$.getJSON("includes/monthly_usage.php", function(data){
												 
											//	 alert(data);
			var html ='<img src="images/MeterUsage/'+data["img"]+'.png"  style="margin-top:-120px; border=0"  BORDER="0"    /><BR>'+data["msg"]; 
			$("#MonthlyUsage").html(html);
			$("#MonthlyUsage").attr("href", '#metered_usage');
			$("#STATUS").html(data["STATUS"]);
			
});

