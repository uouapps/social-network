    <div class="box-shadow-for-ui">
      <div class="uou-block-2b">
        <div class="container">
        <?php $tiger_option_data =get_option('tiger_option_data'); ?>
        <?php
        $top_logo_image= tiger_IMAGE."tiger-logo.png";
        if(isset($tiger_option_data['tiger-header-icon']['url']) AND $tiger_option_data['tiger-header-icon']['url']!=""):
			$top_logo_image=esc_url($tiger_option_data['tiger-header-icon']['url']);
         endif; ?>
         <a href="<?php echo esc_url(site_url('/')); ?>" class="logo"> <img src="<?php echo esc_attr($top_logo_image); ?>" alt="<?php esc_html_e( 'image', 'tiger' ); ?>"> </a>



        <a href="#" class="mobile-sidebar-button mobile-sidebar-toggle"><span></span></a>

          <nav class="nav">
        <?php

          $defaults = array(
            'theme_location'  => 'primary_navigation_right',
            'menu'            => '',
            'container'       => '',
            'container_class' => '',
            'container_id'    => '',
            'menu_class'      => 'sf-menu',
            'menu_id'         => '',
            'echo'            => true,
            'before'          => '',
            'after'           => '',
            'link_before'     => '',
            'link_after'      => '',
            'items_wrap'      => '<ul class="sf-menu %2$s"> %3$s </ul>',
            'depth'           => 0,
            'fallback_cb'     => 'tiger_nav_walker::fallback',
            'walker'          => new tiger_nav_walker()
          );

          wp_nav_menu( $defaults );


			?>
          </nav>
          <?php
			  if ( !has_nav_menu( 'primary_navigation_right' ) AND !has_nav_menu( 'primary_navigation_left' )  ) {

					 $defaults = array(
					'theme_location'  => '',
					//'menu'            => 'primary-menu',
					'container'       => 'ul',
					'container_class' => '',
					'container_id'    => '',
					'menu_class'      => 'sf-menu',
					'menu_id'         => '',
					'echo'            => true,
					'fallback_cb'     => 'wp_page_menu',
					'before'          => '',
					'after'           => '',
					'link_before'     => '',
					'link_after'      => '',
					'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
					'depth'           => 0,
					'walker'          => ''
				);



				?>
				<nav class="nav">

				<?php
				wp_nav_menu( $defaults );

					?>
				</nav>
				<?php


				}
          ?>

        </div>
      </div> <!-- end .uou-block-2b -->
    </div>
