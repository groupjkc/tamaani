<?php 
   include "../include/fonctions.php" ;
   include "../include/connexion.php";
   
  $rubrique      = "text"; 
  $admin_user_id = isset($_GET['admin_user_id'])? $_GET['admin_user_id'] : 0; 
  include "include/session_test.php"; //---> Tester la session et 
                                       //     Importer les variables $select, $mod, $insert, $delete
   include "../include/text.php";  //---> Les fonctions du module text 											   

   //---> Le formaulire de la page en cours a été envoyé
   if (isset($_POST['title_en']))
   { 
     include "include/operation_message.php";  //---> inclure fonction pour afficher un message
	 
		$title_en            = lecture($_POST['title_en']);
		$title_fr            = lecture($_POST['title_fr']);
		$title_in            = lecture($_POST['title_in']);	

		$text_en        = $_POST['text_en'];
		$text_fr        = $_POST['text_fr'];
		$text_in        = $_POST['text_in'];
		
			

     if (isset($_GET['text_id']))
	 { //---> il s'agit d'une modification	
	   $text_id = $_GET['text_id'];
	   $sql = "UPDATE text
	           SET    title_en        = '$title_en' ,
			   		  title_fr        = '$title_fr' ,
					  title_in        = '$title_in' ,
					 
					  text_en        = '$text_en' ,
			   		  text_fr        = '$text_fr' , 
					  text_in        = '$text_in' 
					  
					  WHERE  text_id    =  $text_id            ";
	   $res = executer($sql,__FILE__,__LINE__);           //---> Exécuter la requête
       operation_message("Change Completed", TRUE);  //---> Msg + Fermer la fenêtre	  
	 } else
	 { //---> il s'agit d'une insertion
       $sql = "INSERT INTO text
	           SET    title_en        = '$title_en' ,
			   		  title_fr        = '$title_fr' ,
					  title_in        = '$title_in' ,

					 
					  text_en        = '$text_en' ,
			   		  text_fr        = '$text_fr' , 
					  text_in        = '$text_in'
					  
					  "	;	
	   //---> Exécuter la requête et faire $text_id = @mysql_insert_id();
	   $res            = executer_id($sql,__FILE__,__LINE__,$text_id); //---> Exécuter la requête
       operation_message("Done", FALSE);   //---> Msg + Racharger la page d'insertion	 
	 } //Fsi
	 
 	 //---> Télécharger le fichier de téléchargement EN
	 if ($_FILES["text_icon"]["size"] > 0 && 
	     $_FILES["text_icon"]["error"]==0 &&
		 !empty($_FILES["text_icon"]["name"]) )
	 {
	   $filename_en   = strtolower($_FILES["text_icon"]["name"]);
	   upload_file("text_icon", "../../images/$filename_en");
	   $filesize   = @filesize("../../images/$filename_en");
	   text_icon_update($text_id, $filename_en, $filesize);
	 } //Fsi

	 exit();
   } //Fsi

   //---> Champs du formulaire
   if (isset($_GET['text_id'])) 
   { //---> il s'agit d'une modification
	 $op  = "Update";
	 $sql = "SELECT *
	         FROM   text
			 WHERE  text_id = " . $_GET['text_id'];
     $res = executer($sql,__FILE__,__LINE__); //---> Exécuter la requête
	 $row = mysql_fetch_array($res);
	 if ($row==FALSE)
	   die("Error");	     

		$title_en            = stripslashes($row['title_en']);
		$title_fr            = stripslashes($row['title_fr']);
		$title_in            = stripslashes($row['title_in']);
		
		$text_en        = stripslashes($row['text_en']);
		$text_fr        = stripslashes($row['text_fr']);
		$text_in        = stripslashes($row['text_in']);	
	
		$text_icon   = stripslashes($row['text_icon']);  
		$text_id     = $row['text_id'];				
	 
   } else
   { //---> il s'agit d'une modification
		$op             = "Add";	 
		$title_en       = "";
		$text_icon   = ""; 
		$title_fr       = "";	
		$title_in       = "";
		
		$text_en        = "";
		$text_fr        = "";
		$text_in        = "";	 
		
		$text_id     = NULL;			   
   } //Fsi
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title><?php echo $op?> un text</title>
<link href="include/style_admin.css" rel="stylesheet" type="text/css">
<link href="../../css/style.css" rel="stylesheet" type="text/css">

<script language="JavaScript" src="../include/scripts.js"></script>
<script type="text/javascript" language="javascript">
<!--
  var text_icon_choisi = false;
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
	text.delete_file.file.value = "fichier";
	text.delete_file.submit();
  } //Fin supprimer_fichier
	
-->
</script>

    
<script type="text/javascript"  src="include/ckeditor/ckeditor.js"></script>
<script src="include/ckeditor/_samples/sample.js" type="text/javascript"></script>


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
  <td align="center" valign="middle" >
    <!--******************************************************************************************
	                                 Début de l'encadrement blanc
    *******************************************************************************************-->	  
	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
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
          <td width="98%"><span class="titre">text </span></td> 
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
	            <?php echo $op?></td>
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
				    Text En: *
				  </td>
                  <td align="left" class="menutext">
                    <textarea cols="80" id="editor1" name="text_en" rows="10"><?php echo $text_en?></textarea>

                  </td>
                </tr> 

 
				<tr align="left">
                  <td class="obligatoire">
				    Text Fr: 
				  </td>
                  <td align="left" class="menutext">
                    <textarea cols="80" id="editor2" name="text_fr" rows="10"><?php echo $text_fr?></textarea>

                  </td>
                </tr> 
                
  
				<tr align="left">
                  <td class="obligatoire">
				    Text In: 
				  </td>
                  <td align="left" class="menutext">
                    <textarea cols="80" id="editor3" name="text_in" rows="10"><?php echo $text_in?></textarea>

                  </td>
                </tr>  
                


          	 <tr align="left">
       			<script type="text/javascript">
			
			//<![CDATA[
				editor1 = CKEDITOR.replace( 'editor1' );
				editor2 = CKEDITOR.replace( 'editor2' );
				editor3 = CKEDITOR.replace( 'editor3' );
	
				
			//]]>
			</script>                 	
                <tr align="left">
                  <td class="<?php echo isset($_GET['text_id'])? 'text' : 'obligatoire' ?>">
				    Upload : <?php echo isset($_GET['text_id'])? '' : '*' ?>
				  </td>
                  <td align="right" class="menutext">
			        <!--***************************************************************************
                                              Début Téléchargement de fichiers
					****************************************************************************-->
                    <table border=0 width="100%" align="right">
                    <tr>
                      <td align="left">
					    <input name="text_icon" type="file" value="<?php echo $text_icon?>" class="zone" style="width:275px;"
						       onChange="verif_upload_filename(this); text_icon_choisi = true;">
                      </td>
					<?php 
		              if ($text_icon!=NULL && $text_icon!="")  //---> Faut il afficher l'cône du texts
		              {
		            ?>
   <td width="75" align="center" bgcolor="#AAB7BD"><img id="overview_une" name="overview_une" src="../../images/<?php echo $text_icon?>" width="75" height="75" border="0" align="absmiddle" alt="Photo" /></td>
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
                        <td width="401" align="center" style="background-image:url(./images/boutton-fond.gif)">close</td>                    
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