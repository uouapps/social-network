

        <div class="network">
            <h4>Information</h4>
                 
                     <ul class="nav nav-tabs">
					  <li class="active"><a data-toggle="tab" href="#tab_1_1"><?php  esc_html_e('Personal Info','chilepro');?> </a></li>
					  <li> <a data-toggle="tab" href="#tab_1_5"><?php  esc_html_e('Social Profile','chilepro');?></a></li>
					  <li><a data-toggle="tab" href="#tab_1_3" ><?php  esc_html_e('Change Password','chilepro');?></a></li>
					  
					 <!-- <li ><a data-toggle="tab" href="#tab_1_4" ><?php  esc_html_e('Privacy Settings','chilepro');?></a></li>-->
					</ul>
					
                   
                
                  
                 
                    <div class="tab-content">
                    
                      <div class="tab-pane active" id="tab_1_1">
                        <form role="form" name="profile_setting_form" id="profile_setting_form" action="#">
							<div class=" form-group">
									<label for="text" class=" control-label"><?php esc_html_e('Name','chilepro'); ?></label>
									<div class="  "> 
										<input type="text" class="" name="title" id="title" value="<?php echo get_user_meta($current_user->ID,'profile_name',true); ?>" placeholder="<?php esc_html_e('Enter Your Name Here','chilepro'); ?>">
									</div>																		
								</div>
							<div class=" form-group">
									<label for="text" class=" control-label"><?php esc_html_e('Designation','chilepro'); ?></label>
									<div class="  "> 
										<input type="text" class="" name="designation" id="designation" value="<?php echo get_user_meta($current_user->ID,'designation',true); ?>" placeholder="<?php esc_html_e('Enter Your Designation Here','chilepro'); ?>">
									</div>																		
								</div>
							
							
							<div class=" form-group">
									<label for="text" class=" control-label"><?php  _e('About','chilepro');?></label>
							</div>		
							
							<div class="form-group">										
									<div class=" ">
									<?php
										$settings_a = array(															
											'textarea_rows' =>5,
											//'editor_class' => 'form-control'															 
											);	
										$description_value1=get_user_meta($current_user->ID,'about_us',true);																					
										$editor_id1 = 'about_us';
										wp_editor( $description_value1, $editor_id1,$settings_a );										
										?>
								
								</div>									
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
											$gallery_ids=get_user_meta($current_user->ID ,'image_gallery_ids',true);
											$gallery_ids_array = array_filter(explode(",", $gallery_ids));
											?>
										<input type="hidden" name="gallery_image_ids" id="gallery_image_ids" value="<?php echo $gallery_ids; ?>">
										
										<div class="col-md-12" id="gallery_image_div">
											<?php
												if(sizeof($gallery_ids_array)>0){ 
													foreach($gallery_ids_array as $slide){	
														
												?>
												<div id="gallery_image_div<?php echo $slide;?>" class="col-md-3"><img  class="img-responsive"  src="<?php echo wp_get_attachment_url( $slide ); ?>"><button type="button" onclick="remove_gallery_image('gallery_image_div<?php echo $slide;?>', <?php echo $slide;?>);"  class="btn btn-xs btn-danger"><?php esc_html_e('Remove','medico'); ?></button> </div>
												<?php
													}
												 }
												?>
												
										</div>									
								</div>
								
								
							<div class=" form-group">
							<label for="text" class=" control-label"><?php esc_html_e('Address','chilepro'); ?></label>							
							<div class=" "> 
								<input type="text" class="" name="address" id="address" value="<?php echo get_user_meta($current_user->ID,'address',true); ?>" placeholder="<?php esc_html_e('Enter here Here','chilepro'); ?>">
							</div>
							<input type="hidden" id="latitude" name="latitude"  value="<?php echo get_user_meta($current_user->ID,'latitude',true); ?>" >
							<input type="hidden" id="longitude" name="longitude"  value="<?php echo get_user_meta($current_user->ID,'longitude',true); ?>" >
                            <input type="hidden" id="city" name="city" value="<?php echo get_user_meta($current_user->ID,'city',true); ?>" /> 
                            <input type="hidden" id="state" name="state" value="<?php echo get_user_meta($current_user->ID,'state',true); ?>" /> 
                            <input type="hidden" id="postcode" name="postcode" value="<?php echo get_user_meta($current_user->ID,'postcode',true); ?>" /> 
                            <input type="hidden" id="country" name="country" value="<?php echo get_user_meta($current_user->ID,'country',true); ?>" /> 		 								
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

									  var latlng = new google.maps.LatLng(40.748817, -73.985428);
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
										//alert(city.medico + " " + city.long_name)


										} else {
										  
										}
									  } else {
										
									  }
									});
								  }

						    </script>
							</div>																
						</div>
						
						
						<div class="panel panel-default">
								<div class="panel-heading">
								  <h4 class="panel-title col-lg-10">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
									  <?php esc_html_e('Detail','medico'); ?>
									</a>
								  </h4>
									<h4 class="panel-title" style="text-align:right;color:#1AA2E1;font-size:12px;">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
									  <?php esc_html_e('Edit  ','medico'); ?> <i class="fa fa-edit"></i> 
									</a>
								  </h4>
								</div>
								<div id="collapseFour" class="panel-collapse collapse">
								  <div class="panel-body">											
													 <?php											
												$default_fields = array();
												$field_set=get_option('iv_social_profile_personal_fields' );
											
												if($field_set!=""){ 
														$default_fields=get_option('iv_social_profile_personal_fields' );
												}else{									
													$default_fields['Age']=esc_html__('Age','medico');
													$default_fields['Location']=esc_html__('Location','medico');
													$default_fields['Experiance']=esc_html__('Experiance','medico');
													$default_fields['Dgree']=esc_html__('Dgree','medico');
													$default_fields['Career Lavel']=esc_html__('Career Lavel','medico');
													$default_fields['Phone']=esc_html__('Phone','medico');								
													$default_fields['Fax']=esc_html__('Fax','medico');	
													$default_fields['E-mail']=esc_html__('E-mail','medico');
													$default_fields['web_site']=esc_html__('Website Url','medico');
													
												}
											 if(sizeof($field_set)<1){
													$default_fields['Age']=esc_html__('Age','medico');
													$default_fields['Location']=esc_html__('Location','medico');
													$default_fields['Experiance']=esc_html__('Experiance','medico');
													$default_fields['Dgree']=esc_html__('Dgree','medico');
													$default_fields['Career Lavel']=esc_html__('Career Lavel','medico');
													$default_fields['Phone']=esc_html__('Phone','medico');								
													$default_fields['Fax']=esc_html__('Fax','medico');	
													$default_fields['E-mail']=esc_html__('E-mail','medico');
													$default_fields['web_site']=esc_html__('Website Url','medico');
											 }									
															
											$i=1;							
											foreach ( $default_fields as $field_key => $field_value ) { ?>	
													 <div class="form-group">
														<label class="control-label"><?php echo $field_value; ?></label>
														<input type="text" placeholder="<?php echo 'Enter '.$field_value;?>" name="<?php echo $field_key;?>" id="<?php echo $field_key;?>"  class="" value="<?php echo get_user_meta($current_user->ID,$field_key,true); ?>"/>
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
									<a data-toggle="collapse" data-parent="#accordion" href="#collapsethirty2">
									  <?php esc_html_e('Skills','medico'); ?>
									</a>
								  </h4>
									<h4 class="panel-title" style="text-align:right;color:#1AA2E1;font-size:12px;">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapsethirty2">
									   <?php esc_html_e('Edit  ','medico'); ?> <i class="fa fa-edit"></i> 
									</a>
								  </h4>
								</div>
								<div id="collapsethirty2" class="panel-collapse collapse">
								  <div class="panel-body">	
									   <div style="display: none;">
											<div id="service-main">
												<div id="service">
													<div class=" form-group">
															<label for="text" class=" control-label"><?php esc_html_e('Skill Title','chilepro'); ?>*</label>
															
															<div class="  "> 
																<input type="text" class="" name="service_title[]" id="service_title[]" value="" placeholder="<?php esc_html_e('Enter Skill title *required','chilepro'); ?>">
															</div>																
														</div>	
														<div class=" form-group">
															<label for="text" class=" control-label"><?php esc_html_e('Skill Level (%)','chilepro'); ?></label>
															
															<div class="  "> 
																<input type="text" class="" name="service_value[]" id="service_value[]" value="" placeholder="<?php esc_html_e('Enter Skill Level (%)','chilepro'); ?>">
															</div>																
														</div>													
														<div class=" form-group">
															<label for="text" class=" control-label"><?php esc_html_e('Skill Description','chilepro'); ?></label>
														</div>		
															<div class="form-group">										
																	<textarea id="service_description[]" name="service_description[]"> </textarea>								
															</div>
												</div>	
											</div>
									   </div> 
									  <div id="servicess">
										 <div id="service">	
											 
											 
											 	<?php	$aw=0;	 
													   for($i=0;$i<20;$i++){
														 		  
														   if(get_user_meta($current_user->ID,'_service_title_'.$i,true)!='' || get_user_meta($current_user->ID,'_service_description_'.$i,true) ){?>
															   
															   
															   <div id="service">
																   <div id="service_delete_<?php echo $i; ?>">
																   <div class=" form-group">
																		<span class="pull-right"  > 
																		<button type="button" onclick="service_delete(<?php echo $i; ?>);"  class="btn btn-xs btn-danger">X</button>
																		</span>
																		<label for="text" class=" control-label"><?php esc_html_e('Skill Title','medico'); ?>*
																		</label>
																		
																		<div class="  "> 
																			<input type="text" class="" name="service_title[]" id="service_title[]" value="<?php echo get_user_meta($current_user->ID,'_service_title_'.$i,true); ?>" placeholder="<?php esc_html_e('Enter service title *required','medico'); ?>">
																		</div>																
																	</div>	
																  	<div class=" form-group">
																		<label for="text" class=" control-label"><?php esc_html_e('Skill Level (%)','chilepro'); ?></label>
																		
																		<div class="  "> 
																			<input type="text" class="" name="service_value[]" id="service_value[]" value="<?php echo get_user_meta($current_user->ID,'_service_value_'.$i,true); ?>" placeholder="<?php esc_html_e('Enter Skill Level (%)','chilepro'); ?>">
																		</div>																
																	</div>																	
																	<div class="form-group">	
																		<label for="text" class=" control-label"><?php esc_html_e('Skill Description','chilepro'); ?></label>
																		<textarea id="service_description[]" name="service_description[]"><?php echo get_user_meta($current_user->ID,'_service_description_'.$i,true); ?> </textarea>									
																												
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
															<div id="service">
																	<div class=" form-group">
																		<label for="text" class=" control-label"><?php esc_html_e('Skill Title','chilepro'); ?>*</label>
																		
																		<div class="  "> 
																			<input type="text" class="" name="service_title[]" id="service_title[]" value="" placeholder="<?php esc_html_e('Enter services title *required','chilepro'); ?>">
																		</div>																
																	</div>
																	<div class=" form-group">
																		<label for="text" class=" control-label"><?php esc_html_e('Skill Level (%)','chilepro'); ?></label>
																		
																		<div class="  "> 
																			<input type="text" class="" name="service_value[]" id="service_value[]" value="" placeholder="<?php esc_html_e('Enter Skill Level (%)','chilepro'); ?>">
																		</div>																
																	</div>	
																	<div class=" form-group">
																		<label for="text" class=" control-label"><?php esc_html_e('Skill Description','chilepro'); ?></label>
																	</div>		
																		<div class="form-group">
																													
																					<textarea id="service_description[]" name="service_description[]"> </textarea>								
																		</div>
															</div>	
													
													<?php
													
													}			  
													  ?>
													  
											 
													
										</div>								
									</div>
									<div class=" row  form-group ">
										<div class="col-md-12" >	
										<button type="button" onclick="add_services_field();"  class="btn btn-xs green-haze"><?php esc_html_e('Add More','chilepro'); ?></button>
										</div>
									</div>
									
									
									
									
									
								  </div>
								</div>
					  </div>
					
					
                        
                        
                          <div class="margiv-top-10">
						    <div class="" id="update_message"></div>
						    <button type="button" onclick="update_profile_setting();"  class="btn-new btn-custom"><?php  esc_html_e('Save Changes','chilepro');?></button>
                          
                          </div>
                        </form>
                      </div>
                      
					  <div class="tab-pane" id="tab_1_3">
                        <form action="" name="pass_word" id="pass_word">
                          <div class="form-group">
                            <label class="control-label"><?php  esc_html_e('Current Password','chilepro');?> </label>
                            <input type="password" id="c_pass" name="c_pass" class=""/>
                          </div>
                          <div class="form-group">
                            <label class="control-label"><?php  esc_html_e('New Password','chilepro');?> </label>
                            <input type="password" id="n_pass" name="n_pass" class=""/>
                          </div>
                          <div class="form-group">
                            <label class="control-label"><?php  esc_html_e('Re-type New Password','chilepro');?> </label>
                            <input type="password" id="r_pass" name="r_pass" class=""/>
                          </div>
                          <div class="margin-top-10">
                            <div class="" id="update_message_pass"></div>
							 <button type="button" onclick="iv_update_password();"  class="btn-new btn-custom"><?php  esc_html_e('Change Password','chilepro');?> </button>
                           
                          </div>
                        </form>
                      </div>
					  
					  <div class="tab-pane" id="tab_1_5">
                        <form action="#" name="setting_fb" id="setting_fb">
                          <div class="form-group">
                            <label class="control-label">FaceBook</label>
                            <input type="text" name="facebook" id="facebook" value="<?php echo get_user_meta($current_user->ID,'facebook',true); ?>" class=""/>
                          </div>
                          <div class="form-group">
                            <label class="control-label">Linkedin</label>
                            <input type="text" name="linkedin" id="linkedin" value="<?php echo get_user_meta($current_user->ID,'linkedin',true); ?>" class=""/>
                          </div>
                          <div class="form-group">
                            <label class="control-label">Twitter</label>
                            <input type="text" name="twitter" id="twitter" value="<?php echo get_user_meta($current_user->ID,'twitter',true); ?>" class=""/>
                          </div>
						  <div class="form-group">
                            <label class="control-label">Google+ </label>
                            <input type="text" name="gplus" id="gplus" value="<?php echo get_user_meta($current_user->ID,'gplus',true); ?>"  class=""/>
                          </div>
						  
						  
                          <div class="margin-top-10">
						     <div class="" id="update_message_fb"></div>
                            <button type="button" onclick="iv_update_fb();"  class="btn-new btn-custom"><?php  esc_html_e('Save Changes','chilepro');?> </button>
                           
                          </div>
                        </form>
                      </div>
                      <div class="tab-pane" id="tab_1_4">
                        <form action="#" name="setting_hide_form" id="setting_hide_form">
                        <div class="table-responsive">
                          <table class="table table-light table-hover">
                       
                          <tr>
                            <td style="font-size:14px">
                              <?php  esc_html_e('Hide Email Address ','chilepro');?> 
                            </td>
                            <td>
                              <label class="uniform-inline">
                              <input type="checkbox" id="email_hide" name="email_hide"  value="yes" <?php echo( get_user_meta($current_user->ID,'hide_email',true)=='yes'? 'checked':''); ?>/> <?php  esc_html_e('Yes','chilepro');?>  </label>
                            </td>
                          </tr>
                          <tr>
                            <td style="font-size:14px">
                               <?php  esc_html_e('Hide Phone Number','chilepro');?> 
                            </td>
                            <td>
                              <label class="uniform-inline">
                              <input type="checkbox" id="phone_hide" name="phone_hide" value="yes" <?php echo( get_user_meta($current_user->ID,'hide_phone',true)=='yes'? 'checked':''); ?>  /> <?php  esc_html_e('Yes','chilepro');?>  </label>
                            </td>
                          </tr>
                          <tr>
                            <td style="font-size:14px">
                              <?php  esc_html_e('Hide Mobile Number','chilepro');?> 
                            </td>
                            <td>
                              <label class="uniform-inline">
                              <input type="checkbox" id="mobile_hide" name="mobile_hide" value="yes"  <?php echo( get_user_meta($current_user->ID,'hide_mobile',true)=='yes'? 'checked':''); ?> /> <?php  esc_html_e('Yes','chilepro');?>  </label>
                            </td>
                          </tr>
                          </table>
                          </div>
                          <!--end profile-settings-->
                          <div class="margin-top-10">
						  <div class="" id="update_message_hide"></div>
						   <button type="button" onclick="iv_update_hide_setting();"  class="btn-new btn-custom"><?php  esc_html_e('Save Changes','chilepro');?> </button>
                          
                           
                          </div>
                        </form>
                      </div>
                    
                  </div>
               
             
            </div>
          <!-- END PROFILE CONTENT -->
 <script>
 
function iv_update_hide_setting (){
	
	var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
	var loader_image = '<img src="<?php echo wp_iv_directories_URLPATH. "admin/files/images/loader.gif"; ?>" />';
				jQuery('#update_message_hide').html(loader_image);
				var search_params={
					"action"  : 	"iv_directories_update_setting_hide",	
					"form_data":	jQuery("#setting_hide_form").serialize(), 
				};
				jQuery.ajax({					
					url : ajaxurl,					 
					dataType : "json",
					type : "post",
					data : search_params,
					success : function(response){
						
						jQuery('#update_message_hide').html('<div class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">x</a>'+response.msg +'.</div>');
						
					}
				});
	
	} 
function iv_update_fb (){
	
	var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
	var loader_image = '<img src="<?php echo wp_iv_directories_URLPATH. "admin/files/images/loader.gif"; ?>" />';
				jQuery('#update_message_fb').html(loader_image);
				var search_params={
					"action"  : 	"iv_directories_update_setting_fb",	
					"form_data":	jQuery("#setting_fb").serialize(), 
				};
				jQuery.ajax({					
					url : ajaxurl,					 
					dataType : "json",
					type : "post",
					data : search_params,
					success : function(response){
						
						jQuery('#update_message_fb').html('<div class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">x</a>'+response.msg +'.</div>');
						
					}
				});
	
	}	
function iv_update_password (){
	
	var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
	var loader_image = '<img src="<?php echo wp_iv_directories_URLPATH. "admin/files/images/loader.gif"; ?>" />';
				jQuery('#update_message_pass').html(loader_image);
				var search_params={
					"action"  : 	"iv_directories_update_setting_password",	
					"form_data":	jQuery("#pass_word").serialize(), 
				};
				jQuery.ajax({					
					url : ajaxurl,					 
					dataType : "json",
					type : "post",
					data : search_params,
					success : function(response){
						
						jQuery('#update_message_pass').html('<div class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">x</a>'+response.msg +'.</div>');
						
					}
				});
	
	}	
function add_services_field(){
	var main_services_div =jQuery('#service-main').html(); 
	jQuery('#servicess').append('<div class="clearfix"></div><hr>'+main_services_div+'');
}
function service_delete(id_delete){
	
	jQuery('#service_delete_'+id_delete).remove();
	
}	
function service_post_image(servicesthis){	
				
				var image_gallery_frame;
               // event.preventDefault();
                image_gallery_frame = wp.media.frames.downloadable_file = wp.media({
                    // Set the title of the modal.
                    title: "<?php esc_html_e( 'Set services Image ', 'medico' ); ?>",
                    button: {
                        text: "<?php esc_html_e( 'Set services Image', 'medico' ); ?>",
                    },
                    multiple: false,
                    displayUserSettings: true,
                });                
                image_gallery_frame.on( 'select', function() {
                    var selection = image_gallery_frame.state().get('selection');
                    selection.map( function( attachment ) {
                        attachment = attachment.toJSON();
                        if ( attachment.id ) {		
													
							jQuery(servicesthis).html('<img  class="img-responsive"  src="'+attachment.sizes.thumbnail.url+'"><input type="hidden" name="service_image_id[]" id="service_image_id[]" value="'+attachment.id+'">');
							
							
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
                    title: "<?php esc_html_e( 'Gallery Images ', 'medico' ); ?>",
                    button: {
                        text: "<?php esc_html_e( 'Gallery Images', 'medico' ); ?>",
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
function update_profile_setting (){
	tinyMCE.triggerSave();
	var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
	var loader_image = '<img src="<?php echo wp_iv_directories_URLPATH. "admin/files/images/loader.gif"; ?>" />';
				jQuery('#update_message').html(loader_image); 
				var search_params={
					"action"  : 	"iv_directories_update_profile_setting",	
					"form_data":	jQuery("#profile_setting_form").serialize(), 
				};
				jQuery.ajax({					
					url : ajaxurl,					 
					dataType : "json",
					type : "post",
					data : search_params,
					success : function(response){
						jQuery('#update_message').html('<div class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">x</a>'+response.msg +'.</div>');
						
					}
				});
	
	}	
 function top_banner_post_image(profile_image_id){	
				var image_gallery_frame;
               // event.preventDefault();
                image_gallery_frame = wp.media.frames.downloadable_file = wp.media({
                    // Set the title of the modal.
                    title: "<?php esc_html_e( 'Set Banner Image ', 'medico' ); ?>",
                    button: {
                        text: "<?php esc_html_e( 'Set Banner Image', 'medico' ); ?>",
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
							jQuery('#top_banner_image_id').val(attachment.id ); 
							jQuery('#top_banner_image_edit').html('<button type="button" onclick="edit_post_image(\'top_banner_image_div\');"  class="btn btn-xs green-haze">Edit</button> &nbsp;<button type="button" onclick="remove_post_image(\'top_banner_image_div\');"  class="btn btn-xs green-haze">Remove</button>');  						   
						}
					});                   
                });               
				image_gallery_frame.open(); 				
	}
function  remove_post_image	(profile_image_id){
	jQuery('#'+profile_image_id).html('');
	jQuery('#top_banner_image_id').val(''); 
	jQuery('#top_banner_image_edit').html('<button type="button" onclick="top_banner_post_image(\'top_banner_image_div\');"  class="btn btn green-haze">Add Banner image</button>');  

}		
 </script>	
        
