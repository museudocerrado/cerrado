<?php
/**
 * Testimonials template and post metaboxes.
 * @since presscore 0.1
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

/***********************************************************/
// Display Testimonials
/***********************************************************/

$prefix = '_dt_testimonials_';

$DT_META_BOXES[] = array(
	'id'		=> 'dt_page_box-display_testimonials',
	'title' 	=> _x('Display Testimonials Category(s)', $translation_content, LANGUAGE_ZONE),
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
			'post_type'			=> 'dt_testimonials',
			'taxonomy'			=> 'dt_testimonials_category',
			// posts, categories, images
			'post_type_info'	=> array( 'categories' ),
			'main_tab_class'	=> 'dt_all_blog',
			'desc'				=> sprintf(
				'<h2>%s</h2><p><strong>%s</strong> %s</p><p><strong>%s</strong></p><ul><li><strong>%s</strong>%s</li><li><strong>%s</strong>%s</li><li><strong>%s</strong>%s</li></ul>',

        		_x( 'ALL your Testimonials are being displayed on this page!', 'backend', LANGUAGE_ZONE ),
	            _x( 'By default all your Testimonials will be displayed on this page. ', 'backend', LANGUAGE_ZONE ),
	            _x( 'But you can specify which Testimonials categories will (or will not) be shown.', 'backend', LANGUAGE_ZONE ),
	            _x( 'In tabs above you can select from the following options:', 'backend', LANGUAGE_ZONE ),

        		_x( 'All', 'backend', LANGUAGE_ZONE ),

        		_x( ' &mdash; all Testimonials (from all categories) will be shown on this page.', 'backend', LANGUAGE_ZONE ),

	            _x( 'Only', 'backend', LANGUAGE_ZONE ),

	            _x( ' &mdash; choose Testimonials category(s) to be shown on this page.', 'backend', LANGUAGE_ZONE ),

	            _x( 'All, except', 'backend', LANGUAGE_ZONE ),

	            _x( ' &mdash; choose which category(s) will be excluded from displaying on this page.', 'backend', LANGUAGE_ZONE )
			)
		)
	),
	'only_on'	=> array( 'template' => array('template-testimonials.php') ),
);

/***********************************************************/
// Testimonials options
/***********************************************************/

$prefix = '_dt_testimonials_options_';

$DT_META_BOXES[] = array(
	'id'		=> 'dt_page_box-testimonials_options',
	'title' 	=> _x('Testimonials Options', $translation_content, LANGUAGE_ZONE),
	'pages' 	=> array( 'page' ),
	'context' 	=> 'normal',
	'priority' 	=> 'high',
	'fields' 	=> array(

		// Layout for portfolio masonry
		array(
			'name'    	=> _x('Layout:', $translation_content, LANGUAGE_ZONE),
			'id'      	=> "{$prefix}masonry_layout",
			'type'    	=> 'radio',
			'std'		=> 'masonry',
			'options'	=> array(
				'masonry'	=> array( _x('Masonry', $translation_content, LANGUAGE_ZONE), array('admin-masonry.png', 56, 80) ),
				'grid'		=> array( _x('Grid', $translation_content, LANGUAGE_ZONE), array('admin-grid.png', 56, 80) ),
				'list'		=> array( _x('List', $translation_content, LANGUAGE_ZONE), array('icon-list-testimonials.png', 56, 80) ),
			),
			'hide_fields'	=> array(
				'list'		=> array( "{$prefix}columns" ),
			),
		),
		
		// Number of columns
		array(
			'name'    	=> _x('Number of columns:', $translation_content, LANGUAGE_ZONE),
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
		
		// Number of posts to display on one page
		array(
			'name'	=> _x('Number of testimonials on one page:', $translation_content, LANGUAGE_ZONE),
			'id'    => "{$prefix}ppp",
			'type'  => 'text',
			'std'   => '',
			'top_divider'	=> true
		),

	),
	'only_on'	=> array( 'template' => array('template-testimonials.php') ),
);

/***********************************************************/
// Testimonial options
/***********************************************************/

$prefix = '_dt_testimonial_options_';

$DT_META_BOXES[] = array(
	'id'		=> 'dt_page_box-testimonial_options',
	'title' 	=> _x('Options', $translation_content, LANGUAGE_ZONE),
	'pages' 	=> array( 'dt_testimonials' ),
	'context' 	=> 'side',
	'priority' 	=> 'core',
	'fields' 	=> array(

		// Position
		array(
			'name'	=> _x('Position:', $translation_content, LANGUAGE_ZONE),
			'id'    => "{$prefix}position",
			'type'  => 'textarea',
			'std'   => '',
		),

		// Link
		array(
			'name'	=> _x('Link:', $translation_content, LANGUAGE_ZONE),
			'id'    => "{$prefix}link",
			'type'  => 'text',
			'std'   => '',
			'top_divider'	=> true
		),

	),
);
