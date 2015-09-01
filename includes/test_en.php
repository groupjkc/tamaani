<?php
	if($_POST['NbreSite']){
		
							 
		for ($j = 1; $j <= $_POST['NbreSite']; $j++) {?> 
			<div class='form_line'>
				<label class="label">Site:<?php echo $j?></label>
				<input class='phone width65' id='name' name='name' type='text' />
			</div>       
		<?php
		}	
	}
	else
	{
		echo 'no';
	 
	}

	?>