<?php
/**
 * The Sidebar containing the main widget area.
 *
 * @package WordPress
 * @subpackage Micro
 * @since Micro 1.0
 */

?>
		<div id="primary" class="widget-area" role="complementary">

			<?php micro_before_sidebar(); ?>

			<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>

				<aside id="archives" class="widget">
					<h3 class="widget-title"><?php _e( 'Archives', 'micro' ); ?></h3>
					<ul>
						<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
					</ul>
				</aside>

				<aside id="meta" class="widget">
					<h3 class="widget-title"><?php _e( 'Meta', 'micro' ); ?></h3>
					<ul>
						<?php wp_register(); ?>
						<li><?php wp_loginout(); ?></li>
						<?php wp_meta(); ?>
					</ul>
				</aside>
			<?php else: ?>

			<?php micro_after_sidebar(); ?>
						
			<?php endif; // end sidebar widget area ?>
		</div><!-- #secondary .widget-area -->