<?php
include_once("./classes/database.php");
$db = Database::GetDatabase(); 
$About_System = GetSettingValue('About_System',0);
$html=<<<cd
    <div id="header-image-container">
        <div id="header-image">
            <img src="themes/images/about-header.jpg" alt="About us page" class="stretch-image">
        </div>
    </div>
    <div id="content-container" class="content-width">
            <!-- Breadcrumbs -->
            <div class="row">
                <div id="breadcrumbs-wrapper" class="large-12 columns for-nested">
                    <span>مسیر شما:</span>
                    <ul class="breadcrumbs">
                        <li class="current">
                            <a>درباره ما</a>
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
                    <h1>درباره <strong>ژیک</strong></h1>
                </div>
            </div>
            <!-- Page Content -->
            <div class="row white-bg">
                <div class="large-6 columns">				
                    <p>
                       {$About_System}
                    </p>					
                </div>
                <div class="large-6 columns no-padding">
                    <div class="image-slider-wrapper">
                        <div class="image-slider">
cd;
$works = $db->SelectAll("works","*",null,"ID DESC");
foreach($works as $key=>$val)	
{
$html.=<<<cd
                            <div class="image-slider-item height-510">
                                <img src="{$val[image]}" alt="{$val[subject]}" class="stretch-image" style="width:510px;height:510px;">
                            </div>
cd;
}
$html.=<<<cd
                        </div>
                        <div class="image-slider-controller">
                            <a href="#" class="image-slider-prev"><i class="icon-angle-left"></i></a>
                            <a href="#" class="image-slider-next"><i class="icon-angle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
			     
            <div class="row top-margin">
                <div class="large-12 columns">
                    <h2 class="has-line">کارهای ژیک</h2>
                    <div class="row">
cd;
$i=0;
foreach($works as $key=>$val)	
{
$i++;
if ($i == 5) break;
$html.=<<<cd
                        <div class="large-3 columns less-padding align-center">
                            <p>
                                <img src="{$val[image]}" alt="{$val[subject]}" style="width:215px;height:215px;">
                            </p>
                            <h3 class="light">{$val[subject]}</h3> 
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