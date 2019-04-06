<?php
/**
 * Image Hovers.
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Page definition.
 */
$options[] = array(
		"page_title"	=> _x( "Image Styling & Hovers", 'theme-options', LANGUAGE_ZONE ),
		"menu_title"	=> _x( "Image Styling & Hovers", 'theme-options', LANGUAGE_ZONE ),
		"menu_slug"		=> "of-imghoovers-menu",
		"type"			=> "page"
);

/**
 * Heading definition.
 */
$options[] = array( "name" => _x('Image styling & hovers', 'theme-options', LANGUAGE_ZONE), "type" => "heading" );

/**
 * Hover color.
 */
$options[] = array(	"name" => _x('Hover color overlay', 'theme-options', LANGUAGE_ZONE), "type" => "block_begin" );

	// colorpicker
	$options[] = array(
		"name"	=> '',
		"desc"	=> _x( 'Color', 'theme-options', LANGUAGE_ZONE ),
		"id"	=> "hoover-color",
		"std"	=> "#000000",
		"type"	=> "color"
	);

$options[] = array(	"type" => "block_end");

/**
 * Hover opacity.
 */
$options[] = array(	"name" => _x('Hover opacity', 'theme-options', LANGUAGE_ZONE), "type" => "block_begin" );
	
	// TODO: add some helpful info about opacity in ie <= 8

	// slider
	$options[] = array(
		"name"		=> '',
		"desc"		=> _x( 'Opacity', 'theme-options', LANGUAGE_ZONE ),
		"id"		=> "hoover-opacity",
		"std"		=> 100, 
		"type"		=> "slider",
	);

$options[] = array(	"type" => "block_end");

/**
 * Style.
 */
$options[] = array(	"name" => _x('Style', 'theme-options', LANGUAGE_ZONE), "type" => "block_begin" );

	// radio
	$options[] = array(
		"desc"		=> _x('Style', 'theme-options', LANGUAGE_ZONE),
		"id"		=> 'hoover-style',
		"std"		=> 'none',
		"type"		=> 'radio',
		"options"	=> presscore_themeoptions_get_hoover_options()
	);

$options[] = array(	"type" => "block_end");
