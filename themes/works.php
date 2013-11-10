<?php
  include_once("./classes/database.php");
  include_once("./lib/persiandate.php");
  $db = Database::GetDatabase();   
  $works = $db->SelectAll("works","*",null,"fdate DESC");
  foreach($works as $key=>$val) $cats[] = $val["catid"];    
   $uniqcats = array_unique($cats);
  
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
                            <a>پروژه ها</a>
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
                <h1>پروژه های <strong>ژیک</strong></h1>
                <!-- <p>
                    Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Sed ut perspiciatis unde omnis iste natus error sit voluptatem.
                </p> -->
            </div>
        </div>
        <!-- Portfolio -->
        <div class="row">
            <div class="large-12 columns no-padding">                   
                <div class="portfolio-wrapper">
                    <div class="portfolio-item fixed-box">
                        <h2 class="smaller">انتخاب گروه:</h2>
                        <p>
                            لطفا یکی از گروه های زیر را انتخاب نمایید تا موارد انتخابی نمایش داده شود
                        </p>
                        <p></p>
						  <form id="portfolio-filter-wrapper" class="custom">
                                <select id="portfolio-filter" class="medium">
                                    <option selected="selected" value="*">همه گروه ها</option>
cd;
 foreach($uniqcats as $key=>$val)
 {
	$catname = GetCategoryName($val);
$html.=<<<cd
             <option value=".{$val}">{$catname}</option>
cd;
 }
$html.=<<<cd
                                </select>
                            </form>
                        <p></p>
                    </div>   
cd;
foreach($works as $key=>$val)
{
$html.=<<<cd
                    <div class="{$val[catid]} mockup portfolio-item">
                        <div class="portfolio-item-hover">
                            <h3><a href="work-fullpage{$val[id]}.html">{$val["subject"]}</a></h3>
                            <ul>
                                <li>
                                    <a href="#">عکسها</a>
                                </li>
                                <li>
                                    <a href="#">مشخصات</a>
                                </li>
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
        <!-- <div class="row top-margin">
            <div class="large-12 columns bottom-line">
                <h2 class="smaller no-margin">Feedbacks From Our Customers</h2>
            </div>
        </div> -->
        <!-- Testimonial Slider -->
        <!-- <div class="row no-bg">
            <div class="large-12 columns height-255 no-padding">   
                <div class="testimonial-wrapper">
                    <div class="testimonial-inner">
                        <div class="testimonial-list">
                            <div>
                                <blockquote>
                                    <p>
                                        Nunc feugiat mi a tellus at consequat. Proinquam. Etiam ultrices. Suspendisse in justo sit etiam magna luctus suscipit.
                                    </p>
                                    <cite> Richard Jones, Arch Era Magazine </cite>
                                </blockquote>
                                <img src="themes/images/demo/test1.jpg" alt="">
                            </div>
                            <div>
                                <blockquote>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit!
                                    </p>
                                    <cite> Balmer Family, New York </cite>
                                </blockquote>
                                <img src="themes/images/demo/test3.jpg" alt="">
                            </div>
                            <div>
                                <blockquote>
                                    <p class="smaller">
                                        Curabitur sodales ligula in libero. Curabitur tortor. Pellentesque nibh. Aenean quam. In scelerisque sem at dolor. Maecenas mattis. Sed convallis tristique sem. Proin ut ligula vel nunc egestas porttitor.
                                    </p>
                                    <cite> Steve Woodman, Agency </cite>
                                </blockquote>
                                <img src="themes/images/demo/test2.jpg" alt="">
                            </div>
                        </div>
                        <div class="testimonial-angle"></div>
                        <div class="testimonial-corner"></div>
                        <div class="testimonial-corner-mirror"></div>
                    </div>
                    <div class="testimonial-bullets"></div>
                </div>                  
            </div>
        </div> -->
    </div>
cd;
    return $html;
?>