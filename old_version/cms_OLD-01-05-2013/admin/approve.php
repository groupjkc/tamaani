<?php 
   include "../include/fonctions.php" ;
   include "../include/connexion_without_lang.php";
   

  $rubrique      = "requester"; 
  $admin_user_id = isset($_GET['admin_user_id'])? $_GET['admin_user_id'] : 0; 
  include "include/session_test.php"; //---> Tester la session et 
                                       //     Importer les variables $select, $mod, $insert, $delete
   include "../include/requester.php";  //---> Les fonctions du module requester 											   
 include "include/operation_message.php";
   //---> Champs du formulaire
   if (isset($_GET['requester_id'])) 
   { //---> il s'agit d'une modification
	  
	 $sql = "SELECT *
	         FROM   requester
			 WHERE  requester_id = " . $_GET['requester_id'];
     $res = executer($sql,__FILE__,__LINE__); //---> Ex�cuter la requ�te
	 $row = mysql_fetch_array($res);

	 
	 if ($row==FALSE)
	   die("Error");	     
		
		$Language        	= $row['Language'];
		$CompanyName		= stripslashes($row['CompanyName']);
		$PO			        = stripslashes($row['PO']);	
		$Reference       	= stripslashes($row['Reference']);
		$ContactName		= stripslashes($row['ContactName']);	
		$Address		    = stripslashes($row['Address']);	
		$Town		        = stripslashes($row['Town']);	
		$Province			= stripslashes($row['Province']);	
		$Zip		        = stripslashes($row['Zip']);	
		$Email			    = stripslashes($row['Email']);	
		$WorkPhone 	    	= stripslashes($row['WorkPhone']);
		$NunavikSite     	= stripslashes($row['NunavikSite']);
		
		
		$DateVC		        = stripslashes($row['DateVC']);	
		$TimeStart			= stripslashes($row['TimeStart']);	
		$TimeEnd		    = stripslashes($row['TimeEnd']);		
		$NbreSite 	    	= stripslashes($row['NbreSite']);			
		$requester_id      = $row['requester_id'];				
	 

	if (isset($_POST['CompanyName'])){

			include('../../includes/languages/'.$Language.'.php');

			if(isset($_POST['requester_site_id'])){ 
				$requester_site_array = $_POST['requester_site_id'];
				$ISDN_array           = $_POST['ISDN'];

				$j=0;
				foreach($requester_site_array as $requester_site)
				{	
				
					$sql = "UPDATE requester_site 
					  SET    ISDNnumber = '$ISDN_array[$j]'
					  WHERE  requester_site_id=$requester_site     ";
					 $res = executer($sql, __FILE__, __LINE__);
				 
					$j++;
				   
				}
				
			}		
                                      	 

			$template='	<tr>
					  <td width="50%" align="left" valign="top"  style=" padding:0px 0 0px 50px; font-family:Arial, Helvetica, sans-serif; font-size:14px;">
					  <strong style="color:#228cbe; font-size:18px;">'.$lang['contact_info'].' <br></strong> 
						'.$lang['COMPANY'].'     : '.$CompanyName.'<br>
						'.$lang['PO'].'          : '.$PO.' <br>
						'.$lang['CONTACT_NAME'].': '.$ContactName.' <br>
						'.$lang['ADDRESS'] .    ': '.$Address.' <br>
						'.$lang['TOWN'] .       ': '.$Town.' <br>
						'.$lang['PROVINCE'] .   ': '.$Province.' <br>
						'.$lang['ZIP'].         ': '.$Zip.' <br>
						'.$lang['EMAIL'].       ': '.$Email.' <br>
						'.$lang['WORK_PHONE'].  ': '.$WorkPhone.' <br>
						<p><br>
						</p></td>
					  <td width="50%" align="left" valign="top"  style=" padding:0px 0 0px 50px; font-family:Arial, Helvetica, sans-serif; font-size:14px;">
					  <strong style="color:#228cbe; font-size:18px;">'.$lang['booking_detail'] .'<br></strong> 
						'.$lang['DateVC'].      ': '.$DateVC.'<br>
						'.$lang['TimeStart'].   ': '.$TimeStart.'<br>
						'.$lang['TimeEnd'].     ': '.$TimeEnd.'<br>
						'.$lang['NbreSite'].    ': '.$NbreSite.'<br>
						'.$lang['NUNAVIK_site'].': '.$NunavikSite.'</td>
					</tr>
					<tr>
					  <td colspan="3" style="font-size:14px; padding:10px 0 0px 0px;   "><table  border="0" cellspacing="0" cellpadding="0">
						  <tr>
							<td colspan="3" style="padding-left:50px;"><strong style="color:#228cbe; font-size:18px;ont-weight:bold; ">'.$lang['site_info'].'<br>  
							</strong></td>
						  </tr>
						  <tr>
							<td width="230"  style="padding-left:50px;"  align="left"><img src="http://beta.jkcommunications.com/tamaani2/images/bg_three_1.png" ></td>
							<td width="230"  style="padding-left:50px;"  align="left"><img src="http://beta.jkcommunications.com/tamaani2/images/bg_three_2.png" ></td>
							<td width="230"  style="padding-left:50px;"   ><img src="http://beta.jkcommunications.com/tamaani2/images/bg_three_3.png" ></td>
						  </tr>
						  <tr>';



			 $sqlSites = "SELECT  *
						 FROM   requester_site JOIN site 
							on  requester_site.site_id = site.site_id  where  requester_id= ".$requester_id ;
							
    		 $resSites = executer($sqlSites,__FILE__,__LINE__); //---> Ex�cuter la requ�te
			 
			$i=0;
	 
			while($rowSite = @mysql_fetch_array($resSites))
			{
		 
				$i++;
				$SiteName         = stripslashes($rowSite['SiteName']);

				$RRContact       =  stripslashes($rowSite['RRContact']);
				$RRPhone         =  stripslashes($rowSite['RRPhone']);
				$RREmail         =  stripslashes($rowSite['RREmail']);
				
				$TecContact      =  stripslashes($rowSite['TecContact']);
				$TecPhone        =  stripslashes($rowSite['TecPhone']);
				$TecEmail        =  stripslashes($rowSite['TecEmail']);
				$TechnologyUsed   = stripslashes($rowSite['TechnologyUsed']);
				$IP               = stripslashes($rowSite['IP']);				
				$ISDNnumber       = stripslashes($rowSite['ISDNnumber']);
				 
				$template .='<td width="315"  align="left" style="padding-left:50px; padding-top:10px; font-family:Arial, Helvetica, sans-serif; font-size:14px; ">
								<strong  style=" color:#228cbe;">SITE   '.$i.' <br> </strong> 
										'.$lang['SiteName'].':  '.$SiteName.'	<br><br>
										
										 <strong>'.$lang['RR'].': </strong><br>
										'.$lang['NAME'].': '.$RRContact.'	<br>
										'.$lang['EMAIL'].': '.$RREmail.'	<br>
										'.$lang['PHONE'].': '.$RRPhone.'	<br><br>
										
										 <strong>'.$lang['Tec'].': </strong><br>
										'.$lang['NAME'].': '.$TecContact.'	<br>
										'.$lang['EMAIL'].': '.$TecEmail.'	<br>
										'.$lang['PHONE'].': '.$TecPhone.'	<br>										
			  
										'.$lang['TechnologyUsed'].':  '.$TechnologyUsed.'	<br>';
										
										if($TechnologyUsed=='IP') {
											$template .='IP:                 '.$IP.'	<br>' ;
										}
										else {
											$template .='ISDN number:                 '.$ISDNnumber.'	<br>';
										}	
 
				  $template .= '</td>';
					
					if($i%3==0)
						$template .='</tr><tr>';

			}
		 
			

	 		/*send  to the tamaani team, Room team and the requester*/

			$header_team       = $lang['Approved_team_body'] ;
			$header_requester  = $lang['Approved_body'] ;
			$header_room_man   = 'The following video conferencing form has been approved. <br>Please verify that requestor has made the proper room reservation. ';
			
			
			$Subject           = 'Video Conference Request # '.$Reference ;
			$type              = '<span style="color:green">'.$lang['Approved_subject'].' # '.$Reference.'</span>' ;
			$footer            = $lang['footer_body'];
			
			include('../../includes/config.php');
			include('../../includes/functions.php');			
			
			$requester_site = get_requester_site($requester_id);
			 
	
			send_confirmation_email($header_requester, $Subject, $Email, $ContactName, $template, $type, $footer);
			send_confirmation_email($header_team, $Subject, TO_EMAIL_conferencing, TO_NAME_conferencing, $template, $type, $footer);		
		
			$requester_site = get_requester_site($requester_id);							
			
			foreach ($requester_site as $site) {	
				send_confirmation_email($header_room_man, $Subject, $site['RREmail'], $site['RRContact'], $template, $type, $footer);									
			}			
			
   			operation_message('Your Email is sent', TRUE); 
			requester_statut('A', $requester_id);
	   
	exit();

 
	}
}
 


?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title> Request</title>
<link href="include/style_admin.css" rel="stylesheet" type="text/css">
<link href="../../css/style.css" rel="stylesheet" type="text/css">

<script language="JavaScript" src="../include/scripts.js"></script>

<script type="text/javascript" language="javascript">
<!--
  function verif()
  {
	 
    document.form1.submit();
  }
-->
</script>



<!--**************************************************************************************************
                                Fin n�cessaires pour ins�rer le calendrier
***************************************************************************************************-->
</head>
<body bgcolor="#AAB7BD">
<!--*****************************************************************************************************
                        Ce formulaire sert pour la suppression des fichiers
******************************************************************************************************-->
<form method="post" name="delete_file">
  <input name="file" type="hidden" value="image">
</form>
<table align="center" width="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
  <td align="center" valign="middle" >
    <!--******************************************************************************************
	                                 D�but de l'encadrement blanc
    *******************************************************************************************-->	  
	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr>
	  <td width="7" height="7"><img src="./images/cgh.gif" width="7" height="7"></td>
 	  <td bgcolor="#FFFFFF" width="99%"></td>
	  <td width="7"><img src="./images/cdh.gif" width="7" height="7"></td>
	  <td width="1"></td>
	</tr>
	<tr>
	  <td bgcolor="#FFFFFF" width="7"></td>
	  <td bgcolor="#FFFFFF">
		<table align="center" width="100%" cellpadding="0" cellspacing="0">
		<tr>
		  <td valign="top">
		  <!--*************************************************************************************
		                                       D�but du contenu
		  **************************************************************************************-->
		    <table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
            <tr valign="top">
              <td colspan="2" height="10"></td>
            </tr>
			

           
            <tr valign="top">
              <td width="15" height="25"></td>
              <td class="text">
              <form action="" method="post" name="form1" enctype="multipart/form-data">
			    <!--******************************************************************************
				                              D�but du formulaire
				*******************************************************************************-->
                <table width="95%" border="0" align="center" bgcolor="#FFFFFF" cellpadding="3">
 

                    <tr align="left">
                       <td colspan="2" width="98%"><span class="titre">CONTACT & BILLING INFO </span></td> 
                    </tr>
                    
                    
                    <tr>
                      <td colspan="2" height="2" bgcolor="#FF0000"></td>
                    </tr>
                                       <tr align="left">
                       <td colspan="2" width="98%" height="10px"> </td> 
                    </tr>
               
                <tr align="left">
                  <td width="28%" class="obligatoire">
				    COMPANY/DEPARTMENT NAME: </td>
                  <td width="72%" align="left" class="menutext">
			        <input name="CompanyName" type="text"   class='zone' id="CompanyName" style="width:90%; color:#999;" value="<?php echo $CompanyName?>" readonly="readonly">
                  </td>
                </tr>

                <tr align="left">
                  <td class="obligatoire">
				    P.O. #: </td>
                  <td align="left" class="menutext">
			        <input name="PO" type="text"  class='zone' style="width:90%; color:#999;" value="<?php echo $PO?>" readonly="readonly">
                  </td>
                </tr>
                
                <tr align="left">
                  <td class="obligatoire">
				    CONTACT NAME: </td>
                  <td align="left" class="menutext">
			        <input name="ContactName" type="text"  class='zone' style="width:90%; color:#999;" value="<?php echo $ContactName?>" readonly="readonly">
                  </td>
                </tr>                 
 
                <tr align="left">
                  <td class="obligatoire">
				    ADDRESS: 
				  </td>
                  <td align="left" class="menutext">
			        <input name="Address" type="text"  class='zone' id="Address" style="width:90%; color:#999;" value="<?php echo $Address?>" readonly="readonly">
                  </td>
                </tr>
 
                <tr align="left">
                  <td class="obligatoire">
				    TOWN: 
				  </td>
                  <td align="left" class="menutext">
			        <input name="Town" type="text"  class='zone' id="Town" style="width:90%; color:#999;" value="<?php echo $Town?>" readonly="readonly">
                  </td>
                </tr>
                
                <tr align="left">
                  <td class="obligatoire">
				    PROVINCE/STATE:  
				  </td>
                  <td align="left" class="menutext">
			        <input name="Province" type="text"  class='zone' id="Province" style="width:90%; color:#999;" value="<?php echo $Province?>" readonly="readonly">
                  </td>
                </tr> 
                
          	 <tr align="left">
                  <td class="obligatoire">
				    OSTAL/ZIP CODE: 
				  </td>
                  <td align="left" class="menutext">
			        <input name="Zip" type="text"  class='zone' id="Zip" style="width:90%; color:#999;" value="<?php echo $Zip?>" readonly="readonly">
                  </td>
                </tr>
 
                <tr align="left">
                  <td class="obligatoire">
				    EMAIL: 
				  </td>
                  <td align="left" class="menutext">
			        <input name="Email" type="text"  class='zone' id="Email" style="width:90%; color:#999;" value="<?php echo $Email?>" readonly="readonly">
                  </td>
                </tr>
                
                <tr align="left">
                  <td class="obligatoire">
				    WORK PHONE: 
				  </td>
                  <td align="left" class="menutext">
			        <input name="WorkPhone" type="text"  class='zone' id="WorkPhone" style="width:90%; color:#999;" value="<?php echo $WorkPhone?>" readonly="readonly">
                  </td>
                </tr>
                

                    <tr align="left">
                       <td colspan="2" width="98%" height="30px"> </td> 
                    </tr>
    
                
                    <tr align="left">
                       <td colspan="2" width="98%"><span class="titre">BOOKING DETAILS</span></td> 
                    </tr>
    
                    <tr>
                      <td colspan="2" height="2" bgcolor="#FF0000"></td>
                    </tr>  
                    
                   <tr align="left">
                       <td colspan="2" width="98%" height="10px"> </td> 
                    </tr>
                    
                    <tr align="left">
                      <td class="obligatoire">
                       DATE OF VC 
                      </td>
                      <td align="left" class="menutext">
                        <input name="DateVC" type="text"  class='zone' id="DateVC" style="width:90%; color:#999;" value="<?php echo $DateVC?>" readonly="readonly"  >
                      </td>
                    </tr>
      
                    <tr align="left">
                      <td class="obligatoire">
                       START TIME 
                      </td>
                      <td align="left" class="menutext">
                        <input name="TimeStart" type="text"  class='zone' id="TimeStart" style="width:90%; color:#999;" value="<?php echo $TimeStart?>" readonly="readonly">
                      </td>
                    </tr>
                    
                    <tr align="left">
                      <td class="obligatoire">
                       ESTIMATED END TIME: 
                      </td>
                      <td align="left" class="menutext">
                        <input name="TimeEnd" type="text"  class='zone' id="TimeEnd" style="width:90%; color:#999;" value="<?php echo $TimeEnd?>" readonly="readonly">
                      </td>
                    </tr>    
                    
                    
                    <tr align="left">
                      <td class="obligatoire">
                      HOW MANY SITES
                      </td>
                      <td align="left" class="menutext">
                        <input name="NbreSite" type="text"  class='zone' id="NbreSite" style="width:90%; color:#999;" value="<?php echo $NbreSite?>" readonly="readonly">
                      </td>
                    </tr>
                    



                    <tr align="left">
                       <td colspan="2" width="98%" height="30px"> </td> 
                    </tr>
    
                
                    <tr align="left">
                       <td colspan="2" width="98%"><span class="titre">SITE INFO</span></td> 
                    </tr>
    
                    <tr>
                      <td colspan="2" height="2" bgcolor="#FF0000"></td>
                    </tr>  
                    
                   <tr align="left">
                       <td colspan="2" width="98%" height="10px"> </td> 
                    </tr>
                   
                   
                   <?php  
				   
				         $site = "SELECT  	*
             						 FROM   requester_site JOIN site 
              								on  requester_site.site_id = site.site_id  where  requester_id= ".$requester_id ;
											
					
					    $ressite = executer($site, __FILE__, __LINE__);
						$i=0;
					    while($rowSite = @mysql_fetch_array($ressite))
    					{
							$i++;
							$requester_site_id = stripslashes($rowSite['requester_site_id']);
							$SiteName          = stripslashes($rowSite['SiteName']);

							$RRContact       =  stripslashes($rowSite['RRContact']);
							$RRPhone         =  stripslashes($rowSite['RRPhone']);
							$RREmail         =  stripslashes($rowSite['RREmail']);
							
							$TecContact      =  stripslashes($rowSite['TecContact']);
							$TecPhone        =  stripslashes($rowSite['TecPhone']);
							$TecEmail        =  stripslashes($rowSite['TecEmail']);

							$TechnologyUsed    = stripslashes($rowSite['TechnologyUsed']);
							$IP                = stripslashes($rowSite['IP']);
				   ?>
                    
                    <tr align="left">
                       <td colspan="2" width="98%" height="20px" class="titre">Site Detail <?php echo $i?></td> 
                    </tr>
                    

      
                    <tr align="left">
                      <td class="obligatoire">
                       SITE NAME/LOCATION:
                         <br>
                         <br></td>
                      <td align="left" class="menutext">
                        <input name="SiteName" type="text"  class='zone' id="SiteName" style="width:90%; color:#999;" value="<?php echo $SiteName?>" readonly="readonly">
                      </td>
                    </tr>


  
                   <tr align="left">
                        <td colspan="2" class="obligatoire">
                            <span class="text"> <strong>ROOM RESERVATION</strong></span>                              
                        </td>
                    </tr>
      

                    <tr align="left">
                      <td class="obligatoire">
                       CONTACT NAME
                      </td>
                      <td align="left" class="menutext">
                        <input name="RRContact" type="text" class='zone' id="RRContact" style="width:90%; color:#999;" value="<?php echo $RRContact?>" readonly="readonly">
                      </td>
                    </tr>


                    <tr align="left">
                      <td class="obligatoire">
                    	 EMAIL
                      </td>
                      <td align="left" class="menutext">
                        <input name="RREmail" type="text" class='zone' id="RREmail" style="width:90%; color:#999;" value="<?php echo $RREmail?>" readonly="readonly">
                      </td>
                    </tr> 
                    
                 <tr align="left">
                      <td class="obligatoire">
                    	 PHONE:  
                           <br>
                           <br></td>
                      <td align="left" class="menutext">
                        <input name="RRPhone" type="text" class='zone' id="SiteWorkPhone" style="width:90%; color:#999;" value="<?php echo $RRPhone?>" readonly="readonly">
                      </td>
                    </tr>  




               			 <tr align="left">
                                <td colspan="2" class="obligatoire">
                               	 	<span class="text"> <strong>TECHNICAL CONTACT </strong></span>                              
                                </td>
                            </tr>
      

                    <tr align="left">
                      <td class="obligatoire">
                       CONTACT NAME
                      </td>
                      <td align="left" class="menutext">
                        <input name="TecContact" type="text" class='zone' id="TecContact" style="width:90%; color:#999;" value="<?php echo $TecContact?>" readonly="readonly">
                      </td>
                    </tr>


                    <tr align="left">
                        <td class="obligatoire">
                         EMAIL
                        </td>
                        <td align="left" class="menutext">
                        <input name="TecEmail" type="text" class='zone' id="TecEmail" style="width:90%; color:#999;" value="<?php echo $TecEmail?>" readonly="readonly">
                        </td>
                    </tr> 
                    
                 <tr align="left">
                      <td class="obligatoire">
                    	 PHONE:  
                      </td>
                      <td align="left" class="menutext">
                        <input name="TecPhone" type="text" class='zone' id="SiteWorkPhone" style="width:90%; color:#999;" value="<?php echo $TecPhone?>" readonly="readonly">
                      </td>
                    </tr>  
  
  
     
                    <tr align="left">
                      <td class="obligatoire">
                    	 TECHNOLOGY USED:  
                      </td>
                      
                     
                      <td align="left" class="menutext">
                        <input name="TechnologyUsed" type="text"  class='zone' id="TechnologyUsed" style="width:90%; color:#999;" 
                        value="<?php echo $TechnologyUsed?>" readonly="readonly">
                      </td>
                    </tr>
  					
                     <?php if($TechnologyUsed=='IP') {?>
                    <tr align="left">
                      <td class="obligatoire">
                    	 IP:
                      </td>
                      <td align="left" class="menutext">
                        <input name="IP" type="text"  class='zone' id="IP" style="width:90%; color:#999;" value="<?php echo $IP?>" readonly="readonly">
                      </td>
                    </tr>
                    <?php }else {?>
                    <tr align="left">
                      <td class="obligatoire">
                    	 ISDN number:
                      </td>
                      <td align="left" class="menutext">
                       <input type="hidden" name="requester_site_id[]" value="<?php echo $requester_site_id?>" />
                       <input name="ISDN[]" type="text" class='zone'   style="width:90%; border:#F00 solid;" value="">
                      </td>
                    </tr>    
                     <?php }?>                
                    
                    
                            
                       <tr align="left">
                       <td colspan="2" width="98%" height="20px"  > </td> 
                    </tr>                                    
		
					<?php }?>
                                                                
			    </table>
			    <!--******************************************************************************
				                               Fin du formulaire				
				*******************************************************************************-->				
			  </form>
              </td>
            </tr>
            <tr>
              <td height="25"></td>
              <td align="center">
			    <table border="0" align="center" cellpadding="0" cellspacing="0">
				<tr>
                 
                 <td>
                  <div style="cursor: pointer" onclick="javascript:verif();">
                    <table width="122"  border="0" cellpadding="0" cellspacing="0" class="menutext">
                      <tr>
                        <td width="6"  ><img alt="" src="./images/boutton-gauche.gif" border="0" /></td>
                        <td width="86" align="left" style="background-image:url(./images/boutton-fond.gif)">Send Approval</td>
                        <td width="26"><img alt="" src="./images/boutton-droite.gif" border="0" /></td>
                      </tr>
                    </table>
                  </div>
                </td>               
                  
				  <td width="25">&nbsp;</td>
				  <td>
				    <div style="cursor:pointer" onClick="javascript: fermer_popup();">
					  <table width="75"  border="0" cellpadding="0" cellspacing="0" class="menutext">
                      <tr>
                        <td width="6"><img src="./images/boutton-gauche.gif" border="0"></td>
                        <td width="401" align="center" style="background-image:url(./images/boutton-fond.gif)">close</td>                    
                        <td width="11"><img src="./images/boutton-droite.gif" border="0"></td>
                      </tr>
                    </table>
				    </div>
				  </td>
				</tr>
			    </table>
			  </td>
            </tr>
            <tr>
			  <td height="10"></td>
			</tr>																		
            </table>
		  <!--*************************************************************************************
		                                       Fin du contenu
		  **************************************************************************************-->
		  </td>
		</tr>
		</table>
	  </td>
	  <td bgcolor="#FFFFFF" width="7"></td>		
	  <td bgcolor="#7A7B7B" width="1"></td>	  
	</tr>
	<tr>
	  <td height="7" width="7"><img src="./images/cbg.gif" width="7" height="7"></td>
	  <td style="background-image:url(./images/b.gif)"></td>
	  <td width="7"><img src="./images/cbd.gif" width="7" height="7"></td>
	  <td></td>
	</tr>	  
	</table>
    <!--******************************************************************************************
	                                   Fin de l'encadrement blanc
    *******************************************************************************************-->	
  </td>	
</tr>
</table>	
</body>
</html>