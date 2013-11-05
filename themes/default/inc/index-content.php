<!-- ****************Content (Right) part****************** -->
<?php
	if (GetPageName($_GET['item'],$_GET['act'])){
	 // echo "param is :",$_GET['item'],"<->",$_GET['act'];
		echo include_once GetPageName($_GET['item'],$_GET['act']);
		//exit();
	}else{
		include_once("./classes/database.php");
		include_once("./lib/persiandate.php");
		$db = database::GetDatabase();

$html="<div class='content'>
		<!-- ***********Slideshow************ -->
		<div id='ei-slider' class='slideshow ei-slider'>
			<ul class='ei-slider-large'>";

	$slides= $db->SelectAll('slides',NULL,NULL," pos ASC");
	for($i=0 ; $i<count($slides) ; $i++){
		if($slides[$i]['pos']==1 || $slides[$i]['pos']==3){
$html.=<<<cd
			<li>
				<img src="{$slides[$i][image]}" alt="{$slides[$i][subject]}">
				<div class="ei-title">
					<h2><a href="#">{$slides[$i][subject]}</a></h2>
					<h3>{$slides[$i][body]}</h3>
				</div>
			</li>
cd;
		}
	}
		$html.="</ul>
		<ul class='ei-slider-thumbs'>
			<li class='ei-slider-element'></li>";
		for($i=0 ; $i<count($slides) ; $i++){
			if($slides[$i]['pos']==1 || $slides[$i]['pos']==3){
$html.=<<<cd
			<li><a href="#"></a><img src="{$slides[$i][image]}" alt="{$slides[$i][subject]}"></li>
cd;
			}
		}
$html.=<<<cd
		</ul>
	</div>
	<script type="text/javascript">
	    jQuery(function() {
	        jQuery('#ei-slider').eislideshow({
				animation			: 'center',
				autoplay			: true,
				slideshow_interval	: 6000,
				speed          		: 800,
				titlesFactor		: 0.60,
				titlespeed          : 1000,
				thumbMaxWidth       : 100
	        });
	    });
	</script>
	<div class="badboy"></div>
	<!-- ***********Recent Works************ -->
	<div class="recent-works main-box">
		<h2>کارهای ما</h2>
		<div class="line"></div>
		<div class="badboy"></div>
		<div class="works box-right">
			<div id="slideshow-rec" style="height:225px !important;">
cd;
								
				$works = $db->SelectAll('works',NULL,NULL," fdate DESC");
				for($i=0 ; $i<count($works) ; $i++){
					$sdate= ToJalali($works[$i]["sdate"]," l d F  Y");
					$fdate= ToJalali($works[$i]["fdate"]," l d F  Y");
$html.=<<<cd
					<div class='scroll-item'>
						<a href='work-fullpage{$works[$i][id]}.html' title='{$works[$i][subject]}'><img src='{$works[$i][image]}' alt='{$works[$i][subject]}'></a>
						<h3><a href='work-fullpage{$works[$i][id]}.html' title='{$works[$i][subject]}'>{$works[$i][subject]}</a></h3>
						<p><span>شروع: </span>{$sdate}</p><br />
						<p><span>پایان: </span>{$fdate}</p>
					  </div>
cd;
				}

$html.=<<<cd
			</div>
			<div class="badboy"></div>
			<div id="nav" class="scroll-nav"></div>
			<div class="badboy"></div>
		</div>
	</div>
	<script type="text/javascript">
		jQuery(document).ready(function() {
			var vids = jQuery("#slideshow-rec .scroll-item");
			for(var i = 0; i < vids.length; i+=4) {
			  vids.slice(i, i+4).wrapAll('<div class="group_items"></div>');
			}
			jQuery(function() {
				jQuery('#slideshow-rec').cycle({
					fx:     'scrollHorz',
					timeout: 6000,
					pager:  '#nav',
					slideExpr: '.group_items',
					speed: 700,
					pause: true
				});
			});
	  });
	</script>
	<!-- ***********2 columns************ 
		<div class="two-columns">
			<div class="column1 right main-box">
				<h2>کارهای ما</h2>
				<div class="line"></div>
				<div class="badboy"></div>
				<div class="box-right">
					<ul>
						<li class="first-li">
							<div class="inner-content">
								<div class="pic">
									<a href="#">
										<img src="./themes/default/images/main/others/slide3.jpg" alt="">
										<span class="overlay"></span>
									</a>
								</div>
								<h2>
									<a href="#" title="">پروژه اول</a>
								</h2>
								<div class="date"><p><span>یکشنبه 1392 12</span></p></div>
								<div class="detial"><p>نتظنبت منضتبنشیت شت مکشتمک ت نتظنبت منضتبنشیت شت مکشتمک ت نتظنبت منضتبنشیت شت مکشتمک ت</p></div>							
							</div>
						</li>
						<li>
							<div class="inner-content">
								<div class="pic">
									<a href="#">
										<img src="./themes/default/images/main/others/slide3.jpg" alt="">
										<span class="overlay"></span>
									</a>
								</div>
								<h2>
									<a href="#" title="">پروژه اول</a>
								</h2>
								<div class="date"><p><span>یکشنبه 1392 12</span></p></div>
							</div>
						</li>
						<li>
							<div class="inner-content">
								<div class="pic">
									<a href="#">
										<img src="./themes/default/images/main/others/slide3.jpg" alt="">
										<span class="overlay"></span>
									</a>
								</div>
								<h2>
									<a href="#" title="">پروژه اول</a>
								</h2>
								<div class="date"><p><span>یکشنبه 1392 12</span></p></div>
							</div>
						</li>
						<li>
							<div class="inner-content">
								<div class="pic">
									<a href="#">
										<img src="./themes/default/images/main/others/slide3.jpg" alt="">
										<span class="overlay"></span>
									</a>
								</div>
								<h2>
									<a href="#" title="">پروژه اول</a>
								</h2>
								<div class="date"><p><span>یکشنبه 1392 12</span></p></div>
							</div>
						</li>
						<li>
							<div class="inner-content">
								<div class="pic">
									<a href="#">
										<img src="./themes/default/images/main/others/slide3.jpg" alt="">
										<span class="overlay"></span>
									</a>
								</div>
								<h2>
									<a href="#" title="">پروژه اول</a>
								</h2>
								<div class="date"><p><span>یکشنبه 1392 12</span></p></div>
							</div>
						</li>
					</ul>
					<div class="badboy"></div>
				</div>
			</div>
			<div class="column2 right main-box">
				<h2>اخبار</h2>
				<div class="line"></div>
				<div class="badboy"></div>
				<div class="box-right">
					<ul>
						<li class="first-li">
							<div class="inner-content">
								<div class="pic">
									<a href="#">
										<img src="./themes/default/images/main/others/slide3.jpg" alt="">
										<span class="overlay"></span>
									</a>
								</div>
								<h2>
									<a href="#" title="">پروژه اول</a>
								</h2>
								<div class="date"><p><span>یکشنبه 1392 12</span></p></div>
								<div class="detial"><p>نتظنبت منضتبنشیت شت مکشتمک ت نتظنبت منضتبنشیت شت مکشتمک ت نتظنبت منضتبنشیت شت مکشتمک ت</p></div>							
							</div>
						</li>
						<li>
							<div class="inner-content">
								<div class="pic">
									<a href="#">
										<img src="./themes/default/images/main/others/slide3.jpg" alt="">
										<span class="overlay"></span>
									</a>
								</div>
								<h2>
									<a href="#" title="">پروژه اول</a>
								</h2>
								<div class="date"><p><span>یکشنبه 1392 12</span></p></div>
							</div>
						</li>
						<li>
							<div class="inner-content">
								<div class="pic">
									<a href="#">
										<img src="./themes/default/images/main/others/slide3.jpg" alt="">
										<span class="overlay"></span>
									</a>
								</div>
								<h2>
									<a href="#" title="">پروژه اول</a>
								</h2>
								<div class="date"><p><span>یکشنبه 1392 12</span></p></div>
							</div>
						</li>
						<li>
							<div class="inner-content">
								<div class="pic">
									<a href="#">
										<img src="./themes/default/images/main/others/slide3.jpg" alt="">
										<span class="overlay"></span>
									</a>
								</div>
								<h2>
									<a href="#" title="">پروژه اول</a>
								</h2>
								<div class="date"><p><span>یکشنبه 1392 12</span></p></div>
							</div>
						</li>
						<li>
							<div class="inner-content">
								<div class="pic">
									<a href="#">
										<img src="./themes/default/images/main/others/slide3.jpg" alt="">
										<span class="overlay"></span>
									</a>
								</div>
								<h2>
									<a href="#" title="">پروژه اول</a>
								</h2>
								<div class="date"><p><span>یکشنبه 1392 12</span></p></div>
							</div>
						</li>
					</ul>
					<div class="badboy"></div>
					</ul>
				</div>
			</div>
			<div class="badboy"></div>
		</div>
		-->
	<!-- ***********tabs************ -->
	<div class="box-right cat-box-content cat-box tab" id="cats-tabs-box">
		<div class="cat-tabs-header">
			<ul>
				<li><a href="#catab4">اخبار</a></li>
				<li><a href="#catab1">تصاویر</a></li>
			</ul>
		</div>
		<div class="cat-tabs-wrap" id="catab4">
			<ul>
cd;
				
				$news = $db->SelectAll('news',NULL,NULL," ndate DESC");
				$ndate = ToJalali($news[0]["ndate"]," l d F  Y");
				$body= strip_tags($news[0]['body']);
				$body= (mb_strlen($body)>100) ? mb_substr($body,0,100,"UTF-8")."..." : $body;
$html.=<<<cd
				<li class="first-li">
					<div class="pic first-tab-pic">
						<a href="news-fullpage{$news[0][id]}.html" title="{$news[0][subject]}">
							<img src="{$news[0][image]}" alt="{$news[0][subject]}">
							<span class="overlay"></span>
						</a>
					</div>
					<h2>
						<a href="news-fullpage{$news[0][id]}.html" title="{$news[0][subject]}">{$news[0][subject]}</a>
					</h2>
					<div class="date"><p><span>{$ndate}</span></p></div>
					<div class="detial"><p>{$body}</p></div>
cd;
					if (mb_strlen($body)>100){
						$html.=<<<cd
						<a href="news-fullpage{$news[0][id]}.html" title="ادامه مطلب" class="button">ادامه مطلب</a>
cd;
					}
$html.=<<<cd
				</li>
cd;
				for($i=1 ; $i<5 ; $i++){
					if($news[$i]['subject']!=null){
					$ndate= ToJalali($news[$i]["ndate"]," l d F  Y");
$html.=<<<cd
					<li>
						<div class="pic">
							<a href="news-fullpage{$news[$i][id]}.html" title="{$news[$i][subject]}">
								<img src="{$news[$i][image]}" alt="{$news[$i][subject]}">
							</a>
						</div>
						<h2>
							<a href="news-fullpage{$news[$i][id]}.html" title="{$news[$i][subject]}">{$news[$i][subject]}</a>
						</h2>
						<div class="date"><p><span>$ndate</span></p></div>
					</li>				
cd;
				}}
$html.=<<<cd
			</ul>
			<div class="badboy"></div>
		</div>
		<div class="cat-tabs-wrap" id="catab1">
			<ul>
cd;
				$gallery= $db->SelectAll('gallery',NULL,NULL," id DESC");
$html.=<<<cd
					<li class="first-li-picture">
						<div class="pic first-tab-pic">
							<a href="{$gallery[0][image]}" rel='prettyphoto[gallery2]' title="{$gallery[0][subject]}">
								<img src="{$gallery[0][image]}" alt="{$gallery[0][subject]}">
								<span class="overlay-zoom"></span>
							</a>
						</div>
						<h2>
							{$gallery[0][subject]}
						</h2>
						<div class="detial"><p>{$gallery[0][body]}</p></div>
					</li>
cd;
				for($i=1 ; $i<13 ; $i++){
					if($gallery[$i]['image']!=null){
$html.=<<<cd
					<li class="picture">
						<div class="pic">
							<a href="{$gallery[$i][image]}" rel='prettyphoto[gallery2]' title="{$gallery[$i][subject]}">
								<img src="{$gallery[$i][image]}" alt="{$gallery[$i][subject]}">
							</a>
						</div>
					</li>	
cd;
				}}
$html.=<<<cd
			</ul>
			<div class="badboy"></div>
		</div>
	</div>
</div>
cd;
echo $html;
 	}

?>