<?php
    include_once("./config.php");
    include_once("./classes/database.php");	
	include_once("./classes/functions.php");
	
	$db = Database::GetDatabase();
	header("Content-Type: application/xml; charset=utf-8");
    $sm = '<?xml version="1.0" encoding="UTF-8"?>
    <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
    
	$news = $db->SelectAll("news","*",null,"id ASC");
	$works = $db->SelectAll("works","*",null,"id ASC");
	$articles = $db->SelectAll("articles","*",null,"id ASC");	
	$add ="http://www.mediateq.ir/" ;

	$sm .="
	<url>
	  <loc>http://www.mediateq.ir/</loc>
	</url>
	<url>
	  <loc>http://www.mediateq.ir/search.html</loc>
	</url>
	<url>
	  <loc>http://www.mediateq.ir/about-us.html</loc>
	</url>
	<url>
	  <loc>http://www.mediateq.ir/works.html</loc>
	</url>
	<url>
	  <loc>http://www.mediateq.ir/news.html</loc>
	</url>
	<url>
	  <loc>http://www.mediateq.ir/articles.html</loc>
	</url>
	<url>
	  <loc>http://www.mediateq.ir/contact.html</loc>
	</url>
	<url>
	  <loc>http://www.mediateq.ir/gallery.html</loc>
	</url>
";
	$date = date("Y-m-d");	

	foreach($news as $key=>$val)
	{
		//$date = date("Y-m-dTH:i:s+00:00",$val['ndate']);
		//$date = date("D, d M Y H:i:s T");
		$sm.=<<<cd
		<url>
			<loc>{$add}news-fullpage{$val["id"]}.html</loc>
			<lastmod>{$date}</lastmod>
			<changefreq>daily</changefreq>
			<priority>0.8</priority>
        </url>    		
cd;
	}
	foreach($works as $key=>$val)
	{
	   //$date = date("D, d M Y H:i:s T",$val['sdate']);
	   //$date = date("D, d M Y H:i:s T");
		$sm.=<<<cd
		<url>
			<loc>{$add}works-fullpage{$val["id"]}.html</loc>
			<lastmod>{$date}</lastmod>
			<changefreq>daily</changefreq>
			<priority>0.8</priority>
        </url>    		
cd;
	}
	foreach($articles as $key=>$val)
	{
		//$date = date("D, d M Y H:i:s T",$val['ndate']);
		//$date = date("D, d M Y H:i:s T");
		$sm.=<<<cd
		<url>
			<loc>{$add}articles-fullpage{$val["id"]}.html</loc>
			<lastmod>{$date}</lastmod>
			<changefreq>daily</changefreq>
			<priority>0.8</priority>
        </url>    		
cd;
	}		
    $sm.= "</urlset>";
	echo $sm;