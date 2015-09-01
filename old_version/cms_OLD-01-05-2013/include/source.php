<?php
function source_supprimer($tab)
{
  if (count($tab) == 0) {
    return;
  }
  $str = implode(', ', $tab);
  $sql = "DELETE FROM source
          WHERE       source_id
          IN          ($str)
         ";
  $res = executer($sql, __FILE__, __LINE__);
}

?>