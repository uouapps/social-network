<?php
/**
 * Template Name: Home Page
 *
 */
 ?>
<?php get_header(); ?>
<?php
wp_enqueue_style('uou_tigerp-owlcarousel', tiger_CSS . 'owl.carousel.css');
wp_enqueue_style('uou_tigerp-copywriter', tiger_CSS . 'copywriter-style.css');
wp_enqueue_style('uou_tigerp-creative', tiger_CSS . 'creative-style.css');
wp_enqueue_style('uou_tigerp-profile', tiger_CSS . 'user-public-profile.css');


$iv_gateway=esc_html__('paypal-express','tiger') ;
$stripe_publishable='';
$package_amount=esc_html__('0','tiger');
$api_currency=esc_html__('USD','tiger');
$package_id=esc_html__('0','tiger');
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
                      <input type="password" name="iv_member_password"  data-validation="required" class="form-control ctrl-textbox" placeholder="<?php esc_html_e('Enter Password','tiger');?>"
                      data-validation="strength"
		                  data-validation-strength="2">
					         </div>

                      <button type="submit" id="submit_uou_tigerp_payment" name="submit_uou_tigerp_payment"><?php  esc_html_e('Register','tiger');?> </button>
                       <?php
                       if(has_action('oa_social_login')) {
                       ?>
                         <div class="login-with"><p><?php  esc_html_e('Or Register with:','tiger');?> </p><div class="social-login-plugin"><div style="overflow:hidden;width:100%;height:37px;"><?php echo do_action('oa_social_login'); ?></div></div>
                        </div>
                       <?php
  						 }
                       ?>
                    </form>
                  </div>

                  <!-- LOGIN -->
                  <div id="log-in"  class="active">
        						<form id="login_form"  action="" method="post">
        							<div class="display-hide" id="error_message">  </div>
        						  <input type="text" name="username" id="username"  placeholder="<?php  esc_html_e('User Name','tiger');?>" >
        						  <input type="password" placeholder="<?php  esc_html_e('Password','tiger');?>" name="password" id="password">
        						  <button type="button" onclick="return chack_login();"><?php  esc_html_e('Login','tiger');?> </button>
        						   <?php
        							 if(has_action('oa_social_login')) {
        							 ?>
        						  <div class="login-with"><p><?php  esc_html_e('Or login with:','tiger');?> </p> <div class="social-login-plugin"><div style="overflow:hidden;width:100%;height:37px;"><?php echo do_action('oa_social_login'); ?></div></div> </div>
        						  <?php
        							}
        						  ?>
        						  <div class="forget"><?php esc_html_e('Forgot your password?', 'tiger');?>  <a href="#."> <?php esc_html_e('Click Here', 'tiger');?></a></div>
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
    <?php
    $row2=(isset($tiger_option_data['tiger-show-page-row2'])? $tiger_option_data['tiger-show-page-row2']: '1' );
    if($row2==1){
    ?>

    <section class="services">

      <!-- SERVICES ROW -->
      <ul class="row">

        <!-- SECTION -->
        <li class="col-md-4 matchHeight">
          <div class="ser-inn">
            <h4>
              <?php
              echo (isset($tiger_option_data['tiger-home-row2-block1'])? $tiger_option_data['tiger-home-row2-block1']: esc_html__('Stay in touch with your colleagues','tiger'));
              ?>
              </h4>
            <i class="fa fa-globe"></i>
            <p>
				<?php
              echo (isset($tiger_option_data['tiger-home-row2-block1-sub'])? $tiger_option_data['tiger-home-row2-block1-sub']: esc_html__('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Proin nibh augue conseqaut nibbhi ellit ipsum consectetur.','tiger') );
              ?>
				</p>
          </div>
        </li>

        <!-- SECTION -->
        <li class="col-md-4 matchHeight">
          <div class="ser-inn">
            <h4>
              <?php
              echo (isset($tiger_option_data['tiger-home-row2-block2'])? $tiger_option_data['tiger-home-row2-block2']: esc_html__('Get the latest news in your industry','tiger'));
              ?>
              </h4>
            <i class="fa fa-book"></i>
            <p><?php
              echo (isset($tiger_option_data['tiger-home-row2-block2-sub'])? $tiger_option_data['tiger-home-row2-block2-sub']: esc_html__('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Proin nibh augue conseqaut nibbhi ellit ipsum consectetur.','tiger') );
              ?>

            </p>
          </div>
        </li>

        <!-- SECTION  -->
        <li class="col-md-4 matchHeight">
          <div class="ser-inn">
            <h4>
             <?php
              echo (isset($tiger_option_data['tiger-home-row2-block3'])? $tiger_option_data['tiger-home-row2-block3']: esc_html__('Share what’s up  with you','tiger'));
              ?>
            </h4>
            <i class="fa fa-picture-o"></i>
            <p><?php
              echo (isset($tiger_option_data['tiger-home-row2-block3-sub'])? $tiger_option_data['tiger-home-row2-block3-sub']: esc_html__('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Proin nibh augue conseqaut nibbhi ellit ipsum consectetur.','tiger') );
              ?></p>
          </div>
        </li>
      </ul>
    </section>

	<?php
	}
	?>
    <!-- PRO SECTION -->
     <?php
    $row3=(isset($tiger_option_data['tiger-show-page-row3'])? $tiger_option_data['tiger-show-page-row3']: '1' );
    if($row3==1){
		$top_banner_image3= tiger_IMAGE."pro-img-1.jpg";
		 if(isset($tiger_option_data['tiger-home-row3-image']['url']) AND $tiger_option_data['tiger-home-row3-image']['url'] !=""){
			$top_banner_image3=  $tiger_option_data['tiger-home-row3-image']['url'];
		}
    ?>
    <section class="pro-content">
      <div class="container-fluid">
        <div class="row">

          <!-- PRO IMAGE -->
          <div class="col-md-6 pro-inside" style="background:url(<?php echo $top_banner_image3;?>) center center no-repeat;"></div>

          <!-- PRO CONTENT -->
          <div class="col-md-6 pro-inside">
            <div class="position-center-center col-md-9">
              <h1>
				<?php
              echo (isset($tiger_option_data['tiger-home-row3-block'])? $tiger_option_data['tiger-home-row3-block']: esc_html__(' Interact with other professionals','tiger'));
              ?>
				 </h1>
              <p>
				<?php
              echo (isset($tiger_option_data['tiger-home-row3-block-sub'])? $tiger_option_data['tiger-home-row3-block-sub']: esc_html__(' Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.','tiger') );
              ?>
				   </p>
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
              <h1>
				<?php
              echo (isset($tiger_option_data['tiger-home-row3-block2'])? $tiger_option_data['tiger-home-row3-block2']: esc_html__('Collaborate on a project','tiger'));
              ?>
				  </h1>
              <p> <?php
              echo (isset($tiger_option_data['tiger-home-row3-block-sub2'])? $tiger_option_data['tiger-home-row3-block-sub2']: esc_html__(' Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.','tiger') );
              ?>   </p>
            </div>
          </div>
		<?php
		$top_banner_image3_2= tiger_IMAGE."pro-img-2.jpg";
		 if(isset($tiger_option_data['tiger-home-row3-image2']['url']) AND $tiger_option_data['tiger-home-row3-image2']['url'] !=""){
			$top_banner_image3_2=  $tiger_option_data['tiger-home-row3-image2']['url'];
		}
		?>
          <!-- PRO BACKGROUND -->
          <div class="col-md-6 pro-inside" style="background:url(<?php echo $top_banner_image3_2;?>) center center no-repeat;"></div>
        </div>
      </div>
    </section>

	<?php
	}
	?>
	 <?php
    $row3=(isset($tiger_option_data['tiger-show-page-row4'])? $tiger_option_data['tiger-show-page-row4']: '1' );
    if($row3==1){
		$top_banner_image4= tiger_IMAGE."app-bg.jpg";
		 if(isset($tiger_option_data['tiger-home-row4-image']['url']) AND $tiger_option_data['tiger-home-row4-image']['url'] !=""){
			$top_banner_image4=  $tiger_option_data['tiger-home-row4-image']['url'];
		}
		$top_mobile_image4= tiger_IMAGE."app-img.png";
		 if(isset($tiger_option_data['tiger-home-row4-image2']['url']) AND $tiger_option_data['tiger-home-row4-image2']['url'] !=""){
			$top_mobile_image4=  $tiger_option_data['tiger-home-row4-image2']['url'];
		}

    ?>
    <!-- APP IMAGE -->
    <section class="app-images" style="background:url(<?php echo $top_banner_image4;?>) center center no-repeat; background-size: cover;">
      <div class="container">
        <div class="row">

          <!-- TEXT -->
          <div class="col-md-6 text-center text-area">
            <h1><?php
              echo (isset($tiger_option_data['tiger-home-row4-header'])? $tiger_option_data['tiger-home-row4-header']: esc_html__('SocialMe for your Smartphone','tiger'));
              ?>
				</h1>
            <p>

				<?php
              echo (isset($tiger_option_data['tiger-home-row4-sub'])? $tiger_option_data['tiger-home-row4-sub']: esc_html__('Sed ut perspiciatis unde omnis iste natus error sit voluptatem
              accusantium doloremque laudantium, totam rem aperiam,
              eaque ipsa quae ab illo inventore veritatis et quasi architecto
              beatae vitae dicta sunt explicabo.','tiger'));
              ?>
				 </p>
            <a href="<?php  echo (isset($tiger_option_data['tiger-appstore-link'])? $tiger_option_data['tiger-appstore-link']: '');?>"><i class="fa fa-apple"></i> <?php esc_html_e('App Store', 'tiger') ?></a> </div>

          <!-- APP IMAGE -->
          <div class="col-md-6 text-right"><img src="<?php echo $top_mobile_image4;?>" alt="<?php esc_html_e('Image.', 'tiger');?>" > </div>
        </div>
      </div>
    </section>
	<?php
	}
	?>
    <!-- TESTIMONIALS -->
    <?php

         $row5=(isset($tiger_option_data['tiger-testimonial-switch'])? $tiger_option_data['tiger-testimonial-switch']: '1' );
		if($row5==1){
		$testimonials_data= (isset($tiger_option_data['tiger-our-testimonials'][0]['title'])? $tiger_option_data['tiger-our-testimonials'][0]['title']: '' );

		if($testimonials_data==''){


			$tiger_option_data['tiger-our-testimonials']=array(
					array( 'title'=>'John Kevin Mara',
							'description'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Proin nibh augue. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Proin nibh augue.',
							'url'=>'smashingmagazine.com',
							'image'=> tiger_IMAGE.'avatar-1.jpg',
				),
				array( 'title'=>'John Kevin Mara',
							'description'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Proin nibh augue. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Proin nibh augue.',
							'url'=>'smashingmagazine.com',
							'image'=> tiger_IMAGE.'member-2.png',
				),
				array( 'title'=>'John Kevin Mara',
							'description'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Proin nibh augue. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Proin nibh augue.',
							'url'=>'smashingmagazine.com',
							'image'=> tiger_IMAGE.'clients-avatar-1.jpg',
				),
			);

		}

    ?>

    <section class="clients-says">
      <div class="container">
        <h3 class="section-title"><?php
              echo (isset($tiger_option_data['tiger-testimonial-head'])? $tiger_option_data['tiger-testimonial-head']: esc_html__('What our users say','tiger'));
              ?>  </h3>
        <div class="testi">
          <div class="texti-slide">
			  <?php

			   foreach($tiger_option_data['tiger-our-testimonials'] as $t_slider){?>

				      <!-- SLide -->
						<div class="clints-text">
						  <div class="text-in">
							<p>
							<?php echo (isset($t_slider['description'])?$t_slider['description'] :''); ?>
							</p>
						  </div>
						  <div class="avatar">
							<div class=""> <a href="#"> <img src="<?php echo (isset($t_slider['image'])?$t_slider['image'] :''); ?>" alt="<?php esc_html_e('Image.', 'tiger');?>"> </a> </div>
							<div class="media-body">
							  <h6><?php echo (isset($t_slider['title'])?$t_slider['title'] :''); ?></h6>
							  <span><?php echo (isset($t_slider['url'])?$t_slider['url'] :''); ?></span> </div>
						  </div>
						</div>

					<!-- SLide -->

			<?php
			  }
			  ?>

          </div>
        </div>
      </div>
    </section>

	<?php
	}
	?>
	<?php

	   $sponsor=(isset($tiger_option_data['tiger-sponsors-switch'])? $tiger_option_data['tiger-sponsors-switch']: '1' );
    if($sponsor==1){
		$top_banner_sponsor= tiger_IMAGE."sponsor.png";
		 if(isset($tiger_option_data['tiger-home-sponsors-image']['url']) AND $tiger_option_data['tiger-home-sponsors-image']['url'] !=""){
			$top_banner_sponsor=  $tiger_option_data['tiger-home-sponsors-image']['url'];
		}
		?>

    <!-- sponsors -->
    <div class="sponsors" style="background: url('<?php echo $top_banner_sponsor;?>') top center no-repeat; background-size: cover;">
      <div class="overlay"></div>
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h3 class="section-title"> <?php
              echo (isset($tiger_option_data['tiger-sponsors-head'])? $tiger_option_data['tiger-sponsors-head']: esc_html__('Our Sponsors','tiger'));
              ?></h3>
            <div class="sponsors-slider">
				<?php

				if(isset($tiger_option_data['tiger-our-sponsors'])){
					if(sizeof($tiger_option_data['tiger-our-sponsors'] )>0){
				  foreach($tiger_option_data['tiger-our-sponsors'] as $t_slider){?>

					   <div class="item"><img src="<?php echo (isset($t_slider['image'])?$t_slider['image'] :''); ?>" alt="" style="height:90px"></div>
				<?php
					}
				  }
				}
				?>


            </div>
          </div>
        </div>
      </div>
    </div>

  <?php
	}
  ?>


  </div>
</div>
 <?php
 if(defined('wp_uou_tigerp_URLPATH')){
 wp_enqueue_script('uou_tigerp-script-signup-2-15', wp_uou_tigerp_URLPATH . 'admin/files/js/jquery.form-validator.js');

 wp_enqueue_script( 'profile-login-js', tiger_JS.'profile-login.js', array('jquery'), $ver = true, true );
 wp_localize_script( 'profile-login-js', 'tiger_data', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ),'loading_image'=> wp_uou_tigerp_URLPATH. 'admin/files/images/loader.gif' ) );

 wp_enqueue_script( 'home-registration-js', tiger_JS.'home-registration.js', array('jquery'), $ver = true, true );
 wp_localize_script( 'home-registration-js', 'tiger_data', array( 	'ajaxurl' 			=> admin_url( 'admin-ajax.php' ),
																		'loading_image'		=> wp_uou_tigerp_URLPATH.'admin/files/images/loader.gif',
																		'old_loader'		=> wp_uou_tigerp_URLPATH.'admin/files/images/old-loader.gif',
																		'iv_gateway'		=> esc_html__('paypal-express','tiger') ,
																		'stripe_publishable'=>'',
																		'package_amount'	=> esc_html__('0','tiger') ,
																		'api_currency'		=> esc_html__('USD','tiger') ,
																		'right_icon'		=> wp_uou_tigerp_URLPATH. 'admin/files/images/right_icon.png' ,
																		'wrong_icon'		=> wp_uou_tigerp_URLPATH. 'admin/files/images/wrong_16x16.png' ,

																		) );
}


 ?>
<?php get_footer();

