<?php
//---> Nom des param�tres "action"
$action = 'p';

//---> La langue utilis�e (fr, en, ar)


$lang             = isset($_GET["lang"])? $_GET["lang"] : "";
switch($lang)
{
	case "en"	: break;
	default		: $lang = "en" ; //---> La langue par d�faut
} //Fin switch

/******************************************************************************************************
                               Param�tres de configuration
******************************************************************************************************/
@error_reporting (E_ALL);
@setlocale(LC_ALL, 'french');

/******************************************************************************************************
             Les param�tres liguistiques et de connexion � la base de donn�es
******************************************************************************************************/						 
//---> La premi�re base de donn�es est la base principale

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