<?php
	session_start();
	include('includes/languages/'.$_SESSION['lang'].'.php'); 
	include('includes/config.php');
	include('includes/functions.php');
	
	$text = get_text(1);?>
 
    <div id='inside_content' class="float_wrapper" >  
        <div class="home_content_centered">
	        <div class="big_title white shadow big_title_<?php echo $_SESSION['lang']?>">
	        	<?php   echo $text['title']; ?>
	        </div>
	        <div class="sub_title white shadow">
	        	<?php echo $text['text']?>
	        </div>
			<?php
				if(file_exists($lang['home_tenyears_img'])){
					echo '<div class="home_intro_img">';
					echo '<a href="'.$lang['home_tenyears_link'].'">';
					echo '<img src="'.$lang['home_tenyears_img'].'">';
					echo '</a>';
					echo '</div>';
				} 
			?>
        </div>
		
    </div>
	<script type="text/javascript" src="js/monthly_usage.js" ></script>
	<style>
		#inside_content_wrapper {
			padding-bottom: 80px !important;
		}
	</style>