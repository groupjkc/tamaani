<?php
  $sql = "SELECT * FROM parametres";
  $res = mysql_query($sql);
  if ($res  ==  0) {
    echo "Erreur SQL : $sql<br>";
    die(mysql_error());
  } // Fsi

$row = mysql_fetch_array($res);

  //---> Le tableau de tous les paramètres
  
  $parametres_site             = array();
  
  $param_admin_email           = $parametres_site["param_admin_email"]
                               = strtolower(stripslashes($row["parametres_admin_email"]));
  $param_titre_site            = $parametres_site["param_titre_site"]
                               = affichage($row["parametres_titre_site"]);
  $param_url_site              = $parametres_site["param_url_site"]
                               = affichage($row["parametres_url_site"]);
  $param_basedir               = $parametres_site["param_basedir"]
                               = affichage($row["parametres_basedir"]);
  $param_derniere_modification = $parametres_site["param_derniere_modification"]
                               = $row["parametres_derniere_modification"];
  $param_version               = $parametres_site["param_version"]
                               = affichage($row["parametres_version"]);
  $param_pied_page             = $parametres_site["param_pied_page"]
                               = stripslashes($row["parametres_pied_page"]);
  $param_mots_cles             = $parametres_site["param_mots_cles"]
                               = affichage($row["parametres_mots_cles"]);
  $param_description           = $parametres_site["param_description"]
                               = affichage($row["parametres_description"]);
?>