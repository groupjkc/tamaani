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
                <div  class="cat cat_active" id="links_sub" ><?php echo $lang['links'];?></div> 
                <div  class="cat " id="documents_sub" ><?php echo $lang['documents'];?></div> 
                <div  class="cat " id="support_sub" ><?php echo $lang['support'];?></div>
                <div  class="cat " id="forms_sub" ><?php echo $lang['forms'];?></div>  
            
                <div class="text black "   style=" font-size:14px; padding-top:30px;"><?php echo $lang['text_resources'];?></div>  
            </div>

            <div class="right_box" >    
                <div   id='links_sub_content'> 
                    <div class="title black" ><?php echo $lang['link_tagline'];?></div>  
                    <div class="horizontal_bar "   style="margin-bottom:20px;">  </div>      
                      <?php 
                        $links = get_links(); 
                     
                        foreach($links as $link) {
							$id		  = $link['id'];
							$title    = $link['title'];
							$icon     = $link['icon'];
							$link     = ($link['link']!='') ? 'http://'.$link['link'] : ''; ?>
                               
                            <a class='inline_block' href="<?php echo $link;?>" style="width:145px; padding-bottom:20px;" target="_blank" >
                                <div style="  text-align:center; padding-bottom:5px; "><img src="images/links/<?php echo $icon;?>"  border="0" > </div>
                                <div style="font-size:12px; text-align:center; color:#666;text-transform:uppercase; "><?php echo $title;?></div>
                            </a>                   
                            <?php   
                        }?>	 
                </div>
                    
                <div style="display: none"     id='documents_sub_content'> 
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
                    
                    <div  style="display: none"   id='support_sub_content'> 
                        <div class="title black" ><?php echo $lang['support'];?></div>  
                        <div class="horizontal_bar" ></div>
                        <?php echo $lang['support_text'];?>  
                    </div>                                            
			</div>   
		</div>  
        <div class="bottom_shadow"></div>  
        <script type="text/javascript" src="js/monthly_usage.js" ></script>	