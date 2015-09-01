<?php 
   include "../include/fonctions.php" ;
   include "../include/connexion.php";
   
  $rubrique      = "background"; 
  $admin_user_id = isset($_GET['admin_user_id'])? $_GET['admin_user_id'] : 0; 
   include "include/session_test.php"; //---> Tester la session et                                    //     Importer les variables $select, $mod, $insert, $delete
   include "../include/background.php";  //---> Les fonctions du module background 						
  
   //---> Le formaulire de la page en cours a été envoyé
   if (isset($_POST['idd']))
   { 
	  
     include "include/operation_message.php";  //---> inclure fonction pour afficher un message

     $filename         = lecture($_FILES['filename']['name']);

     if (isset($_GET['background_id']))
	 { //---> il s'agit d'une modification	
	   $background_id = $_GET['background_id'];
	   $sql = "UPDATE background
	           SET    `filename`     = '$filename'
					  WHERE  background_id    =  $background_id  ";
		
	   $res = executer($sql,__FILE__,__LINE__);           //---> Exécuter la requête
       operation_message("Change Completed", TRUE);  //---> Msg + Fermer la fenêtre	  
	 } else
	 { //---> il s'agit d'une insertion
       $sql = "INSERT INTO background
	           SET      `filename`     = '$filename',
					    background_visible                   = 'Y'   ";
						
		
	   //---> Exécuter la requête et faire $background_id = @mysql_insert_id();
	   $res            = executer_id($sql,__FILE__,__LINE__,$background_id); //---> Exécuter la requête
       operation_message("Done", FALSE);   //---> Msg + Racharger la page d'insertion	 
	 } //Fsi
	
 	 //---> Télécharger le fichier de téléchargement EN
	 if ($_FILES["filename"]["size"] > 0 && 
	     $_FILES["filename"]["error"]==0 &&
		 !empty($_FILES["filename"]["name"]) )
	 {
	   $filename_en   = strtolower($_FILES["filename"]["name"]);
	   upload_file("filename", "../../background/$filename");
	   $filesize   = @filesize("../../background/$filename_en");
	   filename_update($background_id, $filename, $filesize);
	 } //Fsi
	 
   } //Fsi

   //---> Champs du formulaire
   if (isset($_GET['background_id'])) 
   { //---> il s'agit d'une modification
	 $op  = "Update";
	 $sql = "SELECT *
	         FROM   background
			 WHERE  background_id = " . $_GET['background_id'];
     $res = executer($sql,__FILE__,__LINE__); //---> Exécuter la requête
	 $row = mysql_fetch_array($res);
	 if ($row==FALSE)
	   die("Impossible de trouver l'actualité");	     
	 $filename       = stripslashes($row['filename']);
     $background_id          = $row['background_id'];		 
   } else
   { //---> il s'agit d'une modification
	 $op          = "Add";	 
	 $filename    = "";
     $background_id          = NULL;			   
   } //Fsi
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title><?php echo $op?> un background</title>
<link href="include/style_admin.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="../include/scripts.js"></script>
<script type="text/javascript" language="javascript">
<!--
  var pdf_en_choisi = true;
  function verif()
  {
    if (document.form1.filename.value == "") {
	  alert("Please enter the title");
      document.form1.filename.focus();
	  return false;
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

<table align="center" width="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
  <td align="center" valign="middle" height="320">
    <!--******************************************************************************************
	                                 Début de l'encadrement blanc
    *******************************************************************************************-->	  
	<form action="" method="post" name="form1" enctype="multipart/form-data">
	<input type="hidden" name="idd" value="11111">
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
          <td width="98%"><span class="titre">background </span></td> 
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
	            <?php echo $op?> a background 
              </td>
            </tr>
            <tr valign="top">
              <td height="5"></td>
              <td></td>
            </tr>
            <tr valign="top">
              <td width="15" height="25"></td>
              <td class="text">

			    <!--******************************************************************************
				                              Début du formulaire
				*******************************************************************************-->
                <table width="95%" border="0" align="center" bgcolor="#FFFFFF" cellpadding="3">
                            
                	
                <tr align="left">
                  <td class="<?php echo isset($_GET['background_id'])? 'text' : 'obligatoire' ?>">
				    File : <?php echo isset($_GET['background_id'])? '' : '*' ?>
				  </td>
                  <td align="right" class="menutext">
			        <!--***************************************************************************
                                              Début Téléchargement de fichiers
					****************************************************************************-->
                    <table border=0 width="100%" align="right">
                    <tr>
                      <td align="left">
					    <input type="file" name="filename"  class="zone" style="width:275px;">
                      </td>
					<?php						
		              if ($filename!=NULL && $filename!="")  //---> Faut il afficher l'cône du liens
		              {
						
		            ?>
                      <td width="27" align="left">
					    <a href="../../background/<?php echo $filename; ?>">
					      <img src="../../background/<?php echo $filename; ?>" width="24" height="24" border="0" align="absmiddle" alt="téléchargement">
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
		</form>	
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