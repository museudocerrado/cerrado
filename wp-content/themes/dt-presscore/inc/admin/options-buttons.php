<?php
/**
 * Buttons.
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Page definition.
 */
$options[] = array(
	"page_title"	=> _x( "Buttons", 'theme-options', LANGUAGE_ZONE ),
	"menu_title"	=> _x( "Buttons", 'theme-options', LANGUAGE_ZONE ),
	"menu_slug"		=> "of-buttons-menu",
	"type"			=> "page"
);

/**
 * Heading definition.
 */
$options[] = array( "name" => _x('Buttons', 'theme-options', LANGUAGE_ZONE), "type" => "heading" );

/**
 * Buttons background color.
 */
$options[] = array(	"name" => _x('Buttons background color', 'theme-options', LANGUAGE_ZONE), "type" => "block_begin" );

	// colorpicker
	$options[] = array(
		"desc"	=> _x( 'Buttons background color', 'theme-options', LANGUAGE_ZONE ),
		"id"	=> "buttons-bg_color",
		"std"	=> "#d73b37",
		"type"	=> "color"
	);

$options[] = array(	"type" => "block_end");

/**
 * Buttons shadow.
 */
$options[] = array(	"name" => _x('Buttons shadow', 'theme-options', LANGUAGE_ZONE), "type" => "block_begin" );

	// colorpicker
	$options[] = array(
		"desc"	=> _x( 'Buttons shadow', 'theme-options', LANGUAGE_ZONE ),
		"id"	=> "buttons-shadow",
		"std"	=> "#a12c29",
		"type"	=> "color"
	);

$options[] = array(	"type" => "block_end");

/**
 * Buttons text color.
 */
$options[] = array(	"name" => _x('Buttons text color', 'theme-options', LANGUAGE_ZONE), "type" => "block_begin" );

	// colorpicker
	$options[] = array(
		"desc"	=> _x( 'Buttons text color', 'theme-options', LANGUAGE_ZONE ),
		"id"	=> "buttons-text_color",
		"std"	=> "#ffffff",
		"type"	=> "color"
	);

$options[] = array(	"type" => "block_end");

/**
 * Buttons text shadow.
 */
$options[] = array(	"name" => _x('Buttons text shadow', 'theme-options', LANGUAGE_ZONE), "type" => "block_begin" );

	// colorpicker
	$options[] = array(
		"desc"	=> _x( 'Buttons text shadow', 'theme-options', LANGUAGE_ZONE ),
		"id"	=> "buttons-text_shadow",
		"std"	=> "#b1302d",
		"type"	=> "color"
	);

$options[] = array(	"type" => "block_end");

/**
 * Small, Medium, Big Buttons.
 */

$buttons = presscore_themeoptions_get_buttons_defaults();

foreach ( $buttons as $id=>$opts ) {

	$options[] = array(	"name" => _x($opts['desc'], 'theme-options', LANGUAGE_ZONE), "type" => "block_begin" );

		// select
        $options[] = array(
            "desc"      => _x( 'Font-family', 'theme-options', LANGUAGE_ZONE ),
            "id"        => "buttons-" . $id . "_font_family",
            "std"       => (!empty($opts['ff']) ? $opts['ff'] : "Open Sans"),
            "type"      => "web_fonts",
            "options"   => $merged_fonts,
        );

        // slider
        $options[] = array(
            "desc"      => _x( 'Font-size', 'theme-options', LANGUAGE_ZONE ),
            "id"        => "buttons-" . $id . "_font_size",
            "std"       => $opts['fs'], 
            "type"      => "slider",
            "options"   => array( 'min' => 9, 'max' => 71 ),
            "sanitize"  => 'font_size'
        );

        // checkbox
        $options[] = array(
            "desc"      => _x( 'Uppercase', 'theme-options', LANGUAGE_ZONE ),
            "id"        => 'buttons-' . $id . '_uppercase',
            "type"      => 'checkbox',
            'std'       => $opts['uc']
        );

        // slider
        $options[] = array(
            "desc"        => _x( 'Line-height', 'theme-options', LANGUAGE_ZONE ),
            "id"        => "buttons-" . $id ."_line_height",
            "std"        => $opts['lh'], 
            "type"        => "slider",
        );

	$options[] = array(	"type" => "block_end");
}
