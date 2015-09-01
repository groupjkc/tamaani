<?php
	session_start();
	include('includes/languages/'.$_SESSION['lang'].'.php'); 
	include('includes/config.php');
	include('includes/functions.php');?>
        <div id='inside_content' class="white_box" >   
            <div class="center " >    
                <div   class="blue center" style="font-size:32px;" ><?PHP echo $lang['Thank_registering_mod']; ?></div>   
                <div   class="text  center" style="font-size:18px; padding-top:20px; padding-bottom:50px;"  > 
                <?PHP echo $lang['receive_email']; ?>
                </div>   
                <div class="center" ><img src="images/tamaani.jpg" width="500"></div>                	
            </div>
        </div> 
        <div class="bottom_shadow"></div> 
 
         
        <script type="text/javascript" src="js/monthly_usage.js" ></script>	
     
	 