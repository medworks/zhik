<?php
 include_once("../config.php");
 include_once("../classes/database.php");
 include_once("../classes/messages.php");	
 include_once("../classes/functions.php"); 
 include_once("../classes/login.php");
 $login = Login::GetLogin();
 if (!$login->IsLogged())
 {
	header("Location: ../index.php");
	die(); // solve a security bug
 }
 if ($_GET['item']!="uploadmgr")	exit();
 $db = Database::GetDatabase();
 $overall_error = false;
 // in this variable save string bit of pics folders
 $pic_fldr_bit_addr = array("newspics"=>0,
                            "workspics"=>0,
  						    "userspics"=>0,
							"slidespics"=>0,
							"gallerypics"=>0);
 $pic_fldrs = array("newspics","workspics","userspics","slidespics","gallerypics");
 $fa_pic_fldrs = array("اخبار","فعالیت ها","کاربران","اسلایدها","گالری تصاویر");
  for($i=0;$i<count($_POST['picsaddr']);$i++)
  {
	if ($_POST['picsaddr'][$i]=="newspics") {$pic_fldr_bit_addr["newspics"]= 1;}
	if ($_POST['picsaddr'][$i]=="workspics") {$pic_fldr_bit_addr["workspics"]= 1;}
	if ($_POST['picsaddr'][$i]=="userspics") {$pic_fldr_bit_addr["userspics"]= 1;}
	if ($_POST['picsaddr'][$i]=="slidespics") {$pic_fldr_bit_addr["slidespics"]= 1;}	  
	if ($_POST['picsaddr'][$i]=="gallerypics") {$pic_fldr_bit_addr["gallerypics"]= 1;}	  
  }	  
  $str = "";
 foreach($pic_fldr_bit_addr as $key=>$val) {$str .= $val;}
 if (isset($_POST["mark"]) and $_POST["mark"]!="srhnews" and $_POST["mark"]!="editfile")
 { 
	if((!empty($_FILES["pic"])) && ($_FILES['pic']['error'] == 0))
   {
		 $filename =strtolower(basename($_FILES['pic']['name']));
		 $ext = substr($filename, strrpos($filename, '.') + 1);	   		 		
		 $newfilename = $_FILES['pic']['name'];
		 $newname = OS_ROOT."/tmp/".$_FILES['pic']['name'];
		 if (!(move_uploaded_file($_FILES['pic']['tmp_name'],$newname)))
		 {       
			   
		 }		 
		 foreach($pic_fldr_bit_addr as $key=>$val)
		 {
		   if ($val==1)
		   {		   
			 $newname2 = OS_ROOT."/{$key}/".$newfilename;
             copy($newname,$newname2);             	 
		   }	
         }
		 unlink($newname);
	}	 
   else	 
   { 
		//$msgs = $msg->ShowError("لط??ا ??ایل عکس را انتخاب کنید");
		header('location:?item=uploadmgr&act=new&msg=4');
		//$_GET["item"] = "uploadmgr";
		//$_GET["act"] = "new";
		//$_GET["msg"] = 4;
		$overall_error = true;
	}
  }    
  
 if (!$overall_error && $_POST["mark"]=="savefile")
 {						   				
	$fields = array("`image`","`subject`","`body`","`address`");	
	$values = array("'{$filename}'","'{$_POST[subject]}'","'{$_POST[body]}'","'{$str}'");
	if (!$db->InsertQuery('uploadcenter',$fields,$values)) 
	{
		//$msgs = $msg->ShowError("ثبت اطلاعات با مشکل مواجه شد");
		header('location:?item=uploadmgr&act=new&msg=2');
		//exit();
		//$_GET["item"] = "uploadmgr";
		//$_GET["act"] = "new";
		//$_GET["msg"] = 2;
	} 	
	else 
	{  										
		//$msgs = $msg->ShowSuccess("ثبت اطلاعات با موفقیت انجام شد");
		header('location:?item=uploadmgr&act=new&msg=1');					
		//exit();
		//$_GET["item"] = "uploadmgr";
		//$_GET["act"] = "new";
		//$_GET["msg"] = 1;
	 }
 }
 else
 if (!$overall_error && $_POST["mark"]=="editfile")
 {			    
	$values = array("`subject`"=>"'{$_POST[subject]}'",
					"`body`"=>"'{$_POST[body]}'");
	$db->UpdateQuery("uploadcenter",$values,array("id='{$_GET['uid']}'"));
	header('location:?item=uploadmgr&act=mgr');
	//$_GET["item"] = "uploadmgr";
	//$_GET["act"] = "mgr";	
 }

	if ($overall_error)
	{
		$row = array("image"=>$_FILES['pic']['name'],
					 "subject"=>$_POST['subject'],
					 "body"=>$_POST['body']);
	}
 
   if ($_GET['act']=="new")
	{
	    $pic_on_edit_insert_section ="<img id='img' src='' alt='' />";
		$editorinsert = "
			<p>
				<input type='submit' id='submit' value='ذخیره' class='submit' />	 
				<input type='hidden' name='mark' value='savefile' />";
	}
	if ($_GET['act']=="edit")
	{
		$row=$db->Select("uploadcenter","*","id='{$_GET["uid"]}'",NULL);
		$pic_on_edit_insert_section = "<img src='{$row[image]}'width='200px' height='100px' />";
		$editorinsert = "
		<p>
			 <input type='submit' id='submit' value='ویرایش' class='submit' />	 
			 <input type='hidden' name='mark' value='editfile' />";
	}
	if ($_GET['act']=="del")
	{
	    $row=$db->Select("uploadcenter","*","id='{$_GET["uid"]}'",NULL);		
		$add = $row['address'];
		for($i=0;$i<strlen($add);$i++)
		 {
		   if ($add[$i]==1)
		   {
               //$address= OS_ROOT."/{$pic_fldrs[$i]}/".$row['image'];
			   $address= "../{$pic_fldrs[$i]}/".$row['image'];			   
			   unlink($address);
		   }
         }		 
		$db->Delete("uploadcenter"," id",$_GET["uid"]);
		if ($db->CountAll("uploadcenter")%10==0) $_GET["pageNo"]-=1;		
		header("location:?item=uploadmgr&act=mgr&pageNo={$_GET[pageNo]}");
	}	
if ($_GET['act']=="do")
{
	$html=<<<ht
		<div class="title">
	      <ul>
	        <li><a href="adminpanel.php?item=dashboard&act=do">پیشخوان</a></li>
	        <li><span>مدیریت آپلود عکس</span></li>
	      </ul>
	      <div class="badboy"></div>
	    </div>
		<div class="sub-menu" id="mainnav">
			<ul>
			  <li>		  
				<a href="?item=uploadmgr&act=new">عکس جدید
					<span class="add-file"></span>
				</a>
			  </li>
			  <li>
				<a href="?item=uploadmgr&act=mgr" id="news" name="news">
				  حذف/ویرایش عکس ها
					<span class="edit-file"></span>
				</a>
			  </li>
			 </ul>
			 <div class="badboy"></div>
		</div>		 
ht;
}else
if ($_GET['act']=="new" or $_GET['act']=="edit")
{
$msgs = GetMessage($_GET['msg']);
$chechbox = array("newspics"=>"پوشه اخبار",
                  "workspics"=>"پوشه فعالیت ها",
                  "userspics"=>"پوشه کاربران",
				  "slidespics"=>"پوشه اسلاید ها",
				  "gallerypics"=>"پوشه گالری تصاویر");
if ($_GET['act']=="edit")
{
	$checkboxes = CheckboxTag("picsaddr",$chechbox,$row['address']);
	$select_pic_for_new_section	="";				
}	
else
{
	$checkboxes = CheckboxTag("picsaddr",$chechbox);
	$select_pic_for_new_section	="
	<p>
		<label for='pic'>فایل </label>
		<span>*</span>
	</p>
	<div class='upload-file'>
				<input type='file' name='pic' class='validate[required] pic ltr' id='pic' onChange='showPreview(this);' />  
				<span class='filename'>لطفا عکس مورد نظر را انتخاب نمایید</span>
				<span class='action'>انتخاب فایل</span>
			</div>
";			
}	
$html=<<<cd
		<script type='text/javascript'>
			$(document).ready(function(){		
				$("#frmuploadmgr").validationEngine();			   
			});
		</script>
		<div class="title">
	      <ul>
	        <li><a href="adminpanel.php?item=dashboard&act=do">پیشخوان</a></li>
	        <li><span>مدیریت عکس ها</span></li>
	      </ul>
	      <div class="badboy"></div>
	    </div>	     
		<div id="message">
		{$msgs}
		</div>
		<form name="frmuploadmgr" id="frmuploadmgr" class="" action="" method="post" enctype="multipart/form-data" > 			
			{$select_pic_for_new_section}
		   <div class="badboy"></div>
		   <div id="imgpreview">
				<img id="img" src="" alt="" />				
			</div>
			<p>
				<label for="subject">اسم مستعار</label>
				<span></span>
			</p>
			<input type="text" name="subject" class="subject" id="subject" value="{$row[subject]}" />
			<p>
				<label for="body">توضیحات </label>
				<span></span>
			</p>
			<input type="text" name="body" class="subject" id="body" value="{$row[body]}" /> 
			<p>
				<label for="picsadr">محل ذخیره سازی فایل</label>
				<span>*</span>
			</p>			
			{$checkboxes}
			{$editorinsert}
				<input type="reset" value="پاک کردن" class='reset' /> 				
			</p>
		</form>
cd;
}
else
if ($_GET['act']=="mgr")
{
	if ($_POST["mark"]=="srhnews")
	{	 			   
		$rows = $db->SelectAll(
				"uploadcenter",
				"*",
				"{$_POST[cbsearch]} LIKE '%{$_POST[txtsrh]}%'",
				"id DESC",
				$_GET["pageNo"]*10,
				10);
			if (!$rows) 
			{					
				//$_GET['item'] = "uploadmgr";
				//$_GET['act'] = "mgr";
				//$_GET['msg'] = 6;				
				header("Location:?item=uploadmgr&act=mgr&msg=6");
			}
		
	}
	else
	{	
		$rows = $db->SelectAll(
				"uploadcenter",
				"*",
				null,
				"id DESC",
				$_GET["pageNo"]*10,
				10);
    }
                $rowsClass = array();
                $colsClass = array();
                $rowCount =($_GET["rec"]=="all" or $_POST["mark"]!="srhnews" )?$db->CountAll("uploadcenter"):Count($rows);
                for($i = 0; $i < Count($rows); $i++)
                {						
		        $rows[$i]["subject"] =(mb_strlen($rows[$i]["subject"])>20)?mb_substr($rows[$i]["subject"],0,20,"UTF-8")."...":$rows[$i]["subject"];
                $rows[$i]["body"] =(mb_strlen($rows[$i]["body"])>30)?
                mb_substr(html_entity_decode(strip_tags($rows[$i]["body"]), ENT_QUOTES, "UTF-8"), 0, 30,"UTF-8") . "..." :
                html_entity_decode(strip_tags($rows[$i]["body"]), ENT_QUOTES, "UTF-8");               
				$adr = $rows[$i]['address'];
				//echo "adr is ",$adr;
				for($j=0;$j<strlen($adr);$j++)
				 {
				   if ($adr[$j]==1)
				   {					   
					   $picaddress = "../{$pic_fldrs[$j]}/".$rows[$i]['image'];
					   break;
				   }
				 }	
                $rows[$i]["image"] ="<img src='{$picaddress}' alt='{$rows[$i][subject]}' width='40px' height='40px' />";
				$picaddress = array();
				for($j=0;$j<strlen($adr);$j++)
				 {
				   if ($adr[$j]==1)
				   {					   
					   $picaddress[] = $fa_pic_fldrs[$j];
				   }
				 }
				 $place = implode(" - ",$picaddress);
				 $rows[$i]["place"] = $place;
				
				if ($i % 2==0)
				 {
						$rowsClass[] = "datagridevenrow";
				 }
				else
				{
						$rowsClass[] = "datagridoddrow";
				}				
				$rows[$i]["edit"] = "<a href='?item=uploadmgr&act=edit&uid={$rows[$i]["id"]}' class='edit-field'" .
						"style='text-decoration:none;'></a>";								
				$rows[$i]["delete"]=<<< del
				<a href="javascript:void(0)"
				onclick="DelMsg('{$rows[$i]['id']}',
					'از حذف این فعالیت اطمینان دارید؟',
				'?item=uploadmgr&act=del&pageNo={$_GET[pageNo]}&uid=');"
				 class='del-field' style='text-decoration:none;'></a>
del;
               }

    if (!$_GET["pageNo"] or $_GET["pageNo"]<=0) $_GET["pageNo"] = 0;
            if (Count($rows) > 0)
            {                    
                    $gridcode.= DataGrid(array( 
							"image"=>"عکس",
							"subject"=>"عنوان",
							"body"=>"توضیحات",
							"place"=>"محل عکس",
                            "edit"=>"ویرایش",
							"delete"=>"حذف",), $rows, $colsClass, $rowsClass, 10,
                            $_GET["pageNo"], "id", false, true, true, $rowCount,"item=uploadmgr&act=mgr");
                    
            }
$msgs = GetMessage($_GET['msg']);
$list = array("subject"=>"عنوان",
              "body"=>"توضیحات" );
$combobox = SelectOptionTag("cbsearch",$list,"subject");
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
				        <li><a href="adminpanel.php?item=dashboard&act=do">پیشخوان</a></li>
					    <li><span> مدیریت آپلود</span></li>
				      </ul>
				      <div class="badboy"></div>
				  </div>
                    <div class="Top">                       
						<center>
							<form action="?item=uploadmgr&act=mgr" method="post" id="frmsrh" name="frmsrh">
								<p>جستجو بر اساس {$combobox}							
									<input type="text" name="txtsrh" class="search-form" value="جستجو..." onfocus="if (this.value == 'جستجو...') {this.value = '';}" onblur="if (this.value == '') {this.value = 'جستجو...';}"  />
									<a href="?item=uploadmgr&act=mgr" name="srhsubmit" id="srhsubmit" class="button"> جستجو</a>
									<a href="?item=uploadmgr&act=mgr&rec=all" name="retall" id="retall" class="button"> کلیه اطلاعات</a>
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