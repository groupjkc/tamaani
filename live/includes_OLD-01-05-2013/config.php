<?php

	// LOCAL FLAG
	if($_SERVER['SERVER_NAME'] == 'beta.jkcommunications.com')
		DEFINE('LOCAL', TRUE);
	else
		DEFINE('LOCAL', FALSE);

	// MAIL
	DEFINE('TO_EMAIL', 'dleclerc@krg.ca');	
	DEFINE('TO_NAME', 'Dominick Leclerc');	
	

	// MAIL video conferencing booking 
	//DEFINE('TO_EMAIL_conferencing', 'dleclerc@krg.ca');
	
	DEFINE('TO_EMAIL_conferencing', 'VC@krg.ca');	
	//DEFINE('TO_EMAIL_conferencing', 'fatiha@jkcommunications.com');	
	DEFINE('TO_NAME_conferencing', 'Tamaani Technical Team');
	
	
	// GOOGLE ANALYTICS - CLIENT
	DEFINE('GA_ACCOUNT', ' ');		
	
	if (LOCAL){
		DEFINE('ANALYTICS_ON', FALSE);	
	}

	else{
		DEFINE('ANALYTICS_ON', TRUE);
	}
	 
	// DATABASE
	if (LOCAL){
		DEFINE('DB_SERVER', "localhost");
		DEFINE('DB_USER', "root");
		DEFINE('DB_PASS', "");
		DEFINE('DB_DATABASE', "tamaani_cms");
	}
	else{/*
		DEFINE('DB_SERVER', "localhost");
		DEFINE('DB_USER', "tamaani");
		DEFINE('DB_PASS', "shn1tThWy5o0");
		DEFINE('DB_DATABASE', "tamaani");	*/
	}
	
			
?>