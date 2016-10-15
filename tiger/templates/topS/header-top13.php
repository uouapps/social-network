    <div class="box-shadow-for-ui">
      <div class="uou-block-2d">
        <div class="container">
          <div class="contact">
			  <?php
        $top_logo_image= tiger_IMAGE."tiger-logo.png";
        if(isset($tiger_option_data['tiger-header-icon']['url']) AND $tiger_option_data['tiger-header-icon']['url']!=""):
			$top_logo_image=esc_url($tiger_option_data['tiger-header-icon']['url']);
         endif; ?>
         
         <?php $tiger_option_data =get_option('tiger_option_data'); ?>
            <?php
			  $tigertopphone='(02) 123-456-7890';
			 if(isset($tiger_option_data['tiger-top-phone']) AND $tiger_option_data['tiger-top-phone']!=""):
				$tigertopphone=$tiger_option_data['tiger-top-phone'];
			 endif;
         
			?>
			
            <span>Call Us:</span>
             <a href="tel:<?php echo $tigertopphone;?>"><?php echo $tigertopphone;?></a>
          </div>

          <a href="<?php echo esc_url(site_url('/')); ?>" class="logo"> <img src="<?php echo esc_attr($top_logo_image); ?>" alt="<?php esc_html_e( 'image', 'tiger' ); ?>"> </a>
          <a href="#" class="mobile-sidebar-button mobile-sidebar-toggle"><span></span></a>

          <a href="#" class="cart"><i class="fa fa-shopping-cart"></i> <?php esc_html_e( 'Shopping Cart', 'tiger' ); ?>   (0)</a>
        </div>
      </div> <!-- end .uou-block-2d -->
    </div>
