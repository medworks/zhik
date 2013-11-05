<?php
include_once("../config.php");
include_once("../classes/database.php");
include_once("../classes/session.php");
include_once("../classes/login.php");
include_once("../classes/messages.php");
$login=Login::GetLogin();
$msg=Message::GetMessage();
$sess = Session::GetSesstion();
$adminloginmsg = "";
if ($login->IsLogged())
{	
		header("Location: ../manager/adminpanel.php?item=dashboard&act=do&type=line");
}
else
{
	if (isset ($_POST["mark"]) AND $_POST["mark"] == "adminlogin")
	{
		if ($login->AdminLogin($_POST['username'],$_POST['password']))
		{		 
			header("location:adminpanel.php?item=dashboard&act=do");			
		}	
		else
		{ 
			$adminloginmsg = $msg->ShowError("نام کاربری یا کلمه عبور اشتباه می باشد !");
			//header("location: ./manager/adminlogin.php");
		}	
	}   

	$html=<<<cod
	<!DOCTYPE HTML>
	<html lang="fa">       
	<head>
	<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=IE8">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
	<title>بخش مديريت سايت</title>		
	<link rel="stylesheet" type="text/css" href="../themes/css/1styles.css"></link>   
	<link rel="stylesheet" type="text/css" href="./adminlogin.css"></link>	
	</head>
	<body>
	<div class="container">
		<div class="logo"><img src="./images/logo2.png" alt="mediateq"></div>
		<div class="login-content">
			<form action="" method="post">
					<fieldset>
							<legend>Log in</legend>			
							<label for="user">نام کاربری :</label>
							<input type="text" id="user" class="text ltr" name="username"/>
							<label for="password">رمز عبور :</label>
							<input type="password" id="password" class="text ltr" name="password"/>
							<input type="submit"  class="button" name="login" value="ورود"/>
							<input type="hidden" name="mark" value="adminlogin" />    
					</fieldset>
			</form>
			<div class="badboy"></div>
			<div class="mes">
				{$adminloginmsg}
			</div>
		</div>
	</div>
	<div class="top-login"></div>
	<div class="top-login2"></div>
	</body>
	</html>
cod;
	echo $html; 
}	
?>