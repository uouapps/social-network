<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package WordPress
 * @subpackage simple builder
 * @since 1.0
 */
?>
<?php 

$chameleon_option_data =get_option('chameleon_option_data'); 

$chameleon_option_data['chameleon-multi-footer-image']=1;
$chameleon_option_data['chameleon-multi-bottom-image']=1;
?>
<!-- Start Footer Switch -->

<?php if($chameleon_option_data['chameleon-footer-switch']){?>

<!-- Start chameleon Multifooter -->

<!-- Start Footer 7 -->
<?php if(isset($chameleon_option_data['chameleon-multi-footer-image'])&&($chameleon_option_data['chameleon-multi-footer-image']==1)){?>
  <!-- uou block 4e -->
  <div class="uou-block-4e">
    <div class="container">
      <div class="row">
		  <!-- Contact us section -->
		  <div class="col-md-3 col-sm-6">
			  <?php
							  /** This filter is documented in wp-includes/default-widgets.php */
							  
						  
						$bg_image_default = SB_IMAGE.'footer-map-bg.png';
						$title = 	(isset($chameleon_option_data['chameleon-title-contact']) ? $chameleon_option_data['chameleon-title-contact'] :'');
						$logo = 	(isset($chameleon_option_data['chameleon-footer-icon']) ? $chameleon_option_data['chameleon-footer-icon']['url'] : '' );
						$address = (isset($chameleon_option_data['chameleon-address-contact']) ? $chameleon_option_data['chameleon-address-contact'] :'');
						$phone_no = (isset($chameleon_option_data['chameleon-phone-contact']) ? $chameleon_option_data['chameleon-phone-contact'] :'' );
						$email = 	(isset($chameleon_option_data['chameleon-email-contact']) ? $chameleon_option_data['chameleon-email-contact']:'' );
						$bg_image = (isset($chameleon_option_data['chameleon-contact-bg-image']['url']) ? $chameleon_option_data['chameleon-contact-bg-image']['url']: $bg_image_default); 
						if($bg_image==''){$bg_image=$bg_image_default;}
						
						?>

						<!-- <div class="col-md-3 col-sm-6"> -->

				

						<?php if ( ! empty( $logo ) ) { ?>

							<a href="#" class="logo"><img src="<?php echo esc_url($logo); ?>" alt=""></a>

						<?php } ?>

							

							<?php 

							

							if ( ! empty( $bg_image ) ) {

								echo '<ul class="contact-info has-bg-image contain" data-bg-image="'.$bg_image.'">'; 

							}

							else{

								echo '<ul class="contact-info">'; 

							}



							if ( ! empty( $address ) ) {

								echo '<li><i class="fa fa-map-marker"></i><address>'.$address.'</address></li>';

							} 



							if ( ! empty( $phone_no ) ) {

								echo '<li><i class="fa fa-phone"></i><a href="tel:#">'.$phone_no.'</a></li>';

							} 



							if ( ! empty( $email ) ) {

								echo '<li><i class="fa fa-envelope"></i><a href="mailto:">'.$email.'</a></li>';

							} 


							?>

						</ul>
		  </div>	  

         <!-- Start left footer sidebar -->

    <?php   if($chameleon_option_data['chameleon-left-footer-switch']){ ?>

            <?php

            if(is_active_sidebar('chameleon_footer_left_sidebar')):

				dynamic_sidebar('chameleon_footer_left_sidebar');

            endif;  
            
            ?>
    
    <?php } ?>

      </div>
    </div>
  </div> <!-- end .uou-block-4e -->
  <?php } ?> 


<?php } ?> 

<!-- Start Bottom 7 -->
<?php if(isset($chameleon_option_data['chameleon-multi-bottom-image'])&&($chameleon_option_data['chameleon-multi-bottom-image']==1)){?>
  <!-- uou block 4b -->
  <div class="uou-block-4a secondary">
    <div class="container">

      <?php if($chameleon_option_data['chameleon-show-footer-copyrights']){?>
      <p>
        <?php if(isset($chameleon_option_data['chameleon-copyright-text'])&&!empty($chameleon_option_data['chameleon-copyright-text'])) {?>
        <?php echo esc_attr($chameleon_option_data['chameleon-copyright-text']); ?> 
        <?php } ?> 
        <?php bloginfo('name'); ?>.  
        <?php if(isset($chameleon_option_data['chameleon-after-copyright-text'])&&!empty($chameleon_option_data['chameleon-after-copyright-text'])) {?>
        <?php echo esc_attr($chameleon_option_data['chameleon-after-copyright-text']); ?>
        <?php } ?>
        <?php if($chameleon_option_data['chameleon-show-footer-credits']) {?>
        <?php echo '<a href="http://themeforest.net/user/uouapps">UOUAPPS</a>'; ?>
        <?php } ?>
        
      </p>
      <?php } ?>

     
    <!-- Start sccial Profile -->

    <?php if($chameleon_option_data['chameleon-social-profile']){?>

      <ul class="social-icons">

        <?php if(isset($chameleon_option_data['chameleon-facebook-profile']) && !empty($chameleon_option_data['chameleon-facebook-profile'])) : ?>
        <li><a  href="http://<?php echo esc_url($chameleon_option_data['chameleon-facebook-profile']);?> "><i class="fa fa-facebook"></i></a></li>
        <?php endif; ?>

        <?php if(isset($chameleon_option_data['chameleon-twitter-profile']) && !empty($chameleon_option_data['chameleon-twitter-profile'])) : ?>
        <li><a  href="http://<?php echo esc_url($chameleon_option_data['chameleon-twitter-profile']);?> "><i class="fa fa-twitter"></i></a></li>
        <?php endif; ?>

        <?php if(isset($chameleon_option_data['chameleon-google-profile']) && !empty($chameleon_option_data['chameleon-google-profile'])) : ?>
        <li><a  href="http://<?php echo esc_url($chameleon_option_data['chameleon-google-profile']);?> "><i class="fa fa-google"></i></a></li>
        <?php endif; ?>

        <?php if(isset($chameleon_option_data['chameleon-linkedin-profile']) && !empty($chameleon_option_data['chameleon-linkedin-profile'])) : ?>
        <li><a  href="http://<?php echo esc_url($chameleon_option_data['chameleon-linkedin-profile']);?> "><i class="fa fa-linkedin"></i></a></li>
        <?php endif; ?>

        <?php if(isset($chameleon_option_data['chameleon-pinterest-profile']) && !empty($chameleon_option_data['chameleon-pinterest-profile'])) : ?>
        <li><a  href="http://<?php echo esc_url($chameleon_option_data['chameleon-pinterest-profile']);?> "><i class="fa fa-pinterest"></i></a></li>
        <?php endif; ?>

      </ul>

    <?php }?>
    <!-- end of social profile -->

    </div>
  </div> 
  <!-- end .uou-block-4a -->
    <?php } ?> 

</div>

<?php wp_footer(); ?>   

</body>
</html>
