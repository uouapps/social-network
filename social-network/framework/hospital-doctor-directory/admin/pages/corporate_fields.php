<style>
.bs-callout {
    margin: 20px 0;
    padding: 15px 30px 15px 15px;
    border-left: 5px solid #eee;
}
.bs-callout-info {
    background-color: #E4F1FE;
    border-color: #22A7F0;
}

</style>
			<?php
			global $wpdb;
			global $current_user;
			$ii=1;
			
			
			?>
			<div class="bootstrap-wrapper">
				<div class="welcome-panel container-fluid">
						<div class="row">
							
							<div class="col-md-12"><h3 class="page-header"><?php _e('Corporate Profile Fields','chilepro'); ?>  <br /><small> &nbsp;</small> </h3>
							</div>
						</div> 
						<div id="success_message">	</div>
						
						
						
							
							
						<div class="panel panel-info">
						<div class="panel-heading"><h4><?php _e('corporate Profile Fields','chilepro'); ?>  </h4></div>
						<div class="panel-body">	
							
							
							<form id="corporate_fields" name="corporate_fields" class="form-horizontal" role="form" onsubmit="return false;">	
								
																	
										<div class="row ">
												<div class="col-sm-5 ">										
													<h4><?php _e('Post Meta Name','chilepro'); ?>  </h4>
												</div>
												<div class="col-sm-5">
													<h4><?php _e('Display Label','chilepro'); ?> </h4>									
												</div>
												<div class="col-sm-2">
													<h4><?php _e('Action','chilepro'); ?> </h4>
													
												</div>		
																		  
										</div>
										
											 					 
									
											<div id="custom_field_div">			
														<?php
														
														$default_fields = array();
															$field_set=get_option('iv_social_profile_corporate_fields' );
															
															
														if($field_set!=""){ 
																$default_fields=get_option('iv_social_profile_corporate_fields' );
														}else{															
																	
															$default_fields['Number_Employees']='Number of Employees';
															$default_fields['Legal_Entity']='Legal Entity';
															$default_fields['Company_Registration']='Company Registration';
															$default_fields['Operating_Hours']='Operating Hours';
															$default_fields['Contacts']='Contacts';
															$default_fields['Email']='Email';								
															$default_fields['web_site']='Website Url';
														}
														if(sizeof($field_set)<1){																
																	
															$default_fields['Number_Employees']='Number of Employees';
															$default_fields['Legal_Entity']='Legal Entity';
															$default_fields['Company_Registration']='Company Registration';
															$default_fields['Operating_Hours']='Operating Hours';
															$default_fields['Contacts']='Contacts';
															$default_fields['Email']='Email';								
															$default_fields['web_site']='Website Url';
														 }	
														
														$i=1;		
														
														foreach ( $default_fields as $field_key => $field_value ) {												
															
																//echo'<br/>$field_key....'.$field_key.'......$field_values....'.$field_values;
																echo '<div class="row form-group " id="field_'.$i.'"><div class=" col-sm-5"> <input type="text" class="form-control" name="meta_name[]" id="meta_name[]" value="'.$field_key . '" placeholder="Enter Post Meta Name "> </div>		
																<div  class=" col-sm-5">
																<input type="text" class="form-control" name="meta_label[]" id="meta_label[]" value="'.$field_value . '" placeholder="Enter Post Meta Label">													
																</div>
																<div  class=" col-sm-2">';
																?>
																<button class="btn btn-danger btn-xs" onclick="return iv_remove_field('<?php echo $i; ?>');"><?php _e('Delete','chilepro'); ?></button>
																<?php																								
																echo '</div></div>';
															
															$i++;	
															
														}	
													?>
														
													
											</div>				  
										<div class="col-xs-12">											
											<button class="btn btn-warning btn-xs" onclick="return iv_add_field();"><?php _e('Add More','chilepro'); ?></button>
									 </div>	
									<input type="hidden" name="dir_name" id="dir_name" value="<?php echo $main_category; ?>">	 
							</form>	
					
									<div class="col-xs-12">					
												<div align="center">
													<div id="loading"></div>
													<button class="btn btn-info btn-lg" onclick="return update_corporate_fields();"><?php _e('Update','chilepro'); ?> </button>
												</div>
												<p>&nbsp;</p>
											</div>
						</div>							 
				
				</div>			 	
					
					
					
				<div id="success_message_experience">	</div>								
										
				<div class="panel panel-info">
						<div class="panel-heading"><h4><?php _e('Services Fields','chilepro'); ?>  </h4></div>
						<div class="panel-body">	
							<form id="experience_fields" name="experience_fields" class="form-horizontal" role="form" onsubmit="return false;">
											
							
										
										
										<div class="row ">
												<div class="col-sm-5 ">										
													<h4><?php _e('Post Meta Name','chilepro'); ?> </h4>
												</div>
												<div class="col-sm-5">
													<h4><?php _e('Display Label','chilepro'); ?> </h4>									
												</div>
												<div class="col-sm-2">
													<h4><?php _e('Action','chilepro'); ?> </h4>
													
												</div>		
																		  
										</div>
										
																 
									
											<div id="custom_field_div_experience">			
														<?php
														
														$default_fields = array();
															$field_set=get_option('iv_social_profile_corporate_fields_services' );
														if($field_set!=""){ 
																$default_fields=get_option('iv_social_profile_corporate_fields_services' );
														}else{													
																$default_fields['Gender']='Gender';	
																$default_fields['HospitalAffiliations']='Hospital Affiliations';
																$default_fields['ExperienceTranining']='Experience / Tranining';
																$default_fields['MedicalSchool']='Medical School';
																$default_fields['Internship']='Internship';
																$default_fields['Residency']='Residency';
																$default_fields['Fellowship']='Fellowship';	
																$default_fields['Certifications']='Certifications';	
																$default_fields['LeadershipRoles']='Leadership Roles';	
															
														}
														if(sizeof($field_set)<1){	
																$default_fields['Gender']='Gender';																
																$default_fields['HospitalAffiliations']='Hospital Affiliations';
																$default_fields['ExperienceTranining']='Experience / Tranining';
																$default_fields['MedicalSchool']='Medical School';
																$default_fields['Internship']='Internship';
																$default_fields['Residency']='Residency';
																$default_fields['Fellowship']='Fellowship';	
																$default_fields['Certifications']='Certifications';	
																$default_fields['LeadershipRoles']='Leadership Roles';	
														 }			
														

														
														foreach ( $default_fields as $field_key => $field_value ) {												
															
																//echo'<br/>$field_key....'.$field_key.'......$field_values....'.$field_values;
																echo '<div class="row form-group " id="field_'.$i.'"><div class=" col-sm-5"> <input type="text" class="form-control" name="meta_name[]" id="meta_name[]" value="'.$field_key . '" placeholder="Enter Post Meta Name "> </div>		
																<div  class=" col-sm-5">
																<input type="text" class="form-control" name="meta_label[]" id="meta_label[]" value="'.$field_value . '" placeholder="Enter Post Meta Label">													
																</div>
																<div  class=" col-sm-2">';
																?>
																<button class="btn btn-danger btn-xs" onclick="return iv_remove_field_experience('<?php echo $i; ?>');"><?php _e('Delete','chilepro'); ?></button>
																<?php																								
																echo '</div></div>';
															
															$i++;	
															
														}	
													?>
														
													
											</div>				  
										<div class="col-xs-12">											
											<button class="btn btn-warning btn-xs" onclick="return iv_add_field_profile();"><?php _e('Add More','chilepro'); ?></button>
									 </div>	
									 
							</form>	
					
								<div class="col-xs-12">					
									<div align="center">
										<div id="loading"></div>
										<button class="btn btn-info btn-lg" onclick="return update_corporate_fields_experience();"><?php _e('Update','chilepro'); ?> </button>
									</div>
									<p>&nbsp;</p>
								</div>
						</div>							 
				
				</div>			 	
					
					<div id="success_message_review">	</div>		
					<div class="panel panel-info">
						<div class="panel-heading"><h4><?php _e('Review Fields','chilepro'); ?>  </h4></div>
						<div class="panel-body">	
							<form id="review_fields" name="review_fields" class="form-horizontal" role="form" onsubmit="return false;">
											
							
										
										
										<div class="row ">
												<div class="col-sm-5 ">										
													<h4><?php _e('Post Meta Name','chilepro'); ?> </h4>
												</div>
												<div class="col-sm-5">
													<h4><?php _e('Display Label','chilepro'); ?> </h4>									
												</div>
												<div class="col-sm-2">
													<h4><?php _e('Action','chilepro'); ?> </h4>
													
												</div>		
																		  
										</div>
										
																 
									
											<div id="custom_field_div_review">			
														<?php
														
														$default_fields = array();
															$field_set=get_option('iv_social_profile_corporate_fields_review' );
														if($field_set!=""){ 
																$default_fields=get_option('iv_social_profile_corporate_fields_review' );
														}else{													
																$default_fields['Expertise']='Expertise';	
																$default_fields['Knowledge']='Knowledge';
																$default_fields['Quality']='Quality';
																$default_fields['Price']='Price';
																$default_fields['Services']='Services';
																
															
														}
														if(sizeof($field_set)<1){	
																$default_fields['Expertise']='Expertise';	
																$default_fields['Knowledge']='Knowledge';
																$default_fields['Quality']='Quality';
																$default_fields['Price']='Price';
																$default_fields['Services']='Services';	
														 }			
														

														
														foreach ( $default_fields as $field_key => $field_value ) {												
															
																//echo'<br/>$field_key....'.$field_key.'......$field_values....'.$field_values;
																echo '<div class="row form-group " id="field_'.$i.'"><div class=" col-sm-5"> <input type="text" class="form-control" name="meta_name[]" id="meta_name[]" value="'.$field_key . '" placeholder="Enter Post Meta Name "> </div>		
																<div  class=" col-sm-5">
																<input type="text" class="form-control" name="meta_label[]" id="meta_label[]" value="'.$field_value . '" placeholder="Enter Post Meta Label">													
																</div>
																<div  class=" col-sm-2">';
																?>
																<button class="btn btn-danger btn-xs" onclick="return iv_remove_field_review('<?php echo $i; ?>');"><?php _e('Delete','chilepro'); ?></button>
																<?php																								
																echo '</div></div>';
															
															$i++;	
															
														}	
													?>
														
													
											</div>				  
										<div class="col-xs-12">											
											<button class="btn btn-warning btn-xs" onclick="return iv_add_field_profile_review();"><?php _e('Add More','chilepro'); ?></button>
									 </div>	
									 
							</form>	
					
								<div class="col-xs-12">					
									<div align="center">
										<div id="loading"></div>
										<button class="btn btn-info btn-lg" onclick="return update_corporate_fields_review();"><?php _e('Update','chilepro'); ?> </button>
									</div>
									<p>&nbsp;</p>
								</div>
						</div>							 
				
				</div>			 	
					
					
					
							
			
									
			  </div>						
		</div>		 


<script>
	var i=<?php echo $i; ?>;
	var ii=<?php echo $ii; ?>;
		

	function iv_add_field(){	
	
		jQuery('#custom_field_div').append('<div class="row form-group " id="field_'+i+'"><div class=" col-sm-5"> <input type="text" class="form-control" name="meta_name[]" id="meta_name[]" value="" placeholder="Enter Post Meta Name "> </div>	<div  class=" col-sm-5"><input type="text" class="form-control" name="meta_label[]" id="meta_label[]" value="" placeholder="Enter Post Meta Label"></div><div  class=" col-sm-2"><button class="btn btn-danger btn-xs" onclick="return iv_remove_field('+i+');">Delete</button>');		
			i=i+1;		
	}
	function iv_remove_field(div_id){		
		jQuery("#field_"+div_id).remove();
	}	
	// experience**********
	function update_corporate_fields(){	
		var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
		var search_params = {
			"action": 		"iv_directories_update_corporate_fields",
			"form_data":	jQuery("#corporate_fields").serialize(), 	
		};
		jQuery.ajax({
			url: ajaxurl,
			dataType: "json",
			type: "post",
			data: search_params,
			success: function(response) {              		
				//jQuery("#success_message").html('<h4><span style="color: #04B404;"> ' + response.code + '</span></h4>');
				jQuery('#success_message_experience').html('<div class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">x</a>'+response.code +'.</div>');
			}
		});
	}
	function update_corporate_fields_experience(){	
		var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
		var search_params = {
			"action": 		"iv_directories_update_corporate_fields_experience",
			"form_data":	jQuery("#experience_fields").serialize(), 	
		};
		jQuery.ajax({
			url: ajaxurl,
			dataType: "json",
			type: "post",
			data: search_params,
			success: function(response) {              		
				//jQuery("#success_message").html('<h4><span style="color: #04B404;"> ' + response.code + '</span></h4>');
				jQuery('#success_message_experience').html('<div class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">x</a>'+response.code +'.</div>');
			}
		});
	}
	function iv_add_field_profile(){	
	
		jQuery('#custom_field_div_experience').append('<div class="row form-group " id="field_'+i+'"><div class=" col-sm-5"> <input type="text" class="form-control" name="meta_name[]" id="meta_name[]" value="" placeholder="Enter Post Meta Name "> </div>	<div  class=" col-sm-5"><input type="text" class="form-control" name="meta_label[]" id="meta_label[]" value="" placeholder="Enter Post Meta Label"></div><div  class=" col-sm-2"><button class="btn btn-danger btn-xs" onclick="return iv_remove_field_experience('+i+');">Delete</button>');		
			i=i+1;		
	}
	function iv_remove_field_experience(div_id){		
		jQuery("#field_"+div_id).remove();
	}	
	
	function iv_add_field_profile_review(){	
	
		jQuery('#custom_field_div_review').append('<div class="row form-group " id="field_'+i+'"><div class=" col-sm-5"> <input type="text" class="form-control" name="meta_name[]" id="meta_name[]" value="" placeholder="Enter Post Meta Name "> </div>	<div  class=" col-sm-5"><input type="text" class="form-control" name="meta_label[]" id="meta_label[]" value="" placeholder="Enter Post Meta Label"></div><div  class=" col-sm-2"><button class="btn btn-danger btn-xs" onclick="return iv_remove_field_review('+i+');">Delete</button>');		
			i=i+1;		
	}
	function iv_remove_field_review(div_id){		
		jQuery("#field_"+div_id).remove();
	}	
	
	function update_corporate_fields_review(){	
		var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
		var search_params = {
			"action": 		"iv_directories_update_corporate_fields_review",
			"form_data":	jQuery("#review_fields").serialize(), 	
		};
		jQuery.ajax({
			url: ajaxurl,
			dataType: "json",
			type: "post",
			data: search_params,
			success: function(response) {              		
				//jQuery("#success_message").html('<h4><span style="color: #04B404;"> ' + response.code + '</span></h4>');
				jQuery('#success_message_review').html('<div class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">x</a>'+response.code +'.</div>');
			}
		});
	}	
</script>				
			
