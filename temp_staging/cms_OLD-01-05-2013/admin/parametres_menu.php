<?php
  // CHARA MOHAMED EL AMINE <neogatsu@hotmail.com>
  // Remarque : 100%
  $rubrique = 'parametres';

  include './include/session_test.php';
  include './include/privilege_test.php';
  include '../include/parametres.php';

  /* Test de la validité des paramètres */
  if (!isset($_GET['session'])) {
    die('Paramètre manquant');
  } else {
    /* Le formulaire de la page en cours a été envoyé */
    if (isset($_POST['parametres_admin_email']) &&
        isset($_POST['parametres_url_site']) &&
        isset($_POST['parametres_basedir']) &&
        isset($_POST['parametres_titre_site']) &&
        isset($_POST['parametres_pied_page']) &&
        isset($_POST['parametres_mots_cles']) &&
        isset($_POST['parametres_description'])) {
      $admin_email        = lecture($_POST['parametres_admin_email']);
      $url_site           = lecture($_POST['parametres_url_site']);
      $parametres_basedir = lecture($_POST['parametres_basedir']);
      $titre_site         = lecture($_POST['parametres_titre_site']);
      $pied_page          = lecture($_POST['parametres_pied_page']);
      $mots_cles          = lecture($_POST['parametres_mots_cles']);
      $description        = lecture($_POST['parametres_description']);
      $sql = "UPDATE parametres
              SET    parametres_admin_email = '$admin_email',
                     parametres_url_site    = '$url_site',
                     parametres_basedir     = '$parametres_basedir',
                     parametres_titre_site  = '$titre_site',
                     parametres_pied_page   = '$pied_page',
                     parametres_mots_cles   = '$mots_cles',
                     parametres_description = '$description'
                    ";
      executer($sql, __FILE__, __LINE__);
    }
    $sql = "SELECT *
            FROM  parametres
           ";
    $res = executer($sql,__FILE__,__LINE__);
    $row = mysql_fetch_array($res);
    if ($row == FALSE) {
       die('Impossible de trouver les paramètres');
    } else {
      $admin_email        = stripslashes($row['parametres_admin_email']);
      $url_site           = stripslashes($row['parametres_url_site']);
      $parametres_basedir = stripslashes($row['parametres_basedir']);
      $titre_site         = stripslashes($row['parametres_titre_site']);
      $pied_page          = stripslashes($row['parametres_pied_page']);
      $mots_cles          = stripslashes($row['parametres_mots_cles']);
      $description        = stripslashes($row['parametres_description']);
    }
  }
?>
<link href="include/style_admin.css" rel="stylesheet" type="text/css">
<script type="text/javascript" language="javascript">
<!--
  function verif()
  {
	if (document.form1.parametres_admin_email.value == "") {
	  alert("Veuillez introduire l'email de l'administrateur");
	  document.form1.parametres_admin_email.focus();
	  return;
	} //Fsi
	if (document.form1.parametres_url_site.value == "") {
	  alert("Veuillez introduire l'URL du site");
	  document.form1.parametres_url_site.focus();
	  return;
	} //Fsi
	if (document.form1.parametres_basedir.value == "") {
	  alert("Veuillez introduire le répertoire du site");
	  document.form1.parametres_basedir.focus();
	  return;
	} //Fsi	
	if (document.form1.parametres_titre_site.value == "") {
	  alert("Veuillez introduire le titre du site");
      document.form1.parametres_titre_site.focus();
	  return;
	} //Fsi
	if (document.form1.parametres_mots_cles.value == "") {
	  alert("Veuillez introduire plusieurs mots clés séparés par des virgules");
	  document.form1.parametres_mots_cles.focus();
	  return;
	} //Fsi
	if (document.form1.parametres_description.value == "") {
	  alert("Veuillez introduire le description du site");
	  document.form1.parametres_description.focus();
	  return;
	} //Fsi		
	document.form1.submit();
  } //Fin verif
-->
</script>
<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
<tr valign="top">
  <td colspan="2" height="10"></td>
</tr>
<tr valign="top">
  <td width="15" height="25"></td>
  <td>
 	<table width="100%"  border="0" cellspacing="0" cellpadding="0"> 
      <tr> 
        <td width="98%"><span class="titre">Options</span></td> 
        <td width="2%"></td> 
      </tr> 
    </table>
    
  </td>
</tr>
<tr>
  <td colspan="2" height="2" bgcolor="#FF0000"></td>
</tr>
<?php
if($select == 'Y') {
?>
<tr valign="top">
  <td height="25"></td>
  <td class="text">
    <img alt="" src="./images/flnoir.gif">
	Paramètres du site
  </td>
</tr>
<tr valign="top">
  <td height="25"></td>
  <td></td>
</tr>
<tr valign="top">
  <td width="15" height="25"></td>
  <td class="text">
  <?php
	if ($select == 'Y') {
  ?>
    <form action="" method="post" name="form1">
	<!--******************************************************************************
				                      Début du formulaire
	*******************************************************************************-->
    <table width="75%"  border="0" align="center" bgcolor="#FFFFFF" cellpadding="3">
    <tr align="left">
      <td class="text">
	    Email de l'administrateur :
	  </td>
      <td class="menutext">
	    <input name="parametres_admin_email" type="text" class="zone" id="parametres_admin_email" value="<?php echo $admin_email?>" size="40">
      </td>
    </tr>
    <tr align="left">
      <td class="text">
	    URL du site :
	  </td>
      <td class="menutext">
	    <input name="parametres_url_site" type="text" class="zone" id="parametres_url_site" value="<?php echo $url_site?>" size="40">
      </td>
    </tr>
	<tr align="left">
      <td class="text">
	    R&eacute;pertoire de base : 
	  </td>
      <td class="menutext">
	    <input name="parametres_basedir" type="text" class="zone" id="parametres_basedir" value="<?php echo $parametres_basedir?>" size="40">
      </td>
    </tr>
    <tr align="left">
      <td class="text">
	    Titre du site :
	  </td>
      <td class="menutext">
	    <input name="parametres_titre_site" type="text" class="zone" id="parametres_titre_site" value="<?php echo $titre_site?>" size="40">
      </td>
    </tr>
    <tr align="left">
      <td class="text">
	    Description :
	  </td>
      <td class="menutext">
	    <textarea name="parametres_description" cols="40" rows="3" class="zone" id="parametres_pied_page"><?php echo $description?></textarea>
      </td>
    </tr>			
    <tr align="left">
      <td class="text">
	    Mots clés :
	  </td>
      <td class="menutext">
	    <textarea name="parametres_mots_cles" cols="40" rows="3" class="zone" id="parametres_mots_cles"><?php echo $mots_cles?></textarea>
      </td>
    </tr>
    <tr align="left">
      <td class="text">
	    Pied de page : <span style="color:#FF0000">*</span><br>
	  </td>
      <td class="menutext">
	    <textarea name="parametres_pied_page" cols="40" rows="7" class="zone" id="parametres_pied_page"><?php echo $pied_page?></textarea>
      </td>
    </tr>	
	<tr>
	  <td colspan="2" height="15"></td>
	</tr>
	<tr>
	  <td colspan="2">
  	    <!-- Début de la barre des bouttons -->
	    <table border="0" align="center" cellpadding="0" cellspacing="0">
		<tr>
		  <td>
		  <?php
		    if ($mod == 'Y') {
		  ?>
		    <div style="cursor:hand" onClick="javascript: verif();">
			  <table width="75"  border="0" cellpadding="0" cellspacing="0" class="menutext">
              <tr>
                <td width="6"><img alt="" src="./images/boutton-gauche.gif" border="0"></td>
                <td width="401" align="center" style="background-image:url(./images/boutton-fond.gif)">Appliquer</td>                    
                <td width="11"><img alt="" src="./images/boutton-droite.gif" border="0"></td>
              </tr>
              </table>
			</div>
		  <?php
		    }
		  ?>
		  </td>
		  <td width="25">&nbsp;</td>
		  <?php
		    if ($mod == 'Y') {
		  ?>		  
		  <td>
		    <div style="cursor:hand" onClick="javascript: document.form1.reset();">
			  <table width="75"  border="0" cellpadding="0" cellspacing="0" class="menutext">
              <tr>
                <td width="6"><img alt="" src="./images/boutton-gauche.gif" border="0"></td>
                <td width="401" align="center" style="background-image:url(./images/boutton-fond.gif)">Rétablir</td>                    
                <td width="11"><img alt="" src="./images/boutton-droite.gif" border="0"></td>
              </tr>
              </table>
			</div>
		  <?php
		    } //Fsi
		  ?>			
		  </td>
		</tr>
		</table>
		<!-- Fin de la barrre des bouttons -->	  
	  </td>
	</tr>
    </table>
    <!--******************************************************************************
                                      Fin du formulaire				
	*******************************************************************************-->				
    </form>
  <?php
    } //Fsi $select=='Y'
  ?>
  </td>
</tr>
<tr align="center" valign="middle">
  <td height="5"></td>
  <td><img alt="" src="./images/sep.gif" width="80%" height="2" align="top"></td>
</tr>
<tr>
  <td></td>
  <td class="text">
    <table border="0" width="80%" align="center" cellpadding="0" cellspacing="0">
	<tr>
	  <td>
	    <span style="font-size:9px;color:#FF0000">
		* Remarques sur le répertoire de base :</span>
		<li style="font-size:9px;color:#FF0000"><span style="color:#000000">ne doit pas se terminer par un /</span></li>
 	    <li style="font-size:9px;color:#FF0000"><span style="color:#000000">{@year}    = Année on en cours</span></li>
	    <li style="font-size:9px;color:#FF0000"><span style="color:#000000">{@email}   = Email Administrateurs</span></li>
		<br>
	    <span style="font-size:9px;color:#FF0000">
		* Remarques sur le champ pied de page :</span>
		<li style="font-size:9px;color:#FF0000"><span style="color:#000000">Balises HTML tolérées</span></li>
 	    <li style="font-size:9px;color:#FF0000"><span style="color:#000000">{@version} = Version en cours</span></li>
	    <li style="font-size:9px;color:#FF0000"><span style="color:#000000">{@year}    = Année on en cours</span></li>
        <li style="font-size:9px;color:#FF0000"><span style="color:#000000">{@email}   = Email Administrateurs</span></li>
	  </td>
	</tr>
	</table>
  </td>
</tr>
<?php
}
else
{
?>
<tr>
  <td height="15"></td>
    <td align="center" class="texte"></td>
</tr>
<tr>
  <td height="15"></td>
    <td align="center" class="texte">
      Vous ne possedez pas les droits necessaire pour effectuer cette operation.
    </td>
</tr>
<?php
}
?>															
<tr>
  <td height="25"></td>
  <td></td>
</tr>	
</table>           