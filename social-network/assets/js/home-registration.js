var loader_image = chilepro_data.loading_image;
var ajaxurl = chilepro_data.ajaxurl;		
(function($) {
	
	var active_payment_gateway=chilepro_data.iv_gateway; 
	
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
							
		


