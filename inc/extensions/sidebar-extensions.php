<?php
/**
 * Sidebar extensions.
 *
 * @package WordPress
 * @subpackage Micro
 * @since Micro 1.0
 */

/*** micro_open_upper
**   since 1.0
**   accepts 0 args
****************************************/

function micro_open_upper(){

	echo '<div class="site-details">';

}

add_action('micro_before_sidebar','micro_open_upper',30);

/*** micro_description
**   since 1.0
**   accepts 0 args
****************************************/

function micro_description(){
	global $up_options; ?>

				<aside class="blog-information">
					<?php if( !$up_options->logo ): ?>
					<a class="title" href="<?php bloginfo('url'); ?>"><?php bloginfo('name') ?></a>
					<?php else: ?>
		            <a href="<?php bloginfo('url'); ?>"><img src="<?php echo $up_options->logo; ?>" alt="<?php bloginfo('name') ?>" class="logo" /></a>
					<?php endif; ?>

					<?php if( get_bloginfo('description') ): ?>
					<div class="desc"><?php bloginfo('description'); ?></div>
					<?php endif; ?>
				</aside><!-- .blog-information -->
	
<?php
}

add_action('micro_before_sidebar','micro_description',60);

/*** micro_sidebar_menu
**   since 1.0
**   accepts 0 args
****************************************/

function micro_sidebar_menu(){
				
				if ( function_exists('wp_nav_menu') ):
					wp_nav_menu(array(
								  'theme_location'  => 'primary',
								  'menu'            => 'navigation', 
								  'container'       => 'aside', 
								  'menu_id'         => 'navigation') );
				else:
					
					echo "<ul id='navigation'>"; 
					wp_list_pages('title_li=');
					echo "</ul>";
					
				endif;
				
}

add_action('micro_before_sidebar','micro_sidebar_menu',70);

/*** micro_search
**   since 1.0
**   accepts 0 args
****************************************/

function micro_search(){

	get_search_form();			

}

add_action('micro_before_sidebar','micro_search',80);

/*** micro_add_social_links
**   since 1.0
**   accepts 0 args
****************************************/

function micro_add_social_links(){
	
	global $up_options;

	if( $up_options->twitter || $up_options->facebook || $up_options->dribbble || $up_options->digg || $up_options->youtube || $up_options->vimeo || $up_options->tumblr || $up_options->skype || $up_options->qik || $up_options->posterous || $up_options->linkedin || $up_options->lastfm || $up_options->gowalla || $up_options->flickr || $up_options->designmoo ): ?>
	
	<aside class="social">
	
		<?php if( $up_options->twitter ): ?>
		<a class="twitter" href="http://twitter.com/<?php echo $up_options->twitter; ?>"><img src="<?php echo get_bloginfo('template_directory') . "/images/icons/twitter_{$up_options->icon_size}.png"; ?>"></a>
		<?php endif; ?>
		
		<?php if( $up_options->facebook ): ?>
		<a class="facebook" href="http://facebook.com/<?php echo $up_options->facebook; ?>"><img src="<?php echo get_bloginfo('template_directory') . "/images/icons/facebook_{$up_options->icon_size}.png"; ?>"></a>
		<?php endif; ?>
		
		<?php if( $up_options->dribbble ): ?>
		<a class="dribbble" href="http://dribbble.com/<?php echo $up_options->dribbble; ?>"><img src="<?php echo get_bloginfo('template_directory') . "/images/icons/dribbble_{$up_options->icon_size}.png"; ?>"></a>
		<?php endif; ?>
		
		<?php if( $up_options->digg ): ?>
		<a class="digg" href="http://digg.com/<?php echo $up_options->digg; ?>"><img src="<?php echo get_bloginfo('template_directory') . "/images/icons/digg_{$up_options->icon_size}.png"; ?>"></a>
		<?php endif; ?>

		<?php if( $up_options->youtube ): ?>
		<a class="youtube" href="http://youtube.com/<?php echo $up_options->youtube; ?>"><img src="<?php echo get_bloginfo('template_directory') . "/images/icons/youtube_{$up_options->icon_size}.png"; ?>"></a>
		<?php endif; ?>
		
		<?php if( $up_options->vimeo ): ?>
		<a class="vimeo" href="http://vimeo.com/<?php echo $up_options->vimeo; ?>"><img src="<?php echo get_bloginfo('template_directory') . "/images/icons/vimeo_{$up_options->icon_size}.png"; ?>"></a>
		<?php endif; ?>
		
		<?php if( $up_options->tumblr ): ?>
		<a class="tumblr" href="<?php echo $up_options->tumblr; ?>"><img src="<?php echo get_bloginfo('template_directory') . "/images/icons/tumblr_{$up_options->icon_size}.png"; ?>"></a>
		<?php endif; ?>
		
		<?php if( $up_options->skype ): ?>
		<a class="skype" href="callto:<?php echo $up_options->skype; ?>"><img src="<?php echo get_bloginfo('template_directory') . "/images/icons/skype_{$up_options->icon_size}.png"; ?>"></a>
		<?php endif; ?>
		
		<?php if( $up_options->qik ): ?>
		<a class="qik" href="http://qik.com/<?php echo $up_options->qik; ?>"><img src="<?php echo get_bloginfo('template_directory') . "/images/icons/qik_{$up_options->icon_size}.png"; ?>"></a>
		<?php endif; ?>
		
		<?php if( $up_options->posterous ): ?>
		<a class="posterous" href="<?php echo $up_options->posterous; ?>"><img src="<?php echo get_bloginfo('template_directory') . "/images/icons/posterous_{$up_options->icon_size}.png"; ?>"></a>
		<?php endif; ?>
		
		<?php if( $up_options->linkedin ): ?>
		<a class="linkedin" href="http://linkedin.com/<?php echo $up_options->linkedin; ?>"><img src="<?php echo get_bloginfo('template_directory') . "/images/icons/linkedin_{$up_options->icon_size}.png"; ?>"></a>
		<?php endif; ?>
		
		<?php if( $up_options->lastfm ): ?>
		<a class="lastfm" href="http://last.fm/user/<?php echo $up_options->lastfm; ?>"><img src="<?php echo get_bloginfo('template_directory') . "/images/icons/lastfm_{$up_options->icon_size}.png"; ?>"></a>
		<?php endif; ?>
		
		<?php if( $up_options->gowalla ): ?>
		<a class="gowalla" href="http://gowalla.com/<?php echo $up_options->gowalla; ?>"><img src="<?php echo get_bloginfo('template_directory') . "/images/icons/gowalla_{$up_options->icon_size}.png"; ?>"></a>
		<?php endif; ?>
		
		<?php if( $up_options->flickr ): ?>
		<a class="flickr" href="http://flickr.com/photos/<?php echo $up_options->flickr; ?>"><img src="<?php echo get_bloginfo('template_directory') . "/images/icons/flickr_{$up_options->icon_size}.png"; ?>"></a>
		<?php endif; ?>
		
		<?php if( $up_options->designmoo ): ?>
		<a class="designmoo" href="http://designmoo.com/members/<?php echo $up_options->designmoo; ?>"><img src="<?php echo get_bloginfo('template_directory') . "/images/icons/designmoo_{$up_options->icon_size}.png"; ?>"></a>
		<?php endif; ?>
		
	</aside><!-- .social -->
	
	<?php endif;

}

add_action('micro_before_sidebar','micro_add_social_links',100);

/*** micro_close_upper
**   since 1.0
**   accepts 0 args
****************************************/

function micro_close_upper(){

	echo "</div>";

}

add_action('micro_before_sidebar','micro_close_upper',200);