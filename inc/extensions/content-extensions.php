<?php
/**
 * Content extensions.
 *
 * @package WordPress
 * @subpackage Micro
 * @since Micro 1.0
 */

/*** micro_author_details
**   since 1.0
**   accepts 0 args
****************************************/

function micro_author_details(){
	echo '<div class="author">' . __("Posted by","micro") . " ";
	the_author_posts_link();
	echo '</div>';
}

/*** micro_post_title
**   since 1.0
**   accepts 0 args
****************************************/

function micro_post_title(){

	global $post, $up_options;

	micro_before_title();

	$postformat = get_post_format();
	$postformat = $postformat ? $postformat : 'standard';

	if( get_post_type() == 'post' ):
	
	/* Post Icons */
	$post_icon_pref = $up_options->post_format_icon ? $up_options->post_format_icon : 'left';
	$post_icon_pref = 'icon-'.$post_icon_pref;
		
		if( !$postformat || $postformat == 'aside' || $postformat == 'status' || ( !empty($up_options->showtitle) && in_array($postformat, $up_options->showtitle ) ) ): ?>
		<div class="post-type <?php echo $post_icons_pref;?>">
			<a href="<?php echo get_post_format_link( get_post_format() ); ?>"><?php echo $post->ID; ?></a>
		</div>
	
		<?php
		endif;
		
	endif;

	/* Post Title */
	
	$url = get_post_meta(get_the_ID(), 'link-url', true);
	$url = $url ? $url : get_permalink();

	$title = get_post_meta(get_the_ID(), 'link-text', true);
	$title = $title ? $title . " &#8594;" : get_the_title();
	
	if( !$postformat || $postformat == 'aside' || $postformat == 'status' || ( !empty($up_options->showtitle) && in_array($postformat, $up_options->showtitle ) ) ):
	    if( ( $url && get_post_format('link') ) || !is_singular() ): ?>
			<h2 class="title"><a href="<?php echo $url; ?>"><?php echo $title; ?></a></h2>
	    <?php else: ?>
			<h1 class="title"><?php echo $title; ?></h1>
	    <?php endif;

	endif;

	micro_after_title();
	
	echo "<div class='clear'></div>";

}

add_action('micro_post_header','micro_post_title',600);

/*** micro_open_before_post
**   since 1.0
**   accepts 0 args
****************************************/

function micro_open_before_post(){

	echo '<div class="post-before">';

}

add_action('micro_post_header','micro_open_before_post',5);

/*** micro_close_before_post
**   since 1.0
**   accepts 0 args
****************************************/

function micro_close_before_post(){

	echo '</div>';

}

add_action('micro_post_header','micro_close_before_post',500);

/*** micro_post_type
**   since 1.0
**   accepts 0 args
****************************************/

function micro_post_type(){
	global $post, $up_options;
	$post_format_pref = $up_options->post_format_icon ? $up_options->post_format_icon : 'left';
	$post_format_pref = 'icon-'.$post_format_pref; ?>
	
	<div class="post-type <?php echo $post_format_pref;?>">
		<a href="<?php echo get_post_format_link( get_post_format() ); ?>"><?php echo $post->ID; ?></a>
	</div>
<?php
}

//add_action('micro_post_header','micro_post_type',40);

/*** micro_author_meta
**   since 1.0
**   accepts 0 args
****************************************/

function micro_author_meta(){
	global $up_options;
	$postformat = get_post_format();
	$postformat = $postformat ? $postformat : 'standard';

	if( is_array($up_options->showmeta) && in_array($postformat, $up_options->showmeta)) 
		micro_author_details();
   	
}

add_action('micro_postmeta','micro_author_meta');

function micro_categories_meta(){
	global $up_options;
	$postformat = get_post_format();
	$postformat = $postformat ? $postformat : 'standard';
	
	if( is_array($up_options->showcategory) && in_array($postformat, $up_options->showcategory)):
		echo "<div class='post-category'>".__('Posted in ', 'micro');
		the_category(', ');
		echo "</div>";
	endif;
}

add_action('micro_postmeta','micro_categories_meta');

/*** micro_time_meta
**   since 1.0
**   accepts 0 args
****************************************/

function micro_time_meta(){
	global $up_options;
	$postformat = get_post_format();
	$postformat = $postformat ? $postformat : 'standard';

    if( is_array($up_options->showtime) && in_array($postformat, $up_options->showtime)) 
    	micro_time_posted();
}

add_action('micro_postmeta','micro_time_meta');

/*** micro_tags_meta
**   since 1.0
**   accepts 0 args
****************************************/

function micro_tags_meta(){
	global $up_options;
	$postformat = get_post_format();
	$postformat = $postformat ? $postformat : 'standard';
	
	if( is_array($up_options->showtag) && in_array($postformat, $up_options->showtag)) 
    the_tags('<div class="tags">',' ','</div>');
}

add_action('micro_postmeta','micro_tags_meta');

/*** micro_categories_meta
**   since 1.0
**   accepts 0 args
****************************************/



/*** micro_comment_meta
**   since 1.0
**   accepts 0 args
****************************************/

function micro_comment_meta(){ ?>

	<div class="post-comments">
    	<?php comments_popup_link(__('0 notes','micro'),__('1 note','micro'),__('% notes','micro')); ?>
	</div>
	<?php
}

add_action('micro_postmeta','micro_comment_meta');

/*** micro_showmeta
**   since 1.0
**   accepts 0 args
****************************************/

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

add_action('micro_post_footer','micro_showmeta',40);

/*** micro_time_posted
**   since 1.0
**   accepts 0 args
****************************************/

function micro_time_posted(){ 
	global $up_options, $post;?>

    <div class="post-date">
        <?php
        if($up_options->showtime_format):
            echo '<a href="'.get_permalink($post->ID).'">'.human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago</a>';
        else:
			echo '<a href="'.get_permalink($post->ID).'">';
            the_time( get_time_format() );
			echo '</a>';
        endif;?>
    </div>
	<?php 
}

function micro_content($content){

	global $post;

	$posttype = get_post_format();
	$posttype = $posttype ? $posttype : 'standard';
	
	$old_content = $content;
		
	$content = '';
	
	switch($posttype){
		
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
			$content .= micro_resize_video(micro_tumblog_embed(array("id" => $post->ID, "width" => CONTENT_WIDTH, "return" => true)));
		break;
	
		case 'gallery':
			$content .= micro_gallery();
		break;
		
		case 'image':
			if( function_exists('woo_tumblog_image') )
				$content .= woo_tumblog_image(array("id" => get_the_ID(),"width" => CONTENT_WIDTH, "return" => true));
			elseif( function_exists('has_theme_support') && has_theme_support('post-thumbnails') )
				$content .= get_the_post_thumbnail(array(CONTENT_WIDTH,99999,1));
		break;
	
		case 'audio':
			
			$rand = wp_rand(0, 999999999);
			
			$audio = get_post_meta($post->ID, 'audio', true);
			$ext = pathinfo($audio, PATHINFO_EXTENSION);
			
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

add_filter('the_content','micro_content');

/*** micro_no_posts
**   since 1.0
**   accepts 0 args
****************************************/

function micro_no_posts(){ ?>
	
	<li>
									
		<h1><?php _e("No Posts Found.","micro"); ?></h1>
		<p><?php _e("There were no posts found. Please try back later.","micro"); ?></p>
		<div class="clear"></div>
							
	</li>
	
<?php }

/*** micro_post_images
**   since 1.0
**   accepts 0 args
****************************************/
function micro_post_images(){
	
	global $post,$content_width;
	
	$post_id = $post->ID;
	
    $images = get_children('post_parent='.$post_id.'&showposts=99999post_type=attachment&post_mime_type=image&order=ASC&orderby=menu_order');
    
    if( is_array($images) ):
        foreach( $images as $image ):
			$thumb = wp_get_attachment_image_src( $image->ID, 'thumbnail' );
			$medium = wp_get_attachment_image_src( $image->ID, 'full-width-image' );
			$full = wp_get_attachment_image_src( $image->ID, 'large');
            $post_images[$image->ID]['thumb'] = $thumb[0];
            $post_images[$image->ID]['medium'] = $medium[0];
			$post_images[$image->ID]['full'] = $full[0];
        endforeach;
    endif;

    return $post_images;
}

/*** micro_gallery
**   since 1.0
**   accepts 0 args
****************************************/
function micro_gallery(){
	global $post;
	$images = micro_post_images();
	$style = get_post_meta($post->ID, 'gallery', true);
	if( is_array($images) ):
		switch($style):
			case 'slider':
				$output = micro_image_slider($images);
				break;
			
			case 'grid':
				$output = micro_image_grid($images);
				break;
			
			case 'list':
				$output = micro_image_list($images);
				break;
		endswitch;
	else:
		return false;
	endif;
	
	return $output;
}

/*** micro_image_grid
**   since 1.0
**   accepts 1 args array
****************************************/
function micro_image_grid($images){
	$output = '<div class="gallery-grid">';
	$rand = wp_rand(0, 999999);
	$count;
	foreach($images as $id => $image):
		$count++;
		$class = $count === 4 ? 'last' : '';
		$title = get_the_title($id);
		$output .= "<a class='$class' rel='grid-$rand' title='$title' href='{$image['full']}'><img src='{$image['thumb']}' alt='$title' /></a>";
		$count = $count === 4 ? 0 : $count;
	endforeach;
	$output .= '<div class="clear"></div>';
	$output .= '</div>';
	return $output;
}

/*** micro_image_list
**   since 1.0
**   accepts 1 args array
****************************************/
function micro_image_list($images){
	$output = '<div class="gallery-list">';
	$rand = wp_rand(0, 999999);
	foreach($images as $id => $image):
		$title = get_the_title($id);
		$output .= "<a class='$class' rel='grid-$rand' title='$title' href='{$image['full']}'><img src='{$image['full']}' alt='$title' /></a>";
	endforeach;
	$output .= '</div>';
	return $output;
}

/*** micro_image_slider
**   since 1.0
**   accepts 1 args array
****************************************/
function micro_image_slider($images){
	$rand = wp_rand(0, 999999);
	$output = '
	<div class="flex-container">
		<div class="flexslider">
			<ul class="slides">';
					foreach($images as $id => $image):
						$title = get_the_title($id);
						$output .= "<li><a title='$title' href='{$image['full']}'><img src='{$image['medium']}' alt='$title' /></a></li>";
					endforeach;
					$output .= '
			</ul>
		</div>
	</div>
	
	';
	return $output;
}





