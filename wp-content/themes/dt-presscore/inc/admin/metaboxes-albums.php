<?php
/**
 * Albums template and post metaboxes.
 * @since presscore 0.1
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

/***********************************************************/
// Display Albums
/***********************************************************/

$prefix = '_dt_albums_';

$DT_META_BOXES[] = array(
	'id'		=> 'dt_page_box-display_albums',
	'title' 	=> _x('Display Photo & Video Albums', $translation_content, LANGUAGE_ZONE),
	'pages' 	=> array( 'page' ),
	'context' 	=> 'normal',
	'priority' 	=> 'high',
	'fields' 	=> array(

		// Sidebar widgetized area
		array(
			'id'       			=> "{$prefix}display",
			'type'     			=> 'fancy_category',
			// may be posts, taxonomy, both
			'mode'				=> 'both',
			'post_type'			=> 'dt_gallery',
			'taxonomy'			=> 'dt_gallery_category',
			// posts, categories, images
			'post_type_info'	=> array( 'categories', 'posts' ),
			'main_tab_class'	=> 'dt_all_albums',
			'desc'				=> sprintf(
				'<h2>%s</h2><p><strong>%s</strong> %s</p><p><strong>%s</strong></p><ul><li><strong>%s</strong>%s</li><li><strong>%s</strong>%s</li><li><strong>%s</strong>%s</li></ul>',
        		
        		_x( 'ALL your Photo & Video albums are being displayed on this page!', 'backend', LANGUAGE_ZONE ),
	            _x( 'By default all your Albums will be displayed on this page. ', 'backend', LANGUAGE_ZONE ),
	            _x( 'But you can specify which Album(s) or Album category(s) will (or will not) be shown.', 'backend', LANGUAGE_ZONE ),
	            _x( 'In tabs above you can select from the following options:', 'backend', LANGUAGE_ZONE ),
        		
        		_x( 'All', 'backend', LANGUAGE_ZONE ),
        		
        		_x( ' &mdash; all Albums will be shown on this page.', 'backend', LANGUAGE_ZONE ),
	            
	            _x( 'Only', 'backend', LANGUAGE_ZONE ),
	            
	            _x( ' &mdash; choose Album(s) or Album category(s) to be shown on this page.', 'backend', LANGUAGE_ZONE ),
	            
	            _x( 'All, except', 'backend', LANGUAGE_ZONE ),
	            
	            _x( ' &mdash; choose which Album(s) or Album category(s) will be excluded from displaying on this page.', 'backend', LANGUAGE_ZONE )
			)
		)
	),
	'only_on'	=> array( 'template' => array('template-albums.php') ),
);

/***********************************************************/
// Albums options
/***********************************************************/

$prefix = '_dt_albums_options_';

$DT_META_BOXES[] = array(
	'id'		=> 'dt_page_box-albums_options',
	'title' 	=> _x('Albums Options', $translation_content, LANGUAGE_ZONE),
	'pages' 	=> array( 'page' ),
	'context' 	=> 'normal',
	'priority' 	=> 'high',
	'fields' 	=> array(

		// Layout for portfolio masonry
		array(
			'name'    	=> _x('Layout:', $translation_content, LANGUAGE_ZONE),
			'id'      	=> "{$prefix}layout",
			'type'    	=> 'radio',
			'std'		=> 'masonry',
			'options'	=> array(
				'masonry'	=> array( _x('Masonry', $translation_content, LANGUAGE_ZONE), array('admin-masonry.png', 56, 80) ),
				'grid'		=> array( _x('Grid', $translation_content, LANGUAGE_ZONE), array('admin-grid.png', 56, 80) ),
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

		// Show projects descriptions
		array(
			'name'    	=> _x('Show albums descriptions:', $translation_content, LANGUAGE_ZONE),
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
			'name'    		=> _x('Make all albums the same width:', $translation_content, LANGUAGE_ZONE),
			'id'      		=> "{$prefix}posts_same_width",
			'type'    		=> 'checkbox',
			'std'			=> 0,
			'top_divider'	=> true
		),

		// Image layout
		array(
			'name'    	=> _x('Images sizing:', $translation_content, LANGUAGE_ZONE),
			'id'      	=> "{$prefix}image_layout",
			'type'    	=> 'radio',
			'std'		=> 'original',
			'options'	=> array(
				'original'	=> _x('preserve images proportions', $translation_content, LANGUAGE_ZONE),
				'resize'	=> _x('resize images', $translation_content, LANGUAGE_ZONE),
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
			'name'	=> _x('Number of albums to display on one page:', $translation_content, LANGUAGE_ZONE),
			'id'    => "{$prefix}ppp",
			'type'  => 'text',
			'std'   => '',
			'top_divider'	=> true
		),

		// Show projects titles
		array(
			'name'    	=> _x('Show albums titles:', $translation_content, LANGUAGE_ZONE),
			'id'      	=> "{$prefix}show_titles",
			'type'    	=> 'radio',
			'std'		=> '1',
			'options'	=> $yes_no_options,
			'before'	=> presscore_meta_boxes_advanced_settings_tpl('dt_portfolio-advanced'), // advanced settings
		),

		// Show projects excerpts
		array(
			'name'    	=> _x('Show albums excerpts:', $translation_content, LANGUAGE_ZONE),
			'id'      	=> "{$prefix}show_exerpts",
			'type'    	=> 'radio',
			'std'		=> '1',
			'options'	=> $yes_no_options,
		),

		// Show projects categories
		array(
			'name'    	=> _x('Show albums categories:', $translation_content, LANGUAGE_ZONE),
			'id'      	=> "{$prefix}show_terms",
			'type'    	=> 'radio',
			'std'		=> '1',
			'options'	=> $yes_no_options,
		),

		// Show filter
		array(
			'name'    	=> _x('Show albums filter:', $translation_content, LANGUAGE_ZONE),
			'id'      	=> "{$prefix}show_filter",
			'type'    	=> 'radio',
			'std'		=> '1',
			'options'	=> $yes_no_options,
			'top_divider'	=> true,
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
			'top_divider'	=> true,
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
			'name'     	=> _x('Order by:', $translation_content, LANGUAGE_ZONE),
			'id'       	=> "{$prefix}orderby",
			'type'     	=> 'select',
			'options'  	=> array_intersect_key($orderby_options, array('date' => null, 'name' => null)),
			'std'		=> 'date',
			'after'		=> '</div>',// advanced settings :)
		),

	),
	'only_on'	=> array( 'template' => array('template-albums.php') ),
);

/***********************************************************/
// Display Photos
/***********************************************************/

$prefix = '_dt_albums_media_';

$DT_META_BOXES[] = array(
	'id'		=> 'dt_page_box-display_albums_media',
	'title' 	=> _x('Display Photos & Videos', $translation_content, LANGUAGE_ZONE),
	'pages' 	=> array( 'page' ),
	'context' 	=> 'normal',
	'priority' 	=> 'high',
	'fields' 	=> array(

		// Sidebar widgetized area
		array(
			'id'       			=> "{$prefix}display",
			'type'     			=> 'fancy_category',
			// may be posts, taxonomy, both
			'mode'				=> 'both',
			'post_type'			=> 'dt_gallery',
			'taxonomy'			=> 'dt_gallery_category',
			// posts, categories, images
			'post_type_info'	=> array( 'categories', 'posts' ),
			'main_tab_class'	=> 'dt_all_albums',
			'desc'				=> sprintf(
				'<h2>%s</h2><p><strong>%s</strong> %s</p><p><strong>%s</strong></p><ul><li><strong>%s</strong>%s</li><li><strong>%s</strong>%s</li><li><strong>%s</strong>%s</li></ul>',
        		
        		_x('ALL Photos & Videos from all your Albums are being displayed on this page!', 'backend', LANGUAGE_ZONE),
	            _x('By default all your Photos & Videos will be displayed on this page. ', 'backend', LANGUAGE_ZONE),
	            _x('But you can specify which Album(s) or Album category(s) will (or will not) be shown.', 'backend', LANGUAGE_ZONE),
	            _x('In tabs above you can select from the following options:', 'backend', LANGUAGE_ZONE),
        		
        		_x( 'All', 'backend', LANGUAGE_ZONE ),
        		
        		_x(' &mdash; all Photos & Videos from all Albums will be shown on this page.', 'backend', LANGUAGE_ZONE),
	            
	            _x( 'Only', 'backend', LANGUAGE_ZONE ),
	            
	            _x(' &mdash; choose Album(s) or Album category(s) to be shown on this page.', 'backend', LANGUAGE_ZONE),
	            
	            _x( 'All, except', 'backend', LANGUAGE_ZONE ),
	            
	            _x(' &mdash; choose which Album(s) or Album category(s) will be excluded from displaying on this page.', 'backend', LANGUAGE_ZONE)
			)
		)
	),
	'only_on'	=> array( 'template' => array('template-media.php') ),
);

/***********************************************************/
// Media template options
/***********************************************************/

$prefix = '_dt_media_options_';

$DT_META_BOXES[] = array(
	'id'		=> 'dt_page_box-media_options',
	'title' 	=> _x('Gallery Options', $translation_content, LANGUAGE_ZONE),
	'pages' 	=> array( 'page' ),
	'context' 	=> 'normal',
	'priority' 	=> 'high',
	'fields' 	=> array(
		
		// Layout for portfolio masonry
		array(
			'name'    	=> _x('Layout:', $translation_content, LANGUAGE_ZONE),
			'id'      	=> "{$prefix}layout",
			'type'    	=> 'radio',
			'std'		=> 'masonry',
			'options'	=> array(
				'masonry'	=> array( _x('Masonry', $translation_content, LANGUAGE_ZONE), array('admin-masonry.png', 56, 80) ),
				'grid'		=> array( _x('Grid', $translation_content, LANGUAGE_ZONE), array('admin-grid.png', 56, 80) ),
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

		// Show projects descriptions
		array(
			'name'    	=> _x('Show items descriptions:', $translation_content, LANGUAGE_ZONE),
			'id'      	=> "{$prefix}description",
			'type'    	=> 'radio',
			'std'		=> 'under_image',
			'options'	=> array(
				'under_image'	=> array( _x('Under images', $translation_content, LANGUAGE_ZONE), array('admin-text-under.png', 56, 80) ),
				'on_hoover'		=> array( _x('On image hovers', $translation_content, LANGUAGE_ZONE), array('admin-text-on.png', 56, 80) ),
			),
			'top_divider'	=> true
		),

		// Image layout
		array(
			'name'    	=> _x('Images sizing:', $translation_content, LANGUAGE_ZONE),
			'id'      	=> "{$prefix}image_layout",
			'type'    	=> 'radio',
			'std'		=> 'original',
			'options'	=> array(
				'original'	=> _x('preserve images proportions', $translation_content, LANGUAGE_ZONE),
				'resize'	=> _x('resize images', $translation_content, LANGUAGE_ZONE),
			),
			'hide_fields'	=> array(
				'original'	=> array( "{$prefix}thumb_proportions" ),
			),
			'top_divider'	=> true
		),

		// Thumbnails proportions
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
			'name'	=> _x('Number of items to display on one page:', $translation_content, LANGUAGE_ZONE),
			'id'    => "{$prefix}ppp",
			'type'  => 'text',
			'std'   => '',
			'top_divider'	=> true
		),

		// Show items titles
		array(
			'name'    	=> _x('Show items titles:', $translation_content, LANGUAGE_ZONE),
			'id'      	=> "{$prefix}show_titles",
			'type'    	=> 'radio',
			'std'		=> '1',
			'options'	=> $yes_no_options,
			'before'	=> presscore_meta_boxes_advanced_settings_tpl('dt_portfolio-advanced'), // advanced settings
		),

		// Show items captions
		array(
			'name'    	=> _x('Show items captions:', $translation_content, LANGUAGE_ZONE),
			'id'      	=> "{$prefix}show_exerpts",
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
			'top_divider'	=> true
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
			'name'     	=> _x('Order by:', $translation_content, LANGUAGE_ZONE),
			'id'       	=> "{$prefix}orderby",
			'type'     	=> 'select',
			'options'  	=> array_intersect_key($orderby_options, array('date' => null, 'name' => null)),
			'std'		=> 'date',
			'after'		=> '</div>',// advanced settings :)
		),

	),
	'only_on'	=> array( 'template' => array('template-media.php') ),
);

/***********************************************************/
// Albums post media
/***********************************************************/

$prefix = '_dt_album_media_';

$DT_META_BOXES[] = array(
	'id'		=> 'dt_page_box-album_post_media',
	'title' 	=> _x('Add/Edit Media', $translation_content, LANGUAGE_ZONE),
	'pages' 	=> array( 'dt_gallery' ),
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
// Albums options
/***********************************************************/

$prefix = '_dt_album_options_';

$DT_META_BOXES[] = array(
	'id'		=> 'dt_page_box-album_options',
	'title' 	=> _x('Album Options', $translation_content, LANGUAGE_ZONE),
	'pages' 	=> array( 'dt_gallery' ),
	'context' 	=> 'side',
	'priority' 	=> 'core',
	'fields' 	=> array(

		// Hide featured image on post page
		array(
			'name'    		=> _x('Exclude featured image from the album:', $translation_content, LANGUAGE_ZONE),
			'id'      		=> "{$prefix}exclude_featured_image",
			'type'    		=> 'checkbox',
			'std'			=> 0,
		),

		//  Post preview width (radio buttons)
		array(
			'name'    	=> _x('Album preview width:', $translation_content, LANGUAGE_ZONE),
			'id'      	=> "{$prefix}preview",
			'type'    	=> 'radio',
			'std'		=> 'normal',
			'options'	=> array(
				'normal'	=> _x('normal', $translation_content, LANGUAGE_ZONE),
				'wide'		=> _x('wide', $translation_content, LANGUAGE_ZONE),
			),
			'top_divider'	=> true,
		),

	),
);
