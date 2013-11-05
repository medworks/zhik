<?php
	include_once("./config.php");
 	include_once("./classes/functions.php");
 	include_once("./classes/database.php");
	$db = database::GetDatabase();
	$pageNo = ($_GET["pid"]) ? $_GET["pid"] : 1;
	$maxItemsInPage = GetSettingValue('Max_Post_Number',0);
	$from = ($pageNo - 1) * $maxItemsInPage;
	$count = $maxItemsInPage;
	$gallery = $db->SelectAll("gallery","*",null," id DESC",$from,$count);
    $itemsCount = $db->CountAll("gallery");

$html=<<<cd
	<div class="gallery-page">
		<div class="page-header" id="others-page">
			<h1>گالری تصاویر</h1>
			<div class="badboy"></div>
		</div>
		<div class="badboy"></div>
		<div class="gallery" id="special-page">
			<ul>
cd;
				for($i=0 ; $i<count($gallery) ; $i++){
					// $body= $gallery[$i]['body'];
					// $body= strip_tags($body);
   					// $body= (mb_strlen($body)>250) ? mb_substr($body,0,250,"UTF-8")."..." : $body;
$html.=<<<cd
					<li>
						<div class="overlay">
							<a href="{$gallery[$i][image]}" rel="prettyphoto[gallery3]">
								<img src="{$gallery[$i][image]}" alt="{$gallery[$i][subject]}" />
							</a>
						</div>
						<div class="detail">
							<h3><a href="{$gallery[$i][image]}" rel="prettyphoto[gallery4] title="{$gallery[$i][subject]}">{$gallery[$i][subject]}</a></h3>
							<!-- <p class="text">{$body}</p> -->
						</div>
					</li>
cd;
				
				if(($i+1) % 3 == 0 || $i == (count($gallery)-1))
$html.=<<<cd
					<span class="line"></span>
cd;
				}
$html.=<<<cd
			</ul>
			<div class="badboy"></div>
		</div>
cd;
		$linkFormat = '?item=gallery&pid=%PN%';
		$maxPageNumberAtTime = GetSettingValue('Max_Page_Number',0);
		$pageNos = Pagination($itemsCount, $maxItemsInPage, $pageNo, $maxPageNumberAtTime, $linkFormat);

$html.=<<<cd
		$pageNos
	</div>
cd;
return $html;
?>