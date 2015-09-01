<?php
	session_start();
	include('includes/languages/'.$_SESSION['lang'].'.php'); 
	include('includes/config.php');
	include('includes/functions.php');
	?>

	
        <div id='inside_content' class="white_box" >  
            <div class="left_box"  >
                <div class="title black" style="font-size:30px; padding-bottom:20px; padding-top:10px;" ><?php echo $lang['resources'];?></div> 
                <div  class="cat line"  ><a id="links" class="cat clicked" href="#links_page"><?php echo $lang['links'];?></a></div>  
                <div  class="cat line"  ><a id="documents" class="cat clicked" href="#documents_page"><?php echo $lang['documents'];?></a></div> 
                <div  class="cat line"><a  id="support" class="cat clicked" href="#support_page"><?php echo $lang['support'];?></a></div>  
                <div class="text black "   style=" font-size:14px; padding-top:30px;"><?php echo $lang['text_resources'];?></div>  
            </div>

            <div class="right_box" >    
  					<div  id='support_sub_content'> 
                        <div class="title black" ><?php echo $lang['Account'] ?></div>  
                        <div class="horizontal_bar" ></div>
   						
 <?php                 
 
 
					if(isset($_SESSION['UsageDetail']))
					{	
						
						$UsageDetail = $_SESSION['UsageDetail'];	
					
					//var_dump($UsageDetail);
						if (isset($UsageDetail["STATUS"]))
								{
									switch($UsageDetail["STATUS"])
									{
										case "200":
											 
										
											if ($result["MAX"]!=0){
												$BW = ($UsageDetail["MBWIN"]+$UsageDetail["MBWOUT"])/ $UsageDetail["MAX"];
												$BW = $BW *100 ;
												$BW = round($BW);
											}
											else
												$BW = 0;
											
										 
										 	 echo 'ici ----<br>';
											var_dump($UsageDetail["MAX"]);
											$MAX = ByteToGega($UsageDetail["MAX"]);
											
											 echo 'ici 1<br>';
											$TBWIN = ByteToGega($UsageDetail["TBWIN"]);
											
											 echo 'ici 2<br>';
											$TBWOUT = ByteToGega($UsageDetail["TBWOUT"]);
											
											 echo 'ici 3<br>';
											
											$MBWIN = ByteToGega($UsageDetail["MBWIN"]);
											 echo 'ici 4<br>';
											 
											$MBWOUT = ByteToGega($UsageDetail["MBWOUT"]);
											 echo 'ici 5<br>';
											 
										 
							
										
											?>
 
 							<p class="top_padded_medium title_section"><?PHP echo $lang['Account']?>: </p> 
                          
                            <div  class="line_grey">                 
                                <div class="inline_block width400" > <?PHP echo $lang['Modem']?>Modem Serial Number	</div>
                                <div class="inline_block blue" ><?php echo $UsageDetail["MODEM"] ?></div>
                            </div>
                          
                            <div  class="line_grey">                 
                                <div class="inline_block width400" > <?PHP echo $lang['Service']?></div>
                                <div class="inline_block blue" ><?php echo $UsageDetail["PLAN"] ?></div>
                            </div>
                            
                          
                            <div  class="line_grey">                 
                                <div class="inline_block width400" > <?PHP echo $lang['Monthly']?></div>
                                <div class="inline_block blue" ><?php echo $MAX ?> GB</div>
                            </div>
                            
                          
                                                
                        <p class="top_padded_medium title_section"> <?PHP echo $lang['Usage_Info']?>: </p>   
            
                           <div  class="line_grey">                 
                                <div class="inline_block width400" > <?PHP echo $lang['Percentage']?></div>
                                <div class="inline_block blue" ><?php echo $BW?>%</div>
                            </div>
                          
                            <div  class="line_grey">                 
                                <div class="inline_block width400" ><?PHP echo $lang['InboundD']?> </div>
                                <div class="inline_block blue" ><?php echo $TBWIN ?> GB</div>
                                
                            </div>
                            
                          
                            <div  class="line_grey">                 
                                <div class="inline_block width400" ><?PHP echo $lang['OutboundD']?></div>
                                <div class="inline_block blue" ><?php echo $TBWOUT ?> GB</div>
                            </div>
                            
                          
                            <div  class="line_grey">                 
                                <div class="inline_block width400" > <?PHP echo $lang['InboundM']?> 	</div>
                                <div class="inline_block blue" ><?php echo $MBWIN?> GB</div>
                            </div>                                                        

                            <div  class="line_grey">                 
                                <div class="inline_block width400" ><?PHP echo $lang['OutboundM']?> 	</div>
                                <div class="inline_block blue" ><?php echo $MBWOUT?> GB</div>
                            </div>        
                        											
											
											
											<?php
											break;	

										case "203":
												print( "<p class='top_padded_medium'>".$lang['203']."<p>"); 								  
											break;								
										
										case "400":
												print( "<p class='top_padded_medium'>".$lang['400']."</p>"); 	
											break;							
				
										case "401":		
												print( "<p class='top_padded_medium'>".$lang['401']."</p>"); 	
											break;							
				
										case "404":
												print( $lang['404']);
											break;
			
										case "500":
												print( "<p class='top_padded_medium'>".$lang['500']."</p>");
											break;
											
										case "501":
												print( "<p class='top_padded_medium'>".$lang['501']."</p>");
											break;
											
										case "503":
												print( "<p class='top_padded_medium'>".$lang['503']."</p>");
											break;
										default:
											print( "<p class='top_padded_medium'>".$lang['default']."</p>");
											break;
									} 
								}
								else // STATUS not defined
								{
									print("<p class='top_padded_medium'>".$lang['default']."</p>"); 
								} 					
					}
					else	
							print("<p class='top_padded_medium'>".$lang['default']."</p>"); 
						
                    ?>                        
  					</div>                                            
			</div>   
		</div>  
        <div class="bottom_shadow"></div>  
        <script type="text/javascript" src="js/monthly_usage.js" ></script>	