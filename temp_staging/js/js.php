	<script type='text/javascript'>
		$(document).ready(function() {
			

			$.address.change(function(event){		
				var urlPassed = event.value;
				
				//Change the href of languages 
				if($('#en').hasClass('active')){
					HrefEn = '?lang=en#' + urlPassed;
					$('#en').attr('href', HrefEn);
				}
				
				if($('#fr').hasClass('active')){
					HrefFr = '?lang=fr#' + urlPassed;
					$('#fr').attr('href', HrefFr);
				}

				if($('#in').hasClass('active')){
					HrefIn = '?lang=in#' + urlPassed;
					$('#in').attr('href', HrefIn);
				}
					
				url = urlPassed.replace('_page', '');
				url = url.replace('/', '');
				 
				 if (url.length > 1){
					 
					 if(url=='metered_usage') {
						
						  var footerImg = $('#MonthlyUsage img').attr('src');

					 	  if(footerImg=='images/ajax-loader.gif')
						  		window.location.replace('#home');
							else
								 $('#inside_content_wrapper').load(url+'.php');

					 }
					else
						$('#inside_content_wrapper').load(url+'.php');
				 }
				 else
				 {
					 $('#inside_content_wrapper').load('home.php');
				 }

			});
									   
			$("#resources").hover(function(){
				$('#sub_services').removeClass('selected');	
			});
				
			$("#services").hover(function(){
				$('#sub_resources').removeClass('selected');			
			})	

			$('.clicked').live('click', function(){	
				var ID  = $(this).attr('id');
				$('.selected').removeClass('selected');


				if((ID=='links_top') || (ID=='documents_top') || (ID=='support_top')){
					ID_sel = ID.replace('_top', '');
					$('#'+ID_sel).addClass('selected');
					$('#resources').addClass('selected');
					$('#sub_resources').addClass('selected');
				}

				if((ID=='links') || (ID=='documents') || (ID=='support')){
					ID_sel = ID+'_top';
					$('#'+ID_sel).addClass('selected');
					$('#resources').addClass('selected');
					$('#sub_resources').addClass('selected');
				}
				  
				if((ID=='residential_top') || (ID=='corporate_top') || (ID=='video_conferencing_top')){
					ID_sel = ID.replace('_top', '');
					$('#'+ID_sel).addClass('selected');
					$('#services').addClass('selected');
					$('#sub_services').addClass('selected');
				}	

				if((ID=='residential') || (ID=='corporate') || (ID=='video_conferencing')){
					ID_sel = ID+'_top';
					$('#'+ID_sel).addClass('selected');
					$('#services').addClass('selected');
					$('#sub_services').addClass('selected');
				}	
				
				$('#'+ID).addClass('selected');
				
			 });

			var userAgent = navigator.appName.toLowerCase();
				//Css center fixed doesnt work on IE, We use the image when it is IE
				if(userAgent=='microsoft internet explorer'){
					$('#bg').attr('src', 'images/Background-IE.jpg') ;	
				}	
				else{
					$("html").addClass("html");
				}

            $("#SignInForm").validate({errorPlacement: function(error, element) {} });
    
            $('#SubscribeForm').submit(function() {															   
                      
                    // Prepare query string and send AJAX request
                    $.ajax({
                        url: 'includes/add_<?php echo $_SESSION['lang'] ?>.php',
                        data: 'ajax=true&email=' + escape($('#email').val()),
                        success: function(msg) {
                            $('#response').css('color', '#F63');
                            $('#response').css('font-size', '12px');
                            $('#response').html(msg);
                        }
                    });
    
                    return false;
            });
			
			
			
		
			
			
			
        });
    </script> 
    
    
  