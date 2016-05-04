<?php

/**
 *  XXL admin panel settings .
 * @since       Version 1.0
 */



if (!class_exists('tiger_admin_config')) {

    class tiger_admin_config {

        public $args        = array();
        public $sections    = array();
        public $theme;
        public $ReduxFramework;

        public function __construct() {

            if (!class_exists('ReduxFramework')) {
                return;
            }

            // This is needed. Bah WordPress bugs.  ;)
           
            $this->initSettings();
            

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
                'title' => esc_html__('Section via hook', 'tiger'),
                'desc' => esc_html__('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'tiger'),
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

            $customize_title = sprintf(esc_html__('Customize &#8220;%s&#8221;', 'tiger'), $this->theme->display('Name'));

            ?>
            <div id="current-theme" class="<?php echo esc_attr($class); ?>">
            <?php if ($screenshot) : ?>
                <?php if (current_user_can('edit_theme_options')) : ?>
                        <a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize" title="<?php echo esc_attr($customize_title); ?>">
                            <img src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview','tiger'); ?>" />
                        </a>
                <?php endif; ?>
                    <img class="hide-if-customize" src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview','tiger'); ?>" />
                <?php endif; ?>

                <h4><?php echo esc_attr($this->theme->display('Name')); ?></h4>

                <div>
                    <ul class="theme-info">
                        <li><?php printf(esc_html__('By %s', 'tiger'), $this->theme->display('Author')); ?></li>
                        <li><?php printf(esc_html__('Version %s', 'tiger'), $this->theme->display('Version')); ?></li>
                        <li><?php echo '<strong>' . esc_html__('Tags', 'tiger') . ':</strong> '; ?><?php printf($this->theme->display('Tags')); ?></li>
                    </ul>
                    <p class="theme-description"><?php echo esc_attr($this->theme->display('Description')); ?></p>
            <?php
            if ($this->theme->parent()) {
                printf(' <p class="howto">' . esc_html__('This <a href="%1$s">child theme</a> requires its parent theme, %2$s.','tiger') . '</p>', esc_html__('http://codex.wordpress.org/Child_Themes', 'tiger'), $this->theme->parent()->display('Name'));
            }
            ?>

                </div>
            </div>

            <?php
            $item_info = ob_get_contents();

            ob_end_clean();

            $sampleHTML = '';
           
            



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

                'title'     => esc_html__('Home Settings', 'tiger'),
                'icon'      => 'el-icon-home',

                'fields'    => array(
					
					
				array(
                        'id'        => 'tiger-show-page-banner-image',
                        'type'      => 'switch',
                        'title'     => esc_html__('Top banner image with text', 'tiger'),
                        'default'   => true,
                    ),
				 
                    
				 array(
                        'id'        => 'tiger-home-banner-image',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => esc_html__('Home Top Banner image', 'tiger'),
                        'subtitle'      => esc_html__('Best fit 1349 X 420 px.', 'tiger'),
                        'compiler'  => 'true',
                        'desc'      => esc_html__('Upload Home Image.', 'tiger'),
                    ),
                    
                        
                     array(
                        'id'        => 'tiger-home-banner-text',
                        'type'      => 'textarea',
                        'title'     => esc_html__('Banner Image Title', 'tiger'), 
						'compiler'  => 'true',
						'validate' => 'html',
                        'default' => esc_html__('Here comes the social networking platform that you’ve been waiting',"tiger"),
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
                        'id'        => 'tiger-home-banner-subtitle',
                        'type'      => 'textarea',
                        'title'     => esc_html__('Banner Image sub title', 'tiger'), 
						'compiler'  => 'true',
						'validate' 	=> 'html',
                        'default' 	=>esc_html__( "This is Photoshop's version of Lorem Ipsum proin venin consequat veniam.","tiger"),
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
                        'id'        => 'tiger-show-page-row2',
                        'type'      => 'switch',
                        'title'     => esc_html__('Row #2 Hide/show (3 Blocks)  ', 'tiger'),
                        'default'   => true,
                    ),
				 
                     array(
                        'id'        => 'tiger-home-row2-block1',
                        'type'      => 'textarea',
                        'title'     => esc_html__('Row #2 Block-1 Content ', 'tiger'), 
                        'subtitle'      => esc_html__('Home Page 1st top block content.', 'tiger'),
						'compiler'  => 'true',
						'validate' => 'html',
                        'default' => esc_html__('Stay in touch with your colleagues',"tiger"),
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
                        'id'        => 'tiger-home-row2-block1-sub',
                        'type'      => 'textarea',
                        'title'     => esc_html__('Row #2 Block-1 Sub Content ', 'tiger'), 
                        'subtitle'      => esc_html__('Home Page 1st top block sub content', 'tiger'),
						'compiler'  => 'true',
						'validate' => 'html',
                        'default' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Proin nibh augue conseqaut nibbhi ellit ipsum consectetur.',"tiger"),
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
                        'id'        => 'tiger-home-row2-block2',
                        'type'      => 'textarea',
                        'title'     => esc_html__('Row #2 Block-2 Content ', 'tiger'), 
                        'subtitle'      => esc_html__('Home Page 2nd top block content.', 'tiger'),
						'compiler'  => 'true',
						'validate' => 'html',
                        'default' => esc_html__('Get the latest news in your industry',"tiger"),
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
                        'id'        => 'tiger-home-row2-block2-sub',
                        'type'      => 'textarea',
                        'title'     => esc_html__('Row #2 Block-2 Sub Content ', 'tiger'), 
                        'subtitle'      => esc_html__('Home Page 2nd top block sub content', 'tiger'),
						'compiler'  => 'true',
						'validate' => 'html',
                        'default' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Proin nibh augue conseqaut nibbhi ellit ipsum consectetur.',"tiger"),
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
                        'id'        => 'tiger-home-row2-block3',
                        'type'      => 'textarea',
                        'title'     => esc_html__('Row #2 Block-3 Content ', 'tiger'), 
                        'subtitle'      => esc_html__('Home Page 3rd top block content.', 'tiger'),
						'compiler'  => 'true',
						'validate' => 'html',
                        'default' => esc_html__('Share what’s up  with you',"tiger"),
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
                        'id'        => 'tiger-home-row2-block3-sub',
                        'type'      => 'textarea',
                        'title'     => esc_html__('Row #2 Block-3 Sub Content ', 'tiger'), 
                        'subtitle'      => esc_html__('Home Page 3rd top block sub content', 'tiger'),
						'compiler'  => 'true',
						'validate' => 'html',
                        'default' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Proin nibh augue conseqaut nibbhi ellit ipsum consectetur.',"tiger"),
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
                    // Fow3 Start******************
                    	
					array(
							'id'        => 'tiger-show-page-row3',
							'type'      => 'switch',
							'title'     => esc_html__('Home page Row 3 Show/Hide', 'tiger'),
							'subtitle'      => esc_html__('Home page Row 3 Show/Hide (include 2 rows, 1st left image+ content  & 2nd right image +content ).', 'tiger'),
							'default'   => true,
						),
					 
						
					 array(
							'id'        => 'tiger-home-row3-image',
							'type'      => 'media',
							'url'       => true,
							'title'     => esc_html__('Home Row 3 left image', 'tiger'),
							//'subtitle'      => esc_html__('Best fit 1349 X 420 px.', 'tiger'),
							'compiler'  => 'true',
							'desc'      => esc_html__('Upload Home Image.', 'tiger'),
						),
                     array(
                        'id'        => 'tiger-home-row3-block',
                        'type'      => 'textarea',
                        'title'     => esc_html__('Row #2 Block-3 Content ', 'tiger'), 
                        'subtitle'      => esc_html__('Home Page 3rd top block content.', 'tiger'),
						'compiler'  => 'true',
						'validate' => 'html',
                        'default' => esc_html__('Interact with other professionals',"tiger"),
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
                        'id'        => 'tiger-home-row3-block-sub',
                        'type'      => 'textarea',
                        'title'     => esc_html__('Row #3 Sub Content ', 'tiger'), 
                        'subtitle'      => esc_html__('Home Page Row #3 sub content', 'tiger'),
						'compiler'  => 'true',
						'validate' => 'html',
                        'default' => esc_html__(' Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.',"tiger"),
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
							'id'        => 'tiger-home-row3-image2',
							'type'      => 'media',
							'url'       => true,
							'title'     => esc_html__('Home Row 3 left image 2', 'tiger'),
							//'subtitle'      => esc_html__('Best fit 1349 X 420 px.', 'tiger'),
							'compiler'  => 'true',
							'desc'      => esc_html__('Upload Home Image.', 'tiger'),
						),
                     array(
                        'id'        => 'tiger-home-row3-block2',
                        'type'      => 'textarea',
                        'title'     => esc_html__('Row #2 Block-3 Content 2 ', 'tiger'), 
                        'subtitle'      => esc_html__('Home Page 3rd top block content.', 'tiger'),
						'compiler'  => 'true',
						'validate' => 'html',
                        'default' => esc_html__('Collaborate on a project',"tiger"),
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
                        'id'        => 'tiger-home-row3-block-sub2',
                        'type'      => 'textarea',
                        'title'     => esc_html__('Row #3 Sub Content 2 ', 'tiger'), 
                        'subtitle'      => esc_html__('Home Page Row #3 sub content 2', 'tiger'),
						'compiler'  => 'true',
						'validate' => 'html',
                        'default' => esc_html__(' Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.',"tiger"),
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
                    //end Row 3**
                     
                    /*
                    array(
                        'id'        => 'tiger-favicon',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => esc_html__('Custom Favicon', 'tiger'),
                        'compiler'  => 'true',
                        'desc'      => esc_html__('Upload custom favicon.', 'tiger'),
                    ),


                    array(
                        'id'        => 'tiger-favicon-iphone',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => esc_html__('Custom Favicon For iphone', 'tiger'),
                        'compiler'  => 'true',
                        'desc'      => esc_html__('Upload custom favicon for iphone.', 'tiger'),

                    ),


                    array(
                        'id'        => 'tiger-favicon-ipad',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => esc_html__('Custom Favicon For ipad', 'tiger'),
                        'compiler'  => 'true',
                        'desc'      => esc_html__('Upload custom favicon for ipad', 'tiger'),

                    ),

                    */


                    array(
                        'id'        => 'tiger-show-page-sidebar',
                        'type'      => 'switch',
                        'title'     => esc_html__('Page Templates With Sidebar', 'tiger'),
                        'default'   => false,
                    ),




                    array(
                        'id'        => 'tiger-custom-css',
                        'type'      => 'ace_editor',
                        'title'     => esc_html__('Custom CSS ', 'tiger'),
                        'subtitle'  => esc_html__('Paste your custom CSS code here.', 'tiger'),
                        'mode'      => 'css',
                        'theme'     => 'monokai',
                    ),


                    array(
                        'id'        => 'tiger-custom-js',
                        'type'      => 'ace_editor',
                        'title'     => esc_html__('Custom JS', 'tiger'),
                        'subtitle'  => esc_html__('Paste your JS code here.', 'tiger'),
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
                'title'     => esc_html__('Header Settings', 'tiger'),
                'fields'    => array(


                    array(
                        'id'        => 'tiger-header-icon',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => esc_html__('Header Logo', 'tiger'),
                        'compiler'  => 'true',
                        'subtitle'      => esc_html__('Upload header logo.', 'tiger'),
                        
                      

                    ),

                     array(
                        'id'        => 'tiger-footer-icon',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => esc_html__('Footer Logo', 'tiger'),
                        'compiler'  => 'true',
                        'subtitle'      => esc_html__('Upload footer logo.', 'tiger'),
                        
                      

                    ),



                    array(
                        'id'        => 'tiger-share-button',
                        'type'      => 'switch',
                        'title'     => esc_html__('Share button', 'tiger'),
                        'default'   => true,
                    ),


                    array(
                        'id'        => 'tiger-share-button-facebook',
                        'type'      => 'switch',
                        'title'     => esc_html__(' Facebook Share button', 'tiger'),
                        'default'   => true,
                    ),

                    array(
                        'id'        => 'tiger-share-button-twitter',
                        'type'      => 'switch',
                        'title'     => esc_html__(' Twitter Share button', 'tiger'),
                        'default'   => true,
                    ),

                    array(
                        'id'        => 'tiger-share-button-google',
                        'type'      => 'switch',
                        'title'     => esc_html__(' Google Plus Share button', 'tiger'),
                        'default'   => true,
                    ),

                    array(
                        'id'        => 'tiger-share-button-linkedin',
                        'type'      => 'switch',
                        'title'     => esc_html__(' LinkedIn Share button', 'tiger'),
                        'default'   => true,
                    ),

                    array(
                        'id'        => 'tiger-share-button-envelope',
                        'type'      => 'switch',
                        'title'     => esc_html__(' Envelope Share button', 'tiger'),
                        'default'   => true,
                    ),

                    array(
                        'id'        => 'tiger-share-button-pinterest',
                        'type'      => 'switch',
                        'title'     => esc_html__(' Pinterest Share button', 'tiger'),
                        'default'   => true,
                    ),


                    array(
                        'id'        => 'tiger-top-language',
                        'type'      => 'switch',
                        'title'     => esc_html__('Show Language ', 'tiger'),
                        'default'   => true,
                    ),

                    array(
                        'id'        => 'tiger-language',
                        'type'      => 'multi_text',
                        'title'     => esc_html__('Language', 'tiger'),
                        'required'  => array('tiger-top-language', '=', '1'),
                        'default'   => array(
                            'en' => 'EN',
                            'de' => 'DE',
                            'it' => 'IT',
                            'fr' => 'FR',
                        )
                    ),


                    array(
                        'id'        => 'tiger-login-option',
                        'type'      => 'switch',
                        'title'     => esc_html__('Login option', 'tiger'),
                        'default'   => true,
                    ),


                    array(
                        'id'       => 'tiger-wpml-select',
                        'type'     => 'select',
                        'title'    => esc_html__('WPML language show type', 'tiger'),
                        'subtitle' => esc_html__('Select the type how you want to show language selector', 'tiger'),
                        'desc'     => esc_html__('This select type will only work if WPML activated in your theme', 'tiger'),

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
    | Start tiger Multi Top Bar Options settings
    |--------------------------------------------------------------------------
    |
    |
    |
    */

        $this->sections[] = array(
            'icon'      => 'el el-cog',
            'title'     => esc_html__('Multi Header Options', 'tiger'),
            'fields'    => array(

                array(
                    'id'        => 'tiger-header-switch',
                    'type'      => 'switch',
                    'title'     => esc_html__('Show Header', 'tiger'),
                    'subtitle'  => esc_html__('Decide to show Header or Not', 'tiger'),
                    'default'   => true,
                    ),
                
                array(
                    'id'        => 'tiger-multi-header-image',
                    'type'      => 'image_select',
                    'title'     => esc_html__('tiger Header images', 'tiger'),
                    'subtitle'  => esc_html__('Select Which Header Image to show', 'tiger'),
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
    | End  tiger Multi Top Bar Options settings
    |--------------------------------------------------------------------------
    |
    |
    |
    */

     /*
    |--------------------------------------------------------------------------
    | Start tiger Multi Top Bar Options settings
    |--------------------------------------------------------------------------
    |
    |
    |
    */

        $this->sections[] = array(
            'icon'      => 'el el-cog',
            'title'     => esc_html__('Tiger Multi TopBar Options', 'tiger'),
            'fields'    => array(

                array(
                    'id'        => 'tiger-top-bar-switch',
                    'type'      => 'switch',
                    'title'     => esc_html__('Show Tob Bar', 'tiger'),
                    'subtitle'  => esc_html__('Decide to show Tob Bar or Not', 'tiger'),
                    'default'   => true,
                    ),
                
                array(
                    'id'        => 'tiger-multi-topBar-image',
                    'type'      => 'image_select',
                    'title'     => esc_html__('tiger Top Bar images', 'tiger'),
                    'subtitle'  => esc_html__('Select Which topBar Image to show', 'tiger'),
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
    | End  tiger Multi Top Bar Options settings
    |--------------------------------------------------------------------------
    |
    |
    |
    */




     /*
    |--------------------------------------------------------------------------
    | Start tiger Multi Top Bar Options settings
    |--------------------------------------------------------------------------
    |
    |
    |
    */

        $this->sections[] = array(
            'icon'      => 'el el-cog',
            'title'     => esc_html__('Tiger Multi Blog Options', 'tiger'),
            'fields'    => array(

                array(
                    'id'        => 'tiger-blog-switch',
                    'type'      => 'switch',
                    'title'     => esc_html__('Show Tob Bar', 'tiger'),
                    'subtitle'  => esc_html__('Decide to show Tob Bar or Not', 'tiger'),
                    'default'   => true,
                    ),
                
                array(
                    'id'        => 'tiger-multi-blog-image',
                    'type'      => 'image_select',
                    'title'     => esc_html__('tiger Blog images', 'tiger'),
                    'subtitle'  => esc_html__('Select Which Blog Image to show', 'tiger'),
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
    | End  tiger Multi Top Bar Options settings
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
            'title'     => esc_html__('Tiger Template', 'tiger'),
            'fields'    => array(


                array(
                        'id'          => 'tiger-construction-header-slider',
                        'type'        => 'slides',
                        'title'       => esc_html__('tiger Slider Imeges', 'tiger'),
                        'subtitle'    => esc_html__('tiger Unlimited slides with drag and drop sortings.', 'redux-framework-demo'),
                        ),


                    array(
                        'id'        => 'tiger-construction-testimonial-footer-banner-image',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => esc_html__('tiger testimonial Image', 'tiger'),
                        'compiler'  => 'true',
                        'desc'      => esc_html__('change your testimonial footer banner image', 'tiger'),
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
                'title' => esc_html__('Social Profile Link', 'tiger'),

                'fields' => array(

                    array(
                        'id'        => 'tiger-social-profile',
                        'type'      => 'switch',
                        'title'     => esc_html__('Social Profile', 'tiger'),
                        'default'   => false,
                    ),

                    array(
                        'id'        => 'tiger-social-profile-title',
                        'type'      => 'text',
                        'title'     => esc_html__('Social Profile Title', 'tiger'),

                    ),

                    array(
                        'id'        => 'tiger-facebook-profile',
                        'type'      => 'text',
                        'title'     => esc_html__('Facebook', 'tiger'),

                    ),

                    array(
                        'id'        => 'tiger-twitter-profile',
                        'type'      => 'text',
                        'title'     => esc_html__('Twitter', 'tiger'),
                    ),

                    array(
                        'id'        => 'tiger-google-profile',
                        'type'      => 'text',
                        'title'     => esc_html__('Google', 'tiger'),

                    ),

                    array(
                        'id'        => 'tiger-linkedin-profile',
                        'type'      => 'text',
                        'title'     => esc_html__('Linkedin', 'tiger'),

                    ),

                    array(
                        'id'        => 'tiger-pinterest-profile',
                        'type'      => 'text',
                        'title'     => esc_html__('Pinterest', 'tiger'),

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
            'title'     => esc_html__('Footer Options', 'tiger'),
            'fields'    => array(

                array(
                    'id'        => 'tiger-left-footer-switch',
                    'type'      => 'switch',
                    'title'     => esc_html__('Show Footer Widgets', 'tiger'),
                    'subtitle'  => esc_html__('Decide show tiger Footer Widgets or Not', 'tiger'),
                    'default'   => true,
                ),
				 array(
                    'id'        => 'tiger-footer-menu-switch',
                    'type'      => 'switch',
                    'title'     => esc_html__('Show Footer Menu', 'tiger'),
                    'subtitle'  => esc_html__('Decide to show Footer Menu or Not', 'tiger'),
                    'default'   => true,
                ),

                array(
                    'id'        => 'tiger-footer-switch',
                    'type'      => 'switch',
                    'title'     => esc_html__('Show Footer', 'tiger'),
                    'subtitle'  => esc_html__('Decide to show Footer or Not', 'tiger'),
                    'default'   => true,
                ),				
                
                array(
                    'id'        => 'tiger-show-footer-copyrights',
                    'type'      => 'switch',
                    'title'     => esc_html__('Show Footer Copyrights', 'tiger'),
                    'subtitle'  => esc_html__('Decide show Footer copyrights or Not', 'tiger'),
                    'default'   => true,
                ),
				 array(
                    'id'        => 'tiger-show-footer-credits',
                    'type'      => 'switch',
                    'title'     => esc_html__('Show Footer Credits of uouapps', 'tiger'),
                    'subtitle'  => esc_html__('Decide show Footer Credits of uouapp or Not', 'tiger'),
                    'default'   => true,
                ), 
				
				
                 array(
                    'id'        => 'tiger-address-contact',
                    'type'      => 'text',
                    'title'     => esc_html__('Contact address', 'tiger'),
                    'subtitle'  => esc_html__('Enter address', 'tiger'),
                    'placeholder' => esc_html__('Enter address','tiger'),
                    'default'  => esc_html__("350 Fifth Avenue, 34th floor, New York, NY 10118-3299 USA",'tiger'), 
                ),
                
                
                
                 array(
                    'id'        => 'tiger-contact-bg-image',
                    'type'      => 'media',
                    'title'     => esc_html__('Contact Background Image', 'tiger'),
                    'subtitle'  => esc_html__('Select Background Image', 'tiger'),
                    'placeholder' => esc_html__('Select Background Image','tiger'),
                ),
                 array(
                    'id'        => 'tiger-email-contact',
                    'type'      => 'text',
                    'title'     => esc_html__('Contact email', 'tiger'),
                    'subtitle'  => esc_html__('Enter email', 'tiger'),
                    'placeholder' => esc_html__('Enter email','tiger'),
                    'default'  => 'test@test.com',
                ),
                 array(
                    'id'        => 'tiger-phone-contact',
                    'type'      => 'text',
                    'title'     => esc_html__('Contact phone', 'tiger'),
                    'subtitle'  => esc_html__('Enter phone', 'tiger'),
                    'placeholder' => esc_html__('Enter phone','tiger'),
                    'default'  => esc_html__('+4534435345','tiger'), '',
                ),
                
                
                array(
                    'id'        => 'tiger-copyright-text',
                    'type'      => 'text',
                    'title'     => esc_html__('Copyright Text', 'tiger'),
                    'subtitle'  => esc_html__('Enter your copyright text', 'tiger'),
                    'placeholder' => esc_html__('&copy; Copyright 2016 ','tiger'),
                    'default'  => esc_html__('&copy; Copyright 2016 ', 'tiger'), 
                    
                ),
				 array(
                    'id'        => 'tiger-copyright-link',
                    'type'      => 'text',
                    'title'     => esc_html__('Copyright link', 'tiger'),
                    'subtitle'  => esc_html__('Enter your copyright link', 'tiger'),
                    'placeholder' => esc_html__('www.example.com ','tiger'),
                    
                    
                ),
                array(
                    'id'        => 'tiger-after-copyright-text',
                    'type'      => 'text',
                    'title'     => esc_html__('After Copyright Text', 'tiger'),
                    'subtitle'  => esc_html__('Enter your After copyright text', 'tiger'),
                    'placeholder' => esc_html__('All rights reserved.','tiger'),
                    'default'  =>esc_html__(' All rights reserved. ', 'tiger'), 
                ),

                array(
                    'id'        => 'tiger-privacy',
                    'type'      => 'text',
                    'title'     => esc_html__('Privacy Policy', 'tiger'),
                    'subtitle'  => esc_html__('Enter your company Privacy Policy link', 'tiger'),
                    'placeholder' => esc_html__('www.example.com','tiger'),
                    'default'  => ''
                ),

                array(
                    'id'        => 'tiger-condition',
                    'type'      => 'text',
                    'title'     => esc_html__('Terms & Conditions', 'tiger'),
                    'subtitle'  => esc_html__('Enter your Terms & Conditions link', 'tiger'),
                    'placeholder' => esc_html__('www.example.com','tiger'),                    
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
                'title'     => esc_html__('Styling Options', 'tiger'),
                'fields'    => array(


                    array(
                        'id'        => 'tiger-select-stylesheet',
                        'type'      => 'select',
                        'title'     => esc_html__('Theme Stylesheet', 'tiger'),
                        'subtitle'  => esc_html__('Select your themes alternative color scheme.', 'tiger'),
                        'options'   => array(
                            'style-switcher.css' => 'Default',
                            'gold.css' => 'Gold',
                        ),
                        'default'   => 'style-switcher.css',
                    ),


                    array(
                        'id'            => 'tiger-body-typography',
                        'type'          => 'typography',
                        'title'         => esc_html__('Body', 'tiger'),
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
                        'id'            => 'tiger-header-typography',
                        'type'          => 'typography',
                        'title'         => esc_html__('Header', 'tiger'),
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
            $theme_info .= '<p class="redux-framework-theme-data description theme-uri">' . esc_html__('<strong>Theme URL:</strong> ', 'tiger') . '<a href="' . $this->theme->get('ThemeURI') . '" target="_blank">' . $this->theme->get('ThemeURI') . '</a></p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-author">' . esc_html__('<strong>Author:</strong> ', 'tiger') . $this->theme->get('Author') . '</p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-version">' . esc_html__('<strong>Version:</strong> ', 'tiger') . $this->theme->get('Version') . '</p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-description">' . $this->theme->get('Description') . '</p>';
            $tabs = $this->theme->get('Tags');
            if (!empty($tabs)) {
                $theme_info .= '<p class="redux-framework-theme-data description theme-tags">' . esc_html__('<strong>Tags:</strong> ', 'tiger') . implode(', ', $tabs) . '</p>';
            }
            $theme_info .= '</div>';

           
            /*

            $this->sections[] = array(
                'title'     => esc_html__('Import / Export', 'tiger'),
                'desc'      => esc_html__('Import and Export your Redux Framework settings from file, text or URL.', 'tiger'),
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
            */

//
//            $this->sections[] = array(
//                'icon'      => 'el-icon-info-sign',
//                'title'     => esc_html__('Theme Information', 'tiger'),
//                'desc'      => esc_html__('<p class="description">This is the Description. Again HTML is allowed</p>', 'tiger'),
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
                'title'     => esc_html__('Theme Information 1', 'tiger'),
                'content'   => esc_html__('<p>This is the tab content, HTML is allowed.</p>', 'tiger')
            );

            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-2',
                'title'     => esc_html__('Theme Information 2', 'tiger'),
                'content'   => esc_html__('<p>This is the tab content, HTML is allowed.</p>', 'tiger')
            );

            // Set the help sidebar
            $this->args['help_sidebar'] = esc_html__('<p>This is the sidebar content, HTML is allowed.</p>', 'tiger');
        }

        /**

          All the possible arguments for Redux.
          For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments

         * */
        public function setArguments() {

            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $this->args = array(
                // TYPICAL -> Change these values as you need/desire
                'opt_name'          => 'tiger_option_data',            // This is where your data is stored in the database and also becomes your global variable name.
                'display_name'      => $theme->get('Name'),     // Name that appears at the top of your panel
                'display_version'   => $theme->get('Version'),  // Version that appears at the top of your panel
                'menu_type'         => 'menu',                  //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu'    => false,                    // Show the sections below the admin menu item or not
                'menu_title'        => esc_html__('Tiger Theme Options', 'tiger'),
                'page_title'        => esc_html__('tiger', 'tiger'),

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
                'page_slug'         => 'tiger_options',              // Page slug used to denote the panel
                'save_defaults'     => true,                    // On load save the defaults to DB before user clicks save or not
                'default_show'      => false,                   // If true, shows the default value next to each field that is not the default value.
                'default_mark'      => '',                      // What to print by the field's title if the value shown is default. Suggested: *
                'show_import_export' => false,                   // Shows the Import/Export panel when not used as a field.

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
              //  $this->args['intro_text'] = sprintf(esc_html__('<p>Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: <strong>$%1$s</strong></p>', 'tiger'), $v);
            } else {
              //  $this->args['intro_text'] = esc_html__('<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'tiger');
            }

            // Add content after the form.
         //   $this->args['footer_text'] = esc_html__('<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', 'tiger');
        }

    }

    global $reduxConfig;
    $reduxConfig = new tiger_admin_config();
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
