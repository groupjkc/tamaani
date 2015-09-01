<?php
/****************************************************************************
                      Supprime une liste d'actualités
****************************************************************************/
function text_supprimer($tab) {  
  if (count($tab)==0)         // Paramètre vide ?
    return;
	
  $str = implode(", ", $tab);
  		  
  //---> Suppresion effective de la base de données
  $sql = "DELETE FROM text
          WHERE text_id IN ($str)";
  $res = executer($sql,__FILE__,__LINE__);
} //Fin text_supprimer
/**************************************************************************************************
                       Modifier la propriété visible d'un ensemble de text
**************************************************************************************************/

/****************************************************************************
   			        Définir l'objet de pagination
****************************************************************************/
function text_pagination_object()
{
 $p   = new CPagination("text"," ",5,"text_titre","ASC");
 return $p;
} //Fin text_pagination_object

/*******************************************
 *	function pour enregistrer une image.
 ******************************************/
function text_icon_update($text_id, $filename, $filesize=0)
{
  //---> Je supprime le fichier précédent
  $sql = "SELECT text_icon
	      FROM   text
		  WHERE  text_id = $text_id";
  $res = executer($sql,__FILE__,__LINE__); //---> Exécuter la requête	 
  $fn  = stripslashes(@mysql_result($res, 0, "pdf_en"));
  if ($filename != $fn)    //---> uniquement si c'est pas le même
    @unlink("../../images/$fn");
	
  //---> Je mets à jour le nom du fichier de téléchargement
  $sql = "UPDATE text
	      SET    text_icon = '$filename'               
		  WHERE  text_id      = $text_id";
  $res = executer($sql,__FILE__,__LINE__); //---> Exécuter la requête
} //Fin pdf_en_update


 
 
?>