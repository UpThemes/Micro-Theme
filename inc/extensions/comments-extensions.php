<?php
/**
 * Comments extensions.
 *
 * @package WordPress
 * @subpackage Micro
 * @since Micro 1.0
 */

/*** micro_comments
**   since 1.0
**   accepts 0 args
****************************************/

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

add_action('micro_comments','micro_attach_comments');

/**
 * Output custom comments list for pings
 * 
 * Callback: wp_list_comments() Pings
 * 
 * wp_list_comments() Callback function for 
 * Pings (Trackbacks/Pingbacks)
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