<?php
/*  Array Options:
   
   name (string)
   desc (string)
   id (string)
   type (string) - text, color, image, select, multiple, textarea, page, pages, category, categories
   value (string) - default value - replaced when custom value is entered - (text, color, select, textarea, page, category)
   options (array)
   attr (array) - any form field attributes
   url (string) - for image type only - defines the default image
    
*/

$options = array (
            
    array(  "name" => "Colors for Sidebar &amp; Footer",
            "desc" => "Enter a color here for the sidebar text.",
            "id" => "sidebar_text_color",
            "type" => "select",
            "default_text" => "Dark",
            "options" => array(
            	"Light" => "light"
            )),
            
	array(  "name" => "Default Hyperlink Color",
            "desc" => "Enter a default hyperlink color here.",
            "id" => "default_link_color",
            "type" => "color"),
            
	array(  "name" => "Hover Hyperlink Color",
            "desc" => "Enter a hover hyperlink color here.",
            "id" => "hover_link_color",
            "type" => "color"),
            
	array(  "name" => "Active Hyperlink Color",
            "desc" => "Enter an active hyperlink color here.",
            "id" => "active_link_color",
            "type" => "color"),
            
	array(  "name" => "Visited Hyperlink Color",
            "desc" => "Enter a visited hyperlink color here.",
            "id" => "visited_link_color",
            "type" => "color"),
            
    array(  "name" => "Content Text Color",
            "desc" => "Enter a color here for the content text.",
            "id" => "content_text_color",
            "type" => "color"),
            
	array(  "name" => "Website Favicon",
            "desc" => "You should upload a small PNG with a size of 16x16.",
            "id" => "favicon",
            "value" => "Upload Favicon",
            "type" => "image")
            
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