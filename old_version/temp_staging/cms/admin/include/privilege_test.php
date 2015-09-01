<?php 
  $rubrique_id = ($rubrique == 'index') ? getRubriqueId('accueil') : getRubriqueId($rubrique);
  $sql = "SELECT *
          FROM   privilege
          WHERE  rubrique_id = '$rubrique_id' AND user_id = '$user_id'
         ";
  $res = executer($sql, __FILE__, __LINE__);
   
  /* Exporter les variables $select, $mod, $insert, $delete */
  $select = 'N'; /* Valeur par défaut */
  $mod    = 'N'; /* Valeur par défaut */
  $insert = 'N'; /* Valeur par défaut */
  $delete = 'N'; /* Valeur par défaut */
  
  if ($row = mysql_fetch_array($res)) {
    $select = decode_text($row['privilege_select']);
    $mod    = decode_text($row['privilege_update']);
    $insert = decode_text($row['privilege_insert']);
    $delete = decode_text($row['privilege_delete']);
  }
  

?>