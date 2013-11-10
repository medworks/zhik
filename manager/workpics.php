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
	
   
$html=<<<cd
<script type='text/javascript'>
	$(document).ready(function(){		  	 		
		$("#tab1").click(function(){
		$.get('ajaxcommand.php?cmd=workpics', function(data) {
						$('#catab1 ul').html(data);
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
			<a title="انتخاب عکس" class="button" id="select">انتخاب</a>
			<a title="خروج" class="button" id="exit">خروج</a>
		</div>
		<div class="files right">
			<div class="pics cat-box-content cat-box tab" id="cats-tabs-box2">
				<div class="cat-tabs-header2">
					<ul>						
						<li id="tab1"><a href="#catab1">پوشه کارها</a></li>						
					</ul>
				</div>				
				<div class="cat-tabs-wrap2" id="catab1">
					<ul>
					
					</ul>
					<div class="badboy"></div>
				</div>				
		</div>
		<div class="badboy"></div>
	</div>
cd;
echo $html;
?>