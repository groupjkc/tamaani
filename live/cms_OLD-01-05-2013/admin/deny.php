<?php 
   include "../include/fonctions.php" ;
   include "../include/connexion_without_lang.php";
   
  $rubrique      = "requester"; 
  $admin_user_id = isset($_GET['admin_user_id'])? $_GET['admin_user_id'] : 0; 
  include "include/session_test.php"; //---> Tester la session et 
                                       //     Importer les variables $select, $mod, $insert, $delete
   
   include "include/operation_message.php";
   include "../include/requester.php";  //---> Les fonctions du module requester 	
   

   //---> Champs du formulaire
   if (isset($_GET['requester_id'])) 
   { //---> il s'agit d'une modification
	  
	 $sql = "SELECT *
	         FROM   requester
			 WHERE  requester_id = " . $_GET['requester_id'];
     $res = executer($sql,__FILE__,__LINE__); //---> Exécuter la requête
	 $row = mysql_fetch_array($res);
	 if ($row==FALSE)
	   die("Error");	     
	
		$Language        	= $row['Language'];
		
			switch($Language)
			{			
				  case 'fr':
					$DisplayLanguage = "French";
					break;
				  case 'in':
					$DisplayLanguage = "Nunavik ";
					break;
				
				default		: $DisplayLanguage = "English"; ; //---> La langue par défaut
			} //Fin switch


		$CompanyName		= stripslashes($row['CompanyName']);
		$PO			        = stripslashes($row['PO']);	
		$ContactName		= stripslashes($row['ContactName']);
		$Reference		    = stripslashes($row['Reference']);
		$Address		    = stripslashes($row['Address']);	
		$Town		        = stripslashes($row['Town']);	
		$Province			= stripslashes($row['Province']);	
		$Zip		        = stripslashes($row['Zip']);	
		$Email			    = stripslashes($row['Email']);	
		$WorkPhone 	    	= stripslashes($row['WorkPhone']);	
		
		$DateVC		        = stripslashes($row['DateVC']);	
		$TimeStart			= stripslashes($row['TimeStart']);	
		$TimeEnd		    = stripslashes($row['TimeEnd']);		
		$NbreSite 	    	= stripslashes($row['NbreSite']);
		$NunavikSite 	    = stripslashes($row['NunavikSite']);
		$requester_id       = $row['requester_id'];	
		
	 
   

	if (isset($_POST['reason'])){
		
		include('../../includes/config.php');
		include('../../includes/functions.php');
		include('../../includes/languages/'.$Language.'.php');
	 	
		
		/*send  to the requester*/
	   
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
									<td width="230"  style="padding-left:50px;" ><img src="http://beta.jkcommunications.com/tamaani2/images/bg_three_3.png" ></td>
								  </tr>
								  <tr>';			 
			 
			

			$site = "SELECT  	*
					 FROM   requester_site JOIN site 
							on  requester_site.site_id = site.site_id  where  requester_id= ".$requester_id ;
							
			$ressite = executer($site, __FILE__, __LINE__);
			$i=0;
			 
			while($rowSite = @mysql_fetch_array($ressite))
			{
		 
				$i++;
				$SiteName        = stripslashes($rowSite['SiteName']);
				$RRContact       =  stripslashes($rowSite['RRContact']);
				$RRPhone         =  stripslashes($rowSite['RRPhone']);
				$RREmail         =  stripslashes($rowSite['RREmail']);
				
				$TecContact      =  stripslashes($rowSite['TecContact']);
				$TecPhone        =  stripslashes($rowSite['TecPhone']);
				$TecEmail        =  stripslashes($rowSite['TecEmail']);

				$TechnologyUsed    = stripslashes($rowSite['TechnologyUsed']);
				$IP                = stripslashes($rowSite['IP']);
	
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

				  $template .=  '</td>';
					
					if($i%3==0)
						$template .='</tr><tr>';

			}
		 
			

		
		$header_requester  = $lang['Denied_body'].' '.$_POST['reason'].'.<br>'.$lang['Denied_body_plus'] ;
		$Subject           = 'Video Conference Request # '.$Reference ;
		$type              = '<span style="color:red">'.$lang['Denied_subject'].' # '.$Reference.'</span>' ;
		$footer            = $lang['footer_body'];
 

		if(send_confirmation_email($header_requester, $Subject, $Email, $ContactName, $template, $type, $footer)){
   			operation_message('Your Email is sent', TRUE); 
			requester_statut('D', $requester_id);
	  }
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
    if (document.form1.reason.value == "") {
      alert("Please enter the Reason");
      document.form1.reason.focus();
      return;
    }
    document.form1.submit();
  }
-->
</script>


<!--**************************************************************************************************
                                Fin nécessaires pour insérer le calendrier
***************************************************************************************************-->
</head>
<body bgcolor="#AAB7BD">
<!--*****************************************************************************************************
                        Ce formulaire sert pour la suppression des fichiers
******************************************************************************************************-->
<table align="center" width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" valign="middle" height="275">
      <!--*****************************************************************************************************
	                          Début de l'encadrement blanc
      ******************************************************************************************************-->  
	  <table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
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
		                                       Début du contenu
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
				                              Début du formulaire
				*******************************************************************************-->
                <table width="95%" border="0" align="center" bgcolor="#FFFFFF" cellpadding="3">
 

                    <tr align="left">
                       <td colspan="2"><span class="titre">DENY THE REQUEST #<?PHP echo $Reference ?> -<span style="color:red"> <?php echo $DisplayLanguage; ?></span>-</span></td> 
                    </tr>
                    
                    
                    <tr>
                      <td colspan="2" height="2" bgcolor="#FF0000"></td>
                    </tr>
                                       <tr align="left">
                       <td colspan="2" height="10px"> </td> 
                    </tr>
               
                <tr align="left">
                  <td width="19%" class="obligatoire">
				    Deny Reason: </td>
                  <td width="81%" align="left" class="menutext">
			        <textarea name="reason" type="text"   id="reason" rows="15"  cols="45"  ></textarea>
                  </td>
                </tr>
                   
                      <tr>
                      <td colspan="2" height="20"  ></td>
                    </tr>     
                                                                
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
                        <td width="45" align="center" style="background-image:url(./images/boutton-fond.gif)"> Deny</td>
                        <td width="71"><img alt="" src="./images/boutton-droite.gif" border="0" /></td>
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