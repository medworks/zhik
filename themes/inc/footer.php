<?php
	include_once("./classes/database.php");
	include_once("./lib/persiandate.php");
	$db = Database::GetDatabase(); 
	$About_System = GetSettingValue('About_System',0);
	$news = $db->SelectAll('news',NULL,NULL," ndate DESC");
	$works = $db->SelectAll('works',NULL,NULL," fdate DESC");
	$articles = $db->SelectAll('articles',NULL,NULL," ndate DESC");
	$About_System = mb_substr(html_entity_decode(strip_tags($About_System), ENT_QUOTES, "UTF-8"), 0, 500,"UTF-8")."  ...";
?>
<!-- Footer Content -->
<div id="footer-content-container">
    <div id="footer-content-inner-wrapper" class="content-width">
        <div id="footer-content" class="row top-margin">
            <div class="large-4 columns less-padding" style="text-align:right;">
                <img id="footer-logo" src="themes/images/logo.png" alt="">
                <p>
                    <a href="about-us.html" title="درباره ما"><?php echo $About_System ?></a>
                </p>
            </div>
            <div class="large-4 columns less-padding">
                <div class="title">
                    <h5>آخرین اخبار</h5>
                </div>
                <ul>
                   
				<?php									  					
					for($i=0 ; $i<3 ; $i++){
						if($news[$i]['subject']!=null){
	  						$ndate = ToJalali($news[$i]["ndate"]," l d F ");
							echo "<li>
                                    <div class='pic'>
    									<a href='news-fullpage{$news[$i][id]}.html' title='{$news[$i]["subject"]}'>
    									   <img src='{$news[$i]["image"]}'alt='{$news[$i]["subject"]}'>
                                        </a>
                                    </div>
									<h3><a href='news-fullpage{$news[$i][id]}.html' title='{$news[$i]["subject"]}'>{$news[$i]["subject"]}</a></h3>
									<span class='date'>{$ndate}</span>
								 </li>";
					}}
				?>
                </ul>

            </div>
            <div class="large-4 columns less-padding">
                <div class="title">
                    <h5>آخرین پروژه ها</h5>
                </div>
                <ul>
    				<?Php
                        for($i=0 ; $i<3 ; $i++){
        					if($works[$i]['subject']!=null){						
        						$fdate = ToJalali($works[$i]["fworksdate"]," l d F  Y"); 
        						echo "<li>
                                        <div class='pic'>
        								    <a href='work-fullpage{$works[$i][id]}.html' title='{$works[$i]["subject"]}'>
        								        <img src='{$works[$i]["image"]}'alt='{$works[$i]["subject"]}' style='width:50px;height:50px;'>
                                            </a>
                                        </div>
        								<h3><a href='work-fullpage{$works[$i][id]}.html' title='{$works[$i]["subject"]}'>{$works[$i]["subject"]}</a></h3>								
        								<span class='date'>{$fdate}</span>
        							</li>";
        				    }
        				}
    				?>
                </ul>
            </div>
            <div class="large-4 columns less-padding">
                <div class="title">
                    <h5>آخرین مقالات</h5>
                </div>
                <ul>
                    <?php												
    					for($i=0 ; $i<3 ; $i++){
    						if($articles[$i]['subject']!=null){
    								$ndate = ToJalali($articles[$i]["ndate"]," l d F Y");
    							echo "<li>
                                        <div class='pic'>
        							        <a href='article-fullpage{$articles[$i][id]}.html' title='{$articles[$i]["subject"]}'>
        									   <img src='{$articles[$i]["image"]}'alt='{$articles[$i]["subject"]}' style='width:50px;height:50px;'>
                                            </a>
                                        </div>
    									<h3 class='article'><a href='article-fullpage{$articles[$i][id]}.html' title='{$articles[$i]["subject"]}'>{$articles[$i]["subject"]}</a></h3>
    									<span class='date article'>{$ndate}</span>
    								</li>";
    					}}
    				?>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End id="footer-content-container" -->
<!-- Footer Bar -->
<div id="footer-bar-container" class="row">
    <div id="footer-bar-inner-wrapper" class="content-width">
        <div class="large-6 columns less-padding">
            <div id="footer-social">
                <?php
                    $gplus = GetSettingValue('Gplus_Add',0);
                    $facebook = GetSettingValue('FaceBook_Add',0);
                    $twitter = GetSettingValue('Twitter_Add',0);
                    $rss = GetSettingValue('Rss_Add',0);
                ?>
                <ul class="bar-social">
                    <li>
                        <a href="https://<?php echo $facebook; ?>" target="_blank" title="Facebook"><img src="themes/images/social/facebook-bw.png" alt="Facebook"><img class="hover" src="themes/images/social/facebook.png" alt="Facebook"></a>
                    </li>
                    <li>
                        <a href="https://<?php echo $twitter; ?>" target="_blank" title="Twitter"><img src="themes/images/social/twitter-bw.png" alt="Twitter"><img class="hover" src="themes/images/social/twitter.png" alt="Twitter"></a>
                    </li>
                    <li>
                        <a href="https://<?php echo $gplus; ?>" target="_blank" title="Google Pluse"><img src="themes/images/social/googleplus-bw.png" alt="Google+"><img class="hover" src="themes/images/social/googleplus.png" alt="Google+"></a>
                    </li>
                    <!-- <li>
                        <a href="#" target="_blank"><img src="themes/images/social/linkedin-bw.png" alt="" title=""><img class="hover" src="themes/images/social/linkedin.png" alt="LinkedIn" title="LinkedIn"></a>
                    </li>
                    <li>
                        <a href="#" target="_blank"><img src="themes/images/social/flickr-bw.png" alt="" title=""><img class="hover" src="themes/images/social/flickr.png" alt="Flickr" title="Flickr"></a>
                    </li>
                    <li>
                        <a href="#" target="_blank"><img src="themes/images/social/vimeo-bw.png" alt="" title=""><img class="hover" src="themes/images/social/vimeo.png" alt="Vimeo" title="Vimeo"></a>
                    </li>
                    <li>
                        <a href="#" target="_blank"><img src="themes/images/social/youtube-bw.png" alt="" title=""><img class="hover" src="themes/images/social/youtube.png" alt="YouTube" title="YouTube"></a>
                    </li>
                    <li>
                        <a href="#" target="_blank"><img src="themes/images/social/forrst-bw.png" alt="" title=""><img class="hover" src="themes/images/social/forrst.png" alt="Forrst" title="Forrst"></a>
                    </li>
                    <li>
                        <a href="#" target="_blank"><img src="themes/images/social/dribbble-bw.png" alt="" title=""><img class="hover" src="themes/images/social/dribbble.png" alt="Dribbble" title="Dribbble"></a>
                    </li> -->
                    <li>
                        <a href="http://<?php echo $rss; ?>" target="_blank" title="RSS"><img src="themes/images/social/rss-bw.png" alt="RSS"><img class="hover" src="themes/images/social/rss.png" alt="RSS"></a>
                    </li>
                </ul>
                <span>:ارتباط با ما از طریق</span>
            </div>
        </div>
        <div class="large-6 columns less-padding">
            Zhik © Copyright 2013, All rights reserved by Zhik company.<br /><br />
            Designed by <a href="http://www.mediateq.ir">Mediateq</a>
        </div>
    </div>
</div> 
<!-- End id="footer-bar-container" -->
    
</body>
</html>