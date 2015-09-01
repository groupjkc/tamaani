<link href="include/style_admin.css" rel="stylesheet" type="text/css">
<?php 
   //---> Rubrique valide ?
   $rubrique_id = getRubriqueId("service");
   
   //---> Tester la session et importer les variables : $select, $mod, $insert, $delete
   //     relatives aux privilèges de l'utilisateur et de la rubrique en cours
   include "include/session_test.php";
   
   include "../include/service.php"; //---> Les fonctions du module service   	
 //  include "include/pagination.php";       //---> Utiliser le module pagination	
   
   //---> Procédure de suppression
   if (isset($_POST['supprimer']) && count($_POST['supprimer']) > 0 )
   {
	 service_supprimer($_POST['supprimer']);
   } //Fsi
      

  /*********************************************************************************************************
                                            Gestion de la pagination
  **********************************************************************************************************/
  //---> Créer un objet de pagination sans condition SQL sur la table
  $p = new CAdminPagination("service","", 10, "title_en");
  $p->writeJavaScript();    //---> Générer le code JavaScript correspondant   
?>
<script type="text/javascript" language="javascript">
<!--

  function ajouter()
  {
    popup('service_add.php?session=<?php echo $session?>&lang=<?php echo $lang?>',525,350);
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
          <td width="98%"><span class="titre">Services </span></td> 
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
	 Services list :

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
		<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" style="border-color:#A0B0B6">
        <tr>
          <td>
            <table width="100%" align="center" border="0" cellpadding="2" cellspacing="1" class="text">
            <tr class="tcat">
              <td width="25" class="inactif">
			    #
			  </td>
              <td>
                <a href="<?php echo $p->makelink('title_en', $p->courent)?>" class="text">
                  Titre En
                  </a>
              </td>
              
              <td>
                <a href="<?php echo $p->makelink('title_fr', $p->courent)?>" class="text">
                  Titre Fr
                  </a>
              </td>
              
              <td>
                <a href="<?php echo $p->makelink('title_in', $p->courent)?>" class="text">
                  Titre In
                  </a>
              </td>

              <td>
                Image
              </td>              

                                          
          <?php 
			     if($mod=='Y')
	             { 
	          ?>
              <?php
			     } //Fsi
	             if($delete=='Y')
	             { 
	          ?>
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
				$service_icon = stripslashes($row['service_icon']);
			?>
		    <tr bgcolor="<?php echo $color?>" id         = "<?php echo $i?>"
			                          onMouseOver="javascript: hightlight_row(this);"
					                  onMouseOut ="javascript: restore_row   (this,'<?php echo $color?>');">
              <td height="25" align="left" class="inactif">
			    <?php echo $p->courent*$p->page+$i?>
				<input type="hidden" name="id[]" value="<?php echo $row['service_id']?>">
			  </td>
              <td>
                <?php 
				if($mod=='Y') 
		        {
		      ?>
                <a href="javascript:popup_scroll('service_add.php?session=<?php echo $session?>&lang=<?php echo $lang?>&service_id=<?php echo $row['service_id']?>',900,3000);" class="menutext">
                
             
                  <?php echo $title_en?>
                  </a>
                <?php
				} else 
				{
				  echo $title_en;
				} //Fsi
              ?>
              </td>
              
                <td>
                	 <?php echo $title_fr?>
                </td>
                
                <td>
                  <?php echo $title_in?>
                </td>                
 
              <td width="85" valign="middle" align="center">
                <img src="../../images/<?php echo $service_icon?>" alt="<?php echo $title_en?>" width="75" height="75" border="0" align="absmiddle">
              </td>
            </tr>
			<?php
			  } //FTQ
			?>
            </table>
          </td>
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