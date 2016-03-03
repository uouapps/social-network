    <div class="box-shadow-for-ui">
      <div class="uou-block-2b border-bottom">
        <div class="container">
        <?php global $chameleon_option_data; ?>

        <?php $top_logo_image= SB_IMAGE."chilepro-logo.png";              
        if(isset($chameleon_option_data['chameleon-header-icon']['url']) AND $chameleon_option_data['chameleon-header-icon']['url']!=""):         
			$top_logo_image=esc_url($chameleon_option_data['chameleon-header-icon']['url']); 
         endif; ?> 
         <a href="<?php echo esc_url(site_url('/')); ?>" class="logo"> <img src="<?php echo $top_logo_image; ?>" alt=""> </a>  
              
        <a href="#" class="mobile-sidebar-button mobile-sidebar-toggle"><span></span></a>

      <nav class="nav">

        <?php 

          $defaults = array(
            'theme_location'  => 'primary_navigation_right',
            'menu'            => '',
            'container'       => '',
            'container_class' => '',
            'container_id'    => '',
            'menu_class'      => 'sf-menu active',
            'menu_id'         => '',
            'echo'            => true,            
            'before'          => '',
            'after'           => '',
            'link_before'     => '',
            'link_after'      => '',
            'items_wrap'      => '<ul class="sf-menu %2$s"> %3$s </ul>',
            'depth'           => 0,
            'fallback_cb'     => 'chameleon_nav_walker::fallback',
            'walker'          => new chameleon_nav_walker()
          );

          wp_nav_menu( $defaults );

        ?>
      </nav>
    </div>
  </div> <!-- end .uou-block-2b -->

</div>

