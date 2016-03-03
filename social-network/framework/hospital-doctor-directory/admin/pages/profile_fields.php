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
							
							<div class="col-md-12"><h3 class="page-header"><?php _e('Listing Fields','chilepro'); ?>  <br /><small> &nbsp;</small> </h3>
							</div>
						</div> 
						<div id="success_message">	</div>
						
						
						
							
							
						<div class="panel panel-info">
						<div class="panel-heading"><h4>Hospital Fields </h4></div>
						<div class="panel-body">	
							
							
							<form id="dir_fields" name="dir_fields" class="form-horizontal" role="form" onsubmit="return false;">	
								<div class="row ">
									<div class="col-sm-3 "><h4>	Specialtie(s) Hospital & Doctor(Both) :</h4>	
									</div>
									<?php
							$specialtie ='Allergy & Immunology, Anaesthesia,Bariatric (Weight Loss) Surgery,Breast Reconstruction,Breast Surgery,Cardiac Surgery,Cardiology,Clinical Neurophysiology,Colonoscopy,Colorectal Surgery,Cosmetic Dermatology,Cosmetic Surgery,Dermatologic Surgery,Dermatology,Dietetics,Ear, Nose and Throat (ENT) Surgery,Endocrinology,Gastroenterology,Gastroscopy,General Medicine,General Surgery,Gynaecology,Hand Surgery,Interventional Cardiology,Laparoscopic Surgery,Liver Biopsy,Maxillofacial Surgery,Mohs Micrographic Surgery,Mole checks and monitoring, Neurology,Neurosurgery,Obstetrics,Oncology,Ophthalmology,Oral Surgery,Orthopaedic Surgery,Osteopathy,Paediatrics,Physiotherapy,Plastic and Reconstructive Surgery,Psychiatry,Psychotherapy,Reconstructive Surgery,Rheumatology,Skin Cancer Surgery and Management,Urology,Vascular & Interventional Radiology,Vascular Surgery,Wireless Capsule Endoscopy';
																										
											$field_set=get_option('iv_hospital_specialtie' );
											if($field_set!=""){ 
													$specialtie=get_option('iv_hospital_specialtie' );
											}			
																	
										?>
									<div class="col-sm-9 ">	<textarea class="col-sm-9 " name="specialtie" id="specialtie"   ><?php echo $specialtie; ?> </textarea>	
									</div>
								</div>
								<br/><br/>
																	
										<div class="row ">
												<div class="col-sm-5 ">										
													<h4>Post Meta Name</h4>
												</div>
												<div class="col-sm-5">
													<h4>Display Label</h4>									
												</div>
												<div class="col-sm-2">
													<h4>Action</h4>
													
												</div>		
																		  
										</div>
										
																 
									
											<div id="custom_field_div">			
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
														
														foreach ( $default_fields as $field_key => $field_value ) {												
															
																//echo'<br/>$field_key....'.$field_key.'......$field_values....'.$field_values;
																echo '<div class="row form-group " id="field_'.$i.'"><div class=" col-sm-5"> <input type="text" class="form-control" name="meta_name[]" id="meta_name[]" value="'.$field_key . '" placeholder="Enter Post Meta Name "> </div>		
																<div  class=" col-sm-5">
																<input type="text" class="form-control" name="meta_label[]" id="meta_label[]" value="'.$field_value . '" placeholder="Enter Post Meta Label">													
																</div>
																<div  class=" col-sm-2">';
																?>
																<button class="btn btn-danger btn-xs" onclick="return iv_remove_field('<?php echo $i; ?>');">Delete</button>
																<?php																								
																echo '</div></div>';
															
															$i++;	
															
														}	
													?>
														
													
											</div>				  
										<div class="col-xs-12">											
											<button class="btn btn-warning btn-xs" onclick="return iv_add_field();">Add More</button>
									 </div>	
									<input type="hidden" name="dir_name" id="dir_name" value="<?php echo $main_category; ?>">	 
							</form>	
					
									<div class="col-xs-12">					
												<div align="center">
													<div id="loading"></div>
													<button class="btn btn-info btn-lg" onclick="return update_dir_fields();">Update </button>
												</div>
												<p>&nbsp;</p>
											</div>
						</div>							 
				
				</div>			 	
					
					
					
				<div id="success_message_doctor">	</div>								
										
				<div class="panel panel-info">
						<div class="panel-heading"><h4>Doctor Fields </h4></div>
						<div class="panel-body">	
							<form id="doctor_fields" name="doctor_fields" class="form-horizontal" role="form" onsubmit="return false;">
											
							
										
										
										<div class="row ">
												<div class="col-sm-5 ">										
													<h4>Post Meta Name</h4>
												</div>
												<div class="col-sm-5">
													<h4>Display Label</h4>									
												</div>
												<div class="col-sm-2">
													<h4>Action</h4>
													
												</div>		
																		  
										</div>
										
																 
									
											<div id="custom_field_div_doctor">			
														<?php
														
														$default_fields = array();
															$field_set=get_option('iv_directories_fields_doctor' );
														if($field_set!=""){ 
																$default_fields=get_option('iv_directories_fields_doctor' );
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
																<button class="btn btn-danger btn-xs" onclick="return iv_remove_field_doctor('<?php echo $i; ?>');">Delete</button>
																<?php																								
																echo '</div></div>';
															
															$i++;	
															
														}	
													?>
														
													
											</div>				  
										<div class="col-xs-12">											
											<button class="btn btn-warning btn-xs" onclick="return iv_add_field_doctor();">Add More</button>
									 </div>	
									 
							</form>	
					
									<div class="col-xs-12">					
												<div align="center">
													<div id="loading"></div>
													<button class="btn btn-info btn-lg" onclick="return update_doctor_fields();">Update </button>
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
	
	
	function update_dir_fields(){
		
		var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
		var search_params = {
			"action": 		"iv_directories_update_dir_fields",
			"form_data":	jQuery("#dir_fields").serialize(), 	
		};
		jQuery.ajax({
			url: ajaxurl,
			dataType: "json",
			type: "post",
			data: search_params,
			success: function(response) {              		
				//jQuery("#success_message").html('<h4><span style="color: #04B404;"> ' + response.code + '</span></h4>');
				jQuery('#success_message').html('<div class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">x</a>'+response.code +'.</div>');
			}
		});
	}
	function iv_add_field(){	
	
		jQuery('#custom_field_div').append('<div class="row form-group " id="field_'+i+'"><div class=" col-sm-5"> <input type="text" class="form-control" name="meta_name[]" id="meta_name[]" value="" placeholder="Enter Post Meta Name "> </div>	<div  class=" col-sm-5"><input type="text" class="form-control" name="meta_label[]" id="meta_label[]" value="" placeholder="Enter Post Meta Label"></div><div  class=" col-sm-2"><button class="btn btn-danger btn-xs" onclick="return iv_remove_field('+i+');">Delete</button>');		
			i=i+1;		
	}
	function iv_remove_field(div_id){		
		jQuery("#field_"+div_id).remove();
	}	
	// Doctor**********
	function update_doctor_fields(){
		
		var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
		var search_params = {
			"action": 		"iv_directories_update_doctor_fields",
			"form_data":	jQuery("#doctor_fields").serialize(), 	
		};
		jQuery.ajax({
			url: ajaxurl,
			dataType: "json",
			type: "post",
			data: search_params,
			success: function(response) {              		
				//jQuery("#success_message").html('<h4><span style="color: #04B404;"> ' + response.code + '</span></h4>');
				jQuery('#success_message_doctor').html('<div class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">x</a>'+response.code +'.</div>');
			}
		});
	}
	function iv_add_field_doctor(){	
	
		jQuery('#custom_field_div_doctor').append('<div class="row form-group " id="field_'+i+'"><div class=" col-sm-5"> <input type="text" class="form-control" name="meta_name[]" id="meta_name[]" value="" placeholder="Enter Post Meta Name "> </div>	<div  class=" col-sm-5"><input type="text" class="form-control" name="meta_label[]" id="meta_label[]" value="" placeholder="Enter Post Meta Label"></div><div  class=" col-sm-2"><button class="btn btn-danger btn-xs" onclick="return iv_remove_field_doctor('+i+');">Delete</button>');		
			i=i+1;		
	}
	function iv_remove_field_doctor(div_id){		
		jQuery("#field_"+div_id).remove();
	}	
	
	
	function iv_add_menu(){	
	
	jQuery('#custom_menu_div').append('<div class="row form-group " id="menu_'+ii+'"><div class=" col-sm-3"> <input type="text" class="form-control" name="menu_title[]" id="menu_title[]" value="" placeholder="Enter Menu Title "> </div>	<div  class=" col-sm-7"><input type="text" class="form-control" name="menu_link[]" id="menu_link[]" value="" placeholder="Enter Menu Link.  Example  http://www.google.com"></div><div  class=" col-sm-2"><button class="btn btn-danger btn-xs" onclick="return iv_remove_menu('+ii+');">Delete</button>');
	
		ii=ii+1;		
	}
	function iv_remove_menu(div_id){		
		jQuery("#menu_"+div_id).remove();
	}	
		
		
</script>				
			
