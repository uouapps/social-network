<?php
/**
 * Template Name: Professional Profile Template
 *
 */
 ?>
<?php get_header();
 if(defined('wp_uou_tigerp_URLPATH')){
	wp_enqueue_style('uou_tigerp-style-71', wp_uou_tigerp_URLPATH . 'assets/cube/css/cubeportfolio.css');
 }
wp_enqueue_style('Company-Profile-style', tiger_CSS.'user-public-profile.css', array(), $ver = false, $media = 'all');
$display_name='';
$email='';
$user_id=1;
 global $current_user;




 if(isset($_REQUEST['id'])){
	   $author_name= $_REQUEST['id'];
		$user = get_user_by( 'slug', $author_name );
	if(isset($user->ID)){
		$user_id=$user->ID;
		$display_name=$user->display_name;
		$email=$user->user_email;
	}
  }else{

	  $user_id=$current_user->ID;
	  $display_name=$current_user->display_name;
	  $email=$current_user->user_email;
	  if($user_id==0){
		$user_id=1;
	  }
  }
	$tigerp_user_status = get_user_meta($user_id, 'uou_tigerp_user_status', true);
	if($tigerp_user_status!='active'){ 
		if($user_id!=$current_user->ID ){
			 include( get_query_template( '404' ) );
			 header('HTTP/1.0 404 Not Found');
            exit; 
		}

	}
  
   $iv_profile_pic_url=get_user_meta($user_id, 'iv_profile_pic_url',true);

	$lat=get_user_meta($user_id,'latitude',true);
	$lng=get_user_meta($user_id,'longitude',true);

	// Get latlng from address* START********
	$dir_lat=$lat;
	$dir_lng=$lng;
	$address = get_user_meta($user_id,'address',true);
	
?>

<div id="">
  <div class="compny-profile">
    <!-- SUB Banner -->
     <?php $top_banner_image= get_user_meta($user_id,'top_banner_image_id',true);

     if(get_user_meta($user_id,'top_banner_image_id',true)!=""){?>
		  
		    <div  class="profile-bnr user-profile-bnr" style="background:url(<?php echo wp_get_attachment_url( $top_banner_image ); ?>) no-repeat; background-size:cover;">
	 <?php
	 }else{?>
		 
		   <div  class="profile-bnr user-profile-bnr" style="background:url(<?php echo tiger_IMAGE."user-bg.jpg";?>) no-repeat; background-size:cover;">
	 <?php
	 }

     ?>
   
    
    
    
      <div class="container">
        <div class="pull-left">
          <h2><?php echo get_user_meta($user_id,'profile_name',true); ?></h2>
          <h5> <?php echo get_user_meta($user_id,'designation',true);   ?></h5>
        </div>

        <!-- Top Riht Button -->
         <div class="right-top-bnr">
          <div class="connect">
			  <span id="uouconnect"  >
						<?php
						$current_user_ID = $current_user->ID;
						if($current_user_ID>0){
							$my_connect = get_user_meta($current_user_ID,'_my_connect',true);
							$all_users = explode(",", $my_connect);

							if (in_array($user_id, $all_users)) { ?>
									<a  class="blue-background" title="<?php esc_html_e('Added to Connection','tiger'); ?>"  href="javascript:;" onclick="save_deleteconnect('<?php echo $user_id; ?>')" ><i class="fa fa-user-plus" ></i> <?php  esc_html_e('Connected','tiger');?></a>
							<?php
							}else{ ?>
								<a    title="<?php esc_html_e('Add to Connection','tiger'); ?>"  href="javascript:;" onclick="save_connect('<?php echo $user_id; ?>')" ><i class="fa fa-user-plus" ></i> <?php  esc_html_e('Connect','tiger');?></a>
							<?php
							}
						}else{ ?>
									<a    title="<?php esc_html_e('Add to Connection','tiger'); ?>"  href="javascript:;" onclick="save_connect('<?php echo $user_id; ?>')" ><i class="fa fa-user-plus" ></i> <?php  esc_html_e('Connect','tiger');?></a>
					<?php
						}
					?>


			  </span>
			   <a href="#." data-toggle="modal" data-target="#modal-share"><i class="fa fa-share-alt"></i> <?php  esc_html_e('Share','tiger');?></a>

            <div class="bt-ns">
				<span id="uoufollow"  >

					<?php
						$current_user_ID = $current_user->ID;
						if($current_user_ID>0){
							 $my_connect = get_user_meta($current_user_ID,'_following',true);
							$all_users = explode(",", $my_connect);

							if (in_array($user_id, $all_users)) { ?>
									 <a class="blue-background"  href="javascript:;" title="<?php esc_html_e('Following','tiger'); ?>" onclick="save_unfollow('<?php echo $user_id; ?>')"><i class="fa fa fa-eye"></i> </a>
							<?php
							}else{ ?>
								 <a href="javascript:;" title="<?php esc_html_e('Add to Follow','tiger'); ?>" onclick="save_follow('<?php echo $user_id; ?>')"><i class="fa fa fa-eye"></i> </a>

							<?php
							}
						}else{ ?>
								<a href="javascript:;" title="<?php esc_html_e('Add to Follow','tiger'); ?>" onclick="save_follow('<?php echo $user_id; ?>')"><i class="fa fa fa-eye"></i> </a>

					<?php
						}
					?>

				 </span>
				 <span id="uoubookmark"  >
					 <?php
						$current_user_ID = $current_user->ID;
						if($current_user_ID>0){
							 $my_connect = get_user_meta($current_user_ID,'_my_bookmark',true);
							$all_users = explode(",", $my_connect);

							if (in_array($user_id, $all_users)) { ?>
										<a class="blue-background"  href="javascript:;" title="<?php esc_html_e('Added to Bookmark','tiger'); ?>" onclick="save_deletebookmark('<?php echo $user_id; ?>')"><i class="fa fa-bookmark-o"></i> </a>

							<?php
							}else{ ?>
									<a href="javascript:;" title="<?php esc_html_e('Add to Bookmark','tiger'); ?>" onclick="save_bookmark('<?php echo $user_id; ?>')"><i class="fa fa-bookmark-o"></i> </a>


							<?php
							}
						}else{ ?>
									<a href="javascript:;" title="<?php esc_html_e('Add to Bookmark','tiger'); ?>" onclick="save_bookmark('<?php echo $user_id; ?>')"><i class="fa fa-bookmark-o"></i> </a>


					<?php
						}
					?>
				</span>
				<a title="<?php esc_html_e('Contact','tiger'); ?>"  href="#." data-toggle="modal" data-target="#modal-contact"><i class="fa fa-envelope-o"></i> </a> 
				<a title="<?php esc_html_e('Report the profile','tiger'); ?>" href="#." data-toggle="modal" data-target="#modal-claim"><i class="fa fa-exclamation"></i> </a>
           </div>
          </div>
        </div>


      </div>

      <!-- Modal contact POPUP -->
      <div class="modal fade" id="modal-contact" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="container">
              <h6><a class="close" href="#." data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></a> <?php  esc_html_e('Send Message','tiger');?></h6>

              <!-- Forms -->
              <form name="message-modal" id="message-modal" method="POST" >
                <ul class="row">
                  <li class="col-xs-6">
                    <input name ="contact_name" id="contact_name"  type="text" placeholder="<?php  esc_html_e('Name & Surname','tiger');?>">
                  </li>

                  <li class="col-xs-6">
                    <input name ="email_address" id="email_address"  type="text" placeholder="<?php  esc_html_e('E-mail address','tiger');?>">
                  </li>
                  <li class="col-xs-12">
                    <textarea name="message-content" id="message-content"  placeholder="<?php  esc_html_e('Your Message','tiger');?>"></textarea>
                  </li>
                  <li class="col-xs-12">
				  <input type="hidden" name="profile_user" id="profile_user" value="<?php echo $user_id; ?>">
                    <button class="btn btn-primary" onclick="modal_send_message_iv();return false;"><?php  esc_html_e('Send message','tiger');?></button>
					<div class="btn pull-right" id="update_message_modal"> </div>
                  </li>
                </ul>

              </form>
            </div>
          </div>
        </div>
      </div>
	 <!-- Modal Claim POPUP -->
      <div class="modal fade" id="modal-claim" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="container">
              <h6><a class="close" href="#." data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></a> <?php  esc_html_e('Report','tiger');?></h6>

              <!-- Forms -->
              <form id="message-claim" name="message-claim"  method="POST">
                <ul class="row">
                  <li class="col-xs-6">
					<input id="subject" name ="subject" type="text" placeholder="Enter Subject" Value="<?php esc_html_e('Report The Listing', 'ivproperty' ); ?>" >
                  </li>

                  <li class="col-xs-6">
                    <input name ="email_address" id="email_address"  type="text" placeholder="<?php  esc_html_e('E-mail address','tiger');?>">
                  </li>
                  <li class="col-xs-12">
                    <textarea name="message-content" id="message-content"  placeholder="<?php  esc_html_e('Your Message','tiger');?>"></textarea>
                  </li>
                  <li class="col-xs-12">
                    <button class="btn btn-primary" onclick="send_message_claim();return false;"><?php  esc_html_e('Send message','tiger');?></button>
					<div class="btn pull-right" id="update_message_claim"> </div>
                  </li>
                </ul>
              </form>
            </div>
          </div>
        </div>
      </div>

   <!-- Modal Share POPUP -->
      <div class="modal fade" id="modal-share" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="container">
              <h6><a class="close" href="#." data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></a> <?php  esc_html_e('Share the profile','tiger');?></h6>

              <!-- Forms -->

                <div class="row">
				 <div class="col-xs-12 col-md-3">
				 </div>
                  <div class="col-xs-12 col-md-6">
				   <div class="social-links">
					   
						<a class="col-md-3 " href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?><?php echo '&id='.$author_name;  ?>"><i class="fa fa-facebook"></i> <?php  esc_html_e('Facebook','tiger');?></a>
						<a class="col-md-3 " href="https://twitter.com/home?status=<?php the_permalink(); ?><?php echo '&id='.$author_name;  ?>"><i class="fa fa-twitter"></i> <?php  esc_html_e('Twitter','tiger');?></a>
					    <a class="col-md-3 " href="https://plus.google.com/share?url=<?php the_permalink(); ?><?php echo '&id='.$author_name;  ?>"><i class="fa fa-google"></i> <?php  esc_html_e('Google+','tiger');?></a>
						<a class="col-md-3 "  href="https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?><?php echo '&id='.$author_name;  ?>"><i class="fa fa-linkedin"></i> <?php  esc_html_e('Linkedin','tiger');?></a>
					</div>
                  </div>
				  <div class="col-xs-12 col-md-3">
				 </div>

                </div>

            </div>
          </div>
        </div>
      </div>


    </div>

    <!-- Profile Company Content -->
    <div class="profile-company-content has-bg-image user-profile">
      <div class="container">
        <div class="row">
			 <!-- Nav Tabs -->
			    <div class="col-md-12">
				<ul class="nav nav-tabs">
				  <li class="active"><a data-toggle="tab" href="#profile"><?php  esc_html_e('Profile','tiger');?></a></li>
				  <li><a data-toggle="tab" href="#jobs"><?php  esc_html_e('Jobs','tiger');?></a></li>
				  <li><a data-toggle="tab" href="#blog"><?php  esc_html_e('Blog Post','tiger');?></a></li>
				  <li><a data-toggle="tab" href="#contact"><?php  esc_html_e('Contact','tiger');?></a></li>
				</ul>
			  </div>

          <!-- Tab Content -->
          <div class="col-md-12">
            <div class="tab-content">

              <!-- PROFILE -->
              <div id="profile" class="tab-pane fade in active">
                <div class="row">
                  <div class="col-md-12">
                    <div class="profile-main">
                      <h3><?php  esc_html_e('About','tiger');?> </h3>
                      <div class="profile-in">
                        <div class="media-left">
                          <div class="img-profile">
							<?php
						if($iv_profile_pic_url!=''){ ?>
						 <img class="media-object"  src="<?php echo $iv_profile_pic_url; ?>">
						<?php
						}else{
						 echo'	 <img class="media-object"  src="'. tiger_IMAGE.'Blank-Profile.jpg" >';
						}
						?>

							    </div>
                        </div>
                        <div class="media-body">
                          <?php echo get_user_meta($user_id,'about_us',true); ?>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-8">

                    <!-- Skills -->
                    <div class="sidebar">
                      <h5 class="main-title"><?php esc_html_e('Skills','tiger'); ?></h5>
                      <div class="job-skills">

                           <?php	$aw=0;
							   for($i=0;$i<20;$i++){

								   if(get_user_meta($user_id,'_service_title_'.$i,true)!='' || get_user_meta($user_id,'_service_value'.$i,true) ){?>


											 <ul class="row">
											  <li class="col-sm-3">
												<h6><i class="fa fa-plus"></i> <?php echo get_user_meta($user_id,'_service_title_'.$i,true); ?></h6>
											  </li>
											  <li class="col-sm-9">
												<div class="progress">
												  <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo get_user_meta($user_id,'_service_value_'.$i,true); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo get_user_meta($user_id,'_service_value_'.$i,true); ?>%;"> </div>
												</div>
												<p><?php echo get_user_meta($user_id,'_service_description_'.$i,true); ?></p>
											  </li>
											</ul>


								<?php
									}
								}
								?>



                      </div>
                    </div>

                    <!-- Professional Details -->
                    <div class="sidebar">
                      <h5 class="main-title"><?php esc_html_e('Similar Professionals','tiger'); ?> </h5>
                      <div class="similar">
                      <?php
                      $connection_type=get_user_meta($user_id,'iv_member_type',true);
                       $args = array();
				      $args['number']='3';
					  if($connection_type=='professional'){

									$args['meta_query']=array(
										'relation' => 'AND',
											array(
												'key'     => 'iv_member_type',
												'value'   => 'professional',
												'compare' => '='
											),
											array(
												'key' => 'uou_tigerp_user_status',
												'value' => 'active',
												'compare' => '=',
												
											)

									);
						}else{
							$args['meta_query']=array(
										'relation' => 'AND',
											array(
												'key'     => 'iv_member_type',
												'value'   => 'corporate',
												'compare' => '='
											),
											array(
												'key' => 'uou_tigerp_user_status',
												'value' => 'active',
												'compare' => '=',
												
											)

									);
						}
					  $args['exclude']=array($user_id);
                      $user_query = new WP_User_Query( $args );
						$reg_page_user='';

						if($connection_type=='corporate'){
							$iv_redirect_user = get_option( '_iv_corporate_profile_public_page');
							$reg_page_user= get_permalink( $iv_redirect_user) ;
						}else{
							$iv_redirect_user = get_option( '_iv_personal_profile_public_page');
							$reg_page_user= get_permalink( $iv_redirect_user) ;
						}
				        // User Loop
				        if ( ! empty( $user_query->results ) ) {
				        	foreach ( $user_query->results as $user ) {
								$iv_profile_pic_url='';
								 $iv_profile_pic_url=get_user_meta($user->ID, 'iv_profile_pic_thum',true);
								?>
								 <div class="media">
									  <div class="media-left">
										<div class="inn-simi">

											<a class="profile-img" href="<?php echo $reg_page_user.'?&id='.$user->user_login; ?>">
											<?php
												if($iv_profile_pic_url!=''){ ?>
												 <img class="media-object"  src="<?php echo $iv_profile_pic_url; ?>">
												<?php
												}else{
												 echo'	 <img class="media-object" src="'. tiger_IMAGE.'Blank-Profile.jpg" >';
												}
												?>
											</a>
										<a href="<?php echo $reg_page_user.'?&id='.$user->user_login; ?>">
										<?php esc_html_e('Profile','tiger'); ?>  </a>

										</div>

									  </div>
									  <div class="media-body">
										<h5><?php echo get_user_meta($user->ID,'profile_name',true); ?> </h5>
										<p><?php echo get_user_meta($user->ID,'designation',true);   ?>  <?php echo '-'.get_user_meta($user->ID,'address',true); ?> </p>
										<p><?php $content = get_user_meta($user->ID,'about_us',true);
											$content = str_replace( ']]>', ']]&gt;', $content );
											echo substr($content ,0,100);

										?>

										</p>

										<!-- Share -->
										<div class="share-w">
											<span id="s_following_<?php echo $user->ID; ?>">
											<?php
												$current_user_ID = $current_user->ID;
												if($current_user_ID>0){
													 $my_connect = get_user_meta($current_user_ID,'_following',true);
													$all_users = explode(",", $my_connect);

													if (in_array($user->ID, $all_users)) { ?>
															 <a class="gray-background"  href="javascript:;" title="<?php esc_html_e('Following','tiger'); ?>" onclick="similar_save_unfollow('<?php echo $user->ID; ?>')"><i class="fa fa fa-eye"></i> </a>
													<?php
													}else{ ?>
														 <a href="javascript:;" title="<?php esc_html_e('Add to Follow','tiger'); ?>" onclick="similar_save_follow('<?php echo $user->ID; ?>')"><i class="fa fa fa-eye"></i> </a>

													<?php
													}
												}else{ ?>
														<a href="javascript:;" title="<?php esc_html_e('Add to Follow','tiger'); ?>" onclick="similar_save_follow('<?php echo $user->ID; ?>')"><i class="fa fa fa-eye"></i> </a>

											<?php
												}
											?>
											</span>
											<span id="s_bookmark_<?php echo $user->ID; ?>">
											 <?php
												$current_user_ID = $current_user->ID;
												if($current_user_ID>0){
													 $my_connect = get_user_meta($current_user_ID,'_my_bookmark',true);
													$all_users = explode(",", $my_connect);

													if (in_array($user->ID, $all_users)) { ?>
																<a class="gray-background"  href="javascript:;" title="<?php esc_html_e('Added to Bookmark','tiger'); ?>" onclick="similar_save_deletebookmark('<?php echo $user->ID; ?>')"><i class="fa fa-bookmark-o"></i> </a>

													<?php
													}else{ ?>
															<a href="javascript:;" title="<?php esc_html_e('Add to Bookmark','tiger'); ?>" onclick="similar_save_bookmark('<?php echo $user->ID; ?>')"><i class="fa fa-bookmark-o"></i> </a>


													<?php
													}
												}else{ ?>
															<a href="javascript:;" title="<?php esc_html_e('Add to Bookmark','tiger'); ?>" onclick="similar_save_bookmark('<?php echo $user->ID; ?>')"><i class="fa fa-bookmark-o"></i> </a>


											<?php
												}
											?>
											</span>
												<span id="s_connection_<?php echo $user->ID; ?>">
												 <?php
														$current_user_ID = $current_user->ID;
														if($current_user_ID>0){
															$my_connect = get_user_meta($current_user_ID,'_my_connect',true);
															$all_users = explode(",", $my_connect);

															if (in_array($user->ID, $all_users)) { ?>
																		<a class="gray-background"  href="javascript:;" title="<?php esc_html_e('Added to Connection','tiger'); ?>" onclick="similar_save_deleteconnect('<?php echo $user->ID; ?>')"><i class="fa fa-user-plus"></i> </a>

															<?php
															}else{ ?>
																	<a href="javascript:;" title="<?php esc_html_e('Add to Connection','tiger'); ?>" onclick="similar_save_connect('<?php echo $user->ID; ?>')"><i class="fa fa-user-plus"></i> </a>


															<?php
															}
														}else{ ?>
																	<a href="javascript:;" title="<?php esc_html_e('Add to Connection','tiger'); ?>" onclick="similar_save_connect('<?php echo $user->ID; ?>')"><i class="fa fa-user-plus"></i> </a>


													<?php
														}
													?>

												</span>
											</div>
									  </div>
									</div>

							<?php
							}
						}

                      ?>

                      </div>
                    </div>
                
                  </div>

                  <!-- Col -->
                  <div class="col-md-4">

                    <!-- Professional Details -->
                    <div class="sidebar">
                      <h5 class="main-title"><?php  esc_html_e('Professional Details','tiger');?> </h5>
                      <div class="sidebar-information">

						    <?php
								$i=1;$default_fields='';
								$field_set=get_option('iv_social_profile_personal_fields' );
								if($field_set!=""){
										$default_fields=get_option('iv_social_profile_personal_fields' );
								}else{
										$default_fields['Age']=esc_html__('Age','tiger');
										$default_fields['Location']=esc_html__('Location','tiger');
										$default_fields['Experiance']=esc_html__('Experiance','tiger');
										$default_fields['Dgree']=esc_html__('Dgree','tiger');
										$default_fields['Career-Lavel']=esc_html__('Career Lavel','tiger');
										$default_fields['Phone']=esc_html__('Phone','tiger');								
										$default_fields['Fax']=esc_html__('Fax','tiger');	
										$default_fields['E-mail']=esc_html__('E-mail','tiger');
										$default_fields['web_site']=esc_html__('Website Url','tiger');
								}
								if(sizeof($default_fields)>0){ 								
										?>
									<ul class="single-category">
											<li class="row">
											<h6 class="title col-xs-6"><?php echo 'Name'; ?></h6>
											<span class="subtitle col-xs-6"><?php echo get_user_meta($user_id,'profile_name',true); ?></span>
											</li>
									<?php
									foreach ( $default_fields as $field_key => $field_value ) {
										$field_value_trim=trim($field_value);											
										?>
										<li class="row">
										<h6 class="title col-xs-6"><?php echo $field_value_trim; ?></h6>
										<span class="subtitle col-xs-6"><?php echo '  '.get_user_meta($user_id,$field_key,true); ?></span>
										</li>
									<?php
									}
									?>
								</ul>
								<?php
								}
								?>


                      </div>
                    </div>

                    <!-- Rating -->
                    <div class="sidebar">
                      <h5 class="main-title"><?php  esc_html_e('Rating','tiger');?></h5>
                      <div class="sidebar-information">
                        <ul class="single-category com-rate">
					<?php
					$i=1;$default_fields='';
					$field_set=get_option('iv_social_profile_personal_fields_review' );
					if($field_set!=""){
							$default_fields=get_option('iv_social_profile_personal_fields_review' );
					}else{
							$default_fields['Expertise']=esc_html__('Expertise','tiger');
							$default_fields['Knowledge']=esc_html__('Knowledge','tiger');
							$default_fields['Quality']=esc_html__('Quality','tiger');
							$default_fields['Price']=esc_html__('Price','tiger');
							$default_fields['Services']=esc_html__('Services','tiger');
					}
					if(sizeof($default_fields)>0){ 	?>

						<?php
						foreach ( $default_fields as $field_key => $field_value ) {
								
							$field_value_trim=trim($field_value);
							$old_rating= get_user_meta($user_id,$field_key.'_rating',true);
							$key_total_count= get_user_meta($user_id,$field_key.'_count',true);	
							if($key_total_count<1){$key_total_count=1;}
							$old_rating=$old_rating/$key_total_count;
							?>
							<li class="row">
							<h6 class="title col-xs-6"><?php echo $field_value_trim; ?></h6>
							 <span class="col-xs-6">
							 <a  href="javascript:;"  onclick="save_rating('<?php echo $user_id; ?>','<?php echo $field_key; ?>','1')" >
							 <i  id="<?php echo $field_key ?>_1" class="uourating fa fa-star<?php echo($old_rating>=1 ? '':'-o'); ?>"></i></a>

							 <a  href="javascript:;"  onclick="save_rating('<?php echo $user_id; ?>','<?php echo $field_key; ?>','2')" >
							 <i id="<?php echo $field_key ?>_2"  class="uourating fa fa-star<?php echo($old_rating>=2 ? '':'-o'); ?>"></i></a>

							 <a  href="javascript:;"  onclick="save_rating('<?php echo $user_id; ?>','<?php echo $field_key; ?>','3')" >
							 <i id="<?php echo $field_key ?>_3"  class="uourating fa fa-star<?php echo($old_rating>=3 ? '':'-o'); ?>"></i></a>

							 <a  href="javascript:;" onclick="save_rating('<?php echo $user_id; ?>','<?php echo $field_key; ?>','4')" >
							 <i id="<?php echo $field_key ?>_4"  class="uourating fa fa-star<?php echo($old_rating>=4 ? '':'-o'); ?>"></i></a>

							 <a  href="javascript:;" onclick="save_rating('<?php echo $user_id; ?>','<?php echo $field_key; ?>','5')" >
							 <i id="<?php echo $field_key ?>_5" class="uourating fa fa-star<?php echo($old_rating>=5 ? '':'-o'); ?>"></i></a>



							 </span>

							</li>
						<?php
						}
						?>

					<?php
					}
					?>
                </ul>
                      </div>
                    </div>

                    <!-- Social Profiles -->
                    <div class="sidebar">
                      <h5 class="main-title"><?php  esc_html_e('Social Profiles','tiger');?></h5>
                      <ul class="socil">
						   <?php
								if(get_user_meta($user_id,'facebook',true)!=""){ ?>
							  <li> <a href="<?php echo get_user_meta($user_id,'facebook',true); ?>"><i class="fa fa-facebook"></i></a></li>
							   <?php
								}
							   ?>
								<?php
								if(get_user_meta($user_id,'twitter',true)!=""){ ?>
							  <li> <a href="<?php echo get_user_meta($user_id,'twitter',true); ?>"><i class="fa fa-twitter"></i></a></li>
							   <?php
								}
							   ?>
								  <?php
								if(get_user_meta($user_id,'gplus',true)!=""){ ?>
							   <li><a href="<?php echo get_user_meta($user_id,'gplus',true); ?>"><i class="fa fa-google"></i></a></li>
							   <?php
								}
							   ?>
								 <?php
								if(get_user_meta($user_id,'linkedin',true)!=""){ ?>
							   <li><a href="<?php echo get_user_meta($user_id,'linkedin',true); ?>"><i class="fa fa-linkedin"></i></a></li>
							   <?php
								}
							   ?>
							   
							   	 <?php
								if(get_user_meta($user_id,'instagram',true)!=""){ ?>
							   <li><a href="<?php echo get_user_meta($user_id,'instagram',true); ?>"><i class="fa fa-instagram"></i></a></li>
							   <?php
								}
							   ?>
							   
							   	 <?php
								if(get_user_meta($user_id,'pinterest',true)!=""){ ?>
							   <li><a href="<?php echo get_user_meta($user_id,'pinterest',true); ?>"><i class="fa fa-pinterest"></i></a></li>
							   <?php
								}
							   ?>
							   
							   

                      </ul>
                    </div>
                  </div>
                </div>
            
              </div>


			   <div id="jobs" class="tab-pane fade">
				  <div class="row">
                  
                  <div class="col-md-8">                   

                    <!-- Professional Details -->
                    <div class="sidebar">
                      <h5 class="main-title"><?php esc_html_e('Jobs','tiger'); ?> </h5>
                      <div class="similar">
                      <?php                 
						$no=1;						
						$paged = 1;						
						$offset=0;  						
                      $args = array();	
                      $args['number']=$no;
					  $args['offset']=$offset;		     
				      $args['post_type']='jobs'; 
				      $args['author']=$user_id;  
				      $args['post_status']='publish';  			       
					 
					  
                      $job_query = new WP_Query( $args );
                      
					  

				        // User Loop
				        if ( $job_query->have_posts() ) {
				        	while ( $job_query->have_posts() ) {
								$job_query->the_post();
								$post_id= $job_query->post->ID;
							
										$currentCategory=wp_get_object_terms( $id,'jobs-category');
										$cat_link='';$cat_name='';$cat_slug='';
										if(isset($currentCategory[0]->slug)){
											$cat_slug = $currentCategory[0]->slug;
											$cat_name = $currentCategory[0]->name;
											$cat_link= get_term_link($currentCategory[0], 'jobs-category');
										}
										?>
									<article class="uou-block-7f"> 
									 <?php
										  if ( has_post_thumbnail() ) {
											$image_id =  get_post_thumbnail_id( get_the_ID() );
											$large_image = wp_get_attachment_url( $image_id ,'full');
											$resize = tiger_aq_resize( $large_image, true );
										   ?>
										  <img src="<?php echo esc_url($resize); ?>" alt="<?php esc_html_e( 'image', 'tiger' ); ?>" class="thumb">
										  <?php } ?>								
								
										 
										  <h1><a href="<?php echo get_permalink( $post_id );?>"><?php the_title(); ?></a></h1>
										   <div class="meta"> <span class="time-ago"><?php esc_html_e('Category: ','tiger'); echo $cat_name   ?>  | <?php esc_html_e(' Date : ','tiger'); echo $job_query->post->post_date;   ?> </span></div>
										  <p>
											<?php $content = $job_query->post->post_content;
													$content = str_replace( ']]>', ']]&gt;', $content );
													echo substr($content ,0,200);
								
												?>
									
								  
								  <a href="<?php echo get_permalink( $post_id );?>"> <?php esc_html_e( 'Read More','toger' );?></a>
								  </p>
								  </article>

							<?php
							}
								$total_jobs = $job_query->found_posts;  
								$total_pages_jobs=ceil($total_jobs/$no);
								if($total_pages_jobs>1){
								
									echo'<div id="add_more_jobs"></div>';
									echo'<div class="text-center" id="add_more_jobs_loading"></div>';
									
									echo'<div class="text-center" id="add_more_jobs_more_button"><button type="button" onclick="add_more_jobs_ajax(2);"><i class="fa fa-plus"></i> '.esc_html__(' More','tiger').'</button> </div>';
								}
							
						}
						
							if ( !$job_query->have_posts() ){
							esc_html_e( 'Sorry, no data matched your criteria.','toger' );
							}
							
						?>
						
			</div>
							 
					<?php		 
						wp_reset_postdata();
                      ?>
						
                      
                    </div>
                
                  </div>

                  <!-- Col -->
                  <div class="col-md-4">

                    <!-- Professional Details -->
                    <div class="sidebar">
                      <h5 class="main-title"><?php  esc_html_e('Professional Details','tiger');?> </h5>
                      <div class="sidebar-information">

						    <?php
								$i=1;$default_fields='';
								$field_set=get_option('iv_social_profile_personal_fields' );
								if($field_set!=""){
										$default_fields=get_option('iv_social_profile_personal_fields' );
								}else{
										$default_fields['Age']=esc_html__('Age','tiger');
										$default_fields['Location']=esc_html__('Location','tiger');
										$default_fields['Experiance']=esc_html__('Experiance','tiger');
										$default_fields['Dgree']=esc_html__('Dgree','tiger');
										$default_fields['Career-Lavel']=esc_html__('Career Lavel','tiger');
										$default_fields['Phone']=esc_html__('Phone','tiger');								
										$default_fields['Fax']=esc_html__('Fax','tiger');	
										$default_fields['E-mail']=esc_html__('E-mail','tiger');
										$default_fields['web_site']=esc_html__('Website Url','tiger');
								}
								if(sizeof($default_fields)>0){ 								
										?>
									<ul class="single-category">
											<li class="row">
											<h6 class="title col-xs-6"><?php echo 'Name'; ?></h6>
											<span class="subtitle col-xs-6"><?php echo get_user_meta($user_id,'profile_name',true); ?></span>
											</li>
									<?php
									foreach ( $default_fields as $field_key => $field_value ) {
										$field_value_trim=trim($field_value);											
										?>
										<li class="row">
										<h6 class="title col-xs-6"><?php echo $field_value_trim; ?></h6>
										<span class="subtitle col-xs-6"><?php echo '  '.get_user_meta($user_id,$field_key,true); ?></span>
										</li>
									<?php
									}
									?>
								</ul>
								<?php
								}
								?>


                      </div>
                    </div>

               
                    <!-- Social Profiles -->
                    <div class="sidebar">
                      <h5 class="main-title"><?php  esc_html_e('Social Profiles','tiger');?></h5>
                      <ul class="socil">
						   <?php
								if(get_user_meta($user_id,'facebook',true)!=""){ ?>
							  <li> <a href="<?php echo get_user_meta($user_id,'facebook',true); ?>"><i class="fa fa-facebook"></i></a></li>
							   <?php
								}
							   ?>
								<?php
								if(get_user_meta($user_id,'twitter',true)!=""){ ?>
							  <li> <a href="<?php echo get_user_meta($user_id,'twitter',true); ?>"><i class="fa fa-twitter"></i></a></li>
							   <?php
								}
							   ?>
								  <?php
								if(get_user_meta($user_id,'gplus',true)!=""){ ?>
							   <li><a href="<?php echo get_user_meta($user_id,'gplus',true); ?>"><i class="fa fa-google"></i></a></li>
							   <?php
								}
							   ?>
								 <?php
								if(get_user_meta($user_id,'linkedin',true)!=""){ ?>
							   <li><a href="<?php echo get_user_meta($user_id,'linkedin',true); ?>"><i class="fa fa-linkedin"></i></a></li>
							   <?php
								}
							   ?>
							   
							   	 <?php
								if(get_user_meta($user_id,'instagram',true)!=""){ ?>
							   <li><a href="<?php echo get_user_meta($user_id,'instagram',true); ?>"><i class="fa fa-instagram"></i></a></li>
							   <?php
								}
							   ?>
							   
							   	 <?php
								if(get_user_meta($user_id,'pinterest',true)!=""){ ?>
							   <li><a href="<?php echo get_user_meta($user_id,'pinterest',true); ?>"><i class="fa fa-pinterest"></i></a></li>
							   <?php
								}
							   ?>
							   
							   

                      </ul>
                    </div>
                  </div>
             
                </div>
            
             
             
              </div>
			
			 <div id="blog" class="tab-pane fade">
                <div class="row">
                  <div class="col-md-12">
                    <div class="profile-main">
                      <h3><?php  esc_html_e('Blog Post','tiger');?> </h3>
                      <div class="profile-in">
                       
                          <div class="row">
                      <div class="col-md-12">
						   <?php                 
						$no=1;						
						$paged = 1;						
						$offset=0;  						
                      $args = array();	
                      $args['number']=$no;
					  $args['offset']=$offset;		     
				      $args['post_type']='post'; 
				      $args['author']=$user_id;  
				      $args['post_status']='publish';  			       
					 
					  
                      $post_query = new WP_Query( $args );
                      
					  

				        // User Loop
				        if ( $post_query->have_posts() ) {
				        	while ( $post_query->have_posts() ) {
								$post_query->the_post();
								$post_id= $post_query->post->ID;
								?>						  
								<article class="uou-block-7f"> 
									 <?php
										  if ( has_post_thumbnail() ) {
											$image_id =  get_post_thumbnail_id( get_the_ID() );
											$large_image = wp_get_attachment_url( $image_id ,'full');
											$resize = tiger_aq_resize( $large_image, true );
										   ?>
										  <img src="<?php echo esc_url($resize); ?>" alt="<?php esc_html_e( 'image', 'tiger' ); ?>" class="thumb">
										  <?php } ?>								
								
										 
										  <h1><a href="#"><?php the_title(); ?></a></h1>
										   <div class="meta"> <span class="time-ago"><?php esc_html_e( 'Date: ','toger' );?><?php echo $post_query->post->post_date; ?></span></div>
										  <p>
											<?php $content = $post_query->post->post_content;
													$content = str_replace( ']]>', ']]&gt;', $content );
													echo substr($content ,0,200);
								
												?>
									
								  
								  <a href="<?php echo get_permalink( $post_id );?>"> <?php esc_html_e( 'Read More','toger' );?></a>
								  </p>
								  </article>
								  
								<!-- end .uou-block-7f -->
                        
                       <?php
							}
								$total_post = $post_query->found_posts;  
								$total_pages_post=ceil($total_post/$no);
								if($total_pages_post>1){
								
									echo'<div id="add_more_post"></div>';
									echo'<div class="text-center" id="add_more_post_loading"></div>';
									
									echo'<div class="text-center" id="add_more_post_more_button"><button type="button" onclick="add_more_post_ajax(2);"><i class="fa fa-plus"></i> '.esc_html__(' More','tiger').'</button> </div>';
								}
							
						}
						
							if ( !$post_query->have_posts() ){
							esc_html_e( 'Sorry, no data matched your criteria.','toger' );
							}
							
						?>
                        
                      
                      
                      </div>
                    </div>
                
                
                       
                       
                      </div>
                    </div>
                  </div>              

                  <!-- Col -->
             
                </div>
              </div>
			
			 <div id="contact" class="tab-pane fade ">
                <div class="row">
                  <div class="col-md-12">
                    <div class="profile-main">
                      <h3><?php  esc_html_e('Contact','tiger');?> </h3>
                      <div class="profile-in">
								<form action="#">
								  <input type="text" placeholder="Name & Surname">
								  <input type="text" placeholder="E-mail address">
								  
								  <textarea placeholder="Your Message"></textarea>
								  <button class="btn btn-primary">Send message</button>
								</form>
							  
                      </div>
                    </div>
                  </div>              

                  <!-- Col -->
             
                </div>
              </div>


            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



<?php 
if(defined('wp_uou_tigerp_URLPATH')){
	wp_enqueue_script('uou_tigerp-ar-script-23', wp_uou_tigerp_URLPATH . 'assets/cube/js/jquery.cubeportfolio.min.js');
	wp_enqueue_script('uou_tigerp-ar-script-102', wp_uou_tigerp_URLPATH . 'assets/cube/js/meet-team.js');
	wp_enqueue_script('single-profile-js', tiger_JS.'single-profile.js', array('jquery'), $ver = true, true );
	wp_localize_script('single-profile-js', 'tiger_data', array( 			'ajaxurl' 			=> admin_url( 'admin-ajax.php' ),
	'loading_image'		=> '<img src="'.tiger_IMAGE.'loader2.gif">',
	'current_user_id'	=>get_current_user_id(),
	'login_message'		=> esc_html__('Please login to remove favorite','tiger'),
	'Add_to_Follow'		=> esc_html__('Add to Follow','tiger'),
	'Add_to_Connect'		=> esc_html__('Add to Connect','tiger'),
	'Add_to_Bookmark'		=> esc_html__('Add to Bookmark','tiger'),
	'Login_claim'		=> esc_html__('Please login to Report/Claim The Profile','tiger'),
	'login_connect'	=> esc_html__("Please login to add connection",'tiger'),
	'login_bookmark'	=> esc_html__("Please login to add bookmark",'tiger'),
	'login_follw'	=> esc_html__("Please login to add follow",'tiger'),
	'Connected'=> esc_html__("Connected",'tiger'),
	'Connect'=> esc_html__("Connect",'tiger'),
	'following'=> esc_html__("following",'tiger'),
	) );
}
?>
<script>

function add_more_post_ajax(page){             
var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
var total_page=<?php echo (isset($total_pages_post)?$total_pages_post:0 ); ?>;	

	var loader_image = '<img src="<?php echo wp_uou_tigerp_URLPATH. "admin/files/images/loader.gif"; ?>" />';
		jQuery('#add_more_post_loading').html(loader_image);
		
		var search_params={
			"action"  : 	"uou_tigerp_load_more_post",	
			"data": "page=" + page +"&user_id=<?php echo $user_id; ?>" , 
		};
		jQuery.ajax({					
			url : ajaxurl,					 
			//dataType : "json",
			type : "post",
			data : search_params,
			success : function(response){						
				page=page+1;
				jQuery('#add_more_post_loading').html('');
				jQuery('#add_more_post').append(response);
				//jQuery('#add_more_follower_more_button').html('')
				
				if(page<=total_page){ 
				jQuery('#add_more_post_more_button').html('<div class="text-center" id="add_more_post_more_button"><button type="button" onclick="add_more_post_ajax('+ page +');"><i class="fa fa-plus"></i> More</button> </div>');
				}else{
					jQuery('#add_more_post_more_button').html('');
				}
			}
		});

}	
	
function add_more_jobs_ajax(page){             
var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
var total_page=<?php echo (isset($total_pages_jobs)?$total_pages_jobs:0 ); ?>;	

	var loader_image = '<img src="<?php echo wp_uou_tigerp_URLPATH. "admin/files/images/loader.gif"; ?>" />';
		jQuery('#add_more_jobs_loading').html(loader_image);
		
		var search_params={
			"action"  : 	"uou_tigerp_load_more_jobs",	
			"data": "page=" + page +"&user_id=<?php echo $user_id; ?>" , 
		};
		jQuery.ajax({					
			url : ajaxurl,					 
			//dataType : "json",
			type : "post",
			data : search_params,
			success : function(response){						
				page=page+1;
				jQuery('#add_more_jobs_loading').html('');
				jQuery('#add_more_jobs').append(response);
				//jQuery('#add_more_follower_more_button').html('')
				
				if(page<=total_page){ 
				jQuery('#add_more_jobs_more_button').html('<div class="text-center" id="add_more_jobs_more_button"><button type="button" onclick="add_more_jobs_ajax('+ page +');"><i class="fa fa-plus"></i> More</button> </div>');
				}else{
					jQuery('#add_more_jobs_more_button').html('');
				}
			}
		});

}	
</script>	
<?php get_footer();
