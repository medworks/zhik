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
	else
	if ($_GET['item']=="articlesmgr")
	{	 
		$dir='../articlepics';
	}
   
$html=<<<cd
<script type='text/javascript'>
	$(document).ready(function(){		  	 
		$("#tab12").click(function(){	
			$.get('ajaxcommand.php?cmd=file&item=planfiles', function(data) {
						$('#catab12 ul').html(data);
				});			
			return false;
		});		
		$("#tab13").click(function(){
		$.get('ajaxcommand.php?cmd=file&item=pricefiles', function(data) {
						$('#catab13 ul').html(data);
				});			
			return false;
		});
		
		$("#tab12").click();
	});
</script>	   
	<div class="picmanager">
		<div class="prev right">
			<div class="pic">
				<img id="priceprevimage" src="./images/imgprev.jpg" alt="">
			</div>
			<div class="detail">
				<h2><span class="highlight">نام فایل: </span><span id="pricenamepreview">---</span></h2>
				<p><span class="highlight">پسوند: </span><span id="pricetypepreview">---</span></p>
				<!-- <p><span class="highlight">سایز: </span><span id="pricesizepreview">---</span></p> -->
			</div>
			<a title="انتخاب عکس" class="button" id="selectpr">انتخاب</a>
			<a title="خروج" class="button" id="priceexit">خروج</a>
		</div>
		<div class="files right">
			<div class="pics cat-box-content cat-box tab" id="cats-tabs-box">
				<div class="cat-tabs-header">
					<ul>
						<li id="tab12"><a href="#catab12">پوشه پلان ها</a></li>
						<li id="tab13"><a href="#catab13">پوشه قیمت ها</a></li>	
					</ul>
				</div>
				<div class="cat-tabs-wrap" id="catab12">
					<ul>
						
					</ul>
					<div class="badboy"></div>
				</div>
				<div class="cat-tabs-wrap" id="catab13">
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