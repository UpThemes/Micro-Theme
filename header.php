<?php
/**
 * Header template file.
 *
 * @package WordPress
 * @subpackage Micro
 * @since Micro 1.0
 */
?>
<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>

	<title><?php echo up_title(); ?></title>

	<meta name="viewport" content="width=device-width,initial-scale=1">
	
	<?php do_action('up_seo'); ?>
	
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	                      
    <link rel="icon" href="<?php echo $up_options->favicon; ?>"/>
    
	<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>">
    
    <?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
	
	<?php wp_head(); ?>
</head>
<body <?php body_class( micro_body_class() ); ?>>

	<?php micro_before_header(); ?>

	<?php micro_header(); ?>
	
	<?php micro_after_header(); ?>
	
	<div id="main" class="container clearfix">

		<?php micro_before_content(); ?>

		<div id="content" class="clearfix">

			<?php micro_before_posts(); ?>
