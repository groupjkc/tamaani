<?php	
$current_page = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
$current_page = substr($current_page, 0, strrpos($current_page, '.'));
$$current_page = "selected";?>   

	<script language="Javascript">
			if(screen.width>1280){
				document.write("<div id='logo' style='width:30%;'><a href='#'><img src='images/tamaani-logo.png'   width='100%'  border='0'></a></div>"); 
			}
			else{
				document.write("<div id='logo' style='width:40%;'><a href='#'><img src='images/tamaani-logo.png'   width='100%'  border='0'></a></div>");
			}
			
		 
	</script>     
 
	<noscript>
		<div id='logo' style='width:30%;'>
			<a href='#'>
				<img src='images/tamaani-logo.png' width='100%' border='0'>
			</a>
		</div>
	</noscript>
	
<?php
	echo   "<div id='top_nav_wrapper'> 
		<div id='top_nav'>
            <div id='top_nav_menu' >
                <ul>
					<li>
						<a title='" .$lang['about_us'] . "' class='clicked' href='#about_us_page' id='about_us'>" . $lang['about_us'] . "</a>
						<ul id='sub_about'>
							<li style='padding-left:20px;'><a title='10 years anniversary'  href='#tenyears_page' class='topnavli clicked' id='tenyears'>10 years anniversary</a></li>
						
						</ul>
					</li>
                    <li><a  title='".$lang['services']."' id='services'  >".$lang['services']."</a>
						<ul id='sub_services'>
							<li style='padding-left:20px;' ><a  title='".$lang['residential']."'  href='#residential_page' class='clicked' id='residential_top'   >".$lang['residential']."</a></li>
							<li><span >|</span></li>
							<li><a  title='".$lang['corporate']."' href='#corporate_page'  class='clicked' id='corporate_top'  >".$lang['corporate']."</a></li>
							<li ><span >|</span></li>
							<li><a  title='".$lang['video_conferencing']."'  href='#video_conferencing_page'  class='clicked' id='video_conferencing_top'  >".$lang['video_conferencing']."</a></li>
						</ul>
                    </li>				
					
                    <li><a  title='".$lang['resources']."'  class='clicked' id='resources'>".$lang['resources']."</a>
						<ul id='sub_resources'>
							<li style='padding-left:20px;  ' ><a  title='".$lang['links']."' href='#links_page'  class='clicked'  id='links_top'>".$lang['links']."</a></li>
							<li><span >|</span></li>
							<li><a  title='".$lang['documents']."' href='#documents_page'  class='clicked' id='documents_top'  >".$lang['documents']."</a></li>
							<li ><span >|</span></li>
							<li><a  title='".$lang['support']."'  href='#support_page'  class='clicked'  id='support_top'>".$lang['support']."</a></li>
							<li ><span >|</span></li>
							<li><a  title='".$lang['forms']."'  href='#forms_page'  class='clicked'  id='forms_top'>".$lang['forms']."</a></li>
						</ul>
                    </li>	

                    <li><a  title='".$lang['Faq']."'   class='clicked' href='#faq_page' id='faq'>". $lang['Faq']."</a></li>
                    <li><a  title='".$lang['contact']."'  class='clicked' href='#contact_page' id='contact'>".$lang['contact']."</a></li>
					<li><a  title='mail box'  class='clicked mail-icon' id='mail-box'>&nbsp</a></li>
                </ul>
            </div>               
        </div> 
    </div> " ;
?>
    

 
    <div id='language_wrapper'> 
        <div id='language'>
             <a id="en"   <?php echo $href1 ;?>   title="English">EN</a> | 
             <a id="in"  <?php echo $href2 ;?>   title="&#5123;&#5316;&#5251;&#5198;&#5200;&#5222;"  >ᐃᓄᑦᑎᑐᑦ</a> | 
             <a id="fr"  <?php echo $href3 ;?>   title="Fran&ccedil;ais"   >FR</a>
        </div>    
    </div> 

	<!-- Success Code -->
	<script>
		function getCookie(cname)
		{
		var name = cname + "=";
		var ca = document.cookie.split(';');
		for(var i=0; i<ca.length; i++) 
		  {
		  var c = ca[i].trim();
		  if (c.indexOf(name)==0) return c.substring(name.length,c.length);
		  }
		return "";
		}
		var error_message = getCookie('error_message');
		if(error_message!="") {
			document.write('<div style="color: rgb(255, 102, 51); font-size: 12px; background-color: rgba(255, 255, 255, 0.8); width: 220px; text-align: center; padding: 2px 20px; margin-top: 4px;">'+decodeURIComponent(error_message)+'</div>');
			document.cookie = "error_message=; expires=Thu, 01 Jan 1970 00:00:00 GMT";
		}
	</script>
	<!-- Success Code -->
    <!-- <div id='signin_wrapper' >
        <div id='signin'  >  
            <form action="http://tamaani.ca/sqmail/src/redirect.php" method="post" name="login_form" id="SignInForm"   >
                
                <div  class="inline_block">
                    <label for="email" class="label" ><?php echo $lang['username'] ;?></label> 
                    <input name="login_username" type="text" value="@tamaani.ca" class="input required">
            
                </div>
                <div  class="inline_block left_padded_small">
                    <label for="password"  class="label"   ><?php echo $lang['password'] ;?></label>
                    <input name="secretkey"  type="password" class="input required" >
                    <input name="js_autodetect_results" value="1" type="hidden">
                    <input name="just_logged_in" value="1" type="hidden">           
                </div>
          
				<div  class="inline_block left_padded_small">
                   	<input type="submit" value="<?php echo $lang['sign_in'] ;?>"   class="submit"/>
               	</div>
				
            </form>
        </div>    
    </div>--> 
                    
    <div id='top_content_wrapper' >
        <div id="menu">    
            <ul>
                <li><a title="<?php echo $lang['residential'] ;?>" href="#residential_page" class="clicked link_<?php echo $_SESSION['lang']?>" id="residential">   <?php echo $lang['residential'];?>   </a>  </li>
                <li style="margin:0 1.5% 0 1.5%"><a  title="<?php echo $lang['corporate'];?>"   href="#corporate_page" class="clicked link_<?php echo $_SESSION['lang']?>" id="corporate"><?php echo $lang['corporate']  ;?>  </a></li>
                <li><a title="<?php echo $lang['video_conferencing'];?>"  href="#video_conferencing_page" class="clicked link_<?php echo $_SESSION['lang']?>" id="video_conferencing"><?php echo $lang['video_conferencing'];?>  </a></li>
            </ul>
        </div>
    </div> 
      
