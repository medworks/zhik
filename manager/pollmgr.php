<?php 
    include_once("../config.php");
    include_once("../classes/database.php");
	include_once("../classes/messages.php");	
	include_once("../classes/functions.php");
	include_once("../classes/login.php");
	include_once("../lib/persiandate.php");	
	$login = Login::GetLogin();
	if (!$login->IsLogged())
	{
		header("Location: ../index.php");
		die(); // solve a security bug
	}
	$db = Database::GetDatabase();	
	$overall_error = false;
	if ($_GET['item']!="pollmgr")	exit();	
	if (!$overall_error && $_POST["mark"]=="savepoll")
	{	    
	    $regdate = date("Y-m-d H:i:s");
		$fields = array("`title`","`regdate`","`active`");		
		$values = array("'{$_POST[question]}'","'{$regdate}'","'0'");
		if (!$db->InsertQuery('polls',$fields,$values)) 
		{
			//$msgs = $msg->ShowError("ثبت اطلاعات با مشکل مواجه شد");
			header('location:?item=pollmgr&act=new&msg=2');			
			//$_GET["item"] = "pollmgr";
			//$_GET["act"] = "new";
			//$_GET["msg"] = 2;
		} 	
		else 
		{  										
			//$msgs = $msg->ShowSuccess("ثبت اطلاعات با مو??قیت انجام شد");
		   $recid = $db->InsertId();
		   $option=split("\n", $_POST["option"]);
		   $fields = array("`pid`","`option`");				   
		   foreach($option as $row)
		   {
		     $row = strip_tags($row);
		     $values = array("'{$recid}'","'{$row}'");
			 $db->InsertQuery('polloptions',$fields,$values);
		   }
			header('location:?item=pollmgr&act=new&msg=1');		    
			//$_GET["item"] = "pollsmgr";
			//$_GET["act"] = "new";
			//$_GET["msg"] = 1;
		}  				 
	}
    else
	if (!$overall_error && $_POST["mark"]=="editpoll")
	{			    
		$values = array("`title`"=>"'{$_POST[title]}'");
        $db->UpdateQuery("polls",$values,array("id='{$_GET[pid]}'"));
		$recid = $db->InsertId();
	   $option=split("\n", $_POST["option"]);
	   $fields = array("`pid`","`option`");				   
	   foreach($option as $row)
	   {
	     $values = array("`title`"=>"'{$_POST[title]}'");
		 $values = array("`pid`"=>"'{$_GET[pid]}'", "`option`"=>"{$row}");		 
		 $db->UpdateQuery("polls",$values,array("id='{$_GET[pid]}'"));		 
	   }
		header('location:?item=pollmgr&act=mgr');
		//$_GET["item"] = "pollmgr";
		//$_GET["act"] = "act";			
	}else
	if($_GET["act"]=="chg")
	{
		$values = array("`active`"=>"'1'");
		$db->UpdateQuery("polls",$values,array("`id` ='{$_GET[pid]}'"));
		$values = array("`active`"=>"'0'");
		$db->UpdateQuery("polls",$values,array("`id` <>'{$_GET[pid]}'"));	
		header("Location:?item=pollmgr&act=mgr");
	}
	if ($_GET['act']=="new")
	{
		$editorinsert = "
			<p>
				<input type='submit' id='submit' value='ذخیره' class='submit' />	 
				<input type='hidden' name='mark' value='savepoll' />";
	}
	if ($_GET['act']=="edit")
	{
		$row=$db->Select("poll","*","id='{$_GET["pid"]}'",NULL);		
		$editorinsert = "
		<p>
			 <input type='submit' id='submit' value='ویرایش' class='submit' />	 
			 <input type='hidden' name='mark' value='editpoll' />";
	}
	if ($_GET['act']=="del")
	{
		$db->Delete("polls"," id",$_GET["pid"]);
		if ($db->CountAll("polls")%10==0) $_GET["pageNo"]-=1;		
		header("location:?item=pollmgr&act=mgr&pageNo={$_GET[pageNo]}");
	}
	if ($_GET['act']=="do")
	{
		$html=<<<ht
			<div class="title">
			  <ul>
				<li><a href="adminpanel.php?item=dashboard&act=do">پیشخوان</a></li>
				<li><span>مدیریت نظر سنجی</span></li>
			  </ul>
			  <div class="badboy"></div>
			</div>
			<div class="sub-menu" id="mainnav">
				<ul>
				  <li>		  
					<a href="?item=pollmgr&act=new">درج نظرسنجی جدید
						<span class="add-news"></span>
					</a>
				  </li>
				  <li>
					<a href="?item=pollmgr&act=mgr" id="poll" name="poll">حذف/ویرایش نظرسنجی
						<span class="edit-news"></span>
					</a>
				  </li>
				 </ul>
				 <div class="badboy"></div>
			</div>		 
ht;
	}
	else
	if ($_GET['act']=="new" or $_GET['act']=="edit")
	{
	$msgs = GetMessage($_GET['msg']);
	$html=<<<cd
	<form name="frmpollmgr" id="frmpollmgr" class="" action="" method="post" >
	<div class="mes" id="message">{$msgs}</div>
     <p class="note">پر کردن موارد مشخص شده با * الزامی می باشد</p>
	 <div class="badboy"></div>
       <p>
         <label for="cbsection">سوال</label>
         <span>*</span>
       </p>   	
        <input type="text" name="question" value="" />
		<div class="badboy"></div>
       <p>
         <label for="cbsection">گزینه ها</label>
         <span>*</span>
       </p>   	         
         <textarea name="option" rows="10" cols="50"></textarea>         
         {$editorinsert}
	 </form>	 
cd;
	}
 else
if ($_GET['act']=="mgr")
{
	if ($_POST["mark"]=="srhnews")
	{	 		
	    if ($_POST["cbsearch"]=="ndate")
		{
		   date_default_timezone_set('Asia/Tehran');		   
		   list($year,$month,$day) = explode("/", trim($_POST["txtsrh"]));		
		   list($gyear,$gmonth,$gday) = jalali_to_gregorian($year,$month,$day);		
		   $_POST["txtsrh"] = Date("Y-m-d",mktime(0, 0, 0, $gmonth, $gday, $gyear));
		}
		$rows = $db->SelectAll(
				"polls",
				"*",
				"{$_POST[cbsearch]} LIKE '%{$_POST[txtsrh]}%'",
				"regdate DESC",
				$_GET["pageNo"]*10,
				10);
			if (!$rows) 
			{					
				//$_GET['item'] = "pollmgr";
				//$_GET['act'] = "mgr";
				//$_GET['msg'] = 6;				
				header("Location:?item=pollmgr&act=mgr&msg=6");
			}
		
	}
	else
	{	
		$rows = $db->SelectAll(
				"polls",
				"*",
				null,
				"regdate DESC",
				$_GET["pageNo"]*10,
				10);
    }
                $rowsClass = array();
                $colsClass = array();
                $rowCount =($_GET["rec"]=="all" or $_POST["mark"]!="srhnews")?$db->CountAll("polls"):Count($rows);
                for($i = 0; $i < Count($rows); $i++)
                {						
		        $rows[$i]["title"] =(mb_strlen($rows[$i]["title"])>40)?mb_substr($rows[$i]["title"],0,40,"UTF-8")."...":$rows[$i]["title"];
                
                $rows[$i]["regdate"] =ToJalali($rows[$i]["regdate"]," l d F  Y ");
				                                            
				if ($i % 2==0)
				 {
						$rowsClass[] = "datagridevenrow";
				 }
				else
				{
						$rowsClass[] = "datagridoddrow";
				}
				$rows[$i]["active"] = ($rows[$i]["active"]==0)? "<a href='?item=pollmgr&act=chg&pid={$rows[$i]["id"]}' " .
                "style='text-decoration:none;' class='dis-field'></a>" :
                "<a href='?item=pollmgr&act=chg&pid={$rows[$i]["id"]}' " .
                 "style='text-decoration:none;' class='en-field'</a>";				
				$rows[$i]["edit"] = "<a href='?item=pollmgr&act=edit&pid={$rows[$i]["id"]}' class='edit-field'" .
						"style='text-decoration:none;'></a>";								
				$rows[$i]["delete"]=<<< del
				<a href="javascript:void(0)"
				onclick="DelMsg('{$rows[$i]['id']}',
					'از حذف این خبر اطمینان دارید؟',
				'?item=pollmgr&act=del&pageNo={$_GET[pageNo]}&pid=');"
				 class='del-field' style='text-decoration:none;'></a>
del;
                         }

    if (!$_GET["pageNo"] or $_GET["pageNo"]<=0) $_GET["pageNo"] = 0;
            if (Count($rows) > 0)
            {                    
                    $gridcode .= DataGrid(array( 	
							"title"=>"سوال",							
							"regdate"=>"تاریخ",
							"active"=>"فعال/غیر فعال",
                            "edit"=>"ویرایش",
							"delete"=>"حذف",), $rows, $colsClass, $rowsClass, 10,
                            $_GET["pageNo"], "id", false, true, true, $rowCount,"item=pollmgr&act=mgr");                    
            }
$msgs = GetMessage($_GET['msg']);
$list = array("title"=>"عنوان",
              "regdate"=>"تاریخ");
$combobox = SelectOptionTag("cbsearch",$list,"title");
$code=<<<edit
<script type='text/javascript'>
	$(document).ready(function(){	   			
		$('#srhsubmit').click(function(){	
			$('#frmsrh').submit();
			return false;
		});
		$('#cbsearch').change(function(){
			$("select option:selected").each(function(){
	            if($(this).val()=="regdate"){
	            	$('.cal-btn').css('display' , 'inline-block');
	            	return false;
	            }else{
	            	$('.cal-btn').css('display' , 'none');
	            }
  			});
		});
	});
</script>	   
					<div class="title">
				      <ul>
				        <li><a href="adminpanel.php?item=dashboard&act=do">پیشخوان</a></li>
					    <li><span>مدیریت نظرسنجی</span></li>
				      </ul>
				      <div class="badboy"></div>
				  </div>
                    <div class="Top">                       
						<center>
							<form action="?item=pollmgr&act=mgr" method="post" id="frmsrh" name="frmsrh">
								<p>جستجو بر اساس {$combobox}</p>

								<p class="search-form">
									<input type="text" id="date_input_1" name="txtsrh" class="search-form" value="جستجو..." onfocus="if (this.value == 'جستجو...') {this.value = '';}" onblur="if (this.value == '') {this.value = 'جستجو...';}"  /> 
									<img src="./images/cal.png" class="cal-btn" id="date_btn_2" alt="cal-pic">
							         <script type="text/javascript">
							          Calendar.setup({
							            inputField  : "date_input_1",   // id of the input field
							            button      : "date_btn_2",   // trigger for the calendar (button ID)
							                ifFormat    : "%Y/%m/%d",       // format of the input field
							                showsTime   : false,
							                dateType  : 'jalali',
							                showOthers  : true,
							                langNumbers : true,
							                weekNumbers : true
							          });
							        </script>
									<a href="?item=pollmgr&act=mgr" name="srhsubmit" id="srhsubmit" class="button"> جستجو</a>
									<a href="?item=pollmgr&act=mgr&rec=all" name="retall" id="retall" class="button"> کلیه اطلاعات</a>
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