<?php
/****************************************************************************
                      Get Records from tenyears DBO
****************************************************************************/
function getTenyearsContent($id = 0) {
  if ($id)
  {
    $sql = "SELECT * FROM tenyears WHERE `id` = $id";
  }
  else
  {
    $sql = "SELECT * FROM tenyears ORDER BY `order`";
  }
  
  $res = executer($sql,__FILE__,__LINE__);
  $results = array();
  while($row=@mysql_fetch_array($res))
  {
    $results[] = $row;
  }
  return $results;
}