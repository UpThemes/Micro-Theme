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
