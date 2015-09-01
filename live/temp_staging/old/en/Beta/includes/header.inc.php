<?php include('includes/config.php');
	session_start();
	
	header('Content-Type: text/html;  charset=iso-8859-1"');
	header('Cache-Control: public, max-age=200');
	header('Expires: '.gmdate('D, d M Y H:i:s \G\M\T', time() + 3600)); 
	
	if (!isset($_SESSION['background'])){
		$background = rand(1,3);
		$_SESSION['background'] = 'Background-'.$background.'.jpg';
	}
	//$_SESSION['background']='Background-3.jpg';
	
	
	// LANGUAGE ***********************************************************************************************************	
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
	
	include('includes/functions.php');
	include('languages/'.$_SESSION['lang'].'.php'); // Grab the associated languages file which contains all strings
	
	// END LANGUAGE ***********************************************************************************************************			
?>
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <link href='css/style.css' rel='stylesheet' type='text/css' />  
    <link rel="icon" type="image/png" href="images/favicon.png" />
    <title><?php echo $lang['page_title']; ?></title> 
	<script  >function preloader(){
			a = new Image(); 
			a.src = "images/<?php echo $_SESSION['background'] ; ?>" 
		}	
					 
	</script>	
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>	
    <script src="js/bg.js"></script> 
    
	<script src="js/jquery.js"></script>
    <script type="text/javascript" src="js/jquery.validate.js"></script>   
    <script type='text/javascript' src='js/jquery.pngFix.pack.js'></script> 
       
    
	<script type='text/javascript'>
        $(document).ready(function() {
			var userAgent = navigator.appName.toLowerCase();
				//Css center fixed doesnt work on IE, We use the image when it is IE
				if(userAgent=='microsoft internet explorer'){
					$('#bg').attr('src', 'images/<?php echo $_SESSION['background']; ?>') ;	
				}	
				else{
					$("html").addClass("html");
				}
									 
			
             $("#SignInForm").validate({errorPlacement: function(error, element) {} });
			 
           $("#resources").hover(function(){
				$('#sub_services').removeClass('selected');	
	             });
            
            $("#services").hover(function(){
				$('#sub_resources').removeClass('selected');			
             })	;					   
    
            $('#SubscribeForm').submit(function() {															   
                    // update user interface
                    $('#response').html('Adding email address...');
                    
                    // Prepare query string and send AJAX request
                    $.ajax({
                        url: 'includes/subscribe.php',
                        data: 'ajax=true&email=' + escape($('#email').val()),
                        success: function(msg) {
                            $('#response').css('color', '#F63');
                            $('#response').css('font-size', '12px');
                            $('#response').html(msg);
                        }
                    });
    
                    return false;
            });
        });
    </script> 
 
    <style> 
		.html {
			background: url(images/<?php  echo $_SESSION['background']; ?>) no-repeat  center fixed; 
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
			height: 100%;
		}
	</style> 
</head>

<body onLoad="javascript:preloader()">
	<img  id="bg">