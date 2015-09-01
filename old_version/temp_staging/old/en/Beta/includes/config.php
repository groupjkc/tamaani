<?php

	// LOCAL FLAG
	if($_SERVER['SERVER_NAME'] == 'beta.jkcommunications.com')
		DEFINE('LOCAL', TRUE);
	else
		DEFINE('LOCAL', FALSE);

	
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
		DEFINE('DB_DATABASE', "tamaani");
	}
	else{
		DEFINE('DB_SERVER', "localhost");
		DEFINE('DB_USER', "planitmeasuring");
		DEFINE('DB_PASS', "Mobile*123Db");
		DEFINE('DB_DATABASE', "planitmeasuring");		
	}
	
			
?>