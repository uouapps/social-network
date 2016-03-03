<?php
wp_enqueue_style('profile-login-style', SB_CSS.'search-form.css', array(), $ver = false, $media = 'all');

$radius=get_option('_iv_radius');
$keyword_post='';
$back_ground_color='0099fe';
if(isset($atts['bgcolor']) and $atts['bgcolor']!="" ){
	$back_ground_color=$atts['bgcolor'];
}
?>

<form  action="<?php echo get_post_type_archive_link( 'hospital' ) ; ?>" method="POST"  class="form-inline advanced-serach" id="searchformhd" onkeypress="return event.keyCode != 13;">
	<div class="container">
	 <div class="input-field">

			 <div class="" >
          <div class="form-group" >
					   <input type="text" class="cbp-search-input" id="keyword" name="keyword"  placeholder="<?php esc_html_e( 'Filter By Keyword', 'chilepro' ); ?>" value="<?php echo $keyword_post; ?>">
			     </div>
        </div>


				<div class="" >
          	<div class="form-group" >
  						<input type="text" class="cbp-search-input location-input" id="address" name="address"  placeholder="<?php esc_html_e( 'Location', 'chilepro' ); ?>"
  						value="">
              <i class="fa fa-map-marker marker"></i>
  						<input type="hidden" id="latitude" name="latitude"  value="" >
  						<input type="hidden" id="longitude" name="longitude"  value="">
            </div>
			  </div>


			  <div class="" >
          <div class="form-group" >
            <i class="fa fa-chevron-down arrow"></i>
						<select name="dir_type"  id="dir_type" class="cbp-search-select">';
  						<option  class="cbp-search-select" value="hospital"><?php esc_html_e('Hospital','chilepro'); ?></option>
  						<option class="cbp-search-select"  value="doctor"><?php esc_html_e('Doctor','chilepro'); ?></option>
						</select>
          </div>
			  </div>

				<div class="" >
          <div class="form-group search" >
					     <button type="button" id="search_submit_m" name="search_submit_m"  onClick='submitSearchForm()' class="btn-new btn-custom-search "> <i class="fa fa-search"></i> <span>Search</span></button>
				  </div>
        </div>
		 </div>
  </div>
</form>

<?php 
 wp_enqueue_script( 'search-form-js', SB_JS.'search-form.js', array('jquery'), $ver = true, true );
 wp_localize_script( 'search-form-js', 'jsdata', array( 'doctor_url' => get_post_type_archive_link( 'doctor' ),'hospital_url'=> get_post_type_archive_link( 'hospital' )) );
 
?>   
 

