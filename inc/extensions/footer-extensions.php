<?php
/**
 * Footer extensions.
 *
 * @package WordPress
 * @subpackage Micro
 * @since Micro 1.0
 */


/*** micro_open_footer
**   since 1.0
**   accepts 0 args
****************************************/

function micro_open_footer(){

	echo '<div id="footer">';
	echo '<div class="container">';

}

add_action('micro_footer','micro_open_footer',1);

/*** micro_footer_widgets
**   since 1.0
**   accepts 0 args
****************************************/

function micro_footer_widgets(){
	get_sidebar('footer');
}

add_action('micro_footer','micro_footer_widgets',30);

/*** micro_credits
**   since 1.0
**   accepts 0 args
****************************************/

function micro_credits(){
	global $up_options;
	
	echo '<div class="credits">';
	echo $up_options->footertext;
	echo '<div class="clear"></div>';
	echo '</div><!-- .credits -->';

}

add_action('micro_footer','micro_credits',60);

/*** micro_close_footer
**   since 1.0
**   accepts 0 args
****************************************/

function micro_close_footer(){
	echo '</div><!-- .container -->';
	echo '</div><!-- #footer -->';
}

add_action('micro_footer','micro_close_footer',100);

/*** micro_add_ga
**   since 1.0
**   accepts 0 args
****************************************/

function micro_add_ga(){

    if( $up_options->google_analytics ): ?>
	    <script type="text/javascript">
	    var _gaq = _gaq || [];
	    _gaq.push(['_setAccount', '<?php echo $up_options->google_analytics; ?>']);
	    _gaq.push(['_trackPageview']);
	    (function() {
	      var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	      ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	      var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	    })();
	    </script>
    <?php endif;

}

add_action('wp_footer','micro_add_ga');

/*** micro_add_disqus
**   since 1.0
**   accepts 0 args
****************************************/

function micro_add_disqus(){

	global $up_options;

    if( $up_options->disqus ): ?>
    
	    <?php if( is_single() ): ?>
	    <script type="text/javascript" src="http://disqus.com/forums/<?php echo $up_options->disqus; ?>/embed.js"></script>
	    <?php endif; ?>

		<script type="text/javascript">
		
			$comment_links = jQuery('.post-comments').find('a');
						
			$comment_links.each(function(i){

				href = jQuery(this).attr('href');
				href = href.replace('#respond','');
				jQuery(this).attr('href',href+"#disqus_thread");
			
			});
		
		    /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
		    var disqus_shortname = '<?php echo $up_options->disqus; ?>'; // required: replace example with your forum shortname
		
		    /* * * DON'T EDIT BELOW THIS LINE * * */
		    (function () {
		        var s = document.createElement('script'); s.async = true;
		        s.type = 'text/javascript';
		        s.src = 'http://' + disqus_shortname + '.disqus.com/count.js';
		        (document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
		    }());
		</script>

    <?php endif;

}

add_action('wp_footer','micro_add_disqus');