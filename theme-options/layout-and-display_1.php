<?php
/**
 * Theme Layout and Display Settings Functions file
 * 
 * The /theme-options/layout-and-display_1.php file defines
 * the layout and display options for the Theme.
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

    array(  "name" => "Theme Layout",
        "desc" => "Please select the layout for your site.",
        "id" => "layout_global",
        "type" => "layouts",
        "value" => get_bloginfo('template_directory').'/library/layouts/right-column.css'),
        
    array(  "name" => "Theme Layout for Archives",
        "desc" => "Please select the layout for your archives.",
        "id" => "layout_archive",
        "type" => "layouts",
        "context" => "archive",
        "value" => get_bloginfo('template_directory').'/library/layouts/right-column.css'),
    
    array(  "name" => "Theme Layout for Categories",
        "desc" => "Please select the layout for your categories.",
        "id" => "layout_category",
        "type" => "layouts",
        "context" => "category",
        "value" => get_bloginfo('template_directory').'/library/layouts/right-column.css'),
    
    
    array(  "name" => "Theme Layout for Pages",
        "desc" => "Please select the layout for your pages.",
        "id" => "layout_page",
        "type" => "layouts",
        "context" => "page",
        "value" => get_bloginfo('template_directory').'/library/layouts/right-column.css'),

    array(  "name" => "Theme Layout for Posts",
        "desc" => "Please select the layout for your posts.",
        "id" => "layout_post",
        "type" => "layouts",
        "context" => "single",
        "value" => get_bloginfo('template_directory').'/library/layouts/right-column.css'),
        
    array(  "name" => "Theme Layout for Author Archives",
        "desc" => "Please select the layout for your author archives.",
        "id" => "layout_author",
        "type" => "layouts",
        "context" => "author",
        "value" => get_bloginfo('template_directory').'/library/layouts/right-column.css'),
        
    array(  "name" => "Theme Layout for Search",
        "desc" => "Please select the layout for your search page.",
        "id" => "layout_search",
        "type" => "layouts",
        "context" => "search",
        "value" => get_bloginfo('template_directory').'/library/layouts/right-column.css'),
        
    array(  "name" => "Theme Layout for Tag Archives",
        "desc" => "Please select the layout for your tag archives.",
        "id" => "layout_tag",
        "type" => "layouts",
        "context" => "tag",
        "value" => get_bloginfo('template_directory').'/library/layouts/right-column.css'),
        
	array(  "name" => "Post Container",
            "desc" => "Do you want posts to be contained within a box or naked?",
            "id" => "post_container",
            "type" => "select",
            "default_text" => "Contained",
            "value" => false,
            "options" => array(
            	"Naked" => true
            )),
    
    array(  "name" => "Post Format Icons",
            "desc" => "How would you like the post format icons displayed?",
            "id" => "post_format_icon",
            "type" => "select",
            "default_text" => "Float Left",
            "value" => false,
            "options" => array(
            	'Float Right' => 'right',
                'Hidden
                ' => 'hide'
            )),

	array(  "name" => "Widget Container",
            "desc" => "Do you want widgets to be contained within a box or naked?",
            "id" => "widget_container",
            "type" => "select",
            "default_text" => "Contained",
            "value" => false,
            "options" => array(
            	"Naked" => true
            ))
    

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