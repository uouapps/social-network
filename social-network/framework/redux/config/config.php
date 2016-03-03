<?php

/**
 *  XXL admin panel settings .
 * @since       Version 1.0
 */



if (!class_exists('chameleon_admin_config')) {

    class chameleon_admin_config {

        public $args        = array();
        public $sections    = array();
        public $theme;
        public $ReduxFramework;

        public function __construct() {

            if (!class_exists('ReduxFramework')) {
                return;
            }

            // This is needed. Bah WordPress bugs.  ;)
            if (  true == Redux_Helpers::isTheme(__FILE__) ) {
                $this->initSettings();
            } else {
                add_action('plugins_loaded', array($this, 'initSettings'), 10);
            }

        }

        public function initSettings() {


            $this->theme = wp_get_theme();

            // Set the default arguments
            $this->setArguments();

            // Set a few help tabs so you can see how it's done
            $this->setHelpTabs();

            // Create the sections and fields
            $this->setSections();

            if (!isset($this->args['opt_name'])) { // No errors please
                return;
            }

            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }



        /**

          Custom function for filtering the sections array. Good for child themes to override or add to the sections.
          Simply include this function in the child themes functions.php file.

          NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
          so you must use get_template_directory_uri() if you want to use any of the built in icons

         * */
        function dynamic_section($sections) {
            //$sections = array();
            $sections[] = array(
                'title' => __('Section via hook', 'uoulib'),
                'desc' => __('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'uoulib'),
                'icon' => 'el-icon-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );

            return $sections;
        }

        /**

          Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.

         * */
        function change_arguments($args) {
            $args['dev_mode'] = false;

            return $args;
        }

        /**

          Filter hook for filtering the default value of any given field. Very useful in development mode.

         * */
        function change_defaults($defaults) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }

        // Remove the demo link and the notice of integrated demo from the redux-framework plugin
        function remove_demo() {

            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if (class_exists('ReduxFrameworkPlugin')) {
                remove_filter('plugin_row_meta', array(ReduxFrameworkPlugin::instance(), 'plugin_metalinks'), null, 2);

                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action('admin_notices', array(ReduxFrameworkPlugin::instance(), 'admin_notices'));
            }
        }

        public function setSections() {

            /**
              Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
             * */
            // Background Patterns Reader
            $sample_patterns_path   = ReduxFramework::$_dir . '../options/patterns/';
            $sample_patterns_url    = ReduxFramework::$_url . '../options/patterns/';
            $sample_patterns        = array();

            if (is_dir($sample_patterns_path)) :

                if ($sample_patterns_dir = opendir($sample_patterns_path)) :
                    $sample_patterns = array();

                    while (( $sample_patterns_file = readdir($sample_patterns_dir) ) !== false) {

                        if (stristr($sample_patterns_file, '.png') !== false || stristr($sample_patterns_file, '.jpg') !== false) {
                            $name = explode('.', $sample_patterns_file);
                            $name = str_replace('.' . end($name), '', $sample_patterns_file);
                            $sample_patterns[]  = array('alt' => $name, 'img' => $sample_patterns_url . $sample_patterns_file);
                        }
                    }
                endif;
            endif;

            ob_start();

            $ct             = wp_get_theme();
            $this->theme    = $ct;
            $item_name      = $this->theme->get('Name');
            $tags           = $this->theme->Tags;
            $screenshot     = $this->theme->get_screenshot();
            $class          = $screenshot ? 'has-screenshot' : '';

            $customize_title = sprintf(__('Customize &#8220;%s&#8221;', 'uoulib'), $this->theme->display('Name'));

            ?>
            <div id="current-theme" class="<?php echo esc_attr($class); ?>">
            <?php if ($screenshot) : ?>
                <?php if (current_user_can('edit_theme_options')) : ?>
                        <a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize" title="<?php echo esc_attr($customize_title); ?>">
                            <img src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview','chilepro'); ?>" />
                        </a>
                <?php endif; ?>
                    <img class="hide-if-customize" src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview','chilepro'); ?>" />
                <?php endif; ?>

                <h4><?php echo $this->theme->display('Name'); ?></h4>

                <div>
                    <ul class="theme-info">
                        <li><?php printf(__('By %s', 'uoulib'), $this->theme->display('Author')); ?></li>
                        <li><?php printf(__('Version %s', 'uoulib'), $this->theme->display('Version')); ?></li>
                        <li><?php echo '<strong>' . __('Tags', 'uoulib') . ':</strong> '; ?><?php printf($this->theme->display('Tags')); ?></li>
                    </ul>
                    <p class="theme-description"><?php echo $this->theme->display('Description'); ?></p>
            <?php
            if ($this->theme->parent()) {
                printf(' <p class="howto">' . __('This <a href="%1$s">child theme</a> requires its parent theme, %2$s.','chilepro') . '</p>', __('http://codex.wordpress.org/Child_Themes', 'uoulib'), $this->theme->parent()->display('Name'));
            }
            ?>

                </div>
            </div>

            <?php
            $item_info = ob_get_contents();

            ob_end_clean();

            $sampleHTML = '';
            if (file_exists(dirname(__FILE__) . '/info-html.html')) {
                /** @global WP_Filesystem_Direct $wp_filesystem  */
                global $wp_filesystem;
                if (empty($wp_filesystem)) {
                    require_once(ABSPATH . '/wp-admin/includes/file.php');
                    WP_Filesystem();
                }
                $sampleHTML = $wp_filesystem->get_contents(dirname(__FILE__) . '/info-html.html');
            }




    /*
    |--------------------------------------------------------------------------
    | Start Home settings
    |--------------------------------------------------------------------------
    | favicon , iphone favicon , ipad favicon , custom css , tracking code .
    |
    |
    */




            // ACTUAL DECLARATION OF SECTIONS
            $this->sections[] = array(

                'title'     => __('Home Settings', 'uoulib'),
                'icon'      => 'el-icon-home',

                'fields'    => array(
					
					
				array(
                        'id'        => 'chameleon-show-page-banner-image',
                        'type'      => 'switch',
                        'title'     => __('Top banner image with text', 'uoulib'),
                        'default'   => true,
                    ),
				 
                    
				 array(
                        'id'        => 'chameleon-home-banner-image',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Home Top Banner image', 'uoulib'),
                        'subtitle'      => __('Best fit 1349 X 420 px.', 'uoulib'),
                        'compiler'  => 'true',
                        'desc'      => __('Upload Home Image.', 'uoulib'),
                    ),
                    
                        
                     array(
                        'id'        => 'chameleon-home-banner-text',
                        'type'      => 'textarea',
                        'title'     => __('Banner Image Title', 'uoulib'), 
						'compiler'  => 'true',
						'validate' => 'html',
                        'default' => __('Welcome to Medical Directory',"chilepro"),
                        'allowed_html' => array(
                            'a' => array(
                                'href' => array(),
                                'title' => array(),
                                'desc' => array()
                            ),
                            'br' => array(),
                            'em' => array(),
                            'strong' => array()
                          ),  
                        
                    ),
                       array(
                        'id'        => 'chameleon-home-banner-subtitle',
                        'type'      => 'textarea',
                        'title'     => __('Banner Image sub title', 'uoulib'), 
						'compiler'  => 'true',
						'validate' 	=> 'html',
                        'default' 	=>__( 'Search for hospitals and doctors on world wide basis',"chilepro"),
                        'allowed_html' => array(
                            'a' => array(
                                'href' => array(),
                                'title' => array(),
                                'desc' => array()
                            ),
                            'br' => array(),
                            'em' => array(),
                            'strong' => array()
                          ),  
                        
                    ),
                    array(
                        'id'        => 'chameleon-home-banner-button1',
                        'type'      => 'textarea',
                        'title'     => __('Banner Button text left', 'uoulib'), 
						'compiler'  => 'true',
						'validate' => 'html',
                        'default' => __('FIND A HOSPITAL',"chilepro" ),
                        'allowed_html' => array(
                            'a' => array(
                                'href' => array(),
                                'title' => array(),
                                'desc' => array()
                            ),
                            'br' => array(),
                            'em' => array(),
                            'strong' => array()
                          ),  
                        
                    ),
                      array(
                        'id'        => 'chameleon-home-banner-button2',
                        'type'      => 'textarea',
                        'title'     => __('Banner Button text right', 'uoulib'), 
						'compiler'  => 'true',
						'validate' => 'html',
                        'default' => __('FIND A DOCTOR',"chilepro"),
                        'allowed_html' => array(
                            'a' => array(
                                'href' => array(),
                                'title' => array(),
                                'desc' => array()
                            ),
                            'br' => array(),
                            'em' => array(),
                            'strong' => array()
                          ),  
                        
                    ),
                     array(
                        'id'        => 'chameleon-home-top-block1',
                        'type'      => 'textarea',
                        'title'     => __('Top Block-1 Content ', 'uoulib'), 
                        'subtitle'      => __('Home Page 1st top block content.', 'uoulib'),
						'compiler'  => 'true',
						'validate' => 'html',
                        'default' => __('With Over 300 hospitals across 20 countries medical directory is the right place to find your closest healthcare center',"chilepro"),
                        'allowed_html' => array(
                            'a' => array(
                                'href' => array(),
                                'title' => array(),
                                'desc' => array()
                            ),
                            'br' => array(),
                            'em' => array(),
                            'strong' => array()
                          ),  
                        
                    ),
                     array(
                        'id'        => 'chameleon-home-top-block2',
                        'type'      => 'textarea',
                        'title'     => __('Top Block-2 Content ', 'uoulib'), 
                        'subtitle'      => __('Home Page 2nd top block content.', 'uoulib'),
						'compiler'  => 'true',
						'validate' => 'html',
                        'default' => __('Find the right doctor within the closest hospital across a wide range of medical fields including neurosurgery',"chilepro"),
                        'allowed_html' => array(
                            'a' => array(
                                'href' => array(),
                                'title' => array(),
                                'desc' => array()
                            ),
                            'br' => array(),
                            'em' => array(),
                            'strong' => array()
                          ),  
                        
                    ),
                     array(
                        'id'        => 'chameleon-home-top-block3',
                        'type'      => 'textarea',
                        'title'     => __('Top Block-3 Content ', 'uoulib'), 
                        'subtitle'      => __('Home Page 3rd top block content.', 'uoulib'),
						'compiler'  => 'true',
						'validate' => 'html',
                        'default' => __("You're a medical center with hospitals and doctors worldwide, medical directory is the right place to list your hospitals and doctors, join us now","chilepro"),
                        'allowed_html' => array(
                            'a' => array(
                                'href' => array(),
                                'title' => array(),
                                'desc' => array()
                            ),
                            'br' => array(),
                            'em' => array(),
                            'strong' => array()
                          ),  
                        
                    ),
                    /*
                    array(
                        'id'        => 'chameleon-favicon',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Custom Favicon', 'uoulib'),
                        'compiler'  => 'true',
                        'desc'      => __('Upload custom favicon.', 'uoulib'),
                    ),


                    array(
                        'id'        => 'chameleon-favicon-iphone',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Custom Favicon For iphone', 'uoulib'),
                        'compiler'  => 'true',
                        'desc'      => __('Upload custom favicon for iphone.', 'uoulib'),

                    ),


                    array(
                        'id'        => 'chameleon-favicon-ipad',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Custom Favicon For ipad', 'uoulib'),
                        'compiler'  => 'true',
                        'desc'      => __('Upload custom favicon for ipad', 'uoulib'),

                    ),

                    */


                    array(
                        'id'        => 'chameleon-show-page-sidebar',
                        'type'      => 'switch',
                        'title'     => __('Page Templates With Sidebar', 'uoulib'),
                        'default'   => false,
                    ),




                    array(
                        'id'        => 'chameleon-custom-css',
                        'type'      => 'ace_editor',
                        'title'     => __('Custom CSS ', 'uoulib'),
                        'subtitle'  => __('Paste your custom CSS code here.', 'uoulib'),
                        'mode'      => 'css',
                        'theme'     => 'monokai',
                    ),


                    array(
                        'id'        => 'chameleon-custom-js',
                        'type'      => 'ace_editor',
                        'title'     => __('Custom JS', 'uoulib'),
                        'subtitle'  => __('Paste your JS code here.', 'uoulib'),
                        'mode'      => 'javascript',
                        'theme'     => 'chrome',
                    ),


                ),
            );

    /*
    |--------------------------------------------------------------------------
    | End Home settings
    |--------------------------------------------------------------------------
    |
    |
    |
    */



    /*
    |--------------------------------------------------------------------------
    | start header settings
    |--------------------------------------------------------------------------
    |
    |
    |
    */

            $this->sections[] = array(
                'icon'      => 'el-icon-paper-clip',
                'title'     => __('Header Settings', 'uoulib'),
                'fields'    => array(


                    array(
                        'id'        => 'chameleon-header-icon',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Header Image', 'uoulib'),
                        'compiler'  => 'true',
                        'subtitle'      => __('Upload header Image.', 'uoulib'),
                        
                      

                    ),

                     array(
                        'id'        => 'chameleon-footer-icon',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Footer Logo', 'uoulib'),
                        'compiler'  => 'true',
                        'subtitle'      => __('Upload footer logo.', 'uoulib'),
                        
                      

                    ),



                    array(
                        'id'        => 'chameleon-share-button',
                        'type'      => 'switch',
                        'title'     => __('Share button', 'uoulib'),
                        'default'   => true,
                    ),


                    array(
                        'id'        => 'chameleon-share-button-facebook',
                        'type'      => 'switch',
                        'title'     => __(' Facebook Share button', 'uoulib'),
                        'default'   => true,
                    ),

                    array(
                        'id'        => 'chameleon-share-button-twitter',
                        'type'      => 'switch',
                        'title'     => __(' Twitter Share button', 'uoulib'),
                        'default'   => true,
                    ),

                    array(
                        'id'        => 'chameleon-share-button-google',
                        'type'      => 'switch',
                        'title'     => __(' Google Plus Share button', 'uoulib'),
                        'default'   => true,
                    ),

                    array(
                        'id'        => 'chameleon-share-button-linkedin',
                        'type'      => 'switch',
                        'title'     => __(' LinkedIn Share button', 'uoulib'),
                        'default'   => true,
                    ),

                    array(
                        'id'        => 'chameleon-share-button-envelope',
                        'type'      => 'switch',
                        'title'     => __(' Envelope Share button', 'uoulib'),
                        'default'   => true,
                    ),

                    array(
                        'id'        => 'chameleon-share-button-pinterest',
                        'type'      => 'switch',
                        'title'     => __(' Pinterest Share button', 'uoulib'),
                        'default'   => true,
                    ),


                    array(
                        'id'        => 'chameleon-top-language',
                        'type'      => 'switch',
                        'title'     => __('Show Language ', 'uoulib'),
                        'default'   => true,
                    ),

                    array(
                        'id'        => 'chameleon-language',
                        'type'      => 'multi_text',
                        'title'     => __('Language', 'uoulib'),
                        'required'  => array('chameleon-top-language', '=', '1'),
                        'default'   => array(
                            'en' => 'EN',
                            'de' => 'DE',
                            'it' => 'IT',
                            'fr' => 'FR',
                        )
                    ),


                    array(
                        'id'        => 'chameleon-login-option',
                        'type'      => 'switch',
                        'title'     => __('Login option', 'uoulib'),
                        'default'   => true,
                    ),


                    array(
                        'id'       => 'chameleon-wpml-select',
                        'type'     => 'select',
                        'title'    => __('WPML language show type', 'chameleon'),
                        'subtitle' => __('Select the type how you want to show language selector', 'chameleon'),
                        'desc'     => __('This select type will only work if WPML activated in your theme', 'chameleon'),

                        'options'  => array(
                            'code' => 'Language Code',
                            'name' => 'Language Name',
                            'flag' => 'Flag'
                        ),
                        'default'  => 'name',
                    ),



                )
            );




    /*
    |--------------------------------------------------------------------------
    | End Header settings
    |--------------------------------------------------------------------------
    |
    |
    |
    */
     /*
    |--------------------------------------------------------------------------
    | Start Chameleon Multi Top Bar Options settings
    |--------------------------------------------------------------------------
    |
    |
    |
    */

        $this->sections[] = array(
            'icon'      => 'el el-cog',
            'title'     => __('Multi Header Options', 'uoulib'),
            'fields'    => array(

                array(
                    'id'        => 'chameleon-header-switch',
                    'type'      => 'switch',
                    'title'     => __('Show Header', 'uoulib'),
                    'subtitle'  => __('Decide to show Header or Not', 'uoulib'),
                    'default'   => true,
                    ),
                
                array(
                    'id'        => 'chameleon-multi-header-image',
                    'type'      => 'image_select',
                    'title'     => __('chilepro Header images', 'uoulib'),
                    'subtitle'  => __('Select Which Header Image to show', 'uoulib'),
                    'options'  => Array(
                        '1'      =>  Array (
                                 'alt'  => 'default',
                                 'img'  =>  ReduxFramework::$_url.'assets/img/header/header1.png',
                            ),

                        '2'      =>  Array (
                                 'alt'  => 'Header 1',
                                 'img'  =>  ReduxFramework::$_url.'assets/img/header/header2.png',
                            ),

                        '3'      =>  Array (
                                 'alt'  => 'Header 2',
                                 'img'  =>  ReduxFramework::$_url.'assets/img/header/header3.png',
                            ),

                        '4'      =>  Array (
                                 'alt'  => 'Header 3',
                                 'img'  =>  ReduxFramework::$_url.'assets/img/header/header4.png',
                            ),

                        // '5'      =>  Array (
                        //          'alt'  => 'Header 4',
                        //          'img'  =>  ReduxFramework::$_url.'assets/img/header/header5.png',
                        //     ),

                        // '6'      =>  Array (
                        //          'alt'  => 'Header 5',
                        //          'img'  =>  ReduxFramework::$_url.'assets/img/header/header6.png',
                        //     ),

                        '7'      =>  Array (
                                 'alt'  => 'Header 6',
                                 'img'  =>  ReduxFramework::$_url.'assets/img/header/header7.png',
                            ),

                        '8'      =>  Array (
                                 'alt'  => 'Header 7',
                                 'img'  =>  ReduxFramework::$_url.'assets/img/header/header8.png',
                            ),

                        '9'      =>  Array (
                                 'alt'  => 'Header 8',
                                 'img'  =>  ReduxFramework::$_url.'assets/img/header/header9.png',
                            ),

                        '10'      =>  Array (
                                 'alt'  => 'Header 9',
                                 'img'  =>  ReduxFramework::$_url.'assets/img/header/header10.png',
                            ),

                        '11'      =>  Array (
                                 'alt'  => 'Header 10',
                                 'img'  =>  ReduxFramework::$_url.'assets/img/header/header11.png',
                            ),

                        '12'      =>  Array (
                                 'alt'  => 'Header 11',
                                 'img'  =>  ReduxFramework::$_url.'assets/img/header/header12.png',
                            ),

                        '13'      =>  Array (
                                 'alt'  => 'Header 12',
                                 'img'  =>  ReduxFramework::$_url.'assets/img/header/header13.png',
                            ),

                        '14'      =>  Array (
                                 'alt'  => 'Header 13',
                                 'img'  =>  ReduxFramework::$_url.'assets/img/header/header14.png',
                            ),

                        '15'      =>  Array (
                                 'alt'  => 'Header 14',
                                 'img'  =>  ReduxFramework::$_url.'assets/img/header/header15.png',
                            ),

                        '16'      =>  Array (
                                 'alt'  => 'Header 15',
                                 'img'  =>  ReduxFramework::$_url.'assets/img/header/header16.png',
                            ),

                        ),
                    'default'   => 1,
                ),
            )
        );


    /*
    |--------------------------------------------------------------------------
    | End  Chameleon Multi Top Bar Options settings
    |--------------------------------------------------------------------------
    |
    |
    |
    */

     /*
    |--------------------------------------------------------------------------
    | Start Chameleon Multi Top Bar Options settings
    |--------------------------------------------------------------------------
    |
    |
    |
    */

        $this->sections[] = array(
            'icon'      => 'el el-cog',
            'title'     => __('chilepro Multi TopBar Options', 'uoulib'),
            'fields'    => array(

                array(
                    'id'        => 'chameleon-top-bar-switch',
                    'type'      => 'switch',
                    'title'     => __('Show Tob Bar', 'uoulib'),
                    'subtitle'  => __('Decide to show Tob Bar or Not', 'uoulib'),
                    'default'   => true,
                    ),
                
                array(
                    'id'        => 'chameleon-multi-topBar-image',
                    'type'      => 'image_select',
                    'title'     => __('chilepro Top Bar images', 'uoulib'),
                    'subtitle'  => __('Select Which topBar Image to show', 'uoulib'),
                    'options'  => Array(
                        '1'      =>  Array (
                                 'alt'  => 'TopBar 1',
                                 'img'  =>  ReduxFramework::$_url.'assets/img/topBar/top1.png',
                            ),

                        '2'      =>  Array (
                                 'alt'  => 'TopBar 2',
                                 'img'  =>  ReduxFramework::$_url.'assets/img/topBar/top2.png',
                            ),

                        '3'      =>  Array (
                                 'alt'  => 'TopBar 3',
                                 'img'  =>  ReduxFramework::$_url.'assets/img/topBar/top3.png',
                            ),

                        '4'      =>  Array (
                                 'alt'  => 'TopBar 4',
                                 'img'  =>  ReduxFramework::$_url.'assets/img/topBar/top4.png',
                            ),

                        '5'      =>  Array (
                                 'alt'  => 'TopBar 5',
                                 'img'  =>  ReduxFramework::$_url.'assets/img/topBar/top5.png',
                            ),

                        '6'      =>  Array (
                                 'alt'  => 'Default Top Bar',
                                 'img'  =>  ReduxFramework::$_url.'assets/img/topBar/top6.png',
                            ),
                        '7'      =>  Array (
                                 'alt'  => 'Default Top Bar',
                                 'img'  =>  ReduxFramework::$_url.'assets/img/topBar/top7.png',
                            ),
                        '8'      =>  Array (
                                 'alt'  => 'Default Top Bar',
                                 'img'  =>  ReduxFramework::$_url.'assets/img/topBar/top8.png',
                            ),
                        '9'      =>  Array (
                                 'alt'  => 'Default Top Bar',
                                 'img'  =>  ReduxFramework::$_url.'assets/img/topBar/top9.png',
                            ),
                        '10'      =>  Array (
                                 'alt'  => 'Default Top Bar',
                                 'img'  =>  ReduxFramework::$_url.'assets/img/topBar/top10.png',
                            ),
                        '11'      =>  Array (
                                 'alt'  => 'Default Top Bar',
                                 'img'  =>  ReduxFramework::$_url.'assets/img/topBar/top11.png',
                            ),
                        '12'      =>  Array (
                                 'alt'  => 'Default Top Bar',
                                 'img'  =>  ReduxFramework::$_url.'assets/img/topBar/top12.png',
                            ),
                        '13'      =>  Array (
                                 'alt'  => 'Default Top Bar',
                                 'img'  =>  ReduxFramework::$_url.'assets/img/topBar/top13.png',
                            ),

                        ),
                    'default'   => 1,
                ),
            )
        );


    /*
    |--------------------------------------------------------------------------
    | End  Chameleon Multi Top Bar Options settings
    |--------------------------------------------------------------------------
    |
    |
    |
    */




     /*
    |--------------------------------------------------------------------------
    | Start Chameleon Multi Breadcrumb Options settings
    |--------------------------------------------------------------------------
    |
    |
    |
    */

$this->sections[] = array(
            'icon'      => 'el el-cog',
            'title'     => __('chilepro Multi-Breadcrumb Options', 'uoulib'),
            'fields'    => array(

                array(
                    'id'        => 'chameleon-breadcrumb-switch',
                    'type'      => 'switch',
                    'title'     => __('Show Breadcrumb', 'uoulib'),
                    'subtitle'  => __('Decide to show Breadcrumb or Not', 'uoulib'),
                    'default'   => true,
                    ),
                
                array(
                    'id'        => 'chameleon-multi-breadcrumb-image',
                    'type'      => 'image_select',
                    'title'     => __('chilepro Breadcrumb images', 'uoulib'),
                    'subtitle'  => __('Select Which breadcrumb Image to show', 'uoulib'),
                    'options'  => Array(
                        '1'      =>  Array (
                                 'alt'  => 'default',
                                 'img'  =>  ReduxFramework::$_url.'assets/img/breadcrumbs/crumb1.png',
                            ),

                        '2'      =>  Array (
                                 'alt'  => 'Breadcrumb 1',
                                 'img'  =>  ReduxFramework::$_url.'assets/img/breadcrumbs/crumb2.png',
                            ),

                        '3'      =>  Array (
                                 'alt'  => 'Breadcrumb 2',
                                 'img'  =>  ReduxFramework::$_url.'assets/img/breadcrumbs/crumb3.png',
                            ),

                        '4'      =>  Array (
                                 'alt'  => 'Breadcrumb 3',
                                 'img'  =>  ReduxFramework::$_url.'assets/img/breadcrumbs/crumb4.png',
                            ),

                        '5'      =>  Array (
                                 'alt'  => 'Breadcrumb 4',
                                 'img'  =>  ReduxFramework::$_url.'assets/img/breadcrumbs/crumb5.png',
                            ),

                        '6'      =>  Array (
                                 'alt'  => 'Breadcrumb 5',
                                 'img'  =>  ReduxFramework::$_url.'assets/img/breadcrumbs/crumb6.png',
                            ),

                        '7'      =>  Array (
                                 'alt'  => 'Breadcrumb 6',
                                 'img'  =>  ReduxFramework::$_url.'assets/img/breadcrumbs/crumb7.png',
                            ),

                        '8'      =>  Array (
                                 'alt'  => 'Breadcrumb 7',
                                 'img'  =>  ReduxFramework::$_url.'assets/img/breadcrumbs/crumb8.png',
                            ),

                        '9'      =>  Array (
                                 'alt'  => 'Breadcrumb 8',
                                 'img'  =>  ReduxFramework::$_url.'assets/img/breadcrumbs/crumb9.png',
                            ),

                        '10'      =>  Array (
                                 'alt'  => 'Breadcrumb 9',
                                 'img'  =>  ReduxFramework::$_url.'assets/img/breadcrumbs/crumb10.png',
                            ),

                        '11'      =>  Array (
                                 'alt'  => 'Breadcrumb 10',
                                 'img'  =>  ReduxFramework::$_url.'assets/img/breadcrumbs/crumb11.png',
                            ),

                        '12'      =>  Array (
                                 'alt'  => 'Breadcrumb 11',
                                 'img'  =>  ReduxFramework::$_url.'assets/img/breadcrumbs/crumb12.png',
                            ),

                        '13'      =>  Array (
                                 'alt'  => 'Breadcrumb 12',
                                 'img'  =>  ReduxFramework::$_url.'assets/img/breadcrumbs/crumb13.png',
                            ),

                        '14'      =>  Array (
                                 'alt'  => 'Breadcrumb 13',
                                 'img'  =>  ReduxFramework::$_url.'assets/img/breadcrumbs/crumb14.png',
                            ),

                        '15'      =>  Array (
                                 'alt'  => 'Header 14',
                                 'img'  =>  ReduxFramework::$_url.'assets/img/breadcrumbs/crumb15.png',
                            ),

                        '16'      =>  Array (
                                 'alt'  => 'Header 15',
                                 'img'  =>  ReduxFramework::$_url.'assets/img/breadcrumbs/crumb16.png',
                            ),

                        ),
                    'default'   => 1,
                ),
            )
        );


     /*
    |--------------------------------------------------------------------------
    | End Chameleon Multi Breadcrumb Options settings
    |--------------------------------------------------------------------------
    |
    |
    |
    */
     /*
    |--------------------------------------------------------------------------
    | Start Chameleon Multi Top Bar Options settings
    |--------------------------------------------------------------------------
    |
    |
    |
    */

        $this->sections[] = array(
            'icon'      => 'el el-cog',
            'title'     => __('chilepro Multi Blog Options', 'uoulib'),
            'fields'    => array(

                array(
                    'id'        => 'chameleon-blog-switch',
                    'type'      => 'switch',
                    'title'     => __('Show Tob Bar', 'uoulib'),
                    'subtitle'  => __('Decide to show Tob Bar or Not', 'uoulib'),
                    'default'   => true,
                    ),
                
                array(
                    'id'        => 'chameleon-multi-blog-image',
                    'type'      => 'image_select',
                    'title'     => __('chilepro Blog images', 'uoulib'),
                    'subtitle'  => __('Select Which Blog Image to show', 'uoulib'),
                    'options'  => Array(
                        '1'      =>  Array (
                                 'alt'  => 'blog 1',
                                 'img'  =>  ReduxFramework::$_url.'assets/img/SB-blog/blog1.png',
                            ),

                        '2'      =>  Array (
                                 'alt'  => 'blog 1',
                                 'img'  =>  ReduxFramework::$_url.'assets/img/SB-blog/blog2.png',
                            ),

                        '3'      =>  Array (
                                 'alt'  => 'blog 1',
                                 'img'  =>  ReduxFramework::$_url.'assets/img/SB-blog/blog3.png',
                            ),

                        '4'      =>  Array (
                                 'alt'  => 'blog 1',
                                 'img'  =>  ReduxFramework::$_url.'assets/img/SB-blog/blog4.png',
                            ),
                        ),
                    'default'   => 1,
                ),
            )
        );


    /*
    |--------------------------------------------------------------------------
    | End  Chameleon Multi Top Bar Options settings
    |--------------------------------------------------------------------------
    |
    |
    |
    */
   



 
    /*
    |--------------------------------------------------------------------------
    | Start Construction settings
    |--------------------------------------------------------------------------
    |
    |
    |
    */


        $this->sections[] = array(

            'icon'      => 'el el-cog',
            'title'     => __('chilepro Template', 'uoulib'),
            'fields'    => array(


                array(
                        'id'          => 'chameleon-construction-header-slider',
                        'type'        => 'slides',
                        'title'       => __('chilepro Slider Imeges', 'uoulib'),
                        'subtitle'    => __('chilepro Unlimited slides with drag and drop sortings.', 'redux-framework-demo'),
                        ),


                    array(
                        'id'        => 'chameleon-construction-testimonial-footer-banner-image',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('chilepro testimonial Image', 'uoulib'),
                        'compiler'  => 'true',
                        'desc'      => __('change your testimonial footer banner image', 'uoulib'),
                    ),
        ),
);



 

            


     /*
    |--------------------------------------------------------------------------
    | Start Social Options settings
    |--------------------------------------------------------------------------
    |
    |
    |
    */

            $this->sections[] = array(

                'icon'  => 'el-icon-myspace',
                'title' => __('Social Profile Link', 'uoulib'),

                'fields' => array(

                    array(
                        'id'        => 'chameleon-social-profile',
                        'type'      => 'switch',
                        'title'     => __('Social Profile', 'uoulib'),
                        'default'   => false,
                    ),

                    array(
                        'id'        => 'chameleon-social-profile-title',
                        'type'      => 'text',
                        'title'     => __('Social Profile Title', 'uoulib'),

                    ),

                    array(
                        'id'        => 'chameleon-facebook-profile',
                        'type'      => 'text',
                        'title'     => __('Facebook', 'uoulib'),

                    ),

                    array(
                        'id'        => 'chameleon-twitter-profile',
                        'type'      => 'text',
                        'title'     => __('Twitter', 'uoulib'),
                    ),

                    array(
                        'id'        => 'chameleon-google-profile',
                        'type'      => 'text',
                        'title'     => __('Google', 'uoulib'),

                    ),

                    array(
                        'id'        => 'chameleon-linkedin-profile',
                        'type'      => 'text',
                        'title'     => __('Linkedin', 'uoulib'),

                    ),

                    array(
                        'id'        => 'chameleon-pinterest-profile',
                        'type'      => 'text',
                        'title'     => __('Pinterest', 'uoulib'),

                    ),

                )
            );

    /*
    |--------------------------------------------------------------------------
    | End Social Options settings
    |--------------------------------------------------------------------------
    |
    |
    |
    */

  








    /*
    |--------------------------------------------------------------------------
    | Start Footer Options settings
    |--------------------------------------------------------------------------
    |
    |
    |
    */


        $this->sections[] = array(
            'icon'      => 'el-icon-photo',
            'title'     => __('Footer Options', 'uoulib'),
            'fields'    => array(

                array(
                    'id'        => 'chameleon-left-footer-switch',
                    'type'      => 'switch',
                    'title'     => __('Show Footer Widgets', 'uoulib'),
                    'subtitle'  => __('Decide show chilepro Footer Widgets or Not', 'uoulib'),
                    'default'   => true,
                ),
				 array(
                    'id'        => 'chameleon-footer-menu-switch',
                    'type'      => 'switch',
                    'title'     => __('Show Footer Menu', 'uoulib'),
                    'subtitle'  => __('Decide to show Footer Menu or Not', 'uoulib'),
                    'default'   => true,
                ),

                array(
                    'id'        => 'chameleon-footer-switch',
                    'type'      => 'switch',
                    'title'     => __('Show Footer', 'uoulib'),
                    'subtitle'  => __('Decide to show Footer or Not', 'uoulib'),
                    'default'   => true,
                ),				
                
                array(
                    'id'        => 'chameleon-show-footer-copyrights',
                    'type'      => 'switch',
                    'title'     => __('Show Footer Copyrights', 'uoulib'),
                    'subtitle'  => __('Decide show Footer copyrights or Not', 'uoulib'),
                    'default'   => true,
                ),
				 array(
                    'id'        => 'chameleon-show-footer-credits',
                    'type'      => 'switch',
                    'title'     => __('Show Footer Credits of uouapps', 'uoulib'),
                    'subtitle'  => __('Decide show Footer Credits of uouapp or Not', 'uoulib'),
                    'default'   => true,
                ), 
				
				
                 array(
                    'id'        => 'chameleon-address-contact',
                    'type'      => 'text',
                    'title'     => __('Contact address', 'uoulib'),
                    'subtitle'  => __('Enter address', 'uoulib'),
                    'placeholder' => __('Enter address','uoulib'),
                    'default'  => '350 Fifth Avenue, 34th floor, New York, NY 10118-3299 USA',
                ),
                
                
                
                 array(
                    'id'        => 'chameleon-contact-bg-image',
                    'type'      => 'media',
                    'title'     => __('Contact Background Image', 'uoulib'),
                    'subtitle'  => __('Select Background Image', 'uoulib'),
                    'placeholder' => __('Select Background Imag','uoulib'),
                ),
                 array(
                    'id'        => 'chameleon-email-contact',
                    'type'      => 'text',
                    'title'     => __('Contact email', 'uoulib'),
                    'subtitle'  => __('Enter email', 'uoulib'),
                    'placeholder' => __('Enter email','uoulib'),
                    'default'  => 'test@test.com',
                ),
                 array(
                    'id'        => 'chameleon-phone-contact',
                    'type'      => 'text',
                    'title'     => __('Contact phone', 'uoulib'),
                    'subtitle'  => __('Enter phone', 'uoulib'),
                    'placeholder' => __('Enter phone','uoulib'),
                    'default'  => '+4534435345',
                ),
                
                
                array(
                    'id'        => 'chameleon-copyright-text',
                    'type'      => 'text',
                    'title'     => __('Copyright Text', 'uoulib'),
                    'subtitle'  => __('Enter your copyright text', 'uoulib'),
                    'placeholder' => __('&copy; Copyright 2016 ','uoulib'),
                    'default'  => '&copy; Copyright 2016 ',
                    
                ),
	
                array(
                    'id'        => 'chameleon-after-copyright-text',
                    'type'      => 'text',
                    'title'     => __('After Copyright Text', 'uoulib'),
                    'subtitle'  => __('Enter your After copyright text', 'uoulib'),
                    'placeholder' => __('All rights reserved.','uoulib'),
                    'default'  => ' All rights reserved. ',
                ),

                array(
                    'id'        => 'chameleon-privacy',
                    'type'      => 'text',
                    'title'     => __('Privacy Policy', 'uoulib'),
                    'subtitle'  => __('Enter your company Privacy Policy link', 'uoulib'),
                    'placeholder' => __('www.example.com','uoulib'),
                    'default'  => ''
                ),

                array(
                    'id'        => 'chameleon-condition',
                    'type'      => 'text',
                    'title'     => __('Terms & Conditions', 'uoulib'),
                    'subtitle'  => __('Enter your Terms & Conditions link', 'uoulib'),
                    'placeholder' => __('www.example.com','uoulib'),                    
                    'default'  => '',
                ),
                 
            )
        );




    /*
    |--------------------------------------------------------------------------
    | End Footer Options settings
    |--------------------------------------------------------------------------
    |
    |
    |
    */


    /*
    |--------------------------------------------------------------------------
    | Start Styling Options settings
    |--------------------------------------------------------------------------
    |
    |
    |
    */


            $this->sections[] = array(
                'icon'      => 'el-icon-website',
                'title'     => __('Styling Options', 'uoulib'),
                'fields'    => array(


                    array(
                        'id'        => 'chameleon-select-stylesheet',
                        'type'      => 'select',
                        'title'     => __('Theme Stylesheet', 'uoulib'),
                        'subtitle'  => __('Select your themes alternative color scheme.', 'uoulib'),
                        'options'   => array(
                            'style-switcher.css' => 'Default',
                            'gold.css' => 'Gold',
                        ),
                        'default'   => 'style-switcher.css',
                    ),


                    array(
                        'id'            => 'chameleon-body-typography',
                        'type'          => 'typography',
                        'title'         => __('Body', 'uoulib'),
                        'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup'   => true,    // Select a backup non-google font in addition to a google font
                        'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
                        'subsets'       => false, // Only appears if google is true and subsets not set to false
                        'font-size'     => false,
                        'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
                        'output'        => array('body'), // An array of CSS selectors to apply this font style to dynamically
                        'units'         => 'px', // Defaults to px
                        'default'   => '',

                    ),



                    array(
                        'id'            => 'chameleon-header-typography',
                        'type'          => 'typography',
                        'title'         => __('Header', 'uoulib'),
                        'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup'   => true,    // Select a backup non-google font in addition to a google font
                        'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
                        'subsets'       => false, // Only appears if google is true and subsets not set to false
                        'font-size'     => false,
                        'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
                        'output'        => array('h1','h2','h3','h4','h5'), // An array of CSS selectors to apply this font style to dynamically

                        'units'         => 'px', // Defaults to px
                        'default'   => '',
                    ),

                )
            );


    /*
    |--------------------------------------------------------------------------
    | End Styling Options settings
    |--------------------------------------------------------------------------
    |
    |
    |
    */





 






    /*
    |--------------------------------------------------------------------------
    | End Construction settings
    |--------------------------------------------------------------------------
    |
    |
    |
    */












            $theme_info  = '<div class="redux-framework-section-desc">';
            $theme_info .= '<p class="redux-framework-theme-data description theme-uri">' . __('<strong>Theme URL:</strong> ', 'uoulib') . '<a href="' . $this->theme->get('ThemeURI') . '" target="_blank">' . $this->theme->get('ThemeURI') . '</a></p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-author">' . __('<strong>Author:</strong> ', 'uoulib') . $this->theme->get('Author') . '</p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-version">' . __('<strong>Version:</strong> ', 'uoulib') . $this->theme->get('Version') . '</p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-description">' . $this->theme->get('Description') . '</p>';
            $tabs = $this->theme->get('Tags');
            if (!empty($tabs)) {
                $theme_info .= '<p class="redux-framework-theme-data description theme-tags">' . __('<strong>Tags:</strong> ', 'uoulib') . implode(', ', $tabs) . '</p>';
            }
            $theme_info .= '</div>';

            if (file_exists(dirname(__FILE__) . '/../README.md')) {
                $this->sections['theme_docs'] = array(
                    'icon'      => 'el-icon-list-alt',
                    'title'     => __('Documentation', 'uoulib'),
                    'fields'    => array(
                        array(
                            'id'        => '17',
                            'type'      => 'raw',
                            'markdown'  => true,
                            'content'   => wp_remote_fopen(dirname(__FILE__) . '/../README.md')
                        ),
                    ),
                );
            }


            $this->sections[] = array(
                'title'     => __('Import / Export', 'uoulib'),
                'desc'      => __('Import and Export your Redux Framework settings from file, text or URL.', 'uoulib'),
                'icon'      => 'el-icon-refresh',
                'fields'    => array(
                    array(
                        'id'            => 'opt-import-export',
                        'type'          => 'import_export',
                        'title'         => 'Import Export',
                        'subtitle'      => 'Save and restore your Redux options',
                        'full_width'    => false,
                    ),
                ),
            );


//
//            $this->sections[] = array(
//                'icon'      => 'el-icon-info-sign',
//                'title'     => __('Theme Information', 'uoulib'),
//                'desc'      => __('<p class="description">This is the Description. Again HTML is allowed</p>', 'uoulib'),
//                'fields'    => array(
//                    array(
//                        'id'        => 'opt-raw-info',
//                        'type'      => 'raw',
//                        'content'   => $item_info,
//                    )
//                ),
//            );

            
        }

        public function setHelpTabs() {

            // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-1',
                'title'     => __('Theme Information 1', 'uoulib'),
                'content'   => __('<p>This is the tab content, HTML is allowed.</p>', 'uoulib')
            );

            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-2',
                'title'     => __('Theme Information 2', 'uoulib'),
                'content'   => __('<p>This is the tab content, HTML is allowed.</p>', 'uoulib')
            );

            // Set the help sidebar
            $this->args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', 'uoulib');
        }

        /**

          All the possible arguments for Redux.
          For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments

         * */
        public function setArguments() {

            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $this->args = array(
                // TYPICAL -> Change these values as you need/desire
                'opt_name'          => 'chameleon_option_data',            // This is where your data is stored in the database and also becomes your global variable name.
                'display_name'      => $theme->get('Name'),     // Name that appears at the top of your panel
                'display_version'   => $theme->get('Version'),  // Version that appears at the top of your panel
                'menu_type'         => 'menu',                  //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu'    => false,                    // Show the sections below the admin menu item or not
                'menu_title'        => __('Medical Theme Options', 'uoulib'),
                'page_title'        => __('chilepro', 'uoulib'),

                // You will need to generate a Google API key to use this feature.
                // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                'google_api_key' => '', // Must be defined to add google fonts to the typography module

                'async_typography'  => false,                    // Use a asynchronous font on the front end or font string
                'admin_bar'         => true,                    // Show the panel pages on the admin bar
                'global_variable'   => '',                      // Set a different name for your global variable other than the opt_name
                'dev_mode'          => false,                    // Show the time the page took to load, etc
                'customizer'        => true,                    // Enable basic customizer support

                // OPTIONAL -> Give you extra features
                'page_priority'     => null,                    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                'page_parent'       => 'themes.php',            // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                'page_permissions'  => 'manage_options',        // Permissions needed to access the options panel.
                'menu_icon'         => '',                      // Specify a custom URL to an icon
                'last_tab'          => '',                      // Force your panel to always open to a specific tab (by id)
                'page_icon'         => 'icon-themes',           // Icon displayed in the admin panel next to your menu_title
                'page_slug'         => 'chameleon_options',              // Page slug used to denote the panel
                'save_defaults'     => true,                    // On load save the defaults to DB before user clicks save or not
                'default_show'      => false,                   // If true, shows the default value next to each field that is not the default value.
                'default_mark'      => '',                      // What to print by the field's title if the value shown is default. Suggested: *
                'show_import_export' => true,                   // Shows the Import/Export panel when not used as a field.

                // CAREFUL -> These options are for advanced use only
                'transient_time'    => 60 * MINUTE_IN_SECONDS,
                'output'            => true,                    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                'output_tag'        => true,                    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

                // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                'database'              => '', // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                'system_info'           => false, // REMOVE

                // HINTS
                // 'hints' => array(
                //     'icon'          => 'icon-question-sign',
                //     'icon_position' => 'right',
                //     'icon_color'    => 'lightgray',
                //     'icon_size'     => 'normal',
                //     'tip_style'     => array(
                //         'color'         => 'light',
                //         'shadow'        => true,
                //         'rounded'       => false,
                //         'style'         => '',
                //     ),
                //     'tip_position'  => array(
                //         'my' => 'top left',
                //         'at' => 'bottom right',
                //     ),
                //     'tip_effect'    => array(
                //         'show'          => array(
                //             'effect'        => 'slide',
                //             'duration'      => '500',
                //             'event'         => 'mouseover',
                //         ),
                //         'hide'      => array(
                //             'effect'    => 'slide',
                //             'duration'  => '500',
                //             'event'     => 'click mouseleave',
                //         ),
                //     ),
                // )
            );


            // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
            $this->args['share_icons'][] = array(
                'url'   => 'https://github.com/uouapps',
                'title' => 'Visit us on GitHub',
                'icon'  => 'el-icon-github'
                //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
            );
            $this->args['share_icons'][] = array(
                'url'   => 'https://www.facebook.com/pages/UOUapps/281914991973646',
                'title' => 'Like us on Facebook',
                'icon'  => 'el-icon-facebook'
            );
            $this->args['share_icons'][] = array(
                'url'   => 'https://twitter.com/uouapps',
                'title' => 'Follow us on Twitter',
                'icon'  => 'el-icon-twitter'
            );
            $this->args['share_icons'][] = array(
                'url'   => 'http://linkedin.com/company/uou-apps',
                'title' => 'Find us on LinkedIn',
                'icon'  => 'el-icon-linkedin'
            );

            // Panel Intro text -> before the form
            if (!isset($this->args['global_variable']) || $this->args['global_variable'] !== false) {
                if (!empty($this->args['global_variable'])) {
                    $v = $this->args['global_variable'];
                } else {
                    $v = str_replace('-', '_', $this->args['opt_name']);
                }
              //  $this->args['intro_text'] = sprintf(__('<p>Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: <strong>$%1$s</strong></p>', 'uoulib'), $v);
            } else {
              //  $this->args['intro_text'] = __('<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'uoulib');
            }

            // Add content after the form.
         //   $this->args['footer_text'] = __('<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', 'uoulib');
        }

    }

    global $reduxConfig;
    $reduxConfig = new chameleon_admin_config();
}

/**
  Custom function for the callback referenced above
 */
if (!function_exists('redux_my_custom_field')):
    function redux_my_custom_field($field, $value) {
        print_r($field);
        echo '<br/>';
        print_r($value);
    }
endif;

/**
  Custom function for the callback validation referenced above
 * */
if (!function_exists('redux_validate_callback_function')):
    function redux_validate_callback_function($field, $value, $existing_value) {
        $error = false;
        $value = 'just testing';

        /*
          do your validation

          if(something) {
            $value = $value;
          } elseif(something else) {
            $error = true;
            $value = $existing_value;
            $field['msg'] = 'your custom error message';
          }
         */

        $return['value'] = $value;
        if ($error == true) {
            $return['error'] = $field;
        }
        return $return;
    }
endif;
