<?php
if (!defined('ABSPATH')) {
	exit;
}

/**

 * The Admin Panel and related tasks are handled in this file.
 */
if (!class_exists('wp_uou_tigerp_Admin')) {
	class wp_uou_tigerp_Admin {
		
		static $pages = array();
		public function __construct() {
			
			add_action('admin_menu', array(&$this, 'admin_menu'));
			add_action('admin_print_scripts', array(&$this, 'load_scripts'));
			add_action('admin_print_styles', array(&$this, 'load_styles'));
			add_action('wp_ajax_uou_tigerp_save_settings', array(&$this, 'uou_tigerp_save_settings'));			
			add_action('wp_ajax_uou_tigerp_get_settings', array(&$this, 'uou_tigerp_get_settings'));
			add_action('wp_ajax_uou_tigerp_get_node', array(&$this, 'uou_tigerp_get_node'));			
			add_action('wp_ajax_uou_tigerp_save_package', array(&$this, 'uou_tigerp_save_package'));
			add_action('wp_ajax_uou_tigerp_update_package', array(&$this, 'uou_tigerp_update_package'));
			add_action('wp_ajax_uou_tigerp_update_form_registration', array(&$this, 'uou_tigerp_update_form_registration'));
			add_action('wp_ajax_uou_tigerp_update_form_payment', array(&$this, 'uou_tigerp_update_form_payment'));
			add_action('wp_ajax_uou_tigerp_update_paypal_settings', array(&$this, 'uou_tigerp_update_paypal_settings'));
			add_action('wp_ajax_uou_tigerp_update_stripe_settings', array(&$this, 'uou_tigerp_update_stripe_settings'));			
			add_action('wp_ajax_uou_tigerp_create_coupon', array(&$this, 'uou_tigerp_create_coupon'));
			add_action('wp_ajax_uou_tigerp_update_coupon', array(&$this, 'uou_tigerp_update_coupon'));
			add_action('wp_ajax_uou_tigerp_update_profile_template', array(&$this, 'uou_tigerp_update_profile_template'));
			add_action('wp_ajax_uou_tigerp_update_signup_template', array(&$this, 'uou_tigerp_update_signup_template'));
			add_action('wp_ajax_uou_tigerp_update_payment_setting', array(&$this, 'uou_tigerp_update_payment_setting'));
			add_action('wp_ajax_uou_tigerp_update_page_setting', array(&$this, 'uou_tigerp_update_page_setting'));
			add_action('wp_ajax_uou_tigerp_update_email_setting', array(&$this, 'uou_tigerp_update_email_setting'));
			add_action('wp_ajax_uou_tigerp_update_mailchamp_setting', array(&$this, 'uou_tigerp_update_mailchamp_setting'));
			add_action('wp_ajax_uou_tigerp_update_package_status', array(&$this, 'uou_tigerp_update_package_status'));
			add_action('wp_ajax_uou_tigerp_gateway_settings_update', array(&$this, 'uou_tigerp_gateway_settings_update'));
			add_action('wp_ajax_uou_tigerp_update_account_setting', array(&$this, 'uou_tigerp_update_account_setting'));
			add_action('wp_ajax_uou_tigerp_update_post_setting', array(&$this, 'uou_tigerp_update_post_setting'));
			add_action('wp_ajax_uou_tigerp_update_protected_setting', array(&$this, 'uou_tigerp_update_protected_setting'));
			add_action('wp_ajax_uou_tigerp_update_tax_setting', array(&$this, 'uou_tigerp_update_tax_setting'));
			add_action('wp_ajax_iv_update_protected_page_setting', array(&$this, 'iv_update_protected_page_setting'));
			
			add_action('wp_ajax_uou_tigerp_archive_template', array(&$this, 'uou_tigerp_archive_template'));
			add_action('wp_ajax_iv_directories_install_page_template', array(&$this, 'iv_directories_install_page_template'));
			
			add_action('wp_ajax_uou_tigerp_update_map_marker', array(&$this, 'uou_tigerp_update_map_marker'));			
			add_action('wp_ajax_uou_tigerp_update_cate_image', array(&$this, 'uou_tigerp_update_cate_image'));			
			add_action('wp_ajax_uou_tigerp_update_profile_public_template', array(&$this, 'uou_tigerp_update_profile_public_template'));
			add_action('wp_ajax_uou_tigerp_update_user_directory', array(&$this, 'uou_tigerp_update_user_directory'));			
			add_action('wp_ajax_uou_tigerp_update_user_settings', array(&$this, 'uou_tigerp_update_user_settings')); 			
			add_action('wp_ajax_uou_tigerp_update_price_table_template', array(&$this, 'uou_tigerp_update_price_table_template'));			
			add_action('wp_ajax_uou_tigerp_settings_save', array(&$this, 'uou_tigerp_settings_save'));			
			add_action('wp_ajax_uou_tigerp_email_admin_template_change', array(&$this, 'uou_tigerp_email_admin_template_change'));
			add_action('wp_ajax_uou_tigerp_email_client_template_change', array(&$this, 'uou_tigerp_email_client_template_change'));
			add_action('wp_ajax_uou_tigerp_save_package_table', array(&$this, 'uou_tigerp_save_package_table'));
			add_action('wp_ajax_uou_tigerp_update_profile_fields', array(&$this, 'uou_tigerp_update_profile_fields'));
			
			add_action('wp_ajax_uou_tigerp_update_personal_fields', array(&$this, 'uou_tigerp_update_personal_fields'));
			add_action('wp_ajax_uou_tigerp_update_personal_fields_experience', array(&$this, 'uou_tigerp_update_personal_fields_experience'));
			add_action('wp_ajax_uou_tigerp_update_personal_fields_review', array(&$this, 'uou_tigerp_update_personal_fields_review'));
			
			add_action('wp_ajax_uou_tigerp_update_corporate_fields', array(&$this, 'uou_tigerp_update_corporate_fields'));
			
			add_action('wp_ajax_uou_tigerp_update_corporate_fields_review', array(&$this, 'uou_tigerp_update_corporate_fields_review'));
			
			add_action('wp_ajax_iv_update_bidding_setting', array(&$this, 'iv_update_bidding_setting'));
			add_action('wp_ajax_iv_update_dir_setting', array(&$this, 'iv_update_dir_setting'));
			
						
			add_action( 'init', array(&$this, 'uou_tigerp_payment_post_type') );
			
			add_filter( 'manage_edit-iv_payment_columns', array(&$this, 'set_custom_edit_iv_payment_columns')  );
			add_action( 'manage_iv_payment_posts_custom_column' ,  array(&$this, 'custom_iv_payment_column')  , 10, 2 );
			
			
			$this->action_hook();
			
			wp_admin_notifications::load();
		}
		
		
		
		
		

// Hook into the 'init' action

		
		public function uou_tigerp_payment_post_type() {
						$args = array(
							'description' => 'uou_tigerp Payment Post Type',
							'show_ui' => true,   
							'exclude_from_search' => true,
							'labels' => array(
							  'name'=> 'Payment History',
							  'singular_name' => 'iv_payment',							 
							  'edit' => 'Edit Payment History',
							  'edit_item' => 'Edit Payment History',							
							  'view' => 'View Payment History',
							  'view_item' => 'View Payment History',
							  'search_items' => 'Search ',
							  'not_found' => 'No  Found',
							  'not_found_in_trash' => 'No Found in Trash',
							  ),
							  
							'public' => true,
							'publicly_queryable' => false,
							'exclude_from_search' => true,
							'show_ui' => true,
							'show_in_menu' => 'flase',
							'hiearchical' => false,
							'capability_type' => 'post',
							'hierarchical' => false,
							'rewrite' => true,
							'supports' => array('title', 'editor', 'thumbnail','excerpt','custom-fields'),							
							);

				register_post_type( 'iv_payment', $args );
							
			}
			public function uou_tigerp_update_map_marker(){					
					
					if(isset($_REQUEST['category_id'])){
						$category_id=$_REQUEST['category_id'];	
						$attachment_id=$_REQUEST['attachment_id'];	 	
						update_option('_cat_map_marker_'.$category_id,$attachment_id);
					}
									
					
					echo json_encode('success');
					exit(0);
			}
			public function uou_tigerp_update_cate_image(){
				
					if(isset($_REQUEST['category_id'])){
						$category_id=$_REQUEST['category_id'];	
						$attachment_id=$_REQUEST['attachment_id'];	 	
						update_option('_cate_main_image_'.$category_id,$attachment_id);
					}
									
					
					echo json_encode('success');
					exit(0);
			
			}

			public function set_custom_edit_iv_payment_columns($columns) {
				 //unset( $columns['title'] );
				$columns['title']='Package Name'; 
				$columns['User'] = 'User Name';
				$columns['Member'] = 'User ID';				
				$columns['Amount'] ='Amount';
				return $columns;
			}

			public function custom_iv_payment_column( $column, $post_id ) {
				global $post;
				switch ( $column ) {
			
					case 'User' :							
							if(isset($post->post_author) ){
								$user_info = get_userdata( $post->post_author);
								if($user_info!='' ){
									echo  $user_info->user_login ;
								}
							}
							break; 
					case 'Member' :
						echo $member_no=$post->post_author; 
						break;
					
					case 'Amount' :
						echo $post->post_content; 
						break;
						
					
				}
			}
			
				/**
				 * Menus in the wp-admin sidebar
				 */
				public function admin_menu() {
					add_menu_page('WP uou_tigerp', 'Tiger Profile', 'manage_options', 'wp-uou_tigerp', array(&$this, 'menu_hook'));
					
					self::$pages['wp-uou_tigerp-package-all'] = add_submenu_page('wp-uou_tigerp', 'Package', 'Package', 'manage_options', 'wp-uou_tigerp-package-all', array(&$this, 'menu_hook'));
										
					self::$pages['wp-uou_tigerp-coupons-form'] = add_submenu_page('wp-uou_tigerp', 'WP uou_tigerp Create', 'Coupons', 'manage_options', 'wp-uou_tigerp-coupons-form', array(&$this, 'menu_hook'));
					//self::$pages['wp-uou_tigerp-profile-form'] = add_submenu_page('wp-uou_tigerp', 'WP uou_tigerp Profile', 'My Account', 'manage_options', 'wp-uou_tigerp-profile-form', array(&$this, 'menu_hook'));
										
					self::$pages['wp-uou_tigerp-payment-setting'] = add_submenu_page('wp-uou_tigerp', 'WP uou_tigerp Settings', 'Payment Gateways', 'manage_options', 'wp-uou_tigerp-payment-settings', array(&$this, 'menu_hook'));
											
					self::$pages['wp-iv_dir_fields'] = add_submenu_page('wp-uou_tigerp', 'WP uou_tigerp directory-admin', 'Professional Profile Fields', 'manage_options', 'wp-iv_dir_fields', array(&$this, 'menu_hook'));
					
					self::$pages['wp-iv_corporate_fields'] = add_submenu_page('wp-uou_tigerp', 'WP uou_tigerp directory-admin', 'Corporate Profile Fields', 'manage_options', 'wp-iv_corporate_fields', array(&$this, 'menu_hook'));
					
					self::$pages['wp-iv_user-directory-admin'] = add_submenu_page('wp-uou_tigerp', 'WP uou_tigerp directory-admin', 'User Setting', 'manage_options', 'wp-iv_user-directory-admin', array(&$this, 'menu_hook'));
					
					self::$pages['wp-uou_tigerp-settings'] = add_submenu_page('wp-uou_tigerp', 'WP uou_tigerp Settings', 'Settings', 'manage_options', 'wp-uou_tigerp-settings', array(&$this, 'menu_hook'));
					add_submenu_page('wp-uou_tigerp', 'WP uou_tigerp', 'Payment  History', 'manage_options',  'edit.php?post_type=iv_payment');
					self::$pages['wp-uou_tigerp-report'] = add_submenu_page('wp-uou_tigerp', 'WP uou_tigerp Report', 'Report', 'manage_options', 'wp-uou_tigerp-report', array(&$this, 'menu_hook'));
				
					
					self::$pages['wp-uou_tigerp-profile-fields'] = add_submenu_page('wp-', 'WP uou_tigerp profile-fields', '', 'manage_options', 'wp-uou_tigerp-profile-fields', array(&$this, 'profile_fields_setting'));
					
					self::$pages['wp-uou_tigerp-package-create'] = add_submenu_page('', 'WP uou_tigerp package', '', 'manage_options', 'wp-uou_tigerp-package-create', array(&$this, 'package_create_page'));
					self::$pages['wp-uou_tigerp-package-update'] = add_submenu_page('', 'WP uou_tigerp package', '', 'manage_options', 'wp-uou_tigerp-package-update', array(&$this, 'package_update_page'));
					
					self::$pages['wp-uou_tigerp-coupon-create'] = add_submenu_page('', 'WP uou_tigerp coupon', '', 'manage_options', 'wp-uou_tigerp-coupon-create', array(&$this, 'coupon_create_page'));
					self::$pages['wp-uou_tigerp-coupon-update'] = add_submenu_page('', 'WP uou_tigerp coupon', '', 'manage_options', 'wp-uou_tigerp-coupon-update', array(&$this, 'coupon_update_page'));
					
					self::$pages['wp-uou_tigerp-payment-paypal'] = add_submenu_page('', 'WP uou_tigerp Payment setting', '', 'manage_options', 'wp-uou_tigerp-payment-paypal', array(&$this, 'paypal_update_page'));
					//self::$pages['wp-uou_tigerp-payment-authorize'] = add_submenu_page('wp-uou_tigerp', 'WP uou_tigerp Payment setting', '', 'manage_options', 'wp-uou_tigerp-payment-authorize', array(&$this, 'authorize_update_page'));
					self::$pages['wp-uou_tigerp-payment-stripe'] = add_submenu_page('', 'WP uou_tigerp Payment setting', '', 'manage_options', 'wp-uou_tigerp-payment-stripe', array(&$this, 'stripe_update_page'));
					
					self::$pages['wp-uou_tigerp-user_update'] = add_submenu_page('', 'WP uou_tigerp user_update', '', 'manage_options', 'wp-uou_tigerp-user_update', array(&$this, 'user_update_page'));
					
					
					
				}
				
				/**
				 * Menu Page Router
				 */
				public function menu_hook() {
					$screen = get_current_screen();
					switch ($screen->id) {
						default:
							include ('pages/profile_fields.php');
						break;
						
						case self::$pages['wp-uou_tigerp-coupons-form']:
						include ('pages/all_coupons.php');
						break;
						case self::$pages['wp-uou_tigerp-package-all']:
							
							include ('pages/package_all.php');
							
						break;
						case self::$pages['wp-uou_tigerp-payment-setting']:							
							include ('pages/payment-settings.php');
														
						break;
						case self::$pages['wp-uou_tigerp-report']:
							
							include ('pages/report.php');							
						break;
						 
					

						case self::$pages['wp-uou_tigerp-settings']:
						include ('pages/settings.php');
						break;																	
							
						
						
						
						
						case self::$pages['wp-iv_user-directory-admin']:							
							include ('pages/user_directory_admin.php');
							
						break;	
						
						case self::$pages['wp-iv_dir_fields']:							
							include ('pages/profile_fields.php');
							
						break;
						case self::$pages['wp-iv_corporate_fields']:							
							include ('pages/corporate_fields.php');
							
						break;
						case self::$pages['wp-uou_tigerp-profile-fields']:							
							include ('pages/my-account-menu.php');
							
						break;
						
						
												
					}
				}
				public function  profile_fields_setting (){
					include ('pages/my-account-menu.php');
				}
				public function coupon_create_page(){
					include ('pages/coupon_create.php');
				}
				public function coupon_update_page(){
					include ('pages/coupon_update.php');
				}

				public function package_create_page(){
					include ('pages/package_create.php');
				}
				public function package_update_page(){
					include ('pages/package_update.php');
				}
				public function authorize_update_page(){
					include ('pages/authorize_update.php');
				}
				public function paypal_update_page(){
					include ('pages/paypal_update.php');
				}
				public function stripe_update_page(){
					include ('pages/stripe_update.php');
				}
				public function user_update_page(){
					include ('pages/user_update.php');
				}
				/**
				 * Page based Script Loader
				 */
				public function load_scripts() {
					$screen = get_current_screen();
					if (in_array($screen->id, array_values(self::$pages))) {
						wp_enqueue_script('uou_tigerp-script-3', wp_uou_tigerp_URLPATH . 'admin/files/js/jquery-ui.min.js');
						//wp_enqueue_script('uou_tigerp-script-3', wp_uou_tigerp_URLPATH . 'admin/files/js/jquery-ui.js');
						wp_enqueue_script('uou_tigerp-script-4', wp_uou_tigerp_URLPATH . 'admin/files/js/bootstrap.min.js');
						//wp_enqueue_script('uou_tigerp-script-4', wp_uou_tigerp_URLPATH . 'admin/files/js/jquery.ui.widget.js');
						wp_enqueue_script('uou_tigerp-script-5', wp_uou_tigerp_URLPATH . 'admin/files/js/jquery.ui.touch-punch.min.js');	
						wp_enqueue_script('uou_tigerp-script-1', wp_uou_tigerp_URLPATH . 'admin/files/js/handlebars.min.js');
					}
					
				}

				
				/**
				 * Page based Style Loader
				 */
				public function load_styles() {
					$screen = get_current_screen();
					if (in_array($screen->id, array_values(self::$pages))) {
						wp_enqueue_style('wp-uou_tigerp-style-3', wp_uou_tigerp_URLPATH . 'admin/files/css/jquery-ui.css');	
					}
					wp_enqueue_style('wp-uou_tigerp-style-2', wp_uou_tigerp_URLPATH . 'admin/files/css/iv-bootstrap.css');
				}
				
				/**
				 * This function declares the different forms, sections and fields.
				 */
				public function settings_form() {
					register_setting('wp_uou_tigerp_settings', 'wp_uou_tigerp_settings', array(&$this, 'validate'));						
						// General Settings
					add_settings_section('general_section', 'General Settings', 'wp_admin_forms::section_description', 'wp_uou_tigerp_general_section');
					add_settings_field('text_field', 'Text Field', 'wp_admin_forms::textbox', 'wp_uou_tigerp_general_section', 'general_section', array('id' => 'text_field', 'text' => '', 'settings' => 'wp_uou_tigerp_settings'));
					add_settings_field('checkbox_field', 'Checkbox Field', 'wp_admin_forms::checkbox', 'wp_uou_tigerp_general_section', 'general_section', array('id' => 'checkbox_field', 'text' => '', 'settings' => 'wp_uou_tigerp_settings'));
					add_settings_field('textarea_field', 'Textbox Field', 'wp_admin_forms::textarea', 'wp_uou_tigerp_general_section', 'general_section', array('id' => 'textarea_field', 'settings' => 'wp_uou_tigerp_settings'));
				}
				
				/**
				 * This functions validate the submitted user input.
				 * @param array $var
				 * @return array
				 */
				public function validate($var) {
					return $var;
				}
				
				/**
				 * Use this function to execute actions
				 */
				public function action_hook() {
					if (!isset($_GET['action'])) {
						return;
					}
					switch ($_GET['action']) {
					}
				}
				
				public function uou_tigerp_save_package() {
					
					parse_str($_POST['form_data'], $form_data);
					
					
					global $wpdb;			
		
					$last_post_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_type = 'uou_tigerp_pack' ORDER BY `ID` DESC ");
					$form_number = $last_post_id + 1;
					$role_name='';
					if($form_data['package_name']==""){
						$post_name = 'Package' . $form_number;
						$role_name=$post_name;
					}else{
						$post_name = $form_data['package_name'] .'-'. $form_number;
						$role_name=$form_data['package_name'];
						
					}					
					$post_title=$form_data['package_name'];
					
					$post_content= $form_data['package_feature']; 

						$my_post_form = array('post_title' => wp_strip_all_tags($post_title), 'post_name' => wp_strip_all_tags($post_name), 'post_content' => $post_content, 'post_status' => 'draft', 'post_author' => get_current_user_id(),);
						$newpost_id = wp_insert_post($my_post_form);

						
						$post_type = 'uou_tigerp_pack';
						$query = "UPDATE {$wpdb->prefix}posts SET post_type='" . $post_type . "' WHERE id='" . $newpost_id . "' LIMIT 1";
						$wpdb->query($query);
						
						update_post_meta($newpost_id, 'uou_tigerp_user_type', $form_data['iv_member_type']);
						
						update_post_meta($newpost_id, 'uou_tigerp_package_cost', $form_data['package_cost']);
						update_post_meta($newpost_id, 'uou_tigerp_package_initial_expire_interval', $form_data['package_initial_expire_interval']);							
						update_post_meta($newpost_id, 'uou_tigerp_package_initial_expire_type', $form_data['package_initial_expire_type']);
						
						if(isset($form_data['package_recurring'])){
							update_post_meta($newpost_id, 'uou_tigerp_package_recurring', $form_data['package_recurring']);
						}else{
							update_post_meta($newpost_id, 'uou_tigerp_package_recurring', '');
						}
						
						
						update_post_meta($newpost_id, 'uou_tigerp_package_recurring_cost_initial', $form_data['package_recurring_cost_initial']);
						update_post_meta($newpost_id, 'uou_tigerp_package_recurring_cycle_count', $form_data['package_recurring_cycle_count']);
						update_post_meta($newpost_id, 'uou_tigerp_package_recurring_cycle_type', $form_data['package_recurring_cycle_type']);
						update_post_meta($newpost_id, 'uou_tigerp_package_recurring_cycle_limit', $form_data['package_recurring_cycle_limit']);
						
						if(isset($form_data['package_enable_trial_period'])){
							update_post_meta($newpost_id, 'uou_tigerp_package_enable_trial_period', $form_data['package_enable_trial_period']);
						}else{
							update_post_meta($newpost_id, 'uou_tigerp_package_enable_trial_period', 'no');
						}
						update_post_meta($newpost_id, 'uou_tigerp_package_trial_amount', $form_data['package_trial_amount']);
						update_post_meta($newpost_id, 'uou_tigerp_package_trial_period_interval', $form_data['package_trial_period_interval']);
						update_post_meta($newpost_id, 'uou_tigerp_package_recurring_trial_type', $form_data['package_recurring_trial_type']);
						
						
						// Start User Role
						global $wp_roles;
								
						$role_name =$form_data['iv_member_type'].'-'.$role_name;						
						$contributor_roles = $wp_roles->get_role('contributor');							
						$role_name_new= str_replace(' ', '_', $role_name);
						$wp_roles->remove_role( $role_name_new );
						 
						$role_display_name = $role_name;
						
						//$wp_roles->add_role($role_name_new, $role_display_name, $contributor_roles->capabilities);
						$wp_roles->add_role($role_name_new, $role_display_name, array(
								'read' => true, // True allows that capability, False specifically removes it.
								'edit_posts' => true,
								'delete_posts' => true,
								//'edit_published_posts' => true,
								//'publish_posts' => true,
								//'edit_files' => true,
								'upload_files' => true //last in array needs no comma!
							));
													
						
						update_post_meta($newpost_id, 'uou_tigerp_package_user_role', $role_name_new);	
											
						update_post_meta($newpost_id, 'uou_tigerp_package_max_post_no', $form_data['max_pst_no']);							
						if(isset($form_data['listing_hide'])){
							update_post_meta($newpost_id, 'uou_tigerp_package_hide_job', $form_data['job_hide']);
						}else{
							update_post_meta($newpost_id, 'uou_tigerp_package_hide_job', 'no');
						}			
						
						if(isset($form_data['listing_hide'])){
							update_post_meta($newpost_id, 'uou_tigerp_package_hide_exp', $form_data['listing_hide']);
						}else{
							update_post_meta($newpost_id, 'uou_tigerp_package_hide_exp', 'no');
						}
						if(isset($form_data['listing_event'])){
							update_post_meta($newpost_id, 'uou_tigerp_package_event', $form_data['listing_event']);
						}else{
							update_post_meta($newpost_id, 'uou_tigerp_package_event', 'no');
						}
						if(isset($form_data['listing_coupon'])){
							update_post_meta($newpost_id, 'uou_tigerp_package_coupon', $form_data['listing_coupon']);
						}else{
							update_post_meta($newpost_id, 'uou_tigerp_package_coupon', 'no');
						}
						
						if(isset($form_data['listing_badge_vip'])){
							update_post_meta($newpost_id, 'uou_tigerp_package_vip_badge', $form_data['listing_badge_vip']);
						}else{
							update_post_meta($newpost_id, 'uou_tigerp_package_vip_badge', 'no');
						}
												
						if(isset($form_data['listing_doctor'])){
							update_post_meta($newpost_id, 'uou_tigerp_package_doctor', $form_data['listing_doctor']);
						}else{
							update_post_meta($newpost_id, 'uou_tigerp_package_doctor', 'no');
						}					
						if(isset($form_data['listing_award'])){
							update_post_meta($newpost_id, 'uou_tigerp_package_award', $form_data['listing_award']);
						}else{
							update_post_meta($newpost_id, 'uou_tigerp_package_video', 'no');
						}
						
						if(isset($form_data['listing_video'])){
							update_post_meta($newpost_id, 'uou_tigerp_package_video', $form_data['listing_video']);
						}else{
							update_post_meta($newpost_id, 'uou_tigerp_package_video', 'no');
						}
						if(isset($form_data['listing_booking'])){
							update_post_meta($newpost_id, 'uou_tigerp_package_booking', $form_data['listing_booking']);
						}else{
							update_post_meta($newpost_id, 'uou_tigerp_package_booking', 'no');
						}
						
						$cat_ids= '';
						if(isset($form_data['membershipcategory'])){
							$cat_ids= implode("|", $form_data['membershipcategory']);
						}
						update_post_meta($newpost_id, 'uou_tigerp_package_category_ids', $cat_ids);
												
						// End User Role
						// For Stripe Plan Create*****
						if(isset($form_data['package_recurring'])){
							$iv_gateway = get_option('uou_tigerp_payment_gateway');
							if($iv_gateway=='stripe'){
								include(wp_uou_tigerp_DIR . '/admin/files/lib/Stripe.php');
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
									
									$interval_count= ($form_data['package_recurring_cycle_count']=="" ? '1':$form_data['package_recurring_cycle_count']);
									
									$stripe_currency =get_post_meta($stripe_id, 'uou_tigerp_stripe_api_currency',true);
									Stripe::setApiKey($stripe_api);
									
									$stripe_array=array();
									$post_package_one = get_post($newpost_id); 
									$p_name = $post_package_one->post_name;
									
									$stripe_array['id']= $p_name;
									$stripe_array['name']=$post_title;
									$stripe_array['amount']=$form_data['package_recurring_cost_initial'] * 100;
									$stripe_array['interval']=$form_data['package_recurring_cycle_type'];									
									$stripe_array['interval_count']=$interval_count;
									$stripe_array['currency']=$stripe_currency;
									
									$trial=get_post_meta($newpost_id, 'uou_tigerp_package_enable_trial_period', true);
									
									if($trial=='yes'){
										
										$trial_type = get_post_meta( $newpost_id,'uou_tigerp_package_recurring_trial_type',true);
										$trial_cycle_count =get_post_meta($newpost_id, 'uou_tigerp_package_trial_period_interval', true);
										
										switch ($trial_type) {
											case 'year':
												$periodNum =  365 * 1;
												break;
											case 'month':
												$periodNum =  30 * $trial_cycle_count;
												break;
											case 'week':
												$periodNum = 7 * $trial_cycle_count;
												break;
											case 'day':
												$periodNum = 1 * $trial_cycle_count;
												break;
										}									
										$stripe_array['trial_period_days']=$periodNum;
									}																	
									
									Stripe_Plan::create($stripe_array);
							}	
						}
						// End Stripe Plan Create*****	
						echo json_encode(array('code' => 'success'));
						exit(0);
				}
				
				public function	iv_directories_install_page_template(){
			
					include (wp_uou_tigerp_ABSPATH.'install/install.php');
					
					echo json_encode(array('code' => 'Update successfully'));
					exit(0);
				}	
			
				public function iv_update_bidding_setting(){
		
						parse_str($_POST['form_data'], $form_data);	
						
						update_option('_iv_radius',$form_data['radius']);
					    update_option('_bid_start_amount',$form_data['bid_start_amount']);
						
						echo json_encode(array("code" => "success","msg"=>"Updated Successfully"));
						exit(0);

				}
				public function iv_update_dir_setting(){
						parse_str($_POST['form_data'], $form_data);	
						
						//update_option('_iv_new_badge_day',$form_data['iv_new_badge_day']);
					    update_option('_dir_approve_publish',$form_data['dir_approve_publish']);	
					    				    
					    update_option('_blog_approve_publish',$form_data['blog_approve_publish']);
					    update_option('_job_approve_publish',$form_data['job_approve_publish']);
					    //update_option('_search_button_show',$form_data['search_button_show']);
					    
					   // update_option('_dir_searchbar_show',$form_data['dir_searchbar_show']);
					   // update_option('_dir_map_show',$form_data['dir_map_show']);
					     
						//update_option('_dir_archive_page',$form_data['dir_archive']);
						 
						echo json_encode(array("code" => "success","msg"=>"Updated Successfully"));
						exit(0);
				
				}
				
				public function uou_tigerp_save_package_table(){
				
					$package_html_content =	$_REQUEST['uou_tigerp_package_template'];
					$package_html_content = str_replace('container', 'container-fluid', $package_html_content);
					
					update_option('uou_tigerp_package_template', htmlentities(stripslashes($package_html_content)));
					
					//update_option('uou_tigerp_package_template', stripslashes(wp_filter_post_kses(addslashes($_POST['uou_tigerp_package_template']))) );
					//update_option('uou_tigerp_package_template', $_POST['uou_tigerp_package_template'] );
					echo json_encode(array('code' => 'success'));
					exit(0);
				   
				}
				public function uou_tigerp_update_profile_fields(){
					
					parse_str($_POST['form_data'], $form_data);
					
										
					$opt_array2= array();
					update_option('uou_tigerp_profile_menu', '' );
					if(isset($form_data['menu_title'])){
						$max = sizeof($form_data['menu_title']);
						for($i = 0; $i < $max;$i++)
						{	
							if($form_data['menu_title'][$i]!="" AND $form_data['menu_link'][$i]!=""){
								$opt_array2[$form_data['menu_title'][$i]]=$form_data['menu_link'][$i];
							}
						}			
						update_option('uou_tigerp_profile_menu', $opt_array2 );
					}
					
					// remove menu******
					 if(isset($form_data['listinghome'])){
						update_option( '_uou_tigerp_menu_listinghome' ,$form_data['listinghome']); 
					 }else{
						update_option( '_uou_tigerp_menu_listinghome' ,'no') ; 
					 }
					 if(isset($form_data['mylevel'])){
						update_option( '_uou_tigerp_mylevel' ,$form_data['mylevel']); 
					 }else{
						update_option( '_uou_tigerp_mylevel' ,'no') ; 
					 }
					 
					 if(isset($form_data['menusetting'])){
						update_option( '_uou_tigerp_menusetting' ,$form_data['menusetting']); 
					 }else{
						update_option( '_uou_tigerp_menusetting' ,'no') ; 
					 }
					 
					
					 if(isset($form_data['menunew_hospital_listing'])){
						update_option( '_iv_menunew_hospital_listing' ,$form_data['menunew_hospital_listing']); 
					 }else{
						update_option( '_iv_menunew_hospital_listing' ,'no') ; 
					 }
					 if(isset($form_data['menunew_doctor_listing'])){
						update_option( '_iv_menunew_doctor_listing' ,$form_data['menunew_doctor_listing']); 
					 }else{
						update_option( '_iv_menunew_doctor_listing' ,'no') ; 
					 }
					
					 if(isset($form_data['menuallpost'])){
						update_option( '_uou_tigerp_menuallpost' ,$form_data['menuallpost']); 
					 }else{
						update_option( '_uou_tigerp_menuallpost' ,'no') ; 
					 }
					 
					  if(isset($form_data['menunewlisting'])){
						update_option( '_uou_tigerp_menunewlisting' ,$form_data['menunewlisting']); 
					 }else{
						update_option( '_uou_tigerp_menunewlisting' ,'no') ; 
					 }
					 
					 
					 
					 
					  if(isset($form_data['menufavorites'])){
						update_option( '_uou_tigerp_menufavorites' ,$form_data['menufavorites']); 
					 }else{
						update_option( '_uou_tigerp_menufavorites' ,'no') ; 
					 }
					  if(isset($form_data['menuinterested'])){
						update_option( '_uou_tigerp_menuinterested' ,$form_data['menuinterested']); 
					 }else{
						update_option( '_uou_tigerp_menuinterested' ,'no') ; 
					 }
					
					
					
					
					echo json_encode(array('code' => 'Update Successfully'));
					exit(0);
				
				}
				public function uou_tigerp_update_personal_fields(){
					
					parse_str($_POST['form_data'], $form_data);
					
					
					$opt_array= array();
					$max = sizeof($form_data['meta_name']);
					for($i = 0; $i < $max;$i++)
					{	
						if($form_data['meta_name'][$i]!="" AND $form_data['meta_label'][$i]!=""){
							$opt_array[$form_data['meta_name'][$i]]=$form_data['meta_label'][$i];
						}
					}					
					
															
					update_option('iv_social_profile_personal_fields', $opt_array );
					
					
					echo json_encode(array('code' => 'Update Successfully'));
					exit(0);
				
				}
				public function uou_tigerp_update_personal_fields_experience(){
					
					parse_str($_POST['form_data'], $form_data);
					
					
					$opt_array= array();
					$max = sizeof($form_data['meta_name']);
					for($i = 0; $i < $max;$i++)
					{	
						if($form_data['meta_name'][$i]!="" AND $form_data['meta_label'][$i]!=""){
							$opt_array[$form_data['meta_name'][$i]]=$form_data['meta_label'][$i];
						}
					}													
					update_option('iv_social_profile_personal_fields_experience', $opt_array );
					
					
					echo json_encode(array('code' => 'Update Successfully'));
					exit(0);
				
				}
				public function uou_tigerp_update_personal_fields_review(){
					
					parse_str($_POST['form_data'], $form_data);
					
					
					$opt_array= array();
					$max = sizeof($form_data['meta_name']);
					for($i = 0; $i < $max;$i++)
					{	
						if($form_data['meta_name'][$i]!="" AND $form_data['meta_label'][$i]!=""){
							$opt_array[$form_data['meta_name'][$i]]=$form_data['meta_label'][$i];
						}
					}													
					update_option('iv_social_profile_personal_fields_review', $opt_array );
					
					
					echo json_encode(array('code' => 'Update Successfully'));
					exit(0);
				
				}

				public function uou_tigerp_update_corporate_fields(){
					
					parse_str($_POST['form_data'], $form_data);
					
					
					$opt_array= array();
					$max = sizeof($form_data['meta_name']);
					for($i = 0; $i < $max;$i++)
					{	
						if($form_data['meta_name'][$i]!="" AND $form_data['meta_label'][$i]!=""){
							$opt_array[$form_data['meta_name'][$i]]=$form_data['meta_label'][$i];
						}
					}					
					
							
					update_option('iv_social_profile_company_type', $form_data['company_type'] );										
					update_option('iv_social_profile_corporate_fields', $opt_array );
					
					
					echo json_encode(array('code' => 'Update Successfully'));
					exit(0);
				
				}
				
				public function uou_tigerp_update_corporate_fields_review(){
					
					parse_str($_POST['form_data'], $form_data);
					
					
					$opt_array= array();
					$max = sizeof($form_data['meta_name']);
					for($i = 0; $i < $max;$i++)
					{	
						if($form_data['meta_name'][$i]!="" AND $form_data['meta_label'][$i]!=""){
							$opt_array[$form_data['meta_name'][$i]]=$form_data['meta_label'][$i];
						}
					}		
					update_option('iv_social_profile_company_type', $form_data['company_type'] );											
					update_option('iv_social_profile_corporate_fields_review', $opt_array );
					
					
					echo json_encode(array('code' => 'Update Successfully'));
					exit(0);
				
				}
				

				public function uou_tigerp_update_package() {
					
					parse_str($_POST['form_data'], $form_data);
					
					
					$post_content="";
					global $wpdb;			
		
						
										
					$post_title=$form_data['package_name'];
					$post_id=$form_data['package_id'];
					$newpost_id=$post_id;
					$post_content= $form_data['package_feature']; 	

						
						$post_type = 'uou_tigerp_pack';
						$query = "UPDATE {$wpdb->prefix}posts SET post_title='" . $post_title . "', post_content='" . $post_content . "'  WHERE id='" . $post_id . "' LIMIT 1";
						$wpdb->query($query);
						
						update_post_meta($newpost_id, 'uou_tigerp_user_type', $form_data['iv_member_type']);
						update_post_meta($newpost_id, 'uou_tigerp_package_cost', $form_data['package_cost']);
						
						update_post_meta($newpost_id, 'uou_tigerp_package_initial_expire_interval', $form_data['package_initial_expire_interval']);							
						update_post_meta($newpost_id, 'uou_tigerp_package_initial_expire_type', $form_data['package_initial_expire_type']);
						
						
						if(isset($form_data['package_recurring'])){
								update_post_meta($newpost_id, 'uou_tigerp_package_recurring', $form_data['package_recurring']);
						}else{
								update_post_meta($newpost_id, 'uou_tigerp_package_recurring', '');
						}
						if(isset($form_data['package_recurring'])){
							update_post_meta($newpost_id, 'uou_tigerp_package_recurring', $form_data['package_recurring']);
							
							
							update_post_meta($newpost_id, 'uou_tigerp_package_recurring_cost_initial', $form_data['package_recurring_cost_initial']);
							update_post_meta($newpost_id, 'uou_tigerp_package_recurring_cycle_count', $form_data['package_recurring_cycle_count']);
							update_post_meta($newpost_id, 'uou_tigerp_package_recurring_cycle_type', $form_data['package_recurring_cycle_type']);
							update_post_meta($newpost_id, 'uou_tigerp_package_recurring_cycle_limit', $form_data['package_recurring_cycle_limit']);
							
							
							
							if(isset($form_data['package_enable_trial_period'])){
								update_post_meta($newpost_id, 'uou_tigerp_package_enable_trial_period', $form_data['package_enable_trial_period']);
							}else{
								update_post_meta($newpost_id, 'uou_tigerp_package_enable_trial_period', 'no');
							}
							
							update_post_meta($newpost_id, 'uou_tigerp_package_trial_amount', $form_data['package_trial_amount']);
							update_post_meta($newpost_id, 'uou_tigerp_package_trial_period_interval', $form_data['package_trial_period_interval']);
							
							update_post_meta($newpost_id, 'uou_tigerp_package_recurring_trial_type', $form_data['package_recurring_trial_type']);
							
						}
						
															
						update_post_meta($newpost_id, 'uou_tigerp_package_max_post_no', $form_data['max_pst_no']);							
						if(isset($form_data['listing_hide'])){
							update_post_meta($newpost_id, 'uou_tigerp_package_hide_job', $form_data['job_hide']);
						}else{
							update_post_meta($newpost_id, 'uou_tigerp_package_hide_job', 'no');
						}
							
								
						if(isset($form_data['listing_hide'])){
							update_post_meta($newpost_id, 'uou_tigerp_package_hide_exp', $form_data['listing_hide']);
						}else{
							update_post_meta($newpost_id, 'uou_tigerp_package_hide_exp', 'no');
						}
						if(isset($form_data['listing_event'])){
							update_post_meta($newpost_id, 'uou_tigerp_package_event', $form_data['listing_event']);
						}else{
							update_post_meta($newpost_id, 'uou_tigerp_package_event', 'no');
						}
						if(isset($form_data['listing_coupon'])){
							update_post_meta($newpost_id, 'uou_tigerp_package_coupon', $form_data['listing_coupon']);
						}else{
							update_post_meta($newpost_id, 'uou_tigerp_package_coupon', 'no');
						}
						
						if(isset($form_data['listing_badge_vip'])){
							update_post_meta($newpost_id, 'uou_tigerp_package_vip_badge', $form_data['listing_badge_vip']);
						}else{
							update_post_meta($newpost_id, 'uou_tigerp_package_vip_badge', 'no');
						}
												
						if(isset($form_data['listing_doctor'])){
							update_post_meta($newpost_id, 'uou_tigerp_package_doctor', $form_data['listing_doctor']);
						}else{
							update_post_meta($newpost_id, 'uou_tigerp_package_doctor', 'no');
						}
						if(isset($form_data['listing_video'])){
							update_post_meta($newpost_id, 'uou_tigerp_package_video', $form_data['listing_video']);
						}else{
							update_post_meta($newpost_id, 'uou_tigerp_package_video', 'no');
						}	
						
						if(isset($form_data['listing_award'])){
							update_post_meta($newpost_id, 'uou_tigerp_package_award', $form_data['listing_award']);
						}else{
							update_post_meta($newpost_id, 'uou_tigerp_package_video', 'no');
						}
						
						if(isset($form_data['listing_booking'])){
							update_post_meta($newpost_id, 'uou_tigerp_package_booking', $form_data['listing_booking']);
						}else{
							update_post_meta($newpost_id, 'uou_tigerp_package_booking', 'no');
						}
						
						
						$cat_ids= '';
						if(isset($form_data['membershipcategory'])){
							$cat_ids= implode("|", $form_data['membershipcategory']);
						}
						
								// For Stripe*****
								// For Stripe Plan Edit*****
								if(isset($form_data['package_recurring'])){
									$iv_gateway = get_option('uou_tigerp_payment_gateway');
									if($iv_gateway=='stripe'){
										include(wp_uou_tigerp_DIR . '/admin/files/lib/Stripe.php');
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
											
											$interval_count= ($form_data['package_recurring_cycle_count']=="" ? '1':$form_data['package_recurring_cycle_count']);
											
											$stripe_currency =get_post_meta($stripe_id, 'uou_tigerp_stripe_api_currency',true);
											Stripe::setApiKey($stripe_api);
											
											$stripe_array=array();
											$post_package_one = get_post($newpost_id); 
											$p_name = $post_package_one->post_name;
											
											$stripe_array['id']= $p_name;
											$stripe_array['name']=$post_title;
											$stripe_array['amount']=$form_data['package_recurring_cost_initial'] * 100;
											$stripe_array['interval']=$form_data['package_recurring_cycle_type'];									
											$stripe_array['interval_count']=$interval_count;
											$stripe_array['currency']=$stripe_currency;
											
											$trial=get_post_meta($newpost_id, 'uou_tigerp_package_enable_trial_period', true);
											
											if($trial=='yes'){
												
												$trial_type = get_post_meta( $newpost_id,'uou_tigerp_package_recurring_trial_type',true);
												$trial_cycle_count =get_post_meta($newpost_id, 'uou_tigerp_package_trial_period_interval', true);
												
												switch ($trial_type) {
													case 'year':
														$periodNum =  365 * 1;
														break;
													case 'month':
														$periodNum =  30 * $trial_cycle_count;
														break;
													case 'week':
														$periodNum = 7 * $trial_cycle_count;
														break;
													case 'day':
														$periodNum = 1 * $trial_cycle_count;
														break;
												}									
												$stripe_array['trial_period_days']=$periodNum;
											}																	
											
											try {
												$p = Stripe_Plan::retrieve($p_name);
												$p->delete();	
												
											} catch (Exception $e) {
												
											}
																	
											
											Stripe_Plan::create($stripe_array);	
																					
											
									}	
								}
								// End Stripe Plan Create*****	
								
							
						
						update_post_meta($newpost_id, 'uou_tigerp_package_category_ids', $cat_ids);

						echo json_encode(array('code' => 'success'));
						exit(0);
				}
			public function uou_tigerp_update_paypal_settings() {
					
					parse_str($_POST['form_data'], $form_data);
					
					
					$post_content="";
					global $wpdb;			
		
						
										
						$post_name='uou_tigerp_paypal_setting';
						
						$row = $wpdb->get_row("SELECT * FROM $wpdb->posts WHERE post_name = '".$post_name."' ");
						if(sizeof($row )<1){
								
								$my_post_form = array('post_title' => wp_strip_all_tags($post_name), 'post_name' => wp_strip_all_tags($post_name), 'post_content' => 'Paypal Setting', 'post_status' => 'draft', 'post_author' => get_current_user_id(),);
								$newpost_id = wp_insert_post($my_post_form);

						
								$post_type = 'iv_payment_setting';
								$query = "UPDATE {$wpdb->prefix}posts SET post_type='" . $post_type . "' WHERE id='" . $newpost_id . "' LIMIT 1";
								$wpdb->query($query);
						}else{
								$newpost_id= $row->ID;
						}
						
						
						update_post_meta($newpost_id, 'uou_tigerp_paypal_mode', $form_data['paypal_mode']);
						update_post_meta($newpost_id, 'uou_tigerp_paypal_username', $form_data['paypal_username']);
						update_post_meta($newpost_id, 'uou_tigerp_paypal_api_password', $form_data['paypal_api_password']);
						update_post_meta($newpost_id, 'uou_tigerp_paypal_api_signature', $form_data['paypal_api_signature']);
						update_post_meta($newpost_id, 'uou_tigerp_paypal_api_currency', $form_data['paypal_api_currency']);
						
					    update_option('_uou_tigerp_api_currency', $form_data['paypal_api_currency'] );
						

						echo json_encode(array('code' => 'success'));
						exit(0);
				}
								
				
				public function uou_tigerp_update_stripe_settings() {
					
					parse_str($_POST['form_data'], $form_data);
					
					
					$post_content="";
					global $wpdb;			
		
						
										
						$post_name='uou_tigerp_stripe_setting';
						
						$row = $wpdb->get_row("SELECT * FROM $wpdb->posts WHERE post_name = '".$post_name."' ");
						if(sizeof($row )<1){
								
								$my_post_form = array('post_title' => wp_strip_all_tags($post_name), 'post_name' => wp_strip_all_tags($post_name), 'post_content' => 'stripe Setting', 'post_status' => 'draft', 'post_author' => get_current_user_id(),);
								$newpost_id = wp_insert_post($my_post_form);

						
								$post_type = 'iv_payment_setting';
								$query = "UPDATE {$wpdb->prefix}posts SET post_type='" . $post_type . "' WHERE id='" . $newpost_id . "' LIMIT 1";
								$wpdb->query($query);
						}else{
								$newpost_id= $row->ID;
						}
						
						
						update_post_meta($newpost_id, 'uou_tigerp_stripe_mode', $form_data['stripe_mode']);
						
						update_post_meta($newpost_id, 'uou_tigerp_stripe_live_secret_key', $form_data['secret_key']);						
						update_post_meta($newpost_id, 'uou_tigerp_stripe_live_publishable_key', $form_data['publishable_key']);
						
						update_post_meta($newpost_id, 'uou_tigerp_stripe_secret_test', $form_data['secret_key_test']);						
						update_post_meta($newpost_id, 'uou_tigerp_stripe_publishable_test', $form_data['stripe_publishable_test']);						
						update_post_meta($newpost_id, 'uou_tigerp_stripe_api_currency', $form_data['stripe_api_currency']);
						
					    update_option('_uou_tigerp_api_currency', $form_data['stripe_api_currency'] );
						

						echo json_encode(array('code' => 'success'));
						exit(0);
				}
				
				
				public function uou_tigerp_create_coupon() {
					
					parse_str($_POST['form_data'], $form_data);
					
					
					$post_content="";
					global $wpdb;			
		
						
										
						$post_name=$form_data['coupon_name'];
						
						$coupon_data = array('post_title' => wp_strip_all_tags($post_name), 'post_name' => wp_strip_all_tags($post_name), 'post_content' => $post_name, 'post_status' => 'draft', 'post_author' => get_current_user_id(),);
						$newpost_id = wp_insert_post($coupon_data);

						
						$post_type = 'tiger_coupon';
						$query = "UPDATE {$wpdb->prefix}posts SET post_type='" . $post_type . "' WHERE id='" . $newpost_id . "' LIMIT 1";
						$wpdb->query($query);
						if($form_data['coupon_count']==""){
							$coupon_limit='99999';
						}else{
							$coupon_limit=$form_data['coupon_count'];
						}
						$pac='';
						if(isset($_POST['form_pac_ids'])){$pac=$_POST['form_pac_ids'];}
						$pck_ids='';
						if($pac!=""){
							$pck_ids =implode(",",$pac);
						}
																		
						update_post_meta($newpost_id, 'tiger_coupon_pac_id', $pck_ids);
						update_post_meta($newpost_id, 'tiger_coupon_limit',$coupon_limit);
						
						update_post_meta($newpost_id, 'tiger_coupon_start_date', $form_data['start_date']);
						update_post_meta($newpost_id, 'tiger_coupon_end_date', $form_data['end_date']);
						update_post_meta($newpost_id, 'tiger_coupon_amount', $form_data['coupon_amount']);
						update_post_meta($newpost_id, 'tiger_coupon_type', $form_data['coupon_type']);
						
						
						

						echo json_encode(array('code' => 'success'));
						exit(0);
				}	

		public function uou_tigerp_update_coupon() {
					
						parse_str($_POST['form_data'], $form_data);						
						
						$post_content="";
						global $wpdb;	
										
						$post_title=$form_data['coupon_name'];
						$post_id=$form_data['coupon_id'];
						$newpost_id=$post_id;
						
						
						$post_type = 'uou_tigerp_pack';
						$query = "UPDATE {$wpdb->prefix}posts SET post_title='" . $post_title . "' WHERE id='" . $post_id . "' LIMIT 1";
						$wpdb->query($query);
						
						
						$pck_ids =implode(",",$_POST['form_pac_ids']);						
						update_post_meta($newpost_id, 'tiger_coupon_pac_id', $pck_ids);
						update_post_meta($newpost_id, 'tiger_coupon_limit', $form_data['coupon_count']);
						update_post_meta($newpost_id, 'tiger_coupon_start_date', $form_data['start_date']);
						update_post_meta($newpost_id, 'tiger_coupon_end_date', $form_data['end_date']);
						update_post_meta($newpost_id, 'tiger_coupon_amount', $form_data['coupon_amount']);
						
						update_post_meta($newpost_id, 'tiger_coupon_type', $form_data['coupon_type']);
						
						
						

						echo json_encode(array('code' => 'success'));
						exit(0);
				}	
			public function	uou_tigerp_update_profile_template(){
			
				$profile_style='';
				
				if(isset($_POST['profile-st'])){
					$profile_style=$_POST['profile-st'];
					
					update_option('uou_tigerp_profile-template', $profile_style); 
				}
				echo json_encode(array('code' => 'Update successfully'));
				exit(0);
			}	
			
			public function	uou_tigerp_archive_template(){
			
				$profile_style='';				
				if(isset($_POST['archive-st'])){
					$archive_st=$_POST['archive-st'];
					
					update_option('_archive_template', $archive_st); 
				}
				echo json_encode(array('code' => 'Update successfully'));
				exit(0);
			}	
			public function uou_tigerp_update_user_directory(){
				$dir_style='';				
				if(isset($_POST['profile-st'])){
					$dir_style=$_POST['profile-st'];
					
					update_option('uou_tigerp_user_directory', $dir_style); 
				}
				echo json_encode(array('code' => 'Update successfully'));
				exit(0);
			
			}
			public function uou_tigerp_update_profile_public_template(){
				$profile_style='';
				
				if(isset($_POST['profile-st'])){
					$profile_style=$_POST['profile-st'];
					
					update_option('uou_tigerp_profile-public', $profile_style); 
				}
				echo json_encode(array('code' => 'Update successfully'));
				exit(0);
			}
			public function uou_tigerp_update_signup_template(){
			
				$signup_style='';
				
				if(isset($_POST['signup-st'])){
					$signup_style=$_POST['signup-st'];
					
					update_option('uou_tigerp_signup-template', $signup_style); 
				}
				echo json_encode(array('code' => 'Update successfully'));
				exit(0);
			}
		public function	uou_tigerp_update_price_table_template(){
			
				$profile_style='';
				
				if(isset($_POST['price-tab-style'])){
					$profile_style=$_POST['price-tab-style'];
					
					update_option('uou_tigerp_price-table', $profile_style); 
				}
				
				echo json_encode(array('code' => 'Update successfully'));
				exit(0);
		}		
			
			
						
public function uou_tigerp_update_form_registration() {
	
	$form_id = 0;
	$captcha=0;
	$captcha_script="";
	
	
	
	if (isset($_POST['hidden_form_id']) AND $_POST['hidden_form_id'] <> "") {
		$form_id = $_POST['hidden_form_id'];
		
	}
	
	$form_name = "";
	if (isset($_POST['hidden_form_name']) AND $_POST['hidden_form_name'] <> "") {
		$form_name = $_POST['hidden_form_name'];
	}
	
	$uou_tigerp_email_template_type="";
	if (isset($_POST['uou_tigerp_email_template_type'])) {
		$uou_tigerp_email_template_type = $_POST['uou_tigerp_email_template_type'];
	}
	if (isset($_POST['source_formContent']) AND $_POST['source_formContent'] <> "") {
		$source_formContent = $_POST['source_formContent'];
	}
	if (isset($_POST['form_content']) AND $_POST['form_content'] <> "") {
		
		$form_content_main = $_POST['form_mdata'];
		
		
		//print_r($_POST['form_content']);
		$form_content = str_replace('iv_member_form_iv', $form_name, $_POST['form_content']);
		$action_submit = 'send_contact_' . $form_name;
		$form_content = str_replace('send_action_iv', $action_submit, $form_content);
		
		$submit_id = 'submit_' . $form_name;
		$form_content = str_replace('submit_uou_tigerp', $submit_id, $form_content);
		$form_content = str_replace('z-index', '', $form_content);
		$form_content = str_replace('well2', '', $form_content);
		
		$uou_tigerp_width_old = get_post_meta($form_id, 'uou_tigerp_width', true);
		$uou_tigerp_width = '';
		
		//$form_content = str_replace('change_width_iv', $uou_tigerp_width, $form_content);
		
		$form_content = str_replace('change_form_name', $form_name, $form_content);
		$form_content_main = str_replace('change_form_name', $form_name, $form_content_main);
	}					
	
	
	$form_script_content = "";
	if (isset($_POST['script_content']) AND $_POST['script_content'] <> "") {
		$action_submit = 'send_contact_' . $form_name;
		
		//$form_script_content = $form_script_content + '<script type="text/javascript" src="' . wp_uou_tigerp_URLPATH . 'admin/files/js/bootstrapValidator.min.js" ></script>';
		$form_script_content = '<script type="text/javascript">' . str_replace('send_action_iv', $action_submit, $_POST['script_content']) . '</script>';
		
		$submit_button = 'submit_' . $form_name;
		
		$form_script_content = str_replace('submit_uou_tigerp', $submit_button, $form_script_content);
		$form_script_content = str_replace('iv_member_form_iv', $form_name, $form_script_content);
		$form_script_content = str_replace('theform_contact', $form_name, $form_script_content);
	}
	
	if (strpos($form_content,'contact_captcha') !== false) {
		
		$captcha=1;
		$contact_captcha='contact_captcha';
		$captcha_answer='captcha_answer';
	}
	if (strpos($form_content,'contact_captcha1') !== false) {
		
		$captcha=1;
		$contact_captcha='contact_captcha1';
		$captcha_answer='captcha_answer1';
	}
		if($captcha==1){
			
			$captcha_script = '<script type="text/javascript"> jQuery(document).ready(function(){
				var lower= 5;
				var upper= 50;
				var first_number= Math.floor(Math.random() * lower) + 1;
				var second_number = Math.floor(Math.random() * upper) + 1;
				var result_number= first_number + second_number;
				jQuery("#display_math").html("<h3> "+first_number +" + "+second_number +"= ?</h3>");
				jQuery("#'.$captcha_answer.'").val(result_number);										
			});</script>';

			$form_script_content = $form_script_content. $captcha_script;


			}
		$script_ui='';
		if (strpos($form_content,'contact_date') !== false) {
				$script_ui='<link href="' . wp_uou_tigerp_URLPATH . 'admin/files/css/jquery-ui.css" rel="stylesheet" media="screen">
				<script type="text/javascript" src="' . wp_uou_tigerp_URLPATH . 'admin/files/js/jquery-ui.min.js" ></script>';
							
				$form_script_content = $form_script_content. $script_ui.'				
				<script type="text/javascript"> jQuery(function() {
							jQuery( "#contact_date" ).datepicker();
						});</script>';
		}

		global $wpdb;
					
		$form_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = 'uou_tigerp_account_form'");
					
		$post_content = $form_content . $form_script_content;
		$query = "UPDATE {$wpdb->prefix}posts SET  post_content='" . $post_content . "' WHERE id='" . $form_id . "' LIMIT 1";
		$wpdb->query($query);

		$newpost_id = $form_id;

				
		update_post_meta($newpost_id, 'uou_tigerp_content', $form_content_main);
		
		

echo json_encode(array('code' => 'success'));
exit(0);
}


public function uou_tigerp_update_form_payment() {
	
	$form_id = 0;
	$captcha=0;
	$captcha_script="";
	
	$uou_tigerp_auto_email_subject =	$_POST['uou_tigerp_auto_email_subject'];	
	$uou_tigerp_admin_email_subject=	$_POST['uou_tigerp_admin_email_subject'];
	
	if (isset($_POST['hidden_form_id']) AND $_POST['hidden_form_id'] <> "") {
		$form_id = $_POST['hidden_form_id'];
		
	}
	
	$form_name = "";
	if (isset($_POST['hidden_form_name']) AND $_POST['hidden_form_name'] <> "") {
		$form_name = 'uou_tigerp_payment';
	}
	
	$uou_tigerp_email_template_type="";
	if (isset($_POST['uou_tigerp_email_template_type'])) {
		$uou_tigerp_email_template_type = $_POST['uou_tigerp_email_template_type'];
	}
	if (isset($_POST['source_formContent']) AND $_POST['source_formContent'] <> "") {
		$source_formContent = $_POST['source_formContent'];
	}
	if (isset($_POST['form_content']) AND $_POST['form_content'] <> "") {
		
		$form_content_main = $_POST['form_mdata'];
		//echo '---$form_name---'.$form_name;
		
		//print_r($_POST['form_content']);
		$form_content = str_replace('iv_member_form_iv', $form_name, $_POST['form_content']);
		$action_submit = 'send_contact_' . $form_name;
		$form_content = str_replace('send_action_iv', $action_submit, $form_content);
		
		$submit_id = 'submit_' . $form_name;
		$form_content = str_replace('submit_uou_tigerp', $submit_id, $form_content);
		$form_content = str_replace('z-index', '', $form_content);
		$form_content = str_replace('well2', '', $form_content);
		
		$uou_tigerp_width_old = get_post_meta($form_id, 'uou_tigerp_width', true);
		$uou_tigerp_width = $_POST['uou_tigerp_width'];
		
		//$form_content = str_replace('change_width_iv', $uou_tigerp_width, $form_content);
		
		$form_content = str_replace('change_form_name', $form_name, $form_content);
		$form_content_main = str_replace('change_form_name', $form_name, $form_content_main);
	}					
	
	
	$form_script_content = "";
	if (isset($_POST['script_content']) AND $_POST['script_content'] <> "") {
		$action_submit = 'send_contact_' . $form_name;
		
		//$form_script_content = $form_script_content + '<script type="text/javascript" src="' . wp_uou_tigerp_URLPATH . 'admin/files/js/bootstrapValidator.min.js" ></script>';
		$form_script_content = '<script type="text/javascript">' . str_replace('send_action_iv', $action_submit, $_POST['script_content']) . '</script>';
		
		$submit_button = 'submit_' . $form_name;
		//$form_script_content = str_replace('submit_uou_tigerp', $submit_button, $form_script_content);
		//$form_script_content = str_replace('iv_member_form_iv', $form_name, $form_script_content);
		//$form_script_content = str_replace('theform_contact', $form_name, $form_script_content);
	}
	
	

		global $wpdb;
					
		$form_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = 'uou_tigerp_payment_form'");
					
		$post_content = $form_content . $form_script_content;
		$query = "UPDATE {$wpdb->prefix}posts SET  post_content='" . $post_content . "' WHERE id='" . $form_id . "' LIMIT 1";
		$wpdb->query($query);

		$newpost_id = $form_id;

				
		update_post_meta($newpost_id, 'uou_tigerp_content', $form_content_main);
		

echo json_encode(array('code' => 'success'));
exit(0);
}

public function uou_tigerp_save_settings() {
	$nonce = $_POST['security'];
	if (!wp_verify_nonce($nonce, 'uou_tigerp_save_settings')) {
		echo json_encode(array("code" => "error", "message" => "Unathorized Attempt"));
	} else {
		foreach ($_POST['settings'] as $key => $value) {
			update_option($key, $value);
		}
		echo json_encode(array("code" => "success", "message" => "Settings Saved"));
	}
	exit(0);
}
public function  uou_tigerp_update_payment_setting(){

		parse_str($_POST['form_data'], $form_data);
					
										
		$iv_terms='no';
		if(isset($form_data['iv_terms'])){
			$iv_terms=$form_data['iv_terms'];
		}
		$terms_detail=$form_data['terms_detail'];
		
		$iv_coupon='';
		if(isset($form_data['iv_coupon'])){
			$iv_coupon=$form_data['iv_coupon'];
		}
		
		update_option('uou_tigerp_payment_terms_text', $terms_detail );
		update_option('uou_tigerp_payment_terms', $iv_terms );
		
		update_option('_uou_tigerp_payment_coupon', $iv_coupon );
		
		
		echo json_encode(array("code" => "success","msg"=>"Updated Successfully"));
		exit(0);
}

public function uou_tigerp_update_account_setting(){
		parse_str($_POST['form_data'], $form_data);
					
										
		$post_approved='no';
		if(isset($form_data['post_approved'])){
			$post_approved=$form_data['post_approved'];
		}
		$signup_redirect=$form_data['signup_redirect'];
		$private_profile_page  = $form_data['pri_profile_redirect']; 
		$pub_profile_redirect=$form_data['profile_redirect'];
		if(isset($form_data['hide_admin_bar'])){
			$admin_bar=$form_data['hide_admin_bar'];
		}else{
			$admin_bar='no';
		}
		
		update_option('uou_tigerp_post_approved', $post_approved );
		update_option('uou_tigerp_signup_redirect', $signup_redirect );
		update_option('_uou_tigerp_profile_page', $private_profile_page );
		update_option('_uou_tigerp_profile_public_page', $pub_profile_redirect );
		update_option('_uou_tigerp_hide_admin_bar', $admin_bar );
		
		echo json_encode(array("code" => "success","msg"=>"Updated Successfully"));
		exit(0);

}
public function iv_update_protected_page_setting(){
		
		parse_str($_POST['form_data'], $form_data);
		
		if(isset($form_data['active_visibility_page'])){
			$active_visibility=$form_data['active_visibility_page'];
		}else{
			$active_visibility='no';
		}		
		update_option('_uou_tigerp_active_visibility_page', $active_visibility );
		update_option('_iv_visibility_serialize_page_role', $form_data);
		
		
		echo json_encode(array("code" => "success","msg"=>"Updated Successfully"));
		exit(0);

}
public function uou_tigerp_update_protected_setting(){
		parse_str($_POST['form_data'], $form_data);
		
		if(isset($form_data['active_visibility'])){
			$active_visibility=$form_data['active_visibility'];
		}else{
			$active_visibility='no';
		}		
		update_option('_uou_tigerp_active_visibility', $active_visibility );
		
		if(isset($form_data['login_message'])){
			update_option('_iv_visibility_login_message', $form_data['login_message'] );
		}
		if(isset($form_data['visitor_message'])){
			update_option('_iv_visibility_visitor_message', $form_data['visitor_message'] );
		}
		
		
		update_option('_iv_visibility_serialize_role', $form_data);
		
		
		echo json_encode(array("code" => "success","msg"=>"Updated Successfully"));
		exit(0);

}
public function uou_tigerp_update_tax_setting(){
		parse_str($_POST['form_data'], $form_data);
		
		if(isset($form_data['active_tax'])){
			$active_tax=$form_data['active_tax'];
		}else{
			$active_tax='no';
		}	
		update_option('_iv_tax_type', $form_data['tax_type']);			
		update_option('_uou_tigerp_active_tax', $active_tax );		
		update_option('_iv_countries_tax', $form_data);		
		update_option('_iv_comman_tax_value', $form_data['common_tax_input']);	
		
		
		echo json_encode(array("code" => "success","msg"=>"Updated Successfully"));
		exit(0);

}
public function uou_tigerp_update_post_setting(){
		parse_str($_POST['form_data'], $form_data);				
			
		if(isset($form_data['client_post_type'])){
			$post_type=$form_data['client_post_type'];
		}else{
			$post_type='post';
		}
		
		update_option('_uou_tigerp_profile_post', $post_type );
		
		
		echo json_encode(array("code" => "success","msg"=>"Updated Successfully"));
		exit(0);

}
public function  uou_tigerp_update_page_setting(){

		parse_str($_POST['form_data'], $form_data);
					
										
		$iv_terms='no';
		if(isset($form_data['iv_terms'])){
			$iv_terms=$form_data['iv_terms'];
		}
		$pricing_page=$form_data['pricing_page'];
		$signup_page=$form_data['signup_page'];
		$profile_page=$form_data['profile_page'];
		$profile_public=$form_data['profile_public'];
		$corporate_public=$form_data['corporate_public'];
		$thank_you=$form_data['thank_you_page'];
		$login=$form_data['login_page'];
		
		
		
		update_option('_uou_tigerp_price_table', $pricing_page); 
		update_option('_uou_tigerp_registration', $signup_page); 
		update_option('_uou_tigerp_profile_page', $profile_page);
		update_option('_iv_personal_profile_public_page',$profile_public);
		update_option('_iv_corporate_profile_public_page',$corporate_public);
						
		update_option('_uou_tigerp_thank_you_page',$thank_you); 
		update_option('_uou_tigerp_login_page',$login); 
		
		update_option('_dir_map_api',$form_data['dir_map_api']);
		
		echo json_encode(array("code" => "success","msg"=>"Updated Successfully"));
		exit(0);
}
public function uou_tigerp_update_email_setting(){
		
		parse_str($_POST['form_data'], $form_data);
		
		$signup_form_id=$form_data['signup_form_id'];
		update_option( 'uou_tigerp_signup_email_subject',$form_data['uou_tigerp_signup_email_subject']);
		update_option( 'uou_tigerp_signup_email',$form_data['signup_email_template']);
		
		update_option( 'uou_tigerp_forget_email_subject',$form_data['forget_email_subject']);
		update_option( 'uou_tigerp_forget_email',$form_data['forget_email_template']);
		 
		update_option('admin_email_uou_tigerp', $form_data['uou_tigerp_admin_email']); 
		update_option('uou_tigerp_order_client_email_sub', $form_data['uou_tigerp_order_email_subject']); 
		update_option('uou_tigerp_order_client_email', $form_data['order_client_email_template']); 
		update_option('uou_tigerp_order_admin_email_sub', $form_data['uou_tigerp_order_admin_email_subject']);
		update_option('uou_tigerp_order_admin_email', $form_data['order_admin_email_template']); 			
						
		update_option( 'uou_tigerp_reminder_email_subject',$form_data['uou_tigerp_reminder_email_subject']);
		update_option( 'uou_tigerp_reminder_email',$form_data['reminder_email_template']);		 
		update_option('uou_tigerp_reminder_day', $form_data['uou_tigerp_reminder_day']); 
							
		update_option( 'uou_tigerp_contact_email_subject',$form_data['contact_email_subject']);
		update_option( 'uou_tigerp_contact_email',$form_data['message_email_template']);				
		
		$bcc_message=(isset($form_data['bcc_message'])? $form_data['bcc_message']:'' );		
		update_option( '_uou_tigerp_bcc_message',$bcc_message);
		///////
		
		
		update_option( 'tiger_contact_us_email_subject',$form_data['contactus_email_subject']);
		update_option( 'tiger_contact_us_email',$form_data['contactus_email_template']);		
		update_option( 'tiger_contact_us_email_subject_client',$form_data['contactus_client_email_subject']);
		update_option( 'tiger_contact_us_email_client',$form_data['contactus_client_email_template']);
		
		echo json_encode(array("code" => "success","msg"=>"Updated Successfully"));
		exit(0);

}
public function uou_tigerp_update_mailchamp_setting (){
		parse_str($_POST['form_data'], $form_data);
		
		update_option('uou_tigerp_mailchimp_api_key', $form_data['uou_tigerp_mailchimp_api_key']); 
		update_option('uou_tigerp_mailchimp_confirmation', $form_data['uou_tigerp_mailchimp_confirmation']); 
		if(isset($form_data['uou_tigerp_mailchimp_list'])){
				update_option('uou_tigerp_mailchimp_list', $form_data['uou_tigerp_mailchimp_list']); 
		}
	
		echo json_encode(array("code" => "success","msg"=>"Updated Successfully"));
		exit(0);
}
public function uou_tigerp_update_package_status (){
	global $wpdb;
	 $package_id_update=trim($_POST['status_id']);
	 $package_current_status=trim($_POST['status_current']);
	// echo '$package_id_update....'.$package_id_update.'....$package_current_status.....'.$package_current_status;
	 //draft pending
	 //echo $package_current_status;
	 if($package_current_status=="pending"){
		$package_st='draft';
		$pac_msg='Active';
	 }else{
		$package_st='pending';
		$pac_msg='Inactive';
	 }
	 
	 $post_type = 'uou_tigerp_pack';
						$query = "UPDATE {$wpdb->prefix}posts SET post_status='" . $package_st . "' WHERE ID='" . $package_id_update . "' LIMIT 1";
			//echo $query;			
	$wpdb->query($query);
	echo json_encode(array("code" => "success","msg"=>$pac_msg,"current_st"=>$package_st));
	exit(0);
 
	
}
public function uou_tigerp_email_admin_template_change() {	
	$uou_tigerp_template = $_POST['uou_tigerp_template'];
		$settings = array('textarea_rows' => 20,);
		$content_admin = get_option('uou_tigerp_admin_email_'.$uou_tigerp_template );
		echo $content_admin;
		exit(0);
}	
public function uou_tigerp_email_client_template_change() {	
	$uou_tigerp_template = $_POST['uou_tigerp_template'];
		$settings = array('textarea_rows' => 20,);
		$content_admin = get_option('uou_tigerp_client_email_'.$uou_tigerp_template );
		echo $content_admin;
		exit(0);
}	
public function uou_tigerp_gateway_settings_update(){
	$payment_gateway = $_POST['payment_gateway'];
	global $wpdb;
	update_option('uou_tigerp_payment_gateway', $payment_gateway);
	
	// For Stripe Plan Create*****
	
	//echo'$total_package.....'.$total_package;
$iv_gateway = get_option('uou_tigerp_payment_gateway');
if($iv_gateway=='stripe'){
		$stripe_id='';
		$post_name2='uou_tigerp_stripe_setting';
		$row2 = $wpdb->get_row("SELECT * FROM $wpdb->posts WHERE post_name = '".$post_name2."' ");
		if(sizeof($row2 )>0){
		  $stripe_id= $row2->ID;
		}
		$sql="SELECT * FROM $wpdb->posts WHERE post_type = 'uou_tigerp_pack'";
		$membership_pack = $wpdb->get_results($sql);
		//$total_package=count($membership_pack);	
	if(sizeof($membership_pack)>0){
		$i=0;
		include(wp_uou_tigerp_DIR . '/admin/files/lib/Stripe.php');
		$stripe_mode=get_post_meta( $stripe_id,'uou_tigerp_stripe_mode',true);	
		if($stripe_mode=='test'){
			$stripe_api =get_post_meta($stripe_id, 'uou_tigerp_stripe_secret_test',true);	
		}else{
			$stripe_api =get_post_meta($stripe_id, 'uou_tigerp_stripe_live_secret_key',true);	
		}	
		$stripe_currency =get_post_meta($stripe_id, 'uou_tigerp_stripe_api_currency',true);
		Stripe::setApiKey($stripe_api);
		
			foreach ( $membership_pack as $row )
			{		$package_recurring=get_post_meta( $row->ID,'uou_tigerp_package_recurring',true);	
				if($package_recurring=='on'){
						$interval_count= get_post_meta( $row->ID,'uou_tigerp_package_recurring_cycle_count',true);
						$interval_count= ($interval_count=="" ? '1':$interval_count);
												
						$stripe_array=array();						
						$p_name = $row->post_name;
						
						$stripe_array['id']= $p_name;
						$stripe_array['name']=$row->post_title;
						$stripe_array['amount']=get_post_meta( $row->ID,'uou_tigerp_package_recurring_cost_initial',true) * 100;
						$stripe_array['interval']=get_post_meta( $row->ID,'uou_tigerp_package_recurring_cycle_type',true);									
						$stripe_array['interval_count']=$interval_count;
						$stripe_array['currency']=$stripe_currency;
						
						$trial=get_post_meta($row->ID, 'uou_tigerp_package_enable_trial_period', true);
						
						if($trial=='yes'){
							
							$trial_type = get_post_meta( $row->ID,'uou_tigerp_package_recurring_trial_type',true);
							$trial_cycle_count =get_post_meta($row->ID, 'uou_tigerp_package_trial_period_interval', true);
							
							switch ($trial_type) {
								case 'year':
									$periodNum =  365 * 1;
									break;
								case 'month':
									$periodNum =  30 * $trial_cycle_count;
									break;
								case 'week':
									$periodNum = 7 * $trial_cycle_count;
									break;
								case 'day':
									$periodNum = 1 * $trial_cycle_count;
									break;
							}									
							$stripe_array['trial_period_days']=$periodNum;
						}																	
						try {
							Stripe_Plan::retrieve($p_name);
							
						} catch (Exception $e) {
							if($stripe_array['amount']>0){
								Stripe_Plan::create($stripe_array);
							}
						}
						
						
				}	
			}
		}
	}	
	// End Stripe Plan Create*****	
	
	
	echo json_encode(array("code" => "success","msg"=>"Updated Successfully: Your current gateway is ".$payment_gateway));
	exit(0);
}

public function uou_tigerp_update_user_settings(){
		global $wpdb;
	parse_str($_POST['form_data'], $form_data);
	$user_id=$form_data['user_id'];
	
	 $user_id=$form_data['user_id'];
		
	 if($form_data['exp_date']!=''){
		$exp_d=date('Y-m-d', strtotime($form_data['exp_date']));	 
		update_user_meta($user_id, 'uou_tigerp_exprie_date',$exp_d); 
	}		
	update_user_meta($user_id, 'uou_tigerp_payment_status', $form_data['payment_status']);	

	
	$package_title= str_replace('-', ' ', $form_data['user_role']);
	
	
	$row2 = $wpdb->get_row("SELECT * FROM $wpdb->posts WHERE post_title = '".$package_title."' ");
	$package_id='';
	if(sizeof($row2 )>0){
		$package_id= $row2->ID;
	}	
	
	//update_user_meta($user_id, 'uou_tigerp_package_id',$package_id); 
	$user = new WP_User( $user_id );
	$user->set_role($form_data['user_role']);
	
	
	update_user_meta($user_id, 'iv_member_type',$form_data['iv_member_type']); 
	update_user_meta($user_id, 'verified',$form_data['verified']); 
	update_user_meta($user_id, 'uou_tigerp_user_status',$form_data['user_status']); 
	
	
	echo json_encode(array("code" => "success","msg"=>"Updated Successfully"));
	exit(0);

}
public function uou_tigerp_settings_save() {
	
	$sucess_message = $_POST['sucess_message'];
	$auto_reply = $_POST['auto_reply'];
	$fail_message = $_POST['fail_message'];
	
	$uou_tigerp_admin_email_subject = $_POST['uou_tigerp_admin_email_subject'];
	$uou_tigerp_auto_email_subject = $_POST['uou_tigerp_auto_email_subject'];
	
	
	update_option('uou_tigerp_success_message', $sucess_message);
	update_option('uou_tigerp_auto_reply', $auto_reply);
	update_option('uou_tigerp_fail_message', $fail_message);
	
	//update_option('uou_tigerp_admin_email_subject', $uou_tigerp_admin_email_subject);
	//update_option('uou_tigerp_auto_email_subject', $uou_tigerp_auto_email_subject);
	
	
	echo json_encode(array("code" => "success","msg"=>"Updated Successfully"));
	exit(0);
}

public function get_all_settings() {
	$all_options = wp_load_alloptions();
	$settings = array();
	$seriazlized_settings = array('uou_tigerp_selected_attributes');
	foreach ($all_options as $name => $value) {
		if (stristr($name, 'uou_tigerp_')) {
			if (in_array($name, $seriazlized_settings)) {
				$settings[$name] = unserialize($value);
			} else {
				$settings[$name] = $value;
			}
		}
	}
	return $settings;
}
}
}

$wp_uou_tigerp_admin = new wp_uou_tigerp_Admin();
