<?php
/*
 * options-socials.php
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

$options[] = array( "page_title" => "Social Links and Like Buttons", "menu_title" => "Social Links and Like Buttons", "menu_slug" => "of-socials-menu", "type" => "page" );

$options[] = array( "name" => _x('Social links', 'theme-options', LANGUAGE_ZONE), "type" => "heading" );

$options[] = array(	"name" => _x('Social links', 'theme-options', LANGUAGE_ZONE), "type" => "block_begin" );

$soc_ico_arr = dt_get_fonts_in( 'images/soc-ico' );

$options[] = array(
    'id'        => 'social_icons',
    'type'      => 'social_icon',
    'std'       => '',
    'options'   => array(
        'fields'        => $soc_ico_arr,
        'ico_height'    => 20,
        'ico_width'     => 20
    )
);

$options[] = array(	"type" => "block_end");

/*
 *	Like buttons
 */
$options[] = array( "name" => _x('Like buttons', 'theme-options', LANGUAGE_ZONE), "type" => "heading" );

// TODO: delete in production 
/*
$options[] = array(	"name" => _x('Enable like buttons in ...', 'theme-options', LANGUAGE_ZONE), "type" => "block_begin" );
	
	$like_places = array(
		'post'		=> array( 'desc' => _x('Post', 'backend like buttons', LANGUAGE_ZONE), 'std' => 1 ),
		'portfolio'	=> array( 'desc' => _x('Portfolio', 'backend like buttons', LANGUAGE_ZONE), 'std' => 1 ),
		'gallery'	=> array( 'desc' => _x('Album', 'backend like buttons', LANGUAGE_ZONE), 'std' => 1 ),
		'photo'		=> array( 'desc' => _x('Photo', 'backend like buttons', LANGUAGE_ZONE), 'std' => 1 ),
	);
	
	foreach( $like_places as $place=>$opts ) {
		$options[] = array(
			"name"      => '',
			"desc"      => $opts['desc'],
			"id"        => "social-like_". $place,
			"std"       => $opts['std'],
			"type"      => "checkbox"
		);
	}
	
$options[] = array(	"type" => "block_end");
*/

$options[] = array(	"name" => _x('Like buttons', 'theme-options', LANGUAGE_ZONE), "type" => "block_begin" );

	$like_buttons = array(
		'google_plus'	=> array( 'desc' => _x('Google Plus', 'backend like buttons', LANGUAGE_ZONE), 'std' => 1 ),
		'twitter'		=> array( 'desc' => _x('Twitter', 'backend like buttons', LANGUAGE_ZONE), 'std' => 1 ),
		'faceboock'		=> array( 'desc' => _x('Facebook', 'backend like buttons', LANGUAGE_ZONE), 'std' => 1 )
	);
	
	foreach( $like_buttons as $button=>$opts ) {
		$options[] = array(
			"name"      => '',
			"desc"      => $opts['desc'],
			"id"        => "social-like_button_". $button,
			"std"       => $opts['std'],
			"type"      => "checkbox"
		);
	}

$options[] = array(	"type" => "block_end");
