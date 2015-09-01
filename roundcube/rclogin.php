 <?php

    /**
     * This small script makes it possible to test whether the 
     * RoundcubeLogin-class works as expected.
     *
     * Please find a detailed description of the available functions
     * in the original blog post:
     *
     * http://blog.philippheckel.com/2008/05/16/roundcube-login-via-php-script/
     * Updated July 2013
     */

    include ('roundcube_login.class.php'); 

    // Set to TRUE if something doesn't work
    $debug = true;
    $rcPath = "/roundcube/?_task=login";
    
    // Pass the relative Roundcube path to the constructor
    $rcl = new roundcube_login($rcPath, $debug);
	
    try {
        // Perform login/logout action
        if ($_POST['action'] == "login"){
        	$user = $_POST['user'];
        	$pass = $_POST['pass'];
            $rcl->login( $user, $pass);
        }
        else if ($_POST['action'] == "logout"){
            $rcl->logout();
        }
    }
    catch (RoundcubeLoginException $ex) {
        // If anything goes wrong, an exception is thrown.        
        //$status = "ERROR: ".$ex->getMessage();
    }
    echo json_encode($rcl->isLoggedIn()); 
?>

