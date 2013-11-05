<?php
	include_once("config.php");
    include_once("classes/database.php"); 
	include_once("classes/functions.php");
	include_once("lib/RSS2Writer.php");
		
	$db = Database::GetDatabase();
	$news = $db->SelectAll("news","*",NULL,"ndate DESC");
	$Site_Title=GetSettingValue("Site_Title",1);
	$Site_Describtion=GetSettingValue("Site_Describtion",1);
	$Admin_Email=GetSettingValue("Admin_Email",1);
	$now = date("D, d M Y H:i:s T");
	$site = "http://www.mediateq.ir";
	$uri = "?item=fullnews&act=do&wid=";
	
	$rss2_writer = new RSS2Writer(
									$Site_Title, 
									$Site_Describtion, 
									'www.mediateq.ir', 
									6, //indent
									false //use CDATA
		                          );
	foreach ($news as $row)
	{		 
		//$rss2_writer->addCategory();		
		$date = $row['ndate'];
		$strdate = explode("-", $date);
		$strtime = explode(":", $date);
		$strtime[0] = substr($strtime[0],11,2);
		$strtime = $strtime[0].":".$strtime[1].":".$strtime[2];
		$date = mktime(0,0,0,$strdate[1],$strdate[2],$strdate[0]); 
		$convert = date("D, j M Y", $date);
		$date = $convert .' '. $strtime.'  GMT';
		$rss2_writer->addElement('pubDate', $date);
		$rss2_writer->addItem($row['subject'],$row['body'],$site."/".$uri.$row['id']);
	}
	//header("Content-Type: application/rss+xml");
	header("Content-type: text/xml");
	echo $rss2_writer->getXML();
?>