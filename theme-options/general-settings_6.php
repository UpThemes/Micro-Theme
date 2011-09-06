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