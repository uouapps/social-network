<?php
/**
* @package WordPress
* @subpackage tiger
* @since 1.0
*/



if(!function_exists('tiger_log')){
  function tiger_log( $message ) {
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

?>
