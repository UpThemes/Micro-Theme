<?php
/**
 * Category template.
 *
 * @package WordPress
 * @subpackage Micro
 * @since Micro 1.0
 */

get_header(); ?>

	<h1><?php wp_title(''); ?></h1>

    <ul id="posts">

        <?php if( have_posts() ): while( have_posts() ): the_post(); ?>
		
		<?php get_template_part('content','category'); ?>
		
		<?php endwhile; ?>
		
		<?php else: ?>
		
		<?php micro_no_posts(); ?>

		<?php endif;?>
	
	</ul>

<?php get_footer(); ?>