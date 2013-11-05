<?php	
	include_once("./config.php");
	include_once("./lib/persiandate.php");
	include_once("./classes/database.php");
	include_once("./classes/seo.php");
	$db = Database::GetDatabase();
	$seo = Seo::GetSeo();
 	$works = $db->Select('works',NULL,"id={$_GET[wid]}"," sdate DESC");
	$workstat = $db->SelectAll("workstat","*","workid = {$_GET[wid]}","id ASC");
	$sdate = ToJalali($works["sdate"]," l d F  Y ");
	$fdate = ToJalali($works["fdate"]," l d F  Y ");
	$body= $works['body'];
	$seo->Site_Title = $works["subject"];
	$seo->Site_Describtion = strip_tags(mb_substr($works["body"],0,150,"UTF-8"));
$html=<<<ht
	<div class="content single-page">
		<div class="title-menu">
			<menu>
				<li><a href="./">صفحه اصلی</a><span>/</span></li>
				<li><a href="works.html">کارهای ما</a><span>/</span></li>
				<li><p>{$works[subject]}</p></li>
			</menu>
		<div class="badboy"></div>
		</div>
	<div class="box-right singlepage-box">
		<div class="image">
			<img src='{$works[image]}' alt='{$works[subject]}'>
		</div>
		<div class="tit-da-de">
			<div class="title">
				<p>{$works[subject]}</p>
			</div>
			<div class="date">
				<p><span>تاریخ شروع: {$sdate} </span></p>
				<p><span>تاریخ پایان: {$fdate}</span></p>
			</div>
			<div class="detail">
				<div class="overview left">
					<ul>
ht;
foreach($workstat as $key=>$val)
{
	$html.="<li> <h5>{$val[subject]} - {$val[percent]}% </h5>";
	$html.="<span> <span style = 'width:{$val["percent"]}%'></span></span> </li>";
}
$html.=<<<ht
				
					</ul>
				</div>
					{$body}
				</div>
ht;
			if($works['link']!=null){
$html.=<<<ht
				<a href="http://{$works[link]}" title="{$works[subject]}" target="_blank" class="button">لینک سایت</a>
ht;
			}else{			
$html.=<<<ht
				<a href="{$works[image]}" title="{$works[subject]}" rel="prettyphoto[gallery4]" class="button">مشاهده تصویر</a>
ht;
			}
$html.=<<<ht
			<div class="badboy"></div>
		</div>
	</div>
</div>
ht;
return $html;
?>