<?php
	include ('includes/header.inc.php'); 
	include ('includes/top_nav.inc.php'); ?>

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
            
            <div class="left_box">
                <?php 
                $faq_categories = get_faq_categories(); 
				$i=0;
                
				foreach($faq_categories as $faq_category)  
				{	
					$i++;
					$title    = $faq_category['title'];
					$id       = $faq_category['id'];
					$cat_active = ($i==1) ? 'cat_active' : ''; 
					echo '<div  class="cat '.$cat_active.'" id="cat'.$id .'" >'.$title.'</div> ';
				}?>
            </div>
            
            <div class="right_box" >    
                <div class="title black" >FAQ</div>  
                <div class="horizontal_bar" ></div>      
				  <?php 
				$j=0;
                foreach($faq_categories as $faq_category)  
				{	$j++;
					$style_none = ($j!=1) ? 'style="display: none"' : '';
					
					$faq_category_id = $faq_category['id'];
					
					echo "<div ".$style_none. "   id='cat".$faq_category_id."_content'>"; 
					
					$faqs = get_faqs($faq_category_id); 
					foreach($faqs as $faq) {
						$id		  = $faq['id'];
						$question = $faq['question'];
						$answer   = $faq['answer'];
						echo '
						<p class="top_padded_medium" >
							<a  class="question" id="'.$id.'" >  Q. '.$question.'</a>
						</p>
						<p id="a'.$id.'" style="display: none" >
						   '.$answer.' 
						</p>   '; 					
					}                     
					echo '</div>';   
				}?>	    
			</div>   
        </div>   
    </div>                    
<?php 	include ('includes/footer.inc.php'); ?>