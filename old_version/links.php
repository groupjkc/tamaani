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
                <div  class="cat cat_active line" id="links" ><?php echo $lang['links'];?></div> 
                <div  class="cat line" ><a  id="documents" class="cat clicked" href="#documents_page"><?php echo $lang['documents'];?></a></div> 
                <div  class="cat line"><a  id="support" class="cat clicked" href="#support_page"><?php echo $lang['support'];?></a></div>
                <div  class="cat line" ><a id="forms" class="cat clicked" href="#forms_page"><?php echo $lang['forms'];?></a></div>  
            
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
			</div>   
		</div>  
        <div class="bottom_shadow"></div>  
        <script type="text/javascript" src="js/monthly_usage.js" ></script>	