var loader_image = chilepro_data.loading_image;
var ajaxurl = chilepro_data.ajaxurl;		
(function($) {
	
	var active_payment_gateway=chilepro_data.iv_gateway; 
	
	jQuery(document).ready(function($) {
	
				jQuery.validate({
					form : '#chilepro_contact',
																			
					onSuccess : function() {	
						send_contact_message();	
						return false; // false Will stop the submission of the form
						
					},
					
			  })
 
	 })
})(jQuery);	

function send_contact_message(){
	
var ajaxurl = chilepro_data.ajaxurl;	
var loader_image =  chilepro_data.loading_image;
	jQuery('#update_message').html('<img src="'+loader_image+'">'); 
	var search_params={
		"action"  : 	"iv_directories_message_contact",	
		"form_data":	jQuery("#chilepro_contact").serialize(), 					
	};				
	jQuery.ajax({					
		url : ajaxurl,					 
		dataType : "json",
		type : "post",
		data : search_params,
		success : function(response){											
			jQuery('#update_message').html(response.msg );
			jQuery("#chilepro_contact").trigger('reset');						
		}
	});		


}

				
		
