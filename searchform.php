<?php
/**
 * Search form template part file
 *
 * This file is the markup for the search form, called
 * via get_search_form().
 * 
 * @link 		http://codex.wordpress.org/Function_Reference/_e							_e()
 * @link 		http://codex.wordpress.org/Function_Reference/get_template_directory_uri	get_template_directory_uri()
 * @link 		http://codex.wordpress.org/Function_Reference/home_url						home_url()
 * @link		http://codex.wordpress.org/Function_Reference/the_search_query				the_search_query()
 *
 * @package 	Micro
 * @copyright	Copyright (c) 2011, UpThemes
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 * @since 		Micro 1.0
 */ 
?>

<aside id="search">
	<form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" class="search-form">
	    <input type="text" name="s" class="search_field" value="<?php the_search_query(); ?>"/>
	    <input alt="<?php _e('Search','micro'); ?>" type="image" name="submit" class="search_button" src="<?php echo get_template_directory_uri() . '/images/ico-search.png'; ?>" />
	</form>				
</aside><!-- #search -->