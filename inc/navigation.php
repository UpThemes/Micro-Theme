<?php
/**
 * Theme Navigation Functions file
 * 
 * The /inc/navigation.php file defines
 * all of the Theme's custom, navigation functions
 *  - micro_get_the_page_count()
 * 
 * This file also defines navigation-related callback 
 * functions hooked into custom Theme hooks
 *  - micro_after_posts
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
 * Add Page Navigation Links
 * 
 * Adds "Previous Post" and "Next Post" links 
 * to single blog posts, and adds "Older Posts" 
 * and "Newer Posts" links to paginated archive 
 * index pages.
 * 
 * This function hooked into the micro_after_posts hook, 
 * which is defined in /inc/hooks.php, and which fires
 * in the footer.php template file.
 * 
 * Child Themes can remove this output by calling 
 * remove_action( 'micro_after_posts', 'micro_attach_navigation' );
 * 
 * Template file: footer.php
 * 
 * @uses	micro_get_the_page_count()	Defined in /inc/navigation.php
 * 
 * @link 	http://codex.wordpress.org/Function_Reference/is_single 			is_single()
 * @link 	http://codex.wordpress.org/Function_Reference/previous_post_link 	previous_post_link()
 * @link 	http://codex.wordpress.org/Function_Reference/next_post_link 		next_post_link()
 * @link 	http://codex.wordpress.org/Function_Reference/get_query_var 		get_query_var()
 * @link 	http://codex.wordpress.org/Function_Reference/previous_posts_link	previous_posts_link()
 * @link 	http://codex.wordpress.org/Function_Reference/next_posts_link		next_posts_link()
 * @link 	http://codex.wordpress.org/Function_Reference/is_archive 			is_archive()
 * @link 	http://codex.wordpress.org/Function_Reference/is_category 			is_category()
 * @link 	http://codex.wordpress.org/Function_Reference/is_tag 				is_tag()
 * @link 	http://codex.wordpress.org/Function_Reference/is_home 				is_home()
 * @link 	http://codex.wordpress.org/Function_Reference/is_author 			is_author()
 * @link 	http://codex.wordpress.org/Function_Reference/is_search 			is_search()
 * 
 * @param	none
 * @return	string	HTML markup for page navigation links
 * 
 * @since	Micro 1.0
 * 
 */
function micro_attach_navigation(){
	
	global $up_options, $wp_query;
	
	if( empty($up_options->attach_navigation) ): ?>
	
	<div id="post-navigation">

		<?php if( is_single() ): ?>

			<ul id="pages">
				<li class="prev-page"><?php previous_post_link('%link',"<span>&larr; Previous Post: %title</span>"); ?></li>
				<li class="next-page"><?php next_post_link('%link',"<span>Next Post: %title &rarr;</span>"); ?></li>
			</ul>
		
		<?php else: ?>

			<?php
			$paged = get_query_var('paged');
			$maxpage = $wp_query->max_num_pages;
	
			if( $maxpage > 1 ): ?>
	
			<ul id="pages">
				<?php

				echo '<li class="prev-page">';
				previous_posts_link( "<span>" . __('&larr; Older Posts','micro') . "</span>" );
				echo '</li>';
?>
				<li class="number"><?php if( is_archive() || is_category() || is_tag() || is_home() || is_author() || is_search() ) micro_get_the_page_count(); ?></li>
<?php
				echo '<li class="next-page">';
				next_posts_link( "<span>" . __('Newer Posts &rarr;','micro') . "</span>" );
				echo '</li>';

				?>
			</ul>
			
			<?php endif; ?>
		
		<?php endif; ?>
		
	</div>

	<?php

	endif;

}
// Hook micro_attach_navigation() into micro_after_posts
add_action( 'micro_after_posts', 'micro_attach_navigation' );

/**
 * Echo Current Page Count
 * 
 * Echoes the current page count for paginated 
 * archive index pages.
 * 
 * This function is called by micro_attach_navigation(),
 * which outputs navigation links in footer.php
 * 
 * Template file: footer.php
 * 
 * @link 	http://codex.wordpress.org/Function_Reference/_e 				_e()
 * @link 	http://codex.wordpress.org/Function_Reference/get_query_var 	get_query_var()
 * @link 	http://codex.wordpress.org/Function_Reference/is_paged 			is_paged()
 * 
 * @param	none
 * @return	string	Current page, as "Page X of Y"
 * 
 * @since	Micro 1.0
 * 
 */
function micro_get_the_page_count(){

		global $wp_query;
	
		$paged = get_query_var( 'paged' );
		$maxpage = $wp_query->max_num_pages;
		
		if( is_paged() )
			$current_page = $paged;
		else
			$current_page = '1';
					
		_e( "Page {$current_page} of {$maxpage}", "micro" );

}