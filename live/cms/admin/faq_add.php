<?php
  // CHARA MOHAMED EL AMINE <neogatsu@hotmail.com>
  // Remarque : 100%
  $rubrique = 'faq';

  include '../include/connexion.php';
  include '../include/fonctions.php';
  include '../include/faq.php';
  include './include/session_test.php';
  include './include/privilege_test.php';
  include '../include/parametres.php';

  /* Mettre à jour le TIMESTAMP de l'ouverture de la session */
  $now = time();
  $sql = "UPDATE session_admin
          SET    dat_ouv_ses = '$now'
          WHERE  user_id     = '$user_id'
         ";
  executer($sql, __FILE__, __LINE__);

  /* Test de la validité des paramètres */
  if (!isset($_GET['session'])) {
    die('Paramètre manquant');
  } else {
    /* Récupérer le titre de la catégorie */
    if (isset($_GET['faq_categorie_id'])) {
      $faq_categorie_id = lecture($_GET['faq_categorie_id']);
      $sql = "SELECT faq_categorie_titre_en 
              FROM   faq_categorie
              WHERE  faq_categorie_id = '$faq_categorie_id'
             ";
      $res = executer($sql, __FILE__, __LINE__);
      if (mysql_num_rows($res) != 1) {
        die('Paramètres invalides');
      } else {
        $faq_categorie_titre_en = affichage(mysql_result($res, 0, 'faq_categorie_titre_en'));
      }
    }
    /* Le formulaire de la page en cours a été envoyé */
    if (isset($_POST['faq_question_en']) && 
        isset($_POST['faq_reponse_en'])) {
      include 'include/operation_message.php';
      $faq_question_en = lecture($_POST['faq_question_en']);
      $faq_reponse_en  = lecture($_POST['faq_reponse_en']);
	  
	  $faq_question_fr = lecture($_POST['faq_question_fr']);
      $faq_reponse_fr  = lecture($_POST['faq_reponse_fr']);
	  
	  $faq_question_in = lecture($_POST['faq_question_in']);
      $faq_reponse_in  = lecture($_POST['faq_reponse_in']);
      if (isset($_GET['faq_id'])) {
        $faq_id = lecture($_GET['faq_id']);
        $sql    = "UPDATE faq
                   SET    faq_question_en = '$faq_question_en',
                          faq_reponse_en  = '$faq_reponse_en',
						  faq_question_fr = '$faq_question_fr',
						  faq_reponse_fr  = '$faq_reponse_fr',
						  faq_question_in = '$faq_question_in',
						  faq_reponse_in  = '$faq_reponse_in'
                   WHERE  faq_id          = '$faq_id'
                  ";
        $res = executer($sql, __FILE__, __LINE__);
        operation_message('Change Completed', TRUE);
      } else {
        $faq_categorie_id = lecture($_GET['faq_categorie_id']);
        $sql = "INSERT INTO faq
                SET         faq_categorie_id = '$faq_categorie_id',
                            faq_question_en     = '$faq_question_en',
                            faq_reponse_en      = '$faq_reponse_en',
							faq_question_fr     = '$faq_question_fr',
							faq_reponse_fr      = '$faq_reponse_fr',
							faq_question_in     = '$faq_question_in',
							faq_reponse_in      = '$faq_reponse_in',
                            faq_visible      = 'Y'
               ";
        /* Exécuter la requête et faire $faq_id = @mysql_insert_id(); */
        $res = executer_id($sql, __FILE__, __LINE__, $faq_id);
        /* faq ORDRE */
        $sql = "UPDATE faq
                SET    faq_ordre = faq_id
                WHERE  faq_id    = '$faq_id'
               ";
        $res = executer($sql, __FILE__, __LINE__);
        operation_message('Done', FALSE);
      }
      exit();
    }
    /* Champs du formulaire */
    if (isset($_GET['faq_id'])) {
      $faq_id = lecture($_GET['faq_id']);
      $sql = "SELECT *
              FROM   faq
              WHERE  faq_id = '$faq_id'
             ";
      $res = executer($sql, __FILE__, __LINE__);
      $row = mysql_fetch_array($res);
      if ($row == FALSE) {
        die('Impossible de trouver la faq');
      } else {
        $op           = 'Update';
        $faq_id       = decode_text($row['faq_id']);
        $faq_question_en = decode_text($row['faq_question_en']);
        $faq_reponse_en  = decode_text($row['faq_reponse_en']);
		
        $faq_question_fr = decode_text($row['faq_question_fr']);
        $faq_reponse_fr  = decode_text($row['faq_reponse_fr']);
		
        $faq_question_in = decode_text($row['faq_question_in']);
        $faq_reponse_in  = decode_text($row['faq_reponse_in']);		
      }
    } else {
      $op           = 'Add';
      $faq_id       = NULL;
      $faq_question_en = '';
      $faq_reponse_en  = '';
	
	  $faq_question_fr = '';
	  $faq_reponse_fr  = '';
	  $faq_question_in = '';
	  $faq_reponse_in  = '';
	  
	  
	  
    }
  }
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
                      "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title><?php echo $op?>  faq</title>
<link href="include/style_admin.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="../include/scripts.js"></script>
<script type="text/javascript" language="javascript">
<!--
  function verif()
  {
    if (document.form1.faq_question_en.value == "") {
      alert("Please enter a question");
      document.form1.faq_question_en.focus();
      return;
	}
    if (document.form1.faq_reponse_en.value == "") {
      alert("Please enter a answer");
      document.form1.faq_reponse_en.focus();
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
      <!--*****************************************************************************************************
                              Début de l'encadrement blanc
      ******************************************************************************************************-->
      <table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td width="7" height="7"><img alt="" src="./images/cgh.gif" width="7" height="7" /></td>
          <td bgcolor="#FFFFFF" width="99%"></td>
          <td width="7"><img alt="" src="./images/cdh.gif" width="7" height="7" /></td>
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
                      <td width="1" height="25"></td>
                      <td width="482">
                        <span class="titre">FAQ</span>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="2" height="2" bgcolor="#FF0000"></td>
                    </tr>
                    <tr valign="top" align="left">
                      <td height="25"></td>
                      <td class="text"><img alt="" src="./images/flnoir.gif" />&nbsp;<?php echo $op?>&nbsp; a questions in the category : <?php echo $faq_categorie_titre_en?></td>
                    </tr>
                    <tr valign="top">
                      <td height="5"></td>
                      <td></td>
                    </tr>
                    <tr valign="top">
                      <td width="1" height="25"></td>
                      <td class="text">
                        <form action="" method="post" name="form1">
                          <!--*****************************************************************************************************
                                                  Début du formulaire
                          ******************************************************************************************************-->
                          <table width="96%"  border="0" align="center" bgcolor="#FFFFFF" cellpadding="3">
                            <tr align="left">
                              <td width="19%" class="obligatoire">
                                Question   En: *
                              </td>
                              <td width="81%" align="left" class="menutext">
                                <input name="faq_question_en" type="text" class='zone' style="width:350px" value="<?php echo $faq_question_en?>" />
                              </td>
                            </tr>
                            <tr align="left">
                              <td class="obligatoire" valign="top">
                                Answer En: *
                              </td>
                              <td align="left" class="menutext">
                                <textarea name="faq_reponse_en" rows="5" class="zone" style="width:350px"><?php echo $faq_reponse_en?></textarea>

                              </td>
                            </tr>
                            
                            <tr align="left">
                              <td width="19%" class="obligatoire">
                                Question   Fr: *
                              </td>
                              <td width="81%" align="left" class="menutext">
                                <input name="faq_question_fr" type="text" class='zone' style="width:350px" value="<?php echo $faq_question_fr?>" />
                              </td>
                            </tr>
                            <tr align="left">
                              <td class="obligatoire" valign="top">
                                Answer Fr: *
                              </td>
                              <td align="left" class="menutext">
                                <textarea name="faq_reponse_fr" rows="5" class="zone" style="width:350px"><?php echo $faq_reponse_fr?></textarea>

                              </td>
                            </tr>
                            
                            <tr align="left">
                              <td width="19%" class="obligatoire">
                                Question   In: *
                              </td>
                              <td width="81%" align="left" class="menutext">
                                <input name="faq_question_in" type="text" class='zone' style="width:350px" value="<?php echo $faq_question_in?>" />
                              </td>
                            </tr>
                            <tr align="left">
                              <td class="obligatoire" valign="top">
                                Answer In: *
                              </td>
                              <td align="left" class="menutext">
                                <textarea name="faq_reponse_in" rows="5" class="zone" style="width:350px"><?php echo $faq_reponse_in?></textarea>

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
                            <td width="25"></td>
                            <td>
                              <div style="cursor:hand" onclick="javascript:fermer_popup();">
                                <table width="75"  border="0" cellpadding="0" cellspacing="0" class="menutext">
                                  <tr>
                                    <td width="6"><img alt="" src="./images/boutton-gauche.gif" border="0" /></td>
                                    <td width="401" align="center" style="background-image:url(./images/boutton-fond.gif)">
                                      Close
                                    </td>
                                    <td width="11"><img alt="" src="./images/boutton-droite.gif" border="0" /></td>
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
          <td height="7" width="7"><img alt="" src="./images/cbg.gif" width="7" height="7" /></td>
          <td style="background-image:url(./images/b.gif)"></td>
          <td width="7"><img alt="" src="./images/cbd.gif" width="7" height="7" /></td>
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