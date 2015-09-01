    <div id="footer">       
        <div id="footer_content" >   
            <div class="inline_block"  style="  vertical-align:bottom;" >
            	<a href="<?php echo $lang['plandaction_link'];?>"  target="_blank" ><img src="images/action_plan_<?php echo $_SESSION['lang'] ?>.png"  border="0"   width="109"/></a>
            </div>     
            <div class="vertical_bar inline_block" ></div> 
            
            <div class="inline_block  pad"  style="  vertical-align:bottom;" >
                <form action="" method="POST" id="SubscribeForm">
                    <label for="email" class="label" id="response">SUBSCRIBE TO OUR NEWSLETTER</label> 
                    <input type="text" name="email"  class="required email input"  id="email" placeholder="email@domainname.com" >
                   <input type="submit" value="Subscribe" id="Subscribe" />
                </form>
            </div>
            
            <div class="vertical_bar inline_block" ></div>  
            <div class="inline_block toll_free pad"  style="  vertical-align:bottom;" >
                 Toll free at 1-888-826-2264 
            </div>
            <div class="vertical_bar inline_block" ></div>   
            <div class="inline_block" style="vertical-align:bottom;" >
                <img src="images/live_help_<?php echo $_SESSION['lang'] ?>.png"    border="0"/>
            </div>    
            <div class="vertical_bar inline_block" ></div> 
            <div class="inline_block pad"   style="  vertical-align:bottom;" >
                <a href="http://www.facebook.com/Tamaani" target="_blank"><img src="images/fb.png" border="0" /></a>
                <a href="http://twitter.com/Tamaani_Info"  target="_blank" ><img src="images/tw.png" border="0"  /></a>
            </div>                
        </div>   
    </div>	
    
 


	<script type="text/javascript">
      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA']);
      _gaq.push(['_trackPageview']);
      (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
      })();
    </script>    
</body>
</html>