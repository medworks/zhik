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
	if ($_GET['item']!="usermgr")	exit();
	$db = Database::GetDatabase();
	$msg = Message::GetMessage();
	$overall_error = false;
	$pass = "";
	if (isset($_POST["mark"]) and $_POST["mark"]!="srhnews")    
	{
		$msgs = "";	    
		// if(empty($_POST["selectpic"]))
		// {
		// 	//$msgs = $msg->ShowError("لط??ا ??ایل عکس را انتخاب کنید");
		// 	//header('location:?item=newsmgr&act=new&msg=4');
		// 	$_GET["item"] = "usermgr";
		// 	$_GET["act"] = "new";
		// 	$_GET["msg"] = 4;
		// 	$overall_error = true;
		// 	//exit();
		// }		
	}	
	if (!$overall_error &&$_POST["mark"]=="saveuser")
	{
	    $pass = md5($_POST[password]);
		$fields = array("`name`","`family`","`image`","`email`","`username`","`password`");
		$values = array("'{$_POST[name]}'","'{$_POST[family]}'","'{$_POST[selectpic]}'","'{$_POST[email]}'","'{$_POST[username]}'","'{$pass}'");	
		if (!$db->InsertQuery('users',$fields,$values)) 
		{
			//$msgs = $msg->ShowError("ثبت اطلاعات با مشکل مواجه شد");
			header('location:?item=usermgr&act=new&msg=2');
			//exit();
			//$_GET["item"] = "usermgr";
			//$_GET["act"] = "new";
			//$_GET["msg"] = 2;
		} 	
		else 
		{  										
			//$msgs = $msg->ShowSuccess("ثبت اطلاعات با موفقیت انجام شد");
			header('location:?item=usermgr&act=new&msg=1');					
			//exit();
			//$_GET["item"] = "usermgr";
			//$_GET["act"] = "new";
			//$_GET["msg"] = 1;
		}  				 
	}
	else
	if (!$overall_error && $_POST["mark"]=="edituser")
	{			    
	    $row=$db->Select("users","*","id='{$_GET["uid"]}'",NULL);	    
		if ($_POST['password'] != $row['password'])
			$pass = md5($_POST['password']);
		else
			$pass = $_POST['password'];
		$values = array("`name`"=>"'{$_POST[name]}'",
		                 "`family`"=>"'{$_POST[family]}'",
						 "`image`"=>"'{$_POST[selectpic]}'",
						 "`email`"=>"'{$_POST[email]}'",
						 "`username`"=>"'{$_POST[username]}'",
						 "`password`"=>"'{$pass}'");		
        $db->UpdateQuery("users",$values,array("id='{$_GET[uid]}'"));		
		header('location:?item=usermgr&act=mgr');
		//$_GET["item"] = "usermgr";
		//$_GET["act"] = "mgr";		
	}

	if ($overall_error)
	{
		$row = array("name"=>$_POST['name'],
		             "family"=>$_POST['family'],
					 "image"=>$_POST['selectpic'],
					 "email"=>$_POST['email'],
					 "username"=>$_POST['username'],
					 "password"=>$_POST['password']);
	}
if ($_GET['act']=="new")
{
	$pic_on_edit_insert_section = "";
	$editorinsert = "
		<p>
			<input type='submit' id='submit' value='ذخیره' class='submit' />	 
			<input type='hidden' name='mark' value='saveuser' />";
}
if ($_GET['act']=="edit")
{
	$row=$db->Select("users","*","id='{$_GET["uid"]}'",NULL);
	$pic_on_edit_insert_section = "<img src='{$row[image]}'width='200px' height='200px' />";
	$editorinsert = "
	<p>
      	 <input type='submit' id='submit' value='ویرایش' class='submit' />	 
      	 <input type='hidden' name='mark' value='edituser' />";
}
if ($_GET['act']=="del")
{
	$db->Delete("users"," id",$_GET["uid"]);
	if ($db->CountAll("users")%10==0) $_GET["pageNo"]-=1;		
	header("location:?item=usermgr&act=mgr&pageNo={$_GET[pageNo]}");
}	
if ($_GET['act']=="do")
{
	$html=<<<ht
		<div class="title">
	      <ul>
	        <li><a href="adminpanel.php?item=dashboard&act=do">پیشخوان</a></li>
	        <li><span>مدیریت کاربران</span></li>
	      </ul>
	      <div class="badboy"></div>
	    </div>
		<div class="sub-menu" id="mainnav">
			<ul>
			  <li>		  
				<a href="?item=usermgr&act=new">درج کاربر جدید
					<span class="add-user"></span>
				</a>
			  </li>
			  <li>
				<a href="?item=usermgr&act=mgr" id="news" name="news">حذف/ویرایش کاربران 
					<span class="edit-user"></span>
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
$html=<<<cd
<script type='text/javascript'>
	$(document).ready(function(){		
	$("#frmusermgr").validationEngine();	  
		$("#submit").click(function(){		    
			//alert("test");
			//$("#message").html('saeid hatami');
		//window.location.href="?item=usermgr&act=do";
			//$("#message").fadeOut(5000,function (){
              //    window.location.href="?item=usermgr&act=do"});
			 
          });		  
    });	   
</script>	     
  <div class="title">
      <ul>
        <li><a href="adminpanel.php?item=dashboard&act=do">پیشخوان</a></li>
        <li><a href="#">مدیریت کاربران</a></li>
      </ul>
      <div class="badboy"></div>
  </div>  
  <div class="content">
    <form name="frmusermgr" id= "frmusermgr" class="usermgr" action="" method="post" enctype="multipart/form-data" >
	  <div class="mes" id="message">{$msgs}</div>
       <p class="note">پر کردن موارد مشخص شده با * الزامی می باشد</p>
       <p>
         <label for="name">نام </label>
         <span>*</span>
       </p>  	 
       <input type="text" name="name" class="validate[required] name" id="name" value="{$row[name]}" />
	   <p>
         <label for="family">نام خانوادگی </label>
         <span>*</span>
       </p>  	 
       <input type="text" name="family" class="validate[required] family" id="family" value="{$row[family]}"/>
       <p>
         <label for="family">عکس فعلی </label>
       </p> 
       <div class="userpic right">{$pic_on_edit_insert_section}</div>
       <div class="badboy"></div>
       <p>
    	 <label for="pic">عکس جدید </label>
       </p>
       <p>
          <input type="text" name="selectpic" class="selectpic" id="selectpic" value='{$row[image]}' />
          <input type="text" class="showadd" id="showadd" value='{$row[image]}' />
          <a class="filesbrowserbtn" id="filesbrowserbtn" name="usermgr" title="گالری تصاویر">گالری تصاویر</a>
          <a class="selectbuttton" id="selectbuttton" title="انتخاب">انتخاب</a>
       </p>
       <div class="badboy"></div>
       <div id="filesbrowser"></div>
       <div class="badboy"></div>
       <p>
         <label for="email">ایمیل </label>
         <span>*</span>
       </p>  	 
       <input type="text" name="email" class="validate[required,custom[email]] email ltr" id="email" value="{$row[email]}"/>
       <p>
         <label for="username">نام کاربری </label>
         <span>*</span>
       </p>  	 
       <input type="text" name="username" class="validate[required] username ltr" id="username" value="{$row[username]}"/>
	   <p>
         <label for="password">رمز عبور </label>
         <span>*</span>
       </p>  	 
       <input type="password" name="password" class="validate[required] password ltr" id="password" value="{$row[password]}"/>
	   <p>
         <label for="cpassword">تکرار رمز عبور </label>
         <span>*</span>
       </p>  	 
       <input type="password" name="cpassword" class="validate[required,equals[password]] cpassword ltr" id="cpassword" value="{$row[password]}" />       
       {$editorinsert}
      	 <input type="reset" value="پاک کردن" class="reset" /> 	 	 
       </p>
    </form>
    <div class="badboy"></div>
  </div>   
cd;
}
else
if ($_GET['act']=="mgr")
{
	if ($_POST["mark"]=="srhnews")
	{	 			   
		$rows = $db->SelectAll(
				"users",
				"*",
				"{$_POST[cbsearch]} LIKE '%{$_POST[txtsrh]}%'",
				"id ASC",
				$_GET["pageNo"]*10,
				10);
			if (!$rows) 
			{					
				//$_GET['item'] = "usermgr";
				//$_GET['act'] = "mgr";
				//$_GET['msg'] = 6;				
				header("Location:?item=usermgr&act=mgr&msg=6");
			}
		
	}
	else
	{	
		$rows = $db->SelectAll(
				"users",
				"*",
				null,
				"id ASC",
				$_GET["pageNo"]*10,
				10);
    }
                $rowsClass = array();
                $colsClass = array();
                $rowCount =($_GET["rec"]=="all" or $_POST["mark"]!="srhnews" )?$db->CountAll("users"):Count($rows);
                for($i = 0; $i < Count($rows); $i++)
                {						
		                       
					$rows[$i]["image"] ="<img src='{$rows[$i][image]}' alt='{$rows[$i][subject]}' width='40px' height='40px' />";				
					if ($i % 2==0)
					{
						$rowsClass[] = "datagridevenrow";
					}
					else
					{
						$rowsClass[] = "datagridoddrow";
					}				
				$rows[$i]["edit"] = "<a href='?item=usermgr&act=edit&uid={$rows[$i]["id"]}' class='edit-field'" .
						"style='text-decoration:none;'></a>";								
				$rows[$i]["delete"]=<<< del
				<a href="javascript:void(0)"
				onclick="DelMsg('{$rows[$i]['id']}',
					'از حذف این فعالیت اطمینان دارید؟',
				'?item=usermgr&act=del&pageNo={$_GET[pageNo]}&uid=');"
				 class='del-field' style='text-decoration:none;'></a>
del;
               }

    if (!$_GET["pageNo"] or $_GET["pageNo"]<=0) $_GET["pageNo"] = 0;
            if (Count($rows) > 0)
            {                    
                    $gridcode.= DataGrid(array( 
							"name"=>"نام",
							"family"=>"نام خانوادگی",
							"image"=>"عکس",
							"email"=>"ایمیل",
							"username"=>"نام کاربری",
                            "edit"=>"ویرایش",
							"delete"=>"حذف",), $rows, $colsClass, $rowsClass, 10,
                            $_GET["pageNo"], "id", false, true, true, $rowCount,"item=usermgr&act=mgr");
                    
            }
$msgs = GetMessage($_GET['msg']);
$list = array("name"=>"نام",
              "family"=>"نام خانوادگی",
			  "username"=>"نام کاربری");              
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
				        <li><a href="adminpanel.php?item=dashboard&act=do">پیشخوان</a></li>
					    <li><span> مدیریت آپلود</span></li>
				      </ul>
				      <div class="badboy"></div>
				  </div>
                    <div class="Top">                       
						<center>
							<form action="?item=usermgr&act=mgr" method="post" id="frmsrh" name="frmsrh">
								<p>جستجو بر اساس {$combobox}							
									<input type="text" name="txtsrh" class="search-form" value="جستجو..." onfocus="if (this.value == 'جستجو...') {this.value = '';}" onblur="if (this.value == '') {this.value = 'جستجو...';}"  />
									<a href="?item=usermgr&act=mgr" name="srhsubmit" id="srhsubmit" class="button"> جستجو</a>
									<a href="?item=usermgr&act=mgr&rec=all" name="retall" id="retall" class="button"> کلیه اطلاعات</a>
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