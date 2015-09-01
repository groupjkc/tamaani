<link href="include/style_admin.css" rel="stylesheet" type="text/css">
<?php 
   //---> Rubrique valide ?
   $rubrique_id = getRubriqueId("requester");
 
   
   //---> Tester la session et importer les variables : $select, $mod, $insert, $delete
   //     relatives aux privilèges de l'utilisateur et de la rubrique en cours
  include './include/session_test.php';
  include './include/privilege_test.php';
  include '../include/parametres.php';
   
   include "../include/requester.php"; //---> Les fonctions du module requester   	
 //  include "include/pagination.php";       //---> Utiliser le module pagination	
   
   //---> Procédure de suppression
   if (isset($_POST['supprimer']) && count($_POST['supprimer']) > 0 )
   {
	 requester_supprimer($_POST['supprimer']);
   } //Fsi
      

  /*********************************************************************************************************
                                            Gestion de la pagination
  **********************************************************************************************************/
  //---> Créer un objet de pagination sans condition SQL sur la table
  $p = new CAdminPagination("requester","", 100, "Reference", 'DESC');
//  CAdminPagination($table, $cond="", $page=8, $default_sort="", $default_sens="")
  $p->writeJavaScript();    //---> Générer le code JavaScript correspondant   
?>
<script type="text/javascript" language="javascript">
  function approve()
  {
    var msg = "Do you really want to approve this request"
	confirm(msg)
	  //document.pagination_tab.submit();
  } //Fin appliquer

  function  deny()
  {
    popup('deny.php?session=<?php echo $session?>&lang=<?php echo $lang?>',525,350);
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
          <td width="98%"><span class="titre">requesters </span></td> 
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
	 requesters list :

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
                <a href="<?php echo $p->makelink('Reference', $p->courent)?>" class="text">
                  Reference
                  </a>
              </td>
              
              <td>
                <a href="<?php echo $p->makelink('ContactName', $p->courent)?>" class="text">
                  Contact Name
                  </a>
              </td>
              
              <td>
                <a href="<?php echo $p->makelink('CompanyName', $p->courent)?>" class="text">
                  Company Name
                  </a>
              </td>
              
               <td>
                
                 Approve
                
              </td>
              
            
              <td>
               
                  Deny
                
              </td>                           
 
              <td>
                <a href="<?php echo $p->makelink('Statut', $p->courent)?>" class="text">
                  Statut
                  </a>
              </td>
               
                  
                
                     
			  			  			  
            </tr>
	        <?php
	          $i = 0;
	          while($row=@mysql_fetch_array($res))
	          {
			    $i++;
				$color                 = ($i%2!=0)? "#EFEFEF" : "#E9E9E9";
				$session               = $_GET["session"];
			    $Reference   = affichage($row['Reference'],"---");
			    $ContactName   = affichage($row['ContactName'],"---");
				$CompanyName   = affichage($row['CompanyName'],"---");
				
				$Statut   = affichage($row['Statut'],"---");
								
				switch ($Statut) {
					case 'D':
						$StatutName='<span style="color:red">Denied</span>';
						break;
					case 'A':
						$StatutName='<span style="color:green">Approved</span>';
						break;
					default:
						$StatutName='<span style="color:red">Pending</span>';
						break;
				}
				 
			?>
		    <tr bgcolor="<?php echo $color?>" id         = "<?php echo $i?>"
			                          onMouseOver="javascript: hightlight_row(this);"
					                  onMouseOut ="javascript: restore_row   (this,'<?php echo $color?>');">
              <td height="25" align="left" class="inactif">
			    <?php echo $p->courent*$p->page+$i?>
				<input type="hidden" name="id[]" value="<?php echo $row['requester_id']?>">
			  </td>
              <td>
                <?php 
				if($mod=='Y') 
		        {
		      ?>
                <a href="javascript:popup_scroll('requester_add.php?session=<?php echo $session?>&lang=<?php echo $lang?>&requester_id=<?php echo $row['requester_id']?>',900,3000);" class="menutext">
                
             
                  <?php echo $Reference?>
                  </a>
                <?php
				} 
              ?>
              </td>
              
                <td>
                	 <?php echo $ContactName; ?>
                </td>
                
                <td>
                  <?php echo $CompanyName ?>
                </td>                

                <?PHP if($Statut!='A' and $Statut!='D' or true ) { // alwayes true ?>
				 <td align="center">
                
				    <div style="cursor:pointer"   onClick="javascript: popup_scroll('approve.php?session=<?php echo $session?>&lang=<?php echo $lang?>&requester_id=<?php echo $row['requester_id']?>',900,3000);;">
					  <table width="75"  border="0" cellpadding="0" cellspacing="0" class="menutext">
                      <tr>
                        <td width="6"><img src="./images/boutton-gauche.gif" border="0"></td>
                        <td width="401" align="center"   style="background-image:url(./images/boutton-fond.gif)">Approve</td>                    
                        <td width="11"><img src="./images/boutton-droite.gif" border="0"></td>
                      </tr>
                    </table>
				    </div>
				  </td>  
                
				 <td align="center">
				    <div style="cursor: pointer" onClick="javascript: popup('deny.php?session=<?php echo $session?>&lang=<?php echo $lang?>&requester_id=<?php echo $row['requester_id']?>',600,400);">
					  <table width="75"  border="0" cellpadding="0" cellspacing="0" class="menutext">
                      <tr>
                        <td width="6"><img src="./images/boutton-gauche.gif" border="0"></td>
                        <td width="401" align="center" style="background-image:url(./images/boutton-fond.gif)"> Deny </td>                    
                        <td width="11"><img src="./images/boutton-droite.gif" border="0"></td>
                      </tr>
                    </table>
				    </div>
				  </td>                   
				<?PHP
				}
				else
				{
				?>
              <td align="center">
                
				   
					  <table width="75"  border="0" cellpadding="0" cellspacing="0" class="menutext">
                      <tr>
                        <td width="6"><img src="./images/boutton-gauche.gif" border="0"></td>
                        <td width="401" align="center" class="inactif" style="background-image:url(./images/boutton-fond.gif)">Approve</td>                    
                        <td width="11"><img src="./images/boutton-droite.gif" border="0"></td>
                      </tr>
                    </table>
				    </div>
				  </td>  
                
				 <td align="center">
				    
					  <table width="75"  border="0" cellpadding="0" cellspacing="0" class="menutext">
                      <tr>
                        <td width="6"><img src="./images/boutton-gauche.gif" border="0"></td>
                        <td width="401" align="center" style="background-image:url(./images/boutton-fond.gif)" class="inactif"> Deny </td>                    
                        <td width="11"><img src="./images/boutton-droite.gif" border="0"></td>
                      </tr>
                    </table>
				    </div>
				  </td>  
                <?php } ?>

                <td>
                  <?php echo $StatutName ?>
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