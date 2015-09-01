<?php
	include ('includes/header.inc.php'); 
	include ('includes/top_nav.inc.php'); ?>

    <div id='inside_content_wrapper' style="padding-bottom:150px;">   
        <div id='inside_content' class="white_box" >  
            
            <div class="left_box">
               <div ><a href="links.php" class="cat"><?php echo $lang['links'];?></a></div>
               <div  class="cat cat_active" ><?php echo $lang['documents'];?></div> 
            </div>
            
            <div class="right_box" >    
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
<?php 	include ('includes/footer.inc.php'); ?>