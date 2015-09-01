<?php 
   include "../include/fonctions.php" ;
   include "../include/connexion.php";
   
  $rubrique      = "lien"; 
  $admin_user_id = isset($_GET['admin_user_id'])? $_GET['admin_user_id'] : 0; 
  include "include/session_test.php"; //---> Tester la session et 
                                       //     Importer les variables $select, $mod, $insert, $delete
   include "../include/lien.php";  //---> Les fonctions du module lien 											   

   //---> Le formaulire de la page en cours a été envoyé
   if (isset($_POST['title_en']))
   { 
     include "include/operation_message.php";  //---> inclure fonction pour afficher un message
	 
     $title_en       = lecture($_POST['title_en']);
     $lien_icon         = lecture($_FILES['lien_icon']['name']);
     $title_fr       = lecture($_POST['title_fr']);
     $title_in       = lecture($_POST['title_in']);
     $lien_url       = lecture($_POST['lien_url']);	 
	 
     if (isset($_GET['lien_id']))
	 { //---> il s'agit d'une modification	
	   $lien_id = $_GET['lien_id'];
	   $sql = "UPDATE lien
	           SET    title_en        = '$title_en' ,
			   		  title_fr        = '$title_fr' ,
					  title_in        = '$title_in' ,
					  lien_url        = '$lien_url' 
					  WHERE  lien_id    =  $lien_id            ";
	   $res = executer($sql,__FILE__,__LINE__);           //---> Exécuter la requête
       operation_message("Change Completed", TRUE);  //---> Msg + Fermer la fenêtre	  
	 } else
	 { //---> il s'agit d'une insertion
       $sql = "INSERT INTO lien
	           SET      title_en        = '$title_en' ,
						title_fr        = '$title_fr' ,
						title_in        = '$title_in' ,
						lien_url        = '$lien_url' ,
					    lien_visible                   = 'Y'   ";
	   //---> Exécuter la requête et faire $lien_id = @mysql_insert_id();
	   $res            = executer_id($sql,__FILE__,__LINE__,$lien_id); //---> Exécuter la requête
       operation_message("Done", FALSE);   //---> Msg + Racharger la page d'insertion	 
	 } //Fsi
	 
 	 //---> Télécharger le fichier de téléchargement EN
	 if ($_FILES["lien_icon"]["size"] > 0 && 
	     $_FILES["lien_icon"]["error"]==0 &&
		 !empty($_FILES["lien_icon"]["name"]) )
	 {
	   $filename_en   = strtolower($_FILES["lien_icon"]["name"]);
	   upload_file("lien_icon", "../../images/links/$filename_en");
	   $filesize   = @filesize("../../images/links/$filename_en");
	   lien_icon_update($lien_id, $filename_en, $filesize);
	 } //Fsi

	 
	 
	 exit();
   } //Fsi

   //---> Champs du formulaire
   if (isset($_GET['lien_id'])) 
   { //---> il s'agit d'une modification
	 $op  = "Update";
	 $sql = "SELECT *
	         FROM   lien
			 WHERE  lien_id = " . $_GET['lien_id'];
     $res = executer($sql,__FILE__,__LINE__); //---> Exécuter la requête
	 $row = mysql_fetch_array($res);
	 if ($row==FALSE)
	   die("Impossible de trouver l'actualité");	     
	 $title_en       = stripslashes($row['title_en']);
	 $title_fr       = stripslashes($row['title_fr']);
	 $title_in       = stripslashes($row['title_in']);
	 $lien_icon      = stripslashes($row['lien_icon']);  

	 $lien_url           = stripslashes($row['lien_url']);
     $lien_id          = $row['lien_id'];		 
   } else
   { //---> il s'agit d'une modification
	 $op                        = "Add";	 
	 $title_en       = "";
	 $lien_icon      = ""; 
	 $title_fr       = "";	
	 $title_in       = "";
	 $lien_url       = "http://";
     $lien_id        = NULL;			   
   } //Fsi
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title><?php echo $op?> un lien</title>
<link href="include/style_admin.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="../include/scripts.js"></script>
<script type="text/javascript" language="javascript">
<!--
  var lien_icon_choisi = false;
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
	lien.delete_file.file.value = "fichier";
	lien.delete_file.submit();
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
          <td width="98%"><span class="titre">Links </span></td> 
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
	            <?php echo $op?> a link
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
                  <td class="obligatoire">
				    Url: *
				  </td>
                  <td align="left" class="menutext">
			        <input name="lien_url" type="text" class='zone' value="<?php echo $lien_url?>" style="width:325px;">
                        
                  </td>
                </tr> 
                	
                <tr align="left">
                  <td class="<?php echo isset($_GET['lien_id'])? 'text' : 'obligatoire' ?>">
				    Upload : <?php echo isset($_GET['lien_id'])? '' : '*' ?>
				  </td>
                  <td align="right" class="menutext">
			        <!--***************************************************************************
                                              Début Téléchargement de fichiers
					****************************************************************************-->
                    <table border=0 width="100%" align="right">
                    <tr>
                      <td align="left">
					    <input name="lien_icon" type="file" value="<?php echo $lien_icon?>" class="zone" style="width:275px;"
						       onChange="verif_upload_filename(this); lien_icon_choisi = true;">
                      </td>
					<?php 
		              if ($lien_icon!=NULL && $lien_icon!="")  //---> Faut il afficher l'cône du liens
		              {
		            ?>
   <td width="75" align="center" bgcolor="#AAB7BD"><img id="overview_une" name="overview_une" src="../../images/links/<?php echo $lien_icon?>" width="75" height="75" border="0" align="absmiddle" alt="Photo" /></td>
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
                        <td width="401" align="center" style="background-image:url(./images/boutton-fond.gif)">Close</td>                    
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