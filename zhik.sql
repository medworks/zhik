-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2013 at 06:48 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `zhik`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(100) NOT NULL,
  `image` varchar(60) NOT NULL,
  `body` text NOT NULL,
  `ndate` datetime NOT NULL,
  `userid` int(11) NOT NULL,
  `resource` varchar(50) NOT NULL,
  `catid` int(11) NOT NULL,
  `keywords` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `subject`, `image`, `body`, `ndate`, `userid`, `resource`, `catid`, `keywords`) VALUES
(1, 'هنوز هم حتما باید درایوهای USB را safely remove کرد؟', './articlepics/happy.jpg', 'هنگامی که بدون Safely Remove کردن کول دیسک تان آن را جدا می کنید، ویندوز عصبانی شده و پیغام های خطایی را نشان می دهد. اما چرا هنوز این مساله اینقدر مهم است؟ اگر هیچ گاه فلشهای یو اس بی و هارد دیسک های USB مان را safely Eject نکنیم، چه اتفاقی برای دستگاه های مان خواهد افتاد؟\r\nبگذارید اینگونه بگوییم که اغلب اوقات که عجله داریم، کول دیسک یا هاردمان را بدون اینکه روی آیکون safely remove کلیک کنیم و مراحل لازم را پشت سر بگذاریم، از کامپیوتر جدا می کنیم. و خوشبختانه کم پیش آمده که با مشکلی روبرو شویم.\r\nواقعا چه دلایلی پشت کلیک روی آیکون safely remove نهفته است؟ و آیا ممکن است زمانی به دلیل رفتار نامناسب، اطلاعات روی کول دیسک مان پاک شوند؟\r\nو پاسخ:\r\nبله هر اتفاقی ممکن است، و این بیشتر بستگی به این دارد که آیا هنگام جدا کردنش، کامپیوتر در حال خواندن و نوشتن اطلاعات روی این ابزارها است یا خیر؟\r\nهنگامی که درایو یو اس بی را به کامپیوتر وصل می کنید، اجازه خواندن و نوشتن بدون محدودیت داده ها را از روی آن می دهید که برخی از آنها هم کش می شوند.\r\nکش شدن اطلاعات باعث می شود داده ها بی درنگ روی درایو یو اس بی نوشته نشوند. بلکه ابتدا روی رم کامپیوتر نگهداری شده و سپس به محل اصلی منتقل می شوند. حال اگر هنگامی که هنوز فایلها به کول دیسک منقل نشده اند یا اینکه در حال نوشته شدن روی آن هستند، به صورت ناگهانی درایو را جدا کنید؛ آنگاه ممکن است نتیجه کار فایل های ناقص باشد.\r\nبه هر حال ویندوز به صورت خودکار کش را برای ابزارهای USB غیرفعال می کند، مگر اینکه شما خودتان آن را فعال کرده باشید. لذا در صورت غیر فعال بودن کش می توان گفت اگر در حال خواندن و نوشتن روی کول دیسک نیستید، جدا کردن آن بدون Safely Remove هم تقریبا بدون خطر است.\r\nالبته استفاده از آیکون Safely Remove Hardware نیز یک سطح امنیتی اضافی برای جلوگیری از نابودی اطلاعات تان است.\r\nاگر به گونه ای عمل کنیم که فایلها به درستی بسته شوند، می تواند باعث حفظ اطلاعات،اشاره گرها و شاخصهای اندازه فایل شود. هنگام نوشتن اطلاعات درون دیسک، کامپیوتر همیشه بافر را خالی نمی کند و تنها بخشی از داده ها نوشته می شوند. استفاده از رویه صحیح جداسازی می تواند باعث اطمینان از این موضوع شود که اطلاعات و اشاره گرها در وضعیت مناسبی قرار دارند.', '2013-11-06 00:00:00', 1, '', 1, ''),
(2, 'هنوز هم حتما باید درایوهای USB را safely remove کرد؟', './articlepics/internet.jpg', 'هنگامی که بدون Safely Remove کردن کول دیسک تان آن را جدا می کنید، ویندوز عصبانی شده و پیغام های خطایی را نشان می دهد. اما چرا هنوز این مساله اینقدر مهم است؟ اگر هیچ گاه فلشهای یو اس بی و هارد دیسک های USB مان را safely Eject نکنیم، چه اتفاقی برای دستگاه های مان خواهد افتاد؟\r\nبگذارید اینگونه بگوییم که اغلب اوقات که عجله داریم، کول دیسک یا هاردمان را بدون اینکه روی آیکون safely remove کلیک کنیم و مراحل لازم را پشت سر بگذاریم، از کامپیوتر جدا می کنیم. و خوشبختانه کم پیش آمده که با مشکلی روبرو شویم.\r\nواقعا چه دلایلی پشت کلیک روی آیکون safely remove نهفته است؟ و آیا ممکن است زمانی به دلیل رفتار نامناسب، اطلاعات روی کول دیسک مان پاک شوند؟\r\nو پاسخ:\r\nبله هر اتفاقی ممکن است، و این بیشتر بستگی به این دارد که آیا هنگام جدا کردنش، کامپیوتر در حال خواندن و نوشتن اطلاعات روی این ابزارها است یا خیر؟\r\nهنگامی که درایو یو اس بی را به کامپیوتر وصل می کنید، اجازه خواندن و نوشتن بدون محدودیت داده ها را از روی آن می دهید که برخی از آنها هم کش می شوند.\r\nکش شدن اطلاعات باعث می شود داده ها بی درنگ روی درایو یو اس بی نوشته نشوند. بلکه ابتدا روی رم کامپیوتر نگهداری شده و سپس به محل اصلی منتقل می شوند. حال اگر هنگامی که هنوز فایلها به کول دیسک منقل نشده اند یا اینکه در حال نوشته شدن روی آن هستند، به صورت ناگهانی درایو را جدا کنید؛ آنگاه ممکن است نتیجه کار فایل های ناقص باشد.\r\nبه هر حال ویندوز به صورت خودکار کش را برای ابزارهای USB غیرفعال می کند، مگر اینکه شما خودتان آن را فعال کرده باشید. لذا در صورت غیر فعال بودن کش می توان گفت اگر در حال خواندن و نوشتن روی کول دیسک نیستید، جدا کردن آن بدون Safely Remove هم تقریبا بدون خطر است.\r\nالبته استفاده از آیکون Safely Remove Hardware نیز یک سطح امنیتی اضافی برای جلوگیری از نابودی اطلاعات تان است.\r\nاگر به گونه ای عمل کنیم که فایلها به درستی بسته شوند، می تواند باعث حفظ اطلاعات،اشاره گرها و شاخصهای اندازه فایل شود. هنگام نوشتن اطلاعات درون دیسک، کامپیوتر همیشه بافر را خالی نمی کند و تنها بخشی از داده ها نوشته می شوند. استفاده از رویه صحیح جداسازی می تواند باعث اطمینان از این موضوع شود که اطلاعات و اشاره گرها در وضعیت مناسبی قرار دارند.', '2013-11-05 00:00:00', 1, '', 1, ''),
(3, 'هنوز هم حتما باید درایوهای USB را safely remove کرد؟', './articlepics/google.jpg', 'هنگامی که بدون Safely Remove کردن کول دیسک تان آن را جدا می کنید، ویندوز عصبانی شده و پیغام های خطایی را نشان می دهد. اما چرا هنوز این مساله اینقدر مهم است؟ اگر هیچ گاه فلشهای یو اس بی و هارد دیسک های USB مان را safely Eject نکنیم، چه اتفاقی برای دستگاه های مان خواهد افتاد؟\r\nبگذارید اینگونه بگوییم که اغلب اوقات که عجله داریم، کول دیسک یا هاردمان را بدون اینکه روی آیکون safely remove کلیک کنیم و مراحل لازم را پشت سر بگذاریم، از کامپیوتر جدا می کنیم. و خوشبختانه کم پیش آمده که با مشکلی روبرو شویم.\r\nواقعا چه دلایلی پشت کلیک روی آیکون safely remove نهفته است؟ و آیا ممکن است زمانی به دلیل رفتار نامناسب، اطلاعات روی کول دیسک مان پاک شوند؟\r\nو پاسخ:\r\nبله هر اتفاقی ممکن است، و این بیشتر بستگی به این دارد که آیا هنگام جدا کردنش، کامپیوتر در حال خواندن و نوشتن اطلاعات روی این ابزارها است یا خیر؟\r\nهنگامی که درایو یو اس بی را به کامپیوتر وصل می کنید، اجازه خواندن و نوشتن بدون محدودیت داده ها را از روی آن می دهید که برخی از آنها هم کش می شوند.\r\nکش شدن اطلاعات باعث می شود داده ها بی درنگ روی درایو یو اس بی نوشته نشوند. بلکه ابتدا روی رم کامپیوتر نگهداری شده و سپس به محل اصلی منتقل می شوند. حال اگر هنگامی که هنوز فایلها به کول دیسک منقل نشده اند یا اینکه در حال نوشته شدن روی آن هستند، به صورت ناگهانی درایو را جدا کنید؛ آنگاه ممکن است نتیجه کار فایل های ناقص باشد.\r\nبه هر حال ویندوز به صورت خودکار کش را برای ابزارهای USB غیرفعال می کند، مگر اینکه شما خودتان آن را فعال کرده باشید. لذا در صورت غیر فعال بودن کش می توان گفت اگر در حال خواندن و نوشتن روی کول دیسک نیستید، جدا کردن آن بدون Safely Remove هم تقریبا بدون خطر است.\r\nالبته استفاده از آیکون Safely Remove Hardware نیز یک سطح امنیتی اضافی برای جلوگیری از نابودی اطلاعات تان است.\r\nاگر به گونه ای عمل کنیم که فایلها به درستی بسته شوند، می تواند باعث حفظ اطلاعات،اشاره گرها و شاخصهای اندازه فایل شود. هنگام نوشتن اطلاعات درون دیسک، کامپیوتر همیشه بافر را خالی نمی کند و تنها بخشی از داده ها نوشته می شوند. استفاده از رویه صحیح جداسازی می تواند باعث اطمینان از این موضوع شود که اطلاعات و اشاره گرها در وضعیت مناسبی قرار دارند.', '2013-11-04 00:00:00', 1, '', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `block`
--

CREATE TABLE IF NOT EXISTS `block` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `pos` tinyint(4) NOT NULL,
  `order` tinyint(4) NOT NULL,
  `acclevel` tinyint(4) NOT NULL,
  `plugin` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `contenttype` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `block`
--

INSERT INTO `block` (`id`, `name`, `pos`, `order`, `acclevel`, `plugin`, `content`, `contenttype`) VALUES
(1, 'اخبار', 1, 1, 1, '', 'jsj sj hc uigjhbhghgh', 2),
(2, 'سعید', 2, 1, 2, '', 'm kjnhubuyggnomnjo', 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `secid` int(11) NOT NULL,
  `catname` varchar(25) CHARACTER SET utf8 NOT NULL,
  `latinname` varchar(25) CHARACTER SET utf8 NOT NULL,
  `describe` varchar(100) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `secid`, `catname`, `latinname`, `describe`) VALUES
(5, 2, 'روانشناسی کودک', 'sycologists', 'اطلاعات روانشناسی'),
(6, 1, 'برنامه نویسی', 'programming', 'انواع زبان های برنامه نویسی');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(100) NOT NULL,
  `image` varchar(60) NOT NULL,
  `body` text NOT NULL,
  `ndate` datetime NOT NULL,
  `userid` int(11) NOT NULL,
  `resource` varchar(50) NOT NULL,
  `catid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=125 ;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `subject`, `image`, `body`, `ndate`, `userid`, `resource`, `catid`) VALUES
(47, 'کامل شدن امکان ویرایش اخبار', './newspics/internet.jpg', '<p>بدینوسیه اعلام می دارم که امکان ویرایش اخبار به اتمام رسید</p>', '2013-06-11 21:10:25', 1, 'حاتمی', 5),
(121, 'تست دوم', './newspics/robot.jpg', '<p>pkdpoksgv oi ojsfdo ivoisjoijosjoibo  ehrwihio   eruo j weitoi</p>', '2013-08-26 11:20:31', 1, 'حاتمی', 5),
(123, 'تست اول', './newspics/apple.jpg', '<p>hbhbubu</p>', '2013-08-26 11:39:54', 1, 'حاتمی', 6),
(124, 'تست اول', './newspics/chrome.jpg', '<p>ک برنامه‌نویس قابلیت جالبی را در نسخه جدید سیستم عامل مک شرکت اپل موسوم به ماوریکس شناسایی کرده که تشخیص حضور کاربر در برابر رایانه را ممکن کرده است.\nبه گزارش فارس به نقل از اپل اینسایدر، حسگر حساس به نور رایانه های مک بوک پرو با استفاده از برنامه ای که در سیستم عامل ماوریکس نصب شده، می تواند حرکات کاربر را در برابر رایانه تشخیص دهد و در صورتی که عدم حضور وی در برابر رایانه طولانی شود، ابتدا نمایشگر خاموش شده و سپس هارددیسک نیز خاموش می گردد و رایانه در وضعیت sleep قرار می گیرد.\nپیش از این دوربین iSight رایانه های مک برای اقدامات عادی دیگری مورد استفاده قرار می گرفتند، اما این اولین بار است که چنین قابلیتی با استفاده از سیستم عامل های اپل بر روی رایانه های مذکور فعال شده است. جالب آنکه با تغییر وضعیت نور محیط قرارگیری رایانه، عملکرد سیستم هم بر مبنای آن متحول می گردد.\nگفتنی است حسگرهای نور محیطی در تمامی مدل های مک بوک پرو و همین طور مدل های اخیر رایانه های آی مک و نمایشگرهای پیشرفته و جدید این شرکت وجود دارد و لذا قابلیت یاد شده برای اکثر کاربران سیستم عامل مک قابل استفاده است. سیستم عامل ماوریکس که حدود 10 روز قبل عرضه شد، مورد استقبال گسترده کاربران قرار گرفته است.</p>', '2013-08-26 11:55:23', 1, 'حاتمی', 6);

-- --------------------------------------------------------

--
-- Table structure for table `newsletter`
--

CREATE TABLE IF NOT EXISTS `newsletter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nid` int(11) NOT NULL,
  `sdate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `newsletter`
--

INSERT INTO `newsletter` (`id`, `nid`, `sdate`) VALUES
(2, 121, '2013-09-22 00:00:00'),
(3, 47, '2013-09-16 00:00:00'),
(4, 48, '2013-09-22 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `pollanswers`
--

CREATE TABLE IF NOT EXISTS `pollanswers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `poid` int(11) NOT NULL,
  `ip` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `pollanswers`
--

INSERT INTO `pollanswers` (`id`, `poid`, `ip`) VALUES
(1, 4, '127.0.0.1');

-- --------------------------------------------------------

--
-- Table structure for table `polloptions`
--

CREATE TABLE IF NOT EXISTS `polloptions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `option` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `polloptions`
--

INSERT INTO `polloptions` (`id`, `pid`, `option`) VALUES
(1, 2, '<p>عالی</p>\r'),
(2, 2, '<p>خوب</p>\r'),
(3, 2, '<p>متوسط</p>'),
(4, 3, '<p>1- عالی</p>\r'),
(5, 3, '<p>2- خوب</p>\r'),
(6, 3, '<p>3- متوسط</p>\r'),
(7, 3, '<p>4- ضعیف</p>');

-- --------------------------------------------------------

--
-- Table structure for table `polls`
--

CREATE TABLE IF NOT EXISTS `polls` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `regdate` datetime NOT NULL,
  `active` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `polls`
--

INSERT INTO `polls` (`id`, `title`, `regdate`, `active`) VALUES
(1, '2013-11-02 17:05:38', '0000-00-00 00:00:00', 0),
(2, '2013-11-02 17:11:07', '2013-11-02 00:00:00', 0),
(3, 'نظر شما؟', '2013-11-02 17:12:46', 1);

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE IF NOT EXISTS `section` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `secname` varchar(50) NOT NULL,
  `latinname` varchar(50) NOT NULL,
  `describe` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`id`, `secname`, `latinname`, `describe`) VALUES
(1, 'کامپیوتر', 'camputer', ''),
(2, 'روانشناسی', 'sycologist', 'اطلاعات روانشناسی'),
(3, 'الکترونیک', 'electronic', 'نرم افزار های الکترونیک'),
(4, 'معماری', 'artituvjh', 'گروه معماری'),
(5, 'روانشناسی2', 'sycologist', 'نرم افزار های الکترونیک'),
(6, 'روانشناسی2', 'sycologist', 'نرم افزار های الکترونیک'),
(7, 'معماری2', 'artituvjh', 'این سایت بر پایه phpطراحی شده است که باعث سهولت در');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(30) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`) VALUES
(1, 'Site_Theme_Name', 'default'),
(2, 'About_System', '<p>گروه مدیا تک بر در سال 1392 تشکیل و به جهت رفاه حال مشتریان عزیز</p>'),
(3, 'Site_Title', 'سیستم مدیریت محتوای مدیا تکنیک'),
(4, 'Site_KeyWords', 'مدیا تک - سی ام اس - مدیریت محتوا'),
(5, 'Site_Describtion', 'این سایت بر پایه phpطراحی شده است که باعث سهولت در'),
(6, 'Admin_Email', 'admin@mediateq.ir'),
(7, 'News_Email', 'news@mediateq.ir'),
(8, 'Contact_Email', 'info@mediateq.ir'),
(9, 'Max_Page_Number', '5'),
(10, 'Max_Post_Number', '3'),
(11, 'FaceBook_Add', 'facebook.com'),
(12, 'Twitter_Add', 'twitter.com'),
(13, 'Rss_Add', '127.0.01/media/rssfeed.php'),
(14, 'YouTube_Add', 'youtube.com'),
(15, 'Tell_Number', '7623666'),
(16, 'Fax_Number', '7634562'),
(17, 'Address', 'مشهد - سه راه فلسطین - ساختمان 202 - طبقه اول - واحد 3'),
(18, 'Is_Smtp_Active', 'yes'),
(19, 'Smtp_Host', 'smtp.gmail.com'),
(20, 'Smtp_User_Name', 'hatami4510@gmail.com'),
(21, 'Smtp_Pass_Word', '12345'),
(22, 'Smtp_Port', '465'),
(23, 'Email_Sender_Name', 'گروه مدیاتک');

-- --------------------------------------------------------

--
-- Table structure for table `slides`
--

CREATE TABLE IF NOT EXISTS `slides` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(60) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `body` varchar(250) NOT NULL,
  `pos` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `slides`
--

INSERT INTO `slides` (`id`, `image`, `subject`, `body`, `pos`) VALUES
(2, '/media/slidespics/e01d0e29bb069be94607d73f8b1234a2.png', 'تست سعید حاتمی', 'این تست جهت حل مشکلات ویرایش می باشد', 3),
(3, './slidespics/test.jpg', 'تست اسم عکس', 'تست توضیحات عکس سعید حاتمی', 1),
(4, './slidespics/editnews.png', 'تست سابمیت', 'تست دوم', 1);

-- --------------------------------------------------------

--
-- Table structure for table `uploadcenter`
--

CREATE TABLE IF NOT EXISTS `uploadcenter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(60) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `body` varchar(250) NOT NULL,
  `address` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `uploadcenter`
--

INSERT INTO `uploadcenter` (`id`, `image`, `subject`, `body`, `address`) VALUES
(1, 'test.jpg', 'تست سابمیت', 'تست توضیحات عکس سعید حاتمی', '1010'),
(2, 'test.jpg', 'تست سابمیت', 'تست دوم', '1011'),
(3, 'test.jpg', 'تست سابمیت', 'تست دوم', '1011'),
(4, 'test.jpg', 'تست سابمیت', 'تست دوم', '1011'),
(5, 'test.jpg', 'تست سابمیت', 'تست دوم', '1011'),
(6, 'editslides.png', 'تست سابمیت', 'تست دوم', '0111'),
(7, 'users.png', 'تست اول', 'اسلاید دو خنده دار است... اسلاید دو خنده دار است... اسلاید دو خنده دار است... اسلاید دو خنده دار است... اسلاید دو خنده دار است... اسلاید دو خنده دار است... اسلاید دو خنده دار است... اسلاید دو خنده دار است... اسلاید دو خنده دار است... اسلاید دو خنده د', '0111'),
(8, 'editworks.png', 'تست سابمیت', 'تست دوم', '0111'),
(9, 'editnews.png', 'تست سابمیت', 'تست دوم', '0111'),
(10, 'editnews.png', 'تست سابمیت', 'تست دوم', '0111'),
(11, 'addworks.png', 'تست اول', 'تست سعید', '0111'),
(12, 'logo.png', 'تست سابمیت', 'تست توضیحات عکس', '0011'),
(13, 'addworks.png', 'تست اول', 'تست دوم', '1110'),
(14, 'users.png', 'تست ورک', 'تست سعید', '1110'),
(15, 'editslides.png', 'تست اول', 'اسلاید دو خنده دار است... اسلاید دو خنده دار است... اسلاید دو خنده دار است... اسلاید دو خنده دار است... اسلاید دو خنده دار است... اسلاید دو خنده دار است... اسلاید دو خنده دار است... اسلاید دو خنده دار است... اسلاید دو خنده دار است... اسلاید دو خنده د', '1010'),
(16, 'users.png', 'تست عکس', 'تست سعید', '1111'),
(17, 'editworks.png', 'تست اول', 'اسلاید دو خنده دار است... اسلاید دو خنده دار است... اسلاید دو خنده دار است... اسلاید دو خنده دار است... اسلاید دو خنده دار است... اسلاید دو خنده دار است... اسلاید دو خنده دار است... اسلاید دو خنده دار است... اسلاید دو خنده دار است... اسلاید دو خنده د', '0110'),
(18, 'editslides.png', 'تست سابمیت', 'تست توضیحات عکس', '0111'),
(19, 'logo.png', 'تست اول', 'این تست جهت حل مشکلات ویرایش می باشد', '0111'),
(20, 'editnews.png', 'تست سابمیت', 'اسلاید دو خنده دار است... اسلاید دو خنده دار است... اسلاید دو خنده دار است... اسلاید دو خنده دار است... اسلاید دو خنده دار است... اسلاید دو خنده دار است... اسلاید دو خنده دار است... اسلاید دو خنده دار است... اسلاید دو خنده دار است... اسلاید دو خنده د', '1111'),
(21, 'users.png', 'تست اول سعید حاتمی', 'سعید حاتمی در حال تست است', '1101'),
(22, 'logo.png', 'تست دوم', 'تست دوم', '11111'),
(23, 'logo.png', 'تست سابمیت', 'تست دوم', '11111');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `family` varchar(50) NOT NULL,
  `image` varchar(60) NOT NULL,
  `email` varchar(30) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(35) NOT NULL,
  `type` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `family`, `image`, `email`, `username`, `password`, `type`) VALUES
(1, 'سعید', 'حاتمی', '../userspics/logo.png', 'hatami4560@yahoo.com', 'php', '5f93f983524def3dca464469d2cf9f3e', 0),
(2, 'علی رضا', 'صادقی نژاد', './newspics/editnews.png', 'r.sadeghi@yahoo.com', 'reza', '4510', 1),
(3, 'علی', 'قائمی', './newspics/works.png', 'ali.ghaemi@gmail.com', 'ghaemi', '827ccb0eea8a706c4c34a16891f84e7b', 0),
(4, 'آرش', 'خویتندار', './newspics/addworks.png', 'arash.kh@gmail.com', 'arash', '827ccb0eea8a706c4c34a16891f84e7b', 0);

-- --------------------------------------------------------

--
-- Table structure for table `usersnews`
--

CREATE TABLE IF NOT EXISTS `usersnews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(30) NOT NULL,
  `tel` varchar(12) NOT NULL,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `usersnews`
--

INSERT INTO `usersnews` (`id`, `email`, `tel`, `name`) VALUES
(2, 'hatami4510@gmail.com', '', 'سعید'),
(4, 'hatami4560@yahoo.com', '09151204395', 'سعید حاتمی'),
(5, 'hatami4560@yahoo.com', '09151204395', 'سعید حاتمی'),
(6, 'hatami4510@gmail.com', '09151204395', 'سعید حاتمی'),
(7, 'hatami4560@yahoo.com', '09151204395', 'سعید'),
(8, 'hatami4560@yahoo.com', '09151204395', 'سعید'),
(9, '', '', ''),
(10, 'hatami4560@yahoo.com', '09366903366', 'رضا وطن خواه'),
(11, 'amjadi.mojtaba@gmail.com', '09151091162', 'سعید حاتمی'),
(12, '', '', ''),
(13, '', '', ''),
(14, 'hatami4510@gmail.com', '09151091155', 'علی'),
(15, '', '', ''),
(16, 'hatami4560@yahoo.com', '09151204395', 'رضا وطن خواه');

-- --------------------------------------------------------

--
-- Table structure for table `works`
--

CREATE TABLE IF NOT EXISTS `works` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(50) NOT NULL,
  `image` varchar(60) NOT NULL,
  `body` text NOT NULL,
  `link` varchar(20) NOT NULL,
  `sdate` datetime NOT NULL,
  `fdate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=156 ;

--
-- Dumping data for table `works`
--

INSERT INTO `works` (`id`, `subject`, `image`, `body`, `link`, `sdate`, `fdate`) VALUES
(100, 'تست اول', './workspics/editslides.jpg', ' test 1', '', '2013-06-01 00:00:00', '2013-08-17 00:00:00'),
(151, 'تست سابمیت', './workspics/test.jpg', '<p>jbSJbjj</p>', '', '2013-06-26 19:07:42', '2013-07-03 19:07:42'),
(152, 'تست سابمیت12', './workspics/editslides.jpg', '<p>hk</p>', '', '2013-08-16 11:21:35', '2013-07-16 11:21:35'),
(153, 'تست ورک', './workspics/users.jpg', '<p>تسیت لینک کار</p>', 'www.mediateq.ir', '2013-07-23 11:13:56', '2013-08-22 11:13:56'),
(154, 'تست ورک', './workspics/users.jpg', '<p>تسیت لینک کار</p>', 'www.mediateq.ir', '2013-07-23 11:13:56', '2013-08-19 11:13:56'),
(155, 'تست سابمیت12', './workspics/test.jpg', '<p>hk</p>', '', '2013-08-16 11:21:35', '2013-07-30 11:21:35');

-- --------------------------------------------------------

--
-- Table structure for table `workstat`
--

CREATE TABLE IF NOT EXISTS `workstat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `workid` int(11) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `percent` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `workstat`
--

INSERT INTO `workstat` (`id`, `workid`, `subject`, `percent`) VALUES
(1, 100, 'graphic', 90),
(2, 100, 'php', 50),
(3, 100, 'CSS', 30),
(4, 100, 'HTML', 60);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
