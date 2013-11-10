<?php
    include_once("./config.php");
	include_once("./lib/persiandate.php");
	include_once("./classes/database.php");	
	include_once("./classes/seo.php");	
	$db = Database::GetDatabase();
	$seo = Seo::GetSeo();
 	$works = $db->Select('works',NULL,"id={$_GET[wid]}");
	$sdate = ToJalali($works["sdate"]," l d F  Y ");
	$fdate = ToJalali($works["fdate"]," l d F  Y ");		
	$seo->Site_Title = $works["subject"];
	$seo->Site_Describtion = strip_tags(mb_substr($works["body"],0,150,"UTF-8"));
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
                        <a>{$works["subject"]}</a>
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
                <h1>{$works["subject"]}</h1>
            </div>
        </div>
        <!-- Portfolio Info -->
        <div class="row">
            <div class="large-12 columns no-padding">
                <div id="portfolio-item-images">
                    <div>
                        <a href="images/demo/portfolio/portfolio-single1.jpg" class="image-box" title="Natural Touch" rel="portfolio-image-group"><img src="themes/images/demo/portfolio/portfolio-single1.jpg" alt=""></a>
                    </div>
                    <div>
                        <a href="images/demo/portfolio/portfolio-single2.jpg" class="image-box" title="Beautiful Upscale Kitchen" rel="portfolio-image-group"><img src="themes/images/demo/portfolio/portfolio-single2.jpg" alt=""></a>
                    </div>
                    <div>
                        <a href="images/demo/portfolio/portfolio-single3.jpg" class="image-box" title="Vintage Style" rel="portfolio-image-group"><img src="themes/images/demo/portfolio/portfolio-single3.jpg" alt=""></a>
                    </div>
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
                        <strong>مشتری</strong><i class="icon-user"></i>
                        <p>
                            Smart Living Co., Ltd.
                        </p>
                    </li>
                    <li>
                        <strong>گروه</strong><i class="icon-tags"></i>
                        <ul id="portfolio-item-categories">
                            <li>
                                <a href="#">گروه</a>
                            </li>
                            <li>
                                <a href="#">سرگروه</a>
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
                   {$works["body"]}
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