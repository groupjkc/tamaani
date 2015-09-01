<?php
  // CHARA MOHAMED EL AMINE <neogatsu@hotmail.com>
  $rubrique = 'admin_user';

  include './include/session_test.php';
  include './include/privilege_test.php';
  include '../include/parametres.php';
  include '../include/admin_user.php';	

  connect();

  /* Procédure de suppression */
  if (isset($_POST['supprimer']) && 
       count($_POST['supprimer']) > 0 && 
       $delete == 'Y') {
    admin_user_supprimer($_POST['supprimer']);
  }
  if (isset($_POST['id']) && 
      $mod == 'Y') {
    /* Procédure de modification "actif" */
    if (isset($_POST['actif'])) {
      admin_user_actif($_POST['actif'], $_POST['id']);
    } else {
      admin_user_actif(NULL, $_POST['id']); // Tous à faux
    }
  }
  /* Créer un objet de pagination sans une condition SQL sur la table */
  $p = new CAdminPagination('admin_user', '', 5, 'admin_user_nom');
  /* Générer le code JavaScript correspondant */
  $p->writeJavaScript();
?>
<link href="include/style_admin.css" rel="stylesheet" type="text/css">
<script type="text/javascript" language="javascript">
<!--
  function verif()
  {
    var msg = "Voulez-vous réellement appliquer les changements demandes (modification + suppression) ?"
	if (confirm(msg))
	  document.pagination_tab.submit();
  }
  
  function ajouter()
  {
    popup_scroll('admin_user_add.php?session=<?php echo $session?>', 825, 480, false, 0, 0); // correct
  }
-->
</script>
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
<?php
if($select == 'Y')
{
?>
<tr valign="top">
  <td height="25"></td>
  <td class="text">
    <img src="./images/flnoir.gif">
	List of Administrators
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
		  $res = $p->makeButtons($action);    //---> Afficher les bouttons    
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
		  if(mysql_num_rows($res)>0 && $select=='Y') //---> Autorisations suffisantes ?
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
              <td width="70">
			    <a href="<?php echo $p->makelink('admin_user_nom', $p->courent)?>" class="text">
	              Name <?php $p->writeArrow('admin_user_nom'); ?>
				</a>
			  </td>
              <td class="inactif">
			    Description
			  </td>
              <td width="50" align="left">
	            <a href="<?php echo $p->makelink('admin_user_date', $p->courent)?>" class="text">
	              Date <?php $p->writeArrow('admin_user_date'); ?>
				</a>				
			  </td>
              <td width="80" align="center">
	            <a href="<?php echo $p->makelink('admin_user_pouvoir', $p->courent)?>" class="text">
	              Privileges <?php $p->writeArrow('admin_user_pouvoir'); ?>
				</a>
			  </td>	
              <td width="50" align="center">
				<a href="<?php echo $p->makelink('admin_user_actif', $p->courent)?>" class="text">
	              Active <?php $p->writeArrow('admin_user_actif'); ?>
				</a>			    
			  </td>
	          <?php
	             if($delete=='Y')
	             { 
	          ?>
              <td width="40" class="inactif" align="center">
				Delete
			  </td>
			  <?php
			     }
			  ?>			  			  			  
            </tr>
	        <?php
	          $i = 0;
	          while($row=@mysql_fetch_array($res))
	          {
			    $i++;
                
				//---> On n'a pas le droit de modifier ses propres paramètres
				$b_mod                  = ($user_id == $row['admin_user_id']) ? 'N' : $mod;	
		        $b_delete               = ($user_id == $row['admin_user_id']) ? 'N' : $delete;
			    $disabled            	= ($b_mod != 'Y') ? 'disabled' : '';
				$color                  = (($i % 2) != 0) ? '#EFEFEF' : '#E9E9E9';
				$session                = $_GET['session'];
			    $admin_user_nom         = $row['admin_user_nom'];
				$admin_user_description = portion(affichage($row['admin_user_description'], '---'), 100);
				$admin_user_date        = date('d/m/Y', $row['admin_user_date']);
				$admin_user_actif       = ($row['admin_user_actif'] == 'Y') ? 'CHECKED' : '';
                $admin_user_pouvoir     = affichage($row['admin_user_pouvoir'], '---');				
			?>
		    <tr bgcolor="<?php echo $color?>" id         = "<?php echo $i?>" class="text"
			                          onMouseOver="javascript: hightlight_row(this);"
					                  onMouseOut ="javascript: restore_row   (this,'<?php echo $color?>');">
              <td height="25" align="center" class="inactif">
			    <?php echo $p->courent*$p->page+$i?>
				<?php
		          if ($row['admin_user_id'] != $user_id) { //---> Si utilisateur en cours, alors pas la peine d'afficher l'input
				?>
				<input type="hidden" name="id[]" value="<?php echo $row['admin_user_id']?>">
				<?php
				  }
				?>
			  </td>
              <td>
	          <?php 
				if ($b_mod == 'Y') {
		      ?>
                <a href="javascript:popup_scroll('admin_user_information.php?user_id=<?php echo $row['admin_user_id']?>&session=<?php echo $session?>&lang=<?php echo $lang?>', 400, 420, false, 0, 0);" class="menutext"><!-- correct -->
				  <?php echo $admin_user_nom?>
				</a>
		      <?php
				} else {
                  echo $admin_user_nom;
				}
              ?>
			  </td>
              <td>
                <?php echo $admin_user_description?>
              </td>
              <td align="left">
                <?php echo $admin_user_date?>
              </td>
			  <td align="center">
	          <?php   
				   if ($b_mod == 'Y') {
		      ?>
				<a href="javascript:popup_scroll('admin_user_privilege.php?user_id=<?php echo $row['admin_user_id']?>&session=<?php echo $session?>&lang=<?php echo $lang?>', 400, 470, false, 0, 0);" class="menutext"><!-- correct -->
			      <?php echo $admin_user_pouvoir?>
				</a>
		      <?php
			       } else {
				     echo $admin_user_pouvoir;
		           } 		        
              ?>				
              </td>
              <td align="center">
				<input type="Checkbox" name="actif[]" value="<?php echo $row['admin_user_id']?>" style="color:#666666;" <?php echo $admin_user_actif?> <?php echo $disabled?> >
			  </td>
			  <?php
			    if ($delete == 'Y') { 
	          ?>			  
              <td align="center">
              <?php
			    if ($b_delete == 'Y') {
	          ?>			    
				<input type="Checkbox" name="supprimer[]" id="supprimer<?php echo $i?>" value="<?php echo $row['admin_user_id']?>"  onClick="javascript:restore_row(this.parentNode.parentNode, '<?php echo $color?>');" >
			  <?php
			    }
			  ?>
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
            if($insert=='Y')                   //---> Autorisations suffisantes ?
            { 
          ?>
		    <div style="cursor:hand" onClick="javascript:ajouter();">
              <table width="75"  border="0" cellpadding="0" cellspacing="0" class="menutext">
              <tr>
                <td width="6"><img src="./images/boutton-gauche.gif" border="0"></td>
                <td width="401" align="center" style="background-image:url(./images/boutton-fond.gif)">Add</td>
                <td width="11"><img src="./images/boutton-droite.gif" border="0"></td>
              </tr>
              </table>
			</div>
		  <?php
		    } //Fsi
		  ?>		  		  
		  </td>
	      <?php
            if(mysql_num_rows($res)>0 && $select=='Y') //---> Autorisations suffisantes ?
            {
		  ?>
		  <td width="15"></td>
		  <td height="22">
		    <div style="cursor:hand" onClick="javascript:verif();">
              <table width="75"  border="0" cellpadding="0" cellspacing="0" class="menutext">
              <tr>
                <td width="6"><img src="./images/boutton-gauche.gif" border="0"></td>
                <td width="401" align="center" style="background-image:url(./images/boutton-fond.gif)">Apply</td>
                <td width="11"><img src="./images/boutton-droite.gif" border="0"></td>
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
    <td align="center" class="texte">&nbsp;
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