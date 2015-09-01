<?php
/****************************************************************************
                      Supprime une liste de rubriques
****************************************************************************/
function document_supprimer($tab) {
  if (count($tab)==0)         // Param�tre vide ?
    return;
	
  $str = implode(", ", $tab);
  
  //---> Supprimer les fichiers � t�l�charger
  $sql = "SELECT document_fichier
          FROM   document
          WHERE  document_id IN ($str)";
  $res = executer($sql,__FILE__,__LINE__);  
  while ($row = @mysql_fetch_array($res))
  {
    if ($row['document_fichier']!=NULL && $row['document_fichier']!="") {
	  @unlink("../$lang/downloads/".stripslashes($row['document_fichier']));
	} //Fsi
  } //FTQ
  
  //---> Suppresion effective de la base de donn�es
  $sql = "DELETE FROM document
          WHERE document_id IN ($str)";
  $res = executer($sql,__FILE__,__LINE__);
} //Fin document_supprimer





/**************************************************************************************************
                Modifier la propri�t� visible d'un ensemble de documents
**************************************************************************************************/
function document_visible($tab, $tab_id)
{
  $id  = implode(", ", $tab_id);
  $sql = "UPDATE document
          SET   document_visible = 'N'
          WHERE document_id IN ($id)";
  $res = executer($sql,__FILE__,__LINE__);
  if (count($tab)>0)
  {
    $str = implode(", ", $tab);
    $sql = "UPDATE document
            SET   document_visible = 'Y'
            WHERE document_id IN ($str)";
    $res = executer($sql,__FILE__,__LINE__);     
  } //Fsi			
} //Fin document_rubrique_visible
/****************************************************************************
                      Supprime une liste de rubriques
****************************************************************************/
function document_rubrique_supprimer($tab) {
  $ext = "tmp";               // Extension des fichiers d'images temporaires
  
  if (count($tab)==0)         // Param�tre vide ?
    return;
	
  $str = implode(", ", $tab);
  
  //---> Supprimer les documents de ces rubriques
  $tab_id = array();
  $i      = 0      ;
  $sql = "SELECT DISTINCT document_id
          FROM  document
		  WHERE document_document_rubrique_id IN ($str)";
  $res = executer($sql,__FILE__,__LINE__);
  while ($row = mysql_fetch_array($res))
  {
    $tab_id[$i++] = $row['document_id'];
  } //FTQ
  document_supprimer($tab_id);
 
  //---> Supprimer les images
  foreach($tab as $document_rubrique_id)
    @unlink("../$lang/common/temp/document_rubrique[$document_rubrique_id].tmp");
  		  
  //---> Suppresion effective de la base de donn�es
  $sql = "DELETE FROM document_rubrique
          WHERE document_rubrique_id IN ($str)";
  $res = executer($sql,__FILE__,__LINE__);
} //Fin document_supprimer
/**************************************************************************************************
                       Modifier la propri�t� visible d'un ensemble de rubriques
**************************************************************************************************/
function document_rubrique_visible($tab, $tab_id)
{
  $id  = implode(", ", $tab_id);
  $sql = "UPDATE document_rubrique
          SET document_rubrique_visible = 'N'
          WHERE document_rubrique_id IN ($id)";
  $res = executer($sql,__FILE__,__LINE__);
  if (count($tab)>0)
  {
    $str = implode(", ", $tab);
    $sql = "UPDATE document_rubrique
            SET   document_rubrique_visible = 'Y'
            WHERE document_rubrique_id IN ($str)";
    $res = executer($sql,__FILE__,__LINE__);     
  } //Fsi			
} //Fin document_rubrique_visible




/*************
                       Modifier la propri�t� une d'un ensemble de actualite
**************************************************************************************************/
function document_rubrique_une($tab, $tab_id)
{
  $id  = implode(", ", $tab_id);
  $sql = "UPDATE document_rubrique
          SET   document_rubrique_une = 'N'
          WHERE document_rubrique_id IN ($id)";
  $res = executer($sql,__FILE__,__LINE__); 
  if (count($tab)>0)
  {
    $str = implode(", ", $tab);
    $sql = "UPDATE document_rubrique
            SET   document_rubrique_une = 'Y'
            WHERE document_rubrique_id IN ($str)";
    $res = executer($sql,__FILE__,__LINE__);     
  } //Fsi			
} //Fin actualite_une
/****************************************************************************
                   Mettre � jour le fichier de la photo
				                  et
					Supprimer le fichier pr�c�dent
****************************************************************************/
function document_rubrique_image_update($document_rubrique_id, $filename, $ext="tmp")
{
  $fn  = "document_rubrique[$document_rubrique_id].$ext";
  @copy($filename, "../$lang/common/temp/$fn");
  $sql = "UPDATE document_rubrique
	      SET    document_rubrique_image = '$fn'
		  WHERE  document_rubrique_id    = " . $_GET['document_rubrique_id'];
  executer($sql,__FILE__,__LINE__);
} //Fin document_rubrique_image_update
/****************************************************************************
                   Mettre � jour le fichier de t�l�chargement
				                  et
					Supprimer le fichier pr�c�dent
****************************************************************************/
function document_fichier_update($document_id, $filename, $filesize=0)
{
  //---> Je supprime le fichier pr�c�dent
  $sql = "SELECT document_fichier
	      FROM   document
		  WHERE  document_id = $document_id";
  $res = executer($sql,__FILE__,__LINE__); //---> Ex�cuter la requ�te	 
  $fn  = stripslashes(@mysql_result($res, 0, "document_fichier"));
  if ($filename != $fn)    //---> uniquement si c'est pas le m�me
    @unlink("../$lang/downloads/$fn");
	
  //---> Je mets � jour le nom du fichier de t�l�chargement
  $sql = "UPDATE document
	      SET    document_fichier = '$filename'       ,
		         document_nb      = 0                 ,
				 document_taille  = $filesize             
		  WHERE  document_id      = $document_id";
  $res = executer($sql,__FILE__,__LINE__); //---> Ex�cuter la requ�te
} //Fin document_fichier_update
?>