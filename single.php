<?php
/**
 * Single post template.
 *
 * @package WordPress
 * @subpackage Micro
 * @since Micro 1.0
 */ get_header(); ?>

    <?php if( have_posts() ): while( have_posts() ): the_post(); ?>
	
	<?php get_template_part('content','single'); ?>
	
	<?php endwhile; ?>
	
	<?php else: ?>
	
	<?php micro_no_posts(); ?>

	<?php endif;?>
	
<?php get_footer(); ?>