<?php
$db = database::GetDatabase();
$gallery= $db->SelectAll('gallery',NULL,NULL," id DESC");

$html="<div class='content'>
		<div class='recent-works main-box'>
			<h2>گالری تصاویر</h2>
			<div class='line'></div>
			<div class='badboy'></div>
			<div class='works box-right gallery-page'>";

$html.=<<<ct
				<ul>
ct;
					for($i=0 ; $i<count($gallery) ; $i++){
$html.=<<<ct
						<li>
							<div class="gallpic">
								<a href="{$gallery[$i][image]}" rel="prettyphoto[gallery3]" title="{$gallery[$i][subject]}">
									<img src="{$gallery[$i][image]}" alt="{$gallery[$i][subject]}" />
									<span class="overlay-zoom"></span>
								</a>
							</div>
							<h2>{$gallery[$i][subject]}</h2>
						</li>
ct;
					}
$html.=<<<ct
				</ul>
				<div class="badboy"></div>
			</div>
		</div>
	   </div>


ct;

return $html;
?>