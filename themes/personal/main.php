<?php
	ob_start();
	include_once("inc/menu.php");
	$page_content = ob_get_contents();
	ob_end_clean();
	include_once("inc/header.php");
	echo $page_content;
	include_once("inc/footer.php");
?>