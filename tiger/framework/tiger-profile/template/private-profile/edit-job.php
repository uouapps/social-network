          <div class="profile-content">
            
              <div class="portlet light">
                  <div class="portlet-title tabbable-line clearfix">
                    <div class="caption caption-md">
                      <span class="caption-subject"><?php  _e('Edit','tiger');?> <?php  _e('Job','tiger');?></span>
                    </div>
					<!--
			                    <ul class="nav nav-tabs">
			                      <li class="active">
			                        <a href="#tab_1_1" data-toggle="tab">Personal Info</a>
			                      </li>
			                      <li>
			                        <a href="#tab_1_3" data-toggle="tab">Change Password</a>
			                      </li>
			                      <li>
			                        <a href="#tab_1_4" data-toggle="tab">Privacy Settings</a>
			                      </li>
			                    </ul>
					-->
                  </div>
                  
                  <div class="portlet-body">
                    <div class="tab-content">
                    
                      <div class="tab-pane active" id="tab_1_1">
					  <?php
						
					
						$curr_post_id=$_REQUEST['post-id'];
						$current_post = $curr_post_id;
						$post_edit = get_post($curr_post_id); 
						
						$title = $post_edit->post_title;
						$content = $post_edit->post_content;
						// Author Check						
						if ( $post_edit->post_author != $current_user->ID) {
							
							$iv_redirect = get_option( '_uou_tigerp_login_page');
							 $reg_page= get_permalink( $iv_redirect); 
							?>
							
							<?php  _e('Please','wpmembership');?> <a href="<?php echo $reg_page; ?>" title="Login"><?php  _e('Login','wpmembership');?></a> <?php  _e('To Edit The Post.','wpmembership');?>
							
						<?php
						}else{
					
					?>
						<div class="row">
							<div class="col-md-12">	 
							
							 
							<form action="" id="edit_post" name="edit_post"  method="POST" role="form">
								<div class=" form-group">
									<label for="text" class=" control-label"><?php  _e('Title','wpmembership');?></label>
									
									<div class="  "> 
										<input type="text" class="form-control" name="title" id="title" value="<?php echo $title;?>" placeholder="Enter Title Here">
									</div>
																		
								</div>
								<div class="form-group">
										
										<div class=" ">
												<?php
													$settings_a = array(															
														'textarea_rows' =>10,	
														'editor_class' => 'form-control'															 
														);
													$content_client =$content;//get_option( 'uou_tigerp_signup_email');
													$editor_id = 'edit_post_content';
													wp_editor( $content_client, $editor_id,$settings_a );										
													?>
									
										</div>
									
								</div>
								<div class=" form-group">
									<label for="text" class=" control-label"><?php  _e('Skills','tiger');?></label>									
									<div class="  "> 
										<input type="text" class="form-control" name="job_skills" id="job_skills" value="<?php echo get_post_meta($curr_post_id,'job_skills',true); ?>" placeholder="<?php  _e('Enter Skills, Separated By Commas e.g Php, Java','tiger');?>">
									</div>																		
								</div>
								
								<div class=" row form-group ">
									<label for="text" class=" col-md-5 control-label"><?php  _e('Logo','wpmembership');?> </label>
									
										<div class="col-md-4" id="post_image_div">										
												
												<?php $feature_image = wp_get_attachment_image_src( get_post_thumbnail_id( $curr_post_id ), 'thumbnail' ); 
												
												
												if($feature_image[0]!=""){ ?>
												
												<img title="profile image" class=" img-responsive" src="<?php  echo $feature_image[0]; ?>">
												
												<?php												
												}else{ ?>
												<a href="javascript:void(0);" onclick="edit_post_image('post_image_div');"  >									
											<?php  echo '<img src="'. wp_uou_tigerp_URLPATH.'assets/images/image-add-icon.png">'; ?>			
											</a>	
												<?php
												}
												$feature_image_id=get_post_thumbnail_id( $curr_post_id );
												?>
																							
										</div>
										<input type="hidden" name="feature_image_id" id="feature_image_id" value="<?php echo $feature_image_id;  ?>">
										<div class="col-md-3" id="post_image_edit">	
												<?php
												if($feature_image[0]!=""){
													
													 ?>
													<button type="button" onclick="edit_post_image('post_image_div');"  class="btn btn-xs green-haze"><?php  _e('Edit','wpmembership');?></button>
													<button type="button" onclick="remove_post_image('post_image_div');"  class="btn btn-xs green-haze"><?php  _e('Remove','wpmembership');?></button>
													
												<?php
												}else{ ?>
												
													<button type="button" onclick="edit_post_image('post_image_div');"  class="btn btn-xs green-haze"><?php  _e('Add','wpmembership');?></button>
													
												<?php
												}
												?>
												
											
										</div>									
								</div>
								<div class="clearfix"></div>
								
								
								<div class=" form-group">
									<label for="text" class=" control-label"><?php  _e('Company Name','tiger');?></label>									
									<div class="  "> 
										<input type="text" class="form-control" name="company_name" id="company_name" value="<?php echo get_post_meta($curr_post_id,'company_name',true); ?>" placeholder="<?php  _e('Enter Company Name','tiger');?>">
									</div>																		
								</div>
								<div class=" form-group">
									<label for="text" class=" control-label"><?php  _e('Company Address','tiger');?></label>									
									<div class="  "> 
										<input type="text" class="form-control" name="company_address" id="company_address" value="<?php echo get_post_meta($curr_post_id,'company_address',true); ?>" placeholder="<?php  _e('Enter Company Address','tiger');?>">
									</div>																		
								</div>
								<div class=" form-group">
									<label for="text" class=" control-label"><?php  _e('Company Email','tiger');?></label>									
									<div class="  "> 
										<input type="text" class="form-control" name="company_email" id="company_email" value="<?php echo get_post_meta($curr_post_id,'company_email',true); ?>" placeholder="<?php  _e('Enter Company Email','tiger');?>">
									</div>																		
								</div>
								<div class=" form-group">
									<label for="text" class=" control-label"><?php  _e('Company Phone','tiger');?></label>									
									<div class="  "> 
										<input type="text" class="form-control" name="company_phone" id="company_phone" value="<?php echo get_post_meta($curr_post_id,'company_phone',true); ?>" placeholder="<?php  _e('Enter Company Phone','tiger');?>">
									</div>																		
								</div>
								<div class=" form-group">
									<label for="text" class=" control-label"><?php  _e('Company Web','tiger');?></label>									
									<div class="  "> 
										<input type="text" class="form-control" name="company_web" id="company_web" value="<?php echo get_post_meta($curr_post_id,'company_web',true); ?>" placeholder="<?php  _e('Enter Company Web','tiger');?>">
									</div>																		
								</div>
								
								
								
								<!--
								<?php 								
									$custom_fields = get_post_custom($curr_post_id);
									?>
								
								<label for="text" class="row col-md-12 control-label"><?php  _e('Custom Fields','wpmembership');?> </label>
								<div id="custom_field_div">
									
											<?php
											foreach ( $custom_fields as $field_key => $field_values ) {
												
												if(!isset($field_values[0])){ continue;}
												//if(in_array($field_key,array("_edit_lock","_edit_last"))) {continue;}
												//if(in_array($field_key,array("_thumbnail_id","_edit_last"))) {continue;} 
												$underscore_str=substr($field_key,0,1);
												if($underscore_str!='_'){
													echo '<div class="row form-group "><div class=" col-md-6"> <input type="text" class="form-control" name="custom_name[]" id="custom_name[]" value="'.$field_key . '" placeholder="Custom Field Name"> </div>		
													<div  class=" col-md-6">
													<textarea name="custom_value[]" id="custom_value[]"  class="form-control col-md-12"  rows="1" placeholder="Value">'.$field_values[0].'</textarea>
													</div></div>';
												}
											}						
												
											?>
											
										
								</div>	
									
								<div class=" row  form-group ">
									<div class="col-md-12" >	
									<button type="button" onclick="add_custom_field();"  class="btn btn-xs green-haze"><?php  _e('More Field','wpmembership');?></button>
									</div>
								</div>	
								-->
								<div class="clearfix"></div>
								<div class=" row form-group ">
									<label for="text" class=" col-md-12 control-label"><?php  _e('Post Status','wpmembership');?>  </label>
								
										<div class="col-md-12" id="">										
										<select name="post_status" id="post_status"  class="form-control">
											<?php
												$dir_approve_publish =get_option('_job_approve_publish');
												if($dir_approve_publish!='yes'){?>
													<option value="publish" <?php echo (get_post_status( $post_edit->ID )=='publish'?'selected="selected"':'' ) ; ?>><?php esc_html_e('Publish','tiger'); ?></option>
												<?php	
												}else{ ?>
													<option value="pending" <?php echo (get_post_status( $post_edit->ID )=='pending'?'selected="selected"':'' ) ; ?>><?php esc_html_e('Pending Review','tiger'); ?></option>
												<?php
												}
											?>	
											
											
											<option value="draft" <?php echo (get_post_status( $post_edit->ID )=='draft'?'selected="selected"':'' ) ; ?> ><?php  _e('Draft','wpmembership');?></option>
										</select>										
											
											
										</div>				
																		
								</div>
								<div class="clearfix"></div>
								<div class=" row form-group">
									<label for="text" class=" col-md-10 control-label"><?php  _e('Category','tiger');?></label>
									
									<div class=" col-md-12 "> 
										<?php
											$directory_url_1='jobs';								
											$currentCategory=wp_get_object_terms( $post_edit->ID, $directory_url_1.'-category');
											$selected='';
											if(isset($currentCategory[0]->slug)){										
										
												$selected = $currentCategory[0]->slug;
											}
											
											echo '<select name="postcats" class=" ">';
											echo'	<option selected="'.$selected.'" value="">'.__('Choose a category','medico').'</option>';
																		
												//directories
												$taxonomy = $directory_url_1.'-category';
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
														'type'                     => $directory_url_1,						
														'parent'                   => $term_parent->term_id,
														'orderby'                  => 'name',
														'order'                    => 'ASC',
														'hide_empty'               => 0,
														'hierarchical'             => 1,
														'exclude'                  => '',
														'include'                  => '',
														'number'                   => '',
														'taxonomy'                 => $directory_url_1.'-category',
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
								
								<div class="margiv-top-10">
								    <div class="" id="update_message"></div>
									<input type="hidden" name="user_post_id" id="user_post_id" value="<?php echo $curr_post_id; ?>">
								    <button type="button" onclick="iv_update_post();"  class="btn green-haze"><?php  _e('Update Post','wpmembership');?></button>
		                          
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
	var loader_image = '<img src="<?php echo wp_uou_tigerp_URLPATH. "admin/files/images/loader.gif"; ?>" />';
				jQuery('#update_message').html(loader_image);
				var search_params={
					"action"  : 	"uou_tigerp_update_jobs",	
					"form_data":	jQuery("#edit_post").serialize(), 
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
function add_custom_field(){
	jQuery('#custom_field_div').append('<div class="row form-group "><div class=" col-md-6"> <input type="text" class="form-control" name="custom_name[]" id="custom_name[]" value="" placeholder="Custom Field Name"> </div><div  class=" col-md-6"><textarea name="custom_value[]" id="custom_value[]"  class="form-control  col-md-12"  rows="1" placeholder="Value"></textarea></div></div>');

}		
function  remove_post_image	(profile_image_id){
	jQuery('#'+profile_image_id).html('');
	jQuery('#feature_image_id').val(''); 
	jQuery('#post_image_edit').html('<button type="button" onclick="edit_post_image(\'post_image_div\');"  class="btn btn-xs green-haze">Add</button>');  

}
 function edit_post_image(profile_image_id){	
				var image_gallery_frame;

               // event.preventDefault();
                image_gallery_frame = wp.media.frames.downloadable_file = wp.media({
                    // Set the title of the modal.
                    title: '<?php _e( 'Set Feature Image ', 'easy-image-gallery' ); ?>',
                    button: {
                        text: '<?php _e( 'Set Feature Image', 'easy-image-gallery' ); ?>',
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
							jQuery('#post_image_edit').html('<button type="button" onclick="edit_post_image(\'post_image_div\');"  class="btn btn-xs green-haze">Edit</button>&nbsp;<button type="button" onclick="remove_post_image(\'post_image_div\');"  class="btn btn-xs green-haze">Remove</button>');  
						}
					});
                   
                });               
				image_gallery_frame.open(); 
				
			}	
			
 </script>	  
        
