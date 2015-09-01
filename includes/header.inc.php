<?php include('includes/config.php');
	session_start();
	header('Content-Type: text/html;  charset=utf-8');
	header('Cache-Control: public, max-age=200');
	header('Expires: '.gmdate('D, d M Y H:i:s \G\M\T', time() + 3600)); 
	
	// LANGUAGE ***********************************************************************************************************	
	
	//$_SESSION['lang'] = 'en'; /*For now just English is activated*/
	if (isset($_GET['IP']))
		setcookie ("IP", $_GET['IP'], time()+60*60*24*365*10);
	else
		setcookie ("IP", $_SERVER['REMOTE_ADDR'], time()+60*60*24*365*10);





	if (isset($_GET['lang'])){
		$_SESSION['lang'] = $_GET['lang'];	
		setcookie ("lang", $_SESSION['lang'], time()+60*60*24*365*10);
	}
	elseif (!isset($_SESSION['lang'])){
		// Otherwise, get it from the existing cookie 
		if (isset($_COOKIE['lang'])){
			$_SESSION['lang'] = $_COOKIE['lang'];
		}
		 
		// Otherwise, get it from the browser and store it in the cookie
		elseif (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])){
			$_SESSION['lang'] = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
			setcookie ("lang", $_SESSION['lang'], time()+60*60*24*365*10);
		}
		else{
			$_SESSION['lang'] = 'en';
			setcookie ("lang", $_SESSION['lang'], time()+60*60*24*365*10);
		}
	}
 	
	foreach($_GET as $k => $v) 
		$qa[$k] = urldecode($v);
		
		$qa1=$qa;
		$qa2=$qa;
		$qa3=$qa;
		
		$qa1['lang'] = 'en';
		$qa2['lang'] = 'in';
		$qa3['lang'] = 'fr';
	
		$href1 ='href=?'.http_build_query($qa1).'  class="active"';
		$href2 ='href=?'.http_build_query($qa2).'  class="active"';
		$href3 ='href=?'.http_build_query($qa3).'  class="active"';

	switch ($_SESSION['lang']){
		case 'en':
			$href1 =' class="desactive"';
			break;
		
		case 'in':
			$href2 =' class="desactive"';
			break;	
	
		case 'fr':
			$href3 =' class="desactive"';	
			break;	
		
		default:
			$_SESSION['lang']='en';
			break;
			
	}
	
	$file_language = isset($_SESSION['lang'])  ? $_SESSION['lang']  : 'en';
	include('includes/functions.php');
	include('languages/'.$file_language.'.php'); // Grab the associated languages file which contains all strings
	
	$_SESSION['Reference'] = $_GET['Reference'];
	$_SESSION['Code']      = $_GET['Code'];
	
	// END LANGUAGE ***********************************************************************************************************		
	if(!isset($_SESSION['bg'])){
		$a = getBackground();
		$b = $c = null;
		foreach($a AS $k){		
			$b[] = $k['filename']; 
		}
	}	
	else{
		$b = $_SESSION['bg'];
	}	
	$c = "background/".$b[array_rand($b)];	
			
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns='http://www.w3.org/1999/xhtml'>
	<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <meta name="description" content="Tamaani is an Internet service provider to all 14 communities in Nunavik (Northern Quebec)." />
    <meta name="keywords" content="Tamaani, Tamaani Internet, Satellite, Satellite Internet, Wireless, Wireless Internet, Redline, NextNet, Nunavik, Internet Nunavik, KRG, KRG Internet, Kativik, Akulivik, Aupaluk, Inukjuak, Ivujivik, Kangiqsualujjuaq, Kangiqsujuaq, Kangirsuk, Kuujjuaq, Kuujjuarapik, Puvurnituq, Quaqtaq, Salluit, Tasiujaq, Umiujaq, Georges River, George River, Wakeham, Wakeham Bay, 
Residential, Corporate, VC, Video conference, Video conferencing, Videoconference, Videoconferencing, Canada, Quebec, Plan Nord" /> 
        
    <link href='css/style.css' rel='stylesheet' type='text/css' />  
    <link rel="icon" type="image/png" href="images/favicon.png" />

	<meta property="og:title" content="Tamaani, Nunavik's Leading Internet Service Provider"/>
	<meta property="og:type" content="website" />
	<meta property="og:url" content="http://www.tamaani.ca/"/>
	<meta property="og:image" content="http://www.tamaani.ca/images/fb_logo.jpg"/>
	<meta property="og:site_name" content="Tamaani, Nunavik's Leading Internet Service Provider" />
	<meta property="og:description" content="Tamaani is an Internet service provider to all 14 communities in Nunavik (Northern Quebec)."/>
    <title><?php echo $lang['page_title']; ?></title> 
	<!-- Mobile Detection -->
    <script src="js/mainsite.mobile.detection.inc.js"></script>
	<script  >
		function preloader(){
			a = new Image(); 
			a.src = "images//Background-IE.jpg" ;
		}	
		var glbackground  = '';		 
		
	</script>	
	
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>	
    <script src="js/bg.js"></script> 
	<script src="js/jquery.js"></script>
	<script type="text/javascript" src="js/jquery-1.4.4.js" ></script>
    <script type='text/javascript' src='js/jquery.validate.pack.js'></script>
    <script type="text/javascript" src="js/jquery.address-1.5.min.js"></script>  
    <script src="js/jquery-ui.js"></script>
    <?php include ('js/js.php');?>  

    <style> 
		.html {
			background: url('<?php echo $c;?>') no-repeat  center fixed; 
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
			height: 100%;
			top:-900px;	 
		}
		
		
	</style> 
</head>

<body onLoad="javascript:preloader();">
	<img  id="bg">