    <div class="box-shadow-for-ui">
      <div class="uou-block-2a">
        <div class="container">
			<?php $tiger_option_data =get_option('tiger_option_data'); ?>
			<?php
        $top_logo_image= tiger_IMAGE."tiger-logo.png";
        if(isset($tiger_option_data['tiger-header-icon']['url']) AND $tiger_option_data['tiger-header-icon']['url']!=""):
			$top_logo_image=esc_url($tiger_option_data['tiger-header-icon']['url']);
         endif; ?>
         
          <a href="<?php echo esc_url(site_url('/')); ?>" class="logo"> 
         <img src="<?php echo esc_attr($top_logo_image); ?>" alt="<?php esc_html_e( 'image', 'tiger' ); ?>">
          
           </a>
          <a href="#" class="mobile-sidebar-button mobile-sidebar-toggle"><span></span></a>
			
			<?php $tiger_option_data =get_option('tiger_option_data'); ?>
            <?php
			  $tigertopphone='(02) 123-456-7890';
			 if(isset($tiger_option_data['tiger-top-phone']) AND $tiger_option_data['tiger-top-phone']!=""):
				$tigertopphone=$tiger_option_data['tiger-top-phone'];
			 endif;
         
			?>
          <div class="contact">
            <span><?php esc_html_e( 'Call Us:', 'tiger' ); ?>  </span>
            <a href="tel:<?php echo $tigertopphone;?>"><?php echo $tigertopphone;?></a>
          </div>
        </div>
      </div> <!-- end .uou-block-2a -->
    </div>
