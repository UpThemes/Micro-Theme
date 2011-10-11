<?php
/**
 * Theme Helper Functions file
 * 
 * The /inc/helpers.php file defines
 * all of the Theme's general, custom/helper functions
 *  - micro_attach_image_content()
 *  - micro_convert_url_to_embed()
 *  - woo_tumblog_image()
 * 
 * @link 		http://php.net/manual/en/function.function-exists.php 					function_exists()
 * 
 * @package 	Micro
 * @copyright	Copyright (c) 2011, UpThemes
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 *
 * @since 		Micro 1.0
 */


/**
 * Convert Custom Field URL to Embed Code
 * 
 * Outputs video-embed markup for video URLs
 * added as 'video-embed' custom post meta 
 * data. The function currently supports 
 * YouTube and Vimeo URLs.
 * 
 * This function called by the tumblog_save_post_data()
 * function, which is defined in /inc/metaboxes/tumblog-meta.php.
 * 
 * Template file: N/A
 * 
 * @todo	Convert to core WordPress oEmbed functionality
 * 
 * @link 	http://php.net/manual/en/function.preg-match.php 	preg_match()
 * @link 	http://php.net/manual/en/function.parse-str.php 	parse_str()
 * @link 	http://php.net/manual/en/function.explode.php 		explode()
 * 
 * @param	string	$url	(required) URL of video to embed
 * @return	string	HTML markup for embedded video
 * 
 * @since	Micro 1.0
 * 
 */
function micro_convert_url_to_embed( $url ) {

	$w = CONTENT_WIDTH;
	$h = ( CONTENT_WIDTH / 16 ) * 9;
	
    if ( preg_match( '/youtube/', $url ) ) :
        $youtube = parse_url( $url );
        parse_str( $youtube[query], $youtube );
        $id = $youtube['v'];
        $embed = '
            <object type="application/x-shockwave-flash" width="'.$w.'" height="'.$h.'" data="http://www.youtube.com/v/'.$id.'">
                <param name="movie" value="http://www.youtube.com/v/'.$id.'" />
            </object>';
        return $embed;
    elseif( preg_match( '/vimeo/', $url ) ) :
        $vimeo = explode( '/', $url );
        $id = $vimeo[3];
        $embed = '
            <object type="application/x-shockwave-flash" width="'.$w.'" height="'.$h.'" data="http://vimeo.com/moogaloop.swf?clip_id='.$id.'&amp;server=vimeo.com&amp;show_title=0&amp;show_byline=0&amp;show_portrait=0&amp;color=ff9933&amp;fullscreen=1">
                <param name="movie" value="http://vimeo.com/moogaloop.swf?clip_id='.$id.'&amp;server=vimeo.com&amp;show_title=0&amp;show_byline=0&amp;show_portrait=0&amp;color=ff9933&amp;fullscreen=1" />
            </object>';
        return $embed;
    else:
        return false;
    endif;
}

if ( ! function_exists( 'woo_tumblog_image' ) ) {

	/**
	* WooTumblog Image
	* 
	* Returns the post image, either the featured 
	* image (i.e. Post Thumbnail), an image added 
	* via custom field, or else the first image in 
	* the post content.
	* 
	* @param	array	$args	(optional) Argument array
	* @return	string	Markup for post image
	* 
	* Derived from code originally develped by WooThemes, for 
	* the WooTumblog Plugin.
	* @copyright	WooThemes
	* @license		GPL
	* 
	* @since	Micro 1.0
	* 
	*/
	function woo_tumblog_image( $args ) {
		global $post;
		
		//Defaults
		$key = 'image';
		$width = null;
		$height = null;
		$class = '';
		$quality = 90;
		$id = null;
		$link = 'src';
		$repeat = 1;
		$offset = 0;
		$before = '';
		$after = '';
		$single = false;
		$force = false;
		$return = false;
		$is_auto_image = false;
		$src = '';
		$auto_meta = true;
		$meta = '';
		$alignment = '';
		
		$alt = 'alt=""';
		$img_link = '';
		
		$attachment_id = array();
		$attachment_src = array();
		$thumb_id = get_post_meta($post->ID,'_thumbnail_id',true);
			
		if ( !is_array($args) ) 
			parse_str( $args, $args );
		
		extract($args);
		
	    // Set post ID
	    if ( empty($id) ) {
			$id = $post->ID;
	    }
	    
		// Set alignment 
		if ( $alignment == '') 
			$alignment = get_post_meta($id, '_image_alignment', $single = true);
	    
		if ( $src != '' ) { // When a custom image is sent through
			$custom_field = $src;
			$link = 'img';
			$auto_meta = false;
			
		} elseif ( get_option('woo_post_image_support') == 'true' AND !empty($thumb_id) ) {
		
			if(is_singular() && $single == false){
				$img_link = get_the_post_thumbnail($id,'single-post-thumbnail',array('class' => 'woo-image ' . $class));	
			} else if(is_singular() && $single == true){
				$img_link = get_the_post_thumbnail($id,array($width,NULL),array('class' => 'woo-image ' . $class));
			} else {
				if(!empty($width)){
					$img_link = get_the_post_thumbnail($id,array($width,NULL),array('class' => 'woo-image ' . $class));
				} else {
					$img_link = get_the_post_thumbnail($id,array(),array('class' => 'woo-image ' . $class));
				}
			}
		
		} else {
	    	$custom_field = get_post_meta($id, $key, true);
		} 
	
		if ( empty($custom_field) && get_option('woo_auto_img') == 'true' && empty($img_link) && !is_singular() ) { // Get the image from post attachments
	        
	        if( $offset >= 1 ) 
				$repeat = $repeat + $offset;
	    
	        $attachments = get_children( array(	'post_parent' => $id,
												'numberposts' => $repeat,
												'post_type' => 'attachment',
												'post_mime_type' => 'image',
												'order' => 'DESC', 
												'orderby' => 'menu_order date')
												);
	
			if ( !empty($attachments) ) { // Search for and get the post attachment
	       
				$counter = -1;
				$size = 'large';
				foreach ( $attachments as $att_id => $attachment ) {            
					$counter++;
					if ( $counter < $offset ) 
						continue;
				
					$src = wp_get_attachment_image_src($att_id, $size, true);
					$custom_field = $src[0];
					$is_auto_image = true;
					$attachment_id[] = $att_id;
					$src_arr[] = $custom_field;
				}
	
			} else { // Get the first img tag from content
	
				$first_img = '';
				$post = get_post($id); 
				ob_start();
				ob_end_clean();
				$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
				if ( !empty($matches[1][0]) )
					$custom_field = $matches[1][0];
	
			}
			
		} 
			
		// Return if there is no attachment or custom field set
		if ( empty($custom_field) && empty($img_link) ) {
			
			// Check if default placeholder image is uploaded
			$placeholder = get_option('framework_woo_default_image');
			if ( $placeholder )
				$custom_field = $placeholder;	
			else
		       return;
		
		}
		
		if(empty($src_arr) && empty($img_link)){ $src_arr[] = $custom_field; }
		
	    $output = '';
	
		// Get standard sizes
		if ( !$width && !$height ) {
			$width = '100';
			$height = '100';
		}
		
	    $set_width = ' width="' . $width .'" ';
	    $set_height = ' height="' . $height .'" '; 
	    
	    if($height == null OR $height == '')
	        $set_height = '';
			
		// Set standard class
		if ( $class )
			$class = 'woo-image ' . $class;
		else 
			$class = 'woo-image';
	
		// Do check to verify if images are smaller then specified.
		$force_all = get_option('woo_force_all');
		$force_single = get_option('woo_force_single');
		if($force == true OR $force_all == true OR ($force_single == true AND is_single())){  
			$set_width = '';
			$set_height = '';
		}
		// WordPress's the_post_thumbnail
		if(!empty($img_link)){
		
					
			if( $link == 'img' ) {  // Just output the image
				$output .= $before; 
				$output .= $img_link;
				$output .= $after;  
				
			} else {  // Default - output with link				
	
				if ( is_singular() ) {
					$rel = 'rel="lightbox"';
					$href = false;  
				} else { 
					$href = get_permalink($id);
					$rel = '';
				}
				
				$title = 'title="' . get_the_title($id) .'"';
			
				$output .= $before; 
				if($href == false){
					$output .= $img_link;
				} else {
					$output .= '<a '.$title.' href="' . $href .'" '.$rel.'>' . $img_link . '</a>';
				}
				
				$output .= $after;  
			}	
		}
		elseif ( get_option('woo_resize') == 'true') { 
			
			foreach($src_arr as $key => $custom_field){
		
				// Clean the image URL
				$href = $custom_field; 		
				$custom_field = woo_tumblog_cleanSource( $custom_field );
	
				// Check if WPMU and set correct path AND that image isn't external
				if ( function_exists('get_current_site') && strpos($custom_field,"http://") !== 0 ) {
					get_current_site();
					//global $blog_id; Breaks with WP3 MS
					if ( !$blog_id ) {
						global $current_blog;
						$blog_id = $current_blog->blog_id;				
					}
					if ( isset($blog_id) && $blog_id > 0 ) {
						$imageParts = explode( 'files/', $custom_field );
						if ( isset($imageParts[1]) ) 
							$custom_field = '/blogs.dir/' . $blog_id . '/files/' . $imageParts[1];
					}
				}
				
				// Set alignment if any
				
			
				//Set the ID to the Attachent's ID if it is an attachment
				if($is_auto_image == true){	
					$quick_id = $attachment_id[$key];
				} else {
				 	$quick_id = $id;
				}
				
				if($auto_meta == true) {
					$alt = 'alt="'. get_the_title($quick_id) .'"';
					$title = 'title="'. get_the_title($quick_id) .'"';
				}
				elseif($auto_meta == false) {
					$alt = 'alt="'. $meta.'"';
					$title = 'title="'. $meta .'"';
				}
				else {
					$alt = 'alt=""';
					$title = '';
				}
				
				// Set alignment parameter
				if ($alignment <> '')
					$alignment = '&a='.$alignment;
					
				//CUSTOMIZATION FOR TUMBLOG PLUGIN	
				$pluginpath = dirname( __FILE__ );					
				$img_link = '<img src="'. WP_PLUGIN_URL. '/' . plugin_basename( $pluginpath ). '/thumb.php?src='. $custom_field .'&amp;w='. $width .'&amp;h='. $height .'&amp;zc=1&amp;q='. $quality . $alignment . '" '.$alt.' class="'. stripslashes($class) .'" '. $set_width . $set_height . ' />';
				
				if( $link == 'img' ) {  // Just output the image
					$output .= $before; 
					$output .= $img_link;
					$output .= $after;  
					
				} else {  // Default - output with link				
	
					if ( ( is_single() OR is_page() ) AND $single == false ) {
						$rel = 'rel="lightbox"';
					} else { 
						$href = get_permalink($id);
						$rel = '';
					}
				
					$output .= $before; 
					$output .= '<a '.$title.' href="' . $href .'" '.$rel.'>' . $img_link . '</a>';
					$output .= $after;  
				}
			}
			
		} else {  // Not Resize
			
			foreach($src_arr as $key => $custom_field){
			
				//Set the ID to the Attachent's ID if it is an attachment
				if($is_auto_image == true){	
					$quick_id = $attachment_id[$key];
				} else {
				 	$quick_id = $id;
				}
				
				if($auto_meta == true) {
					$alt = 'alt="'. get_the_title($quick_id) .'"';
					$title = 'title="'. get_the_title($quick_id) .'"';
				}
				elseif($auto_meta == false) {
					$alt = 'alt="'. $meta.'"';
					$title = 'title="'. $meta .'"';
				}
				else {
					$alt = 'alt=""';
					$title = '';
				}
			
				$img_link =  '<img src="'. $custom_field .'" '. $alt .' '. $set_width . $set_height . ' class="'. stripslashes($class) .'" />';
			
				if ( $link == 'img' ) {  // Just output the image 
					$output .= $before;                   
					$output .= $img_link; 
					$output .= $after;  
					
				} else {  // Default - output with link
				
					if ( is_singular() ) { 
						$href = $custom_field;
						$rel = 'rel="lightbox"';
					} else { 
						$href = get_permalink($id);
						$rel = '';
					}
					 
					$output .= $before;   
					$output .= '<a href="' . $href .'" '. $rel .'>' . $img_link . '</a>';
					$output .= $after;   
				}
			}
		}
		
		// Return or echo the output
		if ( $return == TRUE )
			return $output;
		else 
			echo $output; // Done  
	
	}

}