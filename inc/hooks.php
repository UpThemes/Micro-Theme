<?php
/**
 * Hooks file containing all theme hooks for Micro.
 *
 * @package WordPress
 * @subpackage Micro
 * @since Micro 1.0
 */

function micro_before_header(){
	do_action('micro_before_header');
}

function micro_header(){
	do_action('micro_header');
}

function micro_after_header(){
	do_action('micro_after_header');
}

function micro_before_content(){
	do_action('micro_before_content');
}

function micro_after_content(){
	do_action('micro_after_content');
}

function micro_before_sidebar(){
	do_action('micro_before_sidebar');
}

function micro_after_sidebar(){
	do_action('micro_after_sidebar');
}

function micro_before_posts(){
	do_action('micro_before_posts');
}

function micro_after_posts(){
	do_action('micro_after_posts');
}

function micro_before_title(){
	do_action('micro_before_title');
}

function micro_after_title(){
	do_action('micro_after_title');
}

function micro_post_header(){
	do_action('micro_post_header');
}

function micro_post_footer(){
	do_action('micro_post_footer');
}

function micro_comments(){
	do_action('micro_comments');
}

function micro_postmeta(){
	do_action('micro_postmeta');
}

function micro_before_footer(){
	do_action('micro_before_footer');
}

function micro_footer(){
	do_action('micro_footer');
}

function micro_after_footer(){
	do_action('micro_after_footer');
}

