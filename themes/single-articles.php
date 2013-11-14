<?php
    include_once("./config.php");
	include_once("./lib/persiandate.php");
	include_once("./classes/database.php");	
	include_once("./classes/seo.php");	
	$db = Database::GetDatabase();
	$seo = Seo::GetSeo();
 	$articles = $db->Select('articles',NULL,"id={$_GET[wid]}"," ndate DESC");
	$ndate = ToJalali($articles["ndate"]," l d F  Y ");
	$articles["userid"] = GetUserName($articles["userid"]);
	$body = $articles['body'];
	$seo->Site_Title = $articles["subject"];
	$seo->Site_Describtion = strip_tags(mb_substr($articles["body"],0,150,"UTF-8"));
$html=<<<cd
    <div id="header-image-container">
        <div id="header-image">
            <img src="themes/images/article-header.jpg" alt="Article page" class="stretch-image">
        </div>
    </div>
    <div id="content-container" class="content-width">
        <!-- Breadcrumbs -->
        <div class="row">
            <div id="breadcrumbs-wrapper" class="large-12 columns for-nested">
                <span>مسیر شما:</span>
                <ul class="breadcrumbs">
                    <li class="current">
                        <a>{$articles["subject"]}</a>
                    </li>
                    <li>
                        <a href="articles.html">مقالات</a>
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
                <h1>{$articles["subject"]}</h1>
            </div>
        </div>
        <!-- Blog List -->
        <div class="grey-bg row">
            <div class="large-9 columns for-nested">
                <div class="blog-item row">
                    <div class="large-12 columns height-255">
                        <div class="blog-meta">
                            <span class="date">1392/08/15</span>
                            <ul class="author-comments">
                                <li>
                                    <a href="#">{$articles["userid"]}</a><i class="icon-user"></i>
                                </li>
                                <!-- <li>
                                    <a href="#">5 Comments</a><i class="icon-comments-alt"></i>
                                </li> -->
                            </ul>
                        </div>
                        <hr>
                        <h2 class="blog-title"><a href="article-fullpage{$articles[id]}.html">{$articles["subject"]}</a></h2>
                        <p class="excerpt">
                            {$articles["body"]}
                        </p>
                    </div>
                    <div class="large-12 columns no-padding">
                        <img src="{$articles[image]}" alt="{$articles[subject]}" style="width:765px;height:255px;">
                    </div>
                </div>
            </div>
cd;

$html.=<<<cd
            <div id="sidebar-wrapper" class="large-3 columns for-nested">
                <div class="widget-item row">
                    <div class="large-12 columns">
                        <div class="search-widget">
                            <h4>جستجو</h4>
                            <form id="frmsearch" method="post" action="">
                                <input type="text" id="findtxt" name="findtxt" placeholder="جستجو..." />
                                <p><input type="submit" class="submit" id="srhsubmit" value="جستجو" /></p>
                                <input type="hidden" name='mark' value='findnews' />
                            </form>
                            <fieldset class="info_fieldset">
                                <div id="srhresult"></div>
                            </fieldset>
                            <script type='text/javascript'>
                                $(document).ready(function(){
                                    $("#srhsubmit").click(function(){
                                        $.ajax({                                        
                                            type: "POST",
                                            url: "manager/ajaxcommand.php?items=search&cat=articles",
                                            data: $("#frmsearch").serialize(), 
                                            success: function(msg)
                                            {
                                                $('.info_fieldset').css('display','block');
                                                $("#srhresult").ajaxComplete(function(event, request, settings){
                                                    $(this).hide();
                                                    $(this).html(msg).slideDown("slow");
                                                    $(this).html(msg);
                                                });
                                            }
                                        });
                                        return false;
                                    });
                                });
                            </script>
                        </div>
                    </div>
                </div>
                <div class="widget-item row">
                    <div class="large-12 columns">
                        <div class="posts-widget">
                            <h4>آخرین مقالات</h4>
                            <ul>
cd;
$articles = $db->SelectAll("articles","*",null,"ndate DESC");
for($i = 0;$i<7;$i++)
{
  if (!isset($articles[$i][id])) break;
	$ndate = ToJalali($articles[$i]["ndate"]," l d F  Y");
$html.=<<<cd
                        
                                <li>
                                    <div class="post-thumbnail">
                                        <a href="article-fullpage{$articles[$i][id]}.html">
										<img src="{$articles[$i][image]}" alt="{$articles[$i][subject]}" style="width:50px;height:50px;"></a>
                                    </div>
                                    <div class="post-title">
                                        <a href="article-fullpage{$articles[$i][id]}.html">{$articles[$i][subject]}</a>
                                        <span class="date">{$ndate}</span>
                                    </div>
                                </li>                            
cd;
}
$html.=<<<cd
                            </ul>
                        </div>
                    </div>
                </div>
<!--				
                <div class="widget-item row">
                    <div class="large-12 columns">
                        <div class="category-widget">
                            <h4>گروه ها</h4>
                            <ul class="rtl">
                                <li>
                                    <a href="#">Announcements</a>
                                </li>
                                <li>
                                    <a href="#">General News</a>
                                </li>
                                <li>
                                    <a href="#">Promotions &amp; Offers</a>
                                </li>
                                <li>
                                    <a href="#">Customer Relationship</a>
                                </li>
                                <li>
                                    <a href="#">Upcoming Events</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
    -->            
           <!-- <div class="widget-item row">
                    <div class="large-12 columns">
                        <div class="flickr-widget">
                            <h4>Flickr Gallery</h4>
                            <script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?show_name=1&amp;count=6&amp;display=random&amp;size=s&amp;layout=x&amp;source=user&amp;user=52617155@N08"></script>
                        </div>
                    </div>
                </div> -->
           <!-- <div class="widget-item row">
                    <div class="large-12 columns">
                        <div class="custom-text-widget">
                            <h4>Custom Text</h4>
                            <p>
                                Ut enim ad minim veniam consectetur adipisicing elit. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam consectetur adipisicing elit, sed do eiusmod
                            </p>
                        </div>
                    </div>
                </div> -->    
            </div>
        </div>
    </div>
cd;
    return $html;
?>