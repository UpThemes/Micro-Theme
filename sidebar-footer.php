<?php
/**
 * The Footer widget areas.
 *
 * @package WordPress
 * @subpackage Micro
 * @since Micro 1.0
 */

	if (   ! is_active_sidebar( 'sidebar-3'  )
		&& ! is_active_sidebar( 'sidebar-4' )
		&& ! is_active_sidebar( 'sidebar-5'  )
	)
		return;

?>
<div id="supplementary" <?php micro_footer_sidebar_class(); ?>>
	<?php if ( is_active_sidebar( 'sidebar-3' ) ) : ?>
	<div id="first" class="widget-area" role="complementary">
		<?php dynamic_sidebar( 'sidebar-3' ); ?>
	</div><!-- #first .widget-area -->
	<?php endif; ?>

	<?php if ( is_active_sidebar( 'sidebar-4' ) ) : ?>
	<div id="second" class="widget-area" role="complementary">
		<?php dynamic_sidebar( 'sidebar-4' ); ?>
	</div><!-- #second .widget-area -->
	<?php endif; ?>

	<?php if ( is_active_sidebar( 'sidebar-5' ) ) : ?>
	<div id="third" class="widget-area" role="complementary">
		<?php dynamic_sidebar( 'sidebar-5' ); ?>
	</div><!-- #third .widget-area -->
	<?php endif; ?>
</div>