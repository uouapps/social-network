<?php
wp_enqueue_style('single-doctor-style', SB_CSS.'add-hospital.css', array(), $ver = false, $media = 'all');
?>
				
          <div class="profile-content">
            
              <div class="portlet light">
                <div class="portlet-title tabbable-line clearfix">
                    <div class="caption caption-md">
                      <span class="caption-subject"> <?php esc_html_e('Edit Hospital','chilepro'); ?></span>
                    </div>
					
                  </div>
                                 
                  <div class="portlet-body">
                    <div class="tab-content">
                    
                      <div class="tab-pane active" id="tab_1_1">
					  <?php					
						global $wpdb;
						// Check Max\
						$package_id=get_user_meta($current_user->ID,'iv_directories_package_id',true);						
						$max=get_post_meta($package_id, 'iv_directories_package_max_post_no', true);
						$curr_post_id=$_REQUEST['post-id'];
						$current_post = $curr_post_id;
						$post_edit = get_post($curr_post_id); 
						
						$have_edit_access='yes';
						$exp_date= get_user_meta($current_user->ID, 'iv_directories_exprie_date', true);
						if($exp_date!=''){
							$package_id=get_user_meta($current_user->ID,'iv_directories_package_id',true);
							$dir_hide= get_post_meta($package_id, 'iv_directories_package_hide_exp', true);
							if($dir_hide=='yes'){
								//echo 'exp_date...'.strtotime($exp_date) .' --Time..'. time();
								if(strtotime($exp_date) < time()){	
									$have_edit_access='no';		
								}
							}
						}
						
						if ( $post_edit->post_author != $current_user->ID or $have_edit_access=='no') {
							
							$iv_redirect = get_option( '_iv_directories_login_page');
							 $reg_page= get_permalink( $iv_redirect); 
							?>
							
							
							<?php esc_html_e('Please ','chilepro'); ?>
							 <a href="<?php echo $reg_page.'?&profile=level'; ?>" title="Upgarde"><b><?php esc_html_e('Login or upgrade ','chilepro'); ?> </b></a> 
							<?php esc_html_e('To Edit The Post.','chilepro'); ?>	
							
						
							
							
						<?php
						}else{
								$title = $post_edit->post_title;
								$content = $post_edit->post_content;
					
					?>					
					
						<div class="row">
							<div class="col-md-12">	 
							
							 
							<form action="" id="edit_post" name="edit_post"  method="POST" role="form">
								<div class=" form-group">
								<label for="text" class=" control-label"><?php esc_html_e('Hospital Name','chilepro'); ?></label>
									<div class="  "> 
										<input type="text" class="" name="title" id="title"  placeholder="<?php esc_html_e('Enter Hospital Name Here','chilepro'); ?>" value="<?php echo $title;?>">
									</div>																		
								</div>
								
								<div class="form-group">
										
										<div class=" ">
												<?php
													$settings_a = array(															
														'textarea_rows' =>8,
														'editor_class' => 'form-control',
																													 
														);
													$content_client =$content;
													$editor_id = 'edit_post_content';
													wp_editor($content_client, $editor_id,$settings_a );										
													?>
									
										</div>
									
								</div>

								<div class="upload-content">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group ">

												<label for="text" class=" control-label"><?php esc_html_e('Hospital logo','chilepro'); ?>  </label>
													<?php
													$logo_image_id=get_post_meta($curr_post_id ,'logo_image_id',true);
													?>
													<div class="image-content" id="logo_image_div">
														<a  href="javascript:void(0);" onclick="logo_post_image('logo_image_div');"  >
															<?php
															if($logo_image_id>0){
																
																echo '<img width="" src="'. wp_get_attachment_url( $logo_image_id ).'">';
															}else{
																echo '<img width="" src="'. wp_iv_directories_URLPATH.'assets/images/image-add-icon.png">';
															}
															?>
														</a>					
													</div>
													
													<input type="hidden" name="logo_image_id" id="logo_image_id" value="<?php echo $logo_image_id; ?>">
													
													<div class="" id="logo_image_edit">	
														<button type="button" onclick="logo_post_image('logo_image_div');"  class="btn btn-sm green-haze"><?php esc_html_e('Add','chilepro'); ?> </button>
														
													</div>									
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group ">
												<label for="text" class="control-label"><?php esc_html_e('Feature Image','chilepro'); ?>  </label>
												
													<div class="image-content" id="post_image_div">
														
														<?php $feature_image = wp_get_attachment_image_src( get_post_thumbnail_id( $curr_post_id ), 'thumbnail' ); 
															
															
															if($feature_image[0]!=""){ ?>
															
															<img title="profile image" class="" src="<?php  echo $feature_image[0]; ?>">
															
															<?php												
															}else{ ?>
															<a href="javascript:void(0);" onclick="edit_post_image('post_image_div');"  >									
														<?php  echo '<img src="'. wp_iv_directories_URLPATH.'assets/images/image-add-icon.png">'; ?>			
														</a>	
															<?php
															}
															$feature_image_id=get_post_thumbnail_id( $curr_post_id );
															?>
																	
																			
													</div>
													
													<input type="hidden" name="feature_image_id" id="feature_image_id" value="<?php echo $feature_image_id; ?>">
													
													<div class="" id="post_image_edit">	
														<button type="button" onclick="edit_post_image('post_image_div');"  class="btn btn-sm green-haze"><?php esc_html_e('Add','chilepro'); ?> </button>
														
													</div>									
											</div>
										</div>

									</div>
								</div>
								
								
								<div class=" row form-group ">
									<label for="text" class=" col-md-5 control-label"><?php esc_html_e('Image Gallery','chilepro'); ?> 
										<button type="button" onclick="edit_gallery_image('gallery_image_div');"  class="btn btn-sm green-haze"><?php esc_html_e('Add Images','chilepro'); ?></button>
									 </label>						
								</div>
								<div class=" row form-group ">	
											<!--
										<div class="col-md-12" id="gallery_image_div">
											
											<a  href="javascript:void(0);" onclick="edit_gallery_image('gallery_image_div');"  >									
											<?php  echo '<img src="'. wp_iv_directories_URLPATH.'assets/images/gallery_icon.png">'; ?>			
											</a>
															
										</div>
											-->
											<?php
											$gallery_ids=get_post_meta($curr_post_id ,'image_gallery_ids',true);
											$gallery_ids_array = array_filter(explode(",", $gallery_ids));
											?>
										<input type="hidden" name="gallery_image_ids" id="gallery_image_ids" value="<?php echo $gallery_ids; ?>">
										
										<div class="col-md-12" id="gallery_image_div">
											<?php
												if(sizeof($gallery_ids_array)>0){ 
													foreach($gallery_ids_array as $slide){	
														
												?>
												<div id="gallery_image_div<?php echo $slide;?>" class="col-md-3"><img  class="img-responsive"  src="<?php echo wp_get_attachment_url( $slide ); ?>"><button type="button" onclick="remove_gallery_image('gallery_image_div<?php echo $slide;?>', <?php echo $slide;?>);"  class="btn btn-xs btn-danger">Remove</button> </div>
												<?php
													}
												 }
												?>
												
										</div>									
								</div>
								
																
								
								<div class="clearfix"></div>
								<div class=" row form-group ">
									<label for="text" class=" col-md-12 control-label"><?php esc_html_e('Post Status','chilepro'); ?>  </label>
									
										<div class="col-md-12" id="">
										<select name="post_status" id="post_status"  class="">
											<?php
												$dir_approve_publish =get_option('_dir_approve_publish');
												if($dir_approve_publish!='yes'){?>
													<option value="publish" <?php echo (get_post_status( $post_edit->ID )=='publish'?'selected="selected"':'' ) ; ?>><?php esc_html_e('Publish','chilepro'); ?></option>
												<?php	
												}else{ ?>
													<option value="pending" <?php echo (get_post_status( $post_edit->ID )=='pending'?'selected="selected"':'' ) ; ?>><?php esc_html_e('Pending Review','chilepro'); ?></option>
												<?php
												}
											?>											
											<option value="draft" <?php echo (get_post_status( $post_edit->ID )=='draft'?'selected="selected"':'' ) ; ?> >Draft</option>
										
										</select>										
											
											
										</div>				
																		
								</div>
								
								
								<div class="clearfix"></div>
								<div class=" row form-group">
									<label for="text" class=" col-md-12 control-label"><?php esc_html_e('Category','chilepro'); ?></label>									
									<div class=" col-md-12 "> 								
								<?php
																			
										$currentCategory=wp_get_object_terms( $post_edit->ID, 'hospital-category');
										$selected='';
										if(isset($currentCategory[0]->slug)){										
									
											$selected = $currentCategory[0]->slug;
										}
										
										echo '<select name="postcats" class="">';
										echo'	<option selected="'.$selected.'" value="">'.__('Choose a category','chilepro').'</option>';
																	
											//directories
											$taxonomy = 'hospital-category';
											$args = array(
												'orderby'           => 'name', 
												'order'             => 'ASC',
												'hide_empty'        => false, 
												'exclude'           => array(), 
												'exclude_tree'      => array(), 
												'include'           => array(),
												'number'            => '', 
												'fields'            => 'all', 
												'slug'              => '',
												'parent'            => '0',
												'hierarchical'      => true, 
												'child_of'          => 0,
												'childless'         => false,
												'get'               => '', 
												
											);
								$terms = get_terms($taxonomy,$args); // Get all terms of a taxonomy
								if ( $terms && !is_wp_error( $terms ) ) :
									$i=0;
									foreach ( $terms as $term_parent ) {  ?>												
										
										
											<?php 
											
											echo '<option  value="'.$term_parent->slug.'" '.($selected==$term_parent->slug?'selected':'' ).'><strong>'.$term_parent->name.'<strong></option>';
											?>	
												<?php
												
												$args2 = array(
													'type'                     => 'hospital',						
													'parent'                   => $term_parent->term_id,
													'orderby'                  => 'name',
													'order'                    => 'ASC',
													'hide_empty'               => 0,
													'hierarchical'             => 1,
													'exclude'                  => '',
													'include'                  => '',
													'number'                   => '',
													'taxonomy'                 => 'hospital-category',
													'pad_counts'               => false 

												); 											
												$categories = get_categories( $args2 );	
												if ( $categories && !is_wp_error( $categories ) ) :
														
														
													foreach ( $categories as $term ) { 
														echo '<option  value="'.$term->slug.'" '.($selected==$term->slug?'selected':'' ).'>--'.$term->name.'</option>';
													} 	
																				
												endif;		
												
												?>
																			
	  
									<?php
										$i++;
									} 								
								endif;	
									echo '</select>';	
								?>		
									</div>
																		
								</div>
								
								
								


						<div class=" form-group">
							<label for="text" class=" control-label"><?php esc_html_e('Address','chilepro'); ?></label>							
							<div class=" "> 
								<input type="text" class="" name="address" id="address" value="<?php echo get_post_meta($post_edit->ID,'address',true); ?>" placeholder="<?php esc_html_e('Enter here Here','chilepro'); ?>">
							</div>
							<input type="hidden" id="latitude" name="latitude"  value="<?php echo get_post_meta($post_edit->ID,'latitude',true); ?>" >
							<input type="hidden" id="longitude" name="longitude"  value="<?php echo get_post_meta($post_edit->ID,'longitude',true); ?>" >
                            <input type="hidden" id="city" name="city" value="<?php echo get_post_meta($post_edit->ID,'city',true); ?>" /> 
                            <input type="hidden" id="state" name="state" value="<?php echo get_post_meta($post_edit->ID,'state',true); ?>" /> 
                            <input type="hidden" id="postcode" name="postcode" value="<?php echo get_post_meta($post_edit->ID,'postcode',true); ?>" /> 
                            <input type="hidden" id="country" name="country" value="<?php echo get_post_meta($post_edit->ID,'country',true); ?>" /> 								
						</div>
						<div class=" form-group">
							<label for="text" class=" control-label"><?php esc_html_e('Address Map','chilepro'); ?></label>							
							<div class=" "> 
									<div  id="map-canvas"  style="width:100%;height:300px;"></div>
										
								<script type="text/javascript">
								var geocoder;
								jQuery(document).ready(function($) {									
									var map;
									var marker;

									 geocoder = new google.maps.Geocoder();
									

									function geocodePosition(pos) {
									  geocoder.geocode({
									    latLng: pos
									  }, function(responses) {
									    if (responses && responses.length > 0) {
									      updateMarkerAddress(responses[0].formatted_address);
									    } else {
									      updateMarkerAddress('Cannot determine address at this location.');
									    }
									  });
									}

									function updateMarkerPosition(latLng) {
									  jQuery('#latitude').val(latLng.lat());
									  jQuery('#longitude').val(latLng.lng());	
										//console.log(latLng);	
										codeLatLng(latLng.lat(), latLng.lng());
									}

									function updateMarkerAddress(str) {
									  jQuery('#address').val(str);
									}

									function initialize() {
									  var have_lat ='<?php echo get_post_meta($post_edit->ID,'latitude',true); ?>';
									  if(have_lat!=''){
										 var latlng = new google.maps.LatLng('<?php echo get_post_meta($post_edit->ID,'latitude',true); ?>',' <?php echo get_post_meta($post_edit->ID,'longitude',true); ?>');
									 
									  } else{
										 
										  var latlng = new google.maps.LatLng(40.748817, -73.985428);
									  }	
									  
									  var mapOptions = {
									    zoom: 2,
									    center: latlng
									  }

									  map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
										
									  geocoder = new google.maps.Geocoder();

									  marker = new google.maps.Marker({
									  	position: latlng,
									    map: map,
									    draggable: true
									  });

									  // Add dragging event listeners.
									  google.maps.event.addListener(marker, 'dragstart', function() {
									    updateMarkerAddress('Please Wait Dragging...');
									  });
									  
									  google.maps.event.addListener(marker, 'drag', function() {
									    updateMarkerPosition(marker.getPosition());
									  });
									  
									  google.maps.event.addListener(marker, 'dragend', function() {
									    geocodePosition(marker.getPosition());
									  });

									}

									google.maps.event.addDomListener(window, 'load', initialize);
									google.maps.event.addDomListener(window, 'load', initialize_address);
									function initialize_address() {
										var input = document.getElementById('address');
										var autocomplete = new google.maps.places.Autocomplete(input);
											google.maps.event.addListener(autocomplete, 'place_changed', function () {
											var place = autocomplete.getPlace();
											//document.getElementById('city2').value = place.name;
											document.getElementById('latitude').value = place.geometry.location.lat();
											document.getElementById('longitude').value = place.geometry.location.lng(); 
											
											//codeLatLng(place.geometry.location.lat(), place.geometry.location.lng());
											
									         var location = new google.maps.LatLng(place.geometry.location.lat(), place.geometry.location.lng());
												codeLatLng(place.geometry.location.lat(), place.geometry.location.lng());
											
									        marker.setPosition(location);
									        map.setZoom(16);
									        map.setCenter(location);
										});
									}
									jQuery(document).ready(function() { 
									         
									  initialize();
									          
									 
									  //Add listener to marker for reverse geocoding
									  google.maps.event.addListener(marker, 'drag', function() {
									    geocoder.geocode({'latLng': marker.getPosition()}, function(results, status) {
									      if (status == google.maps.GeocoderStatus.OK) {
									        if (results[0]) {
												
									          jQuery('#address').val(results[0].formatted_address);
									          jQuery('#latitude').val(marker.getPosition().lat());
									          jQuery('#longitude').val(marker.getPosition().lng());
									        }
									      }
									    });
									  });
									  
									});

								});
								// For city country , zip
								function codeLatLng(lat, lng) {
									var city;
									var postcode;
									var state;
									var country;	
									var latlng = new google.maps.LatLng(lat, lng);
									geocoder.geocode({'latLng': latlng}, function(results, status) {
									  if (status == google.maps.GeocoderStatus.OK) {
									  //console.log(results)
										if (results[1]) {
									
										//find country name
											 for (var i=0; i<results[0].address_components.length; i++) {
											for (var b=0;b<results[0].address_components[i].types.length;b++) {

											//there are different types that might hold a city admin_area_lvl_1 usually does in come cases looking for sublocality type will be more appropriate
												if (results[0].address_components[i].types[b] == "administrative_area_level_1") {
													//this is the object you are looking for
													city= results[0].address_components[i];		
													//break;
												}
												if (results[0].address_components[i].types[b] == "country") {
													country= results[0].address_components[i];
												}
												if (results[0].address_components[i].types[b] == "postal_code") {													
													postcode= results[0].address_components[i];													
												}	
												
											}
										}
										//city data
										jQuery('#address').val(results[0].formatted_address); 
										jQuery('#city').val(city.long_name);
										jQuery('#postcode').val(postcode.long_name);
										jQuery('#country').val(country.long_name);
										//alert(city.chilepro + " " + city.long_name)


										} else {
										  
										}
									  } else {
										
									  }
									});
								  }

						    </script>
							</div>																
						</div>
					
										
						<div class="clearfix"></div>	
					
					<div class="panel panel-default">
								<div class="panel-heading">
								  <h4 class="panel-title col-lg-10">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapseEight">
									  <?php esc_html_e('Specialtie(s)','chilepro'); ?>
									</a>
								  </h4>
									<h4 class="panel-title" style="text-align:right;color:#1AA2E1;font-size:12px;">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapseEight">
									  <?php esc_html_e('Edit ','chilepro'); ?> <i class="fa fa-edit"></i>
									</a>
								  </h4>
								</div>
								<div id="collapseEight" class="panel-collapse collapse">
								  <div class="panel-body">
									<div class=" form-group">
										
											<div class=" "> 
											<?php
											$specialtie =__('Allergy & Immunology, Anaesthesia,
															Bariatric (Weight Loss) Surgery,
															Breast Reconstruction,
															Breast Surgery,
															Cardiac Surgery, 
															Cardiology,
															Clinical Neurophysiology, 
															Colonoscopy, 
															Colorectal Surgery, 
															Cosmetic Dermatology, 
															Cosmetic Surgery,
															Dermatologic Surgery, 
															Dermatology, 
															Dietetics,
															Ear, Nose and Throat (ENT) Surgery,
															Endocrinology,
															Gastroenterology, 
															Gastroscopy,
															General Medicine, 
															General Surgery,
															Gynaecology,
															Hand Surgery, 
															Interventional Cardiology,
															Laparoscopic Surgery,
															Liver Biopsy,
															Maxillofacial Surgery,
															Mohs Micrographic Surgery, 
															Mole checks and monitoring, 
															Nail Surgery,
															Neurology,
															Neurosurgery, 
															Obstetrics,
															Oncology,
															Ophthalmology, 
															Oral Surgery,
															Orthopaedic Surgery, 
															Osteopathy,
															Paediatrics, 
															Physiotherapy, 
															Plastic and Reconstructive Surgery, 
															Psychiatry,
															Psychotherapy, 
															Reconstructive Surgery, 
															Rheumatology,
															Skin Cancer Surgery and Management, 
															Urology,
															Vascular & Interventional Radiology, 
															Vascular Surgery,
															Wireless Capsule Endoscopy','chilepro');
																										
											$field_set=get_option('iv_hospital_specialtie' );
											if($field_set!=""){ 
													$specialtie=get_option('iv_hospital_specialtie' );
											}			
																	
														
										$i=1;		
											
										$specialtie_fields= explode(",",$specialtie);	
										$specialties_saved = get_post_meta($post_edit->ID,'specialtie',true);
										$specialties_arr = explode(",",$specialties_saved);	
																				
										//print_r($specialties_saved);	
										foreach ( $specialtie_fields as $field_value ) { 
											if($field_value!='' ){
												$selected='';
												foreach ( $specialties_arr as $field_1 ) {
												 if(trim($field_1)==trim($field_value)){
													$selected='checked'; 
												 }
												}
											?>	
												<div class="col-md-4">
													<label class="form-group"> 
													<input type="checkbox" <?php echo $selected; ?>  name="specialtie_arr[]" id="specialtie_arr[]" value="<?php echo $field_value; ?>"> <?php echo $field_value; ?> </label>  
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
					
					<div class="clearfix"></div>	
					
					<div class="panel panel-default">
								<div class="panel-heading">
								  <h4 class="panel-title col-lg-10">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
									  <?php esc_html_e('Contact Info','chilepro'); ?>
									</a>
								  </h4>
									<h4 class="panel-title" style="text-align:right;color:#1AA2E1;font-size:12px;">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
									  <?php esc_html_e('Edit ','chilepro'); ?> <i class="fa fa-edit"></i>
									</a>
								  </h4>
								</div>
								<div id="collapseFour" class="panel-collapse collapse">
								  <div class="panel-body">											
									<div class=" form-group">
											<label for="text" class=" control-label"><?php esc_html_e('Phone','chilepro'); ?></label>						
											<div class="  "> 
												<input type="text" class="" name="phone" id="phone" value="<?php echo get_post_meta($post_edit->ID,'phone',true); ?>" placeholder="<?php esc_html_e('Enter Phone Number','chilepro'); ?>">
											</div>																
									</div>
									<div class=" form-group">
											<label for="text" class=" control-label"><?php esc_html_e('Fax','chilepro'); ?></label>
											
											<div class="  "> 
												<input type="text" class="" name="fax" id="fax" value="<?php echo get_post_meta($post_edit->ID,'fax',true); ?>" placeholder="<?php esc_html_e('Enter Fax Number','chilepro'); ?>">
											</div>																
									</div>	
									<div class=" form-group">
											<label for="text" class=" control-label"><?php esc_html_e('Email Address','chilepro'); ?></label>
											
											<div class="  "> 
												<input type="text" class="" name="contact-email" id="contact-email" value="<?php echo get_post_meta($post_edit->ID,'contact-email',true); ?>" placeholder="<?php esc_html_e('Enter Email Address','chilepro'); ?>">
											</div>																
									</div>
									<div class=" form-group">
											<label for="text" class=" control-label"><?php esc_html_e('Web Site','chilepro'); ?></label>
											
											<div class="  "> 
												<input type="text" class="" name="contact_web" id="contact_web" value="<?php echo get_post_meta($post_edit->ID,'contact_web',true); ?>" placeholder="<?php esc_html_e('Enter Web Site','chilepro'); ?>">
											</div>																
									</div>
									
									
								  </div>
								</div>
					  </div>
					
					<div class="clearfix"></div>	
					<div class="panel panel-default">
								<div class="panel-heading">
								  <h4 class="panel-title col-lg-10">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapsethirty2">
									  <?php esc_html_e('Awards','chilepro'); ?>
									</a>
								  </h4>
									<h4 class="panel-title" style="text-align:right;color:#1AA2E1;font-size:12px;">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapsethirty2">
									   <?php esc_html_e('Edit ','chilepro'); ?> <i class="fa fa-edit"></i>
									</a>
								  </h4>
								</div>
								<div id="collapsethirty2" class="panel-collapse collapse">
									<div class="panel-body">
									<?php
										// video, event ,  award
										if($this->check_write_access('award')){												
										?>		
									  <div id="awards">
												
												<?php	$aw=0;	 
													   for($i=0;$i<20;$i++){
														 		  
														   if(get_post_meta($post_edit->ID,'_award_title_'.$i,true)!='' || get_post_meta($post_edit->ID,'_award_description_'.$i,true) || get_post_meta($post_edit->ID,'_award_year_'.$i,true)|| get_post_meta($post_edit->ID,'_award_image_id_'.$i,true) ){?>
															   
															   
															   <div id="award">
																   <div id="award_delete_<?php echo $i; ?>">
																   
																	<div class=" form-group">
																		<span class="pull-right"  > 
																		<button type="button" onclick="award_delete(<?php echo $i; ?>);"  class="btn btn-xs btn-danger">X</button>
																		</span>
																		<label for="text" class=" control-label"><?php esc_html_e('Award Title','chilepro'); ?>*
																		</label>
																		
																		<div class="  "> 
																			<input type="text" class="" name="award_title[]" id="award_title[]" value="<?php echo get_post_meta($post_edit->ID,'_award_title_'.$i,true); ?>" placeholder="<?php esc_html_e('Enter award title *required','chilepro'); ?>">
																		</div>																
																	</div>		
																	<div class=" form-group">
																		<label for="text" class=" control-label"><?php esc_html_e('Award Description','chilepro'); ?></label>
																		
																		<div class="  "> 
																			<input type="text" class="" name="award_description[]" id="award_description[]" value="<?php echo get_post_meta($post_edit->ID,'_award_description_'.$i,true); ?>" placeholder="<?php esc_html_e('Enter Award Description','chilepro'); ?>">
																		</div>																
																	</div>
																	<div class=" form-group">
																		<label for="text" class=" control-label"><?php esc_html_e('Year(s) for which award was received','chilepro'); ?></label>
																		
																		<div class="  "> 
																			<input type="text" class="" name="award_year[]" id="award_year[]" value="<?php echo get_post_meta($post_edit->ID,'_award_year_'.$i,true); ?>" placeholder="<?php esc_html_e('Enter Award Year','chilepro'); ?>">
																		</div>																
																	</div>	
																	<div class=" form-group " style="margin-top:10px">
																		<label for="text" class=" col-md-2 control-label"><?php esc_html_e('Award Image','chilepro'); ?>  </label>
																		<?php 
																				if(get_post_meta($post_edit->ID,'_award_image_id_'.$i,true)!=''){?>
																					<a  href="javascript:void(0);" onclick="award_post_image(this);"  >		
																					<img width="100px" src="<?php echo wp_get_attachment_url( get_post_meta($post_edit->ID,'_award_image_id_'.$i,true) ); ?> " >
																					<input type="hidden" name="award_image_id[]" id="award_image_id[]" value="<?php echo get_post_meta($post_edit->ID,'_award_image_id_'.$i,true); ?>">
																					</a>
																				<?php
																				}else{?>
																						<a  href="javascript:void(0);" onclick="award_post_image(this);"  >									
																						<?php  echo '<img width="100px" src="'. wp_iv_directories_URLPATH.'assets/images/image-add-icon.png">'; ?>			
																						</a>																					
																			<?php		
																				}																		
																			?>
																		<div class="col-md-4" id="award_image_div">																			
																							
																		</div>						
																	</div>
																</div>		
															</div>	
															 <div class="clearfix"></div>	 
															  <hr>
															 		
																	
															<?php
															$aw++;	
															}				 
														
														}
													if($aw==0){ ?>
															<div id="award">
															<div class=" form-group">
																<label for="text" class=" control-label"><?php esc_html_e('Award Title','chilepro'); ?></label>
																
																<div class="  "> 
																	<input type="text" class="" name="award_title[]" id="award_title[]" value="" placeholder="<?php esc_html_e('Enter award title','chilepro'); ?>">
																</div>																
															</div>		
															<div class=" form-group">
																<label for="text" class=" control-label"><?php esc_html_e('Award Description','chilepro'); ?></label>
																
																<div class="  "> 
																	<input type="text" class="" name="award_description[]" id="award_description[]" value="" placeholder="<?php esc_html_e('Enter Award Description','chilepro'); ?>">
																</div>																
															</div>
															<div class=" form-group">
																<label for="text" class=" control-label"><?php esc_html_e('Year(s) for which award was received','chilepro'); ?></label>
																
																<div class="  "> 
																	<input type="text" class="" name="award_year[]" id="award_year[]" value="" placeholder="<?php esc_html_e('Enter Award Year','chilepro'); ?>">
																</div>																
															</div>	
															<div class=" form-group " style="margin-top:10px">
																<label for="text" class=" col-md-2 control-label"><?php esc_html_e('Award Image','chilepro'); ?>  </label>
																<a  href="javascript:void(0);" onclick="award_post_image(this);"  >									
																	<?php  echo '<img width="100px" src="'. wp_iv_directories_URLPATH.'assets/images/image-add-icon.png">'; ?>			
																	</a>
																<div class="col-md-4" id="award_image_div">
																					
																</div>						
															</div>	
															</div>	
													
													<?php
													
													}			  
													  ?>																			
									 
									 </div>
											<div class=" row  form-group ">
												<div class="col-md-12" >	
												<button type="button" onclick="add_award_field();"  class="btn btn-xs green-haze"><?php esc_html_e('Add More','chilepro'); ?></button>
												</div>
											</div>
											
									
									
											<?php
											}else{
													_e('Please upgrade your account to add Award ','chilepro');
											}
											?>
									
								  </div>
								  
								</div>
					  </div>
					
					
					
					<div class="clearfix"></div>	
					<div class="panel panel-default">
								<div class="panel-heading">
								  <h4 class="panel-title col-lg-10">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapsethirtysix">
									  <?php esc_html_e('Our Doctors','chilepro'); ?>
									</a>
								  </h4>
									<h4 class="panel-title" style="text-align:right;color:#1AA2E1;font-size:12px;">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapsethirtysix">
									   <?php esc_html_e('Edit ','chilepro'); ?> <i class="fa fa-edit"></i>
									</a>
								  </h4>
								</div>
								<div id="collapsethirtysix" class="panel-collapse collapse">
								  <div class="panel-body">	
									  <?php
											// video, event , doctor , booking
										 if($this->check_write_access('doctor')){
												
												$sql="SELECT * FROM $wpdb->posts WHERE post_type='doctor'  and post_status IN ('publish')  ORDER BY `post_title` ASC ";									
												$doctors = $wpdb->get_results($sql);
												$total_post=count($doctors);									
												if(sizeof($total_post)>0){
													$i=0;
													$physician_list=get_post_meta($post_edit->ID,'physician_list',true);
																										
													?>										
													<div class=" form-group">
														<div class=""> 
															<select name="physician_list[]" id="physician_list[]" size="20" multiple="multiple"  class="">
																<?php
																foreach ( $doctors as $row_doctor )								
																{
																	$selected='';
																	if (in_array($row_doctor->ID,$physician_list)) {
																		$selected='selected';
																	}	
																?>																	
																	<option value="<?php echo $row_doctor->ID; ?>" <?php echo $selected;?> ><?php echo $row_doctor->post_title; ?></option>
																	
																<?php
																}
																?>																		
																</select>				
														</div>																
													</div>
											<?php
													
												}	
											?>
										
										<?php
										}else{
												_e('Please upgrade your account to add Physician ','chilepro');
										}
										?>
									
								  </div>
								</div>
					  </div>
					
					<div class="clearfix"></div>	
					<div class="panel panel-default">
								<div class="panel-heading">
								  <h4 class="panel-title col-lg-10">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
									  <?php esc_html_e('Videos','chilepro'); ?>
									</a>
								  </h4>
									<h4 class="panel-title" style="text-align:right;color:#1AA2E1;font-size:12px;">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
									   <?php esc_html_e('Edit ','chilepro'); ?> <i class="fa fa-edit"></i>
									</a>
								  </h4>
								</div>
								<div id="collapseThree" class="panel-collapse collapse">
								  <div class="panel-body">	
									  <?php
											// video, event , coupon , vip_badge
										 if($this->check_write_access('video')){
											
										?>										
										<div class=" form-group">
											
												<label for="text" class=" control-label"><?php esc_html_e('Youtube','chilepro'); ?></label>
												
												<div class="  "> 
													<input type="text" class="" name="youtube" id="youtube" value="<?php echo get_post_meta($post_edit->ID,'youtube',true); ?>" placeholder="<?php esc_html_e('Enter Youtube video ID, e.g : bU1QPtOZQZU ','chilepro'); ?>">
												</div>																
										</div>
										<div class=" form-group">
												<label for="text" class=" control-label"><?php esc_html_e('Vimeo','chilepro'); ?></label>
												
												<div class="  "> 
													<input type="text" class="" name="vimeo" id="vimeo" value="<?php echo get_post_meta($post_edit->ID,'vimeo',true); ?>" placeholder="<?php esc_html_e('Enter vimeo ID, e.g : 134173961','chilepro'); ?>">
												</div>																
										</div>
										<?php
										}else{
												_e('Please upgrade your account to add video ','chilepro');
										}
										?>
									
								  </div>
								</div>
					  </div>
					<div class="clearfix"></div>	
					<div class="panel panel-default">
								<div class="panel-heading">
								  <h4 class="panel-title col-lg-10">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapseFive">
									  <?php esc_html_e('Social Profiles','chilepro'); ?>
									</a>
								  </h4>
									<h4 class="panel-title" style="text-align:right;color:#1AA2E1;font-size:12px;">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapseFive">
									   <?php esc_html_e('Edit ','chilepro'); ?> <i class="fa fa-edit"></i>
									</a>
								  </h4>
								</div>
								<div id="collapseFive" class="panel-collapse collapse">
								  <div class="panel-body">											
										
										<div class="form-group">
										<label class="control-label">FaceBook</label>
										<input type="text" name="facebook" id="facebook" value="<?php echo get_post_meta($post_edit->ID,'facebook',true); ?>" class=""/>
									  </div>
									  <div class="form-group">
										<label class="control-label">Linkedin</label>
										<input type="text" name="linkedin" id="linkedin" value="<?php echo get_post_meta($post_edit->ID,'linkedin',true); ?>" class=""/>
									  </div>
									  <div class="form-group">
										<label class="control-label">Twitter</label>
										<input type="text" name="twitter" id="twitter" value="<?php echo get_post_meta($post_edit->ID,'twitter',true); ?>" class=""/>
									  </div>
									  <div class="form-group">
										<label class="control-label">Google+ </label>
										<input type="text" name="gplus" id="gplus" value="<?php echo get_post_meta($post_edit->ID,'gplus',true); ?>"  class=""/>
									  </div>
						  									
										
								  </div>
								</div>
					  </div>
					
					
					<div class="clearfix"></div>	
					<div class="panel panel-default">
								<div class="panel-heading">
								  <h4 class="panel-title col-lg-10">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
									  <?php esc_html_e('Additional Info','chilepro'); ?>
									</a>
								  </h4>
									<h4 class="panel-title" style="text-align:right;color:#1AA2E1;font-size:12px;">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
									 <?php esc_html_e('Edit ','chilepro'); ?> <i class="fa fa-edit"></i>
									</a>
								  </h4>
								</div>
								<div id="collapseTwo" class="panel-collapse collapse">
								  <div class="panel-body">											
										<?php							
											
											
											$default_fields = array();
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
											if(sizeof($field_set)<1){																
													$default_fields['profitNonProfit']='For-profit or non-profit?';
													$default_fields['size']='Size';
													$default_fields['cost']='Cost';
													$default_fields['average_stay']=' Average length of stay';
													$default_fields['ownership']='Ownership';
													$default_fields['accreditedBy']='Accredited by';	
													$default_fields['certifications']='Certifications';	
											 }							
																	
														
										$i=1;							
										foreach ( $default_fields as $field_key => $field_value ) { ?>	
												 <div class="form-group">
													<label class="control-label"><?php  echo $field_value; ?></label>
													<input type="text" placeholder="<?php echo 'Enter '.$field_value;?>" name="<?php echo $field_key;?>" id="<?php echo $field_key;?>"  class="" value="<?php echo get_post_meta($post_edit->ID,$field_key,true); ?>"/>
												  </div>
										
										<?php
										}
										?>			
										
								  </div>
								</div>
					  </div>
					
					
						  <div class="panel panel-default">
								<div class="panel-heading">
								  <h4 class="panel-title col-lg-10">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
									  <?php esc_html_e('Opening Time','chilepro'); ?> 
									</a>
								  </h4>
									<h4 class="panel-title" style="text-align:right;color:#1AA2E1;font-size:12px;">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
									  <?php esc_html_e('Edit ','chilepro'); ?> <i class="fa fa-edit"></i>
									</a>
								  </h4>
								</div>
								<div id="collapseOne" class="panel-collapse collapse">
								  <div class="panel-body">	
								  <?php					
										$opeing_days = get_post_meta($post_edit->ID ,'_opening_time',true);
										if($opeing_days!=''){?>						
											
											<?php	
												$i=1;
												if(sizeof($opeing_days)>0){
													foreach($opeing_days as $key => $item){
														$day_time = explode("|", $item);	
														echo '<div id="old_days'. $i .'">
															<div class="col-md-4"><h5>'.$key.'</h5></div> <div class="col-md-7"> <h5>: '.$day_time[0].' - '.$day_time[1].'</h5></div><div class="col-md-1"> <button type="button" onclick="remove_old_day('.$i.');"  class="btn btn-xs btn-danger">X</button> 												
															 </div>
															<input type="hidden" name="day_name[]" id="day_name[]" value="'.$key.'">
															<input type="hidden" name="day_value1[]" id="day_value1[]" value="'.$day_time[0].'">
															<input type="hidden" name="day_value2[]" id="day_value2[]" value="'.$day_time[1].'">
															</div>
															';
														$i++;
													}	
												}										
										}
									 ?>		
									<div id="day_field_div">
										<div class=" row form-group " id="day-row1" >									
											<div class=" col-md-4"> 
											<select name="day_name[]" id="day_name[]" class="">	
											<option value=""></option> 
											<option value="Monday"> <?php esc_html_e('Monday','chilepro'); ?>  </option> 
											<option value="Tuesday"><?php esc_html_e('Tuesday','chilepro'); ?></option> 
											<option value="Wednesday"><?php esc_html_e('Wednesday','chilepro'); ?></option> 
											<option value="Thursday"><?php esc_html_e('Thursday','chilepro'); ?></option> 
											<option value="Friday"><?php esc_html_e('Friday','chilepro'); ?></option> 
											<option value="Saturday"><?php esc_html_e('Saturday','chilepro'); ?></option> 
											<option value="Sunday"><?php esc_html_e('Sunday','chilepro'); ?></option> 
											</select>
											</div>		
											<div  class=" col-md-4">
											<select name="day_value1[]" id="day_value1[]" class="">
												<option value=""> </option>												
												<option value="Closed"><?php esc_html_e('Closed','chilepro'); ?> </option>	
												<option value="Always"><?php esc_html_e('Always','chilepro'); ?></option>											
												<option value="12:00 AM">12:00 AM </option>
												<option value="12:30 AM">12:30 AM </option>
												<option value="01:00 AM">01:00 AM </option>
												<option value="01:30 AM">01:30 AM </option>
												<option value="02:00 AM">02:00 AM </option>
												<option value="02:30 AM">02:30 AM </option>
												<option value="03:00 AM">03:00 AM </option>
												<option value="03:30 AM">03:30 AM </option>
												<option value="04:00 AM">04:00 AM </option>
												<option value="04:30 AM">04:30 AM </option>
												<option value="05:00 AM">05:00 AM </option>
												<option value="05:30 AM">05:30 AM </option>
												<option value="06:00 AM">06:00 AM </option>
												<option value="06:30 AM">06:30 AM </option>
												<option value="07:00 AM">07:00 AM </option>
												<option value="07:30 AM">07:30 AM </option>
												<option value="08:00 AM">08:00 AM </option>
												<option value="08:30 AM">08:30 AM </option>
												<option value="09:00 AM">09:00 AM </option>
												<option value="09:30 AM">09:30 AM </option>
												<option value="10:00 AM">10:00 AM </option>
												<option value="10:30 AM">10:30 AM </option>
												<option value="11:00 AM">11:00 AM </option>
												<option value="11:30 AM">11:30 AM </option>
												<option value="12:00 PM">12:00 PM </option>
												<option value="12:30 PM">12:30 PM </option>
												<option value="01:00 PM">01:00 PM </option>
												<option value="01:30 PM">01:30 PM </option>
												<option value="02:00 PM">02:00 PM </option>
												<option value="02:30 PM">02:30 PM </option>
												<option value="03:00 PM">03:00 PM </option>
												<option value="03:30 PM">03:30 PM </option>
												<option value="04:00 PM">04:00 PM </option>
												<option value="04:30 PM">04:30 PM </option>
												<option value="05:00 PM">05:00 PM </option>
												<option value="05:30 PM">05:30 PM </option>
												<option value="06:00 PM">06:00 PM </option>
												<option value="06:30 PM">06:30 PM </option>
												<option value="07:00 PM">07:00 PM </option>
												<option value="07:30 PM">07:30 PM </option>
												<option value="08:00 PM">08:00 PM </option>
												<option value="08:30 PM">08:30 PM </option>
												<option value="09:00 PM">09:00 PM </option>
												<option value="09:30 PM">09:30 PM </option>
												<option value="10:00 PM">10:00 PM </option>
												<option value="10:30 PM">10:30 PM </option>
												<option value="11:00 PM">11:00 PM </option>
												<option value="11:30 PM">11:30 PM </option>
												<option value="12:00 PM">12:00 PM </option>
											</select>
												
												
											</div>
											<div  class="col-md-4">
											
												<select name="day_value2[]" id="day_value2[]" class="">
												<option value=""> </option>
												<option value="12:00 AM">12:00 AM </option>
												<option value="12:30 AM">12:30 AM </option>
												<option value="01:00 AM">01:00 AM </option>
												<option value="01:30 AM">01:30 AM </option>
												<option value="02:00 AM">02:00 AM </option>
												<option value="02:30 AM">02:30 AM </option>
												<option value="03:00 AM">03:00 AM </option>
												<option value="03:30 AM">03:30 AM </option>
												<option value="04:00 AM">04:00 AM </option>
												<option value="04:30 AM">04:30 AM </option>
												<option value="05:00 AM">05:00 AM </option>
												<option value="05:30 AM">05:30 AM </option>
												<option value="06:00 AM">06:00 AM </option>
												<option value="06:30 AM">06:30 AM </option>
												<option value="07:00 AM">07:00 AM </option>
												<option value="07:30 AM">07:30 AM </option>
												<option value="08:00 AM">08:00 AM </option>
												<option value="08:30 AM">08:30 AM </option>
												<option value="09:00 AM">06:00 AM </option>
												<option value="09:30 AM">09:30 AM </option>
												<option value="10:00 AM">10:00 AM </option>
												<option value="10:30 AM">10:30 AM </option>
												<option value="11:00 AM">11:00 AM </option>
												<option value="11:30 AM">11:30 AM </option>
												<option value="12:00 PM">12:00 PM </option>
												<option value="12:30 PM">12:30 PM </option>
												<option value="01:00 PM">01:00 PM </option>
												<option value="01:30 PM">01:30 PM </option>
												<option value="02:00 PM">02:00 PM </option>
												<option value="02:30 PM">02:30 PM </option>
												<option value="03:00 PM">03:00 PM </option>
												<option value="03:30 PM">03:30 PM </option>
												<option value="04:00 PM">04:00 PM </option>
												<option value="04:30 PM">04:30 PM </option>
												<option value="05:00 PM">05:00 PM </option>
												<option value="05:30 PM">05:30 PM </option>
												<option value="06:00 PM">06:00 PM </option>
												<option value="06:30 PM">06:30 PM </option>
												<option value="07:00 PM">07:00 PM </option>
												<option value="07:30 PM">07:30 PM </option>
												<option value="08:00 PM">08:00 PM </option>
												<option value="08:30 PM">08:30 PM </option>
												<option value="09:00 PM">09:00 PM </option>
												<option value="09:30 PM">09:30 PM </option>
												<option value="10:00 PM">10:00 PM </option>
												<option value="10:30 PM">10:30 PM </option>
												<option value="11:00 PM">11:00 PM </option>
												<option value="11:30 PM">11:30 PM </option>
												<option value="12:00 PM">12:00 PM </option>
											</select>
												
											</div>
											
										</div>
									</div>	
											
									<div class=" row  form-group ">
										<div class="col-md-12" >	
										<button type="button" onclick="add_day_field();"  class="btn btn-xs green-haze"><?php esc_html_e('Add More','chilepro'); ?></button>
										</div>
									</div>	
								  </div>
								</div>
					  </div>
					<div class="clearfix"></div>	
					<div class="panel panel-default">
								<div class="panel-heading">
								  <h4 class="panel-title col-lg-10">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapseSix">
									  <?php esc_html_e('Event','chilepro'); ?>
									</a>
								  </h4>
									<h4 class="panel-title" style="text-align:right;color:#1AA2E1;font-size:12px;">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapseSix">
									  <?php esc_html_e('Edit ','chilepro'); ?> <i class="fa fa-edit"></i>
									</a>
								  </h4>
								</div>
								<div id="collapseSix" class="panel-collapse collapse">
								  <div class="panel-body">											
										<?php
											// video, event , coupon , vip_badge , booking
										 if($this->check_write_access('event')){
											
										?>		
										<div class=" form-group">
											<label for="text" class=" control-label"><?php esc_html_e('Event Title','chilepro'); ?></label>
												<input type="text" class="" name="event-title" id="event-title" value="<?php echo get_post_meta($post_edit->ID,'event_title',true); ?>" placeholder="<?php esc_html_e('Enter Title Here','chilepro'); ?>">							
										</div>	
										<div class=" form-group">
											<label for="text" class=" control-label"><?php esc_html_e('Event Detail','chilepro'); ?></label>
												<?php
													$settings_a = array(															
														'textarea_rows' =>10,	
														'editor_class' => ''															 
														);
													$content_client = get_post_meta($post_edit->ID,'event_detail',true);//$content;//get_option( 'iv_directories_signup_email');
													$editor_id = 'event-detail';
													//wp_editor( $content_client, $editor_id,$settings_a );	
																						
													?>
													<textarea id="event-detail" name="event-detail"  rows="4" class="" > <?php echo $content_client; ?> </textarea>
											
												
												
										</div>
										<div class=" row form-group " style="margin-top:10px">
											<label for="text" class=" col-md-5 control-label"><?php esc_html_e('Event Image','chilepro'); ?>  </label>
										
											<div class="col-md-4" id="event_image_div">										
												
											
													<?php
													
													if(get_post_meta($post_edit->ID,'_event_image_id',true)!=''){
															$event_image_src= wp_get_attachment_url( get_post_meta($post_edit->ID,'_event_image_id',true) );
															?>
															<img  class="img-responsive"  src="<?php echo $event_image_src; ?>">
																														
													
													<?php		
													}else{ ?>
															<a  href="javascript:void(0);" onclick="event_post_image('event_image_div');"  >									
															<?php  echo '<img width="100px" src="'. wp_iv_directories_URLPATH.'assets/images/image-add-icon.png">'; ?>	
															</a>
															
																
															
													<?php
													}
													?>			
											</div>
										
											<div class="col-md-3" id="event_image_edit">	
													<?php
													
													if(get_post_meta($post_edit->ID,'_event_image_id',true)!=''){
															
															?>															
															<button type="button" onclick="event_post_image('event_image_div');"  class="btn btn-xs green-haze">Edit</button> &nbsp;<button type="button" onclick="remove_event_image('event_image_div');"  class="btn btn-xs green-haze">Remove</button>
															
													
													<?php		
													}else{ ?>
															<button type="button" onclick="event_post_image('event_image_div');"  class="btn btn-xs green-haze"><?php esc_html_e('Add','chilepro'); ?></button>
													<?php
													}
													?>		
											</div>	
											
											<input type="hidden" name="event_image_id" id="event_image_id" value="<?php echo get_post_meta($post_edit->ID,'_event_image_id',true); ?>" >
											
																				
										</div>	
										<?php
										}else{
												_e('Please upgrade your account to add event ','chilepro');
										}
										?>
								  </div>
								
								</div>
					  </div>
				
						
						
						
								<div class="margiv-top-10">
								    <div class="" id="update_message"></div>
									<input type="hidden" name="user_post_id" id="user_post_id" value="<?php echo $curr_post_id; ?>">
								    <button type="button" onclick="iv_update_post();"  class="btn green-haze"><?php esc_html_e('Save Post','chilepro'); ?></button>
		                          
		                        </div>	
									 
							</form>
						  </div>
						</div>
			<?php
			
				} // for Role
			
		
				
			?>
					
			

                      
					 </div>
                     
                  </div>
                </div>
              </div>
            </div>
          <!-- END PROFILE CONTENT -->

          
	 <script>				 
function iv_update_post (){
	tinyMCE.triggerSave();	
	var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
	var loader_image = '<img src="<?php echo wp_iv_directories_URLPATH. "admin/files/images/loader.gif"; ?>" />';
				jQuery('#update_message').html(loader_image);
				var search_params={
					"action"  : 	"iv_directories_update_hospital",	
					"form_data":	jQuery("#edit_post").serialize(), 
				};
				jQuery.ajax({					
					url : ajaxurl,					 
					dataType : "json",
					type : "post",
					data : search_params,
					success : function(response){
						if(response.code=='success'){
								var url = "<?php echo get_permalink(); ?>?&profile=all-post";    						
								jQuery(location).attr('href',url);	
						}
						//jQuery('#update_message').html('<div class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">x</a>'+response.msg +'.</div>');
						
					}
				});
	
	}
function add_day_field(){
	var main_opening_div =jQuery('#day-row1').html(); 
	jQuery('#day_field_div').append('<div class="clearfix"></div><div class=" row form-group" >'+main_opening_div+'</div>');

}
function  remove_post_image	(profile_image_id){
	jQuery('#'+profile_image_id).html('');
	jQuery('#feature_image_id').val(''); 
	jQuery('#post_image_edit').html('<button type="button" onclick="edit_post_image(\'post_image_div\');"  class="btn btn-xs green-haze">Add</button>');  

}
function  remove_event_image	(profile_image_id){
	jQuery('#'+profile_image_id).html('');
	jQuery('#event_image_id').val(''); 
	jQuery('#event_image_edit').html('<button type="button" onclick="event_post_image(\'event_image_div\');"  class="btn btn-xs green-haze">Add</button>');  

}
function  remove_deal_image	(profile_image_id){
	jQuery('#'+profile_image_id).html('');
	jQuery('#deal_image_id').val(''); 
	jQuery('#deal_image_edit').html('<button type="button" onclick="deal_post_image(\'deal_image_div\');"  class="btn btn-xs green-haze">Add</button>');  

}	
 function edit_post_image(profile_image_id){	
				var image_gallery_frame;

               // event.preventDefault();
                image_gallery_frame = wp.media.frames.downloadable_file = wp.media({
                    // Set the title of the modal.
                    title: "<?php esc_html_e( 'Set Feature Image ', 'chilepro' ); ?>",
                    button: {
                        text: "<?php esc_html_e( 'Set Feature Image', 'chilepro' ); ?>",
                    },
                    multiple: false,
                    displayUserSettings: true,
                });                
                image_gallery_frame.on( 'select', function() {
                    var selection = image_gallery_frame.state().get('selection');
                    selection.map( function( attachment ) {
                        attachment = attachment.toJSON();
                        if ( attachment.id ) {
							jQuery('#'+profile_image_id).html('<img  class="img-responsive"  src="'+attachment.sizes.thumbnail.url+'">');
							jQuery('#feature_image_id').val(attachment.id ); 
							jQuery('#post_image_edit').html('<button type="button" onclick="edit_post_image(\'post_image_div\');"  class="btn btn-xs green-haze">Edit</button> &nbsp;<button type="button" onclick="remove_post_image(\'post_image_div\');"  class="btn btn-xs green-haze">Remove</button>');  
						   
						}
					});
                   
                });               
				image_gallery_frame.open(); 
				
	}
function event_post_image(profile_image_id){	
				var image_gallery_frame;

               // event.preventDefault();
                image_gallery_frame = wp.media.frames.downloadable_file = wp.media({
                    // Set the title of the modal.
                    title: "<?php esc_html_e( 'Set Event Image ', 'chilepro' ); ?>",
                    button: {
                        text: "<?php esc_html_e( 'Set Event Image', 'chilepro' ); ?>",
                    },
                    multiple: false,
                    displayUserSettings: true,
                });                
                image_gallery_frame.on( 'select', function() {
                    var selection = image_gallery_frame.state().get('selection');
                    selection.map( function( attachment ) {
                        attachment = attachment.toJSON();
                        if ( attachment.id ) {
							jQuery('#'+profile_image_id).html('<img  class="img-responsive"  src="'+attachment.sizes.thumbnail.url+'">');
							jQuery('#event_image_id').val(attachment.id ); 
							jQuery('#event_image_edit').html('<button type="button" onclick="event_post_image(\'event_image_div\');"  class="btn btn-xs green-haze">Edit</button> &nbsp;<button type="button" onclick="remove_event_image(\'event_image_div\');"  class="btn btn-xs green-haze">Remove</button>');  
						   
						}
					});
                   
                });               
				image_gallery_frame.open(); 
				
	}
function deal_post_image(profile_image_id){	
				var image_gallery_frame;

               // event.preventDefault();
                image_gallery_frame = wp.media.frames.downloadable_file = wp.media({
                    // Set the title of the modal.
                    title: "<?php esc_html_e( 'Set Deal/Coupon Image ', 'chilepro' ); ?>",
                    button: {
                        text: "<?php esc_html_e( 'Set Deal/Coupon Image', 'chilepro' ); ?>",
                    },
                    multiple: false,
                    displayUserSettings: true,
                });                
                image_gallery_frame.on( 'select', function() {
                    var selection = image_gallery_frame.state().get('selection');
                    selection.map( function( attachment ) {
                        attachment = attachment.toJSON();
                        if ( attachment.id ) {
							jQuery('#'+profile_image_id).html('<img  class="img-responsive"  src="'+attachment.sizes.thumbnail.url+'">');
							jQuery('#deal_image_id').val(attachment.id ); 
							jQuery('#deal_image_edit').html('<button type="button" onclick="deal_post_image(\'deal_image_div\');"  class="btn btn-xs green-haze">Edit</button> &nbsp;<button type="button" onclick="remove_deal_image(\'deal_image_div\');"  class="btn btn-xs green-haze">Remove</button>');  
						   
						}
					});
                   
                });               
				image_gallery_frame.open(); 
				
	}			
 function edit_gallery_image(profile_image_id){
				
				var image_gallery_frame;
				var hidden_field_image_ids = jQuery('#gallery_image_ids').val();
               // event.preventDefault();
                image_gallery_frame = wp.media.frames.downloadable_file = wp.media({
                    // Set the title of the modal.
                    title: "<?php esc_html_e( 'Gallery Images ', 'chilepro' ); ?>",
                    button: {
                        text: "<?php esc_html_e( 'Gallery Images', 'chilepro' ); ?>",
                    },
                    multiple: true,
                    displayUserSettings: true,
                });                
                image_gallery_frame.on( 'select', function() {
                    var selection = image_gallery_frame.state().get('selection');
                    selection.map( function( attachment ) {
                        attachment = attachment.toJSON();
                        console.log(attachment);
                        if ( attachment.id ) {
							jQuery('#'+profile_image_id).append('<div id="gallery_image_div'+attachment.id+'" class="col-md-3"><img  class="img-responsive"  src="'+attachment.sizes.thumbnail.url+'"><button type="button" onclick="remove_gallery_image(\'gallery_image_div'+attachment.id+'\', '+attachment.id+');"  class="btn btn-xs btn-danger">Remove</button> </div>');
							
							hidden_field_image_ids=hidden_field_image_ids+','+attachment.id ;
							jQuery('#gallery_image_ids').val(hidden_field_image_ids); 
							
							//jQuery('#gallery_image_edit').html('');  
						   
						}
					});
                   
                });               
				image_gallery_frame.open(); 

 }			

function  remove_gallery_image(img_remove_div,rid){	
	var hidden_field_image_ids = jQuery('#gallery_image_ids').val();	
	hidden_field_image_ids =hidden_field_image_ids.replace(rid, '');	
	jQuery('#'+img_remove_div).remove();
	jQuery('#gallery_image_ids').val(hidden_field_image_ids); 
	//jQuery('#gallery_gallery_edit').html('');  

}	
function remove_old_day(div_id){
	jQuery('#old_days'+div_id).remove();
}	
 function logo_post_image(profile_image_id){	
				var image_gallery_frame;
               // event.preventDefault();
                image_gallery_frame = wp.media.frames.downloadable_file = wp.media({
                    // Set the title of the modal.
                    title: "<?php esc_html_e( 'Set Logo Image ', 'chilepro' ); ?>",
                    button: {
                        text: "<?php esc_html_e( 'Set Logo Image', 'chilepro' ); ?>",
                    },
                    multiple: false,
                    displayUserSettings: true,
                });                
                image_gallery_frame.on( 'select', function() {
                    var selection = image_gallery_frame.state().get('selection');
                    selection.map( function( attachment ) {
                        attachment = attachment.toJSON();
                        if ( attachment.id ) {
							jQuery('#'+profile_image_id).html('<img  class="img-responsive"  src="'+attachment.sizes.thumbnail.url+'">');
							jQuery('#logo_image_id').val(attachment.id ); 
							jQuery('#logo_image_edit').html('<button type="button" onclick="edit_post_image(\'logo_image_div\');"  class="btn btn-xs green-haze">Edit</button> &nbsp;<button type="button" onclick="remove_post_image(\'logo_image_div\');"  class="btn btn-xs green-haze">Remove</button>');  						   
						}
					});                   
                });               
				image_gallery_frame.open(); 				
	}
function add_award_field(){
	var main_award_div =jQuery('#award').html(); 
	jQuery('#awards').append('<div class="clearfix"></div><hr>'+main_award_div+'');
}	
function award_post_image(awardthis){	
				var image_gallery_frame;
               // event.preventDefault();
                image_gallery_frame = wp.media.frames.downloadable_file = wp.media({
                    // Set the title of the modal.
                    title: "<?php esc_html_e( 'Set award Image ', 'chilepro' ); ?>",
                    button: {
                        text: "<?php esc_html_e( 'Set award Image', 'chilepro' ); ?>",
                    },
                    multiple: false,
                    displayUserSettings: true,
                });                
                image_gallery_frame.on( 'select', function() {
                    var selection = image_gallery_frame.state().get('selection');
                    selection.map( function( attachment ) {
                        attachment = attachment.toJSON();
                        if ( attachment.id ) {		
													
							jQuery(awardthis).html('<img  class="img-responsive"  src="'+attachment.sizes.thumbnail.url+'"><input type="hidden" name="award_image_id[]" id="award_image_id[]" value="'+attachment.id+'">');
							
							
						}
					});                   
                });               
				image_gallery_frame.open(); 				
	}	
function award_delete(id_delete){
	
	jQuery('#award_delete_'+id_delete).remove();
	
}		
 </script>	  
        
