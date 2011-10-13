<?php
/**
 * Theme Tumblog Metabox Functions file
 * 
 * The /inc/metaboxes/tumblog-meta.php file includes
 * the Theme's Tumblog metabox functions
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
 * Customize Meta Boxes on Post Edit Screen
 * 
 * Adds the Tumblog metabox to the post-edit
 * screen, to allow entry of Tumblog-style 
 * post content based on selected Post Format 
 * type.
 * 
 * Removes the standard custom field metabox from 
 * the post-edit screen, since custom post meta 
 * data will be added via the Tumblog metabox.
 * 
 * @link 	http://codex.wordpress.org/Function_Reference/add_meta_box 			add_meta_box()
 * @link 	http://codex.wordpress.org/Function_Reference/remove_meta_box 		remove_meta_box()
 * 
 * @param	none
 * @return	none
 * 
 * @since	Micro 1.0
 * 
 */
function tumblog_customize_meta_boxes() {
	
	// Remove 'postcustom' metabox
	remove_meta_box( 'postcustom' , 'post' , 'normal' ); 
	// Add Tumblog metabox
	add_meta_box( 'tumblog', __( 'Tumblog Options', 'micro' ), 'tumblog_meta_box', 'post', 'normal', 'high' );
}
// Hook tumblog_add_custom_box() into admin_init action
add_action( 'add_meta_boxes_post', 'tumblog_customize_meta_boxes' );

/**
 * Enqueue Tumblog Scripts
 * 
 * @link 	http://codex.wordpress.org/Function_Reference/wp_enqueue_script 	wp_enqueue_script()
 * 
 * @param	none
 * @return	none
 * 
 * @since	Micro 1.0
 * 
 */
function tumblog_enqueue_scripts() {
	
	global $pagenow;
	if ( 'post.php' == $pagenow || 'post-new.php' == $pagenow ) {
		$upthemes =  THEME_DIR.'/admin/';
		wp_enqueue_script( 'ajaxupload', $upthemes."js/ajaxupload.js", array( 'jquery' ) );
	}

}
// Hook tumblog_enqueue_scripts() into admin_init action
add_action( 'admin_enqueue_scripts', 'tumblog_enqueue_scripts' );

/**
 * Define Markup for the Tumblog Metabox
 * 
 * Defines the markup for the Tumblog metabox,
 * including specific input fields based on the 
 * selected Post Format type.
 * 
 * @link 	http://codex.wordpress.org/Function_Reference/get_post_meta 	get_post_meta()
 * @link 	http://codex.wordpress.org/Function_Reference/wp_nonce_field	wp_nonce_field()
 * 
 * @param	none
 * @return	string	Markup for post-edit screen metabox
 * 
 * @since	Micro 1.0
 * 
 */
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
	
	foreach( $metaboxes as $metabox ) :
	
		$type = $metabox['type'];
		$name = $metabox['name'];
		$value = get_post_meta($post->ID, $metabox['name'], true);

		echo '<div class="' . $metabox['name'] . '">';
		echo '<label for="' . $metabox['name'] . '">' . $metabox['label'] . '</label>';
				
		switch( $type ) :
		
			case 'text' :
				echo '<input type="text" id="' . $metabox['name'] . '" name="' . $metabox['name'] . '" value="' . esc_attr( $value ) . '">';
				break;
			
			case 'textarea' :
				echo '<textarea cols="10" id="' . $metabox['name'] . '" name="' . $metabox['name'] . '">' . esc_textarea( $value ) . '</textarea>';
				break;
			
			case 'select' :
				?>
				<select id="<?php echo $metabox['name']; ?>" name="<?php echo $metabox['name']; ?>">
					<?php foreach($metabox['options'] as $name => $val):?>
						<option value="<?php echo $val;?>" <?php selected( $value == $val ); ?>><?php echo $name;?></option>
					<?php endforeach;?>
				</select>
				<?php 
				break;
			
			case 'image' :
				?>
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
					<button type="button" id="<?php echo $metabox['name']; ?>" class="secondary" <?php global $attr; echo $attr; ?>><?php _e('Upload Image','upfw'); ?></button>
					<span id="<?php echo $metabox['name']; ?>loader" class="loader"></span>
				</div>

				<!-- Hidden Input -->
				<input type="hidden" name="<?php echo $metabox['name']; ?>" id="<?php echo $metabox['name']; ?>" name="<?php echo $metabox['name']; ?>" value="<?php echo $value; ?>" />

				<!-- Upload Status Input -->
				<div class="status hide" id="<?php echo $metabox['name']; ?>status"></div>
				<div class="clear"></div>
				<?php 
				break;
			
			case 'video' :
				echo '<textarea cols="10" id="' . $metabox['name'] . '" name="' . $metabox['name'] . '">' . esc_textarea( $value ) . '</textarea>';
				break;
			
		endswitch;
		
		switch( $name ):
			
			case 'link-url' :
				echo '<kbd>Enter an optional title and description in the standard title and content fields above.</kbd>';
				break;
			case 'gallery' :
				echo '<kbd>Enter an optional title and description in the standard title and content fields above.</kbd>';
				break;
			
		endswitch;?>
	
		<div class='clear'></div>

	</div>
	
	<?php endforeach;
}

/* When the post is saved, saves our custom data */
/**
 * Save Tumblog Post Custom Meta Data
 * 
 * Validates/sanitizes and saves post custom meta 
 * data entered via the Tumblog metabox.
 * 
 * @uses	micro_convert_url_to_embed	Defined in /inc/media.php
 * 
 * @link 	http://codex.wordpress.org/Function_Reference/current_user_can 	current_user_can()
 * @link 	http://codex.wordpress.org/Function_Reference/update_post_meta 	update_post_meta()
 * @link 	http://codex.wordpress.org/Function_Reference/wp_verify_nonce	wp_verify_nonce()
 * 
 * @link 	http://php.net/manual/en/function.defined.php 					defined()
 * @link 	http://php.net/manual/en/function.function-exists.php 			function_exists()
 * 
 * @param	int 	$post_id	Current post ID
 * @return	none
 * 
 * @since	Micro 1.0
 * 
 */
function tumblog_save_postdata( $post_id ) {
	
	// verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times
		
	if ( ! isset( $_POST['tumblog-boxes'] ) || ! wp_verify_nonce( $_POST['tumblog-boxes'], 'tumblog' ) ) {
		return $post_id;
	}
	
	// verify if this is an auto save routine. If it is our form has not been submitted, so we dont want
	// to do anything
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
		return $post_id;
	
	// Check permissions
	if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {
		if ( ! current_user_can( 'edit_page', $post_id ) )
			return $post_id;
	} else {
		if ( ! current_user_can( 'edit_post', $post_id ) )
			return $post_id;
	}
	
	// OK, we're authenticated: we need to find and save the data	
	$image = ( isset( $_POST['image'] ) ? esc_url( $_POST['image'] ) : false );
	$videoembed = ( isset( $_POST['video-embed'] ) ? esc_html( $_POST['video-embed'] ) : false );
	$videourl = ( isset( $_POST['video-url'] ) ? esc_url( $_POST['video-url'] ) : false );
	if( $videourl ) $videoembed = micro_convert_url_to_embed( $videourl );
	$videoembed = $videoembed ? $videoembed : esc_html( $_POST['video-embed'] );
	$quoteauthor = ( isset( $_POST['quote-author'] ) ? esc_attr( $_POST['quote-author'] ) : false );
	$quoteurl = ( isset( $_POST['quote-url'] ) ? esc_url( $_POST['quote-url'] ) : false );
	$quotecopy = ( isset( $_POST['quote-copy'] ) ? wp_kses_post( $_POST['quote-copy'] ) : false );
	$audio = ( isset( $_POST['audio'] ) ? esc_url( $_POST['audio'] ) : false );
	$gallery = ( isset( $_POST['gallery'] ) && in_array( $_POST['gallery'], array( 'grid', 'list', 'slider' ) ) ? $_POST['gallery'] : false );
	$linkurl = ( isset( $_POST['link-url'] ) ? esc_url( $_POST['link-url'] ) : false );
    $linktext = ( isset( $_POST['link-text'] ) ? esc_attr( $_POST['link-text'] ) : false );
	if( $image ) update_post_meta( $post_id, 'image', $image );
	if( $videoembed ) update_post_meta( $post_id, 'video-embed', $videoembed );
    if( $videourl ) update_post_meta( $post_id, 'video-url', $videourl );
	if( $quoteauthor ) update_post_meta( $post_id, 'quote-author', $quoteauthor );
	if( $quotecopy ) update_post_meta( $post_id, 'quote-copy', $quotecopy );
    if( $quoteurl ) update_post_meta( $post_id, 'quote-url', $quoteurl );
	if( $audio ) update_post_meta( $post_id, 'audio', $audio );
	if( $gallery ) update_post_meta( $post_id, 'gallery', $gallery );
	if( $linkurl ) update_post_meta( $post_id, 'link-url', $linkurl );
    if( $linktext ) update_post_meta( $post_id, 'link-text', $linktext );

}

/* Do something with the data entered */
add_action( 'save_post', 'tumblog_save_postdata' );