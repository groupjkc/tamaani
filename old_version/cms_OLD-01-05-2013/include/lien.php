<?php
/****************************************************************************
                      Supprime une liste d'actualit�s
****************************************************************************/
function lien_supprimer($tab) {  
  if (count($tab)==0)         // Param�tre vide ?
    return;
	
  $str = implode(", ", $tab);
  		  
  //---> Suppresion effective de la base de donn�es
  $sql = "DELETE FROM lien
          WHERE lien_id IN ($str)";
  $res = executer($sql,__FILE__,__LINE__);
} //Fin lien_supprimer
/**************************************************************************************************
                       Modifier la propri�t� visible d'un ensemble de lien
**************************************************************************************************/
function lien_visible($tab, $tab_id)
{
  $id  = implode(", ", $tab_id);
  $sql = "UPDATE lien
          SET lien_visible = 'N'
          WHERE lien_id IN ($id)";
  $res = executer($sql,__FILE__,__LINE__);
  if (count($tab)>0)
  {
    $str = implode(", ", $tab);
    $sql = "UPDATE lien
            SET   lien_visible = 'Y'
            WHERE lien_id IN ($str)";
    $res = executer($sql,__FILE__,__LINE__);     
  } //Fsi			
} //Fin lien_visible
/****************************************************************************
   			        D�finir l'objet de pagination
****************************************************************************/
function lien_pagination_object()
{
 $p   = new CPagination("lien","lien_visible = 'Y'",5,"lien_titre","ASC");
 return $p;
} //Fin lien_pagination_object

/*******************************************
 *	function pour enregistrer une image.
 ******************************************/
function lien_icon_update($lien_id, $filename, $filesize=0)
{
  //---> Je supprime le fichier pr�c�dent
  $sql = "SELECT lien_icon
	      FROM   lien
		  WHERE  lien_id = $lien_id";
  $res = executer($sql,__FILE__,__LINE__); //---> Ex�cuter la requ�te	 
  $fn  = stripslashes(@mysql_result($res, 0, "pdf_en"));
  if ($filename != $fn)    //---> uniquement si c'est pas le m�me
    @unlink("../../images/links/$fn");
	
  //---> Je mets � jour le nom du fichier de t�l�chargement
  $sql = "UPDATE lien
	      SET    lien_icon = '$filename'               
		  WHERE  lien_id      = $lien_id";
  $res = executer($sql,__FILE__,__LINE__); //---> Ex�cuter la requ�te
} //Fin pdf_en_update


 
 
?>