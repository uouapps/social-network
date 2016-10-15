    <div class="uou-block-1c">
	   <div class="container">
		   <?php
        $top_logo_image= tiger_IMAGE."tiger-logo.png";
        if(isset($tiger_option_data['tiger-header-icon']['url']) AND $tiger_option_data['tiger-header-icon']['url']!=""):
			$top_logo_image=esc_url($tiger_option_data['tiger-header-icon']['url']);
         endif; ?>
         
      <a href="<?php echo esc_url(site_url('/')); ?>" class="logo"> 
      <img src="<?php echo esc_attr($top_logo_image); ?>" alt="<?php esc_html_e( 'image', 'tiger' ); ?>"> </a>

      <div class="search">
        <?php get_search_form(); ?>
      </div>
      	<?php get_template_part('templates/header','socialButton'); ?>  
    </div>
  </div> <!-- end .uou-block-1a -->

