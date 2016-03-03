<?php
/**
* @package WordPress
* @subpackage chameleon
* @since 1.0
*/



if(!function_exists('_log')){
  function _log( $message ) {
    if( WP_DEBUG === true ){
      if( is_array( $message ) || is_object( $message ) ){
        error_log( print_r( $message, true ) );
      } else {
        error_log( $message );
      }
    }
  }
}


/*-------------------------------------------------------------------------
  START INITIALIZE FILE LINK
------------------------------------------------------------------------- */

require_once(TEMPLATEPATH . '/framework/functions.php');



/*-------------------------------------------------------------------------
  END INITIALIZE FILE LINK
------------------------------------------------------------------------- */

/*-------------------------------------------------------------------------
  START OF REGISTER MENUS
------------------------------------------------------------------------- */


/*-------------------------------------------------------------------------
  END OF REGISTER MENUS
------------------------------------------------------------------------- */







?>
