<?php


/****************************************************************************
                      Supprime une liste de site
					  ****************************************************************************/
function site_supprimer($tab)
{
  if (count($tab) == 0)
  {
    return;
  }
  $str = implode(', ', $tab);
  $sql = "DELETE FROM site
          WHERE       site_id
          IN          ($str)
         ";
  $res = executer($sql, __FILE__, __LINE__);
}


/****************************************************************************
  Définir l'objet de pagination pour une catégorie de faq
****************************************************************************/
function site_pagination_object()
{
  $p = new CPagination('site','active = \'Y\'', 10, 'SiteName', 'ASC');
  return $p;
}

/*************************************************************************************************
  Définir l'objet de pagination d'une faq
*************************************************************************************************/

/**************************************************************************************************
  Modifier la propriété "visible" d'un ensemble de catégorie de faq
**************************************************************************************************/
function site_visible($tab, $tab_id)
{
  $id  = implode(", ", $tab_id);
  $sql = "UPDATE site
          SET    active = 'N'
          WHERE  site_id
          IN     ($id)
         ";
  $res = executer($sql, __FILE__, __LINE__);
  if (count($tab) > 0)
  {
    $str = implode(", ", $tab);
    $sql = "UPDATE site
            SET    active = 'Y'
            WHERE  site_id
            IN     ($str)
           ";
    $res = executer($sql, __FILE__, __LINE__);
  }			
}


function site_Nunavik($tab, $tab_id)
{
  $id  = implode(", ", $tab_id);
  $sql = "UPDATE site
          SET    Nunavik = 'N'
          WHERE  site_id
          IN     ($id)
         ";
  $res = executer($sql, __FILE__, __LINE__);
  if (count($tab) > 0)
  {
    $str = implode(", ", $tab);
    $sql = "UPDATE site
            SET    Nunavik = 'Y'
            WHERE  site_id
            IN     ($str)
           ";
    $res = executer($sql, __FILE__, __LINE__);
  }			
}



?>