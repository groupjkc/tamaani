<?php
// LOCAL FLAG
if($_SERVER['SERVER_NAME'] == 'beta.jkcommunications.com')
	DEFINE('LOCAL', TRUE);
else
	DEFINE('LOCAL', FALSE);

// MAIL
DEFINE('TO_EMAIL', 'dleclerc@krg.ca');	
//	DEFINE('TO_EMAIL', 'fatiha@jkcommunications.com');	
DEFINE('TO_NAME', 'Dominick Leclerc');	

// MAIL video conferencing booking 
DEFINE('TO_EMAIL_conferencing', 'vc@krg.ca');	
//////////DEFINE('TO_EMAIL_conferencing', 'gcalder@dropzone.com');
//DEFINE('TO_EMAIL_conferencing', 'testsol@tamaani.ca');

//	DEFINE('TO_EMAIL_conferencing', 'fatiha@jkcommunications.com');	
DEFINE('TO_NAME_conferencing', 'Tamaani Technical Team');	
	
DEFINE('TO_EMAIL_cal', 'Tamaani-cal-VC@krg.ca');
//DEFINE('TO_EMAIL_cal', 'testsol@tamaani.ca');
DEFINE('TO_NAME_cal', 'Tamaani cal VC');
	
// GOOGLE ANALYTICS - CLIENT
DEFINE('GA_ACCOUNT', ' ');		
	
if (LOCAL)
{
	DEFINE('ANALYTICS_ON', FALSE);	
}
else
{
	DEFINE('ANALYTICS_ON', TRUE);
}
	 
// DATABASE
if (LOCAL)
{
	DEFINE('DB_SERVER', "127.0.0.1");
	DEFINE('DB_USER', "root");
	DEFINE('DB_PASS', "jkc0mmdb");
	DEFINE('DB_DATABASE', "tamaani");
}
else
{
	DEFINE('DB_SERVER', "localhost");
	DEFINE('DB_USER', "tamaani");
	DEFINE('DB_PASS', "shn1tThWy5o0");
	DEFINE('DB_DATABASE', "tamaani");	 
}
	
	//date_default_timezone_set('America/New_York');
	
			
?>
