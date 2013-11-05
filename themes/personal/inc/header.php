<?php
	include_once("classes/seo.php");
	$seo = Seo::GetSeo();
	/* $Site_Title = GetSettingValue('Site_Title',0);
	$Site_KeyWords = GetSettingValue('Site_KeyWords',0);
	$Site_Describtion = GetSettingValue('Site_Describtion',0);
	$tel = GetSettingValue('Tell_Number',0); */
?>
<!doctype html>
<html lang="fa">
<head>
	<title><?php echo $seo->Site_Title;?></title>

	<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=IE8">
	<meta charset="UTF-8">
	<meta name="description" content="<?php echo $seo->Site_Describtion;?>"/>
	<meta name="keywords" content="<?php echo $seo->Site_KeyWords;?>"/>
	<meta name="robots" content="INDEX,FOLLOW">
	<meta http-equiv="Content-Language"  content="Fa">

	<link rel="stylesheet" href="themes/css/1styles.css" />
	<link rel="stylesheet" href="themes/css/prettyphoto.css" />
	<link rel="stylesheet" href="themes/css/validationEngine.css"/>
	<link rel="stylesheet" href="themes/personal/settings.css" />
	<link rel="stylesheet" href="themes/personal/style.css" />

	<script src="lib/js/jquery.js" type="text/javascript"></script>
	<script src="lib/js/jquery.cycle.all.js" type="text/javascript"></script>
	<script src="lib/js/jquery.validationEngine-en.js" type="text/javascript"></script>
	<script src="lib/js/jquery.validationEngine.js" type="text/javascript"></script>	
	<script src="lib/js/jquery.validationEngine-en.js" type="text/javascript"></script>
	<script src="lib/js/jquery.validationEngine.js" type="text/javascript"></script>
	<script src="themes/js/jquery.prettyphoto.js" type="text/javascript"></script>	
	<script src="themes/personal/js/jquery.themepunch.plugins.min.js" type="text/javascript"></script>
	<script src="themes/personal/js/jquery.themepunch.revolution.min.js" type="text/javascript"></script>
	<script src="themes/personal/js/jquery.hoverdir.min.js" type="text/javascript"></script>
	<script src="themes/personal/js/jquery.isotope.min.js" type="text/javascript"></script>
	<script src="themes/personal/js/script.js" type="text/javascript"></script>
	<!-- Piwik -->
		<script type="text/javascript"> 
		  var _paq = _paq || [];
		  _paq.push(['trackPageView']);
		  _paq.push(['enableLinkTracking']);
		  (function() {
			var u=(("https:" == document.location.protocol) ? "https" : "http") + "://mediateq.ir/analys//";
			_paq.push(['setTrackerUrl', u+'piwik.php']);
			_paq.push(['setSiteId', 1]);
			var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0]; g.type='text/javascript';
			g.defer=true; g.async=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
		  })();

		</script>
		<noscript><p><img src="http://mediateq.ir/analys/piwik.php?idsite=1" style="border:0" alt="" /></p></noscript>
	<!-- End Piwik Code -->
	<!--[if lt IE 9]>
		<script src="lib/js/html5shiv.js"></script>
	<![endif]-->
	<link rel="Shortcut Icon" href="themes/personal/favicon.ico" type="image/x-icon"/>
	<link rel="icon" href="themes/personal/favicon.ico" type="image/x-icon"/>
</head>
<body>
	<div class="container">
		<!-- Header part -->
		<header>
			<div class="logo left">
				<h2>
					<a href="./" title="Mediateq"><img src="themes/personal/images/logo.png" alt="Mediateq" /></a>
					<strong>Mediateq</strong>
				</h2>
			</div>
			<div class="information right">
				<ul>
					<li ><span class="email-icon"></span><a href="mailto:info@mediateq.ir" title="Send mail" target="_blank">info<span class="at"></span>mediateq.ir</a></li>
					<li class="ltr"><span class="tel-icon"></span><a title="Tel"><?php echo $tel; ?></a></li>
				</ul>	
			</div>
			<div class="badboy"></div>
		</header>	