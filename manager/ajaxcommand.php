<?php
	include_once("../config.php");
    include_once("../classes/database.php");	
	include_once("../classes/functions.php");		
	$db = Database::GetDatabase();

if ($_GET["items"]=="search")
{ 
      $table = $_GET["cat"];
      $field = "subject";
	  $rownum = 0;
	  $rows = $db->SelectAll(
				$table,
				"*",
				"{$field} LIKE '%{$_POST[findtxt]}%'",
				"id DESC",
				$_GET["pageNo"]*10,
				10);
	  if (!$rows)
	  {
	    echo "<div class='notification_error rtl'>عبارت مورد نظر یافت نشد</div>";
	  }
	  else
	  {
		 $success = count($rows);
		 foreach($rows as $key=>$val)
		 {
			 ++$rownum;
			 $row .= "<p class='srlink'>{$rownum}- <a target='_blank' href='news-fullpage{$val['id']}.html' class='srlink'>
					 {$val['subject']}</a></p>";
		}
		$result=<<<rt
		 <p class="sresult"><span>عبارت جستجو شده: </span>{$_POST["searchtxt"]}</p>
		 <p class="sresult"><span>تعداد نتایج یافت شده: </span>{$success}</p>
rt;
        echo $result;
       }
	   
}	   
	
if ($_GET["news"]=="reg")
{
	$fields = array("`email`","`tel`","`name`");		
	$values = array("'{$_POST[email]}'","'{$_POST[tel]}'","'{$_POST[name]}'");
	
	$name=$_POST['name'];
	$email=$_POST['email'];
    if( strlen($name)>=1 && checkEmail($email))
	{
		if ($db->InsertQuery('usersnews',$fields,$values)){
	    	echo "<div class='notification_ok rtl'>مشخصات شما با موفقیت ثبت شد.</div>";}
		else
		{
			echo "<div class='notification_error rtl'>ثبت مشخصات شما با مشکل مواجه شد! لطفا فیلدها را بررسی نمایید و مجددا تلاش کنید.</div>";
         }	
	} 
	else 
	{
		echo "<div class='notification_error rtl'>ثبت مشخصات شما با مشکل مواجه شد! لطفا فیلدها را بررسی نمایید و مجددا تلاش کنید.</div>";
	}
		 
}

if($_GET["contact"]=="reg"){

	$admin = 'info@mediateq.ir';

	$name    = $_POST['family'];
	$email   = $_POST['email'];
	$subject = $_POST['subject'];
	$text    = $_POST['message'];

	$message = "$text";

	if( strlen($name)>=1 && checkEmail($email) && strlen($text)>=1 ){
		if( @mail (
				$admin,
				"$subject",
				$message,
				"From:$name $email" )
		){
			echo "<div class='notification_ok rtl medium'>پیام شما با موفقیت ارسال شد.</div>";

		}else{
			echo "<div class='notification_error rtl'>خطا! پیام شما ارسال نشد لطفا مجددا تلاش نمایید.</div>";

		}
	}else{
		echo "<div class='notification_error rtl'>خطا! لطفا فیلدها را بررسی نمایید و مجددا ارسال کنید!</div>";
	}

}

 if (isset($_GET["sec"]))
{
	$category = $db->SelectAll("category","*","secid={$_GET[sec]}","id ASC");
	$cbcategory = DbSelectOptionTag("cbcat",$category,"catname",null,null,"select validate[required]");
	echo $cbcategory;
}

if ($_GET["cmd"]=="file")
{
	$pics = "";
	//echo "item is :",$_GET["item"];
    $dir = "../".$_GET["item"];
	$handle=opendir($dir);
    while ($file = readdir($handle))
    {        
         if (!preg_match("/^[.]/",$file,$out, PREG_OFFSET_CAPTURE))
         {             
			 if(is_file("{$dir}/".$file))
			 {                              
					  $dirname = "{$dir}/".basename($file);
					  $filename = basename($file);
					  $exe = substr($filename, strrpos($filename, '.') + 1);
					  $name = substr($filename, 0, strrpos($filename, '.'));
					  $allowedExts = array('jpg','jpeg','png','bmp','gif','pdf');

					if(in_array($exe, $allowedExts)){
                      $pics.=<<<cd
					    <li>
							<div class="pic">
								<a class="select" title="انتخاب عکس {$name}">
									<img src="{$dirname}" alt="{$name}" />
									<div class="overlay"></div>
								</a>
							</div>
							<h2><!-- <span class="highlight">نام فایل: </span> --><span class="filename">{$name}</span></h2>
						</li>	   
cd;
					}
			  }
        }
    }
	closedir($handle);
if ($_GET["item"]=="planfiles")
{
$html.=<<<cd
	<script type='text/javascript'>
		$(document).ready(function(){
			$('.cat-tabs-wrap-plan a.select').click(function(){
	                var srcimg= $(this).children('img').attr('src');
	                $('#planbrowser img#planprevimage').attr('src',srcimg);
	                
	                var filename= $(this).parent().parent().children('h2').children('span.filename').text();
	                $('#planbrowser #plannamepreview').html(filename);

	               var size= getImgSize(srcimg);
	               $('#planbrowser #plansizepreview').html(size);

	               var ext = $(this).children('img').attr('src').split('.').pop().toLowerCase();
	               $('#planbrowser #plantypepreview').html(ext);

	               $('#selectpl').click(function(){
	                    var value= srcimg;
	                    $('#selectplan').val(value);
	                    value= value.split('/').reverse()[0];
	                    $('#showplanadd').val(value);
	               });
	            });
		});
	</script>
cd;
}
else
if ($_GET["item"]=="pricefiles")
{
$html.=<<<cd
	<script type='text/javascript'>
		$(document).ready(function(){
			$('.cat-tabs-wrap-price a.select').click(function(){
                var srcimg= $(this).children('img').attr('src');
                $('#pricebrowser img#priceprevimage').attr('src',srcimg);
                
                var filename= $(this).parent().parent().children('h2').children('span.filename').text();
                $('#pricebrowser #pricenamepreview').html(filename);

               var size= getImgSize(srcimg);
               $('#pricebrowser #pricesizepreview').html(size);

               var ext = $(this).children('img').attr('src').split('.').pop().toLowerCase();
               $('#pricebrowser #pricetypepreview').html(ext);

               $('#selectpr').click(function(){
                    var value= srcimg;
                    $('#selectprice').val(value);
                    value= value.split('/').reverse()[0];
                    $('#showpriceadd').val(value);
               });
            });
		});
	</script>
cd;
}
else
{
$html.=<<<cd
	<script type='text/javascript'>
		$(document).ready(function(){
			$('.cat-tabs-wrap-pic a.select').click(function(){
	                var srcimg= $(this).children('img').attr('src');
	                $('#filesbrowser img#previmage').attr('src',srcimg);
	                
	                var filename= $(this).parent().parent().children('h2').children('span.filename').text();
	                $('#filesbrowser #namepreview').html(filename);

	               var size= getImgSize(srcimg);
	               $('#filesbrowser #sizepreview').html(size);

	               var ext = $(this).children('img').attr('src').split('.').pop().toLowerCase();
	               $('#filesbrowser #typepreview').html(ext);

	               $('#filesbrowser #select').click(function(){
	                    var value= srcimg;
	                    $('#selectpic').val(value);
	                    value= value.split('/').reverse()[0];
	                    $('#showadd').val(value);
	               });
	            });
		});
	</script>
cd;
}
	echo $pics.$html;
	 
}
if ($_GET["cmd"]=="workpics")
{
	$pics = "";	
	$files = array();
    $dir = "../workspics";
	$checkboxs = $db->SelectAll("workpics","*","wid = '{$_GET[id]}'");
	//echo $db->cmd;
	//echo "test is test for test";
	if (!empty($checkboxs))
	{
	//echo "<br/>not empty<br/>";
		foreach($checkboxs as $key=>$val) 
		{		    
			$files[] = mb_substr($val["image"],12,mb_strlen($val["image"]),"UTF-8");	
		//	var_dump($files);
		}	
	}	
	$handle=opendir($dir);
    while ($file = readdir($handle))
    {        
         if (!preg_match("/^[.]/",$file,$out, PREG_OFFSET_CAPTURE))
         {             
			 if(is_file("{$dir}/".$file))
			 {                              
					  $dirname = "{$dir}/".basename($file);
					  $filename = basename($file);
					  $exe = substr($filename, strrpos($filename, '.') + 1);
					  $name = substr($filename, 0, strrpos($filename, '.'));
					  $allowedExts = array('jpg','jpeg','png','bmp','gif');

					if(in_array($exe, $allowedExts)){
                      $pics.=<<<cd
					    <li>
							<div class="pic">
							 
								<a class="select" title="انتخاب عکس {$name}">								
									<img src="{$dirname}" alt="{$name}" />
									<div class="overlay"></div>
								</a>
							</div>
cd;
if(in_array($filename, $files))
{
$pics.=<<<cd
			<input type="checkbox" name="picslist[]" value="{$filename}" checked/>
			<h2><!-- <span class="highlight">نام فایل: </span> --><span class="filename">{$name}</span></h2>
						</li>
cd;
}
else
{
$pics.=<<<cd
            <input type="checkbox" name="picslist[]" value="{$name}.{$exe}"/>
							<h2><!-- <span class="highlight">نام فایل: </span> --><span class="filename">{$name}</span></h2>
						</li>	   
cd;
}
					}
			  }
        }
    }
	closedir($handle);
	
$html.=<<<cd
  <form  method="post" action="">
   {$pics}
   <div class="badboy"></div>
   <div>
	 <input type="submit" name="send" class="submit" value="ثبت عکس ها" />
	 <input type="hidden" name="mark" value="addmorepic" />
   </div>
  </form>
	<script type='text/javascript'>
		$(document).ready(function(){
			$('.cat-tabs-wrap2 a.select').click(function(){
	                var srcimg= $(this).children('img').attr('src');
	                $('img#previmage').attr('src',srcimg);
	                
	                var filename= $(this).parent().parent().children('h2').children('span.filename').text();
	                $('#namepreview').html(filename);

	               var size= getImgSize(srcimg);
	               $('#sizepreview').html(size);

	               var ext = $(this).children('img').attr('src').split('.').pop().toLowerCase();
	               $('#typepreview').html(ext);

	               $('#select').click(function(){
	                    var value= srcimg;
	                    $('#selectpic').val(value);
	                    value= value.split('/').reverse()[0];
	                    $('#showadd').val(value);
	               });
	            });
		});
	</script>
cd;
	echo $html;
	 
}
?>