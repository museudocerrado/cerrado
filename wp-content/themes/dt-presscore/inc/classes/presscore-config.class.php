<?php
/**
 * Config class.
 *
 * @since presscore 1.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Singleton.
 *
 */
class Presscore_Config {

	private static $instance = null;

	private $options = array();

	private function __construct() {}

	public static function get_instance() {
		if ( !self::$instance ) {
			self::$instance = new Presscore_Config();
		}

		return self::$instance;
	}

	public function set( $name, $value = null ) {
		$this->options[ $name ] = $value;
	}

	public function get( $name = '' ) {
		if ( '' == $name ) {
			return $this->options;
		}
		if ( isset( $this->options[ $name ] ) ) {
			return $this->options[ $name ];
		}
		return null;
	}

	public function base_init() {
		global $post;

		if ( empty( $post ) ) {
			return;
		}

		$cur_post_type = get_post_type( $post->ID );
		switch ( $cur_post_type ) {
			case 'page': $this->set_page_vars(); break;
			case 'post': break;
			case 'dt_portfolio': break;
		}

		// common options
		$this->set_header_options();
		$this->set_sidebar_and_footer_options();
	}

	private function set_page_vars() {
		$this->set( 'page_id', get_the_ID() );
		switch ( $this->get('template') ) {
			case 'portfolio' : $this->set_template_portfolio_vars(); break;
			case 'albums' : $this->set_template_albums_vars(); break;
			case 'media' : $this->set_template_media_vars(); break;
			case 'blog' : $this->set_template_blog_vars(); break;
			case 'team' : $this->set_template_team_vars(); break;
			case 'testimonials' : $this->set_template_testimonials_vars(); break;
			default: return;
		}
	}

	private function set_template_portfolio_vars() {
		global $post;

		$prefix = '_dt_portfolio_options_';

		// populate options

		// for categorizer compatibility
		if ( !$this->get('order') ) {
			$this->set( 'order', get_post_meta( $post->ID, "{$prefix}order", true ) );
		}

		if ( !$this->get('orderby') ) {
			$this->set( 'orderby', get_post_meta( $post->ID, "{$prefix}orderby", true ) );
		}

		if ( !$this->get('display') ) {
			$this->set( 'display', get_post_meta( $post->ID, "_dt_portfolio_display", true ) );
		}

		$this->set( 'show_filter', get_post_meta( $post->ID, "{$prefix}show_filter", true ) );
		$this->set( 'show_ordering', get_post_meta( $post->ID, "{$prefix}show_ordering", true ) );
		
		switch ( dt_get_template_name() ) {
			case 'template-portfolio-masonry.php' : $layout = 'masonry_layout'; break;
			default: $layout = 'list_layout';
		}
		$this->set( 'layout', get_post_meta( $post->ID, $prefix . $layout, true ) );

		$this->set( 'posts_per_page', get_post_meta( $post->ID, "{$prefix}ppp", true ) );
		
		$this->set( 'columns', get_post_meta( $post->ID, "{$prefix}columns", true ) );
		$this->set( 'all_the_same_width', get_post_meta( $post->ID, "{$prefix}posts_same_width", true ) );
		
		$this->set( 'description', get_post_meta( $post->ID, "{$prefix}description", true ) );
		$this->set( 'image_layout', get_post_meta( $post->ID, "{$prefix}image_layout", true ) );
		$this->set( 'thumb_proportions', get_post_meta( $post->ID, "{$prefix}thumb_proportions", true ) );
		
		$this->set( 'show_titles', get_post_meta( $post->ID, "{$prefix}show_titles", true ) );
		$this->set( 'show_excerpts', get_post_meta( $post->ID, "{$prefix}show_exerpts", true ) );
		$this->set( 'show_terms', get_post_meta( $post->ID, "{$prefix}show_terms", true ) );
		$this->set( 'show_links', get_post_meta( $post->ID, "{$prefix}show_links", true ) );
		$this->set( 'show_details', get_post_meta( $post->ID, "{$prefix}show_details", true ) );

		$this->set( 'show_all_pages', get_post_meta( $post->ID, "{$prefix}show_all_pages", true ) );
	}

	private function set_template_albums_vars() {
		global $post;

		$prefix = '_dt_albums_options_';

		// populate options

		// for categorizer compatibility
		if ( !$this->get('order') ) {
			$this->set( 'order', get_post_meta( $post->ID, "{$prefix}order", true ) );
		}

		if ( !$this->get('orderby') ) {
			$this->set( 'orderby', get_post_meta( $post->ID, "{$prefix}orderby", true ) );
		}

		if ( !$this->get('display') ) {
			$this->set( 'display', get_post_meta( $post->ID, "_dt_albums_display", true ) );
		}

		$this->set( 'show_filter', get_post_meta( $post->ID, "{$prefix}show_filter", true ) );
		$this->set( 'show_ordering', get_post_meta( $post->ID, "{$prefix}show_ordering", true ) );
		
		$this->set( 'layout', get_post_meta( $post->ID, "{$prefix}layout", true ) );

		$this->set( 'posts_per_page', get_post_meta( $post->ID, "{$prefix}ppp", true ) );
		
		$this->set( 'columns', get_post_meta( $post->ID, "{$prefix}columns", true ) );
		$this->set( 'all_the_same_width', get_post_meta( $post->ID, "{$prefix}posts_same_width", true ) );
		
		$this->set( 'description', get_post_meta( $post->ID, "{$prefix}description", true ) );
		$this->set( 'image_layout', get_post_meta( $post->ID, "{$prefix}image_layout", true ) );
		$this->set( 'thumb_proportions', get_post_meta( $post->ID, "{$prefix}thumb_proportions", true ) );
		
		$this->set( 'show_titles', get_post_meta( $post->ID, "{$prefix}show_titles", true ) );
		$this->set( 'show_excerpts', get_post_meta( $post->ID, "{$prefix}show_exerpts", true ) );
		$this->set( 'show_terms', get_post_meta( $post->ID, "{$prefix}show_terms", true ) );

		$this->set( 'show_all_pages', get_post_meta( $post->ID, "{$prefix}show_all_pages", true ) );
	}

	private function set_template_media_vars() {
		global $post;

		$prefix = '_dt_media_options_';

		// populate options

		$this->set( 'order', get_post_meta( $post->ID, "{$prefix}order", true ) );

		$this->set( 'orderby', get_post_meta( $post->ID, "{$prefix}orderby", true ) );

		$this->set( 'display', get_post_meta( $post->ID, "_dt_albums_media_display", true ) );

		$this->set( 'show_filter', get_post_meta( $post->ID, "{$prefix}show_filter", true ) );
		$this->set( 'show_ordering', get_post_meta( $post->ID, "{$prefix}show_ordering", true ) );
		
		$this->set( 'layout', get_post_meta( $post->ID, "{$prefix}layout", true ) );

		$this->set( 'posts_per_page', get_post_meta( $post->ID, "{$prefix}ppp", true ) );
		
		$this->set( 'columns', get_post_meta( $post->ID, "{$prefix}columns", true ) );
		
		$this->set( 'description', get_post_meta( $post->ID, "{$prefix}description", true ) );
		$this->set( 'image_layout', get_post_meta( $post->ID, "{$prefix}image_layout", true ) );
		$this->set( 'thumb_proportions', get_post_meta( $post->ID, "{$prefix}thumb_proportions", true ) );
		
		$this->set( 'show_excerpts', get_post_meta( $post->ID, "{$prefix}show_exerpts", true ) );
		$this->set( 'show_titles', get_post_meta( $post->ID, "{$prefix}show_titles", true ) );

		$this->set( 'show_all_pages', get_post_meta( $post->ID, "{$prefix}show_all_pages", true ) );
	}

	private function set_template_blog_vars() {
		global $post;

		$prefix = '_dt_blog_options_';

		// populate options
		$this->set( 'display', get_post_meta( $post->ID, "_dt_blog_display", true ) );
		$this->set( 'order', get_post_meta( $post->ID, "{$prefix}order", true ) );
		$this->set( 'orderby', get_post_meta( $post->ID, "{$prefix}orderby", true ) );

		switch ( dt_get_template_name() ) {
			case 'template-blog-masonry.php' : $this->set( 'layout', get_post_meta( $post->ID, "{$prefix}layout", true ) ); break;
			default: $this->set( 'layout', 'list' );
		}
		
		$this->set( 'image_layout', get_post_meta( $post->ID, "{$prefix}image_layout", true ) );
		$this->set( 'thumb_proportions', get_post_meta( $post->ID, "{$prefix}thumb_proportions", true ) );
		
		$this->set( 'posts_per_page', get_post_meta( $post->ID, "{$prefix}ppp", true ) );
		
		$this->set( 'columns', get_post_meta( $post->ID, "{$prefix}columns", true ) );
		$this->set( 'all_the_same_width', get_post_meta( $post->ID, "{$prefix}posts_same_width", true ) );

		$this->set( 'show_all_pages', get_post_meta( $post->ID, "{$prefix}show_all_pages", true ) );
	}

	private function set_template_team_vars() {
		global $post;

		$prefix = '_dt_team_options_';

		// populate options
		$this->set( 'layout', get_post_meta( $post->ID, "{$prefix}masonry_layout", true ) );
		$this->set( 'posts_per_page', get_post_meta( $post->ID, "{$prefix}ppp", true ) );
		$this->set( 'columns', get_post_meta( $post->ID, "{$prefix}columns", true ) );
		$this->set( 'display', get_post_meta( $post->ID, "_dt_team_display", true ) );
	}

	private function set_template_testimonials_vars() {
		global $post;

		$prefix = '_dt_testimonials_options_';

		// populate options
		$this->set( 'layout', get_post_meta( $post->ID, "{$prefix}masonry_layout", true ) );
		$this->set( 'posts_per_page', get_post_meta( $post->ID, "{$prefix}ppp", true ) );
		$this->set( 'columns', get_post_meta( $post->ID, "{$prefix}columns", true ) );
		$this->set( 'display', get_post_meta( $post->ID, "_dt_testimonials_display", true ) );
	}

	private function set_header_options() {
		global $post;

		// Header options
		$prefix = '_dt_header_';
		$this->set( 'header_title', get_post_meta( $post->ID, "{$prefix}title", true ) );
		$this->set( 'header_background', get_post_meta( $post->ID, "{$prefix}background", true ) );

		// Fancy header options
		$prefix = '_dt_fancy_header_';
		$this->set( 'fancy_header_title', get_post_meta( $post->ID, "{$prefix}title", true ) );
		$this->set( 'fancy_header_title_color', get_post_meta( $post->ID, "{$prefix}title_color", true ) );
		$this->set( 'fancy_header_title_aligment', get_post_meta( $post->ID, "{$prefix}title_aligment", true ) );

		$this->set( 'fancy_header_subtitle', get_post_meta( $post->ID, "{$prefix}subtitle", true ) );
		$this->set( 'fancy_header_subtitle_color', get_post_meta( $post->ID, "{$prefix}subtitle_color", true ) );

		$this->set( 'fancy_header_height', get_post_meta( $post->ID, "{$prefix}height", true ) );
		
		$this->set( 'fancy_header_bg_color', get_post_meta( $post->ID, "{$prefix}bg_color", true ) );
		$this->set( 'fancy_header_bg_image', get_post_meta( $post->ID, "{$prefix}bg_image", true ) );
		$this->set( 'fancy_header_bg_repeat', get_post_meta( $post->ID, "{$prefix}bg_repeat", true ) );
		$this->set( 'fancy_header_bg_position_x', get_post_meta( $post->ID, "{$prefix}bg_position_x", true ) );
		$this->set( 'fancy_header_bg_position_y', get_post_meta( $post->ID, "{$prefix}bg_position_y", true ) );
		$this->set( 'fancy_header_bg_fullscreen', get_post_meta( $post->ID, "{$prefix}bg_fullscreen", true ) );

		// Slideshow options
		$prefix = '_dt_slideshow_';
		
		$this->set( 'slideshow_mode', get_post_meta( $post->ID, "{$prefix}mode", true ) );
		
		$this->set( 'slideshow_sliders', get_post_meta( $post->ID, "{$prefix}sliders", false ) );
		$this->set( 'slideshow_layout', get_post_meta( $post->ID, "{$prefix}layout", true ) );

		$slider_prop = get_post_meta( $post->ID, "{$prefix}slider_proportions", true );
		if ( empty($slider_prop) ) {
			$slider_prop = array( 'width' => 1200, 'height' => 500 );
		}
		$this->set( 'slideshow_slider_width', $slider_prop['width'] );
		$this->set( 'slideshow_slider_height', $slider_prop['height'] );
		
		$this->set( 'slideshow_slider_scaling', get_post_meta( $post->ID, "{$prefix}scaling", true ) );

		$this->set( 'slideshow_3d_layout', get_post_meta( $post->ID, "{$prefix}3d_layout", true ) );
		
		$slider_3d_prop = get_post_meta( $post->ID, "{$prefix}3d_slider_proportions", true );
		if ( empty($slider_3d_prop) ) {
			$slider_3d_prop = array( 'width' => 500, 'height' => 500 );
		}
		$this->set( 'slideshow_3d_slider_width', $slider_3d_prop['width'] );
		$this->set( 'slideshow_3d_slider_height', $slider_3d_prop['height'] );

		$this->set( 'slideshow_autoslide_interval', get_post_meta( $post->ID, "{$prefix}autoslide_interval", true ) );
		$this->set( 'slideshow_autoplay', get_post_meta( $post->ID, "{$prefix}autoplay", true ) );
		
		$this->set( 'slideshow_slides_in_raw', get_post_meta( $post->ID, "{$prefix}slides_in_raw", true ) );
		$this->set( 'slideshow_slides_in_column', get_post_meta( $post->ID, "{$prefix}slides_in_column", true ) );
		
		$this->set( 'slideshow_revolution_slider', get_post_meta( $post->ID, "{$prefix}revolution_slider", true ) );
	}

	private function set_sidebar_and_footer_options() {
		global $post;

		// Sidebar options
		$prefix = '_dt_sidebar_';
		$this->set( 'sidebar_position', get_post_meta( $post->ID, "{$prefix}position", true ) );
		$this->set( 'sidebar_widgetarea_id', get_post_meta( $post->ID, "{$prefix}widgetarea_id", true ) );

		// Footer options
		$prefix = '_dt_footer_';
		$this->set( 'footer_show', get_post_meta( $post->ID, "{$prefix}show", true ) );
		$this->set( 'footer_widgetarea_id', get_post_meta( $post->ID, "{$prefix}widgetarea_id", true ) );
	}

}
