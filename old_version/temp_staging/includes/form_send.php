<?php
session_start();
	include ('config.php'); 
	include ('functions.php'); 
	$language = isset($_SESSION['lang'])  ? $_SESSION['lang']  : 'en';
	include('languages/'.$language.'.php'); 
 
	if($_POST['CompanyName']){
		
		$requester_id = insert_request($_POST);

		if(is_int($requester_id)){
			
			$NbreSite  = $_POST['NbreSite'];
			$requester = get_requester($requester_id);
			
			extract($requester);

					$template='	<tr>
							  <td width="50%" align="left" valign="top"  style=" padding:0px 0 0px 50px; font-family:Arial, Helvetica, sans-serif; font-size:14px;">
							  <strong style="color:#228cbe; font-size:18px;">'.$lang['contact_info'].' <br></strong> 
								'.$lang['CompanyName'].'     : '.$CompanyName.'<br>
								'.$lang['PO'].'          : '.$PO.' <br>
								'.$lang['ContactName'].': '.$ContactName.' <br>
								'.$lang['Address'] .    ': '.$Address.' <br>
								'.$lang['Town'] .       ': '.$Town.' <br>
								'.$lang['Province'] .   ': '.$Province.' <br>
								'.$lang['Zip'].         ': '.$Zip.' <br>
								'.$lang['Email'].       ': '.$Email.' <br>
								'.$lang['WorkPhone'].  ': '.$WorkPhone.' <br>
								<p><br>
								</p></td>
							  <td width="50%" align="left" valign="top"  style=" padding:0px 0 0px 50px; font-family:Arial, Helvetica, sans-serif; font-size:14px;">
							  <strong style="color:#228cbe; font-size:18px;">'.$lang['booking_detail'] .'<br></strong> 
								'.$lang['DateVC'].      ': '.$DateVC.'<br>
								'.$lang['TimeStart'].   ': '.$TimeStart.'<br>
								'.$lang['TimeEnd'].     ': '.$TimeEnd.'<br>
								'.$lang['NbreSite'].    ': '.$NbreSite.'<br>
								'.$lang['NunavikSite'].': '.$NunavikSite.'<br>
								'.$lang['SpecialNeeds'].': '.$SpecialNeeds.'<br>
								'.$lang['FirstTimeUser'].': '.$FirstTimeUser.'<br>';
										
							if($_POST['FirstTimeUser']=='YES')
								$template .=$lang['RequireTraining'].': '.$RequireTraining.'<br>';
							 									
								
							 
						$template .='</td>
							</tr>
							<tr>
							  <td colspan="3" style="font-size:14px; padding:10px 0 0px 0px;   "><table  border="0" cellspacing="0" cellpadding="0">
								  <tr>
									<td colspan="3" style="padding-left:50px;"><strong style="color:#228cbe; font-size:18px;ont-weight:bold; ">'.$lang['site_info'].'<br>  
									</strong></td>
								  </tr>
								  <tr>
									<td width="230"  style="padding-left:50px;"  align="left"><img src="http://www.tamaani.ca/images/bg_three_1.png" ></td>
									<td width="230"  style="padding-left:50px;"  align="left"><img src="http://www.tamaani.ca/images/bg_three_2.png" ></td>
									<td width="230"  style="padding-left:50px;"   ><img src="http://www.tamaani.ca/images/bg_three_3.png" ></td>
								  </tr>
								  <tr>';
			
			for ($j = 1; $j <= $NbreSite; $j++) {
			
				if($_POST[$j]==0) {
					$site_array['SiteName']			    = $_POST['SiteName'.$j];		
						
					$site_array['RRContact']            =  $_POST['RRContact'.$j];
					$site_array['RRPhone']	            =  $_POST['RRPhone'.$j];
					$site_array['RREmail']              =  $_POST['RREmail'.$j];
					
					$site_array['TecContact']           =  $_POST['TecContact'.$j];
					$site_array['TecPhone']	            =  $_POST['TecPhone'.$j];
					$site_array['TecEmail']             =  $_POST['TecEmail'.$j];						
					$site_array['IP']			        =  $_POST['IP'.$j];	
		
				
					$site_array['Equipment']            =  $_POST['Equipment'.$j];
					$site_array['Model']                =  $_POST['Model'.$j];				
					
				
					$site_id = insert_site($site_array);
				}
				
				$requester_site = array();
				$requester_site['requester_id']		    = $requester_id; 
				$requester_site['site_id']			    =($_POST[$j]==0) ? $site_id  : $_POST[$j];
				$requester_site['TechnologyUsed']	    = $_POST['TechnologyUsed'.$j] ;
				
				$RRContact  =  $_POST['RRContact'.$j];
				$RRPhone	=  $_POST['RRPhone'.$j];
				$RREmail    =  $_POST['RREmail'.$j];
				
				$TecContact  =  $_POST['TecContact'.$j];
				$TecPhone	 =  $_POST['TecPhone'.$j];
				$TecEmail    =  $_POST['TecEmail'.$j];	
				
				$Equipment	 =  $_POST['Equipment'.$j];
				$Model       =  $_POST['Model'.$j];					
 				

				insert_requester_site($requester_site);
				
				$siteDetail = get_site_detail($requester_site['site_id']);


				$template .='<td width="315"  align="left" style="padding-left:50px; padding-top:10px; font-family:Arial, Helvetica, sans-serif; font-size:14px; ">
								<strong  style=" color:#228cbe;">SITE   '.$j.' <br> </strong> 
										'.$lang['SiteName'].      ':  '.$siteDetail['0']['SiteName'].'	<br><br>
										
										 <strong>'.$lang['RR'].': </strong><br>
										'.$lang['NAME'].': '.$RRContact.'	<br>
										'.$lang['Email'].': '.$RREmail.'	<br>
										'.$lang['PHONE'].': '.$RRPhone.'	<br><br>
										
										 <strong>'.$lang['Tec'].': </strong><br>
										'.$lang['NAME'].': '.$TecContact.'	<br>
										'.$lang['Email'].': '.$TecEmail.'	<br>
										'.$lang['PHONE'].': '.$TecPhone.'	<br>											
			  
										'.$lang['TechnologyUsed'].':  '.$_POST['TechnologyUsed'.$j].'	<br>';
										
										if($_POST['TechnologyUsed'.$j]=='IP') {
											$template .='IP: '.$_POST['IP'.$j].'	<br>' ;
										}	
										
										
										
					$template .=  $lang['Equipment'].': '.$Equipment.'	<br>
								'.$lang['Model'].': '.$Model.'	<br></td>';
				
				if($j%3==0)
					$template .='</tr><tr>';				
			}
 
		$code_requester    = md5($requester_id);
		$code_room_man     = md5($Reference);
		$code_teamn        = md5($Reference.$requester_id);

		$link_update       = 'http://www.tamaani.ca/?Reference='.$Reference.'&lang='.$_POST['Language'];
			
		$header_team       = $lang['Pending_team_body']."<br><br> ".$lang['Mod_text']." <a href='".$link_update."&Code=".$code_teamn."#FormMod'>
								<strong style='color:#228cbe; font-size:18px;'>".$lang['click_here']."</strong> 
							</a>"; 	 ;
		
		$header_room_man   = $lang['Pending_team_body']."<br><br> ".$lang['Mod_text']." <a href='".$link_update."&Code=".$code_room_man."#FormMod'>
								<strong style='color:#228cbe; font-size:18px;'>".$lang['click_here']."</strong> 
							</a>"; 							
		
		$header_requester  = $lang['Pending_body']."<br><br>".$lang['Mod_text']." <a href='".$link_update."&Code=".$code_requester."#FormMod'>
								<strong style='color:#228cbe; font-size:18px;'>".$lang['click_here']."</strong> 
							</a>"; 							
						 
		$Subject           = 'Video Conference Request # '.$Reference ;
		$type              = '<span style="color:red">'.$lang['Pending_subject'].' # '.$Reference.'</span>' ;
		$footer            = $lang['footer_body'];
		
		
		send_confirmation_email($header_requester, $Subject, $Email, utf8_decode($ContactName), utf8_decode($template), $type, $footer);
		send_confirmation_email($header_team, $Subject, TO_EMAIL_conferencing, TO_NAME_conferencing, utf8_decode($template), $type, $footer);


		$requester_site = get_requester_site($requester_id);
		
		foreach ($requester_site as $site) {	
			send_confirmation_email($header_room_man, $Subject, $site['RREmail'], $site['RRContact'], $template, $type, $footer);									
		}	


			$resutl='ok';
		}
		else
			$resutl='no';
	
		
	}
	else
	{
		$resutl='no';
		
	}

	echo $resutl;
	
	?>