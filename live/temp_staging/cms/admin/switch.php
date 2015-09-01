<?php
/****************************************************************************************************
                           Chaque cas correpond à une table Mysql précise
****************************************************************************************************/
if (!isset($_GET[$action]))
  $_GET[$action] = "accueil";

$ecoute_menu = "closed"; //---> Le menu ecoute est fermé par défaut
$rubrique    = ""      ; //---> Le nom de la rubrique

switch($_GET[$action])
{

	case "site" : $rubrique = "site";
		$include_filename = "site_menu.php";
		break;

	case "requester" : $rubrique = "requester";
		$include_filename = "requester_menu.php";
		break;

	case "service" : $rubrique = "service";
		$include_filename = "service_menu.php";
		break;

	case "faq" : $rubrique = "faq";
		$include_filename = "faq_menu.php";
		break;

	case "faq_categorie" : $rubrique = "faq";
		$include_filename = "faq_categorie_menu.php";
		break;

	case "document" : $rubrique = "document";
		$include_filename = "document_menu.php";
		break;

	case "lien" : $rubrique = "lien";
		$include_filename = "lien_menu.php";
		break;

	case "admin_user" : $rubrique = "admin_user";
		$include_filename = "admin_user_menu.php";
		break;

	case "parametres" : $rubrique = "parametres";
		$include_filename = "parametres_menu.php";
		break;

	case "text" : $rubrique = "text";
		$include_filename = "text_menu.php";
		break;

	default : $rubrique = "accueil";
		$include_filename = "accueil.php";
} //Fin switch
?>

