<?php

	if($_GET['email']=='') { 
		$mail_msg= "No email address provided"; } 
	else{
		require_once '../campaignmonitor/csrest_subscribers.php';
		
		$wrap = new CS_REST_Subscribers('fd6d7a0d66391f7a839cb5224c656630', '05eb9d91fcd118669120e66b1bdd6668');
		$result = $wrap->add(array(
			'EmailAddress' => $_GET['email'],
			'Name' => '',
			'Resubscribe' => true
		));
		
		
		if($result->was_successful()) {
			$mail_msg = "<span style='color: #28dc49;'>Your subscription was sucessful</span>";
		} else {
			$res=$result->response;
			$mail_msg = $res->Message;
		}
	}
	echo $mail_msg;