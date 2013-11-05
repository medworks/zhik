<?php
	include_once("./config.php");
 	include_once("./classes/functions.php");
 	include_once("./classes/database.php");
  	include_once("./lib/persiandate.php");
	$db = database::GetDatabase();
	$pageNo = ($_GET["pid"]) ? $_GET["pid"] : 1;
	$maxItemsInPage = GetSettingValue('Max_Post_Number',0);
	$from = ($pageNo - 1) * $maxItemsInPage;
	$count = $maxItemsInPage;
	$works = $db->SelectAll("works","*",null," fdate DESC",$from,$count);
    $itemsCount = $db->CountAll("works");
$html=<<<cd
	<div class="works-page" id="others-page">
		<div class="page-header">
			<h1>کارهای ما</h1>
			<div class="badboy"></div>
		</div>
		<div class="works" id="special-page">
			<ul>
cd;
				for($i=0 ; $i<count($works) ; $i++){
					$body= $works[$i]['subject'];
					$body= strip_tags($body);
   					$body= (mb_strlen($body)>100) ? mb_substr($body,0,100,"UTF-8")."..." : $body;
   					$sdate = ToJalali($works[$i]["sdate"]," l d F  Y ");
   					$fdate = ToJalali($works[$i]["fdate"]," l d F  Y "); 
$html.=<<<cd
					<li>
						<div class="overlay">
							<a href="?item=fullworks&wid={$works[$i][id]}">
								<img src="{$works[$i][image]}" alt="{$works[$i][subject]}" />
							</a>
						</div>
						<div class="detail">
							<h3><a href="?item=fullworks&wid={$works[$i][id]}" title="{$works[$i][subject]}">{$works[$i][subject]}</a></h3>
							<ul>
								<li><p class="sdate">{$sdate}</p></li>
								<li><p class="sep">|</p></li>
								<li><p class="fdate">{$fdate}</p></li>
							</ul>
							<div class="badboy"></div>
							<p class="text">{$body}</p>
						</div>
					</li>
cd;
					if(($i+1) % 3 == 0 || $i == (count($works)-1))
$html.=<<<cd
					<span class="line"></span>
cd;
				}
$html.=<<<cd
			</ul>
			<div class="badboy"></div>
		</div>
cd;
		$linkFormat = '?item=works&pid=%PN%';
		$maxPageNumberAtTime = GetSettingValue('Max_Page_Number',0);
		$pageNos = Pagination($itemsCount, $maxItemsInPage, $pageNo, $maxPageNumberAtTime, $linkFormat);

$html.=<<<cd
		$pageNos
	</div>
cd;
return $html;
?>