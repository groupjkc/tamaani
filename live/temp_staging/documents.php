<?php
    session_start();
    include('includes/languages/'.$_SESSION['lang'].'.php'); 
    include('includes/config.php');
    include('includes/functions.php');?>

	<script>
		$(document).ready(function(){
			$(".support").click(function(){
				var ID = $(this).attr('id');
				if (!$(this).hasClass('support_active')){                  
					
					$( '#a'+ID ).fadeIn("200", function(){
						$('#'+ID).addClass('support_active');
					})
				}
				else
				{    
					$( '#a'+ID ).fadeOut("200", function(){
						$('#'+ID).removeClass('support_active');
					})
				}
			   
			});	
			
			
		});
    </script>

        <div id='inside_content' class="white_box" >  
            <div class="left_box"  >
                
                <div class="title black" style="font-size:30px; padding-bottom:20px; padding-top:10px;" ><?php echo $lang['resources'];?></div> 
                <div  class="cat line"  ><a id="links" class="cat clicked" href="#links_page"><?php echo $lang['links'];?></a></div>  
                <div  class="cat cat_active line" id="documents" ><?php echo $lang['documents'];?></div> 
                <div  class="cat line" ><a id="support" class="cat clicked" href="#support_page"><?php echo $lang['support'];?></a></div>  
            
                <div class="text black "   style=" font-size:14px; padding-top:30px;"><?php echo $lang['text_resources'];?></div>  
            </div>

            <div class="right_box" >        
                <div   id='documents_sub_content'> 
                    <div class="title black" ><?php echo $lang['documents'];?></div>  
                    <div class="horizontal_bar" ></div>      
                      <?php 
                        $documents = get_documents(); 
                        foreach($documents as $document) {
                            $id		  = $document['id'];
                            $title    = $document['title'];
                            $pdf      = $document['pdf'];
                            ?>
                            <p class="top_padded_medium" >
                                <a  class="pdf"  href="pdf/<?php echo $pdf;?>" target="_blank"> <?php echo $title;?> </a>
                            </p><?php   
                        }?>	  
                	</div>                            
			</div>   
		</div>  
        <div class="bottom_shadow"></div> 
        <script type="text/javascript" src="js/monthly_usage.js" ></script>	 