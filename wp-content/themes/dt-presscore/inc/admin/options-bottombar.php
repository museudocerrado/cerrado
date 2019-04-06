<?php
/**
 * Bottom Bar.
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Page definition.
 */
$options[] = array(
	"page_title" 	=> _x( "Bottom Bar", 'theme-options', LANGUAGE_ZONE ),
	"menu_title" 	=> _x( "Bottom Bar", 'theme-options', LANGUAGE_ZONE ),
	"menu_slug"		=> "of-bottombar-menu",
	"type" 			=> "page"
);

/**
 * Heading definition.
 */
$options[] = array( "name" => _x('Bottom Bar', 'theme-options', LANGUAGE_ZONE), "type" => "heading" );

/**
 * Background color.
 */
$options[] = array(	"name" => _x('Background', 'theme-options', LANGUAGE_ZONE), "type" => "block_begin" );

	// colorpicker
	$options[] = array(
		"name"	=> '',
		"desc"	=> _x( 'Background color', 'theme-options', LANGUAGE_ZONE ),
		"id"	=> "bottom_bar-bg_color",
		"std"	=> "#ffffff",
		"type"	=> "color"
	);

	// slider
	$options[] = array(
		"name"		=> '',
		"desc"		=> _x( 'Opacity', 'theme-options', LANGUAGE_ZONE ),
		"id"		=> "bottom_bar-bg_opacity",
		"std"		=> 100, 
		"type"		=> "slider",
		"options"	=> array( 'java_hide_if_not_max' => true )
	);

	// hidden area
	$options[] = array( 'type' => 'js_hide_begin' );
	
		// colorpicker
		$options[] = array(
			"name"	=> '',
			"desc"	=> _x( 'Internet Explorer color', 'theme-options', LANGUAGE_ZONE ),
			"id"	=> "bottom_bar-bg_ie_color",
			"std"	=> "#ffffff",
			"type"	=> "color"
		);
	
	$options[] = array( 'type' => 'js_hide_end' );

	// background_img
	$options[] = array(
		'type' 			=> 'background_img',
		'id'			=> 'bottom_bar-bg_image',
		'desc' 			=> _x( 'Image uploader', 'theme-options', LANGUAGE_ZONE ),
		'preset_images' => $backgrounds_bottom_bar_bg_image,
		'std' 			=> $background_defaults,
	);

$options[] = array(	"type" => "block_end");

/**
 * Font color.
 */
$options[] = array(	"name" => _x('Font color', 'theme-options', LANGUAGE_ZONE), "type" => "block_begin" );

	// colorpicker
	$options[] = array(
		"name"	=> '',
		"desc"	=> _x( 'Font color', 'theme-options', LANGUAGE_ZONE ),
		"id"	=> "bottom_bar-color",
		"std"	=> "#757575",
		"type"	=> "color"
	);

$options[] = array(	"type" => "block_end");

/**
 * Copyright information.
 */
$options[] = array(	"name" => _x('Copyright information', 'theme-options', LANGUAGE_ZONE), "type" => "block_begin" );

	// textarea
	$options[] = array(
		"name"		=> '',
		"desc"		=> _x('Copyright information', 'theme-options', LANGUAGE_ZONE),
		"id"		=> "bottom_bar-copyrights",
		"std"		=> false,
		"type"		=> 'textarea'
	);

	// checkbox
	$options[] = array(
		"desc"		=> _x( 'Give credits to Dream-Theme', 'theme-options', LANGUAGE_ZONE ),
		"name"		=> '',
		"id"		=> 'bottom_bar-credits',
		"type"		=> 'checkbox',
		'std'		=> 1
	);

$options[] = array(	"type" => "block_end");
