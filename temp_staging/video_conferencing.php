<?php
			session_start();
			include('includes/languages/'.$_SESSION['lang'].'.php'); 
			include('includes/config.php');
			include('includes/functions.php');
			
			$services = get_services(3);  ?>
		<div id='inside_content' class="white_box" >
            <div class="plan inline_block" style="width:70%">
                <span class="tag"><?php echo $services['tagline_first'] ?> </span>
            </div> 
            
         
				<div id="BookMeeting_btn" class="inline_block "  >
					 <a href="#form" style=""> <?php echo $lang['Book_video_today']?></a>
				</div>
            
		
                    
					
     
            
            <div class="content_left"><img src="images/<?php echo $services['service_icon']?>"   width="260" ></div>  
            <div class="content_right">
				<?php echo $services['text']?>            
            </div>
            <div class="legal"><?php echo   $services['legal']?></div>              
        </div>

        <div class="bottom_shadow"></div> 
        <script type="text/javascript" src="js/monthly_usage.js" ></script>	
