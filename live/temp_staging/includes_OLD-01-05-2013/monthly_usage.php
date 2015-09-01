<?php
session_start();
	
	include ('config.php'); 
	include ('functions.php'); 
	
 	$language = isset($_SESSION['lang'])  ? $_SESSION['lang']  : 'en';
 
	
	include('languages/'.$language.'.php'); 
	 
		
	 $IP     = $_SERVER['REMOTE_ADDR'];
	// $IP     = '64.184.194.73';
	
 		if (!isset($_COOKIE['Usage'])){

					$result= curl($IP);
					$_SESSION['UsageDetail'] =  $result;
					//setcookie("UsageDetail", json_encode($result), time()+600, '/'); 
				
					if ($result)
					{
							
							if (isset($result["STATUS"]))
								{
									switch($result["STATUS"])
									{
										case "200":
											if ($result["MAX"]!=0){
												$BW = ($result["MBWIN"]+$result["MBWOUT"])/$result["MAX"];
												$BW = $BW *100 ;
												$BW = round($BW);
											}
											else
												$BW = 0;
												
											$msgNbre = 1; 
											
											if($BW > 100)
												$img = '100' ;  
											else
												$img = $BW ;	
											break;
											
										case "404":
										
												$img = 'NA' ; 
												$msgNbre = 2;
											break;
					 		
										default:
												$img = 'NA' ; 
												$msgNbre = 3 ;
												
										}  
								}
								else  
								{
									$img = 'NA' ; 
									$msgNbre = 3; 
								} 
						}
						else  
						{
							$img = 'NA' ; 
							$msgNbre = 3; 
						}
						
							
						$_SESSION['msgNbre']  = $msgNbre;
						$_SESSION['img']      = $img;
						$_SESSION['STATUS']   = $result["STATUS"];
				}
	 
	 				
  
				switch($_SESSION['msgNbre'])
				{
				case 1:
					  $msg = $lang['Monthly_Usage']	;			  
				  break;
				case 2:
					  $msg =$lang['Non_Tamaani'] ;
				   break;
				default:
					$msg= $lang['Bandwidth_Info'];
				   
				}
				
	 
				
				$data = array();				
				$data['img']    = $_SESSION['img'];   
				$data['STATUS'] = $_SESSION['STATUS'];
				
				$data['msg']  = $msg;	
				$data         = json_encode($data);
				echo $data;
 
				setcookie("Usage", $data, time()+60*10, '/');
				


	
	?>