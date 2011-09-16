<?php
/**
 * Footer Template Part File
 * 
 * Template part file that contains the site footer and
 * closing HTML body elements
 *
 * This file is called by all primary template pages
 * 
 * Child Themes can override this template part file globally,
 * via "footer.php", or in a given specific context, via
 * "footer-{context}.php". For example, to replace this
 * template part file on static Pages, a Child Theme would
 * include the file "footer-page.php".
 * 
 * @uses 		micro_after_content()		Defined in /inc/hooks.php
 * @uses 		micro_after_footer()		Defined in /inc/hooks.php
 * @uses 		micro_after_posts()			Defined in /inc/hooks.php
 * @uses 		micro_before_footer()		Defined in /inc/hooks.php
 * @uses 		micro_footer()				Defined in /inc/hooks.php
 * @uses 		micro_after_posts()			Defined in /inc/hooks.php
 * @uses		upfw_get_template_context()	Defined in /admin/functions.php
 * 
 * @link 		http://codex.wordpress.org/Function_Reference/get_sidebar	get_sidebar()
 * @link 		http://codex.wordpress.org/Function_Reference/wp_footer		wp_footer()
 * 
 * @package 	Micro
 * @copyright	Copyright (c) 2011, UpThemes
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 *
 * @since 		Micro 1.0
 */

global $up_options; ?>

			<?php 
			/**
			 * Fire the 'micro_after_posts' custom action hook
			 * 
			 * @param	null
			 * @return	mixed	any output hooked into 'micro_after_posts'
			 */
			micro_after_posts(); 
			?>
				
		</div> <!-- #content -->

		<?php 
		/**
		 * Fire the 'micro_after_content' custom action hook
		 * 
		 * @param	null
		 * @return	mixed	any output hooked into 'micro_after_content'
		 */
		micro_after_content(); 
		?>

		<?php 
		/**
		 * Include the sidebar template part file
		 * 
		 * Calls the sidebar template part file.
		 * 
		 * Codex reference: http://codex.wordpress.org/Function_Reference/get_sidebar
		 * 
		 * Child Themes can replace this template part file globally, 
		 * via "sidebar.php", or in a specific context only, via
		 * "sidebar-{context}.php"
		 */
		get_sidebar( upfw_get_template_context() ); 
		?>
					
	</div><!-- .container -->
	
	<?php 
	/**
	 * Fire the 'micro_before_footer' custom action hook
	 * 
	 * @param	null
	 * @return	mixed	any output hooked into 'micro_before_footer'
	 */
	micro_before_footer(); 
	?>
	
	<?php 
	/**
	 * Fire the 'micro_footer' custom action hook
	 * 
	 * @param	null
	 * @return	mixed	any output hooked into 'micro_footer'
	 */
	micro_footer(); 
	?>

	<?php 
	/**
	 * Fire the 'micro_after_footer' custom action hook
	 * 
	 * @param	null
	 * @return	mixed	any output hooked into 'micro_after_footer'
	 */
	micro_after_footer(); 
	?>
	    
    <?php 
	/**
	 * Fire the 'wp_footer' action hook
	 * 
	 * Codex reference: {@link http://codex.wordpress.org/Hook_Reference/wp_footer wp_footer}
	 * 
	 * This hook is used by WordPress core, Themes, and Plugins to 
	 * add scripts, CSS styles, meta tags, etc. to the document footer.
	 * 
	 * MUST come immediately before the closing </body> tag
	 * 
	 * @param	null
	 * @return	mixed	any output hooked into 'wp_footer'
	 */
	wp_footer(); 
	?>
            
	</body>
</html>