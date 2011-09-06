<?php
/**
 * Search form for search widgets and the like.
 *
 * @package WordPress
 * @subpackage Micro
 * @since Micro 1.0
 */
?>

<aside id="search">
	<form action="<?php bloginfo('url'); ?>" method="get" class="search-form">
	    <input type="text" name="s" class="search_field" value="<?php echo get_query_var('s'); ?>"/>
	    <input alt="<?php _e('Search','micro'); ?>" type="image" name="submit" class="search_button" src="<?php echo get_bloginfo('stylesheet_directory') . '/images/ico-search.png'; ?>" />
	</form>				
</aside><!-- #search -->