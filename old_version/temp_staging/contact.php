<?php
	session_start();
	include('includes/languages/'.$_SESSION['lang'].'.php'); 
	include('includes/config.php');
	include('includes/functions.php');
	
	$text = get_text(3); ?>
        <div id='inside_content' class="white_box" >  
            <div class="left_box"   ><img src="images/<?php echo $text['text_icon']?>" width="260"  ></div>
            
            <div class="right_box" >    
                <div class="title black" ><?php echo $text['title']; ?></div>  
                <div class="horizontal_bar" ></div>   
                <?php  echo $text['text']; ?>    
          </div>
        </div> 
        <div class="bottom_shadow"></div> 
        <script type="text/javascript" src="js/monthly_usage.js" ></script>	