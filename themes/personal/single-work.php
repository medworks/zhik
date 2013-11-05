<?php
	include_once("./classes/database.php");
  	include_once("./lib/persiandate.php");
	include_once("./classes/seo.php");
	$db = Database::GetDatabase();
	$seo = Seo::GetSeo();
	$works = $db->Select('works',NULL,"id={$_GET[wid]}"," sdate DESC");
	$sdate = ToJalali($works["sdate"]," l d F  Y ");
   	$fdate = ToJalali($works["fdate"]," l d F  Y ");
	$seo->Site_Title = $works["subject"];
$html=<<<cd
	<div class="singlework-page" id="others-page">
		<div class="page-header">
			<h1><span>کارهای ما / </span>{$works[subject]}</h1>
			<div class="badboy"></div>
		</div>
		<div class="badboy"></div>
		<div class="singlework" id="special-page">
			<div class="pic">
				<img src="{$works[image]}" alt="{$works[subject]}" />
			</div>
			<div class='detail'>
				<h2>{$works[subject]}</h2>
				<ul>
					<li><p class="sdate">{$sdate}</p></li>
					<li><p class="sep">|</p></li>
					<li><p class="fdate">{$fdate}</p></li>
				</ul>
				<div class="badboy"></div>
				<div class="text">{$works[body]}</div>
				<div class="badboy"></div>
cd;
				if($works['link']!=null){
$html.=<<<cd
					<div class="link"><a href="http://{$works[link]}" title="{$works[subject]}" target="_blank" class="btn">لینک سایت</a></div>
cd;
				}else{
$html.=<<<cd
					<div class="link"><a href="{$works[image]}" title="{$works[subject]}" rel="prettyphoto[gallery4]" class="btn">مشاهده عکس</a></div>
cd;
				}
$html.=<<<cd
			</div>
		</div>
	</div>
cd;
return $html;
?>