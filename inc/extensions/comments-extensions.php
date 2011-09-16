<?php
/**
 * Theme Comments Extension Functions file
 * 
 * The /inc/extensions/comments-extensions.php file defines
 * all of the Theme's callback functions that hook into
 * Theme custom and WordPress action/filter hooks in comments.php
 *  - micro_comments
 *  - wp_list_comments (callback)
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
 * Output Post Comments
 * 
 * Outputs post comments on single blog posts. 
 * If the Theme option is enabled to use Disqus 
 * comments, then Disqus comment markup is output; 
 * otherwise, the Theme comments template file is 
 * output.
 * 
 * This function hooked into the micro_comments hook, 
 * which is defined in /inc/hooks.php, and which fires
 * in the content.php and content-single.php template
 * files.
 * 
 * Template files: content.php, content-single.php
 * 
 * @link 	http://codex.wordpress.org/Function_Reference/_e		 			_e()
 * @link 	http://codex.wordpress.org/Function_Reference/comments_template 	comments_template()
 * @link 	http://codex.wordpress.org/Function_Reference/is_single 			is_single()
 * @link 	http://codex.wordpress.org/Function_Reference/the_permalink			the_permalink()
 * @link 	http://codex.wordpress.org/Function_Reference/the_title 			the_title()
 * 
 * @param	none
 * @return	string	Comments markup
 * 
 * @since	Micro 1.0
 * 
 */
function micro_attach_comments(){
	if(is_single()):
		global $post,$up_options;
		
		if( $up_options->disqus ): ?>
		
		<div id="disqus_comments">
			
			<script type="text/javascript">var disqus_url = "<?php the_permalink(); ?>"; var disqus_title ="<?php the_title(); ?>";</script>
			<div class="post_box">
				<div id="disqus_thread"></div>
			</div>
			<noscript><a href="http://disqus.com/forums/<?php echo $up_options->disqus; ?>/?url=ref"><?php _e("View the discussion thread","micro"); ?></a></noscript>
		
		</div>
		
		<?php else: ?>
		<div class="comments"><?php comments_template('', true);?></div>
		<?php endif;
	endif;
}
// Hook micro_attach_comments() into micro_comments
add_action('micro_comments','micro_attach_comments');

/**
 * Output custom comments list for pings
 * 
 * Callback: wp_list_comments() Pings
 * 
 * wp_list_comments() Callback function for 
 * Pings (Trackbacks/Pingbacks)
 * 
 * Template file: comments.php
 * 
 * @link	http://codex.wordpress.org/Function_Reference/comment_author_link	Codex reference: comment_author_link()
 * @link	http://codex.wordpress.org/Function_Reference/comment_class	Codex reference: comment_class()
 * @link	http://codex.wordpress.org/Function_Reference/comment_ID	Codex reference: comment_ID()
 * 
 * @since	Micro 1.0
 */
function micro_comment_list_pings( $comment ) {
	$GLOBALS['comment'] = $comment;
?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo comment_author_link(); ?></li>
<?php }