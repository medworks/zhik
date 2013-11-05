<?php
    include_once("../config.php");
    include_once("../classes/database.php");
	include_once("../classes/messages.php");	
	include_once("../classes/functions.php");
	include_once("../classes/login.php");
	$login = Login::GetLogin();
	if (!$login->IsLogged())
	{
		header("Location: ../index.php");
		die(); // solve a security bug
	}
	if ($_GET['item']!="thememgr")	exit();
	$db = Database::GetDatabase();
	$msg = Message::GetMessage();
	if($_GET["act"]=="chg")
	{
		$values = array("`value`"=>"'{$_GET['name']}'");
		$db->UpdateQuery("settings",$values,array("`key` ='Site_Theme_Name'"));		
	//	header('location:?item=thememgr&act=do');
	}

	$i = 0;
	$handle=opendir('../themes');
    while ($file = readdir($handle))
    {        
          if (!preg_match("/^[.]/",$file,$out, PREG_OFFSET_CAPTURE))
         {             
			 if(is_dir("../themes/".$file))
			 {              
					$i++;
					if ($i % 2==0)
					{
							$rowsClass[] = "datagridevenrow";
					}
					else
					{
							$rowsClass[] = "datagridoddrow";
					}
					$disable_folders = array('css','fonts','images','js');
					$dirname = basename($file);                 
					$Stat = $db->CountOf("settings","`key` = 'Site_Theme_Name' and `value` ='{$dirname}'");
					if ($Stat == 0) {$Status = "غیر فعال";} else {$Status = "فعال";}
					if(!in_array(basename($file), $disable_folders))
					{
						$themes[] = array("Name"=>basename($file),
									"Status"=>$Status,
									"Active"=>($Stat==0)? "<a href='?item=thememgr&act=chg&name={$dirname}'" .
									"style='text-decoration:none;' class='dis-field' ></a>" :
								    "<a href='?item=thememgr&act=chg&name={$dirname}' " .
									"style='text-decoration:none;' class='en-field'></a>");
					}
				 }
           }
     }
   
    closedir($handle);    
    $code .= DataGrid(array(
                            "Name"=>"نام قالب ",
                            "Status"=>"وضعیت",                            
                            "Active"=>"فعال / غیر فعال"), $themes, $colsClass, $rowsClass, 10,
                            $_GET["pageNo"], "id", false, true, true, $rowCount,"item=thememgr&act=do");
		
//	if ($_GET['act']=="do")
{
	$html=<<<ht
		<div class="title">
	      <ul>
	        <li><a href="adminpanel.php?item=dashboard&act=do">پیشخوان</a></li>
	        <li><span>مدیریت قالب</span></li>
	      </ul>
	      <div class="badboy"></div>
	    </div>
		{$code}
		
ht;
}
	
return $html;
?>