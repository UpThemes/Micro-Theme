<?php
/**
 * Content template for standard loop on page.
 *
 * @package WordPress
 * @subpackage Micro
 * @since Micro 1.0
 */
?>

<div id="id-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<?php micro_post_header(); ?>          
			                
    <div class="post_content">
	    <?php the_content(); ?>
    </div>
		
</div>