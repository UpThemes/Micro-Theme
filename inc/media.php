<?php
/**
 * Theme Media Functions file
 * 
 * The /inc/media.php file defines 
 * all of the Theme's custom, media-handling functions
 *  - micro_audio_content()
 *  - micro_resize_video()
 *  - micro_tumblog_embed()
 * 
 * @package 	Micro
 * @copyright	Copyright (c) 2011, UpThemes
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 *
 * @since 		Micro 1.0
 */

/**
 * Resize Video to 16:9 Ratio
 * 
 * Resizes videos to 16:9 aspect ratio, for videos added to 
 * posts with the Post Format type "Video".
 * 
 * This function is called within the micro_content() function, 
 * which is defined in /inc/extensions/content-extensions.php. This 
 * function is also called within the micro_embed_tumblog() funtion,
 * which is defined in /inc/media.php.
 * 
 * Template files: content.php, content-page.php, content-single.php
 * 
 * @param	string	$markup		(required) HTML markup containing video
 * @return	string	HTML markup containing video, with width="" and height="" attributes modified
 * 
 * @since	Micro 1.0
 * 
 */
function micro_resize_video( $markup ) {
	
	$w = CONTENT_WIDTH;
	$h = ( CONTENT_WIDTH / 16 ) * 9;

	$patterns = array();
	$replacements = array();
	if( ! empty( $w ) )
	{
	$patterns[] = '/width="([0-9]+)px;"/';
	$patterns[] = '/width:([0-9]+)px;/';
	
	$replacements[] = '';
	$replacements[] = '';
	}
	
	if( !empty($h) )
	{
	$patterns[] = '/height="([0-9]+)px;"/';
	$patterns[] = '/height:([0-9]+)px;/';
	
	$replacements[] = '';
	$replacements[] = '';
	}
	
	return preg_replace( $patterns, $replacements, $markup );

}

/**
 * Echo Embedded Video URL
 * 
 * Echoes the URL of a video added to a post via
 * the 'video-embed' custom field, for posts with
 * the Post Format "Video".
 * 
 * This function is called within the micro_content() function, 
 * which is defined in /inc/extensions/content-extensions.php.
 * 
 * @uses	micro_resize_video()	Defined in /inc/media.php
 * 
 * @param	none
 * @return	string	URL of embedded video
 * 
 * @since	Micro 1.0
 * 
 */
function micro_tumblog_embed($id) {

	//Defaults
	$id = null;	

  	if( empty( $id ) ) {
    	global $post;
    	$id = $post->ID;
    }
        
	$custom_field = get_post_meta( $id, 'video-embed', true );
	
    echo $custom_field;

}