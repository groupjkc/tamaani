<?php
  connect();
  /* Fermeture de la session */
  if (isset($_GET['session_close']) &&
      $_GET['session_close'] == 'Y') {
    session_close();
?>	
<script type="text/javascript" language="JavaScript">
  document.location.href = 'authentification.php';
</script>
<?php 
    exit();
  } else {
    $sql = "SELECT parametres_ouverture_session
            FROM   parametres
           ";
    $res = executer($sql, __FILE__, __LINE__);
    if (mysql_num_rows($res) != 1) {
?>
<script type="text/javascript" language="JavaScript">
 document.location.href = 'authentification.php';
</script>
<?php
      exit();
    } else {
      $parametres_ouverture_session = decode_text(mysql_result($res, 0, 'parametres_ouverture_session'));
      /* il sera utilisé dans tous les fichiers "*_menu" et "*_add" */
      $user_id = session_valid($parametres_ouverture_session);
      $session = $_GET['session'];
      /* Récupérer le nom de l'administrateur en cours */
      $sql = "SELECT admin_user_nom, admin_user_pouvoir 
              FROM   admin_user
              WHERE  admin_user_id = '$user_id' AND admin_user_id > 0
             ";
      $res = executer($sql, __FILE__, __LINE__);
      if (mysql_num_rows($res) != 1) {
?>
<script type="text/javascript" language="JavaScript">
 document.location.href = 'authentification.php';
</script>
<?php
        exit();
      } else {
        $admin_user_nom     = decode_text(mysql_result($res, 0, 'admin_user_nom'));
        $admin_user_pouvoir = decode_text(mysql_result($res, 0, 'admin_user_pouvoir'));
      }
      $admin_user_nom     = ($admin_user_nom     == '') ? 'Administrateur' : $admin_user_nom;
      $admin_user_pouvoir = ($admin_user_pouvoir == '') ? 'admin'          : $admin_user_pouvoir;
    }
  }
?>