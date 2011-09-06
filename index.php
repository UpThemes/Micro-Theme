<?php
/**
 * index.php contains the main index loop.
 *
 * @package WordPress
 * @subpackage Micro
 * @since Micro 1.0
 */ get_header(); ?>

    <ul id="posts">

        <?php if( have_posts() ): while( have_posts() ): the_post(); ?>
		
		<?php get_template_part('content','index'); ?>
		
		<?php endwhile; ?>
		
		<?php else: ?>
		
		<?php micro_no_posts(); ?>

		<?php endif;?>
	
	</ul>

<?php get_footer(); ?>