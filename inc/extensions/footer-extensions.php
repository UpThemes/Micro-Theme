<?php
/**
 * Theme Header Extension Functions file
 * 
 * The /inc/extensions/footer-extensions.php file defines
 * all of the Theme's callback functions that hook into
 * Theme custom and WordPress action/filter hooks in footer.php
 *  - micro_footer
 *  - wp_footer
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
 * Add Footer container open tag
 * 
 * Adds opening DIV tag for site footer.
 * 
 * This function hooked into the micro_footer hook, 
 * which is defined in /inc/hooks.php, and which fires
 * in the footer.php template file.
 * 
 * Child Themes can remove this output by calling 
 * remove_action( 'micro_footer', 'micro_open_footer', 1 );
 * 
 * Template file: footer.php
 * 
 * @param	none
 * @return	string	HTML markup for site footer container open tag
 * 
 * @since	Micro 1.0
 * 
 */
function micro_open_footer(){

	echo '<div id="footer">';
	echo '<div class="container">';

}
// Hook micro_open_footer() into micro_footer
add_action( 'micro_footer', 'micro_open_footer', 1 );

/**
 * Output Site Footer Widgets
 * 
 * Outputs the site footer Widget areas, inside the 
 * footer container open tag.
 * 
 * This function hooked into the micro_footer hook, 
 * which is defined in /inc/hooks.php, and which fires
 * in the footer.php template file.
 * 
 * Child Themes can remove this output by calling 
 * remove_action( 'micro_footer', 'micro_footer_widgets', 30 );
 * 
 * Template file: footer.php
 * 
 * @link 	http://codex.wordpress.org/Function_Reference/get_sidebar 	get_sidebar()
 * 
 * @param	none
 * @return	string	Markup for footer Widget area
 * 
 * @since	Micro 1.0
 * 
 */
function micro_footer_widgets(){
	/**
	 * Include the sidebar-footer template part file
	 * 
	 * Calls the sidebar-footer template part file.
	 * 
	 * Codex reference: http://codex.wordpress.org/Function_Reference/get_sidebar
	 * 
	 * Child Themes can replace this template part file globally, 
	 * via "sidebar-footer.php"
	 */
	get_sidebar( 'footer' );
}
// Hook micro_footer_widgets() into micro_footer
add_action( 'micro_footer' , 'micro_footer_widgets' , 30 );

/**
 * Add Theme Credits to Site Footer
 * 
 * Outputs the Theme credits in the site footer, 
 * below the footer Widget area.
 * 
 * This function hooked into the micro_footer hook, 
 * which is defined in /inc/hooks.php, and which fires
 * in the footer.php template file.
 * 
 * Child Themes can remove this output by calling 
 * remove_action( 'micro_footer', 'micro_footer_credits', 60 );
 * 
 * Template file: footer.php
 * 
 * @param	none
 * @return	string	HTML markup for Theme credits
 * 
 * @since	Micro 1.0
 * 
 */
function micro_credits(){
	global $up_options;
	
	echo '<div class="credits">';
	echo $up_options->footertext;
	echo '<div class="clear"></div>';
	echo '</div><!-- .credits -->';

}
// Hook micro_credits() into micro_footer
add_action( 'micro_footer', 'micro_credits', 60 );

/**
 * Add Footer container close tag
 * 
 * Adds closing DIV tag for site footer, after 
 * the Theme credits.
 * 
 * This function hooked into the micro_footer hook, 
 * which is defined in /inc/hooks.php, and which fires
 * in the footer.php template file.
 * 
 * Child Themes can remove this output by calling 
 * remove_action( 'micro_footer', 'micro_close_footer', 100 );
 * 
 * Template file: footer.php
 * 
 * @param	none
 * @return	string	HTML markup for site footer container close tag
 * 
 * @since	Micro 1.0
 * 
 */
function micro_close_footer(){
	echo '</div><!-- .container -->';
	echo '</div><!-- #footer -->';
}
// Hook micro_close_footer() into micro_footer
add_action( 'micro_footer', 'micro_close_footer', 100 );

/**
 * Add Google Analytics to HTML Footer
 * 
 * Outputs Google Analytics script code in the HTML 
 * footer, below the site content.
 * 
 * This function hooked into the wp_footer hook, 
 * which fires in the wp_footer() template tag,
 * called in the footer.php template file.
 * 
 * Child Themes can remove this output by calling 
 * remove_action( 'wp_footer', 'micro_add_ga' );
 * 
 * Template file: footer.php
 * 
 * @param	none
 * @return	string	Google Analytics script markup
 * 
 * @since	Micro 1.0
 * 
 */
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
// Hook micro_add_ga() into wp_footer
add_action( 'wp_footer', 'micro_add_ga' );

/**
 * Add Disqus script to HTML Footer
 * 
 * Outputs Disqus script code in the HTML 
 * footer, below the site content.
 * 
 * This function hooked into the wp_footer hook, 
 * which fires in the wp_footer() template tag,
 * called in the footer.php template file.
 * 
 * Child Themes can remove this output by calling 
 * remove_action( 'wp_footer', 'micro_add_disqus' );
 * 
 * Template file: footer.php
 * 
 * @param	none
 * @return	string	Disqus script markup
 * 
 * @since	Micro 1.0
 * 
 */
function micro_add_disqus(){

	global $up_options;

    if( $up_options->disqus && is_single() && comments_open() ): ?> 

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
// Hook micro_add_disqus() into wp_footer
add_action( 'wp_footer', 'micro_add_disqus' );