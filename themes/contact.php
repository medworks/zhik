<?php
$address = GetSettingValue('Address',0);
$tel = GetSettingValue('Tell_Number',0);
$fax = GetSettingValue('Fax_Number',0);
$cell_phone1 = GetSettingValue('Cell_Phone1',0);
$cell_phone2 = GetSettingValue('Cell_Phone2',0);
$html=<<<cd
    <script src='http://maps.googleapis.com/maps/api/js?key=AIzaSyDun8B3aM33iKhRIZniXwprr2ztGlzgnrQ&sensor=false'></script>
    
    <div id="header-image-container">
        <div id="header-image">
            <img src="themes/images/contact-header.jpg" alt="Contact page" class="stretch-image">
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
                        <img src="themes/images/contact1.jpg" alt="Contact page" class="stretch-image">
                    </div>
                </div>
                <div class="row">
                    <div class="large-12 columns grey-bg">
                        <div class="contact-info-widget">
                            <h3>اطلاعات تماس</h3>                           
                            <p>
                               {$address}
                            </p>
                            <ul>
                                <li>
                                    {$tel}<a title="تلفن ثابت"><i class="icon-phone"></i></a>
                                </li>
                                <li>
                                    {$fax}<a title="فاکس"><i class="icon-phone-sign"></i></a>
                                </li>
                                <li>
                                    {$cell_phone1}<a title="موبایل"><i class="icon-mobile-phone"></i></a>
                                </li>
                                <li>
                                    {$cell_phone2}<a title="موبایل"><i class="icon-mobile-phone"></i></a>
                                </li>
                                <li>
                                    <script type="text/javascript">

                                        emailE='zhiktower.com'
                                        emailE=('info' + '@' + emailE)
                                        document.write('<a href="mailto:' + emailE + '">' + emailE + '</a>')

                                    </script>
                                    <a title="ایمیل"><i class="icon-envelope-alt"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="large-9 columns for-nested">
                <div class="row">
                    <div class="large-12 columns no-padding">
                        <div class="google-map" data-latlng="36.327724, 59.526205" data-display-type="ROADMAP" data-zoom-level="18" data-height="330"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="large-12 columns">
                        <h3 class="blog-section-title">فرم تماس</h3>
                        <p>
                            شما می توانید از طریق فرم زیر ما را از نظرات، پیشنهادات و انتقادات خود بهره مند نمایید.
                        </p>
                        <script>
                            $(document).ready(function(){
                            $("#contact-form").submit(function(){

                                $.ajax({
                                    type: "POST",
                                    url: "manager/ajaxcommand.php?contact=reg",
                                    data: $("#contact-form").serialize(),
                                        success: function(msg)
                                        {
                                            $("#note-contact").ajaxComplete(function(event, request, settings){             
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
                        <div id="note-contact" ></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
cd;
    return $html;
?>