<?php
/**
 * Description here.
 *
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Update custom.less stylesheet.
 */
function presscore_generate_less_css_file() {
	
	$less = WPLessPlugin::getInstance();
	$config = $less->getConfiguration();

	wp_register_style( 'dt-custom.less', get_template_directory_uri() . '/css/custom.less' );

	// save options
	$compilled_vars = presscore_compile_less_vars();
	$options = presscore_compilled_less_vars( $compilled_vars );
	
	if ( $options ) {
		$less->setVariables( $options );
	}

	WPLessStylesheet::$upload_dir = $config->getUploadDir();
	WPLessStylesheet::$upload_uri = $config->getUploadUrl();

	$less->processStylesheet( 'dt-custom.less', true );
}

/**
 * Store Less variables for future use.
 *
 */
function presscore_compilled_less_vars( $options = null ) {
	if ( $options ) {
		update_option( 'presscore_compilled_less_vars', $options );
		$saved_options = $options;
	} else {
		$saved_options = get_option( 'presscore_compilled_less_vars' );
	}

	return $saved_options;
}

/**
 * Translate theme options to less variables.
 */
function presscore_theme_options_to_less() {
	if ( !class_exists('WPLessPlugin') || is_admin() ) {
		return;
	}

	$less = WPLessPlugin::getInstance();

	$options = presscore_compilled_less_vars();
	
	if ( $options ) {
		$less->setVariables( $options );
	}

}
add_action( 'after_setup_theme', 'presscore_theme_options_to_less', 16 );

/**
 * Description here.
 *
 */
function presscore_stylesheet_is_not_writable() {
	if ( get_option( 'presscore_less_css_is_writable' ) ) {
		update_option( 'presscore_less_css_is_writable', 0 );
	}
}
add_action( 'wp-less_save_stylesheet_error', 'presscore_stylesheet_is_not_writable' );

/**
 * Description here.
 *
 */
function presscore_stylesheet_is_writable() {
	if ( false === get_option( 'presscore_less_css_is_writable' ) ) {
		add_option( 'presscore_less_css_is_writable', 1 );
	} else {
		update_option( 'presscore_less_css_is_writable', 1 );
	}
}
add_action( 'wp-less_stylesheet_save_post', 'presscore_stylesheet_is_writable' );

/**
 * Compile less vars from theme options.
 *
 */
function presscore_compile_less_vars() {
	if ( !class_exists('WPLessPlugin') ) {
		return array();
	}

	$less = WPLessPlugin::getInstance();

	$image_defaults = array(
		'image'			=> '',
		'repeat'		=> 'repeat',
		'position_x'	=> 'center',
		'position_y'	=> 'center'
	);

	$font_family_falloff = ', Helvetica, Arial, Verdana, sans-serif';
	$font_family_defaults = array('family' => 'Open Sans');

	$relative_base = '../../..';

	// main array
	$options = array();

	$options_inteface = array(

		/* Top Bar */
		array(
			'type' 		=> 'rgba_color',
			'less_vars' => array('top-bg-color', 'top-bg-color-ie'),
			'php_vars'	=> array(
				'color' 	=> array('top_bar-bg_color', '#ffffff'),
				'opacity'	=> array('top_bar-bg_opacity', 100),
				'ie_color'	=> array('top_bar-bg_ie_color', '#ffffff'),
			),
		),
		array(
			'type'		=> 'image',
			'less_vars'	=> array('top-bg-image', 'top-bg-repeat', 'top-bg-position-x', 'top-bg-position-y'),
			'php_vars'	=> array( 'image' => array('top_bar-bg_image', $image_defaults) ),
		),
		array(
			'type'		=> 'hex_color',
			'less_vars'	=> array('top-color'),
			'php_vars'	=> array( 'color' => array('top_bar-text_color', '#686868') ),
		),
		array(
			'type'		=>'rgba_color',
			'less_vars'	=> array('top-icons-bg-color'),
			'php_vars'	=> array(
				'color'		=> array('top_bar-contact_icons_bg_color', '#686868'),
				'opacity'	=> array('top_bar-contact_icons_bg_opacity', 16)
			),
		),
		array(
			'type'		=> 'rgb_color',
			'less_vars'	=> array('top-icons-color'),
			'wrap'		=> '"',
			'php_vars'	=> array(
				'color'	=> array('top_bar-contact_icons_color', '#686868')
			),
		),

		array(
			'type'		=>'rgba_color',
			'less_vars'	=> array('top-search-bg-color'),
			'php_vars'	=> array(
				'color'		=> array('top_bar-search_bg_color', '#686868'),
				'opacity'	=> array('top_bar-search_bg_opacity', 16)
			),
		),
		array(
			'type'		=> 'hex_color',
			'less_vars'	=> array('top-search-color'),
			'wrap'		=> '"',
			'php_vars'	=> array(
				'color'	=> array('top_bar-search_color', '#686868')
			),
		),

		/* Bootom Bar */
		array(
			'type'		=> 'hex_color',
			'less_vars'	=> array('bottom-color'),
			'php_vars'	=> array( 'color' => array('bottom_bar-color', '#757575') )
		),
		array(
			'type'		=> 'rgba_color',
			'less_vars'	=> array('bottom-bg-color', 'bottom-bg-color-ie'),
			'php_vars'	=> array(
				'color' 	=> array('bottom_bar-bg_color', '#ffffff'),
				'opacity'	=> array('bottom_bar-bg_opacity', 100),
				'ie_color'	=> array('bottom_bar-bg_ie_color', '#ffffff'),
			),
		),
		array(
			'type'		=> 'image',
			'less_vars'	=> array('bottom-bg-image', 'bottom-bg-repeat', 'bottom-bg-position-x', 'bottom-bg-position-y'),
			'php_vars'	=> array( 'image' => array('bottom_bar-bg_image', $image_defaults) ),
		),

		/* Fonts */
		array(
			'type'		=> 'font',
			'wrap'		=> array('"', '"' . $font_family_falloff),
			'less_vars'	=> array('base-font-family', 'base-font-weight', 'base-font-style'),
			'php_vars'	=> array( 'font' => array('fonts-font_family', $font_family_defaults) ),
		),
		array(
			'type'		=> 'number',
			'wrap'		=> array('', 'px'),
			'less_vars'	=> array('base-line-height'),
			'php_vars'	=> array( 'number' => array('fonts-line_height', 20) ),
		),
		array(
			'type'		=> 'number',
			'wrap'		=> array('', 'px'),
			'less_vars'	=> array('base-font-size'),
			'php_vars'	=> array( 'number' => array('fonts-normal_size', 13) ),
		),
		array(
			'type'		=> 'number',
			'wrap'		=> array('', 'px'),
			'less_vars'	=> array('text-small'),
			'php_vars'	=> array( 'number' => array('fonts-small_size', 11) ),
		),
		array(
			'type'		=> 'number',
			'wrap'		=> array('', 'px'),
			'less_vars'	=> array('text-big'),
			'php_vars'	=> array( 'number' => array('fonts-big_size', 15) ),
		),

		/* Buttons */
		
		array(
			'type'		=> 'hex_color',
			'less_vars'	=> array('dt-btn-bg-color'),
			'php_vars'	=> array( 'color' => array('buttons-bg_color', '#d73b37') )
		),
		array(
			'type'		=> 'hex_color',
			'less_vars'	=> array('dt-btn-box-shadow'),
			'php_vars'	=> array( 'color' => array('buttons-shadow', '#a12c29') )
		),
		array(
			'type'		=> 'hex_color',
			'less_vars'	=> array('dt-btn-color'),
			'php_vars'	=> array( 'color' => array('buttons-text_color', '#fff') )
		),
		array(
			'type'		=> 'hex_color',
			'less_vars'	=> array('dt-btn-text-shadow'),
			'php_vars'	=> array( 'color' => array('buttons-text_shadow', '#b1302d') )
		),

		/* Content Area */

		array(
			'type'		=> 'hex_color',
			'less_vars'	=> array( 'base-color' ),
			'php_vars'	=> array( 'color' => array('content-primary_text_color', '#686868') )
		),

		array(
			'type'		=> 'hex_color',
			'less_vars'	=> array( 'secondary-base-color' ),
			'php_vars'	=> array( 'color' => array('content-secondary_text_color', '#000000') )
		),

		array(
			'type' 		=> 'rgba_color',
			'less_vars' => array( 'backgrounds-bg-color', 'backgrounds-bg-color-ie' ),
			'php_vars'	=> array(
				'color' 	=> array('content-additional_bg_color', '#757575'),
				'opacity'	=> array('content-additional_bg_opacity', 100),
				'ie_color'	=> array('content-additional_bg_ie_color', '#dcdcdb'),
			),
		),

		// divider color
		array(
			'type' 		=> 'rgba_color',
			'less_vars' => array( 'divider-bg-color', 'divider-bg-color-ie' ),
			'php_vars'	=> array(
				'color' 	=> array('content-dividers_color', '#ffffff'),
				'opacity'	=> array('content-dividers_opacity', 100),
				'ie_color'	=> array('content-dividers_ie_color', '#ffffff'),
			),
		),

		/* Sidebar */

		array(
			'type' 		=> 'rgba_color',
			'less_vars' => array( 'widget-sidebar-bg-color', 'widget-sidebar-bg-color-ie' ),
			'php_vars'	=> array(
				'color' 	=> array('sidebar-bg_color', '#ffffff'),
				'opacity'	=> array('sidebar-bg_opacity', 100),
				'ie_color'	=> array('sidebar-bg_ie_color', '#ffffff'),
			),
		),
		array(
			'type'		=> 'image',
			'less_vars'	=> array( 'widget-sidebar-bg-image', 'widget-sidebar-bg-repeat', 'widget-sidebar-bg-position-x', 'widget-sidebar-bg-position-y' ),
			'php_vars'	=> array( 'image' => array('sidebar-bg_image', $image_defaults) ),
		),
		array(
			'type'		=> 'hex_color',
			'less_vars'	=> array( 'widget-sidebar-color' ),
			'php_vars'	=> array( 'color' => array('sidebar-primary_text_color', '#686868') )
		),
		array(
			'type'		=> 'hex_color',
			'less_vars'	=> array( 'widget-sidebar-header-color' ),
			'php_vars'	=> array( 'color' => array('sidebar-headers_color', '#000000') )
		),
		array(
			'type'		=> 'hex_color',
			'less_vars'	=> array( 'widget-sidebar-secondary-color' ),
			'php_vars'	=> array( 'color' => array('sidebar-secondary_text_color', '#d73b37') )
		),
		array(
			'type' 		=> 'rgba_color',
			'less_vars' => array( 'widget-sidebar-divider-bg-color', 'widget-sidebar-divider-bg-color-ie' ),
			'php_vars'	=> array(
				'color' 	=> array('sidebar-dividers_color', '#757575'),
				'opacity'	=> array('sidebar-dividers_opacity', 14),
				'ie_color'	=> array('sidebar-dividers_ie_color', '#ececec'),
			),
		),

		/* Footer */
		array(
			'type' 		=> 'rgba_color',
			'less_vars' => array( 'footer-bg-color', 'footer-bg-color-ie' ),
			'php_vars'	=> array(
				'color' 	=> array('footer-bg_color', '#1b1b1b'),
				'opacity'	=> array('footer-bg_opacity', 100),
				'ie_color'	=> array('footer-bg_ie_color', '#1b1b1b'),
			),
		),
		array(
			'type' 		=> 'rgba_color',
			'less_vars' => array( 'widget-footer-divider-bg-color', 'widget-footer-divider-bg-color-ie' ),
			'php_vars'	=> array(
				'color' 	=> array('footer-dividers_color', '#828282'),
				'opacity'	=> array('footer-dividers_opacity', 100),
				'ie_color'	=> array('footer-dividers_ie_color', '#828282'),
			),
		),
		array(
			'type'		=> 'image',
			'less_vars'	=> array( 'footer-bg-image', 'footer-bg-repeat', 'footer-bg-position-x', 'footer-bg-position-y' ),
			'php_vars'	=> array( 'image' => array('footer-bg_image', $image_defaults) ),
		),
		array(
			'type'		=> 'hex_color',
			'less_vars'	=> array( 'widget-footer-color' ),
			'php_vars'	=> array( 'color' => array('footer-primary_text_color', '#828282') )
		),
		array(
			'type'		=> 'hex_color',
			'less_vars'	=> array( 'widget-footer-header-color' ),
			'php_vars'	=> array( 'color' => array('footer-headers_color', '#ffffff') )
		),
		array(
			'type'		=> 'hex_color',
			'less_vars'	=> array( 'widget-footer-secondary-color' ),
			'php_vars'	=> array( 'color' => array('footer-secondary_text_color', '#d73b37') )
		),

		/* Header */

		// regular header
		array(
			'type' 		=> 'rgba_color',
			'less_vars' => array( 'header-bg-color', 'header-bg-color-ie' ),
			'php_vars'	=> array(
				'color' 	=> array('header-bg_color', '#40FF40'),
				'opacity'	=> array('header-bg_opacity', 80),
				'ie_color'	=> array('header-bg_ie_color', '#000000'),
			),
		),
		array(
			'type'		=> 'image',
			'less_vars'	=> array( 'header-bg-image', 'header-bg-repeat', 'header-bg-position-x', 'header-bg-position-y' ),
			'php_vars'	=> array( 'image' => array('header-bg_image', $image_defaults) ),
		),

		// overlap header
		array(
			'type' 		=> 'rgba_color',
			'less_vars' => array( 'header-overlap-bg-color', 'header-overlap-bg-color-ie' ),
			'php_vars'	=> array(
				'color' 	=> array('header_overlapped-bg_color', '#000000'),
				'opacity'	=> array('header_overlapped-bg_opacity', 100),
				'ie_color'	=> array('header_overlapped-bg_ie_color', '#8c8c8c'),
			),
		),
		array(
			'type'		=> 'image',
			'less_vars'	=> array( 'header-overlap-bg-image', 'header-overlap-bg-repeat', 'header-overlap-bg-position-x', 'header-overlap-bg-position-y' ),
			'php_vars'	=> array( 'image' => array('header_overlapped-bg_image', $image_defaults) ),
		),		

		array(
			'type'		=> 'hex_color',
			'less_vars'	=> array( 'navigation-info-color' ),
			'php_vars'	=> array( 'color' => array('header-contentarea_color', '#ffffff') )
		),

		array(
			'type'		=> 'number',
			'wrap'		=> array('', 'px'),
			'less_vars'	=> array('header-height'),
			'php_vars'	=> array( 'number' => array('header-bg_height', 90) ),
		),
		array(
			'type' 		=> 'rgba_color',
			'less_vars' => array( 'submenu-bg-color', 'submenu-bg-color-ie' ),
			'php_vars'	=> array(
				'color' 	=> array('header-submenu_bg_color', '#ffffff'),
				'opacity'	=> array('header-submenu_bg_opacity', 100),
				'ie_color'	=> array('header-submenu_bg_ie_color', '#ffffff', 'dt_stylesheet_color_hex2rgb'),
			),
		),
		array(
			'type'		=> 'hex_color',
			'less_vars'	=> array( 'submenu-color' ),
			'php_vars'	=> array( 'color' => array('header-submenu_color', '#3e3e3e') )
		),
		array(
			'type'		=> 'hex_color',
			'less_vars'	=> array( 'submenu-hover-color' ),
			'php_vars'	=> array( 'color' => array('header-submenu_hoover_color', '#d73b37') )
		),
		array(
			'type' 		=> 'rgba_color',
			'less_vars' => array( 'submenu-div-bg-color', 'submenu-div-bg-color-ie' ),
			'php_vars'	=> array(
				'color' 	=> array('header-submenu_dividers_color', '#222222'),
				'opacity'	=> array('header-submenu_dividers_opacity', 15),
				'ie_color'	=> array('header-submenu_dividers_ie_color', '#dedede'),
			),
		),
		array(
			'type'		=> 'font',
			'wrap'		=> array( '"', '"' . $font_family_falloff ),
			'less_vars'	=> array( 'menu-font-family', 'menu-font-weight', 'menu-font-style' ),
			'php_vars'	=> array( 'font' => array('header-font_family', $font_family_defaults) ),
		),
		array(
			'type'		=> 'number',
			'wrap'		=> array( '', 'px' ),
			'less_vars'	=> array( 'menu-font-size' ),
			'php_vars'	=> array( 'number' => array('header-font_size', 16) ),
		),
		array(
			'type'		=> 'number',
			'wrap'		=> array( '', 'px' ),
			'less_vars'	=> array( 'menu-line-height' ),
			'php_vars'	=> array( 'number' => array('header-font_line_height', 30) ),
		),
		array(
			'type'		=> 'hex_color',
			'less_vars'	=> array( 'menu-color' ),
			'php_vars'	=> array( 'color' => array('header-font_color', '#ffffff') )
		),
		array(
			'type'		=> 'rgb_color',
			'less_vars'	=> array( 'menu-hover-color' ),
			'php_vars'	=> array( 'color' => array('header-hoover_color', '#D7BEBE') )
		),
		array(
			'type' 		=> 'rgba_color',
			'less_vars' => array( 'menu-hover-bg-color', 'menu-hover-bg-color-ie' ),
			'php_vars'	=> array(
				'color' 	=> array('header-hoover_bg_color', '#D74340'),
				'opacity'	=> array('header-hoover_bg_opacity', 100),
				'ie_color'	=> array('header-hoover_bg_ie_color', '#D74340'),
			),
		),
		array(
			'type' 		=> 'rgba_color',
			'less_vars' => array( 'navigation-bg-color', 'navigation-bg-color-ie' ),
			'php_vars'	=> array(
				'color' 	=> array('header-menu_bg_color', '#000000'),
				'opacity'	=> array('header-menu_bg_opacity', 1),
				'ie_color'	=> array('header-menu_bg_ie_color', '#000000'),
			),
		),
		array(
			'type'		=> 'keyword',
			'interface'	=> array( '' => 'none', '1' => 'uppercase' ),
			'less_vars'	=> array( 'menu-text-transform' ),
			'php_vars'	=> array( 'keyword' => array('header-font_uppercase', 0) ),
		),

		/* General */

		// #page bg
		array(
			'type' 		=> 'rgba_color',
			'less_vars' => array( 'page-bg-color', 'page-bg-color-ie' ),
			'php_vars'	=> array(
				'color' 	=> array('general-bg_color', '#252525'),
				'opacity'	=> array('general-bg_opacity', 1),
				'ie_color'	=> array('general-bg_ie_color', '#252525'),
			),
		),
		array(
			'type'		=> 'image',
			'less_vars'	=> array( 'page-bg-image', 'page-bg-repeat', 'page-bg-position-x', 'page-bg-position-y' ),
			'php_vars'	=> array( 'image' => array('general-bg_image', $image_defaults) ),
		),

		array(
			'type'		=> 'keyword',
			'interface'	=> array( '' => 'auto', '1' => 'cover' ),
			'less_vars'	=> array( 'page-bg-size' ),
			'php_vars'	=> array( 'keyword' => array('general-bg_fullscreen', '0') ),
		),

		// body bg
		array(
			'type' 		=> 'hex_color',
			'less_vars' => array( 'body-bg-color' ),
			'php_vars'	=> array(
				'color' 	=> array('general-boxed_bg_color', '#252525'),
			),
		),
		array(
			'type'		=> 'image',
			'less_vars'	=> array( 'body-bg-image', 'body-bg-repeat', 'body-bg-position-x', 'body-bg-position-y' ),
			'php_vars'	=> array( 'image' => array('general-boxed_bg_image', $image_defaults) ),
		),
		array(
			'type'		=> 'keyword',
			'interface'	=> array( '' => 'auto', '1' => 'cover' ),
			'less_vars'	=> array( 'body-bg-size' ),
			'php_vars'	=> array( 'keyword' => array('general-boxed_bg_fullscreen', '0') ),
		),

		// accent
		array(
			'type'		=> 'hex_color',
			'less_vars'	=> array( 'accent-color' ),
			'php_vars'	=> array( 'color' => array('general-accent_text_color', '#ffffff') )
		),
		array(
			'type'		=> 'hex_color',
			'less_vars'	=> array( 'accent-bg-color' ),
			'php_vars'	=> array( 'color' => array('general-accent_bg_color', '#D73B37') )
		),

		// dividers
		// rest of declaration search at end of file
		array(
			'type'		=> 'keyword',
			'less_vars'	=> array( 'divider-thick-switch' ),
			'php_vars'	=> array( 'keyword' => array('general-thick_divider_style', 'style-1') ),
		),

		/* Rollover bg color */
		array(
			'type' 		=> 'rgba_color',
			'less_vars' => array( 'rollover-bg-color' ),
			'php_vars'	=> array(
				'color' 	=> array('hoover-color', '#000000'),
				'opacity'	=> array('hoover-opacity', 1),
			),
		),

		/* Slideshow */
		array(
			'type' 		=> 'rgba_color',
			'less_vars' => array( 'main-slideshow-bg-color', 'main-slideshow-bg-color-ie' ),
			'php_vars'	=> array(
				'color' 	=> array('slideshow-bg_color', '#d74340'),
				'opacity'	=> array('slideshow-bg_opacity', 1),
				'ie_color'	=> array('slideshow-bg_ie_color', '#d74340'),
			),
		),
		array(
			'type'		=> 'image',
			'less_vars'	=> array( 'main-slideshow-bg-image', 'main-slideshow-bg-repeat', 'main-slideshow-bg-position-x', 'main-slideshow-bg-position-y' ),
			'php_vars'	=> array( 'image' => array('slideshow-bg_image', $image_defaults) ),
		),

		array(
			'type'		=> 'keyword',
			'interface'	=> array( '' => 'auto', '1' => 'cover' ),
			'less_vars'	=> array( 'main-slideshow-bg-size' ),
			'php_vars'	=> array( 'keyword' => array('slideshow-bg_fullscreen', '0') ),
		),

	);

	/* Headers */

	foreach ( presscore_themeoptions_get_headers_defaults() as $id=>$opts ) {

		/* Fonts headers */
		
		$options_inteface[] = array(
			'type'		=> 'font',
			'wrap'		=> array('"', '"' . $font_family_falloff),
			'less_vars'	=> array( $id . '-font-family', $id . '-font-weight', $id . '-font-style' ),
			'php_vars'	=> array( 'font' => array('fonts-' . $id . '_font_family', $font_family_defaults) ),
		);

		$options_inteface[] = array(
			'type'		=> 'number',
			'wrap'		=> array('', 'px'),
			'less_vars'	=> array( $id . '-font-size' ),
			'php_vars'	=> array( 'number' => array('fonts-' . $id . '_font_size', $opts['fs']) ),
		);

		$options_inteface[] = array(
			'type'		=> 'number',
			'wrap'		=> array('', 'px'),
			'less_vars'	=> array( $id . '-line-height' ),
			'php_vars'	=> array( 'number' => array('fonts-' . $id . '_line_height', $opts['lh']) ),
		);

		$options_inteface[] = array(
			'type'		=> 'keyword',
			'interface'	=> array( '' => 'none', '1' => 'uppercase' ),
			'less_vars'	=> array( $id . '-text-transform' ),
			'php_vars'	=> array( 'keyword' => array('fonts-' . $id . '_uppercase', $opts['uc']) ),
		);

		/* Content Area */

		$options_inteface[] = array(
			'type'		=> 'hex_color',
			'less_vars'	=> array( $id . '-color' ),
			'php_vars'	=> array( 'color' => array('content-headers_color', '#252525') )
		);
	}

	/* Buttons */

	foreach ( presscore_themeoptions_get_buttons_defaults() as $id=>$opts ) {
		$options_inteface[] = array(
			'type'		=> 'font',
			'wrap'		=> array( '"', '"' . $font_family_falloff ),
			'less_vars'	=> array( 'dt-btn-' . $id . '-font-family', 'dt-btn-' . $id . '-font-weight', 'dt-btn-' . $id . '-font-style' ),
			'php_vars'	=> array( 'font' => array('buttons-' . $id . '_font_family', $font_family_defaults) ),
		);

		$options_inteface[] = array(
			'type'		=> 'number',
			'wrap'		=> array( '', 'px' ),
			'less_vars'	=> array( 'dt-btn-' . $id . '-font-size' ),
			'php_vars'	=> array( 'number' => array('buttons-' . $id . '_font_size', $opts['fs']) ),
		);

		$options_inteface[] = array(
			'type'		=> 'number',
			'wrap'		=> array( '', 'px' ),
			'less_vars'	=> array( 'dt-btn-' . $id . '-line-height' ),
			'php_vars'	=> array( 'number' => array('buttons-' . $id . '_line_height', $opts['lh']) ),
		);

		$options_inteface[] = array(
			'type'		=> 'keyword',
			'interface'	=> array( '' => 'none', '1' => 'uppercase' ),
			'less_vars'	=> array( 'dt-btn-' . $id . '-text-transform' ),
			'php_vars'	=> array( 'keyword' => array('buttons-' . $id . '_uppercase', $opts['uc']) ),
		);
	}

	/* Stripes */

	foreach ( presscore_themeoptions_get_stripes_list() as $id=>$opts ) {

		// bg color
		$options_inteface[] = array(
			'type' 		=> 'rgba_color',
			'less_vars' => array( 'strype-' . $id . '-bg-color', 'strype-' . $id . '-bg-color-ie' ),
			'php_vars'	=> array(
				'color' 	=> array('stripes-stripe_' . $id . '_color', $opts['bg_color']),
				'opacity'	=> array('stripes-stripe_' . $id . '_opacity', $opts['bg_opacity']),
				'ie_color'	=> array('stripes-stripe_' . $id . '_ie_color', $opts['bg_color_ie']),
			),
		);

		// bg image
		$options_inteface[] = array(
			'type'		=> 'image',
			'less_vars'	=> array(
				'strype-' . $id . '-bg-image',
				'strype-' . $id . '-bg-repeat',
				'',
				'strype-' . $id . '-bg-position-y'
				),
			'php_vars'	=> array( 'image' => array('stripes-stripe_' . $id . '_bg_image', $opts['bg_img']) ),
			'wrap'		=> array(
				'image' 		=> array( '~"', '"' ),
				'repeat' 		=> array( '~"', '"' ),
				'position_y'	=> array( '~"', '"' ),
			),
		);

		// fullscreen bg see in special cases
		$options_inteface[] = array(
			'type'		=> 'keyword',
			'interface'	=> array( '' => 'auto', '1' => 'cover' ),
			'less_vars'	=> array( 'strype-' . $id . '-bg-size' ),
			'php_vars'	=> array( 'keyword' => array('stripes-stripe_' . $id . '_bg_fullscreen', $opts['bg_fullscreen']) ),
		);

		// headers color
		$options_inteface[] = array(
			'type'		=> 'hex_color',
			'less_vars'	=> array( 'strype-' . $id . '-header-color' ),
			'php_vars'	=> array( 'color' => array('stripes-stripe_' . $id . '_headers_color', $opts['text_header_color']) ),
			'wrap'		=> array( '~"', '"' ),
		);

		// text color
		$options_inteface[] = array(
			'type'		=> 'hex_color',
			'less_vars'	=> array( 'strype-' . $id . '-color' ),
			'php_vars'	=> array( 'color' => array('stripes-stripe_' . $id . '_text_color', $opts['text_color']) ),
			'wrap'		=> array( '~"', '"' ),
		);

		// divider bg
		$options_inteface[] = array(
			'type' 		=> 'rgba_color',
			'less_vars' => array( 'strype-' . $id . '-divider-bg-color', 'strype-' . $id . '-divider-bg-color-ie' ),
			'php_vars'	=> array(
				'color' 	=> array('stripes-stripe_' . $id . '_div_color', $opts['div_color']),
				'opacity'	=> array('stripes-stripe_' . $id . '_div_opacity', $opts['div_opacity']),
				'ie_color'	=> array('stripes-stripe_' . $id . '_div_ie_color', $opts['div_color_ie']),
			),
		);

		// additional color
		$options_inteface[] = array(
			'type' 		=> 'rgba_color',
			'less_vars' => array( 'strype-' . $id . '-backgrounds-bg-color', 'strype-' . $id . '-backgrounds-bg-color-ie' ),
			'php_vars'	=> array(
				'color' 	=> array('stripes-stripe_' . $id . '_additional_bg_color', $opts['addit_color']),
				'opacity'	=> array('stripes-stripe_' . $id . '_additional_bg_opacity', $opts['addit_opacity']),
				'ie_color'	=> array('stripes-stripe_' . $id . '_additional_bg_ie_color', $opts['addit_color_ie']),
			),
		);

	}

	//----------------------------------------------------------------------------------------------------------------
	// Process options
	//----------------------------------------------------------------------------------------------------------------

	foreach( $options_inteface as $data ) {

		if ( empty($data) || empty($data['type']) || empty($data['less_vars']) || empty($data['php_vars']) ) continue;

		$type = $data['type'];
		$less_vars = $data['less_vars'];
		$php_vars = $data['php_vars'];
		$wrap = isset($data['wrap']) ? $data['wrap'] : false;
		$interface = isset($data['interface']) ? $data['interface'] : false;

		extract($php_vars);

		switch( $type ) {
			case 'rgba_color':
				
				if ( isset($ie_color, $less_vars[1]) ) {
					$ie_color = of_get_option($ie_color[0], $ie_color[1]);
				} else {
					$ie_color = false;
				}

				$color_option = of_get_option( $color[0], $color[1] );
				$opacity_option = of_get_option( $opacity[0], $opacity[1] );

				if ( !$color_option ) {
					$color_option = $color[1];
				}

				$computed_color = dt_stylesheet_make_ie_compat_rgba(
					$color_option,
					$ie_color,
					$opacity_option
				);

				$options[ current($less_vars) ] = $computed_color['rgba'];

				if ( $ie_color ) {

					if ( !empty($ie_color[2]) && function_exists($ie_color[2]) ) {
						$computed_color['ie_color'] = call_user_func( $ie_color[2], $computed_color['ie_color'] );
					}

					if ( empty($computed_color['ie_color']) ) {
						$computed_color['ie_color'] = '~"transparent"';
					}
					$options[ next($less_vars) ] = $computed_color['ie_color'];
				}

				break;
			case 'rgb_color':
				$color_option = of_get_option( $color[0], $color[1] );
				$computed_color = dt_stylesheet_color_hex2rgb( $color_option ? $color_option : $color[1] );
				
				if ( $computed_color && false !== $wrap ) {
					if ( is_array($wrap) ) {
						$computed_color = current($wrap) . $computed_color . next($wrap);
					} else {
						$computed_color = $wrap . $computed_color . $wrap;
					}
				}
				
				$options[ current($less_vars) ] = $computed_color;
				break;
			case 'hex_color':
				$computed_color = of_get_option( $color[0], $color[1] );

				if ( !$computed_color ) {
					$computed_color = $color[1];
				}

				$options[ current($less_vars) ] = $computed_color;
				break;
			case 'image':

				if ( !isset($image) ) break;

				$computed_image = of_get_option($image[0], $image[1]);

				$computed_image['image'] = dt_stylesheet_get_image($computed_image['image']);

				if ( false !== $wrap ) {

					if ( isset($wrap['image']) ) {
						$computed_image['image'] = current($wrap['image']) . $computed_image['image'] . next($wrap['image']);
					}

					if ( isset($wrap['repeat']) ) {
						$computed_image['repeat'] = current($wrap['repeat']) . $computed_image['repeat'] . next($wrap['repeat']);
					}

					if ( isset($wrap['position_x']) ) {
						$computed_image['position_x'] = current($wrap['position_x']) . $computed_image['position_x'] . next($wrap['position_x']);
					}

					if ( isset($wrap['position_y']) ) {
						$computed_image['position_y'] = current($wrap['position_y']) . $computed_image['position_y'] . next($wrap['position_y']);
					}

				}

				// image
				$computed_image['image'] = str_replace( content_url(), $relative_base, $computed_image['image'] );
				$options[ current($less_vars) ] = $computed_image['image'];

				// repeat
				if ( false != next($less_vars) && current($less_vars) ) {
					$options[ current($less_vars) ] = $computed_image['repeat'];
				}

				// position x
				if ( false != next($less_vars) && current($less_vars) ) {
					$options[ current($less_vars) ] = $computed_image['position_x'];
				}

				// position y
				if ( false != next($less_vars) && current($less_vars) ) {
					$options[ current($less_vars) ] = $computed_image['position_y'];
				}

				break;
			case 'number':

				if ( !isset($number) ) break;

				$computed_number = intval( of_get_option($number[0], $number[1]) );

				if ( false !== $wrap ) {
					if ( is_array($wrap) ) {
						$computed_number = current($wrap) . $computed_number . next($wrap);
					} else {
						$computed_number = $wrap . $computed_number . $wrap;
					}
				}

				$options[ current($less_vars) ] = $computed_number;

				break;
			case 'keyword':

				if ( !isset($keyword) ) break;

				$computed_keyword = (string) of_get_option($keyword[0], $keyword[1]);

				if ( false !== $interface && isset( $interface[ $computed_keyword ] ) ) {
					$computed_keyword = $interface[ $computed_keyword ];
				}

				$options[ current($less_vars) ] = $computed_keyword;

				break;
			case 'font':

				if ( !isset($font) ) break;

				$computed_font = dt_stylesheet_make_web_font_object( of_get_option($font[0]), $font[1] );

				if ( !$computed_font ) break;

				// TODO: refactor this
				if ( false !== $wrap ) {
					if ( is_array($wrap) ) {
						$computed_font->family = current($wrap) . $computed_font->family . next($wrap);
					} else {
						$computed_font->family = $wrap . $computed_font->family . $wrap;
					}
				}

				// font family
				$options[ current($less_vars) ] = $computed_font->family;

				// weight
				if ( false != next($less_vars) ) { $options[ current($less_vars) ] = $computed_font->weight; }

				// style
				if ( false != next($less_vars) ) { $options[ current($less_vars) ] = $computed_font->style; }

				break;
		}
	}

	/************************************************************************************************************/
	// Special cases
	/************************************************************************************************************/

	// General -> Background -> Fullscreen
	if ( 'cover' == $options['page-bg-size'] ) {
		$options['page-bg-repeat'] = 'no-repeat';
		$options['page-bg-attachment'] = 'fixed';
	}

	// General -> Layout -> Fullscreen
	if ( 'cover' == $options['body-bg-size'] ) {
		$options['body-bg-repeat'] = 'no-repeat';
		$options['body-bg-attachment'] = 'fixed';
	}

	/* General -> Dividers */
	
	// thick divider with breadcrumbs
	$thick_div_style = $options['divider-thick-switch'];
	$options['divider-thick-bread-switch'] = implode('-', current(array_chunk(explode('-',$thick_div_style ), 2)) );

	// thin divider
	switch ( of_get_option('general-thin_divider_style', 'style-1') ) {
		case 'style-1':
			$options['divider-thin-height'] = '1px';
			$options['divider-thin-style'] = 'solid';
			break;
		case 'style-2':
			$options['divider-thin-height'] = '2px';
			$options['divider-thin-style'] = 'solid';
			break;
		case 'style-3':
			$options['divider-thin-height'] = '1px';
			$options['divider-thin-style'] = 'dotted';
			break;
	}

	/* Stripes */

	// fullscreen
	foreach ( presscore_themeoptions_get_stripes_list() as $id=>$opts ) {

		if ( 'cover' == $options['strype-' . $id . '-bg-size'] ) {
			$options['strype-' . $id . '-bg-repeat'] = 'no-repeat';
			$options['strype-' . $id . '-bg-attachment'] = 'fixed';
		}

	}

	if ( empty($options['widget-sidebar-divider-bg-color']) ) {
		$options['widget-sidebar-divider-bg-color'] = '#777777';
	}

	return $options;
}

/**
 * Escape color for svg objects.
 */
function presscore_less_escape_color( $color = '' ) {
	return '~"' . implode( ',%20', array_map( 'urlencode', explode( ',', $color ) ) ) . '"';
}

/**
 * Escape function for lessphp.
 *
 */
function presscore_lessphp_escape( $value ) {
	$v = &$value[2][1][1];
	$v = rawurlencode( $v );
	return $value;
}

/**
 * Register escape function in lessphp.
 *
 */
function presscore_register_escape_function_for_lessphp() {
	if ( !class_exists('WPLessPlugin') || !function_exists('presscore_lessphp_escape') ) {
		return;
	}

	$less = WPLessPlugin::getInstance();
	$less->registerFunction('escape', 'presscore_lessphp_escape');
}
add_action( 'init', 'presscore_register_escape_function_for_lessphp', 16 );
