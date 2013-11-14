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
            </div>
        </div>
        <!-- Portfolio -->
        <div class="row transparent">
            <div class="large-12 columns no-padding">                   
                <div class="portfolio-wrapper transparent">
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
                                    <a href="work-fullpage{$val[id]}.html">عکسها</a>
                                </li>
                                <li>
                                    <a href="work-fullpage{$val[id]}.html">مشخصات</a>
                                </li>
                            </ul>
                        </div>
                        <img src="{$val[image]}" alt="{$val[subject]}" class="stretch-image" style="width:255px; height:255px">
                    </div>
cd;
}
$html.=<<<cd
                </div>
            </div>
        </div>        
    </div>
cd;
    return $html;
?>