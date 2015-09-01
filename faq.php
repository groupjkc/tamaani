<?php
    session_start();
    include('includes/languages/'.$_SESSION['lang'].'.php'); 
    include('includes/config.php');
    include('includes/functions.php');?>
	
	<script>
		$(document).ready(function(){
			$(".cat").click(function(){
				
				if (!$(this).hasClass('cat_active')){ 
					
					var ID  = $(this).attr('id');  
					var activeID = $('.cat_active').attr('id');					 
										
					$( '#'+activeID+'_content' ).fadeOut('200', function(){
																	   
						$( '#'+ID+'_content' ).fadeIn("2", function(){
							$('#'+ID).addClass('cat_active');
							$('#'+activeID).removeClass('cat_active');
						})												   
					})			
				}
			});        
			
			$(".question").click(function(){
				var ID = $(this).attr('id');
				if (!$(this).hasClass('question_active')){                  
					
					$( '#a'+ID ).fadeIn("200", function(){
						$('#'+ID).addClass('question_active');
					})
				}
				else
				{    
					$( '#a'+ID ).fadeOut("200", function(){
						$('#'+ID).removeClass('question_active');
					})
				}
			   
			});	
		});
    </script>

    <div id='inside_content_wrapper' style="padding-bottom:150px;">   
        <div id='inside_content' class="white_box" >  
            <div class="left_box"  >
                <div class="title black" style="font-size:30px; padding-bottom:20px; padding-top:10px; text-transform:uppercase" ><?php echo $lang['Faq']?></div> 
                <?php 
                $faq_categories = get_faq_categories(); 
                $i=0;
                foreach($faq_categories as $faq_category)  
                {	
                    $i++;
                    $title    = $faq_category['title'];
                    $id       = $faq_category['id'];
                    $cat_active = ($i==1) ? 'cat_active' : ''; 
                    echo '<div  class="cat '.$cat_active.' line" id="cat'.$id .'" >'.$title.'</div> ';
                }?>
                <div class="text black "   style=" font-size:14px; padding-top:30px;"><?php echo $lang['text_resources'];?></div>  
            </div>

            <div class="right_box" >    

				  <?php 
				$j=0;
                foreach($faq_categories as $faq_category)  
				{	$j++;
					$style_none = ($j!=1) ? 'style="display: none"' : '';
	
					$faq_category_id = $faq_category['id'];
					$title           = $faq_category['title'];			 
					

					
					echo "<div ".$style_none. "   id='cat".$faq_category_id."_content'> 
						  <div class='title black'>".$title ."</div>  
						  <div class='horizontal_bar' ></div> ";
					
					$faqs = get_faqs($faq_category_id); 
					foreach($faqs as $faq) {
						$id		  = $faq['id'];
						$question = $faq['question'];
						$answer   = $faq['answer'];
						echo '
						<p class="top_padded_medium" >
							<a  class="question" id="'.$id.'" > '.$question.'</a>
						</p>
						<p id="a'.$id.'" style="display: none" >
						   '.$answer.' 
						</p>   '; 					
					}                     
					echo '</div>';   
				}?>	    
			</div>   
        </div>
        <div class="bottom_shadow"></div>
        <script type="text/javascript" src="js/monthly_usage.js" ></script>	