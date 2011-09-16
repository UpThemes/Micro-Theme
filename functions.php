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
require_once( get_template_directory_uri() . 'admin/admin.php' ); 

/**
 * Include the Header Extensions Functions File
 */
require_once( get_template_directory_uri() . 'inc/extensions/header-extensions.php' );

/**
 * Include the Comments Extensions Functions File
 * 
 * The /inc/extensions/comments-extensions.php file defines
 * all of the Theme's callback functions that hook into
 * Theme custom and WordPress action/filter hooks in comments.php
 *  - micro_comments
 *  - wp_list_comments (callback)
 */
require_once( get_template_directory_uri() . 'inc/extensions/comments-extensions.php' );

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
 *  - micro_post_type()
 *  - micro_time_posted()
 */
require_once( get_template_directory_uri() . 'inc/extensions/content-extensions.php' );

/**
 * Include the Footer Extensions Functions File
 * 
 * The /inc/extensions/footer-extensions.php file defines
 * all of the Theme's callback functions that hook into
 * Theme custom and WordPress action/filter hooks in footer.php
 *  - micro_footer
 *  - wp_footer
 */
require_once( get_template_directory_uri() . 'inc/extensions/footer-extensions.php' );

/**
 * Include the Sidebar Extensions Functions File
 * 
 * The /inc/extensions/sidebar-extensions.php file defines
 * all of the Theme's callback functions that hook into
 * Theme custom and WordPress action/filter hooks in sidebar.php
 * and sidebar-footer.php
 *  - micro_before_sidebar
 */
require_once( get_template_directory_uri() . 'inc/extensions/sidebar-extensions.php' );

/**
 * Include the Helper Functions File
 * 
 * The /inc/helpers.php file defines
 * all of the Theme's general, custom/helper functions
 *  - attach_image_content()
 *  - convert_url_to_embed()
 *  - woo_tumblog_image()
 */
require_once( get_template_directory_uri() . 'inc/helpers.php' );

/**
 * Include the Media Functions File
 * 
 * The /inc/media.php file defines 
 * all of the Theme's custom, media-handling functions
 *  - micro_audio_content()
 *  - micro_resize_video()
 *  - micro_tumblog_embed()
 */
require_once( get_template_directory_uri() . 'inc/media.php' );

/**
 * Include the Header Extensions Functions File
 * 
 * The /inc/hooks.php file defines
 * all of the Theme's custom hook template functions
 */
require_once( get_template_directory_uri() . 'inc/hooks.php' );

/**
 * Include the Navigation Functions File
 * 
 * The /inc/navigation.php file defines
 * all of the Theme's custom, navigation functions
 *  - get_the_page_count()
 * 
 * This file also defines navigation-related callback 
 * functions hooked into custom Theme hooks
 *  - micro_after_posts
 */
require_once( get_template_directory_uri() . 'inc/navigation.php' );

/**
 * Include the Header Extensions Functions File
 * 
 * The /inc/expressapp.php file defines
 * SOMETHING THAT I DON'T KNOW YET
 */
require_once( get_template_directory_uri() . 'inc/expressapp.php' );

/**
 * Include the Tumblog Metaboxes Functions File
 * 
 * The /inc/metaboxes/tumblog-meta.php file includes
 * the Theme's Tumblog metabox functions
 */
require_once( get_template_directory_uri() . 'inc/metaboxes/tumblog-meta.php' );

/**
 * Include the Theme Update Functions File
 * 
 * The /inc/update.php file includes
 * the Theme's automatic update functions
 */
require_once( get_template_directory_uri() . 'inc/update.php' );



/**
 * Set $content_width
 * 
 * Set the global $content_width variable,
 * which is used for dynamic resizing of 
 * embedded images and video. Also, 
 * 
 * @link 	http://codex.wordpress.org/Function_Reference/add_image_size 		add_image_size()
 * 
 * @since	Micro 1.0
 */
function micro_set_content_width(){

	define( 'CONTENT_WIDTH', 500 );

	global $content_width;

	$content_width = CONTENT_WIDTH;
	
	add_image_size( 'full-width-image', $content_width, 99999, 0 );

}
// Hook micro_set_content_width() into after_setup_theme
add_action('after_setup_theme','micro_set_content_width');

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
	
	deregister_theme_layout('left_column_grid');
	deregister_theme_layout('right_column_grid');
	
	add_theme_support( 'post-formats', array( 'aside', 'image', 'link', 'quote', 'status', 'video', 'audio', 'gallery' ) );
	add_theme_support( 'nav-menus' );
	add_theme_support( 'automatic-feed-links' );
	register_nav_menu( 'primary', __('Navigation','micro') );

	wp_enqueue_script('scrolling',get_template_directory_uri() . '/inc/scripts/scrolling/scrolling.js' );
	
	add_custom_background();

}
// Hook micro_theme_init() into init
add_action('init','micro_theme_init');

/**
 * Enqueue link for responsive CSS stylesheet
 * 
 * @since	Micro 1.0
 */
function micro_make_responsive(){

	echo "<link href=\"" . get_template_directory_uri() . "/inc/styles/responsive.css\" type=\"text/css\" rel=\"stylesheet\" media=\"screen\">";

}
// Hook micro_make_responsive() into wp_head
add_action('wp_head','micro_make_responsive',9999);

//This cannot be contained in an init hook
add_theme_support( 'post-thumbnails' );

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
 * Filter the Excerpt More text
 * 
 * Returns a "Continue Reading" link for excerpts,
 * rather than the default "[...]" text.
 * 
 * @link 	http://codex.wordpress.org/Function_Reference/esc_url		esc_url()
 * @link 	http://codex.wordpress.org/Function_Reference/get_permalink	get_permalink()
 *
 * @since Micro 1.0
 */
function micro_continue_reading_link() {
	return ' <a href="'. esc_url( get_permalink() ) . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'micro' ) . '</a>';
}

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