<?php
  include_once("./config.php");
  include_once("./classes/database.php");
  include_once("./lib/persiandate.php");
  include_once("./classes/functions.php");
  $db = Database::GetDatabase();
  $pageNo = ($_GET["pid"]) ? $_GET["pid"] : 1;
  $maxItemsInPage = GetSettingValue('Max_Post_Number',0);
  $from = ($pageNo - 1) * $maxItemsInPage;
  $count = $maxItemsInPage;
  $works = $db->SelectAll("works","*",null,"fdate DESC",$from,$count);  
  $itemsCount = $db->CountAll("works");//count($works);
  $html = "<div class='content'>
              <div class='main-box'>
                <h2>کارهای ما ";
                if($_GET["pid"]>1){
                  $html.="<span>(صفحه {$_GET[pid]})</span>";
                }

  $html.="</h2><div class='line'></div>
  <div class='badboy'></div>";

  foreach($works as $key => $post){
   $sdate = ToJalali($post["sdate"]," l d F  Y ");
   $fdate = ToJalali($post["fdate"]," l d F  Y ");
   $body= $post["body"];
   $body= strip_tags($body);
   $body= (mb_strlen($body)>500) ? mb_substr($body,0,500,"UTF-8")."..." : $body;
   //<a href="?item=fullworks&act=do&wid={$post[id]}" title='{$post[subject]}'><p>{$post[subject]}</p></a>
   $html.=<<<cd
		<div class='box-right'> 
		<div class='title'>
			<a href="work-fullpage{$post[id]}.html" title='{$post[subject]}'><p>{$post[subject]}</p></a>
		</div>
		<div class='time'>
        <p><span>تاریخ شروع:</span> $sdate </p>
        <p><span>تاریخ پایان:</span> $fdate </p>  
		</div>
		<div class='badboy'></div>
		<div class="pic">
        <a href="work-fullpage{$post[id]}.html" title='{$post[subject]}'><img src='{$post[image]}' alt='{$post[subject]}'></a>
		</div>
  		<div class="detail">
  			<p>{$body}</p>
      </div>
cd;
      if(mb_strlen($body)>500){
      $html.=<<<cd
      <a href="work-fullpage{$post[id]}.html" title="توضیحات بیشتر" class="button">ادامه مطلب</a>
cd;
      }
  		$html.=<<<cd
		<div class='badboy'></div>
		</div>
cd;
  }

$html.=" </div> ";  
$linkFormat = 'works-page'.$pid='%PN%'.'.html';;
$maxPageNumberAtTime = GetSettingValue('Max_Page_Number',0);
$pageNos = Pagination($itemsCount, $maxItemsInPage, $pageNo, $maxPageNumberAtTime, $linkFormat);
$html .= '<center>' . $pageNos . '</center> </div>';

return $html;
?>