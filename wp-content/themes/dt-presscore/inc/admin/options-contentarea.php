<?php
/**
 * Content Area.
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Page definition.
 */
$options[] = array(
	"page_title"	=> _x( "Content Area", 'theme-options', LANGUAGE_ZONE ),
	"menu_title"	=> _x( "Content Area", 'theme-options', LANGUAGE_ZONE ),
	"menu_slug"		=> "of-contentarea-menu",
	"type"			=> "page"
);

/**
 * Heading definition.
 */
$options[] = array( "name" => _x('Content Area', 'theme-options', LANGUAGE_ZONE), "type" => "heading" );

/**
 * Text.
 */
$options[] = array(	"name" => _x('Text', 'theme-options', LANGUAGE_ZONE), "type" => "block_begin" );

	// colorpicker
	$options[] = array(
		"name"	=> '',
		"desc"	=> _x( 'Headers color', 'theme-options', LANGUAGE_ZONE ),
		"id"	=> "content-headers_color",
		"std"	=> "#252525",
		"type"	=> "color"
	);

	// colorpicker
	$options[] = array(
		"name"	=> '',
		"desc"	=> _x( 'Primary text color', 'theme-options', LANGUAGE_ZONE ),
		"id"	=> "content-primary_text_color",
		"std"	=> "#686868",
		"type"	=> "color"
	);

	// colorpicker
	$options[] = array(
		"name"	=> '',
		"desc"	=> _x( 'Secondary text color', 'theme-options', LANGUAGE_ZONE ),
		"id"	=> "content-secondary_text_color",
		"std"	=> "#ffffff",
		"type"	=> "color"
	);

$options[] = array(	"type" => "block_end");

/**
 * Divider.
 */
$options[] = array(	"name" => _x('Dividers', 'theme-options', LANGUAGE_ZONE), "type" => "block_begin" );
	
	// colorpicker
	$options[] = array(
		"name"	=> '',
		"desc"	=> _x( 'Color', 'theme-options', LANGUAGE_ZONE ),
		"id"	=> "content-dividers_color",
		"std"	=> "#ffffff",
		"type"	=> "color"
	);

	// slider
	$options[] = array(
		"name"      => '',
		"desc"      => _x( 'Opacity', 'theme-options', LANGUAGE_ZONE ),
		"id"        => "content-dividers_opacity",
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
			"id"    => "content-dividers_ie_color",
			"std"   => "#ffffff",
			"type"  => "color"
		);

	$options[] = array( 'type' => 'js_hide_end' );

$options[] = array(	"type" => "block_end");

/**
 * Additional backgrounds (used in meta information, shortcodes etc).
 */
$options[] = array(	"name" => _x('Additional backgrounds (used in meta information, shortcodes etc)', 'theme-options', LANGUAGE_ZONE), "type" => "block_begin" );

	// colorpicker
	$options[] = array(
		"name"	=> '',
		"desc"	=> _x( 'Color', 'theme-options', LANGUAGE_ZONE ),
		"id"	=> "content-additional_bg_color",
		"std"	=> "#757575",
		"type"	=> "color"
	);

	// slider
	$options[] = array(
		"name"      => '',
		"desc"      => _x( 'Opacity', 'theme-options', LANGUAGE_ZONE ),
		"id"        => "content-additional_bg_opacity",
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
			"id"    => "content-additional_bg_ie_color",
			"std"   => "#dcdcdb",
			"type"  => "color"
		);

	$options[] = array( 'type' => 'js_hide_end' );

$options[] = array(	"type" => "block_end");
