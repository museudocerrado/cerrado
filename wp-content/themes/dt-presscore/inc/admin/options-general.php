<?php
/**
 * General.
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Page definition.
 */
$options[] = array(
		"page_title"	=> _x( "General", 'theme-options', LANGUAGE_ZONE ),
		"menu_title"	=> _x( "General", 'theme-options', LANGUAGE_ZONE ),
		"menu_slug"		=> "of-general-menu",
		"type"			=> "page"
);

/**
 * Heading definition.
 */
$options[] = array( "name" => _x('General', 'theme-options', LANGUAGE_ZONE), "type" => "heading" );

/**
 * Top logo.
 */
$options[] = array(	"name" => _x('Logo in header', 'theme-options', LANGUAGE_ZONE), "type" => "block_begin" );

	// uploader
	$options[] = array(
		"name"		=> '',
		"desc"		=> _x( 'Logo', 'theme-options', LANGUAGE_ZONE ),
		"id"		=> 'header-logo_regular',
		// full / uri_only
		"mode"		=> 'full',
		"type"		=> 'upload',
		'std'		=> array( '', 0 )
	);

	// uploader
	$options[] = array(
		"name"		=> '',
		"desc"		=> _x( 'High-DPI (retina) logo', 'theme-options', LANGUAGE_ZONE ),
		"id"		=> 'header-logo_hd',
		// full / uri_only
		"mode"		=> 'full',
		"type"		=> 'upload',
		'std'		=> array( '', 0 )
	);

$options[] = array(	"type" => "block_end");

/**
 * Bottom logo.
 */
$options[] = array(	"name" => _x('Logo in bottom line', 'theme-options', LANGUAGE_ZONE), "type" => "block_begin" );

	// uploader
	$options[] = array(
		"name"		=> '',
		"desc"		=> _x( 'Logo', 'theme-options', LANGUAGE_ZONE ),
		"id"		=> 'bottom_bar-logo_regular',
		"type"		=> 'upload',
		"mode"		=> 'full',
		'std'		=> array( '', 0 )
	);

	// uploader
	$options[] = array(
		"name"		=> '',
		"desc"		=> _x( 'High-DPI (retina) logo', 'theme-options', LANGUAGE_ZONE ),
		"id"		=> 'bottom_bar-logo_hd',
		"type"		=> 'upload',
		"mode"		=> 'full',
		'std'		=> array( '', 0 )
	);

$options[] = array(	"type" => "block_end");

/**
 * Background.
 */
$options[] = array(	"name" => _x('Background', 'theme-options', LANGUAGE_ZONE), "type" => "block_begin" );

	// colorpicker
	$options[] = array(
		"name"	=> '',
		"desc"	=> _x( 'Color', 'theme-options', LANGUAGE_ZONE ),
		"id"	=> "general-bg_color",
		"std"	=> "#252525",
		"type"	=> "color"
	);

	// slider
	$options[] = array(
		"name"      => '',
		"desc"      => _x( 'Opacity', 'theme-options', LANGUAGE_ZONE ),
		"id"        => "general-bg_opacity",
		"std"       => 100, 
		"type"      => "slider",
		"options"   => array( 'java_hide_if_not_max' => true )
	);
	
	// hidden area
	$options[] = array( 'type' => 'js_hide_begin' );
	
		// colorpicker
		$options[] = array(
			"name"  => '',
			"desc"  => _x( 'Internet Explorer color', 'theme-options', LANGUAGE_ZONE ),
			"id"    => "general-bg_ie_color",
			"std"   => "#252525",
			"type"  => "color"
		);
	
	$options[] = array( 'type' => 'js_hide_end' );

	// background_img
	$options[] = array(
		'desc' 			=> _x( 'Choose/upload background image', 'theme-options', LANGUAGE_ZONE ),
		'id' 			=> 'general-bg_image',
		'preset_images' => $backgrounds_general_bg_image,
		'std' 			=> array(
			'image'			=> '',
			'repeat'		=> 'repeat',
			'position_x'	=> 'center',
			'position_y'	=> 'center'
		),
		'type'			=> 'background_img'
	);

	// checkbox
	$options[] = array(
		"desc"      => _x( 'Fullscreen', 'theme-options', LANGUAGE_ZONE ),
	    "id"    	=> 'general-bg_fullscreen',
	    "type"  	=> 'checkbox',
	    'std'   	=> 0
	);

$options[] = array(	"type" => "block_end");

/**
 * Layout.
 */
$options[] = array(	"name" => _x('Layout', 'theme-options', LANGUAGE_ZONE), "type" => "block_begin" );

	// radio
	$options[] = array(
		"desc"		=> _x('Layout', 'theme-options', LANGUAGE_ZONE),
		"id"		=> 'general-layout',
		"std"		=> 'wide',
		"type"		=> 'radio',
		"options"	=> presscore_themeoptions_get_general_layout_options(),
		"show_hide"	=> array( 'boxed' => true ),
	);

	// hidden area
	$options[] = array( 'type' => 'js_hide_begin' );

		// colorpicker
		$options[] = array(
			"desc"	=> _x( 'Background color', 'theme-options', LANGUAGE_ZONE ),
			"id"	=> "general-boxed_bg_color",
			"std"	=> "#ffffff",
			"type"	=> "color"
		);

		// background_img
		$options[] = array(
			'type' 			=> 'background_img',
			'id' 			=> 'general-boxed_bg_image',
			'desc' 			=> _x( 'Choose/upload background image', 'theme-options', LANGUAGE_ZONE ),
			'preset_images' => $backgrounds_general_boxed_bg_image,
			'std' 			=> array(
				'image'			=> '',
				'repeat'		=> 'repeat',
				'position_x'	=> 'center',
				'position_y'	=> 'center'
			),
		);

		// checkbox
		$options[] = array(
			"desc"      => _x( 'Fullscreen ', 'theme-options', LANGUAGE_ZONE ),
		    "id"    	=> 'general-boxed_bg_fullscreen',
		    "type"  	=> 'checkbox',
		    'std'   	=> 0
		);

	$options[] = array( 'type' => 'js_hide_end' );

$options[] = array(	"type" => "block_end");

/**
 * Responsive.
 */
$options[] = array(	"name" => _x('Responsiveness', 'theme-options', LANGUAGE_ZONE), "type" => "block_begin" );

	// radio
	$options[] = array(
		"desc"		=> _x('Responsive layout', 'theme-options', LANGUAGE_ZONE),
		"id"		=> 'general-responsive',
		"std"		=> '1',
		"type"		=> 'radio',
		"options"	=> $en_dis_options
	);

$options[] = array(	"type" => "block_end");

/**
 * High-DPI (retina) images.
 */
$options[] = array(	"name" => _x('High-DPI (retina) images', 'theme-options', LANGUAGE_ZONE), "type" => "block_begin" );

	// radio
	$options[] = array(
		"desc"		=> _x('High-DPI (retina) images', 'theme-options', LANGUAGE_ZONE),
		"id"		=> 'general-hd_images',
		"std"		=> '1',
		"type"		=> 'radio',
		"options"	=> $en_dis_options
	);

$options[] = array(	"type" => "block_end");

/**
 * Color accent.
 */
$options[] = array(	"name" => _x('Color accent', 'theme-options', LANGUAGE_ZONE), "type" => "block_begin" );

	// colorpicker
	$options[] = array(
		"name"	=> '',
		"desc"	=> _x( 'Icons and text color', 'theme-options', LANGUAGE_ZONE ),
		"id"	=> "general-accent_text_color",
		"std"	=> "#ffffff",
		"type"	=> "color"
	);

	// colorpicker
	$options[] = array(
		"name"	=> '',
		"desc"	=> _x( 'Accent color', 'theme-options', LANGUAGE_ZONE ),
		"id"	=> "general-accent_bg_color",
		"std"	=> "#D73B37",
		"type"	=> "color"
	);

$options[] = array(	"type" => "block_end");

/**
 * Dividers.
 */
$options[] = array(	"name" => _x('Dividers', 'theme-options', LANGUAGE_ZONE), "type" => "block_begin" );

	// bg image
    $options[] = array(
        "name"      => '',
        "desc"      => _x('Thick divider style', 'theme-options', LANGUAGE_ZONE),
        "id"        => "general-thick_divider_style",
        "std"       => 'style-1',
        "type"      => "images",
        "options"   => array(
			'style-1'	=> '/inc/admin/assets/images/dividers-icons/d00.jpg',
			'style-1-1'	=> '/inc/admin/assets/images/dividers-icons/d01.jpg',
			'style-1-2'	=> '/inc/admin/assets/images/dividers-icons/d02.jpg',
			'style-1-3'	=> '/inc/admin/assets/images/dividers-icons/d03.jpg',
			'style-2'	=> '/inc/admin/assets/images/dividers-icons/d04.jpg',
			'style-2-1'	=> '/inc/admin/assets/images/dividers-icons/d05.jpg',
			'style-2-2'	=> '/inc/admin/assets/images/dividers-icons/d06.jpg',
			'style-3'	=> '/inc/admin/assets/images/dividers-icons/d07.jpg',
			'style-3-1'	=> '/inc/admin/assets/images/dividers-icons/d08.jpg',
			'style-3-2'	=> '/inc/admin/assets/images/dividers-icons/d09.jpg',
			'style-4'	=> '/inc/admin/assets/images/dividers-icons/d10.jpg',
			'style-4-1'	=> '/inc/admin/assets/images/dividers-icons/d11.jpg',
			'style-4-2'	=> '/inc/admin/assets/images/dividers-icons/d12.jpg',
        )
    );

    // bg image
    $options[] = array(
        "name"      => '',
        "desc"      => _x('Thin divider style', 'theme-options', LANGUAGE_ZONE),
        "id"        => "general-thin_divider_style",
        "std"       => 'style-1',
        "type"      => "images",
        "options"   => array(
        	'style-1'	=> '/inc/admin/assets/images/dividers-icons/d-small-01.jpg',
        	'style-2'	=> '/inc/admin/assets/images/dividers-icons/d-small-02.jpg',
        	'style-3'	=> '/inc/admin/assets/images/dividers-icons/d-small-03.jpg',
        )
    );

$options[] = array(	"type" => "block_end");

/**
 * Prev / Next buttons.
 */
$options[] = array(	"name" => _x('Prev / Next buttons', 'theme-options', LANGUAGE_ZONE), "type" => "block_begin" );

	// checkbox
	$options[] = array(
		"desc"      => _x( 'Show in blog posts', 'theme-options', LANGUAGE_ZONE ),
	    "name"  	=> '',
	    "id"    	=> 'general-next_prev_in_blog',
	    "type"  	=> 'checkbox',
	    'std'   	=> 1
	);

	// checkbox
	$options[] = array(
		"desc"      => _x( 'Show in portfolio projects', 'theme-options', LANGUAGE_ZONE ),
	    "name"  	=> '',
	    "id"    	=> 'general-next_prev_in_portfolio',
	    "type"  	=> 'checkbox',
	    'std'   	=> 1
	);

$options[] = array(	"type" => "block_end");

/**
 * Show author info on blog post pages.
 */
$options[] = array(	"name" => _x('Show author info in blog posts', 'theme-options', LANGUAGE_ZONE), "type" => "block_begin" );

	// checkbox
	$options[] = array(
		"desc"      => _x( 'Show author info in blog posts', 'theme-options', LANGUAGE_ZONE ),
	    "name"  	=> '',
	    "id"    	=> 'general-show_author_in_blog',
	    "type"  	=> 'checkbox',
	    'std'   	=> 1
	);

$options[] = array(	"type" => "block_end");

/**
 * Tracking code (e.g. Google analytics).
 */
$options[] = array(	"name" => _x('Tracking code (e.g. Google analytics)', 'theme-options', LANGUAGE_ZONE), "type" => "block_begin" );

	// textarea
	$options[] = array(
		"desc"      => _x( 'Tracking code (e.g. Google analytics)', 'theme-options', LANGUAGE_ZONE ),
		"id"		=> "general-tracking_code",
		"std"		=> false,
		"type"		=> 'textarea',
		"sanitize"	=> 'without_sanitize'
	);

$options[] = array(	"type" => "block_end");

/**
 * Favicon.
 */
$options[] = array(	"name" => _x('Favicon', 'theme-options', LANGUAGE_ZONE), "type" => "block_begin" );

	// uploader
	$options[] = array(
		"name"	=> '',
		"desc"	=> _x( 'Upload image', 'theme-options', LANGUAGE_ZONE ),
		"id"	=> 'general-favicon',
		"type"	=> 'upload',
		'std'	=> ''
	);

$options[] = array(	"type" => "block_end");

/**
 * Related posts settings.
 */
$options[] = array(	"name" => _x('Related posts settings', 'theme-options', LANGUAGE_ZONE), "type" => "block_begin" );
	
	/**
	 * Blog.
	 */

	// radio
	$options[] = array(
		"name"		=> _x('Blog posts', 'theme-options', LANGUAGE_ZONE),
		"desc"		=> _x('Show related posts', 'theme-options', LANGUAGE_ZONE),
		"id"		=> 'general-show_rel_posts',
		"std"		=> '0',
		"type"		=> 'radio',
		"options"	=> $yes_no_options,
		"show_hide"	=> array( '1' => true ),
	);

	// hidden area
	$options[] = array( 'type' => 'js_hide_begin' );
	
		// input
		$options[] = array(
			"desc"		=> _x( 'Title', 'theme-options', LANGUAGE_ZONE ),
			"id"		=> 'general-rel_posts_head_title',
			"std"		=> __('Related posts', LANGUAGE_ZONE),
			"type"		=> 'text',
		);

		// input
		$options[] = array(
			"desc"		=> _x( 'Maximum number of related posts', 'theme-options', LANGUAGE_ZONE ),
			"id"		=> 'general-rel_posts_max',
			"std"		=> 6,
			"type"		=> 'text',
			// number
			"sanitize"	=> 'ppp'
		);
	
	$options[] = array( 'type' => 'js_hide_end' );

	/**
	 * Portfolio.
	 */

	// radio
	$options[] = array(
		"before"	=> $divider_html,
		"name"		=> _x('Portfolio projects', 'theme-options', LANGUAGE_ZONE),
		"desc"		=> _x('Show related projects', 'theme-options', LANGUAGE_ZONE),
		"id"		=> 'general-show_rel_projects',
		"std"		=> '0',
		"type"		=> 'radio',
		"options"	=> $yes_no_options,
		"show_hide"	=> array( '1' => true ),
	);

	// hidden area
	$options[] = array( 'type' => 'js_hide_begin' );

		// input
		$options[] = array(
			"desc"		=> _x( 'Title', 'theme-options', LANGUAGE_ZONE ),
			"id"		=> 'general-rel_projects_head_title',
			"std"		=> __('Related projects', LANGUAGE_ZONE),
			"type"		=> 'text',
		);

		// radio
		$options[] = array(
			"desc"		=> _x('Arrows', 'theme-options', LANGUAGE_ZONE),
			"id"		=> 'general-rel_projects_arrows',
			"std"		=> '1',
			"type"		=> 'radio',
			"options"	=> $yes_no_options,
		);

		// input
		$options[] = array(
			"desc"		=> _x( 'Maximum number of projects posts', 'theme-options', LANGUAGE_ZONE ),
			"id"		=> 'general-rel_projects_max',
			"std"		=> 12,
			"type"		=> 'text',
			// number
			"sanitize"	=> 'ppp'
		);

		// radio
		$options[] = array(
			"desc"		=> _x('Show titles', 'theme-options', LANGUAGE_ZONE),
			"id"		=> 'general-rel_projects_title',
			"std"		=> '1',
			"type"		=> 'radio',
			"options"	=> $yes_no_options,
		);

		// radio
		$options[] = array(
			"desc"		=> _x('Show excerpts', 'theme-options', LANGUAGE_ZONE),
			"id"		=> 'general-rel_projects_excerpt',
			"std"		=> '1',
			"type"		=> 'radio',
			"options"	=> $yes_no_options,
		);

		// radio
		$options[] = array(
			"desc"		=> _x('Show links', 'theme-options', LANGUAGE_ZONE),
			"id"		=> 'general-rel_projects_link',
			"std"		=> '1',
			"type"		=> 'radio',
			"options"	=> $yes_no_options,
		);

		// radio
		$options[] = array(
			"desc"		=> _x('Show "Details" button', 'theme-options', LANGUAGE_ZONE),
			"id"		=> 'general-rel_projects_details',
			"std"		=> '1',
			"type"		=> 'radio',
			"options"	=> $yes_no_options,
		);

		// input
		$options[] = array(
			"desc"		=> _x( 'Related posts height for fullwidth posts (px)', 'theme-options', LANGUAGE_ZONE ),
			"id"		=> 'general-rel_projects_fullwidth_height',
			"std"		=> 270,
			"type"		=> 'text',
			// number
			"sanitize"	=> 'ppp'
		);

		// input
		$options[] = array(
			"desc"		=> _x( 'Related posts height for posts with sidebar (px)', 'theme-options', LANGUAGE_ZONE ),
			"id"		=> 'general-rel_projects_height',
			"std"		=> 190,
			"type"		=> 'text',
			// number
			"sanitize"	=> 'ppp'
		);

	$options[] = array( 'type' => 'js_hide_end' );

$options[] = array(	"type" => "block_end");

/**
 * Meta information settings.
 */
$options[] = array(	"name" => _x('Meta information settings', 'theme-options', LANGUAGE_ZONE), "type" => "block_begin" );
	
	/**
	 * Blog.
	 */

	// radio
	$options[] = array(
		"name"		=> _x('Blog & posts', 'theme-options', LANGUAGE_ZONE),
		"desc"		=> _x('Show meta information', 'theme-options', LANGUAGE_ZONE),
		"id"		=> 'general-blog_meta_on',
		"std"		=> '1',
		"type"		=> 'radio',
		"options"	=> $yes_no_options,
		"show_hide"	=> array( '1' => true ),
	);

	// hidden area
	$options[] = array( 'type' => 'js_hide_begin' );

		// checkbox
		$options[] = array(
			"desc"      => _x( 'Post format', 'theme-options', LANGUAGE_ZONE ),
		    "name"  	=> '',
		    "id"    	=> 'general-blog_meta_postformat',
		    "type"  	=> 'checkbox',
		    'std'   	=> 1
		);

		// checkbox
		$options[] = array(
			"desc"      => _x( 'Date', 'theme-options', LANGUAGE_ZONE ),
		    "name"  	=> '',
		    "id"    	=> 'general-blog_meta_date',
		    "type"  	=> 'checkbox',
		    'std'   	=> 1
		);

		// checkbox
		$options[] = array(
			"desc"      => _x( 'Author', 'theme-options', LANGUAGE_ZONE ),
		    "name"  	=> '',
		    "id"    	=> 'general-blog_meta_author',
		    "type"  	=> 'checkbox',
		    'std'   	=> 1
		);

		// checkbox
		$options[] = array(
			"desc"      => _x( 'Categories', 'theme-options', LANGUAGE_ZONE ),
		    "name"  	=> '',
		    "id"    	=> 'general-blog_meta_categories',
		    "type"  	=> 'checkbox',
		    'std'   	=> 1
		);

		// checkbox
		$options[] = array(
			"desc"      => _x( 'Comments', 'theme-options', LANGUAGE_ZONE ),
		    "name"  	=> '',
		    "id"    	=> 'general-blog_meta_comments',
		    "type"  	=> 'checkbox',
		    'std'   	=> 1
		);

		// checkbox
		$options[] = array(
			"desc"      => _x( 'Tags', 'theme-options', LANGUAGE_ZONE ),
		    "name"  	=> '',
		    "id"    	=> 'general-blog_meta_tags',
		    "type"  	=> 'checkbox',
		    'std'   	=> 1
		);

	$options[] = array( 'type' => 'js_hide_end' );

	/**
	 * Portfolio.
	 */

	// radio
	$options[] = array(
		"before"	=> $divider_html,
		"name"		=> _x('Portfolio projects', 'theme-options', LANGUAGE_ZONE),
		"desc"		=> _x('Show meta information', 'theme-options', LANGUAGE_ZONE),
		"id"		=> 'general-portfolio_meta_on',
		"std"		=> '1',
		"type"		=> 'radio',
		"options"	=> $yes_no_options,
		"show_hide"	=> array( '1' => true ),
	);

	// hidden area
	$options[] = array( 'type' => 'js_hide_begin' );

		// checkbox
		$options[] = array(
			"desc"      => _x( 'Date', 'theme-options', LANGUAGE_ZONE ),
		    "name"  	=> '',
		    "id"    	=> 'general-portfolio_meta_date',
		    "type"  	=> 'checkbox',
		    'std'   	=> 1
		);

		// checkbox
		$options[] = array(
			"desc"      => _x( 'Author', 'theme-options', LANGUAGE_ZONE ),
		    "name"  	=> '',
		    "id"    	=> 'general-portfolio_meta_author',
		    "type"  	=> 'checkbox',
		    'std'   	=> 1
		);

		// checkbox
		$options[] = array(
			"desc"      => _x( 'Categories', 'theme-options', LANGUAGE_ZONE ),
		    "name"  	=> '',
		    "id"    	=> 'general-portfolio_meta_categories',
		    "type"  	=> 'checkbox',
		    'std'   	=> 1
		);

		// checkbox
		$options[] = array(
			"desc"      => _x( 'Comments', 'theme-options', LANGUAGE_ZONE ),
		    "name"  	=> '',
		    "id"    	=> 'general-portfolio_meta_comments',
		    "type"  	=> 'checkbox',
		    'std'   	=> 1
		);

	$options[] = array( 'type' => 'js_hide_end' );

$options[] = array(	"type" => "block_end");

/**
 * WYSIWYG.
 */
$options[] = array(	"name" => _x('WYSIWYG', 'theme-options', LANGUAGE_ZONE), "type" => "block_begin" );

	// radio
	$options[] = array(
		"desc"		=> _x('Use visual columns builder in WYSIWYG', 'theme-options', LANGUAGE_ZONE),
		"id"		=> 'general-wysiwig_visual_columns',
		"std"		=> '0',
		"type"  	=> 'checkbox'
	);

$options[] = array(	"type" => "block_end");
