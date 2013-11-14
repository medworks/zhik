<?php
    include_once("./config.php");
	include_once("./lib/persiandate.php");
	include_once("./classes/database.php");	
	include_once("./classes/seo.php");	
	$db = Database::GetDatabase();
	$seo = Seo::GetSeo();
 	$work = $db->Select('works',NULL,"id={$_GET[wid]}");
	$works = $db->SelectAll("workpics","*","wid={$_GET[wid]}");
	// $sdate = ToJalali($work["sdate"]," l d F  Y ");
	// $fdate = ToJalali($work["fdate"]," l d F  Y ");		
	$catname = GetCategoryName($work["catid"]);
	$catg = $db->Select('category',NULL,"id={$work[catid]}");
	$secname = GetSectionName($catg["secid"]);
	$related = $db->SelectAll('works',"*","catid={$work[catid]} AND id<>{$_GET[wid]}",null,"0","4");
	$seo->Site_Title = $work["subject"];
	$seo->Site_Describtion = strip_tags(mb_substr($work["body"],0,150,"UTF-8"));
	
$html=<<<cd
    <div id="header-image-container">
        <div id="header-image">
            <img src="themes/images/portfolio-header.jpg" alt="Project page" class="stretch-image">
        </div>
    </div>
    <div id="content-container" class="content-width">
        <!-- Breadcrumbs -->
        <div class="row">
            <div id="breadcrumbs-wrapper" class="large-12 columns for-nested">
                <span>مسیر شما:</span>
                <ul class="breadcrumbs">
                    <li class="current">
                        <a>{$work["subject"]}</a>
                    </li>
                    <li>
                        <a href="works.html">پروژه ها</a>
                    </li>
                    <li>
                        <a href="./">صفحه اصلی</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Page Intro -->
        <div id="intro" class="not-homepage row">
            <div class="large-9 large-centered columns">
                <h1>{$work["subject"]}</h1>
            </div>
        </div>
        <!-- Portfolio Info -->
        <div class="row">
            <div class="large-12 columns no-padding">
                <div id="portfolio-item-images">
cd;
foreach($works as $key=>$val)
{
$post = $db->Select('works',NULL,"id={$val[wid]}");
$html.=<<<cd
                    <div>
                        <a href="{$val[image]}" class="image-box" title="{$post[subject]}" rel="portfolio-image-group">
						<img src="{$val[image]}" alt="{$post[subject]}"></a>
                    </div>
cd;
}
$html.=<<<cd
                </div>
                <div id="portfolio-item-images-controller">
                    <a href="#" id="portfolio-item-images-prev"><i class="icon-angle-left"></i></a>
                    <a href="#" id="portfolio-item-images-next"><i class="icon-angle-right"></i></a>
                </div>
            </div>
        </div>
        <div id="portfolio-item-info-wrapper" class="row">
            <div id="portfolio-item-info" class="large-3 columns no-padding">
                <ul id="portfolio-item-meta">
                    <!-- <li>
                        <strong>تاریخ</strong><i class="icon-calendar"></i>
                        <p>
                            {$fdate}
                        </p>
                    </li> -->
                    <li>
                        <strong>پلان</strong><i class=" icon-pencil"></i>
                        <p>
                            <a href="{$work[plan]}" target="_blank">
                                پلان ها
                            </a>
                        </p>
                    </li>
					<li>
                        <strong>جدول قیمت</strong><i class="icon-money"></i>
                        <p>
                            <a href="{$work[pricetable]}" target="_blank">
                                قیمت ها
                            </a>
                        </p>
                    </li>
                    <li>
                        <strong>گروه</strong><i class="icon-tags"></i>
                        <ul id="portfolio-item-categories">
                            <li>
                                <a>{$catname}</a>
                            </li>
                            <li>
                                <a>{$secname}</a>
                            </li>                           
                        </ul>
                    </li>                    
                </ul>
            </div>
            <div class="large-9 columns">
                <p>
                   {$work["body"]}
                </p>
            </div>
        </div>
cd;
        if($related!=null){
$html.=<<<cd
		<!-- Related Items -->
        <div class="row top-margin">
            <div class="large-12 columns bottom-line">
                <h3 class="no-margin">پروژه های مرتبط</h3>
            </div>
        </div>
		<div class="row">
            <div class="large-12 columns for-nested portfolio-wrapper">		
cd;
        }
foreach($related as $key=>$val)
{
$html.=<<<cd
    <div class="portfolio-item">
        <div class="portfolio-item-hover">
            <h3><a href="work-fullpage{$val[id]}.html">{$val["subject"]}</a></h3>
            <ul>
                <li>
                    <a href="work-fullpage{$val[id]}.html">مشخصات</a>
                </li>
                <!-- <li>
                    <a href="work-fullpage{$val[id]}.html">عکس ها</a>
                </li> -->
            </ul>
        </div>
        <img src="{$val[image]}" alt="{$val[subject]}" class="stretch-image">
    </div>
cd;
}
$html.=<<<cd

            </div>
        </div>
    </div>
cd;
    return $html;
?>