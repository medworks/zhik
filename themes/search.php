<?php
   include_once("./config.php");
   include_once("./classes/database.php");
   include_once("./classes/messages.php");
   
   $table = "";
   $field = "";   
   $db = Database::GetDatabase();
   if ($_POST["mark"]=="search")
   {
      $table = "works";
      $field = "subject";
	  $rownum = 0;
	  $rows = $db->SelectAll(
				$table,
				"*",
				"{$field} LIKE '%{$_POST[searchtxt]}%'",
				"id DESC",
				$_GET["pageNo"]*10,
				10);
			/* if (!$rows) 
			{							
				//header("Location:?item=search&act=do&msg=6");
				header("Location:search.html");
				
			}
			else
			{
			    $cat = "اخبار";
				$success = count($rows);
				foreach($rows as $key=>$val)
				{
				 ++$rownum;
				 $row .= "<p class='srlink'>{$rownum}- <a target='_blank' href='?item=fullnews&act=do&wid={$val['id']}' class='srlink'>
					 {$val['subject']}</a></p>";
				}
				$result=<<<rt
			     <p class="sresult"><span>نتایج یافت شده در بخش: </span>{$cat}</p>
			     <p class="sresult"><span>عبارت جستجو شده: </span>{$_POST["searchtxt"]}</p>
				 <p class="sresult"><span>تعداد نتایج یافت شده: </span>{$success}</p>
				 {$row}				 
rt;
			} */
				$cat = "پروژه ها";
				$success = count($rows);
				foreach($rows as $key=>$val)
				{
				 ++$rownum;
				 $row .= "<p class='srlink'>{$rownum}- <a target='_blank' href='works-fullpage{$val['id']}.html' class='srlink'>
					 {$val['subject']}</a></p>";
				}
				$result=<<<rt
			     <p class="sresult"><span class="font-siz">نتایج یافت شده در بخش: </span>{$cat}</p>
			     <p class="sresult"><span class="font-siz">عبارت جستجو شده: </span>{$_POST["searchtxt"]}</p>
				 <p class="sresult"><span class="font-siz">تعداد نتایج یافت شده: </span>{$success}</p>
				 {$row}				 
rt;
   }
   if ($_POST["mark"]=="find")
  {
    $table = $_POST["category"];
    $field = $_POST["subcat"];
	$rows = $db->SelectAll(
				$table,
				"*",
				"{$field} LIKE '%{$_POST[searchtxt]}%'",
				"id DESC",
				$_GET["pageNo"]*10,
				10);
			/* if (!$rows) 
			{							
				header("Location:?item=search&act=do&msg=6");
			}
			else
			{
               //header("Location:?item=search&act=do");			
			   $success = count($rows);
			   $cat = "";
			   $rownum = 0;
			   switch($_POST["category"])
			   {
					case 'news':
					$cat = "اخبار";
					
					  foreach($rows as $key=>$val)
					  {
					     ++$rownum;
						 $row .= "<p class='srlink'>{$rownum}- <a target='_blank' href='?item=fullnews&act=do&wid={$val['id']}' class='srlink'>
						 {$val['subject']}</a></p>";
			          }
					break;
					case 'works':
					$cat = "کارهای ما";					
					  foreach($rows as $key=>$val)
					  {
					     ++$rownum;
						 $row .= "<p class='srlink'>{$rownum}- <a target='_blank' href='?item=fullworks&act=do&wid={$val['id']}' class='srlink'>
						 {$val['subject']}</a></p>";
			          }
					break;
					case 'articles':
					$cat = "مطالب خواندنی";					
					  foreach($rows as $key=>$val)
					  {
					     ++$rownum;
						 $row .= "<p class='srlink'>{$rownum}- <a target='_blank' href='?item=fullarticles&act=do&wid={$val['id']}' class='srlink'>
						 {$val['subject']}</a></p>";
			          }
					break;
			   } */
			   
			   $success = count($rows);
			   $cat = "";
			   $rownum = 0;
			   switch($_POST["category"])
			   {
					case 'news':
					$cat = "اخبار";
					
					  foreach($rows as $key=>$val)
					  {
					     ++$rownum;
						 $row .= "<p class='srlink'>{$rownum}- <a target='_blank' href='news-fullpage{$val['id']}.html' class='srlink'>
						 {$val['subject']}</a></p>";
			          }
					break;
					case 'works':
					$cat = "پروژه ها";					
					  foreach($rows as $key=>$val)
					  {
					     ++$rownum;
						 $row .= "<p class='srlink'>{$rownum}- <a target='_blank' href='work-fullpage{$val['id']}.html' class='srlink'>
						 {$val['subject']}</a></p>";
			          }
					break;
					case 'articles':
					$cat = "مطالب خواندنی";					
					  foreach($rows as $key=>$val)
					  {
					     ++$rownum;
						 $row .= "<p class='srlink'>{$rownum}- <a target='_blank' href='article-fullpage{$val['id']}.html' class='srlink'>
						 {$val['subject']}</a></p>";
			          }
					break;
			   } 
			   
			   $result=<<<rt
			     <p class="sresult"><span class="font-siz">نتایج یافت شده در بخش: </span>{$cat}</p>
			     <p class="sresult"><span class="font-siz">عبارت جستجو شده: </span>{$_POST["searchtxt"]}</p>
				 <p class="sresult"><span class="font-siz">تعداد نتایج یافت شده: </span>{$success}<p>
				 {$row}				 
rt;
	}
		
$msgs = GetMessage($_GET['msg']);
$html=<<<cd
	<div id="header-image-container">
        <div id="header-image">
            <img src="themes/images/404-header.jpg" alt="News page" class="stretch-image">
        </div>
    </div>
    <div id="content-container" class="content-width">
    	<div class="row">
            <div id="breadcrumbs-wrapper" class="large-12 columns for-nested">
                <span>مسیر شما:</span>
                <ul class="breadcrumbs">
                    <li class="current">
                        <a>جستجو در ژیک</a>
                    </li>
                    <li>
                        <a href="./">صفحه اصلی</a>
                    </li>
                </ul>
            </div>
        </div>
        <div id="intro" class="not-homepage row">
            <div class="large-9 large-centered columns">
                <h1>جستجو در <strong>ژیک</strong></h1>
            </div>
        </div>
        <div id="portfolio-item-info-wrapper" class="row search">
			<form action="" id="searchfrm" method="post">
	            <div id="portfolio-item-info" class="large-3 columns no-padding">
	                <ul id="portfolio-item-meta">
	                	<li>
	                		<p>
					        	<label class="mar-bot">عبارت مورد نظر </label>
					        </p>
					        <input type="text" name="searchtxt" class="subject" id="searchtxt" value="{$_POST[searchtxt]}"/>
	                	</li>
	                    <li>
	                    	<p>
					        	<label class="mar-bot">جستجو در: </label>
					        </p>
					        <p>
						        <input type="radio" name="category" class="subject right mar-lef" id="category" value="news" checked/>
						        <label>اخبار</label>
					        </p>
					        <p>
						        <input type="radio" name="category" class="right subject mar-lef" id="category" value="works" />
						        <label>کارهای ما</label>
					        </p>
					        <p>
						        <input type="radio" name="category" class="subject right mar-lef" id="category" value="articles" />
						        <label>مطالب خواندنی</label>
					        </p>
	                    </li>
	                    <li>
	                    	<p>
					        	<label class="mar-bot">قسمت: </label>
					        </p>
					        <p>  
					        	<input type="radio" name="subcat" class="subject right mar-lef" id="category" value="subject" checked/>
						        <label>عنوان</label>
				        	</p>
					        <p>
						        <input type="radio" name="subcat" class="subject right mar-lef" id="category" value="body" />
						        <label>توضیحات</label>
					        </p>
	                    </li>              
	                </ul>
	            </div>
	            <div class="large-9 columns">
			        {$result}
	            </div>
				<input type="hidden" name="mark" value="find" />
	        </form>
        </div>
	</div>
cd;
return $html;
?>