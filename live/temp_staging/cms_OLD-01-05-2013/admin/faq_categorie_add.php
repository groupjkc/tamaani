<?php
  // CHARA MOHAMED EL AMINE <neogatsu@hotmail.com>
  // Remarque : 100%
  $rubrique = 'faq';

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
    if (isset($_POST['faq_categorie_titre_en']) && 
        isset($_POST['faq_categorie_titre_fr']) &&
		isset($_POST['faq_categorie_titre_in'])) {
      include './include/operation_message.php';
      $faq_categorie_titre_en       = lecture($_POST['faq_categorie_titre_en']);
	  $faq_categorie_titre_fr       = lecture($_POST['faq_categorie_titre_fr']);
	  $faq_categorie_titre_in       = lecture($_POST['faq_categorie_titre_in']);
	  
      if (isset($_GET['faq_categorie_id'])) {
        $faq_categorie_id = lecture($_GET['faq_categorie_id']);
        $sql = "UPDATE faq_categorie
                SET    faq_categorie_titre_en       = '$faq_categorie_titre_en',
					   faq_categorie_titre_fr		= '$faq_categorie_titre_fr',
					   faq_categorie_titre_in		= '$faq_categorie_titre_in'
                WHERE  faq_categorie_id          = '$faq_categorie_id'
               ";
	    $res = executer($sql, __FILE__, __LINE__);
        operation_message('Change Completed', TRUE); 
      } else {
        $sql = "INSERT INTO faq_categorie
                SET         faq_categorie_titre_en       = '$faq_categorie_titre_en',
					   		faq_categorie_titre_fr		= '$faq_categorie_titre_fr',
					   		faq_categorie_titre_in		= '$faq_categorie_titre_in',
                            faq_categorie_visible     = 'Y'
               ";
        /* Exécuter la requête et faire $faq_categorie_id = @mysql_insert_id(); */
        $res = executer_id($sql, __FILE__, __LINE__, $faq_categorie_id);
        operation_message('Done', FALSE);
      }
      exit();
    }
    /* Champs du formulaire */
    if (isset($_GET['faq_categorie_id'])) {
      $faq_categorie_id = lecture($_GET['faq_categorie_id']);
      $sql = "SELECT *
              FROM   faq_categorie
              WHERE  faq_categorie_id = '$faq_categorie_id'
             ";
      $res = executer($sql, __FILE__, __LINE__);
      $row = mysql_fetch_array($res);
      if ($row == FALSE) {
        die('Error');
      } else {
        $op                        = 'Update';
        $faq_categorie_id          = decode_text($row['faq_categorie_id']);
        $faq_categorie_titre_en    = decode_text($row['faq_categorie_titre_en']);
		$faq_categorie_titre_fr    = decode_text($row['faq_categorie_titre_fr']);
		$faq_categorie_titre_in    = decode_text($row['faq_categorie_titre_in']);
        
      }
    } else {
      $op                        = 'Add';
      $faq_categorie_id          = NULL;
      $faq_categorie_titre_en    = '';
	  $faq_categorie_titre_fr    = '';
	  $faq_categorie_titre_in    = '';
    }
  }
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
                      "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title><?php echo $op?> Category</title>
<link href="include/style_admin.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="../include/scripts.js"></script>
<script type="text/javascript" language="javascript">
<!--
  function verif()
  {
    if (document.form1.faq_categorie_titre_en.value == "") {
      alert("Please enter the title");
      document.form1.faq_categorie_titre_en.focus();
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
    <td align="center" valign="middle" height="275">
      <!--*****************************************************************************************************
	                          Début de l'encadrement blanc
      ******************************************************************************************************-->  
	  <table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
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
                        <span class="titre">FAQ</span>
                      </td>
                    </tr>
                    <tr>
			          <td colspan="2" height="2" bgcolor="#FF0000"></td>
                    </tr>
                    <tr valign="top" align="left">
                      <td height="25"></td>
                      <td class="text"><img src="./images/flnoir.gif" />&nbsp;<?php echo $op?>&nbsp; Category </td>
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
                              <td width="24%" class="obligatoire">
				                Titre En: *
				              </td>
                              <td width="76%" align="left" class="menutext">
			                    <input name="faq_categorie_titre_en" type="text" class='zone' id="faq_categorie_titre_en" style="width:325px;" value="<?php echo $faq_categorie_titre_en?>" />
			                  </td>
                            </tr>
                            <tr align="left">
                              <td class="obligatoire">
				                Titre Fr: *
				              </td>
                              <td align="left" class="menutext"><input name="faq_categorie_titre_fr" type="text" class='zone' id="faq_categorie_titre_fr" style="width:325px;" value="<?php echo $faq_categorie_titre_fr?>" /></td>
                            </tr>
                            <tr align="left">
                              <td class="obligatoire">
				                Titre In : *
				              </td>
                              <td align="left" class="menutext">
			                    <input name="faq_categorie_titre_in" type="text" class='zone' id="faq_categorie_titre_in" style="width:325px;" value="<?php echo $faq_categorie_titre_in?>" />
			                  </td>
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
if ($insert == 'Y' && $mod == 'N' && $op == 'Add')
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
elseif ($insert == 'Y' && $mod == 'Y' && $op == 'Add')
{
?>
                            <td>
                              <div style="cursor:hand" onclick="javascript:verif();">
                                <table width="75"  border="0" cellpadding="0" cellspacing="0" class="menutext">
                                  <tr>
                                    <td width="6"><img alt="" src="./images/boutton-gauche.gif" border="0" /></td>
                                    <td width="401" align="center" style="background-image:url(./images/boutton-fond.gif)"><?php echo $op?></td>
                                    <td width="11"><img alt="" src="./images/boutton-droite.gif" border="0" /></td>
                                  </tr>
                                </table>
                              </div>
                            </td>
<?php
}
elseif ($insert == 'Y' && $mod == 'Y' && $op == 'Update')
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
elseif ($insert == 'N' && $mod == 'Y' && $op == 'Update')
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