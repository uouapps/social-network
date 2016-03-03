var loader_image = chilepro_data.loading_image;
var ajaxurl = chilepro_data.ajaxurl;		
(function($) {
	
	var active_payment_gateway=chilepro_data.iv_gateway; 
	
	jQuery(document).ready(function($) {
			
						jQuery.validate({
							form : '#iv_directories_registration',
							modules : 'security',		
												
							onSuccess : function() {
							
							  	jQuery("#loading-3").show();
								jQuery("#loading").html('<img src="'+loader_image+'">');
								
								if(active_payment_gateway=='stripe'){
									
										 Stripe.createToken({
											number: jQuery('#card_number').val(),
											cvc: jQuery('#card_cvc').val(),
											exp_month: jQuery('#card_month').val(),
											exp_year: jQuery('#card_year').val(),
											//name: $('.card-holder-name').val(),
											//address_line1: $('.address').val(),
											//address_city: $('.city').val(),
											//address_zip: $('.zip').val(),
											//address_state: $('.state').val(),
											//address_country: $('.country').val()
										}, stripeResponseHandler);
									
									return false;
									
								}else{ // Else for paypal
									
									return true; // false Will stop the submission of the form
								}
								
							},
							
					  })
 
	 })
	 
	 
	 // this identifies your website in the createToken call below
	 if(active_payment_gateway=='stripe'){
		Stripe.setPublishableKey(chilepro_data.stripe_publishable);

			function stripeResponseHandler(status, response) {
				if (response.error) {				
					jQuery("#payment-errors").html('<div class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">x</a>'+response.error.message +'.</div> ');
				
				} else {
					var form$ = jQuery("#iv_directories_registration");
					// token contains id, last4, and card type
					var token = response['id'];
					// insert the token into the form so it gets submitted to the server
					form$.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
					// and submit
					form$.get(0).submit();
				}
			}
	}
	 
	 
})(jQuery);
							
		
jQuery(document).ready(function() {
    jQuery('#coupon_name').on('keyup change', function() {
						
		var ajaxurl = chilepro_data.ajaxurl;		
		var search_params={
			"action"  			: "iv_directories_check_coupon",	
			"coupon_code" 		:jQuery("#coupon_name").val(),
			"package_id" 		:jQuery("#package_id").val(),
			"package_amount" 	:chilepro_data.package_amount,
			"api_currency" 		:chilepro_data.api_currency,
			"form_data"			:jQuery("#iv_directories_registration").serialize(),
			
		};
		jQuery('#coupon-result').html('<img src="'+chilepro_data.old_loader+'">');
		jQuery.ajax({					
			url : ajaxurl,					 
			dataType : "json",
			type : "post",
			data : search_params,
			success : function(response){
				if(response.code=='success'){							
					jQuery('#coupon-result').html('<img src="'+chilepro_data.right_icon+'">');							
					
				}else{
					jQuery('#coupon-result').html('<img src="'+chilepro_data.wrong_icon+'">');
				}
				
				jQuery('#total').html('<label class="control-label">'+response.gtotal +'</label>');
				jQuery('#discount').html('<label class="control-label">'+response.dis_amount +'</label>');
			}
		});
	});
});

jQuery(function(){	
	
		jQuery('input:radio[name="iv_member_type"]').change(function (e) {				
										
		var ajaxurl = chilepro_data.ajaxurl;		
		var search_params={
		"action"  			: "iv_directories_check_package_type",	
		"coupon_code" 		:jQuery("#coupon_name").val(),		
		"api_currency" 		:chilepro_data.api_currency,
		"form_data"			:jQuery("#iv_directories_registration").serialize(),
		};
		jQuery.ajax({					
			url : ajaxurl,					 
			dataType : "json",
			type : "post",
			data : search_params,
			success : function(response){
				if(response.code=='success'){
					jQuery('#coupon-result').html('<img src="'+chilepro_data.right_icon+'">');
				}else{
						jQuery('#coupon-result').html('<img src="'+chilepro_data.wrong_icon+'">');
				}
				jQuery('#p_amount').html(response.p_amount);							
				jQuery('#total').html(response.gtotal);
				jQuery('#tax').html(response.tax_total);
				jQuery('#discount').html(response.dis_amount);
				jQuery('#package_div').html(response.package_div_result);
				jQuery('#package_id').val(response.package_id); 
			}
			});
		});	
		
	jQuery('#package_sel').on('change', function (e) {
		var optionSelected = jQuery("option:selected", this);
		var pack_id = this.value;
		
		jQuery("#package_id").val(pack_id);
								
		var ajaxurl = chilepro_data.ajaxurl;		
		var search_params={
		"action"  			: "iv_directories_check_package_amount",	
		"coupon_code" 		:jQuery("#coupon_name").val(),
		"package_id" 		: pack_id,
		"package_amount" 	:chilepro_data.package_amount,
		"api_currency" 		:chilepro_data.api_currency,
		"form_data"			:jQuery("#iv_directories_registration").serialize(),
		};
		jQuery.ajax({					
			url : ajaxurl,					 
			dataType : "json",
			type : "post",
			data : search_params,
			success : function(response){
				if(response.code=='success'){
					jQuery('#coupon-result').html('<img src="'+chilepro_data.right_icon+'">');
				}else{
						jQuery('#coupon-result').html('<img src="'+chilepro_data.wrong_icon+'">');
				}
				jQuery('#p_amount').html(response.p_amount);							
				jQuery('#total').html(response.gtotal);
				jQuery('#tax').html(response.tax_total);
				jQuery('#discount').html(response.dis_amount);
			}
			});
		});	
jQuery('#country_select').on('change', function (e) {
		var optionSelected = jQuery("option:selected", this);
		var pack_id = jQuery("#package_id").val();
		
		
		//jQuery("#package_id").val(pack_id);
								
		var ajaxurl = chilepro_data.ajaxurl;		
		var search_params={
		"action"  			: "iv_directories_check_package_amount",	
		"coupon_code" 		:jQuery("#coupon_name").val(),
		"package_id" 		: pack_id,
		"package_amount" 	:chilepro_data.package_amount,
		"api_currency" 		:chilepro_data.api_currency,
		"form_data"			:jQuery("#iv_directories_registration").serialize(),
		};
		jQuery.ajax({					
			url : ajaxurl,					 
			dataType : "json",
			type : "post",
			data : search_params,
			success : function(response){
				if(response.code=='success'){
					jQuery('#coupon-result').html('<img src="'+chilepro_data.right_icon+'">');
				}else{
						jQuery('#coupon-result').html('<img src="'+chilepro_data.wrong_icon+'">');
				}
				jQuery('#p_amount').html(response.p_amount);							
				jQuery('#total').html(response.gtotal);
				jQuery('#tax').html(response.tax_total);
				jQuery('#discount').html(response.dis_amount);
			}
			});
		});
});	
	
function select_change_ajax(p){
		var pack_id = p;
		
		jQuery("#package_id").val(pack_id);
								
		var ajaxurl = chilepro_data.ajaxurl;	
		var search_params={
		"action"  			: "iv_directories_check_package_amount",	
		"coupon_code" 		:jQuery("#coupon_name").val(),
		"package_id" 		: pack_id,
		"package_amount" 	:chilepro_data.package_amount,
		"api_currency" 		:chilepro_data.api_currency,
		"form_data"			:jQuery("#iv_directories_registration").serialize(),
		};
		jQuery.ajax({					
			url : ajaxurl,					 
			dataType : "json",
			type : "post",
			data : search_params,
			success : function(response){
				if(response.code=='success'){							
					jQuery('#coupon-result').html('<img src="'+chilepro_data.right_icon+'">');
				}else{
						jQuery('#coupon-result').html('<img src="'+chilepro_data.wrong_icon+'">');
				}
				jQuery('#p_amount').html('<label class="control-label">'+response.p_amount+'</label>');							
				jQuery('#total').html('<label class="control-label">'+response.gtotal+'</label>');
				jQuery('#tax').html('<label class="control-label">'+response.tax_total+'</label>');
				jQuery('#discount').html('<label class="control-label">'+response.dis_amount+'</label>');
			}
			});

}	

function show_coupon(){
				jQuery("#coupon-div").show();
                 jQuery("#show_hide_div").html('<label for="text" class="col-md-3 control-label"></label><div class="col-md-9 " ><button type="button" onclick="hide_coupon();"  class="btn btn-default center"> '+chilepro_data.Hide_Coupon +'</button></div>');
}
function hide_coupon(){
				 jQuery("#coupon-div").hide();
                 jQuery("#show_hide_div").html('<label for="text" class="col-md-3 control-label"></label><div class="col-md-9 " ><button type="button" onclick="show_coupon();"  class="btn btn-default center"> '+chilepro_data.have_Coupon +'</button></div>');
}
