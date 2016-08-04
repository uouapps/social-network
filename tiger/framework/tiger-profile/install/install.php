<?php $blog_title = get_bloginfo(); 

global $wpdb;
// Create Basic Role
global $wp_roles;		

										
//$contributor_roles = $wp_roles->get_role('subscriber');		

// Role Start******************					
$role_name_new= 'basic';
$wp_roles->remove_role( $role_name_new );	
$role_display_name = 'Basic';						
//$wp_roles->add_role($role_name_new, $role_display_name, $contributor_roles->capabilities);
$wp_roles->add_role($role_name_new, $role_display_name, array(
    'read' => true, // True allows that capability, False specifically removes it.
    'upload_files' => true //last in array needs no comma!
));


// Role professional
$role_name_new= 'professional';
$wp_roles->remove_role( $role_name_new );	
$role_display_name = 'Professional';						
//$wp_roles->add_role($role_name_new, $role_display_name, $contributor_roles->capabilities);
$wp_roles->add_role($role_name_new, $role_display_name, array(
    'read' => true, // True allows that capability, False specifically removes it.
    'upload_files' => true //last in array needs no comma!
));

// Role Corporate
$role_name_new= 'corporate';
$wp_roles->remove_role( $role_name_new );	
$role_display_name = 'Corporate';						
//$wp_roles->add_role($role_name_new, $role_display_name, $contributor_roles->capabilities);
$wp_roles->add_role($role_name_new, $role_display_name, array(
    'read' => true, // True allows that capability, False specifically removes it.
    'upload_files' => true //last in array needs no comma!
));

// Role End *********************
	
include ('install-payment-option.php');
include ('install-profile-option.php');
include ('install-signup-email.php');
include ('install-order-email.php');
include ('install-reminder-email.php'); 


update_option('_iv_new_badge_day','7');
update_option('_iv_radius','50');
update_option('_bid_start_amount','.01');
//************************************* Font End Page ****************
update_option('_social_profile_install_setting','installed');

/// **** Create Page for Pricing Table******

	
	$page_title='Our Pricing';
	$page_name='our-pricing';
	$page_content='
	<h2 class="home-title" style="text-align: center; padding-top: 30px;"><strong>Join Us Now AS A Company </strong></h2>
<div class="home-subtitle">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>

<div style="text-align: center;padding-top: 40px;">[uou_tigerp_price_table_company]</div>
	<h2 class="home-title" style="text-align: center; padding-top: 30px;"><strong>Join Us Now As A Professional</strong></h2>
<div class="home-subtitle">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>
<div style="text-align: center;padding-top: 40px;">[uou_tigerp_price_table_professional]</div>
';
	$my_post_form = array(
		'post_title'    => wp_strip_all_tags( $page_title),
		'post_name'    => wp_strip_all_tags( $page_name),
		'post_content'  => $page_content,
		'post_status'   => 'publish',
		'post_author'   =>  get_current_user_id(),	
		'post_type'		=> 'page',
		);
	$newpost_id= wp_insert_post( $my_post_form );	
	update_post_meta( $newpost_id, '_wp_page_template', 'templates/full-width-page.php' );
	update_option('_uou_tigerp_price_table', $newpost_id); 		
	update_option('uou_tigerp_signup_redirect', $newpost_id);  
	
	
	// **** Create Account Form For Registration Page******
	
	$page_title='User Registration';
	$page_name='registration';
	$page_content='[uou_tigerp_form_wizard]';
	$post_iv = array(
		'post_title'    => wp_strip_all_tags( $page_title),
		'post_name'    => wp_strip_all_tags( $page_name),
		'post_content'  => $page_content,
		'post_status'   => 'publish',
		'post_author'   =>  get_current_user_id(),	
		'post_type'		=> 'page',
		);
	
	
		
	$newpost_id= wp_insert_post( $post_iv );
	update_post_meta( $newpost_id, '_wp_page_template', 'templates/full-width-page.php' );
	update_option('_uou_tigerp_registration', $newpost_id); 	
	
	/// **** Create Page for User Profile******


	$page_title='My Account';
	$page_name='my-account';
	$page_content='[uou_tigerp_profile_template]';
	$my_post_form = array(
		'post_title'    => wp_strip_all_tags( $page_title),
		'post_name'    => wp_strip_all_tags( $page_name),
		'post_content'  => $page_content,
		'post_status'   => 'publish',
		'post_author'   =>  get_current_user_id(),	
		'post_type'		=> 'page',
		);
	$newpost_id= wp_insert_post( $my_post_form );	
	update_post_meta( $newpost_id, '_wp_page_template', 'templates/full-width-page.php' );
	update_option('_uou_tigerp_profile_page', $newpost_id); 	
	
	
	
	
	
	// Login Page *******************
	$page_title='Login';
	$page_name='login';
	$page_content='[uou_tigerp_login]';
	$my_post_form = array(
		'post_title'    => wp_strip_all_tags( $page_title),
		'post_name'    => wp_strip_all_tags( $page_name),
		'post_content'  => $page_content,
		'post_status'   => 'publish',
		'post_author'   =>  get_current_user_id(),	
		'post_type'		=> 'page',
		);
	$newpost_id= wp_insert_post( $my_post_form );	
	$reg_login_page= get_permalink( $newpost_id);
	update_post_meta( $newpost_id, '_wp_page_template', 'templates/full-width-page.php' );
	update_option('_uou_tigerp_login_page', $newpost_id);
	
	/// **** Create Page for Thank you ****** 
	
	$reg_login_page= get_permalink(get_option('_uou_tigerp_login_page'));
	
	$page_title='Thank You';
	$page_name='thank-you';
	$page_content='<h3>Thank You For Your Signup. Please login <a href="'.$reg_login_page.'"> here </a>.</h3>';
	$my_post_form = array(
		'post_title'    => wp_strip_all_tags( $page_title),
		'post_name'    => wp_strip_all_tags( $page_name),
		'post_content'  => $page_content,
		'post_status'   => 'publish',
		'post_author'   =>  get_current_user_id(),	
		'post_type'		=> 'page',
		);
	$newpost_id= wp_insert_post( $my_post_form );	
	update_post_meta( $newpost_id, '_wp_page_template', 'templates/full-width-page.php' );
	update_option('_uou_tigerp_thank_you_page', $newpost_id);
	
	/// **** Create Page for Companies Directory ******
	
	$reg_login_page= get_permalink(get_option('_uou_tigerp_login_page'));
	
	$page_title='Companies';
	$page_name='companies';
	$page_content='[uou_tigerp_company_directory]';
	$my_post_form = array(
		'post_title'    => wp_strip_all_tags( $page_title),
		'post_name'    => wp_strip_all_tags( $page_name),
		'post_content'  => $page_content,
		'post_status'   => 'publish',
		'post_author'   =>  get_current_user_id(),	
		'post_type'		=> 'page',
		);
	$newpost_id= wp_insert_post( $my_post_form );	
	update_post_meta( $newpost_id, '_wp_page_template', 'templates/full-width-page.php' );
	update_option('_uou_tigerp_user_dir_page', $newpost_id);
	
	/// **** Create Page for Professionals Directory ******
	
	$reg_login_page= get_permalink(get_option('_uou_tigerp_login_page'));
	
	$page_title='Professionals';
	$page_name='professionals';
	$page_content='[uou_tigerp_professionals_directory]';
	$my_post_form = array(
		'post_title'    => wp_strip_all_tags( $page_title),
		'post_name'    => wp_strip_all_tags( $page_name),
		'post_content'  => $page_content,
		'post_status'   => 'publish',
		'post_author'   =>  get_current_user_id(),	
		'post_type'		=> 'page',
		);
	$newpost_id= wp_insert_post( $my_post_form );	
	update_post_meta( $newpost_id, '_wp_page_template', 'templates/full-width-page.php' );
	update_option('_uou_tigerp_professionals_dir_page', $newpost_id);
	
	/// **** Create Page for User public Profile****** 


	$page_title='Professional Profile';
	$page_name='professional-profile';
	$page_content='';
	$my_post_form = array(
		'post_title'    => wp_strip_all_tags( $page_title),
		'post_name'    => wp_strip_all_tags( $page_name),
		'post_content'  => $page_content,
		'post_status'   => 'publish',
		'post_author'   =>  get_current_user_id(),	
		'post_type'		=> 'page',
		);
	$newpost_id= wp_insert_post( $my_post_form );	
	update_post_meta( $newpost_id, '_wp_page_template', 'templates/profile_professional.php' );
	update_option('_iv_personal_profile_public_page', $newpost_id);
	
	// Profile
	
	$page_title='Company Profile';
	$page_name='company-profile';
	$page_content='';
	$my_post_form = array(
		'post_title'    => wp_strip_all_tags( $page_title),
		'post_name'    => wp_strip_all_tags( $page_name),
		'post_content'  => $page_content,
		'post_status'   => 'publish',
		'post_author'   =>  get_current_user_id(),	
		'post_type'		=> 'page',
		);
	$newpost_id= wp_insert_post( $my_post_form );	
	update_post_meta( $newpost_id, '_wp_page_template', 'templates/profile_corporate.php' );
	update_option('_iv_corporate_profile_public_page', $newpost_id);
	
	
	// Contact Us Page**********
	
	$page_title='Contact Us';
	$page_name='contact-us';
	$page_content='<div class="contact-us-content">
<div class="row">
<div class="col-md-6">
<h4>Our HeadQuarters</h4>
<iframe width="100%" height="300px" src="http://www.maps.ie/create-google-map/map.php?width=100%&amp;height=400&amp;hl=en&amp;q=1234%20Hydre%20Street%20San%20Francisco%20CA%2090043+(Medical%20Directory)&amp;ie=UTF8&amp;t=&amp;z=14&amp;iwloc=A&amp;output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" scrolling="no"></iframe>
<div class="row">
<div class="col-md-6">
<h6>Address Details</h6>
<div class="address-single">
<i class="fa fa-map-marker"></i>
<span>1234 Hydre Street</span>
<span>San Francisco</span>
<span>CA 90043</span>
</div>

<div class="address-single">
<i class="fa fa-phone"></i>
<span><b>Phone:</b>+123 456 789</span>
<span><b>Fax:</b>+400 445 999</span>
</div>

<div class="address-single">
<i class="fa fa-envelope-o"></i>
<span><b>Email:</b> example@example.com</span>
<span><b>Website:</b>www.yourwebsite.com</span>
</div>

</div>
<div class="col-md-6">
<h6>Opening Hours</h6>
<div class="address-single">
<i class="fa fa-clock-o"></i>
<span><b>Mo-Fri:</b> 9am - 5pm</span>
<span><b>Saturday:</b>10am - 2pm</span>
<span><b>Sunday:</b>Closed</span>
</div>
</div>
</div>
</div>

<div class="col-md-6">
<div class="contact-form">
<h4 class="contact-title">
Send Us a Message
</h4>
<div class="form-field">
[contact_us]
</div>
</div>
</div>
</div>
</div>
	';
	$my_post_form = array(
		'post_title'    => wp_strip_all_tags( $page_title),
		'post_name'    => wp_strip_all_tags( $page_name),
		'post_content'  => $page_content,
		'post_status'   => 'publish',
		'post_author'   =>  get_current_user_id(),	
		'post_type'		=> 'page',
		);
	$newpost_id= wp_insert_post( $my_post_form );	
	update_post_meta( $newpost_id, '_wp_page_template',  'templates/full-width-page.php' );
	update_option('_uou_tigerp_contact_page', $newpost_id);
	
/// **** Create Page for Home page******


	$page_title='Home';
	$page_name='home';
	$page_content='';
	$my_post_form = array(
		'post_title'    => wp_strip_all_tags( $page_title),
		'post_name'    => wp_strip_all_tags( $page_name),
		'post_content'  => $page_content,
		'post_status'   => 'publish',
		'post_author'   =>  get_current_user_id(),	
		'post_type'		=> 'page',
		);
	$newpost_id= wp_insert_post( $my_post_form );	
	update_post_meta( $newpost_id, '_wp_page_template', 'templates/home.php' );
	update_option('_uou_tigerp_home', $newpost_id); 
		
	update_option( 'page_on_front', $newpost_id);
    update_option( 'show_on_front', 'page' );
    
    
/// **** Create Page for Blog******

	$page_title='Blog';
	$page_name='blog';
	$page_content='';
	$my_post_form = array(
		'post_title'    => wp_strip_all_tags( $page_title),
		'post_name'    => wp_strip_all_tags( $page_name),
		'post_content'  => $page_content,
		'post_status'   => 'publish',
		'post_author'   =>  get_current_user_id(),	
		'post_type'		=> 'page',
		);
	$newpost_id= wp_insert_post( $my_post_form );	
	
	update_option('_uou_tigerp_blog', $newpost_id); 		
	update_option( 'page_for_posts', $newpost_id);
  
	
/// **** About Us Page ******


	$page_title='About Us';
	$page_name='about-us';
	$page_content=' 
        <article class="uou-block-7b secondary">
          <div class="css-table">
            <div class="css-table-cell content">
             
              <h1>Perspiciatis Sint Pariatur Velit Corrupti</h1>

              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Proin nibh augue, suscipit a, scelerisque sed, lacinia in, mi. Cras vel lorem. Etiam pellentesque aliquet tellus. Phasellus pharetra nulla ac diam.</p>

            </div>

            <div class="css-table-cell image has-bg-image">
              <img  src="'. tiger_IMAGE . 'blog-image-2.png" alt="">
            </div>
          </div>
        </article> <!-- end .uou-block-7b -->

		<div class="out-team-content pt30">
        <h4 class="text-center">Our Team</h4>
        <div class="row">
          <div class="col-sm-4">
            <div class="uou-block-6a rounded">
              <img src="'.tiger_IMAGE.'member-1.png" alt="">
              <h6>Jessica Walsh <span>Founder &amp; Web Designer</span></h6>
              <p>Lorem Ipsum dolor sit amet consectetur. Gravid nib velit auctor aquet sollicitudin lorem quis bibendum auctor</p>
              <ul class="social-icons">
                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
              </ul>
            </div> <!-- end .uou-block-6a -->
          </div>

          <div class="col-sm-4">
            <div class="uou-block-6a rounded">
              <img src="'.tiger_IMAGE.'member-2.png" alt="">
              <h6>Wade Jeffree <span>Sales Consultant</span></h6>
              <p>Lorem Ipsum dolor sit amet consectetur. Gravid nib velit auctor aquet sollicitudin lorem quis bibendum auctor</p>
              <ul class="social-icons">
                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
              </ul>
            </div> <!-- end .uou-block-6a -->
          </div>

          <div class="col-sm-4">
            <div class="uou-block-6a rounded">
              <img src="'.tiger_IMAGE.'member-3.jpg" alt="">
              <h6>Stefan Sagmeister <span>Web Developer</span></h6>
              <p>Lorem Ipsum dolor sit amet consectetur. Gravid nib velit auctor aquet sollicitudin lorem quis bibendum auctor</p>
              <ul class="social-icons">
                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
              </ul>
            </div> <!-- end .uou-block-6a -->
          </div>
        </div>
      </div> <!-- end our-team -->
   ';
	$my_post_form = array(
		'post_title'    => wp_strip_all_tags( $page_title),
		'post_name'    => wp_strip_all_tags( $page_name),
		'post_content'  => $page_content,
		'post_status'   => 'publish',
		'post_author'   =>  get_current_user_id(),	
		'post_type'		=> 'page',
		);
	$newpost_id= wp_insert_post( $my_post_form );	
	update_post_meta( $newpost_id, '_wp_page_template', 'templates/about-us.php' );
	update_option('_uou_tigerp_about_us', $newpost_id); 
		
  			
	
?>
