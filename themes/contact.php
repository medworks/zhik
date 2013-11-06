<?php

$html=<<<cd
    <script src='http://maps.googleapis.com/maps/api/js?key=AIzaSyDun8B3aM33iKhRIZniXwprr2ztGlzgnrQ&sensor=false'></script>
    
    <div id="header-image-container">
        <div id="header-image">
            <img src="themes/images/demo/contact-header.jpg" alt="" class="stretch-image">
        </div>
    </div>
    <div id="content-container" class="content-width">
        <!-- Breadcrumbs -->
        <div class="row">
            <div id="breadcrumbs-wrapper" class="large-12 columns for-nested">
                <span>مسیر شما:</span>
                <ul class="breadcrumbs">
                    <li class="current">
                        <a>تماس با ما</a>
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
                <h1>تماس با <strong>ژیک</strong></h1>
            </div>
        </div>
        <!-- Page Content -->
        <div class="grey-bg row">
            <div class="large-3 columns for-nested">
                <div class="row">
                    <div class="large-12 columns no-padding height-255">
                        <img src="themes/images/demo/contact1.jpg" alt="" class="stretch-image">
                    </div>
                </div>
                <div class="row">
                    <div class="large-12 columns grey-bg">
                        <div class="contact-info-widget">
                            <h3>اطلاعات تماس</h3>
                            <!-- <p>
                                Ut enim ad minim veniam consectetur adipisicing elit. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                            </p> -->
                            <p>
                                آدرس: مشهد، بلوار معلم، معلم 12، بین سروش 24 و 26، پلاک 82، طبقه اول.
                            </p>
                            <ul>
                                <li>
                                    +98511.609.3876<i class="icon-phone"></i>
                                </li>
                                <li>
                                    +98915.110.2568<i class="icon-mobile-phone"></i>
                                </li>
                                <li>
                                    +98915.303.0781<i class="icon-mobile-phone"></i>
                                </li>
                                <li>
                                    +98915.520.0272<i class="icon-mobile-phone"></i>
                                </li>
                                <li>
                                    <script type="text/javascript">

                                        emailE='zhik.pro'
                                        emailE=('info' + '@' + emailE)
                                        document.write('<a href="mailto:' + emailE + '">' + emailE + '</a>')

                                    </script>
                                    <i class="icon-envelope-alt"></i>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="large-9 columns for-nested">
                <div class="row">
                    <div class="large-12 columns no-padding">
                        <div class="google-map" data-latlng="36.327724, 59.526205" data-display-type="ROADMAP" data-zoom-level="17" data-height="330"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="large-12 columns">
                        <h3 class="blog-section-title">فرم تماس</h3>
                        <p>
                            شما می توانید از طریق فرم زیر ما را از نظرات، پیشنهادات و انتقادات خود بهره مند نمایید.
                        </p>
                        <form id="contact-form" method="post" class="validate">
                            <div class="row">
                                <div class="large-5 columns less-padding">
                                    <label for="name">نام و نام خانوادگی</label>
                                    <input class="validate[required]" type="text" name="name">
                                </div>
                            </div>
                            <div class="row">
                                <div class="large-5 columns less-padding">
                                    <label for="email">ایمیل</label>
                                    <input class="validate[required,custom[email]] ltr" type="text" name="email">
                                </div>
                            </div>
                            <div class="row">
                                <div class="large-5 columns less-padding">
                                    <label for="subject">موضوع</label>
                                    <input class="validate[required]" type="text" name="subject">
                                </div>
                            </div>
                            <div class="row">
                                <div class="large-12 columns less-padding">
                                    <label for="message">پیام</label>
                                    <textarea class="validate[required]" name="message" style="height: 120px;"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="large-5 columns less-padding rtl">
                                    <input type="submit" class="flat button" value="ارسال">
                                </div>
                            </div>
                        </form>
                        <div id="success" class="success box">
                            Thank you. We have received your message and will contact you back shortly.
                        </div>
                        <div id="error" class="error box">
                            Something went wrong. Please contact us via email or phone. We truly apologize for the inconvenience.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
cd;
    return $html;
?>