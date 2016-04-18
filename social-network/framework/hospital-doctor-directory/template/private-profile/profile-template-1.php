<?php

wp_enqueue_style('wp-iv_directories-myaccount-style-11', wp_iv_directories_URLPATH . 'admin/files/css/iv-bootstrap.css');
wp_enqueue_script('iv_directories-myaccount-style-12', wp_iv_directories_URLPATH . 'admin/files/js/bootstrap.min.js');

wp_enqueue_style('wp-iv_directories-myaccount-style-13', wp_iv_directories_URLPATH . 'assets/css/copywriter-style.css');
wp_enqueue_style('wp-iv_directories-myaccount-style-14', wp_iv_directories_URLPATH . 'assets/css/corporate-style.css');
wp_enqueue_style('wp-iv_directories-myaccount-style-15', wp_iv_directories_URLPATH . 'assets/css/creative-style.css');
wp_enqueue_style('wp-iv_directories-myaccount-style-16', wp_iv_directories_URLPATH . 'assets/css/main-style.css');
wp_enqueue_style('wp-iv_directories-myaccount-style-17', wp_iv_directories_URLPATH . 'assets/css/user-public-profile.css');


//wp_enqueue_style('myaccount-style-12', SB_CSS . 'my-account.css');

wp_enqueue_media(); 
global $current_user;
   
?>


    <?php
      global $current_user;
      get_currentuserinfo();
	  //print_r($current_user);
	  $currencies = array();
	$currencies['AUD'] ='$';$currencies['CAD'] ='$';
	$currencies['EUR'] ='€';$currencies['GBP'] ='£';
	$currencies['JPY'] ='¥';$currencies['USD'] ='$';
	$currencies['NZD'] ='$';$currencies['CHF'] ='Fr';
	$currencies['HKD'] ='$';$currencies['SGD'] ='$';
	$currencies['SEK'] ='kr';$currencies['DKK'] ='kr';
	$currencies['PLN'] ='zł';$currencies['NOK'] ='kr';
	$currencies['HUF'] ='Ft';$currencies['CZK'] ='Kč';
	$currencies['ILS'] ='₪';$currencies['MXN'] ='$';
	$currencies['BRL'] ='R$';$currencies['PHP'] ='₱';
	$currencies['MYR'] ='RM';$currencies['AUD'] ='$';
	$currencies['TWD'] ='NT$';$currencies['THB'] ='฿';	
	$currencies['TRY'] ='TRY';	$currencies['CNY'] ='¥';	
	$currency= get_option('_iv_directories_api_currency');
	
	$currency_symbol=(isset($currencies[$currency]) ? $currencies[$currency] :$currency );
      ?>


<div class="compny-profile bootstrap-wrapper around-separetor"> 
  
  <!-- Profile Company Content -->
  <div class="profile-company-content has-bg-image" data-bg-color="f5f5f5">
    <div class="container">
      <div class="row"> 
        
        <!-- SIDE BAR -->
        <div class="col-md-4"> 
          <!-- Company Information -->
          <div class="sidebar">
            <h5 class="main-title">Mike Tomlinson</h5>
            <div class="sidebar-thumbnail" id="profile_image_main"> 
				
				<?php
				  	$iv_profile_pic_url=get_user_meta($current_user->ID, 'iv_profile_pic_thum',true);
				  	if($iv_profile_pic_url!=''){ ?>
					 <img src="<?php echo $iv_profile_pic_url; ?>">
					<?php
					}else{
					 echo'	 <img src="'. wp_iv_directories_URLPATH.'assets/images/Blank-Profile.jpg">';
					}
				  	?>
            
            </div>
             <div class="profile-userbuttons">
                <button type="button" onclick="edit_profile_image('profile_image_main');"  class="btn-new btn-custom"><?php esc_html_e('Change Image','chilepro'); ?> </button>
              </div>
            <div class="sidebar-information">
                <div class="profile-usermenu">
			  <?php
			  $active='network';
			  
			  if(isset($_GET['profile']) AND $_GET['profile']=='setting' ){
				 $active='setting';
			  }
					  
			  if(isset($_GET['profile']) AND $_GET['profile']=='network' ){
				 $active='network';
			  }
			  if(isset($_GET['profile']) AND $_GET['profile']=='bookmark' ){
				 $active='bookmark';
			  }
			  
			  
			  

				
				$post_type=  'directories';
						
			  ?>
                <ul class="nav">
					
				    
				  <?php
					$account_menu_check= '';
					if( get_option( '_iv_directories_menunetwork' ) ) {
						 $account_menu_check= get_option('_iv_directories_menunetwork');
					}
					if($account_menu_check!='yes'){					
					?>
					  <li class="<?php echo ($active=='network'? 'active':''); ?> ">
                    <a href="<?php echo get_permalink(); ?>?&profile=network">
                    <i class="fa fa-heart-o"></i>
                    <?php  esc_html_e('Network','chilepro');?> </a>
                  </li>
				  <?php
					}
				  ?>
				  <?php
					$account_menu_check= '';
					if( get_option( '_iv_directories_menuinterested' ) ) {
						 $account_menu_check= get_option('_iv_directories_menuinterested');
					}
					if($account_menu_check!='yes'){					
					?>
				    <li class="<?php echo ($active=='who-is-interested'? 'active':''); ?> ">
                    <a href="<?php echo get_permalink(); ?>?&profile=who-is-interested">
                    <i class="fa fa-group"></i>
                    <?php  esc_html_e('Bookmarks','chilepro');?> </a>
                  </li>
				  <?php
					}
				  ?>
				  
					<!--
                  <?php
					$account_menu_check= '';
					if( get_option( '_iv_directories_mylevel' ) ) {
						 $account_menu_check= get_option('_iv_directories_mylevel');
					}
					if($account_menu_check!='yes'){					
					?>
					  <li class="<?php echo ($active=='level'? 'active':''); ?> ">
						<a href="<?php echo get_permalink(); ?>?&profile=level">
						<i class="fa fa-plus-circle"></i>
						<?php esc_html_e('Upgrade My Account','chilepro');	 ?> </a>
					  </li>
					 <?php
					}
					?>
					-->
				  <?php
					$account_menu_check= '';
					if( get_option( '_iv_directories_menusetting' ) ) {
						 $account_menu_check= get_option('_iv_directories_menusetting');
					}
					if($account_menu_check!='yes'){					
					?>
                  <li class="<?php echo ($active=='setting'? 'active':''); ?> ">
                    <a href="<?php echo get_permalink(); ?>?&profile=setting">
                    <i class="fa fa-cog"></i>
                    <?php esc_html_e('Edit Profile','chilepro');?> </a>
                  </li>
				  <?php
					}
				  ?>
				  
				 
				 
				 
					
			  <?php     $old_custom_menu = array();
							if(get_option('iv_directories_profile_menu')){
								$old_custom_menu=get_option('iv_directories_profile_menu' );
							}
							$ii=1;		
							if($old_custom_menu!=''){
								foreach ( $old_custom_menu as $field_key => $field_value ) { ?>
									
									  <li class="">
											<a href="<?php echo $field_value; ?>">
												<i class="fa fa-cog"></i>
											 <?php echo $field_key;?> </a>
									  </li>
								
								<?php
								}
							}	
									
                  
					?>                  
					<li class="<?php echo ($active=='log-out'? 'active':''); ?> ">
						<a href="<?php echo wp_logout_url( home_url() ); ?>" >
						<i class="fa fa-sign-out"></i>
						  <?php esc_html_e('Sign out','chilepro');?> 
						 </a>
					 </li>
                    
				
                </ul>
              </div>
             
             
         
            </div>
          </div>
        </div>
       <div class="col-md-8">
        <!-- Tab Content -->
       <?php
		  if(isset($_GET['profile']) AND $_GET['profile']=='level' ){
			include(  wp_iv_directories_template. 'private-profile/profile-level-1.php');
		  }elseif(isset($_GET['profile']) AND $_GET['profile']=='network' ){ 		    
			include(  wp_iv_directories_template. 'private-profile/my-network.php');
		  }elseif(isset($_GET['profile']) AND $_GET['profile']=='who-is-interested' ){ 		    
			include(  wp_iv_directories_template. 'private-profile/interested-1.php');
		  }elseif(isset($_GET['profile']) AND $_GET['profile']=='setting' ){ 		
				$iv_member_type=get_user_meta($current_user->ID,'iv_member_type',true);     
				if($iv_member_type=='corporate'){
					include(  wp_iv_directories_template. 'private-profile/profile-setting-corporate.php');
				}else{
					//include(  wp_iv_directories_template. 'private-profile/profile-setting-corporate.php');
					include(  wp_iv_directories_template. 'private-profile/profile-setting-personal.php');
				 } 
			
		  }
		  else{ 		 
			
			include(  wp_iv_directories_template. 'private-profile/my-network.php');
		  }
		  
		  
		  ?>
       </div>
      
      </div>
    </div>
  </div>
</div>
 



 <script>
jQuery(document).ready(function($) {
		jQuery('[href^=#tab]').click(function (e) {
		  e.preventDefault()
		 jQuery(this).tab('show')
		});
})	
	
			  
			  function edit_profile_image(profile_image_id){	
				var image_gallery_frame;

               // event.preventDefault();
                image_gallery_frame = wp.media.frames.downloadable_file = wp.media({
                    // Set the title of the modal.
                    title: '<?php esc_html_e( 'Profile Image', 'easy-image-gallery' ); ?>',
                    button: {
                        text: '<?php esc_html_e( 'Profile Image', 'easy-image-gallery' ); ?>',
                    },
                    multiple: false,
                    displayUserSettings: true,
                });                
                image_gallery_frame.on( 'select', function() {
                    var selection = image_gallery_frame.state().get('selection');
                    selection.map( function( attachment ) {
                        attachment = attachment.toJSON();
                        if ( attachment.id ) {
							//console.log(attachment.sizes.thumbnail.url);
							var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
							var search_params = {
								"action": 	"iv_directories_update_profile_pic",
								"attachment_thum": attachment.sizes.thumbnail.url,
								"profile_pic_url_1": attachment.url,
							};
                             jQuery.ajax({
										url: ajaxurl,
										dataType: "json",
										type: "post",
										data: search_params,
										success: function(response) {   
											if(response=='success'){					
												
												jQuery('#'+profile_image_id).html('<img  class="img-circle img-responsive"  src="'+attachment.sizes.thumbnail.url+'">');                              
						

											}
											
										}
									});									
                              
						}
					});
                   
                });               
				image_gallery_frame.open(); 
				
			}
		
 </script>	  

		
