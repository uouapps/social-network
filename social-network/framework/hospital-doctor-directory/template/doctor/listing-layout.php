<?php
get_header(); 

	// For Doctor
	$opt_style=	get_option('_archive_template_doctor');
	if($opt_style==''){$opt_style='style-1';} 
	if($opt_style=='style-1'){
	 echo do_shortcode('[listing_doctor_style_1"]');
	}
	
get_footer();
 ?>
