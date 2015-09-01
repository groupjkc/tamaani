<?php

	if($_GET['email']=='') { 
		$mail_msg= "Aucune adresse courriel fournie"; } 
	else{
		require_once '../campaignmonitor/csrest_subscribers.php';
		
		$wrap = new CS_REST_Subscribers('8933f0f286f31d0214ba332d8e99dce6', '05eb9d91fcd118669120e66b1bdd6668');
		$result = $wrap->add(array(
			'EmailAddress' => $_GET['email'],
			'Name' => '',
			'Resubscribe' => true
		));
		
		
		if($result->was_successful()) {
			$mail_msg = "<span style='color: #28dc49;'>Votre abonnement a &eacute;t&eacute; fait avec succ&egrave;s</span>";
		} else {
			$res=$result->response;
			$mail_msg = $res->Message;
			$mail_msg = 'Veuillez fournir une adresse email valide.';
		}
	}
	echo $mail_msg;