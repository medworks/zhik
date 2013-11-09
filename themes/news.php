<?php
  include_once("./classes/database.php");
  include_once("./lib/persiandate.php");
  $db = Database::GetDatabase();
  $pageNo = ($_GET["pid"]) ? $_GET["pid"] : 1;
  $maxItemsInPage = GetSettingValue('Max_Post_Number',0);
  $from = ($pageNo - 1) * $maxItemsInPage;
  $count = $maxItemsInPage;
  
  $news = $db->SelectAll("news","*",null,"ndate DESC",$from,$count);  
  $itemsCount = $db->CountAll("news");
     
  $html=<<<cd
    <div id="header-image-container">
        <div id="header-image">
            <img src="themes/images/demo/blog/blog-header.jpg" alt="" class="stretch-image">
        </div>
    </div>
    <div id="content-container" class="content-width">
        <!-- Breadcrumbs -->
        <div class="row">
            <div id="breadcrumbs-wrapper" class="large-12 columns for-nested">
                <span>مسیر شما:</span>
                <ul class="breadcrumbs">
                    <li class="current">
                        <a>اخبار</a>
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
                <h1>اخبار <strong>ژیک</strong></h1>
            </div>
        </div>
		<!-- Blog List -->
        <div class="grey-bg row">
            <div class="large-9 columns for-nested">
cd;
foreach($news as $key => $post)
{
	$ndate = ToJalali($post["ndate"]," l d F  Y ساعت H:m");
  	$post["userid"] = GetUserName($post["userid"]);	
    $post["body"]= strip_tags($post["body"]);
    $post["body"] = (mb_strlen($post["body"])>500) ? mb_substr($post["body"],0,500,"UTF-8")."..." : $post["body"];
$html.=<<<cd
                 <div class="blog-item row">
                    <div class="large-12 columns height-255">
                        <div class="blog-meta">
                            <span class="date">1392/08/15</span>
                            <ul class="author-comments">
                                <li>
                                    <a href="#">{$post["userid"]}</a><i class="icon-user"></i>
                                </li>
                                <!-- <li>
                                    <a href="#">5 Comments</a><i class="icon-comments-alt"></i>
                                </li> -->
                            </ul>
                        </div>
                        <hr>
                        <h2 class="blog-title"><a href="blog-single.php">{$post["subject"]}</a></h2>
                        <p class="excerpt">
                            {$post["body"]}
                        </p>
                        <a href="#" class="small flat radius button">ادامه خبر</a>
                    </div>
                    <div class="large-12 columns no-padding">
                        <img src="{$post[image]}" alt="{$post[subject]}" style="width:765px;height:255px;">
                    </div>
                </div> 
cd;
}
$linkFormat = 'news-page'.$pid='%PN%'.'.html';
$maxPageNumberAtTime = GetSettingValue('Max_Page_Number',0);
$pageNos = Pagination($itemsCount, $maxItemsInPage, $pageNo, $maxPageNumberAtTime, $linkFormat);
$html .= '<center>' . $pageNos . '</center>';
$news[0]["ndate"] = ToJalali($news[0]["ndate"]," l d F  Y");
$news[1]["ndate"] = ToJalali($news[1]["ndate"]," l d F  Y");
$news[2]["ndate"] = ToJalali($news[2]["ndate"]," l d F  Y");
$html.=<<<cd
            </div>
            <div id="sidebar-wrapper" class="large-3 columns for-nested">
                <div class="widget-item row">
                    <div class="large-12 columns">
                        <div class="search-widget">
                            <h4>جستجو</h4>
                            <form method="get">
                                <input type="text" placeholder="جستجو...">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="widget-item row">
                    <div class="large-12 columns">
                        <div class="posts-widget">
                            <h4>آخرین اخبار</h4>
                            <ul>
                                <li>
                                    <div class="post-thumbnail">
                                        <a href="blog-single.php"><img src="{$news[0][image]}" alt="{$news[0][subject]}"></a>
                                    </div>
                                    <div class="post-title">
                                        <a href="blog-single.php">{$news[0][subject]}</a>
                                        <span class="date">{$news[0][ndate]}</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="post-thumbnail">
                                        <a href="blog-single.php"><img src="{$news[1][image]}" alt="{$news[1][subject]}"></a>
                                    </div>
                                    <div class="post-title">
                                        <a href="blog-single.php">{$news[1][subject]}</a>
                                        <span class="date">{$news[1][ndate]}</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="post-thumbnail">
                                        <a href="blog-single.php"><img src="{$news[2][image]}" alt="{$news[2][subject]}"></a>
                                    </div>
                                    <div class="post-title">
                                        <a href="blog-single.php">{$news[2][subject]}</a>
                                        <span class="date">{$news[2][ndate]}</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
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
            </div>
        </div>
    </div>
cd;
    return $html;
?>
