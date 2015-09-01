<?php
  // CHARA MOHAMED EL AMINE <neogatsu@hotmail.com>
  // Remarque : 100%
  $rubrique = 'site';

  include '../include/connexion.php';
  include '../include/fonctions.php';
  include './include/session_test.php';
  include './include/privilege_test.php';
  include '../include/parametres.php';

  /* Test de la validité des paramètres */
  if (!isset($_GET['session'])) {
    die('Paramètre manquant');
  } else {
    /* Le formaulire de la page en cours a été envoyé */
    if (isset($_POST['SiteName'])) {
      include './include/operation_message.php';
				
				$SiteName     = lecture($_POST['SiteName']);
				$RRContact    = lecture($_POST['RRContact']);
				$RRPhone      = lecture($_POST['RRPhone']);
				$RREmail      = lecture($_POST['RREmail']);
				$TecContact   = lecture($_POST['TecContact']);
				$TecPhone     = lecture($_POST['TecPhone']);
				$TecEmail     = lecture($_POST['TecEmail']);
				$IP           = lecture($_POST['IP']);
				
      if (isset($_GET['site_id'])) {
        $site_id = lecture($_GET['site_id']);
        $sql = "UPDATE site
                SET    SiteName          = '$SiteName',
					   RRContact		 = '$RRContact',
					   RRPhone           = '$RRPhone',
					   RREmail           = '$RREmail' ,
					   
					   TecContact		 = '$TecContact',
					   TecPhone          = '$TecPhone',
					   TecEmail          = '$TecEmail' ,					   
					   IP	             = '$IP'
					   
                WHERE  site_id           = '$site_id'
               ";
	    $res = executer($sql, __FILE__, __LINE__);
        operation_message('Change Completed', TRUE); 
      } else {
        $sql = "INSERT INTO site SET
								SiteName              = '$SiteName',
		   						RRContact		= '$RRContact',
								RRPhone         = '$RRPhone',
								RREmail         = '$RREmail' ,
								 
								TecContact		= '$TecContact',
								TecPhone        = '$TecPhone',
								TecEmail        = '$TecEmail' ,					   
								IP	            = '$IP', 
                          		active          = 'Y'
               ";
        /* Exécuter la requête et faire $site_id = @mysql_insert_id(); */
        $res = executer_id($sql, __FILE__, __LINE__, $site_id);
        operation_message('Done', FALSE);
      }
      exit();
    }
    /* Champs du formulaire */
    if (isset($_GET['site_id'])) {
      $site_id = lecture($_GET['site_id']);
      $sql = "SELECT *
              FROM   site
              WHERE  site_id = '$site_id'
             ";
      $res = executer($sql, __FILE__, __LINE__);
      $row = mysql_fetch_array($res);
      if ($row == FALSE) {
        die('Error');
      } else {
        $op                        = 'Update';
		
		$site_id          =  decode_text($row['site_id']);
		$SiteName         =  decode_text($row['SiteName']);
		
		$RRContact       =  decode_text($row['RRContact']);
		$RRPhone         =  decode_text($row['RRPhone']);
		$RREmail         =  decode_text($row['RREmail']);

		
		$TecContact      =  decode_text($row['TecContact']);
		$TecPhone        =  decode_text($row['TecPhone']);
		$TecEmail        =  decode_text($row['TecEmail']);
		$IP              =  decode_text($row['IP']);
        
      }
    } else {
        $op                        = 'Add';
		$site_id          = NULL;
		$SiteName         =  '';
		$RRContact        =  '';
		$RRPhone          =  '';
		$RREmail          =  '';

		$TecContact       =  '';
		$TecPhone         =  '';
		$TecEmail         =  '';
		$IP               =  '';
    }
  }
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
                      "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title><?php echo $op?> Site</title>
<link href="include/style_admin.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="../include/scripts.js"></script>
<script type="text/javascript" language="javascript">
<!--
  function verif()
  {
    if (document.form1.SiteName.value == "") {
      alert("Please enter the title");
      document.form1.SiteName.focus();
      return;
    }
    document.form1.submit();
  }
-->
</script>
</head>
<body bgcolor="#AAB7BD">
<!--*****************************************************************************************************
                        Ce formulaire sert pour la suppression des fichiers
******************************************************************************************************-->
<table align="center" width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" valign="middle" height="500">
      <!--*****************************************************************************************************
	                          Début de l'encadrement blanc
      ******************************************************************************************************-->  
	  <table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
	    <tr>
	      <td width="7" height="7"><img src="./images/cgh.gif" width="7" height="7" /></td>
 	      <td bgcolor="#FFFFFF" width="99%"></td>
	      <td width="7"><img src="./images/cdh.gif" width="7" height="7" /></td>
	      <td width="1"></td>
	    </tr>
	    <tr>
	      <td bgcolor="#FFFFFF" width="7"></td>
	      <td bgcolor="#FFFFFF">
		    <table align="center" width="100%" cellpadding="0" cellspacing="0">
		      <tr>
		        <td valign="top">
		          <!--*****************************************************************************************************
		                                  Début du contenu
                  ******************************************************************************************************-->
		          <table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
                    <tr valign="top">
                      <td colspan="2" height="10"></td>
                    </tr>
                    <tr valign="top" align="left">
                      <td width="15" height="25"></td>
                      <td>
                        <span class="titre">SITE</span>
                      </td>
                    </tr>
                    <tr>
			          <td colspan="2" height="2" bgcolor="#FF0000"></td>
                    </tr>
                    <tr valign="top" align="left">
                      <td height="25"></td>
                      <td class="text"><img src="./images/flnoir.gif" />&nbsp;<?php echo $op?>&nbsp; Site </td>
                    </tr>
                    <tr valign="top">
                      <td height="5"></td>
                      <td></td>
                    </tr>
                    <tr valign="top">
                      <td width="15" height="25"></td>
                      <td class="text">
                        <form action="" method="post" name="form1">
			              <!--*****************************************************************************************************
				                                  Début du formulaire
                          ******************************************************************************************************-->
                          <table width="95%" border="0" align="center" bgcolor="#FFFFFF" cellpadding="3">
                            
                        
                            <tr align="left">
                              <td class="obligatoire">
                               SITE NAME/LOCATION:
                              </td>
                              <td align="left" class="menutext">
                                <input name="SiteName" type="text" class='zone' id="SiteName" style="width:90%;" value="<?php echo $SiteName?>">
                              </td>
                            </tr>
        
          
                   <tr align="left">
                       <td colspan="2" width="98%" height="10px"> </td> 
                    </tr>
           
                            <tr align="left">
                                <td colspan="2" class="obligatoire">
                               	 	<span class="titre"> <strong>ROOM RESERVATION</strong></span>                              
                                </td>
                            </tr>
    
           
           
                         <tr align="left">
                              <td class="obligatoire">
                                CONTACT NAME
                              </td>
                              <td align="left" class="menutext">
                                <input name="RRContact" type="text" class='zone' id="RRContact" style="width:90%;" value="<?php echo $RRContact?>">
                              </td>
                            </tr>

                            
                            <tr align="left">
                              <td class="obligatoire">
                                  EMAIL
                              </td>
                              <td align="left" class="menutext">
                                <input name="RREmail" type="text" class='zone' id="RREmail" style="width:90%;" value="<?php echo $RREmail?>">
                              </td>
                            </tr> 
                            
                         <tr align="left">
                              <td class="obligatoire">
                                 PHONE:  
                              </td>
                              <td align="left" class="menutext">
                                <input name="RRPhone" type="text" class='zone' id="RRPhone" style="width:90%;" value="<?php echo $RRPhone?>">
                              </td>
                            </tr>  
      			<tr align="left">
                               <td colspan="2" width="98%" height="20px"  > </td> 
                            </tr>  

                        <tr align="left">
                                <td colspan="2" class="obligatoire">
                               	 	<span class="titre"> TECHNICAL CONTACT  </span>                              
                                </td>
                            </tr>

        
           
                            <tr align="left">
                              <td class="obligatoire">
                                CONTACT NAME
                              </td>
                              <td align="left" class="menutext">
                                <input name="TecContact" type="text" class='zone' id="TecContact" style="width:90%;" value="<?php echo $TecContact?>">
                              </td>
                            </tr>

                            
                            <tr align="left">
                              <td class="obligatoire">
                                EMAIL
                              </td>
                              <td align="left" class="menutext">
                                <input name="TecEmail" type="text" class='zone' id="TecEmail" style="width:90%;" value="<?php echo $TecEmail?>">
                              </td>
                            </tr> 
                            
                         <tr align="left">
                              <td class="obligatoire">
                                PHONE:  
                              </td>
                              <td align="left" class="menutext">
                                <input name="TecPhone" type="text" class='zone' id="TecPhone" style="width:90%;" value="<?php echo $TecPhone?>">
                              </td>
                            </tr>  
                            
                            
                
                            <tr align="left">
                              <td class="obligatoire">
                                 IP:
                              </td>
                              <td align="left" class="menutext">
                                <input name="IP" type="text" class='zone' id="IP" style="width:90%;" value="<?php echo $IP?>">
                              </td>
                            </tr>                          
                            
                                              
                               <tr align="left">
                               <td colspan="2" width="98%" height="20px"  > </td> 
                            </tr>  

			              </table>
			              <!--*****************************************************************************************************
				                                  Fin du formulaire				
                          ******************************************************************************************************-->			
			            </form>
                      </td>
                    </tr>
                    <tr>
                      <td height="25"></td>
                      <td align="center">
                        <table border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr>
<?php
if ($op == 'Add')
{
?>
                            <td>
                              <div style="cursor:hand" onclick="javascript:verif();">
                                <table width="75"  border="0" cellpadding="0" cellspacing="0" class="menutext">
                                  <tr>
                                    <td width="6"><img alt="" src="./images/boutton-gauche.gif" border="0" /></td>
                                    <td width="401" align="center" style="background-image:url(./images/boutton-fond.gif)">
                                      <?php echo $op?>
                                    </td>
                                    <td width="11"><img alt="" src="./images/boutton-droite.gif" border="0" /></td>
                                  </tr>
                                </table>
                              </div>
                            </td>
<?php
}

if ( $op == 'Update')
{
?>
                            <td>
                              <div style="cursor:hand" onclick="javascript:verif();">
                                <table width="75"  border="0" cellpadding="0" cellspacing="0" class="menutext">
                                  <tr>
                                    <td width="6"><img alt="" src="./images/boutton-gauche.gif" border="0" /></td>
                                    <td width="401" align="center" style="background-image:url(./images/boutton-fond.gif)">
                                      <?php echo $op?>
                                    </td>
                                    <td width="11"><img alt="" src="./images/boutton-droite.gif" border="0" /></td>
                                  </tr>
                                </table>
                              </div>
                            </td>
<?php
}
?>
				            <td width="25"></td>
				            <td>
				              <div style="cursor:hand" onClick="javascript: fermer_popup();">
					            <table width="75"  border="0" cellpadding="0" cellspacing="0" class="menutext">
                                  <tr>
                                    <td width="6"><img src="./images/boutton-gauche.gif" border="0" /></td>
                                    <td width="401" align="center" style="background-image:url(./images/boutton-fond.gif)">
                                      Close
                                    </td>
                                    <td width="11"><img src="./images/boutton-droite.gif" border="0" /></td>
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
                  <!--*****************************************************************************************************
		                                  Fin du contenu
                  ******************************************************************************************************-->
                </td>
              </tr>
            </table>
          </td>
          <td bgcolor="#FFFFFF" width="7"></td>
          <td bgcolor="#7A7B7B" width="1"></td>
        </tr>
        <tr>
          <td height="7" width="7"><img src="./images/cbg.gif" width="7" height="7" /></td>
          <td style="background-image:url(./images/b.gif)"></td>
          <td width="7"><img src="./images/cbd.gif" width="7" height="7" /></td>
          <td></td>
        </tr>
      </table>
      <!--*****************************************************************************************************
	                          Fin de l'encadrement blanc
      ******************************************************************************************************-->
	</td>
  </tr>
</table>
</body>
</html>