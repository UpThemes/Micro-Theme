<?php

/**
 * Media-specific functions.
 *
 * @package WordPress
 * @subpackage Micro
 * @since Micro 1.0
 */

/*** micro_resize_video
**   since 1.0
**   accepts 1 arg: $markup
****************************************/

function micro_resize_video($markup){
	
	$w = CONTENT_WIDTH;
	$h = (CONTENT_WIDTH/16)*9;

	$patterns = array();
	$replacements = array();
	if( !empty($w) )
	{
	$patterns[] = '/width="([0-9]+)"/';
	$patterns[] = '/width:([0-9]+)/';
	
	$replacements[] = 'width="'.$w.'"';
	$replacements[] = 'width:'.$w;
	}
	
	if( !empty($h) )
	{
	$patterns[] = '/height="([0-9]+)"/';
	$patterns[] = '/height:([0-9]+)/';
	
	$replacements[] = 'height="'.$h.'"';
	$replacements[] = 'height:'.$h;
	}
	
	return preg_replace($patterns, $replacements, $markup);

}

/*** micro_audio_content
**   since 1.0
**   accepts 0 args
****************************************/

function micro_audio_content() {
	
	global $post;
	
	$post_id = $post->ID;
		
	//Post Args
	$args = array(
	    'post_type' => 'attachment',
	    'numberposts' => -1,
	    'post_status' => null,
	    'post_parent' => $post_id
	);
	
	//Get attachements 
	$attachments = get_posts($args);
	if ($attachments) {
	    foreach ($attachments as $attachment) {
	    	$link_url = $attachment->guid;
	    }
	}
	else {
	    $link_url = get_post_meta($post_id,'audio',true);
	}
	
	if(!empty($link_url)) {
		
		$content_tumblog = '<div class="audio"><div id="mediaspace'.$post_id.'"></div></div>'; 
		  
		$content_tumblog .= '<script type="text/javascript">
		      				var so = new SWFObject("'.get_template_directory_uri(). '/audio/player.swf","mpl","500","32","9");
		      				so.addParam("allowfullscreen","true");
		      				so.addParam("allowscriptaccess","always");
		      				so.addParam("wmode","opaque");
		      				so.addParam("wmode","opaque");
		      				so.addVariable("skin", "'.get_template_directory_uri(). '/audio/stylish_slim.swf");
		      				so.addVariable("file","'.$link_url.'");
		      				so.addVariable("backcolor","000000");
		      				so.addVariable("frontcolor","FFFFFF");
		      				so.write("mediaspace'.$post_id.'");
		    				</script>';
		    
	}
	
	echo $content_tumblog;
}

/*** micro_tumblog_embed
**   since 1.0
**   accepts no args
****************************************/

function micro_tumblog_embed() {

	//Defaults
	$id = null;	

  	if(empty($id)) {
    	global $post;
    	$id = $post->ID;
    }
        
	$custom_field = get_post_meta($id, 'video-embed', true);
	
    echo micro_resize_video($custom_field);

}