<?php
	include_once("./classes/database.php");	
	include_once("./classes/seo.php");
	$db = Database::GetDatabase();	
	function GetPage($func)
	{
		switch($func)
		{
			case 'initial':
				return "index.php";
			break;
			case 'home':
                return "index-content.php";
			break;
			case 'contact':
				$seo = Seo::GetSeo();
				$seo->Site_Title = "تماس با ما";
                return "themes/personal/contact.php";
			break;
			case 'works':
				$seo = Seo::GetSeo();
				$seo->Site_Title = "کار های ما";
                return "themes/personal/works.php";
			break;
			case 'news':
				$seo = Seo::GetSeo();
				$seo->Site_Title = "اخبار";
                return "themes/personal/news.php";
			break;
			case 'gallery':
				$seo = Seo::GetSeo();
				$seo->Site_Title = "گالری تصاویر";
                return "themes/personal/gallery.php";
			break;
			case 'aboutus':
				$seo = Seo::GetSeo();
				$seo->Site_Title = "درباره ما";
                return "themes/personal/aboutus.php";
			break;
			case 'fullnews':
                return "themes/personal/single-news.php";
			break;
			case 'fullworks':
                return "themes/personal/single-work.php";
			break;
		}
	}
?>
<section class="middle">
	<div class="main-menu">
		<menu>
			<li><a href="./"><span class="home-icon"></span>خانه</a>
				<!-- <menu>
					<li><a href="#">خانه 1</a></li>
					<li><a href="#">خانه 2</a></li>
					<li><a href="#">خانه 3</a></li>
					<li><a href="#">خانه 4</a></li>
				</menu> -->
			</li>
			<li><a href="?item=aboutus"><span class="about-icon"></span>درباره ما</a></li>
			<li><a href="?item=works"><span class="works-icon"></span>کارهای ما</a></li>
			<li><a href="?item=news"><span class="news-icon"></span>اخبار</a></li>
			<li><a href="?item=gallery"><span class="gallery-icon"></span>گالری تصاویر</a></li>
			<li><a href="?item=contact"><span class="contact-icon"></span>تماس با ما</a></li>
		</menu>
	</div>
	<div class="contain">
		<div class="inner">
			<div class="inner-wrap">
		<?php
		    if (isset($_GET['item']))  
		    	echo include_once GetPage($_GET['item']);
		    else
			{
			    echo include_once GetPage('home');
		    	//header("Location: ?item=home");
				//exit();
			}	
		?>