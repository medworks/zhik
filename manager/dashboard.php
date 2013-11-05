<?php
	include_once("../classes/database.php");	
	include_once("../classes/login.php");	
	include_once("../config.php");
    include_once("../classes/database.php");	
	include_once("../classes/functions.php");
	include_once("../lib/persiandate.php");
	if ($_GET['item']!="dashboard")	exit();
	if (!isset($_GET["type"])) $_GET["type"]="pie";
	$login = Login::GetLogin();
	if (!$login->IsLogged())
	{
		header("Location: ../index.php");
		die(); // solve a security bug
	}	
	$db = Database::GetDatabase();
	$news = $db->SelectAll("news","*",null,"ndate");	
	if (isset($news))
	{
		$row = array();
		$pie = array();
		$itemcount = array();
		$count = array();
		foreach($news as $key => $val)
		{
		  $row[] = "'".ToJalali($val['ndate'],"Y-m-d")."'";	
		}	
		if (isset($row))
		{
			$uniq = array_unique($row);	
			$itemcount = array_count_values($row);			
			foreach($itemcount as $key => $val)
			{
				$count[] = $val;
				$pie[] = "[{$key},{$val}]";
			}
			if ($_GET["type"]=="pie")
			{		
				//$xnAxis = implode(', ',$uniq);
				$nseries = implode(', ',$pie);
			}
			else
			{ 	
				$xnAxis = implode(', ',$uniq);
				$nseries = implode(', ',$count);
			}
			unset($row);
			unset($itemcount);
			unset($pie);
			unset($count);
		}	
	}	
//*************************************************************
    $works = $db->SelectAll("works","*",null,"sdate");
	if (isset($works))
	{
		foreach($works as $key => $val)
		{
		  $row[] = "'".ToJalali($val['sdate'],"Y-m-d")."'";	
		}	
		if (isset($row))
		{			
			$uniq = array_unique($row);	
			$itemcount = array_count_values($row);
			foreach($itemcount as $key => $val)
			{
				$count[] = $val;        
				$pie[] = "[{$key},{$val}]";
			}
			if ($_GET["type"]=="pie")
			{		
				//$xwAxis = implode(', ',$uniq);		
				$wseries = implode(', ',$pie);
			}
			else
			{ 	
				$xwAxis = implode(', ',$uniq);
				$wseries = implode(', ',$count);
			}
			
			unset($row);
			unset($itemcount);
			unset($pie);
			unset($count);
		}	
	}	
$list = array("none"=>"انتخاب نوع نمودار",
              "area"=>"محیطی",
              "line"=>"خطی",
              "pie"=>"دایره ای",
			  "bar"=>"میله ای");
$combobox = SelectOptionTag("cbchart",$list);	
 $html=<<<cd
<p>
	{$combobox}
</p>
<hr/> 
 <script src="../lib/highcharts/js/highcharts.js"></script>
 <script src="../lib/highcharts/js/modules/exporting.js"></script>
 <script type="text/javascript"> 
 $('#cbchart').change(function(){    
	$("select option:selected").each(function(){
	window.location.href = "adminpanel.php?item=dashboard&act=do&type="+$(this).val();	
	return false;
				});
});	

 $(function () {       		
        $('#pnlnews').highcharts({
           chart: {		
				type: '{$_GET[type]}',
				width: 800,
				height:600,
				zoomType: 'xy'
			},			
            title: {
			style: {fontFamily: 'bmitra', fontWeight: 'bold', fontSize: '25px' },
             text: 'نمودار اخبار'
            },
            xAxis: {			   
			  style: {fontFamily: 'bmitra', fontWeight: 'bold', fontSize: '25px' },	
              categories: [{$xnAxis}]
            },
			yAxis: {
			  style: {fontFamily: 'bmitra', fontWeight: 'bold', fontSize: '25px' },
              title: {
                    text: 'تعداد خبر '
                }
            },
            credits: {
                enabled: false
            },			
            series: [{			
			style: {fontFamily: 'bmitra', fontWeight: 'bold', fontSize: '25px' },
			    title: {
                    text: 'تعداد'
                },
                name: 'تعداد اخبار ',
				color: '#8bbc21',
                data: [{$nseries}]
                }]
        });
    });
	
	$(function () {
        $('#pnlworks').highcharts({
           chart: {		
			    type: '{$_GET[type]}',		   
				width: 800,
				height:600,
				zoomType: 'xy'
			},			
            title: {
			style: {fontFamily: 'bmitra', fontWeight: 'bold', fontSize: '25px' },
                text: 'نمودار فعالیت های اخذ شده '
            },
            xAxis: {			 
                categories: [{$xwAxis}]
            },
			yAxis: {
                title: {
                    text: 'تعداد فعالیت '
                }
            },
            credits: {
                enabled: false
            },
			
            series: [{
			    title: {
                    text: 'تعداد'
                },
                name: 'تعداد فعالیت ',
                data: [{$wseries}]
                }]
        });
    });
		
	</script>
	
 <div id="pnlnews" style="width: 400px; height: 400px; margin: 0;"></div>
 <hr/><br/>
 <div id="pnlworks" style="width: 400px; height: 400px; margin:200px 0;"></div>

cd;
 return $html;
?>