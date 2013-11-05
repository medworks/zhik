<?php
    include_once("../config.php");
    include_once("../classes/functions.php");
  	include_once("../classes/messages.php");
  	include_once("../classes/session.php");	
  	include_once("../classes/security.php");
  	include_once("../classes/database.php");	
    include_once("../lib/persiandate.php");
  	include_once("../classes/login.php");
	$login = Login::GetLogin();	
	if (!$login->IsLogged())
	{
		header("Location: ../index.php");
		die(); //solve security bug
	}	
	$mes = Message::GetMessage();
	$sess = Session::GetSesstion();
	$name = $sess->Get("name").' '.$sess->Get("family");
	$user = $sess->Get("username");
    $pic = $sess->Get("userimg");
	$datetime = ToJalali(date('Y-M-d H:i:s'),'l، d F Y');
	if ($_GET["item"] == "logout")
   {
	   if ($login->LogOut())
			header("Location: ../index.php");
	   else
		    echo $mes->ShowError("عملیات خروج با خطا مواجه شد، لطفا مجددا سعی نمایید.");
   }
	if (isset($_GET['item']) and $_GET['item']!="logout")  
    	$reqpage = include_once GetPageName($_GET['item'],$_GET['act']);
?>
<!DOCTYPE HTML>
<html lang="fa">
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=IE8">
	<meta charset="UTF-8">
	<title> پانل مدیریت</title>
	<link rel="stylesheet" type="text/css" href="../themes/css/1styles.css" />
	<link rel="stylesheet" type="text/css" href="../themes/css/validationEngine.css"/>
	<link rel="stylesheet" type="text/css" href="./calendar-blue.css" />
	<link rel="stylesheet" type="text/css" href="./adminpanel.css" />

	<script type="text/javascript" src="../lib/js/jquery.js"></script>  
	<script type="text/javascript" src="../lib/js/jalali.js"></script>  
	<script type="text/javascript" src="../lib/js/calendar.js"></script>  
	<script type="text/javascript" src="../lib/js/calendar-setup.js"></script>  
	<script type="text/javascript" src="../lib/js/calendar-fa.js"></script>	
	<script type="text/javascript" src="../lib/js/jquery.validationEngine-en.js"></script>
	<script type="text/javascript" src="../lib/js/jquery.validationEngine.js"></script>	
  <script type="text/javascript" src="../lib/js/tiny/tinymce.min.js"></script>
	<script type="text/javascript" src="../lib/js/jsfuncs.js"></script>	

	<!--[if lt IE 9]>
		<script src="./lib/js/html5shiv.js"></script>
	<![endif]-->

<?php
  $path = realpath(dirname(__FILE__));  
?>	

</head>
<body>
<div class="container">
    <header>
      <a href="../" class="logo" title="Mediateq" target="_blank">Mediateq website</a>
      <div id="mini-nav">
        <ul class="hidden-phone">
          <li class="pic"><img src="<?php echo $pic; ?>" alt="<?php echo $name; ?>" /></li>       
          <li><a><?php echo "نام: <span class='highlight'>$name</span>"; ?></a></li>
          <li><a><?php echo "نام کاربری: <span class='highlight'>$user</span>"; ?></a></li>
          <li><a><?php echo "تاریخ: <span class='highlight'>$datetime</span>"; ?></a></li>
          <!-- <li><a href="#" >وظایف</a></li>
          <li><a href="#">ثبت نام ها <span id="newSignup">06</span></a></li> -->  
          <li class="exit"><a href="?item=logout&act=do">خروج</a></li>		  
        </ul>
        <div class="badboy"></div>
      </div>
    </header>
    <div class="badboy"> </div>
 
 <div id="right" class="admin_right_panel"> 
	  <div id="mainnav" class="main-menu">
        <ul>
          <li>
            <a href="?item=dashboard&act=do" class='dashboard'><p>پیشخوان</p></a>
          </li>
          <li>
            <a href="?item=catmgr&act=do" class="catmgr"><p>دسته بندی</p></a>
            <a href="?item=secmgr&act=do" class="trick"></a>
          </li>
          <li>
            <a href="?item=articlesmgr&act=do" id="articles" name="articles" class="articles"><p>مدیریت مقالات</p></a>
          </li>
          <li>
            <a href="?item=newsmgr&act=do" id="news" name="news" class="news"><p>مدیریت اخبار</p></a>
          </li>
          <li >            
            <a href="?item=worksmgr&act=do" id="works" name="works" class="works"><p>مدیریت کارها</p></a>
          </li>
          <li>
            <a href="?item=slidesmgr&act=do" class="slidemgr"><p>مدیریت اسلاید</p></a>
          </li>
          <li>
            <a href="?item=gallerymgr&act=do" class="gallerymgr"><p>گالری تصاویر</p></a>
          </li>
    		  <li>
            <a href="?item=blocksmgr&act=do" class="block"><p>مدیریت بلاک</p></a>
          </li>
    		  <li>
            <a href="?item=pluginmgr&act=do" class="plugin"><p>مدیریت پلاگین</p></a>
          </li>
		      <li >            
            <a href="?item=newslettermgr&act=do" id="newslettermgr" class="newslettermgr"><p>مدیریت خبرنامه</p></a>
          </li>
		  </li>
		      <li >            
            <a href="?item=pollmgr&act=do" id="pollmgr" class="pollmgr"><p>مدیریت نظرسنجی</p></a>
          </li>
    	    <li >            
            <a href="?item=usermgr&act=do" id="users" name="users" class="users"><p>مدیریت کاربران</p></a>
          </li>	
          <li >            
            <a href="?item=uploadmgr&act=do" id="users" name="users" class="upload"><p>مدیریت آپلود</p></a>
          </li>		  
          <li>
            <a href="?item=thememgr&act=do" class="template"><p>مدیریت قالب</p></a>
          </li>
  		    <li>
            <a href="?item=settingmgr&act=do" class="setting"><p>تنظیمات</p></a>
          </li>
        </ul>
    </div>
 
 </div> 
 <div id="container"  class="admin_container">
    <?php
      echo $reqpage;
    ?>    
 </div>

 <div class="badboy"></div>
 <footer>
  <div class="foot">
   <p>پانل مدیرت مدیا تک</p>
   <img src="./images/logo.png" alt="MEdiateq" />
  </div>
 </footer>
 </div>
</body>
</html>