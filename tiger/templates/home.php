<?php
/**
 * Template Name: Home Page
 *
 */
 ?>
<?php get_header(); ?>
<?php
wp_enqueue_style('iv_directories-owlcarousel', tiger_CSS . 'owl.carousel.css');
wp_enqueue_style('iv_directories-copywriter', tiger_CSS . 'copywriter-style.css');
wp_enqueue_style('iv_directories-creative', tiger_CSS . 'creative-style.css');
wp_enqueue_style('iv_directories-profile', tiger_CSS . 'user-public-profile.css');


$iv_gateway='paypal-express';
$stripe_publishable='';
$package_amount=0;
$api_currency='USD';
$package_id=0;
?>

<div id="">

  <!-- HOME PRO-->
  <div class="home-pro">

    <!-- PRO BANNER HEAD -->
    <?php
	if(isset($tiger_option_data['tiger-show-page-banner-image']) AND $tiger_option_data['tiger-show-page-banner-image']==1){
		$top_banner_image= tiger_IMAGE."main-bg.jpg";
		 if(isset($tiger_option_data['tiger-home-banner-image']['url']) AND $tiger_option_data['tiger-home-banner-image']['url'] !=""){
			$top_banner_image=  $tiger_option_data['tiger-home-banner-image']['url'];
		}
		?>
    <div class="banr-head" style="background: url('<?php echo esc_attr($top_banner_image);?>') ">
      <div class="container">
        <div class="row">

          <!-- CONTENT -->
          <div class="col-sm-7">
            <div class="text-area">
              <div class="position-center-center col-md-10">
                <h1>
					<?php
					echo esc_attr($tiger_option_data['tiger-home-banner-text']);
					?>
					
					 
					
					</h1>
                <h6>
					<?php
					$banner_subtitle= (isset($tiger_option_data['tiger-home-banner-subtitle'])?$tiger_option_data['tiger-home-banner-subtitle']:"");
					echo esc_attr($banner_subtitle);
				  ?>
					</h6>
              </div>
            </div>
          </div>

          <!-- FORM SECTION -->
          <div class="col-sm-5">
            <div class="login-sec">

              <!-- TABS -->
              <div class="uou-tabs">
                <ul class="tabs">
                  <li><a href="#register"><?php  esc_html_e('Register Now','tiger');?></a></li>
                  <li class="active"><a href="#log-in"><?php  esc_html_e('Member Login','tiger');?></a></li>
                </ul>

                <!-- REGISTER -->
                <div class="content">
                  <div id="register">
                   	<form id="iv_home_registration" name="iv_home_registration"  action="<?php  the_permalink() ?>?package_id=<?php echo $package_id; ?>&payment_gateway=paypal&iv-submit-listing=register" method="post" >

							<label><input type="radio"  name="iv_member_type"  id="iv_member_type" value="corporate" checked data-validation-error-msg="<?php  esc_html_e(' Select user Type','tiger');?>" class="form-control ctrl-textbox"   data-validation="required" > <span><?php esc_html_e('Corporate','tiger');?> </span> </label>


							<label><input type="radio"  name="iv_member_type"  id="iv_member_type" value="professional"  data-validation-error-msg="<?php  esc_html_e(' Select user Type','tiger');?>" class="form-control ctrl-textbox"   data-validation="required"> <span><?php  esc_html_e('Professional','tiger');?></span>  </label>


                       <div>
                      <input type="text" id="full_name"  name="full_name"  data-validation="required"  placeholder="<?php esc_html_e('Display Name','tiger');?>"  data-validation-error-msg="<?php  esc_html_e('Please enter Name','tiger');?> ">
                      </div>
                      <div>
                      <input type="email" name="iv_member_email" data-validation="email"  data-validation="required" placeholder="<?php esc_html_e('Enter email address','tiger');?>" data-validation-error-msg="<?php  esc_html_e('Please enter a valid email address','tiger');?> ">
                      </div>
                      <div>
                      <input type="text"  name="iv_member_user_name"  data-validation="length alphanumeric"
data-validation-length="4-12" data-validation-error-msg="<?php  esc_html_e(' The user name has to be an alphanumeric value between 4-12 characters','tiger');?>" class="form-control ctrl-textbox" placeholder="<?php esc_html_e('Enter User Name','tiger');?>"  >
					</div>
					 <div>
                      <input type="password" name="iv_member_password"  data-validation="required" class="form-control ctrl-textbox" placeholder="<?php esc_html_e('Enter Password','tiger');?>" data-validation="strength"
		 data-validation-strength="2">
					</div>
                      <button type="submit" id="submit_iv_directories_payment" name="submit_iv_directories_payment"><?php  esc_html_e('Register','tiger');?> </button>
                      <div class="login-with"> <span><?php echo do_action('oa_social_login'); ?> </span>

                      </div>
                    </form>
                  </div>

                  <!-- LOGIN -->
                  <div id="log-in"  class="active">

						<form id="login_form"  action="" method="post">
							<div class="display-hide" id="error_message">  </div>
						  <input type="text" name="username" id="username"  placeholder="<?php  esc_html_e('User Name','tiger');?>" >
						  <input type="password" placeholder="<?php  esc_html_e('Password','tiger');?>" name="password" id="password">
						  <button type="button" onclick="return chack_login();"><?php  esc_html_e('Login','tiger');?> </button>
						  <div class="login-with"> <span><?php echo do_action('oa_social_login'); ?>Or login with:</span>
  						  <!-- <a href="#."><i class="fa fa-facebook"></i>
                </a> <a href="#."><i class="fa fa-google"></i></a>
                <a href="#."><i class="fa fa-linkedin"></i></a> -->
						   </div>
						  <div class="forget">Forgot your password? <a href="#."> Click Here</a></div>
						</form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
	
	<?php
	}
	?>
    <!-- SERVICES -->
    <section class="services">

      <!-- SERVICES ROW -->
      <ul class="row">

        <!-- SECTION -->
        <li class="col-md-4 matchHeight">
          <div class="ser-inn">
            <h4>Stay in touch with your
              colleagues</h4>
            <i class="fa fa-globe"></i>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Proin nibh augue conseqaut nibbhi ellit ipsum consectetur.</p>
          </div>
        </li>

        <!-- SECTION -->
        <li class="col-md-4 matchHeight">
          <div class="ser-inn">
            <h4>Get the latest news
              in your industry</h4>
            <i class="fa fa-book"></i>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Proin nibh augue conseqaut nibbhi ellit ipsum consectetur.</p>
          </div>
        </li>

        <!-- SECTION  -->
        <li class="col-md-4 matchHeight">
          <div class="ser-inn">
            <h4>Share what’s up
              with you</h4>
            <i class="fa fa-picture-o"></i>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Proin nibh augue conseqaut nibbhi ellit ipsum consectetur.</p>
          </div>
        </li>
      </ul>
    </section>

    <!-- PRO SECTION -->
    <section class="pro-content">
      <div class="container-fluid">
        <div class="row">

          <!-- PRO IMAGE -->
          <div class="col-md-6 pro-inside" style="background:url(<?php echo tiger_IMAGE;?>pro-img-1.jpg) center center no-repeat;"></div>

          <!-- PRO CONTENT -->
          <div class="col-md-6 pro-inside">
            <div class="position-center-center col-md-9">
              <h1>Interact with other
                professionals</h1>
              <p> Sed ut perspiciatis unde omnis iste natus error sit voluptatem
                accusantium doloremque laudantium, totam rem aperiam,
                eaque ipsa quae ab illo inventore veritatis et quasi architecto
                beatae vitae dicta sunt explicabo. </p>
            </div>
          </div>
        </div>
      </div>

      <!-- PRO SECTION -->
      <div class="container-fluid">
        <div class="row">

          <!-- PRO TEXT -->
          <div class="col-md-6 pro-inside">
            <div class="position-center-center col-md-9">
              <h1>Collaborate on a
                project</h1>
              <p> Sed ut perspiciatis unde omnis iste natus error sit voluptatem
                accusantium doloremque laudantium, totam rem aperiam,
                eaque ipsa quae ab illo inventore veritatis et quasi architecto
                beatae vitae dicta sunt explicabo. </p>
            </div>
          </div>

          <!-- PRO BACKGROUND -->
          <div class="col-md-6 pro-inside" style="background:url(<?php echo tiger_IMAGE;?>pro-img-2.jpg) center center no-repeat;"></div>
        </div>
      </div>
    </section>

    <!-- APP IMAGE -->
    <section class="app-images">
      <div class="container">
        <div class="row">

          <!-- TEXT -->
          <div class="col-md-6 text-center text-area">
            <h1>SocialMe for your
              Smartphone</h1>
            <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem
              accusantium doloremque laudantium, totam rem aperiam,
              eaque ipsa quae ab illo inventore veritatis et quasi architecto
              beatae vitae dicta sunt explicabo. </p>
            <a href="#."><i class="fa fa-apple"></i> App Store</a> </div>

          <!-- APP IMAGE -->
          <div class="col-md-6 text-right"><img src="<?php echo tiger_IMAGE;?>app-img.png" alt="" > </div>
        </div>
      </div>
    </section>

    <!-- TESTIMONIALS -->
    <section class="clients-says">
      <div class="container">
        <h3 class="section-title">what our users say </h3>
        <div class="testi">
          <div class="texti-slide">
            <!-- SLide -->
            <div class="clints-text">
              <div class="text-in">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Proin nibh augue. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Proin nibh augue.</p>
              </div>
              <div class="avatar">
                <div class=""> <a href="#"> <img src="<?php echo tiger_IMAGE;?>clients-avatar-1.jpg" alt=""> </a> </div>
                <div class="media-body">
                  <h6>John Kevin Mara</h6>
                  <span>smashingmagazine.com</span> </div>
              </div>
            </div>

            <!-- SLide -->
            <div class="clints-text">
              <div class="text-in">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Proin nibh augue. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Proin nibh augue.</p>
              </div>
              <div class="avatar">
                <div class=""> <a href="#"> <img src="<?php echo tiger_IMAGE;?>clients-avatar-1.jpg" alt=""> </a> </div>
                <div class="media-body">
                  <h6>John Kevin Mara</h6>
                  <span>smashingmagazine.com</span> </div>
              </div>
            </div>

            <!-- SLide -->
            <div class="clints-text">
              <div class="text-in">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Proin nibh augue. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Proin nibh augue.</p>
              </div>
              <div class="avatar">
                <div class=""> <a href="#"> <img src="<?php echo tiger_IMAGE;?>clients-avatar-1.jpg" alt=""> </a> </div>
                <div class="media-body">
                  <h6>John Kevin Mara</h6>
                  <span>smashingmagazine.com</span> </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- sponsors -->
    <div class="sponsors" style="background: url('<?php echo tiger_IMAGE;?>sponsor.png') top center no-repeat; background-size: cover;">
      <div class="overlay"></div>
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h3 class="section-title">Our Sponsors</h3>
            <div class="sponsors-slider">
              <div class="item"><img src="<?php echo tiger_IMAGE;?>sponsor_logo1.png" alt="" class="img-responsive"></div>
              <div class="item"><img src="<?php echo tiger_IMAGE;?>sponsor_logo2.png" alt="" class="img-responsive"></div>
              <div class="item"><img src="<?php echo tiger_IMAGE;?>sponsor_logo3.png" alt="" class="img-responsive"></div>
              <div class="item"><img src="<?php echo tiger_IMAGE;?>sponsor_logo4.png" alt="" class="img-responsive"></div>
              <div class="item"><img src="<?php echo tiger_IMAGE;?>sponsor_logo5.png" alt="" class="img-responsive"></div>
              <div class="item"><img src="<?php echo tiger_IMAGE;?>sponsor_logo6.png" alt="" class="img-responsive"></div>
              <div class="item"><img src="<?php echo tiger_IMAGE;?>sponsor_logo4.png" alt="" class="img-responsive"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
 <?php
 wp_enqueue_script('iv_directories-script-signup-2-15', wp_iv_directories_URLPATH . 'admin/files/js/jquery.form-validator.js');

 wp_enqueue_script( 'profile-login-js', tiger_JS.'profile-login.js', array('jquery'), $ver = true, true );
 wp_localize_script( 'profile-login-js', 'tiger_data', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ),'loading_image'=> wp_iv_directories_URLPATH. 'admin/files/images/loader.gif' ) );

 wp_enqueue_script( 'home-registration-js', tiger_JS.'home-registration.js', array('jquery'), $ver = true, true );
 wp_localize_script( 'home-registration-js', 'tiger_data', array( 	'ajaxurl' 			=> admin_url( 'admin-ajax.php' ),
																		'loading_image'		=> wp_iv_directories_URLPATH.'admin/files/images/loader.gif',
																		'old_loader'		=> wp_iv_directories_URLPATH.'admin/files/images/old-loader.gif',
																		'iv_gateway'		=>$iv_gateway,
																		'stripe_publishable'=>$stripe_publishable,
																		'package_amount'	=> $package_amount,
																		'api_currency'		=>$api_currency ,
																		'right_icon'		=> wp_iv_directories_URLPATH. 'admin/files/images/right_icon.png' ,
																		'wrong_icon'		=> wp_iv_directories_URLPATH. 'admin/files/images/wrong_16x16.png' ,
																		'Hide_Coupon'=> __('Hide Coupon','tiger'),
																		'have_Coupon'=> __('Have a coupon?','tiger'),

																		) );


 ?>
<?php get_footer();

