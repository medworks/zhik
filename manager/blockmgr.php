<?php
    include_once("../config.php");
    include_once("../classes/database.php");
	include_once("../classes/messages.php");
	include_once("../classes/session.php");	
	include_once("../classes/functions.php");
	include_once("../classes/login.php");
	$login = Login::GetLogin();
	if (!$login->IsLogged())
	{
		header("Location: ../index.php");
		die(); // solve a security bug
	}
	if ($_GET['item']!="blocksmgr")	exit();
	$db = Database::GetDatabase();
	$msg = Message::GetMessage();
	if (isset($_POST["mark"]) and $_POST["mark"]!="srhnews")
	{	   
		if (empty($_POST['content']))
		{
		   header('location:?item=blocksmgr&act=new&msg=5');
			//$_GET["item"] = "blocksmgr";
			//$_GET["act"] = "new";
			//$_GET["msg"] = 5;
		    $overall_error = true;
		}
	}
	if (!$overall_error && $_POST["mark"]=="saveblocks")
	{	    
		$fields = array("`name`","`pos`","`order`","`acclevel`","`plugin`","`content`","`contenttype`");
		$_POST["content"] = addslashes($_POST["content"]);
		$values = array("'{$_POST[subject]}'","'{$_POST[cbpos]}'","'{$_POST[order]}'","'{$_POST[cbauth]}'","'{$_POST[cbplugin]}'","'{$_POST[content]}'","'{$_POST[cbtype]}'");						
		if (!$db->InsertQuery('block',$fields,$values)) 
		{
			//$msgs = $msg->ShowError("ثبت اطلاعات با مشکل مواجه شد");
			header('location:?item=blocksmgr&act=new&msg=2');
			//exit();
			//$_GET["item"] = "blocksmgr";
			//$_GET["act"] = "new";
			//$_GET["msg"] = 2;
		} 	
		else 
		{  										
			//$msgs = $msg->ShowSuccess("ثبت اطلاعات با مو??قیت انجام شد");
			header('location:?item=blocksmgr&act=new&msg=1');
			//$_GET["item"] = "blocksmgr";
			//$_GET["act"] = "new";
			//$_GET["msg"] = 1;
		}  				 
	}
    else
	if (!$overall_error && $_POST["mark"]=="editblocks")
	{		
	    $_POST["content"] = addslashes($_POST["content"]);	    
		$values = array("`name`"=>"'{$_POST[subject]}'",
						 "`pos`"=>"'{$_POST[cbpos]}'",
						 "`order`"=>"'{$_POST[order]}'",
						 "`acclevel`"=>"'{$_POST[cbauth]}'",
						 "`plugin`"=>"'{$_POST[cbplugin]}'",
						 "`content`"=>"'{$_POST[content]}'",
						 "`contenttype`"=>"'{$_POST[cbtype]}'");			
        $db->UpdateQuery("blocks",$values,array("id='{$_GET[bid]}'"));
		header('location:?item=blocksmgr&act=mgr');
		//$_GET["item"] = "blocksmgr";
		//$_GET["act"] = "new";			
	}

	if ($overall_error)
	{
		$row = array("subject"=>$_POST['subject'],
		             "image"=>$_POST['image'],
					 "body"=>$_POST['detail'],
					 "ndate"=>$_POST['ndate'],
					 "userid"=>$userid,
					 "resource"=>$_POST['res'],
					 "groupname"=>$_POST['group']);
	}
	
	
	if ($_GET['act']=="new")
	{
		$editorinsert = "
			<p>
				<input type='submit' id='submit' value='ذخیره' class='submit' />	 
				<input type='hidden' name='mark' value='saveblocks' />";
	}
	if ($_GET['act']=="edit")
	{		
		$editorinsert = "
		<p>
			 <input type='submit' id='submit' value='ویرایش' class='submit' />	 
			 <input type='hidden' name='mark' value='editblocks' />";
	}	
	if ($_GET['act']=="do")
	{
	$html=<<<ht
		<div class="title">
	      <ul>
	        <li><a href="?item=dashboard&act=do">پیشخوان</a></li>
	        <li><span>مدیریت بلاک ها</span></li>
	      </ul>
	      <div class="badboy"></div>
	    </div>
		<div class="sub-menu" id="mainnav">
			<ul>
			  <li>		  
				<a href="?item=blocksmgr&act=new"> ایجاد بلاک
					<span class="add-block"></span>
				</a>
			  </li>
			  <li>
				<a href="?item=blocksmgr&act=mgr" >حذف/ویرایش بلاک
					<span class="edit-block"></span>
				</a>
			  </li>
			 </ul>
			 <div class="badboy"></div>
		</div>		 
ht;
} else
if ($_GET['act']=="new" or $_GET['act']=="edit")
{
$msgs = GetMessage($_GET['msg']);
$plugin = array( "1"=>"خبرنامه",
                 "2"=>"نظر سنجی");			     
$plugin = SelectOptionTag("cbplugin",$plugin,"1",null,"select");
$pos = array( "1"=>"راست",
              "2"=>"چپ",
			  "3"=>"بالا",
			  "4"=>"پایین");
$pos = SelectOptionTag("cbpos",$pos,"1",null,'select validate[required]');
$auth = array("1"=>"کلیه کاربران",
              "2"=>"کاربران مدیر ",
			  "3"=>"کاربران عضو");
$auth = SelectOptionTag("cbauth",$auth,"1",null,'select validate[required]');

$type = array("1"=>"عادی",
              "2"=>"چرخشی");
$type = SelectOptionTag("cbtype",$type,"1",null,'select validate[required]');
$html=<<<cd
	<script type='text/javascript'>
		$(document).ready(function(){	   
			$("#frmblocks").validationEngine();			
    });
	</script>	   
  <div class="title">
      <ul>
        <li><a href="adminpanel.php?item=dashboard&act=do">پیشخوان</a></li>
	    <li><span>مدیریت اخبار</span></li>
      </ul>
      <div class="badboy"></div>
  </div>
  <div class="mes" id="message">{$msgs}</div>
  <div class='content'>
	<form name="frmblocks" id="frmblocks" class="" action="" method="post" >
     <p class="note">پر کردن موارد مشخص شده با * الزامی می باشد</p>
	 <div class="badboy"></div>
      <p>
         <label for="subject">عنوان </label>
         <span>*</span>
      </p>    
      <input type="text" name="subject" class="validate[required] subject" id="subject" value='{$row[name]}'/> 
	  <p>
         <label for="cbplugin">انتساب به پلاگین</label>
      </p>
	  {$plugin}
	  <div class="badboy"></div>
	  <p>
         <label for="cbpos">موقعیت مکانی</label>
         <span>*</span>
      </p> 
       {$pos}
       <div class="badboy"></div>
      <p>
         <label for="order">ترتیب مکانی</label>
      </p>    
      <input type="text" name="order" class="subject" id="order" value='{$row[order]}'/> 
      <p>
         <label for="cbauth">نمایش برای</label>
         <span>*</span>
      </p>
	  {$auth}
	  <div class="badboy"></div>
      <p>
         <label for="cbtype">نوع محتوا</label>
         <span>*</span>
      </p>    
      {$type}
       <div class="badboy"></div>
	  <p>
         <label for="content">محتوا </label>
      </p>   
	  <textarea cols="40" rows="8" name="content" class="detail" id="content" > </textarea>
	  {$editorinsert}       
      	 <input type="reset" value="پاک کردن" class='reset' /> 	 	     
       </p>  
	</form>
</div> 

<!-- TinyMCE -->
	<script type="text/javascript" src="../lib/js/tiny/tiny_mce.js"></script>
	<script type="text/javascript">
		tinyMCE.init({
			// General options
			mode : "textareas",
			theme : "advanced",
			skin : "o2k7",
			plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",
			init_instance_callback : "initialiseInstance",

			// Theme options
			theme_advanced_buttons1 : "newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
			theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
			theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen,|,table",
			theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
			theme_advanced_toolbar_location : "top",
			theme_advanced_toolbar_align : "right",
			theme_advanced_statusbar_location : "bottom",
			theme_advanced_resizing : true,

			// Example content CSS (should be your site CSS)
			content_css : "../lib/js/tiny/tiny_mce/css/content.css",

			// Drop lists for link/image/media/template dialogs
			template_external_list_url : "../lib/js/tiny/tiny_mce/lists/template_list.js",
			external_link_list_url : "../lib/js/tiny/tiny_mce/lists/link_list.js",
			external_image_list_url : "../lib/js/tiny/tiny_mce/lists/image_list.js",
			media_external_list_url : "../lib/js/tiny/tiny_mce/lists/media_list.js",

			// Style formats
			style_formats : [
				{title : 'Bold text', inline : 'b'},
				{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
				{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
				{title : 'Example 1', inline : 'span', classes : 'example1'},
				{title : 'Example 2', inline : 'span', classes : 'example2'},
				{title : 'Table styles'},
				{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
			],

			// Replace values for the template plugin
			template_replace_values : {
				username : "Some User",
				staffid : "991234"
			}
		});

		function initialiseInstance(editor){
			$('#submit').click(function(event){
				if(editor.getContent()==""){
					$('#detail_tbl').validationEngine('showPrompt', '* لطفا فیلد توضیحات را تکمیل نمایید', 'red', 'topRight');
				}else{
					$('#detail_tbl').validationEngine('hide');
				}
			});
		}
	</script>
	<!-- /TinyMCE -->   	
	
cd;
}else
if ($_GET['act']=="mgr")
{
	if ($_POST["mark"]=="srhnews")
	{	 			    
		$rows = $db->SelectAll(
				"block",
				"*",
				"{$_POST[cbsearch]} LIKE '%{$_POST[txtsrh]}%'",
				null,
				$_GET["pageNo"]*10,
				10);
			if (!$rows) 
			{					
				//$_GET['item'] = "blocksmgr";
				//$_GET['act'] = "mgr";
				//$_GET['msg'] = 6;				
				header("Location:?item=newsmgr&act=mgr&msg=6");
			}
		
	}
	else
	{		
		$rows = $db->SelectAll(
				"block",
				"*",
				null,
				null,
				$_GET["pageNo"]*10,
				10);
    }
                $rowsClass = array();
                $colsClass = array();
                $rowCount =($_GET["rec"]=="all" or $_POST["mark"]!="srhnews")?$db->CountAll("block"):Count($rows);
                for($i = 0; $i < Count($rows); $i++)
                {						
		        $rows[$i]["name"] =(mb_strlen($rows[$i]["name"])>20)?mb_substr($rows[$i]["name"],0,20,"UTF-8")."...":$rows[$i]["name"];
			    switch($rows[$i]["pos"])
				{
				 case 1: $rows[$i]["pos"] = "راست"; break;
				 case 2: $rows[$i]["pos"] = "چپ"; break;
				 case 3: $rows[$i]["pos"] = "بالا"; break;
				 case 4: $rows[$i]["pos"] = "پایین"; break;
				}
				switch($rows[$i]["acclevel"])
				{
				 case 1: $rows[$i]["acclevel"] = "کلیه کاربران"; break;
				 case 2: $rows[$i]["acclevel"] = "کاربران مدیر"; break;
				 case 3: $rows[$i]["acclevel"] = "کاربران عضو"; break;				 
				}
				switch($rows[$i]["contenttype"])
				{
				 case 1: $rows[$i]["contenttype"] = "عادی"; break;
				 case 2: $rows[$i]["contenttype"] = "چرخشی"; break;				 
				}
				if ($i % 2==0)
				 {
						$rowsClass[] = "datagridevenrow";
				 }
				else
				{
						$rowsClass[] = "datagridoddrow";
				}				
				$rows[$i]["edit"] = "<a href='?item=blocksmgr&act=edit&bid={$rows[$i]["id"]}' class='edit-field'" .
						"style='text-decoration:none;'></a>";								
				$rows[$i]["delete"]=<<< del
				<a href="javascript:void(0)"
				onclick="DelMsg('{$rows[$i]['id']}',
					'از حذف این بلاک اطمینان دارید؟',
				'?item=blocksmgr&act=del&pageNo={$_GET[pageNo]}&bid=');"
				 class='del-field' style='text-decoration:none;'></a>
del;
                         }

    if (!$_GET["pageNo"] or $_GET["pageNo"]<=0) $_GET["pageNo"] = 0;
            if (Count($rows) > 0)
            {                    
                    $gridcode .= DataGrid(array( 
							"name"=>"نام",
							"pos"=>"موقعیت مکانی",
							"order"=>"ترتیب مکانی",
							"acclevel"=>"سطح دسترسی",
							"plugin"=>"پلاگین",							
							"contenttype"=>"نوع محتوا",
                            "edit"=>"ویرایش",
							"delete"=>"حذف",), $rows, $colsClass, $rowsClass, 10,
                            $_GET["pageNo"], "id", false, true, true, $rowCount,"item=blocksmgr&act=mgr");
                    
            }			
$msgs = GetMessage($_GET['msg']);
$list = array("name"=>"نام");
$combobox = SelectOptionTag("cbsearch",$list,"name");
$code=<<<edit
<script type='text/javascript'>
	$(document).ready(function(){	   			
		$('#srhsubmit').click(function(){	
			$('#frmsrh').submit();
			return false;
		});		
	});
</script>	   
					<div class="title">
				      <ul>
				        <li><a href="?item=dashboard&act=do">پیشخوان</a></li>
					    <li><span>مدیریت بلاک ها</span></li>
				      </ul>
				      <div class="badboy"></div>
				  </div>
                    <div class="Top">                       
						<center>
							<form action="?item=blocksmgr&act=mgr" method="post" id="frmsrh" name="frmsrh">
								<p>جستجو بر اساس {$combobox}</p>

								<p class="search-form">
									<input type="text" id="date_input_1" name="txtsrh" class="search-form" value="جستجو..." onfocus="if (this.value == 'جستجو...') {this.value = '';}" onblur="if (this.value == '') {this.value = 'جستجو...';}"  /> 
									<a href="?item=blocksmgr&act=mgr" name="srhsubmit" id="srhsubmit" class="button"> جستجو</a>
									<a href="?item=blocksmgr&act=mgr&rec=all" name="retall" id="retall" class="button"> کلیه اطلاعات</a>
								</p>
								<input type="hidden" name="mark" value="srhnews" /> 
								{$msgs}
								{$gridcode} 
							</form>
					   </center>
					</div>
edit;
$html = $code;
}	
return $html;
?>