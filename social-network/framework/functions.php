<?php




/*-------------------------------------------------------------------------
  START INITIALIZE FILE LINK
------------------------------------------------------------------------- */

require_once(  get_template_directory(). '/framework/constants.php' );


require_once(  get_template_directory(). '/framework/visual-composer/shortcodes.php' );

require_once(  get_template_directory(). '/framework/ext/extensions-setup.php' );
require_once(  get_template_directory(). '/framework/ext/sb-catagories_one.php' );
require_once(  get_template_directory() . '/framework/ext/sb-newsletter-subscription.php' );
require_once(  get_template_directory(). '/framework/ext/sb-contact-info.php' );
require_once(  get_template_directory(). '/framework/ext/sb-social.php' );
require_once(  get_template_directory(). '/framework/ext/sb-company.php' );
require_once(  get_template_directory(). '/framework/ext/sb-legal.php' );
require_once(  get_template_directory(). '/framework/ext/sb-logo.php' );
require_once(  get_template_directory(). '/framework/ext/chilepro-hospital.php' ); 
require_once(  get_template_directory(). '/framework/ext/chilepro-doctor.php' ); 


require_once(  get_template_directory(). '/framework/ext/sb-archives.php' );
require_once(  get_template_directory(). '/framework/ext/sb-tag.php' );
require_once(  get_template_directory(). '/framework/ext/sb-social.php' );
require_once(  get_template_directory(). '/framework/ext/sb-categories.php' );



require_once(  get_template_directory(). '/framework/theme/style.php' );
require_once(  get_template_directory(). '/framework/theme/scripts.php' );
require_once(  get_template_directory() . '/framework/theme/chameleon-image.php' );
require_once(  get_template_directory(). '/framework/theme/chameleon-wpml.php' );

require_once(  get_template_directory(). '/framework/admin/functions.php' );
require_once(  get_template_directory(). '/framework/admin/theme-functions.php' );
require_once(  get_template_directory(). '/framework/admin/breadcrumbs.php' );
require_once(  get_template_directory(). '/framework/admin/allBreadcrumbs/arrowcrumbs.php' );
require_once(  get_template_directory() . '/framework/admin/chameleon-menu-walker.php' );
require_once(  get_template_directory(). '/framework/admin/chameleon-nav-menu-walker-two.php' );
require_once(  get_template_directory(). '/framework/admin/chameleon-image.php' );

require_once(  get_template_directory(). '/framework/hospital-doctor-directory/plugin.php' );

/*-------------------------------------------------------------------------
  END INITIALIZE FILE LINK
------------------------------------------------------------------------- */


/*-------------------------------------------------------------------------
  START ENQUEUING REDUX OPTION FRAMEWORK
------------------------------------------------------------------------- */

	if ( !class_exists( 'ReduxFramework' ) && file_exists( get_template_directory() . '/framework/redux/ReduxCore/framework.php' ) ) {
	    require_once( get_template_directory() . '/framework/redux/ReduxCore/framework.php' );
	}
	if ( !isset( $chameleon_option_data ) && file_exists( get_template_directory() . '/framework/redux/config/config.php' ) ) {
	    require_once( get_template_directory() . '/framework/redux/config/config.php' );
	}


/*-------------------------------------------------------------------------
  END ENQUEUING REDUX OPTION FRAMEWORK
------------------------------------------------------------------------- */


/*-------------------------------------------------------------------------
  START FUNCTION FOR NAV MENU ACTIVE CLASS
------------------------------------------------------------------------- */

add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);

function special_nav_class ($classes, $item) {
    if (in_array('current-menu-item', $classes) ){
        $classes[] = 'active ';
    }
    return $classes;
}
add_filter( 'template_include', 'include_template_function', 10, 2  );
function include_template_function( $template_path ) { 					
						
		if ( get_post_type() == 'hospital' ) { 
				
			if(  is_category() || is_archive() ){
				
				$template_path =  get_template_directory(). '/archive-hospital.php';
			}
		}
		if ( get_post_type() == 'doctor' ) { 
			/*
			if ( is_single() ) {
				//$template_path =  wp_iv_directories_template. 'doctor/single-doctor.php';	
			}
			*/							
			if(is_category() || is_archive() ){
				$template_path =  get_template_directory(). '/archive-doctor.php';
			}
		}
		
		
		return $template_path;
					
}

/*-------------------------------------------------------------------------
  END FUNCTION FOR NAV MENU ACTIVE CLASS
------------------------------------------------------------------------- */



