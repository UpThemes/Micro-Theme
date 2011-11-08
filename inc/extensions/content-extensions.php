<?php
/**
 * Theme Content Extension Functions file
 * 
 * The /inc/extensions/content-extensions.php file defines
 * all of the Theme's callback functions that hook into
 * Theme custom and WordPress action/filter hooks in content.php, 
 * content-page.php, and content-single.php
 *  - micro_post_footer
 *  - micro_post_header
 *  - micro_postmeta
 *  - the_content
 * 
 * This file also defines content-related custom functions:
 *  - micro_author_details()
 *  - micro_gallery()
 *  - micro_image_grid()
 *  - micro_image_list()
 *  - micro_image_slider()
 *  - micro_no_posts()
 *  - micro_post_images()
 *  - micro_time_posted()
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
 * Output Author Details
 * 
 * Outputs "Posted by {Author Name}", where
 * {Author Name} is linked to the author's
 * archive index page.
 * 
 * The micro_author_details() function is called 
 * by the micro_author_meta() function.
 * 
 * The micro_author_meta() function is defined 
 * in /inc/extensions/content-extensions.php and 
 * is hooked into the micro_postmeta hook, which is 
 * fired inside the micro_postmeta() function. 
 * 
 * The micro_postmeta() function is defined 
 * in /inc/extensions/content-extensions.php and 
 * is called inside the micro_showmeta() function.
 * 
 * The micro_showmeta() function is defined 
 * in /inc/extensions/content-extensions.php and 
 * is hooked into the micro_post_footer hook, which 
 * is fired in the content.php and content-single.php 
 * template files.
 * 
 * Template file: content.php, content-single.php
 * 
 * @link 	http://codex.wordpress.org/Function_Reference/the_author_posts_link 	the_author_posts_link()
 * 
 * @param	none
 * @return	type	description
 * 
 * @since	Micro 1.0
 * 
 */
function micro_author_details() {
	echo '<div class="author">' . __( "Posted by", "micro" ) . " ";
	the_author_posts_link();
	echo '</div>';
}

/**
 * Output Post Timestamp Details
 * 
 * Outputs a timestamped post permalink, 
 * using either a human-readable time 
 * difference or a date/time string, 
 * depending on Theme setting.
 * 
 * The micro_time_posted() function is called 
 * by the micro_time_meta() function.
 * 
 * The micro_time_meta() function is defined 
 * in /inc/extensions/content-extensions.php and 
 * is hooked into the micro_postmeta hook, which is 
 * fired inside the micro_postmeta() function. 
 * 
 * The micro_postmeta() function is defined 
 * in /inc/extensions/content-extensions.php and 
 * is called inside the micro_showmeta() function.
 * 
 * The micro_showmeta() function is defined 
 * in /inc/extensions/content-extensions.php and 
 * is hooked into the micro_post_footer hook, which 
 * is fired in the content.php and content-single.php 
 * template files.
 * 
 * Template file: content.php, content-single.php
 * 
 * @link 	http://codex.wordpress.org/Function_Reference/get_permalink 	get_permalink()
 * @link 	http://codex.wordpress.org/Function_Reference/human_time_diff 	human_time_diff()
 * @link 	http://codex.wordpress.org/Function_Reference/get_the_time 		get_the_time()
 * @link 	http://codex.wordpress.org/Function_Reference/the_time 			the_time()
 * 
 * @link 	http://php.net/manual/en/function.time.php 						time()
 * 
 * @param	none
 * @return	string	Markup for post timestamp metadata
 * 
 * @since	Micro 1.0
 * 
 */
function micro_time_posted() { 
	global $up_options, $post;?>

    <div class="post-date">
        <?php
        if( 'human' == $up_options->showtime_format ):
            echo '<a href="' . get_permalink( $post->ID ) . '">' . human_time_diff( get_the_time( 'U' ), time() ) . ' ago</a>';
        else:
			echo '<a href="' . get_permalink( $post->ID ) . '">';
            the_time( get_option( 'time_format' ) );
			echo '</a>';
        endif;?>
    </div>
	<?php 
}

/**
 * Output Default Post Content
 * 
 * Outputs error message when no posts are
 * found/returned by the current query.
 * 
 * The micro_no_posts() function is called 
 * in the content.php, content-page.php, and 
 * content-single.php template files.
 * 
 * Template file: content.php, content-page.php, content-single.php
 * 
 * @link 	http://codex.wordpress.org/Function_Reference/_e 	_e()
 * 
 * @param	none
 * @return	string	Markup for error message output when no posts found
 * 
 * @since	Micro 1.0
 * 
 */
function micro_no_posts(){ ?>
	
	<li>
									
		<h1><?php _e( "No Posts Found.", "micro" ); ?></h1>
		<p><?php _e( "There were no posts found. Please try back later.", "micro" ); ?></p>
		<div class="clear"></div>
							
	</li>
	
<?php }

/**
 * Return Gallery Post Content
 * 
 * Returns gallery post content for posts with 
 * the Post Format type "Gallery". The function 
 * returns different markup for gallery lists, 
 * gallery grids, or gallery sliders, depending 
 * on the post meta data gallery style setting.
 * 
 * The micro_gallery() function is called within 
 * the micro_content() function, which is hooked 
 * into the_content filter hook, which is applied 
 * in the the_content() template tag.
 * 
 * The the_content() template tag is called in the 
 * content.php, content-page, and content-single.php 
 * template files.
 * 
 * Template file: content.php, content-page.php, content-single.php
 * 
 * @uses	micro_image_grid()		Defined in /inc/extensions/content-extensions.php
 * @uses	micro_image_list()		Defined in /inc/extensions/content-extensions.php
 * @uses	micro_image_slider()	Defined in /inc/extensions/content-extensions.php
 * @uses	micro_post_images()		Defined in /inc/extensions/content-extensions.php
 * 
 * @link 	http://codex.wordpress.org/Function_Reference/get_post_meta 	get_post_meta()
 * 
 * @link 	http://php.net/manual/en/function.is-array.php 					is_array()
 * 
 * @param	none
 * @return	string	Markup for post gallery content
 * 
 * @since	Micro 1.0
 * 
 */
function micro_gallery() {
	global $post;
	$output = '';
	$images = micro_post_images();
	$style = get_post_meta( $post->ID, 'gallery', true );
	if( is_array( $images ) ) :
		switch( $style ):
			case 'slider':
				$output = micro_image_slider( $images );
				break;
			
			case 'grid':
				$output = micro_image_grid( $images );
				break;
			
			case 'list':
				$output = micro_image_list( $images );
				break;
		endswitch;
	else:
		return false;
	endif;
	
	return $output;
}

/**
 * Return Array of Post Images
 * 
 * Returns an indexed array of associative arrays of 
 * attached post images, indexed by attachment id.
 * 
 * The micro_post_images() function is called by the 
 * micro_gallery() function.
 * 
 * The micro_gallery() function is called by the 
 * micro_content() function, which is hooked into 
 * the the_content filter hook, which is applied 
 * in the the_content() template tag.
 * 
 * The the_content() template tag is called in the 
 * content.php, content-page, and content-single.php 
 * template files.
 * 
 * Template files: content.php, content-page.php, content-single.php
 * 
 * @link 	http://codex.wordpress.org/Function_Reference/get_children 					get_children()
 * @link 	http://codex.wordpress.org/Function_Reference/wp_get_attachment_image_src 	wp_get_attachment_image_src()
 * 
 * @link 	http://php.net/manual/en/function.is-array.php 								is_array()
 * 
 * @param	none
 * @return	array	Array of array of image attachments
 * 
 * @since	Micro 1.0
 * 
 */
function micro_post_images(){
	
	global $post, $content_width;
	
	$post_id = $post->ID;
	
    $images = get_children( 'post_parent=' . $post_id . '&showposts=99999post_type=attachment&post_mime_type=image&order=ASC&orderby=menu_order' );
    
    if( is_array( $images ) ):
        foreach( $images as $image ):
			$thumb = wp_get_attachment_image_src( $image->ID, 'thumbnail' );
			$medium = wp_get_attachment_image_src( $image->ID, 'full-width-image' );
			$full = wp_get_attachment_image_src( $image->ID, 'large' );
			$contentwidth = wp_get_attachment_image_src( $image->ID, array($content_width,99999) );
            $post_images[$image->ID]['thumb'] = $thumb[0];
            $post_images[$image->ID]['medium'] = $medium[0];
			$post_images[$image->ID]['full'] = $full[0];
			$post_images[$image->ID]['contentwidth'] = $contentwidth[0];
        endforeach;
    endif;

    return $post_images;
}

/**
 * Return Grid-Style Gallery
 * 
 * Returns markup for a grid-style image gallery.
 * 
 * The micro_image_grid() function is called by the 
 * micro_gallery() function.
 * 
 * The micro_gallery() function is called by the 
 * micro_content() function, which is hooked into 
 * the the_content filter hook, which is applied 
 * in the the_content() template tag.
 * 
 * The the_content() template tag is called in the 
 * content.php, content-page, and content-single.php 
 * template files.
 * 
 * Template files: content.php, content-page.php, content-single.php
 * 
 * @link 	http://codex.wordpress.org/Function_Reference/wp_rand 			wp_rand()
 * @link 	http://codex.wordpress.org/Function_Reference/get_the_title 	get_the_title()
 * 
 * @param	none
 * @return	string	Markup for grid-style image gallery
 * 
 * @since	Micro 1.0
 * 
 */
function micro_image_grid( $images ){
	$output = '<div class="gallery-grid">';
	$rand = wp_rand( 0, 999999 );
	$count;
	foreach( $images as $id => $image ) :
		$count++;
		$class = $count === 4 ? 'last view' : ' view';
		$title = get_the_title( $id );
		$output .= "<a class='$class' rel='grid-$rand' title='$title' href='{$image['full']}'><img src='{$image['medium']}' alt='$title' /></a>";
		$count = $count === 4 ? 0 : $count;
	endforeach;
	$output .= '<div class="clear"></div>';
	$output .= '</div>';
	return $output;
}

/**
 * Return List-Style Gallery
 * 
 * Returns markup for a list-style image gallery.
 * 
 * The micro_image_list() function is called by the 
 * micro_gallery() function.
 * 
 * The micro_gallery() function is called by the 
 * micro_content() function, which is hooked into 
 * the the_content filter hook, which is applied 
 * in the the_content() template tag.
 * 
 * The the_content() template tag is called in the 
 * content.php, content-page, and content-single.php 
 * template files.
 * 
 * Template files: content.php, content-page.php, content-single.php
 * 
 * @link 	http://codex.wordpress.org/Function_Reference/wp_rand 			wp_rand()
 * @link 	http://codex.wordpress.org/Function_Reference/get_the_title 	get_the_title()
 * 
 * @param	none
 * @return	string	Markup for list-style image gallery
 * 
 * @since	Micro 1.0
 * 
 */
function micro_image_list( $images ){
	$output = '<div class="gallery-list">';
	$rand = wp_rand( 0, 999999 );
	foreach( $images as $id => $image ):
		$title = get_the_title( $id );
		$output .= "<a class='view' rel='grid-$rand' title='$title' href='{$image['full']}'><img src='{$image['contentwidth']}' alt='$title' /></a>";
	endforeach;
	$output .= '</div>';
	return $output;
}

/**
 * Return Slider-Style Gallery
 * 
 * Returns markup for a slider-style image gallery.
 * 
 * The micro_image_slider() function is called by the 
 * micro_gallery() function.
 * 
 * The micro_gallery() function is called by the 
 * micro_content() function, which is hooked into 
 * the the_content filter hook, which is applied 
 * in the the_content() template tag.
 * 
 * The the_content() template tag is called in the 
 * content.php, content-page, and content-single.php 
 * template files.
 * 
 * Template files: content.php, content-page.php, content-single.php
 * 
 * @link 	http://codex.wordpress.org/Function_Reference/wp_rand 			wp_rand()
 * @link 	http://codex.wordpress.org/Function_Reference/get_the_title 	get_the_title()
 * 
 * @param	none
 * @return	string	Markup for slider-style image gallery
 * 
 * @since	Micro 1.0
 * 
 */
function micro_image_slider( $images ){
	$rand = wp_rand( 0, 999999 );
	$output = '
	<div class="flex-container">
		<div class="flexslider">
			<ul class="slides">';
					foreach( $images as $id => $image ):
						$title = get_the_title( $id );
						$output .= "<li><a class='view' title='$title' rel='grid-$rand' href='{$image['full']}'><img src='{$image['contentwidth']}' alt='$title' /></a></li>";
					endforeach;
					$output .= '
			</ul>
		</div>
	</div>
	
	';
	return $output;
}

/**
 * Output Post Title
 * 
 * Outputs the post title content, including 
 * Post Format icons and the Post Title. Two 
 * custom action hooks, micro_before_title and 
 * micro_after_title, are fired inside this 
 * function.
 * 
 * The micro_post_title() function is hooked 
 * into the micro_post_header hook, which is 
 * fired inside the micro_post_header() function. 
 * 
 * The micro_post_header() function is defined 
 * in /inc/hooks.php and is fired in the 
 * content.php, content-page.php, and 
 * content-single.php template files.
 * 
 * Template file: content.php, content-page.php, content-single.php
 * 
 * Child Themes can remove this output by calling 
 * remove_action( 'micro_post_header', 'micro_post_title', 600 );
 * 
 * @uses	micro_after_title()		Defined in /inc/hooks.php
 * @uses	micro_before_title()	Defined in /inc/hooks.php
 * 
 * @link 	http://codex.wordpress.org/Function_Reference/get_permalink 		get_permalink()
 * @link 	http://codex.wordpress.org/Function_Reference/get_post_format 		get_post_format()
 * @link 	http://codex.wordpress.org/Function_Reference/get_post_format_link 	get_post_format_link()
 * @link 	http://codex.wordpress.org/Function_Reference/get_post_meta 		get_post_meta()
 * @link 	http://codex.wordpress.org/Function_Reference/get_post_type 		get_post_type()
 * @link 	http://codex.wordpress.org/Function_Reference/get_the_ID 			get_the_ID()
 * @link 	http://codex.wordpress.org/Function_Reference/get_the_title 		get_the_title()
 * @link 	http://codex.wordpress.org/Function_Reference/is_singular 			is_singular()
 * 
 * @link 	http://php.net/manual/en/function.in-array.php 						in_array()
 * @link 	http://php.net/manual/en/function.isset.php 						isset()
 * 
 * @param	none
 * @return	string	HTML markup for post title
 * 
 * @since	Micro 1.0
 * 
 */
function micro_post_title(){

	global $post, $up_options;

	micro_before_title();

	$postformat = get_post_format();
	$postformat = $postformat ? $postformat : 'standard';

	if( get_post_type() == 'post' ):
	
	/* Post Icons */
	$post_icon_pref = ( isset( $up_options->post_format_icon ) ? $up_options->post_format_icon : 'left' );
	$post_icon_pref = 'icon-' . $post_icon_pref;
	$post_icon_link = ( get_post_format() ? get_post_format_link( get_post_format() ) : home_url( '/' ) );
		
		if( ! $postformat || $postformat == 'aside' || $postformat == 'status' || $postformat == 'link' || ( isset( $up_options->showtitle ) && in_array( $postformat, $up_options->showtitle ) ) ) : ?>
		<div class="post-type <?php echo $post_icon_pref;?>">
			<a href="<?php echo $post_icon_link; ?>"><?php echo $post->ID; ?></a>
		</div>
	
		<?php
		endif;
		
	endif;

	/* Post Title */
	
	$url = get_post_meta( get_the_ID(), 'link-url', true );
	$url = $url ? $url : get_permalink();

	$title = get_post_meta( get_the_ID(), 'link-text', true );
	$title = $title ? $title . " &#8594;" : get_the_title();
	
	if( !$postformat || $postformat == 'aside' || $postformat == 'status' || $postformat == 'link' || ( isset( $up_options->showtitle ) && in_array( $postformat, $up_options->showtitle ) ) ):
	    if( ( $url && 'link' == get_post_format() ) || ! is_singular() ): ?>
			<h2 class="title"><a href="<?php echo $url; ?>"><?php echo $title; ?></a></h2>
	    <?php else: ?>
			<h1 class="title"><?php echo $title; ?></h1>
	    <?php endif;

	endif;

	micro_after_title();
	
	echo "<div class='clear'></div>";

}
// Hook micro_post_title() into micro_post_header action
add_action( 'micro_post_header', 'micro_post_title', 600 );

/**
 * Add Post-Before container open tag
 * 
 * Adds opening DIV tag for post-before container
 * in the post header.
 * 
 * The micro_open_before_post() function is hooked 
 * into the micro_post_header hook, which is 
 * fired inside the micro_post_header() function. 
 * 
 * The micro_post_header() function is defined 
 * in /inc/hooks.php and is fired in the 
 * content.php, content-page.php, and 
 * content-single.php template files.
 * 
 * Template file: content.php, content-page.php, content-single.php
 * 
 * Child Themes can remove this output by calling 
 * remove_action( 'micro_post_header', 'micro_open_before_post', 5 );
 * 
 * Template file: sidebar.php
 * 
 * @param	none
 * @return	string	Markup for post-before container open HTML tag
 * 
 * @since	Micro 1.0
 * 
 */
function micro_open_before_post(){

	echo '<div class="post-before">';

}
// Hook micro_open_before_post() into micro_post_header action
add_action( 'micro_post_header', 'micro_open_before_post', 5 );

/**
 * Add Post-Before container close tag
 * 
 * Adds closing DIV tag for post-before container
 * in the post header.
 * 
 * The micro_close_before_post() function is hooked 
 * into the micro_post_header hook, which is 
 * fired inside the micro_post_header() function. 
 * 
 * The micro_post_header() function is defined 
 * in /inc/hooks.php and is fired in the 
 * content.php, content-page.php, and 
 * content-single.php template files.
 * 
 * Template file: content.php, content-page.php, content-single.php
 * 
 * Child Themes can remove this output by calling 
 * remove_action( 'micro_post_header', 'micro_close_before_post', 500 );
 * 
 * Template file: sidebar.php
 * 
 * @param	none
 * @return	string	Markup for post-before container close HTML tag
 * 
 * @since	Micro 1.0
 * 
 */
function micro_close_before_post(){

	echo '</div>';

}

add_action( 'micro_post_header', 'micro_close_before_post', 500 );

/**
 * Output Author Meta
 * 
 * Outputs the author meta data in the post 
 * footer.
 * 
 * The micro_author_meta() function is hooked 
 * into the micro_postmeta hook, which is 
 * fired inside the micro_postmeta() function. 
 * 
 * The micro_postmeta() function is defined 
 * in /inc/extensions/content-extensions.php and 
 * is called inside the micro_showmeta() function.
 * 
 * The micro_showmeta() function is defined 
 * in /inc/extensions/content-extensions.php and 
 * is hooked into the micro_post_footer hook, which 
 * is fired in the content.php and content-single.php 
 * template files.
 * 
 * Template file: content.php, content-single.php
 * 
 * Child Themes can remove this output by calling 
 * remove_action( 'micro_postmeta', 'micro_author_meta' );
 * 
 * @uses	micro_author_details()	Defined in /inc/extensions/content-extensions.php
 * 
 * @link 	http://codex.wordpress.org/Function_Reference/get_post_format 		get_post_format()
 * 
 * @link 	http://php.net/manual/en/function.in-array.php 						in_array()
 * @link 	http://php.net/manual/en/function.isset.php 						isset()
 * 
 * @param	none
 * @return	string	Markup for post author metadata
 * 
 * @since	Micro 1.0
 * 
 */
function micro_author_meta(){
	global $up_options;
	$postformat = get_post_format();
	$postformat = $postformat ? $postformat : 'standard';

	if( isset( $up_options->showmeta ) && in_array( $postformat, $up_options->showmeta ) ) 
		micro_author_details();
   	
}
// Hook micro_author_meta() into micro_postmeta action
add_action( 'micro_postmeta', 'micro_author_meta' );

/**
 * Output Post Category Meta Data
 * 
 * Outputs the category meta data in the post 
 * footer.
 * 
 * The micro_categories_meta() function is hooked 
 * into the micro_postmeta hook, which is 
 * fired inside the micro_postmeta() function. 
 * 
 * The micro_postmeta() function is defined 
 * in /inc/extensions/content-extensions.php and 
 * is called inside the micro_showmeta() function.
 * 
 * The micro_showmeta() function is defined 
 * in /inc/extensions/content-extensions.php and 
 * is hooked into the micro_post_footer hook, which 
 * is fired in the content.php and content-single.php 
 * template files.
 * 
 * Template file: content.php, content-single.php
 * 
 * Child Themes can remove this output by calling 
 * remove_action( 'micro_postmeta', 'micro_categories_meta' );
 * 
 * @link 	http://codex.wordpress.org/Function_Reference/get_post_format 		get_post_format()
 * @link 	http://codex.wordpress.org/Function_Reference/the_category 			the_category()
 * 
 * @link 	http://php.net/manual/en/function.in-array.php 						in_array()
 * @link 	http://php.net/manual/en/function.isset.php 						isset()
 * 
 * @param	none
 * @return	string	Markup for post categories metadata
 * 
 * @since	Micro 1.0
 * 
 */
function micro_categories_meta(){
	global $up_options;
	$postformat = get_post_format();
	$postformat = $postformat ? $postformat : 'standard';
	
	if( isset( $up_options->showcategory ) && in_array( $postformat, $up_options->showcategory ) ) :
		echo "<div class='post-category'>".__('Posted in ', 'micro');
		the_category(', ');
		echo "</div>";
	endif;
}
// Hook micro_categories_meta() into micro_postmeta action
add_action( 'micro_postmeta', 'micro_categories_meta' );

/**
 * Output Post Date/Time Meta Data
 * 
 * Outputs the date/time meta data in the post 
 * footer.
 * 
 * The micro_time_meta() function is hooked 
 * into the micro_postmeta hook, which is 
 * fired inside the micro_postmeta() function. 
 * 
 * The micro_postmeta() function is defined 
 * in /inc/extensions/content-extensions.php and 
 * is called inside the micro_showmeta() function.
 * 
 * The micro_showmeta() function is defined 
 * in /inc/extensions/content-extensions.php and 
 * is hooked into the micro_post_footer hook, which 
 * is fired in the content.php and content-single.php 
 * template files.
 * 
 * Template file: content.php, content-single.php
 * 
 * Child Themes can remove this output by calling 
 * remove_action( 'micro_postmeta', 'micro_time_meta' );
 * 
 * @link 	http://codex.wordpress.org/Function_Reference/get_post_format 		get_post_format()
 * @link 	http://codex.wordpress.org/Function_Reference/the_category 			the_category()
 * 
 * @link 	http://php.net/manual/en/function.in-array.php 						in_array()
 * @link 	http://php.net/manual/en/function.isset.php 						isset()
 * 
 * @param	none
 * @return	string	Markup for post timestamp metadata
 * 
 * @since	Micro 1.0
 * 
 */
function micro_time_meta(){
	global $up_options;
	$postformat = get_post_format();
	$postformat = $postformat ? $postformat : 'standard';

    if( isset( $up_options->showtime ) && in_array( $postformat, $up_options->showtime ) ) 
    	micro_time_posted();
}

add_action( 'micro_postmeta', 'micro_time_meta' );

/**
 * Output Post Tags Meta Data
 * 
 * Outputs the post tags meta data in the post 
 * footer.
 * 
 * The micro_tags_meta() function is hooked 
 * into the micro_postmeta hook, which is 
 * fired inside the micro_postmeta() function. 
 * 
 * The micro_postmeta() function is defined 
 * in /inc/extensions/content-extensions.php and 
 * is called inside the micro_showmeta() function.
 * 
 * The micro_showmeta() function is defined 
 * in /inc/extensions/content-extensions.php and 
 * is hooked into the micro_post_footer hook, which 
 * is fired in the content.php and content-single.php 
 * template files.
 * 
 * Template file: content.php, content-single.php
 * 
 * Child Themes can remove this output by calling 
 * remove_action( 'micro_postmeta', 'micro_tags_meta' );
 * 
 * @link 	http://codex.wordpress.org/Function_Reference/get_post_format 		get_post_format()
 * @link 	http://codex.wordpress.org/Function_Reference/the_tags 				the_tags()
 * 
 * @link 	http://php.net/manual/en/function.in-array.php 						in_array()
 * @link 	http://php.net/manual/en/function.isset.php 						isset()
 * 
 * @param	none
 * @return	string	Markup for post tags metadata
 * 
 * @since	Micro 1.0
 * 
 */
function micro_tags_meta(){
	global $up_options;
	$postformat = get_post_format();
	$postformat = $postformat ? $postformat : 'standard';
	
	if( isset( $up_options->showtag ) && in_array( $postformat, $up_options->showtag ) ) 
    the_tags( '<div class="tags">',' ','</div>' );
}
// Hook micro_tags_meta() into micro_postmeta action
add_action( 'micro_postmeta', 'micro_tags_meta' );


/**
 * Output Post Comments Meta Data
 * 
 * Outputs the post comments meta data in the post 
 * footer.
 * 
 * The micro_comment_meta() function is hooked 
 * into the micro_postmeta hook, which is 
 * fired inside the micro_postmeta() function. 
 * 
 * The micro_postmeta() function is defined 
 * in /inc/extensions/content-extensions.php and 
 * is called inside the micro_showmeta() function.
 * 
 * The micro_showmeta() function is defined 
 * in /inc/extensions/content-extensions.php and 
 * is hooked into the micro_post_footer hook, which 
 * is fired in the content.php and content-single.php 
 * template files.
 * 
 * Template file: content.php, content-single.php
 * 
 * Child Themes can remove this output by calling 
 * remove_action( 'micro_postmeta', 'micro_comment_meta' );
 * 
 * @link 	http://codex.wordpress.org/Function_Reference/_2 					__()
 * @link 	http://codex.wordpress.org/Function_Reference/comments_popup_link 	comments_popup_link()
 * 
 * @param	none
 * @return	string	Markup for post comment metadata
 * 
 * @since	Micro 1.0
 * 
 */
function micro_comment_meta(){ ?>

	<div class="post-comments">
    	<?php comments_popup_link( __( '0 notes', 'micro' ), __( '1 note', 'micro' ), __( '% notes', 'micro' ) ); ?>
	</div>
	<?php
}

add_action( 'micro_postmeta', 'micro_comment_meta' );

/**
 * Output Post Meta Data
 * 
 * Outputs the post meta data in the post 
 * footer.
 * 
 * The micro_showmeta() function is hooked into the 
 * micro_post_footer hook, which is fired in the 
 * content.php and content-single.php template files.
 * 
 * Template file: content.php, content-single.php
 * 
 * Child Themes can remove this output by calling 
 * remove_action( 'micro_post_footer', 'micro_showmeta', 40 );
 * 
 * @uses	micro_postmeta()	Defined in /inc/extensions/content-extensions.php
 * 
 * @link 	http://codex.wordpress.org/Function_Reference/get_post_format 	get_post_format()
 * 
 * @param	none
 * @return	string	Markup for post metadata
 * 
 * @since	Micro 1.0
 * 
 */
function micro_showmeta(){

	global $up_options;

	$postformat = get_post_format();
	$postformat = $postformat ? $postformat : 'standard';

?>
    <div class="post-meta">
        <?php micro_postmeta(); ?>
    </div>
<?php

}
// Hook micro_showmeta() into micro_post_footer action
add_action( 'micro_post_footer', 'micro_showmeta', 40 );

/**
 * Output Post Content
 * 
 * Outputs post content, based on Post Format
 * type.
 * 
 * The micro_content() function is hooked into the 
 * the_content filter hook, which is applied in the 
 * the_content() template tag.
 * 
 * The the_content() template tag is called in the 
 * content.php, content-page, and content-single.php 
 * template files.
 * 
 * Template file: content.php, content-page.php, content-single.php
 * 
 * Child Themes can remove this output by calling 
 * remove_action( 'the_content', 'micro_content' );
 * 
 * @uses	micro_tumblog_embed()	Defined in /inc/media.php
 * @uses	micro_gallery()			Defined in /inc/extensions/content-extensions.php
 * 
 * @uses	woo_tumblog_image()		Defined by WooTumblog Plugin
 * 
 * @link 	http://codex.wordpress.org/Function_Reference/get_post_format 				get_post_format()
 * @link 	http://codex.wordpress.org/Function_Reference/get_post_meta 				get_post_meta()
 * @link 	http://codex.wordpress.org/Function_Reference/get_the_ID 					get_the_ID()
 * @link 	http://codex.wordpress.org/Function_Reference/get_template_directory_uri	get_template_directory_uri()
 * @link 	http://codex.wordpress.org/Function_Reference/get_the_post_thumbnail 		get_the_post_thumbnail()
 * @link 	http://codex.wordpress.org/Function_Reference/has_post_thumbnail 			has_post_thumbnail()
 * @link 	http://codex.wordpress.org/Function_Reference/wp_rand 						wp_rand()
 * 
 * @link 	http://php.net/manual/en/function.function-exists.php 						function_exists()
 * 
 * @param	none
 * @return	string	Filtered post content
 * 
 * @since	Micro 1.0
 * 
 */
function micro_content( $content ) {

	global $post;

	$posttype = get_post_format();
	$posttype = $posttype ? $posttype : 'standard';
	
	$old_content = $content;
		
	$content = '';
	
	switch( $posttype ){
		
		case 'quote':
			$url = get_post_meta(get_the_ID(), 'quote-url', true);
			$author = get_post_meta(get_the_ID(), 'quote-author', true);
		
			$content .= "<blockquote>" . get_post_meta(get_the_ID(), 'quote-copy', true) . "</blockquote>";
			
			if($author):
				$content .= '&#45; ';
				if($url) $content .= '<a href="'.$url.'">';
				$content .= $author;
				if($url) $content .= "</a>";
			endif;
		break;
	
		case 'video':
			$content .= micro_tumblog_embed( array( "id" => $post->ID, "return" => true ) );
		break;
	
		case 'gallery':
			$content .= micro_gallery();
		break;
		
		case 'image':
			if( function_exists( 'woo_tumblog_image' ) )
				$content .= woo_tumblog_image( array("id" => get_the_ID(), "width" => CONTENT_WIDTH ) );
			elseif( has_post_thumbnail() )
				$content .= get_the_post_thumbnail( 'full-width-image' );
		break;
	
		case 'audio':
			
			$rand = wp_rand( 0, 999999999 );
			
			$audio = get_post_meta( $post->ID, 'audio', true );
			$ext = pathinfo( $audio, PATHINFO_EXTENSION );
			
			$content .= '
				<script type="text/javascript">
				//<![CDATA[
				jQuery(document).ready(function($){
				
					$("#jquery_jplayer_'.$rand.'").jPlayer({
						ready: function () {
							$(this).jPlayer("setMedia", {
								'.$ext.': "'.$audio.'"
							});
						},
						ended: function (event) {
							$(this).jPlayer("play");
						},
						swfPath: "' . get_template_directory_uri() . '/inc/scripts/jplayer",
						supplied: "'.$ext.'"
					});
				});
				//]]>
				</script>
				<div class="post-audio">
					<div id="jquery_jplayer_'.$rand.'" class="jp-jplayer"></div>
					<div class="jp-audio">
						<div class="jp-type-single">
							<div id="jp_interface_1" class="jp-interface">
								<ul class="jp-controls">
									<li><a href="#" class="jp-play" tabindex="1">play</a></li>
									<li><a href="#" class="jp-pause" tabindex="1">pause</a></li>
									<li><a href="#" class="jp-mute" tabindex="1">mute</a></li>
									<li><a href="#" class="jp-unmute" tabindex="1">unmute</a></li>
								</ul>
								<div class="jp-progress-container">
									<div class="jp-progress">
										<div class="jp-seek-bar">
											<div class="jp-play-bar"></div>
										</div>
									</div>
								</div>
								<div class="jp-volume-bar-container">
									<div class="jp-volume-bar">
										<div class="jp-volume-bar-value"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

			';
			
		break;
	}
	
	$content .= $old_content;
	
	return $content;

}
// Hook micro_content() into the_content filter
add_filter( 'the_content', 'micro_content' );