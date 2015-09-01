
<link href="include/style_admin.css" rel="stylesheet" type="text/css">
<?php
  // CHARA MOHAMED EL AMINE <neogatsu@hotmail.com>
  // Remarque : 100%
  $rubrique = 'faq';
  
  include './include/session_test.php';
  include './include/privilege_test.php';
  include '../include/parametres.php';
  include '../include/faq.php';
 
  // Procédure de suppression
  if (isset($_POST['supprimer']) && 
      count($_POST['supprimer']) > 0 && 
      $delete == 'Y') {
    faq_categorie_supprimer($_POST['supprimer']);
  }
  if (isset($_POST['id']) && 
      $mod == 'Y') {
  	/* Procédure de modification "visible" */
    if (isset($_POST['visible'])) {
      faq_categorie_visible($_POST['visible'], $_POST['id']);
    } else {
      faq_categorie_visible(NULL, $_POST['id']); // Tous à faux
    }
  }
  /* Créer un objet de pagination sans condition SQL sur la table */
  $p = new CAdminPagination('faq_categorie', '', 10, 'faq_categorie_titre_en');
  /* Générer le code JavaScript correspondant */
  $p->writeJavaScript();
?>
<script type="text/javascript" language="javascript">
<!--
  function verif()
  {
    var msg = "Do you really want to apply the requested changes (change + delete)?"
    if (confirm(msg))
      document.pagination_tab.submit();
  } // Fin appliquer
  
  function ajouter()
  {
    popup('faq_categorie_add.php?&session=<?php echo $session?>&lang=<?php echo $lang?>', 525, 305);
  } // Fin ajouter
-->
</script>
<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
  <tr valign="top">
    <td colspan="2" height="10"></td>
  </tr>
  <tr valign="top" align="left">
    <td width="15" height="25"></td>
    <td>
      <span class="titre">FAQ Categories</span>
    </td>
  </tr>
  <tr>
    <td colspan="2" height="2" bgcolor="#FF0000"></td>
  </tr>
<?php
if($select == 'Y')
{
?>
  <tr valign="top">
    <td height="25"></td>
    <td class="text">
      <img alt="" src="./images/flnoir.gif" />
      Category list
    </td>
  </tr>
  <tr valign="top">
    <td height="15"></td>
    <td></td>
  </tr>
  <tr valign="top">
    <td width="15" height="25"></td>
    <td>
      <!-- Début du tableau avec un système de pagination -->
      <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td colspan="2">
            <!-- Début de l'enête de pagination -->
<?php
  $res = $p->makeButtons($action); //---> Afficher les bouttons    
?>
            <!-- Fin de l'enête de pagination -->
          </td>
        </tr>
        <tr>
          <td height="5"></td>
        </tr>
        <tr>
          <td>
<?php
  if(mysql_num_rows($res) > 0) //---> Autorisations suffisantes ?
  {
?>
            <form name="pagination_tab" method="post" action="">
<?php
    $p->writeForm(FALSE);
?>		
              <!-- Début du tableau de contenu -->
              <table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" style="border-color:#A0B0B6">
                <tr>
                  <td>
                    <table width="100%" align="center" border="0" cellpadding="2" cellspacing="1" class="text">
                      <tr class="tcat">
                        <td width="25" class="inactif" align="center">
                          #
                        </td>
                        <td>
                          <a href="<?php echo $p->makelink('faq_categorie_titre', $p->courent)?>" class="text">
                            Category Title En <?php $p->writeArrow('faq_categorie_titre_en'); ?>
                          </a>
                        </td>
                        <td>
                          <a href="<?php echo $p->makelink('faq_categorie_titre_fr', $p->courent)?>" class="text">
                            Category Title Fr<?php $p->writeArrow('faq_categorie_titre_fr'); ?>
                          </a>
                        </td>
                        <td>
                          <a href="<?php echo $p->makelink('faq_categorie_titre_in', $p->courent)?>" class="text">
                            Category Title In <?php $p->writeArrow('faq_categorie_titre_in'); ?>
                          </a>
                        </td>
                        <td width="40" align="center">
                          Questions
                        </td>
<?php
    if($mod == 'Y')
    { 
?>
                        <td width="60" align="center">
                          <a href="<?php echo $p->makelink('faq_categorie_visible', $p->courent)?>" class="text">
                            Visible <?php $p->writeArrow('faq_categorie_visible'); ?>
                          </a>
                        </td>
<?php
    }
    else
    {
?>
                        <td width="60" align="center">
                          <a href="<?php echo $p->makelink('faq_categorie_visible', $p->courent)?>" class="inactif">
                            Visible <?php $p->writeArrow('faq_categorie_visible'); ?>
                          </a>
                        </td>
<?php
    }
?>
<?php
    if($delete == 'Y')
    { 
?>
                        <td width="40" align="center">
                          remove
                        </td>
<?php
    }
?>			  			  			  
                      </tr>
<?php
    $i = 0;
    while($row = @mysql_fetch_array($res))
    {
      $i++;
      $session               = $_GET['session'];
      $disabled              = ($mod != 'Y')? 'disabled' : '';
      $color                 = (($i % 2) != 0)? '#EFEFEF' : '#E9E9E9';
      $faq_categorie_id      = $row['faq_categorie_id'];
      $faq_categorie_titre_en   = affichage($row['faq_categorie_titre_en'], '---');
	  $faq_categorie_titre_fr   = affichage($row['faq_categorie_titre_fr'], '---');
	  $faq_categorie_titre_in   = affichage($row['faq_categorie_titre_in'], '---');
      $faq_categorie_visible = ($row['faq_categorie_visible'] == 'Y') ? 'CHECKED' : '';
        
      //---> Nombre de questions par categorie de faq
      $sql_nb_faq = "SELECT *
              FROM   faq
              WHERE  faq_categorie_id = '$faq_categorie_id'
             ";
      $res_nb_faq = executer($sql_nb_faq, __FILE__, __LINE__);
      $nb_faq = mysql_num_rows($res_nb_faq);
?>
                      <tr bgcolor="<?php echo $color?>" id="<?php echo $i?>" class="text" onmouseover="javascript:hightlight_row(this);" onmouseout="javascript:restore_row(this,'<?php echo $color?>');">
                        <td class="inactif" align="center">
                          <?php echo $p->courent*$p->page+$i?>
                          <input type="hidden" name="id[]" value="<?php echo $faq_categorie_id?>" />
                        </td>
                        <td>
                          <a href="javascript:popup('faq_categorie_add.php?faq_categorie_id=<?php echo $faq_categorie_id?>&session=<?php echo $session?>&lang=<?php echo $lang?>', 525, 305);" class="menutext">
                            <?php echo $faq_categorie_titre_en ; ?>
                          </a>
                        </td>
                        <td>
                          <a href="javascript:popup('faq_categorie_add.php?faq_categorie_id=<?php echo $faq_categorie_id?>&session=<?php echo $session?>&lang=<?php echo $lang?>', 525, 305);" class="menutext">
                            <?php echo $faq_categorie_titre_fr ; ?>
                          </a>
                        </td>
                        <td>
                          <a href="javascript:popup('faq_categorie_add.php?faq_categorie_id=<?php echo $faq_categorie_id?>&session=<?php echo $session?>&lang=<?php echo $lang?>', 525, 305);" class="menutext">
                            <?php echo $faq_categorie_titre_in ; ?>
                          </a>
                        </td>
                        <td align="center">
                          <a href="./?<?php echo $action?>=faq&faq_categorie_id=<?php echo $faq_categorie_id?>&session=<?php echo $session?>&lang=<?php echo $lang?>" class="menutext">
                            <?php echo $nb_faq?>
                          </a>
                        </td>
<?php
    if($mod == 'Y')
    { 
?>
                        <td align="center">
                          <input type="Checkbox" name="visible[]" value="<?php echo $faq_categorie_id?>" style="color:#666666;" <?php echo $faq_categorie_visible?> <?php echo $disabled?> />
                        </td>
<?php
    }
    else
    {
?>
                        <td align="center">
                          <input type="Checkbox" name="visible[]" value="<?php echo $faq_categorie_id?>" style="color:#666666;" <?php echo $faq_categorie_visible?> <?php echo $disabled?> />
                        </td>
<?php
    }
?>
<?php
      if($delete == 'Y')
      { 
?>			  
                        <td align="center">
                          <input type="Checkbox" name="supprimer[]" id="supprimer<?php echo $i?>" value="<?php echo $faq_categorie_id?>" onclick="javascript: restore_row(this.parentNode.parentNode, '<?php echo $color?>');" />
                        </td>
<?php
      }
?>
                      </tr>
<?php
    }
?>
                    </table>
                  </td>
                </tr>
              </table>
 
<?php
  }
?>		
              <!-- Fin du tableau de contenu -->
            </form>		
          </td>
        </tr>
        <tr>
          <td height="5"></td>
        </tr>
        <tr>
          <td align="right">
            <!-- Début de la barre des bouttons -->
            <table align="right" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td height="22">
<?php
  if($insert == 'Y') //---> Autorisations suffisantes ?
  { 
?>
                  <div style="cursor:hand" onClick="javascript: ajouter();">
                    <table width="75"  border="0" cellpadding="0" cellspacing="0" class="menutext">
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
<?php
  if(mysql_num_rows($res) > 0 && $select == 'Y') //---> Autorisations suffisantes ?
  {
?>
                <td width="15"></td>
                <td height="22">
                  <div style="cursor:hand" onclick="javascript:verif();">
                    <table width="75"  border="0" cellpadding="0" cellspacing="0" class="menutext">
                      <tr>
                        <td width="6"><img alt="" src="./images/boutton-gauche.gif" border="0" /></td>
                        <td width="401" align="center" style="background-image:url(./images/boutton-fond.gif)">
                          Apply
                        </td>
                        <td width="11"><img alt="" src="./images/boutton-droite.gif" border="0" /></td>
                      </tr>
                    </table>
                  </div>
<?php
  }
?>						  
                </td>		  		  
              </tr>
            </table>
            <!-- Fin de la barrre des bouttons -->
          </td>
        </tr>	
      </table>
      <!-- Fin du tableau avec un système de pagination -->
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
     You do not have the necessary rights to perform this operation.
    </td>
</tr>
<?php
}
?>
  <tr>
    <td height="15"></td>
    <td></td>
  </tr>															
</table>