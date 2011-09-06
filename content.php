<?php
/**
 * Content template for standard loop.
 *
 * @package WordPress
 * @subpackage Micro
 * @since Micro 1.0
 */
?>

<li id="id-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<?php micro_post_header(); ?>          
			                
    <div class="post_content">
	    <?php the_content(); ?>
    </div>
		
	<?php micro_post_footer(); ?>

	<?php micro_comments(); ?>

</li>