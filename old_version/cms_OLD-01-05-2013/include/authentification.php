<?php
  /****************************************************************************
         Code nécessaire pour gérer l'authentification et les sessions
  ****************************************************************************/

  //---> Logout
  if (isset($_POST['logout']))
  {
    unset($_SESSION["user_id"]);
	@session_unregister('user_id');
    unset($_SESSION["commande"]);
	@session_unregister('commande');	
	session_destroy();
  } //Fsi
  
  //---> Procédure d'authentification ?
  $login_message = "";
  if (isset($_POST['user']) && isset($_POST['password']))
  {
    $user_id = abonne_verif_login($_POST['user'], $_POST['password']);
	switch($user_id)
	{
	case 0  : $login_message       = "Login incorrect"; break;
	case -1 : $login_message       = "Compte désactivé"; break;
	default : 
	          //---> Je supprime tout le contenu du tableau session
			  foreach ($_SESSION as $key => $v)
			  {
			    unset($_SESSION[$key]);
			  } //Fin foreach
	          //---> Nouveau enregistrement
			  $_SESSION["user_id"] = $user_id;
	} //Fin switch
  } //Fsi
  
  //---> Les informations sur l'abonné
  $abonne_civilite = NULL;
  $abonne_non      = NULL;
  $abonne_prenon   = NULL;
  if (isset($_SESSION["user_id"]))
  {
    $sql = "SELECT *
			FROM   abonne
			WHERE  abonne_id = " . $_SESSION["user_id"];
	$res = executer($sql,__FILE__,__LINE__);
	$row = mysql_fetch_array($res);
	if ($row==FALSE)
	{
	  unset($_SESSION["user_id"]);
	  @session_unregister('user_id');
	} else
	{
	  $abonne_civilite = $row['abonne_civilite'];
	  $abonne_non      = strtoupper(affichage($row['abonne_nom']));
	  $abonne_prenon   = strtoupper(affichage($row['abonne_prenom']));
    } //Fsi
  } //Fsi
?>