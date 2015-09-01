<?php
/****************************************************************************
          Formate une chaine de caract�re pour mettre dans la BD
****************************************************************************/
// Prot�ge la variable pour �vite les injections SQL
function mylecture($value)
{
  if (empty($value) == FALSE) {
    // Supprime les espaces (ou d'autres caract�res) en d�but et fin de cha�ne
    $value = trim($value);
    
    // Supprime les anti-slash si la directive magic_quotes_gpc est � on
    if (get_magic_quotes_gpc()) {
      $value = stripslashes($value);
    }
    
    // Protection si ce n'est pas une valeur num�rique ou une cha�ne num�rique
    if (!is_numeric($value)) {
      $value = "'" . mysql_real_escape_string($value) . "'";
    }
  } else {
    $value = "";
  }
  
  return $value;
}
?>