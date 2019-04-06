<?php
/**
 * Declare custom post types.
 *
 * @since presscore 0.1
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

/*******************************************************************/
// Portfolio post type
/*******************************************************************/

if ( !class_exists('Presscore_Inc_Portfolio_Post_Type') ):

class Presscore_Inc_Portfolio_Post_Type {
	public static $post_type = 'dt_portfolio';
	public static $taxonomy = 'dt_portfolio_category';
	public static $menu_position = 47; 

	public static function register() {
		
		// titles
		$labels = array(
		    'name'                  => _x('Portfolio',              'backend portfolio', LANGUAGE_ZONE),
		    'singular_name'         => _x('Portfolio',              'backend portfolio', LANGUAGE_ZONE),
		    'add_new'               => _x('Add New',                'backend portfolio', LANGUAGE_ZONE),
		    'add_new_item'          => _x('Add New Item',           'backend portfolio', LANGUAGE_ZONE),
		    'edit_item'             => _x('Edit Item',              'backend portfolio', LANGUAGE_ZONE),
		    'new_item'              => _x('New Item',               'backend portfolio', LANGUAGE_ZONE),
		    'view_item'             => _x('View Item',              'backend portfolio', LANGUAGE_ZONE),
		    'search_items'          => _x('Search Items',           'backend portfolio', LANGUAGE_ZONE),
		    'not_found'             => _x('No items found',         'backend portfolio', LANGUAGE_ZONE),
		    'not_found_in_trash'    => _x('No items found in Trash','backend portfolio', LANGUAGE_ZONE), 
		    'parent_item_colon'     => '',
		    'menu_name'             => _x('Portfolio', 'backend portfolio', LANGUAGE_ZONE)
		);

		$img = PRESSCORE_URI . '/admin/assets/images/admin_ico_portfolio.png';

		// options
		$args = array(
		    'labels'                => $labels,
		    'public'                => true,
		    'publicly_queryable'    => true,
		    'show_ui'               => true,
		    'show_in_menu'          => true, 
		    'query_var'             => true,
		    'rewrite'               => array( 'slug' => 'project' ),
		    'capability_type'       => 'post',
		    'has_archive'           => true, 
		    'hierarchical'          => false,
		    'menu_position'         => self::$menu_position,
		    'menu_icon'             => $img,
		    'supports'              => array( 'title', 'editor', 'thumbnail', 'comments', 'excerpt', 'revisions', 'custom-fields' )
		);
		register_post_type( self::$post_type, $args );
		/* post type end */

		/* setup taxonomy */

		// titles
		$labels = array(
		    'name'              => _x( 'Categories',        'backend portfolio', LANGUAGE_ZONE ),
		    'singular_name'     => _x( 'Category',          'backend portfolio', LANGUAGE_ZONE ),
		    'search_items'      => _x( 'Search in Category','backend portfolio', LANGUAGE_ZONE ),
		    'all_items'         => _x( 'Categories',        'backend portfolio', LANGUAGE_ZONE ),
		    'parent_item'       => _x( 'Parent Category',   'backend portfolio', LANGUAGE_ZONE ),
		    'parent_item_colon' => _x( 'Parent Category:',  'backend portfolio', LANGUAGE_ZONE ),
		    'edit_item'         => _x( 'Edit Category',     'backend portfolio', LANGUAGE_ZONE ), 
		    'update_item'       => _x( 'Update Category',   'backend portfolio', LANGUAGE_ZONE ),
		    'add_new_item'      => _x( 'Add New Category',  'backend portfolio', LANGUAGE_ZONE ),
		    'new_item_name'     => _x( 'New Category Name', 'backend portfolio', LANGUAGE_ZONE ),
		    'menu_name'         => _x( 'Categories',        'backend portfolio', LANGUAGE_ZONE )
		); 	

		register_taxonomy(
		    self::$taxonomy,
		    array( self::$post_type ),
		    array(
		        'hierarchical'          => true,
		        'public'                => true,
		        'labels'                => $labels,
		        'show_ui'               => true,
		        'rewrite'               => array('slug' => 'project-category'),
		        'show_admin_column'		=> true,
		    )
		);
		/* taxonomy end */
	}
}

endif;

/*******************************************************************/
// Testimonials post type
/*******************************************************************/

if ( !class_exists('Presscore_Inc_Testimonials_Post_Type') ):

class Presscore_Inc_Testimonials_Post_Type {
	public static $post_type = 'dt_testimonials';
	public static $taxonomy = 'dt_testimonials_category';
	public static $menu_position = 48; 

	public static function register() {
		
		// titles
		$labels = array(
		    'name'                  => _x('Testimonials',              'backend testimonials', LANGUAGE_ZONE),
		    'singular_name'         => _x('Testimonials',              'backend testimonials', LANGUAGE_ZONE),
		    'add_new'               => _x('Add New',                'backend testimonials', LANGUAGE_ZONE),
		    'add_new_item'          => _x('Add New Item',           'backend testimonials', LANGUAGE_ZONE),
		    'edit_item'             => _x('Edit Item',              'backend testimonials', LANGUAGE_ZONE),
		    'new_item'              => _x('New Item',               'backend testimonials', LANGUAGE_ZONE),
		    'view_item'             => _x('View Item',              'backend testimonials', LANGUAGE_ZONE),
		    'search_items'          => _x('Search Items',           'backend testimonials', LANGUAGE_ZONE),
		    'not_found'             => _x('No items found',         'backend testimonials', LANGUAGE_ZONE),
		    'not_found_in_trash'    => _x('No items found in Trash','backend testimonials', LANGUAGE_ZONE), 
		    'parent_item_colon'     => '',
		    'menu_name'             => _x('Testimonials', 'backend testimonials', LANGUAGE_ZONE)
		);

		$img = PRESSCORE_URI . '/admin/assets/images/admin_ico_testimonials.png';

		// options
		$args = array(
		    'labels'                => $labels,
		    'public'                => false,
		    // 'publicly_queryable'    => true,
		    'show_ui'               => true,
		    'show_in_menu'          => true, 
		    // 'query_var'             => true,
		    // 'rewrite'               => false,
		    'capability_type'       => 'post',
		    'has_archive'           => false, 
		    'hierarchical'          => false,
		    'menu_position'         => self::$menu_position,
		    'menu_icon'             => $img,
		    'supports'              => array( 'title', 'editor', 'thumbnail' )
		);
		register_post_type( self::$post_type, $args );
		/* post type end */

		/* setup taxonomy */

		// titles
		$labels = array(
		    'name'              => _x( 'Categories',        'backend testimonials', LANGUAGE_ZONE ),
		    'singular_name'     => _x( 'Category',          'backend testimonials', LANGUAGE_ZONE ),
		    'search_items'      => _x( 'Search in Category','backend testimonials', LANGUAGE_ZONE ),
		    'all_items'         => _x( 'Categories',        'backend testimonials', LANGUAGE_ZONE ),
		    'parent_item'       => _x( 'Parent Category',   'backend testimonials', LANGUAGE_ZONE ),
		    'parent_item_colon' => _x( 'Parent Category:',  'backend testimonials', LANGUAGE_ZONE ),
		    'edit_item'         => _x( 'Edit Category',     'backend testimonials', LANGUAGE_ZONE ), 
		    'update_item'       => _x( 'Update Category',   'backend testimonials', LANGUAGE_ZONE ),
		    'add_new_item'      => _x( 'Add New Category',  'backend testimonials', LANGUAGE_ZONE ),
		    'new_item_name'     => _x( 'New Category Name', 'backend testimonials', LANGUAGE_ZONE ),
		    'menu_name'         => _x( 'Categories',        'backend testimonials', LANGUAGE_ZONE )
		); 	

		register_taxonomy(
		    self::$taxonomy,
		    array( self::$post_type ),
		    array(
		        'hierarchical'          => true,
		        'public'                => true,
		        'labels'                => $labels,
		        'show_ui'               => true,
		        'rewrite'               => true,
		        'show_admin_column'		=> true,
		    )
		);
		/* taxonomy end */
	}

	/**
	 * Testimonial renderer.
	 *
	 */
	public static function render_testimonial( $post_id = null ) {
		global $post;
		
		if ( null != $post_id ) {
			$post_backup = $post;
			$post = get_post( $post_id );
			setup_postdata( $post );
		} else {
			$post_id = get_the_ID();
		}

		if ( !$post_id ) return '';

		$html = '';

		$content = get_the_content();

		// get avatar ( featured image )		
		$avatar = '<span class="alignleft no-avatar"></span>';
		if ( has_post_thumbnail( $post_id ) ) {

			$thumb_id = get_post_thumbnail_id( $post_id );
			$avatar = dt_get_thumb_img( array(
				'img_meta'      => wp_get_attachment_image_src( $thumb_id, 'full' ),
				'img_id'		=> $thumb_id,
				'options'       => array( 'w' => 50, 'h' => 50 ),
				'echo'			=> false,
				'wrap'			=> '<img %IMG_CLASS% %SRC% %SIZE% %IMG_TITLE% %ALT% />',
			) );

			$avatar = '<span class="alignleft">' . $avatar . '</span>';
		}

		// get link
		$link = get_post_meta( $post_id, '_dt_testimonial_options_link', true );
		if ( $link ) {
			$link = esc_url( $link );
			$avatar = '<a href="' . $link . '">' . $avatar . '</a>';
		} else {
			$link = '';
		}

		// get position
		$position = get_post_meta( $post_id, '_dt_testimonial_options_position', true );
		if ( $position ) {
			$position = '<span class="text-secondary color-secondary">' . $position . '</span>';
		} else {
			$position = '';
		}

		// get title
		$title = get_the_title( $post_id );
		if ( $title ) {

			if ( $link ) {
				$title = '<a href="' . $link . '" class="text-primary"><span>' . $title . '</span></a>';
			} else {
				$title = '<span class="text-primary">' . $title . '</span>';
			}

			$title .= '<br />';
		} else {
			$title = '';
		}

		// get it all togeather
		$html = sprintf(
			'<article>' . "\n\t" . '<div class="testimonial-content">%1$s</div>' . "\n\t" . '<div class="testimonial-vcard"><div class="wf-td">%2$s</div><div class="wf-td">%3$s</div></div>' . "\n" . '</article>' . "\n",
			$content, $avatar, $title . $position
		);

		if ( !empty($post_backup) ) {
			$post = $post_backup;
			setup_postdata( $post );
		}

		return $html;
	}

	public static function get_template_query() {
		$config = Presscore_Config::get_instance();

		$display = $config->get('display');
		$ppp = $config->get('posts_per_page');

		$query_args = array(
			'post_type'	=> self::$post_type,
			'status'	=> 'publish' ,
			'paged'		=> dt_get_paged_var(),
		);

		if ( $ppp ) {
	        $query_args['posts_per_page'] = intval($ppp);
	    }

	    if ( 'all' != $display['select'] && is_array( $display['terms_ids'] ) ) {

		    $query_args['tax_query'] = array( array(
		    	'taxonomy'	=> self::$taxonomy,
		    	'field'		=> 'id',
		    	'terms'		=> array_values($display['terms_ids']),
		    ) );

		    switch( $display['select'] ) {
		        case 'only':
		        	$query_args['tax_query'][0]['operator'] = 'IN';
		            break;
		    
		        case 'except':
		    		$query_args['tax_query'][0]['operator'] = 'NOT IN';
		    }

		}

		return new WP_Query( $query_args );
	}
}

endif;

/*******************************************************************/
// Team post type
/*******************************************************************/

if ( !class_exists('Presscore_Inc_Team_Post_Type') ):

class Presscore_Inc_Team_Post_Type {
	public static $post_type = 'dt_team';
	public static $taxonomy = 'dt_team_category';
	public static $menu_position = 49; 

	public static function register() {
		
		// titles
		$labels = array(
		    'name'                  => _x('Team',              			'backend team', LANGUAGE_ZONE),
		    'singular_name'         => _x('Team',              			'backend team', LANGUAGE_ZONE),
		    'add_new'               => _x('Add New',                	'backend team', LANGUAGE_ZONE),
		    'add_new_item'          => _x('Add New Teammate',           'backend team', LANGUAGE_ZONE),
		    'edit_item'             => _x('Edit Teammate',              'backend team', LANGUAGE_ZONE),
		    'new_item'              => _x('New Teammate',               'backend team', LANGUAGE_ZONE),
		    'view_item'             => _x('View Teammate',              'backend team', LANGUAGE_ZONE),
		    'search_items'          => _x('Search Teammates',           'backend team', LANGUAGE_ZONE),
		    'not_found'             => _x('No teammates found',         'backend team', LANGUAGE_ZONE),
		    'not_found_in_trash'    => _x('No Teammates found in Trash','backend team', LANGUAGE_ZONE), 
		    'parent_item_colon'     => '',
		    'menu_name'             => _x('Team', 'backend team', LANGUAGE_ZONE)
		);

		$img = PRESSCORE_URI . '/admin/assets/images/admin_ico_team.png';

		// options
		$args = array(
		    'labels'                => $labels,
		    'public'                => true,
		    'publicly_queryable'    => true,
		    'show_ui'               => true,
		    'show_in_menu'          => true, 
		    'query_var'             => true,
		    'rewrite'               => true,
		    'capability_type'       => 'post',
		    'has_archive'           => true, 
		    'hierarchical'          => false,
		    'menu_position'         => self::$menu_position,
		    'menu_icon'             => $img,
		    'supports'              => array( 'title', 'editor', 'thumbnail' )
		);
		register_post_type( self::$post_type, $args );
		/* post type end */

		/* setup taxonomy */

		// titles
		$labels = array(
		    'name'              => _x( 'Categories',        'backend team', LANGUAGE_ZONE ),
		    'singular_name'     => _x( 'Category',          'backend team', LANGUAGE_ZONE ),
		    'search_items'      => _x( 'Search in Category','backend team', LANGUAGE_ZONE ),
		    'all_items'         => _x( 'Categories',        'backend team', LANGUAGE_ZONE ),
		    'parent_item'       => _x( 'Parent Category',   'backend team', LANGUAGE_ZONE ),
		    'parent_item_colon' => _x( 'Parent Category:',  'backend team', LANGUAGE_ZONE ),
		    'edit_item'         => _x( 'Edit Category',     'backend team', LANGUAGE_ZONE ), 
		    'update_item'       => _x( 'Update Category',   'backend team', LANGUAGE_ZONE ),
		    'add_new_item'      => _x( 'Add New Category',  'backend team', LANGUAGE_ZONE ),
		    'new_item_name'     => _x( 'New Category Name', 'backend team', LANGUAGE_ZONE ),
		    'menu_name'         => _x( 'Categories',        'backend team', LANGUAGE_ZONE )
		); 	

		register_taxonomy(
		    self::$taxonomy,
		    array( self::$post_type ),
		    array(
		        'hierarchical'          => true,
		        'public'                => true,
		        'labels'                => $labels,
		        'show_ui'               => true,
		        'rewrite'               => true,
		        'show_admin_column'		=> true,
		    )
		);
		/* taxonomy end */
	}

	/**
	 * This method render's team item.
	 *
	 * @param integer $post_id If empty - uses current post id.
	 *
	 * @return string Item html.
	 */
	public static function render_teammate( $post_id = null ) {
		$post_id = $post_id ? $post_id : get_the_ID();
		
		if ( !$post_id ) return '';

		$html = '';

		$content = get_the_content( $post_id );
		if ( $content ) $content = '<div class="team-content">' . wpautop( $content ) . '</div>';

		// get featured image
		$image = '';
		if ( has_post_thumbnail( $post_id ) ) {

			$thumb_id = get_post_thumbnail_id( $post_id );
			$image = dt_get_thumb_img( array(
				'img_meta'      => wp_get_attachment_image_src( $thumb_id, 'full' ),
				'img_id'		=> $thumb_id,
				'options'       => false,
				'echo'			=> false,
				'wrap'			=> '<img %IMG_CLASS% %SRC% %SIZE% %IMG_TITLE% %ALT% />',
			) );

		}

		// get links
		$links = array();
		if ( function_exists('presscore_get_team_links_array') ) {
			
			foreach ( presscore_get_team_links_array() as $id=>$data ) {
				$link = get_post_meta( $post_id, '_dt_teammate_options_' . $id, true );
				if ( $link ) {
					$links[] = sprintf(
						'<a title="%2$s" target="_blank" href="%1$s" class="%3$s"><span class="assistive-text">%2$s</span></a>',
						esc_attr( $link ),
						esc_attr( $data['desc'] ),
						esc_attr( $id )
					);
				}
			}
			
		}

		if ( empty($links) ) {
			$links = '';
		} else {
			$links = '<div class="soc-ico">' . implode('', $links) . '</div>';
		}

		// get position
		$position = get_post_meta( $post_id, '_dt_teammate_options_position', true );
		if ( $position ) {
			$position = '<p>' . $position . '</p>';
		} else {
			$position = '';
		}

		// get title
		$title = get_the_title( $post_id );
		if ( $title ) {
			$title = '<div class="team-author-name">' . $title . '</div>';
		} else {
			$title = '';
		}

		$author_block = $title . $position;
		if ( $author_block ) $author_block = '<div class="team-author">' . $author_block . '</div>';

		// get it all togeather
		$html = sprintf(
			'<div class="team-container">' . "\n\t" . '%1$s<div class="team-desc">%2$s</div>' . "\n\t" . '</div>' . "\n",
			$image, $author_block . $content . $links
		);

		return $html;
	}

	public static function get_template_query() {
		$config = Presscore_Config::get_instance();

		$display = $config->get('display');
		$ppp = $config->get('posts_per_page');

		$query_args = array(
			'post_type'	=> self::$post_type,
			'status'	=> 'publish' ,
			'paged'		=> dt_get_paged_var(),
		);

		if ( $ppp ) {
	        $query_args['posts_per_page'] = intval( $ppp );
	    }

	    if ( 'all' != $display['select'] ) {

		    $query_args['tax_query'] = array( array(
		    	'taxonomy'	=> self::$taxonomy,
		    	'field'		=> 'id',
		    	'terms'		=> array_values( $display['terms_ids'] ),
		    ) );

		    switch( $display['select'] ) {
		        case 'only':
		        	$query_args['tax_query'][0]['operator'] = 'IN';
		            break;
		    
		        case 'except':
		    		$query_args['tax_query'][0]['operator'] = 'NOT IN';
		    }

		}

		return new WP_Query( $query_args );
	}
}

endif;

/*******************************************************************/
// Logos post type
/*******************************************************************/

if ( !class_exists('Presscore_Inc_Logos_Post_Type') ):

class Presscore_Inc_Logos_Post_Type {
	public static $post_type = 'dt_logos';
	public static $taxonomy = 'dt_logos_category';
	public static $menu_position = 50; 

	public static function register() {
		
		// titles
		$labels = array(
		    'name'                  => _x('Partners, Clients, etc.',    'backend logos', LANGUAGE_ZONE),
		    'singular_name'         => _x('Item',              			'backend logos', LANGUAGE_ZONE),
		    'add_new'               => _x('Add New',                	'backend logos', LANGUAGE_ZONE),
		    'add_new_item'          => _x('Add New Item',           	'backend logos', LANGUAGE_ZONE),
		    'edit_item'             => _x('Edit Item',              	'backend logos', LANGUAGE_ZONE),
		    'new_item'              => _x('New Item',               	'backend logos', LANGUAGE_ZONE),
		    'view_item'             => _x('View Item',              	'backend logos', LANGUAGE_ZONE),
		    'search_items'          => _x('Search Items',           	'backend logos', LANGUAGE_ZONE),
		    'not_found'             => _x('No items found',         	'backend logos', LANGUAGE_ZONE),
		    'not_found_in_trash'    => _x('No items found in Trash',	'backend logos', LANGUAGE_ZONE), 
		    'parent_item_colon'     => '',
		    'menu_name'             => _x('Partners, Clients, etc.', 	'backend logos', LANGUAGE_ZONE)
		);

		$img = PRESSCORE_URI . '/admin/assets/images/admin_ico_clients.png';

		// options
		$args = array(
		    'labels'                => $labels,
		    'public'                => true,
		    'publicly_queryable'    => true,
		    'show_ui'               => true,
		    'show_in_menu'          => true, 
		    'query_var'             => true,
		    'rewrite'               => true,
		    'capability_type'       => 'post',
		    'has_archive'           => true, 
		    'hierarchical'          => false,
		    'menu_position'         => self::$menu_position,
		    'menu_icon'             => $img,
		    'supports'              => array( 'title', 'thumbnail' )
		);
		register_post_type( self::$post_type, $args );
		/* post type end */

		/* setup taxonomy */

		// titles
		$labels = array(
		    'name'              => _x( 'Categories',        'backend partners', LANGUAGE_ZONE ),
		    'singular_name'     => _x( 'Category',          'backend partners', LANGUAGE_ZONE ),
		    'search_items'      => _x( 'Search in Category','backend partners', LANGUAGE_ZONE ),
		    'all_items'         => _x( 'Categories',        'backend partners', LANGUAGE_ZONE ),
		    'parent_item'       => _x( 'Parent Category',   'backend partners', LANGUAGE_ZONE ),
		    'parent_item_colon' => _x( 'Parent Category:',  'backend partners', LANGUAGE_ZONE ),
		    'edit_item'         => _x( 'Edit Category',     'backend partners', LANGUAGE_ZONE ), 
		    'update_item'       => _x( 'Update Category',   'backend partners', LANGUAGE_ZONE ),
		    'add_new_item'      => _x( 'Add New Category',  'backend partners', LANGUAGE_ZONE ),
		    'new_item_name'     => _x( 'New Category Name', 'backend partners', LANGUAGE_ZONE ),
		    'menu_name'         => _x( 'Categories',        'backend partners', LANGUAGE_ZONE )
		); 	

		register_taxonomy(
		    self::$taxonomy,
		    array( self::$post_type ),
		    array(
		        'hierarchical'          => true,
		        'public'                => true,
		        'labels'                => $labels,
		        'show_ui'               => true,
		        'rewrite'               => true,
		        'show_admin_column'		=> true,
		    )
		);
		/* taxonomy end */
	}
}

endif;

/*******************************************************************/
// Albums post type
/*******************************************************************/

if ( !class_exists('Presscore_Inc_Albums_Post_Type') ):

class Presscore_Inc_Albums_Post_Type {
	public static $post_type = 'dt_gallery';
	public static $taxonomy = 'dt_gallery_category';
	public static $menu_position = 51; 

	public static function register() {

		// titles
		$labels = array(
		    'name'                  => _x('Photo Albums', 'backend albums', LANGUAGE_ZONE),
		    'singular_name'         => _x('Photo Album', 'backend albums', LANGUAGE_ZONE),
		    'add_new'               => _x('Add New', 'backend albums', LANGUAGE_ZONE),
		    'add_new_item'          => _x('Add New Album', 'backend albums', LANGUAGE_ZONE),
		    'edit_item'             => _x('Edit Album', 'backend albums', LANGUAGE_ZONE),
		    'new_item'              => _x('New Album', 'backend albums', LANGUAGE_ZONE),
		    'view_item'             => _x('View Album', 'backend albums', LANGUAGE_ZONE),
		    'search_items'          => _x('Search for Albums', 'backend albums', LANGUAGE_ZONE),
		    'not_found'             => _x('No Albums Found', 'backend albums', LANGUAGE_ZONE),
		    'not_found_in_trash'    => _x('No Albums Found in Trash', 'backend albums', LANGUAGE_ZONE), 
		    'parent_item_colon'     => '',
		    'menu_name'             => _x('Photo Albums', 'backend albums', LANGUAGE_ZONE)
		);

		$img = PRESSCORE_URI . '/admin/assets/images/admin_ico_gallery.png';

		// options
		$args = array(
		    'labels'                => $labels,
		    'public'                => true,
		    'publicly_queryable'    => true,
		    'show_ui'               => true,
		    'show_in_menu'          => true, 
		    'query_var'             => true,
		    'rewrite'               => true,
		    'capability_type'       => 'post',
		    'has_archive'           => true, 
		    'hierarchical'          => false,
		    'menu_position'         => self::$menu_position,
		    'menu_icon'             => $img,
		    'supports'              => array( 'title', 'thumbnail', 'excerpt' )
		);
		register_post_type( self::$post_type, $args );
		/* post type end */

		/* setup taxonomy */

		// titles
		$labels = array(
		    'name'              => _x( 'Categories',            'backend albums', LANGUAGE_ZONE ),
		    'singular_name'     => _x( 'Category',              'backend albums', LANGUAGE_ZONE ),
		    'search_items'      => _x( 'Search in Category',    'backend albums', LANGUAGE_ZONE ),
		    'all_items'         => _x( 'Categories',            'backend albums', LANGUAGE_ZONE ),
		    'parent_item'       => _x( 'Parent Category',       'backend albums', LANGUAGE_ZONE ),
		    'parent_item_colon' => _x( 'Parent Category:',      'backend albums', LANGUAGE_ZONE ),
		    'edit_item'         => _x( 'Edit Category',         'backend albums', LANGUAGE_ZONE ), 
		    'update_item'       => _x( 'Update Category',       'backend albums', LANGUAGE_ZONE ),
		    'add_new_item'      => _x( 'Add New Category',      'backend albums', LANGUAGE_ZONE ),
		    'new_item_name'     => _x( 'New Category Name',     'backend albums', LANGUAGE_ZONE ),
		    'menu_name'         => _x( 'Categories',            'backend albums', LANGUAGE_ZONE )
		); 	

		register_taxonomy(
		    self::$taxonomy,
		    array( self::$post_type ),
		    array(
		        'hierarchical'          => true,
		        'public'                => true,
		        'labels'                => $labels,
		        'show_ui'               => true,
		        'rewrite'               => true,
		        'show_admin_column'		=> true,
		    )
		);
		/* taxonomy end */
	}

	public static function get_albums_template_query() {
		$config = Presscore_Config::get_instance();

		$ppp = $config->get('posts_per_page');
		$order = $config->get('order');
		$orderby = $config->get('orderby');
		$display = $config->get('display');
		$request_display = $config->get('request_display');
		$layout = $config->get('layout');

		$all_terms = get_categories( array(
	        'type'          => self::$post_type,
	        'hide_empty'    => 1,
	        'hierarchical'  => 0,
	        'taxonomy'      => self::$taxonomy,
	        'pad_counts'    => false
	    ) );

		$all_terms_array = array();
	    foreach ( $all_terms as $term ) {
	    	$all_terms_array[] = $term->term_id;
	    }

		$query_args = array(
			'post_type'	=> self::$post_type,
			'status'	=> 'publish' ,
			'paged'		=> dt_get_paged_var(),
			'order'		=> $order,
			'orderby'	=> 'name' == $orderby ? 'title' : $orderby,
		);

		if ( $ppp ) {
	        $query_args['posts_per_page'] = intval($ppp);
	    }

	    if ( 'all' != $display['select'] ) {

           	if ( 'category' == $display['type'] && !empty($display['terms_ids']) ) {

	       	    $query_args['tax_query'] = array( array(
	       	    	'taxonomy'	=> self::$taxonomy,
	       	    	'field'	 => 'id',
	       	    	'terms'	 => array_values($display['terms_ids']),
	       	    	'operator'	=> 'IN',
	       	    ) );

	       	    if ( 'except' == $display['select'] ) {
			       	$terms_arr = array_diff( $all_terms_array, $display['terms_ids'] );
       	            sort( $terms_arr );

       	            if ( $terms_arr ) {
	       	    	 	$query_args['tax_query']['relation'] = 'OR';
			       	    $query_args['tax_query'][1] = $query_args['tax_query'][0];
   	    	            $query_args['tax_query'][0]['terms'] = $terms_arr;
   	    	            $query_args['tax_query'][1]['operator'] = 'NOT IN';
   	    	        }

   	    	        add_filter( 'posts_clauses', 'dt_core_join_left_filter' );
	       	    }

	       	} elseif ( 'albums' == $display['type'] && !empty($display['posts_ids']) ) {

		       	$display['posts_ids'] = array_values( $display['posts_ids'] );

	       	    if ( 'except' == $display['select'] ) {
	       	    	$query_args['post__not_in'] = $display['posts_ids'];
	       	    } else {
	       	    	$query_args['post__in'] = $display['posts_ids'];
	       	    }

	       	}

       	}

		// filter
		if ( $request_display ) {

			// except
	    	if ( 0 == current($request_display['terms_ids']) ) {
			    // ninjaaaa
			    $request_display['terms_ids'] = $all_terms_array;
	    	}

	    	$query_args['tax_query'] = array( array(
	    		'taxonomy'	=> self::$taxonomy,
	    		'field'		=> 'id',
	    		'terms'		=> array_values($request_display['terms_ids']),
	    		'operator'	=> 'IN',
	    	) );

	    	if ( 'except' == $request_display['select'] ) {
	    		$query_args['tax_query'][0]['operator'] = 'NOT IN';
	    	}
		}

		$query = new WP_Query($query_args);
		remove_filter( 'posts_clauses', 'dt_core_join_left_filter' );

		return $query;
	}

	public static function get_media_template_query() {
		$config = Presscore_Config::get_instance();

		$ppp = $config->get('posts_per_page');
		$order = $config->get('order');
		$orderby = $config->get('orderby');
		$display = $config->get('display');

		$all_terms = get_categories( array(
	        'type'          => self::$post_type,
	        'hide_empty'    => 1,
	        'hierarchical'  => 0,
	        'taxonomy'      => self::$taxonomy,
	        'pad_counts'    => false
	    ) );

		$all_terms_array = array();
	    foreach ( $all_terms as $term ) {
	    	$all_terms_array[] = $term->term_id;
	    }

		$page_args = array(
			'post_type'			=> self::$post_type,
			'status'			=> 'publish' ,
			'posts_per_page'	=> '-1',
			'order'				=> $order,
			'orderby'			=> 'name' == $orderby ? 'title' : $orderby,
		);

	    if ( 'all' != $display['select'] ) {

           	if ( 'category' == $display['type'] && !empty($display['terms_ids']) ) {

	       	    $page_args['tax_query'] = array( array(
	       	    	'taxonomy'	=> self::$taxonomy,
	       	    	'field'	 => 'id',
	       	    	'terms'	 => array_values($display['terms_ids']),
	       	    	'operator'	=> 'IN',
	       	    ) );

	       	    if ( 'except' == $display['select'] ) {
			       	$terms_arr = array_diff( $all_terms_array, $display['terms_ids'] );
       	            sort( $terms_arr );

       	            if ( $terms_arr ) {
	       	    	 	$page_args['tax_query']['relation'] = 'OR';
			       	    $page_args['tax_query'][1] = $page_args['tax_query'][0];
   	    	            $page_args['tax_query'][0]['terms'] = $terms_arr;
   	    	            $page_args['tax_query'][1]['operator'] = 'NOT IN';
   	    	        }

   	    	        add_filter( 'posts_clauses', 'dt_core_join_left_filter' );
	       	    }

	       	} elseif ( 'albums' == $display['type'] && !empty($display['posts_ids']) ) {

		       	$display['posts_ids'] = array_values($display['posts_ids']);

	       	    if ( 'except' == $display['select'] ) {
	       	    	$page_args['post__not_in'] = $display['posts_ids'];
	       	    } else {
	       	    	$page_args['post__in'] = $display['posts_ids'];
	       	    }

	       	}

       	}

		$page_query = new WP_Query($page_args);
		remove_filter( 'posts_clauses', 'dt_core_join_left_filter' );

		$media_items = array(0);
		if ( $page_query->have_posts() ) {
			$media_items = array();
			foreach ( $page_query->posts as $gallery ) {
				$gallery_media = get_post_meta($gallery->ID, '_dt_album_media_items', true);
				if ( is_array($gallery_media) ) {
					$media_items = array_merge( $media_items, $gallery_media );
				}
			}
		}

		$media_items = array_unique( $media_items );

		// get attachments
		// ninjaaaa!!!
		$media_args = array(
			'post_type'         => 'attachment',
			'paged'				=> dt_get_paged_var(),
			'post_mime_type'    => 'image',
			'post_status'       => 'inherit',
			'post__in'			=> $media_items,
			'orderby'			=> 'post__in',
		);

		if ( $ppp ) {
	        $media_args['posts_per_page'] = intval($ppp);
	    }

		return new WP_Query( $media_args );
	}
}

endif;

/*******************************************************************/
// Slideshow post type
/*******************************************************************/

if ( !class_exists('Presscore_Inc_Slideshow_Post_Type') ):

class Presscore_Inc_Slideshow_Post_Type {
	public static $post_type = 'dt_slideshow';
	public static $taxonomy = 'dt_slideshow_category';
	public static $menu_position = 52; 

	public static function register() {

		// titles
		$labels = array(
		    'name'                  => _x('Slideshows', 'backend albums', LANGUAGE_ZONE),
		    'singular_name'         => _x('Slider', 'backend albums', LANGUAGE_ZONE),
		    'add_new'               => _x('Add New', 'backend albums', LANGUAGE_ZONE),
		    'add_new_item'          => _x('Add New Slider', 'backend albums', LANGUAGE_ZONE),
		    'edit_item'             => _x('Edit Slider', 'backend albums', LANGUAGE_ZONE),
		    'new_item'              => _x('New Slider', 'backend albums', LANGUAGE_ZONE),
		    'view_item'             => _x('View Slider', 'backend albums', LANGUAGE_ZONE),
		    'search_items'          => _x('Search for Slideshow', 'backend albums', LANGUAGE_ZONE),
		    'not_found'             => _x('No Slideshow Found', 'backend albums', LANGUAGE_ZONE),
		    'not_found_in_trash'    => _x('No Slideshow Found in Trash', 'backend albums', LANGUAGE_ZONE), 
		    'parent_item_colon'     => '',
		    'menu_name'             => _x('Slideshows', 'backend albums', LANGUAGE_ZONE)
		);

		$img = PRESSCORE_URI . '/admin/assets/images/admin_ico_slides.png';

		// options
		$args = array(
		    'labels'                => $labels,
		    'public'                => true,
		    'publicly_queryable'    => true,
		    'show_ui'               => true,
		    'show_in_menu'          => true, 
		    'query_var'             => true,
		    'rewrite'               => true,
		    'capability_type'       => 'post',
		    'has_archive'           => true, 
		    'hierarchical'          => false,
		    'menu_position'         => self::$menu_position,
		    'menu_icon'             => $img,
		    'supports'              => array( 'title', 'thumbnail' )
		);
		register_post_type( self::$post_type, $args );
		/* post type end */
	}

	/**
	 * Get slideshows by terms.
	 *
	 */
	public static function get_by_terms( $terms = array(), $field = 'slug', $ppp = -1, $op = 'IN' ) {
		if ( empty( $terms ) ) return false;

		return new WP_Query( array(
			'post_type'			=> self::$post_type,
			'status'			=> 'publish',
			'posts_per_page'	=> $ppp,
			'tax_query' => array( array(
		    	'taxonomy'	=> self::$taxonomy,
		    	'field'		=> $field,
		    	'terms'		=> array_values($terms),
		    	'operator'	=> $op,
		    ) ),
		) );
	}

	/**
	 * Get slideshows by ids.
	 *
	 */
	public static function get_by_id( $ids = array(), $ppp = -1, $op = 'IN' ) {
		if ( is_array( $ids ) ) {
			$ids = array_values($ids);
		} else {
			$ids = array_map( 'trim', explode( ',', $ids ) );
		}

		$args = array(
			'post_type'			=> self::$post_type,
			'status'			=> 'publish',
			'posts_per_page'	=> $ppp,
		);

		if ( !empty($ids) ) {
			if ( 'IN' == $op ) {
				$args['post__in'] = $ids;
			} else {
				$args['post__not_in'] = $ids;
			}
		}

		return new WP_Query( $args );
	}

}

endif;

// init post types
add_action( 'init', array('Presscore_Inc_Portfolio_Post_Type', 'register'), 15 );
add_action( 'init', array('Presscore_Inc_Testimonials_Post_Type', 'register'), 15 );
add_action( 'init', array('Presscore_Inc_Team_Post_Type', 'register'), 15 );
add_action( 'init', array('Presscore_Inc_Logos_Post_Type', 'register'), 15 );
add_action( 'init', array('Presscore_Inc_Albums_Post_Type', 'register'), 15 );
add_action( 'init', array('Presscore_Inc_Slideshow_Post_Type', 'register'), 15 );
