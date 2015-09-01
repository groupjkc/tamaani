<?php
/****************************************************************************
                      Supprime une liste de rubriques
****************************************************************************/
function background_supprimer($tab) {
  if (count($tab)==0)         // Param�tre vide ?
    return;
	
  $str = implode(", ", $tab);
  
  //---> Supprimer les fichiers � t�l�charger
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
  
  //---> Suppresion effective de la base de donn�es
  $sql = "DELETE FROM background
          WHERE background_id IN ($str)";
  $res = executer($sql,__FILE__,__LINE__);
} //Fin background_supprimer





/**************************************************************************************************
                Modifier la propri�t� visible d'un ensemble de backgrounds
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
                   Mettre � jour le fichier de t�l�chargement
				                  et
					Supprimer le fichier pr�c�dent
****************************************************************************/
function filename_update($background_id, $filename, $filesize=0)
{
  //---> Je supprime le fichier pr�c�dent
  $sql = "SELECT filename
	      FROM   background
		  WHERE  background_id = $background_id";
  $res = executer($sql,__FILE__,__LINE__); //---> Ex�cuter la requ�te	 
  $fn  = stripslashes(@mysql_result($res, 0, "filename"));
  if ($filename != $fn)    //---> uniquement si c'est pas le m�me
    @unlink("../../filename/downloads/$fn");
	
  //---> Je mets � jour le nom du fichier de t�l�chargement
  $sql = "UPDATE background
	      SET    filename = '$filename'               
		  WHERE  background_id      = $background_id";
  $res = executer($sql,__FILE__,__LINE__); //---> Ex�cuter la requ�te
} //Fin pdf_en_update

function pdf_in_update($background_id, $filename, $filesize=0)
{
  //---> Je supprime le fichier pr�c�dent
  $sql = "SELECT pdf_in
	      FROM   background
		  WHERE  background_id = $background_id";
  $res = executer($sql,__FILE__,__LINE__); //---> Ex�cuter la requ�te	 
  $fn  = stripslashes(@mysql_result($res, 0, "pdf_en"));
  if ($filename != $fn)    //---> uniquement si c'est pas le m�me
    @unlink("../../pdf/downloads/$fn");
	
  //---> Je mets � jour le nom du fichier de t�l�chargement
  $sql = "UPDATE background
	      SET    pdf_in = '$filename'               
		  WHERE  background_id      = $background_id";
  $res = executer($sql,__FILE__,__LINE__); //---> Ex�cuter la requ�te
} //Fin pdf_en_update
?>