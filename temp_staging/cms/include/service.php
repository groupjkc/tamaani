<?php
/****************************************************************************
                      Supprime une liste d'actualit�s
****************************************************************************/
function service_supprimer($tab) {  
  if (count($tab)==0)         // Param�tre vide ?
    return;
	
  $str = implode(", ", $tab);
  		  
  //---> Suppresion effective de la base de donn�es
  $sql = "DELETE FROM service
          WHERE service_id IN ($str)";
  $res = executer($sql,__FILE__,__LINE__);
} //Fin service_supprimer
/**************************************************************************************************
                       Modifier la propri�t� visible d'un ensemble de service
**************************************************************************************************/

/****************************************************************************
   			        D�finir l'objet de pagination
****************************************************************************/
function service_pagination_object()
{
 $p   = new CPagination("service"," ",5,"service_titre","ASC");
 return $p;
} //Fin service_pagination_object

/*******************************************
 *	function pour enregistrer une image.
 ******************************************/
function service_icon_update($service_id, $filename, $filesize=0)
{
  //---> Je supprime le fichier pr�c�dent
  $sql = "SELECT service_icon
	      FROM   service
		  WHERE  service_id = $service_id";
  $res = executer($sql,__FILE__,__LINE__); //---> Ex�cuter la requ�te	 
  $fn  = stripslashes(@mysql_result($res, 0, "pdf_en"));
  if ($filename != $fn)    //---> uniquement si c'est pas le m�me
    @unlink("../../images/$fn");
	
  //---> Je mets � jour le nom du fichier de t�l�chargement
  $sql = "UPDATE service
	      SET    service_icon = '$filename'               
		  WHERE  service_id      = $service_id";
  $res = executer($sql,__FILE__,__LINE__); //---> Ex�cuter la requ�te
} //Fin pdf_en_update


 
 
?>