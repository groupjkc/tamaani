<?php 
/*****************************************************************************************************
  Cette fonction : 
    1/ Afficher un message 
    2/ Rafraichir la fenêtre parent
    3/ Fermer éventuellment la fenêtre
******************************************************************************************************/ 
function operation_message($msg, $close, $autre = '', $url = '')
{
?>
  <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
  <html>
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <title>Confirmation d'insertion</title>
  <script type="text/javascript" language="JavaScript" src="../include/scripts.js"></script>
  </head>
  <body id="page" bgcolor="#FFFFFF">
<?php 
  report_msg($msg);
  echo $autre;
  $url = ($url == "") ? "document.location" : "'$url'";
  if ($close == FALSE) {
?>
  <script language="javascript" type="text/javascript">
  <!--
    changerCurseur("page", "wait");                   //---> Changer le pointeur de souris	  
    rafraichir_parent();                              //---> rafraichir la fenêtre parent
    setTimeout("document.location = <?php echo $url?>",1000); //---> rafraichir la page en cours
  -->
  </script>
<?php
  } else {
?>
  <script language="javascript" type="text/javascript">
  <!--
    changerCurseur("page", "wait");     //---> Changer le pointeur de souris	  
    setTimeout("fermer_popup();",1000); //---> Fermer la fenêtre
  -->
  </script>
<?php
  } // Fsi
?>
  </body>
  </html>
<?php
} // Fin operation_message
?>
