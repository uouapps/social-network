<?php
global $wpdb;			
	$email_body = get_option( 'uou_tigerp_signup_email');
	$signup_email_subject = get_option( 'uou_tigerp_signup_email_subject');			
					
		$admin_mail = get_option('admin_email');	
		if( get_option( 'admin_email_uou_tigerp' )==FALSE ) {
			$admin_mail = get_option('admin_email');						 
		}else{
			$admin_mail = get_option('admin_email_uou_tigerp');								
		}						
		$wp_title = get_bloginfo();
	
	$user_info = get_userdata( $user_id);	
					
	//parse_str($_POST['form_reg'], $data_a);
	//$data_a['contact_name']='AAAAA';
				
	// Email for Admin		
				
	
	$email_body = str_replace("[user_name]", $user_info->display_name, $email_body);
	$email_body = str_replace("[iv_member_user_name]", $user_info->display_name, $email_body);
	$email_body = str_replace("[iv_member_password]", $userdata['user_pass'], $email_body);	
			
	$cilent_email_address =$user_info->user_email; //trim(get_post_meta($post_id, 'iv_form_modal_client_email', true));
					
	
			
	$auto_subject=  $signup_email_subject; 
							
	$headers = array("From: " . $wp_title . " <" . $admin_mail . ">", "Content-Type: text/html");
	$h = implode("\r\n", $headers) . "\r\n";
	wp_mail($cilent_email_address, $auto_subject, $email_body, $h);
			
	// Admin Start ********
	
	$email_body = get_option( 'uou_tigerp_signup_email');
	$email_body = str_replace("[user_name]", $user_info->display_name, $email_body);
	$email_body = str_replace("[iv_member_user_name]", $user_info->display_name, $email_body);
	$email_body = str_replace("[iv_member_password]", '****', $email_body);	
	
	wp_mail($admin_mail, $auto_subject, $email_body, $h);
	
	// Admin Email end
					
			// Send Mailchimp
					
			$firstname='';
			$lastname='';
			$words= array();
			if(isset($data_a['iv_member_fname'])){
				if(isset($data_a['iv_member_fname'])){
					$firstname = $data_a['iv_member_fname'];
				}
				if(isset($data_a['iv_member_lname'])){
					$lastname = $data_a['iv_member_lname'];
				}									
				
			}else{
				if(isset($data_a['iv_member_user_name'])){
					$firstname = $data_a['iv_member_user_name'];
				}
			}	
							
			if( ! class_exists('MCAPI' ) ) {
				include(wp_uou_tigerp_DIR . '/inc/MCAPI.class.php');
			}
			$iv_mailchimp_api_key='';
			if( get_option( 'uou_tigerp_mailchimp_api_key' )==FALSE ) {
				$iv_mailchimp_api_key = get_option('uou_tigerp_mailchimp_api_key');						 
			}else{
				$iv_mailchimp_api_key = get_option('uou_tigerp_mailchimp_api_key');								
			}
			$uou_tigerp_mailchimp_confirmation='yes';
			if( get_option( 'uou_tigerp_mailchimp_confirmation' )==FALSE ) {
				$uou_tigerp_mailchimp_confirmation = get_option('uou_tigerp_mailchimp_confirmation');						 
			}else{
				$uou_tigerp_mailchimp_confirmation = get_option('uou_tigerp_mailchimp_confirmation');								
			}
			
			$api = new MCAPI($iv_mailchimp_api_key);
			$list_id=get_option('uou_tigerp_mailchimp_list');
			
			$opt_in = ($uou_tigerp_mailchimp_confirmation=='yes'  ? true : false);
			if($api->listSubscribe($list_id, $cilent_email_address, array('FNAME' => $firstname , 'LNAME' => $lastname), 'html', $opt_in) === true) {
				//return true;
			}
			
			
			
	// End Send Mailchimp
	
	

