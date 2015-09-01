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
							else {
								$('#inside_content_wrapper').addClass('high-index');
								$('#inside_content_wrapper').load(url+'.php');
							}
					}
					else if (url.indexOf("company-page-") > -1) {
					 	//if this is company-page
					 	var postDetailID = url.replace('company-page-', '');
					 	$('#inside_content_wrapper').addClass('high-index');
						$('#inside_content_wrapper').load('company.php?info='+postDetailID);
					}
					else {
						$('#inside_content_wrapper').addClass('high-index');
						$('#inside_content_wrapper').load(url+'.php');
					}
				 }
				 else
				 {
					 $('#inside_content_wrapper').load('home.php');
					 $('#inside_content_wrapper').removeClass('high-index');
				 }

			});
									   
			$("#resources").hover(function(){
				$('#sub_services').removeClass('selected');
				$('#sub_about').removeClass('selected');
			});
				
			$("#services").hover(function(){
				$('#sub_resources').removeClass('selected');
				$('#sub_about').removeClass('selected');			
			});

			$('#about_us').hover(function(){
				$('#sub_resources').removeClass('selected');
				$('#sub_services').removeClass('selected');				
			});

			$('.clicked').live('click', function(){	
				var ID  = $(this).attr('id');
				var showWhenClickAbout = $(this).hasClass("sub_about_child");
				$('.selected').removeClass('selected');


				if((ID=='links_top') || (ID=='documents_top') || (ID=='support_top') || (ID=='forms_top')){
					ID_sel = ID.replace('_top', '');
					$('#'+ID_sel).addClass('selected');
					$('#resources').addClass('selected');
					$('#sub_resources').addClass('selected');
				}

				if((ID=='links') || (ID=='documents') || (ID=='support') || (ID=='forms')){
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

				if(ID == 'tenyears' || showWhenClickAbout ){
					$('#about_us').addClass('selected');
					$('#sub_about').addClass('selected');
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
				//var randomNumber = (Math.floor((Math.random() * 1000) + 1)%3) + 1;
				if(userAgent=='microsoft internet explorer'){
					$('#bg').attr('src', glbackground) ;	
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
            
            $('#mail-box').click(function() {
                $('#login-form').dialog('open');
                closedialog = 0;
            });

            var closedialog;

            function overlayclickclose() {
                if (closedialog) {
                    $('#login-form').dialog('close');
                }

                //set to one because click on dialog box sets to zero 
                closedialog = 1;
            }

            $('#login-form').dialog({
                autoOpen: false,
                width:500,
                height:350,
                open: function() {
                    closedialog = 1;
                    $(".ui-overlay").show();
                    $("#message .error").hide();
                    //$(document).bind('click', overlayclickclose);
                },
                focus: function() {
                    closedialog = 0;
                    $("#message .error").hide();
                }
                , close: function() {
                    $(document).unbind('click');
                    $(".ui-overlay").hide();
                    $("#rcmloginpwd").val("");
                    $("#rcmloginuser").val("");
                }
                /*,buttons: {
                    Submit: function() {
                        $(this).dialog('close');
                    }
                }*/
            });
            $("#rcmcancel").click(function() {
            	$('#login-form').dialog('close');
            });
            $("#rcmloginsubmit").click(function() {
             if($.trim($("#rcmloginuser").val())!="")
             { 
                 if($("#rcmloginpwd").val()!=""){
					 $("#message .loading").show();
					 $("#message .error").hide();
					 var user = $.trim($("#rcmloginuser").val());
					 var pass = $("#rcmloginpwd").val();
					    $.ajax({
							url: "/roundcube/rclogin.php",
							type: "POST",
							dataType: 'json',
							data: { action: "login", user : user, pass: pass},
							success:function(result){
								//$('.result').html(result);
								if(result)
								{
									window.location = "/roundcube";
								}
								else
								{
									$("#message .loading").hide();
									$("#message .error").html('Username or password is incorrect.').show(); 
								}
							}
						});
                 }
                 else{
                	 $("#message .error").html('Password is not empty.').show();
                 }
             }
             else
             {
            	 $("#message .error").html('Username is not empty.').show();
             }
            });
            
        });
    </script> 
    
    
  