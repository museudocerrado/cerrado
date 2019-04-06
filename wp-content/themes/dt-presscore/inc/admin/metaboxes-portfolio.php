<?php
/**
 * Portfolio template and post meta boxes.
 *
 * @since presscore 0.1
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

/***********************************************************/
// Display Portfolio
/***********************************************************/

$prefix = '_dt_portfolio_';

$DT_META_BOXES[] = array(
	'id'		=> 'dt_page_box-display_portfolio',
	'title' 	=> _x('Display Portfolio Category(s)', $translation_content, LANGUAGE_ZONE),
	'pages' 	=> array( 'page' ),
	'context' 	=> 'normal',
	'priority' 	=> 'high',
	'fields' 	=> array(

		// Sidebar widgetized area
		array(
			'id'       			=> "{$prefix}display",
			'type'     			=> 'fancy_category',
			// may be posts, taxonomy, both
			'mode'				=> 'taxonomy',
			'post_type'			=> 'dt_portfolio',
			'taxonomy'			=> 'dt_portfolio_category',
			// posts, categories, images
			'post_type_info'	=> array( 'categories' ),
			'main_tab_class'	=> 'dt_all_portfolio',
			'desc'				=> sprintf(
				'<h2>%s</h2><p><strong>%s</strong> %s</p><p><strong>%s</strong></p><ul><li><strong>%s</strong>%s</li><li><strong>%s</strong>%s</li><li><strong>%s</strong>%s</li></ul>',
        		
        		_x('ALL your Portfolio projects are being displayed on this page!', 'backend', LANGUAGE_ZONE),
	            _x('By default all your Portfolio projects will be displayed on this page. ', 'backend', LANGUAGE_ZONE),
	            _x('But you can specify which Portfolio project category(s) will (or will not) be shown.', 'backend', LANGUAGE_ZONE),
	            _x('In tabs above you can select from the following options:', 'backend', LANGUAGE_ZONE),
        		
        		_x( 'All', 'backend', LANGUAGE_ZONE ),
        		
        		_x(' &mdash; all Projects will be shown on this page.', 'backend', LANGUAGE_ZONE),
	            
	            _x( 'Only', 'backend', LANGUAGE_ZONE ),
	            
	            _x(' &mdash; choose Project category(s) to be shown on this page.', 'backend', LANGUAGE_ZONE),
	            
	            _x( 'All, except', 'backend', LANGUAGE_ZONE ),
	            
	            _x(' &mdash; choose which Project category(s) will be excluded from displaying on this page.', 'backend', LANGUAGE_ZONE)
			)
		)
	),
	'only_on'	=> array( 'template' => array('template-portfolio-list.php', 'template-portfolio-masonry.php') ),
);

/***********************************************************/
// Portfolio options
/***********************************************************/

$prefix = '_dt_portfolio_options_';

$DT_META_BOXES[] = array(
	'id'		=> 'dt_page_box-portfolio_options',
	'title' 	=> _x('Portfolio Options', $translation_content, LANGUAGE_ZONE),
	'pages' 	=> array( 'page' ),
	'context' 	=> 'normal',
	'priority' 	=> 'high',
	'fields' 	=> array(

		// Layout for portfolio list
		array(
			'name'    	=> _x('Layout:', $translation_content, LANGUAGE_ZONE),
			'id'      	=> "{$prefix}list_layout",
			'type'    	=> 'radio',
			'std'		=> 'list',
			'options'	=> array(
				'list'			=> array( _x('Normal', $translation_content, LANGUAGE_ZONE), array('admin-regular.png', 56, 80) ),
				'checkerboard' 	=> array( _x('Checkerboard order', $translation_content, LANGUAGE_ZONE), array('admin-checker.png', 56, 80) ),
			),
			'before'	=> '<div class="rwmb-hidden-field hide-if-js" data-show-on="template-portfolio-list.php">',
			'after'		=> '</div>',
		),
		
		// Layout for portfolio masonry
		array(
			'name'    	=> _x('Layout', $translation_content, LANGUAGE_ZONE),
			'id'      	=> "{$prefix}masonry_layout",
			'type'    	=> 'radio',
			'std'		=> 'masonry',
			'options'	=> array(
				'masonry'	=> array( _x('Masonry', $translation_content, LANGUAGE_ZONE), array('admin-masonry.png', 56, 80) ),
				'grid'		=> array( _x('Grid', $translation_content, LANGUAGE_ZONE), array('admin-grid.png', 56, 80) ),
			),
			'before'	=> '<div class="rwmb-hidden-field hide-if-js" data-show-on="template-portfolio-masonry.php">',
		),
		
		// Number of columns
		array(
			'name'    	=> _x('Number of columns', $translation_content, LANGUAGE_ZONE),
			'id'      	=> "{$prefix}columns",
			'type'    	=> 'radio',
			'std'		=> '3',
			'options'	=> array(
				'2'	=> array( '2', array('admin-2col.png', 56, 80) ),
				'3'	=> array( '3', array('admin-3col.png', 56, 80) ),
				'4'	=> array( '4', array('admin-4col.png', 56, 80) )
			),
			'top_divider'	=> true
		),

		// Show projects descriptions
		array(
			'name'    	=> _x('Show projects descriptions:', $translation_content, LANGUAGE_ZONE),
			'id'      	=> "{$prefix}description",
			'type'    	=> 'radio',
			'std'		=> 'under_image',
			'options'	=> array(
				'under_image'	=> array( _x('Under images', $translation_content, LANGUAGE_ZONE), array('admin-text-under.png', 56, 80) ),
				'on_hoover'		=> array( _x('On image hovers', $translation_content, LANGUAGE_ZONE), array('admin-text-on.png', 56, 80) ),
			),
			'top_divider'	=> true
		),

		// Make all posts the same width
		array(
			'name'    		=> _x('Make all projects the same width', $translation_content, LANGUAGE_ZONE),
			'id'      		=> "{$prefix}posts_same_width",
			'type'    		=> 'checkbox',
			'std'			=> 0,
			'after'			=> '</div>',
			'top_divider'	=> true
		),

		// Image layout
		array(
			'name'    	=> _x('Image layout:', $translation_content, LANGUAGE_ZONE),
			'id'      	=> "{$prefix}image_layout",
			'type'    	=> 'radio',
			'std'		=> 'original',
			'options'	=> array(
				'original'	=> _x('Preserve image proportions', $translation_content, LANGUAGE_ZONE),
				'resize'	=> _x('Resize images', $translation_content, LANGUAGE_ZONE),
			),
			'hide_fields'	=> array(
				'original'	=> array( "{$prefix}thumb_proportions" ),
			),
			'top_divider'	=> true
		),

		// Thumbnails height
		array(
			'id'   => "{$prefix}thumb_proportions",
			'type' => 'proportion_slider',

			'std'	=> $proportions_maybe_1x1,

			// jQuery UI slider options. See here http://api.jqueryui.com/slider/
			'js_options' => array(
				'min'   => 1,
				'max'   => $proportions_max,
				'step'  => 1,
			),
		),

		// Number of posts to display on one page
		array(
			'name'	=> _x('Number of projects to display on one page', $translation_content, LANGUAGE_ZONE),
			'id'    => "{$prefix}ppp",
			'type'  => 'text',
			'std'   => '',
			'top_divider'	=> true
		),

		// Show projects titles
		array(
			'name'    	=> _x('Show projects titles:', $translation_content, LANGUAGE_ZONE),
			'id'      	=> "{$prefix}show_titles",
			'type'    	=> 'radio',
			'std'		=> '1',
			'options'	=> $yes_no_options,
			'before'	=> presscore_meta_boxes_advanced_settings_tpl('dt_portfolio-advanced'), // advanced settings
		),

		// Show projects excerpts
		array(
			'name'    	=> _x('Show projects excerpts:', $translation_content, LANGUAGE_ZONE),
			'id'      	=> "{$prefix}show_exerpts",
			'type'    	=> 'radio',
			'std'		=> '1',
			'options'	=> $yes_no_options,
		),

		// Show projects categories
		array(
			'name'    	=> _x('Show projects categories:', $translation_content, LANGUAGE_ZONE),
			'id'      	=> "{$prefix}show_terms",
			'type'    	=> 'radio',
			'std'		=> '1',
			'options'	=> $yes_no_options,
		),

		// Show details buttons
		array(
			'name'    	=> _x('Show details buttons:', $translation_content, LANGUAGE_ZONE),
			'id'      	=> "{$prefix}show_details",
			'type'    	=> 'radio',
			'std'		=> '1',
			'options'	=> $yes_no_options,
		),

		// Show links buttons
		array(
			'name'    	=> _x('Show links buttons:', $translation_content, LANGUAGE_ZONE),
			'id'      	=> "{$prefix}show_links",
			'type'    	=> 'radio',
			'std'		=> '1',
			'options'	=> $yes_no_options,
		),

		// Show categories filter
		array(
			'name'    	=> _x('Show categories filter:', $translation_content, LANGUAGE_ZONE),
			'id'      	=> "{$prefix}show_filter",
			'type'    	=> 'radio',
			'std'		=> '1',
			'options'	=> $yes_no_options,
		),

		// Show ordering
		array(
			'name'    	=> _x('Show ordering:', $translation_content, LANGUAGE_ZONE),
			'id'      	=> "{$prefix}show_ordering",
			'type'    	=> 'radio',
			'std'		=> '1',
			'options'	=> $yes_no_options,
		),

		// Show all pages in paginator
		array(
			'name'    	=> _x('Show all pages in paginator:', $translation_content, LANGUAGE_ZONE),
			'id'      	=> "{$prefix}show_all_pages",
			'type'    	=> 'radio',
			'std'		=> '0',
			'options'	=> $yes_no_options,
		),

		// Order
		array(
			'name'    	=> _x('Order:', $translation_content, LANGUAGE_ZONE),
			'id'      	=> "{$prefix}order",
			'type'    	=> 'radio',
			'std'		=> 'DESC',
			'options'	=> $order_options,
			'top_divider'	=> true
		),

		// Orderby
		array(
			'name'     	=> _x('Orderby:', $translation_content, LANGUAGE_ZONE),
			'id'       	=> "{$prefix}orderby",
			'type'     	=> 'select',
			'options'  	=> array_intersect_key($orderby_options, array('date' => null, 'name' => null)),
			'std'		=> 'date',
			'after'		=> '</div>',// advanced settings :)
		),

	),
	'only_on'	=> array( 'template' => array('template-portfolio-list.php', 'template-portfolio-masonry.php') ),
);

/***********************************************************/
// Portfolio post media
/***********************************************************/

$prefix = '_dt_project_media_';

$DT_META_BOXES[] = array(
	'id'		=> 'dt_page_box-portfolio_post_media',
	'title' 	=> _x('Add/Edit Project Media', $translation_content, LANGUAGE_ZONE),
	'pages' 	=> array( 'dt_portfolio' ),
	'context' 	=> 'normal',
	'priority' 	=> 'high',
	'fields' 	=> array(

		// IMAGE ADVANCED (WP 3.5+)
		array(
			'id'               => "{$prefix}items",
			'type'             => 'image_advanced_mk2',
		),

	),
);

/***********************************************************/
// Portfolio post media options
/***********************************************************/

$prefix = '_dt_project_media_options_';

$DT_META_BOXES[] = array(
	'id'		=> 'dt_page_box-portfolio_post_media_options',
	'title' 	=> _x('Media Options', $translation_content, LANGUAGE_ZONE),
	'pages' 	=> array( 'dt_portfolio' ),
	'context' 	=> 'normal',
	'priority' 	=> 'high',
	'fields' 	=> array(

		// Layout settings
		array(
			'name'    	=> _x('Layout settings:', $translation_content, LANGUAGE_ZONE),
			'id'      	=> "{$prefix}layout",
			'type'    	=> 'radio',
			'std'		=> 'left',
			'options'	=> array(
				'left'		=> array( _x('Media on the left of content', $translation_content, LANGUAGE_ZONE), array('p1.png', 75, 50) ),
				'right' 	=> array( _x('Media on the right of content', $translation_content, LANGUAGE_ZONE), array('p2.png', 75, 50) ),
				'before' 	=> array( _x('Media before content area', $translation_content, LANGUAGE_ZONE), array('p3.png', 75, 50) ),
				'after' 	=> array( _x('Media after content area', $translation_content, LANGUAGE_ZONE), array('p4.png', 75, 50) ),
				'disabled' 	=> array( _x('Media disabled (blank page)', $translation_content, LANGUAGE_ZONE), array('p5.png', 75, 50) ),
			),
		),

		// Show media as
		array(
			'name'    	=> _x('Show media as:', $translation_content, LANGUAGE_ZONE),
			'id'      	=> "{$prefix}type",
			'type'    	=> 'radio',
			'std'		=> 'slideshow',
			'options'	=> array(
				'slideshow'	=> array( _x('Slideshow', $translation_content, LANGUAGE_ZONE), array('p11.png', 75, 50) ),
				'gallery' 	=> array( _x('Gallery', $translation_content, LANGUAGE_ZONE), array('p13.png', 75, 50) ),
				'list'		=> array( _x('List', $translation_content, LANGUAGE_ZONE), array('p12.png', 75, 50) ),
			),
			'hide_fields'	=> array(
				'gallery' 	=> array( "{$prefix}slider_proportions" ),
				'list'		=> array( "{$prefix}slider_proportions" ),
			),
			'top_divider'	=> true

		),

		// Slider proportions
		array(
			'name'			=> _x('Slider proportions:', $translation_content, LANGUAGE_ZONE),
			'id'    		=> "{$prefix}slider_proportions",
			'type'  		=> 'simple_proportions',
			'std'   		=> array( 'width' => '', 'height' => '' ),
			'top_divider'	=> true
		),

	),
);

/***********************************************************/
// Portfolio post options
/***********************************************************/

$prefix = '_dt_project_options_';

$DT_META_BOXES[] = array(
	'id'		=> 'dt_page_box-portfolio_post',
	'title' 	=> _x('Project Options', $translation_content, LANGUAGE_ZONE),
	'pages' 	=> array( 'dt_portfolio' ),
	'context' 	=> 'normal',
	'priority' 	=> 'high',
	'fields' 	=> array(

		// Project link
		array(
			'name'    		=> _x('Project link:', $translation_content, LANGUAGE_ZONE),
			'id'      		=> "{$prefix}show_link",
			'type'    		=> 'checkbox',
			'std'			=> 0,
			'hide_fields'	=> array(
				"{$prefix}link",
				"{$prefix}link_name",
				"{$prefix}link_target",
			),
		),

		// Link
		array(
			'name'	=> _x('Link:', $translation_content, LANGUAGE_ZONE),
			'id'    => "{$prefix}link",
			'type'  => 'text',
			'std'   => '',
		),

		// Link name
		array(
			'name'	=> _x('Caption:', $translation_content, LANGUAGE_ZONE),
			'id'    => "{$prefix}link_name",
			'type'  => 'text',
			'std'   => '',
		),

		// Target
		array(
			'name'    	=> _x('Target:', $translation_content, LANGUAGE_ZONE),
			'id'      	=> "{$prefix}link_target",
			'type'    	=> 'radio',
			'std'		=> '',
			'options'	=> array(
				''			=> _x('_self', $translation_content, LANGUAGE_ZONE),
				'_blank' 	=> _x('_blank', $translation_content, LANGUAGE_ZONE),
			),
		),

		// Hide featured image on project page
		array(
			'name'    		=> _x('Hide featured image on project page:', $translation_content, LANGUAGE_ZONE),
			'id'      		=> "{$prefix}hide_thumbnail",
			'type'    		=> 'checkbox',
			'std'			=> 0,
			'top_divider'	=> true,
		),

		// Related projects category
		array(
			'name'    	=> _x('Related projects category:', $translation_content, LANGUAGE_ZONE),
			'id'      	=> "{$prefix}related_mode",
			'type'    	=> 'radio',
			'std'		=> 'same',
			'options'	=> array(
				'same'		=> _x('from the same category', $translation_content, LANGUAGE_ZONE),
				'custom'	=> _x('choose category(s)', $translation_content, LANGUAGE_ZONE),
			),
			'hide_fields'	=> array(
				'same'	=> array( "{$prefix}related_categories" ),
			),
			'top_divider'	=> true,
		),

		// Taxonomy list
		array(
			'id'      => "{$prefix}related_categories",
			'type'    => 'taxonomy_list',
			'options' => array(
				// Taxonomy name
				'taxonomy' => 'dt_portfolio_category',
				// How to show taxonomy: 'checkbox_list' (default) or 'checkbox_tree', 'select_tree' or 'select'. Optional
				'type' => 'checkbox_list',
				// Additional arguments for get_terms() function. Optional
				'args' => array()
			),
		),

		//  Project preview width
		array(
			'name'    	=> _x('Project preview width:', $translation_content, LANGUAGE_ZONE),
			'id'      	=> "{$prefix}preview",
			'type'    	=> 'radio',
			'std'		=> 'normal',
			'options'	=> array(
				'normal'	=> _x('normal', $translation_content, LANGUAGE_ZONE),
				'wide'		=> _x('wide', $translation_content, LANGUAGE_ZONE),
			),
			'before'	=> '<p><small>' . sprintf(
				_x('Related projects can be enabled / disabled from %sTheme Options / General / Related posts settings%s', $translation_content, LANGUAGE_ZONE),
				'<a href="' . add_query_arg( 'page', 'of-general-menu', get_admin_url() . 'admin.php' ) . '" target="_blank">',
				'</a>'
			) . '</small></p><div class="dt_hr"></div><p><strong>' . _x('Project Preview Options', $translation_content, LANGUAGE_ZONE) . '</strong></p>'
		),

		//  Project preview style
		array(
			'name'    	=> _x('Preview style:', $translation_content, LANGUAGE_ZONE),
			'id'      	=> "{$prefix}preview_style",
			'type'    	=> 'radio',
			'std'		=> 'featured_image',
			'options'	=> array(
				'featured_image'	=> _x('featured image', $translation_content, LANGUAGE_ZONE),
				'slideshow'			=> _x('slideshow', $translation_content, LANGUAGE_ZONE),
			),
			'hide_fields'	=> array(
				'featured_image' => array( "{$prefix}slider_proportions" ),
			),
		),

		// Slider proportions
		array(
			'name'			=> _x('Slider proportions:', $translation_content, LANGUAGE_ZONE),
			'id'    		=> "{$prefix}slider_proportions",
			'type'  		=> 'simple_proportions',
			'std'   		=> array('width' => '', 'height' => ''),
		),

	),
);
