<?php
/****************************************************************************
                      Supprime une liste de rubriques
****************************************************************************/
function forms_supprimer($tab) {
  if (count($tab)==0)         // Param�tre vide ?
    return;
	
  $str = implode(", ", $tab);
  
  //---> Supprimer les fichiers � t�l�charger
  $sql = "SELECT pdf_en
          FROM   forms
          WHERE  forms_id IN ($str)";
  $res = executer($sql,__FILE__,__LINE__);  
  while ($row = @mysql_fetch_array($res))
  {
    if ($row['pdf_en']!=NULL && $row['pdf_en']!="") {
	  @unlink("../../forms/".stripslashes($row['pdf_en']));
	} //Fsi
  } //FTQ
  
  //---> Suppresion effective de la base de donn�es
  $sql = "DELETE FROM forms
          WHERE forms_id IN ($str)";
  $res = executer($sql,__FILE__,__LINE__);
} //Fin forms_supprimer





/**************************************************************************************************
                Modifier la propri�t� visible d'un ensemble de formss
**************************************************************************************************/
function forms_visible($tab, $tab_id)
{
  $id  = implode(", ", $tab_id);
  $sql = "UPDATE forms
          SET   forms_visible = 'N'
          WHERE forms_id IN ($id)";
  $res = executer($sql,__FILE__,__LINE__);
  if (count($tab)>0)
  {
    $str = implode(", ", $tab);
    $sql = "UPDATE forms
            SET   forms_visible = 'Y'
            WHERE forms_id IN ($str)";
    $res = executer($sql,__FILE__,__LINE__);     
  } //Fsi			
} //Fin forms_rubrique_visible


/****************************************************************************
                   Mettre � jour le fichier de t�l�chargement
				                  et
					Supprimer le fichier pr�c�dent
****************************************************************************/
function pdf_en_update($forms_id, $filename, $filesize=0)
{
  //---> Je supprime le fichier pr�c�dent
  $sql = "SELECT pdf_en
	      FROM   forms
		  WHERE  forms_id = $forms_id";
  $res = executer($sql,__FILE__,__LINE__); //---> Ex�cuter la requ�te	 
  $fn  = stripslashes(@mysql_result($res, 0, "pdf_en"));
  if ($filename != $fn)    //---> uniquement si c'est pas le m�me
    @unlink("../../pdf/$fn");
	
  //---> Je mets � jour le nom du fichier de t�l�chargement
  $sql = "UPDATE forms
	      SET    pdf_en = '$filename'               
		  WHERE  forms_id      = $forms_id";
  $res = executer($sql,__FILE__,__LINE__); //---> Ex�cuter la requ�te
} //Fin pdf_en_update

function pdf_fr_update($forms_id, $filename, $filesize=0)
{
  //---> Je supprime le fichier pr�c�dent
  $sql = "SELECT pdf_fr
	      FROM   forms
		  WHERE  forms_id = $forms_id";
  $res = executer($sql,__FILE__,__LINE__); //---> Ex�cuter la requ�te	 
  $fn  = stripslashes(@mysql_result($res, 0, "pdf_en"));
  if ($filename != $fn)    //---> uniquement si c'est pas le m�me
    @unlink("../../pdf/$fn");
	
  //---> Je mets � jour le nom du fichier de t�l�chargement
  $sql = "UPDATE forms
	      SET    pdf_fr = '$filename'               
		  WHERE  forms_id      = $forms_id";
  $res = executer($sql,__FILE__,__LINE__); //---> Ex�cuter la requ�te
} //Fin pdf_en_update

function pdf_in_update($forms_id, $filename, $filesize=0)
{
  //---> Je supprime le fichier pr�c�dent
  $sql = "SELECT pdf_in
	      FROM   forms
		  WHERE  forms_id = $forms_id";
  $res = executer($sql,__FILE__,__LINE__); //---> Ex�cuter la requ�te	 
  $fn  = stripslashes(@mysql_result($res, 0, "pdf_en"));
  if ($filename != $fn)    //---> uniquement si c'est pas le m�me
    @unlink("../../pdf/$fn");
	
  //---> Je mets � jour le nom du fichier de t�l�chargement
  $sql = "UPDATE forms
	      SET    pdf_in = '$filename'               
		  WHERE  forms_id      = $forms_id";
  $res = executer($sql,__FILE__,__LINE__); //---> Ex�cuter la requ�te
} //Fin pdf_en_update
?>