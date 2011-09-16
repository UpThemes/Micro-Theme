<?php
/**
 * Template part file that contains the default sidebar content
 *
 * This file is called by footer.php
 * 
 * @uses		micro_after_sidebar()	Defined in /inc/hooks.php
 * @uses		micro_before_sidebar()	Defined in /inc/hooks.php
 * 
 * @link 		http://codex.wordpress.org/Function_Reference/_e				_e()
 * @link 		http://codex.wordpress.org/Function_Reference/dynamic_sidebar	dynamic_sidebar()
 * @link 		http://codex.wordpress.org/Function_Reference/wp_get_archives	wp_get_archives()
 * @link 		http://codex.wordpress.org/Function_Reference/wp_loginout		wp_loginout()
 * @link 		http://codex.wordpress.org/Function_Reference/wp_meta			wp_meta()
 * @link 		http://codex.wordpress.org/Function_Reference/wp_register		wp_register()
 * 
 * @package 	Micro
 * @copyright	Copyright (c) 2011, UpThemes
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 *
 * @since 		Micro 1.0
 */
?>
		<div id="primary" class="widget-area" role="complementary">

			<?php 
			/**
			 * Fire the 'micro_before_sidebar' custom action hook
			 * 
			 * @param	null
			 * @return	mixed	any output hooked into 'micro_before_sidebar'
			 */
			micro_before_sidebar(); 
			?>

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

			<?php 
			/**
			 * Fire the 'micro_after_sidebar' custom action hook
			 * 
			 * @param	null
			 * @return	mixed	any output hooked into 'micro_after_sidebar'
			 */
			micro_after_sidebar(); 
			?>
						
			<?php endif; // end sidebar widget area ?>
		</div><!-- #secondary .widget-area -->