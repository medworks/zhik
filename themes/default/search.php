<?php
   include_once("./config.php");
   include_once("./classes/database.php");
   include_once("./classes/messages.php");
   
   $table = "";
   $field = "";   
   $db = Database::GetDatabase();
   if ($_POST["mark"]=="search")
   {
      $table = "news";
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
				$cat = "اخبار";
				$success = count($rows);
				foreach($rows as $key=>$val)
				{
				 ++$rownum;
				 $row .= "<p class='srlink'>{$rownum}- <a target='_blank' href='news-fullpage{$val['id']}.html' class='srlink'>
					 {$val['subject']}</a></p>";
				}
				$result=<<<rt
			     <p class="sresult"><span>نتایج یافت شده در بخش: </span>{$cat}</p>
			     <p class="sresult"><span>عبارت جستجو شده: </span>{$_POST["searchtxt"]}</p>
				 <p class="sresult"><span>تعداد نتایج یافت شده: </span>{$success}</p>
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
					$cat = "کارهای ما";					
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
			     <p class="sresult"><span>نتایج یافت شده در بخش: </span>{$cat}</p>
			     <p class="sresult"><span>عبارت جستجو شده: </span>{$_POST["searchtxt"]}</p>
				 <p class="sresult"><span>تعداد نتایج یافت شده: </span>{$success}<p>
				 {$row}				 
rt;
	}
		
$msgs = GetMessage($_GET['msg']);
$html=<<<cd
	<div class='content'>
		<div class='search main-box'>
			<h2>جستجو</h2>
			<div class='line'></div>
			<div class='badboy'></div>
			<div class='contact box-right'>
			<div class="mes" id="message">{$msgs}</div>
			<div id="result">{$result} </div>
				<form action="" id="searchfrm" method="post">
				   <p>
			         <label>عبارت مورد نظر </label>
			       </p>
			       <input type="text" name="searchtxt" class="subject" id="searchtxt" value="{$_POST[searchtxt]}"/>
				   <p>
			         <label>جستجو در </label>
			       </p>
			        <label class="right">اخبار</label>
			        	<input type="radio" name="category" class="subject" id="category" value="news" checked/>
			        <label class="right">کارهای ما</label>
			        	<input type="radio" name="category" class="subject" id="category" value="works" />
			        <label class="right">مطالب خواندنی</label>
			        	<input type="radio" name="category" class="subject" id="category"
						value="articles" />
			        <div class="badboy"></div>
			       <p>
			         <label>قسمت </label>
			       </p>    
			       <label class="right">عنوان</label>
			        	<input type="radio" name="subcat" class="subject" id="category" value="subject" checked/>
			        <label class="right">توضیحات</label>
			        	<input type="radio" name="subcat" class="subject" id="category"
						value="body" />
			       <div class="badboy"></div>
			       <p>
					  <input type="submit" id="submit" class="submit" value="جستجو" />
			          <input type="hidden" name="mark" value="find" />
			       </p>
				</form>

			</div>
		</div>
	</div>
cd;
return $html;
?>