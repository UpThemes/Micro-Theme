<?php
/*  Array Options:
   
   name (string)
   desc (string)
   id (string)
   type (string) - text, color, image, select, multiple, textarea, page, pages, category, categories, divider, taxonomy, checkbox
   value (string) - default value - replaced when custom value is entered - (text, color, select, textarea, page, category)
   options (array)
   attr (array) - any form field attributes
   url (string) - for image type only - defines the default image
    
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
            5 => "status",
            5 => "aside",
            5 => "video"
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
            5 => "status",
            5 => "aside",
            5 => "video"
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
            5 => "status",
            5 => "aside",
            5 => "video"
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
            5 => "status",
            5 => "aside",
            5 => "video"
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