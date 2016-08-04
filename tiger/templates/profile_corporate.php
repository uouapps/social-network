<?php
/**
 * Template Name: Company Profile Template
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
   $iv_post = get_option( '_uou_tigerp_profile_post');
	if($iv_post!=''){
		$post_type=  $iv_post;
	}else{
		$post_type=  'Post';
	}
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
		   <div class="profile-bnr" style="background:url(<?php echo wp_get_attachment_url( $top_banner_image ); ?>) no-repeat; background-size:cover;">
	 <?php
	 }else{?>
		  <div class="profile-bnr" style="background:url(<?php echo tiger_IMAGE."profile-bnr.jpg";?>) no-repeat; background-size:cover;">
	 <?php
	 }

     ?>

      <div class="container">

        <!-- User Iinfo -->
        <div class="user-info">
          <h1><?php echo get_user_meta($user_id,'profile_name',true); ?> 
			  <?php
			  if(get_user_meta($user_id,'verified',true)=='Yes'){
				?>  
				<a data-toggle="tooltip" data-placement="top" title="<?php  esc_html_e('Verified Member','tiger');?>  ">
					<img src="<?php echo tiger_IMAGE."icon-ver.png";?>" alt="icon" >
				</a> 
			<?php
				}
			?>	
			</h1>

          <h6><?php echo get_user_meta($user_id,'company_type',true); ?> </h6>
          <?php
          if(get_user_meta($user_id,'address',true)!=''){
          ?>
          <p><?php echo get_user_meta($user_id,'address',true); ?>   ( <a href="http://maps.google.com/maps?q=<?php echo $lat;?>%2C<?php echo $lng;?>" target="_blank"><?php  esc_html_e('map','tiger');?></a> )</p>
          <?php
			}
          ?>
          <!-- Social Icon -->
          <div class="social-links">
			  <?php
				if(get_user_meta($user_id,'facebook',true)!=""){ ?>
			   <a href="<?php echo get_user_meta($user_id,'facebook',true); ?>"><i class="fa fa-facebook"></i></a>
			   <?php
				}
			   ?>
			    <?php
				if(get_user_meta($user_id,'twitter',true)!=""){ ?>
			   <a href="<?php echo get_user_meta($user_id,'twitter',true); ?>"><i class="fa fa-twitter"></i></a>
			   <?php
				}
			   ?>
			      <?php
				if(get_user_meta($user_id,'gplus',true)!=""){ ?>
			   <a href="<?php echo get_user_meta($user_id,'gplus',true); ?>"><i class="fa fa-google"></i></a>
			   <?php
				}
			   ?>
			      <?php
				if(get_user_meta($user_id,'linkedin',true)!=""){ ?>
			   <a href="<?php echo get_user_meta($user_id,'linkedin',true); ?>"><i class="fa fa-linkedin"></i></a>
			   <?php
				}
			   ?>
           </div>

          <!-- Stars -->
          <ul class="row">
            <li class="col-sm-6">
			<?php
			$total_count=0;
			$total_count=get_user_meta($user_id,'_rating_total_count',true);
			$i=1;$default_fields='';$total_rating_value=0;$avg_rating=0;
			$field_set=get_option('iv_social_profile_corporate_fields_review' );
			if($field_set!=""){
					$default_fields=get_option('iv_social_profile_corporate_fields_review' );
			}else{
					$default_fields['Expertise']=esc_html__('Expertise','tiger');
					$default_fields['Knowledge']=esc_html__('Knowledge','tiger');
					$default_fields['Quality']=esc_html__('Quality','tiger');
					$default_fields['Price']=esc_html__('Price','tiger');
					$default_fields['Services']=esc_html__('Services','tiger');
			}
			if(sizeof($default_fields)>0){
				foreach ( $default_fields as $field_key => $field_value ) {
					$field_value_trim=trim($field_value);
					$total_rating_value=$total_rating_value +get_user_meta($user_id,$field_key.'_rating',true);
				}
			}

			if($total_rating_value>0 AND $total_count>0){
				$avg_rating=$total_rating_value/$total_count;
			}

			?>
              <div class="stars">
			  <i class="fa fa-star<?php echo($avg_rating>=1? "":"-o"); ?>"></i>
			  <i class="fa fa-star<?php echo($avg_rating>=1.5? "":"-o"); ?>"></i>
			  <i class="fa fa-star<?php echo($avg_rating>=2.5? "":"-o"); ?>"></i>
			  <i class="fa fa-star<?php echo($avg_rating>=3.5? "":"-o"); ?>"></i>
			  <i class="fa fa-star<?php echo($avg_rating>=4.5? "":"-o"); ?>"></i>
			  <span>(<?php echo ($total_count==""?0:$total_count); ?>)</span>
			  </div>
            </li>
            <li class="col-sm-6">
              <p><i class="fa fa-bookmark-o"></i> <?php
				$socialnetwork_value='';
				$socialnetwork_value = get_user_meta($user_id,'_bookmarker',true);
				$socialnetwork_value_arr = array_filter( explode(',', $socialnetwork_value), 'strlen' );
				$socialnetwork_value_arr= array_filter(array_map('trim', $socialnetwork_value_arr));
				echo sizeof($socialnetwork_value_arr).' ';
			  esc_html_e('Bookmarks','tiger');?>
			  </p>
            </li>
          </ul>

          <!-- Followers -->
          <div class="followr">
            <ul class="row">
              <li class="col-sm-6">
                <p><?php  esc_html_e('Followers','tiger');?> <span>(
				<?php
				$socialnetwork_value='';
				$socialnetwork_value = get_user_meta($user_id,'_follower',true);
				$socialnetwork_value_arr = array_filter( explode(',', $socialnetwork_value), 'strlen' );
				$socialnetwork_value_arr= array_filter(array_map('trim', $socialnetwork_value_arr));
				echo sizeof($socialnetwork_value_arr).' ';
			    ?>
				)</span></p>
              </li>
              <li class="col-sm-6">
                <p><?php  esc_html_e('Following','tiger');?> <span>(
				<?php
				$socialnetwork_value='';
				$socialnetwork_value = get_user_meta($user_id,'_following',true);
				$socialnetwork_value_arr = array_filter( explode(',', $socialnetwork_value), 'strlen' );
				$socialnetwork_value_arr= array_filter(array_map('trim', $socialnetwork_value_arr));
				echo sizeof($socialnetwork_value_arr).' ';
			    ?>

				)</span></p>
              </li>
            </ul>
          </div>
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
				<a title="<?php esc_html_e('Report the profile','tiger'); ?>"  href="#." data-toggle="modal" data-target="#modal-contact"><i class="fa fa-envelope-o"></i> </a> <a href="#." data-toggle="modal" data-target="#modal-claim"><i class="fa fa-exclamation"></i> </a>
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
					    <a class="col-md-3 " href="https://plus.google.com/share?url=<?php the_permalink(); ?><?php echo '&id='.$author_name;  ?>"><i class="fa fa-google"></i> <?php  esc_html_e('Google','tiger');?>+</a>
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
    <div class="profile-company-content has-bg-image">
      <div class="container">
        <div class="row">

          <!-- Nav Tabs -->
          <!--
          <div class="col-md-12">
            <ul class="nav nav-tabs">
              <li class="active"><a data-toggle="tab" href="#profile"><?php  esc_html_e('Profile','tiger');?></a></li>
              <li><a data-toggle="tab" href="#jobs"><?php  esc_html_e('Jobs','tiger');?></a></li>
              <li><a data-toggle="tab" href="#contact"><?php  esc_html_e('Contact','tiger');?></a></li>
            </ul>
          </div>
          -->
          <!-- SIDE BAR -->
          <div class="col-md-4">

            <!-- Company Information -->
            <div class="sidebar">
              <h5 class="main-title"><?php echo get_user_meta($user_id,'profile_name',true); ?><?php  esc_html_e(' Information','tiger');?></h5>
              <div class="sidebar-thumbnail">
					<?php
				  	if($iv_profile_pic_url!=''){ ?>
					 <img src="<?php echo $iv_profile_pic_url; ?>">
					<?php
					}else{
					 echo'	 <img src="'. tiger_IMAGE.'avatar-profile.jpg" alt="profile image">';
					}
				  	?>
			</div>
              <div class="sidebar-information">

                <?php
					$i=1;$default_fields='';
					$field_set=get_option('iv_social_profile_corporate_fields' );
					if($field_set!=""){
							$default_fields=get_option('iv_social_profile_corporate_fields' );
					}else{
							$default_fields['Number_Employees']=esc_html__('Number of Employees','tiger');
							$default_fields['Legal_Entity']=esc_html__('Legal Entity','tiger');
							$default_fields['Company_Registration']=esc_html__('Company Registration','tiger');
							$default_fields['Operating_Hours']=esc_html__('Operating Hours','tiger');
							$default_fields['Contacts']=esc_html__('Contacts','tiger');
							$default_fields['Email']=esc_html__('Email','tiger');
							$default_fields['web_site']=esc_html__('Website Url','tiger');
					}
					if(sizeof($default_fields)>0){ 	?>
						<ul class="single-category">
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

            <!-- Company Rating -->
            <div class="sidebar">
              <h5 class="main-title"><?php echo get_user_meta($user_id,'profile_name',true); ?> <?php  esc_html_e(' Rating','tiger');?> </h5>
              <div class="sidebar-information">
                <ul class="single-category com-rate">
					<?php
					$i=1;$default_fields='';
					$field_set=get_option('iv_social_profile_corporate_fields_review' );
					if($field_set!=""){
							$default_fields=get_option('iv_social_profile_corporate_fields_review' );
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

            <!-- Company Rating -->
            <div class="sidebar">
              <h5 class="main-title"><?php  esc_html_e('Contact','tiger');?></h5>
              <div class="sidebar-information form-side">
               <form id="message-pop" name="message-pop"  method="POST" role="form" >
                  <input name ="contact_name" id="contact_name"  type="text" placeholder="<?php  esc_html_e('Name & Surname','tiger');?>">
                  <input name ="email_address" id="email_address"  type="text" placeholder="<?php  esc_html_e('E-mail address','tiger');?>">
                  <textarea name="message-content" id="message-content"  placeholder="<?php  esc_html_e('Your Message','tiger');?>"></textarea>
                 <input type="hidden" name="profile_user" id="profile_user" value="<?php echo $user_id; ?>">
                  <div id="update_message_popup"></div>
                  <button class="btn btn-primary" onclick="send_message_iv();return false;" ><?php  esc_html_e('Send message','tiger');?></button>
                 <div id="update_message_popup"> </div>
                </form>
              </div>
            </div>
          </div>

          <!-- Tab Content -->
          <div class="col-md-8">
            <div class="tab-content">

              <!-- PROFILE -->
              <div id="profile" class="tab-pane fade in active">
                <div class="profile-main">
                  <h3><?php  esc_html_e('About the ','tiger');?> <?php echo get_user_meta($user_id,'profile_name',true); ?></h3>
                  <div class="profile-in">
					  <?php
					$gallery_ids=get_user_meta($user_id,'image_gallery_ids',true);
					$gallery_ids_array = array_filter(explode(",", $gallery_ids));
						if(sizeof($gallery_ids_array )>0){
					  ?>
					  <div class="content slider">
							<div class="cbp-slider">
								<ul class="cbp-slider-wrap">
									<?php
										//get_template_part( 'content', 'single' );
										$i=1;
											foreach($gallery_ids_array as $slide){
												if($slide!=''){ ?>
												 <li class="cbp-slider-item">
													<img src="<?php echo wp_get_attachment_url( $slide ); ?> " alt="image">
												 </li>
												<?php
												$i++;
												}
											}
										?>
								</ul>
								</div>
							</div>

					<?php
						}
					?>
						<div class="clearfix"><br/></div>

					  <?php echo get_user_meta($user_id,'about_us',true); ?>
					  <div class="clearfix"><br/></div>

                  </div>
                </div>

                <!-- Services -->
                <div class="profile-main">
                  <h3><?php  esc_html_e('Services','tiger');?> </h3>
                  <div class="profile-in profile-serv">
                    <h6><?php  esc_html_e('Here an overview of the services we provide.','tiger');?>  </h6>

                    <?php	$aw=0;
				   for($i=0;$i<20;$i++){

					   if(get_user_meta($user_id,'_service_title_'.$i,true)!='' || get_user_meta($user_id,'_service_description_'.$i,true) || get_user_meta($user_id,'_service_description_'.$i,true) ){?>

						<div class="media">
						  <div class="media-left">
							<div class="icon">
								<?php
									if(get_user_meta($user_id,'_service_image_id_'.$i,true)!=''){?>
										<img width="100px" src="<?php echo wp_get_attachment_url( get_user_meta($user_id,'_service_image_id_'.$i,true) ); ?> " >
									<?php
									}else{?>
										<img src="<?php echo tiger_IMAGE."icon-prifile-3.png";?>" alt="icon" >
								<?php
									}
								?>


							 </div>
						  </div>
						  <div class="media-body">
							   <h6><?php echo get_user_meta($user_id,'_service_title_'.$i,true); ?></h6>
								<p><?php echo get_user_meta($user_id,'_service_description_'.$i,true); ?></p>
						  </div>
						</div>
                    <?php
						}
					}
                    ?>


                  </div>
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

<?php get_footer();
