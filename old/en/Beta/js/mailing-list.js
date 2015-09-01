/*///////////////////////////////////////////////////////////////////////
Ported to jquery from prototype by Joel Lisenby (joel.lisenby@gmail.com)
http://joellisenby.com

original prototype code by Aarron Walter (aarron@buildingfindablewebsites.com)
http://buildingfindablewebsites.com

Distrbuted under Creative Commons license
http://creativecommons.org/licenses/by-sa/3.0/us/
///////////////////////////////////////////////////////////////////////*/

$(document).ready(function() {
	
	$('#mc_embed_signup').submit(function() {
		
		// update user interface
		$('#response').html('Adding email address...');
		
		// Prepare query string and send AJAX request
		$.ajax({
			url: 'includes/includes/add-address.php',
			data: 'ajax=true&email=' + escape($('#mce-EMAIL').val()),
			success: function(msg) {
				$('#response').html(msg);
			}
		});
	
		return false;
	});
});