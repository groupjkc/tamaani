<?php
/****************************************************************************
          Formate une chaine de caractère pour mettre dans la BD
****************************************************************************/
// Protège la variable pour évite les injections SQL
function mylecture($value)
{
  if (empty($value) == FALSE) {
    // Supprime les espaces (ou d'autres caractères) en début et fin de chaîne
    $value = trim($value);
    
    // Supprime les anti-slash si la directive magic_quotes_gpc est à on
    if (get_magic_quotes_gpc()) {
      $value = stripslashes($value);
    }
    
    // Protection si ce n'est pas une valeur numérique ou une chaîne numérique
    if (!is_numeric($value)) {
      $value = "'" . mysql_real_escape_string($value) . "'";
    }
  } else {
    $value = "";
  }
  
  return $value;
}
?>