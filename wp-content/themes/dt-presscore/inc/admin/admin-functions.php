<?php
/**
 * Admin functions.
 *
 * @since presscore 1.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Generate less css after theme switch.
 *
 */
function presscore_generate_less_css_after_switch_theme () {
	add_action( 'admin_init', 'presscore_generate_less_css_file', 25 );
}
add_action( 'after_switch_theme', 'presscore_generate_less_css_after_switch_theme' );

/**
 * Admin notice.
 *
 */
function presscore_admin_notice() {
	
	// if less css file is writable - return
	if ( get_option( 'presscore_less_css_is_writable' ) ) {
		return;
	}
    ?>
    <div class="error">
        <p><?php _ex( 'Error: Less css is not writable!', 'backend', LANGUAGE_ZONE ); ?></p>
    </div>
    <?php
}
add_action( 'admin_notices', 'presscore_admin_notice' );

/**
 * Add video url field for attachments.
 */
function presscore_attachment_fields_to_edit( $fields, $post ) {

	// hopefuly add new field only for images
	if ( strpos( get_post_mime_type( $post->ID ), 'image' ) !== false ) {
		$video_url = get_post_meta( $post->ID, 'dt-video-url', true );
		$img_link = get_post_meta( $post->ID, 'dt-img-link', true );

	    $fields['dt-video-url'] = array(
	            'label' 		=> _x('Video url', 'attachment field', LANGUAGE_ZONE),
	            'input' 		=> 'text',
	            'value'			=> $video_url ? $video_url : '',
	            'show_in_edit' 	=> true,
	    );

	    $fields['dt-img-link'] = array(
	            'label' 		=> _x('Image link', 'attachment field', LANGUAGE_ZONE),
	            'input' 		=> 'text',
	//			'html'       	=> "<input type='text' class='text widefat' name='attachments[$post->ID][dt-video-url]' value='" . esc_attr($img_link) . "' /><br />",
	            'value'			=> $img_link ? $img_link : '',
	            'show_in_edit' 	=> true,
	    );
	}

    return $fields;
}
add_filter( 'attachment_fields_to_edit', 'presscore_attachment_fields_to_edit', 10, 2 );

/**
 * Save vide url attachment field.
 */
function presscore_save_attachment_fields( $attachment_id ) {
    if ( isset( $_REQUEST['attachments'][$attachment_id]['dt-video-url'] ) ) {
        $location = esc_url($_REQUEST['attachments'][$attachment_id]['dt-video-url']);
        update_post_meta( $attachment_id, 'dt-video-url', $location );
    }

	if ( isset( $_REQUEST['attachments'][$attachment_id]['dt-img-link'] ) ) {
        $location = esc_url($_REQUEST['attachments'][$attachment_id]['dt-img-link']);
        update_post_meta( $attachment_id, 'dt-img-link', $location );
    }    
}
add_action( 'edit_attachment', 'presscore_save_attachment_fields' );

/**	
 * This function return array with thumbnail image meta for items list in admin are.
 * If fitured image not set it gets last image by menu order.
 * If there are no images and $noimage not empty it returns $noimage in other way it returns false
 *
 * @param integer $post_id
 * @param integer $max_w
 * @param integer $max_h
 * @param string $noimage
 */ 

function dt_get_admin_thumbnail ( $post_id, $max_w = 100, $max_h = 100, $noimage = '' ) {
	$post_type=  get_post_type( $post_id );
	$thumb = array();

	if ( has_post_thumbnail( $post_id ) ) {
		$thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'thumbnail' );
	} elseif ( 'dt_gallery' == $post_type ) {
		$media_gallery = get_post_meta( $post_id, '_dt_album_media_items', true );
		$thumb = empty($media_gallery) ? array() : wp_get_attachment_image_src( current($media_gallery), 'thumbnail' );
	} elseif ( 'dt_slideshow' == $post_type ) {
		$media_gallery = get_post_meta( $post_id, '_dt_slider_media_items', true );
		$thumb = empty($media_gallery) ? array() : wp_get_attachment_image_src( current($media_gallery), 'thumbnail' );
	}
	
	if ( empty( $thumb ) ) {
		if ( ! $noimage ) { return false; }
		
		$thumb = $noimage;
		$w = $max_w;
		$h = $max_h;
	} else {
		$sizes = wp_constrain_dimensions( $thumb[1], $thumb[2], $max_w, $max_h );
		$w = $sizes[0];
		$h = $sizes[1];
		$thumb = $thumb[0];
	}
	
	return array( esc_url( $thumb ), $w, $h );
}

/**
 * Description here.
 *
 * @param integer $post_id
 */
function dt_admin_thumbnail ( $post_id ) {
	$default_image = PRESSCORE_THEME_URI . '/images/noimage-thumbnail.jpg';
	$thumbnail = dt_get_admin_thumbnail( $post_id, 100, 100, $default_image );
	
	if ( $thumbnail ) {

		echo 	'<a style="width: 100%; text-align: center; display: block;" href="post.php?post=' . absint($post_id) . '&action=edit" title="">
					<img src="' . esc_url($thumbnail[0]) . '" width="' . esc_attr($thumbnail[1]) . '" height="' . esc_attr($thumbnail[2]) . '" alt="" />
				</a>';
	}
}

/**
 * Add styles to admin.
 *
 */
function presscore_admin_print_scripts(  ) {
?>
<style type="text/css">
#presscore-thumbs {
	width: 110px;
}
#presscore-sidebar,
#presscore-footer {
	width: 120px;
}
#wpbody-content .bulk-edit-row-page .inline-edit-col-right,
#wpbody-content .bulk-edit-row-post .inline-edit-col-right {
	width: 30%;
}
</style>
<?php
}
add_action( 'admin_print_scripts-edit.php', 'presscore_admin_print_scripts', 99 );

/**
 * Add thumbnails column in posts list.
 *
 */
function presscore_add_thumbnails_column_in_admin( $defaults ){
	$head = array_slice( $defaults, 0, 1 );
    $tail = array_slice( $defaults, 1 );

    $head['presscore-thumbs'] = _x( 'Thumbnail', 'backend', LANGUAGE_ZONE );

    $defaults = array_merge( $head, $tail );

    return $defaults;
}
add_filter('manage_edit-dt_portfolio_columns', 'presscore_add_thumbnails_column_in_admin');
add_filter('manage_edit-dt_gallery_columns', 'presscore_add_thumbnails_column_in_admin');
add_filter('manage_edit-dt_team_columns', 'presscore_add_thumbnails_column_in_admin');
add_filter('manage_edit-dt_testimonials_columns', 'presscore_add_thumbnails_column_in_admin');
add_filter('manage_edit-dt_logos_columns', 'presscore_add_thumbnails_column_in_admin');
add_filter('manage_edit-dt_slideshow_columns', 'presscore_add_thumbnails_column_in_admin');

/**
 * Add sidebar and footer columns in posts list.
 *
 */
function presscore_add_sidebar_and_footer_columns_in_admin( $defaults ){
    $defaults['presscore-sidebar'] = _x( 'Sidebar', 'backend', LANGUAGE_ZONE );
    $defaults['presscore-footer'] = _x( 'Footer', 'backend', LANGUAGE_ZONE );
    return $defaults;
}
add_filter('manage_edit-page_columns', 'presscore_add_sidebar_and_footer_columns_in_admin');
// add_filter('manage_edit-post_columns', 'presscore_add_sidebar_and_footer_columns_in_admin');
add_filter('manage_edit-dt_portfolio_columns', 'presscore_add_sidebar_and_footer_columns_in_admin');

/**
 * Add slug column for slideshow posts list.
 *
 */
function presscore_add_slug_column_for_slideshow( $defaults ){
    $defaults['presscore-slideshow-slug'] = _x( 'Slug', 'backend', LANGUAGE_ZONE );
    return $defaults;
}
add_filter('manage_edit-dt_slideshow_columns', 'presscore_add_slug_column_for_slideshow');

/**
 * Show thumbnail in column.
 *
 */
function presscore_display_thumbnails_in_admin( $column_name, $id ){
	static $wa_list = -1;

	if ( -1 === $wa_list ) {
		$wa_list = presscore_get_widgetareas_options();
	}

	switch ( $column_name ) {
		case 'presscore-thumbs': dt_admin_thumbnail( $id ); break;
		case 'presscore-sidebar':
			$wa = get_post_meta( $id, '_dt_sidebar_widgetarea_id', true );
			$wa_title = isset( $wa_list[ $wa ] ) ? $wa_list[ $wa ] : $wa_list['sidebar_1'];
			echo esc_html( $wa_title );
			break;
		case 'presscore-footer':
			$wa = get_post_meta( $id, '_dt_footer_widgetarea_id', true );
			$wa_title = isset( $wa_list[ $wa ] ) ? $wa_list[ $wa ] : $wa_list['sidebar_2'];
			echo esc_html( $wa_title );
			break;
		case 'presscore-slideshow-slug':
			if ( $dt_post = get_post( $id ) ) {
				echo $dt_post->post_name;
			} else {
				echo '&mdash;';
			}
			break;
	}
}
add_action( 'manage_posts_custom_column', 'presscore_display_thumbnails_in_admin', 10, 2 );
add_action( 'manage_pages_custom_column', 'presscore_display_thumbnails_in_admin', 10, 2 );

/**
 * Add Bulk edit fields.
 *
 */
function presscore_add_bulk_edit_fields( $col, $type ) {
	if ( !in_array( $type, array( 'page', 'post', 'dt_portfolio' ) ) ) return; ?>
		<fieldset class="inline-edit-col-right">
			<div class="inline-edit-col">

				<div class="inline-edit-group">
					<label class="alignleft">
						<span class="title"><?php _ex( 'Sidebar option', 'backend bulk edit', LANGUAGE_ZONE ); ?></span>
						<?php
						$sidebar_options = array(
							'left' 		=> _x('Left', 'backend bulk edit', LANGUAGE_ZONE),
							'right' 	=> _x('Right', 'backend bulk edit', LANGUAGE_ZONE),
							'disabled'	=> _x('Disabled', 'backend bulk edit', LANGUAGE_ZONE),
						);
						?>
						<select name="_dt_bulk_edit_sidebar_options">
							<option value="-1"><?php _ex( '&mdash; No Change &mdash;', 'backend bulk edit', LANGUAGE_ZONE ); ?></option>
							<?php foreach ( $sidebar_options as $value=>$title ): ?>
								<option value="<?php echo $value; ?>"><?php echo $title; ?></option>
							<?php endforeach; ?>
						</select>
					</label>
				
					<label class="alignright">
						<span class="title"><?php _ex( 'Widgetized footer', 'backend bulk edit', LANGUAGE_ZONE ); ?></span>
						<?php
						$show_wf = array(
							0	=> _x('Hide', 'backend bulk edit footer', LANGUAGE_ZONE),
							1	=> _x('Show', 'backend bulk edit footer', LANGUAGE_ZONE),
						);
						?>
						<select name="_dt_bulk_edit_show_footer">
							<option value="-1"><?php _ex( '&mdash; No Change &mdash;', 'backend bulk edit', LANGUAGE_ZONE ); ?></option>
 							<?php foreach ( $show_wf as $value=>$title ): ?>
 								<option value="<?php echo $value; ?>"><?php echo $title; ?></option>
 							<?php endforeach; ?>
 						</select>
 					</label>
				</div>

			<?php if ( function_exists('presscore_get_widgetareas_options') && $wa_list = presscore_get_widgetareas_options() ): ?>
				
				<div class="inline-edit-group">
					<label class="alignleft">
						<span class="title"><?php _ex( 'Sidebar', 'backend bulk edit', LANGUAGE_ZONE ); ?></span>
 						<select name="_dt_bulk_edit_sidebar">
							<option value="-1"><?php _ex( '&mdash; No Change &mdash;', 'backend bulk edit', LANGUAGE_ZONE ); ?></option>
 							<?php foreach ( $wa_list as $value=>$title ): ?>
 								<option value="<?php echo esc_attr($value); ?>"><?php echo esc_html( $title ); ?></option>
 							<?php endforeach; ?>
 						</select>
 					</label>
 				
					<label class="alignright">
						<span class="title"><?php _ex( 'Footer', 'backend bulk edit', LANGUAGE_ZONE ); ?></span>
 						<select name="_dt_bulk_edit_footer">
							<option value="-1"><?php _ex( '&mdash; No Change &mdash;', 'backend bulk edit', LANGUAGE_ZONE ); ?></option>
 							<?php foreach ( $wa_list as $value=>$title ): ?>
 								<option value="<?php echo esc_attr($value); ?>"><?php echo esc_html( $title ); ?></option>
 							<?php endforeach; ?>
 						</select>
 					</label>
 				</div>

 			<?php endif; ?>

			</div>
		</fieldset>
<?php
	// remove itself
	remove_action( 'bulk_edit_custom_box', 'presscore_add_bulk_edit_fields', 10, 2 );
}
add_action( 'bulk_edit_custom_box', 'presscore_add_bulk_edit_fields', 10, 2 );

/**
 * Save changes made by bulk edit.
 *
 */
function presscore_bulk_edit_save_changes( $post_ID, $post ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( !isset($_REQUEST['_ajax_nonce']) && !isset($_REQUEST['_wpnonce']) ) {
		return;
	}

	// verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times

	// Check permissions
	if ( !current_user_can( 'edit_page', $post_ID ) ) {
		return;
	}

	if ( !check_ajax_referer( 'bulk-posts', false, false ) ) {
		return;
	}

	if ( isset($_REQUEST['bulk_edit']) ) {

		// sidebar options
		if ( isset( $_REQUEST['_dt_bulk_edit_sidebar_options'] ) && in_array( $_REQUEST['_dt_bulk_edit_sidebar_options'], array( 'left', 'right', 'disabled' ) ) ) {
			update_post_meta( $post_ID, '_dt_sidebar_position', esc_attr( $_REQUEST['_dt_bulk_edit_sidebar_options'] ) );
		}

		// update sidebar
		if ( isset( $_REQUEST['_dt_bulk_edit_sidebar'] ) && '-1' != $_REQUEST['_dt_bulk_edit_sidebar'] ) {
			update_post_meta( $post_ID, '_dt_sidebar_widgetarea_id', esc_attr( $_REQUEST['_dt_bulk_edit_sidebar'] ) );
		}

		// update footer
		if ( isset( $_REQUEST['_dt_bulk_edit_footer'] ) && '-1' != $_REQUEST['_dt_bulk_edit_footer'] ) {
			update_post_meta( $post_ID, '_dt_footer_widgetarea_id', esc_attr( $_REQUEST['_dt_bulk_edit_footer'] ) );
		}

		// show footer
		if ( isset( $_REQUEST['_dt_bulk_edit_show_footer'] ) && '-1' != $_REQUEST['_dt_bulk_edit_show_footer'] ) {
			update_post_meta( $post_ID, '_dt_footer_show', absint( $_REQUEST['_dt_bulk_edit_show_footer'] ) );
		}		
	}
}
add_action( 'save_post', 'presscore_bulk_edit_save_changes', 10, 2 );

/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function presscore_register_required_plugins() {

	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */

	$plugins = array(
		array(
			'name'     				=> 'Revolution Slider', // The plugin name
			'slug'     				=> 'revslider', // The plugin slug (typically the folder name)
			'source'   				=> '/revslider.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'     				=> 'Pricing Tables', // The plugin name
			'slug'     				=> 'pricing-table', // The plugin slug (typically the folder name)
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
		),
		array(
			'name'     				=> 'Contact Form 7', // The plugin name
			'slug'     				=> 'contact-form-7', // The plugin slug (typically the folder name)
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
		),
		array(
			'name'     				=> 'Recent Tweets Widget', // The plugin name
			'slug'     				=> 'recent-tweets-widget', // The plugin slug (typically the folder name)
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
		),
	);

	// Change this to your theme text domain, used for internationalising strings
	$theme_text_domain = LANGUAGE_ZONE;

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'domain'       		=> $theme_text_domain,         	// Text domain - likely want to be the same as your theme.
		'default_path' 		=> PRESSCORE_PLUGINS_DIR,                         	// Default absolute path to pre-packaged plugins
		'parent_menu_slug' 	=> 'themes.php', 				// Default parent menu slug
		'parent_url_slug' 	=> 'themes.php', 				// Default parent URL slug
		'menu'         		=> 'install-required-plugins', 	// Menu slug
		'has_notices'      	=> true,                       	// Show admin notices or not
		'is_automatic'    	=> false,					   	// Automatically activate plugins after installation or not
		'message' 			=> '',							// Message to output right before the plugins table
		'strings'      		=> array(
			'page_title'                       			=> __( 'Install Required Plugins', $theme_text_domain ),
			'menu_title'                       			=> __( 'Install Plugins', $theme_text_domain ),
			'installing'                       			=> __( 'Installing Plugin: %s', $theme_text_domain ), // %1$s = plugin name
			'oops'                             			=> __( 'Something went wrong with the plugin API.', $theme_text_domain ),
			'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
			'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
			'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
			'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
			'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
			'return'                           			=> __( 'Return to Required Plugins Installer', $theme_text_domain ),
			'plugin_activated'                 			=> __( 'Plugin activated successfully.', $theme_text_domain ),
			'complete' 									=> __( 'All plugins installed and activated successfully. %s', $theme_text_domain ), // %1$s = dashboard link
			'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
		)
	);

	tgmpa( $plugins, $config );

}
add_action( 'tgmpa_register', 'presscore_register_required_plugins' );