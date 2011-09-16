<?php
/**
 * Header Template Part
 * 
 * Template part file that contains the HTML document head and 
 * opening HTML body elements, as well as the site header.
 *
 * This file is called by all primary template pages
 * 
 * Child Themes can override this template part file globally,
 * via "header.php", or in a given specific context, via
 * "header-{context}.php". For example, to replace this
 * template part file on static Pages, a Child Theme would
 * include the file "header-page.php".
 * 
 * @uses		micro_after_header()		Defined in /inc/hooks.php
 * @uses		micro_before_content()		Defined in /inc/hooks.php
 * @uses		micro_before_header()		Defined in /inc/hooks.php
 * @uses		micro_before_posts()		Defined in /inc/hooks.php
 * @uses		micro_body_class()			Defined in /inc/extensions/header-extensions.php
 * @uses		micro_header()				Defined in /inc/hooks.php
 * @uses		up_title()					Defined in /admin/library/engines/seo-engine.php
 * @uses		upfw_get_template_context()	Defined in /admin/functions.php
 * 
 * @link 		http://codex.wordpress.org/Function_Reference/bloginfo				bloginfo()
 * @link 		http://codex.wordpress.org/Function_Reference/body_class			body_class()
 * @link 		http://codex.wordpress.org/Function_Reference/do_action				do_action()
 * @link 		http://codex.wordpress.org/Function_Reference/get_stylesheet_uri	get_stylesheet_uri()
 * @link 		http://codex.wordpress.org/Function_Reference/language_attributes	language_attributes()
 * @link 		http://codex.wordpress.org/Function_Reference/wp_enqueue_script		wp_enqueue_script()
 * @link 		http://codex.wordpress.org/Function_Reference/wp_head				wp_head()
 * 
 * @package 	Micro
 * @copyright	Copyright (c) 2011, UpThemes
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 *
 * @since 		Micro 1.0
 */
?>
<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<html xmlns="http://www.w3.org/1999/xhtml" <?php  
/**
 * Output language attributes for the <html> tag
 * 
 * Codex reference: {@link http://codex.wordpress.org/Function_Reference/language_attributes language_attributes}
 * 
 * Added inside the HTML <html> tag, and outputs various HTML
 * language attributes, such as language and text-direction.
 * 
 * @param	null
 * @return	string	e.g. dir="ltr" lang="en-US"
 */
 language_attributes(); 
 ?>>
<head>

	<title><?php echo up_title(); ?></title>

	<meta name="viewport" content="width=device-width,initial-scale=1">
	
	<?php 
	/**
	 * Fire the 'up_seo' custom action hook
	 * 
	 * @param	null
	 * @return	mixed	any output hooked into 'up_seo'
	 */
	do_action('up_seo'); 
	?>
	
	<meta http-equiv="Content-Type" content="<?php 
	/**
	 * Output the site HTML type
	 *
	 * Codex reference: {@link http://codex.wordpress.org/Function_Reference/bloginfo bloginfo}
	 * Codex reference: {@link http://codex.wordpress.org/Function_Reference/get_bloginfo get_bloginfo}
	 * 
	 * bloginfo() prints (displays/outputs) the data requested. 
	 * get_bloginfo() returns, rather than display/output, the data
	 * 
	 * The 'html_type' parameter is the document HTML type
	 *  - Defined on the General Settings page in the administration panel
	 *  - Usually "text/html"
	 *
	 * @param	string	$show	e.g. 'html_type'; default: none
	 * @return	string			e.g. "text/html"
	 */
	 bloginfo('html_type'); 
	 ?>; charset=<?php 
	/**
	 * Output the site HTML type
	 *
	 * Codex reference: {@link http://codex.wordpress.org/Function_Reference/bloginfo bloginfo}
	 * Codex reference: {@link http://codex.wordpress.org/Function_Reference/get_bloginfo get_bloginfo}
	 * 
	 * bloginfo() prints (displays/outputs) the data requested. 
	 * get_bloginfo() returns, rather than display/output, the data
	 * 
	 * The 'charset' parameter is the document character set
	 * 	- Defined in wp-config.php
	 *  - Usually "UTF-8"
	 *
	 * @param	string	$show	e.g. 'charset'; default: none
	 * @return	string			e.g. "UTF-8"
	 */
	 bloginfo('charset'); 
	 ?>" />
	
	<link rel="pingback" href="<?php 
	/**
	 * Output the pingback URL
	 *
	 * Codex reference: {@link http://codex.wordpress.org/Function_Reference/bloginfo bloginfo}
	 * Codex reference: {@link http://codex.wordpress.org/Function_Reference/get_bloginfo get_bloginfo}
	 * 
	 * bloginfo() prints (displays/outputs) the data requested. 
	 * get_bloginfo() returns, rather than display/output, the data
	 * 
	 * The 'pingback_url' parameter is the URL used to send pingbacks
	 *
	 * @param	string	$show	e.g. 'pingback_url'; default: none
	 * @return	string			e.g. "{url}"
	 */bloginfo('pingback_url'); 
	 ?>" />
	                      
    <link rel="icon" href="<?php echo $up_options->favicon; ?>"/>
    
	<link rel="stylesheet" type="text/css" href="<?php 
	/**
	 * Return the URL for the default stylesheet
	 * 
	 * Codex reference: {@link http://codex.wordpress.org/Function_Reference/get_stylesheet_uri get_stylesheet_uri}
	 * 
	 * Returns the value for the URI of the Theme default style sheet (style.css).
	 * 
	 * @param	null 
	 * @return	string	URL of default stylesheet
	 */
	 echo get_stylesheet_uri(); 
	 ?>">
    
    <?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
	
	<?php 
	/**
	 * Fire the 'wp_head' action hook
	 * 
	 * Codex reference: {@link http://codex.wordpress.org/Hook_Reference/wp_head wp_head}
	 * 
	 * This hook is used by WordPress core, Themes, and Plugins to 
	 * add scripts, CSS styles, meta tags, etc. to the document head.
	 * 
	 * MUST come immediately before the closing </head> tag
	 * 
	 * @param	null
	 * @return	mixed	any output hooked into 'wp_head'
	 */
	wp_head(); 
	?>
</head>
<body <?php body_class( micro_body_class() ); ?>>

	<?php
	/**
	 * Fire the 'micro_before_header' custom action hook
	 * 
	 * @param	null
	 * @return	mixed	any output hooked into 'micro_before_header'
	 */
	micro_before_header(); 
	?>

	<?php 
	/**
	 * Fire the 'micro_header' custom action hook
	 * 
	 * @param	null
	 * @return	mixed	any output hooked into 'micro_header'
	 */
	micro_header(); 
	?>
	
	<?php 
	/**
	 * Fire the 'micro_after_header' custom action hook
	 * 
	 * @param	null
	 * @return	mixed	any output hooked into 'micro_after_header'
	 */
	micro_after_header(); 
	?>
	
	<div id="main" class="container clearfix">

		<?php 
		/**
		 * Fire the 'micro_before_content' custom action hook
		 * 
		 * @param	null
		 * @return	mixed	any output hooked into 'micro_before_content'
		 */
		micro_before_content(); 
		?>

		<div id="content" class="clearfix">

			<?php 
			/**
			 * Fire the 'micro_before_posts' custom action hook
			 * 
			 * @param	null
			 * @return	mixed	any output hooked into 'micro_before_posts'
			 */
			micro_before_posts(); 
			?>
