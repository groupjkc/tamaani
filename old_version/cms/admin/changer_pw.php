<?php 
  // CHARA MOHAMED EL AMINE <neogatsu@hotmail.com>
  $rubrique = 'admin_user';

  include '../include/connexion.php';
  include '../include/fonctions.php';
  include './include/session_test.php';
  include './include/privilege_test.php';
  include '../include/parametres.php';
   
  connect();

  /* Le formaulire de la page en cours a été envoyé */
  $msg = '';
  if (isset($_POST['user_password']) &&
      isset($_POST['user_password_ancien']) &&
      isset($_POST['user_password_confirm'])) {
    $user_password         = strtolower(lecture($_POST['user_password']));
    $user_password         = md5($user_password);
    $user_password_ancien  = strtolower(lecture($_POST['user_password_ancien']));
    $user_password_ancien  = md5($user_password_ancien);
    $user_password_confirm = strtolower(lecture($_POST['user_password_confirm']));
    $user_password_confirm = md5($user_password_confirm);
    /* Ancien mot de passe correct */
    $sql = "SELECT *
            FROM   admin_user
            WHERE  admin_user_id = '$user_id' AND admin_user_password = '$user_password_ancien'
           ";
    $res = executer($sql, __FILE__, __LINE__);
    $row = mysql_fetch_array($res);
    if ($row == FALSE) {
      $msg = 'Mot de passe incorrect';
    } else {
      /* ok ! il s'agit d'une modification */
      if ($user_password == $user_password_confirm) {
        $sql = "UPDATE admin_user
                SET    admin_user_password = '$user_password'
                WHERE  admin_user_id = '$user_id' AND admin_user_password = '$user_password_ancien'
               ";
        $res = executer($sql, __FILE__, __LINE__);
        $msg = 'Le mot de passe a été correctement modifié';
      } else {
        die('La confirmation du mot de passe n\'est pas correct');
      }
    }
    if ($msg != '') {
      include './include/operation_message.php';
      operation_message($msg, FALSE);
      exit();
    } else {
      include 'include/operation_message.php';
      operation_message('Modification terminée', TRUE);
      exit();   
    }
  }
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Changer votre mot de passe</title>
<link href="include/style_admin.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="../include/scripts.js"></script>
<script type="text/javascript" language="javascript">
<!--
function verif()
{
  if (document.form1.user_password_ancien.value == "") {
    alert("Please enter your current password");
    document.form1.user_password_ancien.focus();
    return;
  }

  if (document.form1.user_password.value == "") {
    alert("Please intoduire new password");
    document.form1.user_password.focus();	  
    return;
  }

  if (document.form1.user_password.value != document.form1.user_password_confirm.value) {
    alert("Confirmation of the password is not correct");
    document.form1.user_password.focus();
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
  <td align="center" valign="middle" height="225">
    <!--******************************************************************************************
	                                 Début de l'encadrement blanc
    *******************************************************************************************-->	  
	<table width="450" border="0" align="center" cellpadding="0" cellspacing="0">
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
	            Change your password
              </td>
            </tr>
            <tr valign="top">
              <td height="5"></td>
              <td></td>
            </tr>
            <tr valign="top">
              <td width="15" height="25"></td>
              <td class="text">
              <form action="" method="post" name="form1">
			    <!--******************************************************************************
				                              Début du formulaire
				*******************************************************************************-->
                <table width="95%"  border="0" align="center" bgcolor="#FFFFFF" cellpadding="3">
                <tr align="left">
                  <td class="obligatoire">
				    Current Password:: *
				  </td>
                  <td align="right" class="menutext">
			        <input name="user_password_ancien" type="password" size="30" class='zone'>
                  </td>
                </tr>
                <tr align="left">
                  <td class="obligatoire">
				    New Password: *
				  </td>
                  <td align="right" class="menutext">
			        <input name="user_password" type="password" size="30" class='zone'>
                  </td>
                </tr>                      
				<tr align="left">
                  <td class="obligatoire">
				    Confirm password : *
				  </td>
                  <td align="right" class="menutext">
			        <input name="user_password_confirm" type="password" size="30" class='zone'>
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
                        <td width="401" align="center" style="background-image:url(./images/boutton-fond.gif)">Update</td>                    
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
                        <td width="401" align="center" style="background-image:url(./images/boutton-fond.gif)">Close</td>                    
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