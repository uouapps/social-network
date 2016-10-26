<?php
/**
 * The template for displaying product search form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/product-searchform.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/'  ) ); ?>">
	<!-- <label class="screen-reader-text side-tittle " for="woocommerce-product-search-field"><?php _e( 'Search for:', 'tiger' ); ?></label> -->
	<input type="search"  class="search-input" placeholder="<?php echo esc_attr_x( 'Search Products&hellip;', 'placeholder', 'tiger' ); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'tiger' ); ?>" />
	<input type="submit" class="btn btn-default searchsubmit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'tiger' ); ?>" />
	<input type="hidden" name="post_type" value="product" />
</form>
