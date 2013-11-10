<?php
$db = database::GetDatabase();
$gallery= $db->SelectAll('gallery',NULL,NULL," id DESC");
$html=<<<cd
    <div id="header-image-container">
        <div id="header-image">
            <img src="themes/images/demo/gallery-header.jpg" alt="" class="stretch-image">
        </div>
    </div>
    <div id="content-container" class="content-width">
        <!-- Breadcrumbs -->
        <div class="row">
            <div id="breadcrumbs-wrapper" class="large-12 columns for-nested">
                <span>مسیر شما:</span>
                <ul class="breadcrumbs">
                    <li class="current">
                        <a>گالری تصاویر</a>
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
                <h1>گالری تصاویر<strong>ژیک</strong></h1>
                <!-- <p>
                    Etiam pellentesque mollis ultrices. Nam dictum auctor nunc, at ultricies lorem tempor id. Nulla tellus dolor, aliquam ac consectetur at, euismod sed sapien. 
                </p> -->
            </div>
        </div>
        <!-- Gallery Items -->
        <div class="row no-bg">
            <div class="large-12 columns no-padding">
                
                <div class="gallery2-wrapper">
cd;
	for($i=0 ; $i<count($gallery) ; $i++)
	{
$html.=<<<cd
                    <div class="gallery-item">
                        <a href="{$gallery[$i][image]}" class="image-box" rel="gallery1">
						<img src="{$gallery[$i][image]}" alt="{$gallery[$i][subject]}"></a>
                    </div>
cd;
$html.=<<<cd
                </div>
            </div>
        </div>
    </div>
cd;
    return $html;
?>