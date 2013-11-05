<?php	
	include_once("./config.php");
	include_once("./lib/persiandate.php");
	include_once("./classes/database.php");	
	include_once("./classes/seo.php");	
	$db = Database::GetDatabase();
	$seo = Seo::GetSeo();
 	$articles = $db->Select('articles',NULL,"id={$_GET[wid]}"," ndate DESC");
	$ndate = ToJalali($articles["ndate"]," l d F  Y ");
	$articles["userid"] = GetUserName($articles["userid"]);
	$body = $articles['body'];
	$seo->Site_Title = $articles["subject"];
	$seo->Site_Describtion = strip_tags(mb_substr($articles["body"],0,150,"UTF-8"));
	
	
$html=<<<ht
	<div class="content single-page">
	<div class="title-menu">
		<menu>
			<li><a href="./">صفحه اصلی</a><span>/</span></li>
			<li><a href="articles.html">مطالب مفید</a><span>/</span></li>
			<li><p>{$articles[subject]}</p></li>
		</menu>
		<div class="badboy"></div>
	</div>
	<div class="box-right singlepage-box">
		<div class="tit-da-de">
			<div class="title">
				<p>{$articles[subject]}</p>
			</div>
			<div class="date">
				<p><span>تاریخ ثبت: {$ndate} </span></p>
				<p><span>توسط: {$articles[userid]}</span></p>
	        <p><span>منبع: {$articles[resource]}</span></p>  
			</div>
			<div class="detail">
				{$body}
			</div>
		</div>
	</div>
</div>
ht;
return $html;	
?>