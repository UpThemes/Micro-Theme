<?php
/**
 * Theme Header Extension Functions file
 * 
 * The /inc/extensions/header-extensions.php file defines
 * all of the Theme's callback functions that hook into
 * Theme custom and WordPress action/filter hooks in header.php:
 *  - micro_before_header
 *  - wp_enqueue_scripts
 *  - wp_print_styles
 * 
 * @link 		http://codex.wordpress.org/Function_Reference/add_action 	add_action()
 * 
 * @package 	Micro
 * @copyright	Copyright (c) 2011, UpThemes
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 *
 * @since 		Micro 1.0
 */

/**
 * Enqueue Theme Scripts
 * 
 * Enqueues the third-party scripts used by the 
 * Theme, including jPlayer, FancyBox, FancyBox 
 * MouseWheel and Easing, FlexSlider, Modernizr, 
 * and custom Theme scripts.
 * 
 * This function hooked into the WordPress 
 * wp_print_scripts hook, which fires in the 
 * wp_head() template tag, in the header.php 
 * template file.
 * 
 * @link 	http://codex.wordpress.org/Function_Reference/comments_open 				comments_open()
 * @link 	http://codex.wordpress.org/Function_Reference/get_option 					get_option()
 * @link 	http://codex.wordpress.org/Function_Reference/get_template_directory_uri 	get_template_directory_uri()
 * @link 	http://codex.wordpress.org/Function_Reference/is_single 					is_single()
 * @link 	http://codex.wordpress.org/Function_Reference/wp_enqueue_script 			wp_enqueue_script()
 * 
 * @param	none
 * @return	string	Enqueued scripts
 * 
 * @since	Micro 1.0
 * 
 */
function micro_add_scripts(){
	
	/* JPlayer Mini Audio Player */
	wp_enqueue_script( 'jplayer', get_template_directory_uri() . '/inc/scripts/jplayer/jquery.jplayer.min.js', array( 'jquery' ) );
    wp_enqueue_script( 'fancybox', get_template_directory_uri() . '/inc/scripts/fancybox/jquery.fancybox-1.3.4.pack.js', array( 'jquery' ) );
    wp_enqueue_script( 'fancybox-mousewheel', get_template_directory_uri() . '/inc/scripts/fancybox/jquery.mousewheel-3.0.4.pack.js', array( 'jquery' ) );
    wp_enqueue_script( 'fancybox-easing', get_template_directory_uri() . '/inc/scripts/fancybox/jquery.easing-1.3.pack.js', array( 'jquery' ) );
	wp_enqueue_script( 'flexslider', get_template_directory_uri() . '/inc/scripts/flexslider/jquery.flexslider-min.js', array( 'jquery' ) );
	wp_enqueue_script( 'micro', get_template_directory_uri() . '/inc/scripts/global.js', array( 'jquery' ) );
	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/inc/scripts/modernizr-2.0.6.min.js' );
	// Moved form micro_init() function
	wp_enqueue_script( 'scrolling', get_template_directory_uri() . '/inc/scripts/scrolling/scrolling.js' );
	// Enqueue comment-reply script
	if ( is_single() && comments_open() ) {
		if ( get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
		global $up_options;
		wp_enqueue_script( 'disqus', 'http://disqus.com/forums/' . $up_options->disqus . '/embed.js', array(), false, true );
	}

}
// Hook micro_add_scripts() into wp_print_scripts
add_action( 'wp_enqueue_scripts', 'micro_add_scripts' );

/**
 * Enqueue High-Priority Theme Stylesheets
 * 
 * Enqueues the third-party stylesheets used by the 
 * Theme, including FlexSlider.
 * 
 * This function hooked into the WordPress 
 * wp_print_styles hook, which fires in the 
 * wp_head() template tag, in the header.php 
 * template file.
 * 
 * @param	none
 * @return	string	Enqueued stylesheets
 * 
 * @since	Micro 1.0
 * 
 */
function micro_add_styles(){
	wp_enqueue_style('flexslider', get_template_directory_uri() . '/inc/scripts/flexslider/flexslider.css');
}
// Hook micro_add_styles() into wp_print_styles
add_action('wp_print_styles','micro_add_styles',1);

/**
 * Enqueue Low-Priority Theme Stylesheets
 * 
 * Enqueues the third-party stylesheets used by the 
 * Theme, including FancyBox and jPlayer, as well as 
 * custom stylesheets used by the Theme.
 * 
 * This function hooked into the WordPress 
 * wp_print_styles hook, which fires in the 
 * wp_head() template tag, in the header.php 
 * template file.
 * 
 * @param	none
 * @return	string	Enqueued stylesheets
 * 
 * @since	Micro 1.0
 * 
 */
function micro_custom_styles(){
	
	global $up_options;
	
	if( !is_admin() && !in_array( $GLOBALS['pagenow'], array( 'wp-login.php', 'wp-register.php' ) ) ):
		
		$styles = '<style type="text/css">';
		
		if( $up_options->default_link_color )
			$styles .= "a{ color: {$up_options->default_link_color}; }";
	
		if( $up_options->visited_link_color )
			$styles .= "a:visited{ color: {$up_options->visited_link_color}; }";
	
		if( $up_options->hover_link_color )
			$styles .= "a:hover{ color: {$up_options->hover_link_color}; }";
	
		if( $up_options->active_link_color )
			$styles .= "a:active{ color: {$up_options->active_link_color}; }";
		
		if( $up_options->content_text_color )
			$styles .= "#content .post_content,.navigation{ color: {$up_options->content_text_color}; }";
		
		$styles .= '</style>';
		
		echo $styles;
		
	endif;
        
		// Fancybox
        wp_enqueue_style('fancybox', get_template_directory_uri() . '/inc/scripts/fancybox/jquery.fancybox-1.3.4.css');
		
		// JPlayer Audio
		wp_enqueue_style('jplayer', get_template_directory_uri() . '/inc/scripts/jplayer/skin.css');
	
}
// Hook micro_custom_styles() into wp_print_styles
add_action('wp_print_styles','micro_custom_styles',40);

/**
 * Add Custom Theme Classes to HTML Body Tag
 * 
 * Adds custom classes to the HTML Body tag, 
 * based on the Theme options for post 
 * container class and widget container 
 * class, as well as light/dark Widget color, 
 * and RTL support.
 * 
 * This function is passed as an argument to the 
 * body_class() template tag, which is called 
 * in the header.php template file.
 * 
 * Template file: header.php
 * 
 * @param	none
 * @return	string	space-separated list of CSS classes
 * 
 * @since	Micro 1.0
 * 
 */
function micro_body_class( $body_class ){
	
	global $up_options;
	
	if( $up_options->post_container != true )
		$body_class[] = 'contain_posts';

	if( $up_options->widget_container != true )
		$body_class[] = 'contain_widgets';

	if( $up_options->sidebar_text_color == 'light' )
		$body_class[] = 'widgets_light';
	else
		$body_class[] = 'widgets_dark';

	if(	$up_options->rtl_support == true )
		$body_class[] = 'rtl';
		
	return $body_class;
	
}
// Hook micro_body_class() into the body_class filter
add_filter( 'body_class', 'micro_body_class' );

/**
 * Append Site Description To Site Header
 * 
 * Appends a DIV containing the site description 
 * before the site header content.
 * 
 * This function hooked into the micro_before_header 
 * hook, which is defined in /inc/hooks.php, and which 
 * fires in the header.php template file.
 * 
 * @param	none
 * @return	string	HTML markup containing the site description
 * 
 * @since	Micro 1.0
 * 
 */
function micro_mobile_header(){

	global $up_options;

	echo "<div class=\"mobile_site_header\">";
	micro_description();
	echo "</div>";
}

add_action('micro_before_header','micro_mobile_header');