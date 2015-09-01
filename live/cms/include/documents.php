<?php
/****************************************************************************
                      Supprime une liste d'actualités
****************************************************************************/
function document_supprimer($tab) {  
  if (count($tab)==0)         // Paramètre vide ?
    return;
	
  $str = implode(", ", $tab);
  		  
  //---> Suppresion effective de la base de données
  $sql = "DELETE FROM document
          WHERE id IN ($str)";
  $res = executer($sql,__FILE__,__LINE__);
} //Fin document_supprimer
/**************************************************************************************************
                       Modifier la propriété visible d'un ensemble de document
**************************************************************************************************/
function document_visible($tab, $tab_id)
{
  $id  = implode(", ", $tab_id);
  $sql = "UPDATE document
          SET document_visible = 'N'
          WHERE id IN ($id)";
  $res = executer($sql,__FILE__,__LINE__);
  if (count($tab)>0)
  {
    $str = implode(", ", $tab);
    $sql = "UPDATE document
            SET   document_visible = 'Y'
            WHERE id IN ($str)";
    $res = executer($sql,__FILE__,__LINE__);     
  } //Fsi			
} //Fin document_visible
/****************************************************************************
   			        Définir l'objet de pagination
****************************************************************************/
function document_pagination_object()
{
 $p   = new CPagination("document","document_visible = 'Y'",5,"document_titre","ASC");
 return $p;
} //Fin document_pagination_object
?>