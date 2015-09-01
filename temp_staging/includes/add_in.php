<?php
	if($_GET['email']=='') { 
		$mail_msg= "&#5507;&#5446;&#5205;&#5125;&#5421;&#5125;&#5193; &#5200;&#5452;&#5448;&#5198;&#5523; &#5169;&#5205;&#5507;&#5745;&#5200;&#5509;"; } 
	else{
		require_once '../campaignmonitor/csrest_subscribers.php';
		
		$wrap = new CS_REST_Subscribers('c0878538f0eaf3546ec3347d61c2f857', '05eb9d91fcd118669120e66b1bdd6668');
		$result = $wrap->add(array(
			'EmailAddress' => $_GET['email'],
			'Name' => '',
			'Resubscribe' => true
		));
		
		
		if($result->was_successful()) {
			$mail_msg = "<span style='color: #28dc49;'>&#5130;&#5200;&#5456;&#5198;&#5448;&#5261;&#5290;&#5125;&#5198;&#5198;&#5222; &#5169;&#5421;&#5447;&#5456;&#5171;&#5222; </span>";
		} else {
			$res=$result->response;
			$mail_msg = $res->Message;
			$mail_msg ='&#5316;&#5123;&#5222;&#5359;&#5335;&#5198;&#5222; &#5130;&#5200;&#5448;&#5328;&#5319;&#5200;&#5285;&#5251; &#5507;&#5446;&#5205;&#5125;&#5421;&#5287;&#5222; &#5200;&#5452;&#5448;&#5198;&#5285;&#5251;';
		}
	}
	echo $mail_msg;