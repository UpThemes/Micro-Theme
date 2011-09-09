<?php

//set_site_transient('update_themes', null);

add_filter('pre_set_site_transient_update_themes', 'check_for_update');

function check_for_update($checked_data) {
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


if (is_admin())
	$current = get_transient('update_themes');

?>