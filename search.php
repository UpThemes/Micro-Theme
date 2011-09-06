<?php
/**
 * Search page template.
 *
 * @package WordPress
 * @subpackage Micro
 * @since Micro 1.0
 */ get_header(); ?>

	<h1><?php echo _e('Search Results for:'); echo " " . $_REQUEST['s']; ?></h1>

    <ul id="posts">

        <?php if( have_posts() ): while( have_posts() ): the_post(); ?>
		
		<?php get_template_part('content','category'); ?>
		
		<?php endwhile; ?>
		
		<?php else: ?>
		
		<?php micro_no_posts(); ?>

		<?php endif;?>
	
	</ul>

<?php get_footer(); ?>