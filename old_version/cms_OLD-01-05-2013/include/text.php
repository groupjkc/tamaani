<?php
/****************************************************************************
                      Supprime une liste d'actualit�s
****************************************************************************/
function text_supprimer($tab) {  
  if (count($tab)==0)         // Param�tre vide ?
    return;
	
  $str = implode(", ", $tab);
  		  
  //---> Suppresion effective de la base de donn�es
  $sql = "DELETE FROM text
          WHERE text_id IN ($str)";
  $res = executer($sql,__FILE__,__LINE__);
} //Fin text_supprimer
/**************************************************************************************************
                       Modifier la propri�t� visible d'un ensemble de text
**************************************************************************************************/

/****************************************************************************
   			        D�finir l'objet de pagination
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
  //---> Je supprime le fichier pr�c�dent
  $sql = "SELECT text_icon
	      FROM   text
		  WHERE  text_id = $text_id";
  $res = executer($sql,__FILE__,__LINE__); //---> Ex�cuter la requ�te	 
  $fn  = stripslashes(@mysql_result($res, 0, "pdf_en"));
  if ($filename != $fn)    //---> uniquement si c'est pas le m�me
    @unlink("../../images/$fn");
	
  //---> Je mets � jour le nom du fichier de t�l�chargement
  $sql = "UPDATE text
	      SET    text_icon = '$filename'               
		  WHERE  text_id      = $text_id";
  $res = executer($sql,__FILE__,__LINE__); //---> Ex�cuter la requ�te
} //Fin pdf_en_update


 
 
?>