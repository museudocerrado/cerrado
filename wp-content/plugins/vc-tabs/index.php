<?php
/*
  Plugin Name: Tabs - Responsive Tabs with  Accordions
  Plugin URI: https://www.oxilab.org/
  Description: Tabs - Responsive Tabs with  Accordions is essayist way to awesome WordPress responsive Content Tabs Plugin with many features.
  Author: Biplob Adhikari
  Author URI: http://www.oxilab.org/
  Version: 2.6
 */
if (!defined('ABSPATH'))
    exit;

$content_tabs_ultimate_version = '2.6.1';
define('content_tabs_ultimate_plugin_url', plugin_dir_path(__FILE__));
define('Responsive_Tabs_with_Accordions_HOME', 'https://www.oxilab.org'); // you should use your own CONSTANT name, and be sure to replace it throughout this file
// the name of your product. This should match the download name in EDD exactly
define('Responsive_Tabs_with_Accordions', 'Responsive Tabs with Accordions'); // you should use your own CONSTANT name, and be sure to replace it throughout this file
// the name of the settings page for the license input to be displayed
define('Responsive_Tabs_with_Accordions_LICENSE_PAGE', 'content-tabs-ultimate-license');

add_shortcode('ctu_ultimate_oxi', 'ctu_ultimate_oxi_shortcode');
include content_tabs_ultimate_plugin_url . 'public.php';

function ctu_ultimate_oxi_shortcode($atts) {
    extract(shortcode_atts(array('id' => ' ',), $atts));
    $styleid = $atts['id'];
    ob_start();
    oxi_responsive_tabs_shortcode_function($styleid, 'user');
    return ob_get_clean();
}

add_action('vc_before_init', 'content_tabs_ultimate_VC_extension');
add_shortcode('ctu_ultimate_oxi_VC', 'ctu_ultimate_oxi_VC_shortcode');

function ctu_ultimate_oxi_VC_shortcode($atts) {
    extract(shortcode_atts(array(
        'id' => ''
                    ), $atts));
    $styleid = $atts['id'];
    ob_start();
    oxi_responsive_tabs_shortcode_function($styleid, 'user');
    return ob_get_clean();
}

function content_tabs_ultimate_VC_extension() {
    vc_map(array(
        "name" => __("Content Tabs"),
        "base" => "ctu_ultimate_oxi_VC",
        "category" => __("Content"),
        "params" => array(
            array(
                "type" => "textfield",
                "holder" => "div",
                "heading" => __("ID"),
                "param_name" => "id",
                "description" => __("Input your Tabs ID in input box")
            ),
        )
    ));
}

add_filter('widget_text', 'do_shortcode');
include content_tabs_ultimate_plugin_url . 'widget.php';
if (!function_exists('is_plugin_active')) {
    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}

function responsive_tabs_with_accordions_user_capabilities() {
    if (is_plugin_active('shortcode-addons/index.php')) {
        $user_role = get_option('oxi_addons_user');
    } else {
        $user_role = get_option('responsive_tabs_with_accordions_user_role_key');
    }
    $role_object = get_role($user_role);
    $first_key = '';
    if (isset($role_object->capabilities) && is_array($role_object->capabilities)) {
        reset($role_object->capabilities);
        $first_key = key($role_object->capabilities);
    } else {
        $first_key = 'manage_options';
    }
    if (!current_user_can($first_key)) {
        wp_die(__('You do not have sufficient permissions to access this page.'));
    }
    VcTabsAdminRenameData();
}

add_action('admin_menu', 'content_tabs_menu');

function content_tabs_menu() {
    if (is_plugin_active('shortcode-addons/index.php')) {
        $user_role = get_option('oxi_addons_user');
    } else {
        $user_role = get_option('responsive_tabs_with_accordions_user_role_key');
    }
    $role_object = get_role($user_role);
    $first_key = '';
    if (isset($role_object->capabilities) && is_array($role_object->capabilities)) {
        reset($role_object->capabilities);
        $first_key = key($role_object->capabilities);
    } else {
        $first_key = 'manage_options';
    }
    if (is_plugin_active('shortcode-addons/index.php')) {
        add_submenu_page('oxi-addons-import', 'Content Tabs', 'Content Tabs', $first_key, 'content-tabs-ultimate', 'content_tabs_ultimate_home');
        add_submenu_page('oxi-addons-import', 'New Tabs', 'New Tabs', $first_key, 'content-tabs-ultimate-new', 'content_tabs_ultimate_new');
        add_submenu_page('oxi-addons-import', 'Import Templates', 'Import Templates', $first_key, 'content-tabs-ultimate-import', 'content_tabs_ultimate_import');
        add_submenu_page('oxi-addons-import', 'Settings', 'Settings', 'manage_options', Responsive_Tabs_with_Accordions_LICENSE_PAGE, 'responsive_tabs_with_accordions_license_page');
        add_submenu_page('oxi-addons-import', 'Shortcode Addons', 'Shortcode Addons', $first_key, 'content-tabs-ultimate-addons', 'content_tabs_ultimate_addons');
    } else {
        add_menu_page('Content Tabs', 'Content Tabs', $first_key, 'content-tabs-ultimate', 'content_tabs_ultimate_home');
        add_submenu_page('content-tabs-ultimate', 'Content Tabs', 'Content Tabs', $first_key, 'content-tabs-ultimate', 'content_tabs_ultimate_home');
        add_submenu_page('content-tabs-ultimate', 'New Tabs', 'New Tabs', $first_key, 'content-tabs-ultimate-new', 'content_tabs_ultimate_new');
        add_submenu_page('content-tabs-ultimate', 'Settings', 'Settings', 'manage_options', Responsive_Tabs_with_Accordions_LICENSE_PAGE, 'responsive_tabs_with_accordions_license_page');
        add_submenu_page('content-tabs-ultimate', 'Import Templates', 'Import Templates', $first_key, 'content-tabs-ultimate-import', 'content_tabs_ultimate_import');
        add_submenu_page('content-tabs-ultimate', 'Shortcode Addons', 'Shortcode Addons', $first_key, 'content-tabs-ultimate-addons', 'content_tabs_ultimate_addons');
    }
}

function content_tabs_ultimate_home() {
    include content_tabs_ultimate_plugin_url . 'home.php';
    $jquery = 'jQuery(".iheu-admin-side-menu li:eq(0) a").addClass("active");';
    wp_add_inline_script('oxilab-bootstrap', $jquery);
}

function content_tabs_ultimate_new() {
    wp_enqueue_script('jQuery');
    wp_enqueue_style('oxilab-admin', plugins_url('js-css/admin.css', __FILE__));
    wp_enqueue_style('oxilab-bootstrap', plugins_url('js-css/bootstrap.min.css', __FILE__));
    wp_enqueue_style('oxi-tabs-style', plugins_url('public/style.css', __FILE__));
    $faversion = get_option('oxi_addons_font_awesome_version');
    $faversion = explode('||', $faversion);
    wp_enqueue_style('font-awesome-' . $faversion[0], $faversion[1]);
    wp_enqueue_script('oxilab-bootstrap', plugins_url('js-css/bootstrap.min.js', __FILE__));
    wp_enqueue_style('Open+Sans', 'https://fonts.googleapis.com/css?family=Open+Sans');
    if (!empty($_GET['styleid']) && is_numeric($_GET['styleid'])) {
        $id = $_GET['styleid'];
        global $wpdb;
        $table_name = $wpdb->prefix . 'content_tabs_ultimate_style';
        $styledata = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d ", $id), ARRAY_A);
        wp_enqueue_script('oxilab-font-select', plugins_url('js-css/font-select.js', __FILE__));
        wp_enqueue_script('oxilab-color', plugins_url('js-css/minicolors.js', __FILE__));
        wp_enqueue_script('oxilab-drag', plugins_url('js-css/drag.js', __FILE__));
        include content_tabs_ultimate_plugin_url . 'admin/' . $styledata['style_name'] . '.php';
        wp_enqueue_style('oxilab-color', plugins_url('js-css/minicolors.css', __FILE__));
        content_tabs_ultimate_admin_drag_drop();
        add_action('wp_print_scripts', 'content_tabs_ultimate_admin_drag_drop');
        wp_enqueue_script('YouTubePopUps', plugins_url('js-css/YouTubePopUps.js', __FILE__));
        $jquery = 'setTimeout(function () {
                                        jQuery(".oxi-addons-tutorials").grtyoutube({autoPlay: true, theme: "light"});
                                    }, 500);';
        wp_add_inline_script('YouTubePopUps', $jquery);
    } else {
        include content_tabs_ultimate_plugin_url . 'layouts/index.php';
    }
    $jquery = 'jQuery(".iheu-admin-side-menu li:eq(1) a").addClass("active");';
    wp_add_inline_script('oxilab-bootstrap', $jquery);
}

function content_tabs_ultimate_admin_drag_drop() {
    wp_enqueue_script('content_tabs_ultimate-drap-drop', plugins_url('js-css/content_tabs_ultimate-drag.js', __FILE__));
    wp_localize_script('content_tabs_ultimate-drap-drop', 'content_tabs_ultimate_drag_drop_ajax', array('ajaxurl' => admin_url('admin-ajax.php')));
}

function content_tabs_ultimate_admin_ajax_data() {
    check_ajax_referer('vc_tabs_ajax_data', 'security');
    $list_order = sanitize_text_field($_POST['list_order']);
    $list = explode(',', $list_order);
    global $wpdb;
    $table_list = $wpdb->prefix . 'content_tabs_ultimate_list';
    foreach ($list as $value) {
        $data = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_list WHERE id = %d ", $value), ARRAY_A);
        $wpdb->query($wpdb->prepare("INSERT INTO {$table_list} (styleid, title, files, css) VALUES (%d, %s, %s, %s)", array($data['styleid'], $data['title'], $data['files'], $data['css'])));
        $redirect_id = $wpdb->insert_id;
        if ($redirect_id == 0) {
            wp_die();
        }
        if ($redirect_id != 0) {
            $wpdb->query($wpdb->prepare("DELETE FROM $table_list WHERE id = %d", $value));
        }
    }
    wp_die();
}

add_action('wp_ajax_content_tabs_ultimate_admin_ajax_data', 'content_tabs_ultimate_admin_ajax_data');

function content_tabs_ultimate_import() {
    wp_enqueue_style('oxilab-admin', plugins_url('js-css/admin.css', __FILE__));
    wp_enqueue_style('oxilab-bootstrap', plugins_url('js-css/bootstrap.min.css', __FILE__));
    wp_enqueue_style('oxi-tabs-show', plugins_url('public/style.css', __FILE__));
    $faversion = get_option('oxi_addons_font_awesome_version');
    $faversion = explode('||', $faversion);
    wp_enqueue_style('font-awesome-' . $faversion[0], $faversion[1]);
    wp_enqueue_style('Open+Sans', 'https://fonts.googleapis.com/css?family=Open+Sans');
    wp_enqueue_script('jQuery');
    wp_enqueue_script('oxilab-bootstrap', plugins_url('js-css/bootstrap.min.js', __FILE__));
    include content_tabs_ultimate_plugin_url . 'layouts/import-style.php';
    $jquery = 'jQuery(".iheu-admin-side-menu li:eq(2) a").addClass("active");';
    wp_add_inline_script('oxilab-bootstrap', $jquery);
}

function content_tabs_ultimate_addons() {
    wp_enqueue_style('oxilab-admin', plugins_url('js-css/admin.css', __FILE__));
    wp_enqueue_style('oxilab-bootstrap', plugins_url('js-css/bootstrap.min.css', __FILE__));
    wp_enqueue_style('oxilab-font-awesome', plugins_url('js-css/font-awesome.min.css', __FILE__));
    wp_enqueue_script('oxilab-bootstrap', plugins_url('js-css/bootstrap.min.js', __FILE__));
    wp_enqueue_style('Open+Sans', 'https://fonts.googleapis.com/css?family=Open+Sans');
    include content_tabs_ultimate_plugin_url . 'admin/shortcode-addons.php';
}

function content_tabs_custom_post_type_icon() {
    ?>
    <style type='text/css' media='screen'>
        #adminmenu #toplevel_page_content-tabs-ultimate  div.wp-menu-image:before {
            content: "\f163";
        }
    </style>
    <?php
}

add_action('admin_head', 'content_tabs_custom_post_type_icon');

register_activation_hook(__FILE__, 'content_tabs_ultimate_install');

function ctu_html_special_charecter($data) {
    $data = html_entity_decode($data);
    $data = str_replace("\'", "'", $data);
    $data = str_replace('\"', '"', $data);
    $data = do_shortcode($data, $ignore_html = false);
    return $data;
}

function ctu_admin_special_charecter($data) {
    $data = html_entity_decode($data);
    $data = str_replace("\'", "'", $data);
    $data = str_replace('\"', '"', $data);
    return $data;
}

function ctu_icon_font_selector($data) {
    $icon = explode(' ', $data);
    $fadata = get_option('oxi_addons_font_awesome');
    $faversion = get_option('oxi_addons_font_awesome_version');
    $faversion = explode('||', $faversion);
    if ($fadata == 'yes') {
        wp_enqueue_style('font-awesome-' . $faversion[0], $faversion[1]);
    }
    $files = '<i class="' . $data . ' oxi-icons"></i>';
    return $files;
}

function ctu_font_familly_special_charecter($data) {
    wp_enqueue_style('' . $data . '', 'https://fonts.googleapis.com/css?family=' . $data . '');
    $data = str_replace('+', ' ', $data);
    $data = explode(':', $data);
    $data = $data[0];
    $data = '"' . $data . '"';
    return $data;
}

function ctu_admin_style_layouts($styledata, $listdata) {
    include_once content_tabs_ultimate_plugin_url . 'public/' . $styledata['style_name'] . '.php';
    wp_enqueue_style('oxi-responsive-tabs', plugins_url('public/style.css', __FILE__));
    $stylefunctionmane = 'oxi_responsive_tabs_shortcode_function_' . $styledata['style_name'] . '';
    $stylefunctionmane($styledata['id'], 'user', explode('|', $styledata['css']), $listdata);
}

function content_tabs_ultimate_install() {
    global $wpdb;
    global $content_tabs_ultimate_version;
    $headersize = 0;
    $fawesome = '5.3.1||https://use.fontawesome.com/releases/v5.3.1/css/all.css';
    $table_name = $wpdb->prefix . 'content_tabs_ultimate_style';
    $table_list = $wpdb->prefix . 'content_tabs_ultimate_list';
    $table_import = $wpdb->prefix . 'content_tabs_ultimate_import';

    $charset_collate = $wpdb->get_charset_collate();
    $sql1 = "CREATE TABLE $table_name (
		id mediumint(5) NOT NULL AUTO_INCREMENT,
                name varchar(50) NOT NULL,
		style_name varchar(10) NOT NULL,
                css text NOT NULL,
		PRIMARY KEY  (id)
	) $charset_collate;";
    $sql2 = "CREATE TABLE $table_list (
		id mediumint(5) NOT NULL AUTO_INCREMENT,
                styleid mediumint(6) NOT NULL,
		title text,
                files text,
                css varchar(100),
		PRIMARY KEY  (id)
	) $charset_collate;";
    $sql3 = "CREATE TABLE $table_import (
		id mediumint(5) NOT NULL AUTO_INCREMENT,
		name mediumint(5) NOT NULL,                
		PRIMARY KEY  (id),
                UNIQUE name (name)
	) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta($sql1);
    dbDelta($sql2);
    dbDelta($sql3);
    add_option('content_tabs_ultimate_version', $content_tabs_ultimate_version);
    add_option('oxi_addons_font_awesome_version', $fawesome);
    add_option('oxi_addons_fixed_header_size', $headersize);
    $wpdb->query("INSERT INTO {$table_import} (name) VALUES
        (1),
        (2),
        (3),
        (4),
        (5)");

    set_transient('_Oxi_responsive_tabs_welcome_activation_redirect', true, 30);
}

add_action('admin_init', 'Oxi_responsive_tabs_welcome_activation_redirect');

function Oxi_responsive_tabs_welcome_activation_redirect() {
    if (!get_transient('_Oxi_responsive_tabs_welcome_activation_redirect')) {
        return;
    }
    delete_transient('_Oxi_responsive_tabs_welcome_activation_redirect');
    if (is_network_admin() || isset($_GET['activate-multi'])) {
        return;
    }
    wp_safe_redirect(add_query_arg(array('page' => 'oxi-responsive-tabs-welcome'), admin_url('index.php')));
}

add_action('admin_menu', 'Oxi_responsive_tabs_welcome_pages');

function Oxi_responsive_tabs_welcome_pages() {
    add_dashboard_page(
            'Welcome To Responsive Tabs with  Accordions', 'Welcome To Responsive Tabs with  Accordions', 'read', 'oxi-responsive-tabs-welcome', 'oxi_responsive_tabs_welcome'
    );
}

function oxi_responsive_tabs_welcome() {
    wp_enqueue_style('oxi-responsive-tabs-welcome', plugins_url('js-css/admin-welcome.css', __FILE__));
    ?>
    <div class="wrap about-wrap">

        <h1>Welcome to Responsive Tabs with  Accordions</h1>
        <div class="about-text">
            Thank you for choosing Responsive Tabs with  Accordions - the most friendly WordPress Tabs and Accordions  Plugins. Here's how to get started.
        </div>
        <h2 class="nav-tab-wrapper">
            <a class="nav-tab nav-tab-active">
                Getting Started		
            </a>
        </h2>
        <p class="about-description">
            Use the tips below to get started using Responsive Tabs with  Accordions. You will be up and running in no time.	
        </p>    
        <div class="feature-section">
            <h3>Creating Your Tabs</h3>
            <p>Responsive Tabs with  Accordions makes it easy to create Jquery Tabs in WordPress. You can follow the video tutorial on the right or read our how to 
                <a href="https://www.oxilab.org/docs/responsive-tabs-with-accordions/getting-started/" target="_blank" rel="noopener">Create your Tabs guide</a>.					</p>
            <p>But in reality, the process is so intuitive that you can just start by going to <a href="<?php echo admin_url(); ?>admin.php?page=content-tabs-ultimate-new">New Tabs</a>.				</p>
            </br>
            </br>
            <iframe width="560" height="315" src="https://www.youtube.com/embed/-42zCmS2p6c" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe>
        </div>
        <div class="feature-section">
            <h3>See all Responsive Tabs with  Accordions Features</h3>
            <p>Responsive Tabs with  Accordions is both easy to use and extremely powerful. We have tons of helpful features that allows us to give you everything you need on Tabs.</p>
            <p>1. Awesome Live Preview Panel</p>
            <p>1. Can Customize with Our Settings</p>
            <p>1. Easy to USE & Builtin Integration for popular Page Builder</p>
            <p><a href="https://www.oxilab.org/downloads/responsive-tabs-with-accordions/" target="_blank" rel="noopener" class="iheu-image-features-button button button-primary">See all Features</a></p>

        </div>
        <div class="feature-section">
            <h3>Have any Bugs or Suggestion</h3>
            <p>Your suggestions will make this plugin even better, Even if you get any bugs on Image Hover Effects with Carousel so let us to know, We will try to solved within few hours</p>
            <p><a href="https://www.oxilab.org/contact-us" target="_blank" rel="noopener" class="image-features-button button button-primary">Contact Us</a>
                <a href="https://wordpress.org/support/plugin/vc-tabs" target="_blank" rel="noopener" class="image-features-button button button-primary">Support Forum</a></p>

        </div>

    </div>
    <?php
}

add_action('admin_head', 'oxi_responsive_tabs_welcome_remove_menus');

function oxi_responsive_tabs_welcome_remove_menus() {
    remove_submenu_page('index.php', 'oxi-responsive-tabs-welcome');
}

$saved_role = get_option('oxi_addons_fixed_header_size');
if (empty($saved_role)) {
    $saved_role = 120;
    add_option('oxi_addons_fixed_header_size', $saved_role);
}
// load our custom updater
include( dirname(__FILE__) . '/Plugin_Updater.php' );

function responsive_tabs_with_accordions_plugin_updater() {
    $license_key = trim(get_option('responsive_tabs_with_accordions_license_key'));
    // retrieve our license key from the DB
    // setup the updater
    $responsive_tabs_with_accordions_updater = new Responsive_Tabs_with_Accordions_Plugin_Updater(Responsive_Tabs_with_Accordions_HOME, __FILE__, array(
        'version' => '2.6.1', // current version number
        'license' => $license_key, // license key (used get_option above to retrieve from DB)
        'item_name' => Responsive_Tabs_with_Accordions, // name of this plugin
        'author' => 'Biplob Adhikari', // author of this plugin
        'beta' => false
            )
    );
}

$license_key = trim(get_option('responsive_tabs_with_accordions_license_key'));
if (!empty($license_key)) {
    add_action('admin_init', 'responsive_tabs_with_accordions_plugin_updater', 0);
}

/* * **********************************
 * the code below is just a standard
 * options page. Substitute with
 * your own.
 * *********************************** */

function responsive_tabs_with_accordions_license_page() {
    $license = get_option('responsive_tabs_with_accordions_license_key');
    $status = get_option('responsive_tabs_with_accordions_license_status');
    global $wp_roles;
    $roles = $wp_roles->get_names();
    $saved_role = get_option('oxi_addons_user_permission');
    $fontawvr = get_option('oxi_addons_font_awesome_version');
    $fontawesomevr = array(
        array('name' => '5.5.0', 'url' => '5.5.0||https://use.fontawesome.com/releases/v5.3.1/css/all.css'),
        array('name' => '5.4.1', 'url' => '5.4.1||https://use.fontawesome.com/releases/v5.3.1/css/all.css'),
        array('name' => '5.3.1', 'url' => '5.3.1||https://use.fontawesome.com/releases/v5.3.1/css/all.css'),
        array('name' => '5.2.0', 'url' => '5.2.0||https://use.fontawesome.com/releases/v5.2.0/css/all.css'),
        array('name' => '5.1.1', 'url' => '5.1.1||https://use.fontawesome.com/releases/v5.1.1/css/all.css'),
        array('name' => '5.1.0', 'url' => '5.1.0||https://use.fontawesome.com/releases/v5.1.0/css/all.css'),
        array('name' => '5.0.13', 'url' => '5.0.13||https://use.fontawesome.com/releases/v5.0.13/css/all.css'),
        array('name' => '5.0.12', 'url' => '5.0.12||https://use.fontawesome.com/releases/v5.0.12/css/all.css'),
        array('name' => '5.0.10', 'url' => '5.0.10||https://use.fontawesome.com/releases/v5.0.10/css/all.css'),
        array('name' => '5.0.9', 'url' => '5.0.9||https://use.fontawesome.com/releases/v5.0.9/css/all.css'),
        array('name' => '5.0.8', 'url' => '5.0.8||https://use.fontawesome.com/releases/v5.0.8/css/all.css'),
        array('name' => '5.0.6', 'url' => '5.0.6||https://use.fontawesome.com/releases/v5.0.6/css/all.css'),
        array('name' => '5.0.4', 'url' => '5.0.4||https://use.fontawesome.com/releases/v5.0.4/css/all.css'),
        array('name' => '4.7.0', 'url' => '4.7.0||https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css'),
    );
    $oxi_fixed_header = get_option('oxi_addons_fixed_header_size');
    if (empty($oxi_fixed_header)) {
        update_option('oxi_addons_fixed_header_size', 0);
    }
    ?>
    <div class="wrap">       
        <h2><?php _e('User Settings'); ?></h2>
        <p>Settings for Responsive Tabs with Accordions.</p>
        <form method="post" action="options.php">
            <table class="form-table">
                <?php settings_fields('oxi-addons-vc-tabs-settings-group'); ?>
                <?php do_settings_sections('oxi-addons-vc-tabs-settings-group'); ?>
                <tbody>
                    <tr valign="top">
                        <td scope="row">Who Can Edit?</td>
                        <td>
                            <select name="oxi_addons_user_permission">
                                <?php foreach ($roles as $key => $role) { ?>
                                    <option value="<?php echo $key; ?>" <?php selected($saved_role, $key); ?>><?php echo $role; ?></option>
                                <?php } ?>
                            </select>
                        </td>
                        <td>
                            <label class="description" for="oxi_addons_user_permission"><?php _e('Select the Role who can manage This Plugins.'); ?> <a target="_blank" href="https://codex.wordpress.org/Roles_and_Capabilities#Capability_vs._Role_Table">Help</a></label>
                        </td>
                    </tr>                        
                    <tr valign="top">
                        <td scope="row">Font Awesome Support</td>
                        <td>
                            <input type="radio" name="oxi_addons_font_awesome" value="yes" <?php checked('yes', get_option('oxi_addons_font_awesome'), true); ?>>YES
                            <input type="radio" name="oxi_addons_font_awesome" value="" <?php checked('', get_option('oxi_addons_font_awesome'), true); ?>>No
                        </td>
                        <td>
                            <label class="description" for="oxi_addons_font_awesome"><?php _e('Load Font Awesome CSS at shortcode loading, If your theme already loaded select No for faster loading'); ?></label>
                        </td>
                    </tr> 
                    <tr valign="top">
                        <td scope="row">Font Awesome Version?</td>
                        <td>
                            <select name="oxi_addons_font_awesome_version">
                                <?php foreach ($fontawesomevr as $value) { ?>
                                    <option value="<?php echo $value['url']; ?>" <?php selected($fontawvr, $value['url']); ?>><?php echo $value['name']; ?></option>
                                <?php } ?>
                            </select>
                        </td>
                        <td>
                            <label class="description" for="oxi_addons_font_awesome_version"><?php _e('Select Your Font Awesome version, Which are using into your sites so Its will not conflict your Icons'); ?></label>
                        </td>
                    </tr>  
                    <tr valign="top">
                        <td scope="row">Fixed Header Size</td>
                        <td>
                            <input type="number" class="widefat" name="oxi_addons_fixed_header_size" value="<?php echo esc_attr(get_option('oxi_addons_fixed_header_size')); ?>" />
                        </td>
                        <td>                           
                            <label class="description" for="oxi_addons_fixed_header_size"><?php _e('Set Fixed Header Size for Responsive Tabs with Accordions.'); ?></label>
                        </td>
                    </tr>

                </tbody>
            </table>
            <?php submit_button(); ?>
        </form>
        <br>
        <br>
        <br>
        <br>
        <h2><?php _e('Product License Activation'); ?></h2>
        <p>Activate your copy to get direct plugin updates and official support.</p>
        <form method="post" action="options.php">

            <?php settings_fields('responsive_tabs_with_accordions_license'); ?>

            <table class="form-table">
                <tbody>
                    <tr valign="top">
                        <th scope="row" valign="top">
                            <?php _e('License Key'); ?>
                        </th>
                        <td>
                            <input id="responsive_tabs_with_accordions_license_key" name="responsive_tabs_with_accordions_license_key" type="text" class="regular-text" value="<?php esc_attr_e($license); ?>" />
                            <label class="description" for="responsive_tabs_with_accordions_license_key"><?php _e('Enter your license key'); ?></label>
                        </td>
                    </tr>
                    <?php if (!empty($license)) { ?>
                        <tr valign="top">
                            <th scope="row" valign="top">
                                <?php _e('Activate License'); ?>
                            </th>
                            <td>
                                <?php if ($status !== false && $status == 'valid') { ?>
                                    <span style="color:green;"><?php _e('active'); ?></span>
                                    <?php wp_nonce_field('responsive_tabs_with_accordions_nonce', 'responsive_tabs_with_accordions_nonce'); ?>
                                    <input type="submit" class="button-secondary" name="responsive_tabs_with_accordions_license_deactivate" value="<?php _e('Deactivate License'); ?>"/>
                                    <?php
                                } else {
                                    wp_nonce_field('responsive_tabs_with_accordions_nonce', 'responsive_tabs_with_accordions_nonce');
                                    ?>
                                    <input type="submit" class="button-secondary" name="responsive_tabs_with_accordions_license_activate" value="<?php _e('Activate License'); ?>"/>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?php submit_button(); ?>
        </form>
        <?php
    }

    function oxi_addons_plugin_vc_tabs_settings() {
        //register our settings
        register_setting('oxi-addons-vc-tabs-settings-group', 'oxi_addons_user_permission');
        register_setting('oxi-addons-vc-tabs-settings-group', 'oxi_addons_font_awesome');
        register_setting('oxi-addons-vc-tabs-settings-group', 'oxi_addons_font_awesome_version');
        register_setting('oxi-addons-vc-tabs-settings-group', 'oxi_addons_fixed_header_size');
    }

    add_action('admin_init', 'oxi_addons_plugin_vc_tabs_settings');

    function responsive_tabs_with_accordions_register_option() {
        // creates our settings in the options table
        register_setting('responsive_tabs_with_accordions_license', 'responsive_tabs_with_accordions_license_key', 'responsive_tabs_with_accordions_sanitize_license');
    }

    add_action('admin_init', 'responsive_tabs_with_accordions_register_option');

    function responsive_tabs_with_accordions_sanitize_license($new) {
        $old = get_option('responsive_tabs_with_accordions_license_key');
        if ($old && $old != $new) {
            delete_option('responsive_tabs_with_accordions_license_status'); // new license has been entered, so must reactivate
        }
        return $new;
    }

    /*     * **********************************
     * this illustrates how to activate
     * a license key
     * *********************************** */

    function responsive_tabs_with_accordions_activate_license() {

        // listen for our activate button to be clicked
        if (isset($_POST['responsive_tabs_with_accordions_license_activate'])) {

            // run a quick security check
            if (!check_admin_referer('responsive_tabs_with_accordions_nonce', 'responsive_tabs_with_accordions_nonce'))
                return; // get out if we didn't click the Activate button
// retrieve the license from the database
            $license = trim(get_option('responsive_tabs_with_accordions_license_key'));


            // data to send in our API request
            $api_params = array(
                'edd_action' => 'activate_license',
                'license' => $license,
                'item_name' => urlencode(Responsive_Tabs_with_Accordions), // the name of our product in EDD
                'url' => home_url()
            );

            // Call the custom API.
            $response = wp_remote_post(Responsive_Tabs_with_Accordions_HOME, array('timeout' => 15, 'sslverify' => false, 'body' => $api_params));

            // make sure the response came back okay
            if (is_wp_error($response) || 200 !== wp_remote_retrieve_response_code($response)) {

                if (is_wp_error($response)) {
                    $message = $response->get_error_message();
                } else {
                    $message = __('An error occurred, please try again.');
                }
            } else {

                $license_data = json_decode(wp_remote_retrieve_body($response));

                if (false === $license_data->success) {

                    switch ($license_data->error) {

                        case 'expired' :

                            $message = sprintf(
                                    __('Your license key expired on %s.'), date_i18n(get_option('date_format'), strtotime($license_data->expires, current_time('timestamp')))
                            );
                            break;

                        case 'revoked' :

                            $message = __('Your license key has been disabled.');
                            break;

                        case 'missing' :

                            $message = __('Invalid license.');
                            break;

                        case 'invalid' :
                        case 'site_inactive' :

                            $message = __('Your license is not active for this URL.');
                            break;

                        case 'item_name_mismatch' :

                            $message = sprintf(__('This appears to be an invalid license key for %s.'), Responsive_Tabs_with_Accordions);
                            break;

                        case 'no_activations_left':

                            $message = __('Your license key has reached its activation limit.');
                            break;

                        default :

                            $message = __('An error occurred, please try again.');
                            break;
                    }
                }
            }

            // Check if anything passed on a message constituting a failure
            if (!empty($message)) {
                $base_url = admin_url('admin.php?page=' . Responsive_Tabs_with_Accordions_LICENSE_PAGE);
                $redirect = add_query_arg(array('sl_activation' => 'false', 'message' => urlencode($message)), $base_url);

                wp_redirect($redirect);
                exit();
            }

            // $license_data->license will be either "valid" or "invalid"

            update_option('responsive_tabs_with_accordions_license_status', $license_data->license);
            wp_redirect(admin_url('admin.php?page=' . Responsive_Tabs_with_Accordions_LICENSE_PAGE));
            exit();
        }
    }

    add_action('admin_init', 'responsive_tabs_with_accordions_activate_license');


    /*     * *********************************************
     * Illustrates how to deactivate a license key.
     * This will decrease the site count
     * ********************************************* */

    function responsive_tabs_with_accordions_deactivate_license() {

        // listen for our activate button to be clicked
        if (isset($_POST['responsive_tabs_with_accordions_license_deactivate'])) {

            // run a quick security check
            if (!check_admin_referer('responsive_tabs_with_accordions_nonce', 'responsive_tabs_with_accordions_nonce'))
                return; // get out if we didn't click the Activate button
// retrieve the license from the database
            $license = trim(get_option('responsive_tabs_with_accordions_license_key'));


            // data to send in our API request
            $api_params = array(
                'edd_action' => 'deactivate_license',
                'license' => $license,
                'item_name' => urlencode(Responsive_Tabs_with_Accordions), // the name of our product in EDD
                'url' => home_url()
            );

            // Call the custom API.
            $response = wp_remote_post(Responsive_Tabs_with_Accordions_HOME, array('timeout' => 15, 'sslverify' => false, 'body' => $api_params));

            // make sure the response came back okay
            if (is_wp_error($response) || 200 !== wp_remote_retrieve_response_code($response)) {

                if (is_wp_error($response)) {
                    $message = $response->get_error_message();
                } else {
                    $message = __('An error occurred, please try again.');
                }

                $base_url = admin_url('admin.php?page=' . Responsive_Tabs_with_Accordions_LICENSE_PAGE);
                $redirect = add_query_arg(array('sl_activation' => 'false', 'message' => urlencode($message)), $base_url);

                wp_redirect($redirect);
                exit();
            }

            // decode the license data
            $license_data = json_decode(wp_remote_retrieve_body($response));

            // $license_data->license will be either "deactivated" or "failed"
            if ($license_data->license == 'deactivated') {
                delete_option('responsive_tabs_with_accordions_license_status');
            }

            wp_redirect(admin_url('admin.php?page=' . Responsive_Tabs_with_Accordions_LICENSE_PAGE));
            exit();
        }
    }

    add_action('admin_init', 'responsive_tabs_with_accordions_deactivate_license');


    /*     * **********************************
     * this illustrates how to check if
     * a license key is still valid
     * the updater does this for you,
     * so this is only needed if you
     * want to do something custom
     * *********************************** */

    function responsive_tabs_with_accordions_check_license() {

        global $wp_version;

        $license = trim(get_option('responsive_tabs_with_accordions_license_key'));

        $api_params = array(
            'edd_action' => 'check_license',
            'license' => $license,
            'item_name' => urlencode(Responsive_Tabs_with_Accordions),
            'url' => home_url()
        );

        // Call the custom API.
        $response = wp_remote_post(Responsive_Tabs_with_Accordions_HOME, array('timeout' => 15, 'sslverify' => false, 'body' => $api_params));

        if (is_wp_error($response))
            return false;

        $license_data = json_decode(wp_remote_retrieve_body($response));

        if ($license_data->license == 'valid') {
            echo 'valid';
            exit;
            // this license is still valid
        } else {
            echo 'invalid';
            exit;
            // this license is no longer valid
        }
    }

    /**
     * This is a means of catching errors from the activation method above and displaying it to the customer
     */
    function responsive_tabs_with_accordions_admin_notices() {
        if (isset($_GET['sl_activation']) && !empty($_GET['message'])) {

            switch ($_GET['sl_activation']) {

                case 'false':
                    $message = urldecode($_GET['message']);
                    ?>
                    <div class="error">
                        <p><?php echo $message; ?></p>
                    </div>
                    <?php
                    break;

                case 'true':
                default:
                    // Developers can put a custom success message here for when activation is successful if they way.
                    break;
            }
        }
    }

    add_action('admin_notices', 'responsive_tabs_with_accordions_admin_notices');

    function responsive_tabs_with_accordions_video_toturial() {
        $status = get_option('responsive_tabs_with_accordions_license_status');

        if ($status != 'valid') {
            $jquery = 'jQuery(".oxilab-vendor-color").each(function (index, value) {
                            var dataid = jQuery(this).attr("id");
                            jQuery("." + dataid).append(" <span class=\"oxi-pro-only\">Pro</span>");
                        });
                        jQuery(".oxi-admin-font").each(function (index, value) {
                            var dataid = jQuery(this).attr("id");
                            jQuery("." + dataid).append(" <span class=\"oxi-pro-only\">Pro</span>");
                        });
                        jQuery("#custom-css").each(function (index, value) {
                            var dataid = jQuery(this).attr("id");
                            jQuery("." + dataid).append(" <span class=\"oxi-pro-only\">Pro</span>");
                        });
                        jQuery("#oxi-style-submit").submit(function () {
                            jQuery(".oxilab-vendor-color").each(function (index, value) {
                                var datavalue = jQuery(this).attr("oxivalue");
                                jQuery(this).val(datavalue);
                            });
                            jQuery(".oxi-admin-font").each(function (index, value) {
                                var datavalue = jQuery(this).attr("oxivalue");
                                jQuery(this).val(datavalue);
                            });
                            jQuery("#custom-css").each(function (index, value) {
                                jQuery(this).val("");
                            });
                        });';
            //wp_add_inline_script('oxilab-font-select', $jquery);
        }
        ?>
        <div class="ihewc-admin-style-settings-div-css">
            <div class="col-xs-12">                                           
                <a href="https://www.oxilab.org/docs/responsive-tabs-with-accordions/getting-started/" target="_blank">
                    <div class="col-xs-support-ihewc">
                        <div class="ihewc-admin-support-icon">
                            <i class="fas fa-file" aria-hidden="true"></i>
                        </div>  
                        <div class="ihewc-admin-support-heading">
                            Read Our Docs
                        </div> 
                        <div class="ihewc-admin-support-info">
                            Learn how to set up and using Responsive Tabs with Accordions
                        </div> 
                    </div>
                </a>
                <a href="https://wordpress.org/support/plugin/vc-tabs" target="_blank">
                    <div class="col-xs-support-ihewc">
                        <div class="ihewc-admin-support-icon">
                            <i class="fas fa-users" aria-hidden="true"></i>
                        </div>  
                        <div class="ihewc-admin-support-heading">
                            Support
                        </div> 
                        <div class="ihewc-admin-support-info">
                            Powered by WordPress.org, Issues resolved by Plugins Author.
                        </div> 
                    </div>
                </a>
                <a href="https://youtu.be/w8gb-CXxToA" target="_blank">
                    <div class="col-xs-support-ihewc">
                        <div class="ihewc-admin-support-icon">
                            <i class="fas fa-ticket-alt" aria-hidden="true"></i>
                        </div>  
                        <div class="ihewc-admin-support-heading">
                            Video Tutorial 
                        </div> 
                        <div class="ihewc-admin-support-info">
                            Watch our Using Video Toturial in Youtube.
                        </div> 
                    </div>
                </a>
            </div>
        </div> 
        <?php
    }

    function responsive_tabs_with_accordions_promote_free() {
        $status = get_option('responsive_tabs_with_accordions_license_status');
        $menu = '   <div class="oxilab-admin-wrapper">
                        <ul class="oxilab-admin-menu iheu-admin-side-menu">  
                            <li><a href="' . admin_url('admin.php?page=content-tabs-ultimate') . '">Tabs</a></li>
                            <li><a href="' . admin_url('admin.php?page=content-tabs-ultimate-new') . '">Templates</a></li>
                            <li><a href="' . admin_url('admin.php?page=content-tabs-ultimate-import') . '">More layouts</a></li>
                            <li><a href="' . admin_url('admin.php?page=content-tabs-ultimate-license') . '">Settings</a></li>
                        </ul>
                    </div>';
        if (is_plugin_active('shortcode-addons/index.php')) {
            echo '<div class="oxilab-admin-wrapper">
                        <ul class="oxilab-admin-menu">  
                            <li><a class="active" href="' . admin_url('admin.php?page=oxi-addons') . '">Shortcode Addons</a></li>
                            <li><a href="' . admin_url('admin.php?page=oxi-addons-import') . '">Import Addons</a></li>
                            <li><a href="' . admin_url('admin.php?page=oxi-addons-import-data') . '">Import Style</a></li>
                            <li><a href="' . admin_url('admin.php?page=oxi-addons-settings') . '">Addons Settings</a></li>
                        </ul>
                    </div> ';
            echo $menu;
        } else {
            echo '<div class="oxilab-admin-wrapper">
                        <ul class="oxilab-admin-menu">  
                           <li><a class="active" href="https://www.oxilab.org/shortcode-addons-features/">Shortcode Addons</a></li>
                            <li><a href="' . admin_url('admin.php?page=content-tabs-ultimate-addons') . '">Import Addons</a></li>
                            <li><a href="' . admin_url('admin.php?page=content-tabs-ultimate-addons') . '">Import Style</a></li>
                            <li><a href="https://wordpress.org/plugins/shortcode-addons/">Download Addons </a></li>
                        </ul>
                    </div> ';
            echo $menu;
        }
        echo ' <div class="oxilab-admin-notifications">
                    <h3>
                        <span class="dashicons dashicons-flag"></span> 
                        Notifications
                    </h3>
                    <p></p>
                    <div class="oxilab-admin-notifications-holder">
                        <div class="oxilab-admin-notifications-alert">
                            <p>Thank you for using my Responsive Tabs with Accordions. I Just wanted to see if you have any questions or concerns about my plugins. If you do, Please do not hesitate to <a href="https://wordpress.org/support/plugin/vc-tabs#new-post">file a bug report</a></p>
                           ';
        if ($status != 'valid') {
            echo '<p>By the way, did you know we also have a <a href="https://www.oxilab.org/downloads/responsive-tabs-with-accordions/">Premium Version</a>? It offers lots of options with automatic update. It also comes with 16/5 personal support.</p>';
        }
        echo '<p>Thanks Again!</p>
                    <p></p>
                </div>                     
            </div>
            <p></p>
        </div> 
        <p></p>';


        if ($status != 'valid') {
            $jquery = 'jQuery(".oxilab-vendor-color").each(function (index, value) {                             
                            jQuery(this).parent().siblings(".col-sm-6.control-label").append(" <span class=\"oxi-pro-only\">Pro</span>");
                            var datavalue = jQuery(this).val();
                            jQuery(this).attr("oxivalue", datavalue);
                        });
                        jQuery(".oxi-admin-font").each(function (index, value) {
                            jQuery(this).parent().siblings(".col-sm-6.control-label").append(" <span class=\"oxi-pro-only\">Pro</span>");
                            var datavalue = jQuery(this).val();
                            jQuery(this).attr("oxivalue", datavalue);
                        });
                        jQuery("#custom-css").each(function (index, value) {
                            var dataid = jQuery(this).attr("id");
                            jQuery("." + dataid).append(" <span class=\"oxi-pro-only\">Pro Only</span>");
                            var datavalue = jQuery(this).val();
                            jQuery(this).attr("oxivalue", datavalue);
                        });
                        jQuery("#oxi-style-submit").submit(function () {
                            jQuery(".oxilab-vendor-color").each(function (index, value) {
                                var datavalue = jQuery(this).attr("oxivalue");
                                jQuery(this).val(datavalue);
                            });
                            jQuery(".oxi-admin-font").each(function (index, value) {
                                var datavalue = jQuery(this).attr("oxivalue");
                                jQuery(this).val(datavalue);
                            });
                            jQuery("#custom-css").each(function (index, value) {
                                jQuery(this).val("");
                            });
                        });';
            wp_add_inline_script('oxilab-bootstrap', $jquery);
        }
    }

    $oxi_addons_install = get_option('oxi_addons_install');
    if (empty($oxi_addons_install)) {

        function responsive_tabs_with_accordions_set_no_bug() {
            $nobug = "";
            if (isset($_GET['responsive_tabs_with_accordions_no_bug'])) {
                $nobug = esc_attr($_GET['responsive_tabs_with_accordions_no_bug']);
            }
            if ('already' == $nobug) {
                add_option('responsive_tabs_with_accordions_no_bug', $nobug);
            } elseif ('later' == $nobug) {
                $now = strtotime("now");
                update_option('responsive_tabs_with_accordions_activation_date', $now);
            }
        }

        add_action('admin_init', 'responsive_tabs_with_accordions_set_no_bug');

        function responsive_tabs_with_accordions_check_installation_date() {
            $nobug = "";
            $nobug = get_option('responsive_tabs_with_accordions_no_bug');
            if ($nobug != 'already') {
                $install_date = get_option('responsive_tabs_with_accordions_activation_date');
                if (empty($install_date)) {
                    $now = strtotime("now");
                    add_option('responsive_tabs_with_accordions_activation_date', $now);
                }
                $past_date = strtotime('-5 days');
                if ($past_date >= $install_date) {
                    add_action('admin_notices', 'responsive_tabs_with_accordions_display_admin_notice');
                }
            }
        }

        add_action('admin_init', 'responsive_tabs_with_accordions_check_installation_date');

        function responsive_tabs_with_accordions_display_admin_notice() {

            // Review URL - Change to the URL of your plugin on WordPress.org
            $reviewurl = 'https://wordpress.org/plugins/vc-tabs/';

            $nobugurl = get_admin_url() . '?responsive_tabs_with_accordions_no_bug=later';
            $nobugurl2 = get_admin_url() . '?responsive_tabs_with_accordions_no_bug=already';

            echo '<div class="updated">';
            echo '<p></p>';

            printf(__('<p>Hey, You’ve using <strong>Responsive Tabs with Accordions </strong> for more than 1 week – that’s awesome! Could you please do me a BIG favor and give it a 5-star rating on WordPress? Just to help me spread the word and boost my motivation.!
                     </p>
                    <p><a href=%s target="_blank"><strong>Ok, you deserve it</strong></a></p>
                    <p><a href=%s><strong>Nope, maybe later</strong></a> </p>
                    <p><a href=%s><strong>I already did</strong></a> </p>'), $reviewurl, $nobugurl, $nobugurl2);
            echo '<p></p>';
            echo "</div>";
        }

    }

    function VcTabsAdminFontAwesomeData($data) {
        $val = '';
        $faversion = get_option('oxi_addons_font_awesome_version');
        $faversion = explode('||', $faversion);
        $ftawversion = $faversion[0];
        if ($data == 'facebook') {
            if ($ftawversion == '4.7.0') {
                $val .= 'fa fa-facebook';
            } else {
                $val .= 'fab fa-facebook-f';
            }
        } elseif ($data == 'twitter') {
            if ($ftawversion == '4.7.0') {
                $val .= 'fa fa-twitter';
            } else {
                $val .= 'fab fa-twitter';
            }
        } elseif ($data == 'youtube') {
            if ($ftawversion == '4.7.0') {
                $val .= 'fa fa-youtube-play';
            } else {
                $val .= 'fab fa-youtube';
            }
        } elseif ($data == 'ambulance') {
            if ($ftawversion == '4.7.0') {
                $val .= 'fa fa-ambulance';
            } else {
                $val .= 'fas fa-ambulance';
            }
        } elseif ($data == 'adn') {
            if ($ftawversion == '4.7.0') {
                $val .= 'fa fa-adn';
            } else {
                $val .= 'fab fa-adn';
            }
        } elseif ($data == 'github') {
            if ($ftawversion == '4.7.0') {
                $val .= 'fa fa-github-alt';
            } else {
                $val .= 'fab fa-github';
            }
        } elseif ($data == 'book') {
            if ($ftawversion == '4.7.0') {
                $val .= 'fa fa-address-book-o';
            } else {
                $val .= 'fas fa-address-book';
            }
        } elseif ($data == 'plus') {
            if ($ftawversion == '4.7.0') {
                $val .= 'fa fa-plus-circle';
            } else {
                $val .= 'fas fa-plus-circle';
            }
        } elseif ($data == 'cogs') {
            if ($ftawversion == '4.7.0') {
                $val .= 'fa fa-cog';
            } else {
                $val .= 'fas fa-cogs';
            }
        }
        return $val;
    }

    function VcTabsAdminFontAwesome($data) {
        $faversion = get_option('oxi_addons_font_awesome_version');
        $faversion = explode('||', $faversion);
        wp_enqueue_style('font-awesome-' . $faversion[0], $faversion[1]);
        $data = VcTabsAdminFontAwesomeData($data);
        return ctu_icon_font_selector($data);
    }

    function VcTabsAdminRenameData() {
        global $wpdb;
        $table_name = $wpdb->prefix . 'content_tabs_ultimate_style';
        if (!empty($_REQUEST['_wpnonce'])) {
            $nonce = $_REQUEST['_wpnonce'];
            if (!empty($_POST['vctabsrenamechange']) && $_POST['vctabsrenamechange'] == 'Save') {
                if (!wp_verify_nonce($nonce, 'vc-tabs-rename-change')) {
                    die('You do not have sufficient permissions to access this page.');
                } else {
                    $styleid = (int) $_POST['vctabsrenameid'];
                    $name = sanitize_text_field($_POST['vctabsrenametext']);
                    $wpdb->query($wpdb->prepare("UPDATE $table_name SET name = %s WHERE id = %d", $name, $styleid));
                }
            }
        }
    }

    function VcTabsAdminRightSideData($styleid, $style) {
        ?>
        <div class="oxilab-admin-item-panel">
            <div class="oxilab-admin-add-new-headding">
                Add New
            </div>
            <div class="oxilab-admin-add-new-item" id="oxilab-admin-add-new-item">
                <span>
                    <?php echo VcTabsAdminFontAwesome('plus'); ?>
                    Add new Items
                </span>
            </div>
        </div>
        <div class="oxilab-shortcode">
            <div class="oxilab-shortcode-heading">
                Rename
            </div>
            <div class="oxilab-shortcode-body">
                <form method="post">
                    <div class="input-group mb-3" style="display: inline-flex;">
                        <input type="hidden" class="form-control" name="vctabsrenameid" value="<?php echo $styleid; ?>">
                        <input type="text" class="form-control" name="vctabsrenametext" value="<?php echo $style['name']; ?>">
                        <div class="input-group-append" style="margin-left:5px">
                            <input type="submit" class="btn btn-success" name="vctabsrenamechange" value="Save">
                        </div>
                    </div>
                    <?php echo wp_nonce_field('vc-tabs-rename-change'); ?>
                </form>
            </div>
        </div>
        <div class="oxilab-shortcode">
            <div class="oxilab-shortcode-heading">
                Shortcodes
            </div>
            <div class="oxilab-shortcode-body">
                <em>Shortcode for posts/pages/plugins</em>
                <p>Copy &amp; paste the shortcode directly into any WordPress post or page.</p>
                <input type="text" class="form-control" onclick="this.setSelectionRange(0, this.value.length)" value="[ctu_ultimate_oxi id=&quot;<?php echo $styleid; ?>&quot;]">
                <span></span>
                <em>Shortcode for templates/themes</em>
                <p>Copy &amp; paste this code into a template file to include the slideshow within your theme.</p>
                <input type="text" class="form-control" onclick="this.setSelectionRange(0, this.value.length)" value="&lt;?php echo do_shortcode(&#039;[ctu_ultimate_oxi  id=&quot;<?php echo $styleid; ?>&quot;]&#039;); ?&gt;">
                <span></span>
                <em>Apply on Visual Composer</em>
                <p>Go on Visual Composer and get Our element on Content bar as Content Tabs</p>
            </div>
        </div>
        <div class="oxilab-admin-item-panel">
            <div class="oxilab-shortcode-heading">
                Quick Tutorials
            </div>
            <a class="oxilab-admin-add-new-item oxi-addons-tutorials" youtubeid="w8gb-CXxToA">
                <span>
                    <?php echo VcTabsAdminFontAwesome('youtube'); ?>
                </span>
            </a>
        </div>
        <div class="oxilab-admin-item-panel">
            <div class="oxilab-admin-add-new-headding">
                Rearrange Tabs
            </div>
            <div class="oxilab-admin-add-new-item" id="content-tabs-ultimate-drag-id">
                <span>
                    <?php echo VcTabsAdminFontAwesome('cogs'); ?>
                </span>
            </div>
        </div>
        <?php
    }

    function VcTabsAdminTabsInitialOpen($data) {
        ?>
        <div class="form-group row form-group-sm">
            <label for="oxi-tabs-opening" class="col-sm-6 col-form-label" data-toggle="tooltip" data-placement="top" title="Set Which tabs You want to Open Initial" >Initial Opening </label>
            <div class="col-sm-6">
                <select class="form-control" id="oxi-tabs-opening" name="oxi-tabs-opening">
                    <option value=":first"     <?php
                    if ($data == ':first') {
                        echo 'selected';
                    };
                    ?>>First</option>
                    <option value=":eq(1)"     <?php
                    if ($data == ':eq(1)') {
                        echo 'selected';
                    };
                    ?>>2nd</option>
                    <option value=":eq(2)"     <?php
                    if ($data == ':eq(2)') {
                        echo 'selected';
                    };
                    ?>>3rd</option>
                    <option value=":eq(3)"     <?php
                    if ($data == ':eq(3)') {
                        echo 'selected';
                    };
                    ?>>4th</option>
                    <option value=":eq(4)"     <?php
                    if ($data == ':eq(4)') {
                        echo 'selected';
                    };
                    ?>>5th</option>
                    <option value=":eq(5)"     <?php
                    if ($data == ':eq(5)') {
                        echo 'selected';
                    };
                    ?>>6th</option>
                    <option value=":eq(6)"     <?php
                    if ($data == ':eq(6)') {
                        echo 'selected';
                    };
                    ?>>7th</option>
                    <option value=":eq(7)"     <?php
                    if ($data == ':eq(7)') {
                        echo 'selected';
                    };
                    ?>>8th</option>
                    <option value=":eq(8)"     <?php
                    if ($data == ':eq(8)') {
                        echo 'selected';
                    };
                    ?>>9th</option>
                    <option value=":eq(9)" <?php
                    if ($data == ':eq(9)') {
                        echo 'selected';
                    };
                    ?>>10th</option>
                    <option value="none"    <?php
                    if ($data == 'none') {
                        echo 'selected';
                    };
                    ?>>None</option>
                </select>
            </div>
        </div>
        <?php
    }
    