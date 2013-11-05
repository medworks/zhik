<?php	
	include_once("../config.php");	
    include_once("../classes/database.php");
	include_once("../classes/session.php");	
    include_once("../classes/security.php");	
    include_once("../classes/login.php");	
	$login = Login::GetLogin();
	if (!$login->IsLogged())
	{
		header("Location: ../index.php");
		die(); // solve a security bug
	}
    $pics = "";
	$dir = "";	
	if ($_GET['item']=="newsmgr")
	{	   
		$dir='../newspics';
	}	
	else
	if ($_GET['item']=="worksmgr")
	{	 
		$dir='../workspics';
	}
	else
	if ($_GET['item']=="slidesmgr")
	{	 
		$dir='../slidespics';
	}
	else
	if ($_GET['item']=="gallerymgr")
	{	 
		$dir='../gallerypics';
	}
	else
	if ($_GET['item']=="usermgr")
	{	 
		$dir='../userspics';
	}		
   
$html=<<<cd
<script type='text/javascript'>
	$(document).ready(function(){		  	 
		$("#tab1").click(function(){	
			$.get('ajaxcommand.php?cmd=file&item=newspics', function(data) {
						$('#catab1 ul').html(data);
				});			
			return false;
		});		
		$("#tab2").click(function(){
		$.get('ajaxcommand.php?cmd=file&item=workspics', function(data) {
						$('#catab2 ul').html(data);
				});			
			return false;
		});
		$("#tab3").click(function(){
		$.get('ajaxcommand.php?cmd=file&item=slidespics', function(data) {
						$('#catab3 ul').html(data);
				});			
			return false;
		});
		$("#tab4").click(function(){
		$.get('ajaxcommand.php?cmd=file&item=gallerypics', function(data) {
						$('#catab4 ul').html(data);
				});			
			return false;
		});
		$("#tab5").click(function(){
		$.get('ajaxcommand.php?cmd=file&item=userspics', function(data) {
						$('#catab5 ul').html(data);
				});			
			return false;
		});
		$("#tab1").click();
	});
</script>	   
	<div class="picmanager">
		<div class="prev right">
			<div class="pic">
				<img id="previmage" src="./images/imgprev.jpg" alt="">
			</div>
			<div class="detail">
				<h2><span class="highlight">نام فایل: </span><span id="namepreview">---</span></h2>
				<p><span class="highlight">پسوند: </span><span id="typepreview">---</span></p>
				<!-- <p><span class="highlight">سایز: </span><span id="sizepreview">---</span></p> -->
			</div>
			<a title="انتخاب عکس" class="button" id="select">انتخاب</a>
			<a title="خروج" class="button" id="exit">خروج</a>
		</div>
		<div class="files right">
			<div class="pics cat-box-content cat-box tab" id="cats-tabs-box">
				<div class="cat-tabs-header">
					<ul>
						<li id="tab1"><a href="#catab1">پوشه اخبار</a></li>
						<li id="tab2"><a href="#catab2">پوشه کارها</a></li>
						<li id="tab3"><a href="#catab3">پوشه اسلاید ها</a></li>
						<li id="tab4"><a href="#catab4">پوشه گالری</a></li>
						<li id="tab5"><a href="#catab5">پوشه کاربران</a></li>
					</ul>
				</div>
				<div class="cat-tabs-wrap" id="catab1">
					<ul>
						
					</ul>
					<div class="badboy"></div>
				</div>
				<div class="cat-tabs-wrap" id="catab2">
					<ul>
					
					</ul>
					<div class="badboy"></div>
				</div>
				<div class="cat-tabs-wrap" id="catab3">
					<ul>
						
					</ul>
					<div class="badboy"></div>
				</div>
				<div class="cat-tabs-wrap" id="catab4">
					<ul>
						
					</ul>
					<div class="badboy"></div>
				</div>
				<div class="cat-tabs-wrap" id="catab5">
					<ul>
						
					</ul>
					<div class="badboy"></div>
				</div>
				<div class="badboy"></div>
			</div>
		</div>
		<div class="badboy"></div>
	</div>
cd;
echo $html;
?>