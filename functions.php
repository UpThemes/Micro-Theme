<?php

require_once('admin/admin.php'); 
require_once('inc/extensions/header-extensions.php');
require_once('inc/extensions/comments-extensions.php');
require_once('inc/extensions/content-extensions.php');
require_once('inc/extensions/footer-extensions.php');
require_once('inc/extensions/sidebar-extensions.php');
require_once('inc/helpers.php');
require_once('inc/media.php');
require_once('inc/hooks.php');
require_once('inc/navigation.php');
require_once('inc/expressapp.php');
require_once('inc/metaboxes/tumblog-meta.php');

function micro_set_content_width(){

	define('CONTENT_WIDTH',500);
		
	global $content_width;

	$content_width = CONTENT_WIDTH;
	
	add_image_size('full-width-image',$content_width,99999,0);

}

add_action('after_setup_theme','micro_set_content_width');

/**
 * Set up our theme support, layouts, and menu.
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

	wp_enqueue_script('scrolling',get_bloginfo('template_directory') . '/inc/scripts/scrolling/scrolling.js' );
	
	add_custom_background();

}
add_action('init','micro_theme_init');

//This cannot be contained in an init hook
add_theme_support( 'post-thumbnails' );

/**
 * Register our sidebars and widgetized areas.
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
add_action( 'widgets_init', 'micro_widgets_init' );

/**
 * Sets the post excerpt length to 40 words.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 */
function micro_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'micro_excerpt_length' );

/**
 * Returns a "Continue Reading" link for excerpts
 */
function micro_continue_reading_link() {
	return ' <a href="'. esc_url( get_permalink() ) . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'micro' ) . '</a>';
}

/**
 * Count the number of footer sidebars to enable dynamic classes for the footer
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