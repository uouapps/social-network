function modal_send_message_iv(){
		
		var formc = jQuery("#message-modal");
		if (jQuery.trim(jQuery("#message-content",formc).val()) == "") {
                  alert("Please put your message");
        } else {    
			var ajaxurl = chilepro_data.ajaxurl;	
			var loader_image =  chilepro_data.loading_image;
				jQuery('#update_message_modal').html(loader_image); 
				var search_params={
					"action"  : 	"iv_directories_message_send",	
					"form_data":	jQuery("#message-modal").serialize(), 					
				};				
				jQuery.ajax({					
					url : ajaxurl,					 
					dataType : "json",
					type : "post",
					data : search_params,
					success : function(response){											
						jQuery('#update_message_modal').html(response.msg );
						jQuery("#message-modal").trigger('reset');						
					}
				});
		}	
}
function send_message_iv(){		 
		var formc = jQuery("#message-pop");
		if (jQuery.trim(jQuery("#message-content",formc).val()) == "") {
                  alert("Please put your message");
        } else {    
			var ajaxurl = chilepro_data.ajaxurl;	
			var loader_image =  chilepro_data.loading_image;
				jQuery('#update_message_popup').html(loader_image); 
				var search_params={
					"action"  : 	"iv_directories_message_send",	
					"form_data":	jQuery("#message-pop").serialize(), 					
				};				
				jQuery.ajax({					
					url : ajaxurl,					 
					dataType : "json",
					type : "post",
					data : search_params,
					success : function(response){											
						jQuery('#update_message_popup').html(response.msg );
						jQuery("#message-pop").trigger('reset');						
					}
				});
		}	
}
function send_message_claim(){	
			
		var isLogged = chilepro_data.current_user_id;                            
        if (isLogged=="0") {                   
                alert(chilepro_data.Login_claim);
        } else { 	
			
			var form = jQuery("#message-claim");			
			if (jQuery.trim(jQuery("#message-content", form).val()) == "") {
                  alert("Please put your message");
			} else {
				var ajaxurl = chilepro_data.ajaxurl;	
				var loader_image =  chilepro_data.loading_image;
				jQuery('#update_message_claim').html(loader_image); 
				var search_params={
					"action"  : 	"iv_directories_claim_send",	
					"form_data":	jQuery("#message-claim").serialize(), 					
				};				
				jQuery.ajax({					
					url : ajaxurl,					 
					dataType : "json",
					type : "post",
					data : search_params,
					success : function(response){ 											
						jQuery('#update_message_claim').html('   '+response.msg );
						jQuery("#message-claim").trigger('reset');
						
					}
				});
			}
		}	
	
	}
function save_follow(id) {       
		
		  var isLogged = chilepro_data.current_user_id;
                               
                if (isLogged=="0") {                   
                     alert(chilepro_data.login_follw);
                } else { 
						
						var ajaxurl = chilepro_data.ajaxurl;
						var search_params={
							"action"  : 	"iv_directories_save_follow",	
							"data": "id=" + id,
						};
						
						jQuery.ajax({					
							url : ajaxurl,					 
							dataType : "json",
							type : "post",
							data : search_params,
							success : function(response){ 
								
								jQuery("#uoufollow").html('<a   href="javascript:;" class="blue-background"  onclick="save_unfollow('+id+')" ><i class="fa fa fa-eye" ></i> </a>');
							
								
							}
						});
						
				}  
				
    }
function save_unfollow(id) {
		  var isLogged = chilepro_data.current_user_id;
                               
                if (isLogged=="0") {                   
                     alert(chilepro_data.login_follw);
                } else { 
						
						var ajaxurl = chilepro_data.ajaxurl;								
						var search_params={
							"action"  : 	"iv_directories_save_un_follow",	
							"data": "id=" + id,
						};
						
						jQuery.ajax({					
							url : ajaxurl,					 
							dataType : "json",
							type : "post",
							data : search_params,
							success : function(response){ 
								jQuery("#uoufollow").html('<a   href="javascript:;"   onclick="save_follow('+id+')" ><i class="fa fa fa-eye" ></i> </a>');
							
								
							}
						});
						
				}  
				
    }	    
function save_connect(id) {       
		
		  var isLogged = chilepro_data.current_user_id;
                               
                if (isLogged=="0") {                   
                     alert(chilepro_data.login_connect);
                } else { 
						
						var ajaxurl = chilepro_data.ajaxurl;
						var search_params={
							"action"  : 	"iv_directories_save_connect",	
							"data": "id=" + id,
						};
						
						jQuery.ajax({					
							url : ajaxurl,					 
							dataType : "json",
							type : "post",
							data : search_params,
							success : function(response){ 
								jQuery("#uouconnect").html('<a href="javascript:;" class="blue-background" onclick="save_deleteconnect('+id+');" ><i class="fa fa-user-plus" ></i> '+chilepro_data.Connected+'</a>');
							
								
							}
						});
						
				}  
				
    }
  function save_deleteconnect(id) {       
		
		  var isLogged = chilepro_data.current_user_id;
                               
                if (isLogged=="0") {                   
                     alert(chilepro_data.login_connect);
                } else { 
						
						var ajaxurl = chilepro_data.ajaxurl;
						var search_params={
							"action"  : 	"iv_directories_save_deleteconnect",	
							"data": "id=" + id,
						};
						
						jQuery.ajax({					
							url : ajaxurl,					 
							dataType : "json",
							type : "post",
							data : search_params,
							success : function(response){ 
								jQuery("#uouconnect").html('<a   href="javascript:;"  onclick="save_connect('+id+')" ><i class="fa fa-user-plus" ></i> '+chilepro_data.Connect+'</a>');
																
							}
						});
						
				}  
				
    }  
    function save_bookmark(id) {       
		
		  var isLogged = chilepro_data.current_user_id;
                               
                if (isLogged=="0") {                   
                     alert(chilepro_data.login_bookmark);
                } else { 
						
						var ajaxurl = chilepro_data.ajaxurl;
						var search_params={
							"action"  : 	"iv_directories_save_bookmark",	
							"data": "id=" + id,
						};
						
						jQuery.ajax({					
							url : ajaxurl,					 
							dataType : "json",
							type : "post",
							data : search_params,
							success : function(response){ 
							
							jQuery("#uoubookmark").html('<a href="javascript:;" class="blue-background" onclick="save_deletebookmark('+id+');" ><i class="fa fa-bookmark-o" ></i></a>');
								
							}
						});
						
				}  
				
    }
    function save_deletebookmark(id) {
		  var isLogged = chilepro_data.current_user_id;
                               
                if (isLogged=="0") {                   
                     alert(chilepro_data.login_bookmark);
                } else { 
						
						var ajaxurl = chilepro_data.ajaxurl;								
						var search_params={
							"action"  : 	"iv_directories_save_deletebookmark",	
							"data": "id=" + id,
						};
						
						jQuery.ajax({					
							url : ajaxurl,					 
							dataType : "json",
							type : "post",
							data : search_params,
							success : function(response){ 
								jQuery("#uoubookmark").html('<a href="javascript:;" onclick="save_bookmark('+id+');" ><i class="fa fa-bookmark-o" ></i></a>');
							
								
							}
						});
						
				}  
				
    }	
    function save_rating(user_id,rating_text,rating_value) {
		
		  var isLogged = chilepro_data.current_user_id;
                               
                if (isLogged=="0") {                   
                     alert(chilepro_data.login_bookmark);
                } else { 
						
						var ajaxurl = chilepro_data.ajaxurl;								
						var search_params={
							"action"  : 	"iv_directories_save_rating",	
							"data": "id=" + user_id+"&rating_text="+rating_text+"&rating_value="+rating_value,
						};
						
						jQuery.ajax({					
							url : ajaxurl,					 
							dataType : "json",
							type : "post",
							data : search_params,
							success : function(response){ 
								var ii=0;
								for(ii=0; ii<=5; ii++){									
									jQuery("#"+rating_text+"_"+ii).removeClass("fa-star");
									jQuery("#"+rating_text+"_"+ii).addClass("fa-star-o");									
								}	
								
								for(ii=0; ii<=rating_value; ii++){
									jQuery("#"+rating_text+"_"+ii).removeClass("fa-star-o");
									jQuery("#"+rating_text+"_"+ii).removeClass("fa-star");
									jQuery("#"+rating_text+"_"+ii).addClass("fa-star");	
								}	
								 
								
							}
						});
						
				}  
				
    }	    
    
	

(function($, window, document, undefined) {
    var slider = $('.cbp-slider');
    slider.find('.cbp-slider-item').addClass('cbp-item');
    slider.cubeportfolio({
        layoutMode: 'slider',
        mediaQueries: [{
            width: 1,
            cols: 1
        }],
        gapHorizontal: 0,
        gapVertical: 0,
        caption: '',
    });
})(jQuery, window, document);
(function($, window, document, undefined) {
    'use strict';
    // init cubeportfolio
    var singlePage = jQuery('#js-singlePage-container').children('div');
    jQuery('#js-grid-slider-projects').cubeportfolio({
        layoutMode: 'slider',
        drag: true,
        auto: false,
        autoTimeout: 4000,
        autoPauseOnHover: true,
        showNavigation: true,
        showPagination: true,
        rewindNav: false,
        scrollByPage: false,
        gridAdjustment: 'responsive',
        mediaQueries: [{
            width: 1500,
            cols: 5
        }, {
            width: 1100,
            cols: 4
        }, {
            width: 800,
            cols: 3
        }, {
            width: 480,
            cols: 2
        }, {
            width: 320,
            cols: 1
        }],
        gapHorizontal: 0,
        gapVertical: 25,
        caption: 'overlayBottomReveal',
        displayType: 'lazyLoading',
        displayTypeSpeed: 100,
        // lightbox
        lightboxDelegate: '.cbp-lightbox',
        lightboxGallery: true,
        lightboxTitleSrc: 'data-title',
        lightboxCounter: '<div class="cbp-popup-lightbox-counter">{{current}} of {{total}}</div>',
        // singlePage popup
        singlePageDelegate: '.cbp-singlePage',
        singlePageDeeplinking: true,
        singlePageStickyNavigation: true,
        singlePageCounter: '<div class="cbp-popup-singlePage-counter">{{current}} of {{total}}</div>',
        singlePageAnimation: 'fade',
        singlePageCallback: function(url, element) {
            // to update singlePage content use the following method: this.updateSinglePage(yourContent)
            var indexElement = $(element).parents('.cbp-item').index(),
                item = singlePage.eq(indexElement);
            this.updateSinglePage(item.html());},
    });
})(jQuery, window, document);

