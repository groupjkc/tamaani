<?php
/****************************************************************************
                      Supprime une liste d'actualit�s
****************************************************************************/
function requester_supprimer($tab) {  
  if (count($tab)==0)         // Param�tre vide ?
    return;
	
  $str = implode(", ", $tab);
  		  
  //---> Suppresion effective de la base de donn�es
  $sql = "DELETE FROM requester
          WHERE requester_id IN ($str)";
  $res = executer($sql,__FILE__,__LINE__);
} //Fin requester_supprimer
/**************************************************************************************************
                       Modifier la propri�t� visible d'un ensemble de requester
**************************************************************************************************/

/****************************************************************************
   			        D�finir l'objet de pagination
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