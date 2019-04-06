<?php
/**
 * Sidebar.
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Page definition.
 */
$options[] = array(
		"page_title"	=> _x( "Sidebar", 'theme-options', LANGUAGE_ZONE ),
		"menu_title"	=> _x( "Sidebar", 'theme-options', LANGUAGE_ZONE ),
		"menu_slug"		=> "of-sidebar-menu",
		"type"			=> "page"
);

/**
 * Heading definition.
 */
$options[] = array( "name" => _x('Sidebar', 'theme-options', LANGUAGE_ZONE), "type" => "heading" );

// info
$options[] = array(
	"desc"	=> _x( "Please note that  settings from this page are also being used in pagination and categorization.", 'theme-options', LANGUAGE_ZONE ),
	"class"	=> '',
	"type"	=> 'info'
);

/**
 * Background color.
 */
$options[] = array(	"name" => _x('Background color', 'theme-options', LANGUAGE_ZONE), "type" => "block_begin" );

	// colorpicker
	$options[] = array(
		"name"	=> '',
		"desc"	=> _x( 'Background color', 'theme-options', LANGUAGE_ZONE ),
		"id"	=> "sidebar-bg_color",
		"std"	=> "#ffffff",
		"type"	=> "color"
	);

	// slider
	$options[] = array(
		"name"      => '',
		"desc"      => _x( 'Opacity', 'theme-options', LANGUAGE_ZONE ),
		"id"        => "sidebar-bg_opacity",
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
			"id"    => "sidebar-bg_ie_color",
			"std"   => "#ffffff",
			"type"  => "color"
		);

	$options[] = array( 'type' => 'js_hide_end' );

	// background_img
	$options[] = array(
		'type' 			=> 'background_img',
		'id' 			=> 'sidebar-bg_image',
		'desc' 			=> _x( 'Image uploader', 'theme-options', LANGUAGE_ZONE ),
		'preset_images' => $backgrounds_sidebar_bg_image,
		'std' 			=> array(
			'image'			=> '',
			'repeat'		=> 'repeat',
			'position_x'	=> 'center',
			'position_y'	=> 'center',
		),
	);

$options[] = array(	"type" => "block_end");

/**
 * Dividers.
 */
$options[] = array(	"name" => _x('Dividers', 'theme-options', LANGUAGE_ZONE), "type" => "block_begin" );

	// colorpicker
	$options[] = array(
		"name"	=> '',
		"desc"	=> _x( 'Color', 'theme-options', LANGUAGE_ZONE ),
		"id"	=> "sidebar-dividers_color",
		"std"	=> "#757575",
		"type"	=> "color"
	);

	// slider
	$options[] = array(
		"name"      => '',
		"desc"      => _x( 'Opacity', 'theme-options', LANGUAGE_ZONE ),
		"id"        => "sidebar-dividers_opacity",
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
			"id"    => "sidebar-dividers_ie_color",
			"std"   => "#ececec",
			"type"  => "color"
		);

	$options[] = array( 'type' => 'js_hide_end' );

$options[] = array(	"type" => "block_end");

/**
 * Text.
 */
$options[] = array(	"name" => _x('Text', 'theme-options', LANGUAGE_ZONE), "type" => "block_begin" );

	// colorpicker
	$options[] = array(
		"name"	=> '',
		"desc"	=> _x( 'Headers color', 'theme-options', LANGUAGE_ZONE ),
		"id"	=> "sidebar-headers_color",
		"std"	=> "#000000",
		"type"	=> "color"
	);

	// colorpicker
	$options[] = array(
		"name"	=> '',
		"desc"	=> _x( 'Primary text color', 'theme-options', LANGUAGE_ZONE ),
		"id"	=> "sidebar-primary_text_color",
		"std"	=> "#686868",
		"type"	=> "color"
	);

	// colorpicker
	$options[] = array(
		"name"	=> '',
		"desc"	=> _x( 'Secondary text color', 'theme-options', LANGUAGE_ZONE ),
		"id"	=> "sidebar-secondary_text_color",
		"std"	=> "#d73b37",
		"type"	=> "color"
	);

$options[] = array(	"type" => "block_end");
