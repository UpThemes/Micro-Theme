<?php
/**
 * Theme General Settings Functions file
 * 
 * The /theme-options/general-settings_6.php file defines
 * the general options for the Theme.
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

	array(  "name" => "Google Analytics ID",
            "desc" => "Enter your Google Analytics ID to enable analytics.",
            "id" => "google_analytics",
            "type" => "text"),

    array(  "name" => "Disqus User ID",
            "desc" => "Enter your Disqus Username to enable Disqus comments.",
            "id" => "disqus",
            "type" => "text"),
            
    array(  "name" => "Enable RTL?",
            "desc" => "For sites with content that goes from 'Right To Left.'",
            "id" => "rtl_support",
            "type" => "select",
            "default_text" => "No",
            "options" => array(
            	"Yes" => true
            )),
            
    array(  "name" => "Footer Text",
            "desc" => "Enter your custom footer text here",
            "id" => "footertext",
            "type" => "textarea",
            "value" => "Copyright " . date('Y') . " " . get_bloginfo('Name'),
            "attr" => array("rows" => '8'))
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