<?php

/**
 * Plugin Name:       ImageLinks
 * Plugin URI:        http://avirtum.com
 * Description:       ImageLinks allows you to easily create an interactive image for your site that empowers publishers and bloggers to create more engaging content by adding rich media links to photos. Use this plugin to create interactive news photography, infographics, imagemaps, floormaps and shoppable product catalogs in minutes.
 * Version:           1.5.1
 * Author:            Avirtum
 * Author URI:        http://avirtum.com/
 * License:           GPLv3
 * Text Domain:       imagelinks
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if(!defined('WPINC')) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('IMAGELINKS_PLUGIN_NAME', 'imagelinks');
define('IMAGELINKS_PLUGIN_VERSION', '1.5.1');
define('IMAGELINKS_DB_VERSION', '1.0.0');
define('IMAGELINKS_SHORTCODE_NAME', 'imagelinks');

/**
 * The code that runs during plugin activation
 */
function imagelinks_activate() {
	require_once( plugin_dir_path( __FILE__ ) . 'includes/activator.php' );
	$activator = new ImageLinks_Activator();
	$activator->activate();
}
register_activation_hook( __FILE__, 'imagelinks_activate' );

/**
 * The code that runs during plugin deactivation
 */
function imagelinks_deactivate() {
	require_once( plugin_dir_path( __FILE__ ) . 'includes/deactivator.php' );
	$deactivator = new ImageLinks_Deactivator();
	$deactivator->deactivate();
}
register_deactivation_hook( __FILE__, 'imagelinks_deactivate' );

/**
 * The code that runs after plugins loaded
 */
function imagelinks_check_db() {
	require_once( plugin_dir_path( __FILE__ ) . 'includes/activator.php' );
	
	$activator = new ImageLinks_Activator();
	$activator->check_db();
}
add_action('plugins_loaded', 'imagelinks_check_db');


/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 */
require_once( plugin_dir_path( __FILE__ ) . 'includes/plugin.php' );


function imagelinks_run() {
	$pluginBasename = plugin_basename(__FILE__);
	
	$plugin = new ImageLinks_Builder($pluginBasename);
	$plugin->run();
}
add_action('init', 'imagelinks_run');