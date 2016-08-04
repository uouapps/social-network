<?php
wp_enqueue_style('wp-uou_tigerp-style-11', wp_uou_tigerp_URLPATH . 'admin/files/css/iv-bootstrap.css');
?>
<div class="bootstrap-wrapper">
	<div class="welcome-panel container-fluid">
		
		<div class="row">
			<div class="col-md-12">
				
				<h3 class="page-header" ><?php  _e('User Setting','tiger')	;?>  <small>  </small> </h3>
				
				
				
			</div>
		</div>
		<div id="update_message"> </div>		
	<div class="form-group row">
		<form class="form-horizontal" role="form"  name='directory_settings' id='directory_settings'>	
			<div class="form-group">
				<label  class="col-md-3 control-label"> <?php _e('Company & Professional','tiger');  ?></label>
			<?php
				$dir_approve_publish =get_option('_dir_approve_publish');	
				if($dir_approve_publish ==""){
					$dir_approve_publish ='no';
				}
			?>
			<div class="col-md-3">
					<label>												
					<input type="radio" name="dir_approve_publish" id="dir_approve_publish" value='yes' <?php echo ($dir_approve_publish=='yes' ? 'checked':'' ); ?> ><?php _e(" Don't publish without admin approval",'tiger');  ?>
					</label>	
				</div>
				<div class="col-md-3">	
					<label>											
					<input type="radio"  name="dir_approve_publish" id="dir_approve_publish" value='no' <?php echo ($dir_approve_publish=='no' ? 'checked':'' );  ?> > <?php _e(' Auto approval for publishing','tiger');  ?>
					</label>
				</div>	
			</div>
		</form>	
			<div class="form-group">
					<label  class="col-md-3 control-label"> </label>
					<div class="col-md-8">
						
						<button type="button" onclick="return  iv_update_dir_setting();" class="btn btn-success">Update</button>
					</div>
			</div>
	</div>	
	<hr>		
	<div class="form-group col-md-12 row">
			
			
		<?php
		global $wpdb,$wp_roles;
		$package ='';
		$currencyCode= get_option('_uou_tigerp_api_currency');
		if(isset($_REQUEST['package_sel'])){
			$package = $_REQUEST['package_sel'];
			
		}
		if($package==''){			
			if(isset($_REQUEST['package'])){
				$package=$_REQUEST['package'];
			}			
		}	
	
		
		$search_user='';
		if(isset($_POST['search_user'])){
			$search_user = $_POST['search_user'];
			//$package = $_POST['package_hidden'];
		}
		
		?>
	       <div class="row">
	        	<div class="main clearfix underline form-group col-md-12">
	        	    <form class=" dd col-md-6"   action="<?php echo the_permalink(); ?>" method="post"  >
	        	        <div class="row pull-left">
	        	        <input type="text" name="search_user" id="search_user" class="search" placeholder="Search by user name" value="<?php echo $search_user; ?>">
	        	        <button class="submit"><i class="fa fa-search"></i></button>
						<input type="hidden" name="package_hidden" id="package_hidden" value="<?php echo $package; ?>">
	        	    	</div>
	        	    </form>
        	 		<!--[if IE ]>
					<![endif]-->
        	 		 <form class=" dd col-md-6"   action="<?php echo the_permalink(); ?>" method="post"  >     
						<div class="row pull-right">	 		  
							   <!--
							   <select id="package_sel" name="package_sel" class="btn-infu form-group" >  
							<?php
							   $sql="SELECT * FROM $wpdb->posts WHERE post_type = 'uou_tigerp_pack'  and post_status='draft' ";
							$membership_pack = $wpdb->get_results($sql);
								echo'<option value="">All Package </option>';
									foreach ( $membership_pack as $row ){
										echo'<option value="'.$row->ID.'"  '.($package==$row->ID ? " selected" : " ") .' >'.$row->post_title.'</option>';	
											
									}

							  ?>
							  </select >
							  -->
									
							 <select id="package_sel" name="package_sel" class="btn-infu form-group" >  
								<?php		
											echo'<option value="">All Roles </option>';									
											foreach ( $wp_roles->roles as $key=>$value ){
												echo'<option value="'.$key.'"  '.($package==$key? " selected" : " ") .' >'.$key.'</option>';	
													
											}

									  ?>	
							</select>	
						</div>	  
        	 		</form>
					</div>
	        	 	
	        	</div>
					
								
				        <?php
				       
				     
						$no=20;	
						 $paged = (isset($_REQUEST['paged'])) ? $_REQUEST['paged'] : 1;
						
						if($paged==1){
						  $offset=0;  
						}else {
						   $offset= ($paged-1)*$no;
						}
				        $args = array();
				        $args['number']=$no;
				        $args['offset']=$offset;
				        $args['orderby']='registered';
				        $args['order']='DESC'; 
				        //$args['search']='12';				       
				        //$args['search_columns']=array( 'user_login', 'user_email' );
				        if($package!=''){	
							$role_package= $package; 	
							$args['role']=$role_package;
						}
						  if($search_user!=''){							
							$args['search']='*'.$search_user.'*';
						}										
						
				        $user_query = new WP_User_Query( $args );
						//echo'<pre>';
						//print_r($user_query);
						//echo'</pre>';
						?>	
						 <table class="table">						 
						  <thead>
							<tr>	
							  <th> <?php  _e('Create Date','tiger')	;?> </th>						 
							  <th> <?php  _e('User Name','tiger')	;?></th>
							  <th> <?php  _e('Email','tiger')	;?> </th>
						
							  <th> <?php  _e('User Type','tiger')	;?> </th>							  
							  <th> <?php  _e('Payment Status','tiger')	;?> </th>	
												  
							  <th> <?php  _e('Role','tiger')	;?> </th>
							  <th> <?php  _e('Verified','tiger')	;?> </th>
							  <th> <?php  _e('Expiry Date','tiger')	;?> </th>	
							  <th> <?php  _e('Status','tiger')	;?> </th>	
							  <th><?php  _e('Action','tiger')	;?></th>
							</tr>
						  </thead>
						  <tbody>
							
							
						<?php	
				        // User Loop
				        if ( ! empty( $user_query->results ) ) {
				        	foreach ( $user_query->results as $user ) {								
								//print_r($user );
								?>
									<tr>
									  <td><?php echo date("d-M-Y h:m:s A" ,strtotime($user->user_registered) ); ?></td>							 
									  <td><?php echo $user->display_name; ?></td>
									  <td><?php echo $user->user_email; ?></td>
									 
									    <td>
									  <?php 
										echo get_user_meta($user->ID, 'iv_member_type', true);
										?>
										</td>
										<td>
									   <?php  echo get_user_meta($user->ID,'uou_tigerp_payment_status',true);?>
									  </td>
									  <td><?php
										if ( !empty( $user->roles ) && is_array( $user->roles ) ) {
											foreach ( $user->roles as $role )
												echo ucfirst($role);
										}
										?>
									  </td>
									   
									  <td>
									   <?php  echo (get_user_meta($user->ID,'verified',true)== "" ? 'No': get_user_meta($user->ID,'verified',true));?>
									  </td>
									   <td><?php
												
											$exp_date= get_user_meta($user->ID, 'uou_tigerp_exprie_date', true);
											if($exp_date!=''){
												echo date('d-M-Y',strtotime($exp_date));
											}	
											
											?>
										</td>
										 <td><?php												
											$tigerp_user_status= get_user_meta($user->ID, 'uou_tigerp_user_status', true);	
											if($tigerp_user_status==''){												

												$setting_value_approve =get_option('_dir_approve_publish');	
												$user_status_new ='active';
												if($setting_value_approve ==""){
													$user_status_new='active';
												}else{
													if($setting_value_approve=='yes'){
														$user_status_new ='inactive';
													}
													if($setting_value_approve=='no'){
														$user_status_new ='active';
													}													
												}
												
												update_user_meta($user->ID, 'uou_tigerp_user_status', $user_status_new);
												
											}
											$tigerp_user_status= get_user_meta($user->ID, 'uou_tigerp_user_status', true);	
											echo ucfirst($tigerp_user_status);
											?>
										</td>
										
									  <td>		<a class="btn btn-primary btn-xs" href="?page=wp-uou_tigerp-user_update&id=<?php echo $user->ID; ?>"> <?php  _e('Edit','tiger')	;?></a> 
												<a class="btn btn-danger btn-xs" href="<?php echo admin_url().'/users.php'?>"><?php  _e('Delete','tiger')	;?> </a>
									  </td>
									</tr>
													
						<?php  	
								
							}
						
						} else {
								 echo '<tr><td>No users found.</td></tr>';
						}

		?>
					  </tbody>
				</table>
				
				<div class="text-center">
				<?php
					$total_user = $user_query->total_users;  
					$total_pages=ceil($total_user/$no);						
					echo '<div id="iv-pagination" class="iv-pagination">';  
							
						echo paginate_links( array(
							'base'     => add_query_arg('paged','%#%?&package='.$package),
							'format'   => '',
							'prev_text' => __('&laquo; Previous','medeco'), // text for previous page
							'next_text' => __('Next &raquo;','tiger'), // text for next page
							'total' => $total_pages, // the total number of pages we have
							'current' => $paged, // the current page
							'end_size' => 1,
							'mid_size' => 5,	
						));	
						
										
					echo '</div></div>';  	
					?>
					</div>
				
									
			
			
		
	</div>
</div>
<script>
	jQuery(function() {
    jQuery('#package_sel').change(function() {
        this.form.submit();
    });
});
function iv_update_dir_setting(){
var search_params={
		"action"  : 	"iv_update_dir_setting",	
		"form_data":	jQuery("#directory_settings").serialize(), 
	};
	jQuery.ajax({					
		url : ajaxurl,					 
		dataType : "json",
		type : "post",
		data : search_params,
		success : function(response){
			jQuery('#update_message').html('<div class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">x</a>'+response.msg +'.</div>');
			
		}
	})

}

</script>


