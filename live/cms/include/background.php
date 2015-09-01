<?php
/****************************************************************************
                      Supprime une liste de rubriques
****************************************************************************/
function background_supprimer($tab) {
  if (count($tab)==0)         // Paramètre vide ?
    return;
	
  $str = implode(", ", $tab);
  
  //---> Supprimer les fichiers à télécharger
  $sql = "SELECT filename
          FROM   background
          WHERE  background_id IN ($str)";
  $res = executer($sql,__FILE__,__LINE__);  
  while ($row = @mysql_fetch_array($res))
  {
    if ($row['filename']!=NULL && $row['filename']!="") {
	  @unlink("../../background/".stripslashes($row['filename']));
	} //Fsi
  } //FTQ
  
  //---> Suppresion effective de la base de données
  $sql = "DELETE FROM background
          WHERE background_id IN ($str)";
  $res = executer($sql,__FILE__,__LINE__);
} //Fin background_supprimer





/**************************************************************************************************
                Modifier la propriété visible d'un ensemble de backgrounds
**************************************************************************************************/
function background_visible($tab, $tab_id)
{
  $id  = implode(", ", $tab_id);
  $sql = "UPDATE background
          SET   background_visible = 'N'
          WHERE background_id IN ($id)";
  $res = executer($sql,__FILE__,__LINE__);
  if (count($tab)>0)
  {
    $str = implode(", ", $tab);
    $sql = "UPDATE background
            SET   background_visible = 'Y'
            WHERE background_id IN ($str)";
    $res = executer($sql,__FILE__,__LINE__);     
  } //Fsi			
} //Fin background_rubrique_visible


/****************************************************************************
                   Mettre à jour le fichier de téléchargement
				                  et
					Supprimer le fichier précédent
****************************************************************************/
function filename_update($background_id, $filename, $filesize=0)
{
  //---> Je supprime le fichier précédent
  $sql = "SELECT filename
	      FROM   background
		  WHERE  background_id = $background_id";
  $res = executer($sql,__FILE__,__LINE__); //---> Exécuter la requête	 
  $fn  = stripslashes(@mysql_result($res, 0, "filename"));
  if ($filename != $fn)    //---> uniquement si c'est pas le même
    @unlink("../../filename/downloads/$fn");
	
  //---> Je mets à jour le nom du fichier de téléchargement
  $sql = "UPDATE background
	      SET    filename = '$filename'               
		  WHERE  background_id      = $background_id";
  $res = executer($sql,__FILE__,__LINE__); //---> Exécuter la requête
} //Fin pdf_en_update

function pdf_in_update($background_id, $filename, $filesize=0)
{
  //---> Je supprime le fichier précédent
  $sql = "SELECT pdf_in
	      FROM   background
		  WHERE  background_id = $background_id";
  $res = executer($sql,__FILE__,__LINE__); //---> Exécuter la requête	 
  $fn  = stripslashes(@mysql_result($res, 0, "pdf_en"));
  if ($filename != $fn)    //---> uniquement si c'est pas le même
    @unlink("../../pdf/downloads/$fn");
	
  //---> Je mets à jour le nom du fichier de téléchargement
  $sql = "UPDATE background
	      SET    pdf_in = '$filename'               
		  WHERE  background_id      = $background_id";
  $res = executer($sql,__FILE__,__LINE__); //---> Exécuter la requête
} //Fin pdf_en_update
?>