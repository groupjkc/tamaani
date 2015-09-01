<?php
//---> Nom des paramètres "action"
$action = 'p';

//---> La langue utilisée (fr, en, ar)


$lang             = isset($_GET["lang"])? $_GET["lang"] : "";
switch($lang)
{
	case "en"	: break;
	default		: $lang = "en" ; //---> La langue par défaut
} //Fin switch

/******************************************************************************************************
                               Paramètres de configuration
******************************************************************************************************/
@error_reporting (E_ALL);
@setlocale(LC_ALL, 'french');

/******************************************************************************************************
             Les paramètres liguistiques et de connexion à la base de données
******************************************************************************************************/						 
//---> La première base de données est la base principale

$lang_param = array
              (
				//---> principal = FALSE
                "en" => array(
							   "host"        => "localhost"         ,
							   "db"          => "tamaani"   ,
							   "user"        => "tamaani"              ,
							   "password"    => "shn1tThWy5o0"                  ,
							   "chemin"      => "en"                ,
							   "description" => "Langue anglaise"   ,
							   "short"       => "Anglais"           ,
							 )			 
							 
			  ); //Fin $lang_param
?>