<?php
	include_once("./classes/database.php");
	$db = database::GetDatabase();
	$gplus = GetSettingValue('Gplus_Add',0);
	$facebook = GetSettingValue('FaceBook_Add',0);
	$twitter = GetSettingValue('Twitter_Add',0);
	$rss = GetSettingValue('Rss_Add',0);
	
?>
<div class="sidebar">
	<!-- ***********Slideshow************ -->
	<div class="social simple-box">
		<ul>
			<li>
				<a href="#" class="dribble"></a>
			</li>
			<li>
				<a href="https://<?php echo $facebook; ?>" target="_blank" class="facebook"></a>
			</li>
			<li>
				<a href="https://<?php echo $twitter; ?>" target="_blank" class="twitter"></a>
			</li>
			<li>
				<a href="#" class="vimeo"></a>
			</li>
			<li>
				<a href="https://<?php echo $gplus; ?>" target="_blank" class="gpluse"></a>
			</li>
			<li>
				<a href="http://<?php echo $rss; ?>" target="_blank" class="rss"></a>
			</li>
		</ul>
		<div class="badboy"></div>
	</div>
	<!-- ***********Login Panel************ 
	<div class="login-panel main-box">
		<h2>ورود کاربران</h2>
		<div class="line"></div>
		<div class="badboy"></div>
		<div class="login box-left">
			<form action="">
				<p><input type="text" name="username" class="username" value="نام کاربری" onfocus="if (this.value == 'نام کاربری') {this.value = '';}" onblur="if (this.value == '') {this.value = 'نام کاربری';}" /></p>
				<p><input type="password" name="password" class="password" value="رمز عبور" onfocus="if (this.value == 'رمز عبور') {this.value = '';}" onblur="if (this.value == '') {this.value = 'رمز عبور';}" /></p>
				<p class="right"><input type="submit" name="submit" class="submit" value="ورود" /></p>
				<label class="ltr right">به خاطر بسپار <input type="checkbox" checked="checked" name="remember" class="remember"/></label>
			</form>
			<div class="badboy"></div>
			<a href="#" class="forget">رمز خود را فراموش کرده ام!</a>
			<div class="badboy"></div>
		</div>
	</div> -->
	<!-- ***********Subscribe************ -->
	<div class="subscrib main-box">
		<h2>اشتراک</h2>
		<div class="line"></div>
		<div class="badboy"></div>
		<div class="box-left">
			<form id="subscribfrm" method="post" action="">
			    <fieldset class="info_fieldset">
					<div id="note"></div>
				</fieldset>
				<p>اشتراک خبرنامه به وسیله ایمیل</p>
				<input type="text" name="name" class="subscrib" id="subscrib" placeholder="نام و نام خانوادگی" />
				<input type="text" name="tel" class="subscrib" id="subscrib" placeholder="تلفن همراه" />
				<input type="text" name="email" class="subscrib ltr" id="subscrib" placeholder="E-mail" />
				<p><input type="submit" class="submit" id="nsubmit" value="اشتراک" /></p>
				<input type="hidden" name='mark' value='regnews' />
			</form>
		</div>
		<script type='text/javascript'>
		$(document).ready(function(){	   			
			$("#nsubmit").click(function(){
				$.ajax({
					type: "POST",
					url: "manager/ajaxcommand.php?news=reg",
					data: $("#subscribfrm").serialize(), 
					success: function(msg)
					{
						$("#note").ajaxComplete(function(event, request, settings){				
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
	<!-- ***********poll************ -->
	<div class="subscrib main-box">
		<h2>نظر سنجی</h2>
		<div class="line"></div>
		<div class="badboy"></div>
		<div class="box-left">
			<form id="frmpoll" method="post" action="">
			    <fieldset class="info_fieldset">
					<div id="note"></div>
				</fieldset>
				<p>سوال</p>				
				<p><input type="submit" class="submit" id="nsubmit" value="ثبت" /></p>
				<input type="hidden" name='mark' value='regpoll' />
			</form>
		</div>		
	</div>
	<!-- ***********Gallery Slideshow************ -->
	<div class="gallery flexslider simple-box" id="slider">
		<ul class="slides">
			<?php
				$slides= $db->SelectAll('slides',NULL,NULL," pos ASC");
				for($i=0 ; $i<count($slides) ; $i++){
					if($slides[$i]['pos']==2 || $slides[$i]['pos']==3){

						echo "<li>
								<a href=''><img src='{$slides[$i][image]}' alt='{$slides[$i][subject]}'></a>
								<div class='slider-caption'>
									<h2><a href=''>{$slides[$i][subject]}</a></h2>
								</div>
							</li>";

					}
				}
			?>
		</ul>
	</div>
	<script>
		jQuery(window).load(function() {
		  jQuery('#slider').flexslider({
			animation: "fade",
			slideshowSpeed: 7000,
			animationSpeed: 600,
			randomize: false,
			pauseOnHover: true,
			controlNav: false
		  });
		});
	</script>
	<!-- ***********Tabed menu************ 
	<div class="widget" id="tabbed-widget">
		<div class="box-left tab">
			<div class="widget-container">
				<div class="widget-top">
					<ul class="tabs posts-taps">
						<li class="tabs"><a href="#tab1">کارهای ما</a></li>
						<li class="tabs"><a href="#tab2">اخبار</a></li>
						<li class="tabs"><a href="#tab3">تصاویر</a></li>
						<li class="tabs"><a href="#tab4">پست ها</a></li>
					</ul>
				</div>
				<div class="tabs-wrap" id="tab1">
					<ul>
						<?php
							/* $db = database::getDatabase();
  							$works = $db->SelectAll('works',NULL,NULL," fdate DESC");
  							 for($i=0 ; $i<5 ; $i++){
  							 	$sdate = ToJalali($works[$i]["sdate"]," l d F  Y ");
    							$fdate = ToJalali($works[$i]["fdate"]," l d F  Y ");
    							echo "<li>
    									<div class='pic right'>
    										<a href='?item=fullworks&act=do&wid={$works[$i]["id"]}' title='{$works[$i]["subject"]}'>
    											<img src='{$works[$i]["image"]}' alt='{$works[$i]["subject"]}'>
    										</a>
    									</div>
    									<div class='detail right'>
    										<h3>
    											<a href='?item=fullworks&act=do&wid={$works[$i]["id"]}' title='{$works[$i]["subject"]}'>{$works[$i]["subject"]}</a>
    										</h3>
    										<span class='date'>
    											<span>$sdate</span>
    										</span>
    										<span class='date'>
    											<span>$fdate</span>
    										</span>
    									</div>
    								  </li>";
  							 }*/
						?>
					</ul>
				</div>
				<div class="tabs-wrap" id="tab2">
					<ul>
						<?php
							/*$db = database::getDatabase();
  							$news = $db->SelectAll('news',NULL,NULL," ndate DESC");
  							 for($i=0 ; $i<5 ; $i++){
  							 	$ndate = ToJalali($news[$i]["sdate"]," l d F  Y ");
    							echo "<li>
    									<div class='pic right'>
    										<a href='?item=fullnews&act=do&wid={$news[$i]["id"]}' title='{$news[$i]["subject"]}'>
    											<img src='{$news[$i]["image"]}' alt='{$news[$i]["subject"]}'>
    										</a>
    									</div>
    									<div class='detail right'>
											<h3>
												<a href='?item=fullnews&act=do&wid={$news[$i]["id"]}' title='{$news[$i]["subject"]}'>{$news[$i]["subject"]}</a>
											</h3>
											<span class='date'>
												<span>$ndate</span>
											</span>
										</div>
    								  </li>";
  							 }*/
						?>
					</ul>
				</div>
				<div class="tabs-wrap" id="tab3"></div>
				<div class="tabs-wrap" id="tab4"></div>
			</div>
			<div class="badboy"></div>
		</div>
	</div>
	-->
	
</div>
<div class="badboy"></div>
<?php
/* if ($_POST["mark"]=="regnews")
	{
		$fields = array("`email`","`tel`","`name`");		
		$values = array("'{$_POST[email]}'","'{$_POST[tel]}'","'{$_POST[name]}'");
		if ($db->InsertQuery('usersnews',$fields,$values))
			header('location:?item=initial&msg=1');
		else
			header('location:?item=initial&msg=2');
		$msgs = GetMessage($_GET['msg']);
	} */
?>