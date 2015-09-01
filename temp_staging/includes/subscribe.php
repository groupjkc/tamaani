<?php
	include ('config.php'); 
	include ('functions.php'); 

	// Validation
		if($_GET['email']=='') { 
			$mail_msg= "No email address provided"; 
		} 
		elseif(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*$/i", $_GET['email'])) {
			$mail_msg=  "Email address is invalid"; 
		} 
		elseif (email_exists($_GET['email'])){
			 $mail_msg = "Duplicate email address";						
		}		
		else{	
			insert_contact_info($_GET['email']);
			smtpmailer($_GET['email'], 'Subscribe Form ', $_GET['email'], $_GET['email']);
			$mail_msg= 'Your subscription was sucessful';
		}
		echo $mail_msg;
	?>