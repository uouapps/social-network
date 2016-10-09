<?php


  if (!defined('ABSPATH')) {
  	exit;
  }

  if (!class_exists('wp_uou_tigerp')) {  	
		
			final class wp_uou_tigerp {
			
			private static $instance;			
				
				public static function instance() {
					if (!isset(self::$instance) && !(self::$instance instanceof wp_uou_tigerp)) {
						self::$instance = new wp_uou_tigerp;
					}
					return self::$instance;
				}
				
				/**
				 * Construct and start the other plug-in functionality
				 */
				public function __construct() {
					
						
						//
						// 2. Declare constants and load dependencies
						//
					$this->define_constants();
					$this->load_dependencies();
					
						//
						// 3. Activation Hooks
						//
					
					add_action( 'load-themes.php',  array(&$this, 'init_theme') );	
					
					
					register_activation_hook(__FILE__, array(&$this, 'activate'));
					register_deactivation_hook(__FILE__, array(&$this, 'deactivate'));
					//register_uninstall_hook(__FILE__, 'wp_uou_tigerp::uninstall');
					
					
						//
						// 4. Load Widget
						//
					add_action('widgets_init', array(&$this, 'register_widget'));
					
						//
						// 5. i18n
						//
					//add_action('init', array(&$this, 'i18n'));
						//
						// 6. Actions
						//
					
					add_action('wp_ajax_uou_tigerp_registration_submit', array(&$this, 'uou_tigerp_registration_submit'));
					add_action('wp_ajax_nopriv_uou_tigerp_registration_submit', array(&$this, 'uou_tigerp_registration_submit'));
					add_action('wp_ajax_uou_tigerp_user_exist_check', array(&$this, 'uou_tigerp_user_exist_check'));
					add_action('wp_ajax_nopriv_uou_tigerp_user_exist_check', array(&$this, 'uou_tigerp_user_exist_check'));
					add_action('wp_ajax_uou_tigerp_check_coupon', array(&$this, 'uou_tigerp_check_coupon'));
					add_action('wp_ajax_nopriv_uou_tigerp_check_coupon', array(&$this, 'uou_tigerp_check_coupon'));					
					add_action('wp_ajax_uou_tigerp_check_package_amount', array(&$this, 'uou_tigerp_check_package_amount'));
					add_action('wp_ajax_nopriv_uou_tigerp_check_package_amount', array(&$this, 'uou_tigerp_check_package_amount'));
					
					add_action('wp_ajax_uou_tigerp_check_package_type', array(&$this, 'uou_tigerp_check_package_type'));
					add_action('wp_ajax_nopriv_uou_tigerp_check_package_type', array(&$this, 'uou_tigerp_check_package_type'));
					
					add_action('wp_ajax_uou_tigerp_update_profile_pic', array(&$this, 'uou_tigerp_update_profile_pic'));
					add_action('wp_ajax_nopriv_uou_tigerp_update_profile_pic', array(&$this, 'uou_tigerp_update_profile_pic'));
					add_action('wp_ajax_uou_tigerp_update_profile_setting', array(&$this, 'uou_tigerp_update_profile_setting'));
					add_action('wp_ajax_nopriv_uou_tigerp_update_profile_setting', array(&$this, 'uou_tigerp_update_profile_setting'));
					
					
					add_action('wp_ajax_nopriv_uou_tigerp_save_doctor', array(&$this, 'uou_tigerp_save_doctor'));
					add_action('wp_ajax_uou_tigerp_update_setting_fb', array(&$this, 'uou_tigerp_update_setting_fb'));
					add_action('wp_ajax_nopriv_uou_tigerp_update_setting_fb', array(&$this, 'uou_tigerp_update_setting_fb'));
					add_action('wp_ajax_uou_tigerp_update_setting_hide', array(&$this, 'uou_tigerp_update_setting_hide'));
					add_action('wp_ajax_nopriv_uou_tigerp_update_setting_hide', array(&$this, 'uou_tigerp_update_setting_hide'));
					add_action('wp_ajax_uou_tigerp_update_setting_password', array(&$this, 'uou_tigerp_update_setting_password'));
					add_action('wp_ajax_nopriv_uou_tigerp_update_setting_password', array(&$this, 'uou_tigerp_update_setting_password'));					
					add_action('wp_ajax_uou_tigerp_check_login', array(&$this, 'uou_tigerp_check_login'));
					add_action('wp_ajax_nopriv_uou_tigerp_check_login', array(&$this, 'uou_tigerp_check_login'));
					add_action('wp_ajax_uou_tigerp_forget_password', array(&$this, 'uou_tigerp_forget_password'));
					add_action('wp_ajax_nopriv_uou_tigerp_forget_password', array(&$this, 'uou_tigerp_forget_password'));
					add_action('wp_ajax_uou_tigerp_cancel_stripe', array(&$this, 'uou_tigerp_cancel_stripe'));
					add_action('wp_ajax_nopriv_uou_tigerp_cancel_stripe', array(&$this, 'uou_tigerp_cancel_stripe'));
					add_action('wp_ajax_uou_tigerp_cancel_paypal', array(&$this, 'uou_tigerp_cancel_paypal'));
					add_action('wp_ajax_nopriv_uou_tigerp_cancel_paypal', array(&$this, 'uou_tigerp_cancel_paypal'));
					add_action('wp_ajax_uou_tigerp_profile_stripe_upgrade', array(&$this, 'uou_tigerp_profile_stripe_upgrade'));
					add_action('wp_ajax_nopriv_uou_tigerp_profile_stripe_upgrade', array(&$this, 'uou_tigerp_profile_stripe_upgrade'));						
					add_action('wp_ajax_uou_tigerp_bulk_connection_make_follow', array(&$this, 'uou_tigerp_bulk_connection_make_follow'));
					add_action('wp_ajax_nopriv_uou_tigerp_bulk_connection_make_follow', array(&$this, 'uou_tigerp_bulk_connection_make_follow'));	
					
					add_action('wp_ajax_uou_tigerp_bulk_connection_make_deleteconnection', array(&$this, 'uou_tigerp_bulk_connection_make_deleteconnection'));
					add_action('wp_ajax_nopriv_uou_tigerp_bulk_connection_make_deleteconnection', array(&$this, 'uou_tigerp_bulk_connection_make_deleteconnection'));	
					
					add_action('wp_ajax_uou_tigerp_bulk_follower_make_deletefollower', array(&$this, 'uou_tigerp_bulk_follower_make_deletefollower'));
					add_action('wp_ajax_nopriv_uou_tigerp_bulk_follower_make_deletefollower', array(&$this, 'uou_tigerp_bulk_follower_make_deletefollower'));	
					
					add_action('wp_ajax_uou_tigerp_bulk_deletebookmarker', array(&$this, 'uou_tigerp_bulk_deletebookmarker'));
					add_action('wp_ajax_nopriv_uou_tigerp_bulk_deletebookmarker', array(&$this, 'uou_tigerp_bulk_deletebookmarker'));
					
					add_action('wp_ajax_uou_tigerp_bulk_deletemybookmarker', array(&$this, 'uou_tigerp_bulk_deletemybookmarker'));
					add_action('wp_ajax_nopriv_uou_tigerp_bulk_deletemybookmarker', array(&$this, 'uou_tigerp_bulk_deletemybookmarker'));
					
					add_action('wp_ajax_uou_tigerp_bulk_follower_make_follow', array(&$this, 'uou_tigerp_bulk_follower_make_follow'));
					add_action('wp_ajax_nopriv_uou_tigerp_bulk_follower_make_follow', array(&$this, 'uou_tigerp_bulk_follower_make_follow'));
					
					
					add_action('wp_ajax_uou_tigerp_load_more_following', array(&$this, 'uou_tigerp_load_more_following'));
					add_action('wp_ajax_nopriv_uou_tigerp_load_more_following', array(&$this, 'uou_tigerp_load_more_following'));
					
					add_action('wp_ajax_uou_tigerp_bulk_following_make_unfollow', array(&$this, 'uou_tigerp_bulk_following_make_unfollow'));
					add_action('wp_ajax_nopriv_uou_tigerp_bulk_following_make_unfollow', array(&$this, 'uou_tigerp_bulk_following_make_unfollow'));
					
					add_action('wp_ajax_uou_tigerp_bulk_following_make_connect', array(&$this, 'uou_tigerp_bulk_following_make_connect'));
					add_action('wp_ajax_nopriv_uou_tigerp_bulk_following_make_connect', array(&$this, 'uou_tigerp_bulk_following_make_connect'));
					
					//follow
					add_action('wp_ajax_uou_tigerp_save_follow', array(&$this, 'uou_tigerp_save_follow'));
					add_action('wp_ajax_nopriv_uou_tigerp_save_follow', array(&$this, 'uou_tigerp_save_follow'));
					add_action('wp_ajax_uou_tigerp_save_un_follow', array(&$this, 'uou_tigerp_save_un_follow'));
					add_action('wp_ajax_nopriv_uou_tigerp_save_un_follow', array(&$this, 'uou_tigerp_save_un_follow'));	
					//connect
					add_action('wp_ajax_uou_tigerp_save_connect', array(&$this, 'uou_tigerp_save_connect'));
					add_action('wp_ajax_nopriv_uou_tigerp_save_connect', array(&$this, 'uou_tigerp_save_connect'));
					add_action('wp_ajax_uou_tigerp_save_deleteconnect', array(&$this, 'uou_tigerp_save_deleteconnect'));
					add_action('wp_ajax_nopriv_uou_tigerp_save_deleteconnect', array(&$this, 'uou_tigerp_save_deleteconnect'));
					//bookmark
					add_action('wp_ajax_uou_tigerp_save_bookmark', array(&$this, 'uou_tigerp_save_bookmark'));
					add_action('wp_ajax_nopriv_uou_tigerp_save_bookmark', array(&$this, 'uou_tigerp_save_bookmark'));
					
					add_action('wp_ajax_uou_tigerp_load_more_connection', array(&$this, 'uou_tigerp_load_more_connection'));
					add_action('wp_ajax_nopriv_uou_tigerp_load_more_connection', array(&$this, 'uou_tigerp_load_more_connection'));	
					
					add_action('wp_ajax_uou_tigerp_load_more_bookmark', array(&$this, 'uou_tigerp_load_more_bookmark'));
					add_action('wp_ajax_nopriv_uou_tigerp_load_more_bookmark', array(&$this, 'uou_tigerp_load_more_bookmark'));						
					add_action('wp_ajax_uou_tigerp_load_more_bookmarker', array(&$this, 'uou_tigerp_load_more_bookmarker'));
					add_action('wp_ajax_nopriv_uou_tigerp_load_more_bookmarker', array(&$this, 'uou_tigerp_load_more_bookmarker'));						
					add_action('wp_ajax_uou_tigerp_load_more_follower', array(&$this, 'uou_tigerp_load_more_follower'));
					add_action('wp_ajax_nopriv_uou_tigerp_load_more_follower', array(&$this, 'uou_tigerp_load_more_follower'));	
					
					add_action('wp_ajax_uou_tigerp_load_more_jobs', array(&$this, 'uou_tigerp_load_more_jobs'));
					add_action('wp_ajax_nopriv_uou_tigerp_load_more_jobs', array(&$this, 'uou_tigerp_load_more_jobs'));	
					
					add_action('wp_ajax_uou_tigerp_load_more_post', array(&$this, 'uou_tigerp_load_more_post'));
					add_action('wp_ajax_nopriv_uou_tigerp_load_more_post', array(&$this, 'uou_tigerp_load_more_post'));					
					
					add_action('wp_ajax_uou_tigerp_save_deletebookmark', array(&$this, 'uou_tigerp_save_deletebookmark'));
					add_action('wp_ajax_nopriv_uou_tigerp_save_deletebookmark', array(&$this, 'uou_tigerp_save_deletebookmark'));
					add_action('wp_ajax_uou_tigerp_save_rating', array(&$this, 'uou_tigerp_save_rating'));
					add_action('wp_ajax_nopriv_uou_tigerp_save_rating', array(&$this, 'uou_tigerp_save_rating'));
					
					add_action('wp_ajax_uou_tigerp_save_note', array(&$this, 'uou_tigerp_save_note'));
					add_action('wp_ajax_nopriv_uou_tigerp_save_note', array(&$this, 'uou_tigerp_save_note'));
					add_action('wp_ajax_uou_tigerp_delete_favorite', array(&$this, 'uou_tigerp_delete_favorite'));
					add_action('wp_ajax_nopriv_uou_tigerp_delete_favorite', array(&$this, 'uou_tigerp_delete_favorite'));
					add_action('wp_ajax_uou_tigerp_contact_popup', array(&$this, 'uou_tigerp_contact_popup'));
					add_action('wp_ajax_nopriv_uou_tigerp_contact_popup', array(&$this, 'uou_tigerp_contact_popup'));
					add_action('wp_ajax_uou_tigerp_claim_popup', array(&$this, 'uou_tigerp_claim_popup'));
					add_action('wp_ajax_nopriv_uou_tigerp_claim_popup', array(&$this, 'uou_tigerp_claim_popup'));
					add_action('wp_ajax_uou_tigerp_message_send', array(&$this, 'uou_tigerp_message_send'));
					add_action('wp_ajax_nopriv_uou_tigerp_message_send', array(&$this, 'uou_tigerp_message_send'));						
					add_action('wp_ajax_uou_tigerp_message_contact', array(&$this, 'uou_tigerp_message_contact'));
					add_action('wp_ajax_nopriv_uou_tigerp_message_contact', array(&$this, 'uou_tigerp_message_contact'));						
					add_action('wp_ajax_uou_tigerp_paypal_notify_url', array(&$this, 'uou_tigerp_paypal_notify_url'));
					add_action('wp_ajax_nopriv_uou_tigerp_paypal_notify_url', array(&$this, 'uou_tigerp_paypal_notify_url'));					
					add_action('wp_ajax_uou_tigerp_claim_send', array(&$this, 'uou_tigerp_claim_send'));
					add_action('wp_ajax_nopriv_uou_tigerp_claim_send', array(&$this, 'uou_tigerp_claim_send'));
					add_action('wp_ajax_uou_tigerp_cron_job', array(&$this, 'uou_tigerp_cron_job'));
					add_action('wp_ajax_nopriv_uou_tigerp_cron_job', array(&$this, 'uou_tigerp_cron_job'));				
					
					
					
					
					add_action('wp_ajax_uou_tigerp_update_wp_post', array(&$this, 'uou_tigerp_update_wp_post'));
					add_action('wp_ajax_nopriv_uou_tigerp_update_wp_post', array(&$this, 'uou_tigerp_update_wp_post'));
					add_action('wp_ajax_uou_tigerp_save_wp_post', array(&$this, 'uou_tigerp_save_wp_post'));
					add_action('wp_ajax_nopriv_uou_tigerp_save_wp_post', array(&$this, 'uou_tigerp_save_wp_post'));
					//jobs jobs jobs
					add_action('wp_ajax_uou_tigerp_update_jobs', array(&$this, 'uou_tigerp_update_jobs'));
					add_action('wp_ajax_nopriv_uou_tigerp_update_jobs', array(&$this, 'uou_tigerp_update_jobs'));
					add_action('wp_ajax_uou_tigerp_save_jobs', array(&$this, 'uou_tigerp_save_jobs'));
					add_action('wp_ajax_nopriv_uou_tigerp_save_jobs', array(&$this, 'uou_tigerp_save_jobs'));
					
					
					
					
					
					add_action('plugins_loaded', array(&$this, 'start'));
					add_action('add_meta_boxes', array(&$this, 'prfx_custom_meta_iv_hospital'));
					add_action('add_meta_boxes', array(&$this, 'prfx_custom_meta_iv_doctor'));
					add_action('save_post', array(&$this, 'iv_hospital_meta_save'));
					add_action('save_post', array(&$this, 'iv_doctor_meta_save'));
									
					add_action( 'init', array(&$this, 'uou_tigerp_paypal_form_submit') );
					add_action( 'init', array(&$this, 'uou_tigerp_stripe_form_submit') );					
					add_action('wp_login', array(&$this, 'check_expiry_date'));					
					add_action('pre_get_posts',array(&$this, 'iv_restrict_media_library') );
					
					add_action('init', array(&$this, 'remove_admin_bar') );	
					add_action( 'init', array(&$this, 'iv_jobs_post_type') );
					add_action( 'init', array(&$this, 'tr_create_my_taxonomy_jobs'));	
					
						// For Visual Composer 
					add_action('vc_before_init',array(&$this, 'dir_vc_pricing_table') );
					add_action('vc_before_init',array(&$this, 'dir_vc_signup') );
					add_action('vc_before_init',array(&$this, 'dir_vc_user_login') );
					add_action('vc_before_init',array(&$this, 'dir_vc_my_account') );
					add_action('vc_before_init',array(&$this, 'dir_vc_public_profile') );
					add_action('vc_before_init',array(&$this, 'dir_vc_user_directory') );
					
						
						// 7. Shortcode					
						
						
					//add_shortcode('uou_tigerp_display', array(&$this, 'uou_tigerp_display_func'));	
					
					add_shortcode('uou_tigerp_price_table_company', array(&$this, 'uou_tigerp_price_table_company_func'));
					add_shortcode('uou_tigerp_price_table_professional', array(&$this, 'uou_tigerp_price_table_professional_func'));
					
					add_shortcode('uou_tigerp_registration_form', array(&$this, 'uou_tigerp_registration_form_func'));
					add_shortcode('uou_tigerp_payment_form', array(&$this, 'uou_tigerp_payment_form_func'));
					add_shortcode('uou_tigerp_form_wizard', array(&$this, 'uou_tigerp_form_wizard_func'));
					add_shortcode('uou_tigerp_profile_template', array(&$this, 'uou_tigerp_profile_template_func'));
					add_shortcode('uou_tigerp_profile_public', array(&$this, 'uou_tigerp_profile_public_func'));
					//add_shortcode('uou_tigerp_stripe_form', array(&$this, 'uou_tigerp_stripe_form_func'));
					add_shortcode('uou_tigerp_login', array(&$this, 'uou_tigerp_login_func'));
					add_shortcode('uou_tigerp_company_directory', array(&$this, 'uou_tigerp_company_directory'));
					add_shortcode('uou_tigerp_professionals_directory', array(&$this, 'uou_tigerp_professionals_directory'));
					
										
					add_shortcode('contact_us', array(&$this, 'contact_us_func'));
					add_shortcode('search_box', array(&$this, 'search_box_func'));
					
					
					add_shortcode('uou_tigerp_reminder_email_cron', array(&$this, 'uou_tigerp_reminder_email_cron_func'));
						// 8. Filter
					
					//add_filter('the_content', array(&$this, 'uou_tigerp_content_protected'), 9);
					add_filter( 'mce_css',	array(&$this, 'plugin_mce_css_uou_tigerp') );
					add_filter('user_contactmethods', array(&$this, 'modify_contact_methods') );					
					//add_filter('registration_redirect', array(&$this, 'iv_registration_redirect') );
					add_filter( 'author_link',  array(&$this, 'author_public_profile') );
					//add_filter('pre_get_posts', array(&$this, 'uou_tigerp_check_access'), 9);
					
								
					//---- COMMENT FILTERS ----//	
					//add_filter('comments_template', array(&$this,'no_comments_on_page'),10); 
					
					//add_action( 'init', array(&$this, 'iv_hospital_post_type') );
					//add_action( 'init', array(&$this, 'tr_create_my_taxonomy_hospital'));					
					//add_filter('request', array(&$this, 'post_type_tags_fix'));	
					
					
					
					
					//add_filter( 'template_include', array(&$this, 'include_template_function'), 9, 2  );
					
					
				}
				
				
				/**
				 * Define constants needed across the plug-in.
				 */
				private function define_constants() {
					
					if (!defined('wp_uou_tigerp_BASENAME')) define('wp_uou_tigerp_BASENAME', plugin_basename(__FILE__));
					
					if (!defined('wp_uou_tigerp_DIR')) define('wp_uou_tigerp_DIR', dirname(__FILE__));					
					if (!defined('wp_uou_tigerp_ABSPATH'))define('wp_uou_tigerp_ABSPATH', get_template_directory().'/framework/tiger-profile/' );
					if (!defined('wp_uou_tigerp_URLPATH'))define('wp_uou_tigerp_URLPATH', get_template_directory_uri().'/framework/tiger-profile/' );
					if (!defined('wp_uou_tigerp_ADMINPATH'))define('wp_uou_tigerp_ADMINPATH', get_admin_url());
					
					/*
					if (!defined('wp_uou_tigerp_BASENAME')) define('wp_uou_tigerp_BASENAME', plugin_basename(__FILE__));
					//define('wp_uou_tigerp_BASENAME', plugin_basename(__FILE__));
					if (!defined('wp_uou_tigerp_DIR')) define('wp_uou_tigerp_DIR', dirname(__FILE__));
					if (!defined('wp_uou_tigerp_FOLDER'))define('wp_uou_tigerp_FOLDER', plugin_basename(dirname(__FILE__)));
					if (!defined('wp_uou_tigerp_ABSPATH'))define('wp_uou_tigerp_ABSPATH', trailingslashit(str_replace("\\", "/", WP_PLUGIN_DIR . '/' . plugin_basename(dirname(__FILE__)))));
					if (!defined('wp_uou_tigerp_URLPATH'))define('wp_uou_tigerp_URLPATH', trailingslashit(WP_PLUGIN_URL . '/' . plugin_basename(dirname(__FILE__))));
					if (!defined('wp_uou_tigerp_ADMINPATH'))define('wp_uou_tigerp_ADMINPATH', get_admin_url());
					*/				
								
					if (!defined('wp_uou_tigerp_template'))define( 'wp_uou_tigerp_template', wp_uou_tigerp_ABSPATH.'/template/' );
					
					
				}	
				function init_theme() {					
					
					  if ( isset( $_GET['activated'] ) ) { //  if theme is activated
							// What to do when theme is active
							// delete All Page if already created 
							global $wpdb;
							$page_name=get_option('_uou_tigerp_home');						
							$query = "delete from {$wpdb->prefix}posts where  ID='".$page_name."' LIMIT 1";
							$wpdb->query($query);
							
							$page_name=get_option('_uou_tigerp_price_table');						
							$query = "delete from {$wpdb->prefix}posts where  ID='".$page_name."' LIMIT 1";
							$wpdb->query($query);
							
							$page_name=get_option('_uou_tigerp_registration');							
							$query = "delete from {$wpdb->prefix}posts where  ID='".$page_name."' LIMIT 1";
							$wpdb->query($query);
							
							$page_name=get_option('_uou_tigerp_profile_page');						
							$query = "delete from {$wpdb->prefix}posts where  ID='".$page_name."' LIMIT 1";
							$wpdb->query($query);
							
						
							
							$page_name=get_option('_uou_tigerp_login_page');					
							$query = "delete from {$wpdb->prefix}posts where  ID='".$page_name."' LIMIT 1";
							$wpdb->query($query);
							
							$page_name=get_option('_uou_tigerp_thank_you_page');					
							$query = "delete from {$wpdb->prefix}posts where  ID='".$page_name."' LIMIT 1";
							$wpdb->query($query);
							
							$page_name=get_option('_uou_tigerp_user_dir_page');						
							$query = "delete from {$wpdb->prefix}posts where  ID='".$page_name."' LIMIT 1";
							$wpdb->query($query);
							
							$page_name=get_option('_uou_tigerp_contact_page');						
							$query = "delete from {$wpdb->prefix}posts where  ID='".$page_name."' LIMIT 1";
							$wpdb->query($query);
							
							$page_name=get_option('_uou_tigerp_blog');						
							$query = "delete from {$wpdb->prefix}posts where  ID='".$page_name."' LIMIT 1";
							$wpdb->query($query);
							
							$page_name=get_option('_uou_tigerp_about_us');						
							$query = "delete from {$wpdb->prefix}posts where  ID='".$page_name."' LIMIT 1";
							$wpdb->query($query);
							
							$page_name=get_option('_uou_tigerp_company_profile');						
							$query = "delete from {$wpdb->prefix}posts where  ID='".$page_name."' LIMIT 1";
							$wpdb->query($query);
							
							$page_name=get_option('_uou_tigerp_professionals_dir_page');						
							$query = "delete from {$wpdb->prefix}posts where  ID='".$page_name."' LIMIT 1";
							$wpdb->query($query);
							
							
							
							
						
						include ('install/install.php');
						
					  }					   
					  
					}			
				/**
				 * Loads PHP files that required by the plug-in
				 */			

				public function remove_admin_bar() {
					 $iv_hide = get_option( '_uou_tigerp_hide_admin_bar');
					if (!current_user_can('administrator') && !is_admin()) {
						if($iv_hide=='yes'){							
						  show_admin_bar(false);
						  
						}
					}	
				}
					
				
				
				public function dir_vc_pricing_table() {
						vc_map( array(
						  "name" => __( "Pricing Table", "tiger" ),
						  "base" => "uou_tigerp_price_table",
						  "class" => "",
						  "category" => __( "Content", "tiger"),
						  //'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extend/bartag.js'),
						  //'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extend/bartag.css'),
						  "params" => array(
							 array(
								"type" => "textfield",
								"holder" => "div",
								"class" => "",
								"heading" => __( "Style Name", "tiger" ),
								"param_name" => "no",
								"value" => __( "Default", "tiger" ),
								"description" => __( "You can select the style from wp-admin e.g : style-1.", "tiger" )
							 )
						  )
					   ) );
				}
				public function dir_vc_signup() {
						vc_map( array(
						  "name" => __( "Signup ", "tiger" ),
						  "base" => "uou_tigerp_form_wizard",
						  "class" => "",
						  "category" => __( "Content", "tiger"),
						  //'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extend/bartag.js'),
						  //'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extend/bartag.css'),
						  "params" => array(
							 array(
								"type" => "textfield",
								"holder" => "div",
								"class" => "",
								"heading" => __( "Style Name", "tiger" ),
								"param_name" => "Default",
								"value" => __( "Default", "tiger" ),
								"description" => __( ".", "tiger" )
							 )
						  )
					   ) );
				}
				public function dir_vc_my_account() {
						vc_map( array(
						  "name" => __( "My Acount ", "tiger" ),
						  "base" => "uou_tigerp_profile_template",
						  "class" => "",
						  "category" => __( "Content", "tiger"),
						  //'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extend/bartag.js'),
						  //'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extend/bartag.css'),
						  "params" => array(
							 array(
								"type" => "textfield",
								"holder" => "div",
								"class" => "",
								"heading" => __( "Style Name", "tiger" ),
								"param_name" => "Default",
								"value" => __( "Default", "tiger" ),
								"description" => __( ".", "tiger" )
							 )
						  )
					   ) );
				}
				public function dir_vc_public_profile() {
						vc_map( array(
						  "name" => __( "Public Profile ", "tiger" ),
						  "base" => "uou_tigerp_profile_public",
						  "class" => "",
						  "category" => __( "Content", "tiger"),
						  //'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extend/bartag.js'),
						  //'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extend/bartag.css'),
						  "params" => array(
							 array(
								"type" => "textfield",
								"holder" => "div",
								"class" => "",
								"heading" => __( "Style Name", "tiger" ),
								"param_name" => "Default",
								"value" => __( "Default", "tiger" ),
								"description" => __( "You can select the style from wp-admin e.g : style-1 , style-2 ", "tiger" )
							 )
						  )
					   ) );
				}
				public function tr_create_my_taxonomy_jobs() {
					$directory_url_1='jobs';				
					
						register_taxonomy(
							$directory_url_1.'-category',
							$directory_url_1,
							array(
								'label' => __( 'Categories','tiger' ),
								'rewrite' => array( 'slug' => $directory_url_1.'-category' ),
								'hierarchical' => true,
							)
						);
				}	
				public function iv_jobs_post_type() {
					$directory_url_1=get_option('_iv_directory_url_1');					
					if($directory_url_1==""){$directory_url_1='jobs';}

					$labels = array(
						'name'                => _x( 'jobs', 'Post Type General Name', 'tiger' ),
						'singular_name'       => _x( $directory_url_1, 'Post Type Singular Name', 'tiger' ),
						'menu_name'           => __( 'Jobs', 'tiger' ),
						'name_admin_bar'      => __( "Jobs", 'text_directories' ),
						'parent_item_colon'   => __( 'Parent Item:', 'text_directories' ),
						'all_items'           => __( 'All Items', 'text_directories' ),
						'add_new_item'        => __( 'Add New Item', 'text_directories' ),
						'add_new'             => __( 'Add New', 'text_directories' ),
						'new_item'            => __( 'New Item', 'text_directories' ),
						'edit_item'           => __( 'Edit Item', 'text_directories' ),
						'update_item'         => __( 'Update Item', 'text_directories' ),
						'view_item'           => __( 'View Item', 'text_directories' ),
						'search_items'        => __( 'Search Item', 'text_directories' ),
						'not_found'           => __( 'Not found', 'text_directories' ),
						'not_found_in_trash'  => __( 'Not found in Trash', 'text_directories' ),
					);
					$args = array(
						'label'               => __( $directory_url_1, 'text_hospital' ),
						'description'         => __( $directory_url_1, 'text_hospital' ),
						'labels'              => $labels,
						'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'comments', 'post-formats','custom-fields' ),
						//'taxonomies'          => array(  'post_tag' ),
						'hierarchical'        => false,
						'public'              => true,
						'show_ui'             => true,
						'show_in_menu'        => true,
						'menu_position'       => 5,
						'show_in_admin_bar'   => true,
						'show_in_nav_menus'   => true,
						'can_export'          => true,
						'has_archive'         => true,
						'exclude_from_search' => false,
						'publicly_queryable'  => true,
						'capability_type'     => 'post',
						
					);
					register_post_type( $directory_url_1, $args );

				}	
				public function uou_tigerp_save_jobs(){
					global $current_user; global $wpdb;	
					parse_str($_POST['form_data'], $form_data);				
					$my_post = array();
					//$my_post['ID'] = $form_data['user_post_id'];
					$my_post['post_title'] = $form_data['title'];
					$my_post['post_content'] = $form_data['new_post_content'];
					
					if($form_data['post_status']=='publish'){
							$dir_approve_publish =get_option('_dir_approve_publish');
							if($dir_approve_publish!='yes'){
								$form_data['post_status']='publish';
							}
						
					}
					
					$my_post['post_status'] = $form_data['post_status'];					
					$newpost_id= wp_insert_post( $my_post );						
					//get_option( '_uou_tigerp_profile_post');
									
					$directory_url_1='jobs';
					$post_type = $directory_url_1;
					if($post_type!=''){
							$query = "UPDATE {$wpdb->prefix}posts SET post_type='" . $post_type . "' WHERE id='" . $newpost_id . "' LIMIT 1";
							$wpdb->query($query);										
					}						
					if(isset($form_data['feature_image_id'] )){
							$attach_id =$form_data['feature_image_id'];
							set_post_thumbnail( $newpost_id, $attach_id );					
					}
					
					// WPML Start******
					if ( function_exists('icl_object_id') ) {
					include_once( WP_PLUGIN_DIR . '/sitepress-multilingual-cms/inc/wpml-api.php' );
					$_POST['icl_post_language'] = $language_code = ICL_LANGUAGE_CODE;
					$query = "UPDATE {$wpdb->prefix}icl_translations SET element_type='post_".$post_type."' WHERE element_id='" . $newpost_id . "' LIMIT 1";
					$wpdb->query($query);					
					//wpml_update_translatable_content( 'post_directories', $newpost_id , $language_code );	
					}
					// End WPML**********
						
					if(isset($form_data['feature_image_id'] )){
							$attach_id =$form_data['feature_image_id'];
							set_post_thumbnail( $newpost_id, $attach_id );
					
					}
						
					if(isset($form_data['postcats'] )){ 
						$category_ids = array($form_data['postcats']);
							wp_set_object_terms( $newpost_id, $category_ids, $post_type.'-category');
					}
					if(isset($form_data['custom_name'] )){
						$custom_metas= $form_data['custom_name'] ;
						$custom_value = $form_data['custom_value'] ;
						$i=0;
						foreach($custom_metas  as $one_meta){
							if(isset($custom_metas[$i]) and isset($custom_value[$i]) ){
								if($custom_metas[$i] !=''){
									update_post_meta($newpost_id, $custom_metas[$i], $custom_value[$i]); 
								}
							}
							
						$i++;	
						}
					
					}	
					//update_user_meta($current_user->ID,'first_name', $form_data['first_name']); 
					
					echo json_encode(array("code" => "success","msg"=>"Updated Successfully"));
					exit(0);
				
				}
				public function uou_tigerp_update_jobs(){
					global $current_user;global $wpdb;	
					parse_str($_POST['form_data'], $form_data);
			
					$my_post = array();
					$my_post['ID'] = $form_data['user_post_id'];
					$my_post['post_title'] = $form_data['title'];
					$my_post['post_content'] = $form_data['edit_post_content'];
					$my_post['post_status'] = $form_data['post_status'];
					//wp_update_post( $my_post );
					
					$query = "UPDATE {$wpdb->prefix}posts SET post_title='" . $form_data['title'] . "', post_content='" . $form_data['edit_post_content'] . "', post_status='" . $form_data['post_status'] . "'   WHERE id='" . $form_data['user_post_id'] . "' LIMIT 1";
					$wpdb->query($query);		
					
					 
					if(isset($form_data['feature_image_id'] ) AND $form_data['feature_image_id']!='' ){
							$attach_id =$form_data['feature_image_id'];
							set_post_thumbnail( $form_data['user_post_id'], $attach_id );
						
					}else{
						$attach_id='0';
						delete_post_thumbnail( $form_data['user_post_id'] );
					
					}
					if(isset($form_data['postcats'] )){ 
						wp_set_post_categories($form_data['user_post_id'], $form_data['postcats'] );
					}
					// Delete All custom Post Meta 
					$custom_fields = get_post_custom($form_data['user_post_id']);
					foreach ( $custom_fields as $field_key => $field_values ) {
						if(!isset($field_values[0])){ continue;}
						if(in_array($field_key,array("_edit_lock","_edit_last"))) {continue;}
						$underscore_str=substr($field_key,0,1);
						if($underscore_str!='_'){
							 delete_post_meta($form_data['user_post_id'] ,$field_key); 
						}
						
					}					
					
					if(isset($form_data['custom_name'] )){
						$custom_metas= $form_data['custom_name'] ;
						$custom_value = $form_data['custom_value'] ;
						$i=0;
						foreach($custom_metas  as $one_meta){
							if(isset($custom_metas[$i]) and isset($custom_value[$i]) ){
								if($custom_metas[$i] !=''){
									update_post_meta($form_data['user_post_id'], $custom_metas[$i], $custom_value[$i]); 
								}
							}
							
						$i++;	
						}
					
					}	
					//update_user_meta($current_user->ID,'first_name', $form_data['first_name']); 
					
					echo json_encode(array("code" => "success","msg"=>"Updated Successfully"));
					exit(0);
				
				}
				public function uou_tigerp_update_wp_post(){
					global $current_user;global $wpdb;	
					parse_str($_POST['form_data'], $form_data);
			
					$my_post = array();
					$my_post['ID'] = $form_data['user_post_id'];
					$my_post['post_title'] = $form_data['title'];
					$my_post['post_content'] = $form_data['edit_post_content'];
					$my_post['post_status'] = $form_data['post_status'];
					//wp_update_post( $my_post );
					
					$query = "UPDATE {$wpdb->prefix}posts SET post_title='" . $form_data['title'] . "', post_content='" . $form_data['edit_post_content'] . "', post_status='" . $form_data['post_status'] . "'   WHERE id='" . $form_data['user_post_id'] . "' LIMIT 1";
					$wpdb->query($query);		
					
					 
					if(isset($form_data['feature_image_id'] ) AND $form_data['feature_image_id']!='' ){
							$attach_id =$form_data['feature_image_id'];
							set_post_thumbnail( $form_data['user_post_id'], $attach_id );
						
					}else{
						$attach_id='0';
						delete_post_thumbnail( $form_data['user_post_id'] );
					
					}
					if(isset($form_data['postcats'] )){ 
						//$category_ids = array($form_data['postcats']);
						
						 wp_set_post_categories($form_data['user_post_id'], $form_data['postcats'] );
					}
					// Delete All custom Post Meta 
					$custom_fields = get_post_custom($form_data['user_post_id']);
					foreach ( $custom_fields as $field_key => $field_values ) {
						if(!isset($field_values[0])){ continue;}
						if(in_array($field_key,array("_edit_lock","_edit_last"))) {continue;}
						$underscore_str=substr($field_key,0,1);
						if($underscore_str!='_'){
							 delete_post_meta($form_data['user_post_id'] ,$field_key); 
						}
						
					}					
					
					if(isset($form_data['custom_name'] )){
						$custom_metas= $form_data['custom_name'] ;
						$custom_value = $form_data['custom_value'] ;
						$i=0;
						foreach($custom_metas  as $one_meta){
							if(isset($custom_metas[$i]) and isset($custom_value[$i]) ){
								if($custom_metas[$i] !=''){
									update_post_meta($form_data['user_post_id'], $custom_metas[$i], $custom_value[$i]); 
								}
							}
							
						$i++;	
						}
					
					}	
					//update_user_meta($current_user->ID,'first_name', $form_data['first_name']); 
					
					echo json_encode(array("code" => "success","msg"=>"Updated Successfully"));
					exit(0);
				
				}
				public function dir_vc_user_directory() {
						vc_map( array(
						  "name" => __( "User Directory ", "tiger" ),
						  "base" => "uou_tigerp_user_directory",
						  "class" => "",
						  "category" => __( "Content", "tiger"),
						  //'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extend/bartag.js'),
						  //'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extend/bartag.css'),
						  "params" => array(
							 array(
								"type" => "textfield",
								"holder" => "div",
								"class" => "",
								"heading" => __( "Show  number of user / Page", "tiger" ),
								"param_name" => "per_page",
								"value" => __( "12", "tiger" ),
								"description" => __( "You can set the number : 10,20 ", "tiger" )
							 )
						  )
					   ) );
				}
				public function dir_vc_user_login() {
						vc_map( array(
						  "name" => __( "Login", "tiger" ),
						  "base" => "uou_tigerp_login",
						  "class" => "",
						  "category" => __( "Content", "tiger"),
						  //'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extend/bartag.js'),
						  //'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extend/bartag.css'),
						  "params" => array(
							 array(
								"type" => "textfield",
								"holder" => "div",
								"class" => "",
								"heading" => __( " Login", "tiger" ),
								"param_name" => "style",
								"value" => __( "Default", "tiger" ),
								"description" => __( "Default ", "tiger" )
							 )
						  )
					   ) );
				}
				public function search_box_func($atts = ''){
					ob_start();	
					include( wp_uou_tigerp_template. 'hospital/slider-search.php');
					$content = ob_get_clean();
					return $content;
					
			   }
				public function author_public_profile() {
					
					$author = get_the_author();	
					$iv_redirect = get_option( '_uou_tigerp_profile_public_page');
					if($iv_redirect!='defult'){ 
						$reg_page= get_permalink( $iv_redirect) ; 
						return    $reg_page.'?&id='.$author; //$reg_page ;
						//wp_redirect( $reg_page.'/author/111'  );
						exit;
					}
				}
				
				public function iv_registration_redirect(){
					$iv_redirect = get_option( 'uou_tigerp_signup_redirect');
					if($iv_redirect!='defult'){
						$reg_page= get_permalink( $iv_redirect); 
						wp_redirect( $reg_page );
						exit;
					}	
						
				}
				public function uou_tigerp_login_func(){
						include(wp_uou_tigerp_template. 'private-profile/profile-login.php');
				}
				public function uou_tigerp_forget_password(){
					
					parse_str($_POST['form_data'], $data_a);
						if( ! email_exists($data_a['forget_email']) ) {
							echo json_encode(array("code" => "not-success","msg"=>"There is no user registered with that email address."));
								exit(0);
						} else {
								include( wp_uou_tigerp_ABSPATH. 'inc/forget-mail.php');
								echo json_encode(array("code" => "success","msg"=>"Updated Successfully"));
								exit(0);
						}
				}
				public function uou_tigerp_check_login(){
					
					parse_str($_POST['form_data'], $form_data);
					global $user;
					$creds = array();
					$creds['user_login'] =$form_data['username'];
					$creds['user_password'] =  $form_data['password'];
					$creds['remember'] =  (isset($form_data['remember']) ?'true' : 'false');
					$user = wp_signon( $creds, false );
					if ( is_wp_error($user) ) {
						//echo $user->get_error_message();
						echo json_encode(array("code" => "not-success","msg"=>__('Invalid Username & Password','tiger')));
						exit(0);
					}
					if ( !is_wp_error($user) ) {
						$iv_redirect = get_option( '_uou_tigerp_profile_page');
						if($iv_redirect!='defult'){
							
							$reg_page= get_permalink( $iv_redirect); 
							echo json_encode(array("code" => "success","msg"=>$reg_page));
							exit(0);
							//wp_redirect( $reg_page );
							
						}
					}		
				
				}
				
			
			public function uou_tigerp_update_hospital(){
					global $current_user;global $wpdb;	
					parse_str($_POST['form_data'], $form_data);		
					$my_post = array();
					
					$my_post['ID'] = $newpost_id= $form_data['user_post_id'];
					
					$my_post['post_title'] = $form_data['title'];
					$my_post['post_content'] = $form_data['edit_post_content'];
					$my_post['post_status'] = $form_data['post_status'];
					//wp_update_post( $my_post );
					
					if($form_data['post_status']=='publish'){
							$dir_approve_publish =get_option('_dir_approve_publish');
							if($dir_approve_publish!='yes'){
								$form_data['post_status']='publish';
							}
						
					}
					
					$query = "UPDATE {$wpdb->prefix}posts SET post_title='" . $form_data['title'] . "', post_content='" . $form_data['edit_post_content'] . "', post_status='" . $form_data['post_status'] . "'   WHERE id='" . $form_data['user_post_id'] . "' LIMIT 1";
					$wpdb->query($query);		
					if(isset($form_data['feature_image_id'] )){
							$attach_id =$form_data['feature_image_id'];
							set_post_thumbnail( $newpost_id, $attach_id );					
					}						
					if(isset($form_data['postcats'] )){ 
						//wp_set_post_categories($newpost_id, $form_data['postcats'] );
						//wp_set_post_categories($newpost_id, array($form_data['postcats'] ));
							
							$category_ids = array($form_data['postcats']);
							wp_set_object_terms( $newpost_id, $category_ids, 'hospital-category');
					}
					$default_fields = array();
					$field_set=get_option('uou_tigerp_fields' );
					if($field_set!=""){ 
							$default_fields=get_option('uou_tigerp_fields' );
					}else{															
							$default_fields['profitNonProfit']='For-profit or non-profit?';
							$default_fields['size']='Size';
							$default_fields['cost']='Cost';
							$default_fields['average_stay']=' Average length of stay';
							$default_fields['ownership']='Ownership';
							$default_fields['accreditedBy']='Accredited by';	
							$default_fields['certifications']='Certifications';		
					}
					if(sizeof($default_fields )){			
						foreach( $default_fields as $field_key => $field_value ) { 
							if(isset($form_data[$field_key])){
								update_post_meta($newpost_id, $field_key, $form_data[$field_key] );
							}
						}					
					}
					$opening_day=array();
					if(isset($form_data['day_name'] )){
						$day_name= $form_data['day_name'] ;
						$day_value1 = $form_data['day_value1'] ;
						$day_value2 = $form_data['day_value2'] ;
						$i=0;
						foreach($day_name  as $one_meta){
							if(isset($day_name[$i]) and isset($day_value1[$i]) ){
								if($day_name[$i] !=''){
									$opening_day[$day_name[$i]]=$day_value1[$i].'|'.$day_value2[$i];
								}
							}							
						$i++;	
						}
						update_post_meta($newpost_id, '_opening_time', $opening_day); 	
					}
					// For Tag Save tag_arr
					$tag_all='';
					if(isset($form_data['tag_arr'] )){
						$tag_name= $form_data['tag_arr'] ;							
						$i=0;$tag_all='';
						foreach($tag_name  as $one_tag){							
							$tag_all= $tag_all.",".$one_tag;												
							$i++;	
						}
						wp_set_post_tags($newpost_id, $tag_all, true); 	
					}
					if(isset($form_data['new_tag'] )){
						$tag_all=$tag_all.','.$form_data['new_tag'];
						wp_set_post_tags($newpost_id, $tag_all, true); 	
					
					}	
					// Our Doctors
					if(isset($form_data['physician_list'] )){
						$doctors=$form_data['physician_list'];															
						update_post_meta($newpost_id, 'physician_list', $doctors);  	
					}	
					
					
					
					// For Specialtie Save 
					$specialtie_all='';
					if(isset($form_data['specialtie_arr'] )){
						$specialtie_name= $form_data['specialtie_arr'] ;							
						$i=0;$specialtie_all='';
						foreach($specialtie_name  as $one_specialtie){							
							$specialtie_all= $specialtie_all.",".$one_specialtie;
						}
						update_post_meta($newpost_id, 'specialtie', $specialtie_all);  	
							
					}
					
					// For Awards Save 
					// Delete 1st
					$i=0;
						for($i=0;$i<20;$i++){
								delete_post_meta($newpost_id, '_award_title_'.$i); 							
								delete_post_meta($newpost_id, '_award_description_'.$i);							
								delete_post_meta($newpost_id, '_award_year_'.$i); 						
								delete_post_meta($newpost_id, '_award_image_id_'.$i); 						
						}		
					// Delete End
					
				
					if(isset($form_data['award_title'] )){
						$award_title= $form_data['award_title'];
						$award_description= $form_data['award_description'];	
						$award_year= $form_data['award_year'];	
						$award_image_id= (isset($form_data['award_image_id']) ? $form_data['award_image_id']:'');							
													
						$i=0;
						//foreach($award_title  as $one_award_title){							
						for($i=0;$i<20;$i++){	
							if(isset($award_title[$i])){
								update_post_meta($newpost_id, '_award_title_'.$i, $award_title[$i]); 
							}
							if(isset($award_description[$i])){
								update_post_meta($newpost_id, '_award_description_'.$i, $award_description[$i]); 
							}
							if(isset($award_year[$i])){
								update_post_meta($newpost_id, '_award_year_'.$i, $award_year[$i]); 
							}
							if(isset($award_image_id[$i])){
								update_post_meta($newpost_id, '_award_image_id_'.$i, $award_image_id[$i]); 
							}
														
							//$i++;
						}						 	
							
					}
					
					//wp_set_post_tags( 42, 'meaning,life', true );
					
					
					update_post_meta($newpost_id, 'address', $form_data['address']); 
					update_post_meta($newpost_id, 'latitude', $form_data['latitude']); 
					update_post_meta($newpost_id, 'longitude', $form_data['longitude']);					
					update_post_meta($newpost_id, 'city', $form_data['city']); 
					update_post_meta($newpost_id, 'postcode', $form_data['postcode']); 
					update_post_meta($newpost_id, 'country', $form_data['country']); 
					
					// Get latlng from address* START********
					$dir_lat=$form_data['latitude'];
					$dir_lng=$form_data['longitude'];
					$address = $form_data['address'];
					if($address!=''){
							if($dir_lat=='' || $dir_lng==''){
								$latitude='';$longitude='';
								
								$prepAddr = str_replace(' ','+',$address);
								$geocode=wp_remote_fopen('http://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
								$output= json_decode($geocode);
								if(isset( $output->results[0]->geometry->location->lat)){
									$latitude = $output->results[0]->geometry->location->lat;
								}
								if(isset($output->results[0]->geometry->location->lng)){
									$longitude = $output->results[0]->geometry->location->lng;
								}
								if($latitude!=''){
									update_post_meta($newpost_id,'latitude',$latitude);
								}
								if($longitude!=''){
									update_post_meta($newpost_id,'longitude',$longitude);
								}
							}
					}	
					// Get latlng from address* END********	
					
					update_post_meta($newpost_id, 'logo_image_id', $form_data['logo_image_id']); 
					update_post_meta($newpost_id, 'image_gallery_ids', $form_data['gallery_image_ids']); 
					update_post_meta($newpost_id, 'phone', $form_data['phone']); 
					update_post_meta($newpost_id, 'fax', $form_data['fax']); 
					update_post_meta($newpost_id, 'contact-email', $form_data['contact-email']); 
					update_post_meta($newpost_id, 'contact_web', $form_data['contact_web']); 
					
					if(isset($form_data['vimeo'] )){
						update_post_meta($newpost_id, 'vimeo', $form_data['vimeo']); 
						update_post_meta($newpost_id, 'youtube', $form_data['youtube']); 
					}
					update_post_meta($newpost_id, 'facebook', $form_data['facebook']); 
					update_post_meta($newpost_id, 'linkedin', $form_data['linkedin']); 
					update_post_meta($newpost_id, 'twitter', $form_data['twitter']); 
					update_post_meta($newpost_id, 'gplus', $form_data['gplus']);
					if(isset($form_data['event-title'])){
						update_post_meta($newpost_id, '_event_image_id', $form_data['event_image_id']);
						update_post_meta($newpost_id, 'event_title', $form_data['event-title']);
						update_post_meta($newpost_id, 'event_detail', $form_data['event-detail']);
					}
										
					
					echo json_encode(array("code" => "success","msg"=>"Updated Successfully"));
					exit(0);
				
				}
				public function get_unique_post_meta_values( $key = 'designation' ){
						global $wpdb;

						if( empty( $key ) ){
							return;
						}	

						$res = $wpdb->get_col( $wpdb->prepare( "
						SELECT DISTINCT pm.meta_value FROM {$wpdb->usermeta} pm
						LEFT JOIN {$wpdb->users} p ON p.ID = pm.user_id
						WHERE pm.meta_key = '%s'						
						", $key) );

							return $res;
					}    
			public function uou_tigerp_update_doctor(){
					global $current_user;global $wpdb;	
					parse_str($_POST['form_data'], $form_data);		
					$my_post = array();
					
					$my_post['ID'] = $newpost_id= $form_data['user_post_id'];
					
					$my_post['post_title'] = $form_data['title'];
					$my_post['post_content'] = $form_data['edit_post_content'];
					$my_post['post_status'] = $form_data['post_status'];
					//wp_update_post( $my_post );
					
					if($form_data['post_status']=='publish'){
							$dir_approve_publish =get_option('_dir_approve_publish');
							if($dir_approve_publish!='yes'){
								$form_data['post_status']='publish';
							}
						
					}
					
					$query = "UPDATE {$wpdb->prefix}posts SET post_title='" . $form_data['title'] . "', post_content='" . $form_data['edit_post_content'] . "', post_status='" . $form_data['post_status'] . "'   WHERE id='" . $form_data['user_post_id'] . "' LIMIT 1";
					$wpdb->query($query);		
					if(isset($form_data['feature_image_id'] )){
							$attach_id =$form_data['feature_image_id'];
							set_post_thumbnail( $newpost_id, $attach_id );					
					}						
					if(isset($form_data['postcats'] )){ 
						//wp_set_post_categories($newpost_id, $form_data['postcats'] );
						//wp_set_post_categories($newpost_id, array($form_data['postcats'] ));
							
							$category_ids = array($form_data['postcats']);
							wp_set_object_terms( $newpost_id, $category_ids, 'doctor-category');
					}
					$default_fields = array();
					$field_set=get_option('uou_tigerp_fields_doctor' );
					if($field_set!=""){ 
							$default_fields=get_option('uou_tigerp_fields_doctor' );
					}else{															
							$default_fields['HospitalAffiliations']='Hospital Affiliations';
							$default_fields['ExperienceTranining']='Experience / Tranining';
							$default_fields['MedicalSchool']='Medical School';
							$default_fields['Internship']='Internship';
							$default_fields['Residency']='Residency';
							$default_fields['Fellowship']='Fellowship';	
							$default_fields['Certifications']='Certifications';	
							$default_fields['LeadershipRoles']='Leadership Roles';	
					}
					if(sizeof($default_fields )){			
						foreach( $default_fields as $field_key => $field_value ) { 
							if(isset($form_data[$field_key])){
								update_post_meta($newpost_id, $field_key, $form_data[$field_key] );
							}
						}					
					}
					$opening_day=array();
					if(isset($form_data['day_name'] )){
						$day_name= $form_data['day_name'] ;
						$day_value1 = $form_data['day_value1'] ;
						$day_value2 = $form_data['day_value2'] ;
						$i=0;
						foreach($day_name  as $one_meta){
							if(isset($day_name[$i]) and isset($day_value1[$i]) ){
								if($day_name[$i] !=''){
									$opening_day[$day_name[$i]]=$day_value1[$i].'|'.$day_value2[$i];
								}
							}							
						$i++;	
						}
						update_post_meta($newpost_id, '_opening_time', $opening_day); 	
					}

										
					// For Specialtie Save 
					$specialtie_all='';
					if(isset($form_data['specialtie_arr'] )){
						$specialtie_name= $form_data['specialtie_arr'] ;							
						$i=0;$specialtie_all='';
						foreach($specialtie_name  as $one_specialtie){							
							$specialtie_all= $specialtie_all.",".$one_specialtie;
						}
						update_post_meta($newpost_id, 'specialtie', $specialtie_all);  	
							
					}
					
					// For Awards Save 
					// Delete 1st
					$i=0;
						for($i=0;$i<20;$i++){
								delete_post_meta($newpost_id, '_award_title_'.$i); 							
								delete_post_meta($newpost_id, '_award_description_'.$i);							
								delete_post_meta($newpost_id, '_award_year_'.$i); 						
								delete_post_meta($newpost_id, '_award_image_id_'.$i); 						
						}		
					// Delete End
					
				
					if(isset($form_data['award_title'] )){
						$award_title= $form_data['award_title'];
						$award_description= $form_data['award_description'];	
						$award_year= $form_data['award_year'];	
						$award_image_id= (isset($form_data['award_image_id']) ? $form_data['award_image_id']:'');							
													
						$i=0;
						//foreach($award_title  as $one_award_title){							
						for($i=0;$i<20;$i++){		
							if(isset($award_title[$i])){
								update_post_meta($newpost_id, '_award_title_'.$i, $award_title[$i]); 
							}
							if(isset($award_description[$i])){
								update_post_meta($newpost_id, '_award_description_'.$i, $award_description[$i]); 
							}
							if(isset($award_year[$i])){
								update_post_meta($newpost_id, '_award_year_'.$i, $award_year[$i]); 
							}
							if(isset($award_image_id[$i])){
								update_post_meta($newpost_id, '_award_image_id_'.$i, $award_image_id[$i]); 
							}
														
							//$i++;
						}						 	
							
					}
					
					//wp_set_post_tags( 42, 'meaning,life', true );
					
					
					update_post_meta($newpost_id, 'address', $form_data['address']); 
					update_post_meta($newpost_id, 'latitude', $form_data['latitude']); 
					update_post_meta($newpost_id, 'longitude', $form_data['longitude']);					
					update_post_meta($newpost_id, 'city', $form_data['city']); 
					update_post_meta($newpost_id, 'postcode', $form_data['postcode']); 
					update_post_meta($newpost_id, 'country', $form_data['country']); 
					
					// Get latlng from address* START********
					$dir_lat=$form_data['latitude'];
					$dir_lng=$form_data['longitude'];
					$address = $form_data['address'];
					if($address!=''){
							if($dir_lat=='' || $dir_lng==''){
								$latitude='';$longitude='';
								
								$prepAddr = str_replace(' ','+',$address);
								$geocode=wp_remote_fopen('http://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
								$output= json_decode($geocode);
								if(isset( $output->results[0]->geometry->location->lat)){
									$latitude = $output->results[0]->geometry->location->lat;
								}
								if(isset($output->results[0]->geometry->location->lng)){
									$longitude = $output->results[0]->geometry->location->lng;
								}
								if($latitude!=''){
									update_post_meta($newpost_id,'latitude',$latitude);
								}
								if($longitude!=''){
									update_post_meta($newpost_id,'longitude',$longitude);
								}
							}
					}	
					// Get latlng from address* END********					
					
					 
					update_post_meta($newpost_id, 'phone', $form_data['phone']); 
					update_post_meta($newpost_id, 'fax', $form_data['fax']); 
					update_post_meta($newpost_id, 'contact-email', $form_data['contact-email']); 
					update_post_meta($newpost_id, 'contact_web', $form_data['contact_web']); 
					
					if(isset($form_data['vimeo'] )){
						update_post_meta($newpost_id, 'vimeo', $form_data['vimeo']); 
						update_post_meta($newpost_id, 'youtube', $form_data['youtube']); 
					}
					update_post_meta($newpost_id, 'facebook', $form_data['facebook']); 
					update_post_meta($newpost_id, 'linkedin', $form_data['linkedin']); 
					update_post_meta($newpost_id, 'twitter', $form_data['twitter']); 
					update_post_meta($newpost_id, 'gplus', $form_data['gplus']);
					if(isset($form_data['event-title'])){
						update_post_meta($newpost_id, '_event_image_id', $form_data['event_image_id']);
						update_post_meta($newpost_id, 'event_title', $form_data['event-title']);
						update_post_meta($newpost_id, 'event_detail', $form_data['event-detail']);
					}
										
					if(isset($form_data['booking'])){
						update_post_meta($newpost_id, 'booking', $form_data['booking']);
					}
					if(isset($form_data['booking_detail'])){
						update_post_meta($newpost_id, 'booking_detail', $form_data['booking_detail']);
												
					}
					
					echo json_encode(array("code" => "success","msg"=>"Updated Successfully"));
					exit(0);
				
				}
				public function uou_tigerp_save_doctor(){
					global $current_user; global $wpdb;	
					parse_str($_POST['form_data'], $form_data);				
					$my_post = array();
					//$my_post['ID'] = $form_data['user_post_id'];
					$my_post['post_title'] = $form_data['title'];
					$my_post['post_content'] = $form_data['new_post_content'];
					
					if($form_data['post_status']=='publish'){
							$dir_approve_publish =get_option('_dir_approve_publish');
							if($dir_approve_publish!='yes'){
								$form_data['post_status']='publish';
							}
					}
					
					$my_post['post_status'] = $form_data['post_status'];					
					$newpost_id= wp_insert_post( $my_post );						
					$post_type = 'doctor';//get_option( '_uou_tigerp_profile_post');
					if($post_type!=''){
							$query = "UPDATE {$wpdb->prefix}posts SET post_type='" . $post_type . "' WHERE id='" . $newpost_id . "' LIMIT 1";
							$wpdb->query($query);										
					}
						// WPML Start******
					if ( function_exists('icl_object_id') ) {
					include_once( WP_PLUGIN_DIR . '/sitepress-multilingual-cms/inc/wpml-api.php' );
					$_POST['icl_post_language'] = $language_code = ICL_LANGUAGE_CODE;
					$query = "UPDATE {$wpdb->prefix}icl_translations SET element_type='post_doctor' WHERE element_id='" . $newpost_id . "' LIMIT 1";
					$wpdb->query($query);					
					//wpml_update_translatable_content( 'post_directories', $newpost_id , $language_code );	
					}
					// End WPML**********
											
					if(isset($form_data['feature_image_id'] )){
							$attach_id =$form_data['feature_image_id'];
							set_post_thumbnail( $newpost_id, $attach_id );					
					}						
					if(isset($form_data['postcats'] )){ 
						//wp_set_post_categories($newpost_id, $form_data['postcats'] );
						//wp_set_post_categories($newpost_id, array($form_data['postcats'] ));
							
							$category_ids = array($form_data['postcats']);
							wp_set_object_terms( $newpost_id, $category_ids, 'doctor-category');
					}
					$default_fields = array();
					$field_set=get_option('uou_tigerp_fields_doctor' );
					if($field_set!=""){ 
							$default_fields=get_option('uou_tigerp_fields_doctor' );
					}else{															
							$default_fields['HospitalAffiliations']='Hospital Affiliations';
							$default_fields['ExperienceTranining']='Experience / Tranining';
							$default_fields['MedicalSchool']='Medical School';
							$default_fields['Internship']='Internship';
							$default_fields['Residency']='Residency';
							$default_fields['Fellowship']='Fellowship';	
							$default_fields['Certifications']='Certifications';	
							$default_fields['LeadershipRoles']='Leadership Roles';	
					}
					if(sizeof($default_fields )){			
						foreach( $default_fields as $field_key => $field_value ) { 
							if(isset($form_data[$field_key])){
								update_post_meta($newpost_id, $field_key, $form_data[$field_key] );
							}
						}					
					}
					$opening_day=array();
					if(isset($form_data['day_name'] )){
						$day_name= $form_data['day_name'] ;
						$day_value1 = $form_data['day_value1'] ;
						$day_value2 = $form_data['day_value2'] ;
						$i=0;
						foreach($day_name  as $one_meta){
							if(isset($day_name[$i]) and isset($day_value1[$i]) ){
								if($day_name[$i] !=''){
									$opening_day[$day_name[$i]]=$day_value1[$i].'|'.$day_value2[$i];
								}
							}							
						$i++;	
						}
						update_post_meta($newpost_id, '_opening_time', $opening_day); 	
					}
					
					
					// For Specialtie Save 
					$specialtie_all='';
					if(isset($form_data['specialtie_arr'] )){
						$specialtie_name= $form_data['specialtie_arr'] ;							
						$i=0;$specialtie_all='';
						foreach($specialtie_name  as $one_specialtie){							
							$specialtie_all= $specialtie_all.",".$one_specialtie;
						}
						update_post_meta($newpost_id, 'specialtie', $specialtie_all);  	
							
					}
					
					// For Awards Save 
				
					if(isset($form_data['award_title'] )){
						$award_title= $form_data['award_title'];
						$award_description= $form_data['award_description'];	
						$award_year= $form_data['award_year'];	
						$award_image_id= (isset($form_data['award_image_id']) ? $form_data['award_image_id']:'');							
													
						$i=0;
						//foreach($award_title  as $one_award_title){							
						for($i=0;$i<20;$i++){		
							if(isset($award_title[$i])){
								update_post_meta($newpost_id, '_award_title_'.$i, $award_title[$i]); 
							}
							if(isset($award_description[$i])){
								update_post_meta($newpost_id, '_award_description_'.$i, $award_description[$i]); 
							}
							if(isset($award_year[$i])){
								update_post_meta($newpost_id, '_award_year_'.$i, $award_year[$i]); 
							}
							if(isset($award_image_id[$i])){
								update_post_meta($newpost_id, '_award_image_id_'.$i, $award_image_id[$i]); 
							}
														
							//$i++;
						}						 	
							
					}
					
					//wp_set_post_tags( 42, 'meaning,life', true );
					
					
					update_post_meta($newpost_id, 'address', $form_data['address']); 
					update_post_meta($newpost_id, 'latitude', $form_data['latitude']); 
					update_post_meta($newpost_id, 'longitude', $form_data['longitude']);					
					update_post_meta($newpost_id, 'city', $form_data['city']); 
					update_post_meta($newpost_id, 'postcode', $form_data['postcode']); 
					update_post_meta($newpost_id, 'country', $form_data['country']); 
					
					// Get latlng from address* START********
					$dir_lat=$form_data['latitude'];
					$dir_lng=$form_data['longitude'];
					$address = $form_data['address'];
					if($address!=''){
							if($dir_lat=='' || $dir_lng==''){
								$latitude='';$longitude='';
								
								$prepAddr = str_replace(' ','+',$address);
								$geocode=wp_remote_fopen('http://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
								$output= json_decode($geocode);
								if(isset( $output->results[0]->geometry->location->lat)){
									$latitude = $output->results[0]->geometry->location->lat;
								}
								if(isset($output->results[0]->geometry->location->lng)){
									$longitude = $output->results[0]->geometry->location->lng;
								}
								if($latitude!=''){
									update_post_meta($newpost_id,'latitude',$latitude);
								}
								if($longitude!=''){
									update_post_meta($newpost_id,'longitude',$longitude);
								}
							}
					}	
					// Get latlng from address* END********	
					
					//update_post_meta($newpost_id, 'logo_image_id', $form_data['logo_image_id']); 
					//update_post_meta($newpost_id, 'image_gallery_ids', $form_data['gallery_image_ids']); 
					update_post_meta($newpost_id, 'phone', $form_data['phone']); 
					update_post_meta($newpost_id, 'fax', $form_data['fax']); 
					update_post_meta($newpost_id, 'contact-email', $form_data['contact-email']); 
					update_post_meta($newpost_id, 'contact_web', $form_data['contact_web']); 
					
					if(isset($form_data['vimeo'] )){
						update_post_meta($newpost_id, 'vimeo', $form_data['vimeo']); 
						update_post_meta($newpost_id, 'youtube', $form_data['youtube']); 
					}
					update_post_meta($newpost_id, 'facebook', $form_data['facebook']); 
					update_post_meta($newpost_id, 'linkedin', $form_data['linkedin']); 
					update_post_meta($newpost_id, 'twitter', $form_data['twitter']); 
					update_post_meta($newpost_id, 'gplus', $form_data['gplus']);
					/*
					if(isset($form_data['event-title'])){
						update_post_meta($newpost_id, '_event_image_id', $form_data['event_image_id']);
						update_post_meta($newpost_id, 'event_title', $form_data['event-title']);
						update_post_meta($newpost_id, 'event_detail', $form_data['event-detail']);
					}
					*/					
					if(isset($form_data['booking'])){
						update_post_meta($newpost_id, 'booking', $form_data['booking']);
					}
					if(isset($form_data['booking_detail'])){
						update_post_meta($newpost_id, 'booking_detail', $form_data['booking_detail']);
												
					}
					echo json_encode(array("code" => "success","msg"=>"Updated Successfully"));
					exit(0);
				
				}
			
				
				public function uou_tigerp_save_hospital(){
					global $current_user; global $wpdb;	
					parse_str($_POST['form_data'], $form_data);				
					$my_post = array();
					//$my_post['ID'] = $form_data['user_post_id'];
					$my_post['post_title'] = $form_data['title'];
					$my_post['post_content'] = $form_data['new_post_content'];
					
					if($form_data['post_status']=='publish'){
							$dir_approve_publish =get_option('_dir_approve_publish');
							if($dir_approve_publish!='yes'){
								$form_data['post_status']='publish';
							}
						
					}
					
					$my_post['post_status'] = $form_data['post_status'];					
					$newpost_id= wp_insert_post( $my_post );						
					$post_type = 'hospital';//get_option( '_uou_tigerp_profile_post');
					if($post_type!=''){
							$query = "UPDATE {$wpdb->prefix}posts SET post_type='" . $post_type . "' WHERE id='" . $newpost_id . "' LIMIT 1";
							$wpdb->query($query);										
					}
					// WPML Start******
					if ( function_exists('icl_object_id') ) {
					include_once( WP_PLUGIN_DIR . '/sitepress-multilingual-cms/inc/wpml-api.php' );
					$_POST['icl_post_language'] = $language_code = ICL_LANGUAGE_CODE;
					$query = "UPDATE {$wpdb->prefix}icl_translations SET element_type='post_hospital' WHERE element_id='" . $newpost_id . "' LIMIT 1";
					$wpdb->query($query);					
					//wpml_update_translatable_content( 'post_directories', $newpost_id , $language_code );	
					}
					// End WPML**********
					
											
					if(isset($form_data['feature_image_id'] )){
							$attach_id =$form_data['feature_image_id'];
							set_post_thumbnail( $newpost_id, $attach_id );					
					}						
					if(isset($form_data['postcats'] )){ 
						//wp_set_post_categories($newpost_id, $form_data['postcats'] );
						//wp_set_post_categories($newpost_id, array($form_data['postcats'] ));
							
							$category_ids = array($form_data['postcats']);
							wp_set_object_terms( $newpost_id, $category_ids, 'hospital-category');
					}
					$default_fields = array();
					$field_set=get_option('uou_tigerp_fields' );
					if($field_set!=""){ 
							$default_fields=get_option('uou_tigerp_fields' );
					}else{															
							$default_fields['profitNonProfit']='For-profit or non-profit?';
							$default_fields['size']='Size';
							$default_fields['cost']='Cost';
							$default_fields['average_stay']=' Average length of stay';
							$default_fields['ownership']='Ownership';
							$default_fields['accreditedBy']='Accredited by';	
							$default_fields['certifications']='Certifications';		
					}
					if(sizeof($default_fields )){			
						foreach( $default_fields as $field_key => $field_value ) { 
							if(isset($form_data[$field_key])){
								update_post_meta($newpost_id, $field_key, $form_data[$field_key] );
							}
						}					
					}
					$opening_day=array();
					if(isset($form_data['day_name'] )){
						$day_name= $form_data['day_name'] ;
						$day_value1 = $form_data['day_value1'] ;
						$day_value2 = $form_data['day_value2'] ;
						$i=0;
						foreach($day_name  as $one_meta){
							if(isset($day_name[$i]) and isset($day_value1[$i]) ){
								if($day_name[$i] !=''){
									$opening_day[$day_name[$i]]=$day_value1[$i].'|'.$day_value2[$i];
								}
							}							
						$i++;	
						}
						update_post_meta($newpost_id, '_opening_time', $opening_day); 	
					}
					
					// Our Doctors
					if(isset($form_data['physician_list'] )){
						$doctors=$form_data['physician_list'];															
						update_post_meta($newpost_id, 'physician_list', $doctors);  	
					}	
					
					
					
					// For Specialtie Save 
					$specialtie_all='';
					if(isset($form_data['specialtie_arr'] )){
						$specialtie_name= $form_data['specialtie_arr'] ;							
						$i=0;$specialtie_all='';
						foreach($specialtie_name  as $one_specialtie){							
							$specialtie_all= $specialtie_all.",".$one_specialtie;
						}
						update_post_meta($newpost_id, 'specialtie', $specialtie_all);  	
							
					}
					
					// For Awards Save 
				
					if(isset($form_data['award_title'] )){
						$award_title= $form_data['award_title'];
						$award_description= $form_data['award_description'];	
						$award_year= $form_data['award_year'];	
						$award_image_id= (isset($form_data['award_image_id']) ? $form_data['award_image_id']:'');							
													
						$i=0;
						//foreach($award_title  as $one_award_title){							
						for($i=0;$i<20;$i++){	
							if(isset($award_title[$i])){
								update_post_meta($newpost_id, '_award_title_'.$i, $award_title[$i]); 
							}
							if(isset($award_description[$i])){
								update_post_meta($newpost_id, '_award_description_'.$i, $award_description[$i]); 
							}
							if(isset($award_year[$i])){
								update_post_meta($newpost_id, '_award_year_'.$i, $award_year[$i]); 
							}
							if(isset($award_image_id[$i])){
								update_post_meta($newpost_id, '_award_image_id_'.$i, $award_image_id[$i]); 
							}
														
							//$i++;
						}						 	
							
					}
					
					//wp_set_post_tags( 42, 'meaning,life', true );
					
					
					update_post_meta($newpost_id, 'address', $form_data['address']); 
					update_post_meta($newpost_id, 'latitude', $form_data['latitude']); 
					update_post_meta($newpost_id, 'longitude', $form_data['longitude']);					
					update_post_meta($newpost_id, 'city', $form_data['city']); 
					update_post_meta($newpost_id, 'postcode', $form_data['postcode']); 
					update_post_meta($newpost_id, 'country', $form_data['country']); 
					
					// Get latlng from address* START********
					$dir_lat=$form_data['latitude'];
					$dir_lng=$form_data['longitude'];
					$address = $form_data['address'];
					if($address!=''){
							if($dir_lat=='' || $dir_lng==''){
								$latitude='';$longitude='';
								
								$prepAddr = str_replace(' ','+',$address);
								$geocode=wp_remote_fopen('http://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
								$output= json_decode($geocode);
								if(isset( $output->results[0]->geometry->location->lat)){
									$latitude = $output->results[0]->geometry->location->lat;
								}
								if(isset($output->results[0]->geometry->location->lng)){
									$longitude = $output->results[0]->geometry->location->lng;
								}
								if($latitude!=''){
									update_post_meta($newpost_id,'latitude',$latitude);
								}
								if($longitude!=''){
									update_post_meta($newpost_id,'longitude',$longitude);
								}
							}
					}	
					// Get latlng from address* END********	
					
					update_post_meta($newpost_id, 'logo_image_id', $form_data['logo_image_id']); 
					update_post_meta($newpost_id, 'image_gallery_ids', $form_data['gallery_image_ids']); 
					update_post_meta($newpost_id, 'phone', $form_data['phone']); 
					update_post_meta($newpost_id, 'fax', $form_data['fax']); 
					update_post_meta($newpost_id, 'contact-email', $form_data['contact-email']); 
					update_post_meta($newpost_id, 'contact_web', $form_data['contact_web']); 
					
					if(isset($form_data['vimeo'] )){
						update_post_meta($newpost_id, 'vimeo', $form_data['vimeo']); 
						update_post_meta($newpost_id, 'youtube', $form_data['youtube']); 
					}
					update_post_meta($newpost_id, 'facebook', $form_data['facebook']); 
					update_post_meta($newpost_id, 'linkedin', $form_data['linkedin']); 
					update_post_meta($newpost_id, 'twitter', $form_data['twitter']); 
					update_post_meta($newpost_id, 'gplus', $form_data['gplus']);
					if(isset($form_data['event-title'])){
						update_post_meta($newpost_id, '_event_image_id', $form_data['event_image_id']);
						update_post_meta($newpost_id, 'event_title', $form_data['event-title']);
						update_post_meta($newpost_id, 'event_detail', $form_data['event-detail']);
					}
										
					
					echo json_encode(array("code" => "success","msg"=>"Updated Successfully"));
					exit(0);
				
				}
			
			public function uou_tigerp_save_wp_post(){
					global $current_user; global $wpdb;	
					parse_str($_POST['form_data'], $form_data);				
					$my_post = array();
					//$my_post['ID'] = $form_data['user_post_id'];
					$my_post['post_title'] = $form_data['title'];
					$my_post['post_content'] = $form_data['new_post_content'];
					
					if($form_data['post_status']=='publish'){
							$dir_approve_publish =get_option('_dir_approve_publish');
							if($dir_approve_publish!='yes'){
								$form_data['post_status']='publish';
							}
						
					}
					
					$my_post['post_status'] = $form_data['post_status'];					
					$newpost_id= wp_insert_post( $my_post );						
					//get_option( '_uou_tigerp_profile_post');
					$directory_url_1=get_option('_iv_directory_url_1');					
					if($directory_url_1==""){$directory_url_1='post';}
					$post_type = $directory_url_1;
					if($post_type!=''){
							$query = "UPDATE {$wpdb->prefix}posts SET post_type='" . $post_type . "' WHERE id='" . $newpost_id . "' LIMIT 1";
							$wpdb->query($query);										
					}						
					if(isset($form_data['feature_image_id'] )){
							$attach_id =$form_data['feature_image_id'];
							set_post_thumbnail( $newpost_id, $attach_id );					
					}
					
					// WPML Start******
					if ( function_exists('icl_object_id') ) {
					include_once( WP_PLUGIN_DIR . '/sitepress-multilingual-cms/inc/wpml-api.php' );
					$_POST['icl_post_language'] = $language_code = ICL_LANGUAGE_CODE;
					$query = "UPDATE {$wpdb->prefix}icl_translations SET element_type='post_".$post_type."' WHERE element_id='" . $newpost_id . "' LIMIT 1";
					$wpdb->query($query);					
					//wpml_update_translatable_content( 'post_directories', $newpost_id , $language_code );	
					}
					// End WPML**********
						
					if(isset($form_data['feature_image_id'] )){
							$attach_id =$form_data['feature_image_id'];
							set_post_thumbnail( $newpost_id, $attach_id );
					
					}
						
					if(isset($form_data['postcats'] )){ 
						$category_ids = array($form_data['postcats']);
						 wp_set_post_categories($newpost_id, $category_ids );
					}
					if(isset($form_data['custom_name'] )){
						$custom_metas= $form_data['custom_name'] ;
						$custom_value = $form_data['custom_value'] ;
						$i=0;
						foreach($custom_metas  as $one_meta){
							if(isset($custom_metas[$i]) and isset($custom_value[$i]) ){
								if($custom_metas[$i] !=''){
									update_post_meta($newpost_id, $custom_metas[$i], $custom_value[$i]); 
								}
							}
							
						$i++;	
						}
					
					}	
					//update_user_meta($current_user->ID,'first_name', $form_data['first_name']); 
					
					echo json_encode(array("code" => "success","msg"=>"Updated Successfully"));
					exit(0);
				
				}
			
				public function uou_tigerp_cancel_paypal(){
						global $wpdb;
						global $current_user;
						parse_str($_POST['form_data'], $form_data);
						
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
						
						$oldProfile = get_user_meta($current_user->ID,'iv_paypal_recurring_profile_id',true);
						if (!empty($oldProfile)) {
							$cancelParams = array(
								'PROFILEID' => $oldProfile,
								'ACTION' => 'Cancel'
							);
							$paypal -> request('ManageRecurringPaymentsProfileStatus',$cancelParams);
							
							update_user_meta($current_user->ID,'iv_paypal_recurring_profile_id','');
							update_user_meta($current_user->ID,'iv_cancel_reason', $form_data['cancel_text']); 
							update_user_meta($current_user->ID,'uou_tigerp_payment_status', 'cancel'); 
							
							echo json_encode(array("code" => "success","msg"=>"Cancel Successfully"));
							exit(0);							
						}else{
						
							echo json_encode(array("code" => "not","msg"=>"Unable to Cancel "));
							exit(0);	
						}
						
				
				}
				public function iv_hospital_ajax_single(){					
					//include( get_template_directory(). '/ajax-single-hospital.php');
					include( wp_uou_tigerp_template. '/hospital/ajax-single-hospital.php');
					
					exit(0);
				}
				public function iv_doctor_ajax_single(){					
					//include( get_template_directory(). '/ajax-single-doctor.php');
					include( wp_uou_tigerp_template. '/doctor/ajax-single-doctor.php');
					exit(0);
				}
				
				public function  uou_tigerp_profile_stripe_upgrade(){
						include(wp_uou_tigerp_DIR . '/admin/files/lib/Stripe.php');
						global $wpdb;
						global $current_user;
						parse_str($_POST['form_data'], $form_data);	
						
						$newpost_id='';
						$post_name='uou_tigerp_stripe_setting';
						$row = $wpdb->get_row("SELECT * FROM $wpdb->posts WHERE post_name = '".$post_name."' ");
									if(sizeof($row )>0){
									  $newpost_id= $row->ID;
									}
						$stripe_mode=get_post_meta( $newpost_id,'uou_tigerp_stripe_mode',true);	
						if($stripe_mode=='test'){
							$stripe_api =get_post_meta($newpost_id, 'uou_tigerp_stripe_secret_test',true);	
						}else{
							$stripe_api =get_post_meta($newpost_id, 'uou_tigerp_stripe_live_secret_key',true);	
						}
						
						Stripe::setApiKey($stripe_api);						
						// For  cancel ----
						$arb_status =	get_user_meta($current_user->ID, 'uou_tigerp_payment_status', true);
						$cust_id = get_user_meta($current_user->ID,'uou_tigerp_stripe_cust_id',true);
						$sub_id = get_user_meta($current_user->ID,'uou_tigerp_stripe_subscrip_id',true);
						if($sub_id!=''){	
							try{
									$iv_cancel_stripe = Stripe_Customer::retrieve($form_data['cust_id']);
									$iv_cancel_stripe->subscriptions->retrieve($form_data['sub_id'])->cancel();
									
							} catch (Exception $e) {
								//print_r($e);	
								
								//$error_msg=$e;
							}
							update_user_meta($current_user->ID,'uou_tigerp_payment_status', 'cancel'); 
							update_user_meta($current_user->ID,'uou_tigerp_stripe_subscrip_id','');
						}
						
						// Start  New 
						$response='';
						parse_str($_POST['form_data'], $form_data);
						include(wp_uou_tigerp_DIR . '/admin/pages/payment-inc/stripe-upgrade.php');
						
						echo json_encode(array("code" => "success","msg"=>$response));
						exit(0);

				}
				public function  uou_tigerp_profile_stripe_add_balance(){
						include(wp_uou_tigerp_DIR . '/admin/files/lib/Stripe.php');
						global $wpdb;
						global $current_user;
						parse_str($_POST['form_data'], $form_data);	
						
						$newpost_id='';
						$post_name='uou_tigerp_stripe_setting';
						$row = $wpdb->get_row("SELECT * FROM $wpdb->posts WHERE post_name = '".$post_name."' ");
									if(sizeof($row )>0){
									  $newpost_id= $row->ID;
									}
						$stripe_mode=get_post_meta( $newpost_id,'uou_tigerp_stripe_mode',true);	
						if($stripe_mode=='test'){
							$stripe_api =get_post_meta($newpost_id, 'uou_tigerp_stripe_secret_test',true);	
						}else{
							$stripe_api =get_post_meta($newpost_id, 'uou_tigerp_stripe_live_secret_key',true);	
						}
																		
						// Start  New 
						$response='';
						parse_str($_POST['form_data'], $form_data);
						include(wp_uou_tigerp_DIR . '/admin/pages/payment-inc/stripe-add-balance.php');
						
						echo json_encode(array("code" => "success","msg"=>$response));
						exit(0);

				}
				public function uou_tigerp_cancel_stripe(){
						
						include(wp_uou_tigerp_DIR . '/admin/files/lib/Stripe.php');
						global $wpdb;
						global $current_user;
						parse_str($_POST['form_data'], $form_data);	
						
						$newpost_id='';
						$post_name='uou_tigerp_stripe_setting';
						$row = $wpdb->get_row("SELECT * FROM $wpdb->posts WHERE post_name = '".$post_name."' ");
									if(sizeof($row )>0){
									  $newpost_id= $row->ID;
									}
						$stripe_mode=get_post_meta( $newpost_id,'uou_tigerp_stripe_mode',true);	
						if($stripe_mode=='test'){
							$stripe_api =get_post_meta($newpost_id, 'uou_tigerp_stripe_secret_test',true);	
						}else{
							$stripe_api =get_post_meta($newpost_id, 'uou_tigerp_stripe_live_secret_key',true);	
						}
						parse_str($_POST['form_data'], $form_data);
						
						
						Stripe::setApiKey($stripe_api);
						
						
						try{
								$iv_cancel_stripe = Stripe_Customer::retrieve($form_data['cust_id']);
								$iv_cancel_stripe->subscriptions->retrieve($form_data['sub_id'])->cancel();
						
						} catch (Exception $e) {
							//print_r($e);	
						}
						
						
						update_user_meta($current_user->ID,'iv_cancel_reason', $form_data['cancel_text']); 
						update_user_meta($current_user->ID,'uou_tigerp_payment_status', 'cancel'); 
						update_user_meta($current_user->ID,'uou_tigerp_stripe_subscrip_id','');
						
						echo json_encode(array("code" => "success","msg"=>"Cancel Successfully"));
						exit(0);
				
				}
				public function  uou_tigerp_stripe_form_func(){
					//echo wp_uou_tigerp_URLPATH.'files/short_code_file/iv_stripe_form_display';
					include(wp_uou_tigerp_ABSPATH.'files/short_code_file/iv_stripe_form_display.php');
				}
				
				public function uou_tigerp_update_setting_hide(){
					global $current_user;
					parse_str($_POST['form_data'], $form_data);	
					$mobile_hide=(isset($form_data['mobile_hide'])? $form_data['mobile_hide']:'');	
					$email_hide=(isset($form_data['email_hide'])? $form_data['email_hide']:'');	
					$phone_hide=(isset($form_data['phone_hide'])? $form_data['phone_hide']:'');	
					
					update_user_meta($current_user->ID,'hide_email', $email_hide); 
					update_user_meta($current_user->ID,'hide_phone', $phone_hide);					
					update_user_meta($current_user->ID,'hide_mobile',$mobile_hide); 
					
					 
					
					echo json_encode(array("code" => "success","msg"=>"Updated Successfully"));
					exit(0);
				}
				
				public function uou_tigerp_update_setting_fb(){
					global $current_user;
					parse_str($_POST['form_data'], $form_data);			
					update_user_meta($current_user->ID,'twitter', $form_data['twitter']); 
					update_user_meta($current_user->ID,'facebook', $form_data['facebook']); 
					update_user_meta($current_user->ID,'gplus', $form_data['gplus']); 
					update_user_meta($current_user->ID,'linkedin', $form_data['linkedin']); 
					 
					
					echo json_encode(array("code" => "success","msg"=>"Updated Successfully"));
					exit(0);
				}
				public function uou_tigerp_update_setting_password(){
					global $current_user;
					parse_str($_POST['form_data'], $form_data);						
					if ( wp_check_password( $form_data['c_pass'], $current_user->user_pass, $current_user->ID) ){
					  
							if($form_data['r_pass']!=$form_data['n_pass']){
								echo json_encode(array("code" => "not", "msg"=>"New Password & Re Password are not same. "));
								exit(0);
							}else{
								wp_set_password( $form_data['n_pass'], $current_user->ID);
								echo json_encode(array("code" => "success","msg"=>"Updated Successfully"));
								exit(0);
							}
					}else{
						
					   echo json_encode(array("code" => "not", "msg"=>"Current password is wrong. "));
						exit(0);
					}
					
					
					
				}
				
				public function uou_tigerp_update_profile_setting(){
					global $current_user;
					parse_str($_POST['form_data'], $form_data);			
					
					
				   update_user_meta($current_user->ID,'profile_name', $form_data['title']);
				   update_user_meta($current_user->ID,'about_us', $form_data['about_us']);
				   update_user_meta($current_user->ID, 'image_gallery_ids', $form_data['gallery_image_ids']); 
				  if(isset($form_data['company_type'])){
				   update_user_meta($current_user->ID,'company_type', $form_data['company_type']);
				  }
				   if(isset($form_data['designation'])){
				   update_user_meta($current_user->ID,'designation', $form_data['designation']);
				  }
					
					
					update_user_meta($current_user->ID,'twitter', $form_data['twitter']); 
					update_user_meta($current_user->ID,'facebook', $form_data['facebook']); 
					update_user_meta($current_user->ID,'gplus', $form_data['gplus']); 
					update_user_meta($current_user->ID,'linkedin', $form_data['linkedin']); 
					update_user_meta($current_user->ID,'instagram', $form_data['instagram']); 
					update_user_meta($current_user->ID,'pinterest', $form_data['pinterest']); 
				   
				   
					update_user_meta($current_user->ID, 'address', $form_data['address']); 
					update_user_meta($current_user->ID, 'latitude', $form_data['latitude']); 
					update_user_meta($current_user->ID, 'longitude', $form_data['longitude']);					
					update_user_meta($current_user->ID, 'city', $form_data['city']); 
					update_user_meta($current_user->ID, 'postcode', $form_data['postcode']); 
					update_user_meta($current_user->ID, 'country', $form_data['country']); 
					
					
					if(isset($form_data['top_banner_image_id'])){
						if($form_data['top_banner_image_id']!=''){
						update_user_meta($current_user->ID, 'top_banner_image_id', $form_data['top_banner_image_id']); 
						}
					}
				  
				   $default_fields = array();
				   $user_type= get_user_meta($current_user->ID,'iv_member_type',true);
					
					if($user_type=='corporate'){
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
					}else{
						$field_set=get_option('iv_social_profile_personal_fields' );
						if($field_set!=""){ 
								$default_fields=get_option('iv_social_profile_personal_fields' );
						}else{									
							$default_fields['Age']=esc_html__('Age','tiger');
							$default_fields['Location']=esc_html__('Location','tiger');
							$default_fields['Experiance']=esc_html__('Experiance','tiger');
							$default_fields['Dgree']=esc_html__('Dgree','tiger');
							$default_fields['Career-Lavel']=esc_html__('Career Lavel','tiger');
							$default_fields['Phone']=esc_html__('Phone','tiger');								
							$default_fields['Fax']=esc_html__('Fax','tiger');	
							$default_fields['E-mail']=esc_html__('E-mail','tiger');
							$default_fields['web_site']=esc_html__('Website Url','tiger');
							
						}
					}
								
					
					
					
					if(sizeof($default_fields )){			
						foreach( $default_fields as $field_key => $field_value ) { 
							if(isset($form_data[$field_key])){
								update_user_meta($current_user->ID, $field_key, $form_data[$field_key] );
							}
						}					
					}
				     
				   // For service Save 
					// Delete 1st
					$i=0;
						for($i=0;$i<20;$i++){
								delete_user_meta($current_user->ID, '_service_title_'.$i); 							
								delete_user_meta($current_user->ID, '_service_description_'.$i);
								delete_user_meta($current_user->ID, '_service_image_id_'.$i); 						
						}		
					// Delete End
					
					if(isset($form_data['service_title'] )){
						 $service_title= $form_data['service_title'];
						 $service_description= $form_data['service_description'];	
						 $service_value= (isset($form_data['service_value']) ? $form_data['service_value']:'');	
						 $service_image_id= (isset($form_data['service_image_id']) ? $form_data['service_image_id']:'');							
																		
						$i=0;
						//foreach($award_title  as $one_award_title){							
						for($i=0;$i<20;$i++){	
							if(isset($service_title[$i]) AND $service_title[$i]!=''){
								
								if(isset($service_title[$i])){
									update_user_meta($current_user->ID, '_service_title_'.$i, $service_title[$i]); 
								}
								if(isset($service_description[$i])){
									update_user_meta($current_user->ID, '_service_description_'.$i, $service_description[$i]); 
								}													
												
								if(isset($service_image_id[$i])){
									update_user_meta($current_user->ID, '_service_image_id_'.$i, $service_image_id[$i]); 
								}
								if(isset($service_value[$i])){
									update_user_meta($current_user->ID, '_service_value_'.$i, $service_value[$i]); 
								}
							}
														
							//$i++;
						}						 	
							
					} 
					
					echo json_encode(array("code" => "success","msg"=>"Updated Successfully"));
					exit(0);
				
				}
				public function modify_contact_methods($profile_fields) {

					// Add new fields
					$profile_fields['phone'] = 'Phone Number';
					$profile_fields['twitter'] = 'Twitter Username';
					$profile_fields['facebook'] = 'Facebook URL';
					$profile_fields['gplus'] = 'Google+ URL';
					$profile_fields['linkedin'] = 'Linkedin';
					

					return $profile_fields;
				}

				public function iv_restrict_media_library( $wp_query ) {
					global $current_user, $pagenow;
					
						//global $current_user;
						if( is_admin() && !current_user_can('edit_others_posts') ) {
							$wp_query->set( 'author', $current_user->ID );
							add_filter('views_edit-post', 'fix_post_counts');
							add_filter('views_upload', 'fix_media_counts');
						}
					
				}
				public function check_expiry_date($user) {
					
					include(wp_uou_tigerp_DIR . '/inc/check_expire_date.php');
				}
				
				public function uou_tigerp_update_profile_pic(){
					global $current_user;
					if(isset($_REQUEST['profile_pic_url_1'])){
						$iv_profile_pic_url=$_REQUEST['profile_pic_url_1'];
						$attachment_thum=$_REQUEST['attachment_thum'];
					}else{
						$iv_profile_pic_url='';
						$attachment_thum='';
					
					}
					
					update_user_meta($current_user->ID, 'iv_profile_pic_thum', $attachment_thum);					
					update_user_meta($current_user->ID, 'iv_profile_pic_url', $iv_profile_pic_url);
					update_user_meta($current_user->ID, 'iv_profile_pic_id', $_REQUEST['profile_pic_url_id']);
					echo json_encode('success');
					exit(0);
				}
				
				public function uou_tigerp_paypal_form_submit(  ) {
					include(wp_uou_tigerp_DIR . '/admin/pages/payment-inc/paypal-submit.php');
				}	
				public function uou_tigerp_stripe_form_submit(  ) {
					include(wp_uou_tigerp_DIR . '/admin/pages/payment-inc/stripe-submit.php');
				}
				
				public function plugin_mce_css_uou_tigerp( $mce_css ) {
					if ( ! empty( $mce_css ) )
						$mce_css .= ',';

					$mce_css .= plugins_url( 'admin/files/css/iv-bootstrap.css', __FILE__ );

					return $mce_css;
				}
												
				/***********************************
				 * Adds a meta box to the post editing screen
				*/
				public function prfx_custom_meta_iv_hospital() {
					add_meta_box('prfx_meta', __('Claim Approve ', 'tiger'), array(&$this, 'iv_hospital_meta_callback'),'hospital','side');
				}
				public function prfx_custom_meta_iv_doctor() {
					add_meta_box('prfx_meta', __('Claim Approve ', 'tiger'), array(&$this, 'iv_doctor_meta_callback'),'doctor','side');
				}
				
				public function uou_tigerp_check_coupon(){
				
					global $wpdb;
					$coupon_code=$_REQUEST['coupon_code'];
					$package_id=$_REQUEST['package_id'];
					parse_str($_REQUEST['form_data'], $form_data);
					//$package_amount =$_REQUEST['package_amount'];
					$package_amount=get_post_meta($package_id, 'uou_tigerp_package_cost',true);
					$api_currency =$_REQUEST['api_currency'];
					// Tax Strat********************
						$tax_total=0;
						$tax_type= get_option('_iv_tax_type');
						$tax_active_module=get_option('_uou_tigerp_active_tax');
						
						if($tax_active_module=='' ){ $tax_active_module='yes';	}					
						if($tax_type==''){$tax_type='country';}
							
						if($tax_active_module=='yes' AND $tax_type=='country'){						
							$countries_tax_array= (get_option('_iv_countries_tax')!=''? get_option('_iv_countries_tax'): array()) ;
							$country_id= (isset($form_data['country_select'])?$form_data['country_select']:'0');
							if(array_key_exists($country_id , $countries_tax_array)){							
								 $country_tax_value= $countries_tax_array[$country_id];
								 $tax_total=$package_amount * $country_tax_value/100;
							}
						}
						if($tax_active_module=='yes' AND $tax_type=='common'){						
							$common_tax_value= get_option('_iv_comman_tax_value');						
							$tax_total=$package_amount * $common_tax_value/100;
							
						}
						$iv_gateway = get_option('uou_tigerp_payment_gateway');	
						$uou_tigerp_package_recurring= get_post_meta( $package_id,'uou_tigerp_package_recurring',true);
						if($uou_tigerp_package_recurring=='on' AND $iv_gateway=='stripe'){
							$tax_total=0;
						}
					// End TAx****************
						$post_cont = $wpdb->get_row("SELECT * FROM $wpdb->posts WHERE post_title = '" . $coupon_code . "' and  post_type='tiger_coupon'");	
						
						if(sizeof($post_cont)>0 && $package_amount>0){
							$coupon_name = $post_cont->post_title;
							 
							 $current_date=$today = date("m/d/Y");
							 
							 
							 $start_date=get_post_meta($post_cont->ID, 'tiger_coupon_start_date', true);
							 $end_date=get_post_meta($post_cont->ID, 'tiger_coupon_end_date', true);
							 $coupon_used=get_post_meta($post_cont->ID, 'tiger_coupon_used', true);
							 $coupon_limit=get_post_meta($post_cont->ID, 'tiger_coupon_limit', true);
							 $dis_amount=get_post_meta($post_cont->ID, 'tiger_coupon_amount', true);							 
							 $package_ids =get_post_meta($post_cont->ID, 'tiger_coupon_pac_id', true);
							 
							 $all_pac_arr= explode(",",$package_ids);
							 
							 $today_time = strtotime($current_date);
							 $start_time = strtotime($start_date);
							 $expire_time = strtotime($end_date);
							 
												
							 if(in_array('0', $all_pac_arr)){
								$pac_found=1;
								
							 }else{
								if(in_array($package_id, $all_pac_arr)){
									$pac_found=1;
								}else{
									$pac_found=0;
								}
								
							 }
							 $recurring = get_post_meta( $package_id,'uou_tigerp_package_recurring',true); 
							
							
							 if($today_time >= $start_time && $today_time<=$expire_time && $coupon_used<=$coupon_limit && $pac_found == '1' && $recurring!='on' ){
						
								$total = ($package_amount -$dis_amount)+ $tax_total;
								$coupon_type= get_post_meta($post_cont->ID, 'tiger_coupon_type', true);
								if($coupon_type=='percentage'){
										$dis_amount= $dis_amount * $package_amount/100;
										$total = ($package_amount -$dis_amount)+ $tax_total;
								}
								
								echo json_encode(array('code' => 'success',
														'dis_amount' => $dis_amount.' '.$api_currency,
														'gtotal' => $total.' '.$api_currency,
														'tax_total'	=>$api_currency .' '.$tax_total,
														'p_amount' => $package_amount.' '.$api_currency,
													));
								
								exit(0);
							}else{
								$dis_amount='';
								$total=$package_amount + $tax_total;
								echo json_encode(array('code' => 'not-success-2',
														'dis_amount' => '',
														'gtotal' => $total.' '.$api_currency,
														'tax_total'	=>$api_currency .' '.$tax_total,
														'p_amount' => $package_amount.' '.$api_currency,
														
													));
								exit(0);
							
							}
							
						
						}else{
								if($package_amount=="" or $package_amount=="0"){$package_amount='0';}
								$dis_amount='';
								$total=$package_amount + $tax_total;
								echo json_encode(array('code' => 'not-success-1',
														'dis_amount' => '',
														'gtotal' => $total.' '.$api_currency,
														'tax_total'	=>$api_currency .' '.$tax_total,
														'p_amount' => $package_amount.' '.$api_currency,
													));
								exit(0);
						
						}
						
					
					
				}
				public function uou_tigerp_check_package_amount(){
				
					global $wpdb;
					$coupon_code=isset($_REQUEST['coupon_code']);
					$package_id=$_REQUEST['package_id'];
					 $form_data= array();
					 if(isset($_REQUEST['form_data'])){
						parse_str($_REQUEST['form_data'], $form_data);
					}					
					if( get_post_meta( $package_id,'uou_tigerp_package_recurring',true) =='on'  ){
						$package_amount=get_post_meta($package_id, 'uou_tigerp_package_recurring_cost_initial', true);			
					}else{					
						$package_amount=get_post_meta($package_id, 'uou_tigerp_package_cost',true);
					}
					
					$api_currency =$_REQUEST['api_currency'];
					// Tax Strat********************
					$tax_total=0;
					$tax_type= get_option('_iv_tax_type');
					$tax_active_module=get_option('_uou_tigerp_active_tax');
					
					if($tax_active_module=='' ){ $tax_active_module='yes';	}					
					if($tax_type==''){$tax_type='country';}
						
					if($tax_active_module=='yes' AND $tax_type=='country'){						
						$countries_tax_array= (get_option('_iv_countries_tax')!=''? get_option('_iv_countries_tax'): array()) ;
						$country_id= (isset($form_data['country_select'])?$form_data['country_select']:'0');
						if(array_key_exists($country_id , $countries_tax_array)){							
							 $country_tax_value= $countries_tax_array[$country_id];
							 $tax_total=$package_amount * $country_tax_value/100;
						}
					}
					if($tax_active_module=='yes' AND $tax_type=='common'){						
						$common_tax_value= get_option('_iv_comman_tax_value');						
						$tax_total=$package_amount * $common_tax_value/100;
						
					}
						$iv_gateway = get_option('uou_tigerp_payment_gateway');	
						$uou_tigerp_package_recurring= get_post_meta( $package_id,'uou_tigerp_package_recurring',true);
						if($uou_tigerp_package_recurring=='on' AND $iv_gateway=='stripe'){
							$tax_total=0;
						}
						
					// End TAx****************
						$post_cont = $wpdb->get_row("SELECT * FROM $wpdb->posts WHERE post_title = '" . $coupon_code . "' and  post_type='tiger_coupon'");	
						
						if(sizeof($post_cont)>0){
							$coupon_name = $post_cont->post_title;
							 
							 $current_date=$today = date("m/d/Y");
							 
							 
							 $start_date=get_post_meta($post_cont->ID, 'tiger_coupon_start_date', true);
							 $end_date=get_post_meta($post_cont->ID, 'tiger_coupon_end_date', true);
							 $coupon_used=get_post_meta($post_cont->ID, 'tiger_coupon_used', true);
							 $coupon_limit=get_post_meta($post_cont->ID, 'tiger_coupon_limit', true);
							 $dis_amount=get_post_meta($post_cont->ID, 'tiger_coupon_amount', true);							 
							 $package_ids =get_post_meta($post_cont->ID, 'tiger_coupon_pac_id', true);
							 
							 $all_pac_arr= explode(",",$package_ids);
							 
							 $today_time = strtotime($current_date);
							 $start_time = strtotime($start_date);
							 $expire_time = strtotime($end_date);
							 
							 $pac_found= in_array($package_id, $all_pac_arr);							
							 
							 if($today_time >= $start_time && $today_time<=$expire_time && $coupon_used<=$coupon_limit && $pac_found=="1"){
							// if( $today_time<=$expire_time && $coupon_used<=$coupon_limit){	
								$total = ($package_amount -$dis_amount)+ $tax_total;
								echo json_encode(array('code' => 'success',
														'dis_amount' => $api_currency.' '.$dis_amount,
														'gtotal' => $api_currency.' '.$total,
														'tax_total'	=>$api_currency.' '.$tax_total,
														'p_amount' => $api_currency.' '.$package_amount,
													));
								
								exit(0);
							}else{
								$dis_amount='--';
								$total=$package_amount + $tax_total;
								echo json_encode(array('code' => 'not-success',
														'dis_amount' => $api_currency.' '.$dis_amount,
														'gtotal' => $api_currency.' '.$total,
														'tax_total'	=>$api_currency .' '.$tax_total,
														'p_amount' => $api_currency.' '.$package_amount,
													));
								exit(0);
							
							}
							
						
						}else{
								
								$dis_amount='--';
								$total=$package_amount + $tax_total;
								echo json_encode(array('code' => 'not-success',
														'dis_amount' => $api_currency.' '.$dis_amount,
														'gtotal' => $api_currency.' '.$total,
														'tax_total'	=>$api_currency .' '.$tax_total,
														'p_amount' => $api_currency.' '.$package_amount,
													));
								exit(0);
						
						}
						
					
					
				}
				
				public function uou_tigerp_check_package_type(){
					global $wpdb;
					$coupon_code=isset($_REQUEST['coupon_code']);
					$package_id=0;
					 $form_data= array();
					 if(isset($_REQUEST['form_data'])){
						parse_str($_REQUEST['form_data'], $form_data);
					}					
					if( get_post_meta( $package_id,'uou_tigerp_package_recurring',true) =='on'  ){
						$package_amount=get_post_meta($package_id, 'uou_tigerp_package_recurring_cost_initial', true);			
					}else{					
						$package_amount=get_post_meta($package_id, 'uou_tigerp_package_cost',true);
					}
					
					//package_div_result***************
						$package_div_result=__('None','tiger');
						$package_type = $form_data['iv_member_type']; 						
						
						// WP_Query arguments
							$args_package = array (
								'post_type'              => array( 'uou_tigerp_pack' ),
								'post_status'            => array( 'draft' ),
								'meta_query'             => array(
									array(
										'key'       => 'uou_tigerp_user_type',
										'value'     => $package_type,
										'compare'   => '=',
									),
								),
							);

							// The Query
							$query_package = new WP_Query( $args_package );
							
							$i=0;
							if ( $query_package->have_posts() ) {
								$package_div_result='<select name="package_sel" id ="package_sel" class=" form-control" onchange="select_change_ajax(this.value);">';
								while ( $query_package->have_posts() ) {
									$query_package->the_post();
									$package_div_result=$package_div_result. '<option value="'. $query_package->post->ID.'" >'. $query_package->post->post_title.'</option>';
									if($i==0){$package_id=$query_package->post->ID;}
									
								 $i++;
								}
								$package_div_result=$package_div_result. '</select>';
								$recurring= get_post_meta($package_id, 'uou_tigerp_package_recurring', true);	
								if($recurring == 'on'){
									$package_amount=get_post_meta($package_id, 'uou_tigerp_package_recurring_cost_initial', true);
								}else{
									$package_amount=get_post_meta($package_id, 'uou_tigerp_package_cost',true);
								}	
								
							}						
						
						
					// End package_div_result *********
					
					$api_currency =$_REQUEST['api_currency'];
					// Tax Strat********************
					$tax_total=0;
					$tax_type= get_option('_iv_tax_type');
					$tax_active_module=get_option('_uou_tigerp_active_tax');
					
					if($tax_active_module=='' ){ $tax_active_module='yes';	}					
					if($tax_type==''){$tax_type='country';}
						
					if($tax_active_module=='yes' AND $tax_type=='country'){						
						$countries_tax_array= (get_option('_iv_countries_tax')!=''? get_option('_iv_countries_tax'): array()) ;
						$country_id= (isset($form_data['country_select'])?$form_data['country_select']:'0');
						if(array_key_exists($country_id , $countries_tax_array)){							
							 $country_tax_value= $countries_tax_array[$country_id];
							 $tax_total=$package_amount * $country_tax_value/100;
						}
					}
					if($tax_active_module=='yes' AND $tax_type=='common'){						
						$common_tax_value= get_option('_iv_comman_tax_value');						
						$tax_total=$package_amount * $common_tax_value/100;
						
					}
						$iv_gateway = get_option('uou_tigerp_payment_gateway');	
						$uou_tigerp_package_recurring= get_post_meta( $package_id,'uou_tigerp_package_recurring',true);
						if($uou_tigerp_package_recurring=='on' AND $iv_gateway=='stripe'){
							$tax_total=0;
						}
						
					// End Tax****************
						$post_cont = $wpdb->get_row("SELECT * FROM $wpdb->posts WHERE post_title = '" . $coupon_code . "' and  post_type='tiger_coupon'");	
						
						if(sizeof($post_cont)>0){
							$coupon_name = $post_cont->post_title;
							 
							 $current_date=$today = date("m/d/Y");
							 
							 
							 $start_date=get_post_meta($post_cont->ID, 'tiger_coupon_start_date', true);
							 $end_date=get_post_meta($post_cont->ID, 'tiger_coupon_end_date', true);
							 $coupon_used=get_post_meta($post_cont->ID, 'tiger_coupon_used', true);
							 $coupon_limit=get_post_meta($post_cont->ID, 'tiger_coupon_limit', true);
							 $dis_amount=get_post_meta($post_cont->ID, 'tiger_coupon_amount', true);							 
							 $package_ids =get_post_meta($post_cont->ID, 'tiger_coupon_pac_id', true);
							 
							 $all_pac_arr= explode(",",$package_ids);
							 
							 $today_time = strtotime($current_date);
							 $start_time = strtotime($start_date);
							 $expire_time = strtotime($end_date);
							 
							 $pac_found= in_array($package_id, $all_pac_arr);							
							 
							 if($today_time >= $start_time && $today_time<=$expire_time && $coupon_used<=$coupon_limit && $pac_found=="1"){
							// if( $today_time<=$expire_time && $coupon_used<=$coupon_limit){	
								$total = ($package_amount -$dis_amount)+ $tax_total;
								echo json_encode(array('code' => 'success',
														'dis_amount' => $api_currency.' '.$dis_amount,
														'gtotal' => $api_currency.' '.$total,
														'tax_total'	=>$api_currency.' '.$tax_total,
														'p_amount' => $api_currency.' '.$package_amount,
														'package_div_result'=> $package_div_result,
														'package_id'=>$package_id,
													));
								
								exit(0);
							}else{
								$dis_amount='--';
								$total=$package_amount + $tax_total;
								echo json_encode(array('code' => 'not-success',
														'dis_amount' => $api_currency.' '.$dis_amount,
														'gtotal' => $api_currency.' '.$total,
														'tax_total'	=>$api_currency .' '.$tax_total,
														'p_amount' => $api_currency.' '.$package_amount,
														'package_div_result'=> $package_div_result,
														'package_id'=>$package_id,
														
													));
								exit(0);
							
							}							
						
						}else{								
								$dis_amount='--';
								$total=$package_amount + $tax_total;
								echo json_encode(array('code' => 'not-success',
														'dis_amount' => $api_currency.' '.$dis_amount,
														'gtotal' => $api_currency.' '.$total,
														'tax_total'	=>$api_currency .' '.$tax_total,
														'p_amount' => $api_currency.' '.$package_amount,
														'package_div_result'=> $package_div_result,
														'package_id'=>$package_id,
													));
								exit(0);						
						}
				
				}
				/**
				 * Outputs the content of the meta box
				 */
				public function iv_hospital_meta_callback($post) {
					wp_nonce_field(basename(__FILE__), 'prfx_nonce');
					include ('admin/pages/metabox.php');
				}
				public function iv_doctor_meta_callback($post) {
					wp_nonce_field(basename(__FILE__), 'prfx_nonce');
					include ('admin/pages/metabox.php');
				}
				public function iv_hospital_meta_save($post_id) {
					
					global $wpdb;
					$is_autosave = wp_is_post_autosave($post_id);					
						
					if (isset($_REQUEST['iv_hospital_approve'])) {
						if($_REQUEST['iv_hospital_approve']=='yes'){ 
								update_post_meta($post_id, 'iv_hospital_approve', $_REQUEST['iv_hospital_approve']);
							// Set new user for post
							$sql="UPDATE  $wpdb->posts SET post_author=".$_REQUEST['uou_tigerp_author_id']."  WHERE ID=".$post_id;		
							$wpdb->query($sql); 	
						}
					} 
				}
				public function iv_doctor_meta_save($post_id) {
					
					global $wpdb;
					$is_autosave = wp_is_post_autosave($post_id);
					
					if (isset($_REQUEST['iv_doctor_approve'])) {
						if($_REQUEST['iv_doctor_approve']=='yes'){ 
								update_post_meta($post_id, 'iv_doctor_approve', $_REQUEST['iv_doctor_approve']);
							// Set new user for post
							$sql="UPDATE  $wpdb->posts SET post_author=".$_REQUEST['uou_tigerp_author_id']."  WHERE ID=".$post_id;		
							$wpdb->query($sql); 	
						}
					} 
				}
				public function iv_content_protected_pages($content) {					
					$current_user = wp_get_current_user();
					global $post ;	
					ob_start();	
					
					$active_module=get_option('_uou_tigerp_active_visibility_page'); 					
					if(!isset($post->post_type)){
							return $content;
					}	
					
					
					
					if($active_module=='yes' AND $post->post_type=='page'){					
						if(isset($current_user->ID) AND $current_user->ID!=''){
							$user_role= $current_user->roles[0];
							if(isset($current_user->roles[0]) and $current_user->roles[0]=='administrator'){
								return $content;
							}
							$message=get_option('_iv_visibility_login_message');							
						}else{							
							$user_role= 'visitor';
							
							$message=get_option('_iv_visibility_visitor_message');
								
						}	
						$store_array=get_option('_iv_visibility_serialize_page_role');
						//echo'<pre>';
						//print_r($store_array);

						 if(isset($store_array[$user_role]))
						{	
							if(in_array($post->post_name, $store_array[$user_role])){
								return $content;
							}else{
								$content = ob_get_clean();
								$content =  $message; 
								return $content;
							}
							
						}else{ 
								$content = ob_get_clean();
								$content =  $message; 
								return $content;
						
						}
						
						
					}
					return $content;
				}
				public function no_comments_on_page( $file )
				{
					
					$current_user = wp_get_current_user(); $user_role= '';	
					global $post ;	
							//echo'<pre>'; print_r($post); echo'</pre>';
					$active_module=get_option('_uou_tigerp_active_visibility_page'); 					
					
					if($active_module=='yes'){	
							if(isset($current_user->ID) AND $current_user->ID!=''){
								$user_role= $current_user->roles[0];
								if(isset($current_user->roles[0]) and $current_user->roles[0]=='administrator'){
									return $file;
								}														
							}else{							
								 $user_role= 'visitor';					
								
							}					
						$have_access=0;
						$store_array=get_option('_iv_visibility_serialize_role');	
						//echo'<pre>'; print_r($store_array); echo'</pre>'.$user_role;
						if(isset($store_array[$user_role]))	{	
							$post_category='';
							if(get_the_category($post->ID)){ 
								 $post_category = get_the_category($post->ID);  // the value is recieved properly
								if(isset($post_category[0]->category_nicename)){
									$post_category=$post_category[0]->category_nicename;
								}
								
							}
							if(in_array($post_category, $store_array[$user_role])){
								$have_access=1; 
							}else{
								 $have_access=0;
							}							
						}
						$have_access_page=0;
						$store_array_page=get_option('_iv_visibility_serialize_page_role');	
						 if(isset($store_array_page[$user_role])){	
							if(in_array($post->post_name, $store_array_page[$user_role])){
								$have_access_page=1;							
							}else{
								$have_access_page=0;
								
							}							
						}
						if($have_access == 0 AND $have_access_page == 0){
							
							 $file =wp_uou_tigerp_DIR . '/admin/pages/empty-comment-file.php';
						}
						
					}
					
					
					
					return $file;
				}

				public function uou_tigerp_content_protected($content) { 
					
					$current_user = wp_get_current_user();
					global $post ;
					
					$active_module=get_option('_uou_tigerp_active_visibility'); 
					ob_start();	
					

					if($active_module=='yes' AND $post->post_type=='post'){	
										
						if(isset($current_user->ID) AND $current_user->ID!=''){
							$user_role= $current_user->roles[0];
							if(isset($current_user->roles[0]) and $current_user->roles[0]=='administrator'){
								
								return $content;
							}
							$message=get_option('_iv_visibility_login_message');
							$iv_redirect = get_option( '_uou_tigerp_profile_page');							
							$reg_page= '<a href="'.get_permalink( $iv_redirect).'?&profile=level "> Here </a';
							$message= str_replace('[here_link]', $reg_page, $message);							

						}else{							
							$user_role= 'visitor';
							
							$message=get_option('_iv_visibility_visitor_message');
							$iv_redirect = get_option( '_uou_tigerp_login_page');							
							$reg_page= '<a href="'.get_permalink( $iv_redirect).' "> Here </a';
							$message= str_replace('[here_link]', $reg_page, $message);	
						}
						
						$post_category='';
							if(get_the_category($post->ID)){ 
								 $post_category = get_the_category($post->ID);  // the value is recieved properly
								if(isset($post_category[0]->category_nicename)){
									$post_category=$post_category[0]->category_nicename;
								}
								
							}
						$store_array=get_option('_iv_visibility_serialize_role');
						
						 if(isset($store_array[$user_role]))
						{	
							if(in_array($post_category, $store_array[$user_role])){
								
								return $content;
							}else{
								
								$content = ob_get_clean();
								$content =  $message; 
								return $content;
							}
							//print_r($store_array['Silver']);
						}else{ 
							$content='';
							$content = ob_get_clean();
							$content =  $message; 
							return $content;
							
						}
						
						$output='';
						$output = $content;
					}
					
					
					return $content;
				}
				
			
				public function uou_tigerp_user_exist_check(){
						global $wpdb;
					
					parse_str($_POST['form_data'], $data_a2);
						
						
					
					if(isset($data_a2['contact_captcha'])){
						$captcha_answer="";
						if(isset($data_a2['captcha_answer'])){
							$captcha_answer=$data_a2['captcha_answer'];
						}
						if($data_a2['contact_captcha']!=$captcha_answer){
							echo json_encode('captcha_error');
							exit(0);
						}						
					}
					$userdata = array();
					$user_name='';
					if(isset($data_a2['iv_member_user_name'])){
						$userdata['user_login']=$data_a2['iv_member_user_name'];
					}					
					if(isset($data_a2['iv_member_email'])){
						$userdata['user_email']=$data_a2['iv_member_email'];
					}					
					if(isset($data_a2['iv_member_password'])){
						$userdata['user_pass']=$data_a2['iv_member_password'];
					}
					
					
					if($userdata['user_login']!='' and $userdata['user_email']!='' and $userdata['user_pass']!='' ){
					
						$user_id = username_exists( $userdata['user_login'] );
						if ( !$user_id and email_exists($userdata['user_email']) == false ) {							
							 //$user_id = wp_insert_user( $userdata ) ;
								echo json_encode('success');
								exit(0);
						} else {
								echo json_encode('User or Email exists');
								exit(0);
						}
					}
									
				
						
				
				}
				public function uou_tigerp_registration_submit() {
					
					global $wpdb;
					
					parse_str($_POST['form_data'], $data_a2);
						
						
						
					if(isset($data_a2['contact_captcha'])){
						$captcha_answer="";
						if(isset($data_a2['captcha_answer'])){
							$captcha_answer=$data_a2['captcha_answer'];
						}
						if($data_a2['contact_captcha']!=$captcha_answer){
							echo json_encode('captcha_error');
							exit(0);
						}						
					}
					$userdata = array();
					$user_name='';
					if(isset($data_a2['iv_member_user_name'])){
						$userdata['user_login']=$data_a2['iv_member_user_name'];
					}					
					if(isset($data_a2['iv_member_email'])){
						$userdata['user_email']=$data_a2['iv_member_email'];
					}					
					if(isset($data_a2['iv_member_password'])){
						$userdata['user_pass']=$data_a2['iv_member_password'];
					}
					if(isset($data_a2['iv_member_password'])){
						$userdata['first_name']=$data_a2['iv_member_fname'];
					}
					if(isset($data_a2['iv_member_password'])){
						$userdata['last_name']=$data_a2['iv_member_lname'];
					}							
					
					//print_r($userdata);
					
					if($userdata['user_login']!='' and $userdata['user_email']!='' and $userdata['user_pass']!='' ){
					
						$user_id = username_exists( $userdata['user_login'] );
						if ( !$user_id and email_exists($userdata['user_email']) == false ) {							
							 $user_id = wp_insert_user( $userdata ) ;
						} else {
							echo json_encode('User or Email exists');
							exit(0);
						}
					}
					
					//$hidden_form_name = $data_a2['uou_tigerp_registration'];
					$post_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = 'uou_tigerp_account_form'");
					
					$uou_tigerp_auto_email = get_post_meta($post_id, 'uou_tigerp_auto_email', true);
					$admin_mail = get_option('admin_email');
					$wp_title = get_bloginfo();
					
						// email for user
					
					foreach ($data_a2 as $key => $item) {
						$search_sort_key = '[' . $key . ']';
						$uou_tigerp_auto_email = str_replace($search_sort_key, $item, $uou_tigerp_auto_email);
						$search_sort_key = '[ ' . $key . ' ]';
						$uou_tigerp_auto_email = str_replace($search_sort_key, $item, $uou_tigerp_auto_email);
					}
					
					$uou_tigerp_admin_email = get_post_meta($post_id, 'uou_tigerp_admin_email', true);
						
						
					$cilent_email_address = $userdata['user_email'];
							
					$auto_subject=  get_post_meta($post_id, 'uou_tigerp_auto_email_subject', true); 
							
					$headers = array("From: " . $wp_title . " <" . $admin_mail . ">", "Content-Type: text/html");
					$h = implode("\r\n", $headers) . "\r\n";
							
					if (get_option('uou_tigerp_auto_reply') == 'yes') {
								wp_mail($cilent_email_address, $auto_subject, $uou_tigerp_auto_email, $h);
					}
						
						
				
										
				
						echo json_encode('success');
						exit(0);
				}
				
				
				
				private function load_dependencies() {
					
						// Admin Panel
					if (is_admin()) {
						include ('admin/forms.php');
						include ('admin/notifications.php');
						include ('admin/tables.php');
						include ('admin/admin.php');
					}
					
						// Front-End Site
					if (!is_admin()) {
					}
					
						// Global
					include ('inc/widget.php');
				}
				
				/**
				 * Called every time the plug-in is activated.
				 */
				public function activate() {
							global $wpdb;					
							$page_name=get_option('_uou_tigerp_home');						
							$query = "delete from {$wpdb->prefix}posts where  ID='".$page_name."' LIMIT 1";
							$wpdb->query($query);
							
							$page_name=get_option('_uou_tigerp_price_table');						
							$query = "delete from {$wpdb->prefix}posts where  ID='".$page_name."' LIMIT 1";
							$wpdb->query($query);
							
							$page_name=get_option('_uou_tigerp_registration');							
							$query = "delete from {$wpdb->prefix}posts where  ID='".$page_name."' LIMIT 1";
							$wpdb->query($query);
							
							$page_name=get_option('_uou_tigerp_profile_page');						
							$query = "delete from {$wpdb->prefix}posts where  ID='".$page_name."' LIMIT 1";
							$wpdb->query($query);
							
						
							
							$page_name=get_option('_uou_tigerp_login_page');					
							$query = "delete from {$wpdb->prefix}posts where  ID='".$page_name."' LIMIT 1";
							$wpdb->query($query);
							
							$page_name=get_option('_uou_tigerp_thank_you_page');					
							$query = "delete from {$wpdb->prefix}posts where  ID='".$page_name."' LIMIT 1";
							$wpdb->query($query);
							
							$page_name=get_option('_uou_tigerp_user_dir_page');						
							$query = "delete from {$wpdb->prefix}posts where  ID='".$page_name."' LIMIT 1";
							$wpdb->query($query);
							
							$page_name=get_option('_uou_tigerp_contact_page');						
							$query = "delete from {$wpdb->prefix}posts where  ID='".$page_name."' LIMIT 1";
							$wpdb->query($query);
							
							$page_name=get_option('_uou_tigerp_blog');						
							$query = "delete from {$wpdb->prefix}posts where  ID='".$page_name."' LIMIT 1";
							$wpdb->query($query);
							
							$page_name=get_option('_uou_tigerp_about_us');						
							$query = "delete from {$wpdb->prefix}posts where  ID='".$page_name."' LIMIT 1";
							$wpdb->query($query);
							
							$page_name=get_option('_uou_tigerp_company_profile');						
							$query = "delete from {$wpdb->prefix}posts where  ID='".$page_name."' LIMIT 1";
							$wpdb->query($query);
							
							$page_name=get_option('_uou_tigerp_professionals_dir_page');						
							$query = "delete from {$wpdb->prefix}posts where  ID='".$page_name."' LIMIT 1";
							$wpdb->query($query);
					
					include ('install/install.php');
					
						
				}
				
				/**
				 * Called when the plug-in is deactivated.
				 */
				public function deactivate() {
								
					
					
				}
				
				/**
				 * Called when the plug-in is uninstalled
				 */
				static function uninstall() {
				}
				
				/**
				 * Register the widgets
				 */
				public function register_widget() {
					//register_widget("wp_uou_tigerp_widget");
				}
				
				/**
				 * Internationalization
				 */
				public function i18n() {
					
					//load_plugin_textdomain('tiger', false,  get_template_directory() . '/language/' );
					
					//die( get_template_directory()  . '/language/');
				}
				
				/**
				 * Starts the plug-in main functionality
				 */
				public function start() {
				}
				public function uou_tigerp_display_func($atts = '', $content = '') {
					global $wpdb;					
						
					if (isset($atts['form'])) {
						$form_name = $atts['form'];
						$post_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = '" . $form_name . "'");
						
						$content_post = get_post($post_id);
						$content = $content_post->post_content;
						
					}
					return $content;
				}
				
				public function uou_tigerp_price_table_company_func($atts = '', $content = '') {						
						ob_start();						  //include the specified file
							
						include( wp_uou_tigerp_template. 'pricing-table/price-table_company.php');						
							
						$content = ob_get_clean();	
					
					return $content;
					
				}
				public function uou_tigerp_price_table_professional_func($atts = '', $content = '') {						
						ob_start();						  //include the specified file
							
						include( wp_uou_tigerp_template. 'pricing-table/price-table_professional.php');						
							
						$content = ob_get_clean();	
					
					return $content;
					
				}
				
				public function uou_tigerp_registration_form_func($atts = '', $content = '') {
						
						$package_id=0;
						if(isset($_REQUEST['package_id'])){
							$package_id=$_REQUEST['package_id'];
						}
						
						global $wpdb;
						
						$post_name='uou_tigerp_account_form';
						$post_content = $wpdb->get_row("SELECT post_content FROM $wpdb->posts WHERE post_name = '" . $post_name . "'");	
						
						if(sizeof($post_content)>0){
							$content = $post_content->post_content;
							$content = str_replace('uou_tigerp_package_id_change', $package_id, $content);
						}
						
					
					return $content;
				}
				public function uou_tigerp_payment_form_func($atts = '', $content = '') {
						
						
						
						global $wpdb;
						
						$post_name='uou_tigerp_payment_form';
						$post_content = $wpdb->get_row("SELECT post_content FROM $wpdb->posts WHERE post_name = '" . $post_name . "'");	
						
						if(sizeof($post_content)>0){
							$content = $post_content->post_content;
							//$content = str_replace('uou_tigerp_package_id_change', $package_id, $content);
						}
						
					
					return $content;
				}
				public function iv_archive_directories_func(){
					ob_start();	
					$template_path=wp_uou_tigerp_template.'directories/';
					include( $template_path. 'archive-directories.php');
					
					$content = ob_get_clean();
					return $content;
				}
				public function uou_tigerp_form_wizard_func($atts = '') {
						
						//global $wpdb;
						$template_path=wp_uou_tigerp_template.'signup/';						
						ob_start();						
							
						include( $template_path. 'wizard-style-2.php');							
						
						$content = ob_get_clean();	
					
					return $content;
				}
				
				public function uou_tigerp_profile_template_func($atts = '') {
						//die(wp_uou_tigerp_template);
						//global $wpdb;
					 global $current_user;
					 ob_start();
					 if($current_user->ID==0){
							include(wp_uou_tigerp_template. 'private-profile/profile-login.php');
					 
					 }else{
							
							// get_template_part('templates/private-profile/profile-template-1.php','choose');
							//die(get_template_directory_uri().'templates');
							include( wp_uou_tigerp_template. 'private-profile/profile-template-1.php');
							
						
						
					}
					
					$content = ob_get_clean();	
					
					return $content;
						
					
				}
				public function uou_tigerp_reminder_email_cron_func ($atts = ''){
					
					include( wp_uou_tigerp_ABSPATH. 'inc/reminder-email-cron.php');
					
				
				}
				public function uou_tigerp_cron_job(){
					
					include( wp_uou_tigerp_ABSPATH. 'inc/all_cron_job.php');
					exit(0);
				}
				
				public function hospital_categories_func($atts = ''){
					ob_start();						
					include( wp_uou_tigerp_template. 'hospital/hospital_categories.php');					
					$content = ob_get_clean();
					return $content;
				}
				public function doctor_categories_func($atts = ''){
					ob_start();						
					include( wp_uou_tigerp_template. 'doctor/doctor_categories.php');					
					$content = ob_get_clean();
					return $content;
				}
				public function directorypro_map_func($atts = ''){
					ob_start();	
						include( wp_uou_tigerp_template. 'directories/directories-map.php');
					$content = ob_get_clean();
					return $content;
				}				
				public function hospital_featured_func($atts = ''){
					ob_start();
					include( wp_uou_tigerp_template. 'hospital/hospital_featured.php');
					$content = ob_get_clean();
					return $content;
				}
				public function doctor_featured_home_func($atts = ''){
					ob_start();
					include( wp_uou_tigerp_template. 'doctor/doctor_featured_home.php');
					$content = ob_get_clean();
					return $content;
				}
				public function doctor_featured_func($atts = ''){
					ob_start();
					include( wp_uou_tigerp_template. 'doctor/doctor_featured.php');
					$content = ob_get_clean();
					return $content;
				}	
				public function listing_doctor_style_1_func(){
					ob_start();	
						include( wp_uou_tigerp_template. 'doctor/archive-doctor_style_1.php');
					$content = ob_get_clean();
					return $content;
				
				}
				public function listing_layout_style_1_func(){
					ob_start();	
						include( wp_uou_tigerp_template. 'hospital/archive-hospital_style_1.php');
					$content = ob_get_clean();
					return $content;
				
				}				
				public function contact_us_func(){
					ob_start();	
						include( wp_uou_tigerp_template. 'contact/contact-us.php');
					$content = ob_get_clean();
					return $content;
				
				}
				
				public function listing_layout_style_2_func(){
					ob_start();	
						include( wp_uou_tigerp_template. 'hospital/archive-hospital-style-2.php');
					$content = ob_get_clean();
					return $content;				
				}
				public function listing_layout_style_3_func(){
					ob_start();	
						include( wp_uou_tigerp_template. 'directories/archive-directories-style-3.php');
					$content = ob_get_clean();
					return $content;				
				}
				
				public function uou_tigerp_company_directory($atts = ''){
					global $current_user;					 
					
					
					ob_start();						 
					//include the specified file
					
					include( wp_uou_tigerp_template. 'user-directory/directory-template-company.php');
					
					
					$content = ob_get_clean();
					return $content;						
							
						
				}
				public function uou_tigerp_professionals_directory($atts = ''){
					global $current_user;
					
					ob_start();						 
					//include the specified file
					
					include( wp_uou_tigerp_template. 'user-directory/directory-template-professionals.php');
					
					
					$content = ob_get_clean();
					return $content;	
				}	
				public function uou_tigerp_profile_public_func($atts = '') {
						
						
						
						ob_start();						 
						//include the specified file
						
						//include(wp_uou_tigerp_template. 'profile-public/profile-template.php');
						include(wp_uou_tigerp_template. 'profile-public/profile_company.php');
						
													
						$content = ob_get_clean();	
					
					return $content;
				}
				public function get_search_listing($lat=0,$lng=0,$radius=3,$postcats){
					global $wpdb;	
					
					if($radius==""){$radius='50';}	
					if($lat==""){$lat='0';}	
					if($lng==""){$lng='0';}	
					$results = $wpdb->get_results("SELECT p.ID, 
								ACOS(SIN(RADIANS($lat))*SIN(RADIANS(pm1.meta_value))+COS(RADIANS($lat  ))*COS(RADIANS(pm1.meta_value))*COS(RADIANS(pm2.meta_value)-RADIANS($lng))) * 6387.7 AS distance 
								FROM $wpdb->posts p													
								LEFT JOIN wp_postmeta AS pm1 ON ( p.ID = pm1.post_id AND pm1.meta_key = 'latitude' )
								LEFT JOIN wp_postmeta AS pm2 ON ( p.ID = pm2.post_id AND pm2.meta_key = 'longitude' )
								
								WHERE post_type = 'directories' AND post_status = 'publish'								
								HAVING distance <= $radius
								ORDER BY distance ASC;");
													
					$ids='';
					foreach($results as $row){
						$ids=$row->ID.',';
						
					}
					return $ids;
				}
				public function get_nearest_listing($lat=0,$lng=0,$radius=3){
					global $wpdb;	
					if($radius==""){$radius='50';}	
					if($lat==""){$lat='0';}	
					if($lng==""){$lng='0';}	
					$dir_search_redius=get_option('_dir_search_redius');
					$for_option_redius='6387.7';	
					if($dir_search_redius=="Miles"){$for_option_redius='3959';}else{$for_option_redius='6387.7'; }
				
					$results = $wpdb->get_results("SELECT p.*, pm1.meta_value as lat, pm2.meta_value as lon, 
								ACOS(SIN(RADIANS($lat))*SIN(RADIANS(pm1.meta_value))+COS(RADIANS($lat  ))*COS(RADIANS(pm1.meta_value))*COS(RADIANS(pm2.meta_value)-RADIANS($lng))) * ".$for_option_redius." AS distance 
								FROM $wpdb->posts p													
								LEFT JOIN wp_postmeta AS pm1 ON ( p.ID = pm1.post_id AND pm1.meta_key = 'latitude' )
								LEFT JOIN wp_postmeta AS pm2 ON ( p.ID = pm2.post_id AND pm2.meta_key = 'longitude' )								
								WHERE post_type = 'directories' AND post_status = 'publish'
								HAVING distance <= $radius
								ORDER BY distance ASC;");
					
					return $results;
				}
				
				
				public function uou_tigerp_bidding_popup(){
					include( wp_uou_tigerp_template. 'private-profile/bidding-popup.php');
					exit(0);
				}
				public function uou_tigerp_contact_popup(){
					include( wp_uou_tigerp_template. 'private-profile/contact_popup.php');
					exit(0);
				}
				public function uou_tigerp_claim_popup(){
					include( wp_uou_tigerp_template. 'private-profile/claim_popup.php');
					exit(0);
				}
			
				public function uou_tigerp_bidding_position(){
					global $wpdb;
					parse_str($_POST['form_data'], $form_data);
					$amount=$form_data['bump_amount'];
					$dir_id=$form_data['dir_id'];
					$radius=get_option('_iv_radius');
					
					$paid_cat_range=0;
					$paid_area_count=0;
					$top_bump_amount=0;
					$bump_room=0;
					$lat=get_post_meta($dir_id,'latitude',true);
					$long=get_post_meta($dir_id,'longitude',true);						
						
					$nearest_listing = $this->get_nearest_listing($lat,$long,$radius);
					
					$bump_exp_date =get_post_meta($dir_id,'_bump_exp_date',true);
					$bump_amount  = get_post_meta($dir_id,'_bump_amount',true); 
					$bump_create_date= get_post_meta($dir_id,'_bump_create_date',true);
					
					//if(strtotime($bump_exp_date)>=time()){								
							$bump_room=1;								
						foreach ($nearest_listing as $nearest_listing_row) { 										
							if($nearest_listing_row->ID!=$dir_id){
								$near_bump_exp_date=get_post_meta($nearest_listing_row->ID,'_bump_exp_date',true);
								$near_bump_create_date= get_post_meta($nearest_listing_row->ID,'_bump_create_date',true);
								$near_bump_amount= get_post_meta($nearest_listing_row->ID,'_bump_amount',true);	
																	
								if(strtotime($near_bump_exp_date)>=time()){														
										if($near_bump_amount > $amount  ){															
												$paid_area_count++;	
														
										}
										if($amount == $near_bump_amount ){
											 if(strtotime($bump_create_date) < strtotime($near_bump_create_date )){
													$paid_area_count++;
													
											 }	
										}
										
									}
							}
							
						}
					
					//}					
					
					$i=1;
					$free_area_count=0;
					$free_cat_range=0;					
					$cat_range=1+$paid_cat_range+$free_cat_range;
					$area_count=1+$paid_area_count+$free_area_count;
									
					//echo json_encode(array("code" => "success","msg"=>"Updated Successfully"));
					
					echo json_encode(array("cat_range" => $cat_range, "area_count" => $area_count));
                  exit(0);
				}
				public function uou_tigerp_save_bidding(){
					global $wpdb;
					parse_str($_POST['form_data'], $form_data);
					
					$amount=$form_data['bump_amount'];
					$balance=get_user_meta(get_current_user_id(),'balance',true);
					if($balance<$amount){
						echo json_encode(array("msg" => 'lowBalance'));
						exit(0);
					}
					$dir_id=$form_data['dir_id'];
					$new_amount=$amount - get_post_meta($dir_id,'bump_amount',true); 
					$bump_exp_date= strtotime("+1 day", time());
					$bump_exp_date=date("Y-m-d H:i:s",$bump_exp_date); 
					
					update_post_meta($dir_id,'_bump_exp_date',$bump_exp_date);
					update_post_meta($dir_id,'_bump_amount',$amount); 
					$current_date=date("Y-m-d H:i:s", time());
					update_post_meta($dir_id,'_bump_create_date',$current_date);
					update_post_meta($dir_id,'_bump_status', 'open');
					$total=get_post_meta($dir_id,'_bump_amount_total',true);
					update_post_meta($dir_id,'_bump_amount_total',$total+$new_amount);
					
					//**********
					
					$balance=$balance - $new_amount;
					update_user_meta(get_current_user_id(),'balance',$balance);
					//*********
					
					
						// Add History ******
						$post_history='Bidding Cost';
						$history_content='Bidding Cost :'.$new_amount.' For Directory  : <a href="'.get_permalink( $dir_id ).'"> '.get_the_title( $dir_id ).'</a>';
						$my_post_form = array('post_title' => wp_strip_all_tags($post_history), 'post_name' => wp_strip_all_tags($post_history), 'post_content' => $history_content, 'post_status' => 'publish', 'post_author' => get_current_user_id(),);
						$newpost_id = wp_insert_post($my_post_form);
						
						$post_type = 'iv_payment';
						$query = "UPDATE {$wpdb->prefix}posts SET post_type='" . $post_type . "' WHERE id='" . $newpost_id . "' LIMIT 1";
						$wpdb->query($query);
						
						update_post_meta($newpost_id,'amount',$new_amount);
						
					
						echo json_encode(array("msg" => 'success'));		
					
						exit(0);		
					
				
				}
				//follow
				public function uou_tigerp_save_follow(){
						parse_str($_POST['data'], $form_data);					
						$profile_user_id=$form_data['id'];
						$current_user_id=get_current_user_id();
						
						$old_favorites= get_user_meta($profile_user_id,'_follower',true);
						$old_favorites = str_replace(get_current_user_id(), '',  $old_favorites);
						
						$new_favorites=$old_favorites.', '.get_current_user_id();
						update_user_meta($profile_user_id,'_follower',$new_favorites);						
						
						$old_favorites2=get_user_meta(get_current_user_id(),'_following', true);						
						$old_favorites2 = str_replace($profile_user_id ,'',  $old_favorites2);						
						
						$new_favorites2=$old_favorites2.', '.$profile_user_id;
						update_user_meta(get_current_user_id(),'_following',$new_favorites2);
						
						echo json_encode(array("msg" => 'success'));
						exit(0);	
				}
				public function uou_tigerp_save_un_follow(){
						parse_str($_POST['data'], $form_data);					
						$profile_user_id=$form_data['id'];
						
						$old_favorites= get_user_meta($profile_user_id,'_follower',true);
						$old_favorites = str_replace(get_current_user_id(), '',  $old_favorites);
						update_user_meta($profile_user_id,'_follower',$old_favorites);	
						
												
						$old_favorites2=get_user_meta(get_current_user_id(),'_following', true);						
						$old_favorites2 = str_replace($profile_user_id ,'',  $old_favorites2);						
						
						$new_favorites2=$old_favorites2;
						update_user_meta(get_current_user_id(),'_following',$new_favorites2);
						
						echo json_encode(array("msg" => 'success'));
						exit(0);	
				}
				//Connect
				public function uou_tigerp_save_connect(){
						parse_str($_POST['data'], $form_data);					
						$profile_user_id=$form_data['id'];
						$current_user_id=get_current_user_id();
						
						$old_favorites= get_user_meta($profile_user_id,'_connecter',true);
						$old_favorites = str_replace(get_current_user_id(), '',  $old_favorites);
						
						$new_favorites=$old_favorites.', '.get_current_user_id();
						update_user_meta($profile_user_id,'_connecter',$new_favorites);						
						
						$old_favorites2=get_user_meta(get_current_user_id(),'_my_connect', true);						
						$old_favorites2 = str_replace($profile_user_id ,' ',  $old_favorites2);						
						
						$new_favorites2=$old_favorites2.', '.$profile_user_id;
						update_user_meta(get_current_user_id(),'_my_connect',$new_favorites2);
						
						echo json_encode(array("msg" => 'success'));
						exit(0);	
				}
				public function uou_tigerp_load_more_connection(){
						global $current_user;
						parse_str($_POST['data'], $form_data);	
						$paged =$form_data['page'];
						$connection_type =$form_data['type'];
						$args = array();
						$result='';
						$socialnetwork_value='';
                        $socialnetwork_value = get_user_meta($current_user->ID,'_my_connect',true);	                       
						$socialnetwork_value = array_filter(explode(",", $socialnetwork_value));
										
						$no=10;							
						if($connection_type!='All'){
							if($connection_type=='Professionals'){								
								
								$args['meta_query']=array(
									'relation' => 'AND',
										array(
											'key'     => 'iv_member_type',
											'value'   => 'professional',
											'compare' => '='
										)
										
								);
							}
							if($connection_type=='Companies'){
								
								$args['meta_query']=array(
									'relation' => 'AND',
										array(
											'key'     => 'iv_member_type',
											'value'   => 'corporate',
											'compare' => '='
										)
										
								);
							}	
						}					
										
						$offset= ($paged-1)*$no;					
				        $args['number']=$no;
				        $args['offset']=$offset;						
						$args['include']=$socialnetwork_value;
						
					   $user_query = new WP_User_Query( $args );	
					  
						if ( ! empty( $user_query->results ) ) {
							foreach ( $user_query->results as $user ) {	
								
								$Followers='';
								$Followers = get_user_meta($user->ID,'_follower',true);				
								$Followers = array_filter( explode(',', $Followers), 'strlen' );
								$Followers= array_filter(array_map('trim', $Followers));	
								
								$Following='';
								$Following = get_user_meta($user->ID,'_following',true);				
								$Following = array_filter( explode(',', $Following), 'strlen' );
								$Following= array_filter(array_map('trim', $Following));	
								
								$Connections='';
								$Connections = get_user_meta($user->ID,'_connecter',true);				
								$Connections = array_filter( explode(',', $Connections), 'strlen' );
								$Connections= array_filter(array_map('trim', $Connections));					
								$iv_profile_pic_url=get_user_meta($user->ID, 'iv_profile_pic_thum',true);
								if($iv_profile_pic_url==''){ 
									$iv_profile_pic_url= tiger_IMAGE.'Blank-Profile.jpg';
								}
								$reg_page_user='';
								$user_type= get_user_meta($user->ID,'iv_member_type',true);
								if($user_type=='corporate'){
									$iv_redirect_user = get_option( '_iv_corporate_profile_public_page');
								    $reg_page_user= get_permalink( $iv_redirect_user) ;
								}else{
									
									$iv_redirect_user = get_option( '_iv_personal_profile_public_page');
								    $reg_page_user= get_permalink( $iv_redirect_user) ;
								}		
								
								$result=$result.'<li ><div class="row">
										<div class="col-xs-4">
										  <div class="checkbox">
											<input id="connection_id[]" name="connection_id[]" value="'.$user->ID.'" class="styled" type="checkbox">
											<label for="checkbox1"></label>
										  </div>
										  <div class="fol-name">
											<div class="avatar"> 
											<a href="'.$reg_page_user.'?&id='.$user->user_login.'">	
											<img src="'.$iv_profile_pic_url.'" alt="image"> </div>
											</a>
											<a href="'.$reg_page_user.'?&id='.$user->user_login.'">	
											<h6>'. (get_user_meta($user->ID,'profile_name',true)!=''? get_user_meta($user->ID,'profile_name',true): $user->display_name ).'</h6>
											</a>
											<span>'.( get_user_meta($user->ID,'iv_member_type',true)=='corporate' ? get_user_meta($user->ID,'company_type',true):get_user_meta($user->ID,'designation',true) ).'</span> </div>
										</div>
										<div class="col-xs-3 n-p-r n-p-l"> <span>'. get_user_meta($user->ID,'address',true).' </span> </div>
										<div class="col-xs-3 n-p-r"> <span>
												'. sizeof($Followers).' '. esc_html__('Followers','tiger').'</span> <span>'. sizeof($Following).' '. esc_html__('Following','tiger').'</span> </div>								
										<div class="col-xs-2 n-p-r n-p-l"> <span>'. sizeof($Connections).' '.esc_html__('Connections','tiger').'</span> </div>
									  </div>
									</li>
									';
									
								
							}
						}
						
						//echo json_encode(array("result" => $result));
						echo $result;
						exit(0);	
						
				}
				public function uou_tigerp_load_more_bookmark(){
						global $current_user;
						parse_str($_POST['data'], $form_data);	
						$paged =$form_data['page'];
						$connection_type =$form_data['type'];
						$args = array();
						$result='';
						$socialnetwork_value='';
                        $socialnetwork_value = get_user_meta($current_user->ID,'_my_bookmark',true);	                       
						$socialnetwork_value = array_filter(explode(",", $socialnetwork_value));
										
						$no=10;							
						if($connection_type!='All'){
							if($connection_type=='Professionals'){								
								
								$args['meta_query']=array(
									'relation' => 'AND',
										array(
											'key'     => 'iv_member_type',
											'value'   => 'professional',
											'compare' => '='
										)
										
								);
							}
							if($connection_type=='Companies'){
								
								$args['meta_query']=array(
									'relation' => 'AND',
										array(
											'key'     => 'iv_member_type',
											'value'   => 'corporate',
											'compare' => '='
										)
										
								);
							}	
						}					
										
						$offset= ($paged-1)*$no;					
				        $args['number']=$no;
				        $args['offset']=$offset;						
						$args['include']=$socialnetwork_value;
						
					   $user_query = new WP_User_Query( $args );	
					  
						if ( ! empty( $user_query->results ) ) {
							foreach ( $user_query->results as $user ) {	
								
								$Followers='';
								$Followers = get_user_meta($user->ID,'_follower',true);				
								$Followers = array_filter( explode(',', $Followers), 'strlen' );
								$Followers= array_filter(array_map('trim', $Followers));	
								
								$Following='';
								$Following = get_user_meta($user->ID,'_following',true);				
								$Following = array_filter( explode(',', $Following), 'strlen' );
								$Following= array_filter(array_map('trim', $Following));	
								
								$Connections='';
								$Connections = get_user_meta($user->ID,'_connecter',true);				
								$Connections = array_filter( explode(',', $Connections), 'strlen' );
								$Connections= array_filter(array_map('trim', $Connections));					
								$iv_profile_pic_url=get_user_meta($user->ID, 'iv_profile_pic_thum',true);
								if($iv_profile_pic_url==''){ 
									$iv_profile_pic_url= tiger_IMAGE.'Blank-Profile.jpg';
								}
								$reg_page_user='';
								$user_type= get_user_meta($user->ID,'iv_member_type',true);
								if($user_type=='corporate'){
									$iv_redirect_user = get_option( '_iv_corporate_profile_public_page');
								    $reg_page_user= get_permalink( $iv_redirect_user) ;
								}else{
									
									$iv_redirect_user = get_option( '_iv_personal_profile_public_page');
								    $reg_page_user= get_permalink( $iv_redirect_user) ;
								}		
								
								$result=$result.'<li ><div class="row">
										<div class="col-xs-4">
										  <div class="checkbox">
											<input id="connection_id[]" name="connection_id[]" value="'.$user->ID.'" class="styled" type="checkbox">
											<label for="checkbox1"></label>
										  </div>
										  <div class="fol-name">
											<div class="avatar"> 
											<a href="'.$reg_page_user.'?&id='.$user->user_login.'">	
											<img src="'.$iv_profile_pic_url.'" alt="image"> </div>
											</a>
											<a href="'.$reg_page_user.'?&id='.$user->user_login.'">	
											<h6>'. (get_user_meta($user->ID,'profile_name',true)!=''? get_user_meta($user->ID,'profile_name',true): $user->display_name ).'</h6>
											</a>
											<span>'.( get_user_meta($user->ID,'iv_member_type',true)=='corporate' ? get_user_meta($user->ID,'company_type',true):get_user_meta($user->ID,'designation',true) ).'</span> </div>
										</div>
										<div class="col-xs-3 n-p-r n-p-l"> <span>'. get_user_meta($user->ID,'address',true).' </span> </div>
										<div class="col-xs-3 n-p-r"> <span>
												'. sizeof($Followers).' '. esc_html__('Followers','tiger').'</span> <span>'. sizeof($Following).' '. esc_html__('Following','tiger').'</span> </div>								
										<div class="col-xs-2 n-p-r n-p-l"> <span>'. sizeof($Connections).' '.esc_html__('Connections','tiger').'</span> </div>
									  </div>
									</li>
									';
									
								
							}
						}
						
						//echo json_encode(array("result" => $result));
						echo $result;
						exit(0);	
						
				}
				public function uou_tigerp_load_more_bookmarker(){
						global $current_user;
						parse_str($_POST['data'], $form_data);	
						$paged =$form_data['page'];
						$connection_type =$form_data['type'];
						$args = array();
						$result='';
						$socialnetwork_value='';
                        $socialnetwork_value = get_user_meta($current_user->ID,'_bookmarker',true);	                       
						$socialnetwork_value = array_filter(explode(",", $socialnetwork_value));
										
						$no=10;							
						if($connection_type!='All'){
							if($connection_type=='Professionals'){								
								
								$args['meta_query']=array(
									'relation' => 'AND',
										array(
											'key'     => 'iv_member_type',
											'value'   => 'professional',
											'compare' => '='
										)
										
								);
							}
							if($connection_type=='Companies'){
								
								$args['meta_query']=array(
									'relation' => 'AND',
										array(
											'key'     => 'iv_member_type',
											'value'   => 'corporate',
											'compare' => '='
										)
										
								);
							}	
						}					
										
						$offset= ($paged-1)*$no;					
				        $args['number']=$no;
				        $args['offset']=$offset;						
						$args['include']=$socialnetwork_value;
						
					   $user_query = new WP_User_Query( $args );	
					  
						if ( ! empty( $user_query->results ) ) {
							foreach ( $user_query->results as $user ) {	
								
								$Followers='';
								$Followers = get_user_meta($user->ID,'_follower',true);				
								$Followers = array_filter( explode(',', $Followers), 'strlen' );
								$Followers= array_filter(array_map('trim', $Followers));	
								
								$Following='';
								$Following = get_user_meta($user->ID,'_following',true);				
								$Following = array_filter( explode(',', $Following), 'strlen' );
								$Following= array_filter(array_map('trim', $Following));	
								
								$Connections='';
								$Connections = get_user_meta($user->ID,'_connecter',true);				
								$Connections = array_filter( explode(',', $Connections), 'strlen' );
								$Connections= array_filter(array_map('trim', $Connections));					
								$iv_profile_pic_url=get_user_meta($user->ID, 'iv_profile_pic_thum',true);
								if($iv_profile_pic_url==''){ 
									$iv_profile_pic_url= tiger_IMAGE.'Blank-Profile.jpg';
								}
								$reg_page_user='';
								$user_type= get_user_meta($user->ID,'iv_member_type',true);
								if($user_type=='corporate'){
									$iv_redirect_user = get_option( '_iv_corporate_profile_public_page');
								    $reg_page_user= get_permalink( $iv_redirect_user) ;
								}else{
									
									$iv_redirect_user = get_option( '_iv_personal_profile_public_page');
								    $reg_page_user= get_permalink( $iv_redirect_user) ;
								}		
								
								$result=$result.'<li ><div class="row">
										<div class="col-xs-4">
										  <div class="checkbox">
											<input id="connection_id[]" name="connection_id[]" value="'.$user->ID.'" class="styled" type="checkbox">
											<label for="checkbox1"></label>
										  </div>
										  <div class="fol-name">
											<div class="avatar"> 
											<a href="'.$reg_page_user.'?&id='.$user->user_login.'">	
											<img src="'.$iv_profile_pic_url.'" alt="image"> </div>
											</a>
											<a href="'.$reg_page_user.'?&id='.$user->user_login.'">	
											<h6>'. (get_user_meta($user->ID,'profile_name',true)!=''? get_user_meta($user->ID,'profile_name',true): $user->display_name ).'</h6>
											</a>
											<span>'.( get_user_meta($user->ID,'iv_member_type',true)=='corporate' ? get_user_meta($user->ID,'company_type',true):get_user_meta($user->ID,'designation',true) ).'</span> </div>
										</div>
										<div class="col-xs-3 n-p-r n-p-l"> <span>'. get_user_meta($user->ID,'address',true).' </span> </div>
										<div class="col-xs-3 n-p-r"> <span>
												'. sizeof($Followers).' '. esc_html__('Followers','tiger').'</span> <span>'. sizeof($Following).' '. esc_html__('Following','tiger').'</span> </div>								
										<div class="col-xs-2 n-p-r n-p-l"> <span>'. sizeof($Connections).' '.esc_html__('Connections','tiger').'</span> </div>
									  </div>
									</li>
									';
									
								
							}
						}
						
						//echo json_encode(array("result" => $result));
						echo $result;
						exit(0);	
						
				}
				public function uou_tigerp_load_more_follower(){
						global $current_user;
						parse_str($_POST['data'], $form_data);	
						$paged =$form_data['page'];
						$connection_type =$form_data['type'];
						$args = array();
						$result='';
						$socialnetwork_value='';
                        $socialnetwork_value = get_user_meta($current_user->ID,'_follower',true);	                       
						$socialnetwork_value = array_filter(explode(",", $socialnetwork_value));
										
						$no=10;							
						if($connection_type!='All'){
							if($connection_type=='Professionals'){								
								
								$args['meta_query']=array(
									'relation' => 'AND',
										array(
											'key'     => 'iv_member_type',
											'value'   => 'professional',
											'compare' => '='
										)
										
								);
							}
							if($connection_type=='Companies'){
								
								$args['meta_query']=array(
									'relation' => 'AND',
										array(
											'key'     => 'iv_member_type',
											'value'   => 'corporate',
											'compare' => '='
										)
										
								);
							}	
						}					
										
						$offset= ($paged-1)*$no;					
				        $args['number']=$no;
				        $args['offset']=$offset;						
						$args['include']=$socialnetwork_value;
						
					   $user_query = new WP_User_Query( $args );	
					  
						if ( ! empty( $user_query->results ) ) {
							foreach ( $user_query->results as $user ) {	
								
								$Followers='';
								$Followers = get_user_meta($user->ID,'_follower',true);				
								$Followers = array_filter( explode(',', $Followers), 'strlen' );
								$Followers= array_filter(array_map('trim', $Followers));	
								
								$Following='';
								$Following = get_user_meta($user->ID,'_following',true);				
								$Following = array_filter( explode(',', $Following), 'strlen' );
								$Following= array_filter(array_map('trim', $Following));	
								
								$Connections='';
								$Connections = get_user_meta($user->ID,'_connecter',true);				
								$Connections = array_filter( explode(',', $Connections), 'strlen' );
								$Connections= array_filter(array_map('trim', $Connections));					
								$iv_profile_pic_url=get_user_meta($user->ID, 'iv_profile_pic_thum',true);
								if($iv_profile_pic_url==''){ 
									$iv_profile_pic_url= tiger_IMAGE.'Blank-Profile.jpg';
								}
								$reg_page_user='';
								$user_type= get_user_meta($user->ID,'iv_member_type',true);
								if($user_type=='corporate'){
									$iv_redirect_user = get_option( '_iv_corporate_profile_public_page');
								    $reg_page_user= get_permalink( $iv_redirect_user) ;
								}else{
									
									$iv_redirect_user = get_option( '_iv_personal_profile_public_page');
								    $reg_page_user= get_permalink( $iv_redirect_user) ;
								}		
								
								$result=$result.'<li ><div class="row">
										<div class="col-xs-4">
										  <div class="checkbox">
											<input id="connection_id[]" name="connection_id[]" value="'.$user->ID.'" class="styled" type="checkbox">
											<label for="checkbox1"></label>
										  </div>
										  <div class="fol-name">
											<div class="avatar"> 
											<a href="'.$reg_page_user.'?&id='.$user->user_login.'">	
											<img src="'.$iv_profile_pic_url.'" alt="image"> </div>
											</a>
											<a href="'.$reg_page_user.'?&id='.$user->user_login.'">	
											<h6>'. (get_user_meta($user->ID,'profile_name',true)!=''? get_user_meta($user->ID,'profile_name',true): $user->display_name ).'</h6>
											</a>
											<span>'.( get_user_meta($user->ID,'iv_member_type',true)=='corporate' ? get_user_meta($user->ID,'company_type',true):get_user_meta($user->ID,'designation',true) ).'</span> </div>
										</div>
										<div class="col-xs-3 n-p-r n-p-l"> <span>'. get_user_meta($user->ID,'address',true).' </span> </div>
										<div class="col-xs-3 n-p-r"> <span>
												'. sizeof($Followers).' '. esc_html__('Followers','tiger').'</span> <span>'. sizeof($Following).' '. esc_html__('Following','tiger').'</span> </div>								
										<div class="col-xs-2 n-p-r n-p-l"> <span>'. sizeof($Connections).' '.esc_html__('Connections','tiger').'</span> </div>
									  </div>
									</li>
									';
									
								
							}
						}
						
						//echo json_encode(array("result" => $result));
						echo $result;
						exit(0);	
						
				}
				public function uou_tigerp_load_more_post(){
					global $current_user;
						parse_str($_POST['data'], $form_data);	
						$paged =$form_data['page'];
						$user_id=$form_data['user_id'];
						
						$result='';
						
						$no=1;			
						$offset= ($paged-1)*$no;	
								
				        $args = array();	
						$args['number']=$no;
						$args['offset']=$offset;		     
						$args['post_type']='post'; 
						$args['author']=$user_id;  
						$args['post_status']='publish';  			       
					 
					  
                      $post_query = new WP_Query( $args );
						
					  
					  
						 if ( $post_query->have_posts() ) {
				        	while ( $post_query->have_posts() ) {
								$post_query->the_post();
								$post_id= $post_query->post->ID;
								
								
								$content = $post_query->post->post_content;
								$content = str_replace( ']]>', ']]&gt;', $content );
								$title=$post_query->post->post_title;
								$content = $post_query->post->post_content;
								$content = str_replace( ']]>', ']]&gt;', $content );
								$post_image="";
								if ( has_post_thumbnail() ) {
										$image_id =  get_post_thumbnail_id( get_the_ID() );
										$large_image = wp_get_attachment_url( $image_id ,'full');
										$resize = tiger_aq_resize( $large_image, true );
									  
										$post_image ='<img src="'. esc_url($resize).'" class="thumb">';
								} 
										  
								$result=$result.'
								<article class="uou-block-7f"> '.$post_image.'																
										 
										  <h1><a href="'. get_permalink( $post_id ).'">'.$title.'</a></h1>
										   <div class="meta"> <span class="time-ago">'. esc_html__( 'Date: ','toger' ).' '.$post_query->post->post_date.'</span></div>
										  <p>
											'. substr($content ,0,200).' <a href="'. get_permalink( $post_id ).'">'. esc_html__( 'Read More','toger' ).'</a>
								  </p>
								  </article>';
									
								
							}
						}
						
						
						echo $result;
						exit(0);	
				
				
				}
				
				public function uou_tigerp_load_more_jobs(){
						global $current_user;
						parse_str($_POST['data'], $form_data);	
						$paged =$form_data['page'];
						$user_id=$form_data['user_id'];
						
						$result='';
						
						$no=1;			
						$offset= ($paged-1)*$no;	
								
				        $args = array();	
						$args['number']=$no;
						$args['offset']=$offset;		     
						$args['post_type']='jobs'; 
						$args['author']=$user_id;  
						$args['post_status']='publish';  			       
					 
					  
                      $job_query = new WP_Query( $args );
						
					  
					  
						 if ( $job_query->have_posts() ) {
				        	while ( $job_query->have_posts() ) {
								$job_query->the_post();
								$post_id= $job_query->post->ID;
								
								$currentCategory=wp_get_object_terms( $id,'jobs-category');
								$cat_link='';$cat_name='';$cat_slug='';
								if(isset($currentCategory[0]->slug)){
									$cat_slug = $currentCategory[0]->slug;
									$cat_name = $currentCategory[0]->name;
									$cat_link= get_term_link($currentCategory[0], 'jobs-category');
								}
								$content = $job_query->post->post_content;
								$content = str_replace( ']]>', ']]&gt;', $content );
								$title=$job_query->post->post_title;
								$post_image="";
								if ( has_post_thumbnail() ) {
										$image_id =  get_post_thumbnail_id( get_the_ID() );
										$large_image = wp_get_attachment_url( $image_id ,'full');
										$resize = tiger_aq_resize( $large_image, true );
									  
										$post_image ='<img src="'. esc_url($resize).'" class="thumb">';
								} 
										  
								$result=$result.'
								<article class="uou-block-7f"> '.$post_image.'																
										 
										  <h1><a href="'. get_permalink( $post_id ).'">'.$title.'</a></h1>
										   <div class="meta"> <span class="time-ago">'. esc_html__( 'Date: ','toger' ).' '.$job_query->post->post_date.'</span></div>
										  <p>
											'. substr($content ,0,200).' <a href="'. get_permalink( $post_id ).'">'. esc_html__( 'Read More','toger' ).'</a>
								  </p>
								  </article>';
									
								
							}
						}
						
						
						echo $result;
						exit(0);	
						
				}
				public function uou_tigerp_load_more_following(){
						global $current_user;
						parse_str($_POST['data'], $form_data);	
						$paged =$form_data['page'];
						$connection_type =$form_data['type'];
						$args = array();
						$result='';
						$socialnetwork_value='';
                        $socialnetwork_value = get_user_meta($current_user->ID,'_following',true);	                       
						$socialnetwork_value = array_filter(explode(",", $socialnetwork_value));
										
						$no=10;							
						if($connection_type!='All'){
							if($connection_type=='Professionals'){								
								
								$args['meta_query']=array(
									'relation' => 'AND',
										array(
											'key'     => 'iv_member_type',
											'value'   => 'professional',
											'compare' => '='
										)
										
								);
							}
							if($connection_type=='Companies'){
								
								$args['meta_query']=array(
									'relation' => 'AND',
										array(
											'key'     => 'iv_member_type',
											'value'   => 'corporate',
											'compare' => '='
										)
										
								);
							}	
						}					
										
						$offset= ($paged-1)*$no;					
				        $args['number']=$no;
				        $args['offset']=$offset;						
						$args['include']=$socialnetwork_value;
						
					   $user_query = new WP_User_Query( $args );	
					  
						if ( ! empty( $user_query->results ) ) {
							foreach ( $user_query->results as $user ) {	
								
								$Followers='';
								$Followers = get_user_meta($user->ID,'_follower',true);				
								$Followers = array_filter( explode(',', $Followers), 'strlen' );
								$Followers= array_filter(array_map('trim', $Followers));	
								
								$Following='';
								$Following = get_user_meta($user->ID,'_following',true);				
								$Following = array_filter( explode(',', $Following), 'strlen' );
								$Following= array_filter(array_map('trim', $Following));	
								
								$Connections='';
								$Connections = get_user_meta($user->ID,'_connecter',true);				
								$Connections = array_filter( explode(',', $Connections), 'strlen' );
								$Connections= array_filter(array_map('trim', $Connections));					
								$iv_profile_pic_url=get_user_meta($user->ID, 'iv_profile_pic_thum',true);
								if($iv_profile_pic_url==''){ 
									$iv_profile_pic_url= tiger_IMAGE.'Blank-Profile.jpg';
								}
								$reg_page_user='';
								$user_type= get_user_meta($user->ID,'iv_member_type',true);
								if($user_type=='corporate'){
									$iv_redirect_user = get_option( '_iv_corporate_profile_public_page');
								    $reg_page_user= get_permalink( $iv_redirect_user) ;
								}else{
									
									$iv_redirect_user = get_option( '_iv_personal_profile_public_page');
								    $reg_page_user= get_permalink( $iv_redirect_user) ;
								}		
								
								$result=$result.'<li ><div class="row">
										<div class="col-xs-4">
										  <div class="checkbox">
											<input id="connection_id[]" name="connection_id[]" value="'.$user->ID.'" class="styled" type="checkbox">
											<label for="checkbox1"></label>
										  </div>
										  <div class="fol-name">
											<div class="avatar"> 
											<a href="'.$reg_page_user.'?&id='.$user->user_login.'">	
											<img src="'.$iv_profile_pic_url.'" alt="image"> </div>
											</a>
											<a href="'.$reg_page_user.'?&id='.$user->user_login.'">	
											<h6>'. (get_user_meta($user->ID,'profile_name',true)!=''? get_user_meta($user->ID,'profile_name',true): $user->display_name ).'</h6>
											</a>
											<span>'.( get_user_meta($user->ID,'iv_member_type',true)=='corporate' ? get_user_meta($user->ID,'company_type',true):get_user_meta($user->ID,'designation',true) ).'</span> </div>
										</div>
										<div class="col-xs-3 n-p-r n-p-l"> <span>'. get_user_meta($user->ID,'address',true).' </span> </div>
										<div class="col-xs-3 n-p-r"> <span>
												'. sizeof($Followers).' '. esc_html__('Followers','tiger').'</span> <span>'. sizeof($Following).' '. esc_html__('Following','tiger').'</span> </div>								
										<div class="col-xs-2 n-p-r n-p-l"> <span>'. sizeof($Connections).' '.esc_html__('Connections','tiger').'</span> </div>
									  </div>
									</li>
									';
									
								
							}
						}
						
						//echo json_encode(array("result" => $result));
						echo $result;
						exit(0);	
						
				}
				public function uou_tigerp_bulk_connection_make_follow(){
					parse_str($_POST['form_data'], $form_data);	
					$current_user_id=get_current_user_id();					
					if(isset($form_data['connection_id'])){
						foreach($form_data['connection_id'] as $profile_user_id){
							
							$old_favorites= get_user_meta($profile_user_id,'_follower',true);
							$old_favorites = str_replace(get_current_user_id(), '',  $old_favorites);
							
							$new_favorites=$old_favorites.', '.get_current_user_id();
							update_user_meta($profile_user_id,'_follower',$new_favorites);						
							
							$old_favorites2=get_user_meta(get_current_user_id(),'_following', true);						
							$old_favorites2 = str_replace($profile_user_id ,'',  $old_favorites2);						
							
							$new_favorites2=$old_favorites2.', '.$profile_user_id;
							update_user_meta(get_current_user_id(),'_following',$new_favorites2);
						
						}
					}
					echo json_encode(array("msg" => 'success'));
					exit(0);		
				}
				public function uou_tigerp_bulk_follower_make_follow(){
					parse_str($_POST['form_data'], $form_data);	
					$current_user_id=get_current_user_id();					
					if(isset($form_data['connection_id'])){
						foreach($form_data['connection_id'] as $profile_user_id){
							
							$old_favorites= get_user_meta($profile_user_id,'_follower',true);
							$old_favorites = str_replace(get_current_user_id(), '',  $old_favorites);
							
							$new_favorites=$old_favorites.', '.get_current_user_id();
							update_user_meta($profile_user_id,'_follower',$new_favorites);						
							
							$old_favorites2=get_user_meta(get_current_user_id(),'_following', true);						
							$old_favorites2 = str_replace($profile_user_id ,'',  $old_favorites2);						
							
							$new_favorites2=$old_favorites2.', '.$profile_user_id;
							update_user_meta(get_current_user_id(),'_following',$new_favorites2);
						
						}
					}
					echo json_encode(array("msg" => 'success'));
					exit(0);		
				}
				public function uou_tigerp_bulk_connection_make_deleteconnection(){
					parse_str($_POST['form_data'], $form_data);	
					$current_user_id=get_current_user_id();					
					if(isset($form_data['connection_id'])){
						foreach($form_data['connection_id'] as $profile_user_id){
							
							$old_favorites= get_user_meta($profile_user_id,'_connecter',true);
							$old_favorites = str_replace($current_user_id, '',  $old_favorites);
							update_user_meta($profile_user_id,'_connecter',$old_favorites);	
							
							
							$new_favorites=$old_favorites;											
							
							$old_favorites2=get_user_meta(get_current_user_id(),'_my_connect', true);						
							$old_favorites2 = str_replace($profile_user_id ,'',  $old_favorites2);						
							
							$new_favorites2=$old_favorites2;
							update_user_meta(get_current_user_id(),'_my_connect',$new_favorites2);
						
						}
					}
					echo json_encode(array("msg" => 'success'));
					exit(0);		
				}
				public function uou_tigerp_bulk_following_make_connect(){
					parse_str($_POST['form_data'], $form_data);	
					$current_user_id=get_current_user_id();					
					if(isset($form_data['connection_id'])){
						foreach($form_data['connection_id'] as $profile_user_id){
							
							
							$old_favorites= get_user_meta($profile_user_id,'_connecter',true);
							$old_favorites = str_replace(get_current_user_id(), '',  $old_favorites);
							
							$new_favorites=$old_favorites.', '.get_current_user_id();
							update_user_meta($profile_user_id,'_connecter',$new_favorites);						
							
							$old_favorites2=get_user_meta(get_current_user_id(),'_my_connect', true);						
							$old_favorites2 = str_replace($profile_user_id ,'',  $old_favorites2);						
							
							$new_favorites2=$old_favorites2.', '.$profile_user_id;
							update_user_meta(get_current_user_id(),'_my_connect',$new_favorites2);
						
						
						
						}
					}	
					echo json_encode(array("msg" => 'success'));
					exit(0);		
				}
				public function  uou_tigerp_bulk_follower_make_deletefollower(){
					parse_str($_POST['form_data'], $form_data);	
						$current_user_id=get_current_user_id();					
						if(isset($form_data['connection_id'])){
							foreach($form_data['connection_id'] as $profile_user_id){
								
								$old_favorites= get_user_meta(get_current_user_id(),'_follower',true);
								$old_favorites = str_replace($profile_user_id, '',  $old_favorites);
								update_user_meta(get_current_user_id(),'_follower',$old_favorites);	
								
								
								$old_favorites2=get_user_meta($profile_user_id,'_following', true);						
								$old_favorites2 = str_replace(get_current_user_id() ,'',  $old_favorites2);						
								
								update_user_meta($profile_user_id,'_following',$old_favorites2);
																						
							
							}
						}	
						echo json_encode(array("msg" => 'success'));
						exit(0);		
				
				}
				public function uou_tigerp_bulk_deletebookmarker(){
						parse_str($_POST['form_data'], $form_data);	
						$current_user_id=get_current_user_id();					
						if(isset($form_data['connection_id'])){
							foreach($form_data['connection_id'] as $profile_user_id){
								
								$old_favorites= get_user_meta(get_current_user_id(),'_bookmarker',true);
								$old_favorites = str_replace($profile_user_id, '',  $old_favorites);
								update_user_meta(get_current_user_id(),'_bookmarker',$old_favorites);	
								
																					
							
							}
						}	
						echo json_encode(array("msg" => 'success'));
						exit(0);		
				}
				public function uou_tigerp_bulk_deletemybookmarker(){
						parse_str($_POST['form_data'], $form_data);	
						$current_user_id=get_current_user_id();					
						if(isset($form_data['connection_id'])){
							foreach($form_data['connection_id'] as $profile_user_id){
								
								$old_favorites= get_user_meta(get_current_user_id(),'_follower',true);
								$old_favorites = str_replace($profile_user_id, '',  $old_favorites);
								update_user_meta(get_current_user_id(),'_my_bookmark',$old_favorites);	
								
								
								$old_favorites2=get_user_meta($profile_user_id,'_bookmarker', true);						
								$old_favorites2 = str_replace(get_current_user_id() ,'',  $old_favorites2);						
								
								update_user_meta($profile_user_id,'_bookmarker',$old_favorites2);
																						
							
							}
						}	
						echo json_encode(array("msg" => 'success'));
						exit(0);							
						
							
				}
				
				
				public function  uou_tigerp_bulk_following_make_unfollow(){
						parse_str($_POST['form_data'], $form_data);	
						$current_user_id=get_current_user_id();					
						if(isset($form_data['connection_id'])){
							foreach($form_data['connection_id'] as $profile_user_id){
								
								$old_favorites= get_user_meta($profile_user_id,'_follower',true);
								$old_favorites = str_replace(get_current_user_id(), '',  $old_favorites);
								update_user_meta($profile_user_id,'_follower',$old_favorites);	
								
								
								$old_favorites2=get_user_meta(get_current_user_id(),'_following', true);						
								$old_favorites2 = str_replace($profile_user_id ,'',  $old_favorites2);						
								
								update_user_meta(get_current_user_id(),'_following',$old_favorites2);
																						
							
							}
						}	
						echo json_encode(array("msg" => 'success'));
						exit(0);		
				
				}
				
				public function uou_tigerp_save_deleteconnect(){
						parse_str($_POST['data'], $form_data);					
						$profile_user_id=$form_data['id'];
						$current_user_id=get_current_user_id();
						
						$old_favorites= get_user_meta($profile_user_id,'_connecter',true);
						$old_favorites = str_replace($current_user_id, '',  $old_favorites);
						update_user_meta($profile_user_id,'_connecter',$old_favorites);	
						
						
						$new_favorites=$old_favorites;											
						
						$old_favorites2=get_user_meta(get_current_user_id(),'_my_connect', true);						
						$old_favorites2 = str_replace($profile_user_id ,'',  $old_favorites2);						
						
						$new_favorites2=$old_favorites2;
						update_user_meta(get_current_user_id(),'_my_connect',$new_favorites2);
						
						echo json_encode(array("msg" => 'success'));
						exit(0);	
				}
				// Bookmark
				public function uou_tigerp_save_bookmark(){
						parse_str($_POST['data'], $form_data);					
						$profile_user_id=$form_data['id'];
						$current_user_id=get_current_user_id();
						
						$old_favorites= get_user_meta($profile_user_id,'_bookmarker',true);
						$old_favorites = str_replace(get_current_user_id(), '',  $old_favorites);
						
						$new_favorites=$old_favorites.', '.get_current_user_id();
						update_user_meta($profile_user_id,'_bookmarker',$new_favorites);						
						
						$old_favorites2=get_user_meta(get_current_user_id(),'_my_bookmark', true);						
						$old_favorites2 = str_replace($profile_user_id ,' ',  $old_favorites2);						
						
						$new_favorites2=$old_favorites2.', '.$profile_user_id;
						update_user_meta(get_current_user_id(),'_my_bookmark',$new_favorites2);
						
						echo json_encode(array("msg" => 'success'));
						exit(0);	
				}
				public function uou_tigerp_save_deletebookmark(){
						parse_str($_POST['data'], $form_data);					
						$profile_user_id=$form_data['id'];
						
						$old_favorites= get_user_meta($profile_user_id,'_bookmarker',true);
						$old_favorites = str_replace(get_current_user_id(), '',  $old_favorites);
						update_user_meta($profile_user_id,'_bookmarker',$old_favorites);	
							
						
						$old_favorites2=get_user_meta(get_current_user_id(),'_my_bookmark', true);						
						$old_favorites2 = str_replace($profile_user_id ,' ',  $old_favorites2);						
						
						$new_favorites2=$old_favorites2;
						update_user_meta(get_current_user_id(),'_my_bookmark',$new_favorites2);
						
						echo json_encode(array("msg" => 'success'));
						exit(0);	
				}
				// Rating********
				public function uou_tigerp_save_rating(){
					parse_str($_POST['data'], $form_data);					
					 $profile_user_id=$form_data['id'];
					 $rating_text=$form_data['rating_text'];
					 $rating_value=$form_data['rating_value'];
					
					$total_count=get_user_meta($profile_user_id,'_rating_total_count',true);					
					$old_rating= get_user_meta(get_current_user_id(),$rating_text.'_rating'.'|'.$profile_user_id,true);
					if($old_rating<1){
						$total_count=$total_count+1;
					}
					$total_rating=get_user_meta($profile_user_id,$rating_text.'_rating',true);
					$count_the_rating=get_user_meta($profile_user_id,$rating_text.'_count',true);					
					
					if($old_rating>0){
						$count_the_rating=$count_the_rating-1;
						
					}					
					
					$count_the_rating=$count_the_rating + 1 ;
					$total_rating=$total_rating-$old_rating;
					$total_rating=$total_rating+$rating_value;
								
					
					update_user_meta($profile_user_id,$rating_text.'_count',$count_the_rating);
					update_user_meta($profile_user_id,$rating_text.'_rating',$total_rating);	
					update_user_meta($profile_user_id,'_rating_total_count',$total_count);
					
					update_user_meta(get_current_user_id(),$rating_text.'_rating'.'|'.$profile_user_id,$rating_value);	
					
					echo json_encode(array("msg" => 'success'));
					exit(0);	
				}
				
				public function uou_tigerp_save_note(){
					
						parse_str($_POST['data'], $form_data);					
						$dir_id=$form_data['id'];
						$note=$form_data['note'];
						
						update_post_meta($dir_id,'_note_'.get_current_user_id(),$note);
						
						echo json_encode(array("msg" => 'success'));
						exit(0);	
				}
				public function uou_tigerp_delete_favorite(){
						parse_str($_POST['data'], $form_data);					
						$dir_id=$form_data['id'];						
						
						
						$old_favorites= get_post_meta($dir_id,'_favorites',true);
						$old_favorites = str_replace(get_current_user_id(), '',  $old_favorites);
						
						$new_favorites=$old_favorites;
						update_post_meta($dir_id,'_favorites',$new_favorites);						
						
						$old_favorites2=get_user_meta(get_current_user_id(),'_dir_favorites', true);						
						$old_favorites2 = str_replace($dir_id ,' ',  $old_favorites2);						
						
						$new_favorites2=$old_favorites2;
						update_user_meta(get_current_user_id(),'_dir_favorites',$new_favorites2);
						
						
						echo json_encode(array("msg" => 'success'));
						exit(0);
				
				}
				public function uou_tigerp_paypal_notify_url(){				
						include( wp_uou_tigerp_ABSPATH. 'inc/paypal_deal_notify_mail.php');	
						exit(0);
				}
				
				public function uou_tigerp_message_contact(){
					parse_str($_POST['form_data'], $form_data);					
					
					include( wp_uou_tigerp_ABSPATH. 'inc/contact-mail.php');	
					
					echo json_encode(array("msg" => 'Message Sent'));
					exit(0);
					
				}
				public function uou_tigerp_message_send(){
					parse_str($_POST['form_data'], $form_data);					
					
					include( wp_uou_tigerp_ABSPATH. 'inc/message-mail.php');	
					
					echo json_encode(array("msg" => 'Message Sent'));
					exit(0);
					
				}
				public function uou_tigerp_claim_send(){
					parse_str($_POST['form_data'], $form_data);					
					
					include( wp_uou_tigerp_ABSPATH. 'inc/claim-mail.php');	
					
					echo json_encode(array("msg" => 'Message Sent'));
					exit(0);
					
				}
				public function paging() {
					global $wp_query;
					
				} 
				public function check_write_access($arg=''){
					 $current_user = wp_get_current_user();
					 $userId=$current_user->ID;
					
					if(isset($current_user->roles[0]) and $current_user->roles[0]=='administrator'){
							return true;
					}		
					 $package_id=get_user_meta($userId,'uou_tigerp_package_id',true);
					 
					 $access=get_post_meta($package_id, 'uou_tigerp_package_'.$arg, true);
						if($access=='yes'){
							return true;
						}else{
							return false;
						}
				} 
				public function check_reading_access($arg='',$id=0){
					 global $post;
					  
					 $current_user = wp_get_current_user();
					 $userId=$current_user->ID;
					 if($id>0){
						$post = get_post($id);
					 }			 
					 
					 if($post->post_author==$userId){
						 return true;
					 }
					 $package_id=get_user_meta($userId,'uou_tigerp_package_id',true);					 
					 $access=get_post_meta($package_id, 'uou_tigerp_package_'.$arg, true);
					 
					 					
					  $active_module=get_option('_uou_tigerp_active_visibility'); 
					 
						if($active_module=='yes' ){		
											
								if(isset($current_user->ID) AND $current_user->ID!=''){
									$user_role= $current_user->roles[0];
									if(isset($current_user->roles[0]) and $current_user->roles[0]=='administrator'){
										return true;
									}																
								}else{							
									$user_role= 'visitor';
								}	
								
								$store_array=get_option('_iv_visibility_serialize_role');	
								//echo'<pre>';
								//echo $user_role;
								//print_r($store_array);

								 if(isset($store_array[$user_role]))
								{	
									if(in_array($arg, $store_array[$user_role])){
										return true;
									}else{
										
										return false;
									}
									
								}else{ 
										
										return false;
								
								}
								
								
							}else{
								return true;
							}
					
								
				}
				
			}
	}

if(!class_exists('WP_GeoQuery'))
{
	/**
	 * Extends WP_Query to do geographic searches
	 */
	class WP_GeoQuery extends WP_Query
	{
		private $_search_latitude = NULL;
		private $_search_longitude = NULL;
		private $_search_distance = NULL;
		private $_search_postcats = NULL;
		
		
		
		/**
		 * Constructor - adds necessary filters to extend Query hooks
		 */
		public function __construct($args = array())
		{
			// Extract Latitude
			
			if(!empty($args['lat']))
			{
				$this->_search_latitude = $args['lat'];
			}
			// Extract Longitude
			if(!empty($args['lng']))
			{
				$this->_search_longitude = $args['lng'];
			}
			if(!empty($args['distance']))
			{
				$this->_search_distance = $args['distance'];
			}
			if(!empty($args['category']))
			{
				$this->_search_postcats= $args['category'];
				
			}
			
			
			// unset lat/lng
			unset($args['lat'], $args['lng'],$args['distance']);
			
			add_filter('posts_fields', array(&$this, 'posts_fields'), 10, 2);
			add_filter('posts_join', array(&$this, 'posts_join'), 10, 2);
			add_filter('posts_where', array(&$this, 'posts_where'), 10, 2);
			add_filter('posts_groupby', array($this, 'posts_groupby'), 10, 2);
			add_filter('posts_orderby', array(&$this, 'posts_orderby'), 10, 2);
			
			parent::query($args);
			remove_filter('posts_fields', array($this, 'posts_fields'));
			remove_filter('posts_join', array($this, 'posts_join'));
			remove_filter('posts_where', array($this, 'posts_where'));
			remove_filter('posts_groupby', array($this, 'posts_groupby'));
			remove_filter('posts_orderby', array($this, 'posts_orderby'));
			
		} // END public function __construct($args = array())

		/**
		 * Selects the distance from a haversine formula
		 */	
		public function posts_groupby($where) {
			
			global $wpdb;			
			if($this->_search_longitude!=""){
				if($this->_search_postcats!=""){								
					$where .= $wpdb->prepare(" HAVING distance < %d ", $this->_search_distance); 					
				}else{								
					$where = $wpdb->prepare("{$wpdb->posts}.ID  HAVING distance < %d ", $this->_search_distance);
				}
			}
			if($this->_search_postcats!=""){
				
				//$where .= $wpdb->prepare(" HAVING distance < %d ", $this->_search_distance);
			}				
			
			
			return $where;
		  }		 
		public function posts_fields($fields)
		{
			global $wpdb;
      
			if(!empty($this->_search_latitude) && !empty($this->_search_longitude))
			{
				
				$dir_search_redius=get_option('_dir_search_redius');
				$for_option_redius='6387.7';	
				if($dir_search_redius=="Miles"){$for_option_redius='3959';}else{$for_option_redius='6387.7'; }
				
				$fields .= sprintf(", ( ".$for_option_redius."* acos( 
						cos( radians(%s) ) * 
						cos( radians( latitude.meta_value ) ) * 
						cos( radians( longitude.meta_value ) - radians(%s) ) + 
						sin( radians(%s) ) * 
						sin( radians( latitude.meta_value ) ) 
					) ) AS distance ", $this->_search_latitude, $this->_search_longitude, $this->_search_latitude);	
			
				$fields .= ", latitude.meta_value AS latitude ";
				$fields .= ", longitude.meta_value AS longitude ";
			}
			return $fields;
		} // END public function posts_join($join, $query)

		/**
		 * Makes joins as necessary in order to select lat/long metadata
		 */		
		public function posts_join($join, $query)
		{
			global $wpdb;
			if(!empty($this->_search_latitude) && !empty($this->_search_longitude)){
			$join .= " INNER JOIN {$wpdb->postmeta} AS latitude ON {$wpdb->posts}.ID = latitude.post_id ";
			$join .= " INNER JOIN {$wpdb->postmeta} AS longitude ON {$wpdb->posts}.ID = longitude.post_id ";
			//$join .= " INNER JOIN {$wpdb->postmeta} AS location ON {$wpdb->posts}.ID = location.post_id ";
			}
			
			return $join;
		} // END public function posts_join($join, $query)
		
		/**
		 * Adds where clauses to compliment joins
		 */		
		public function posts_where($where)
		{	
			if(!empty($this->_search_latitude) && !empty($this->_search_longitude)){
				$where .= ' AND latitude.meta_key="latitude" ';
				$where .= ' AND longitude.meta_key="longitude" ';
				//$where .= ' HAVING distance < '.$this->_search_distance;
			}
			
			return $where;
		} // END public function posts_where($where)
		
		/**
		 * Adds where clauses to compliment joins
		 */	
		public function posts_orderby($orderby)
		{
			if(!empty($this->_search_latitude) && !empty($this->_search_distance))
			{ 
				$orderby = " distance ASC, " . $orderby;
			}			
			return $orderby;
		} // END public function posts_orderby($orderby)
	}
}
/*
 * Creates a new instance of the BoilerPlate Class
*/
function uou_tigerpBootstrap() {
	return wp_uou_tigerp::instance();
}

uou_tigerpBootstrap(); ?>
