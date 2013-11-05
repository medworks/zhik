<?php	
	include_once("./config.php");
	include_once("./lib/persiandate.php");
	include_once("./classes/database.php");	
	include_once("./classes/seo.php");	
	$db = Database::GetDatabase();
	$seo = Seo::GetSeo();
 	$news = $db->Select('news',NULL,"id={$_GET[wid]}"," ndate DESC");
	$ndate = ToJalali($news["ndate"]," l d F  Y ");
	$news["userid"] = GetUserName($news["userid"]);
	$body = $news['body'];
	$seo->Site_Title = $news["subject"];
	$seo->Site_Describtion = strip_tags(mb_substr($news["body"],0,150,"UTF-8"));
	
	
$html=<<<ht
	<div class="content single-page">
	<div class="title-menu">
		<menu>
			<li><a href="./">صفحه اصلی</a><span>/</span></li>
			<li><a href="news.html">اخبار</a><span>/</span></li>
			<li><p>{$news[subject]}</p></li>
		</menu>
		<div class="badboy"></div>
	</div>
	<div class="box-right singlepage-box">
		<div class="image">
			<img src='{$news[image]}' alt='{$news[subject]}' />
		</div>
		<div class="tit-da-de">
			<div class="title">
				<p>{$news[subject]}</p>
			</div>
			<div class="date">
				<p><span>تاریخ ثبت: {$ndate} </span></p>
				<p><span>توسط: {$news[userid]}</span></p>
	        <p><span>منبع: {$news[resource]}</span></p>  
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