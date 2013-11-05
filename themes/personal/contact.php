<?php

$msg="";
$admin = 'info@mediateq.ir';

$name    = $_POST['name'];
$email   = $_POST['email'];
$subject = $_POST['subject'];
$text    = $_POST['message'];

$message = "$text";

if( strlen($name)>=1 && strlen($email)>=1 && strlen($subject)>=1 && strlen($text)>=1 ){
	if( @mail (
			$admin,
			"$subject",
			$message,
			"From:$name $email" )
	){
		// echo '<script type="text/javascript">
		// 		alert("پیام شما با موفقیت ارسال شد.");
		// 	  </script>';
		//header("Location:?item=contact");
		$msg="پیام شما با موفقیت ارسال شد.";

	}else{
		// echo '<script type="text/javascript">
		// 		alert("خطا! پیام شما ارسال نشد لطفا مجددا تلاش نمایید.");
		// 	  </script>';
		//header("Location:?item=contact");
		$msg="خطا! پیام شما ارسال نشد لطفا مجددا تلاش نمایید.";

	}
}

$db = database::GetDatabase();
$address = GetSettingValue('Address',0);
$tel = GetSettingValue('Tell_Number',0);
$fax = GetSettingValue('Fax_Number',0);

$html=<<<cd
	<div class="contact-page" id="others-page">
		<div class="page-header" id="others-page">
			<h1>تماس با ما</h1>
			<div class="badboy"></div>
		</div>
		<div class="badboy"></div>
		<div class="contact" id="special-page">
			<script src='http://maps.googleapis.com/maps/api/js?key=AIzaSyDun8B3aM33iKhRIZniXwprr2ztGlzgnrQ&sensor=false'></script>
			<script>
				function initialize()
				{
					var mapProp = {
					  center:new google.maps.LatLng(36.309462, 59.567817),
					  zoom:18,
					  mapTypeId:google.maps.MapTypeId.ROADMAP
					  };

					var map=new google.maps.Map(document.getElementById('googleMap'),mapProp);

					var marker=new google.maps.Marker({
					 	 position:myCenter,
					  });

					marker.setMap(map);

					var infowindow = new google.maps.InfoWindow({
						  content:'Mediateq'
					  });

					infowindow.open(map,marker);

				}

				google.maps.event.addDomListener(window, 'load', initialize);

		   </script>
		   <div id="googleMap" class="map" style="width:720px;height:380px;"></div>

			<div class="detail">
				<div class="contact-form right">
					<h3>فرم تماس</h3>
					<p>شما می توانید از طریق فرم زیر با ما تماس حاصل فرمایید.</p>
					<form action="" method="post" accept-charset="utf-8">
						<label>نام<span> *</span></label>
						<p>
							<input type="text" name="name" class="name" id="name" />
						</p>
						<label>ایمیل<span> *</span></label>
						<p>
							<input type="text" name="email" class="ltr email" id="email" />
						</p>
						<label>عنوان<span> *</span></label>
						<p>
							<input type="text" name="subject" class="subject" id="subject" />
						</p>
						<label>متن<span> *</span></label>
						<p>
							<textarea name="message" class="message" id="message"></textarea>
						</p>
						<p>
							<input type="submit" name="submit" class="submit btn" id="submit" value="ارسال" />
							<input type="reset" name="reset" class="reset btn" id="reset" value="پاک کردن" />
						</p>	
					</form>
						<p class="msg">{$msg}</p>
				</div>
				<div class="address">
					<h3>مشخصات تماس</h3>
					<p>راه های تماس با ما</p>
					<h4>آدرس</h4>
					<p class="addre">{$address}</p>
					<h4>تلفن</h4>
					<p class="tel ltr">Tel: {$tel}</p>
					<p class="fax ltr">Fax: {$fax}</p>
					<h4>ایمیل</h4>
					<p class="email ltr">Email: <a href="mailto:info@mediateq.ir" title="Send Mail">info[at]mediateq.ir</a></p>
				</div>
			</div>
			<div class="badboy"></div>
		</div>
	</div>
cd;
return $html;
?>