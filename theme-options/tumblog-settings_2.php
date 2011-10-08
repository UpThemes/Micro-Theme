<?php
/**
 * Theme Tumblog Settings Functions file
 * 
 * The /theme-options/tumblog-settings_2.php file defines
 * the Tumblog options for the Theme.
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

	array(  "name" => "Select the post time format?",
            "desc" => "Standard time will display 'April 2nd, 2011'. Human time will display '4 days Ago'.",
            "id" => "showtime_format",
            "type" => "select",
            "default_text" => "Standard Time",
            "options" => array("Human Time" => "human")),
    
    
    array(  "name" => "Display Titles",
        "desc" => "Choose the post types on which you wish to display the post title.",
        "id" => "showtitle",
        "type" => "checkbox",
        "options" => array(
            "Standard" => "standard",
            "Image" => 'image',
            "Gallery" => 'gallery',
            "Audio" => 'audio',
            "Link" => 'link',
            "Video" => 'video'
        ),
        "value" => array(
            0 => "standard",
            1 => "image",
            2 => "gallery",
            3 => "audio",
            4 => "link",
            5 => "video"
        )
    ),
    
    array(  "name" => "Display Author Information",
        "desc" => "Choose the post types on which you wish to display the author information.",
        "id" => "showmeta",
        "type" => "checkbox",
        "options" => array(
            "Standard" => "standard",
            "Aside" => "aside",
            "Image" => 'image',
            "Gallery" => 'gallery',
            "Audio" => 'audio',
            "Link" => 'link',
            "Quote" => 'quote',
            "Status" => 'status',
            "Video" => 'video'
        ),
        "value" => array(
            0 => "standard",
            1 => "image",
            2 => "gallery",
            3 => "audio",
            4 => "link",
            5 => "quote",
            6 => "status",
            7 => "aside",
            8 => "video"
        )
    ),
    
    
    array(  "name" => "Display Time",
        "desc" => "Choose the post types on which you wish to display the post time.",
        "id" => "showtime",
        "type" => "checkbox",
        "options" => array(
            "Standard" => "standard",
            "Aside" => "aside",
            "Image" => 'image',
            "Gallery" => 'gallery',
            "Audio" => 'audio',
            "Link" => 'link',
            "Quote" => 'quote',
            "Status" => 'status',
            "Video" => 'video'
        ),
        "value" => array(
            0 => "standard",
            1 => "image",
            2 => "gallery",
            3 => "audio",
            4 => "link",
            5 => "quote",
            6 => "status",
            7 => "aside",
            8 => "video"
        )
    ),

    array(  "name" => "Display Categories",
        "desc" => "Choose the post types on which you wish to display the categories.",
        "id" => "showcategory",
        "type" => "checkbox",
        "options" => array(
            "Standard" => "standard",
            "Aside" => "aside",
            "Image" => 'image',
            "Gallery" => 'gallery',
            "Audio" => 'audio',
            "Link" => 'link',
            "Quote" => 'quote',
            "Status" => 'status',
            "Video" => 'video'
        ),
        "value" => array(
            0 => "standard",
            1 => "image",
            2 => "gallery",
            3 => "audio",
            4 => "link",
            5 => "quote",
            6 => "status",
            7 => "aside",
            8 => "video"
        )
    ),
    
    array(  "name" => "Display Tags",
        "desc" => "Choose the post types on which you wish to display the tags.",
        "id" => "showtag",
        "type" => "checkbox",
        "options" => array(
            "Standard" => "standard",
            "Aside" => "aside",
            "Image" => 'image',
            "Gallery" => 'gallery',
            "Audio" => 'audio',
            "Link" => 'link',
            "Quote" => 'quote',
            "Status" => 'status',
            "Video" => 'video'
        ),
        "value" => array(
            0 => "standard",
            1 => "image",
            2 => "gallery",
            3 => "audio",
            4 => "link",
            5 => "quote",
            6 => "status",
            7 => "aside",
            8 => "video"
        )
    )

        
        
);

/* ------------ Do Not edit below this line ----------- */

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