<?php

if(!defined('medical-directroy')){
	define('medical-directroy', "chilepro");
}
if(!defined('chilepro')){
	define('chilepro', "chilepro");
}
if(!defined('medical-directroy')){
	define('medical-directroy', "chilepro_wp");
}

if(!defined('chilepro_PANEL')){
	define('chilepro_PANEL', TRUE);
}


/*-------------------------------------------------------------------------
  START JS CSS IMG & VIDEO CONSTANT PATH DEFINED
------------------------------------------------------------------------- */

if(!defined('SB_JS')){

	define('SB_JS', get_template_directory_uri().'/assets/js/' );
}
if(!defined('SB_JS_PLUGINS')){

	define('SB_JS_PLUGINS', get_template_directory_uri().'/assets/js/plugins/' );
}
if(!defined('SB_CSS')){

	define('SB_CSS', get_template_directory_uri().'/assets/css/' );
}

if(!defined('SB_IMAGE')){

	define('SB_IMAGE', get_template_directory_uri().'/assets/img/');
}

if(!defined('SB_VIDEO')){

	define('SB_VIDEO', get_template_directory_uri().'/assets/media/');

}

/*-------------------------------------------------------------------------
  END JS CSS AND IMG CONSTANT PATH DEFINED
------------------------------------------------------------------------- */

?>
