<?php

wp_enqueue_style('wp-uou_tigerp-myaccount-style-11', wp_uou_tigerp_URLPATH . 'admin/files/css/iv-bootstrap.css');
wp_enqueue_script('uou_tigerp-myaccount-style-12', wp_uou_tigerp_URLPATH . 'admin/files/js/bootstrap.min.js');

wp_enqueue_style('wp-uou_tigerp-myaccount-style-13', wp_uou_tigerp_URLPATH . 'assets/css/copywriter-style.css');
wp_enqueue_style('wp-uou_tigerp-myaccount-style-14', wp_uou_tigerp_URLPATH . 'assets/css/corporate-style.css');
wp_enqueue_style('wp-uou_tigerp-myaccount-style-15', wp_uou_tigerp_URLPATH . 'assets/css/creative-style.css');
wp_enqueue_style('wp-uou_tigerp-myaccount-style-16', wp_uou_tigerp_URLPATH . 'assets/css/main-style.css');
wp_enqueue_style('wp-uou_tigerp-myaccount-style-17', wp_uou_tigerp_URLPATH . 'assets/css/user-public-profile.css');


//wp_enqueue_style('myaccount-style-12', tiger_CSS . 'my-account.css');

wp_enqueue_media();
global $current_user;

?>


    <?php
      global $current_user;
    
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
	$currency= get_option('_uou_tigerp_api_currency');

	$currency_symbol=(isset($currencies[$currency]) ? $currencies[$currency] :$currency );
	
	$iv_member_type=get_user_meta($current_user->ID,'iv_member_type',true);
	if ($iv_member_type==""){
		update_user_meta($current_user->ID,'iv_member_type','professional');	
	}
	$profile_name=get_user_meta($current_user->ID,'profile_name',true);
	if($profile_name==''){
		update_user_meta($current_user->ID,'profile_name',$current_user->user_login);
	}
	// for  social login empty status
	$tigerp_user_status= get_user_meta($current_user->ID, 'uou_tigerp_user_status', true);	
	if($tigerp_user_status==''){
		$setting_value_approve =get_option('_dir_approve_publish');	
		$user_status_new ='active';
		if($setting_value_approve ==""){
			$user_status_new='active';
		}else{
			if($setting_value_approve=='yes'){
				$user_status_new ='inactive';
			}
			if($setting_value_approve=='no'){
				$user_status_new ='active';
			}													
		}
		
		update_user_meta($current_user->ID, 'uou_tigerp_user_status', $user_status_new);
		
	}
	// End for  social login empty status
	
	//update_user_meta($current_user->ID, 'iv_profile_pic_url','');
	$iv_post='';
?>


<div class="compny-profile bootstrap-wrapper around-separetor">

  <!-- Profile Company Content -->
  <div class="profile-company-content has-bg-image" data-bg-color="">
    <div class="container">
      <div class="row">

        <!-- SIDE BAR -->
        <div class="col-md-4">
          <!-- Company Information -->
          <div class="sidebar my-accont">
            <h5 class="main-title"><?php echo get_user_meta($current_user->ID,'profile_name',true); ?> </h5>
            <div class="sidebar-thumbnail" id="profile_image_main">

				<?php	
				
				   		
				  	$iv_profile_pic_url=get_user_meta($current_user->ID, 'iv_profile_pic_url',true);
				  	if($iv_profile_pic_url!=''){ ?>
					 <img src="<?php echo $iv_profile_pic_url; ?>">
					<?php
					}else{						
						echo $avatar_img = get_avatar( $current_user->ID, 300 );  												
						preg_match("/src=['\"](.*?)['\"]/i", $avatar_img, $matches);						 						
						if($matches[1]!=''){
							update_user_meta($current_user->ID, 'iv_profile_pic_url',$matches[1]);
						}						
							
						//echo'	 <img src="'. tiger_IMAGE.'Blank-Profile.jpg'.'">';
					}
				  	?>

            </div>
             <div class="profile-userbuttons">
                <button type="button" onclick="edit_profile_image('profile_image_main');"  class="btn-new btn-custom"><?php esc_html_e('Change Image','tiger'); ?> </button>
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
			   if(isset($_GET['profile']) AND $_GET['profile']=='level' ){
				 $active='level';
			  }
			   if(isset($_GET['profile']) AND $_GET['profile']=='blog' ){
				 $active='add-news';
			  }
			  if(isset($_GET['profile']) AND $_GET['profile']=='all-blog' ){
				 $active='all-blog';
			  }
			   if(isset($_GET['profile']) AND $_GET['profile']=='blog-edit' ){
				 $active='All-blog';
			  }





				$post_type=  'directories';

			  ?>
                <ul class="nav">


				  <?php
					$account_menu_check= '';
					if( get_option( '_uou_tigerp_menunetwork' ) ) {
						 $account_menu_check= get_option('_uou_tigerp_menunetwork');
					}
					if($account_menu_check!='yes'){
					?>
					  <li class="<?php echo ($active=='network'? 'active':''); ?> ">
                    <a href="<?php echo get_permalink(); ?>?&profile=network">
                    <i class="fa fa-group"></i>
                    <?php  esc_html_e('Network','tiger');?> </a>
                  </li>
				  <?php
					}
				  ?>
				  <?php
					$account_menu_check= '';
					if( get_option( '_uou_tigerp_menuinterested' ) ) {
						 $account_menu_check= get_option('_uou_tigerp_menuinterested');
					}
					if($account_menu_check!='yes'){
					?>
				    <li class="<?php echo ($active=='bookmark'? 'active':''); ?> ">
                    <a href="<?php echo get_permalink(); ?>?&profile=bookmark">
                    <i class="fa fa-bookmark"></i>
                    <?php  esc_html_e('Bookmarks','tiger');?> </a>
                  </li>
				  <?php
					}
				  ?>

					
                  <?php
					$account_menu_check= '';
					if( get_option( '_uou_tigerp_mylevel' ) ) {
						 $account_menu_check= get_option('_uou_tigerp_mylevel');
					}
					if($account_menu_check!='yes'){
					?>
					  <li class="<?php echo ($active=='level'? 'active':''); ?> ">
						<a href="<?php echo get_permalink(); ?>?&profile=level">
						<i class="fa fa-plus-circle"></i>
						<?php esc_html_e('Upgrade','tiger');	 ?> </a>
					  </li>
					 <?php
					}
					?>
					
				 <li class="<?php echo ($active=='blog'? 'active':''); ?> ">
                    <a href="<?php echo get_permalink(); ?>?&profile=add-blog">
                    <i class="fa fa-cog"></i>
                    <?php  esc_html_e('Blog','tiger');?> </a>
                  </li>
					
				<li class="<?php echo ($active=='job'? 'active':''); ?> ">
                    <a href="<?php echo get_permalink(); ?>?&profile=add-job">
                    <i class="fa fa-cog"></i>
                    <?php  esc_html_e('Jobs','tiger');?> </a>
                  </li>	
					
				  <?php
					$account_menu_check= '';
					if( get_option( '_uou_tigerp_menusetting' ) ) {
						 $account_menu_check= get_option('_uou_tigerp_menusetting');
					}
					if($account_menu_check!='yes'){
					?>
                  <li class="<?php echo ($active=='setting'? 'active':''); ?> ">
                    <a href="<?php echo get_permalink(); ?>?&profile=setting">
                    <i class="fa fa-cog"></i>
                    <?php esc_html_e('Edit Profile','tiger');?> </a>
                  </li>
				  <?php
					}
				  ?>





			  <?php     $old_custom_menu = array();
							if(get_option('uou_tigerp_profile_menu')){
								$old_custom_menu=get_option('uou_tigerp_profile_menu' );
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
					<li>
						<?php
							$iv_member_type=get_user_meta($current_user->ID,'iv_member_type',true);
							if($iv_member_type=='corporate'){
								   $iv_redirect_user = get_option( '_iv_corporate_profile_public_page');
								    $reg_page_user= get_permalink( $iv_redirect_user) ;
							
							}else{
									$iv_redirect_user = get_option( '_iv_personal_profile_public_page');
								    $reg_page_user= get_permalink( $iv_redirect_user) ;
							  
							}	
						?>
						
						<a href="<?php echo $reg_page_user.'?&id='.$current_user->user_login; ?>" >
						<i class="fa fa-cog"></i>
						  <?php esc_html_e('View My Profile','tiger');?>
						 </a>
					 </li>

					<li class="<?php echo ($active=='log-out'? 'active':''); ?> ">
						<a href="<?php echo wp_logout_url( home_url() ); ?>" >
						<i class="fa fa-sign-out"></i>
						  <?php esc_html_e('Sign out','tiger');?>
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
			include(  wp_uou_tigerp_template. 'private-profile/profile-level-1.php');
		  }elseif(isset($_GET['profile']) AND $_GET['profile']=='network' ){
			include(  wp_uou_tigerp_template. 'private-profile/my-network.php');
		  }elseif(isset($_GET['profile']) AND $_GET['profile']=='bookmark' ){
			include(  wp_uou_tigerp_template. 'private-profile/bookmark.php');
		  }elseif(isset($_GET['profile']) AND $_GET['profile']=='add-blog' ){
			include(  wp_uou_tigerp_template. 'private-profile/add-blog.php');
		  }elseif(isset($_GET['profile']) AND $_GET['profile']=='blog-edit' ){
			include(  wp_uou_tigerp_template. 'private-profile/edit-blog.php');
		  }elseif(isset($_GET['profile']) AND $_GET['profile']=='add-job' ){
			include(  wp_uou_tigerp_template. 'private-profile/add-job.php');
		  }elseif(isset($_GET['profile']) AND $_GET['profile']=='job-edit' ){
			include(  wp_uou_tigerp_template. 'private-profile/edit-job.php');
		  }
		  
		  elseif(isset($_GET['profile']) AND $_GET['profile']=='setting' ){
				$iv_member_type=get_user_meta($current_user->ID,'iv_member_type',true);
				if($iv_member_type=='corporate'){
					include(  wp_uou_tigerp_template. 'private-profile/profile-setting-corporate.php');
				}else{
					//include(  wp_uou_tigerp_template. 'private-profile/profile-setting-corporate.php');
					include(  wp_uou_tigerp_template. 'private-profile/profile-setting-personal.php');
				 }

		  }
		  else{

			include(  wp_uou_tigerp_template. 'private-profile/my-network.php');
		  }


		  ?>
       </div>

      </div>
    </div>
  </div>
</div>




 <script>
 /*
jQuery(document).ready(function($) {
		jQuery('[href^=#tab]').click(function (e) {
		  e.preventDefault()
		 jQuery(this).tab('show')
		});
})
*/

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
								"action": 	"uou_tigerp_update_profile_pic",
								"attachment_thum": attachment.sizes.thumbnail.url,
								"profile_pic_url_1": attachment.url,
								"profile_pic_url_id": attachment.id,
							};
                             jQuery.ajax({
										url: ajaxurl,
										dataType: "json",
										type: "post",
										data: search_params,
										success: function(response) {
											if(response=='success'){

												jQuery('#'+profile_image_id).html('<img  class="sidebar-thumbnail"  src="'+attachment.sizes.thumbnail.url+'">');


											}

										}
									});

						}
					});

                });
				image_gallery_frame.open();

			}

 </script>


