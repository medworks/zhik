<?php
    include_once("./config.php");
	include_once("./lib/persiandate.php");
	include_once("./classes/database.php");	
	include_once("./classes/seo.php");	
	$db = Database::GetDatabase();
	$seo = Seo::GetSeo();
 	$work = $db->Select('works',NULL,"id={$_GET[wid]}");
	$works = $db->SelectAll("workpics","*","wid={$_GET[wid]}");
	$sdate = ToJalali($work["sdate"]," l d F  Y ");
	$fdate = ToJalali($work["fdate"]," l d F  Y ");		
	$catname = GetCategoryName($work["catid"]);
	$catg = $db->Select('category',NULL,"id={$work[catid]}");
	$secname = GetSectionName($catg["secid"]);
	$seo->Site_Title = $work["subject"];
	$seo->Site_Describtion = strip_tags(mb_substr($work["body"],0,150,"UTF-8"));
$html=<<<cd
    <div id="header-image-container">
        <div id="header-image">
            <img src="themes/images/demo/portfolio/portfolio-header.jpg" alt="" class="stretch-image">
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
                    <li>
                        <strong>تاریخ</strong><i class="icon-calendar"></i>
                        <p>
                            {$fdate}
                        </p>
                    </li>
                    <li>
                        <strong>پلان</strong><i class=""></i>
                        <p>
                            Smart Living Co., Ltd.
                        </p>
                    </li>
					<li>
                        <strong>جدول قیمت</strong><i class=""></i>
                        <p>
                            Smart Living Co., Ltd.
                        </p>
                    </li>
                    <li>
                        <strong>گروه</strong><i class="icon-tags"></i>
                        <ul id="portfolio-item-categories">
                            <li>
                                <a href="#">{$catname}</a>
                            </li>
                            <li>
                                <a href="#">{$secname}</a>
                            </li>                           
                        </ul>
                    </li>
                    <!-- <li>
                        <strong>وب سایت</strong><i class="icon-globe"></i>
                        <p>
                            <a href="#">www.smart-living.com</a>
                        </p>
                    </li> -->
                </ul>
            </div>
            <div class="large-9 columns">
                <p>
                   {$work["body"]}
                </p>
            </div>
        </div>
        <!-- Related Items -->
        <div class="row top-margin">
            <div class="large-12 columns bottom-line">
                <h3 class="no-margin">Related Projects</h3>
            </div>
        </div>
        <div class="row">
            <div class="large-12 columns for-nested portfolio-wrapper">
                <div class="portfolio-item">
                    <div class="portfolio-item-hover">
                        <h3><a href="#">برج پزشکی ژیک</a></h3>
                        <ul>
                            <li>
                                <a href="#">مشخصات</a>
                            </li>
                            <li>
                                <a href="#">عکس ها</a>
                            </li>
                        </ul>
                    </div>
                    <img src="themes/images/demo/portfolio/project-thumb3.jpg" alt="" class="stretch-image">
                </div>
                <div class="portfolio-item">
                    <div class="portfolio-item-hover">
                        <h3><a href="#">برج پزشکی ژیک</a></h3>
                        <ul>
                            <li>
                                <a href="#">مشخصات</a>
                            </li>
                            <li>
                                <a href="#">عکس ها</a>
                            </li>
                        </ul>
                    </div>
                    <img src="themes/images/demo/portfolio/project-thumb4.jpg" alt="" class="stretch-image">
                </div>
                <div class="portfolio-item">
                    <div class="portfolio-item-hover">
                        <h3><a href="#">برج پزشکی ژیک</a></h3>
                        <ul>
                            <li>
                                <a href="#">مشخصات</a>
                            </li>
                            <li>
                                <a href="#">عکس ها</a>
                            </li>
                        </ul>
                    </div>
                    <img src="themes/images/demo/portfolio/project-thumb5.jpg" alt="" class="stretch-image">
                </div>
                <div class="portfolio-item">
                    <div class="portfolio-item-hover">
                        <h3><a href="#">برج پزشکی ژیک</a></h3>
                        <ul>
                            <li>
                                <a href="#">مشخصات</a>
                            </li>
                            <li>
                                <a href="#">عکس ها</a>
                            </li>
                        </ul>
                    </div>
                    <img src="themes/images/demo/portfolio/project-thumb9.jpg" alt="" class="stretch-image">
                </div>

            </div>
        </div>
    </div>
cd;
    return $html;
?>