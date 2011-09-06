<?php

/* Define the custom box */

// WP 3.0+
// add_action('add_meta_boxes', 'myplugin_add_custom_box');

// backwards compatible
add_action('admin_init', 'tumblog_add_custom_box', 1);

add_action( 'admin_menu' , 'remove_post_custom_fields' );

/* Adds a box to the main column on the Post and Page edit screens */
function tumblog_add_custom_box() {
	$upthemes =  THEME_DIR.'/admin/';
	
	add_meta_box( 'tumblog', __( 'Tumblog Options', 'micro' ), 'tumblog_meta_box', 'post', 'normal', 'high' );
	wp_enqueue_script('ajaxupload', $upthemes."js/ajaxupload.js", array('jquery'));
}

function remove_post_custom_fields() {
	remove_meta_box( 'postcustom' , 'post' , 'normal' ); 
}

/* Prints the box content */
function tumblog_meta_box() {

	// Use nonce for verification
	wp_nonce_field( 'tumblog', 'tumblog-boxes' );

	global $post;
	
	$metaboxes = array(
	
	    "image" => array (
	        "name" => "image",
	        "label" => "Image",
	        "type" => "image",
	        "desc" => "Enter path to image file here."
	    ),
		 "gallery" => array (
	        "name" => "gallery",
	        "label" => "Gallery Style",
	        "type" => "select",
			"options" => array(
				"Slider" => 'slider',
				"Grid" => 'grid',
				"Full-Width List" => 'list'
			),
	        "desc" => "Enter path to image file here."
	    ),
	    "video-embed" => array (
	        "name" => "video-embed",
	        "label" => "Embed Code (Videos)",
	        "type" => "textarea",
	        "desc" => "Add embed code for video services like Youtube or Vimeo"
	    ),
            "video-url" => array (
	        "name" => "video-url",
	        "label" => "Video URL (Vimeo or Youtube)",
	        "type" => "text",
	        "desc" => "Add a video URL."
	    ),
	    "quote-author" => array (
	        "name"  => "quote-author",
	        "std"  => "Unknown",
	        "label" => "Quote Author",
	        "type" => "text",
	        "desc" => "Enter the name of the quote author."
	    ),
	    "quote-url" => array (
	        "name"  => "quote-url",
	        "std"  => "http://",
	        "label" => "Link to Quote",
	        "type" => "text",
	        "desc" => "Enter the url/web address of the quote if available."
	    ),
	    "quote-copy" => array (
	        "name"  => "quote-copy",
	        "std"  => "Unknown",
	        "label" => "Quote",
	        "type" => "textarea",
	        "desc" => "Enter the Quote."
	    ),
	    "audio" => array (
	        "name"  => "audio",
	        "std"  => "http://",
	        "label" => "Audio URL",
	        "type" => "text",
	        "desc" => "Enter the url/web address of the audio file."
	    ),
        "link-text" => array (
	        "name"  => "link-text",
	        "std"  => "Unknown",
	        "label" => "Link Text",
	        "type" => "text",
	        "desc" => "Enter the link text."
	    ),
	    "link-url" => array (
	        "name"  => "link-url",
	        "std"  => "http://",
	        "label" => "Link URL",
	        "type" => "text",
	        "desc" => "Enter the url/web address of the link."
	    )
	
	);

?>
<style type="text/css">
	#tumblog label{ float: left; clear: left; width: 28%; padding-top: 6px; padding-right: 3%; text-align: right; font-weight: bold; }
	#tumblog input[type="text"],textarea{ float: left; margin-bottom: 10px; width: 68%; }
	#tumblog img{ max-width: 68%; float: none; }
	#tumblog .inside div{ float: none; }
	#tumblog .uploadify{ overflow: auto; margin: 5px 0 10px 31%; width: auto; clear: both; }
	#tumblog kbd{ margin-left: 31%; background-color: # }
</style>
<script type="text/javascript">

jQuery(function($){

	var tumblog = {
		container 	: $('#tumblog'),
		inside 		: $('#tumblog').find('.inside'),
		postarea 	: $('.postarea'),
		complete 	: false
	}
	
	var go_switch_post_type = function($value){
		
		switch($value){
	
		case 'image':
			tumblog.inside.find('.link-url,.gallery,.link-text,.quote-author,.quote-url,.quote-copy,.video-embed,.video-url,.audio').hide();
			tumblog.container.slideDown('fast');
			tumblog.postarea.slideDown('fast');
			tumblog.inside.find('.image').show();
			break;
		case 'link':
			tumblog.inside.find('.image,.gallery,.quote-author,.quote-url,.quote-copy,.video-embed,.video-url,.audio').hide();
			tumblog.container.slideDown('fast');
			tumblog.postarea.slideDown('fast');
			tumblog.inside.find('.link-url,.link-text').show();
			break;
		case 'quote':
			tumblog.inside.find('.image,.gallery,.link-url,.link-text,.video-embed,.video-url,.audio').hide();
			tumblog.container.slideDown('fast');
			tumblog.postarea.slideDown('fast');
			tumblog.inside.find('.quote-author,.quote-url,.quote-copy').show();
			break;
		case 'video':
			tumblog.inside.find('.image,.gallery,.quote-author,.quote-url,.quote-copy,.link-url,.link-text,.audio').hide();
			tumblog.container.slideDown('fast');
			tumblog.postarea.slideDown('fast');
			tumblog.inside.find('.video-embed,.video-url').show();			
			break;
		case 'audio':
			tumblog.inside.find('.image,.gallery,.quote-author,.quote-url,.quote-copy,.link-url,.link-text,.video-embed,.video-url,').hide();
			tumblog.container.slideDown('fast');
			tumblog.postarea.slideDown('fast');
			tumblog.inside.find('.audio').show();			
			break;
		case 'gallery':
			tumblog.inside.find('.image,.audio,.quote-author,.quote-url,.quote-copy,.link-url,.link-text,.video-embed,.video-url,').hide();
			tumblog.container.slideDown('fast');
			tumblog.postarea.slideDown('fast');
			tumblog.inside.find('.gallery').show();			
			break;
		case 'status':
			tumblog.postarea.slideUp('fast');
			tumblog.container.slideUp('fast');
			break;
		default:
			tumblog.inside.find('.image,.gallery,.quote-author,.quote-url,.quote-copy,.link-url,.link-text,.video-embed,.video-url,.audio').hide();
			tumblog.container.slideUp('fast');
			tumblog.postarea.slideDown('fast');
			break;
		}
	
		tumblog.complete = true;
	
	}

	value = $('#post-formats-select').find('[type="radio"]:checked').val();
	
	// start it out with the right post type
	$(document).ready(function(e){
		
		if(!tumblog.complete)
			go_switch_post_type(value);

	});
	
	$('#post-formats-select input[type="radio"]').live('change',function(e){
			
		$value = $(this).attr('value');
		go_switch_post_type($value);
	
	});

});

</script>
<?php
	
	foreach($metaboxes as $metabox):
	
		$type = $metabox['type'];
		$name = $metabox['name'];
		$value = get_post_meta($post->ID, $metabox['name'], true);

		echo "<div class='{$metabox['name']}'>";
		echo "<label for='{$metabox['name']}'>{$metabox['label']}</label>";
				
		switch($type):
		
			case 'text':
				echo "<input type='text' id='{$metabox['name']}' name='{$metabox['name']}' value='{$value}'>";
				break;
			
			case 'textarea':
				echo "<textarea cols='10' id='{$metabox['name']}' name='{$metabox['name']}'>{$value}</textarea>";
				break;
			
			case 'select':?>
				<select id='<?php echo $metabox['name'];?>' name='<?php echo $metabox['name'];?>'>
					<?php foreach($metabox['options'] as $name => $val):?>
						<?php if($val === $value) $check_selected = 'selected="selected"';?>
						<option value="<?php echo $val;?>" <?php echo $check_selected;?>><?php echo $name;?></option>
						<?php $check_selected = '';?>
					<?php endforeach;?>
				</select>
				<?php break;
			
			case 'image':?>
				<script type="text/javascript">
					jQuery(function($){
						<?php //Upload Security
						$upload_security = md5($_SERVER['SERVER_ADDR']); ?>
						//Upload an Image
						var <?php echo $metabox['name']; ?>=$('div.uploadify button#<?php echo $metabox['name']; ?>');
						var status=$('#<?php echo $metabox['name']; ?>status');
						new AjaxUpload(<?php echo $metabox['name']; ?>, {
							action: '<?php echo THEME_DIR; ?>/admin/upload-file.php',
							name: '<?php echo $upload_security?>',
							data: {
								upload_path : '<?php echo base64_encode(UPFW_UPLOADS_DIR); ?>'
							},
							onSubmit: function(file, ext){
								//Check if file is an image
								if (! (ext && /^(JPG|PNG|GIF|jpg|png|jpeg|gif)$/.test(ext))){ 
								   // extension is not allowed 
								   status.text('Only JPG, PNG or GIF files are allowed');
								   return false;
								}
								$('#<?php echo $metabox['name']; ?>loader').addClass('activeload');
							},
							onComplete: function(file, response){
								//On completion clear the status
								status.text('');
								//Successful upload
								if(response==="success"){
									$file = file.toLowerCase().replace(/ /g,'_').replace(/(_)\1+/g, '_').replace(/[^\w\(\).-]/gi,'_').replace(/__/g,'_');
									//Preview uploaded file
									$('#<?php echo $metabox['name']; ?>preview').removeClass('uploaderror');
									$('#<?php echo $metabox['name']; ?>preview').html('<img class="preview" src="<?php echo UPFW_UPLOADS_URL; ?>/'+$file+'" alt="<?php echo $metabox['name']; ?> Image" />').addClass('success');
									//Add image source to hidden input
									$('input#<?php echo $metabox['name']; ?>').attr('value', '<?php echo UPFW_UPLOADS_URL; ?>/'+$file);
									//Save Me Fool
									$('#button-zone').animate({ 
										backgroundColor: '#555',
										borderLeftColor: '#555',
										borderRightColor: '#555'
									});
									$('#button-zone button').addClass('save-me-fool');
									$('.formState').fadeIn( 400 );
								} else{
									//Something went wrong
									$('#<?php echo $metabox['name']; ?>preview').text(file+' did not upload. Please try again.').addClass('uploaderror');
								}
								$('#<?php echo $metabox['name']; ?>loader').removeClass('activeload');
							}
						});
					});
				</script>

				<!-- Image Preview Input -->
				<div id="<?php echo $metabox['name']; ?>preview">
					<?php if($value):
						echo "<img src='{$value}' alt='Preview Image' />";
					else:
						echo "<img src='".THEME_DIR."/admin/images/upfw_noimage.gif' alt='No Image Available' />";
					endif;?>
				</div>	

				<div class="uploadify">
					<button type="button" id="<?php echo $metabox['name']; ?>" class="secondary" <?php echo $attr; ?>><?php _e('Upload Image','upfw'); ?></button>
					<span id="<?php echo $metabox['name']; ?>loader" class="loader"></span>
				</div>

				<!-- Hidden Input -->
				<input type="hidden" name="<?php echo $metabox['name']; ?>" id="<?php echo $metabox['name']; ?>" name="<?php echo $metabox['name']; ?>" value="<?php echo $value; ?>" />

				<!-- Upload Status Input -->
				<div class="status hide" id="<?php echo $metabox['name']; ?>status"></div>
				<div class="clear"></div>
			<?php break;
			
			case 'video':
				echo "<textarea cols='10' id='{$metabox['name']}' name='{$metabox['name']}'>{$value}</textarea>";
				break;
			
		endswitch;
		
		switch($name):
			
			case 'link-url':
				echo '<kbd>Enter an optional title and description in the standard title and content fields above.</kbd>';
				break;
			case 'gallery':
				echo '<kbd>Enter an optional title and description in the standard title and content fields above.</kbd>';
				break;
			
		endswitch;?>
	
		<div class='clear'></div>

	</div>
	
	<?php endforeach;
}

/* When the post is saved, saves our custom data */
function tumblog_save_postdata( $post_id ) {
	
	// verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times
		
	if ( !wp_verify_nonce( $_POST['tumblog-boxes'], 'tumblog' )) {
		return $post_id;
	}
	
	// verify if this is an auto save routine. If it is our form has not been submitted, so we dont want
	// to do anything
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
		return $post_id;
	
	// Check permissions
	if ( 'page' == $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_page', $post_id ) )
			return $post_id;
	} else {
		if ( !current_user_can( 'edit_post', $post_id ) )
			return $post_id;
	}
	
	// OK, we're authenticated: we need to find and save the data	
	$image = $_POST['image'];
	$videoembed = $_POST['video-embed'];
	$videourl = $_POST['video-url'];
	if( $videourl && function_exists('convert_url_to_embed') )$videoembed = convert_url_to_embed($videourl);
	$videoembed = $videoembed ? $videoembed : $_POST['video-embed'];
	$quoteauthor = $_POST['quote-author'];
	$quoteurl = $_POST['quote-url'];
	$quotecopy = $_POST['quote-copy'];
	$audio = $_POST['audio'];
	$gallery = $_POST['gallery'];
	$linkurl = $_POST['link-url'];
    $linktext = $_POST['link-text'];
	if($image) update_post_meta($post_id,'image',$image);
	if($videoembed) update_post_meta($post_id,'video-embed',$videoembed);
    if($videourl) update_post_meta($post_id,'video-url',$videourl);
	if($quoteauthor) update_post_meta($post_id,'quote-author',$quoteauthor);
	if($quotecopy) update_post_meta($post_id,'quote-copy',$quotecopy);
    if($quoteurl) update_post_meta($post_id,'quote-url',$quoteurl);
	if($audio) update_post_meta($post_id,'audio',$audio);
	if($gallery) update_post_meta($post_id,'gallery',$gallery);
	if($linkurl) update_post_meta($post_id,'link-url',$linkurl);
    if($linktext) update_post_meta($post_id,'link-text',$linktext);

}

/* Do something with the data entered */
add_action('save_post', 'tumblog_save_postdata');