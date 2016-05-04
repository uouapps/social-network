<?php


/*
Register Fonts
*/
function tiger_fonts_url() {
$fonts_url = '';

/* Translators: If there are characters in your language that are not
* supported by Open Sans, translate this to 'off'. Do not translate
* into your own language.
*/

	$open_sans = _x( 'on', 'Open Sans font: on or off', 'tiger' );
	$droid_serif = _x( 'on', 'Droid Serif font: on or off', 'tiger' );
	$montserrat = _x( 'on', 'Montserrat font: on or off', 'tiger' );
	$nothing_you_could_do = _x( 'on', 'Nothing You Could Do font: on or off', 'tiger' );
	$libre_baskerville = _x( 'on', 'Libre Baskerville  font: on or off', 'tiger' );


if ( 'off' !== $open_sans || 'off' !== $droid_serif || 'off' !== $montserrat || 'off' !== $nothing_you_could_do || 'off' !== $libre_baskerville ) {
	$font_families = array();

	if ( 'off' !== $open_sans ) {
		$font_families[] = 'Open Sans:400italic,300,400,600,700';
	}

	if ( 'off' !== $droid_serif ) {
		$font_families[] = 'Droid Serif:400,700,400italic';
	}

	if ( 'off' !== $montserrat ) {
		$font_families[] = 'Montserrat:400,700';
	}

	if ( 'off' !== $nothing_you_could_do ) {
		$font_families[] = 'Nothing You Could Do';
	}

	if ( 'off' !== $libre_baskerville ) {
		$font_families[] = 'Libre Baskerville:400,400italic';
	}

	$query_args = array(
		'family' => urlencode( implode( '|', $font_families ) ),
		'subset' => urlencode( 'latin,latin-ext' ),
	);

	$fonts_url = add_query_arg( $query_args,"https://fonts.googleapis.com/css" );
}

return esc_url_raw( $fonts_url );
}



/*-------------------------------------------------------------------------
 START ENQUEUING STYLESHEETS
------------------------------------------------------------------------- */

if( !function_exists('tiger_add_style') ){

function tiger_add_style(){


 global $is_IE,$tiger_option_data;

  $i=1;
 $protocol = is_ssl() ? 'https' : 'http';

 wp_enqueue_style( 'sb-fonts', tiger_fonts_url(), array(), null );


 wp_enqueue_style('sb-swipebox', tiger_CSS.'swipebox.min.css', array(), $ver = false, $media = 'all');

if(is_page_template('templates/copywriter-home.php' ))
{
	$i=0;
 wp_enqueue_style('copywriter-style', tiger_CSS.'copywriter-style.css', array(), $ver = false, $media = 'all');
}

if(is_page_template('templates/corporate-home.php' ))
{
	$i=0;
 wp_enqueue_style('corporate-style-style', tiger_CSS.'corporate-style.css', array(), $ver = false, $media = 'all');
}
if(is_page_template('templates/creative-home.php' ))
{
	$i=0;
 wp_enqueue_style('creative-style', tiger_CSS.'creative-style.css', array(), $ver = false, $media = 'all');
}
 // Start Base MasterSlider style sheet
// wp_enqueue_style('masterslider-style', tiger_JS.'masterslider/style/masterslider.css', array(), $ver = false, $media = 'all');

 //wp_enqueue_style('default-style', tiger_JS.'masterslider/skins/default/style.css', array(), $ver = false, $media = 'all');

 //wp_enqueue_style('light2-style', tiger_JS.'masterslider/skins/light-2/style.css', array(), $ver = false, $media = 'all');

 //wp_enqueue_style('black1-style', tiger_JS.'masterslider/skins/black-1/style.css', array(), $ver = false, $media = 'all');

 wp_enqueue_style('roboto-style', 'https://fonts.googleapis.com/css?family=Roboto+Slab:400,700', array(), $ver = false, $media = 'all');

 wp_enqueue_style('open-sans-style', 'https://fonts.googleapis.com/css?family=Open+Sans:400,600,700', array(), $ver = false, $media = 'all');

wp_enqueue_style('search-form-style', tiger_CSS.'search-form.css');
wp_enqueue_style('iv_directories-style-11010', tiger_CSS . 'image_gallery.css');


 if (class_exists('wp_iv_directories')) {
	//wp_enqueue_style('iv_directories-style64', wp_iv_directories_URLPATH . 'assets/cube/css/cubeportfolio.css',array(), $ver = false, $media = 'all');

}

wp_enqueue_style('pricing-table-style', tiger_CSS.'price-table.css', array(), $ver = false, $media = 'all');


wp_enqueue_style('iv_directories-style6', tiger_CSS . 'widget.css',array(), $ver = false, $media = 'all');

wp_enqueue_style('advance-search', tiger_CSS . 'advanced-search-form.css',array(), $ver = false, $media = 'all');

 // End Base MasterSlider style sheet

 // if u having problem in master slide style then please look at the HTML stylesheet section i didn't include some style
// if(is_page_template(!'templates/creative-home.php'&&!'templates/corporate-home.php'&&!'templates/copywriter-home.php' ))
// {
 if($i==1){
 wp_enqueue_style('sb-main-stylesheet', tiger_CSS.'main-style.css', array(), $ver = false, $media = 'all');
 wp_enqueue_style('corporate-style-style', tiger_CSS.'corporate-style.css', array(), $ver = false, $media = 'all');

}


 }
}

add_action('wp_enqueue_scripts', 'tiger_add_style');

/*-------------------------------------------------------------------------
 END ENQUEUING STYLESHEETS
------------------------------------------------------------------------- */

