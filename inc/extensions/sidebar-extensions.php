<?php
/**
 * Theme Header Extension Functions file
 * 
 * The /inc/extensions/sidebar-extensions.php file defines
 * all of the Theme's callback functions that hook into
 * Theme custom and WordPress action/filter hooks in sidebar.php
 * and sidebar-footer.php
 *  - micro_before_sidebar
 * 
 * @link 		http://codex.wordpress.org/Function_Reference/add_action 	add_action()
 * 
 * @package 	Micro
 * @copyright	Copyright (c) 2011, UpThemes
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 *
 * @since 		Micro 1.0
 */

/**
 * Add Sidebar Site Details container open tag
 * 
 * Adds opening DIV tag for site details container
 * in the main sidebar.
 * 
 * This function hooked into the micro_before_sidebar hook, 
 * which is defined in /inc/hooks.php, and which fires
 * in the sidebar.php template file.
 * 
 * Child Themes can remove this output by calling 
 * remove_action( 'micro_before_sidebar', 'micro_open_upper', 30 );
 * 
 * Template file: sidebar.php
 * 
 * @param	none
 * @return	string	HTML markup for sidebar site details container open tag
 * 
 * @since	Micro 1.0
 * 
 */
function micro_open_upper(){

	echo '<div class="site-details">';

}
// Hook micro_open_upper() into micro_before_sidebar
add_action( 'micro_before_sidebar', 'micro_open_upper', 30 );

/**
 * Add Site Description to Sidebar
 * 
 * Adds site description to the sidebar, after the 
 * opening site description container HTML tag.
 * 
 * This function hooked into the micro_before_sidebar hook, 
 * which is defined in /inc/hooks.php, and which fires
 * in the sidebar.php template file.
 * 
 * Child Themes can remove this output by calling 
 * remove_action( 'micro_before_sidebar', 'micro_description', 60 );
 * 
 * Template file: sidebar.php
 * 
 * @link 	http://codex.wordpress.org/Function_Reference/get_bloginfo		get_bloginfo()
 * 
 * @param	none
 * @return	string	HTML markup for sidebar site description
 * 
 * @since	Micro 1.0
 * 
 */
function micro_description(){
	global $up_options; ?>

				<aside class="blog-information">
					<?php if( ! isset( $up_options->logo ) ) : ?>
					<a class="title" href="<?php echo home_url( '/' ); ?>"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></a>
					<?php else: ?>
		            <a href="<?php echo home_url( '/' ); ?>"><img src="<?php echo esc_url( $up_options->logo ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" class="logo" /></a>
					<?php endif; ?>

					<?php if( get_bloginfo( 'description' ) ): ?>
					<div class="desc"><?php echo esc_html( get_bloginfo( 'description' ) ); ?></div>
					<?php endif; ?>
				</aside><!-- .blog-information -->
	
<?php
}
// Hook micro_description() into micro_before_sidebar
add_action( 'micro_before_sidebar', 'micro_description', 60 );

/**
 * Add Site Navigation Menu to Sidebar
 * 
 * Adds site navigation menu to the sidebar, after the 
 * opening site description container HTML tag.
 * 
 * This function hooked into the micro_before_sidebar hook, 
 * which is defined in /inc/hooks.php, and which fires
 * in the sidebar.php template file.
 * 
 * The custom navigation menu called in this function uses 
 * the 'primary' Theme Location. Create a custom navigation 
 * menu via Dashboard -> Appearance -> Menus, and apply it 
 * to the "Primary" Theme Location, for it to display here.
 * 
 * If no custom navigation menu is applied to the "Primary" 
 * Theme Location, then the menu falls back to wp_page_menu().
 * 
 * Child Themes can remove this output by calling 
 * remove_action( 'micro_before_sidebar', 'micro_sidebar_menu', 70 );
 * 
 * Template file: sidebar.php
 * 
 * @link 	http://codex.wordpress.org/Function_Reference/has_nav_menu		has_nav_menu()
 * @link 	http://codex.wordpress.org/Function_Reference/wp_list_pages		wp_list_pages()
 * @link 	http://codex.wordpress.org/Function_Reference/wp_nav_menu		wp_nav_menu()
 * 
 * @param	none
 * @return	string	HTML markup for sidebar navigation menu
 * 
 * @since	Micro 1.0
 * 
 */
function micro_sidebar_menu(){
				
				if ( has_nav_menu( 'primary' ) ):
					wp_nav_menu(array(
								  'theme_location'  => 'primary',
								  'menu'            => 'navigation', 
								  'container'       => 'aside', 
								  'menu_id'         => 'navigation') );
				else:
					
					echo "<ul id='navigation'>"; 
					wp_list_pages( 'title_li=' );
					echo "</ul>";
					
				endif;
				
}
// Hook micro_sidebar_menu() into micro_before_sidebar
add_action( 'micro_before_sidebar', 'micro_sidebar_menu', 70 );

/**
 * Add Search Form to Sidebar
 * 
 * Adds a search form to the sidebar, after the 
 * site navigation menu.
 * 
 * This function hooked into the micro_before_sidebar hook, 
 * which is defined in /inc/hooks.php, and which fires
 * in the sidebar.php template file.
 * 
 * Child Themes can remove this output by calling 
 * remove_action( 'micro_before_sidebar', 'micro_search', 80 );
 * 
 * Template file: sidebar.php
 * 
 * @link 	http://codex.wordpress.org/Function_Reference/get_search_form		get_search_form()
 * 
 * @param	none
 * @return	string	HTML markup for sidebar site details container open tag
 * 
 * @since	Micro 1.0
 * 
 */
function micro_search(){

	get_search_form();			

}
// Hook micro_search() into micro_before_sidebar
add_action( 'micro_before_sidebar', 'micro_search', 80 );

/**
 * Add Social Links to Sidebar
 * 
 * Adds a list of social profile links to the sidebar, 
 * after the search form.
 * 
 * This function hooked into the micro_before_sidebar hook, 
 * which is defined in /inc/hooks.php, and which fires
 * in the sidebar.php template file.
 * 
 * Child Themes can remove this output by calling 
 * remove_action( 'micro_before_sidebar', 'micro_add_social_links', 100 );
 * 
 * Template file: sidebar.php
 * 
 * @link 	http://codex.wordpress.org/Function_Reference/get_template_directory_uri		get_template_directory_uri()
 * 
 * @param	none
 * @return	string	HTML markup for sidebar site details container open tag
 * 
 * @since	Micro 1.0
 * 
 */
function micro_add_social_links(){
	
	global $up_options;

	if( $up_options->twitter || $up_options->facebook || $up_options->dribbble || $up_options->digg || $up_options->youtube || $up_options->vimeo || $up_options->tumblr || $up_options->skype || $up_options->qik || $up_options->posterous || $up_options->linkedin || $up_options->lastfm || $up_options->gowalla || $up_options->flickr || $up_options->designmoo ): ?>
	
	<aside class="social">
	
		<?php if( $up_options->twitter ): ?>
		<a class="twitter" href="http://twitter.com/<?php echo $up_options->twitter; ?>"><img src="<?php echo get_template_directory_uri() . "/images/icons/twitter_{$up_options->icon_size}.png"; ?>"></a>
		<?php endif; ?>
		
		<?php if( $up_options->facebook ): ?>
		<a class="facebook" href="http://facebook.com/<?php echo $up_options->facebook; ?>"><img src="<?php echo get_template_directory_uri() . "/images/icons/facebook_{$up_options->icon_size}.png"; ?>"></a>
		<?php endif; ?>
		
		<?php if( $up_options->dribbble ): ?>
		<a class="dribbble" href="http://dribbble.com/<?php echo $up_options->dribbble; ?>"><img src="<?php echo get_template_directory_uri() . "/images/icons/dribbble_{$up_options->icon_size}.png"; ?>"></a>
		<?php endif; ?>
		
		<?php if( $up_options->digg ): ?>
		<a class="digg" href="http://digg.com/<?php echo $up_options->digg; ?>"><img src="<?php echo get_template_directory_uri() . "/images/icons/digg_{$up_options->icon_size}.png"; ?>"></a>
		<?php endif; ?>

		<?php if( $up_options->youtube ): ?>
		<a class="youtube" href="http://youtube.com/<?php echo $up_options->youtube; ?>"><img src="<?php echo get_template_directory_uri() . "/images/icons/youtube_{$up_options->icon_size}.png"; ?>"></a>
		<?php endif; ?>
		
		<?php if( $up_options->vimeo ): ?>
		<a class="vimeo" href="http://vimeo.com/<?php echo $up_options->vimeo; ?>"><img src="<?php echo get_template_directory_uri() . "/images/icons/vimeo_{$up_options->icon_size}.png"; ?>"></a>
		<?php endif; ?>
		
		<?php if( $up_options->tumblr ): ?>
		<a class="tumblr" href="<?php echo $up_options->tumblr; ?>"><img src="<?php echo get_template_directory_uri() . "/images/icons/tumblr_{$up_options->icon_size}.png"; ?>"></a>
		<?php endif; ?>
		
		<?php if( $up_options->skype ): ?>
		<a class="skype" href="callto:<?php echo $up_options->skype; ?>"><img src="<?php echo get_template_directory_uri() . "/images/icons/skype_{$up_options->icon_size}.png"; ?>"></a>
		<?php endif; ?>
		
		<?php if( $up_options->qik ): ?>
		<a class="qik" href="http://qik.com/<?php echo $up_options->qik; ?>"><img src="<?php echo get_template_directory_uri() . "/images/icons/qik_{$up_options->icon_size}.png"; ?>"></a>
		<?php endif; ?>
		
		<?php if( $up_options->posterous ): ?>
		<a class="posterous" href="<?php echo $up_options->posterous; ?>"><img src="<?php echo get_template_directory_uri() . "/images/icons/posterous_{$up_options->icon_size}.png"; ?>"></a>
		<?php endif; ?>
		
		<?php if( $up_options->linkedin ): ?>
		<a class="linkedin" href="http://linkedin.com/<?php echo $up_options->linkedin; ?>"><img src="<?php echo get_template_directory_uri() . "/images/icons/linkedin_{$up_options->icon_size}.png"; ?>"></a>
		<?php endif; ?>
		
		<?php if( $up_options->lastfm ): ?>
		<a class="lastfm" href="http://last.fm/user/<?php echo $up_options->lastfm; ?>"><img src="<?php echo get_template_directory_uri() . "/images/icons/lastfm_{$up_options->icon_size}.png"; ?>"></a>
		<?php endif; ?>
		
		<?php if( $up_options->gowalla ): ?>
		<a class="gowalla" href="http://gowalla.com/<?php echo $up_options->gowalla; ?>"><img src="<?php echo get_template_directory_uri() . "/images/icons/gowalla_{$up_options->icon_size}.png"; ?>"></a>
		<?php endif; ?>
		
		<?php if( $up_options->flickr ): ?>
		<a class="flickr" href="http://flickr.com/photos/<?php echo $up_options->flickr; ?>"><img src="<?php echo get_template_directory_uri() . "/images/icons/flickr_{$up_options->icon_size}.png"; ?>"></a>
		<?php endif; ?>
		
		<?php if( $up_options->designmoo ): ?>
		<a class="designmoo" href="http://designmoo.com/members/<?php echo $up_options->designmoo; ?>"><img src="<?php echo get_template_directory_uri() . "/images/icons/designmoo_{$up_options->icon_size}.png"; ?>"></a>
		<?php endif; ?>
		
	</aside><!-- .social -->
	
	<?php endif;

}
// Hook micro_add_social_links() into micro_before_sidebar
add_action( 'micro_before_sidebar', 'micro_add_social_links', 100 );

/**
 * Add Sidebar Site Details container close tag
 * 
 * Adds closing DIV tag for site details container
 * in the main sidebar.
 * 
 * This function hooked into the micro_before_sidebar hook, 
 * which is defined in /inc/hooks.php, and which fires
 * in the sidebar.php template file.
 * 
 * Child Themes can remove this output by calling 
 * remove_action( 'micro_before_sidebar', 'micro_close_upper', 200 );
 * 
 * Template file: sidebar.php
 * 
 * @param	none
 * @return	string	HTML markup for sidebar site details container close tag
 * 
 * @since	Micro 1.0
 * 
 */
function micro_close_upper(){

	echo "</div>";

}
// Hook micro_close_upper() into micro_before_sidebar
add_action( 'micro_before_sidebar', 'micro_close_upper', 200 );