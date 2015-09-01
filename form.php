<?php
	session_start();
	include('includes/languages/'.$_SESSION['lang'].'.php'); 
	//include('includes/languages/en.php'); 
	
	include('includes/config.php');
	include('includes/functions.php');
	$services = get_services(3); 
	
	$sites= get_sites();
	$nbreSites=count($sites= get_sites());	
	?>

    <div id='inside_content' class="white_box" > 
        <div class="left_box"   ><img src="images/<?php echo $services['service_icon']?>" width="260"  ></div>
        <div class="right_box"  >    
        
              
			<div class="tag"><?php echo $lang['form_tagline'];?></div>        
			<form id='RequestForm' method='post' action='' name="RequestForm"  >   


                <div class="section_title  sectionlink black" id="Info"   ><?php echo $lang['step1'].$lang['contact_info'];?></div>  
                <div class="horizontal_bar" ></div>
                
                <div class="ContactInfo"  id="content_Info" >  
     
                    <div class='form_line'>
                        <label class="label"><?php echo $lang['CompanyName'];?>: *</label>
                        <input class='required width55' id='CompanyName' name='CompanyName' type='text' />
                        <input  name='Language' type='hidden' value="<?php echo $_SESSION['lang'] ?>" />
                        
                    </div>
                    
                    <div class='form_line'>
                        <label class="label"> <?php echo $lang['PO'];?>: *</label>
                        <input class='width55' id='PO' name='PO' type='text' />
                    </div>                            
                    
                    <div class='form_line'>
                        <label class="label"><?php echo $lang['ContactName'];?>: *</label>
                        <input class='phone width55 required' id='ContactName' name='ContactName' type='text' />
                    </div>
                                    
                    <div class='form_line'>
                        <label class="label"><?php echo $lang['Address'];?>: *</label>
                         <input class=' address width55 required' id='Address' name='Address' type='text' />
                      
                    </div>  
                    
                    <div class='form_line'>
                        <label class="label"><?php echo $lang['Town'];?>: *</label>
                        <input class=' width55 required' id='Town' name='Town' type='text' />
                    </div>
                    
                    <div class='form_line inline_block width260 '     >
                       <label class="label"><?php echo $lang['Province'];?>: *</label>
                      <input   id='Province' name='Province' type='text' class="required" />
                    </div>
                    
                    
                      <div class='form_line inline_block width290 '     >
                        <label class="label"><?php echo $lang['Zip'];?>: *</label>
                        <input   id='Zip' name='Zip' type='text' class="required" />
                    </div>                                                                                                              
                                                
                     <div class='form_line inline_block width260 '     >
                        <label class="label"><?php echo $lang['Email'];?>: *</label>
                        <input class='required email' id='Email' name='Email' type='text' />
                    </div>
                    
                     <div class='form_line inline_block width290 '     >
                        <label class="label"><?php echo $lang['WorkPhone'];?>: *</label>
                        <input class='phone required' id='WorkPhone' name='WorkPhone' type='text' />
                    </div>  
                    
				</div>
 

      
                <div class="section_title sectionlink black" id="boking"   ><?php echo $lang['step2'].$lang['booking_detail'];?></div>  
                <div class="horizontal_bar" ></div>
                
                <div class="BookingDetail"  id="content_boking"  style="display: none;" >    
                    <div class='form_line'>
                        <label class="label"><?php echo $lang['DateVC'];?>:</label>
                        <input class='width55'  type="text" id="DateVC" name='DateVC'>    
                    </div>
 
                     <div class='form_line'>
                        <label class="label"><?php echo $lang['TimeStart'];?>:</label>                                     
                        <input class='hasDatepicker width55' id='TimeStart' name='TimeStart' type='text'  />
                    </div>
                    
                    <div class='form_line'>
                        <label class="label"><?php echo $lang['TimeEnd'];?>:</label>
                        <input  class='hasDatepicker width55'  id='TimeEnd' name='TimeEnd' type='text'/> 
                    </div>
  
                    <div class='form_line'>
                        <input  id='oldNbreSite' name='oldNbreSite' type='hidden' value="0" /> 
                        <label class="label"><?php echo $lang['NbreSite'];?></label>
                        <select name='NbreSite' id='NbreSite' class='width55'>
                        
                        	<option value=""><?php echo $lang['select_how_site'];?></option> 
                            <?php 
                             
                           for ($i = 2; $i <= $nbreSites; $i++) {
                                echo "<option value='".$i."'";
                                if ($_POST['NbreSite'] == $i) 
                                echo " selected='selected' ";					
                                echo ">".$i."</option>";
                            }
                            ?>
                        </select>    
                    </div>                                                           
                   <div class='form_line '  style="height:40px; padding-bottom:8px;  ">
                        <div  class=" inline_block width35 "  style="vertical-align: top; padding-top:10px;"  >
                            <label class="label "><?php echo $lang['NunavikSite'];?></label>
                        </div>
                        <div  class=" inline_block  width55  left" >
                            <input type="radio" name="NunavikSite"  value="YES"  style="float:none" checked="checked"> 
                            <label class="label " style="float:none"><?php echo $lang['YES'];?></label>
                            <div  style="margin-bottom:10px; "> </div>
                            
                            <input type="radio" name="NunavikSite" value="NO"   style="float:none">
                            <label class="label " style="float:none"><?php echo $lang['NO'];?> </label>
                            
                        </div>
                    </div> 
                      
                    <div class='form_line_heigher'>
                        <label class="label"><?php echo $lang['SpecialNeeds'];?>:</label>
                        <textarea  class='  width55'  id=' SpecialNeeds' name='SpecialNeeds' type='text'  /> </textarea>
                        
                    </div>                     
                    
 

					<div class='form_line '  style="height:40px; padding-bottom:8px;  ">
                        <div  class=" inline_block width35 "  style="vertical-align: top; padding-top:10px;"  >
                            <label class="label "><?php echo $lang['FirstTimeUser'];?></label>
                        </div>
                        <div  class=" inline_block  width55  left" >
                            <input type="radio" name="FirstTimeUser"  value="YES"  style="float:none" > 
                            <label class="label " style="float:none"><?php echo $lang['YES'];?></label>
                            <div  style="margin-bottom:10px; "> </div>
                            
                            <input type="radio" name="FirstTimeUser" value="NO"   style="float:none" checked="checked">
                            <label class="label " style="float:none"><?php echo $lang['NO'];?> </label>
                            
                        </div>
                    </div> 
                
					<div class='form_line none '  style="height:40px; padding-bottom:8px;" id="RequireTraining">
                        <div  class=" inline_block width35 "  style="vertical-align: top; padding-top:10px;"  >
                            <label class="label "><?php echo $lang['RequireTraining'];?></label>
                        </div>
                        <div  class=" inline_block  width55  left" >
                            <input type="radio" name="RequireTraining"  value="YES"  style="float:none" checked="checked"> 
                            <label class="label " style="float:none"><?php echo $lang['YES'];?></label>
                            <div  style="margin-bottom:10px; "> </div>
                            
                            <input type="radio" name="RequireTraining" value="NO"   style="float:none">
                            <label class="label " style="float:none"><?php echo $lang['NO'];?> </label>
                            
                        </div>
                    </div>                                           
            
				</div> 
                                                    
				
                <div id="Site_Section"  style="display: none;" >     
   
                    <div class="section_title black top_padded_medium" id="boking"  style="background:none;"><?php echo $lang['step3'].$lang['site_info'];?></div>  
                    <div class="horizontal_bar" ></div>                
					<?php 

 				
					for ($j = 1; $j <= $nbreSites; $j++) {?> 
                        <div id='Site<?php echo $j?>'  style="display: none" >  
                        	<div class='section_title' style="background:#0A88C2; color:#FFF; margin-top:20px; padding:8px; " >
                            
                            <?php echo $lang['site_detail']?> 
							<?php echo $j?> </div>

                            <div class='form_line'>
                                <label class="label"><?php echo $lang['SiteName']?>:</label>
                                <select name='<?php echo $j?>' id='<?php echo $j?>' class='width55 SiteSelected'> 
                                	<option value=""><?php echo $lang['select_site']?></option> 
                                    <?php 
 								foreach ($sites as $site) {	
				                        echo "<option value='".$site['site_id']."'";
                                        if ($_POST['NumSite'] == $site['site_id']) 
                                        echo " selected='selected' ";					
                                        echo ">".$site['SiteName']."</option>";
                                    }
                                    ?>
                                    <option value="0"><?php echo $lang['Other']?></option>
                                </select>    
                                <br>
                               
                            </div>   

                            <div class='form_line' style="display:none;"  id="SiteNameContent<?php echo $j?>" >
                                <input class='width55' id='SiteName<?php echo $j?>' name='SiteName<?php echo $j?>' type='text'  value="SITE NAME"/>
                            </div>



                            <div class='form_line ' >
                                <label class="label bold"><?php echo $lang['RR']?>:</label>
                            </div>
                                    
 

                            <div class='form_line '  >
                                <label class="label"><?php echo $lang['NAME']?>:</label>
                                <input class='width55' id='RRContact<?php echo $j?>' name='RRContact<?php echo $j?>' type='text' />
                            </div>
                            
                            <div class='form_line inline_block width260 '   >
                                <label class="label"><?php echo $lang['Email']?>: *</label>
                                <input class=' email ' id='RREmail<?php echo $j?>' name='RREmail<?php echo $j?>' type='text' style="width:180px;" />
                            </div>
                            
                            <div class='form_line inline_block width290'>
                                <label class="label"><?php echo $lang['PHONE']?>: *</label>
                                <input class=' ' id='RRPhone<?php echo $j?>' name='RRPhone<?php echo $j?>' type='text'  style="width:190px;" />
                            </div>                               
                            
 
 
 
                            <div class='form_line ' >
                                <label class="label bold"><?php echo $lang['Tec']?>:</label>
                            </div>                                                

                            <div class='form_line '  >
                                <label class="label"><?php echo $lang['NAME']?>:</label>
                                <input class='width55' id='TecContact<?php echo $j?>' name='TecContact<?php echo $j?>' type='text' />
                            </div>
                            
                            <div class='form_line inline_block width260 '   >
                                <label class="label"><?php echo $lang['Email']?>: *</label>
                                <input class=' email ' id='TecEmail<?php echo $j?>' name='TecEmail<?php echo $j?>' type='text' style="width:180px;" />
                            </div>
                            
                            <div class='form_line inline_block width290'>
                                <label class="label"><?php echo $lang['PHONE']?>: *</label>
                                <input class=' ' id='TecPhone<?php echo $j?>' name='TecPhone<?php echo $j?>' type='text'  style="width:190px;" />
                            </div>  

                            <div class='form_line '  style="height:40px; padding-bottom:8px;  ">
                                <div  class=" inline_block width35 "  style="vertical-align: top; padding-top:10px;"  >
                                    <label class="label "><?php echo $lang['TechnologyUsed']?>: *</label>
                                </div>
                                <div  class=" inline_block  width55  left" >
                                    <input type="radio" name="TechnologyUsed<?php echo $j?>"  value="IP"  style="float:none" checked="checked"> 
                                    <label class="label " style="float:none">IP:</label>
                                    
                                    <input class='width80' id='IP<?php  echo $j?>' name='IP<?php  echo $j?>' type='text' />
                                    	<div  style="margin-bottom:10px; "> </div>

									<div id="Nunavik<?php echo $j?>">                                    
                                        <input type="radio" name="TechnologyUsed<?php echo $j?>" value="ISDN"   style="float:none">
                                        <label class="label " style="float:none;"><?php echo $lang['ISDN']?>: </label>
                                   </div>
 
                                   
                                   
                                </div>
                            </div>
                            
                            <div class='form_line'   >
                                <label class="label"><?php echo $lang['Equipment']?>: *</label>
                                <input  class='width55'  id='Equipment<?php echo $j?>' name='Equipment<?php echo $j?>' type='text'  />
                            </div>
                            
                            <div class='form_line '>
                                <label class="label"><?php echo $lang['Model']?>: *</label>
                                <input class='width55'  id='Model<?php echo $j?>' name='Model<?php echo $j?>' type='text'    />
                            </div>                                                                                                              
                        
                        </div> 
                    <?php }?>                                                   
                </div>
            	<input class="submit" type="submit" name="submit_second" id="submit_second" value="<?php echo  $lang['Next_Step'];?>" />                      
            </form>
                                                                
		</div>
    </div>
    
    <div class="bottom_shadow"></div> 
      
    <div class="popup_box" id="popup"  >
    			<div id="close" class="blue" align="right"  style="cursor:pointer;" ><img src="images/close.jpg"  border="0" /></div> 
                <div   class="blue center" style="font-size:32px;" ><?PHP echo $lang['Thank_registering']; ?></div>   
                <div   class="text  center" style="font-size:18px; padding-top:20px; padding-bottom:50px;"  > 
                	 <?PHP echo $lang['receive_email']; ?>
                </div>   
                <div class="center" ><img src="images/tamaani.jpg" width="500"></div>                	
    </div>
    
    <link rel="stylesheet" href="includes/ui/themes/redmond/jquery.ui.all.css">    
    <link rel="stylesheet" href="css/datepicker.css">   
    <link rel="stylesheet" href="css/timepicker.css" type="text/css" />
	
    <!-- js and css of the calender and timer	/* -->
	<script src="includes/ui/jquery.ui.core.js"></script> 
    <script src="includes/ui/jquery.ui.datepicker.js"></script>  
    <script type="text/javascript" src="includes/ui/jquery.ui.timepicker.js"></script> 
     <script type="text/javascript" src="js/blockUI.js" charset="utf-8"></script>   
  
	<script>

	$(function() {	   
			$("#DateVC" ).datepicker();
		});		
		
		$('#TimeStart').timepicker({
			showLeadingZero: false,
			onHourShow: tpStartOnHourShowCallback,
			onMinuteShow: tpStartOnMinuteShowCallback
		});
		$('#TimeEnd').timepicker({
			showLeadingZero: false,
			onHourShow: tpEndOnHourShowCallback,
			onMinuteShow: tpEndOnMinuteShowCallback
		});	

		function tpStartOnHourShowCallback(hour) {
			var tpEndHour = $('#TimeEnd').timepicker('getHour');
			// Check if proposed hour is prior or equal to selected end time hour
			if (hour <= tpEndHour) { return true; }
			// if hour did not match, it can not be selected
			return true;
		}
		function tpStartOnMinuteShowCallback(hour, minute) {
			var tpEndHour = $('#TimeEnd').timepicker('getHour');
			var tpEndMinute = $('#TimeEnd').timepicker('getMinute');
			// Check if proposed hour is prior to selected end time hour
			if (hour < tpEndHour) { return true; }
			// Check if proposed hour is equal to selected end time hour and minutes is prior
			if ( (hour == tpEndHour) && (minute < tpEndMinute) ) { return true; }
			// if minute did not match, it can not be selected
			return true;
		}

		function tpEndOnHourShowCallback(hour) {
			var tpStartHour = $('#TimeStart').timepicker('getHour');
			// Check if proposed hour is after or equal to selected start time hour
			if (hour >= tpStartHour) { return true; }
			// if hour did not match, it can not be selected
			return false;
		}
		function tpEndOnMinuteShowCallback(hour, minute) {
			var tpStartHour = $('#TimeStart').timepicker('getHour');
			var tpStartMinute = $('#TimeStart').timepicker('getMinute');
			// Check if proposed hour is after selected start time hour
			if (hour > tpStartHour) { return true; }
			// Check if proposed hour is equal to selected start time hour and minutes is after
			if ( (hour == tpStartHour) && (minute > tpStartMinute) ) { return true; }
			// if minute did not match, it can not be selected
			return false;
		}

		
	</script>
	

    
    <script type='text/javascript'>
    	$(document).ready(function(){
					   
				 $.unblockUI();		   	   
	/****************************************************  LOADING*****************************************************/ 

			$("#RequestForm").validate({
									    
				errorPlacement: function(error, element) {
					error.appendTo(element.siblings(".error"));
				},
			 			 
				submitHandler: function(form) {	
				
						var dontBlock = false;
						
						$(document).ajaxStart(function(){
									if(!dontBlock){
										$.blockUI.defaults.css = {};
										$.blockUI({ 
										message: '<div ><img src="images/spinner.gif" /> <?PHP echo $lang['please_wait']; ?>...</div>'  }
										);
									}
						}).ajaxStop($.unblockUI);				
				
				
				
				  if (!$('#boking').hasClass('section_active'))    
				  {
				 	$( '#content_Info').fadeOut("200", function(){
						
						$( '#content_boking' ).fadeIn("200", function(){
							$('#boking').addClass('section_active');
							
								
						})
						
						if(($.browser.msie) && ($.browser.version<9)) 
						{
							$('#inside_content').css({ height:'590px' });
						}						
						
						$('#Info').addClass('section');
						$('#boking').addClass('section');
						
						
						$('#Info').removeClass('section_active');
					 	$('#content_boking input').addClass('required');
						$('#content_boking select').addClass('required');
						$('#submit_second').val('<?php echo $lang['Submit'] ;  ?>');	
						 
					})
				  }
				  else
				  {
		 
					$.post("includes/form_send.php", $("#RequestForm").serialize(), function(data) {
						
										dontBlock = true; 														 
   											 
											if (parseInt(data) > 0)
											{
												window.location.replace('#ThankYou');
												//popup(); 
												//alert('yes');
											}
											else
											{
												alert(data + ') There was an error. Please try again.');
												//window.location.replace('#ThankYou');
												//alert('Error');  
											}
											
					 	});
	   
           		 	return false;
					}
				
				}
			});  
					/****************************************************  LOADING *****************************************************/ 
						
					
			$(".sectionlink").click(function(){
				var ID = $(this).attr('id');
			
				if(($.browser.msie) && ($.browser.version<9)) 
				{
					$('#inside_content').css({ height:'790px' });
				}	
					
				if (!$(this).hasClass('section_active')){                  
					
					$( '#content_'+ID ).fadeIn("200", function(){
						$('#'+ID).addClass('section_active');
					})
				}
				else
				{    
					$( '#content_'+ID ).fadeOut("200", function(){
						$('#'+ID).removeClass('section_active');
					})
				}
			   
			});	
			
		 
				//-------------------------------------- Change First time user -----------------------------------
			
			$("input[name='FirstTimeUser']").live('change', function() {
             
            	if ($("input[name='FirstTimeUser']:checked").val() == 'YES')
					$("#RequireTraining").removeClass('none');
				else
					$("#RequireTraining").addClass('none');
					
			})
			//-------------------------------------- Change info Site -----------------------------------
	
			$('.SiteSelected').live('change', function() {
												   
													   
				
				var SiteSelected    = parseInt($(this).val());	
				var SelectId        = $(this).attr('id');
			 
			 	
				if(SiteSelected==0){
					$('#SiteNameContent'+SelectId).show();
					$('#SiteName'+SelectId).val('');
					$('#Site_Section input').attr('readonly', false);
				}
				else
				{	
					$('#SiteNameContent'+SelectId).hide();
					$('#SiteName'+SelectId).val('SITE NAME');
					$('#Site_Section input').attr('readonly', true);


					$.getJSON("includes/get_site.php?SiteSelected="+SiteSelected, function(data){
					 
						var RRContact  = data[0]["RRContact"];
						var RREmail    = data[0]["RREmail"];
						var RRPhone    = data[0]["RRPhone"];
						
						var TecContact  = data[0]["TecContact"];
						var TecEmail    = data[0]["TecEmail"];
						var TecPhone    = data[0]["TecPhone"];

						var IP                = data[0]["IP"];
						var Nunavik           = data[0]["Nunavik"];
						
						var Equipment         = data[0]["Equipment"];
						var Model             = data[0]["Model"];						
							//if it is a nunavik site we remove the ISDN			 
						if(Nunavik=='Y')
							$("#Nunavik"+SelectId).addClass('none');
						else
							$("#Nunavik"+SelectId).removeClass('none');
							$("#RRContact"+SelectId).val(RRContact);
							$("#RREmail"+SelectId).val(RREmail);
							$("#RRPhone"+SelectId).val(RRPhone);
							
							$("#TecContact"+SelectId).val(TecContact);
							$("#TecEmail"+SelectId).val(TecEmail);
							$("#TecPhone"+SelectId).val(TecPhone);
							
							$("#Equipment"+SelectId).val(Equipment);
							$("#Model"+SelectId).val(Model);
							
							$("#IP"+SelectId).val(IP);
				});

				$('#'+SelectId+'_choose').append(SiteSelected);	
				
				
				
				}
					


			});	
			
			
					//-------------------------------------- Change Number Site ------------------------------------
			$('#NbreSite').live('change', function() {
					


					var NbreSite    = parseInt($(this).val());
					var oldNbreSite	= parseInt($('#oldNbreSite').val());	
					var difference  = NbreSite - oldNbreSite

					if(($.browser.msie) && ($.browser.version<9)) 
						{
						newheight = 790+(470*NbreSite);
						$('#inside_content').css({ height:newheight+'px' });
					}


					if(oldNbreSite>0)
						if(difference >0)
							for (var i=oldNbreSite + 1 ; i<= NbreSite; i++)
							{		
								$('#Site'+i).show();
								$('#Site'+i+ ' input').addClass('required');
								$('#Site'+i+ ' select').addClass('required');
								
								$('#Equipment'+i).removeClass('required');
								$('#Model'+i).removeClass('required');
								 
							}	
						else 
							for (var i=NbreSite+1; i<= oldNbreSite; i++)
							{
								$('#Site'+i).hide();
								$('#Site'+i+ ' input').removeClass('required');
								$('#Site'+i+ ' select').removeClass('required');
							}	
												   
					else{
						for (var i=1; i<= NbreSite; i++)
						{
							$('#Site'+i).show();
							$('#Site'+i+ ' input').addClass('required');
							$('#Site'+i+ ' select').addClass('required');
							
							$('#Equipment'+i).removeClass('required');
							$('#Model'+i).removeClass('required');
							
						}
						$('#Site_Section').show();	
					}
					$("#oldNbreSite").val(NbreSite);
					return false;	
			});	
	
	

								   
				function popup(){
						$('#popup').fadeIn();
						
						//add div with the fade just the first time 
						if($("body div:[id='fade']").length < 1)
							$('body').append('<div id="fade"></div>');
	
							
						//remove the scroll
						$('body').css('overflow', 'hidden');
						
						$('#fade').css({'filter' : 'alpha(opacity=50)'}).fadeIn();
						
						var popuptopmargin = ($('#popup').height() + 10) / 2;
						var popupleftmargin = ($('#popup').width() + 10) / 2;
						
						$('#popup').css({
						'margin-top' : -popuptopmargin,
						'margin-left' : -popupleftmargin
						});
				}
						
			
		 
			
				//Close POPUP
			$('#close').click(function() {		  
				$('#fade , #popup').fadeOut();
				$('body').css('overflow', '');
				$('#inside_content_wrapper').load('form.php');

				return false;
			});					   
								   	
							
					
			


		});
								   
								   
    
    </script>  
    <script type="text/javascript" src="js/monthly_usage.js" ></script>	
				   
								   
     
		    
