<?php
	include('phpdbclass/database.class.php');
	include ("phpmailer/class.phpmailer.php");	

	 	DEFINE('DB_SERVER', "localhost");
		DEFINE('DB_USER', "tamaani");
		DEFINE('DB_PASS', "shn1tThWy5o0");
		DEFINE('DB_DATABASE', "tamaani");	 



	function curl($IP){
		 
		
		$ch = curl_init();
		
		$url         = '38.108.74.36/ulu.php';
		$arr         = array();
		$arr[]       = array('VER'=> "1.0", 'IP'=>$IP); 
		$json_string = json_encode($arr);

		curl_setopt($ch, CURLOPT_URL, $url);

		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $json_string);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
		curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Content-Length: ' . strlen($json_string)) );

		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);		
		
		$json = curl_exec($ch);
		echo curl_error($ch);
		curl_close($ch);
		$json_array = json_decode($json, TRUE);	
		return($json_array);
	}



	function ByteToGega($value){
		$res= $value/(1024*1024*1024) ;
		$res =number_format($res, 2, ',', '');
		return($res);
		
	}

	function send_confirmation_email($header, $Subject, $to, $toName, $template, $type, $footer) { 
			 
			 $body ='
					<!DOCTYPE html>
					<html>
					<head>
					</head>
					<body style="background-color:#ccc; ">
					
					<table width="950" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF"  style="position:relative; font-family:Arial, 
					Helvetica, sans-serif; "  >
					  <tr>
						  <td bgcolor="#0A88C2" background="http://www.tamaani.ca/images/Email-Header.jpg" height="100" >
						
							<!--[if gte mso 9]>
							
							<v:image xmlns:v="urn:schemas-microsoft-com:vml" id="theImage" style="behavior: url(#default#VML); display:inline-block; 
							position:absolute; height:100px; width:950px;" src="http://www.tamaani.ca/images/Email-Header.jpg"/>
							
							<v:shape xmlns:v="urn:schemas-microsoft-com:vml" id="theText" style="behavior: url(#default#VML); display:inline-block; 
							position:absolute; height:100px; width:950px; ">
							
							<![endif]-->
							
							<p style="margin:60px 50px 10px 0px;  text-align:right;  font-size:22px; font-weight:bold ; font-family:Arial, 
							Helvetica, sans-serif; ">'.$type.'</p>
							
							<!--[if gte mso 9]>
							
							</v:shape>
							
							<![endif]-->
						
						</td>
					
					  </tr>
					  <tr>
						<td style="background-color:#FFF; color:#000  width:100%; padding:0px 50px 0px 0px; font-size:14px; ">
						<table width="850px" border="0" cellspacing="0" cellpadding="0">
	
							<tr>
							  <td colspan="3" style="  color:#000; font-size:15px; padding:20px 0 10px 50px; font-family:Arial, Helvetica, sans-serif; font-size:14px; "> 
									 '.$header.'
							  </td>
							</tr>
						   
							<tr>
							  <td colspan="3" align="center" style="font-size:22px; font-weight:bold; padding:10px 0 10px 50px;   ">
							  <img src="http://www.tamaani.ca/images/tamaani.jpg"  ></td>
							</tr>';
			
				$body .= $template.'
				
						  </table>
						  </td>
							</tr>
						  </table></td>
					  </tr>
					  <tr>
						<td style=" color:#000; font-size:18px; padding:20px 0 10px 50px; font-family:Arial, Helvetica, sans-serif;"> '.$footer.'</td>
					  </tr>
					  <tr>
						<td style="background-color:#000000;  width:100%; padding:3px 0 3px 0px; font-family:Arial, Helvetica, sans-serif; ">&nbsp;</td>
					  </tr>
					  <tr>
						<td style="background-color:#138bc0;  width:100%; padding:3px 0 3px 0px; ">&nbsp;</td>
					  </tr>
					</table>
					</body>
					</html>	';


		$mail = new PHPMailer();  // create a new object
		$mail->IsSMTP(); 					
		$mail->SMTPAuth = TRUE;
		$mail->Port = 25;
		$mail->Host = '64.207.179.138';
		$mail->Username = 'mailer@jkvisual.com';
		$mail->Password = '82cann0t$be*123';	

		$mail->From = 'vc@krg.ca';
		$mail->FromName = 'Tamaani VC';		
		$mail->Subject = $Subject;
		$mail->Body = $body;
		$mail->AltBody = $body;		

		
		$mail->AddAddress($to, $toName);
		//$mail->AddAddress('fatiha@jkcommunications.com', $toName);
		
	//	$mail->AddBCC("webmaster@mobilizeme.com", "Webmaster");
		
		if(!$mail->Send()) {
			return 'Mail error: '.$mail->ErrorInfo; 
		} else {
			return true;
		}

	}


	function get_faq_categories(){
		$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
		$db->connect();			
		$sql = "SELECT faq_categorie_id as id, faq_categorie_titre_".$_SESSION['lang']." as title FROM faq_categorie";
		$result = $db->fetch_all_array($sql);
		$db->close();	
		return $result;
	}

	function get_faqs($id){
		$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
		$db->connect();			
		$sql = "SELECT faq_id as id, faq_question_".$_SESSION['lang']."  as question, faq_reponse_".$_SESSION['lang']."  as answer FROM faq  where faq_categorie_id=".$id. " 
		ORDER BY `faq_ordre` ASC	";
		$result = $db->fetch_all_array($sql);
		$db->close();	
		return $result;
	}

	function get_links(){
		$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
		$db->connect();			
		$sql = "SELECT lien_id as id, title_".$_SESSION['lang']." as title, lien_url as link, lien_icon as icon, lien_visible FROM lien where lien_visible='Y' ";
		$result = $db->fetch_all_array($sql);
		$db->close();	
		return $result;
	}

	function get_documents(){
		$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
		$db->connect();			
		$sql = "SELECT document_id as id, title_".$_SESSION['lang']." as title, pdf_".$_SESSION['lang']."  as pdf  FROM document  where document_visible='Y'	";
		$result = $db->fetch_all_array($sql);
		$db->close();	
		return $result;
	}

	function get_services($ID){
		$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
		$db->connect();			
		$sql = "SELECT service_id as id, title_".$_SESSION['lang']." as title, tagline_first_".$_SESSION['lang']."  as tagline_first, tagline_second_".$_SESSION['lang']."  as tagline_second,
				text_".$_SESSION['lang']."  as text, legal_".$_SESSION['lang']."  as legal, service_icon    FROM service  where service_id=".$ID;
				
		$result = $db->fetch_all_array($sql);
		$db->close();	
		return $result[0];
	}
	

	function get_text($ID){
		$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
		$db->connect();			
		$sql = "SELECT text_id as id, title_".$_SESSION['lang']." as title, text_".$_SESSION['lang']."  as text, text_icon    FROM text  where text_id=".$ID;
				
		$result = $db->fetch_all_array($sql);
		$db->close();	
		return $result[0];
	}	
	



	function get_requester($id) {
		$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
		$db->connect();	
		$sql= "SELECT * FROM requester WHERE    requester_id=".$id;
				
		$result = $db->fetch_all_array($sql);
		$db->close();	
		return $result[0];
	}
	
	function get_site_detail($site_id) {
		$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
		$db->connect();	
		$sql= "SELECT * FROM site WHERE    site_id=".$site_id;
				
		$result = $db->fetch_all_array($sql);
		$db->close();	
		return $result;
	}	

	function get_sites() {
		$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
		$db->connect();	
		$sql= "SELECT * FROM site WHERE    active='Y' ORDER BY  `SiteName` ASC";
				
		$result = $db->fetch_all_array($sql);
		$db->close();	
		return $result;
	}

	function get_requester_site($requester_id) {
		$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
		$db->connect();	
		$sql= "SELECT  	*  FROM   requester_site JOIN site on  requester_site.site_id = site.site_id  where  requester_id= ".$requester_id ;
				
		$result = $db->fetch_all_array($sql);
		$db->close();	
		return $result;
	}

	
	function insert_site($site_array) {
		$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
		$db->connect();	
		$id = $db->query_insert("site", $site_array);
		$db->close();	
		return $id;
	}
	
	function insert_requester_site($site_array) {
		$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
		$db->connect();	
		$id = $db->query_insert("requester_site", $site_array);
		$db->close();	
		return $id;
	}	

	function insert_request($post) {
		$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
		$db->connect();			

		$request_array = array();
		$request_array['CompanyName']		= $post['CompanyName'];
		$request_array['PO']			    = $post['PO'];	
		$request_array['ContactName']		= $post['ContactName'];	
		$request_array['Address']		    = $post['Address'];	
		$request_array['Town']		        = $post['Town'];	
		$request_array['Province']			= $post['Province'];	
		$request_array['Zip']		        = $post['Zip'];	
		$request_array['Email']			    = $post['Email'];	
		$request_array['WorkPhone'] 	   	= $post['WorkPhone'];	
		
		$request_array['DateVC']		    = $post['DateVC'];	
		$request_array['TimeStart']			= $post['TimeStart'];	
		$request_array['TimeEnd']		    = $post['TimeEnd'];	
		$request_array['NbreSite'] 	    	= $post['NbreSite'];
		$request_array['NunavikSite'] 	    = $post['NunavikSite'];
		$request_array['Language'] 	        = $post['Language'];
		
		
		
		$sql = "SELECT * from requester ORDER BY `requester_id` DESC   LIMIT 0 , 1  ";
		$result = $db->fetch_all_array($sql);
		
		$Reference = $result[0]['Reference'];
		$Reference = ($Reference!='') ? $Reference : 'VC000000'; 
		$Reference++;	
		$request_array['Reference'] 	    = $Reference;

		$id = $db->query_insert("requester", $request_array);
		$db->close();	
		return $id;
	}	
	
	
	function requester_statut($Statut, $id)
	{
			
		$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
		$db->connect();	
		$sql= "UPDATE requester SET    Statut = '$Statut' WHERE  requester_id ='$id'  ";

		$id = $db->query_update("requester", array('Statut'=>$Statut), 'requester_id='.$id);
		$db->close();	
		return $id;		
	}
 