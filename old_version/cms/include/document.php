<?php
/****************************************************************************
                      Supprime une liste de rubriques
****************************************************************************/
function document_supprimer($tab) {
  if (count($tab)==0)         // Paramètre vide ?
    return;
	
  $str = implode(", ", $tab);
  
  //---> Supprimer les fichiers à télécharger
  $sql = "SELECT pdf_en
          FROM   document
          WHERE  document_id IN ($str)";
  $res = executer($sql,__FILE__,__LINE__);  
  while ($row = @mysql_fetch_array($res))
  {
    if ($row['pdf_en']!=NULL && $row['pdf_en']!="") {
	  @unlink("../../pdf/".stripslashes($row['pdf_en']));
	} //Fsi
  } //FTQ
  
  //---> Suppresion effective de la base de données
  $sql = "DELETE FROM document
          WHERE document_id IN ($str)";
  $res = executer($sql,__FILE__,__LINE__);
} //Fin document_supprimer





/**************************************************************************************************
                Modifier la propriété visible d'un ensemble de documents
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
                   Mettre à jour le fichier de téléchargement
				                  et
					Supprimer le fichier précédent
****************************************************************************/
function pdf_en_update($document_id, $filename, $filesize=0)
{
  //---> Je supprime le fichier précédent
  $sql = "SELECT pdf_en
	      FROM   document
		  WHERE  document_id = $document_id";
  $res = executer($sql,__FILE__,__LINE__); //---> Exécuter la requête	 
  $fn  = stripslashes(@mysql_result($res, 0, "pdf_en"));
  if ($filename != $fn)    //---> uniquement si c'est pas le même
    @unlink("../../pdf/downloads/$fn");
	
  //---> Je mets à jour le nom du fichier de téléchargement
  $sql = "UPDATE document
	      SET    pdf_en = '$filename'               
		  WHERE  document_id      = $document_id";
  $res = executer($sql,__FILE__,__LINE__); //---> Exécuter la requête
} //Fin pdf_en_update

function pdf_fr_update($document_id, $filename, $filesize=0)
{
  //---> Je supprime le fichier précédent
  $sql = "SELECT pdf_fr
	      FROM   document
		  WHERE  document_id = $document_id";
  $res = executer($sql,__FILE__,__LINE__); //---> Exécuter la requête	 
  $fn  = stripslashes(@mysql_result($res, 0, "pdf_en"));
  if ($filename != $fn)    //---> uniquement si c'est pas le même
    @unlink("../../pdf/downloads/$fn");
	
  //---> Je mets à jour le nom du fichier de téléchargement
  $sql = "UPDATE document
	      SET    pdf_fr = '$filename'               
		  WHERE  document_id      = $document_id";
  $res = executer($sql,__FILE__,__LINE__); //---> Exécuter la requête
} //Fin pdf_en_update

function pdf_in_update($document_id, $filename, $filesize=0)
{
  //---> Je supprime le fichier précédent
  $sql = "SELECT pdf_in
	      FROM   document
		  WHERE  document_id = $document_id";
  $res = executer($sql,__FILE__,__LINE__); //---> Exécuter la requête	 
  $fn  = stripslashes(@mysql_result($res, 0, "pdf_en"));
  if ($filename != $fn)    //---> uniquement si c'est pas le même
    @unlink("../../pdf/downloads/$fn");
	
  //---> Je mets à jour le nom du fichier de téléchargement
  $sql = "UPDATE document
	      SET    pdf_in = '$filename'               
		  WHERE  document_id      = $document_id";
  $res = executer($sql,__FILE__,__LINE__); //---> Exécuter la requête
} //Fin pdf_en_update
?>