<?php 
   include "../include/fonctions.php" ;
   include "../include/connexion.php";
   
  $rubrique      = "forms"; 
  $admin_user_id = isset($_GET['admin_user_id'])? $_GET['admin_user_id'] : 0; 
   include "include/session_test.php"; //---> Tester la session et                                    //     Importer les variables $select, $mod, $insert, $delete
   include "../include/forms.php";  //---> Les fonctions du module forms 						
   
					   

   //---> Le formaulire de la page en cours a été envoyé
   if (isset($_POST['title_en']))
   { 
     include "include/operation_message.php";  //---> inclure fonction pour afficher un message
	 
     $title_en       = lecture($_POST['title_en']);
     $pdf_en         = lecture($_FILES['pdf_en']['name']);
 
     $title_fr       = lecture($_POST['title_fr']);
     $pdf_fr         = lecture($_FILES['pdf_fr']['name']);
	
     $title_in       = lecture($_POST['title_in']);
     $pdf_in         = lecture($_FILES['pdf_in']['name']);	
	

     if (isset($_GET['forms_id']))
	 { //---> il s'agit d'une modification	
	   $forms_id = $_GET['forms_id'];
	   $sql = "UPDATE forms
	           SET    title_en        = '$title_en' ,
			   		  title_fr        = '$title_fr' ,
					  title_in        = '$title_in' 
					  WHERE  forms_id    =  $forms_id            ";
	   $res = executer($sql,__FILE__,__LINE__);           //---> Exécuter la requête
       operation_message("Change Completed", TRUE);  //---> Msg + Fermer la fenêtre	  
	 } else
	 { //---> il s'agit d'une insertion
       $sql = "INSERT INTO forms
	           SET      title_en        = '$title_en'        ,
						title_fr        = '$title_fr' ,
						title_in        = '$title_in' ,
					    forms_visible                   = 'Y'   ";
	   //---> Exécuter la requête et faire $forms_id = @mysql_insert_id();
	   $res            = executer_id($sql,__FILE__,__LINE__,$forms_id); //---> Exécuter la requête
       operation_message("Done", FALSE);   //---> Msg + Racharger la page d'insertion	 
	 } //Fsi
	 
 	 //---> Télécharger le fichier de téléchargement EN
	 if ($_FILES["pdf_en"]["size"] > 0 && 
	     $_FILES["pdf_en"]["error"]==0 &&
		 !empty($_FILES["pdf_en"]["name"]) )
	 {
	   $filename_en   = strtolower($_FILES["pdf_en"]["name"]);
	   upload_file("pdf_en", "../../forms/$filename_en");
	   $filesize   = @filesize("../../forms/$filename_en");
	   pdf_en_update($forms_id, $filename_en, $filesize);
	 } //Fsi
	 
 	 //---> Télécharger le fichier de téléchargement FR
	 if ($_FILES["pdf_fr"]["size"] > 0 && 
	     $_FILES["pdf_fr"]["error"]==0 &&
		 !empty($_FILES["pdf_fr"]["name"]) )
	 {
	   $filename_fr   = strtolower($_FILES["pdf_fr"]["name"]);
	   upload_file("pdf_fr", "../../forms/$filename_fr");
	   $filesize   = @filesize("../../forms/$filename_fr");
	   pdf_fr_update($forms_id, $filename_fr, $filesize);
	 } //Fsi

 	 //---> Télécharger le fichier de téléchargement IN
	 if ($_FILES["pdf_in"]["size"] > 0 && 
	     $_FILES["pdf_in"]["error"]==0 &&
		 !empty($_FILES["pdf_in"]["name"]) )
	 {
	   $filename_fr   = strtolower($_FILES["pdf_in"]["name"]);
	   upload_file("pdf_in", "../../forms/$filename_fr");
	   $filesize   = @filesize("../../forms/$filename_fr");
	   pdf_in_update($forms_id, $filename_fr, $filesize);
	 } //Fsi
	 
	 
	 
	 exit();
   } //Fsi

   //---> Champs du formulaire
   if (isset($_GET['forms_id'])) 
   { //---> il s'agit d'une modification
	 $op  = "Update";
	 $sql = "SELECT *
	         FROM   forms
			 WHERE  forms_id = " . $_GET['forms_id'];
     $res = executer($sql,__FILE__,__LINE__); //---> Exécuter la requête
	 $row = mysql_fetch_array($res);
	 if ($row==FALSE)
	   die("Impossible de trouver l'actualité");	     
	 $title_en       = stripslashes($row['title_en']);
	 $title_fr       = stripslashes($row['title_fr']);
	 $title_in       = stripslashes($row['title_in']);
	 $pdf_en         = stripslashes($row['pdf_en']); 
	 $pdf_fr         = stripslashes($row['pdf_fr']); 
	 $pdf_in         = stripslashes($row['pdf_in']); 	 
	 
     $forms_id          = $row['forms_id'];		 
   } else
   { //---> il s'agit d'une modification
	 $op          = "Add";	 
	 $title_en    = "";
	 $pdf_en      = "";
	 
	 $title_fr    = "";
	 $pdf_fr      = "";
	
	 $title_in    = "";
	 $pdf_in      = "";	
	 
	 
     $forms_id          = NULL;			   
   } //Fsi
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title><?php echo $op?> un forms</title>
<link href="include/style_admin.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="../include/scripts.js"></script>
<script type="text/javascript" language="javascript">
<!--
  var pdf_en_choisi = false;
  function verif()
  {
    if (document.form1.title_en.value == "") {
	  alert("Please enter the title");
      document.form1.title_en.focus();
	  return;
	} //Fsi
	
 
	document.form1.submit();
  } //Fin verif
  
  function supprimer_fichier()
  {
	document.delete_file.file.value = "fichier";
	document.delete_file.submit();
  } //Fin supprimer_fichier
	
-->
</script>


<!--**************************************************************************************************
                                Fin nécessaires pour insérer le calendrier
***************************************************************************************************-->
</head>
<body bgcolor="#AAB7BD">
<!--*****************************************************************************************************
                        Ce formulaire sert pour la suppression des fichiers
******************************************************************************************************-->
<form method="post" name="delete_file">
  <input name="file" type="hidden" value="image">
</form>
<table align="center" width="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
  <td align="center" valign="middle" height="320">
    <!--******************************************************************************************
	                                 Début de l'encadrement blanc
    *******************************************************************************************-->	  
	<table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr>
	  <td width="7" height="7"><img src="./images/cgh.gif" width="7" height="7"></td>
 	  <td bgcolor="#FFFFFF" width="99%"></td>
	  <td width="7"><img src="./images/cdh.gif" width="7" height="7"></td>
	  <td width="1"></td>
	</tr>
	<tr>
	  <td bgcolor="#FFFFFF" width="7"></td>
	  <td bgcolor="#FFFFFF">
		<table align="center" width="100%" cellpadding="0" cellspacing="0">
		<tr>
		  <td valign="top">
		  <!--*************************************************************************************
		                                       Début du contenu
		  **************************************************************************************-->
		    <table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
            <tr valign="top">
              <td colspan="2" height="10"></td>
            </tr>
			
			<tr valign="top"> 
    <td width="15" height="25"><img src="images/shim.gif" width="15" height="1"></td> 
    <td> <table width="100%"  border="0" cellspacing="0" cellpadding="0"> 
        <tr> 
          <td width="98%"><span class="titre">forms </span></td> 
          <td width="2%"><img src="./images/<?php echo $lang?>.gif" width="16" height="16" alt="<?php echo $lang_param[$lang]["description"]?>"></td> 
        </tr> 
      </table> 
      </td> 
  </tr> 
		
            <tr>
			  <td colspan="2" height="2" bgcolor="#FF0000"></td>
            </tr>
            <tr valign="top" align="left">
              <td height="25"></td>
              <td class="text">
                <img src="./images/flnoir.gif">
	            <?php echo $op?> a forms 
              </td>
            </tr>
            <tr valign="top">
              <td height="5"></td>
              <td></td>
            </tr>
            <tr valign="top">
              <td width="15" height="25"></td>
              <td class="text">
              <form action="" method="post" name="form1" enctype="multipart/form-data">
			    <!--******************************************************************************
				                              Début du formulaire
				*******************************************************************************-->
                <table width="95%" border="0" align="center" bgcolor="#FFFFFF" cellpadding="3">
                <tr align="left">
                  <td class="obligatoire">
				    Titre En: *
				  </td>
                  <td align="left" class="menutext">
			        <input name="title_en" type="text" class='zone' value="<?php echo $title_en?>" style="width:325px;">
                  </td>
                </tr>
 
                <tr align="left">
                  <td class="obligatoire">
				    Titre Fr: *
				  </td>
                  <td align="left" class="menutext">
			        <input name="title_fr" type="text" class='zone' value="<?php echo $title_fr?>" style="width:325px;">
                  </td>
                </tr>
                
                <tr align="left">
                  <td class="obligatoire">
				    Titre In: *
				  </td>
                  <td align="left" class="menutext">
			        <input name="title_in" type="text" class='zone' value="<?php echo $title_in?>" style="width:325px;">
                  </td>
                </tr>                 
                	
                <tr align="left">
                  <td class="<?php echo isset($_GET['forms_id'])? 'text' : 'obligatoire' ?>">
				    File En : <?php echo isset($_GET['forms_id'])? '' : '*' ?>
				  </td>
                  <td align="right" class="menutext">
			        <!--***************************************************************************
                                              Début Téléchargement de fichiers
					****************************************************************************-->
                    <table border=0 width="100%" align="right">
                    <tr>
                      <td align="left">
					    <input name="pdf_en" type="file" value="<?php echo $pdf_en?>" class="zone" style="width:275px;"
						       onChange="verif_upload_filename(this); pdf_en_choisi = true;">
                      </td>
					<?php 
		              if ($pdf_en!=NULL && $pdf_en!="")  //---> Faut il afficher l'cône du liens
		              {
		            ?>
                      <td width="27" align="left">
					    <a href="../../pdf/<?php echo $pdf_en?>">
					      <img src="./images/ph.gif" width="24" height="24" border="0" align="absmiddle" alt="téléchargement">
					    </a>
					  </td>
                    <?php	      
		              } //Fsi
		            ?>					  
                    </tr>              
                    
                    </table>
					<!--***************************************************************************
                                              Fin Téléchargement de fichiers
					****************************************************************************-->
                  </td>
                </tr>
                
 				<tr align="left">
                  <td class="<?php echo isset($_GET['forms_id'])? 'text' : 'obligatoire' ?>">
				    File Fr : <?php echo isset($_GET['forms_id'])? '' : '*' ?>
				  </td>
                  <td align="right" class="menutext">
			        <!--***************************************************************************
                                              Début Téléchargement de fichiers
					****************************************************************************-->
                    <table border=0 width="100%" align="right">
                        <tr>
                          <td align="left">
                            <input name="pdf_fr" type="file" value="<?php echo $pdf_en?>" class="zone" style="width:275px;"
                                   onChange="verif_upload_filename(this); pdf_en_choisi = true;">
                          </td>
                        <?php 
                          if ($pdf_fr!=NULL && $pdf_fr!="")  //---> Faut il afficher l'cône du liens
                          {
                        ?>
                          <td width="27" align="left">
                            <a href="../../pdf/<?php echo $pdf_fr?>">
                              <img src="./images/ph.gif" width="24" height="24" border="0" align="absmiddle" alt="téléchargement">
                            </a>
                          </td>
                        <?php	      
                          } //Fsi
                        ?>					  
                        </tr>
                    </table>
					<!--***************************************************************************
                                              Fin Téléchargement de fichiers
					****************************************************************************-->
                  </td>
                </tr>               
                
                <tr align="left">
                  <td class="<?php echo isset($_GET['forms_id'])? 'text' : 'obligatoire' ?>">
				    File In : <?php echo isset($_GET['forms_id'])? '' : '*' ?>
				  </td>
                  <td align="right" class="menutext">
			        <!--***************************************************************************
                                              Début Téléchargement de fichiers
					****************************************************************************-->
                    <table border=0 width="100%" align="right">
                    <tr>
                      <td align="left">
					    <input name="pdf_in" type="file" value="<?php echo $pdf_in?>" class="zone" style="width:275px;"
						       onChange="verif_upload_filename(this); pdf_en_choisi = true;">
                      </td>
					<?php 
		              if ($pdf_in!=NULL && $pdf_in!="")  //---> Faut il afficher l'cône du liens
		              {
		            ?>
                      <td width="27" align="left">
					    <a href="../../pdf/<?php echo $pdf_in?>">
					      <img src="./images/ph.gif" width="24" height="24" border="0" align="absmiddle" alt="téléchargement">
					    </a>
					  </td>
                    <?php	      
		              } //Fsi
		            ?>					  
                    </tr>              
                    
                    </table>
					<!--***************************************************************************
                                              Fin Téléchargement de fichiers
					****************************************************************************-->
                  </td>
                </tr>                
                
			    </table>
			    <!--******************************************************************************
				                               Fin du formulaire				
				*******************************************************************************-->				
			  </form>
              </td>
            </tr>
            <tr>
              <td height="25"></td>
              <td align="center">
			    <table border="0" align="center" cellpadding="0" cellspacing="0">
				<tr>
				  <td>
				    <div style="cursor:hand" onClick="javascript: verif();">
					  <table width="75"  border="0" cellpadding="0" cellspacing="0" class="menutext">
                      <tr>
                        <td width="6"><img src="./images/boutton-gauche.gif" border="0"></td>
                        <td width="401" align="center" style="background-image:url(./images/boutton-fond.gif)"><?php echo $op?></td>                    
                        <td width="11"><img src="./images/boutton-droite.gif" border="0"></td>
                      </tr>
                    </table>
				    </div>
				  </td>
				  <td width="25">&nbsp;</td>
				  <td>
				    <div style="cursor:hand" onClick="javascript: fermer_popup();">
					  <table width="75"  border="0" cellpadding="0" cellspacing="0" class="menutext">
                      <tr>
                        <td width="6"><img src="./images/boutton-gauche.gif" border="0"></td>
                        <td width="401" align="center" style="background-image:url(./images/boutton-fond.gif)">Fermer</td>                    
                        <td width="11"><img src="./images/boutton-droite.gif" border="0"></td>
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
		  <!--*************************************************************************************
		                                       Fin du contenu
		  **************************************************************************************-->
		  </td>
		</tr>
		</table>
	  </td>
	  <td bgcolor="#FFFFFF" width="7"></td>		
	  <td bgcolor="#7A7B7B" width="1"></td>	  
	</tr>
	<tr>
	  <td height="7" width="7"><img src="./images/cbg.gif" width="7" height="7"></td>
	  <td style="background-image:url(./images/b.gif)"></td>
	  <td width="7"><img src="./images/cbd.gif" width="7" height="7"></td>
	  <td></td>
	</tr>	  
	</table>
    <!--******************************************************************************************
	                                   Fin de l'encadrement blanc
    *******************************************************************************************-->	
  </td>	
</tr>
</table>	
</body>
</html>