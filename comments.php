<?php
/**
 * Template part file the contains the Comments functionality
 *
 * This template file includes both the comments list and
 * the comment reply form. 
 * 
 * @link	http://codex.wordpress.org/Function_Reference/comments_number			Codex reference: comments_number()
 * @link	http://codex.wordpress.org/Function_Reference/the_title					Codex reference: the_title()
 * @link	http://codex.wordpress.org/Function_Reference/get_comments_pages_count	Codex reference: get_comment_pages_count()
 * @link	http://codex.wordpress.org/Function_Reference/get_option				Codex reference: get_option()
 * @link	http://codex.wordpress.org/Function_Reference/paginate_comments_links	Codex reference: paginate_comments_links()
 * @link	http://codex.wordpress.org/Function_Reference/wp_list_comments			Codex reference: wp_list_comments()
 * @link	http://codex.wordpress.org/Function_Reference/comment_form				Codex reference: comment_form()
 * 
 * @uses		micro_after_comments()		Defined in /inc/hooks.php
 * @uses		micro_before_comments()		Defined in /inc/hooks.php
 * 
 * @package 	Micro
 * @copyright	Copyright (c) 2010, Chip Bennett
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 *
 * @since 		Micro 1.0
 */
?>

<!-- Comments Begin (div#comments) -->
<div id="comments">

	<?php micro_before_comments(); ?>

	<?php 
	if ( have_comments() ) {
		?>
		<?php
		// Globalize variable that holds comments by type
		global $comments_by_type;	
		?>
		<h2 id="comments-title"><?php comments_number(__("No Responses","micro"), __("One Response","micro"), __("% Responses","micro") ); ?></h3>

		<?php $i = 0; ?>
		
		<?php if ( ! comments_open() ) { ?> <p><?php _e("(Comments are closed)","micro"); ?></p><?php } ?>

		<?php 
		// If the paged comments setting is enabled, and enough comments exisst to cause comments to be paged
		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { 
			?>
			<div class="nav-comments">
				<?php paginate_comments_links( array( 'prev_text' => '&lt;&lt;', 'next_text' => '&gt;&gt;' ) ); ?>
			</div> <!-- .navigation -->
			<?php 
		} // check for comment navigation 
		
		if ( get_comments_number() > '0' ) { 
			?>
			<ol class="commentlist">
				<?php wp_list_comments( 'type=comment&avatar_size=40' ); ?>
			</ol>
			<?php 
		}

		// Are there comments to navigate through?
		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) {
			?>
			<div class="nav-comments">
				<?php paginate_comments_links( array( 'prev_text' => '&lt;&lt;', 'next_text' => '&gt;&gt;' ) ); ?>
			</div>
			<?php 
		} // check for comment navigation 		
		
		// if the post has any trackbacks or pingbacks, display them as a list		
		global $comments_by_type;
		$comments_by_type = &separate_comments( $comments );
		if ( ! empty( $comments_by_type['pings'] ) ) {  
			?>
			<h3 class="trackbackheader"><?php _e("Trackbacks","micro"); ?></h3>
			<ol class="trackbacklist">
				<?php wp_list_comments( array( 'type' => 'pings', 'callback' => 'micro_comment_list_pings' ) ); ?>
			</ol>
			<?php 
		}
	} else { 
		// or, if we don't have comments:
	} 
	// end have_comments() 

	comment_form();
	
	micro_after_comments(); 
	
	?>

</div>
<!-- Comments End  (div#comments) -->