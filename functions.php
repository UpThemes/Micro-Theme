<?php
/**
 * Theme functions file
 *
 * Contains all of the Theme's setup functions, custom functions,
 * custom Widgets, custom hooks, and Theme settings.
 * 
 * For ease of understanding the different functionality and
 * purpose of all the functions, this file is split into several
 * sub-files, each of which is called below. Refer to each
 * sub-file for documentation of each included function.
 * 
 * To facilitate creation of Child Themes for Micro, these
 * sub-files are included via get_template_directory(), rather
 * than get_stylesheet_directory(). Using get_template_directory()
 * ensures that WordPress will always search the template, i.e.
 * Parent Theme, directory for these files. Thus, they do not
 * need to be copied to the Child Theme in order to work. Also,
 * this allows Child Themes to create their own custom functions,
 * Widgets, options, hooks, etc., that work alongside those
 * provided here.
 *
 * For more information on hooks, actions, and filters, 
 * see {@link http://codex.wordpress.org/Plugin_API Plugin API}.
 * 
 * @link 		http://codex.wordpress.org/Function_Reference/get_template_directory 	get_template_directory()
 * 
 * @link 		http://php.net/manual/en/function.require-once.php 						require_once()
 * 
 * @package 	Micro
 * @copyright	Copyright (c) 2011, UpThemes
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 *
 * @since 		Micro 1.0
 */


/**
 * Define THEME_NAME constant
 */
define( 'THEME_NAME', 'micro' );

/**
 * Bootstrap the UpThemes Framework
 */
require_once( get_template_directory() . '/admin/admin.php' ); 

/**
 * Include the Header Extensions Functions File
 */
require_once( get_template_directory() . '/inc/extensions/header-extensions.php' );

/**
 * Include the Comments Extensions Functions File
 * 
 * The /inc/extensions/comments-extensions.php file defines
 * all of the Theme's callback functions that hook into
 * Theme custom and WordPress action/filter hooks in comments.php
 *  - micro_comments
 *  - wp_list_comments (callback)
 */
require_once( get_template_directory() . '/inc/extensions/comments-extensions.php' );

/**
 * Include the Content Extensions Functions File
 * 
 * The /inc/extensions/content-extensions.php file defines
 * all of the Theme's callback functions that hook into
 * Theme custom and WordPress action/filter hooks in content.php, 
 * content-page.php, and content-single.php
 *  - micro_post_footer
 *  - micro_post_header
 *  - micro_postmeta
 *  - the_content
 * 
 * This file also defines content-related custom functions:
 *  - micro_author_details()
 *  - micro_gallery()
 *  - micro_image_grid()
 *  - micro_image_list()
 *  - micro_image_slider()
 *  - micro_no_posts()
 *  - micro_post_images()
 *  - micro_time_posted()
 */
require_once( get_template_directory() . '/inc/extensions/content-extensions.php' );

/**
 * Include the Footer Extensions Functions File
 * 
 * The /inc/extensions/footer-extensions.php file defines
 * all of the Theme's callback functions that hook into
 * Theme custom and WordPress action/filter hooks in footer.php
 *  - micro_footer
 *  - wp_footer
 */
require_once( get_template_directory() . '/inc/extensions/footer-extensions.php' );

/**
 * Include the Sidebar Extensions Functions File
 * 
 * The /inc/extensions/sidebar-extensions.php file defines
 * all of the Theme's callback functions that hook into
 * Theme custom and WordPress action/filter hooks in sidebar.php
 * and sidebar-footer.php
 *  - micro_before_sidebar
 */
require_once( get_template_directory() . '/inc/extensions/sidebar-extensions.php' );

/**
 * Include the Helper Functions File
 * 
 * The /inc/helpers.php file defines
 * all of the Theme's general, custom/helper functions
 *  - micro_convert_url_to_embed()
 *  - woo_tumblog_image()
 */
require_once( get_template_directory() . '/inc/helpers.php' );

/**
 * Include the Media Functions File
 * 
 * The /inc/media.php file defines 
 * all of the Theme's custom, media-handling functions
 *  - micro_resize_video()
 *  - micro_tumblog_embed()
 */
require_once( get_template_directory() . '/inc/media.php' );

/**
 * Include the Header Extensions Functions File
 * 
 * The /inc/hooks.php file defines
 * all of the Theme's custom hook template functions
 */
require_once( get_template_directory() . '/inc/hooks.php' );

/**
 * Include the Navigation Functions File
 * 
 * The /inc/navigation.php file defines
 * all of the Theme's custom, navigation functions
 *  - micro_get_the_page_count()
 * 
 * This file also defines navigation-related callback 
 * functions hooked into custom Theme hooks
 *  - micro_after_posts
 */
require_once( get_template_directory() . '/inc/navigation.php' );

/**
 * Include the Header Extensions Functions File
 * 
 * The /inc/expressapp.php file integrates 
 * the WooExpress App functionality.
 */
require_once( get_template_directory() . '/inc/expressapp.php' );

/**
 * Include the Tumblog Metaboxes Functions File
 * 
 * The /inc/metaboxes/tumblog-meta.php file includes
 * the Theme's Tumblog metabox functions
 */
require_once( get_template_directory() . '/inc/metaboxes/tumblog-meta.php' );

/**
 * Include the Theme Update Functions File
 * 
 * The /inc/update.php file includes
 * the Theme's automatic update functions
 */
require_once( get_template_directory() . '/inc/update.php' );

/**
 * Theme initialization/setup function
 * 
 * Add Theme support for Post Formats, Custom Navigation
 * Menus, Automatic Feed Links, and Custom Background.
 * Also, deregister Theme layouts, register the "primary"
 * navigation menu Theme Location, and enqueue the JS
 * "scrolling" script.
 * 
 * @link 	http://codex.wordpress.org/Function_Reference/add_custom_background 	add_custom_background()
 * @link 	http://codex.wordpress.org/Function_Reference/add_image_size 			add_image_size()
 * @link 	http://codex.wordpress.org/Function_Reference/add_theme_support 		add_theme_support()
 * @link 	http://codex.wordpress.org/Function_Reference/deregister_theme_layout 	deregister_theme_layout()
 * @link 	http://codex.wordpress.org/Function_Reference/register_nav_menu			register_nav_menu()
 * @link 	http://codex.wordpress.org/Function_Reference/wp_enqueue_script 		wp_enqueue_script()
 *
 * @since Micro 1.0
 */
function micro_theme_init(){

	// Setup content width
	define( 'CONTENT_WIDTH', 700 );

	global $content_width;

	if ( ! isset( $content_width ) ) {
		$content_width = CONTENT_WIDTH;
	}
	
	// Add Theme support for Post Thumbnails
	add_theme_support( 'post-thumbnails' );
	
	// Add custom image sizes
	add_image_size( 'full-width-image', $content_width, 99999, 0 );
	
	add_theme_support( 'post-formats', array( 'aside', 'image', 'link', 'quote', 'status', 'video', 'audio', 'gallery' ) );
	add_theme_support( 'nav-menus' );
	add_theme_support( 'automatic-feed-links' );
	register_nav_menu( 'primary', __('Navigation','micro') );
	
	add_custom_background();

	define('HEADER_TEXTCOLOR', '222222');
	define('HEADER_IMAGE', '%s/images/theme-logo.png'); // %s is the template dir uri
	define('HEADER_IMAGE_WIDTH', 140); // use width and height appropriate for your theme
	define('HEADER_IMAGE_HEIGHT', 140);

	add_custom_image_header( 'micro_header_style', 'micro_admin_header_style' );

}
// Hook micro_theme_init() into after_setup_theme action
add_action( 'after_setup_theme', 'micro_theme_init' );

/**
 * Configure UpThemes Framework
 * 
 * Deregisters theme layouts added by 
 * the UpThemes Framework.
 * 
 * @uses 	deregister_theme_layout		Defined in /admin/library/engines/layout-engine.php
 *
 * @since Micro 1.0
 */
function micro_upfw_config() {
	
	deregister_theme_layout('left_column_grid');
	deregister_theme_layout('right_column_grid');

}
// Hook micro_upfw_config() into the init action, 
// so that it fires AFTER framework is bootstrapped
add_action( 'init', 'micro_upfw_config' );

/**
 * Header image CSS displayed on website front-end
 * 
 * @since	Micro 1.0
 */
function micro_header_style() {
    ?><style type="text/css">
        .blog-information a{
            background: url(<?php header_image(); ?>);
            width: <?php echo HEADER_IMAGE_WIDTH; ?>px;
            height: <?php echo HEADER_IMAGE_HEIGHT; ?>px;
            text-indent: -9000px;
            text-align: left;
            margin: 0 auto 10px;
            max-width: 100%;
			display: block;
			background-position: center center;
			background-repeat: no-repeat;
        }
    </style><?php
}

/**
 * Include header default styles in admin preview
 * 
 * @since	Micro 1.0
 */
function micro_admin_header_style() {
    ?><style type="text/css">
        #headimg {
            width: <?php echo HEADER_IMAGE_WIDTH; ?>px;
            height: <?php echo HEADER_IMAGE_HEIGHT; ?>px;
			background-position: center center;
			background-repeat: no-repeat;
        }
		#headimg #name{
			text-indent: -9000px;
			overflow: hidden;
			display: block;	
		}
		
		#desc{
			display: none;
		}
		
    </style><?php
}

/**
 * Register theme Widgetized Sidebars
 * 
 * The Micro Theme includes four Widgetized sidebars: 
 * the "Main Sidebar", as well as three Widgetized
 * footer areas.
 * 
 * @link 	http://codex.wordpress.org/Function_Reference/register_sidebar	register_sidebar()
 *
 * @since Micro 1.0
 */
function micro_widgets_init() {

	register_sidebar( array(
		'name' => __( 'Main Sidebar', 'micro' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Area One', 'micro' ),
		'id' => 'sidebar-3',
		'description' => __( 'An optional widget area for your site footer', 'micro' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Area Two', 'micro' ),
		'id' => 'sidebar-4',
		'description' => __( 'An optional widget area for your site footer', 'micro' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Area Three', 'micro' ),
		'id' => 'sidebar-5',
		'description' => __( 'An optional widget area for your site footer', 'micro' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
// Hook micro_widgets_init() into widgets_init
add_action( 'widgets_init', 'micro_widgets_init' );

/**
 * Filter the Excerpt Length
 * 
 * Sets the excerpt length to 40 words.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 *
 * @since Micro 1.0
 */
function micro_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'micro_excerpt_length' );

/**
 * Dynamically set CSS class for footer Widget container
 * 
 * Count the number of footer sidebars to enable dynamic 
 * classes for the footer. Dynamically sets the container 
 * class to 'class="class-one"', 'class="class-two"', or
 * 'class="class-three"', depending on the number of
 * footer Widget areas active.
 *
 * @since Micro 1.0
 */
function micro_footer_sidebar_class() {
	$count = 0;

	if ( is_active_sidebar( 'sidebar-3' ) )
		$count++;

	if ( is_active_sidebar( 'sidebar-4' ) )
		$count++;

	if ( is_active_sidebar( 'sidebar-5' ) )
		$count++;

	$class = '';

	switch ( $count ) {
		case '1':
			$class = 'one';
			break;
		case '2':
			$class = 'two';
			break;
		case '3':
			$class = 'three';
			break;
	}

	if ( $class )
		echo 'class="' . $class . '"';
}

?>