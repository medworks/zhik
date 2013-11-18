<?php
    include_once("../config.php");
    include_once("../classes/database.php");
	include_once("../classes/messages.php");
	include_once("../classes/session.php");	
	include_once("../classes/functions.php");
	include_once("../lib/persiandate.php");	
	include_once("../classes/login.php");
	$login = Login::GetLogin();
    if (!$login->IsLogged())
	 {
		header("Location: ../index.php");
		die(); // solve a security bug
	 }
	$db = Database::GetDatabase();
	$overall_error = false;
	if ($_GET['item']!="worksmgr")	exit();
	if (isset($_POST["mark"]) and $_POST["mark"]!="srhnews")
	{
	   date_default_timezone_set('Asia/Tehran');
	   list($hour,$minute,$second) = explode(':', Date('H:i:s'));
	   list($year,$month,$day) = explode("-", trim($_POST["sdate"]));
	   list($gyear,$gmonth,$gday) = jalali_to_gregorian($year,$month,$day);
	   $sdatetime = Date("Y-m-d H:i:s",mktime($hour, $minute, $second, $gmonth, $gday, $gyear));
	   list($year,$month,$day) = explode("-", trim($_POST["fdate"]));
	   list($gyear,$gmonth,$gday) = jalali_to_gregorian($year,$month,$day);
	   $fdatetime = Date("Y-m-d H:i:s",mktime($hour, $minute, $second, $gmonth, $gday, $gyear));
				  
	    if(empty($_POST["selectpic"])&& $_POST["mark"]!="addmorepic")
		{ 
			//$msgs = $msg->ShowError("لط??ا ??ایل عکس را انتخاب کنید");
			header('location:?item=worksmgr&act=new&msg=4');
			//$_GET["item"] = "worksmgr";
			//$_GET["act"] = "new";
			//$_GET["msg"] = 4;
			$overall_error = true;
			//exit();
		}
		else
		{			
			if (empty($_POST['detail'])&& $_POST["mark"]!="addmorepic")
			{
			   //header('location:?item=worksmgr&act=new&msg=5');
				$_GET["item"] = "worksmgr";
				$_GET["act"] = "new";
				$_GET["msg"] = 5;
			   $overall_error = true;
			}			
		}
	}	
    if (!$overall_error && $_POST["mark"]=="saveworks")
	{			   
		$fields = array("`subject`","`image`","`body`","`link`","`sdate`","`fdate`","`catid`","`plan`","`pricetable`");
		$_POST["detail"] = addslashes($_POST["detail"]);
		$values = array("'{$_POST[subject]}'","'{$_POST[selectpic]}'","'{$_POST[detail]}'","'{$_POST[link]}'","'{$sdatetime}'","'{$fdatetime}'","'{$_POST[cbcat]}'","'{$_POST[selectplan]}'","'{$_POST[selectprice]}'");
		if (!$db->InsertQuery('works',$fields,$values)) 
		{
			//$msgs = $msg->ShowError("ثبت اطلاعات با مشکل مواجه شد");
			header('location:?item=worksmgr&act=new&msg=2');
			//exit();
			//$_GET["item"] = "worksmgr";
			//$_GET["act"] = "new";
			//$_GET["msg"] = 2;
		} 	
		else 
		{  													
			header('location:?item=worksmgr&act=new&msg=1');
	    }	  				 
	 }
	else
	if (!$overall_error && $_POST["mark"]=="editworks")
	{		
	    $_POST["detail"] = addslashes($_POST["detail"]);
		$values = array("`subject`"=>"'{$_POST[subject]}'",
		                 "`image`"=>"'{$_POST[selectpic]}'",
						 "`body`"=>"'{$_POST[detail]}'",
						 "`link`"=>"'{$_POST[link]}'",
						 "`sdate`"=>"'{$sdatetime}'",
						 "`fdate`"=>"'{$fdatetime}'",
						 "`catid`"=>"'{$_POST[cbcat]}'",
						 "`plan`"=>"'{$_POST[selectplan]}'",
						 "`pricetable`"=>"'{$_POST[selectprice]}'");
        $db->UpdateQuery("works",$values,array("id='{$_GET[wid]}'"));		
		header('location:?item=worksmgr&act=mgr');
		//$_GET["item"] = "worksmgr";
		//$_GET["act"] = "mgr";			
	}
	if (!$overall_error && $_POST["mark"]=="addmorepic")
	{			
        $pics = $db->SelectAll("workpics","*","wid = '{$_GET[wid]}'");	
		$img = array();
		$reqimg = array();
		$dif = array();
		if (empty($pics))
		{
			$fields = array("`wid`","`image`");
			if(!empty($_POST['picslist'])) 
			{
			  foreach($_POST['picslist'] as $key=>$val)
			  {		    
				$values = array("'{$_GET[wid]}'","'./workspics/{$val}'");
				$db->InsertQuery('workpics',$fields,$values);		
			  }	
			 }
		}
		else
		{
			foreach($pics as $key=>$val) $img[] = $val["image"];
			foreach($_POST['picslist'] as $key=>$val) $reqimg[] = "./workspics/{$val}";
			$dif = array_diff($img, $reqimg);
			foreach($dif as $key=>$val)
			{
				$db->Delete("workpics"," image","{$val}");				
			}
			$dif = array_diff($reqimg, $img);
			$fields = array("`wid`","`image`");
			foreach($dif as $key=>$val)
			{			
			    $values = array("'{$_GET[wid]}'","'{$val}'");
				$db->InsertQuery('workpics',$fields,$values);
			}
		}
		header('location:?item=worksmgr&act=mgr');		 
	 }
	if ($overall_error)
	{
		$row = array("subject"=>$_POST['subject'],
					 "image"=>$_POST['image'],
					 "body"=>$_POST['detail'],
					 "link"=>$_POST['link'],
					 "sdate"=>$_POST['sdate'],
					 "fdate"=>$_POST['fdate'],
					  "cat"=>$_POST['cbcat'],
					  "plan"=>$_POST['plan'],
					  "pricetable"=>$_POST['pricetable']);
	}
	if ($_GET['act']=="new")
	{
		$editorinsert = "
			<p>
				<input type='submit' id='submit' value='ذخیره' class='submit' />	 
				<input type='hidden' name='mark' value='saveworks' />";
	}
	if ($_GET['act']=="edit")
	{
		$row=$db->Select("works","*","id='{$_GET["wid"]}'",NULL);
		$row['sdate'] = ToJalali($row["sdate"]);
		$row['fdate'] = ToJalali($row["fdate"]);
		$editorinsert = "
		<p>
			 <input type='submit' id='submit' value='ویرایش' class='submit' />	 
			 <input type='hidden' name='mark' value='editworks' />";
	}
	if ($_GET['act']=="del")
	{
		$db->Delete("works"," id",$_GET["wid"]);
		if ($db->CountAll("works")%10==0) $_GET["pageNo"]-=1;		
		header("location:?item=worksmgr&act=mgr&pageNo={$_GET[pageNo]}");
	}	
if ($_GET['act']=="do")
{
	$html=<<<ht
		<div class="title">
	      <ul>
	        <li><a href="adminpanel.php?item=dashboard&act=do">پیشخوان</a></li>
	        <li><span>مدیریت کار ها</span></li>
	      </ul>
	      <div class="badboy"></div>
	    </div>
		<div class="sub-menu" id="mainnav">
			<ul>
			  <li>		  
				<a href="?item=worksmgr&act=new">درج پروژه جدید
					<span class="add-works"></span>
				</a>
			  </li>			  
			  <li>
				<a href="?item=worksmgr&act=mgr" id="news" name="news">حذف / ویرایش پروژه ها
					<span class="edit-works"></span>
				</a>
			  </li>
			 </ul>
			 <div class="badboy"></div>
		</div>		 
ht;
}else	
if ($_GET['act']=="new" or $_GET['act']=="edit")
{
	$msgs = GetMessage($_GET['msg']);
	$sections = $db->SelectAll("section","*",null,"id ASC");
	if ($_GET['act']=="edit") 
	{   
		$category = $db->SelectAll("category","*",null,"id ASC");
		$secid = $db ->Select("category","secid","ID = '{$row[catid]}'");
		$secid = $secid[0];
		$cbsection = DbSelectOptionTag("cbsec",$sections,"secname","{$secid}",null,"select validate[required]");
		$cbcategory = DbSelectOptionTag("cbcat",$category,"catname","{$row[catid]}",null,"select validate[required]");
		
	}
	else
	{
	  $cbsection = DbSelectOptionTag("cbsec",$sections,"secname",null,null,"select validate[required]");
	  $cbcategory = null;
	} 
	$html=<<<cd
	<script type='text/javascript'>
		$(document).ready(function(){		
			$("#frmworksmgr").validationEngine();
			$("#cbsec").change(function(){
				$.get('ajaxcommand.php?sec='+$(this).val(), function(data) {
						$('#catgory').html(data);
				});
			});			
		});	   
	</script>	     
	  <div class="title">
		  <ul>
			 <li><a href="adminpanel.php?item=dashboard&act=do">پیشخوان</a></li>
			 <li><span>مدیریت کارها</span></li>
		  </ul>
		  <div class="badboy"></div>
	  </div>  
	  <div class="content">
		<form name="frmworksmgr" id= "frmworksmgr" class="worksmgr" action="" method="post" enctype="multipart/form-data" >
		  <div class="mes" id="message">{$msgs}</div>
		   <p class="note">پر کردن موارد مشخص شده با * الزامی می باشد</p>
		   <p>
         <label for="cbsection">سر گروه </label>
         <span>*</span>
       </p>    
	   {$cbsection}   
	   <div id="catgory">
		   {$cbcategory}
	   </div>
       <div class="badboy"></div>
		   <p>
			 <label for="subject">عنوان </label>
			 <span>*</span>
		   </p>  	 
		   <input type="text" name="subject" class="validate[required] subject" id="subject" value="{$row[subject]}" />
		   <p>
			 <label for="pic">عکس پیش فرض</label>
			 <span>*</span>
		   </p>
		   <p>
		   		<input type="text" name="selectpic" class="selectpic" id="selectpic" value='{$row[image]}' />
		   		<input type="text" class="validate[required] showadd" id="showadd" value='{$row[image]}' />
		   		<a class="filesbrowserbtn" id="filesbrowserbtn" name="worksmgr" title="گالری تصاویر">گالری تصاویر</a>
		   		<a class="selectbuttton" id="selectbuttton" title="انتخاب">انتخاب</a>
		   </p>
		   <div class="badboy"></div>
		   <div id="filesbrowser"></div>		   
		   <div class="badboy"></div>
		   <p>
			 <label for="detail">توضیحات </label>
		   </p>
		   <textarea cols="50" rows="10" name="detail" class="detail" id="detail">{$row[body]}</textarea>
		   <p>
			 <label for="pic">فایل پلان</label>
			 <span>*</span>
		   </p>
		   <p>
		   		<input type="text" name="selectplan" class="selectpic" id="selectplan" value='{$row[plan]}' />
		   		<input type="text" class="validate[required] showadd" id="showplanadd" value='{$row[plan]}' />
		   		<a class="filebrowserbtn" id="planbrowserbtn" name="worksmgr" title="گالری تصاویر">گالری تصاویر</a>
		   		<a class="selectbuttton" id="selectplanbuttton" title="انتخاب">انتخاب</a>
		   </p>
		   <div class="badboy"></div>
		   <div id="planbrowser"></div>		   
		   <div class="badboy"></div>
		   <p>
			 <label for="pic">فایل جدول قیمت</label>
			 <span>*</span>
		   </p>
		   <p>
		   		<input type="text" name="selectprice" class="selectpic" id="selectprice" value='{$row[pricetable]}' />
		   		<input type="text" class="validate[required] showadd" id="showpriceadd" value='{$row[pricetable]}' />
		   		<a class="filebrowserbtn" id="pricebrowserbtn" name="worksmgr" title="گالری تصاویر">گالری تصاویر</a>
		   		<a class="selectbuttton" id="selectpricebuttton" title="انتخاب">انتخاب</a>
		   </p>
		   <div class="badboy"></div>
		   <div id="pricebrowser"></div>
		   <div class="badboy"></div>
		   <p>
			<label for="sdate">تاریخ شروع </label>
			<span>*</span><br /><br />
			<input type="text" name="sdate" class="validate[required] sdate" id="date_input_1" value="{$row[sdate]}" />
			<img src="./images/cal.png" id="date_btn_1" alt="cal-pic">
			 <script type="text/javascript">
			  Calendar.setup({
				inputField  : "date_input_1",   // id of the input field
				button      : "date_btn_1",   // trigger for the calendar (button ID)
					ifFormat    : "%Y-%m-%d",       // format of the input field
					showsTime   : false,
					dateType  : 'jalali',
					showOthers  : true,
					langNumbers : true,
					weekNumbers : true
			  });
			</script>
		   </p>
		   <p>
			 <label for="fdate">تاریخ پایان </label>
			 <span>*</span><br /><br />
			 <input type="text" name="fdate" class="validate[required] fdate" id="date_input_2" value="{$row[fdate]}"/>
			 <img src="./images/cal.png" id="date_btn_2" alt="cal-pic">
			 <script type="text/javascript">
			  Calendar.setup({
				inputField  : "date_input_2",   // id of the input field
				button      : "date_btn_2",   // trigger for the calendar (button ID)
					ifFormat    : "%Y-%m-%d",       // format of the input field
					showsTime   : false,
					dateType  : 'jalali',
					showOthers  : true,
					langNumbers : true,
					weekNumbers : true,
			  });
			</script>
		   </p>	  		   
		   {$editorinsert}
			 <input type="reset" value="پاک کردن" class="reset" /> 	 	 
		   </p>
		</form>
		<div class="badboy"></div>
	  </div> 
cd;
  }
else
if ($_GET['act']=="pic")
{
$msgs = GetMessage($_GET['msg']);
$html=<<<cd
<script type='text/javascript'>
	$(document).ready(function(){		  	 		
		$("#tab1").click(function(){
		$.get('ajaxcommand.php?cmd=workpics&id={$_GET[wid]}', function(data) {
						$('#catab1 ul').html(data);
				});			
			return false;
		});		
		$("#tab1").click();
	});
</script>	
<div class="mes" id="message">{$msgs}</div>   
	<div class="picmanager">		
		<div class="files right add-pics">
			<div class="pics cat-box-content cat-box tab" id="cats-tabs-box">
				<div class="cat-tabs-header" id="cat-tabs-header">
					<ul>						
						<li id="tab1" class="active"><a href="#catab1">پوشه کارها</a></li>						
					</ul>
				</div>				
				<div class="cat-tabs-wrap-pic" id="catab1">
					<ul>
					
					</ul>
					<div class="badboy"></div>
				</div>				
			</div>
		<div class="badboy"></div>
	</div>
</div>
cd;
}
else
if ($_GET['act']=="mgr")
{
	if ($_POST["mark"]=="srhnews")
	{	 		
	    if ($_POST["cbsearch"]=="sdate" or $_POST["cbsearch"]=="fdate")
		{
		   date_default_timezone_set('Asia/Tehran');		   
		   list($year,$month,$day) = explode("/", trim($_POST["txtsrh"]));		
		   list($gyear,$gmonth,$gday) = jalali_to_gregorian($year,$month,$day);		
		   $_POST["txtsrh"] = Date("Y-m-d",mktime(0, 0, 0, $gmonth, $gday, $gyear));
		}
		$rows = $db->SelectAll(
				"works",
				"*",
				"{$_POST[cbsearch]} LIKE '%{$_POST[txtsrh]}%'",
				"sdate DESC,fdate DESC",
				$_GET["pageNo"]*10,
				10);
			if (!$rows) 
			{					
				//$_GET['item'] = "worksmgr";
				//$_GET['act'] = "mgr";
				//$_GET['msg'] = 6;				
				header("Location:?item=worksmgr&act=mgr&msg=6");
			}
		
	}
	else
	{	
		$rows = $db->SelectAll(
				"works",
				"*",
				null,
				"sdate DESC,fdate DESC",
				$_GET["pageNo"]*10,
				10);
    }
                $rowsClass = array();
                $colsClass = array();
                $rowCount =($_GET["rec"]=="all" or $_POST["mark"]!="srhnews" )?$db->CountAll("works"):Count($rows);
                for($i = 0; $i < Count($rows); $i++)
                {						
		        $rows[$i]["subject"] =(mb_strlen($rows[$i]["subject"])>20)?mb_substr($rows[$i]["subject"],0,20,"UTF-8")."...":$rows[$i]["subject"];
                $rows[$i]["body"] =(mb_strlen($rows[$i]["body"])>30)?
                mb_substr(html_entity_decode(strip_tags($rows[$i]["body"]), ENT_QUOTES, "UTF-8"), 0, 30,"UTF-8") . "..." :
                html_entity_decode(strip_tags($rows[$i]["body"]), ENT_QUOTES, "UTF-8");               
                $rows[$i]["sdate"] =ToJalali($rows[$i]["sdate"]," l d F  Y ");
				$rows[$i]["fdate"] =ToJalali($rows[$i]["fdate"]," l d F  Y ");
				$rows[$i]["image"] ="<img src='{$rows[$i][image]}' alt='{$rows[$i][subject]}' width='40px' height='40px' />";                
				if ($i % 2==0)
				 {
						$rowsClass[] = "datagridevenrow";
				 }
				else
				{
						$rowsClass[] = "datagridoddrow";
				}
				$rows[$i]["username"]=GetUserName($rows[$i]["userid"]); 
				$rows[$i]["catid"] = GetCategoryName($rows[$i]["catid"]);
				$rows[$i]["addpic"] = "<a href='?item=worksmgr&act=pic&wid={$rows[$i]["id"]}' class='add-pic'" .
						"style='text-decoration:none;'></a>";								
				$rows[$i]["edit"] = "<a href='?item=worksmgr&act=edit&wid={$rows[$i]["id"]}' class='edit-field'" .
						"style='text-decoration:none;'></a>";								
				$rows[$i]["delete"]=<<< del
				<a href="javascript:void(0)"
				onclick="DelMsg('{$rows[$i]['id']}',
					'از حذف ایت فعالیت اطمینان دارید؟',
				'?item=worksmgr&act=del&pageNo={$_GET[pageNo]}&wid=');"
				 class='del-field' style='text-decoration:none;'></a>
del;
                         }

    if (!$_GET["pageNo"] or $_GET["pageNo"]<=0) $_GET["pageNo"] = 0;
            if (Count($rows) > 0)
            {                    
                    $gridcode .= DataGrid(array( 
							"catid"=>"گروه",
							"subject"=>"عنوان",
							"image"=>"تصویر",
							"body"=>"توضیحات",
							"sdate"=>"تاریخ شروع",
							"fdate"=>"تاریخ پایان",
							"addpic"=>"عکس",
                            "edit"=>"ویرایش",
							"delete"=>"حذف",), $rows, $colsClass, $rowsClass, 10,
                            $_GET["pageNo"], "id", false, true, true, $rowCount,"item=worksmgr&act=mgr");
                    
            }
$msgs = GetMessage($_GET['msg']);
$list = array("subject"=>"عنوان",
              "body"=>"توضیحات",
			  "sdate"=>"تاریخ شروع",
			  "fdate"=>"تاریخ پایان");
$combobox = SelectOptionTag("cbsearch",$list,"subject");
$code=<<<edit
<script type='text/javascript'>
	$(document).ready(function(){	   			
		$('#srhsubmit').click(function(){	
			$('#frmsrh').submit();
			return false;
		});
		$('#cbsearch').change(function(){
			$("select option:selected").each(function(){
	            if($(this).val()=="sdate"||$(this).val()=="fdate"){
	            	$('.cal-btn').css('display' , 'inline-block');
	            	return false;
	            }else{
	            	$('.cal-btn').css('display' , 'none');
	            }
  			});
		});
	});
</script>	   
					<div class="title">
				      <ul>
				        <li><a href="adminpanel.php?item=dashboard&act=do">پیشخوان</a></li>
					    <li><span>مدیریت کار ها</span></li>
				      </ul>
				      <div class="badboy"></div>
				  </div>
                    <div class="Top">                       
						<center>
							<form action="?item=worksmgr&act=mgr" method="post" id="frmsrh" name="frmsrh">
								<p>جستجو بر اساس {$combobox}</p>

								<p class="search-form">
									<input type="text" id="date_input_1" name="txtsrh" class="search-form" value="جستجو..." onfocus="if (this.value == 'جستجو...') {this.value = '';}" onblur="if (this.value == '') {this.value = 'جستجو...';}"  /> 
									<img src="./images/cal.png" class="cal-btn" id="date_btn_2" alt="cal-pic">
							         <script type="text/javascript">
							          Calendar.setup({
							            inputField  : "date_input_1",   // id of the input field
							            button      : "date_btn_2",   // trigger for the calendar (button ID)
							                ifFormat    : "%Y/%m/%d",       // format of the input field
							                showsTime   : false,
							                dateType  : 'jalali',
							                showOthers  : true,
							                langNumbers : true,
							                weekNumbers : true
							          });
							        </script>
									<a href="?item=worksmgr&act=mgr" name="srhsubmit" id="srhsubmit" class="button"> جستجو</a>
									<a href="?item=worksmgr&act=mgr&rec=all" name="retall" id="retall" class="button"> کلیه اطلاعات</a>
								</p>
								<input type="hidden" name="mark" value="srhnews" /> 
								{$msgs}

								{$gridcode} 
															
							</form>
					   </center>
					</div>

edit;
$html = $code;
}	
return $html;
?>