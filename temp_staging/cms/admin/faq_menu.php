<?php
  // CHARA MOHAMED EL AMINE <neogatsu@hotmail.com>
  // Remarque : 100%
  $rubrique = 'faq';
  
  include './include/session_test.php';
  include './include/privilege_test.php';
  include '../include/parametres.php';
  include '../include/faq.php';

  /* Test de la validité des paramètres */
  if (!isset($_GET['faq_categorie_id'])) {
    die('Paramètres faq_categorie_id manquant');
  } else {
    $faq_categorie_id = lecture($_GET['faq_categorie_id']);
    $sql = "SELECT faq_categorie_titre_en
            FROM   faq_categorie
            WHERE  faq_categorie_id = $faq_categorie_id
           ";
    $res = executer($sql, __FILE__, __LINE__);
    if (mysql_num_rows($res) != 1) {
      die('Error');
    } else {
      $faq_categorie_titre_en = affichage(mysql_result($res, 0, 'faq_categorie_titre_en'));
    }

    /* Procédure de changement de "visibilité" */
    if (isset($_GET['visible']) && 
        isset($_GET['faq_id']) && 
        $mod = 'Y') {
      if ($_GET['visible'] == 'Y') {
        $faq_visible = 'Y';
      } else {
        $faq_visible = 'N';
      }
      $faq_id = lecture($_GET['faq_id']);
      $sql = "UPDATE faq
              SET    faq_visible = '$faq_visible'
              WHERE  faq_id      = $faq_id
             ";
      $res = executer($sql, __FILE__, __LINE__);
?>
<!-- Pour que la page se recharge après chaque changement -->
<script language="javascript" type="text/javascript">
<!--
  document.location = "./?<?php echo $action?>=<?php echo $_GET[$action]?>&faq_categorie_id=<?php echo $faq_categorie_id?>&session=<?php echo $_GET['session']?>";
-->
</script>
<?php
      exit();
    }
    
    /* Procédure de suppression */
    if (isset($_POST['faq_id_delete']) && 
        $delete == 'Y') {
      $faq_id_delete = lecture($_POST['faq_id_delete']);
      faq_supprimer(array($faq_id_delete));
?>
<!-- Pour que la page se recharge après chaque changement -->
<script language="javascript" type="text/javascript">
<!--
  document.location = "./?<?php echo $action?>=<?php echo $_GET[$action]?>&faq_categorie_id=<?php echo $faq_categorie_id?>&session=<?php echo $_GET['session']?>";
-->
</script>
<?php  	 
      exit();
    }
    
    /* Procédure de déplacement */
    if (isset($_POST['dsens']) && 
        $mod = 'Y') {
      $faq_ordre = lecture($_POST['faq_ordre']);
      if ($_POST['dsens'] == 'bas') {
        faq_deplacer_bas($faq_ordre);
      } else {
        faq_deplacer_haut($faq_ordre);
      }
?>
<!-- Pour que la page se recharge après chaque changement -->
<script language="javascript" type="text/javascript">
<!--
  document.location = "./?<?php echo $action?>=<?php echo $_GET[$action]?>&faq_categorie_id=<?php echo $faq_categorie_id?>&session=<?php echo $_GET['session']?>";
-->
</script>
<?php  
      exit();
    }
  }
?>
<link href="include/style_admin.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.titre2 {
  color:#3F7CB4;
  text-decoration:none;
  font-family: Verdana, Arial, Helvetica, sans-serif;
  font-size: 11px;
  font-weight: bold;
}
-->
</style>
<script type="text/javascript" language="javascript">
<!--
  function verif(id, nom)
  {
    var msg = 'Do you really want to delete the question : \'' + nom + '\' ?'
    if (confirm(msg))
    {
      document.delete_champ.faq_id_delete.value = id;
      document.delete_champ.submit();
    }
  }
  
  function ajouter()
  {
    popup('faq_add.php?faq_categorie_id=<?php echo $faq_categorie_id?>&session=<?php echo $session?>&lang=<?php echo $lang?>', 900, 650);
  }
  
  function deplacer(faq_ordre, dsens)
  {
    document.deplacer.faq_ordre.value = faq_ordre;
    document.deplacer.dsens.value = dsens;
    document.deplacer.submit();
  }
  
  function gotoSelectedPage()
  {
    if (document.form1.gotoPage.value != -1)
      document.location = "./?<?php echo $action?>=<?php echo $_GET[$action]?>&faq_categorie_id=" + document.form1.gotoPage.value + "&session=<?php echo $session?>&lang=<?php echo $lang?>";			    
  }
  
  function apercu()
  {
    window.open('../?<?php echo $action?>=faq');
  } 
-->
</script>
<!--*****************************************************************************************************
                        Ce formulaire sert pour la suppression des champs
******************************************************************************************************-->
<form name="delete_champ" method="post" action="">
  <input name="faq_id_delete" type="hidden" value="0" />
</form>
<!--*****************************************************************************************************
                        Ce formulaire sert pour le dépalcement des champs
******************************************************************************************************-->
<form name="deplacer" method="post" action="">
  <input name="dsens" type="hidden" value="" />
  <input name="faq_ordre" type="hidden" value="" />
</form>
<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
  <tr valign="top">
    <td colspan="2" height="10"></td>
  </tr>
  <tr valign="top">
    <td width="15" height="25"></td>
    <td>
      <span class="titre">FAQ</span>
    </td>
  </tr>
  <tr>
    <td colspan="2" height="2" bgcolor="#FF0000"></td>
  </tr>
<?php
  if ($select == 'Y')
  {
?>
  <tr valign="top">
    <td height="25"></td>
    <td class="text"><img alt="" src="./images/flnoir.gif" />&nbsp;List of questions in the category '<b><?php echo $faq_categorie_titre_en?></b>'</td>
  </tr>
  <tr valign="top">
    <td height="25"></td>
    <td></td>
  </tr>
  <tr valign="top">
    <td width="15" height="25"></td>
    <td class="text">
      <!--******************************************************************************
				                      Début du listing
      *******************************************************************************-->
      <table width="95%" align="left" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td height="25">
            <form name="form1" method="post" action="">
              <table border="0" cellpadding="0" cellspacing="0" align="center" width="100%">
                <tr valign="middle">
                  <td align="left">
                    <select name="gotoPage" class="zone" style="width:350px" onchange="javascript:gotoSelectedPage();">
                      <option value="0">Choose a category</option>
<?php
  $sql = "SELECT *
          FROM   faq_categorie
          WHERE  faq_categorie_id <> $faq_categorie_id
         ";
  $res = executer($sql, __FILE__, __LINE__);
  while ($row = mysql_fetch_array($res))
  {
?>
                      <option value="<?php echo $row['faq_categorie_id']?>"><?php echo affichage($row['faq_categorie_titre_en'])?></option>
<?php			
  }
?>
                    </select>
                  </td>
                </tr>
              </table>
            </form>
            <br />
          </td>
        </tr>		  
        <tr>
          <td height="25">
            <table width="100%"  border="0" align="center" bgcolor="#FFFFFF" cellpadding="0" cellspacing="0">
<?php
    $sql = "SELECT   *
            FROM     faq where faq_categorie_id = $faq_categorie_id
            ORDER BY faq_ordre ASC
           ";
    $res = executer($sql,__FILE__,__LINE__);
    $i = 0;
    while ($row = @mysql_fetch_array($res))
    {
      $i++;
      $faq_id       = $row['faq_id'];
      $faq_question_en = affichage(addslashes($row['faq_question_en']));
      $faq_reponse_en  = $row['faq_reponse_en'];
      $faq_visible  = $row['faq_visible'];
      $faq_ordre    = $row['faq_ordre'];
?>
              <tr>
                <td width="26%"></td>
                <td width="74%">
                  <table width="100%"  border="0" cellpadding="0" cellspacing="0">
                    <tr valign="bottom">
                      <td width="87%" align="right"><img alt="" src="./images/spa.gif" width="25" height="19" /></td>
                      <td width="4%" align="center" bgcolor="#F3F3F3">
<?php 
      if($mod == 'Y')
      {
?>
                        <a href="javascript:deplacer(<?php echo $faq_ordre?>, 'bas');">
                          <img alt="" src="./images/fl_bas.gif" width="14" height="14" border="0" align="absbottom" />
                        </a>
<?php
      }
?>
                      </td>
                      <td width="4%" align="center" bgcolor="#F3F3F3">
<?php 
      if($delete == 'Y') 
      {
?>
                         <a href="javascript:verif(<?php echo $faq_ordre?>, '<?php echo $faq_question_en?>');">
                           <img alt="" src="./images/sup.gif" width="14" height="14" border="0" align="absbottom" />
                         </a>
<?php 
      }
?>
                      </td>
                      <td width="4%" align="center" bgcolor="#F3F3F3">
<?php 
      if($mod  ==  'Y') 
      {
?>
                         <a href="javascript:deplacer(<?php echo $faq_ordre?>, 'haut');">
                           <img alt="" src="./images/fl_haut.gif" width="14" height="14" border="0" align="absbottom" />
                         </a>
<?php 
      }
?>
                      </td>
                      <td width="2%" align="center" valign="bottom" bgcolor="#F3F3F3"></td>
                    </tr>
                  </table>
                </td>
              </tr>	
              <tr>
                <td valign="top" bgcolor="#F3F3F3">
                  <table width="100%"  border="0" cellpadding="5">
                    <tr>
                      <td>
                        <table width="100%"  border="0" cellpadding="1" cellspacing="0">
                          <tr>
                            <td class="text">
<?php 
      if($mod == 'Y') 
      {
?>
                              <a href="javascript:popup('faq_add.php?faq_categorie_id=<?php echo $faq_categorie_id?>&faq_id=<?php echo $faq_id?>&session=<?php echo $session?>&lang=<?php echo $lang?>', 900, 650);" class="menutext">
                                <b><?php echo stripslashes($faq_question_en)?></b>	
                              </a>
<?php
      }
      else
      {
        echo '<b>'.stripslashes($faq_question_en).'</b>';
      }
?>
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                </td>
                <td bgcolor="#F3F3F3">
                  <table width="100%"  border="0" cellpadding="5">
                    <tr>
                      <td>
                        <table width="100%"  border="0" cellpadding="1" cellspacing="0" bgcolor="#000000">
                          <tr>
                            <td>
                              <table width="100%"  border="0" cellpadding="0" cellspacing="4" bgcolor="#FFFFFF">
                                <tr>
                                  <td>
                                    <?php echo affichage_puce($faq_reponse_en, "images/puce.gif", "text", "titre2", 10, 10);?>
                                  </td>
                                </tr>
                              </table>
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
<?php
      if ($mod == 'Y')
      {
?>
              <tr>
                <td></td>
                <td align="right">
                  <a href="./?<?php echo $action?>=<?php echo $_GET[$action]?>&faq_categorie_id=<?php echo $faq_categorie_id?>&faq_id=<?php echo $faq_id?>&visible=<?php echo ($faq_visible == 'N') ? 'Y' : 'N'?>&session=<?php echo $session?>&lang=<?php echo $lang?>" class="menutext">
<?php
        if ($faq_visible == 'N')
        {
          echo '<font color=\'red\'>Visible</font>';
        }
        else
        {
          echo 'Invisible';
        }
?>
                  </a>
                   |
                  <a href="javascript:popup('faq_add.php?faq_categorie_id=<?php echo $faq_categorie_id?>&faq_id=<?php echo $faq_id?>&session=<?php echo $session?>&lang=<?php echo $lang?>', 525, 315);" class="menutext">
                    Edit
                  </a>
                </td>
              </tr>
<?php
      }
?>
              <tr>
                <td height="10"></td>
                <td></td>
              </tr>
<?php
    }
?>
            </table>
          </td>
        </tr>	
        <tr>
          <td>
            <!-- Début de la barre des bouttons -->
            <table border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td>
<?php
    if($insert == 'Y')
    { 
?>
                  <div onclick="javascript:ajouter();" style="cursor:hand;">
                    <table width="75" border="0" cellpadding="0" cellspacing="0" class="menutext">
                      <tr>
                        <td width="6"><img alt="" src="./images/boutton-gauche.gif" border="0" /></td>
                        <td width="401" align="center" style="background-image:url(./images/boutton-fond.gif)">
                          Add
                        </td>                    
                        <td width="11"><img alt="" src="./images/boutton-droite.gif" border="0" /></td>
                      </tr>
                    </table>
                  </div>
<?php
    }
?>
                </td>
                <td width="25"></td>
                <td>&nbsp;</td>
              </tr>
            </table>
            <!-- Fin de la barrre des bouttons -->	  
          </td>
        </tr>
      </table>	  
      <!--******************************************************************************
                                        Fin du listing			
      *******************************************************************************-->

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
    <td align="center" class="texte"><span id="result_box" lang="en" xml:lang="en">You do not have the necessary rights to perform this operation.</span></td>
</tr>
<?php
}
?>
  <tr>
    <td height="15"></td>
    <td></td>
  </tr>															
</table>