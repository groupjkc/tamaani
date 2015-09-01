<?php
	include ('includes/header.inc.php'); 
	include ('includes/top_nav.inc.php'); ?>

    <div id='inside_content_wrapper' style="padding-bottom:150px;">   
        <div id='inside_content' class="white_box" >  
            
            <div class="left_box">
               <div  class="cat cat_active"><?php echo $lang['links'];?></div>
               <div    ><a href="documents.php" class="cat"><?php echo $lang['documents'];?></a></div> 
            </div>
            
            <div class="right_box" >    
                <div class="title black" ><?php echo $lang['links'];?></div>  
                <div class="horizontal_bar" ></div>      
				  <?php 
					$links = get_links(); 
					foreach($links as $link) {
						$id		  = $link['id'];
						$title    = $link['title'];
						$link     = $link['link'];
						?>
						<p class="top_padded_medium" >
							<a  class="links"  href="http://<?php echo $link;?>" target="_blank"> <?php echo $title;?> </a>
						</p><?php   
					}?>	    
			</div>   
        </div>   
    </div>                    
<?php 	include ('includes/footer.inc.php'); ?>