<?php


if ( ! isset( $content_width ) )
  $content_width = 1140;




/*-------------------------------------------------------------------------
  START REGISTER chameleon SIDEBARS
------------------------------------------------------------------------- */

if ( ! function_exists( 'chameleon_sidebar' ) ) {


function chameleon_sidebar() {

  $args = array(
    'id'            => 'mainsidebar',
    'name'          => __( 'Page Sidebar', 'chilepro' ),   
    'description'   => __('Put your main sidebar widgets here','chilepro'),  
    'before_widget' => '',
    'after_widget'  => '',
    'before_title'  => '<h5 class="sidebar-title">',
    'after_title'   => '</h5>',
  );

  register_sidebar( $args );

   $footer_left_sidebar = array(

    'id'            => 'chameleon_footer_left_sidebar',
    'name'          => __( 'Footer', 'chilepro' ),
    'description'   => __('Put your widgets here that show on footer side area','chilepro'),    
    'before_widget' => '<div class="col-md-3 col-sm-6">',
    'after_widget'  => '</div>', 
    'before_title'  => '<h5>',
    'after_title'   => '</h5>',

  );

  register_sidebar( $footer_left_sidebar );

  $footer_middle_sidebar = array(

    'id'            => 'chameleon_footer_middle_sidebar',
    'name'          => __( 'Footer Middle Sidebar', 'chameleon' ),
    'description'   => __('Put your widgets here that show on footer middle area','chilepro'), 
    'before_widget' => '<div class="col-md-3 col-sm-6">',
    'after_widget'  => '</div>',
    'before_title'  => '<h5>',
    'after_title'   => '</h5>',

  );

  //register_sidebar( $footer_middle_sidebar );


 $footer_right_sidebar = array(
    'id'            => 'chameleon_footer_right_sidebar',
    'name'          => __( 'Footer Right Sidebar', 'chameleon' ),
    'description'   => __('Put your widgets here that show on footer right side area example(newsletter)','chilepro'), 
    'before_widget' => '',
    'after_widget'  => '',
    'before_title'  => '',
    'after_title'   => '',
  );

  //register_sidebar( $footer_right_sidebar );

  $footer_down_sidebar = array(
    'id'            => 'chameleon_footer_down_sidebar',
    'name'          => __( 'Footer Down Sidebar', 'chameleon' ),
    'description'   => __('Put your widgets here that show on footer down side area example(contact info)','chilepro'), 
    'before_widget' => '',
    'after_widget'  => '',
    'before_title'  => '',
    'after_title'   => '',
  );

  //register_sidebar( $footer_down_sidebar );

 $footer_extra_middle_sidebar = array(
    'id'            => 'chameleon_footer_extra_middle_sidebar',
    'name'          => __( 'Footer Extra Middle Sidebar', 'chameleon' ),
    'description'   => __('Put your widgets here that show on footer extra middle side area','chilepro'), 
    'before_widget' => '<div class="col-sm-4">',
    'after_widget'  => '</div>',
    'before_title'  => '<h5>',
    'after_title'   => '</h5>',
  );

  //register_sidebar( $footer_extra_middle_sidebar );

}

add_action( 'widgets_init', 'chameleon_sidebar' );

}

/*-------------------------------------------------------------------------
  END RESGISTER chameleon SIDEBARS
------------------------------------------------------------------------- */


/*-------------------------------------------------------------------------
  START RESGISTER NAVIGATION MENUS FOR Chameleon
 ------------------------------------------------------------------------- */   

function chameleon_custom_navigation_menus() {

  $locations = array(

    //'primary_navigation_left'   => __('Primary Menu Left','chilepro'),
    'primary_navigation_right'  => __('Primary Menu','chilepro'), 
    //'primary_navigation_footer' => __('Primary Menu footer','chilepro'), 
    //'primary_navigation_mobile' => __('Primary Menu mobile','chilepro'), 



  );

  register_nav_menus( $locations );

}

add_action( 'init', 'chameleon_custom_navigation_menus' );



/*-------------------------------------------------------------------------
  END REGISTER NAVIGATION MENUS FOR  Chameleon
 ------------------------------------------------------------------------- */ 


 /*-------------------------------------------------------------------------
  START chilepro CUSTOM CSS START
------------------------------------------------------------------------- */


add_action( 'wp_head', 'sb_custom_css' );


function sb_custom_css() {

  global $chameleon_option_data;
  if(isset($chameleon_option_data['chameleon-custom-css'])){
    echo "<style>" . $chameleon_option_data['chameleon-custom-css'] . "</style>";  
  }
  
  
}


/*-------------------------------------------------------------------------
  END chilepro AUTORENT CUSTOM CSS END
------------------------------------------------------------------------- */


/*-------------------------------------------------------------------------
  START chilepro CUSTOM JS START
------------------------------------------------------------------------- */


add_action( 'wp_head', 'sb_custom_js' );

function sb_custom_js() {
  global $chameleon_option_data;
  if(isset($chameleon_option_data['chameleon-custom-js'])){
    echo "<script>" . $chameleon_option_data['chameleon-custom-js'] . "</script>";  
  }
  
}


/*-------------------------------------------------------------------------
  END chilepro CUSTOM JS END
------------------------------------------------------------------------- */




