<?php
	session_start();
	include('includes/languages/'.$_SESSION['lang'].'.php'); 
	include('includes/config.php');
	include('includes/functions.php');
	
	$text = get_text(1);?>
 
    <div id='inside_content'    >  
        <div class="home_content" style="margin-top:-22px;">
        <div class="big_title right white shadow big_title_<?php echo $_SESSION['lang']?>"><?php   echo $text['title']; ?></div>
        <?php echo $text['text']?>
        </div>
    </div>
	<script type="text/javascript" src="js/monthly_usage.js" ></script>	