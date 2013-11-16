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
//------------------------------- wellcome part -------------------------
		$WellCome_Title = GetSettingValue('WellCome_Title',0);
	    $WellCome_Body = GetSettingValue('WellCome_Body',0);
//------------------------------- articles part -------------------------
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
//------------------------------- work part -------------------------
		$works = $db->SelectAll("works","*",null,"fdate DESC","0","6");
		$lastworkbody = mb_substr(html_entity_decode(strip_tags($works[0]["body"]), ENT_QUOTES, "UTF-8"), 0, 200,"UTF-8") . "..." ;
		
//------------------------------- news part -------------------------	
        $news = $db->SelectAll("news","*",null,"ndate DESC","0","3");
        $news[0]["body"] =(mb_strlen($news[0]["body"])>150)?
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
//------------------------------- header slides part -------------------------
		$slides = $db->SelectAll("slides","*");		

$html=<<<cd
<!-- Home Slider Container -->
<div id="home-slider-container">
    <div id="home-slider">
cd;
foreach($slides as $key=>$val)
{
$html.=<<<cd
        <div class="home-slider-item">
            <img src="{$val[image]}" alt="{$val[subject]}">
            <div class="slider-caption">
                <h2>{$val["subject"]}</h2>
                <p>
                    {$val["body"]}
                </p>
            </div>
        </div>
cd;
}
$html.=<<<cd
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
    <div class="row transparent">
        <div class="large-12 columns no-padding">
            <div class="portfolio-wrapper transparent">
                <div class="fixed-box portfolio-item bottom-line">
                    <h2 class="smaller">آخرین پروژه</h2>
                    <p>
                        <a href='work-fullpage{$works[0][id]}.html'>
                            {$lastworkbody}
                        </a>
                    </p>
                    <a href="works.html" class="bottom-right angle flat button">نمایش همه پروژه ها<span class="angle"><i class="icon-angle-left"></i></span></a>
                </div>
cd;
                for ($i=0 ; $i<6 ; $i++){
                    if($works[$i]['subject']!=null){
$html.=<<<cd
                    <div class="portfolio-item">
                        <div class="portfolio-item-hover">
                            <h3><a href='work-fullpage{$works[$i][id]}.html'>{$works[$i][subject]}</a></h3>
                            <ul>
                                <!-- <li>
                                    <a href="#">عکسها</a>
                                </li> -->
                                <li>
                                    <a href="work-fullpage{$works[$i][id]}.html">مشخصات</a>
                                </li>
                            </ul>
                        </div>                  
                        <img src="{$works[$i][image]}" alt="{$works[$i][subject]}" class="stretch-image" style="width:255px;height:255px;">
                    </div>
cd;
                }}
$html.=<<<cd
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
cd;
            for($i=1 ; $i<3 ; $i++){
                if($news[$i]['subject']!=null){
$html.=<<<cd
                <div class="sub-blog-item large-3 columns for-nested">
                    <div class="right-border row">
                        <div class="large-12 columns height-255">
                            <div class="blog-meta">
                                <span class="date">{$news[$i]["ndate"]}</span>
                            </div>
                            <hr>
                            <h4 class="sub-blog-title"><a href="news-fullpage{$news[$i][id]}.html">{$news[$i]["subject"]}</a></h4>
                             <p class="excerpt">
                                {$news[$i]["body"]}
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="large-12 columns no-padding height-255">
                        <a href="news-fullpage{$news[$i][id]}.html" title="{$news[$i][subject]}">
                            <img src="{$news[$i][image]}" alt="{$news[$i][subject]}" class="stretch-image" style="width:255px;height:255px;">
                        </a>    
                        </div>
                    </div>
                </div>
cd;
            }}
$html.=<<<cd
    </div>
    <!-- Features
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
cd;
            for($i=1 ; $i<3 ; $i++){
                if($articles[$i]['subject']!=null){
$html.=<<<cd
                <div class="row">
                    <div class="large-6 columns height-255 no-padding">             
                    <a href="article-fullpage{$articles[$i][id]}.html" title="{$articles[$i][subject]}">
                        <img src="{$articles[$i][image]}" alt="{$articles[$i][subject]}" class="stretch-image" style="width:255px;height:255px;">
                    </a>    
                    </div>
                    <div class="large-6 columns height-255 bottom-line">
                    <a href="article-fullpage{$articles[$i][id]}.html" title="{$articles[$i][subject]}">
                        <h2 class="smaller">{$articles[$i]["subject"]}</h2>
                    </a>    
                        <p>
                             {$articles[$i]["body"]}
                        </p>
                        <a href="article-fullpage{$articles[$i][id]}.html" class="bottom-right angle flat button">بیشتر بدانید<span class="angle"><i class="icon-angle-left"></i></span></a>
                    </div>
                </div>
cd;
            }}
$html.=<<<cd
        </div>
    </div> -->
</div>
<!-- End id="content-container" -->
cd;
    echo $html;
    }
?>