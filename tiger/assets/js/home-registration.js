var loader_image = tiger_data.loading_image;
var ajaxurl = tiger_data.ajaxurl;		
(function($) {
	
	var active_payment_gateway=tiger_data.iv_gateway; 
	
	jQuery(document).ready(function($) {
			
						jQuery.validate({
							form : '#iv_home_registration',
							modules : 'security',		
												
							onSuccess : function() {
							
							  	jQuery("#loading-3").show();
								jQuery("#loading").html('<img src="'+loader_image+'">');
									return true; // false Will stop the submission of the form
							
							},
							
					  })
 
	 })
	 
})(jQuery);
							
		


