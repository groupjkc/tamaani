			function is_wireless(){
				return ( /(Android|iPhone|iPod|webOS|NetFront|Opera Mini|SEMC-Browser|PlayStation Portable|Nintendo Wii|BlackBerry)/.test( navigator.userAgent ) )
			}

			function $_GET(q,s) {
		        s = s ? s : window.location.search;
		        var re = new RegExp('&'+q+'(?:=([^&]*))?(?=&|$)','i');
		        return (s=s.replace(/^\?/,'&').match(re)) ? (typeof s[1] == 'undefined' ? '' : decodeURIComponent(s[1])) : undefined;
		    } 

			function createCookie(name,value,days) {
				if (days) {
					var date = new Date();
					date.setTime(date.getTime()+(days*24*60*60*1000));
					var expires = "; expires="+date.toGMTString();
				}
				else var expires = "";
				document.cookie = name+"="+value+expires+"; path=/";
			}

			function readCookie(name) {
				var nameEQ = name + "=";
				var ca = document.cookie.split(';');
				for(var i=0;i < ca.length;i++) {
					var c = ca[i];
					while (c.charAt(0)==' ') c = c.substring(1,c.length);
					if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
				}
				return null;
			}

			function eraseCookie(name) {
				createCookie(name,"",-1);
			}

		    /* MOBILE BROWSER DETECTION AND REDIRECTION
			by Marc Robert Guay for MobilizeMe (c) 2011 */

			if (1){ // ON/OFF switch

				if ($_GET('desktop') == '1'){
					createCookie('is_wireless_device', 'false');
				}		
				else { 

					if (is_wireless()){
						createCookie('is_wireless_device', 'true');
					}
					else{
						createCookie('is_wireless_device', 'false');
					}
				}	

				if (readCookie('is_wireless_device') == "true"){
					document.location = 'http://m.tamaani.com/';
				} 				
			}
