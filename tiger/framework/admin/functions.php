<?php


if ( ! isset( $content_width ) )
  $content_width = 1140;




/*-------------------------------------------------------------------------
  START REGISTER tiger SIDEBARS
------------------------------------------------------------------------- */

if ( ! function_exists( 'tiger_sidebar' ) ) {


function tiger_sidebar() {

  $args = array(
    'id'            => 'mainsidebar',
    'name'          => esc_html__( 'Page Sidebar', 'tiger' ),   
    'description'   => esc_html__('Put your main sidebar widgets here','tiger'),  
    'before_widget' => '',
    'after_widget'  => '',
    'before_title'  => '<h5 class="sidebar-title">',
    'after_title'   => '</h5>',
  );

  register_sidebar( $args );

   $footer_left_sidebar = array(

    'id'            => 'tiger_footer_left_sidebar',
    'name'          => esc_html__( 'Footer', 'tiger' ),
    'description'   => esc_html__('Put your widgets here that show on footer side area','tiger'),    
    'before_widget' => '<div class="col-md-3 col-sm-6">',
    'after_widget'  => '</div>', 
    'before_title'  => '<h5>',
    'after_title'   => '</h5>',

  );

  register_sidebar( $footer_left_sidebar );

  $footer_middle_sidebar = array(

    'id'            => 'tiger_footer_middle_sidebar',
    'name'          => esc_html__( 'Footer Middle Sidebar', 'tiger' ),
    'description'   => esc_html__('Put your widgets here that show on footer middle area','tiger'), 
    'before_widget' => '<div class="col-md-3 col-sm-6">',
    'after_widget'  => '</div>',
    'before_title'  => '<h5>',
    'after_title'   => '</h5>',

  );

  //register_sidebar( $footer_middle_sidebar );


 $footer_right_sidebar = array(
    'id'            => 'tiger_footer_right_sidebar',
    'name'          => esc_html__( 'Footer Right Sidebar', 'tiger' ),
    'description'   => esc_html__('Put your widgets here that show on footer right side area example(newsletter)','tiger'), 
    'before_widget' => '',
    'after_widget'  => '',
    'before_title'  => '',
    'after_title'   => '',
  );

  //register_sidebar( $footer_right_sidebar );

  $footer_down_sidebar = array(
    'id'            => 'tiger_footer_down_sidebar',
    'name'          => esc_html__( 'Footer Down Sidebar', 'tiger' ),
    'description'   => esc_html__('Put your widgets here that show on footer down side area example(contact info)','tiger'), 
    'before_widget' => '',
    'after_widget'  => '',
    'before_title'  => '',
    'after_title'   => '',
  );

  //register_sidebar( $footer_down_sidebar );

 $footer_extra_middle_sidebar = array(
    'id'            => 'tiger_footer_extra_middle_sidebar',
    'name'          => esc_html__( 'Footer Extra Middle Sidebar', 'tiger' ),
    'description'   => esc_html__('Put your widgets here that show on footer extra middle side area','tiger'), 
    'before_widget' => '<div class="col-sm-4">',
    'after_widget'  => '</div>',
    'before_title'  => '<h5>',
    'after_title'   => '</h5>',
  );

  //register_sidebar( $footer_extra_middle_sidebar );

}

add_action( 'widgets_init', 'tiger_sidebar' );

}

/*-------------------------------------------------------------------------
  END RESGISTER tiger SIDEBARS
------------------------------------------------------------------------- */


/*-------------------------------------------------------------------------
  START RESGISTER NAVIGATION MENUS FOR tiger
 ------------------------------------------------------------------------- */   

function tiger_custom_navigation_menus() {

  $locations = array(

    //'primary_navigation_left'   => esc_html__('Primary Menu Left','tiger'),
    'primary_navigation_right'  => esc_html__('Primary Menu','tiger'), 
    //'primary_navigation_footer' => esc_html__('Primary Menu footer','tiger'), 
    //'primary_navigation_mobile' => esc_html__('Primary Menu mobile','tiger'), 



  );

  register_nav_menus( $locations );

}

add_action( 'init', 'tiger_custom_navigation_menus' );



/*-------------------------------------------------------------------------
  END REGISTER NAVIGATION MENUS FOR  tiger
 ------------------------------------------------------------------------- */ 


 /*-------------------------------------------------------------------------
  START tiger CUSTOM CSS START
------------------------------------------------------------------------- */


add_action( 'wp_head', 'tiger_custom_css' );


function tiger_custom_css() {

  $tiger_option_data =get_option('tiger_option_data'); 
  if(isset($tiger_option_data['tiger-custom-css'])){
    echo "<style>" . $tiger_option_data['tiger-custom-css'] . "</style>";  
  }
  
  
}


/*-------------------------------------------------------------------------
  END tiger AUTORENT CUSTOM CSS END
------------------------------------------------------------------------- */


/*-------------------------------------------------------------------------
  START tiger CUSTOM JS START
------------------------------------------------------------------------- */


add_action( 'wp_head', 'tiger_custom_js' );

function tiger_custom_js() {
  $tiger_option_data =get_option('tiger_option_data'); 
  if(isset($tiger_option_data['tiger-custom-js'])){
    echo "<script>" . $tiger_option_data['tiger-custom-js'] . "</script>";  
  }
  
}


/*-------------------------------------------------------------------------
  END tiger CUSTOM JS END
------------------------------------------------------------------------- */




