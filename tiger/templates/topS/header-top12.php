    <div class="box-shadow-for-ui">
      <div class="uou-block-2d">
        <div class="container">
			<?php $tiger_option_data =get_option('tiger_option_data'); ?>
			<?php
        $top_logo_image= tiger_IMAGE."tiger-logo.png";
        if(isset($tiger_option_data['tiger-header-icon']['url']) AND $tiger_option_data['tiger-header-icon']['url']!=""):
			$top_logo_image=esc_url($tiger_option_data['tiger-header-icon']['url']);
         endif; ?>
         
          <a href="<?php echo esc_url(site_url('/')); ?>" class="logo">  <img src="<?php echo esc_attr($top_logo_image); ?>" alt="<?php esc_html_e( 'image', 'tiger' ); ?>"> </a>
          <a href="#" class="mobile-sidebar-button mobile-sidebar-toggle"><span></span></a>
        </div>
      </div> <!-- end .uou-block-2d -->
    </div>
