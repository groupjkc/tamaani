<?php
  // CHARA MOHAMED EL AMINE <neogatsu@hotmail.com>
  $rubrique = 'admin_user';

  include '../include/connexion.php';
  include '../include/fonctions.php';
  include '../include/admin_user.php';
  include './include/session_test.php'; /* Retourne $user_id de l'utilisateur en cours */
  include './include/privilege_test.php';
  include '../include/parametres.php';

  connect();
  /* 
    IMPORTANT ne pas deplacer ni supprimer cette ligne. Elle remplace le user_id de l'utilisateur en cours 
    par celui de l'utilisateur dont on veux changer les informations.
  */
  $user_id = $_GET['user_id'];

  /* Test de la validité des paramètres */
  if (!isset($_GET['session']) &&
      !isset($_GET['user_id'])) {
    die('Paramètres manquants');
  } else {
    /* Le formaulire de la page en cours a été envoyé */
    if (isset($_POST['admin_user_pouvoir']) && 
        isset($_POST['admin_user_nom']) && 
        isset($_POST['admin_user_description']) && 
        isset($_POST['admin_user_password']) && 
        isset($_POST['admin_user_password_confirm'])) {    
      include 'include/operation_message.php';
      $admin_user_pouvoir          = lecture($_POST['admin_user_pouvoir']);
      $admin_user_nom              = lecture($_POST['admin_user_nom']);
      $admin_user_description      = lecture($_POST['admin_user_description']);
      $admin_user_password         = strtolower(lecture($_POST['admin_user_password']));
      $admin_user_password_confirm = strtolower(lecture($_POST['admin_user_password_confirm']));
      if ($admin_user_password != '' && $admin_user_password_confirm != '') {
        if ($admin_user_password == $admin_user_password_confirm) {
          $admin_user_password = md5($admin_user_password);
          $sql = "UPDATE admin_user
                  SET    admin_user_nom         = '$admin_user_nom',
                         admin_user_pouvoir     = '$admin_user_pouvoir',
                         admin_user_description = '$admin_user_description',
                         admin_user_password    = '$admin_user_password'
                  WHERE  admin_user_id          = '$user_id'
                 ";
          $res = executer($sql, __FILE__, __LINE__);
          operation_message('Modification Terminée', TRUE);
        } else {
          operation_message('La confirmation du mot de passe n\'est pas correct', FALSE);
        }
      } else {
          if ($admin_user_password == '' && $admin_user_password_confirm == '') {
            $sql = "UPDATE admin_user
                    SET    admin_user_nom         = '$admin_user_nom',
                           admin_user_pouvoir     = '$admin_user_pouvoir',
                           admin_user_description = '$admin_user_description'
                    WHERE  admin_user_id          = '$user_id'
                   ";
            $res = executer($sql, __FILE__, __LINE__);
            operation_message('Modification Terminée (Pas de changement de Mot de Passe)', TRUE);
          } else {
            if (($admin_user_password != '' && $admin_user_password_confirm == '') || 
                ($admin_user_password == '' && $admin_user_password_confirm != '')) {
              operation_message('La confirmation du Mot de Passe n\'est pas correct', FALSE);
            }
          }
      }
      exit();
    }
    /* Champs du formulaire */
    $sql = "SELECT *
            FROM  admin_user
            WHERE admin_user_id = '$user_id'
           ";
    $res = executer($sql, __FILE__, __LINE__);
    $row = mysql_fetch_array($res);
    if ($row == FALSE) {
      die('Impossible de trouver l\'utilisateur');
    } else {
      $admin_user_pouvoir     = decode_text($row['admin_user_pouvoir']);
      $admin_user_nom         = decode_text($row['admin_user_nom']);
      $admin_user_description = decode_text($row['admin_user_description']);
      $admin_user_date        = date('d/m/Y', $row['admin_user_date']);
    }
  }
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Modifier un administrateur</title>
<link href="include/style_admin.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="../include/scripts.js"></script>
<script type="text/javascript" language="javascript">
<!--
function verif()
{
  if (document.form1.admin_user_nom.value == "") {
    alert("Please enter the Name");
    document.form1.admin_user_nom.focus();
    return;
  }

  document.form1.submit();
}
-->
</script>
</head>
<body bgcolor="#AAB7BD">
<table align="center" width="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
  <td align="center" valign="middle" height="350">
    <!--******************************************************************************************
	                                 Début de l'encadrement blanc
    *******************************************************************************************-->	  
	<table width="380" border="0" align="center" cellpadding="0" cellspacing="0">
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
            <tr valign="top" align="left">
              <td width="15" height="25"></td>
              <td>
                <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="98%"><span class="titre">Administrator</span></td>
                    <td width="2%"></td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td colspan="2" height="2" bgcolor="#FF0000"></td>
            </tr>
            <tr valign="top" align="left">
              <td height="25"></td>
              <td class="text">
                <img src="./images/flnoir.gif">
	            Update <span id="result_box" lang="en">administrator</span></td>
            </tr>
            <tr valign="top">
              <td height="15"></td>
              <td></td>
            </tr>
            <tr valign="top">
              <td width="15" height="25"></td>
              <td class="text">
              <form action="" method="post" name="form1">
			    <!--******************************************************************************
				                              Début du formulaire
				*******************************************************************************-->
				<table width="100%"  border="0" cellspacing="0" cellpadding="0">
				<tr>
				  <td width="45%" valign="top">
	                <fieldset>
		              <legend>		    
                        <img src="./images/b_browse.png" width="16" height="16" align="absmiddle">
			            Informations :
		              </legend>
                      <br>
					  <table width="95%"  border="0" align="center" bgcolor="#FFFFFF" cellpadding="3">
                      <tr align="left">
					    <td class="obligatoire">
					      Type : *
					    </td>
					    <td align="right" class="menutext">
    			          <select name="admin_user_pouvoir" class='zone' style="width:180px">
                          <option value="user" <?php echo ($admin_user_pouvoir == 'user' )? 'selected' : '' ?>>Agent</option>
                          <option value="admin" <?php echo ($admin_user_pouvoir == 'admin')? 'selected' : '' ?>>administrator</option>
                          </select>						  
						</td>						
					  </tr>
                      <tr align="left">
                        <td class="obligatoire">
                          Name : *
                        </td>
                        <td align="right" class="menutext">
			              <input name="admin_user_nom" type="text" value="<?php echo $admin_user_nom?>" class='zone' style="width:180px">
                        </td>
                      </tr> 
                      <tr align="left">
                        <td class="text">
                          Description :
                        </td>
                        <td align="right" class="menutext">
			              <textarea name="admin_user_description" rows="3" class='zone' style="width:180px" cols="20" ><?php echo $admin_user_description?></textarea>
                        </td>
                      </tr>
                      <tr align="left">
                        <td class="text">
						  Password :
						</td>
                        <td align="right" class="menutext">
			              <input name="admin_user_password" type="password" class='zone' style="width:180px">
                        </td>
                      </tr>                      
					  <tr align="left">
                        <td class="text">
						  Confirm the Password:
						</td>
                        <td align="right" class="menutext">
			              <input name="admin_user_password_confirm" type="password" class='zone' style="width:180px">
                        </td>
                      </tr>
                      <tr align="left">
                        <td class="text">Date : </td>
                        <td align="left">
                          <a class="menutext"><?php echo $admin_user_date?></a>
                        </td>
                      </tr>					  					  					    					   
					  </table>
					  <br>
		              <table align="center" width="90%" border="0" cellpadding="0" cellspacing="0">
					  <tr align="left">
					    <td class="obligatoire">
						* Required Field.
						</td>
				      </tr>
					  </table>
					  <br>
					</fieldset>
				  </td>
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
			        <div style="cursor:hand" onClick="javascript: verif();">
                      <table width="75"  border="0" cellpadding="0" cellspacing="0" class="menutext">
                        <tr>
                          <td width="6"><img src="./images/boutton-gauche.gif" border="0"></td>
                          <td width="401" align="center" style="background-image: url('images/boutton-fond.gif')">Update</td>
                          <td width="11"><img src="./images/boutton-droite.gif" border="0"></td>
                        </tr>
                      </table>
			        </div>
				  </td>
				  <td width="25">&nbsp;</td>
				  <td>
			        <div style="cursor:hand" onClick="javascript: fermer_popup();">
                      <table width="75"  border="0" cellpadding="0" cellspacing="0" class="menutext">
                        <tr>
                          <td width="6"><img src="./images/boutton-gauche.gif" border="0"></td>
                          <td width="401" align="center" style="background-image: url('images/boutton-fond.gif')">Close</td>
                          <td width="11"><img src="./images/boutton-droite.gif" border="0"></td>
                        </tr>
                      </table>
			        </div>
				  </td>
				</tr>
			    </table>
			  </td>
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
	  <td style="background-image: url('images/b.gif')"></td>
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