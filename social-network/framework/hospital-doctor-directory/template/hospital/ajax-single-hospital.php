<?php
global $post,$wpdb;

	 $id=$_GET['id'];
	//print_r($_REQUEST);
	$id = $_GET['id'];
	 $post_id_1 = get_post($id);
	$post_id_1->post_title;


$wp_directory= new wp_iv_directories();
	$logo_image_id=get_post_meta($id ,'logo_image_id',true);

?>
<div class="blog-content pt60">
 <div class="">
		<div class="row">
				<div class="cbp-l-project-title">

					<?php
					if($logo_image_id>0){?>
						<img style="width:90px;vertical-align:middle"  src="<?php echo wp_get_attachment_url( $logo_image_id ); ?> " >
					<?php
					}
					echo $post_id_1->post_title; ?>

				</div>
<?php
if(has_post_thumbnail()){
	$feature_image = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'large' );
	if($feature_image[0]!=""){
		$feature_img =$feature_image[0];
	}
}else{
	$feature_img= wp_iv_directories_URLPATH."/assets/images/default-directory.jpg";

}

$currentCategory=wp_get_object_terms( $id, 'hospital-category');
$cat_link='';$cat_name='';$cat_slug='';
if(isset($currentCategory[0]->slug)){
	$cat_slug = $currentCategory[0]->slug;
	$cat_name = $currentCategory[0]->name;
	$cat_link= get_term_link($currentCategory[0], 'hospital-category');
}

?>

			<div class="cbp-slider">
				<ul class="cbp-slider-wrap">

						<?php
							//get_template_part( 'content', 'single' );

							$gallery_ids=get_post_meta($id ,'image_gallery_ids',true);
							$gallery_ids_array = array_filter(explode(",", $gallery_ids));
							$i=1;
								foreach($gallery_ids_array as $slide){
									if($slide!=''){ ?>
									 <li class="cbp-slider-item">
										<img src="<?php echo wp_get_attachment_url( $slide ); ?> " >
									 </li>
									<?php
									$i++;
									}
								}
							if(sizeof($gallery_ids_array)<1){

									if(has_post_thumbnail($id)){
										echo'<li class="cbp-slider-item">';
											echo get_the_post_thumbnail($id, 'large');
										echo '</li>';
									}else{
										?>
										 <li class="cbp-slider-item">
											<img   src="<?php echo  wp_iv_directories_URLPATH."/assets/images/default-directory.jpg";?>">
										 </li>
									<?php
									}
							}
						?>
				</ul>
			</div>

	<div class="single-direcotry-page">
		<div class="row ">
				<div class="col-md-9">
							<div class="content">
									<div class="cbp-l-project-desc-title"><span class="project-title"><?php esc_html_e('About Us','chilepro'); ?></span>

										<span id="fav_dir<?php echo $id; ?>" style="float: right;">
													<?php
														$user_ID = get_current_user_id();
														if($user_ID>0){
															$my_favorite = get_post_meta($id,'_favorites',true);
															$all_users = explode(",", $my_favorite);
															if (in_array($user_ID, $all_users)) { ?>
																<a style="text-decoration: none;" data-toggle="tooltip" data-placement="bottom" title="<?php esc_html_e('Added to Favorites','chilepro'); ?>" href="javascript:;" onclick="save_unfavorite('<?php echo $id; ?>')" >
																<span class="hide-sm"><i class="fa fa-heart  red-heart fa-lg"></i>&nbsp;&nbsp; </span></a>
															<?php
															}else{ ?>
																<a style="text-decoration: none;" data-toggle="tooltip" data-placement="bottom" title="<?php esc_html_e('Add to Favorites','chilepro'); ?>" href="javascript:;" onclick="save_favorite('<?php echo $id; ?>')" >
																<span class="hide-sm"><i class="fa fa-heart fa-lg"></i>&nbsp;&nbsp; </span>
																</a>
															<?php
															}
														}else{ ?>
																<a style="text-decoration: none;" data-toggle="tooltip" data-placement="bottom" title="<?php esc_html_e('Add to Favorites','chilepro'); ?>" href="javascript:;" onclick="save_favorite('<?php echo $id; ?>')" >
																<span class="hide-sm"><i class="fa fa-heart fa-lg"></i>&nbsp;&nbsp; </span>
																</a>
													<?php
														}
													?>
										</span>

									</div>

									<div class="conten-desc">


										<?php
												if($wp_directory->check_reading_access('description',$id)){
											?>

												<div class="cbp-l-project-desc-text">
												<?php
																												
														$content_post = get_post($id);														
														$content = $content_post->post_content;
														$content = apply_filters('the_content', $content);
														$content = str_replace(']]>', ']]&gt;', $content);
														echo $content;
														

												?>
												</div>
											<div class="cbp-l-project-desc-text">
												<?php
												$i=1;
												$field_set=get_option('iv_directories_fields' );
												if($field_set!=""){
														$default_fields=get_option('iv_directories_fields' );
												}else{
														$default_fields['profitNonProfit']='For-profit or non-profit?';
														$default_fields['size']='Size';
														$default_fields['cost']='Cost';
														$default_fields['average_stay']=' Average length of stay';
														$default_fields['ownership']='Ownership';
														$default_fields['accreditedBy']='Accredited by';
														$default_fields['certifications']='Certifications';
												}
												if(sizeof($default_fields)>0){ 	?>
													<ul class="cbp-l-project-adi-list">
													<?php
													foreach ( $default_fields as $field_key => $field_value ) {
														$field_value_trim=trim($field_value);
														?>
														 <li><strong><?php  echo $field_value_trim; ?></strong>
															<?php echo '  '.get_post_meta($id,$field_key,true); ?>
														</li>
													<?php
													}
													?>
												</ul>
												<?php
												}
												?>
											</div>
										<?php
										}else{
												echo get_option('_iv_visibility_login_message');

											}
										?>

								</div>
						</div>


							<?php
							if(get_post_meta($id,'_award_title_0',true)!='' || get_post_meta($id,'_award_description_0',true) ){
						if($wp_directory->check_reading_access('award',$id)){
					?>

						<div class="content">
								<div class="cbp-l-project-desc-title"><span><?php esc_html_e('Awards','chilepro'); ?></span></div>

									<div class="conten-desc">

											<div class="cbp-l-project-desc-text">

												<?php
												   for($i=0;$i<20;$i++){
													   if(get_post_meta($id,'_award_title_'.$i,true)!='' || get_post_meta($id,'_award_description_'.$i,true) || get_post_meta($id,'_award_year_'.$i,true)|| get_post_meta($id,'_award_image_id_'.$i,true) ){?>

														   <div class="cbp-l-inline">
																<div class="cbp-l-inline-left">
																	<?php
																		if(get_post_meta($id,'_award_image_id_'.$i,true)!=''){?>
																			<img src="<?php echo wp_get_attachment_url( get_post_meta($id,'_award_image_id_'.$i,true) ); ?> " >
																		<?php
																		}

																	?>

																</div>
																<div class="cbp-l-inline-right-hd">
																	<div class="cbp-l-award-title"><?php echo get_post_meta($id,'_award_title_'.$i,true); ?></div>
																	<div class="cbp-l-inline-subtitle"><?php echo get_post_meta($id,'_award_year_'.$i,true); ?></div>
																	<div class="cbp-l-inline-desc">
																			<?php echo get_post_meta($id,'_award_description_'.$i,true); ?>
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
						<?php
						}else{
								echo get_option('_iv_visibility_login_message');

							}
					}
						?>
						<?php
							if($wp_directory->check_reading_access('video',$id)){

							 $video_vimeo_id= get_post_meta($id,'vimeo',true);
							 $video_youtube_id=get_post_meta($id,'youtube',true);
							if($video_vimeo_id!='' || $video_youtube_id!=''){
							?>
						<div class="content">
									<div class="cbp-l-project-desc-title"><span><?php esc_html_e('Video','chilepro'); ?></span></div>
									<div class="conten-desc">
										<?php
													 $v=0;
													 $video_vimeo_id= get_post_meta($id,'vimeo',true);
													 if($video_vimeo_id!=""){ $v=$v+1; ?>
															<iframe src="https://player.vimeo.com/video/<?php echo $video_vimeo_id; ?>" width="100%" height="315px" frameborder="0"></iframe>
													<?php
													 }
													?>
													<br/>
													<?php
													 $video_youtube_id=get_post_meta($id,'youtube',true);
													 if($video_youtube_id!=""){
															echo($v==1?'<hr>':'');
														 ?>

															<iframe width="100%" height="315px" src="https://www.youtube.com/embed/<?php echo $video_youtube_id; ?>" frameborder="0" allowfullscreen></iframe>
													<?php
													 }
													?>
									</div>
						</div>
						<?php
							}
						}
						?>
						<div class="content">
									<?php
									if($wp_directory->check_reading_access('event')){
									?>
										<?php

									 if(trim(get_post_meta($id,'event_title',true))!='' || trim(get_post_meta($id,'event_detail',true))!=''  || trim(get_post_meta($id,'_event_image_id',true))!=''  ){?>
										<div class="cbp-l-project-desc-title"><span><?php esc_html_e('Event','chilepro'); ?></span>
										</div>
										<div class="conten-desc event-content">
													<div class="cbp-l-project-desc-text">

															   <div class="cbp-l-inline">
																	<div class="cbp-l-inline-left">
																		<?php
																			if(get_post_meta($id,'_event_image_id',true)!=''){?>
																				<img src="<?php echo wp_get_attachment_url( get_post_meta($id,'_event_image_id',true) ); ?> " >
																			<?php
																			}

																		?>

																	</div>
																	<div class="cbp-l-inline-right-hd">
																		<div class="cbp-l-award-title"><?php echo get_post_meta($id,'event_title',true); ?></div>
																		<div class="cbp-l-inline-desc">
																				<?php echo get_post_meta($id,'event_detail',true); ?>
																		</div>
																	</div>
																</div>


												</div>


											</div>
												<?php
														}

												  ?>

												<?php
											}
											?>

							</div>
						<?php
							$physician_list=get_post_meta($id,'physician_list',true);


							if(sizeof($physician_list)>0 and $physician_list!=""){?>
							  <div class="content">
									<div class="cbp-l-slider-title-block">

												<div class=""><?php esc_html_e('Our Doctors','chilepro'); ?></div>
										 </div>
								<div id="js-grid-slider-projects" class="cbp doctor-slider conten-desc">
									<?php
									foreach($physician_list as $doctor_one){
											$post_doctor= get_post($doctor_one);
											?>
										<div class="cbp-item singl-directory">
											<div class="cbp-caption">
												<div class="cbp-caption-defaultWrap">
													<?php
														if(has_post_thumbnail($doctor_one)){
																echo get_the_post_thumbnail($doctor_one, 'large');

														}else{	?>

															<img   src="<?php echo  wp_iv_directories_URLPATH."/assets/images/default-doctor.jpg";?>">

														<?php
														}
													?>
												</div>
												<div class="cbp-caption-activeWrap">
													<div class="cbp-l-caption-alignCenter">
														<div class="cbp-l-caption-body">
															<a href="<?php echo get_permalink($doctor_one);?>" class="btn-new btn-custom" rel="nofollow"><?php esc_html_e( 'View Profile', 'chilepro' ); ?> </a>

														</div>
													</div>
												</div>
											</div>
											<div class="cbp-l-grid-projects-title"><?php  echo get_the_title( $doctor_one );  ?></div>
											<div class="cbp-l-grid-projects-desc">
												<?php
												$currentCategory=wp_get_object_terms( $doctor_one, 'doctor-category');
												$cat_link='';$cat_name='';$cat_slug='';
												if(isset($currentCategory[0]->slug)){
													$cat_slug = $currentCategory[0]->slug;
													$cat_name = $currentCategory[0]->name;
													$cat_link= get_term_link($currentCategory[0], 'doctor-category');
												}
												echo $cat_name;
												?>
												</div>
										</div>

							<?php
								}
								?>
									</div>
								</div>
							<?php
							}
						?>
				</div> <!-- End col-md-9-->
				<div class="col-md-3">
							<div class="chilepro-sidebar">
								<div class="cbp-l-project-desc-text">
									<?php
										$lat=get_post_meta($id,'latitude',true);
										$lng=get_post_meta($id,'longitude',true);

										// Get latlng from address* START********
										$dir_lat=$lat;
										$dir_lng=$lng;
										$address = get_post_meta($id,'address',true);
										if($address!=''){
												if($dir_lat=='' || $dir_lng==''){
													$latitude='';$longitude='';

													$prepAddr = str_replace(' ','+',$address);
													$geocode=wp_remote_fopen('http://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
													$output= json_decode($geocode);
													if(isset( $output->results[0]->geometry->location->lat)){
														$latitude = $output->results[0]->geometry->location->lat;
													}
													if(isset($output->results[0]->geometry->location->lng)){
														$longitude = $output->results[0]->geometry->location->lng;
													}
													if($latitude!=''){
														update_post_meta($id,'latitude',$latitude);
													}
													if($longitude!=''){
														update_post_meta($id,'longitude',$longitude);
													}
													$lat=$latitude;
													$lng=$longitude;
												}
										}
									?>

									<iframe class="scroll-no" width="100%" height="200" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q=<?php echo $address; ?>&amp;ie=UTF8&amp;&amp;output=embed"></iframe><br />
									</div>
										<div class="cbp-l-project-details-title"><span><?php esc_html_e('Share','chilepro'); ?></span>
										</div>
										<a data-toggle="tooltip" class="icon-blue" data-placement="bottom" title="<?php esc_html_e('Share On Facebook','chilepro'); ?>" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink();  ?>"><i class="fa fa-facebook-square fa-2x"></i></a>

										<a data-toggle="tooltip" class="icon-blue" data-placement="bottom" title="<?php esc_html_e('Share On Twitter','chilepro'); ?>" href="https://twitter.com/home?status=<?php the_permalink();  ?>"><i class="fa fa-twitter fa-2x"></i></a>

										<a data-toggle="tooltip" class="icon-blue" data-placement="bottom" title="<?php esc_html_e('Share On linkedin','chilepro'); ?>" href="https://www.linkedin.com/shareArticle?mini=true&url=test&title=<?php the_title(); ?>&summary=&source="><i class="fa fa-linkedin-square fa-2x"></i></a>

										<a data-toggle="tooltip" class="icon-blue" data-placement="bottom" title="<?php esc_html_e('Share On google+','chilepro'); ?>" href="https://plus.google.com/share?url=<?php the_permalink();  ?>"><i class="fa fa-google-plus-square fa-2x"></i></a>

										<div class="cbp-l-project-details-title"><span><?php esc_html_e('Contact Info','chilepro'); ?></span>
										</div>
											<?php
											if($wp_directory->check_reading_access('contact info',$id)){
											?>

										<ul class="cbp-l-project-details-list location-lists">
											<li><strong><?php esc_html_e('Location','chilepro'); ?></strong>
											<?php
												echo '<a style="text-decoration: none;" href="http://maps.google.com/maps?saddr=Current+Location&amp;daddr='.$lat.'%2C'.$lng.'" target="_blank"">'.get_post_meta($id,'address',true).'</a>';
											?>
											</li>
											  <li><strong><?php esc_html_e('Phone','chilepro'); ?></strong>
												<?php echo '<a style="text-decoration: none;" href="tel:'.get_post_meta($id,'phone',true).'">'.get_post_meta($id,'phone',true).'</a>' ;?>
											</li>
											  <li><strong><?php esc_html_e('Fax','chilepro'); ?></strong>
														<?php echo get_post_meta($id,'fax',true).'&nbsp;';?>			</li>
											  <li><strong><?php esc_html_e('Email','chilepro'); ?></strong>
														<?php echo get_post_meta($id,'contact-email',true).'&nbsp;';?>					</li>
											  <li><strong><?php esc_html_e('Web Site','chilepro'); ?></strong>
													<?php echo '<a style="text-decoration: none;" href="http://'. get_post_meta($id,'contact_web',true).'" target="_blank"">'. get_post_meta($id,'contact_web',true).'&nbsp; </a>';?>
											 </li>
										</ul>
									<?php
									}else{
										echo get_option('_iv_visibility_login_message');

									}
									?>

										<?php
									 if(get_post_meta($id,'facebook',true)!='' || get_post_meta($id,'twitter',true)!='' || get_post_meta($id,'linkedin',true)!=''|| get_post_meta($id,'gplus',true)!='' ){

									?>

									<div class="cbp-l-project-details-title"><span><?php esc_html_e('Social Profile','chilepro'); ?></span>
									</div>

										<?php
										if(get_post_meta($id,'facebook',true)!=""){ ?>
											<a data-toggle="tooltip" data-placement="bottom" class="icon-blue"  title="<?php esc_html_e('Facebook Profile','chilepro'); ?>" href="<?php echo get_post_meta($id,'facebook',true);?>" target="_blank"><i class="fa fa-facebook-square fa-2x"></i></a>
										<?php
										}
										?>
										<?php
										if(get_post_meta($id,'twitter',true)!=""){ ?>
											<a data-toggle="tooltip" data-placement="bottom" class="icon-blue"  title="<?php esc_html_e('Twitter Profile','chilepro'); ?>" href="<?php echo get_post_meta($id,'twitter',true);?>" target="_blank"><i class="fa fa-twitter fa-2x"></i></a>
										<?php
										}
										?>
										<?php
										if(get_post_meta($id,'linkedin',true)!=""){ ?>
											<a data-toggle="tooltip" data-placement="bottom" class="icon-blue"  title="<?php esc_html_e('linkedin Profile','chilepro'); ?>" href="<?php echo get_post_meta($id,'linkedin',true);?>" target="_blank"><i class="fa fa-linkedin-square fa-2x"></i></a>
										<?php
										}
										?>
										<?php
										if(get_post_meta($id,'gplus',true)!=""){ ?>
											<a data-toggle="tooltip" data-placement="bottom" class="icon-blue"  title="<?php esc_html_e('google+ Profile','chilepro'); ?>" href="<?php echo get_post_meta($id,'gplus',true);?>" target="_blank"><i class="fa fa-google-plus-square fa-2x"></i></a>
										<?php
										}
									}
								?>
									<div class="cbp-l-project-details-title"><span><?php esc_html_e('Specialties','chilepro'); ?></span>
									</div>
									<?php
										$specialties = get_post_meta($id,'specialtie',true);
										$specialties_arr= explode(",",$specialties);
										if(sizeof($specialties_arr)>0){?>
											<ul class="cbp-l-project-details-list">
											<?php
											foreach($specialties_arr as $sp_one){
													if(trim($sp_one)!=''){
													?>
												<li><strong><?php echo $sp_one;?></strong> <span style="float: right;" ></span></li>
											<?php
												}
											}?>
											</ul>
										<?php
										}
										?>
										<?php
											$openin_days =get_post_meta($id ,'_opening_time',true);
											if($openin_days!=''){
											if(sizeof($openin_days)>0){?>

													<div class="cbp-l-project-details-title"><span><?php esc_html_e('Opening Time','chilepro'); ?></span></div>

													<ul class="cbp-l-project-details-list">
												<?php
													foreach($openin_days as $key => $item){
														$day_time = explode("|", $item);
														?>
														 <li><strong><?php echo $key; ?></strong><?php echo $day_time[0].' - '.$day_time[1];  ?></li>
														<?php

														}
													?>
													   </ul>
												<?php
											} }
										 ?>


										<div class="cbp-l-project-details-title"><span><?php esc_html_e('Contact Us','chilepro'); ?></span></div>
										<?php
											if($wp_directory->check_reading_access('contact us',$id)){
										?>
											<form action="" id="message-pop" name="message-pop"  method="POST" role="form">
											<div class="cbp-l-grid-projects-desc">
												<input id="subject" name ="subject" type="text" placeholder="Enter Subject" class="cbp-search-input">
											</div>
											<div class="cbp-l-grid-projects-desc">
												<input name ="email_address" id="email_address" type="text" placeholder="Enter Email" class="cbp-search-input">
											</div>
											<div class="cbp-l-grid-projects-desc">
												<textarea name="message-content" id="message-content"  class="cbp-search-"  cols="54" rows="4" title="Please Enter Message"  placeholder="<?php esc_html_e( 'Enter Message', 'chilepro' ); ?>"  ></textarea>
											</div>
											 <input type="hidden" name="dir_id" id="dir_id" value="<?php echo $id; ?>">
											  <a onclick="send_message_iv();" class="btn btn-primary full-width"><?php esc_html_e( 'Send Message', 'chilepro' ); ?></a>
												<div id="update_message_popup"></div>
											</form>
										<?php
										}else{
												echo get_option('_iv_visibility_login_message');

										}
										?>
										<?php
										$dir_claim_show=get_option('_dir_claim_show');
										if($dir_claim_show==""){$dir_claim_show='yes';}
										if($dir_claim_show=='yes'){
											if(get_post_meta($id,'iv_hospital_approve',true)!='yes'){
											?>

											<div class="cbp-l-project-details-title"><span><?php esc_html_e('Claim','chilepro'); ?></span></div>
											 <form action="" id="message-claim" name="message-claim"  method="POST" role="form">
													<div class="cbp-l-grid-projects-desc">
														<input id="subject" name ="subject" type="text" placeholder="Enter Subject" Value="<?php esc_html_e('Claim The Listing', 'chilepro' ); ?>" class="cbp-search-input">
													</div>
													<div class="cbp-l-grid-projects-desc">
														<textarea name="message-content" id="message-content"  class="cbp-search-"  cols="56" rows="4" title="Please Enter Message"  placeholder="<?php esc_html_e( 'Enter Message', 'chilepro' ); ?>"  ></textarea>
													</div>
													 <input type="hidden" name="dir_id" id="dir_id" value="<?php echo $id; ?>">
													  <a onclick="send_message_claim();" class="btn btn-primary full-width"><?php esc_html_e( 'Submit Claim', 'chilepro' ); ?></a>
														<div id="update_message_claim"></div>

												</form>

										<?php
										}
									}
										?>

						</div>	<!--chilepro-sidebar -->

				</div><!-- End col-md-3-->
		</div>
	</div>




</div>
</div></div></div>



<?php

  /*
wp_enqueue_script('iv_directories-ar-script-23', wp_iv_directories_URLPATH . 'assets/cube/js/jquery.cubeportfolio.min.js');
wp_enqueue_script('iv_directories-ar-script-102', wp_iv_directories_URLPATH . 'assets/cube/js/meet-team.js');
wp_enqueue_script('single-hospital-js', SB_JS.'single-hospital.js', array('jquery'), $ver = true, true );
wp_localize_script('single-hospital-js', 'chilepro_data', array( 			'ajaxurl' 			=> admin_url( 'admin-ajax.php' ),
'loading_image'		=> wp_iv_directories_URLPATH.'admin/files/images/loader.gif',
'current_user_id'	=>get_current_user_id(),
'login_message'		=> __('Please login to remove favorite','chilepro'),
'Add_to_Favorites'		=> __('Add to Favorites','chilepro'),
'Login_claim'		=> __('Please login to Claim The Listing','chilepro'),
'login_favorite'	=> __("Please login to add favorite",'chilepro'),
) );
 */

  ?>


<script type="text/javascript">

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

</script>
