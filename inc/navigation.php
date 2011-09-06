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

			<ul id="posts">
				
				<div id="maxposts" class="hide"><?php echo get_option('posts_per_page'); ?></div>
				
				<?php
				
				echo '<li class="next-post">';
				echo '<a id="next-post-scroll" href="#"><span>' . __('Next Post','micro') . '</span></a>';
				echo '</li>';
				
				echo '<li class="prev-post">';
				echo '<a id="previous-post-scroll" href="#"><span>' . __('Previous Post','micro') . '</span></a>';
				echo '</li>';
				
				?>
				<li class="description"></li>
			</ul>

			<?php
			$paged = get_query_var('paged');
			$maxpage = $wp_query->max_num_pages;
	
			if( $maxpage > 1 ): ?>
	
			<ul id="pages">
				<li class="number"><?php if( is_archive() || is_category() || is_tag() || is_home() || is_author() || is_search() ) get_the_page_count(); ?></li>
				<?php

				echo '<li class="prev-page">';
				previous_posts_link( "<span>" . __('Older posts','micro') . "</span>" );
				echo '</li>';

				echo '<li class="next-page">';
				next_posts_link( "<span>" . __('Newer posts','micro') . "</span>" );
				echo '</li>';

				?>
			</ul>
			
			<?php endif; ?>
		
		<?php endif; ?>
		
	</div>

	<?php

	endif;

}

add_action('micro_above_content','micro_attach_navigation');

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
