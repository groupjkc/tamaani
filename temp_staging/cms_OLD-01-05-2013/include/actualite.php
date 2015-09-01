<?php
/****************************************************************************
                      Supprime une liste d'actualit�s
****************************************************************************/
function actualite_supprimer($tab) {
  global $lang;

  $ext = "tmp";               // Extension des fichiers d'images temporaires
  if (count($tab)==0)         // Param�tre vide ?
    return;
  $str = implode(", ", $tab);
  
  //---> Supprimer les images
  foreach($tab as $actualite_id)
    @unlink("../common/Image/temp/actualite[$actualite_id].$ext");

  //---> Suppresion effective de la base de donn�es
  $sql = "DELETE FROM actualite
          WHERE actualite_id IN ($str)";
  $res = executer($sql,__FILE__,__LINE__);
} //Fin actualite_supprimer
/**************************************************************************************************
                       Modifier la propri�t� visible d'un ensemble de actualite
**************************************************************************************************/
function actualite_visible($tab, $tab_id)
{ 
  global $lang;
  $id  = implode(", ", $tab_id);
  $sql = "UPDATE actualite
          SET actualite_visible = 'N'
          WHERE actualite_id IN ($id)";
  $res = executer($sql,__FILE__,__LINE__);
  if (count($tab)>0)
  {
    $str = implode(", ", $tab);
    $sql = "UPDATE actualite
            SET   actualite_visible = 'Y'
            WHERE actualite_id IN ($str)";
    $res = executer($sql,__FILE__,__LINE__);     
  } //Fsi			
} //Fin actualite_visible

/****************************************************************************
                   Mettre � jour le fichier de image
				                  et
					Supprimer le fichier pr�c�dent
****************************************************************************/
function actualite_image_une_update($actualite_id, $filename, $ext="tmp")
{ 
  global $lang;
  $fn  = "actualite[$actualite_id].$ext";
  @copy($filename, "../downloads/actualite/une/$fn");
  $sql = "UPDATE actualite
	      SET    actualite_image_une = '$fn'
		  WHERE  actualite_id    = " . $_GET['actualite_id'];
  executer($sql,__FILE__,__LINE__);
} //Fin actualite_image_update
/****************************************************************************
                   Mettre � jour le fichier de image
				                  et
					Supprimer le fichier pr�c�dent
****************************************************************************/
function actualite_image_update($actualite_id, $filename, $ext="tmp")
{ 
  global $lang;
  $fn  = "actualite[$actualite_id].$ext";
  @copy($filename, "../downloads/actualite/$fn");
  $sql = "UPDATE actualite
	      SET    actualite_image = '$fn'
		  WHERE  actualite_id    = " . $_GET['actualite_id'];
  executer($sql,__FILE__,__LINE__);
} //Fin actualite_image_update
/****************************************************************************
                   Mettre � jour le fichier de t�l�chargement
				                  et
					Supprimer le fichier pr�c�dent
****************************************************************************/
function actualite_fichier_update($actualite_id, $filename)
{ 
  global $lang;
  
  //---> Je supprime le fichier pr�c�dent
  $sql = "SELECT actualite_fichier
	      FROM   actualite
		  WHERE  actualite_id = $actualite_id";
  $res = executer($sql,__FILE__,__LINE__); //---> Ex�cuter la requ�te	 
  $fn  = stripslashes(@mysql_result($res, 0, "actualite_fichier"));
  if ($filename != $fn)    //---> uniquement si c'est pas le m�me
    @unlink("../downloads/actualite/file/$fn");
  
  //---> Je mets � jour le nom du fichier de t�l�chargement
  $sql = "UPDATE actualite
          SET    actualite_fichier = '$filename'
          WHERE  actualite_id      = $actualite_id";
  $res = executer($sql,__FILE__,__LINE__); //---> Ex�cuter la requ�te
}
/****************************************************************************
   			        D�finir l'objet de pagination
****************************************************************************/

function actualite_arch($tab, $tab_id)
{
  $id  = implode(", ", $tab_id);
  $sql = "UPDATE actualite
          SET    actualite_arch = 'N'
          WHERE  actualite_id IN ($id)
         ";
  $res = executer($sql,__FILE__,__LINE__); 
  if (count($tab) > 0)
  {
    $str  = implode(", ", $tab);
    $sql1 = "UPDATE actualite
             SET    actualite_arch = 'Y'
             WHERE  actualite_id IN ($str)
            ";
    $res1 = executer($sql1, __FILE__, __LINE__);
    $sql2 = "UPDATE actualite
             SET    actualite_une = 'N'
             WHERE  actualite_id IN ($str)
            ";
    $res2 = executer($sql2, __FILE__, __LINE__);
  }			
}
/**************************************************************************************************
                       Modifier la propri�t� une d'un ensemble de actualite
**************************************************************************************************/
function actualite_une($tab, $tab_id)
{
  $id  = implode(", ", $tab_id);
  $sql = "UPDATE actualite
          SET   actualite_une = 'N'
          WHERE actualite_id IN ($id)
         ";
  $res = executer($sql, __FILE__, __LINE__);
  if (count($tab) > 0)
  {
    $str  = implode(", ", $tab);
    $sql1 = "UPDATE actualite
             SET    actualite_une = 'Y'
             WHERE  actualite_id IN ($str)
            ";
    $res1 = executer($sql1, __FILE__, __LINE__);
    $sql2 = "UPDATE actualite
             SET    actualite_visible = 'Y'
             WHERE  actualite_id IN ($str)
            ";
    $res2  = executer($sql2, __FILE__, __LINE__);
  }			
}

/**************************************************************************************************
                       
**************************************************************************************************/
function actualite_pagination_object()
{
 $p = new CPagination("actualite","actualite_visible = 'Y'",3,"actualite_date","DESC");
 return $p;
} //Fin actualite_pagination_object
?>