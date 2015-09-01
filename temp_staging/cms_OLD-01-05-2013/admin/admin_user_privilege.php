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
    par celui de l'utilisateur dont on veux changer les privilèges.
  */
  $user_id = $_GET['user_id'];

  /* Test de la validité des paramètres */
  if (!isset($_GET['session']) && 
      !isset($_GET['user_id'])) {
    die('Paramètres manquants');
  } else {
    /* Récupérer le nom de l'utilisateur */
    $sql = "SELECT admin_user_nom
            FROM   admin_user
            WHERE  admin_user_id = '$user_id'
           ";
    $res = executer($sql, __FILE__, __LINE__);
    if (mysql_num_rows($res) != 1) {
      die('Error');
    } else {
      $admin_user_nom = mysql_result($res, 0, 'admin_user_nom');
    }
    if (isset($_POST['admin_user_privilege'])) {
      /* Mettre à jour les privilèges */
      $privilege_select = (isset($_POST['privilege_select'])) ? $_POST['privilege_select'] : NULL;
      $privilege_update = (isset($_POST['privilege_update'])) ? $_POST['privilege_update'] : NULL;	 
      $privilege_insert = (isset($_POST['privilege_insert'])) ? $_POST['privilege_insert'] : NULL;
      $privilege_delete = (isset($_POST['privilege_delete'])) ? $_POST['privilege_delete'] : NULL;
      privilege_modifier($user_id, $privilege_select, $privilege_update, $privilege_insert, $privilege_delete);
      include 'include/operation_message.php'; 
      operation_message('Done', TRUE);	 
      exit();
    }
  }
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Modifier les privilèges</title>
<link href="include/style_admin.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="../include/scripts.js"></script>
<script type="text/javascript" language="javascript">
<!--
  function verif()
  {
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
	<table width="350" border="0" align="center" cellpadding="0" cellspacing="0">
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
                    <td width="98%"><span class="titre">Administrators</span></td>
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
	            Change user privileges : <b><?php echo $admin_user_nom?></b>
              </td>
            </tr>
            <tr valign="top">
              <td height="15"></td>
              <td></td>
            </tr>
            <tr valign="top">
              <td width="15" height="25"></td>
              <td class="text">
              <form action="" method="post" name="form1">
			  <input type="hidden" name="admin_user_privilege">
  			    <!--******************************************************************************
				                              Début du formulaire
				*******************************************************************************-->
				<table width="100%"  border="0" cellspacing="0" cellpadding="0">
				<tr>
				  <td valign="top">
                    <fieldset>
		              <legend>
					    <img src="./images/b_edit.png" width="16" height="16" border="0" align="absmiddle">
						Privileges :
					  </legend>
		              <br> 
                      <?php afficher_privilege($user_id, "form1"); ?>

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