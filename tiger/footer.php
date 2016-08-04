</div>
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

$tiger_option_data =get_option('tiger_option_data');

$tiger_option_data['tiger-multi-footer-image']=1;
$tiger_option_data['tiger-multi-bottom-image']=1;
?>
<!-- Start Footer Switch -->

<?php if($tiger_option_data['tiger-footer-switch']){?>

<!-- Start tiger Multifooter -->

<!-- Start Footer 7 -->
<?php if(isset($tiger_option_data['tiger-multi-footer-image'])&&($tiger_option_data['tiger-multi-footer-image']==1)){?>
  <!-- uou block 4e -->
  <div class="uou-block-4e">
    <div class="container">
      <div class="row">
		  <!-- Contact us section -->
		  <div class="col-md-3 col-sm-6">
			  <?php
							  /** This filter is documented in wp-includes/default-widgets.php */


						$bg_image_default = tiger_IMAGE.'footer-map-bg.png';
						$title = 	(isset($tiger_option_data['tiger-title-contact']) ? $tiger_option_data['tiger-title-contact'] :'');
						$logo = 	(isset($tiger_option_data['tiger-footer-icon']['url']) ? $tiger_option_data['tiger-footer-icon']['url'] : '' );
						$address = (isset($tiger_option_data['tiger-address-contact']) ? $tiger_option_data['tiger-address-contact'] :'');
						$phone_no = (isset($tiger_option_data['tiger-phone-contact']) ? $tiger_option_data['tiger-phone-contact'] :'' );
						$email = 	(isset($tiger_option_data['tiger-email-contact']) ? $tiger_option_data['tiger-email-contact']:'' );
						$bg_image = (isset($tiger_option_data['tiger-contact-bg-image']['url']) ? $tiger_option_data['tiger-contact-bg-image']['url']: $bg_image_default);
						if($bg_image==''){$bg_image=$bg_image_default;}

						?>

						<!-- <div class="col-md-3 col-sm-6"> -->



						<?php if ( ! empty( $logo ) ) { ?>

							<a href="#" class="logo"><img src="<?php echo esc_url($logo); ?>" alt="<?php esc_html_e( 'image', 'tiger' ); ?>"></a>

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

    <?php   if(isset($tiger_option_data['tiger-left-footer-switch'])){ ?>

            <?php

            if(is_active_sidebar('tiger_footer_left_sidebar')):

				dynamic_sidebar('tiger_footer_left_sidebar');

            endif;

            ?>

    <?php } ?>

      </div>
    </div>
  </div> <!-- end .uou-block-4e -->
  <?php } ?>


<?php } ?>

<!-- Start Bottom 7 -->
<?php if(isset($tiger_option_data['tiger-multi-bottom-image'])&&($tiger_option_data['tiger-multi-bottom-image']==1)){?>
  <!-- uou block 4b -->
  <div class="uou-block-4a secondary">
    <div class="container">

      <?php if(isset($tiger_option_data['tiger-show-footer-copyrights'])){?>
      <p>
        <?php if(isset($tiger_option_data['tiger-copyright-text'])&&!empty($tiger_option_data['tiger-copyright-text'])) {?>
        <?php
				if(isset($tiger_option_data['tiger-copyright-link']) && $tiger_option_data['tiger-copyright-link']!='' ){?>

					<a  href="http://<?php echo esc_html($tiger_option_data['tiger-copyright-link']);?> "><?php echo esc_html($tiger_option_data['tiger-copyright-text']);?></i></a>
					<?php
				}else{
					echo esc_html($tiger_option_data['tiger-copyright-text']);
				}



				?>
        <?php } ?>
        <?php bloginfo('name'); ?>.
        <?php if(isset($tiger_option_data['tiger-after-copyright-text'])&&!empty($tiger_option_data['tiger-after-copyright-text'])) {?>
        <?php echo esc_html($tiger_option_data['tiger-after-copyright-text']); ?>
        <?php } ?>
         <?php if(isset($tiger_option_data['tiger-show-footer-credits']) && $tiger_option_data['tiger-show-footer-credits']==1) {				
			?>
        <?php echo '<a href="http://themeforest.net/user/uouapps">UOUAPPS</a>'; ?>
        <?php } ?>
     
      </p>
      <?php } ?>


    <!-- Start sccial Profile -->

    <?php if(isset($tiger_option_data['tiger-social-profile'])){?>

      <ul class="social-icons">

        <?php if(isset($tiger_option_data['tiger-facebook-profile']) && !empty($tiger_option_data['tiger-facebook-profile'])) : ?>
        <li><a  href="http://<?php echo esc_url($tiger_option_data['tiger-facebook-profile']);?> "><i class="fa fa-facebook"></i></a></li>
        <?php endif; ?>

        <?php if(isset($tiger_option_data['tiger-twitter-profile']) && !empty($tiger_option_data['tiger-twitter-profile'])) : ?>
        <li><a  href="http://<?php echo esc_url($tiger_option_data['tiger-twitter-profile']);?> "><i class="fa fa-twitter"></i></a></li>
        <?php endif; ?>

        <?php if(isset($tiger_option_data['tiger-google-profile']) && !empty($tiger_option_data['tiger-google-profile'])) : ?>
        <li><a  href="http://<?php echo esc_url($tiger_option_data['tiger-google-profile']);?> "><i class="fa fa-google"></i></a></li>
        <?php endif; ?>

        <?php if(isset($tiger_option_data['tiger-linkedin-profile']) && !empty($tiger_option_data['tiger-linkedin-profile'])) : ?>
        <li><a  href="http://<?php echo esc_url($tiger_option_data['tiger-linkedin-profile']);?> "><i class="fa fa-linkedin"></i></a></li>
        <?php endif; ?>

        <?php if(isset($tiger_option_data['tiger-pinterest-profile']) && !empty($tiger_option_data['tiger-pinterest-profile'])) : ?>
        <li><a  href="http://<?php echo esc_url($tiger_option_data['tiger-pinterest-profile']);?> "><i class="fa fa-pinterest"></i></a></li>
        <?php endif; ?>

      </ul>

    <?php }?>
    <!-- end of social profile -->

    </div>
  </div>
  <!-- end .uou-block-4a -->
    <?php } ?>



<?php wp_footer(); ?>

</body>
</html>
