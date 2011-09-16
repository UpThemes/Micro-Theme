<?php
/**
 * Master/Default template file
 *
 * This file is the master/default template file, used when no other file matches in
 * the {@link http://codex.wordpress.org/Template_Hierarchy Template Hierarchy}.
 * 
 * @link		http://codex.wordpress.org/Function_Reference/get_header 			get_header()
 * @link 		http://codex.wordpress.org/Function_Reference/get_footer 			get_footer()
 * @link 		http://codex.wordpress.org/Function_Reference/get_sidebar 			get_sidebar()
 * @link 		http://codex.wordpress.org/Function_Reference/get_template_part 	get_template_part()
 * @link 		http://codex.wordpress.org/Function_Reference/have_posts 			have_posts()
 * @link 		http://codex.wordpress.org/Function_Reference/the_post 				the_post()
 * 
 * @uses		micro_no_posts()			Defined in /inc/extensions/content-extensions.php
 * @uses		upfw_get_template_context()	Defined in /admin/functions.php
 *
 * @package 	Micro
 * @copyright	Copyright (c) 2011, UpThemes
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 * @since 		Micro 1.0
 */ 

/**
 * Include the header template part file
 * 
 * MUST come first. 
 * Calls the header PHP file. 
 * Used in all primary template pages
 * 
 * @see {@link: http://codex.wordpress.org/Function_Reference/get_header get_header}
 * 
 * Child Themes can replace this template part file globally, via "header.php", or in
 * a specifric context only, via "header-{context}.php"
 */
get_header( upfw_get_template_context() ); 
?>

    <ul id="posts">

        <?php if( have_posts() ): while( have_posts() ): the_post(); ?>
		
		<?php 
		/**
		* Include the content template part file
		* 
		* Codex reference: {@link http://codex.wordpress.org/Function_Reference/get_template_part get_template_part}
		* 
		* get_template_part( $slug ) will attempt to include $slug.php. 
		* The function will attempt to include files in the following 
		* order, until it finds one that exists: the Theme's $slug.php, 
		* the parent Theme's $slug.php
		* 
		* get_template_part( $slug , $name ) will attempt to include 
		* $slug-$name.php. The function will attempt to include files 
		* in the following order, until it finds one that exists: the 
		* Theme's $slug-$name.php, the Theme's $slug.php, the parent 
		* Theme's $slug-$name.php, the parent Theme's $slug.php
		* 
		* Child Themes can replace this template part file globally, 
		* via "content.php", or in a specific context only, via 
		* "content-{context}.php"
		*/
		get_template_part( 'content', upfw_get_template_context() ); 
		?>
		
		<?php endwhile; ?>
		
		<?php else: ?>
		
		<?php micro_no_posts(); ?>

		<?php endif;?>
	
	</ul>

<?php 
/**
 * Include the footer template part file
 * 
 * MUST come last. 
 * Calls the footer PHP file. 
 * Used in all primary template pages
 * 
 * Codex reference: {@link http://codex.wordpress.org/Function_Reference/get_footer get_footer}
 * 
 * Child Themes can replace this template part file globally, via "footer.php", or in
 * a specific context only, via "footer-{context}.php"
 */
get_footer( upfw_get_template_context() ); 
?>