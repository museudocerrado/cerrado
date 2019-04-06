<?php
/**
 * Layout builder.
 *
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

// add shortcode button
$tinymce_button = new DT_ADD_MCE_BUTTON(
	'dt_mce_plugin_shortcode_layout_builder',
	basename(dirname(__FILE__)),
	array( 'dt_createColumn', 'dt_removeColumn', 'dt_lineBefore', 'dt_lineAfter', 'separator', 'separator' )
);

// TODO: delete in production

/*add_action( "init", create_function( '', 'new tinymce_layout_builder();' ) ) ;
class tinymce_layout_builder {

	function __construct() {
		add_filter( 'mce_external_plugins', array( &$this, 'add_tcustom_tinymce_plugin' ) );
		add_filter( 'mce_buttons_3', array(&$this, 'register_button' ) );
	}
	
	//include the tinymce javascript plugin
	function add_tcustom_tinymce_plugin( $plugin_array ) {
		$plugin_array['dt_mce_plugin_shortcode_layout_builder'] = PRESSCORE_SHORTCODES_URI . '/includes/layout-builder/plugin.js';		
		return $plugin_array;
	}

	//include the css file to style the graphic that replaces the shortcode
	function myformatTinyMCE( $in ) {
		$in['content_css'] .= "," . WP_PLUGIN_URL . '/tinymce-graphical-shortcode/tinymce-plugin/icitspots/editor-style.css';
		return $in;
	}

	// used to insert button in wordpress 2.5x editor
	function register_button( $buttons ) {
		array_unshift( $buttons, '', 'dt_createColumn', 'dt_removeColumn', 'dt_lineBefore', 'dt_lineAfter', 'separator', 'separator' );
		return $buttons;
	}

}*/
