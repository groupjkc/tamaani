
<link href="include/style_admin.css" rel="stylesheet" type="text/css">
<?php
  // CHARA MOHAMED EL AMINE <neogatsu@hotmail.com>
  // Remarque : 100%
  $rubrique = 'site';
  
  include './include/session_test.php';
  include './include/privilege_test.php';
  include '../include/parametres.php';
  include '../include/site.php';
 
  // Procédure de suppression
  if (isset($_POST['supprimer']) && 
      count($_POST['supprimer']) > 0 && 
      $delete == 'Y') {
    site_supprimer($_POST['supprimer']);
  }
  if (isset($_POST['id']) &&     $mod == 'Y') {
  	/* Procédure de modification "visible" */
    if (isset($_POST['visible'])) {
      site_visible($_POST['visible'], $_POST['id']);
    } else {
      site_visible(NULL, $_POST['id']); // Tous à faux
    }
	
	/* Procédure de modification "Nunavik" */	
    if (isset($_POST['Nunavik'])) {
      site_Nunavik($_POST['Nunavik'], $_POST['id']);
    } else {
      site_Nunavik(NULL, $_POST['id']); // Tous à faux
    }


  }
  /* Créer un objet de pagination sans condition SQL sur la table */
  $p = new CAdminPagination('site', '', 10, 'SiteName');
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
    popup('site_add.php?&session=<?php echo $session?>&lang=<?php echo $lang?>', 725, 525);
  } // Fin ajouter
-->
</script>
<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
  <tr valign="top">
    <td colspan="2" height="10"></td>
  </tr>
  <tr valign="top" align="left">
    <td width="15" height="25"></td>
    <td>Sites</td>
  </tr>
  <tr>
    <td colspan="2" height="2" bgcolor="#FF0000"></td>
  </tr>
 
  <tr valign="top">
    <td height="25"></td>
    <td class="text">
      <img alt="" src="./images/flnoir.gif" />
      sites list
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
                          <a href="<?php echo $p->makelink('SiteName', $p->courent)?>" class="text">
                            Site Name <?php $p->writeArrow('SiteName'); ?>
                          </a>
                        </td>
                        <td>
                          <a href="<?php echo $p->makelink('RRContact', $p->courent)?>" class="text">
                            Room Reservation Contact<?php $p->writeArrow('RRContact'); ?>
                          </a>
                        </td>

                        <td>
                          <a href="<?php echo $p->makelink('TecContact', $p->courent)?>" class="text">
                            Technical Contact<?php $p->writeArrow('TecContact'); ?>
                          </a>
                        </td>
                        
                        <td>
                          <a href="<?php echo $p->makelink('Nunavik', $p->courent)?>" class="text">
                            Nunavik<?php $p->writeArrow('Nunavik'); ?>
                          </a>
                        </td>



                        <td width="60" align="center">
                          <a href="<?php echo $p->makelink('site_visible', $p->courent)?>" class="text">
                            Visible <?php $p->writeArrow('site_visible'); ?>
                          </a>
                        </td>

                        <td width="40" align="center">
                          remove
                        </td>
                 </tr>
<?php
    $i = 0;
    while($row = @mysql_fetch_array($res))
    {
      $i++;
      $session               = $_GET['session'];
      $disabled              = '';
      $color                 = (($i % 2) != 0)? '#EFEFEF' : '#E9E9E9';
      $site_id               = $row['site_id'];
      $SiteName              = affichage($row['SiteName'], '---');
	  $RRContact             = affichage($row['RRContact'], '---');
	  $TecContact            = affichage($row['TecContact'], '---');

      $active = ($row['active'] == 'Y') ? 'CHECKED' : '';
	  $Nunactive = ($row['Nunavik'] == 'Y') ? 'CHECKED' : '';

?>
                      <tr bgcolor="<?php echo $color?>" id="<?php echo $i?>" class="text" onmouseover="javascript:hightlight_row(this);" onmouseout="javascript:restore_row(this,'<?php echo $color?>');">
                        <td class="inactif" align="center">
                          <?php echo $p->courent*$p->page+$i?>
                          <input type="hidden" name="id[]" value="<?php echo $site_id?>" />
                        </td>
                        <td>
                          <a href="javascript:popup('site_add.php?site_id=<?php echo $site_id?>&session=<?php echo $session?>&lang=<?php echo $lang?>', 725, 525);" class="menutext">
                            <?php echo $SiteName ; ?>
                          </a>
                        </td>
                        <td>
                          <a href="javascript:popup('site_add.php?site_id=<?php echo $site_id?>&session=<?php echo $session?>&lang=<?php echo $lang?>', 725, 525);" class="menutext">
                            <?php echo $RRContact ; ?>
                          </a>
                        </td>


                        <td>
                          <a href="javascript:popup('site_add.php?site_id=<?php echo $site_id?>&session=<?php echo $session?>&lang=<?php echo $lang?>', 725, 525);" class="menutext">
                            <?php echo $TecContact ; ?>
                          </a>
                        </td>


                        <td align="center">
                          <input type="Checkbox" name="Nunavik[]" value="<?php echo $site_id?>" style="color:#666666;" <?php echo $Nunactive?> <?php echo $disabled?> />
                        </td>


                        <td align="center">
                          <input type="Checkbox" name="visible[]" value="<?php echo $site_id?>" style="color:#666666;" <?php echo $active?> <?php echo $disabled?> />
                        </td>


	  
                        <td align="center">
                          <input type="Checkbox" name="supprimer[]" id="supprimer<?php echo $i?>" value="<?php echo $site_id?>" onclick="javascript: restore_row(this.parentNode.parentNode, '<?php echo $color?>');" />
                        </td>

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
	  		  
                </td>
<?php
  if(mysql_num_rows($res) > 0 ) //---> Autorisations suffisantes ?
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
  <tr>
    <td height="15"></td>
    <td></td>
  </tr>															
</table>