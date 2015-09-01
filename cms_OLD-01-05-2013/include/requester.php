<?php
/****************************************************************************
                      Supprime une liste d'actualités
****************************************************************************/
function requester_supprimer($tab) {  
  if (count($tab)==0)         // Paramètre vide ?
    return;
	
  $str = implode(", ", $tab);
  		  
  //---> Suppresion effective de la base de données
  $sql = "DELETE FROM requester
          WHERE requester_id IN ($str)";
  $res = executer($sql,__FILE__,__LINE__);
} //Fin requester_supprimer
/**************************************************************************************************
                       Modifier la propriété visible d'un ensemble de requester
**************************************************************************************************/

/****************************************************************************
   			        Définir l'objet de pagination
****************************************************************************/
function requester_pagination_object()
{
 $p   = new CPagination("requester"," ",5,"CompanyName","DESC");
 return $p;
} //Fin requester_pagination_object

/*******************************************
 *	function pour enregistrer une image.
 ******************************************/

function requester_statut1($Statut, $id)
{

  $sql = "UPDATE requester
          SET    Statut = '$Statut'
          WHERE  requester_id ='$id'       ";
  $res = executer($sql, __FILE__, __LINE__);
}
 
 
?>