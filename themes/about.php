<?php
$About_System = GetSettingValue('About_System',0);
$html=<<<cd
    <div id="header-image-container">
        <div id="header-image">
            <img src="themes/images/demo/about/about-header.jpg" alt="" class="stretch-image">
        </div>
    </div>
    <div id="content-container" class="content-width">
            <!-- Breadcrumbs -->
            <div class="row">
                <div id="breadcrumbs-wrapper" class="large-12 columns for-nested">
                    <span>مسیر شما:</span>
                    <ul class="breadcrumbs">
                        <li class="current">
                            <a>درباره ما</a>
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
                    <h1>درباره <strong>ژیک</strong></h1>
                </div>
            </div>
            <!-- Page Content -->
            <div class="row white-bg">
                <div class="large-6 columns">
				<!--
                    <h2 class="has-line">ژیک چه کاری انجام می دهد</h2>
					
                    <h3 class="larger light">Praesent sollicitudin ligula a magna consectetur commodo. Integer id urna dui. Vestibulum ornare orci eget dolor laoreet placerat.</h3>
				-->
                    <p>
                       {$About_System}
                    </p>
					<!--
						<a href="?item=pdf" class="flat button"><i class="icon-save"></i>&nbsp;&nbsp;دانلود با فرمت PDF</a>
					-->
                </div>
                <div class="large-6 columns no-padding">
                    <div class="image-slider-wrapper">
                        <div class="image-slider">
                            <div class="image-slider-item height-510">
                                <img src="themes/images/demo/about/about2.jpg" alt="" class="stretch-image">
                            </div>
                            <div class="image-slider-item height-510">
                                <img src="themes/images/demo/about/about3.jpg" alt="" class="stretch-image">
                            </div>
                            <div class="image-slider-item height-510">
                                <img src="themes/images/demo/about/about1.jpg" alt="" class="stretch-image">
                            </div>
                        </div>
                        <div class="image-slider-controller">
                            <a href="#" class="image-slider-prev"><i class="icon-angle-left"></i></a>
                            <a href="#" class="image-slider-next"><i class="icon-angle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
			     
            <div class="row top-margin">
                <div class="large-12 columns">
                    <h2 class="has-line">کارهای ژیک</h2>
                    <div class="row">
                        <div class="large-3 columns less-padding align-center">
                            <p>
                                <img src="themes/images/demo/about/about4.jpg" alt="">
                            </p>
                            <h3 class="light">One Step Ahead</h3>
                            <p>
                                Vestibulum elementum, purus a tempus fringilla, tortor est
                            </p>
                        </div>
                        <div class="large-3 columns less-padding align-center">
                            <p>
                                <img src="themes/images/demo/about/about5.jpg" alt="">
                            </p>
                            <h3 class="light">Leader For Living</h3>
                            <p>
                                Vestibulum elementum, purus a tempus fringilla, tortor est
                            </p>
                        </div>
                        <div class="large-3 columns less-padding align-center">
                            <p>
                                <img src="themes/images/demo/about/about6.jpg" alt="">
                            </p>
                            <h3 class="light">Your Satisfaction First</h3>
                            <p>
                                Vestibulum elementum, purus a tempus fringilla, tortor est
                            </p>
                        </div>
                        <div class="large-3 columns less-padding align-center">
                            <p>
                                <img src="themes/images/demo/about/about7.jpg" alt="">
                            </p>
                            <h3 class="light">Never Fall Back</h3>
                            <p>
                                Vestibulum elementum, purus a tempus fringilla, tortor est
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
cd;

    return $html;
?>