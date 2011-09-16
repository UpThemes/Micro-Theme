<?php
/**
 * Theme Update Functions file
 * 
 * The /inc/update.php file includes
 * the Theme's automatic update functions
 * 
 * @link 		http://codex.wordpress.org/Function_Reference/add_filter 	add_filter()
 * @link 		http://codex.wordpress.org/Function_Reference/is_admin 		is_admin()
 * @link 		http://codex.wordpress.org/Function_Reference/get_transient	get_transient()
 * 
 * @package 	Micro
 * @copyright	Copyright (c) 2011, UpThemes
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 *
 * @since 		Micro 1.0
 */

/**
 * Check For Micro Theme Updates
 * 
 * This function uses the UpThemes API to determine
 * if a Micro Theme update is available, in order
 * to hook into the WordPress core Theme update
 * functionality.
 * 
 * @link 	http://codex.wordpress.org/Function_Reference/get_theme_data		get_theme_data()
 * @link 	http://codex.wordpress.org/Function_Reference/get_stylesheet_uri	get_stylesheet_uri()
 * @link 	http://codex.wordpress.org/Function_Reference/get_bloginfo			get_bloginfo()
 * @link 	http://codex.wordpress.org/Function_Reference/wp_remote_post		wp_remote_post()
 * @link 	http://codex.wordpress.org/Function_Reference/is_wp_error			is_wp_error()
 * 
 * @link 	http://php.net/manual/en/function.basename.php 						basename()
 * @link 	http://php.net/manual/en/function.dirname.php 						dirname()
 * @link 	http://php.net/manual/en/function.empty.php 						empty()
 * 
 * @param	object	$checked_data	(required) Transient theme update data
 * @return	object	Filtered transient theme update data
 * 
 * @since	Micro 1.0
 * 
 */
function micro_check_for_update($checked_data) {
	global $wp_version,$up_options;

	if (empty($checked_data->last_checked) && empty($up_options->api_key))
		return $checked_data;
	
	$api_url = 'http://upthemes.com/api/';
	$theme_base = basename(dirname(dirname(__FILE__)));
	
	$theme_data = get_theme_data(get_stylesheet_uri());
	
	$request = array(
		'slug' => THEME_NAME,
		'version' => $theme_data['Version']
	);

	// Start checking for an update
	$send_for_check = array(
		'body' => array(
			'action' => 'theme_update',
			'request' => serialize($request),
			'api-key' => $up_options->api_key
		),
		'user-agent' => 'WordPress/' . $wp_version . '; ' . get_bloginfo('url')
	);

	$raw_response = wp_remote_post($api_url, $send_for_check);
	
	if (!is_wp_error($raw_response) && ($raw_response['response']['code'] == 200))
		$response = unserialize($raw_response['body']);
		
	// Feed the update data into WP updater
	if (!empty($response)) 
		$checked_data->response[$theme_base] = $response;
	
	return $checked_data;
}
// Hook micro_check_for_update() into pre_set_site_transient_update_themes
add_filter( 'pre_set_site_transient_update_themes', 'micro_check_for_update' );

if (is_admin())
	$current = get_transient('update_themes');

	
//set_site_transient('update_themes', null);
?>