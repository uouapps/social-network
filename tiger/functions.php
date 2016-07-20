<?php
/**
* @package WordPress
* @subpackage tiger
* @since 1.0
*/


/*-------------------------------------------------------------------------
  START INITIALIZE FILE LINK
------------------------------------------------------------------------- */

require_once( get_template_directory() . '/framework/functions.php');

?>
<?php if ( is_singular() ) wp_enqueue_script( "comment-reply" ); ?> 
