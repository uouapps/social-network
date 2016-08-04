<script>
	function update_user_setting() {
	
				// New Block For Ajax*****
				var search_params={
					"action"  : 	"uou_tigerp_update_user_settings",	
					"form_data":	jQuery("#user_form_iv").serialize(), 
				};
				jQuery.ajax({					
					url : ajaxurl,					 
					dataType : "json",
					type : "post",
					data : search_params,
					success : function(response){
						var url = "<?php echo wp_uou_tigerp_ADMINPATH; ?>admin.php?page=wp-iv_user-directory-admin&message=success";    						
						jQuery(location).attr('href',url);
						
					}
				});
				
	}
		jQuery(function() {
			jQuery( "#exp_date" ).datepicker();
						
		});			


			
</script>	
			<?php
			global $wpdb,$wp_roles;
			$user_id='';
			if(isset($_GET['id'])){ $user_id=$_GET['id'];}
			
			$user = new WP_User( $user_id );
			
			?>
			<div class="bootstrap-wrapper">
				<div class="welcome-panel container-fluid">				
					
					
					<div class="row">
						<div class="col-md-12"><h3 class="">User Settings: Edit </h3>
						
						</div>	
											
						
					</div> 
					
						
						
					<div class="col-md-7 panel panel-info">
						<div class="panel-body">
					
					<!-- /.modal -->
					
					
					<!-- Start Form 101 -->
					
						
						<form id="user_form_iv" name="user_form_iv" class="form-horizontal" role="form" onsubmit="return false;">
							
							 
							 
										
							<div class="form-group">
								<label for="text" class="col-md-3 control-label"></label>
								<div id="iv-loading"></div>
							 </div>	
							  <div class="form-group">
								<label for="inputEmail3" class="col-md-4 control-label">User Name</label>
								<div class="col-md-8">
									
									<label for="inputEmail3" class="control-label"><?php echo $user->user_login; ?></label>
								</div>
							  </div>
							   <div class="form-group">
								<label for="inputEmail3" class="col-md-4 control-label">Email Address</label>
								<div class="col-md-8">									
									<label for="inputEmail3" class="control-label"><?php echo $user->user_email; ?></label>
									
								</div>
							  </div>	
							 <div class="form-group">
								<label for="text" class="col-md-4 control-label">User Type (Company/Professional) </label>
								<div class="col-md-8">
									<?php
											
											$iv_member_type= get_user_meta($user->ID, 'iv_member_type', true);
										?>
									<select name="iv_member_type" id ="iv_member_type" class="form-control">
										<?php											
													
												echo'<option value="corporate"  '.($iv_member_type=='corporate'? " selected" : " ") .' >Company</option>';	
												echo'<option value="professional"  '.($iv_member_type=='professional'? " selected" : " ") .' >Professional</option>';				
													

											  ?>	
									</select>	
								
								</div>
							  </div> 
							  
							 <div class="form-group">
								<label for="text" class="col-md-4 control-label">User Role</label>
								<div class="col-md-8">
									<?php
											
											$user_role= $user->roles[0];
										?>
									<select name="user_role" id ="user_role" class="form-control">
										<?php											
													foreach ( $wp_roles->roles as $key=>$value ){
														echo'<option value="'.$key.'"  '.($user_role==$key? " selected" : " ") .' >'.$key.'</option>';	
															
													}

											  ?>	
									</select>	
								
								</div>
							  </div> 
							  <div class="form-group">
								<label for="text" class="col-md-4 control-label">Verified Status</label>
								<div class="col-md-8">
									<?php
									 $verified= get_user_meta($user_id, 'verified', true);
									?>
									<select name="verified" id ="verified" class="form-control">
													<option value="No" >Select</option>
													<option value="Yes" <?php echo ($verified == 'Yes' ? 'selected' : '') ?>>Yes</option>
													<option value="No" <?php echo ($verified == 'No' ? 'selected' : '') ?>>No</option>
													
									</select>	
									
								</div>
							  </div>
							
							 
							  <div class="form-group">
								<label for="text" class="col-md-4 control-label">Payment Status</label>
								<div class="col-md-8">
									<?php
									 $payment_status= get_user_meta($user_id, 'uou_tigerp_payment_status', true);
									?>
									<select name="payment_status" id ="payment_status" class="form-control">
													<option value="success" <?php echo ($payment_status == 'success' ? 'selected' : '') ?>>Success</option>
													<option value="pending" <?php echo ($payment_status == 'pending' ? 'selected' : '') ?>>Pending</option>
													
									</select>	
									
								</div>
							  </div>
							
							 
							  <div class="form-group">
								<label for="inputEmail3" class="col-md-4 control-label">Expiry Date</label>
								<div class="col-md-8">
									<?php
									 $exp_date= get_user_meta($user_id, 'uou_tigerp_exprie_date', true);
									?>
								 <input type="text"  name="exp_date"  readonly   id="exp_date" class="form-control ctrl-textbox"  value="<?php echo $exp_date; ?>" placeholder="">

								</div>
							  </div>
								
							<div class="form-group">
								<label for="text" class="col-md-4 control-label">Status</label>
								<div class="col-md-8">
									<?php
									 $user_statust= get_user_meta($user_id, 'uou_tigerp_user_status', true);
									?>
									<select name="user_status" id ="user_status" class="form-control">
													<option value="active" <?php echo ($user_statust == 'active' ? 'selected' : '') ?>>Active</option>
													<option value="inactive" <?php echo ($user_statust == 'inactive' ? 'selected' : '') ?>>Inactive</option>
													
									</select>	
									
								</div>
							  </div>
							
							
							 <input type="hidden"  name="user_id"     id="user_id"   value="<?php echo $user_id; ?>" >
							  
							 
								
							  
							 
												  
						  
						
					
							<div class="row">					
								<div class="col-md-12">	
									<label for="" class="col-md-4 control-label"></label>
									<div class="col-md-8">
										<button class="btn btn-info " onclick="return update_user_setting();">Update User</button></div>
										<p>&nbsp;</p>
									</div>
								</div>
							</div>	
							
							</form>
							
							
					
						</div>			
					</div>
				</div>		 



			
