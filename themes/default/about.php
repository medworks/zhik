<?php	
	$about = GetSettingValue('About_System',0);	
$html="<div class='content'>
			<div class='main-box'>
				<h2>درباره ما</h2>
				<div class='line'></div>
				<div class='badboy'></div>
				<div class='aboutus box-right'>
					{$about}
				</div>
			</div>
		</div>";

return $html;
?>