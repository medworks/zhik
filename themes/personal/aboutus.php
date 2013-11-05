<?php
	include_once("./config.php");
 	include_once("./classes/functions.php");
 	include_once("./classes/database.php");
	$db = database::GetDatabase();
	$about = GetSettingValue('About_System',0);

$html=<<<cd
	<div class="aboutus-page">
		<div class="page-header" id="others-page">
			<h1>درباره ما</h1>
			<div class="badboy"></div>
		</div>
		<div class="badboy"></div>
		<div class="about" id="special-page">
			<div class="detail">{$about}</div>
			<div class="badboy"></div>
		</div>
	</div>
cd;
	
return $html;
?>