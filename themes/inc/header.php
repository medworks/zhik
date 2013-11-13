<?php
    include_once("config.php");
    include_once("classes/functions.php");
    include_once("classes/database.php");
    include_once("classes/seo.php");
    $seo = Seo::GetSeo();   
?>
<!DOCTYPE html>
<!--[if IE 8]>
    <html class="no-js lt-ie9" lang="fa">
<![endif]-->
<!--[if gt IE 8]><!-->
    <html class="no-js" lang="fa">
<!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta name="description" content="<?php echo $seo->Site_Describtion;?>"/>
    <meta name="keywords" content="<?php echo $seo->Site_KeyWords;?>"/>
    <meta name="robots" content="INDEX,FOLLOW">
    <meta http-equiv="Content-Language"  content="Fa">
    <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
    Remove this if you use the .htaccess -->
    <meta http-equiv="X-UA-Compatible" content="chrome=1">

    <title><?php echo $seo->Site_Title;?></title>

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">

    <link href="themes/css/reset.css" rel="stylesheet">
    <link href="themes/css/foundation.css" rel="stylesheet">
    <link href="themes/css/font-awesome.min.css" rel="stylesheet">
    <link href="themes/css/isotope.css" rel="stylesheet">
    <link href="themes/css/jquery.fancybox-1.3.4.css" rel="stylesheet">
    <link href="themes/css/validationEngine.jquery.css" rel="stylesheet">
    <link href="themes/css/style-init.css" rel="stylesheet">
    <!--[if IE 8]>
        <link href="themes/css/foundation-ie8.css" rel="stylesheet">
        <link href="themes/css/archtek-ie8.css" rel="stylesheet">
    <![endif]-->

    <script src="themes/js/custom.modernizr.js"></script>

    <link rel="shortcut icon" href="favicon.ico">
    <link rel="apple-touch-icon" href="favicon.ico">
</head>
<body>
    <script type="text/javascript" src="themes/js/CFInstall.js"></script>
    <script>
       CFInstall.check({
            url: "./ie.html",
            mode: "overlay",
            destination: "http://www.mediateq.ir/zhik",
       });
    </script>
<div id="header-container" class="content-width">
    <!-- Logo -->
    <div id="logo-wrapper">
        <div id="logo">
            <a href="./"><img src="themes/images/logo.png" alt="Zhik"></a>
            <p class="ltr">ZhikTower.com</p>
        </div>
    </div>
    <!-- Menu -->
    <div id="menu-wrapper">
        <ul id="root-menu" class="sf-menu">
            <li>
                <a href="./">صفحه اصلی</a>
               <!--  <ul>
                    <li>
                        <a href="index.php">صفحه اصلی 1</a>
                    </li>
                    <li>
                        <a href="index-2.php">صفحه اصلی 2</a>
                    </li>
                </ul> -->
            </li>
            <li>
                <a href="about-us.html">درباره ما</a>
            </li>
            <li>
                <a href="works.html">پروژه ها</a>
                <!-- <ul>
                    <li>
                        <a href="work-fullpage1.html">پروژه برج پزشکی ژیک</a>
                    </li>
                    <li>
                        <a href="portfolio-single.php">Single Page</a>
                        <ul>
                            <li>
                                <a href="portfolio-single.php">Image/Slideshow Format</a>
                            </li>
                            <li>
                                <a href="portfolio-single-video.php">Video Format</a>
                            </li>
                        </ul>
                    </li>
                </ul> -->
            </li>
            <li>
                <a href="news.html">اخبار</a>
                <!-- <ul>
                    <li>
                        <a href="news-fullpage1.html">برج پزشکی ژیک</a>
                    </li>
                    <li>
                        <a href="blog-list-left-sidebar.php">List Page (Left Sidebar)</a>
                    </li>
                    <li>
                        <a href="blog-single.php">Single Page</a>
                    </li>
                </ul> -->
            </li>
            <li>
                <a href="articles.html">مقالات</a>
                <!-- <ul>
                    <li>
                        <a href="article-fullpage1.html">برج پزشکی ژیک</a>
                    </li>
                    <li>
                        <a href="gallery-2.php">Gallery Style 2</a>
                    </li>
                    <li>
                        <a href="team.php">Our Team</a>
                    </li>
                    <li>
                        <a href="team-member-single.php">Team Member Profile</a>
                    </li>
                    <li>
                        <a href="faq.php">FAQ</a>
                    </li>
                    <li>
                        <a href="404.php">404 - Page Not Found</a>
                    </li>
                </ul> -->
            </li>
            <li>
                <a href="gallery.html">گالری تصاویر</a>
            </li>
            <li>
                <a href="contact.html">تماس با ما</a>
                <!-- <ul class="flip">
                    <li>
                        <a href="elements-layouts.php">Layouts</a>
                    </li>
                    <li>
                        <a href="elements-buttons.php">Buttons</a>
                    </li>
                    <li>
                        <a href="elements-headings.php">Headings</a>
                    </li>
                    <li>
                        <a href="elements-icons.php">Icons</a>
                    </li>
                    <li>
                        <a href="elements-images-videos.php">Images and Videos</a>
                    </li>
                    <li>
                        <a href="elements-blockquotes.php">Blockquotes</a>
                    </li>
                    <li>
                        <a href="elements-tabs-message-boxes.php">Tabs and Message Boxes</a>
                    </li>
                    <li>
                        <a href="elements-accordion-toggles.php">Accordion and Toggles</a>
                    </li>
                    <li>
                        <a href="elements-google-maps.php">Google Maps</a>
                    </li>
                    <li>
                        <a href="elements-testimonial-slider.php">Testimonial Slider</a>
                    </li>
                    <li>
                        <a href="elements-dropcaps-highlights-dividers.php">Drop Caps, Highlights and Dividers</a>
                    </li>
                </ul> -->
            </li>
            <!-- <li>
                <a href="contact-us.php">Contact</a>
            </li> -->
        </ul>
        <nav id="mobile-menu" class="top-bar">
            <ul class="title-area">
                <!-- Do not remove this list item -->
                <li class="name"></li>
                
                <!-- Menu toggle button -->
                <li class="toggle-topbar menu-icon">
                    <a href="#"><span></span></a>
                </li>
            </ul>
            
            <!-- Mobile menu's container -->
            <section class="top-bar-section"></section>
        </nav>
    </div>
    <!-- Search -->
    <div id="header-search">
        <a id="header-search-button" href="javascript:;"><i class="icon-search"></i></a>
    </div>
    <div id="header-search-input-wrapper">
        <form action="search.html" method="post" name="frmsearch">
            <input id="searchtxt" type="text" placeholder="Type and hit enter to search ...">
			<input type="submit" name="submit" class="submit left" value="" />
			<input type="hidden" name="mark" value="search" />
        </form>
    </div>
</div>
<!-- End id="header-container" -->