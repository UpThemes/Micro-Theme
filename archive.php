<?php
/**
 * Archive index template file
 *
 * This file is the archive index template file, used on blog post archive index pages
 * when no other, more-specific archive template file matches in
 * the {@link http://codex.wordpress.org/Template_Hierarchy Template Hierarchy}.
 * 
 * @link		http://codex.wordpress.org/Function_Reference/get_header 			get_header()
 * @link 		http://codex.wordpress.org/Function_Reference/get_footer 			get_footer()
 * @link 		http://codex.wordpress.org/Function_Reference/get_sidebar 			get_sidebar()
 * @link 		http://codex.wordpress.org/Function_Reference/get_template_part 	get_template_part()
 * @link 		http://codex.wordpress.org/Function_Reference/have_posts 			have_posts()
 * @link 		http://codex.wordpress.org/Function_Reference/the_post 				the_post()
 * @link 		http://codex.wordpress.org/Function_Reference/wp_title 				wp_title()
 * 
 * @uses		micro_no_posts()	Defined in /inc/extensions/content-extensions.php
 *
 * @package 	Micro
 * @copyright	Copyright (c) 2011, UpThemes
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 * @since 		Micro 1.0
 */ 

get_header( 'category' ); 
?>

	<h1><?php echo _e('Archives:'); wp_title(''); ?></h1>

    <ul id="posts">

        <?php if( have_posts() ): while( have_posts() ): the_post(); ?>
		
		<?php 
		get_template_part( 'content', 'category' ); 
		?>
		
		<?php endwhile; ?>
		
		<?php else: ?>
		
		<?php micro_no_posts(); ?>

		<?php endif;?>
	
	</ul>
	
<?php 
get_footer( 'category' ); 
?>