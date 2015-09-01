<?php
	include ('config.php'); 
	include ('functions.php'); 
 
	$site_detail= get_site_detail($_GET['SiteSelected']);

	echo json_encode($site_detail);
	
	?>