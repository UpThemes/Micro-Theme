<?php
/**
 * Footer template.
 *
 * @package WordPress
 * @subpackage Micro
 * @since Micro 1.0
 */ 

global $up_options; ?>

			<?php micro_after_posts(); ?>
				
		</div> <!-- #content -->

		<?php micro_after_content(); ?>

		<?php get_sidebar(); ?>
					
	</div><!-- .container -->
	
	<?php micro_before_footer(); ?>
	
	<?php micro_footer(); ?>

	<?php micro_after_footer(); ?>
	    
    <?php wp_footer(); ?>
            
	</body>
</html>