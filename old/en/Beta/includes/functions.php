<?php
	include('phpdbclass/database.class.php');
	
	function email_exists($email){
		$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
		$db->connect();	

		$result = $db->query_first("SELECT * from subscribe WHERE email='".$email."'");
		$db->close();	
		
		if ($result)
			return TRUE;
		else 	return FALSE;
		//
	}

	/* insert the data to the subscribe table */
	function insert_contact_info($email) {
		$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
		$db->connect();			
	
		$ins_array = array();
		$ins_array['email'] = $email; 
		$id = $db->query_insert("subscribe",  $ins_array);	
		$db->close();	
		return $id;
	}
	
	
	function smtpmailer($post_arr, $Subject, $From, $FromName) { 
	
		include ("phpmailer/class.phpmailer.php");
		
		$body = "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.0 Transitional//EN'><html><head></head><body>
				<div><td>A new Subscribe person -".$post_arr."-</div></body></html>";
				
				
		$mail = new PHPMailer();  // create a new object
		$mail->IsSMTP(); // enable SMTP
		$mail->Port = 25;		

		$mail->From = $From;
		$mail->FromName = $FromName;		
		$mail->Subject = $Subject;
		$mail->Body = $body;
		$mail->AltBody = $body;		
		
		$mail->AddBCC("webmaster@mobilizeme.com", "Webmaster");
		
		if(!$mail->Send()) {
			return 'Mail error: '.$mail->ErrorInfo; 
		} else {
			return true;
		}
	}

	function get_faq_categories(){
		$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
		$db->connect();			
		$sql = "SELECT id, title_".$_SESSION['lang']." as title FROM faq_categorie ORDER BY `order` ASC	";
		$result = $db->fetch_all_array($sql);
		$db->close();	
		return $result;
	}

	function get_faqs($id){
		$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
		$db->connect();			
		$sql = "SELECT id, question_".$_SESSION['lang']."  as question, answer_".$_SESSION['lang']."  as answer FROM faq  where faq_categorie_id=".$id. " ORDER BY `order` ASC	";
		$result = $db->fetch_all_array($sql);
		$db->close();	
		return $result;
	}

	function get_links(){
		$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
		$db->connect();			
		$sql = "SELECT id, title_".$_SESSION['lang']." as title, link FROM link ORDER BY `order` ASC	";
		$result = $db->fetch_all_array($sql);
		$db->close();	
		return $result;
	}

	function get_documents(){
		$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
		$db->connect();			
		$sql = "SELECT id, title_".$_SESSION['lang']." as title, pdf FROM document ORDER BY `order` ASC	";
		$result = $db->fetch_all_array($sql);
		$db->close();	
		return $result;
	}

