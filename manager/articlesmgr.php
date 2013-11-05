<?php 
    include_once("../config.php");
    include_once("../classes/database.php");
	include_once("../classes/messages.php");
	include_once("../classes/session.php");	
	include_once("../classes/functions.php");
	include_once("../classes/login.php");
	include_once("../lib/persiandate.php");	
	$login = Login::GetLogin();
	if (!$login->IsLogged())
	{
		header("Location: ../index.php");
		die(); // solve a security bug
	}
	$db = Database::GetDatabase();
	$sess = Session::GetSesstion();	
	$userid = $sess->Get("userid");
	$overall_error = false;
	if ($_GET['item']!="articlesmgr")	exit();	   
	if (isset($_POST["mark"]) and $_POST["mark"]!="srhnews")
	{
	   date_default_timezone_set('Asia/Tehran');
	   list($hour,$minute,$second) = explode(':', Date('H:i:s'));
	   list($year,$month,$day) = explode("-", trim($_POST["ndate"]));		
	   list($gyear,$gmonth,$gday) = jalali_to_gregorian($year,$month,$day);		
	   $ndatetime = Date("Y-m-d H:i:s",mktime($hour, $minute, $second, $gmonth, $gday, $gyear));		
						
		if (empty($_POST['detail']))
		{
		   header('location:?item=articlesmgr&act=new&msg=5');
		    $overall_error = true;
		}			
		
	}	
	if (!$overall_error && $_POST["mark"]=="savenews")
	{	    
		$fields = array("`subject`","`body`","`ndate`","`userid`","`resource`","`catid`","`keywords`");
		$_POST["detail"] = addslashes($_POST["detail"]);		
		$values = array("'{$_POST[subject]}'","'{$_POST[detail]}'","'{$ndatetime}'","'{$userid}'","'{$_POST[res]}'","'{$_POST[cbcat]}'","'{$_POST[keywords]}'");
		if (!$db->InsertQuery('articles',$fields,$values)) 
		{
			header('location:?item=articlesmgr&act=new&msg=2');
		} 	
		else 
		{  													
			header('location:?item=articlesmgr&act=new&msg=1');
		}  				 
	}
    else
	if (!$overall_error && $_POST["mark"]=="editnews")
	{		
	    $_POST["detail"] = addslashes($_POST["detail"]);	    
		$values = array("`subject`"=>"'{$_POST[subject]}'",
						"`body`"=>"'{$_POST[detail]}'",
						"`ndate`"=>"'{$ndatetime}'",
						"`userid`"=>"'{$userid}'",
						"`resource`"=>"'{$_POST[res]}'",
						"`catid`"=>"'{$_POST[cbcat]}'",
						"`keywords`"=>"'{$_POST[keywords]}'");
			
        $db->UpdateQuery("articles",$values,array("id='{$_GET[nid]}'"));
		header('location:?item=articlesmgr&act=mgr');		
	}

	if ($overall_error)
	{
		$row = array("subject"=>$_POST['subject'],
					 "body"=>$_POST['detail'],
					 "ndate"=>$_POST['ndate'],
					 "userid"=>$userid,
					 "resource"=>$_POST['res'],
					 "cat"=>$_POST['cbcat'],
					 "keywords"=>$_POST['keywords']);
	}
	
	
if ($_GET['act']=="new")
{
	$editorinsert = "
		<p>
			<input type='submit' id='submit' value='ذخیره' class='submit' />	 
			<input type='hidden' name='mark' value='savenews' />";
}
if ($_GET['act']=="edit")
{
	$row=$db->Select("articles","*","id='{$_GET["nid"]}'",NULL);
	$row['ndate'] = ToJalali($row["ndate"]);
	$editorinsert = "
	<p>
      	 <input type='submit' id='submit' value='ویرایش' class='submit' />	 
      	 <input type='hidden' name='mark' value='editnews' />";
}
if ($_GET['act']=="del")
{
	$db->Delete("articles"," id",$_GET["nid"]);
	if ($db->CountAll("articles")%10==0) $_GET["pageNo"]-=1;		
	header("location:?item=articlesmgr&act=mgr&pageNo={$_GET[pageNo]}");
}
if ($_GET['act']=="do")
{
	$html=<<<ht
		<div class="title">
	      <ul>
	        <li><a href="adminpanel.php?item=dashboard&act=do">پیشخوان</a></li>
	        <li><span>مدیریت مقالات</span></li>
	      </ul>
	      <div class="badboy"></div>
	    </div>
		<div class="sub-menu" id="mainnav">
			<ul>
			  <li>		  
				<a href="?item=articlesmgr&act=new">درج مقاله
					<span class="add-article"></span>
				</a>
			  </li>
			  <li>
				<a href="?item=articlesmgr&act=mgr" id="articles" name="articles">حذف/ویرایش مقالات
					<span class="edit-article"></span>
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
			$("#frmnewsmgr").validationEngine();
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
	    <li><span>درج مقاله</span></li>
      </ul>
      <div class="badboy"></div>
  </div>
  <div class="mes" id="message">{$msgs}</div>
  <div class='content'>
	<form name="frmnewsmgr" id="frmnewsmgr" class="" action="" method="post" >
     <p class="note">پر کردن موارد مشخص شده با * الزامی می باشد</p>
	 <div class="badboy"></div>
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
       <input type="text" name="subject" class="validate[required] subject" id="subject" value='{$row[subject]}'/>
  	   <p>
         <label for="detail">توضیحات </label>
         <span>*</span>
       </p>
       <textarea cols="50" rows="10" name="detail" class="detail" id="detail" > {$row[body]}</textarea>
       <p>
         <label for="detail">کلمات کلیدی </label>
         <span>*</span>
       </p>
       <input type="text" name="keywords" class="validate[required] subject" id="keywords" value='{$row[keywords]}'/>
  	   <p>
        <label for="sdate">تاریخ </label>
        <span>*</span><br /><br />
        <input type="text" name="ndate" class="validate[required] ndate" id="date_input_1" value='{$row[ndate]}' />
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
  	   <label>منبع مقاله </label>
       <span>*</span>   	 
       </p>
       <input type="text" name="res" class='validate[required]' value='{$row['resource']}'/>
	   {$editorinsert}       
      	 <input type="reset" value="پاک کردن" class='reset' /> 	 	     
       </p>  
	</form>
	<div class='badboy'></div>	
  </div>  
   
cd;
} else
if ($_GET['act']=="mgr")
{
	if ($_POST["mark"]=="srhnews")
	{	 		
	    if ($_POST["cbsearch"]=="ndate")
		{
		   date_default_timezone_set('Asia/Tehran');		   
		   list($year,$month,$day) = explode("/", trim($_POST["txtsrh"]));		
		   list($gyear,$gmonth,$gday) = jalali_to_gregorian($year,$month,$day);		
		   $_POST["txtsrh"] = Date("Y-m-d",mktime(0, 0, 0, $gmonth, $gday, $gyear));
		}
		$rows = $db->SelectAll(
				"articles",
				"*",
				"{$_POST[cbsearch]} LIKE '%{$_POST[txtsrh]}%'",
				"ndate DESC",
				$_GET["pageNo"]*10,
				10);
			if (!$rows) 
			{								
				header("Location:?item=articlesmgr&act=mgr&msg=6");
			}
		
	}
	else
	{	
		$rows = $db->SelectAll(
				"articles",
				"*",
				null,
				"ndate DESC",
				$_GET["pageNo"]*10,
				10);
    }
                $rowsClass = array();
                $colsClass = array();
                $rowCount =($_GET["rec"]=="all" or $_POST["mark"]!="srhnews")?$db->CountAll("articles"):Count($rows);
                for($i = 0; $i < Count($rows); $i++)
                {						
		        $rows[$i]["subject"] =(mb_strlen($rows[$i]["subject"])>20)?mb_substr($rows[$i]["subject"],0,20,"UTF-8")."...":$rows[$i]["subject"];
                $rows[$i]["body"] =(mb_strlen($rows[$i]["body"])>30)?
                mb_substr(html_entity_decode(strip_tags($rows[$i]["body"]), ENT_QUOTES, "UTF-8"), 0, 30,"UTF-8") . "..." :
                html_entity_decode(strip_tags($rows[$i]["body"]), ENT_QUOTES, "UTF-8");               
                $rows[$i]["ndate"] =ToJalali($rows[$i]["ndate"]," l d F  Y ");
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
				$rows[$i]["edit"] = "<a href='?item=articlesmgr&act=edit&nid={$rows[$i]["id"]}' class='edit-field'" .
						"style='text-decoration:none;'></a>";								
				$rows[$i]["delete"]=<<< del
				<a href="javascript:void(0)"
				onclick="DelMsg('{$rows[$i]['id']}',
					'از حذف این خبر اطمینان دارید؟',
				'?item=articlesmgr&act=del&pageNo={$_GET[pageNo]}&nid=');"
				 class='del-field' style='text-decoration:none;'></a>
del;
                         }

    if (!$_GET["pageNo"] or $_GET["pageNo"]<=0) $_GET["pageNo"] = 0;
            if (Count($rows) > 0)
            {                    
                    $gridcode .= DataGrid(array( 
					        "catid"=>"گروه",
							"subject"=>"عنوان",
							"body"=>"توضیحات",
							"ndate"=>"تاریخ",
							"resource"=>"منبع",							
							"username"=>"کاربر",
                            "edit"=>"ویرایش",
							"delete"=>"حذف",), $rows, $colsClass, $rowsClass, 10,
                            $_GET["pageNo"], "id", false, true, true, $rowCount,"item=articlesmgr&act=mgr");
                    
            }
$msgs = GetMessage($_GET['msg']);
$list = array("subject"=>"عنوان",
              "body"=>"توضیحات",
			  "ndate"=>"تاریخ",
			  "resource"=>"منبع");
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
	            if($(this).val()=="ndate"){
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
					    <li><span>درج/ویرایش مقالات</span></li>
				      </ul>
				      <div class="badboy"></div>
				  </div>
                    <div class="Top">                       
						<center>
							<form action="?item=articlesmgr&act=mgr" method="post" id="frmsrh" name="frmsrh">
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
									<a href="?item=articlesmgr&act=mgr" name="srhsubmit" id="srhsubmit" class="button"> جستجو</a>
									<a href="?item=articlesmgr&act=mgr&rec=all" name="retall" id="retall" class="button"> کلیه اطلاعات</a>
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