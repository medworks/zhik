<?php
	include_once("./classes/database.php");
	include_once("./lib/persiandate.php");
	$db = database::GetDatabase();
$html=<<<cd
<!-- *********************Slideshow part************************** -->
<div class="slideshow ltr bannercontainer responsive">
	<div class="banner ltr">
		<ul>
cd;
			$slides= $db->SelectAll('slides',NULL,NULL," pos ASC");
			for($i=0 ; $i<count($slides) ; $i++){
$html.=<<<cd
            <li data-transition="slotfade-horizontal" data-slotamount="1" data-masterspeed="300" data-thumb="{$slides[$i][image]}">
				<img src="{$slides[$i][image]}" alt="{$slides[$i][subject]}" >

                <div class="caption large_text sft"
                     data-x="750"
                     data-y="44"
                     data-speed="300"
                     data-start="800"
                     data-easing="easeOutExpo">
                     <p style="white-space: normal;">{$slides[$i][subject]}</p>
                </div>

                <div class="caption medium_text sfl"
                     data-x="200"
                     data-y="100"
                     data-speed="300"
                     data-start="1100"
                     data-easing="easeOutExpo">
                     <p style="white-space: normal; margin-right: 50px; line-height: 1.5;">{$slides[$i][body]}</p>
                </div>

                <div class="caption lfl"
                     data-x="30"
                     data-y="350"
                     data-speed="300"
                     data-start="1400"
                     data-easing="easeOutExpo"  >
                     <img width='200px' height="150px" src="{$slides[$i][image]}" alt="{$slides[$i][subject]}">
                 </div>
            </li>
cd;
			}
$html.=<<<cd
        </ul>
        <div class="tp-bannertimer"></div>
	</div>
</div>
<!-- *********************Client part************************** -->
<div class="client-part">
	<div class="cat-tabs-wrap" id="tab1">
		<div class="title"><h2>سایت های رسپانسیو</h2></div>
		<div class="text"><p>امروزه صفحه نمایش ها از 320 پیکسل شروع شده و به 2560 پیکسل و حتی بزرگتر ختم میشود. بنابراین طرح های سنتی و قدیمی با عرض ثابت جوابگو نیست و طراحی های جدید نیاز به استفاده از روش انطباقی <span class="enfont">(Responsive)</span> دارد و طرح و قالب مورد نظر باید به صورت خودکار برای صفحه نمایش ها و رزولوشن های مختلف تنظیم گردد تا برای انواع کاربران به درستی نمایش داده شود.<p></div>
	</div>
	<div class="cat-tabs-wrap" id="tab2">
		<div class="title"><h2>تبلیغات اینترنتی</h2></div>
		<div class="text"><p>توجه به این نکته بسیار مهم است که مادامی که سایت شما دیده نشود نمی تواند برای شما هیچگونه سودآوری داشته باشد. بنابراین زمانی شما می توانید از وب سایت خود کسب درآمد کنید که توسط مشتری بازدید شوید. از اهداف مهم ما در این زمینه هدایت هدفمند مشتری به وب سایت شما و صفحات شما است. توجه به این نکته که تبلیغات اینترنتی در تجارت امروزه به عنوان یکی از قدرتمندترین ابزارهای تبلیغاتی و بازاریابی در دست شرکتهای پیشرو در این زمینه است و ایجاد ترنولهای عظیم مالی بر مبنای تجارت اینترنتی برای اینگونه شرکتها ما را بر آن داشت تا با ایجاد مدلهای علمی در این زمینه بتوانیم برنامه های مدونی را به شرکتهای مختلف جهت عرضه محصولاتشان در بازرهای جهانی و بازارهای هدف ارائه نماییم.<p></div>
	</div>
	<div class="cat-tabs-wrap" id="tab3">
		<div class="title"><h2>بهینه سازی سایت</h2></div>
		<div class="text"><p>ده ها مرورگر وب در سراسر جهان در حال استفاده میباشند. برای همه آنها اجرای سندهای <span class="enfont">W3C</span> کمی متفاوت است. طراحی سایت باید با این تفاوتها دست به گریبان باشد. بدیهی است سازگاری صد در صد با همه مرورگرها بالقوه غیرممکن است. اما این امکان وجود دارد طراحی صفحه وب را طوری انجام داد که در محبوبترین مرورگرها به صورت بهینه و مناسب نمایش داده شود.<p></div>
	</div>
	<div class="cat-tabs-wrap" id="tab4">
		<div class="title"><h2>رتبه سایت</h2></div>
		<div class="text"><p>ممکن است که وب سایت یا بلاگ شخصی داشته باشید که این روزها اکثر افراد دارند. با این حال، این مسئله که هر فردی میتواند وب سایتی داشته باشد، به این مفهوم نمیباشد که هر فردی میتواند وب سایت راه اندازی کند. در راه اندازی سایت، مراحل متعددی مانند طراحی، محتوا و بهینه سازی وجود دارند. آیا باید سایتتان را خودتان طراحی کنید، یا طراح متخصص استخدام کنید؟<p></div>
	</div>
	<div class="cat-tabs-header">
		<ul>
			<li><a href="#tab1"><span class="tab1-icon"></span>سایتهای رسپانسیو</a></li>
			<li><a href="#tab2"><span class="tab2-icon"></span>تبلیغات اینترنتی</a></li>
			<li><a href="#tab3"><span class="tab3-icon"></span>بهینه سازی سایت</a></li>
			<li><a href="#tab4"><span class="tab4-icon"></span>رتبه سایت</a></li>
		</ul>	
	</div>
	<div class="badboy"></div>
</div>
<hr class="arrow">
<!-- *********************News part************************** -->
<h2 class="news-title">اخبار</h2>
<div class="news-part">
	<div id="slideshow-rec">
cd;
		$news = $db->SelectAll('news',NULL,NULL," ndate DESC");
			for($i=0 ; $i<count($news) ; $i++){
				$ndate = ToJalali($news[0]["ndate"]," l d F  Y");
				$body= strip_tags($news[0]['body']);
				$body= (mb_strlen($body)>100) ? mb_substr($body,0,100,"UTF-8")."..." : $body;
$html.=<<<cd
			<div class='scroll-item'>
			    <a href='?item=fullnews&wid={$news[$i][id]}' title='{$news[$i][subject]}'><img src='{$news[$i][image]}' alt='{$news[$i][subject]}'></a>
			    <h2><a href='?item=fullnews&wid={$news[$i][id]}' title='{$news[$i][subject]}'>{$news[$i][subject]}</a></h2>
			    <p>{$body}</p>
			</div>
cd;
			}
$html.=<<<cd
	</div>
	<div class="badboy"></div>
	<div class="nav">
		<a id="prev1" href="#">Prev</a>
		<a id="next1" href="#">Next</a>
	</div>
	<div class="badboy"></div>
</div>
<!-- Script for rec work slideshow -->
<script type="text/javascript">
	$(document).ready(function() {
		var vids = $("#slideshow-rec .scroll-item");
		for(var i = 0; i < vids.length; i+=3) {
		  vids.slice(i, i+3).wrapAll('<div class="group_items"></div>');
		}
		$(function() {
			$('#slideshow-rec').cycle({
				fx: 'fade',
				timeout: 0,
				slideExpr: '.group_items',
				speed: 700,
				pause: true,
				prev: '#prev1', 
				next: '#next1',
			});
		});
 	});
</script>
<!-- END Script for rec work slideshow -->
<hr class="arrow">
<!-- *********************Tab part************************** -->
<div class="tabs-part">
cd;
$html.=<<<cd
	<div class="tit">
		<h2>کارهای ما</h2>
		<!-- <p></p>  -->
	</div>
	<div class="cat-tabs-header2">
		<ul>
cd;
  			$works = $db->SelectAll("works","*",null,"fdate DESC");  
			for($i=0 ; $i<5 ; $i++){
				if($i<count($works)){
					$j= $i+10;
$html.=<<<cd
				<li><a href="#tab$j"><span class="tab8-icon"></span>{$works[$i][subject]}</a></li>
cd;
			}}
$html.=<<<cd
		</ul>	
	</div>
	<div class="cat-tabs">
cd;
		for($i=0 ; $i<5 ; $i++){
			$j= $i+10;
			$body= $works[$i]['body'];
			$body= strip_tags($body);
   			$body= (mb_strlen($body)<1200) ? mb_substr($body,0,1200,"UTF-8")."..." : $body;
$html.=<<<cd
			<div class="cat-tabs-wrap2" id="tab$j">
				<div class="title"><h3><a href="?item=fullworks&wid={$works[$i][id]}" title="{$works[$i][subject]}">{$works[$i][subject]}</a></h3></div>
				<div class="text"><p>{$body}<p></div>
				<div class="pic"><img src="{$works[$i][image]}" alt="{$works[$i][subject]}" /></div>
				<div class="continue"><p><a href="?item=fullworks&wid={$works[$i][id]}">ادامه مطلب &#8604;</a></p></div>
			</div>
cd;
		}
$html.=<<<cd
	</div>
	<div class="badboy"></div>
</div>
<!-- <hr class="arrow"> -->
<!-- *********************Aboutus part************************** 
<div class="about-part">
	<div class="left aboutus">
		<div class="tit"><h2>درباره ما</h2></div>
		<div class="detail">
			<div class="pic"><img src="themes/personal/images/others/a1.jpg" alt=""></div>
			<div class="text">
				<div class="arrow-box"><p>توضیحات مربوط بهمرفی محصولات ما به صورت مستمر مرفی محصولات ما به صورت مستمر صورت مستمر صورت مستمر صورت مستمر صورت مستمر صورت مستمر صورت مستمر صورت مستمر <p></div>
			</div>
			<div class="badboy"></div>
		</div>
		<div class="detail">
			<div class="pic"><img src="themes/personal/images/others/a1.jpg" alt=""></div>
			<div class="text">
				<div class="arrow-box"><p>توضیحات مربوط بهمرفی محصولات ما به صورت مستمر مرفی محصولات ما به صورت مستمر صورت مستمر صورت مستمر صورت مستمر صورت مستمر صورت مستمر صورت مستمر صورت مستمر <p></div>
			</div>
			<div class="badboy"></div>
		</div>
	</div>
	<div class="aboutworks">
		<div class="tit"><h2>چرا مشتریان ما را انتخاب می کنند</h2></div>
		<div class="detail">
			<p>توضیحات مربوط بهمرفی محصولات ما به صورت مستمر مرفی محصولات ما به صورت مستمر صورت مستمر صورت مستمر صورت مستمر صورت مستمر صورت مستمر صورت مستمر صورت مستمر </p>
			<p class="tik"><span></span>توضیحات مربوط بهمرفی محصولات ما به صورت مستمر مرفی </p>
			<p class="tik"><span></span>توضیحات مربوط بهمرفی محصولات ما به صورت مستمر مرفی </p>
			<p class="tik"><span></span>توضیحات مربوط بهمرفی محصولات ما به صورت مستمر مرفی </p>
			<p class="tik"><span></span>توضیحات مربوط بهمرفی محصولات ما به صورت مستمر مرفی </p>
		</div>
	</div>
	<div class="badboy"></div>
</div>
-->
cd;
return $html;
?>