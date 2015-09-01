<?php
/****************************************************************************
                    Supprime une liste de FAQ
****************************************************************************/
function faq_supprimer($tab)
{
  if (count($tab) == 0)
  {
    return;
  }
  $str = implode(', ', $tab);
  $sql = "DELETE FROM faq
          WHERE       faq_id
          IN          ($str)
         ";
  $res = executer($sql, __FILE__, __LINE__);
}

/****************************************************************************
                      Supprime une liste de categories de FAQ
****************************************************************************/
function faq_categorie_supprimer($tab)
{
  if (count($tab) == 0)
  {
    return;
  }
  $str = implode(', ', $tab);
  $sql = "DELETE FROM faq_categorie
          WHERE       faq_categorie_id
          IN          ($str)
         ";
  $res = executer($sql, __FILE__, __LINE__);
  $sql_faq = "SELECT faq_id
              FROM   faq
              WHERE  faq_categorie_id
              IN ($str)
             ";
  $res_faq = executer($sql_faq, __FILE__, __LINE__);
  if(mysql_num_rows($res_faq) > 0)
  {
    while($row = mysql_fetch_array($res_faq))
    {
      $tab_faq[] = $row['faq_id'];
    }
    faq_supprimer($tab_faq);
  }
}

/****************************************************************************
              Déplacer un champs de la faq vers le bas
****************************************************************************/
function faq_deplacer_bas($ordre)
{
  executer("LOCK TABLES faq WRITE", __FILE__, __LINE__);
  $sql = "SELECT MIN(faq_ordre)
          FROM   faq
          WHERE  faq_ordre > $ordre
         ";
  $res = executer($sql, __FILE__, __LINE__);
  $ordre2 = mysql_result($res, 0, 0);
  if ($ordre2 != '')
  {
    $sql = "UPDATE faq
            SET    faq_ordre = 0
            WHERE  faq_ordre = $ordre2
           ";
    executer($sql, __FILE__, __LINE__);
    $sql = "UPDATE faq
            SET    faq_ordre = $ordre2
            WHERE  faq_ordre = $ordre
           ";
    executer($sql, __FILE__, __LINE__);
    $sql = "UPDATE faq
            SET    faq_ordre = $ordre
            WHERE  faq_ordre = 0
           ";
    executer($sql, __FILE__,__LINE__);
  }
  executer("UNLOCK TABLES", __FILE__,__LINE__);
}
/****************************************************************************
              Déplacer un champs de la faq vers le haut
****************************************************************************/
function faq_deplacer_haut($ordre)
{
  executer("LOCK TABLES faq WRITE", __FILE__, __LINE__);
  $sql = "SELECT MAX(faq_ordre)
          FROM   faq
          WHERE  faq_ordre < $ordre
         ";
  $res = executer($sql, __FILE__, __LINE__);
  $ordre2 = mysql_result($res, 0, 0);
  if ($ordre2 != '')
  {
    $sql = "UPDATE faq
            SET    faq_ordre = 0
            WHERE  faq_ordre = $ordre2
           ";
    executer($sql, __FILE__, __LINE__);
    $sql = "UPDATE faq
            SET    faq_ordre = $ordre2
            WHERE  faq_ordre = $ordre
           ";
    executer($sql, __FILE__, __LINE__);
    $sql = "UPDATE faq
            SET    faq_ordre = $ordre
            WHERE  faq_ordre = 0
           ";
    executer($sql, __FILE__, __LINE__);
  }
  executer("UNLOCK TABLES", __FILE__, __LINE__);
}

/****************************************************************************
  Définir l'objet de pagination pour une catégorie de faq
****************************************************************************/
function faq_categorie_pagination_object()
{
  $p = new CPagination('faq_categorie','faq_categorie_visible = \'Y\'', 10, 'faq_categorie_titre', 'ASC');
  return $p;
}

/*************************************************************************************************
  Définir l'objet de pagination d'une faq
*************************************************************************************************/
function faq_pagination_object()
{
  $p = new CPagination('faq', '', 5, 'faq_question','ASC');
  return $p;
}

/**************************************************************************************************
  Modifier la propriété "visible" d'un ensemble de catégorie de faq
**************************************************************************************************/
function faq_categorie_visible($tab, $tab_id)
{
  $id  = implode(", ", $tab_id);
  $sql = "UPDATE faq_categorie
          SET    faq_categorie_visible = 'N'
          WHERE  faq_categorie_id
          IN     ($id)
         ";
  $res = executer($sql, __FILE__, __LINE__);
  if (count($tab) > 0)
  {
    $str = implode(", ", $tab);
    $sql = "UPDATE faq_categorie
            SET    faq_categorie_visible = 'Y'
            WHERE  faq_categorie_id
            IN     ($str)
           ";
    $res = executer($sql, __FILE__, __LINE__);
  }			
}

/**************************************************************************************************
  Modifier la propriété "visible" d'un ensemble de faq
**************************************************************************************************/
function faq_visible($tab, $tab_id)
{
  $id  = implode(", ", $tab_id);
  $sql = "UPDATE faq
          SET    faq_visible = 'N'
          WHERE  faq_id
          IN     ($id)
         ";
  $res = executer($sql, __FILE__, __LINE__);
  if (count($tab) > 0)
  {
    $str = implode(", ", $tab);
    $sql = "UPDATE faq
            SET    faq_visible = 'Y'
            WHERE  faq_id
            IN     ($str)
           ";
    $res = executer($sql, __FILE__, __LINE__);
  }			
}
/**************************************************************************************************
  Modifier la propriété "une" d'un ensemble de faq
**************************************************************************************************/
function faq_une($tab, $tab_id)
{
  $id  = implode(", ", $tab_id);
  $sql = "UPDATE faq
          SET    faq_une = 'N'
          WHERE  faq_id
          IN     ($id)
         ";
  $res = executer($sql, __FILE__, __LINE__); 
  if (count($tab) > 0)
  {
    $str = implode(", ", $tab);
    $sql = "UPDATE faq
            SET    faq_une = 'Y'
            WHERE  faq_id
            IN     ($str)
           ";
    $res = executer($sql, __FILE__, __LINE__);
    $sql = "UPDATE faq
            SET    faq_visible = 'Y'
            WHERE  faq_id
            IN     ($str)
           ";     
    $res = executer($sql, __FILE__, __LINE__);
  }			
}

?>