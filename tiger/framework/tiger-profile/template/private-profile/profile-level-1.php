 <?php
 global $wpdb;
 $current_user = wp_get_current_user();
 $package_amount=0;
  
		    // Check Express Checkout Here 
		    // IF IF*********
   
		$userId=$current_user->ID;
		
		$payment_gateway=get_user_meta($userId, 'uou_tigerp_payment_gateway', true);
		if($payment_gateway=='paypal-express'){
				if( ! class_exists('Paypal' ) ) {
					include(wp_uou_tigerp_DIR . '/inc/class-paypal.php');
				}
				$post_name='uou_tigerp_paypal_setting';						
				$row = $wpdb->get_row("SELECT * FROM $wpdb->posts WHERE post_name = '".$post_name."' ");
				$paypal_id='0';
				if(sizeof($row )>0){
					$paypal_id= $row->ID;
				}
				$paypal_api_currency=get_post_meta($paypal_id, 'uou_tigerp_paypal_api_currency', true);
				
				$paypal_username=get_post_meta($paypal_id, 'uou_tigerp_paypal_username',true);
				$paypal_api_password=get_post_meta($paypal_id, 'uou_tigerp_paypal_api_password', true);
				$paypal_api_signature=get_post_meta($paypal_id, 'uou_tigerp_paypal_api_signature', true);
				
				$credentials = array();
				$credentials['USER'] = (isset($paypal_username)) ? $paypal_username : '';
				$credentials['PWD'] = (isset($paypal_api_password)) ? $paypal_api_password : '';
				$credentials['SIGNATURE'] = (isset($paypal_api_signature)) ? $paypal_api_signature : '';
				
				$paypal_mode=get_post_meta($paypal_id, 'uou_tigerp_paypal_mode', true);

				$currencyCode = $paypal_api_currency;
				$sandbox = ($paypal_mode == 'live') ? '' : 'sandbox.';
				$sandboxBool = (!empty($sandbox)) ? true : false;						
				$paypal = new Paypal($credentials,$sandboxBool);
						
						
				$payment_status=get_user_meta($userId, 'uou_tigerp_payment_status', true);
				if($payment_status=='pending'){
					
						$PROFILEID=get_user_meta($userId, 'iv_paypal_recurring_profile_id', true);
						$recurringCheck ='';
						$recurringCheck = $paypal -> request('GetRecurringPaymentsProfileDetails',array('PROFILEID' => $PROFILEID ));
						
						//[STATUS] => Active
						if(isset($recurringCheck['STATUS'])){
							if($recurringCheck['STATUS']=='Active'){
								$package_id=get_user_meta($userId, 'uou_tigerp_package_id', true); 
								$role_package= get_post_meta( $package_id,'uou_tigerp_package_user_role',true); 	
								
								update_user_meta($userId, 'uou_tigerp_payment_status', 'success');
								$user = new WP_User( $userId );
								$user->set_role($role_package);									
							
							}
						}
				}
					
					$exprie_date= strtotime (get_user_meta($userId, 'uou_tigerp_exprie_date', true));	
					$current_date=strtotime(date('Y-m-d'));							
					
					
				if($exprie_date < $current_date){
							
							$PROFILEID=get_user_meta($userId, 'iv_paypal_recurring_profile_id', true);
							$recurringCheck ='';
							$recurringCheck = $paypal -> request('GetRecurringPaymentsProfileDetails',array('PROFILEID' => $PROFILEID ));
							
							// For one time payment
							if($PROFILEID==''){
								if($exprie_date!=''){
									update_user_meta($userId, 'uou_tigerp_payment_status', 'pending');
									$user = new WP_User( $userId );
									$user->set_role('basic');
								}	
							}
							
							//[STATUS] => Active
							if(isset($recurringCheck['STATUS'])){
								if($recurringCheck['STATUS']=='Active'){
									$package_id=get_user_meta($userId, 'uou_tigerp_package_id', true); 
									$role_package= get_post_meta( $package_id,'uou_tigerp_package_user_role',true); 	
									
									update_user_meta($userId, 'uou_tigerp_payment_status', 'success');
									$user = new WP_User( $userId );
									$user->set_role($role_package);
									// Change exprie_date 
									
									$package_id=get_user_meta($userId,'uou_tigerp_package_id',true); 
										$uou_tigerp_exprie_date_old =get_user_meta($userId,'uou_tigerp_exprie_date',true);
										
										$recurring_cycle_count= get_post_meta($package_id,'uou_tigerp_package_recurring_cycle_count',true);
										if($recurring_cycle_count=="" or $recurring_cycle_count==0){$recurring_cycle_count=1;}
										 $recurring_cycle_type= get_post_meta($package_id,'uou_tigerp_package_recurring_cycle_type',true);
										$periodNum='';
										switch ($recurring_cycle_type) {
											case 'year':
												$periodNum = (60 * 60 * 24 * 365) * $recurring_cycle_count;
												break;
											case 'month':
												$periodNum = (60 * 60 * 24 * 30) * $recurring_cycle_count;
												break;
											case 'week':
												$periodNum = (60 * 60 * 24 * 7) * $recurring_cycle_count;
												break;
											case 'day':
												$periodNum = (60 * 60 * 24) * $recurring_cycle_count;
												break;
										}
										
										$timeToBegin = time() + $periodNum;
										$date_n = date('Y-m-d',$timeToBegin).'T'.'00:00:00Z';
									
									$new_exp_date=  date("Y-m-d", strtotime($date_n));
									update_user_meta($userId, 'uou_tigerp_exprie_date', $new_exp_date); 
									// End exprie_date 
									//Add  History for Payment
										$row4 = $wpdb->get_row("SELECT * FROM $wpdb->posts WHERE id = '".$package_id."' ");
										$package_name=$row4->post_title;
										if(get_post_meta($package_id,'uou_tigerp_package_recurring',true)=='on'){
											$uou_tigerp_package_cost =get_post_meta($package_id,'uou_tigerp_package_recurring_cost_initial',true);
										}else{
											$uou_tigerp_package_cost =get_post_meta($package_id,'uou_tigerp_package_cost',true);
										}
										$api_currency= get_option('_uou_tigerp_api_currency' );		
										$total_g = $uou_tigerp_package_cost.' '.$api_currency;												
										/*
										$form_post_data = array('post_author' =>$userId ,'post_title' => wp_strip_all_tags($package_name), 'post_content' => $total_g , 'post_status' => 	'publish', 'post_type' => 'iv_payment' );
										wp_insert_post($form_post_data);
										*/
										$my_post_form = array('post_title' => wp_strip_all_tags($package_name), 'post_name' => 														wp_strip_all_tags($package_name), 'post_content' => $total_g, 'post_status' => 'publish', 														'post_author' => get_current_user_id(),);
										$newpost_id = wp_insert_post($my_post_form);
			
										$post_type = 'iv_payment';
										$query = "UPDATE {$wpdb->prefix}posts SET post_type='" . $post_type . "' WHERE id='" . $newpost_id . "' LIMIT 1";
										$wpdb->query($query);
																	
									//End  History for Payment	
																	
								
								}else{
									$package_id=get_user_meta($userId, 'uou_tigerp_package_id', true); 
									$dir_hide= get_post_meta($package_id, 'uou_tigerp_package_hide_exp', true);
									if($dir_hide=='yes'){
										update_user_meta($userId, 'uou_tigerp_user_status','inactive'); 
									}
									
									update_user_meta($userId, 'uou_tigerp_payment_status', 'pending');
									$user = new WP_User( $userId );
									$user->set_role('basic');
								
								}
							}	
				}			
					
		
		}
		
			
		if($payment_gateway=='stripe'){
					
				$post_name2='uou_tigerp_stripe_setting';
				$row = $wpdb->get_row("SELECT * FROM $wpdb->posts WHERE post_name = '".$post_name2."' ");
					if(sizeof($row )>0){
					  $stripe_id= $row->ID;
					}					
				$stripe_mode=get_post_meta( $stripe_id,'uou_tigerp_stripe_mode',true);	
				if($stripe_mode=='test'){
					$stripe_api =get_post_meta($stripe_id, 'uou_tigerp_stripe_secret_test',true);	
				}else{
					$stripe_api =get_post_meta($stripe_id, 'uou_tigerp_stripe_live_secret_key',true);	
				}
				
								
				$payment_status=get_user_meta($userId, 'uou_tigerp_payment_status', true);	
							
				if($payment_status=='pending'){	
					
						include(wp_uou_tigerp_DIR . '/admin/files/lib/Stripe.php');						
						Stripe::setApiKey($stripe_api);				
					
						$cust_id = get_user_meta($userId,'uou_tigerp_stripe_cust_id',true);
						$sub_id = get_user_meta($userId,'uou_tigerp_stripe_subscrip_id',true);
						if($sub_id!=''){							
							try{
									$iv_return_stripe 	= Stripe_Customer::retrieve($cust_id);
									$subscription		= $iv_return_stripe->subscriptions->retrieve($sub_id);
							
							} catch (Exception $e) {
								//print_r($e);	
							}							
							if(isset($subscription->status)){
								if($subscription->status=='active'){
									$package_id=get_user_meta($userId, 'uou_tigerp_package_id', true); 
									$role_package= get_post_meta( $package_id,'uou_tigerp_package_user_role',true); 	
									
									update_user_meta($userId, 'uou_tigerp_payment_status', 'success');
									$user = new WP_User( $userId );
									$user->set_role($role_package);
								}
							}
							
						}
						
				}
				
					$exprie_date= strtotime (get_user_meta($userId, 'uou_tigerp_exprie_date', true));	
					$current_date=strtotime(date('Y-m-d'));
						
				if(  $current_date > $exprie_date){
							
							include(wp_uou_tigerp_DIR . '/admin/files/lib/Stripe.php');						
							Stripe::setApiKey($stripe_api);				
						
							$cust_id = get_user_meta($userId,'uou_tigerp_stripe_cust_id',true);
							$sub_id = get_user_meta($userId,'uou_tigerp_stripe_subscrip_id',true);
							if($sub_id!=''){							
								try{
										$iv_return_stripe 	= Stripe_Customer::retrieve($cust_id);
										$subscription		= $iv_return_stripe->subscriptions->retrieve($sub_id);
								
								} catch (Exception $e) {
									//print_r($e);	
								}	
								
												
								if(isset($subscription->status)){
									if($subscription->status=='active'){
										 
										$package_id=get_user_meta($userId, 'uou_tigerp_package_id', true); 
										$role_package= get_post_meta( $package_id,'uou_tigerp_package_user_role',true); 	
										
										update_user_meta($userId, 'uou_tigerp_payment_status', 'success');
										$user = new WP_User( $userId );
										$user->set_role($role_package);
										
										// Change exprie_date 										
										$package_id=get_user_meta($userId,'uou_tigerp_package_id',true); 
										$uou_tigerp_exprie_date_old =get_user_meta($userId,'uou_tigerp_exprie_date',true);
										
										$recurring_cycle_count= get_post_meta($package_id,'uou_tigerp_package_recurring_cycle_count',true);
										if($recurring_cycle_count=="" or $recurring_cycle_count==0){$recurring_cycle_count=1;}
										$recurring_cycle_type= get_post_meta($package_id,'uou_tigerp_package_recurring_cycle_type',true);
										$periodNum='';
										switch ($recurring_cycle_type) {
											case 'year':
												$periodNum = (60 * 60 * 24 * 365) * $recurring_cycle_count;
												break;
											case 'month':
												$periodNum = (60 * 60 * 24 * 30) * $recurring_cycle_count;
												break;
											case 'week':
												$periodNum = (60 * 60 * 24 * 7) * $recurring_cycle_count;
												break;
											case 'day':
												$periodNum = (60 * 60 * 24) * $recurring_cycle_count;
												break;
										}
										
										$timeToBegin = time() + $periodNum;
										$date_n = date('Y-m-d',$timeToBegin).'T'.'00:00:00Z';
										
										
										$new_exp_date=  date("Y-m-d", strtotime($date_n)); 
										update_user_meta($userId, 'uou_tigerp_exprie_date', $new_exp_date);
										
										// End exprie_date
											//Add  History for Payment
										$row4 = $wpdb->get_row("SELECT * FROM $wpdb->posts WHERE id = '".$package_id."' ");
										$package_name=$row4->post_title;
										if(get_post_meta($package_id,'uou_tigerp_package_recurring',true)=='on'){
											$uou_tigerp_package_cost =get_post_meta($package_id,'uou_tigerp_package_recurring_cost_initial',true);
										}else{
											$uou_tigerp_package_cost =get_post_meta($package_id,'uou_tigerp_package_cost',true);
										}
										$api_currency= get_option('_uou_tigerp_api_currency' );		
										$total_g = $uou_tigerp_package_cost.' '.$api_currency;												
										
										$my_post_form = array('post_title' => wp_strip_all_tags($package_name), 'post_name' => 														wp_strip_all_tags($package_name), 'post_content' => $total_g, 'post_status' => 'publish', 														'post_author' => get_current_user_id(),);
										$newpost_id = wp_insert_post($my_post_form);
			
										$post_type = 'iv_payment';
										$query = "UPDATE {$wpdb->prefix}posts SET post_type='" . $post_type . "' WHERE id='" . $newpost_id . "' LIMIT 1";
										$wpdb->query($query);
											
										//End  History for Payment	
								
									}else{
										
										$package_id=get_user_meta($userId, 'uou_tigerp_package_id', true); 
										$dir_hide= get_post_meta($package_id, 'uou_tigerp_package_hide_exp', true);
										if($dir_hide=='yes'){
											update_user_meta($userId, 'uou_tigerp_user_status','inactive'); 
										}
										update_user_meta($userId, 'uou_tigerp_payment_status', 'pending');
											
										$user = new WP_User( $userId );
										$user->set_role('basic');
									
									}
								}	
						}
					
		
			}
	}		
	
	?>    
				
        
         
        <div class="network">
            <h4><?php  esc_html_e('Membership','tiger');?> </h4>
            
       
                 
                    
					 <ul class="nav nav-tabs">
                      <li class="active">
                        <a href="#tab_current" data-toggle="tab"><?php  _e('Current','tiger')	;?></a>
                      </li>
					  <li class="">
                        <a href="#tab_upgrade" data-toggle="tab"><?php  _e('Upgrade','tiger')	;?></a>
                      </li>					
					  <li>
						<a href="#tab_cancel" data-toggle="tab"><?php  _e('Cancel','tiger')	;?></a>
					  </li>
                    </ul>
                  
                 
                  
                  
                    <div class="tab-content">
                    
                      <div class="tab-pane active" id="tab_current">
					   <?php
						  	global $wpdb, $post;
							$iv_gateway = get_option('uou_tigerp_payment_gateway');								
							$sql="SELECT * FROM $wpdb->posts WHERE post_type = 'uou_tigerp_pack'  and post_status='draft' ";
							$membership_pack = $wpdb->get_results($sql);
							$total_package=count($membership_pack);
							$package_id=get_user_meta($current_user->ID,'uou_tigerp_package_id',true);
							$iv_pac=$package_id;
						  ?>
						<div class="row"> </div>
						
						
						
						  <div class="net-work-in"> 
				
                  <!-- Members -->
                  <div class="main-mem"> 
                    
                    <!-- Head -->
                    <div class="head">
						<?php  _e("User's Information",'tiger')	;?>	
                      
                    </div>
                    
                 
                   
						<div class="folow-persons" >
						  <ul >							
									 <!-- MEMBER -->
									 	<li style="min-height: 55px;">
										  <div class="row">
											<div class="col-xs-6"> 											
											  <!-- Name -->
												<div class="fol-name">
												<h6><?php  _e('Publishing Status','tiger')	;?>	</h6>												
												
												</div>												
											</div>
											<!-- Location -->
											<div class="col-xs-6 n-p-r n-p-l">	
												<div class="fol-name">
												<h6>											
												<?php
													$tigerp_user_status= get_user_meta($current_user->ID, 'uou_tigerp_user_status', true);	
													echo ucfirst($tigerp_user_status);
													?>
													</h6>
												</div>	
											</div>									
											
										  </div>
										</li>
										
										<li style="min-height: 55px;">
										  <div class="row">
											<div class="col-xs-6"> 											
											  <!-- Name -->
												<div class="fol-name">
												<h6><?php  _e('Current Package','tiger')	;?>	</h6>												
												
												</div>												
											</div>
											<!-- Location -->
											<div class="col-xs-6 n-p-r n-p-l">	
												<div class="fol-name">
												<h6>											
												<?php
													if($package_id!=""){
														$post_p = get_post($package_id); 
														if(!empty($post_p)){
															echo ($post_p->post_title!="" ? $post_p->post_title: 'None');	
														}else{
															 _e('None','tiger'); 
														}	
													}else{
														 _e('None','tiger'); 
													}
													
													?>
													</h6>
												</div>	
											</div>									
											
										  </div>
										</li>
										<li class="even" style="min-height: 55px;">
										  <div class="row">
											<div class="col-xs-6"> 											
											  <!-- Name -->
												<div class="fol-name">
												<h6><?php  _e('Package Amount','tiger')	;?>	</h6>												
												
												</div>												
											</div>
											<!-- Location -->
											<div class="col-xs-6 n-p-r n-p-l">	
												<div class="fol-name">
												<h6>											
												<?php	$currencyCode= get_option('_uou_tigerp_api_currency');
														$recurring_text='  '; $amount= '';
														if(get_post_meta($package_id, 'uou_tigerp_package_cost', true)=='0' or get_post_meta($package_id, 'uou_tigerp_package_cost', true)==""){
														  $amount= 'Free';
														}else{
														  $amount= $currencyCode.' '. get_post_meta($package_id, 'uou_tigerp_package_cost', true);
														}
														
														$recurring= get_post_meta($package_id, 'uou_tigerp_package_recurring', true);	
														if($recurring == 'on'){
															$amount= $currencyCode.' '. get_post_meta($package_id, 'uou_tigerp_package_recurring_cost_initial', true);
															$count_arb=get_post_meta($package_id, 'uou_tigerp_package_recurring_cycle_count', true); 	
															if($count_arb=="" or $count_arb=="1"){
															$recurring_text=" per ".' '.get_post_meta($package_id, 'uou_tigerp_package_recurring_cycle_type', true);
															}else{
															$recurring_text=' per '.$count_arb.' '.get_post_meta($package_id, 'uou_tigerp_package_recurring_cycle_type', true).'s';
															}
															
														}else{
															$recurring_text=' &nbsp; ';
														}
													echo $amount;
													?>
												</h6>
												</div>	
											</div>									
											
										  </div>
										</li>
										<li class="odd" style="min-height: 55px;">
										  <div class="row">
											<div class="col-xs-6"> 											
											  <!-- Name -->
												<div class="fol-name">
												<h6><?php  _e('Package Type','tiger')	;?>	</h6>												
												
												</div>												
											</div>
											<!-- Location -->
											<div class="col-xs-6 n-p-r n-p-l">		
												<div class="fol-name">
												<h6>										
													<?php
													echo $amount.' '.$recurring_text;
													?>
												</h6>
												</div>	
											</div>									
											
										  </div>
										</li>
										<li class="even" style="min-height: 55px;">
										  <div class="row">
											<div class="col-xs-6"> 											
											  <!-- Name -->
												<div class="fol-name">
												<h6><?php  _e('Payment Status','tiger')	;?>	</h6>												
												
												</div>												
											</div>
											<!-- Location -->
											<div class="col-xs-6 n-p-r n-p-l">		
												<div class="fol-name">
												<h6>										
													<?php 
													echo ucfirst(get_user_meta($current_user->ID, 'uou_tigerp_payment_status', true));
													?>
												</h6>
												</div>	
											</div>									
											
										  </div>
										</li>
										<li class="odd" style="min-height: 55px;">
										  <div class="row">
											<div class="col-xs-6"> 											
											  <!-- Name -->
												<div class="fol-name">
												<h6><?php  _e('User Role','tiger')	;?>	</h6>	
												</div>												
											</div>
											<!-- Location -->
											<div class="col-xs-6 n-p-r n-p-l">	
												<div class="fol-name">
												<h6>											
													<?php 
										
													 $user = new WP_User( $current_user->ID );
													if ( !empty( $user->roles ) && is_array( $user->roles ) ) {
														foreach ( $user->roles as $role )
															echo ucfirst($role);
													}
													
													?>
														</h6>	
												</div>									
											</div>									
											
										  </div>
										</li>
										 <?php
							 
									   if(get_user_meta($current_user->ID, 'uou_tigerp_payment_status', true)=='cancel'){
										?>
										<li class="even" style="min-height: 55px;">
										  <div class="row">
											<div class="col-xs-6"> 											
											  <!-- Name -->
												<div class="fol-name">
												<h6><?php  _e('Exprie Date','tiger');?> 	</h6>												
												
												</div>												
											</div>
											<!-- Location -->
											<div class="col-xs-6 n-p-r n-p-l">	
												<div class="fol-name">
												<h6>
													<?php
													if($recurring == 'on'){
														$exp_date= get_user_meta($current_user->ID, 'uou_tigerp_exprie_date', true);
														echo date('d-M-Y',strtotime($exp_date));
													}else{
														$exp_date= get_user_meta($current_user->ID, 'uou_tigerp_exprie_date', true);
														echo date('d-M-Y',strtotime($exp_date));	
													}	
											
											?>											
													<?php 
													echo get_user_meta($current_user->ID, 'uou_tigerp_payment_status', true);
													?>
												</h6>
												</div>	
											</div>									
											
										  </div>
										</li>
									<?php
									}else{
									?>	
									<li class="even" style="min-height: 55px;">
										  <div class="row">
											<div class="col-xs-6"> 											
											  <!-- Name -->
												<div class="fol-name">
												<h6><?php  _e('Exprie Date','tiger');?> 	</h6>												
												
												</div>												
											</div>
											<!-- Location -->
											<div class="col-xs-6 n-p-r n-p-l">	
												<div class="fol-name">
												<h6>
													<?php
											if($recurring == 'on'){
													$exp_date= get_user_meta($current_user->ID, 'uou_tigerp_exprie_date', true);
													echo ($exp_date!=""? date('d-M-Y',strtotime($exp_date)):'');
												}else{
													$exp_date= get_user_meta($current_user->ID, 'uou_tigerp_exprie_date', true);
													echo ($exp_date!=""? date('d-M-Y',strtotime($exp_date)):'');
												}	
												
												?>
												</h6>
												</div>
											</div>									
											
										  </div>
										</li>
									
									<?php
									}
									?>
										
										
						  </ul>
						</div>
                  </div>                 				
                </div>
           
						
						
					
	               </div>                   
					
					<div class="tab-pane" id="tab_upgrade">
						
					
							
						<?php			
						if($iv_gateway=='paypal-express'){							
						?>
			<form class="form-group"  name="profile_upgrade_form" id="profile_upgrade_form" action="<?php  the_permalink() ?>?&payment_gateway=paypal&iv-submit-upgrade=upgrade" method="post">
			
				<div class=" row form-group">
					<label for="text" class="col-md-4 col-xs-4 col-sm-4 control-label"><?php  _e('Package Name','tiger')	;?></label>
						<div class="col-md-8 col-xs-8 col-sm-8 "> 																				
							<?php
								
								$user_member_type_ = get_user_meta($current_user->ID,'iv_member_type',true);								
								$sql="SELECT * FROM $wpdb->posts WHERE post_type = 'uou_tigerp_pack'  and post_status='draft'";
								$membership_pack = $wpdb->get_results($sql);
								$total_package=count($membership_pack);
								//echo'$total_package.....'.$total_package;
								if(sizeof($membership_pack)>0){
									$i=0; $current_package_id=get_user_meta($current_user->ID,'uou_tigerp_package_id',true);
									echo'<select name="package_sel" id ="package_sel" class=" form-control">';							
									foreach ( $membership_pack as $row )
									{	
										if(get_post_meta($row->ID, 'uou_tigerp_user_type', true)==$user_member_type_){
												if($current_package_id==$row->ID){
													echo '<option value="'. $row->ID.'" >'. $row->post_title.' [Your Current Package]</option>';
												}else{
													echo '<option value="'. $row->ID.'" >'. $row->post_title.'</option>';
												}
													if($i==0){
														$package_id=$row->ID;
														if(get_post_meta($row->ID, 'uou_tigerp_package_recurring',true)=='on'){
															$package_amount=get_post_meta($row->ID, 'uou_tigerp_package_recurring_cost_initial', true);	
														}else{
															$package_amount=get_post_meta($row->ID, 'uou_tigerp_package_cost',true);
														
														}
													}
											 $i++;	
										}	
									}	
														
									echo '</select>';
								}
							 ?>
							</div>
				
				</div>
				<div class="row form-group">
						<label for="text" class="col-md-4 col-xs-4 col-sm-4 control-label"><?php  _e('Amount','tiger')	;?></label>
						
						<div class="col-md-8 col-xs-8 col-sm-8 " id="p_amount"> 									
							<?php  
							$api_currency= 'USD';
							if( get_option('_uou_tigerp_api_currency' )!=FALSE ) {
								$api_currency= get_option('_uou_tigerp_api_currency' );
							}
							
							echo $package_amount.' '.$api_currency .' '.$recurring_text; ?> 
							
						</div>										
				</div>	
					<?php
							$api_currency= 'USD';
							if( get_option('_uou_tigerp_api_currency' )!=FALSE ) {
								$api_currency= get_option('_uou_tigerp_api_currency' );
							}
							$tax_total=0;
							$tax_type= (get_option('_iv_tax_type')!=""? get_option('_iv_tax_type'):"country");
							$tax_active_module=get_option('_uou_tigerp_active_tax');
							$country_id= get_user_meta($userId, 'country_code',true);  // Will get from User meta
							if($tax_active_module=='yes'){
							?>
							<div class="row form-group">
								<label for="text" class="col-md-4 control-label"><?php  esc_html_e('Vat/Tax','tiger');?></label>												
																				
								<div class="col-md-8" id="tax">  
									<?php 										
										$tax_type= get_option('_iv_tax_type');
										$tax_active_module=get_option('_uou_tigerp_active_tax');
										
										if($tax_active_module=='' ){ $tax_active_module='yes';	}					
										if($tax_type==''){$tax_type='country';}
											
										if($tax_active_module=='yes' AND $tax_type=='country'){						
											$countries_tax_array= (get_option('_iv_countries_tax')!=''? get_option('_iv_countries_tax'): array()) ;
											
											if(array_key_exists($country_id , $countries_tax_array)){							
												 $country_tax_value= $countries_tax_array[$country_id];
												 $tax_total=$package_amount * $country_tax_value/100;
											}
										}
										if($tax_active_module=='yes' AND $tax_type=='common'){						
											$common_tax_value= get_option('_iv_comman_tax_value');						
											$tax_total=$package_amount * $common_tax_value/100;											
										}
													echo $tax_total.' '.$api_currency; 
										
										?>
								</div>										
							</div>
							<?php
							}	
							?>					
						<div class="row form-group">
								<label for="text" class="col-md-4 control-label"><?php  esc_html_e('Total','tiger');?></label>		
								<div class="col-md-8" id="total"><label class="control-label">  <?php  $package_amount= $package_amount+$tax_total; echo $package_amount.' '.$api_currency; ?></label>
								</div>										
						</div>		
						
                        
                       
								<div class="row form-group">
									<label for="text" class="col-md-4 col-xs-4 col-sm-4 control-label"></label>
									<div class="col-md-8 col-xs-8 col-sm-8 " > 	<div id="loading"> </div> 
										<input type="hidden" name="country_select" id="country_select" value="<?php echo $country_id; ?>">	
										<input type="hidden" name="package_id" id="package_id" value="<?php echo $package_id; ?>">	
										<input type="hidden" name="coupon_code" id="coupon_code" value="">	
										<button class="btn green-haze" type="submit"> <?php  esc_html_e('Upgrade','tiger')	;?></button>
										<input type="hidden" name="return_page" id="return_page" value="<?php  the_permalink() ?>">
									</div>
									
								</div>	
						</form> 
						 <?php
						 }
																			
						if($iv_gateway=='stripe'){ ?>
							<form class="form"  name="profile_upgrade_form" id="profile_upgrade_form" action="" method="post">
						<?php	
							include(wp_uou_tigerp_template.'private-profile/iv_stripe_form_upgrade.php');
								$arb_status =	get_user_meta($current_user->ID, 'uou_tigerp_payment_status', true);
								$cust_id = get_user_meta($current_user->ID,'uou_tigerp_stripe_cust_id',true);
								$sub_id = get_user_meta($current_user->ID,'uou_tigerp_stripe_subscrip_id',true);	
							?>
							
							<input type="hidden" name="cust_id" value="<?php echo $cust_id; ?>">
							<input type="hidden" name="sub_id" value="<?php echo $sub_id; ?>">
							
						</form>
						<?php		
							}
							?>
						<div class=" row bs-callout bs-callout-info">
						<?php  esc_html_e('Note: Your Successful Upgrade or Downgrade will affect on your user role immediately.','tiger')	;?>						
							
						</div>
					</div>
					<div class="tab-pane" id="tab_cancel">
								<?php
								 $ii=0;
									$payment_gateway=get_user_meta($current_user->ID, 'uou_tigerp_payment_gateway', true);
									if($payment_gateway=='paypal-express'){	
										$arb_status =	get_user_meta($current_user->ID, 'uou_tigerp_payment_status', true);
										$profile_id = get_user_meta($current_user->ID,'iv_paypal_recurring_profile_id',true);
											if($arb_status!='cancel'  && $profile_id!='' ){	
																						?>
												<div class="net-work-in"> 		
														<div class="main-mem"> 										
															<div class="" id="update_message_paypal"></div>
															<div id="paypal_cancel_div" name="paypal_cancel_div">
																	<form class="form" role="form"  name="paypal_cancel_form" id="paypal_cancel_form" action="" method="post">
																		<input type="hidden" name="profile_id" value="<?php echo $profile_id; ?>">	
																		<div class="form-group">
																		<label class="control-label"><?php  esc_html_e('Cancel Reason','tiger')	;?></label>
																		<textarea class="form-control" name="cancel_text" id="cancel_text" rows="3" placeholder="<?php  esc_html_e('Canceling Reason','tiger')	;?>"  ></textarea>
																	  </div>
																		
																		<div class="margiv-top-10">
																			<div class="" id="update_message"></div>
																			
																			<button type="button"   class="btn green-haze" onclick="return iv_cancel_membership_paypal();"><?php  esc_html_e('Cancel Membership','tiger')	;?></button>
															  
															  </div>	
															</div>
														  </div>							  
														  </form>  
														</div>    
											<?php
											}else{ ?>
											
												<div class="net-work-in"> 		
													<div class="main-mem"> 
														<div class="form-group">
															<label class="control-label"><?php $ii=2; esc_html_e('Nothing to Cancel','tiger')	;?></label>
															
														</div>
												</div>
											</div>		
											<?php
											}
						
									}
									if($payment_gateway=='stripe'){
											
											
											
											$arb_status =	get_user_meta($current_user->ID, 'uou_tigerp_payment_status', true);
											$cust_id = get_user_meta($current_user->ID,'uou_tigerp_stripe_cust_id',true);
											$sub_id = get_user_meta($current_user->ID,'uou_tigerp_stripe_subscrip_id',true);
											
											if($arb_status!='cancel'  && $sub_id!='' ){	
																					?>
													<div class="net-work-in"> 		
														<div class="main-mem"> 								
														<div class="" id="update_message_stripe"></div>
														<div id="stripe_cancel_div" name="stripe_cancel_div">
																<form class="form" role="form"  name="profile_cancel_form" id="profile_cancel_form" action="<?php  the_permalink() ?>" method="post">		
																<input type="hidden" name="cust_id" value="<?php echo $cust_id; ?>">
																<input type="hidden" name="sub_id" value="<?php echo $sub_id; ?>">																	
																	<div class="form-group">
																	<label class="control-label"><?php  esc_html_e('Cancel Reason','tiger')	;?></label>
																	<textarea class="form-control" name="cancel_text" id="cancel_text" rows="3" placeholder="<?php  esc_html_e('Canceling Reason','tiger')	;?>"  ></textarea>
																  </div>															
																	
																	<div class="margiv-top-10">
																		
																		<button type="button"   class="btn green-haze" onclick="return iv_cancel_membership_stripe();"><?php  esc_html_e('Cancel Membership','tiger')	;?></button>
																   </div>
																	
																</form>
														</div>
														</div>
													</div>	
												<?php
												}else{ ?>
												
												<div class="net-work-in"> 		
													<div class="main-mem"> 
														<div class="form-group">
															<label class="control-label"><?php $ii=2;  esc_html_e('Nothing to Cancel','tiger')	;?>.</label>
															
														  </div>
													</div>
												</div>		
												<?php
												}
										
									
									}	
								if($ii==0){ ?>
									<div class="net-work-in"> 		
										<div class="main-mem"> 
											<div class="form-group">
															<label class="control-label"><?php $ii=2; esc_html_e('Nothing to Cancel [Only recurring payment user can cancel his/her subscription].','tiger')	;?></label>													
											</div>
										</div>
									</div>		
								
								<?php
								}
								
								?>
								
					</div>
                  </div>
               
           
            </div>
   <script>  
   function iv_cancel_membership_paypal (){
	
	 if (confirm('Are you sure to cancel this Membership?')) {
		var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
		var loader_image = '<img src="<?php echo wp_uou_tigerp_URLPATH. "admin/files/images/loader.gif"; ?>" />';
					jQuery('#update_message_paypal').html(loader_image);
					var search_params={
						"action"  : 	"uou_tigerp_cancel_paypal",	
						"form_data":	jQuery("#paypal_cancel_form").serialize(), 
					};
					jQuery.ajax({					
						url : ajaxurl,					 
						dataType : "json",
						type : "post",
						data : search_params,
						success : function(response){
							if(response.code=='success'){
								jQuery('#paypal_cancel_div').hide(); 
								jQuery('#update_message_paypal').html('<div class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">x</a>'+response.msg +'.</div>');
							
							}else{
								jQuery('#update_message_paypal').html('<div class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">x</a>'+response.msg +'.</div>');
							
							}
							
						}
						
					});
		}			
	
	}        
  function iv_cancel_membership_stripe (){
	
	 if (confirm('Are you sure to cancel this Membership?')) {
		var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
		var loader_image = '<img src="<?php echo wp_uou_tigerp_URLPATH. "admin/files/images/loader.gif"; ?>" />';
					jQuery('#update_message_stripe').html(loader_image);
					var search_params={
						"action"  : 	"uou_tigerp_cancel_stripe",	
						"form_data":	jQuery("#profile_cancel_form").serialize(), 
					};
					jQuery.ajax({					
						url : ajaxurl,					 
						dataType : "json",
						type : "post",
						data : search_params,
						success : function(response){
							jQuery('#stripe_cancel_div').hide(); 
							jQuery('#update_message_stripe').html('<div class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">x</a>'+response.msg +'.</div>');
							
						}
					});
		}			
	
	}
 </script>	
<script>
jQuery(function(){	
	jQuery('#package_sel').on('change', function (e) {
		
		var optionSelected = jQuery("option:selected", this);
		var pack_id = this.value;
		
		jQuery("#package_id").val(pack_id);
								
		var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
		var search_params={
		"action"  			: "uou_tigerp_check_package_amount",	
		"coupon_code" 		:jQuery("#coupon_name").val(),
		"package_id" 		: pack_id,
		"package_amount" 	:'',
		"form_data"			:jQuery("#profile_upgrade_form").serialize(),
		"api_currency" 		:'<?php echo $currencyCode; ?>',
		};
		jQuery.ajax({					
			url : ajaxurl,					 
			dataType : "json",
			type : "post",
			data : search_params,
			success : function(response){
				if(response.code=='success'){							
					jQuery('#coupon-result').html('<img src="<?php echo wp_uou_tigerp_URLPATH; ?>admin/files/images/right_icon.png">');
				}else{
						jQuery('#coupon-result').html('<img src="<?php echo wp_uou_tigerp_URLPATH; ?>admin/files/images/wrong_16x16.png">');
				}
				
				jQuery('#p_amount').html(response.p_amount);							
				jQuery('#total').html(response.gtotal);
				jQuery('#tax').html(response.tax_total);							
				
			}
			});
		});	
	});	
</script>	
 
          <!-- END PROFILE CONTENT -->
        
