<?php
    include_once("config.php");
    include_once("classes/functions.php");
    /* include_once("classes/seo.php");
    $seo = Seo::GetSeo();  */	
    if (GetPageName($_GET['item'],$_GET['act'])){
        echo include_once GetPageName($_GET['item'],$_GET['act']);
    }else{
        include_once("./classes/database.php");
        include_once("./lib/persiandate.php");
        $db = Database::GetDatabase();
		$WellCome_Title = GetSettingValue('WellCome_Title',0);
	    $WellCome_Body = GetSettingValue('WellCome_Body',0);
		$articles = $db->SelectAll("articles","*",null,"ndate DESC","0","3");
		$articles[0]["body"] =(mb_strlen($articles[0]["body"])>400)?
                mb_substr(html_entity_decode(strip_tags($articles[0]["body"]), ENT_QUOTES, "UTF-8"), 0, 400,"UTF-8") . "..." :
                html_entity_decode(strip_tags($articles[0]["body"]), ENT_QUOTES, "UTF-8");
		$articles[1]["body"] =(mb_strlen($articles[1]["body"])>50)?
                mb_substr(html_entity_decode(strip_tags($articles[1]["body"]), ENT_QUOTES, "UTF-8"), 0, 50,"UTF-8") . "..." :
                html_entity_decode(strip_tags($articles[1]["body"]), ENT_QUOTES, "UTF-8");
       
        $articles[2]["body"] =(mb_strlen($articles[2]["body"])>50)?
                mb_substr(html_entity_decode(strip_tags($articles[2]["body"]), ENT_QUOTES, "UTF-8"), 0, 50,"UTF-8") . "..." :
                html_entity_decode(strip_tags($articles[2]["body"]), ENT_QUOTES, "UTF-8");
		$works = $db->SelectAll("works","*",null,"fdate DESC","0","6");
        $news = $db->SelectAll("news","*",null,"ndate DESC","0","3");
        $news[0]["body"] =(mb_strlen($articles[0]["body"])>150)?
                mb_substr(html_entity_decode(strip_tags($news[0]["body"]), ENT_QUOTES, "UTF-8"), 0, 150,"UTF-8") . "..." :
                html_entity_decode(strip_tags($news[0]["body"]), ENT_QUOTES, "UTF-8");		
		$news[1]["body"] =(mb_strlen($news[1]["body"])>60)?
                mb_substr(html_entity_decode(strip_tags($news[1]["body"]), ENT_QUOTES, "UTF-8"), 0, 60,"UTF-8") . "..." :
                html_entity_decode(strip_tags($news[1]["body"]), ENT_QUOTES, "UTF-8");
        $news[2]["body"] =(mb_strlen($news[2]["body"])>60)?
                mb_substr(html_entity_decode(strip_tags($news[2]["body"]), ENT_QUOTES, "UTF-8"), 0, 60,"UTF-8") . "..." :
                html_entity_decode(strip_tags($news[2]["body"]), ENT_QUOTES, "UTF-8");				
		$news[0]["ndate"] = ToJalali($news[0]["ndate"]," l d F  Y");
		$news[1]["ndate"] = ToJalali($news[1]["ndate"]," l d F  Y");
		$news[2]["ndate"] = ToJalali($news[2]["ndate"]," l d F  Y");

$html=<<<cd
<!-- Home Slider Container -->
<div id="home-slider-container">

    <div id="home-slider">
        <div class="home-slider-item">
            <img src="themes/images/demo/slider/slide1.jpg" alt="Slide 1">
            <div class="slider-caption">
                <h2>برج پزشکی ژیک.</h2>
                <p>
                    برج پزشکی ژیک در موقعیتی ممتاز در همجواری بیمارستان مهر می باشد.
                </p>
            </div>
        </div>
        <div class="home-slider-item">
            <img src="themes/images/demo/slider/slide3.jpg" alt="Slide 2">
            <div class="slider-caption">
                <h2>برج پزشکی ژیک.</h2>
                <p>
                    برج پزشکی ژیک در موقعیتی ممتاز در همجواری بیمارستان مهر می باشد.
                </p>
            </div>
        </div>
        <div class="home-slider-item">
            <img src="themes/images/demo/slider/slide3-new2.jpg" alt="Slide 3">
            <div class="slider-caption">
                <h2>برج پزشکی ژیک.</h2>
                <p>
                    برج پزشکی ژیک در موقعیتی ممتاز در همجواری بیمارستان مهر می باشد.
                </p>
            </div>
        </div>
    </div>
    <div id="slider-controller" class="content-width">
        <a href="#" id="slider-prev"><i class="icon-angle-left"></i></a>
        <a href="#" id="slider-next"><i class="icon-angle-right"></i></a>
    </div>
    <div id="header-image-shadow" class="content-width"></div>
</div>
<!-- End id="home-slider-container" -->
<div id="content-container" class="content-width">
    <!-- Page Intro -->
    <div id="intro" class="row">
        <div class="large-12 columns">
            <h1>{$WellCome_Title}</h1>
            <div id="intro-line">
                <hr class="stick">
                <hr>
            </div>
            <p>
                {$WellCome_Body}
            </p>
        </div>
    </div>
    <!-- Portfolio -->
    <div class="row">
        <div class="large-12 columns no-padding">

            <div class="portfolio-wrapper">

                <div class="fixed-box portfolio-item bottom-line">
                    <h2 class="smaller">پروژه های ما.</h2>
                    <p>
                        توضیحات کلی در مورد پروژه ها... توضیحات کلی در مورد پروژه ها... توضیحات کلی در مورد پروژه ها... توضیحات کلی در مورد پروژه ها... توضیحات کلی در مورد پروژه ها... توضیحات کلی در مورد پروژه ها... 
                    </p>
                    <a href="portfolio-list.php" class="bottom-right angle flat button">نمایش همه پروژه ها<span class="angle"><i class="icon-angle-left"></i></span></a>
                </div>

                <div class="kitchen mockup portfolio-item">
                    <div class="portfolio-item-hover">
                        <h3><a href='work-fullpage{$works[0][id]}.html'>{$works[0][subject]}</a></h3>
                        <ul>
                            <li>
                                <a href="#">عکسها</a>
                            </li>
                            <li>
                                <a href="work-fullpage{$works[0][id]}.html">مشخصات</a>
                            </li>
                        </ul>
                    </div>					
                    <img src="{$works[0][image]}" alt="{$works[0][subject]}" class="stretch-image" style="width:255px;height:255px;">
                </div>
                <div class="furniture interior portfolio-item">
                    <div class="portfolio-item-hover">
                        <h3><a href='work-fullpage{$works[1][id]}.html'>ب{$works[1][subject]}</a></h3>
                        <ul>
                            <li>
                                <a href="#">عکسها</a>
                            </li>
                            <li>
                                <a href="work-fullpage{$works[1][id]}.html">مشخصات</a>
                            </li>
                        </ul>
                    </div>
                    <img src="{$works[1][image]}" alt="{$works[1][subject]}" class="stretch-image" style="width:255px;height:255px;">
                </div>

                <div class="room interior portfolio-item">
                    <div class="portfolio-item-hover">
                        <h3><a href='work-fullpage{$works[2][id]}.html'>{$works[2][subject]}</a></h3>
                        <ul>
                            <li>
                                <a href="#">عکسها</a>
                            </li>
                            <li>
                                <a href="work-fullpage{$works[2][id]}.html">مشخصات</a>
                            </li>
                        </ul>
                    </div>
                   <img src="{$works[2][image]}" alt="{$works[2][subject]}" class="stretch-image" style="width:255px;height:255px;">
                </div>
                <div class="interior mockup room portfolio-item">
                    <div class="portfolio-item-hover">
                        <h3><a href='work-fullpage{$works[3][id]}.html'>{$works[3][subject]}</a></h3>
                        <ul>
                            <li>
                                <a href="#">عکسها</a>
                            </li>
                            <li>
                                <a href="work-fullpage{$works[3][id]}.html">مشخصات</a>
                            </li>
                            <!-- <li>
                                <a href="#">Room</a>
                            </li> -->
                        </ul>
                    </div>
                    <img src="{$works[3][image]}" alt="{$works[3][subject]}" class="stretch-image" style="width:255px;height:255px;">
                </div>
                <div class="interior mockup furniture portfolio-item">
                    <div class="portfolio-item-hover">
                        <h3><a href='work-fullpage{$works[4][id]}.html'>{$works[4][subject]}</a></h3>
                        <ul>
                            <li>
                                <a href="#">عکسها</a>
                            </li>
                            <li>
                                <a href="work-fullpage{$works[4][id]}.html">مشخصات</a>
                            </li>
                            <!-- <li>
                                <a href="#">Mock-up</a>
                            </li> -->
                        </ul>
                    </div>
                    <img src="{$works[4][image]}" alt="{$works[4][subject]}" class="stretch-image" style="width:255px;height:255px;">
                </div>
                <div class="kitchen interior portfolio-item">
                    <div class="portfolio-item-hover">
                        <h3><a href='work-fullpage{$works[5][id]}.html'>{$works[5][subject]}</a></h3>
                        <ul>
                            <li>
                                <a href="#">عکسها</a>
                            </li>
                            <li>
                                <a href="work-fullpage{$works[5][id]}.html">مشخصات</a>
                            </li>
                        </ul>
                    </div>
                    <img src="{$works[5][image]}" alt="{$works[5][subject]}" class="stretch-image" style="width:255px;height:255px;">
                </div>                
            </div>                
        </div>
    </div>  
    <!-- Blog -->
    <div class="row top-margin">
        <div class="large-12 columns bottom-line">
            <h3 class="no-margin">آخرین اخبار...</h3>
            <a href="news.html" class="bottom-right angle flat button">نمایش اخبار<span class="angle"><i class="icon-angle-left"></i></span></a>
        </div>
    </div>
    <div class="row">
        <div class="blog-item no-border large-6 columns for-nested">
            <div class="right-border row">
                <div class="large-12 columns height-255">
                    <div class="blog-meta">
                        <span class="date">{$news[0]["ndate"]}</span>
                    </div>
                    <hr>
                    <h4 class="blog-title"><a href="news-fullpage{$news[0][id]}.html">{$news[0]["subject"]}</a></h4>
                    <p class="excerpt">
                        {$news[0]["body"]}
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="large-12 columns no-padding height-255">
				<a href="news-fullpage{$news[0][id]}.html" title="{$news[0][subject]}">
                    <img src="{$news[0][image]}" alt="{$news[0][subject]}" class="stretch-image" style="width:510px;height:255px;">
				</a>	
                </div>
            </div>
        </div>
        <div class="sub-blog-item large-3 columns for-nested">
            <div class="right-border row">
                <div class="large-12 columns height-255">
                    <div class="blog-meta">
                        <span class="date">{$news[1]["ndate"]}</span>
                    </div>
                    <hr>
                    <h4 class="sub-blog-title"><a href="news-fullpage{$news[1][id]}.html">{$news[1]["subject"]}</a></h4>
					 <p class="excerpt">
                        {$news[1]["body"]}
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="large-12 columns no-padding height-255">
				<a href="news-fullpage{$news[1][id]}.html" title="{$news[1][subject]}">
                    <img src="{$news[1][image]}" alt="{$news[1][subject]}" class="stretch-image" style="width:255px;height:255px;">
				</a>	
                </div>
            </div>
        </div>
        <div class="sub-blog-item large-3 columns for-nested">
            <div class="row">
                <div class="large-12 columns height-255">
                    <div class="blog-meta">
                        <span class="date">{$news[2]["ndate"]}</span>
                    </div>
                    <hr>
                    <h4 class="sub-blog-title"><a href="news-fullpage{$news[2][id]}.html">{$news[2]["subject"]}</a></h4>
					 <p class="excerpt">
                        {$news[2]["body"]}
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="large-12 columns no-padding height-255">
				<a href="news-fullpage{$news[2][id]}.html" title="{$news[2][subject]}">
                    <img src="{$news[2][image]}" alt="{$news[2][subject]}" class="stretch-image" style="width:255px;height:255px;">
				</a>	
                </div>
            </div>
        </div>
    </div>
    <!-- Features -->
    <div class="row top-margin">
        <div class="large-6 columns for-nested">
            <div class="row">
                <div class="large-6 columns height-510 no-padding">
                <a href="article-fullpage{$articles[0][id]}.html" title="{$articles[0][subject]}">
                    <img src="{$articles[0][image]}" alt="{$articles[0][subject]}" class="stretch-image" style="width:255px;height:510px;">
                </a>    
                </div>
                <div class="large-6 columns height-510 bottom-line">
                <a href="article-fullpage{$articles[0][id]}.html" title="{$articles[0][subject]}">
                    <h2 class="smaller">{$articles[0]["subject"]}</h2>
                </a>    
                    
                    <p>
                      {$articles[0]["body"]}
                    </p>
                    <a href="article-fullpage{$articles[0][id]}.html" class="bottom-right angle flat button">بیشتر بدانید<span class="angle"><i class="icon-angle-left"></i></span></a>
                </div>
            </div>
        </div>
        <div class="large-6 columns for-nested">
            <div class="row">
                <div class="large-6 columns height-255 no-padding">             
                <a href="article-fullpage{$articles[1][id]}.html" title="{$articles[1][subject]}">
                    <img src="{$articles[1][image]}" alt="{$articles[1][subject]}" class="stretch-image" style="width:255px;height:255px;">
                </a>    
                </div>
                <div class="large-6 columns height-255 bottom-line">
                <a href="article-fullpage{$articles[1][id]}.html" title="{$articles[1][subject]}">
                    <h2 class="smaller">{$articles[1]["subject"]}</h2>
                </a>    
                    <p>
                         {$articles[1]["body"]}
                    </p>
                    <a href="article-fullpage{$articles[1][id]}.html" class="bottom-right angle flat button">بیشتر بدانید<span class="angle"><i class="icon-angle-left"></i></span></a>
                </div>
            </div>
            <div class="row">
                <div class="large-6 columns height-255 no-padding">
                <a href="article-fullpage{$articles[2][id]}.html" title="{$articles[2][subject]}">
                    <img src="{$articles[2][image]}" alt="{$articles[2][subject]}" class="stretch-image" style="width:255px;height:255px;" >
                </a>    
                </div>
                <div class="large-6 columns height-255 bottom-line">
                <a href="article-fullpage{$articles[2][id]}.html" title="{$articles[2][subject]}">
                    <h2 class="smaller">{$articles[2]["subject"]}</h2>
                </a>    
                    <p>
                        {$articles[2]["body"]}
                    </p>
                    <a href="article-fullpage{$articles[2][id]}.html" class="bottom-right angle flat button">بیشتر بدانید<span class="angle"><i class="icon-angle-left"></i></span></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End id="content-container" -->
cd;
    echo $html;
    }
?>