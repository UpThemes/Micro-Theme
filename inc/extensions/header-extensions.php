<?php
/**
 * Header extensions.
 *
 * @package WordPress
 * @subpackage Micro
 * @since Micro 1.0
 */

/*** micro_add_scripts
**   since 1.0
**   accepts 0 args
****************************************/

function micro_add_scripts(){
	
	/* JPlayer Mini Audio Player */
	wp_enqueue_script('jplayer', get_template_directory_uri() . '/inc/scripts/jplayer/jquery.jplayer.min.js', array('jquery'));
    wp_enqueue_script('fancybox', get_template_directory_uri() . '/inc/scripts/fancybox/jquery.fancybox-1.3.4.pack.js', array('jquery'));
    wp_enqueue_script('fancybox-mousewheel', get_template_directory_uri() . '/inc/scripts/fancybox/jquery.mousewheel-3.0.4.pack.js', array('jquery'));
    wp_enqueue_script('fancybox-easing', get_template_directory_uri() . '/inc/scripts/fancybox/jquery.easing-1.3.pack.js', array('jquery'));
	wp_enqueue_script('flexslider', get_template_directory_uri() . '/inc/scripts/flexslider/jquery.flexslider-min.js', array('jquery'));
	wp_enqueue_script('micro', get_template_directory_uri() . '/inc/scripts/global.js', array('jquery'));
	wp_enqueue_script('jplayer', get_template_directory_uri() . '/inc/scripts/modernizr-2.0.6.min.js');

}

add_action('wp_print_scripts','micro_add_scripts',1);

function micro_add_styles(){
	wp_enqueue_style('flexslider', get_template_directory_uri() . '/inc/scripts/flexslider/flexslider.css');
}

add_action('wp_print_styles','micro_add_styles',1);

/*** micro_custom_styles
**   since 1.0
**   accepts 0 args
****************************************/

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
        
		$styles .= $up_options->customcss;
		
		$styles .= '</style>';
		
		echo $styles;
		
	endif;
        
		// Fancybox
        wp_enqueue_style('fancybox', get_template_directory_uri() . '/inc/scripts/fancybox/jquery.fancybox-1.3.4.css');
		
		// JPlayer Audio
		wp_enqueue_style('jplayer', get_template_directory_uri() . '/inc/scripts/jplayer/skin.css');
	
}

add_action('wp_print_styles','micro_custom_styles',40);

function micro_body_class(){
	
	global $up_options;
	
	$body_class = '';
	
	if( $up_options->post_container != true )
		$body_class .= 'contain_posts';

	if( $up_options->widget_container != true )
		$body_class .= ' contain_widgets';

	if( $up_options->sidebar_text_color == 'light' )
		$body_class .= ' widgets_light';
	else
		$body_class .= ' widgets_dark';

	if(	$up_options->rtl_support == true )
		$body_class .= ' rtl';
		
	return $body_class;
	
}

function micro_mobile_header(){

	global $up_options;

	echo "<div class=\"mobile_site_header\">";
	micro_description();
	echo "</div>";
}

add_action('micro_before_header','micro_mobile_header');