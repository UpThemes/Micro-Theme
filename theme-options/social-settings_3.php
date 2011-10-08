<?php
/**
 * Theme Social Settings Functions file
 * 
 * The /theme-options/social-settings_3.php file defines
 * the social-profile options for the Theme.
 * 
 * How to use this file:
 * 1) Save this template to the 'theme-options' folder in the Theme root
 * 2) Change the file name to this syntax (remember to add the .php 
 *    extension): tab-name_#.php, where:
 *    - tab-name = Name of the Tab as it will appear in the Admin menu
 *    - # = position tab will appear, relative to other tabs
 * 3) Add options to the $options array
 * 4) BOOM!
 * 
 * To add additional options, add arrays to the $options
 * array, with each new array containing the following
 * array keys:
 * - key 	name	string	(required)	option name
 * - key	desc	string	(required)	option description
 * - key	id		string	(required)	option slug
 * - key	type	string	(required)	option type; one of: text, color, image, select, multiple, textarea, page, pages, category, categories
 * - key	value	string	(required)	default option value, replaced when custom value is entered (text, color, select, textarea, page, category)
 * - key	options	array	(optional)	associative array of valid options for select-type options, in the form of "Name" => "slug"
 * - key	attr	array	(optional)	form-field attributes
 * - keys	url		string	(optional)	default-image URL, for image-type options
 * 
 * @package 	Micro
 * @copyright	Copyright (c) 2011, UpThemes
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 *
 * @since 		Micro 1.0
 */

$options = array (

	array(  "name" => "Social Icon Size",
            "desc" => "Select the size you want your social icons to be.",
            "id" => "icon_size",
            "type" => "select",
            "options" => array(
				"16px" => "16",
				"32px" => "32"
            ),
            "value" => "16px"),
                
	array(  "name" => "Dribbble User ID",
            "desc" => "Enter your Dribbble Username to show the Dribbble icon in the sidebar.",
            "id" => "dribbble",
            "type" => "text"),
            
	array(  "name" => "Facebook User ID",
            "desc" => "Enter your Facebook Username to show the Facebook icon in the sidebar.",
            "id" => "facebook",
            "type" => "text"),
            
	array(  "name" => "Twitter User ID",
            "desc" => "Enter your Twitter Username to show the Twitter icon in the sidebar.",
            "id" => "twitter",
            "type" => "text"),
            
	array(  "name" => "Digg User ID",
            "desc" => "Enter your Digg Username to show the Digg icon in the sidebar.",
            "id" => "digg",
            "type" => "text"),
            
	array(  "name" => "YouTube User ID",
            "desc" => "Enter your Digg Username to show the Digg icon in the sidebar.",
            "id" => "youtube",
            "type" => "text"),
            
	array(  "name" => "Vimeo User ID",
            "desc" => "Enter your Vimeo Username to show the Vimeo icon in the sidebar.",
            "id" => "vimeo",
            "type" => "text"),
            
	array(  "name" => "Tumblr URL",
            "desc" => "Enter your Tumblr URL to show the Tumblr icon in the sidebar.",
            "id" => "tumblr",
            "type" => "text"),
            
	array(  "name" => "Skype User ID",
            "desc" => "Enter your Skype Username to show the Skype icon in the sidebar.",
            "id" => "skype",
            "type" => "text"),
            
	array(  "name" => "Qik User ID",
            "desc" => "Enter your Qik Username to show the Qik icon in the sidebar.",
            "id" => "qik",
            "type" => "text"),
            
	array(  "name" => "Posterous URL",
            "desc" => "Enter your Posterous URL to show the Posterous icon in the sidebar.",
            "id" => "posterous",
            "type" => "text"),
            
	array(  "name" => "LinkedIn User ID",
            "desc" => "Enter your LinkedIn Username to show the LinkedIn icon in the sidebar.",
            "id" => "linkedin",
            "type" => "text"),
            
	array(  "name" => "Last.fm User ID",
            "desc" => "Enter your Last.fm Username to show the Last.fm icon in the sidebar.",
            "id" => "lastfm",
            "type" => "text"),
            
	array(  "name" => "Gowalla User ID",
            "desc" => "Enter your Gowalla Username to show the Gowalla icon in the sidebar.",
            "id" => "gowalla",
            "type" => "text"),
            
	array(  "name" => "Flickr User ID",
            "desc" => "Enter your Flickr Username to show the Flickr icon in the sidebar.",
            "id" => "flickr",
            "type" => "text"),
            
	array(  "name" => "Designmoo User ID",
            "desc" => "Enter your Designmoo Username to show the Designmoo icon in the sidebar.",
            "id" => "designmoo",
            "type" => "text")
);

/* ------------ Do not edit below this line ----------- */

//Check if theme options set
global $default_check;
global $default_options;

if(!$default_check):
    foreach($options as $option):
        if($option['type'] != 'image'):
            $default_options[$option['id']] = $option['value'];
        else:
            $default_options[$option['id']] = $option['url'];
        endif;
    endforeach;
    $update_option = get_option('up_themes_'.UPTHEMES_SHORT_NAME);
    if(is_array($update_option)):
        $update_option = array_merge($update_option, $default_options);
        update_option('up_themes_'.UPTHEMES_SHORT_NAME, $update_option);
    else:
        update_option('up_themes_'.UPTHEMES_SHORT_NAME, $default_options);
    endif;
endif;

render_options($options);

?>