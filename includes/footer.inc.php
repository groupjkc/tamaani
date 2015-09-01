    <!--Start of Zopim Live Chat Script-->
    <script type="text/javascript">
        window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
        d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
        _.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute('charset','utf-8');
        $.src='//cdn.zopim.com/?0KsXPAXyhof6cswMAt3j5KQ2cp0j9Zmh';z.t=+new Date;$.
        type='text/javascript';e.parentNode.insertBefore($,e)})(document,'script');


		$zopim(function() {
		$zopim.livechat.setOnStatus(change_chat_img);
			function change_chat_img(status) {
			var img = document.getElementById('chat_img');
			if (status == 'offline')
			img.src = 'images/livechat_offline_<?php echo $_SESSION['lang'] ?>.png';
			else
			img.src = 'images/livechat_online_<?php echo $_SESSION['lang'] ?>.png';
			}
		});

    </script>
    <!--End of Zopim Live Chat Script-->    

 	
    <div id="footer">       
        <div id="footer_content" >   
            <div class="inline_block width145" >
                <a id="MonthlyUsage"  >
                	<img src="images/ajax-loader.gif" style="vertical-align:top"/>
               	</a>                 
            </div> 
            
            <div id="STATUS" style='display:none' ></div>       
            
            <div class="vertical_bar inline_block" ></div> 
            
            <div class="inline_block  pad"  style="  vertical-align:bottom;" >
                <form action="" method="POST" id="SubscribeForm">
                    <label for="email" class="label" id="response"><?php echo $lang['subscribe'];?></label> 
                    <input type="text" name="email"  class="required email input"  id="email" placeholder="<?php echo $lang['domainename'];?>" >
                   <input type="submit" value="<?php echo $lang['submit']?>" id="Subscribe" class="submit" />
                </form>
            </div>
            
            <div class="vertical_bar inline_block" ></div>  
            
            <div class="inline_block toll_free toll_free_<?php echo $_SESSION['lang']?> pad"  style="vertical-align:bottom;" >
                 <?php echo $lang['free_toll']?> <span  class="upper">1-888-TAMAANI</span> 
            </div>
            
            <div class="vertical_bar inline_block" ></div>   
            
            <div class="inline_block" style="vertical-align:bottom;" >
            
				<a href="javascript:$zopim.livechat.window.show()"   style="cursor:pointer;"  ><img src="images/livechat_offline_<?php echo $_SESSION['lang'] ?>.png" id="chat_img" alt="Live Help"   border="0"  /></a> 
            </div>    
            <div class="vertical_bar inline_block" ></div> 
            <div class="inline_block pad"   style="  vertical-align:bottom;" >
                <a href="http://www.facebook.com/Tamaani" target="_blank"><img src="images/fb.png" border="0" /></a>
                <a href="http://twitter.com/Tamaani_Info" target="_blank" ><img src="images/tw.png" border="0"  /></a>
            </div>                
        </div>   
    </div>	
    
   

	<?php 
	if(!LOCAL) {?>
		<script type="text/javascript">
                                  
          var _gaq = _gaq || [];
          _gaq.push(['_setAccount', 'UA-24525750-1']);
          _gaq.push(['_trackPageview']);
        
          (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
          })();
        
        </script>
	<?php }?>
<div id="login-form">
	<div class="box-inner">
		<img src="images/roundcube_logo.png" class="logo" alt="Tamaani Webmail">

		<form name="form" method="post" action="http://localhost:88/?_task=login">
			<table>
				<tbody>
					<tr>
						<td class="title"><label for="rcmloginuser">Username</label>
						</td>
						<td class="input"><input name="_user" id="rcmloginuser"
							required="required" size="40" autocapitalize="off"
							autocomplete="off" type="text"></td>
					</tr>
					<tr>
						<td class="title"><label for="rcmloginpwd">Password</label>
						</td>
						<td class="input"><input name="_pass" id="rcmloginpwd"
							required="required" size="40" autocapitalize="off"
							autocomplete="off" type="password"></td>
					</tr>
					<tr>
						<td class="title">
						</td>
						<td class="input"><input type="button" id="rcmloginsubmit" class="button mainaction"
					value="Login"><input type="button" id="rcmcancel" class="button mainaction cancel"
					value="Cancel"></td>
					</tr>
				</tbody>
			</table>
		</form>

	</div>

	<div class="box-bottom">
		<div id="message"><span class="loading">Loading...</span><span class="error">Username or password is incorrect.</span></div>
		<noscript>&lt;p class="noscriptwarning"&gt;Warning: This webmail
			service requires Javascript! In order to use it please enable
			Javascript in your browser's settings.&lt;/p&gt;</noscript>
	</div>

	<div id="bottomline">Tamaani Webmail</div>
</div>
<div class="ui-overlay"></div>
<script type='text/javascript'>
	function setCookie(key, value) {
	    var expires = new Date();
	    expires.setTime(expires.getTime() + (1 * 60 * 60 * 1000));
	    document.cookie = key + '=' + value + ';expires=' + expires.toUTCString();
	}
	
	function getCookie(key) {
	    var keyValue = document.cookie.match('(^|;) ?' + key + '=([^;]*)(;|$)');
	    return keyValue ? keyValue[2] : null;
	}
	
	$(document).ready(function() {
		//$('#announcement-box').dialog({
		//	autoOpen: false,
		//	dialogClass: 'announcement-dialog'
		//});
		//$('#announcement-box').dialog('open');
		//$("#img-accouncement").click(function() {
			//$('#img-accouncement').addClass('disable');
		//});
	});
</script>
</body>
</html>