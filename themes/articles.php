<?php
  include_once("./classes/database.php");
  include_once("./lib/persiandate.php");
  $db = Database::GetDatabase();
  $pageNo = ($_GET["pid"]) ? $_GET["pid"] : 1;
  $maxItemsInPage = GetSettingValue('Max_Post_Number',0);
  $from = ($pageNo - 1) * $maxItemsInPage;
  $count = $maxItemsInPage;
  
  $articles = $db->SelectAll("articles","*",null,"ndate DESC",$from,$count);  
  $itemsCount = $db->CountAll("articles");
     
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
                        <a>مقالات</a>
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
                <h1>مقالات<strong>ژیک</strong></h1>
            </div>
        </div>
		<!-- Blog List -->
        <div class="grey-bg row">
            <div class="large-9 columns for-nested">
cd;
foreach($articles as $key => $post)
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
                        <h2 class="blog-title"><a href="article-fullpage{$post[id]}.html">{$post["subject"]}</a></h2>
                        <p class="excerpt">
                            {$post["body"]}
                        </p>
                        <a href="article-fullpage{$post[id]}.html" class="small flat radius button">ادامه مقاله</a>
                    </div>
                    <div class="large-12 columns no-padding">
                        <img src="{$post[image]}" alt="{$post[subject]}" style="width:765px;height:255px;">
                    </div>
                </div> 
cd;
}
$linkFormat = 'article-page'.$pid='%PN%'.'.html';
$maxPageNumberAtTime = GetSettingValue('Max_Page_Number',0);
$pageNos = Pagination($itemsCount, $maxItemsInPage, $pageNo, $maxPageNumberAtTime, $linkFormat);
$html .= '<div class="row"><div id="blog-pagination" class="large-12 columns pagination-centered rtl">' . $pageNos . '</div></div>';

$html.=<<<cd
            </div>
            <div id="sidebar-wrapper" class="large-3 columns for-nested">
                <div class="widget-item row">
                                       <div class="large-12 columns">
                        <div class="search-widget">
                            <h4>جستجو</h4>
							<fieldset class="info_fieldset">
								<div id="srhresult"></div>
							</fieldset>
                            <form id="frmsearch" method="post" action="">
                                <input type="text" id="findtxt" name="findtxt" placeholder="جستجو..." />
								<p><input type="submit" class="submit" id="srhsubmit" value="جستجو" /></p>
								<input type="hidden" name='mark' value='findnews' />
                            </form>
							<script type='text/javascript'>
							$(document).ready(function(){
								$("#srhsubmit").click(function(){								
									$.ajax({									    
										type: "POST",
										url: "manager/ajaxcommand.php?items=search&cat=articles",
										data: $("#frmsearch").serialize(), 
										success: function(msg)
										{
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
$posts = $db->SelectAll("articles","*",null,"ndate DESC");
for($i = 0;$i<7;$i++)
{
  if (!isset($posts[$i][id])) break;
	$ndate = ToJalali($posts[$i]["ndate"]," l d F  Y");
$html.=<<<cd
                        
                                <li>
                                    <div class="post-thumbnail">
                                        <a href="article-fullpage{$posts[$i][id]}.html">
										<img src="{$posts[$i][image]}" alt="{$posts[$i][subject]}" style="width:50px;height:50px;"></a>
                                    </div>
                                    <div class="post-title">
                                        <a href="article-fullpage{$posts[$i][id]}.html">{$posts[$i][subject]}</a>
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
            </div>
        </div>
    </div>
cd;
    return $html;
?>
