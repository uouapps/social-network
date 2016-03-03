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
// Role Personal
$role_name_new= 'personal';
$wp_roles->remove_role( $role_name_new );	
$role_display_name = 'Personal';						
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


/// **** Create Page for Pricing Table******


	$page_title='Our Pricing';
	$page_name='our-pricing';
	$page_content='[iv_directories_price_table]';
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
	update_option('_iv_directories_price_table', $newpost_id); 		
	update_option('iv_directories_signup_redirect', $newpost_id);  
	
	// **** Create Account Form For Registration Page******
	
	$page_title='User Registration';
	$page_name='registration';
	$page_content='[iv_directories_form_wizard]';
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
	update_option('_iv_directories_registration', $newpost_id); 	
	
	/// **** Create Page for User Profile******


	$page_title='My Account';
	$page_name='my-account';
	$page_content='[iv_directories_profile_template]';
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
	update_option('_iv_directories_profile_page', $newpost_id); 	
	
	/// **** Create Page for User public Profile****** c c c c c c c   c


	$page_title='Profile Public';
	$page_name='profile-public';
	$page_content='[iv_directories_profile_public]';
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
	update_option('_iv_directories_profile_public_page', $newpost_id);
	
	
	
	// Login Page *******************
	$page_title='Login';
	$page_name='login';
	$page_content='[iv_directories_login]';
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
	update_option('_iv_directories_login_page', $newpost_id);
	
	/// **** Create Page for Thank you ****** 
	
	$reg_login_page= get_permalink(get_option('_iv_directories_login_page'));
	
	$page_title='Thank You';
	$page_name='thank-you';
	$page_content='<h3>Thank You For Your Signup & Payment. Please login <a href="'.$reg_login_page.'"> here </a>.</h3>';
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
	update_option('_iv_directories_thank_you_page', $newpost_id);
	
	/// **** Create Page for User Directory ******
	
	$reg_login_page= get_permalink(get_option('_iv_directories_login_page'));
	
	$page_title='User Directory';
	$page_name='user-directory';
	$page_content='[iv_directories_user_directory]';
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
	update_option('_iv_directories_user_dir_page', $newpost_id);
	
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
	update_option('_iv_directories_contact_page', $newpost_id);
	
/// **** Create Page for Home page******


	$page_title='Home';
	$page_name='home';
	$page_content='<p class="home-title" style="text-align: center;"><strong>Hospital Categories</strong></p>
<p class="home-subtitle">With over 5000 doctors and experts in the healthcare field medical directory provides a listing of all doctors 
across a wide variety if medical fields</p>
<p style="text-align: center;">[hospital_categories]</p>
<p  class="home-title" style="text-align: center;"><strong>Doctor Categories</strong></p>
<p  class="home-subtitle" style="text-align: center;">
Find the right doctor within the closest hospital across a wide range of medical fields including neurosurgery
</p>
<p style="text-align: center;">[doctor_categories]</p>
<p class="home-title" style="text-align: center;"><strong>Hospital Featured Listing</strong></p>
<p style="text-align: center;">[hospital_featured]</p>

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
	update_post_meta( $newpost_id, '_wp_page_template', 'templates/home.php' );
	update_option('_iv_directories_home', $newpost_id); 
		
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
	
	update_option('_iv_directories_blog', $newpost_id); 		
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
              <img  src="'. SB_IMAGE . 'blog-image-2.png" alt="">
            </div>
          </div>
        </article> <!-- end .uou-block-7b -->

		<div class="out-team-content pt30">
        <h4 class="text-center">Our Team</h4>
        <div class="row">
          <div class="col-sm-4">
            <div class="uou-block-6a rounded">
              <img src="'.SB_IMAGE.'member-1.png" alt="">
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
              <img src="'.SB_IMAGE.'member-2.png" alt="">
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
              <img src="'.SB_IMAGE.'member-3.jpg" alt="">
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
	update_option('_iv_directories_about_us', $newpost_id); 
		
  			
	
?>
