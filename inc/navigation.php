<?php

function micro_attach_navigation(){
	
	global $up_options, $wp_query;
	
	if( empty($up_options->attach_navigation) ): ?>
	
	<div id="post-navigation">

		<?php if( is_single() || is_page() ): ?>

			<ul id="pages">
				<li class="prev-page"><?php previous_post_link('%link',"<span>%title</span>"); ?></li>
				<li class="next-page"><?php next_post_link('%link',"<span>%title</span>"); ?></li>
			</ul>
		
		<?php else: ?>

			<?php
			$paged = get_query_var('paged');
			$maxpage = $wp_query->max_num_pages;
	
			if( $maxpage > 1 ): ?>
	
			<ul id="pages">
				<?php

				echo '<li class="prev-page">';
				previous_posts_link( "<span>" . __('&larr; Older Posts','micro') . "</span>" );
				echo '</li>';
?>
				<li class="number"><?php if( is_archive() || is_category() || is_tag() || is_home() || is_author() || is_search() ) get_the_page_count(); ?></li>
<?php
				echo '<li class="next-page">';
				next_posts_link( "<span>" . __('Newer Posts &rarr;','micro') . "</span>" );
				echo '</li>';

				?>
			</ul>
			
			<?php endif; ?>
		
		<?php endif; ?>
		
	</div>

	<?php

	endif;

}

add_action('micro_after_posts','micro_attach_navigation');

function get_the_page_count(){

		global $wp_query;
	
		$paged = get_query_var('paged');
		$maxpage = $wp_query->max_num_pages;
		
		if( is_paged() )
			$current_page = $paged;
		else
			$current_page = '1';
					
		_e("Page {$current_page} of {$maxpage}","micro");

}
