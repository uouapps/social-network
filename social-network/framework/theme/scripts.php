<?php



/*-------------------------------------------------------------------------
  START ENQUEUING THEME SCRIPTS
------------------------------------------------------------------------- */

if( !function_exists('chameleon_add_theme_scripts') ){

  function chameleon_add_theme_scripts(){

     global $is_IE;

  /**
   * mordanizr
   * @param $handle, $src, $deps, $ver, $in_footer
   * @since  Version 1.0
  */
  
    wp_enqueue_script( 'hoverIntent', SB_JS_PLUGINS.'hoverIntent.js', array('jquery'), $ver = true, true );

    wp_enqueue_script( 'jquery.fitvids', SB_JS_PLUGINS.'jquery.fitvids.js', array('jquery'), $ver = true, true );

    wp_enqueue_script( 'flexslider', SB_JS_PLUGINS.'jquery.flexslider-min.js', array('jquery'), $ver = true, true );

    wp_enqueue_script( 'rangeslider', SB_JS_PLUGINS.'rangeslider.min.js', array('jquery'), $ver = true, true );

    wp_enqueue_script( 'superfish', SB_JS_PLUGINS.'superfish.min.js', array('jquery'), $ver = true, true );

    wp_enqueue_script( 'supersubs', SB_JS_PLUGINS.'supersubs.js', array('jquery'), $ver = true, true );

    wp_enqueue_script( 'masterslider', SB_JS .'masterslider/masterslider.min.js', array('jquery'), $ver = false, true );

    wp_enqueue_script( 'jquery.easing.min', SB_JS .'masterslider/jquery.easing.min.js', array('jquery'), $ver = false, true );

    wp_enqueue_script( 'master-slider-custom', SB_JS.'master-slider-custom.js', array('jquery'), $ver = true, true );

    wp_enqueue_script( 'bootstrap.min', SB_JS.'bootstrap.js', array('jquery'), $ver = true, true );

    wp_enqueue_script( 'uou_accordions', SB_JS.'uou-accordions.js', array('jquery'), $ver = true, true );

    wp_enqueue_script( 'uou-tabs', SB_JS.'uou-tabs.js', array('jquery'), $ver = true, true );

    wp_enqueue_script( 'jquery-nicescroll', SB_JS.'jquery.nicescroll.js', array('jquery'), $ver = true, true );

    wp_enqueue_script( 'isotope-custom', SB_JS.'isotope-custom.js', array('jquery'), $ver = true, true );
    
    wp_enqueue_script( 'isotope', SB_JS.'isotope.pkgd.min.js', array('jquery'), $ver = true, true );


    wp_enqueue_script( 'swipebox', SB_JS.'jquery.swipebox.min.js', array('jquery'), $ver = true, true );

    //wp_enqueue_script('maps.google', 'http://maps.google.com/maps/api/js?sensor=false', array('jquery'), false, true);
    wp_enqueue_script('maps.google', 'http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places', array('jquery'), false, true);
    

    wp_enqueue_script( 'maplace-0.1.3', SB_JS.'maplace-0.1.3.js', array('jquery'), $ver = true, true );


    wp_enqueue_script( 'scripts', SB_JS.'scripts.js', array('jquery'), $ver = true, true );
    

/*-------------------------------------------------------------------------
      GOOGLE MAP FOR CONTACT US PAGE START
    ------------------------------------------------------------------------- */
if(is_page_template('templates/creative-home.php' )||is_page_template('templates/corporate-home.php' )||is_page_template('templates/copywriter-home.php' ))
{
    $args = array('post_type' => 'company_location','posts_per_page' => '-1');

    $my_query = new WP_Query( $args );

    $marker_content_prev = array();


    foreach ($my_query->posts as $key => $value) {


      $post_id = $my_query->posts[$key]->ID;
      $country_name = get_post_meta( $post_id, '_chameleon_property_address_country_name');       
      $region_name = get_post_meta( $post_id, '_chameleon_property_address_region_name'); 
      $address_name = get_post_meta( $post_id, '_chameleon_property_address_address_name');
      $lat = get_post_meta( $post_id, '_chameleon_property_address_lat');
      $lng = get_post_meta( $post_id, '_chameleon_property_address_lng'); 

      $icon_id = get_post_meta($post_id,'_chameleon_company_location_icon');
      $icon = wp_get_attachment_image_src( $icon_id[0] );

      $post_title = $my_query->posts[$key]->post_title;
      $post_permalink = $my_query->posts[$key]->guid;
      $content = $my_query->posts[$key]->post_content;
      $trimmed_content = wp_trim_words( $content, 10, '<a href="'. $post_permalink .'"> Read More</a>'  );
      

          $m=8;

            $marker_content_prev[$key]['lat'] = floatval($lat[0]);
            $marker_content_prev[$key]['lon'] = floatval($lng[0]);
            $marker_content_prev[$key]['id'] = (string)$post_id;
            $marker_content_prev[$key]['zoom'] =intval($m);
        
      
      if(isset($group)){
        $marker_content_prev[$key]['group'] = $group;
      }
      
      if(isset($icon) && !empty($icon)){
        $marker_content_prev[$key]['icon'] = $icon[0];
      }     


    }

    
    $marker_content = array();

    foreach ($marker_content_prev as $keys => $values) {
      array_push($marker_content, $values);
    } 


    wp_enqueue_script( 'chameleon_custom_map_script', SB_JS.'map-script.js', array('jquery'), $ver = false, true );
    wp_localize_script( 'chameleon_custom_map_script', 'marker_location', $marker_content );
}
    /*-------------------------------------------------------------------------
       GOOGLE MAP FOR CONTACT US PAGE END
    ------------------------------------------------------------------------- */


   
  }
}

  add_action('wp_enqueue_scripts', 'chameleon_add_theme_scripts');


/*-------------------------------------------------------------------------
  START ENQUEUING ADMIN SCRIPTS
------------------------------------------------------------------------- */

if( !function_exists('chameleon_admin_load_scripts') ){

  function chameleon_admin_load_scripts($hook) {   

    if(in_array($hook,array("post.php","post-new.php"))) {

      wp_enqueue_script( 'chameleon-admin', SB_JS.'sb-admin.js', array('jquery'), $ver = false, true );

      wp_enqueue_script('maps.google', 'http://maps.google.com/maps/api/js?sensor=false', array('jquery'), false, true);
      wp_enqueue_script( 'gps_converter', SB_JS.'gps_converter.js', array('jquery'), $ver = false, true );

      }   

  }

}

add_action('admin_enqueue_scripts', 'chameleon_admin_load_scripts');

/*-------------------------------------------------------------------------
  END ENQUEUING ADMIN SCRIPTS
------------------------------------------------------------------------- */

