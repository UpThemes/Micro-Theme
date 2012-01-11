<?php
/**
 * Theme functions file
 *
 * Contains all of the Theme's setup functions, custom functions,
 * custom Widgets, custom hooks, and Theme settings.
 * 
 * For ease of understanding the different functionality and
 * purpose of all the functions, this file is split into several
 * sub-files, each of which is called below. Refer to each
 * sub-file for documentation of each included function.
 * 
 * To facilitate creation of Child Themes for Micro, these
 * sub-files are included via get_template_directory(), rather
 * than get_stylesheet_directory(). Using get_template_directory()
 * ensures that WordPress will always search the template, i.e.
 * Parent Theme, directory for these files. Thus, they do not
 * need to be copied to the Child Theme in order to work. Also,
 * this allows Child Themes to create their own custom functions,
 * Widgets, options, hooks, etc., that work alongside those
 * provided here.
 *
 * For more information on hooks, actions, and filters, 
 * see {@link http://codex.wordpress.org/Plugin_API Plugin API}.
 * 
 * @link 		http://codex.wordpress.org/Function_Reference/get_template_directory 	get_template_directory()
 * 
 * @link 		http://php.net/manual/en/function.require-once.php 						require_once()
 * 
 * @package 	Micro
 * @copyright	Copyright (c) 2011, UpThemes
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 *
 * @since 		Micro 1.0
 */


/**
 * Define THEME_NAME constant
 */
define( 'THEME_NAME', 'micro' );

/**
 * Bootstrap the UpThemes Framework
 */
require_once( get_template_directory() . '/admin/admin.php' ); 

/**
 * Include the Header Extensions Functions File
 */
require_once( get_template_directory() . '/inc/extensions/header-extensions.php' );

/**
 * Include the Comments Extensions Functions File
 * 
 * The /inc/extensions/comments-extensions.php file defines
 * all of the Theme's callback functions that hook into
 * Theme custom and WordPress action/filter hooks in comments.php
 *  - micro_comments
 *  - wp_list_comments (callback)
 */
require_once( get_template_directory() . '/inc/extensions/comments-extensions.php' );

/**
 * Include the Content Extensions Functions File
 * 
 * The /inc/extensions/content-extensions.php file defines
 * all of the Theme's callback functions that hook into
 * Theme custom and WordPress action/filter hooks in content.php, 
 * content-page.php, and content-single.php
 *  - micro_post_footer
 *  - micro_post_header
 *  - micro_postmeta
 *  - the_content
 * 
 * This file also defines content-related custom functions:
 *  - micro_author_details()
 *  - micro_gallery()
 *  - micro_image_grid()
 *  - micro_image_list()
 *  - micro_image_slider()
 *  - micro_no_posts()
 *  - micro_post_images()
 *  - micro_time_posted()
 */
require_once( get_template_directory() . '/inc/extensions/content-extensions.php' );

/**
 * Include the Footer Extensions Functions File
 * 
 * The /inc/extensions/footer-extensions.php file defines
 * all of the Theme's callback functions that hook into
 * Theme custom and WordPress action/filter hooks in footer.php
 *  - micro_footer
 *  - wp_footer
 */
require_once( get_template_directory() . '/inc/extensions/footer-extensions.php' );

/**
 * Include the Sidebar Extensions Functions File
 * 
 * The /inc/extensions/sidebar-extensions.php file defines
 * all of the Theme's callback functions that hook into
 * Theme custom and WordPress action/filter hooks in sidebar.php
 * and sidebar-footer.php
 *  - micro_before_sidebar
 */
require_once( get_template_directory() . '/inc/extensions/sidebar-extensions.php' );

/**
 * Include the Helper Functions File
 * 
 * The /inc/helpers.php file defines
 * all of the Theme's general, custom/helper functions
 *  - micro_convert_url_to_embed()
 *  - woo_tumblog_image()
 */
require_once( get_template_directory() . '/inc/helpers.php' );

/**
 * Include the Media Functions File
 * 
 * The /inc/media.php file defines 
 * all of the Theme's custom, media-handling functions
 *  - micro_resize_video()
 *  - micro_tumblog_embed()
 */
require_once( get_template_directory() . '/inc/media.php' );

/**
 * Include the Header Extensions Functions File
 * 
 * The /inc/hooks.php file defines
 * all of the Theme's custom hook template functions
 */
require_once( get_template_directory() . '/inc/hooks.php' );

/**
 * Include the Navigation Functions File
 * 
 * The /inc/navigation.php file defines
 * all of the Theme's custom, navigation functions
 *  - micro_get_the_page_count()
 * 
 * This file also defines navigation-related callback 
 * functions hooked into custom Theme hooks
 *  - micro_after_posts
 */
require_once( get_template_directory() . '/inc/navigation.php' );

/**
 * Include the Header Extensions Functions File
 * 
 * The /inc/expressapp.php file integrates 
 * the WooExpress App functionality.
 */
require_once( get_template_directory() . '/inc/expressapp.php' );

/**
 * Include the Tumblog Metaboxes Functions File
 * 
 * The /inc/metaboxes/tumblog-meta.php file includes
 * the Theme's Tumblog metabox functions
 */
require_once( get_template_directory() . '/inc/metaboxes/tumblog-meta.php' );

/**
 * Include the Theme Update Functions File
 * 
 * The /inc/update.php file includes
 * the Theme's automatic update functions
 */
require_once( get_template_directory() . '/inc/update.php' );

/**
 * Theme initialization/setup function
 * 
 * Add Theme support for Post Formats, Custom Navigation
 * Menus, Automatic Feed Links, and Custom Background.
 * Also, deregister Theme layouts, register the "primary"
 * navigation menu Theme Location, and enqueue the JS
 * "scrolling" script.
 * 
 * @link 	http://codex.wordpress.org/Function_Reference/add_custom_background 	add_custom_background()
 * @link 	http://codex.wordpress.org/Function_Reference/add_image_size 			add_image_size()
 * @link 	http://codex.wordpress.org/Function_Reference/add_theme_support 		add_theme_support()
 * @link 	http://codex.wordpress.org/Function_Reference/deregister_theme_layout 	deregister_theme_layout()
 * @link 	http://codex.wordpress.org/Function_Reference/register_nav_menu			register_nav_menu()
 * @link 	http://codex.wordpress.org/Function_Reference/wp_enqueue_script 		wp_enqueue_script()
 *
 * @since Micro 1.0
 */
function micro_theme_init(){

	// Setup content width
	define( 'CONTENT_WIDTH', 700 );

	global $content_width;

	if ( ! isset( $content_width ) ) {
		$content_width = CONTENT_WIDTH;
	}
	
	// Add Theme support for Post Thumbnails
	add_theme_support( 'post-thumbnails' );
	
	// Add custom image sizes
	add_image_size( 'full-width-image', $content_width, 99999, 0 );
	
	add_theme_support( 'post-formats', array( 'aside', 'image', 'link', 'quote', 'status', 'video', 'audio', 'gallery' ) );
	add_theme_support( 'nav-menus' );
	add_theme_support( 'automatic-feed-links' );
	register_nav_menu( 'primary', __('Navigation','micro') );
	
	add_custom_background();

	define('HEADER_TEXTCOLOR', '222222');
	define('HEADER_IMAGE', '%s/images/theme-logo.png'); // %s is the template dir uri
	define('HEADER_IMAGE_WIDTH', 140); // use width and height appropriate for your theme
	define('HEADER_IMAGE_HEIGHT', 140);

	add_custom_image_header( 'micro_header_style', 'micro_admin_header_style' );

}
// Hook micro_theme_init() into after_setup_theme action
add_action( 'after_setup_theme', 'micro_theme_init' );


/**
 * Micro Contextual Help
 * 
 * Contextual help, WordPress 3.3-compatible
 * 
 * @since	Micro 1.x
 */
function micro_contextual_help() {
	// Load contextual help
	global $upfw_settings_page;
	add_action( 'load-' . $upfw_settings_page, 'micro_contextual_help_tabs', 11 );
}
add_action( 'admin_menu', 'micro_contextual_help' );


/**
 * Micro Contextual Help Tabs
 * 
 * Contextual help, WordPress 3.3-compatible
 * 
 * @since	Micro 1.x
 */
 function micro_contextual_help_tabs() {
	// Globalize settings page
	global $upfw_settings_page;
	// Test for current page
	$screen = get_current_screen();
	if ( $screen->id != $upfw_settings_page ) {
		return;
	}
	// Add Colors and Images contextual help tab
	$screen->add_help_tab( array(
		'id'      => 'upfw-help-colorsimages',
		'title'   => __( 'Colors/Images', 'micro' ),
		'content' => '',
	) );
	// Add Layout and Display contextual help tab
	$screen->add_help_tab( array(
		'id'      => 'upfw-help-layoutdisplay',
		'title'   => __( 'Layout/Display', 'micro' ),
		'content' => '',
	) );
	// Add Tumblog contextual help tab
	$screen->add_help_tab( array(
		'id'      => 'upfw-help-tumblog',
		'title'   => __( 'Tumblog', 'micro' ),
		'content' => '',
	) );
	// Add Social contextual help tab
	$screen->add_help_tab( array(
		'id'      => 'upfw-help-social',
		'title'   => __( 'Social', 'micro' ),
		'content' => '',
	) );
	// Add SEO contextual help tab
	$screen->add_help_tab( array(
		'id'      => 'upfw-help-seo',
		'title'   => __( 'SEO', 'micro' ),
		'content' => '',
	) );
	// Add Typography contextual help tab
	$screen->add_help_tab( array(
		'id'      => 'upfw-help-typography',
		'title'   => __( 'Typography', 'micro' ),
		'content' => '',
	) );
	// Add Import/Export contextual help tab
	$screen->add_help_tab( array(
		'id'      => 'upfw-help-importexport',
		'title'   => __( 'Import/Export', 'micro' ),
		'content' => '',
	) );
	// Add Support contextual help tab
	$screen->add_help_tab( array(
		'id'      => 'upfw-help-support',
		'title'   => __( 'Support', 'micro' ),
		'content' => micro_support_help_tab_content(),
	) );
}


/**
 * Support Help Tab Content
 */
function micro_support_help_tab_content() {
	$micro_github_data_issues_open = micro_get_github_api_data( 'issues', 'open' );
	$micro_github_data_roadmap = micro_get_github_api_data( 'issues', 'open', '*', true );
	$micro_github_data_issues_closed = micro_get_github_api_data( 'issues', 'closed' );
	$micro_github_data_commits = micro_get_github_api_data( 'commits' );
	
	$tabtext = '';
	$tabtext .= '<h2>' . __( 'Support options and links for Micro', 'micro' ) . '</h2>';

	// Open Bug Reports
	$tabtext .= '<h3>';
	$tabtext .= '<span>' . __( 'Open Micro Bug Reports', 'micro' ) . '</span>';
	$tabtext .= '</h3>';
	$tabtext .= '<div class="postbox"><div class="inside">';
	$tabtext .= '<div class="text-widget">' . $micro_github_data_issues_open . '</div>';
	$tabtext .= '</div></div>';

	// Latest Support Forum Topics
	$tabtext .= '<h3>';
	$tabtext .= '<span>' . __( 'Latest Micro Support Topics', 'micro' ) . '</span> ';
	$tabtext .= ' (<a href="http://upthemes.com/forum/list.php?16">' . __( 'See All', 'micro' ) . '</a>)';
	$tabtext .= '</h3>';
	$tabtext .= '<div class="postbox"><div class="inside">';
	$tabtext .= '<div class="rss-widget">(' . __( 'Coming back soon)', 'micro' ) . '</div>';
	$tabtext .= '</div></div>';

	// Roadmap
	$tabtext .= '<h3>';
	$tabtext .= '<span>' . __( 'Micro Roadmap', 'micro' ) . '</span> ';
	$tabtext .= '</h3>';
	$tabtext .= '<div class="postbox"><div class="inside">';
	$tabtext .= '<div class="text-widget">' . $micro_github_data_roadmap . '</div>';
	$tabtext .= '</div></div>';

	// Bug Reports Closed Since Last Release
	$tabtext .= '<h3>';
	$tabtext .= '<span>' . __( 'Micro Bug Reports Closed Since Last Release', 'micro' ) . '</span>';
	$tabtext .= '</h3>';
	$tabtext .= '<div class="postbox"><div class="inside">';
	$tabtext .= '<div class="text-widget">' . $micro_github_data_issues_closed . '</div>';
	$tabtext .= '</div></div>';

	// Development Commits Since Last Release
	$tabtext .= '<h3>';
	$tabtext .= '<span>' . __( 'Micro Development Commits Since Last Release', 'micro' ) . '</span>';
	$tabtext .= '</h3>';
	$tabtext .= '<div class="postbox"><div class="inside">';
	$tabtext .= '<div class="text-widget">' . $micro_github_data_commits . '</div>';
	$tabtext .= '</div></div>';

	return $tabtext;
}

/**
 * Configure UpThemes Framework
 * 
 * Deregisters theme layouts added by 
 * the UpThemes Framework.
 * 
 * @uses 	deregister_theme_layout		Defined in /admin/library/engines/layout-engine.php
 *
 * @since Micro 1.0
 */
function micro_upfw_config() {
	
	deregister_theme_layout('left_column_grid');
	deregister_theme_layout('right_column_grid');

}
// Hook micro_upfw_config() into the init action, 
// so that it fires AFTER framework is bootstrapped
add_action( 'init', 'micro_upfw_config' );

/**
 * Header image CSS displayed on website front-end
 * 
 * @since	Micro 1.0
 */
function micro_header_style() {
    ?><style type="text/css">
        .blog-information a{
            background: url(<?php header_image(); ?>);
            width: <?php echo HEADER_IMAGE_WIDTH; ?>px;
            height: <?php echo HEADER_IMAGE_HEIGHT; ?>px;
            text-indent: -9000px;
            text-align: left;
            margin: 0 auto 10px;
            max-width: 100%;
			display: block;
			background-position: center center;
			background-repeat: no-repeat;
        }
    </style><?php
}

/**
 * Include header default styles in admin preview
 * 
 * @since	Micro 1.0
 */
function micro_admin_header_style() {
    ?><style type="text/css">
        #headimg {
            width: <?php echo HEADER_IMAGE_WIDTH; ?>px;
            height: <?php echo HEADER_IMAGE_HEIGHT; ?>px;
			background-position: center center;
			background-repeat: no-repeat;
        }
		#headimg #name{
			text-indent: -9000px;
			overflow: hidden;
			display: block;	
		}
		
		#desc{
			display: none;
		}
		
    </style><?php
}

/**
 * Register theme Widgetized Sidebars
 * 
 * The Micro Theme includes four Widgetized sidebars: 
 * the "Main Sidebar", as well as three Widgetized
 * footer areas.
 * 
 * @link 	http://codex.wordpress.org/Function_Reference/register_sidebar	register_sidebar()
 *
 * @since Micro 1.0
 */
function micro_widgets_init() {

	register_sidebar( array(
		'name' => __( 'Main Sidebar', 'micro' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Area One', 'micro' ),
		'id' => 'sidebar-3',
		'description' => __( 'An optional widget area for your site footer', 'micro' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Area Two', 'micro' ),
		'id' => 'sidebar-4',
		'description' => __( 'An optional widget area for your site footer', 'micro' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Area Three', 'micro' ),
		'id' => 'sidebar-5',
		'description' => __( 'An optional widget area for your site footer', 'micro' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
// Hook micro_widgets_init() into widgets_init
add_action( 'widgets_init', 'micro_widgets_init' );

/**
 * Filter the Excerpt Length
 * 
 * Sets the excerpt length to 40 words.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 *
 * @since Micro 1.0
 */
function micro_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'micro_excerpt_length' );

/**
 * Dynamically set CSS class for footer Widget container
 * 
 * Count the number of footer sidebars to enable dynamic 
 * classes for the footer. Dynamically sets the container 
 * class to 'class="class-one"', 'class="class-two"', or
 * 'class="class-three"', depending on the number of
 * footer Widget areas active.
 *
 * @since Micro 1.0
 */
function micro_footer_sidebar_class() {
	$count = 0;

	if ( is_active_sidebar( 'sidebar-3' ) )
		$count++;

	if ( is_active_sidebar( 'sidebar-4' ) )
		$count++;

	if ( is_active_sidebar( 'sidebar-5' ) )
		$count++;

	$class = '';

	switch ( $count ) {
		case '1':
			$class = 'one';
			break;
		case '2':
			$class = 'two';
			break;
		case '3':
			$class = 'three';
			break;
	}

	if ( $class )
		echo 'class="' . $class . '"';
}


/**
 * Get GitHub API Data
 * 
 * Uses the GitHub API (v3) to get information
 * regarding open or closed issues (bug reports)
 * or commits, then outputs them in a table.
 *
 * Derived from code originally developed by
 * Michael Fields (@_mfields):
 * @link	https://gist.github.com/1061846 Simple Github commit API shortcode for WordPress
 * 
 * @param	string	$context		(required) API data context. Currently supports 'commits' and 'issues'. Default: 'commits'
 * @param	string	$status			(optional) Issue state, either 'open' or 'closed'. Only used for 'commits' context. Default: 'open'
 * @param	string	$releasedate	(optional) Date, in YYYY-MM-DD format, used to return commits/issues since last release.
 * @param	string	$user			(optional) GitHub user who owns repository.
 * @param	string	$repo			(optional) GitHub repository for which to return API data
 * 
 * @return	string	table of formatted API data
 */
function micro_get_github_api_data( $context = 'commits', $status = 'open', $milestone = '7', $roadmap = false, $currentrelease = '2.6', $releasedate = '2011-12-16', $user = 'chriswallace', $repo = 'Micro-Theme' ) {

	$capability = 'read';

	// $branch is user/repository string.
	// Used variously throughout the function
	$branch = $user . '/' . $repo;

	// Create transient key string. Used to ensure API data are 
	// pinged only periodically. Different transient keys are
	// created for commits, open issues, and closed issues.
	$transient_key = 'oenology_' . $currentrelease . '_github_';
	if ( 'commits' == $context ) {
		$transient_key .= 'commits' . md5( $branch );
	} else if ( 'issues' == $context ) {
		$transient_key .= 'issues_' . $status . md5( $branch . $milestone );
	}

	// If cached (transient) data are used, output an HTML
	// comment indicating such
	$cached = get_transient( $transient_key );

	if ( false !== $cached ) {
		return $cached .= "\n" . '<!--Returned from transient cache.-->';
	}
	
	// Construct the API request URL, based on $branch and
	// $context, for issues, $status, and $milestone
	$apiurl = 'https://api.github.com/repos/' . $branch . '/' . $context;
	if ( 'commits' == $context ) {
		$apiurl .= '';
	} else if ( 'issues' == $context ) {
		$apiurl .= '?state=' . $status;
		$apiurl .= '&milestone=' . $milestone;
		$apiurl .= '&sort=created&direction=asc';
	}	
	
	// Request the API data, using the constructed URL
	$remote = wp_remote_get( esc_url( $apiurl ) );

	// If the API data request results in an error, return
	// an appropriate comment
	if ( is_wp_error( $remote ) ) {
		if ( current_user_can( $capability ) ) {
			return '<p>Github API: Github is unavailable.</p>';
		}
		return;
	}

	// If the API returns a server error in response, output
	// an error message indicating the server response.
	if ( '200' != $remote['response']['code'] ) {
		if ( current_user_can( $capability ) ) {
			return '<p>Github API: Github responded with an HTTP status code of ' . esc_html( $remote['response']['code'] ) . '.</p>';
		}
		return;
	}

	// If the API returns a valid response, the data will be
	// json-encoded; so decode it.
	$data = json_decode( $remote['body'] );	
	if ( 'issues' == $context ) {
		// Test	
	}
	usort( $data, 'oenology_sort_github_data' );

	// If the decoded json data is null, return a message
	// indicating that no data were returned.
	if ( ! isset( $data ) || empty( $data ) ) {
		$apidata = $context;
		if ( 'issues' == $context ) {
			$apidata = $status . ' ' . $context;
		}
		if ( current_user_can( $capability ) ) {
			return '<p>No ' . $apidata . ' could be found.</p>';
			return '<p>Github API: No ' . $apidata . ' could be found for this repository.</p>';
		}
		return;
	}

	// If the decoded json data has content, prepare the data
	// to be output.
	if ( 'issues' == $context ) {
		// $reportdate is used as a table column header
		$reportdate = ( 'open' == $status ? 'Reported' : 'Closed' );
		// $reportobject is used to return the appropriate timestamp
		$reportobject = ( 'open' == $status ? 'created_at' : 'closed_at' );
	} else if ( 'commits' == $context ) {
		// $reportdate is used as a table column header
		$reportdate = 'Date';
	}
	// $reportidlabel is used as a table column header
	$reportidlabel = ( 'issues' == $context ? '#' : 'Commit' );
	// $datelastrelease is the PHP date of last released, based
	// on the $releasedate parameter passed to the function
	$datelastrelease = get_date_from_gmt( date( 'Y-m-d H:i:s', strtotime( $releasedate ) ), 'U' );

	// Begin constructing the table
	$output = '';
	$output .= "\n" . '<table class="github-api github-' . $context . '">';
	$output .= "\n" . '<thead>';
	$output .= "\n\t" . '<tr><th>' . $reportidlabel . '</th><th>' . $reportdate . '</th>';
	if ( 'issues' == $context ) {
		$output .= '<th>Milestone</th><th>Label</th>';
	}
	$output .= '<th>Issue</th></tr>';
	$output .= "\n" . '</thead>';
	$output .= "\n" . '<tbody>';

	// Step through each object in the $data array
	foreach( $data as $object ) {
		if ( 'issues' == $context ) {
			$url = 'https://github.com/' . $branch . '/' . $context .'/' . $object->number;
			$reportid = $object->number;
			$message = $object->title;
			$label = $object->labels;
			$label = $label[0];
				$labelname = $label->name;
				$labelcolor = $label->color;
			$objecttime = $object->$reportobject;
			$milestoneobj = $object->milestone;
			$milestonetitle = $milestoneobj->title;
			$milestonenumber = $milestoneobj->number;
		} else if ( 'commits' == $context ) {				
			$url = 'https://github.com/' . $branch . '/commit/' . $object->sha;
			$reportid = substr( $object->sha, 0, 6 );
			$commit = $object->commit;
				$message = $commit->message;
				$author = $commit->author;
			$objecttime = $author->date;
		}
		$time = get_date_from_gmt( date( 'Y-m-d H:i:s', strtotime( $objecttime ) ), 'U' );
		$timestamp = date( 'dMy', $time );
		$time_human = 'About ' . human_time_diff( $time, get_date_from_gmt( date( 'Y-m-d H:i:s' ), 'U' ) ) . ' ago';
		$time_machine = date( 'Y-m-d\TH:i:s\Z', $time );
		$time_title_attr = date( get_option( 'date_format' ) . ' at ' . get_option( 'time_format' ), $time );
		
		// Only output $data reported/created/closed since 
		// the last release
		if ( ( 'issues' == $context && ( $milestone == $milestonenumber || ( true == $roadmap && $milestonetitle > $currentrelease ) ) ) || ( 'commits' == $context && $time > $datelastrelease ) ) {
			$output .= "\n\t" . '<tr>';
			$output .= '<td style="padding:3px 5px;text-align:center;font-weight:bold;"><a href="' . esc_url( $url ) . '">' . $reportid . '</a></td>';
			$output .= '<td style="padding:3px 5px;text-align:center;color:#999;font-size:12px;"><time title="' . esc_attr( $time_title_attr ) . '" datetime="' . esc_attr( $time_machine ) . '">' . esc_html( $timestamp ) . '</time></td>';
			if ( 'issues' == $context ) {
				$output .= '<td style="padding:3px 5px;text-align:center;color:#999;">' . $milestonetitle . '</td>';
				$output .= '<td style="padding-left:5px;text-align:center;"><div style="text-shadow:#555 1px 1px 0px;border:1px solid #bbb;-webkit-border-radius:5px;-moz-border-radius:5px;border-radius:5px;padding:3px;padding-bottom:5px;padding-top:1px;font-weight:bold;background-color:#ffffff;color:#' . $labelcolor . ';">' . $labelname . '</div></td>';
			}
			$output .= '<td style="padding:3px 5px;font-size:12px;">' . esc_html( $message ) . '</td>';
			$output .= '</tr>';
		}
	}

	// Complete construction of the table
	$output .= "\n" . '</tbody>';
	$output .= "\n" . '</table>';

	// Set the transient (cache) for the API data
	set_transient( $transient_key, $output, 600 );

	// Return the output
	return $output;
}

/**
 * Sort GitHub API Data
 * 
 * Callback function for usort() to sort the GitHub 
 * API (v3) issues data by issue number or commit date
 * 
 * @return	object	object of GitHub API data sorted by issue number or commit date
 */
function micro_sort_github_data( $a, $b ) {
	$sort = 0;
	$param_a = '';
	$param_b = '';
	if ( isset( $a->number ) ) {
		$param_a = $a->number;
		$param_b = $b->number;
	} else if ( isset( $a->committer ) ) {
		$commit_a = $a->commit;
		$commit_b = $b->commit;
		$committer_a = $commit_a->committer;
		$committer_b = $commit_b->committer;
		$param_a = get_date_from_gmt( date( 'Y-m-d H:i:s', strtotime( $committer_a->date ) ), 'U' );
		$param_b = get_date_from_gmt( date( 'Y-m-d H:i:s', strtotime( $committer_b->date ) ), 'U' );
	}
	if (  $param_a ==  $param_b ) { 
		$sort = 0; 
	} else {
		$sort = ( $param_a < $param_b ? -1 : 1 );
	}
	return $sort;
}

?>