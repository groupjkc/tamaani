<link href="include/style_admin.css" rel="stylesheet" type="text/css">
<?php 
   //---> Rubrique valide ?
   $rubrique_id = getRubriqueId("document");
   
   //---> Tester la session et importer les variables : $select, $mod, $insert, $delete
   //     relatives aux privilèges de l'utilisateur et de la rubrique en cours
   include "include/session_test.php";
   
   include "../include/document.php"; //---> Les fonctions du module document   	
 //  include "include/pagination.php";       //---> Utiliser le module pagination	
   
   //---> Procédure de suppression
   if (isset($_POST['supprimer']) && count($_POST['supprimer']) > 0 )
   {
	 document_supprimer($_POST['supprimer']);
   } //Fsi
      
   if (isset($_POST['id']))
   {
     //---> Procédure de modification "visible"
     if (isset($_POST['visible']))
	   document_visible($_POST['visible'],$_POST['id']);
	 else
	   document_visible(NULL,$_POST['id']);  // Tous à faux
   } //Fsi

  /*********************************************************************************************************
                                            Gestion de la pagination
  **********************************************************************************************************/
  //---> Créer un objet de pagination sans condition SQL sur la table
  $p = new CAdminPagination("document","", 10, "title_en");
 
  $p->writeJavaScript();    //---> Générer le code JavaScript correspondant   
?>
<script type="text/javascript" language="javascript">
<!--
  function verif()
  {
    var msg = "Do you really want to apply the requested changes (change + delete)?"
	if (confirm(msg))
	  document.pagination_tab.submit();
  } //Fin appliquer
  
  function ajouter()
  {
    popup('document_add.php?session=<?php echo $session?>&lang=<?php echo $lang?>',525,350);
  } //Fin ajouter
-->
</script>
<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
<tr valign="top">
  <td colspan="2" height="10"></td>
</tr>

<tr valign="top"> 
    <td width="15" height="25"><img src="images/shim.gif" width="15" height="1"></td> 
    <td> <table width="100%"  border="0" cellspacing="0" cellpadding="0"> 
        <tr> 
          <td width="98%"><span class="titre">Documents </span></td> 
          <td width="2%"><img src="./images/<?php echo $lang?>.gif" width="16" height="16" alt="<?php echo $lang_param[$lang]["description"]?>"></td> 
        </tr> 
      </table> 
      </td> 
  </tr> 


<tr>
  <td colspan="2" height="2" bgcolor="#FF0000"></td>
</tr>
<tr valign="top">
  <td height="25"></td>
  <td class="text">
    <img src="./images/flnoir.gif">
	List of documents :
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
		  if($p->getTotal()!=0 && $select=='Y') //---> Autorisations suffisantes ?
          {
		?>
	    <form name="pagination_tab" method="post" action="">
		<!-- Début du tableau de contenu -->
    <!-- Début du tableau avec un système de pagination -->
    <table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" style="border-color:#A0B0B6">
      <tr>
        <td><table width="100%" align="center" border="0" cellpadding="2" cellspacing="1" class="text">
          <tr class="tcat">
            <td width="25" class="inactif"> # </td>
            <td><a href="<?php echo $p->makelink('title_en', $p->courent)?>" class="text"> Titre En </a></td>
            <td><a href="<?php echo $p->makelink('title_fr', $p->courent)?>" class="text"> Titre Fr </a></td>
            <td><a href="<?php echo $p->makelink('title_in', $p->courent)?>" class="text"> Titre In   </a></td>
            <?php 
			     if($mod=='Y')
	             { 
	          ?>
            <td width="40"><a href="<?php echo $p->makelink('document_visible', $p->courent)?>" class="text"> Visible </a></td>
            <?php
			     } //Fsi
	             if($delete=='Y')
	             { 
	          ?>
            <td width="40" class="inactif"> Detele </td>
            <?php
			     }//Fsi
 
			 
			  ?>
          </tr>
        
          <?php
	          $i = 0;
	          while($row=@mysql_fetch_array($res))
	          {
			    $i++;
				$color                 = ($i%2!=0)? "#EFEFEF" : "#E9E9E9";
				$session               = $_GET["session"];
			    $title_en   = affichage($row['title_en'],"---");
			    $title_fr   = affichage($row['title_fr'],"---");
				$title_in   = affichage($row['title_in'],"---");
				$document_visible = ($row['document_visible']=='Y')? "CHECKED" : "";
				$pdf_en = stripslashes($row['pdf_en']);
				
			?>
          <tr bgcolor="<?php echo $color?>" id         = "<?php echo $i?>"
			                          onmouseover="javascript: hightlight_row(this);"
					                  onmouseout ="javascript: restore_row   (this,'<?php echo $color?>');">
            <td height="25" align="left" class="inactif"><?php echo $p->courent*$p->page+$i?>
              <input type="hidden" name="id[]" value="<?php echo $row['document_id']?>" /></td>
            <td><?php 
				if($mod=='Y') 
		        {
		      ?>
              <a href="javascript:popup('document_add.php?session=<?php echo $session?>&lang=<?php echo $lang?>&document_id=<?php echo $row['document_id']?>',525,350);" class="menutext"> <?php echo $title_en?> </a>
              <?php
				} else 
				{
				  echo $title_en;
				} //Fsi
              ?></td>
            <td><?php echo $title_fr?></td>
            <td><?php echo $title_in?></td>
            <?php 
			    if($mod=='Y') 
		        {   
	          ?>
            <td align="center"><input type="Checkbox" name="visible[]" value="<?php echo $row['document_id']?>" style="color:#666666;" <?php echo $document_visible?> /></td>
            <?php
			    } //Fsi

			    if($delete=='Y')
	            { 
	          ?>
            <td align="center"><input type="Checkbox" name="supprimer[]" id="supprimer<?php echo $i?>" value="<?php echo $row['document_id']?>"  onclick="javascript: restore_row(this.parentNode.parentNode, '<?php echo $color?>');" /></td>
            <?php
			    } //Fsi
			  ?>
          </tr>
          <?php
			  } //FTQ
			?>
        </table></td>
      </tr>
    </table>
    	<?php
		  } //Fsi
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
		    <div style="cursor:hand" onClick="javascript: ajouter();">
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
            if($p->getTotal()!=0 && $select=='Y') //---> Autorisations suffisantes ?
            {
		  ?>
		  <td width="15"></td>
		  <td height="22">
		    <div style="cursor:hand" onClick="javascript: verif();">
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
<tr>
  <td height="15"></td>
  <td></td>
</tr>															
</table>