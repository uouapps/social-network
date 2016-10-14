 <?php
	$profile_url=get_permalink(); 
	global $current_user;
	$current_user = wp_get_current_user();
	$user = $current_user->ID;
	$message='';
if(isset($_GET['delete_id']))  {
	$post_id=$_GET['delete_id'];
	$post_edit = get_post($post_id); 
	
	if($post_edit->post_author==$current_user->ID){
		wp_delete_post($post_id);
		delete_post_meta($post_id,true);
		$message="Deleted Successfully";
	}

	
	
}
 //videos lyrics
?> 
          <div class="network">
            <h4><?php  esc_html_e('Jobs','tiger');?> </h4>
                 
                     <ul class="nav nav-tabs">
					  <li class="active"><a data-toggle="tab" href="#tab_1_3" ><?php  esc_html_e('My All Job Post','tiger');?></a></li>	
					  <li ><a data-toggle="tab" href="#tab_1_1"><?php  esc_html_e('Add Job Post','tiger');?> </a></li>					  
									
					</ul> 
		  <div class="tab-content">  
		 <div class="tab-pane active" id="tab_1_3">
			 <?php
					  //$iv_post ='';// get_option( '_iv_membership_profile_post');
						
						
						$iv_post='jobs';											
							
						
						if($message!=''){
						 echo  '<div class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">x</a>'.$message.'.</div>';
						}
						
						?>
					<div class="table-responsive">
					 <table class="table table-striped ">
		 
							<tr>
								<th><?php  _e('Title','tiger');?></th>
								
								<th><?php  _e('Status','tiger');?></th>
								<th><?php  _e('Actions','tiger');?></th>
							</tr>
						 
							<?php
								//if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); 
								global $wpdb;
									$per_page=10;$row_strat=0;$row_end=$per_page;
									$current_page=0 ;
									if(isset($_REQUEST['cpage']) and $_REQUEST['cpage']!=1 ){   
										$current_page=$_REQUEST['cpage']; $row_strat =($current_page-1)*$per_page; 
										$row_end=$per_page;
									}
									$sql="SELECT * FROM $wpdb->posts WHERE post_type = '".$iv_post."' and post_author='".$current_user->ID."' and post_status IN ('publish','pending','draft' ) limit ".$row_strat.", ".$row_end;									
									$authpr_post = $wpdb->get_results($sql);
									$total_post=count($authpr_post);									
									if(sizeof($total_post)>0){
										$i=0;
										foreach ( $authpr_post as $row )								
										{									
										?>
								<tr>
									<td style="width:65%"> 
									<a class="profile-desc-link" href="<?php echo get_permalink($row->ID); ?>" style="font-size:15px;">
									<?php $feature_image = wp_get_attachment_image_src( get_post_thumbnail_id( $row->ID), 'thumbnail' ); 
									if($feature_image[0]!=""){ ?>												
												<img title="profile image" style="width:45px;"  src="<?php  echo $feature_image[0]; ?>">
									<?php												
									}
												
									?>
									&nbsp; <?php echo $row->post_title; ?></a></td>
									
									 <td width="15%" style="font-size:15px"><?php echo get_post_status( $row->ID ) ?></td>
									<td width="20%" >
										<?php											
											$edit_post= $profile_url.'?&profile=job-edit&post-id='.$row->ID;										
											?>											
										<a href="<?php echo $edit_post; ?>" class="btn btn-xs green-haze" ><?php  _e('Edit','tiger');?></a> 										
										<a href="<?php echo $profile_url.'?&profile=lyrics&delete_id='.$row->ID ;?>"  onclick="return confirm('<?php  _e('Are you sure to delete this post?','tiger');?>');"  class="btn btn-xs btn-danger"><?php  _e('Delete','tiger');?>										
										</a></td>
								</tr>
								 
								<?php 
								}
							}	
								
								 ?>	
								
								 
	
					</table>
					
					
					</div>
							<div class="center">
								<?php
								$sql2="SELECT * FROM $wpdb->posts WHERE post_type =  '".$iv_post."'  and post_author='".$current_user->ID."' and post_status IN ('publish','pending','draft' ) ";
								$authpr_post2 = $wpdb->get_results($sql2);
								$total_post=count($authpr_post2);
								$total_page= $total_post/$per_page;
								$total_page=ceil( $total_page);
								$current_page =($current_page==''? '1': $current_page );
								echo ' <ul class="iv-pagination">';										
								for($i=1;$i<= $total_page;$i++){
										echo '<li class="list-pagi '.($i==$current_page  ? 'active-li': '').'"><a href="'.get_permalink().'?&profile=add-job&cpage='.$i.'"> '.$i.'</a></li>';		
										
							
								}
								echo'</ul>';
							
							?>
							 </div> 
					
		</div>	 
      	                    
         <div class="tab-pane " id="tab_1_1">			   
          <div class="profile-content">
            
              <div class="portlet light">
                 
                  
                  <div class="portlet-body">
                    <div class="tab-content">
                    
                      <div class="tab-pane active" id="tab_1_1">
					 
						<div class="row">
							<div class="col-md-12">	 
							
							 
							<form action="" id="new_post" name="new_post"  method="POST" role="form">
								<div class=" form-group">
									<label for="text" class=" control-label"><?php  _e('Title','tiger');?></label>									
									<div class="  "> 
										<input type="text" class="form-control" name="title" id="title" value="" placeholder="<?php  _e('Enter Title Here','tiger');?>">
									</div>																		
								</div>
								<div class="form-group">
										
										<div class=" ">
												<?php
													$settings_a = array(															
														'textarea_rows' =>10,
														'editor_class' => 'form-control'															 
														);
													
													$editor_id = 'new_post_content';
													wp_editor( '', $editor_id,$settings_a );										
													?>
									
										</div>
									
								</div>
								<div class=" form-group">
									<label for="text" class=" control-label"><?php  _e('Skills','tiger');?></label>									
									<div class="  "> 
										<input type="text" class="form-control" name="job_skills" id="job_skills" value="" placeholder="<?php  _e('Enter Skills, Separated By Commas e.g Php, Java','tiger');?>">
									</div>																		
								</div>
								
								<div class=" row form-group ">
									<label for="text" class=" col-md-5 control-label"><?php  _e('Logo Image','tiger');?>  </label>
									
										<div class="col-md-4" id="post_image_div">
											<a  href="javascript:void(0);" onclick="edit_post_image('post_image_div');"  >									
											<?php  echo '<img src="'. wp_uou_tigerp_URLPATH.'assets/images/image-add-icon.png">'; ?>			
											</a>					
										</div>
										
										<input type="hidden" name="feature_image_id" id="feature_image_id" value="">
										
										<div class="col-md-3" id="post_image_edit">	
											<button type="button" onclick="edit_post_image('post_image_div');"  class="btn btn-xs green-haze"><?php  _e('Add','tiger');?></button>
											
										</div>									
								</div>
								
								<div class=" form-group">
									<label for="text" class=" control-label"><?php  _e('Company Name','tiger');?></label>									
									<div class="  "> 
										<input type="text" class="form-control" name="company_name" id="company_name" value="" placeholder="<?php  _e('Enter Company Name','tiger');?>">
									</div>																		
								</div>
								<div class=" form-group">
									<label for="text" class=" control-label"><?php  _e('Company Address','tiger');?></label>									
									<div class="  "> 
										<input type="text" class="form-control" name="company_address" id="company_address" value="" placeholder="<?php  _e('Enter Company Address','tiger');?>">
									</div>																		
								</div>
								<div class=" form-group">
									<label for="text" class=" control-label"><?php  _e('Company Email','tiger');?></label>									
									<div class="  "> 
										<input type="text" class="form-control" name="company_email" id="company_email" value="" placeholder="<?php  _e('Enter Company Email','tiger');?>">
									</div>																		
								</div>
								<div class=" form-group">
									<label for="text" class=" control-label"><?php  _e('Company Phone','tiger');?></label>									
									<div class="  "> 
										<input type="text" class="form-control" name="company_phone" id="company_phone" value="" placeholder="<?php  _e('Enter Company Phone','tiger');?>">
									</div>																		
								</div>
								<div class=" form-group">
									<label for="text" class=" control-label"><?php  _e('Company Web','tiger');?></label>									
									<div class="  "> 
										<input type="text" class="form-control" name="company_web" id="company_web" value="" placeholder="<?php  _e('Enter Company Web','tiger');?>">
									</div>																		
								</div>
								
								
								
								<!--
								<div class="clearfix"></div>
								<label for="text" class="row col-md-12 control-label"><?php  _e('Custom Fields','tiger');?> </label>
								<div id="custom_field_div">
									<div class=" row form-group " >									
										<div class=" col-md-6"> <input type="text" class="form-control" name="custom_name[]" id="custom_name[]" value="" placeholder="<?php  _e('Custom Field Name','tiger');?>" > </div>		
											<div  class=" col-md-6">
											<textarea name="custom_value[]" id="custom_value[]"  class=" col-md-12 form-control"  rows="1"placeholder="<?php  _e('Value','tiger');?>" ></textarea>
										</div>
										
									</div>
								</div>	
								
								<div class=" row  form-group ">
									<div class="col-md-12" >	
									<button type="button" onclick="add_custom_field();"  class="btn btn-xs green-haze"><?php  _e('More Field','tiger');?></button>
									</div>
								</div>	
								-->
								
								<div class="clearfix"></div>
								<div class=" row form-group ">
									<label for="text" class=" col-md-12 control-label"><?php  _e('Post Status','tiger');?>  </label>
									
										<div class="col-md-12" id="">										
										<select name="post_status" id="post_status"  class="form-control">
											<option value="pending"><?php  _e('Pending Review','tiger');?></option>
											<option value="draft"><?php  _e('Draft','tiger');?></option>
										</select>										
											
											
										</div>				
																		
								</div>
								<div class="clearfix"></div>
								<div class=" row form-group">
									<label for="text" class=" col-md-12 control-label"><?php  _e('Category','tiger');?></label>
									
									<div class=" col-md-12 "> 
										<?php
											$directory_url_1='jobs';								
											$currentCategory='';//wp_get_object_terms( $post_edit->ID, $directory_url_1.'-category');
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
								    <button type="button" onclick="iv_save_post();"  class="btn green-haze"><?php  _e('Save Post','tiger');?></button>
		                          
		                        </div>	
									 
							</form>
						  </div>
						</div>
			
					
			

                      
					 </div>
                     
                  </div>
                </div>
              </div>
            </div>
          <!-- END PROFILE CONTENT -->
          </div> 
      
		
       </div>    
    </div>      
	 <script>
function iv_save_post (){
	tinyMCE.triggerSave();	
	var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
	var loader_image = '<img src="<?php echo wp_uou_tigerp_URLPATH. "admin/files/images/loader.gif"; ?>" />';
				jQuery('#update_message').html(loader_image);
				var search_params={
					"action"  : 	"uou_tigerp_save_jobs",	
					"form_data":	jQuery("#new_post").serialize(), 
				};
				jQuery.ajax({					
					url : ajaxurl,					 
					dataType : "json",
					type : "post",
					data : search_params,
					success : function(response){
						if(response.code=='success'){
								var url = "<?php echo get_permalink(); ?>?&profile=add-job";    						
								jQuery(location).attr('href',url);	
						}
						//jQuery('#update_message').html('<div class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">x</a>'+response.msg +'.</div>');
						
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
							jQuery('#post_image_edit').html('<button type="button" onclick="edit_post_image(\'post_image_div\');"  class="btn btn-xs green-haze">Edit</button> &nbsp;<button type="button" onclick="remove_post_image(\'post_image_div\');"  class="btn btn-xs green-haze">Remove</button>');  
						   
						}
					});
                   
                });               
				image_gallery_frame.open(); 
				
			}	
			
 </script>	  
        
