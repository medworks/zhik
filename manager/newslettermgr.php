<?php
    include_once("../config.php");
    include_once("../classes/database.php");
	include_once("../classes/messages.php");
	include_once("../classes/session.php");	
	include_once("../classes/functions.php");
	include_once("../classes/login.php");
	include_once("../lib/class.phpmailer.php");
	$login = Login::GetLogin();
	if (!$login->IsLogged())
	{
		header("Location: ../index.php");
		die(); // solve a security bug
	}
	if ($_GET['item']!="newslettermgr")	exit();
	$db = Database::GetDatabase();
	$msg = Message::GetMessage();
	if ($_POST["mark"]=="sendnews")
    {
	  //  echo "mark is ",$_POST["mark"];
		$News_Email=GetSettingValue("News_Email",1);
		$Email_Sender_Name = GetSettingValue("Email_Sender_Name",1);
		$Is_Smtp = GetSettingValue("Is_Smtp_Active",1);
		$rows = $db->SelectAll("usersnews","email");
		$news = $db->Select("news",NULL,"id={$_POST[select]}");		
		$emails = array();
		foreach ($rows as $row) $emails[] = $row["email"];
		if ($Is_Smtp == "yes")
		{
			$host = GetSettingValue("Smtp_Host",1);
			$username = GetSettingValue("Smtp_User_Name",1);
			$password = GetSettingValue("Smtp_Pass_Word",1);
			$port = GetSettingValue("Smtp_Port",1);

			$IsSend = SendSmtpEmail($News_Email, $Email_Sender_Name, $emails,
			          $news["subject"],$news["body"], $host, $port, $username, $password);
	   }
       else
       {
			//echo $News_Email,"<br/>",$Email_Sender_Name,"<br/>",$news["subject"];
			$IsSend = SendEmail($News_Email,$Email_Sender_Name,$emails
						, $news["subject"], $news["body"]);			
       }
    
		if ($IsSend)
		{
			//$msgs=$msg->ShowSuccess("ارسال خبر انجام شد");
			$fields = array("`nid`","`sdate`");	
			$values = array("'{$news["id"]}'","'{$news["ndate"]}'");
			$db->InsertQuery('newsletter',$fields,$values);
		    header('location:?item=newslettermgr&act=new&msg=7');
		}
		else
		{
		   // $msgs=$msg->ShowError("ارسال خبر با خطا مواجه شد");
			header('location:?item=newslettermgr&act=new&msg=8');
		}
	}
	if ($_GET['act']=="dela")
	{
		$db->Delete("newsletter","id",$_GET["nid"]);
		if ($db->CountAll("newsletter")%10==0) $_GET["pageNo"]-=1;		
		header("location:?item=newslettermgr&act=arc&pageNo={$_GET[pageNo]}");
	}
	if ($_GET['act']=="delu")
	{
		$db->Delete("usersnews","id",$_GET["uid"]);
		if ($db->CountAll("usersnews")%10==0) $_GET["pageNo"]-=1;		
		header("location:?item=newslettermgr&act=user&pageNo={$_GET[pageNo]}");
	}
	if ($_POST["mark"]=="setting")
    {
	    SetSettingValue("Email_Sender_Name",$_POST["tbname"]);
		SetSettingValue("Is_Smtp_Active",$_POST["chbsmtp"]);
		SetSettingValue("Smtp_Host",$_POST["tbsmtpadd"]);
		SetSettingValue("Smtp_User_Name",$_POST["tbsmtpuser"]);
		SetSettingValue("Smtp_Pass_Word",$_POST["tbsmtppass"]);
		SetSettingValue("Smtp_Port",$_POST["tbport"]);		
		header('location:?item=newslettermgr&act=set&msg=9');
	}
	if ($_GET['act']=="do")
	{
		$html=<<<ht
		<div class="title">
	      <ul>
	        <li><a href="adminpanel.php?item=dashboard&act=do">پیشخوان</a></li>
	        <li><span>مدیریت خبرنامه</span></li>
	      </ul>
	      <div class="badboy"></div>
	    </div>
		<div class="sub-menu" id="mainnav">
			<ul class="two-column">
			  <li>		  
				<a href="?item=newslettermgr&act=new">ایجاد خبرنامه
					<span class="add-newsletter"></span>
				</a>
			  </li>
			  <li>
				<a href="?item=newslettermgr&act=arc">آرشیو خبرنامه
					<span class="edit-newsletter"></span>
				</a>
			  </li>
			  <li>
				<a href="?item=newslettermgr&act=user">اعضاء خبرنامه
					<span class="member-newsletter"></span>
				</a>
			  </li>
			  <li>
				<a href="?item=newslettermgr&act=set">تنظیمات خبرنامه
					<span class="news-setting"></span>
				</a>
			  </li>
			 </ul>
			 <div class="badboy"></div>
		</div>		 
ht;
}else
if ($_GET['act']=="mgr" or $_GET['act']=="new")
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
				"news",
				"*",
				"{$_POST[cbsearch]} LIKE '%{$_POST[txtsrh]}%'",
				"ndate DESC",
				$_GET["pageNo"]*10,
				10);
			if (!$rows) 
			{					
				//$_GET['item'] = "newslettermgr";
				//$_GET['act'] = "mgr";
				//$_GET['msg'] = 6;				
				header("Location:?item=newslettermgr&act=mgr&msg=6");
			}
		
	}
	else
	{	
		$rows = $db->SelectAll(
				"news",
				"*",
				null,
				"ndate DESC",
				$_GET["pageNo"]*10,
				10);
    }
                $rowsClass = array();
                $colsClass = array();
                $rowCount =($_GET["rec"]=="all" or $_POST["mark"]!="srhnews")?$db->CountAll("news"):Count($rows);				
                for($i = 0; $i < Count($rows); $i++)
                {						
		        $rows[$i]["subject"] =(mb_strlen($rows[$i]["subject"])>20)?mb_substr($rows[$i]["subject"],0,20,"UTF-8")."...":$rows[$i]["subject"];
                $rows[$i]["body"] =(mb_strlen($rows[$i]["body"])>30)?
                mb_substr(html_entity_decode(strip_tags($rows[$i]["body"]), ENT_QUOTES, "UTF-8"), 0, 30,"UTF-8") . "..." :
                html_entity_decode(strip_tags($rows[$i]["body"]), ENT_QUOTES, "UTF-8");               
                $rows[$i]["ndate"] = ToJalali($rows[$i]["ndate"]," l d F  Y ");
				$rows[$i]["select"] = "<input type='radio' name='select' value='{$rows[$i][id]}' > ";
				$rows[$i]["image"] ="<img src='{$rows[$i][image]}' alt='{$rows[$i][subject]}' width='40px' height='40px' />";                                            
				if ($i % 2==0)
				 {
						$rowsClass[] = "datagridevenrow";
				 }
				else
				{
						$rowsClass[] = "datagridoddrow";
				}
				$rows[$i]["username"]=GetUserName($rows[$i]["userid"]); 
				$rows[$i]["catid"] = GetCategoryName($rows[$i]["catid"]);				
                         }

    if (!$_GET["pageNo"] or $_GET["pageNo"]<=0) $_GET["pageNo"] = 0;
            if (Count($rows) > 0)
            {                    
                    $gridcode .= DataGrid(array( 
					        "select"=>"انتخاب",
							"catid"=>"گروه",
							"subject"=>"عنوان",
							"image"=>"تصویر",
							"body"=>"توضیحات",
							"ndate"=>"تاریخ",
							"resource"=>"منبع",							
							"username"=>"کاربر",), $rows, $colsClass, $rowsClass, 10,
                            $_GET["pageNo"], "id", false, true, true, $rowCount,"item=newslettermgr&act=mgr");
                    
            }
$msgs = GetMessage($_GET['msg']);
$list = array("subject"=>"عنوان",
              "body"=>"توضیحات",
			  "ndate"=>"تاریخ",
			  "resource"=>"منبع");
$combobox = SelectOptionTag("cbsearch",$list,"subject");
$code=<<<edit
<script type='text/javascript'>
	$(document).ready(function(){	   			
		$('#srhsubmit').click(function(){	
			$('#frmsrh').submit();
			return false;
		});
		$('#cbsearch').change(function(){
			$("select option:selected").each(function(){
	            if($(this).val()=="ndate"){
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
					    <li><span>مدیریت خبرنامه</span></li>
				      </ul>
				      <div class="badboy"></div>
				  </div>
                    <div class="Top">                       
						<center>
							<form action="?item=newslettermgr&act=mgr" method="post" id="frmsrh" name="frmsrh">
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
									<a href="?item=newslettermgr&act=mgr" name="srhsubmit" id="srhsubmit" class="button"> جستجو</a>
									<a href="?item=newslettermgr&act=mgr&rec=all" name="retall" id="retall" class="button"> کلیه اطلاعات</a>
								</p>
								<input type="hidden" name="mark" value="srhnews" /> 
								 <div class="mes" id="message">{$msgs}</div>

								{$gridcode}
								<br />
								<input type='submit' id='submit' value='ارسال' class='submit' />	 
			                    <input type='hidden' name='mark' value='sendnews' />
							</form>
					   </center>
					</div>

edit;
$html = $code;
}
else
if ($_GET['act']=="arc")
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
				"newsletter",
				"*",
				"{$_POST[cbsearch]} LIKE '%{$_POST[txtsrh]}%'",
				"sdate DESC",
				$_GET["pageNo"]*10,
				10);
			if (!$rows) 
			{					
				//$_GET['item'] = "newslettermgr";
				//$_GET['act'] = "mgr";
				//$_GET['msg'] = 6;				
				header("Location:?item=newslettermgr&act=arc&msg=6");
			}
		
	}
	else
	{	
		$rows = $db->SelectAll(
				"newsletter",
				"*",
				null,
				"sdate DESC",
				$_GET["pageNo"]*10,
				10);
    }
                $rowsClass = array();
                $colsClass = array();
                $rowCount =($_GET["rec"]=="all" or $_POST["mark"]!="srhnews")?$db->CountAll("newsletter"):Count($rows);				
                for($i = 0; $i < Count($rows); $i++)
                {						
				    $row = $db->Select("news","subject","id ={$rows[$i][nid]}");
					$rows[$i]["subject"] =(mb_strlen($row[0])>40)?mb_substr($row[0],0,40,"UTF-8")."...":$row[0];                
					$rows[$i]["sdate"] = ToJalali($rows[$i]["sdate"]," l d F  Y ");								
					if ($i % 2==0)
					{
							$rowsClass[] = "datagridevenrow";
					}
					else
					{
							$rowsClass[] = "datagridoddrow";
					}
					$rows[$i]["delete"]=<<< del
				<a href="javascript:void(0)"
				onclick="DelMsg('{$rows[$i]['id']}',
					'از حذف این خبر اطمینان دارید؟',
				'?item=newslettermgr&act=dela&pageNo={$_GET[pageNo]}&nid=');"
				 class='del-field' style='text-decoration:none;'></a>
del;
                }

    if (!$_GET["pageNo"] or $_GET["pageNo"]<=0) $_GET["pageNo"] = 0;
            if (Count($rows) > 0)
            {                    
                    $gridcode .= DataGrid(array( 			
							"subject"=>"عنوان",
							"sdate"=>"تاریخ",
							"delete"=>"حذف",), $rows, $colsClass, $rowsClass, 10,
                            $_GET["pageNo"], "id", false, true, true, $rowCount,"item=newslettermgr&act=arc");
                    
            }
$msgs = GetMessage($_GET['msg']);
$list = array("subject"=>"عنوان",              
			  "sdate"=>"تاریخ",);
$combobox = SelectOptionTag("cbsearch",$list,"subject");
$code=<<<edit
<script type='text/javascript'>
	$(document).ready(function(){	   			
		$('#srhsubmit').click(function(){	
			$('#frmsrh').submit();
			return false;
		});
		$('#cbsearch').change(function(){
			$("select option:selected").each(function(){
	            if($(this).val()=="sdate"){
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
					    <li><span>مدیریت خبرنامه</span></li>
				      </ul>
				      <div class="badboy"></div>
				  </div>
                    <div class="Top">                       
						<center>
							<form action="?item=newslettermgr&act=arc" method="post" id="frmsrh" name="frmsrh">
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
									<a href="?item=newslettermgr&act=arc" name="srhsubmit" id="srhsubmit" class="button"> جستجو</a>
									<a href="?item=newslettermgr&act=arc&rec=all" name="retall" id="retall" class="button"> کلیه اطلاعات</a>
								</p>
								<input type="hidden" name="mark" value="srhnews" /> 
								 <div class="mes" id="message">{$msgs}</div>

								{$gridcode}
							</form>
					   </center>
					</div>

edit;
$html = $code;
}
else
if ($_GET['act']=="user")
{
$rows = $db->SelectAll(
				"usersnews",
				"*",
				null,
				"id ASC",
				$_GET["pageNo"]*10,
				10);
                $rowsClass = array();
                $colsClass = array();
                $rowCount =($_GET["rec"]=="all" or $_POST["mark"]!="srhnews")?$db->CountAll("usersnews"):Count($rows);
                for($i = 0; $i < Count($rows); $i++)
                {								                                            
					if ($i % 2==0)
					 {
							$rowsClass[] = "datagridevenrow";
					 }
					else
					{
							$rowsClass[] = "datagridoddrow";
					}
					
				$rows[$i]["delete"]=<<< del
				<a href="javascript:void(0)"
				onclick="DelMsg('{$rows[$i]['id']}',
					'از حذف این فعالیت اطمینان دارید؟',
				'?item=newslettermgr&act=delu&pageNo={$_GET[pageNo]}&uid=');"
				 class='del-field' style='text-decoration:none;'></a>
del;
								
                }
				
    if (!$_GET["pageNo"] or $_GET["pageNo"]<=0) $_GET["pageNo"] = 0;
            if (Count($rows) > 0)
            {                    
                    $gridcode .= DataGrid(array( 
					        "name"=>"نام",
							"tel"=>"تلفن",
					        "email"=>"ایمیل",
							"delete"=>"حذف",), $rows, $colsClass, $rowsClass, 10,
                            $_GET["pageNo"], "id", false, true, true, $rowCount,"item=newslettermgr&act=user");
                    
            }

$html = $gridcode;
}else
if ($_GET['act']=="set")
{
	$Email_Sender_Name = GetSettingValue('Email_Sender_Name',0);
    if(GetSettingValue("Is_Smtp_Active",1)=="yes")
    {
        $Is_Smtp ="checked";
    }
    else {$Is_Smtp ="";}
    $Smtp_Host = GetSettingValue("Smtp_Host",1);
    $Smtp_User_Name = GetSettingValue("Smtp_User_Name",1);
    $Smtp_Pass_Word = GetSettingValue("Smtp_Pass_Word",1);
    $Smtp_Port = GetSettingValue("Smtp_Port",1);
	$msgs = GetMessage($_GET['msg']);
    $html=<<<set
	<div class="mes" id="message">{$msgs}</div>
   <form action="" method="post">   
	   <p>
         <label for="subject">نام فرستنده </label>
         <span>*</span>
       </p>
        <input type="text" name="tbname"  value="{$Email_Sender_Name}" />                
			<p>
				<label for="subject">استفاده از SMTP </label>
				<span>*</span>
			</p>
				<p><input type="checkbox" name="chbsmtp" value="yes" {$Is_Smtp}/></p>
			<p>
				<label for="subject">آدرس SMTP </label>
				<span>*</span>
			</p>
				 <input type="text" name="tbsmtpadd" value="{$Smtp_Host}" />
			<p>
				<label for="subject">نام کاربری  SMTP </label>
				<span>*</span>
			</p>
			 <input type="text" name="tbsmtpuser" value="{$Smtp_User_Name}" />
			 <p>
				<label for="subject">کلمه عبور SMTP </label>
				<span>*</span>
			</p>                        
			 <input type="password" name="tbsmtppass" value="{$Smtp_Pass_Word}" /> 
			 <p>
				<label for="subject">پورت SMTP </label>
				<span>*</span>
			</p>
			 <input type="text" name="tbport" value="{$Smtp_Port}" />           
           <input  type="submit" value="ثبت/ویرایش" />
           <input type="hidden" name="mark" value="setting" />                                              
   </form>
set;
}
	
return $html;
?>