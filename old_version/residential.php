<?php
			session_start();
			include('includes/languages/'.$_SESSION['lang'].'.php'); 
			include('includes/config.php');
			include('includes/functions.php');
			
			$services = get_services(1); 
			?>
             
            <div id='inside_content' class="white_box residental-page" >
                
                <div class="plan">
                    <span class="tag"><?php echo $services['tagline_first'] ?> </span>
                    <span class="contact_us"><?php echo $services['tagline_second'] ?> </span>
                </div>
                
                <div class="inline_block picture-block" ><img src="images/<?php echo $services['service_icon']?>"  width="260" ></div>
                <div class="inline_block " style="vertical-align:top ;" ><?php echo $services['text']?></div>
                <div class="legal"><?php echo  $services['legal']?></div> 
			</div>
        <div class="bottom_shadow"></div>
        <script type="text/javascript" src="js/monthly_usage.js" ></script>	