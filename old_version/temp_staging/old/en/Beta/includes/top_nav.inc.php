<?php	
	$current_page = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
	$current_page = substr($current_page, 0, strrpos($current_page, '.'));
	$$current_page = "selected";    
	echo   " <div id='logo' style=' width:30%;'><img src='images/tamaani-logo.png'   width='100%' ></div>
    <div id='top_nav_wrapper'> 
		
      
		<div id='top_nav'>
            <div id='top_nav_menu' >
                <ul>
					<li><a title='".$lang['about_us']."' href='about_us.php' class='".$about_us."'>".$lang['about_us']."</a></li>
                    <li id='services'   ><a  title='".$lang['services']."' href='residential.php' class='".$residential.$corporate.$video_conferencing."'>".$lang['services']."</a>
						<ul  id='sub_services' class='".$residential.$corporate.$video_conferencing."'  >
							<li style='padding-left:20px;  ' ><a class='".$residential."'  href='residential.php' title='".$lang['residential']."' >".$lang['residential']."</a></li>
							<li><span >|</span></li>
							<li><a  href='corporate.php' title='".$lang['corporate']."' class='".$corporate."' >".$lang['corporate']."</a></li>
							<li ><span >|</span></li>
							<li><a  href='video_conferencing.php' title='".$lang['video_conferencing']."' class='".$video_conferencing."'>".$lang['video_conferencing']."</a></li>
						</ul>
                    </li>
					
                    <li id='resources' ><a href='links.php' title='".$lang['resources']."' class='".$links.$documents."'>".$lang['resources']."</a>
                        <ul id='sub_resources' class='".$links.$documents."'  >
                            <li style='padding-left:20px;'><a  href='links.php' class='".$links."' title='".$lang['links']."'>".$lang['links']."</a></li>
                            <li ><span >|</span></li>
                            <li><a href='documents.php' class='".$documents."'  title='".$lang['documents']."'>".$lang['documents']."</a></li>
                        </ul>                        
                    </li>
                    <li><a  title='".$lang['Faq']."' href='faq.php' class='".$faq."'>".$lang['Faq']."</a></li>
                    <li><a  title='".$lang['contact']."' href='contact.php' class='".$contact."'>".$lang['contact']."</a></li>
                </ul>
            </div>               
        </div> 
    </div> " ;?>

    <div id='language_wrapper'> 
        <div id='language'>
             <a  <?php echo $href1 ;?>  title="English">EN</a> | 
             <a  <?php echo $href2 ;?>   title="&#5123;&#5316;&#5251;&#5198;&#5200;&#5222;"  >&#5123;&#5316;&#5251;&#5198;&#5200;&#5222; </a> | 
             <a  <?php echo $href3 ;?>  title="Fran&ccedil;ais"   >FR</a>
        </div>    
    </div> 

   
    <div id='signin_wrapper' >
        <div id='signin' >  
            <form action="http://webmail.tamaani.ca/src/redirect.php" method="post" name="login_form"  target="_blank" id="SignInForm"   >
                <div  class="inline_block">
                    <label for="email" class="label" >Username</label> 
                    <input type="text" name="login_username" class="input required"       />
                </div>
                <div  class="inline_block left_padded_small">
                    <label for="password"  class="label"   >Password</label>               
                    <input type="password" name="xj95aqhlaa"   class="input required"     />
                </div>
          
          
				<div class="top_padded_small right"  >	
                    <input type="hidden" name="secretkey" value="xj95aqhlaa" />
                    <input type="hidden" name="js_autodetect_results" value="0" />
                    <input type="hidden" name="just_logged_in" value="1" />
                	<input type="submit" value="Sign In"   class="submit"/>
                     
               	</div>
            </form>
        </div>    
    </div> 

    <div id='top_content_wrapper' >
    	
        <div id="menu">    
            <ul>
                <li><a href="residential.php" title="<?php echo $lang['residential'] ;?>" class="<?php echo $residential?>">  <?php echo $lang['residential'];?>   </a>  </li>
                <li style="margin:0 1.5% 0 1.5%"><a href="corporate.php " title="<?php echo $lang['corporate'];?>" class="<?php echo $corporate?>"> <?php echo $lang['corporate']  ;?>  </a></li>
                <li><a href="video_conferencing.php" title="<?php echo $lang['video_conferencing'];?>" class="<?php echo $video_conferencing?>"><?php echo $lang['video_conferencing'];?>  </a></li>
            </ul>
        </div>
    </div> 
      