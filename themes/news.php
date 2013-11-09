<?php
  include_once("./classes/database.php");
  include_once("./lib/persiandate.php");
  $db = Database::GetDatabase();
  $pageNo = ($_GET["pid"]) ? $_GET["pid"] : 1;
  $maxItemsInPage = GetSettingValue('Max_Post_Number',0);
  $from = ($pageNo - 1) * $maxItemsInPage;
  $count = $maxItemsInPage;
  
  $news = $db->SelectAll("news","*",null,"ndate DESC",$from,$count);
  $itemsCount = $db->CountAll("news");//count($news);
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
    return $html;
?>
