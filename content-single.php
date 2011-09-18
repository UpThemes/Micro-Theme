<?php
/**
 * Static Page Content loop template part file
 *
 * This file is the content Loop template part file, that displays post content
 * in the static page context.
 * 
 * @link		http://codex.wordpress.org/Function_Reference/the_ID 			the_ID()
 * @link 		http://codex.wordpress.org/Function_Reference/the_content 		the_content()
 * @link 		http://codex.wordpress.org/Function_Reference/post_class		post_class()
 * 
 * @uses		micro_comments()	Defined in /inc/hooks.php
 * @uses		micro_post_footer()	Defined in /inc/hooks.php
 * @uses		micro_post_header()	Defined in /inc/hooks.php
 *
 * @package 	Micro
 * @copyright	Copyright (c) 2011, UpThemes
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 * @since 		Micro 1.0
 */
?>

<div id="id-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<?php 
	/**
	 * Fire the 'micro_post_header' custom action hook
	 * 
	 * @param	null
	 * @return	mixed	any output hooked into 'micro_post_header'
	 */
	micro_post_header(); 
	?>          
			                
    <div class="post_content">
	    <?php 
		/**
		 * Output the Post Content
		 * 
		 * Codex reference: {@link http://codex.wordpress.org/Function_Reference/the_content the_content}
		 * 
		 * @param	string	$more_link_text	text to use for the "More" link; default: '(more...)'
		 * @param	bool	$strip_teaser	strip text prior to "More" link on Single Post view; default: true
		 */
		the_content(); 
		wp_link_pages( array( 'before' => '<p class="link-pages">Pages: ' ) );
		?>
    </div>
		
	<?php 
	/**
	 * Fire the 'micro_post_footer' custom action hook
	 * 
	 * @param	null
	 * @return	mixed	any output hooked into 'micro_post_footer'
	 */
	micro_post_footer(); 
	?>

</div> <!-- div#id-{$postid} -->

	<?php 
	/**
	 * Fire the 'micro_comments' custom action hook
	 * 
	 * @param	null
	 * @return	mixed	any output hooked into 'micro_comments'
	 */
	micro_comments(); 
	?>