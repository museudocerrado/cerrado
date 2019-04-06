<?php
/**
 * presscore functions and definitions.
 *
 * @package presscore
 * @since presscore 0.1
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since presscore 0.1
 */
if ( ! isset( $content_width ) ) {
	$content_width = 890; /* pixels */
}

/**
 * Theme init file.
 *
 */
require( get_template_directory() . '/inc/init.php' );

if ( ! function_exists( 'presscore_setup' ) ) :
	
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which runs
	 * before the init hook. The init hook is too late for some features, such as indicating
	 * support post thumbnails.
	 *
	 * @since presscore 1.0
	 */
	function presscore_setup() {

		/**
		 * Make theme available for translation
		 * Translations can be filed in the /languages/ directory
		 */
		load_theme_textdomain( LANGUAGE_ZONE, get_template_directory() . '/languages' );

		/**
		 * Editor style.
		 */
		add_editor_style();

		/**
		 * Add default posts and comments RSS feed links to head
		 */
		add_theme_support( 'automatic-feed-links' );

		/**
		 * Enable support for Post Thumbnails
		 */
		add_theme_support( 'post-thumbnails' );

		/**
		 * This theme uses wp_nav_menu() in one location.
		 */
		register_nav_menus( array(
			'primary' 	=> __( 'Primary Menu', LANGUAGE_ZONE ),
			'top'		=> __( 'Top Menu', LANGUAGE_ZONE ),
			'bottom'	=> __( 'Bottom Menu', LANGUAGE_ZONE ),
		) );

		/**
		 * Enable support for Post Formats
		 */
		add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link', 'gallery', 'chat', 'status' ) );

		/**
		 * Allow shortcodes in widgets.
		 *
		 */
		add_filter( 'widget_text', 'do_shortcode' );

		// create upload dir
		wp_upload_dir();

		/**
		 * Include helpers.
		 *
		 */
		require_once( PRESSCORE_DIR . '/helpers.php' );

		/**
		 * Include stylesheet related functions.
		 *
		 */
		require_once( PRESSCORE_EXTENSIONS_DIR . '/stylesheet-functions.php' );

		/**
		 * Include WP-Less.
		 *
		 */
		require_once( PRESSCORE_EXTENSIONS_DIR . '/wp-less/bootstrap-for-theme.php' );

		// less manipulations
		if ( class_exists('WPLessPlugin') ) {
			$less = WPLessPlugin::getInstance();
			$less->dispatch();
		}

		/**
		 * Less variables.
		 *
		 * @since presscore 0.5
		 */
		require_once( PRESSCORE_DIR . '/less-vars.php' );

		/**
		 * Include options framework if it is not installed like plugin.
		 *
		 */
		if ( !defined('OPTIONS_FRAMEWORK_VERSION') ) {
			
			// Base
			require_once( PRESSCORE_EXTENSIONS_DIR . '/options-framework/options-framework.php' );
			
			/**
			 * Set theme options path.
			 *
			 */
			function presscore_add_theme_options() {
				return array( 'inc/admin/options.php' );
			}
			add_filter( 'options_framework_location', 'presscore_add_theme_options' );
		}

		/**
		 * Include admin functions.
		 *
		 */
		if ( is_admin() ) :

			/**
			 * Include the TGM_Plugin_Activation class.
			 */
			require_once( PRESSCORE_EXTENSIONS_DIR . '/class-tgm-plugin-activation.php' );

			require_once( PRESSCORE_ADMIN_DIR . '/admin-functions.php' );
		endif;

		/**
		 * Include custom post typest.
		 *
		 */
		require_once( PRESSCORE_DIR . '/post-types.php' );

		// Include the meta box script
		if ( file_exists( RWMB_DIR . 'meta-box.php' ) ) {
			
			if ( is_admin() ) {	
				
				/**
				 * Include metaboxes overrides.
				 *
				 */
				require_once( PRESSCORE_EXTENSIONS_DIR . '/custom-meta-boxes/override-fields.php' ); 
			}

			/**
			 * Include Meta-Box framework.
			 *
			 */
			require_once( RWMB_DIR . 'meta-box.php' );

			if ( is_admin() ) {
				
				/**
				 * Include custom metaboxes.
				 *
				 */
				require_once( PRESSCORE_EXTENSIONS_DIR . '/custom-meta-boxes/metabox-fields.php' ); 

				/**
				 * Attach metaboxes.
				 *
				 */		
				if ( file_exists( PRESSCORE_ADMIN_DIR . '/metaboxes.php' ) ) {
					require_once( PRESSCORE_ADMIN_DIR . '/metaboxes.php' );
				}
			}
		}

		/**
		 * Include template actions and filters.
		 *
		 */
		require_once( PRESSCORE_DIR . '/template-tags.php' );

		/**
		 * Some additional classes ( remove in future ).
		 *
		 */
		require_once( PRESSCORE_CLASSES_DIR . '/tags.class.php' );

		/**
		 * Include paginator.
		 *
		 */
		require_once( PRESSCORE_EXTENSIONS_DIR . '/dt-pagination.php' );

		/**
		 * Include custom menu.
		 *
		 */
		require_once( PRESSCORE_EXTENSIONS_DIR . '/core-menu.php' );

		/**
		 * Include AQResizer.
		 *
		 */
		require_once( PRESSCORE_EXTENSIONS_DIR . '/aq_resizer.php' );

		/**
		 * Include core functions.
		 *
		 */
		require_once( PRESSCORE_EXTENSIONS_DIR . '/core-functions.php' );

		/**
		 * Include widgets.
		 *
		 */

		/* Widgets list */
		$presscore_widgets = array(
			'contact-info.php',
			'custom-menu-1.php',
			'custom-menu-2.php',
			'blog-posts.php',
			'blog-categories.php',
			'flickr.php',
			'portfolio.php',
			'progress-bars.php',
			'testimonials-list.php',
			'testimonials-slider.php',
			'team.php',
			'logos.php',
			'photos.php',
			'contact-form.php',
			'accordion.php',
		);
		$presscore_widgets = apply_filters( 'presscore_widgets', $presscore_widgets );
		foreach ( $presscore_widgets as $presscore_widget ) {
			require_once( trailingslashit( PRESSCORE_WIDGETS_DIR ) . $presscore_widget );
		}

		// List of shortcodes folders to include
		// All folders located in /include
		$presscore_shortcodes = array(
			'layout-builder',
			'columns',
			'box',
			'gap',
			'divider',
			'stripes',

			'fancy-image',
			'list',
			'button',
			'tooltips',
			'highlight',
			'code',
			
			'tabs',
			'accordion',
			'toggles',

			'quote',
			'call-to-action',
			'shortcode-teasers',
			'banner',
			'benefits',
			'progress-bars',
			'contact-form',
			'social-icons',
			'map',
			
			'blog-posts-small',
			'blog-posts',
			'portfolio',
			'small-photos',
			'slideshow',
			'team',
			'testimonials',
			'logos',
			
			'gallery',

			'animated-text'
		);
		$presscore_shortcodes = apply_filters( 'presscore_shortcodes', $presscore_shortcodes );
		if ( $presscore_shortcodes ) {

			/**
			 * Setup shortcodes.
			 *
			 */
			require_once( PRESSCORE_SHORTCODES_DIR . '/setup.php' );

			foreach ( $presscore_shortcodes as $shortcode_dirname ) {
				$file_path =  trailingslashit( PRESSCORE_SHORTCODES_INCLUDES_DIR ) . $shortcode_dirname . '/functions.php';

				if ( file_exists( $file_path ) ) {
					require_once( $file_path );
				}
			}
		}

		/**
		 * Add woocommerce support.
		 *
		 */
		require_once( trailingslashit( PRESSCORE_DIR ) . 'woocommerce-support.php' );
	}

endif; // presscore_setup

add_action( 'after_setup_theme', 'presscore_setup', 15 );


if ( ! function_exists('presscore_layout_builder_controller') ) :

	/**
	 * WYSIWYG layout builder filter.
	 *
	 */
	function presscore_layout_builder_controller() {
		if ( function_exists('of_get_option') && class_exists('DT_ADD_MCE_BUTTON') ) {

			// remove shortcodes buttons from wysiwyg
			if ( of_get_option( 'general-wysiwig_visual_columns' ) ) {
				unset( DT_ADD_MCE_BUTTON::$plugins['columns'] );
				unset( DT_ADD_MCE_BUTTON::$plugins['box'] );
			} else {
				unset( DT_ADD_MCE_BUTTON::$plugins['layout-builder'] );
			}

		}
	}

endif; // presscore_layout_builder_controller

add_filter( 'init', 'presscore_layout_builder_controller' );


if ( ! function_exists('presscore_set_first_run_skin') ) :

	/**
	 * Set first run skin.
	 *
	 */
	function presscore_set_first_run_skin( $skin_name = '' ) {
		return 'red';
	}

endif; // presscore_set_first_run_skin

add_filter( 'options_framework_first_run_skin', 'presscore_set_first_run_skin' );


/**
 * Flush your rewrite rules.
 */
function presscore_flush_rewrite_rules() {
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'presscore_flush_rewrite_rules' );


if ( ! function_exists('presscore_generate_less_css_file_after_options_save') ) :

	/**
	 * Update custom.less stylesheet.
	 */
	function presscore_generate_less_css_file_after_options_save() {
		
		$set = get_settings_errors('options-framework');
		if ( !empty( $set ) ) {
			presscore_generate_less_css_file();

			if ( get_option( 'presscore_less_css_is_writable' ) ) {
				add_settings_error( 'presscore-wp-less', 'save_stylesheet', _x( 'Stylesheet saved.', 'backend', LANGUAGE_ZONE ), 'updated fade' );
			}
		}

	}

endif; // presscore_generate_less_css_file_after_options_save

add_action( 'admin_init', 'presscore_generate_less_css_file_after_options_save', 11 );


if ( ! function_exists('presscore_widgets_init') ) :

	/**
	 * Register widgetized area and
	 *
	 * @since presscore 0.1
	 */
	function presscore_widgets_init() {

		if ( function_exists('of_get_option') ) {

			$w_params = array(
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget' 	=> '</section>',
				'before_title' 	=> '<div class="widget-title">',
				'after_title'	=> '</div>'
			);

			$w_areas = apply_filters( 'presscore_widgets_init-sidebars', of_get_option( 'widgetareas', false ) );

			if ( !empty( $w_areas ) && is_array( $w_areas ) ) {
				
				$prefix = 'sidebar_';
				
				foreach( $w_areas as $sidebar_id=>$sidebar ) {
					
					$sidebar_args = array(
						'name' 			=> isset( $sidebar['sidebar_name'] ) ? $sidebar['sidebar_name'] : '',
						'id' 			=> $prefix . $sidebar_id,
						'description' 	=> isset( $sidebar['sidebar_desc'] ) ? $sidebar['sidebar_desc'] : '',
						'before_widget' => $w_params['before_widget'],
						'after_widget' 	=> $w_params['after_widget'],
						'before_title' 	=> $w_params['before_title'],
						'after_title'	=> $w_params['after_title'] 
					);

					$sidebar_args = apply_filters( 'presscore_widgets_init-sidebar_args', $sidebar_args, $sidebar_id, $sidebar );

					register_sidebar( $sidebar_args );
				}
			
			}

		}
	}

endif; // presscore_widgets_init

add_action( 'widgets_init', 'presscore_widgets_init' );


if ( ! function_exists( 'presscore_enqueue_scripts' ) ) :

	/**
	 * Enqueue scripts and styles.
	 */
	function presscore_enqueue_scripts() {
		$config = Presscore_Config::get_instance();

		$template_uri = get_template_directory_uri();

		// enqueue web fonts if needed
		presscore_enqueue_web_fonts();

		wp_enqueue_style( 'dt-normalize', $template_uri . '/css/normalize.css' );
		wp_enqueue_style( 'dt-wireframe', $template_uri . '/css/wireframe.css' );
		wp_enqueue_style( 'dt-main', $template_uri . '/css/main.css' );
		wp_enqueue_style( 'dt-media', $template_uri . '/css/media.css' );

		if ( get_option( 'presscore_less_css_is_writable' ) ) {
			wp_enqueue_style( 'dt-custom.less', $template_uri . '/css/custom.less' );
		} else {
			// get current skin name
			$preset = of_get_option( 'preset', 'red' );

			// load skin precompiled css
			wp_enqueue_style( 'dt-compiled-custom.less', $template_uri . '/css/compiled/custom-' . esc_attr($preset) . '.css' );
		}
		
		if ( dt_retina_on() ) {
			wp_enqueue_style( 'dt-highdpi', $template_uri . '/css/highdpi.css' );
		}

		wp_enqueue_style( 'style', get_stylesheet_uri() );
		
		// RoyalSlider
		wp_enqueue_style( 'dt-royalslider', $template_uri . '/royalslider/royalslider.css' );

		wp_enqueue_style( 'dt-prettyPhoto', $template_uri . '/js/plugins/pretty-photo/css/prettyPhoto.css' );
		
		// in header
		wp_enqueue_script( 'dt-modernizr', $template_uri . '/js/modernizr.js', array( 'jquery' ) );
		
		// in footer
		wp_enqueue_script( 'dt-royalslider', $template_uri . '/royalslider/jquery.royalslider.js', array( 'jquery' ), null, true );
		wp_enqueue_script( 'dt-prettyPhoto', $template_uri . '/js/plugins/pretty-photo/js/jquery.prettyPhoto.js', array( 'jquery' ), null, true );	
		wp_enqueue_script( 'dt-plugins', $template_uri . '/js/plugins.js', array( 'jquery' ), null, true );	
		
		wp_enqueue_script( 'dt-main', $template_uri . '/js/main.js', array( 'jquery' ), '1.0', true );
		
		// add some additional data
		wp_localize_script( 'dt-main', 'dtLocal', array(
			'passText'		=> __('To view this protected post, enter the password below:', LANGUAGE_ZONE),
			'ajaxurl'		=> admin_url( 'admin-ajax.php' ),
			'contactNonce'	=> wp_create_nonce('dt_contact_form'),
		) );

		// additional scripts
		wp_enqueue_script( 'dt-dev-code', $template_uri . '/js/dt-dev-code.js', array( 'jquery', 'dt-main' ), '1.0', true );

		// comments clear script
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}

endif; // presscore_enqueue_scripts

add_action( 'wp_enqueue_scripts', 'presscore_enqueue_scripts', 15 );


if ( ! function_exists( 'presscore_admin_scripts' ) ) :

	/**
	 * Add metaboxes scripts and styles.
	 */
	function presscore_admin_scripts( $hook ) {
		if ( !in_array( $hook, array( 'post-new.php', 'post.php' ) ) ) {
			return;
		}

		$template_uri = get_template_directory_uri();

		wp_enqueue_style( 'dt-mb-magick', $template_uri . '/inc/admin/assets/admin_mbox_magick.css' );

		wp_enqueue_script( 'dt-metaboxses-scripts', $template_uri . '/inc/admin/assets/custom-metaboxes.js', array('jquery'), false, true );
		wp_enqueue_script( 'dt-mb-magick', $template_uri . '/inc/admin/assets/admin_mbox_magick.js', array('jquery'), false, true );
		wp_enqueue_script( 'dt-mb-switcher', $template_uri . '/inc/admin/assets/admin_mbox_switcher.js', array('jquery'), false, true );

		// for proportion ratio metabox field
		$proportions = presscore_meta_boxes_get_images_proportions();
		$proportions['length'] = count( $proportions );
		wp_localize_script( 'dt-metaboxses-scripts', 'rwmbImageRatios', $proportions );
	}

endif; // presscore_admin_scripts

add_action( 'admin_enqueue_scripts', 'presscore_admin_scripts', 11 );


if ( ! function_exists( 'presscore_setup_admin_scripts' ) ) :

	/**
	 * Add widgets scripts. Enqueued only for widgets.php.
	 */
	function presscore_setup_admin_scripts( $hook ) {

		if ( 'widgets.php' != $hook ) {
			return;
		}

		if ( function_exists( 'wp_enqueue_media' ) ) {
			wp_enqueue_media();
		}

		// enqueue wp colorpicker
		wp_enqueue_style( 'wp-color-picker' );

		// presscore stuff
		wp_enqueue_style( 'dt-admin-widgets', PRESSCORE_ADMIN_URI . '/assets/admin-widgets.css' );
		wp_enqueue_script( 'dt-admin-widgets', PRESSCORE_ADMIN_URI . '/assets/admin_widgets_page.js', array('jquery', 'wp-color-picker'), false, true );

		wp_localize_script( 'dt-admin-widgets', 'dtWidgtes', array(
			'title'			=> _x( 'Title', 'widget', LANGUAGE_ZONE ),
			'content'		=> _x( 'Content', 'widget', LANGUAGE_ZONE ),
			'percent'		=> _x( 'Percent', 'widget', LANGUAGE_ZONE ),
			'showPercent'	=> _x( 'Show', 'widget', LANGUAGE_ZONE ),
		) );

	}

endif; // presscore_setup_admin_scripts

add_action( 'admin_enqueue_scripts', 'presscore_setup_admin_scripts', 15 );


if ( ! function_exists( 'presscore_themeoptions_add_share_buttons' ) ) :

	/**
	 * Add some share buttons to theme options.
	 */
	function presscore_themeoptions_add_share_buttons( $buttons ) {
		$theme_soc_buttons = presscore_themeoptions_get_social_buttons_list();
		if ( $theme_soc_buttons && is_array( $theme_soc_buttons ) ) {
			$buttons = array_merge( $buttons, $theme_soc_buttons );
		}
		return $buttons;
	}

endif; // presscore_themeoptions_add_share_buttons

add_filter( 'optionsframework_interface-social_buttons', 'presscore_themeoptions_add_share_buttons', 15 );


if ( ! function_exists( 'presscore_dt_paginator_args_filter' ) ) :
	
	/**
	 * PressCore dt_paginator args filter.
	 *
	 * @param array $args Paginator args.
	 * @return array Filtered $args.
	 */
	function presscore_dt_paginator_args_filter( $args ) {
		global $post;
		$config = Presscore_Config::get_instance();

		// show all pages in paginator
		$show_all_pages = '0';

		if ( is_page() ) {
			$show_all_pages = $config->get( 'show_all_pages' );
		}

		if ( '0' != $show_all_pages ) {
			$args['num_pages'] = 9999;
		} else {
			$args['num_pages'] = 5;
		}

		$args['wrap'] = '
		<div class="paginator" role="navigation">
			<div class="page-links">%LIST%
		';
		$args['pages_wrap'] = '
			</div>
			<div class="page-nav">
				%PREV%%NEXT%
			</div>
		</div>
		';
		$args['item_wrap'] = '<a href="%HREF%" %CLASS_ACT%>%TEXT%</a>';
		$args['first_wrap'] = '<a href="%HREF%" %CLASS_ACT%>%FIRST_PAGE%</a>';
		$args['last_wrap'] = '<a href="%HREF%" %CLASS_ACT%>%LAST_PAGE%</a>';
		$args['dotleft_wrap'] = '<a href="javascript: void(0);" class="dots">%TEXT%</a>'; 
		$args['dotright_wrap'] = '<a href="javascript: void(0);" class="dots">%TEXT%</a>';// %TEXT%
		$args['pages_prev_class'] = 'nav-prev';
		$args['pages_next_class'] = 'nav-next';
		$args['act_class'] = 'act';
		$args['next_text'] = _x( 'Next page', 'paginator', LANGUAGE_ZONE );
		$args['prev_text'] = _x( 'Prev page', 'paginator', LANGUAGE_ZONE );
		$args['no_next'] = '';
		$args['no_prev'] = '';
		$args['first_is_first_mode'] = true;
		
		return $args;
	}

endif; // presscore_dt_paginator_args_filter

add_filter( 'dt_paginator_args', 'presscore_dt_paginator_args_filter' );


if ( ! function_exists( 'presscore_comment_id_fields_filter' ) ) :

	/**
	 * PressCore comments fields filter. Add Post Comment and clear links before hudden fields.
	 *
	 * @since presscore 0.1
	 */
	function presscore_comment_id_fields_filter( $result ) {
		$comment_buttons = '<a class="clear-form" href="javascript: void(0);">' . __( 'clear', LANGUAGE_ZONE ) . '</a>';
		$comment_buttons .= '<a class="dt-btn dt-btn-m" href="javascript: void(0);">' . __('Post Comment', LANGUAGE_ZONE) . '</a>';
		
		return $comment_buttons . $result;
	}

endif; // presscore_comment_id_fields_filter

add_filter( 'comment_id_fields', 'presscore_comment_id_fields_filter' );


if ( ! function_exists( 'presscore_comment' ) ) :

	/**
	 * Template for comments and pingbacks.
	 *
	 * Used as a callback by wp_list_comments() for displaying the comments.
	 *
	 * @since presscore 1.0
	 */
	function presscore_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;

		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' :
		?>
		<li class="pingback">
			<div class="pingback-content">
				<span><?php _e( 'Pingback:', LANGUAGE_ZONE ); ?></span>
				<?php comment_author_link(); ?>
				<?php edit_comment_link( __( '(Edit)', LANGUAGE_ZONE ), ' ' ); ?>
			</div>
		<?php
				break;
			default :
		?>
		<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
			
			<article id="div-comment-<?php comment_ID(); ?>">

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'add_below' => 'div-comment', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
			
			<div class="comment-meta">
				<time datetime="<?php comment_time( 'c' ); ?>">
				<?php
					/* translators: 1: date, 2: time */
					// TODO: add date/time format (for qTranslate)
					printf( __( '%1$s at %2$s', LANGUAGE_ZONE ), get_comment_date(), get_comment_time() ); ?>
				</time>
				<?php edit_comment_link( __( '(Edit)', LANGUAGE_ZONE ), ' ' ); ?>
			</div><!-- .comment-meta -->
			
			<div class="comment-author vcard">
				<?php if ( dt_validate_gravatar( $comment->comment_author_email ) ) :	?>
					<?php echo get_avatar( $comment, 60 ); ?>
				<?php else : ?>
					<span class="avatar no-avatar"></span>
				<?php endif; ?>
				<?php printf( '<cite class="fn">%s</cite>', get_comment_author_link() ); ?>
			</div><!-- .comment-author .vcard -->

			<?php if ( $comment->comment_approved == '0' ) : ?>
				<em><?php _e( 'Your comment is awaiting moderation.', LANGUAGE_ZONE ); ?></em>
				<br />
			<?php endif; ?>

			<div class="comment-content"><?php comment_text(); ?></div>

			</article>

		<?php
				break;
		endswitch;
	}

endif; // presscore_comment


if ( ! function_exists( 'presscore_body_class' ) ) :

	/**
	 * Add theme speciffik classes to body.
	 *
	 * @since presscore 1.0
	 */
	function presscore_body_class( $classes ) {
		$config = Presscore_Config::get_instance();

		$desc_on_hoover = ( 'on_hoover' == $config->get('description') );

		// template classes
		switch ( $config->get('template') ) {
			case 'blog': $classes[] = 'blog'; break;
			case 'portfolio': $classes[] = 'portfolio'; break;
			case 'team': $classes[] = 'team'; break;
			case 'testimonials': $classes[] = 'testimonials'; break;
			case 'archive': $classes[] = 'archive'; break;
			case 'search': $classes[] = 'search'; break;
			case 'albums': $classes[] = 'albums'; break;
			case 'media': $classes[] = 'media'; break;
		}

		// layout classes
		switch ( $config->get('layout') ) {
			case 'masonry':
				if ( $desc_on_hoover ) {
					$classes[] = 'layout-masonry-grid';
				} else {
					$classes[] = 'layout-masonry';
				}
				break;
			case 'grid':
				$classes[] = 'layout-grid';
				if ( $desc_on_hoover ) $classes[] = 'grid-text-hovers';
				break;
			case 'checkerboard':
			case 'list': $classes[] = 'layout-list'; break;
		}

		// hide dividers if content is off
		if ( in_array($config->get('template'), array('albums', 'portfolio')) && 'masonry' == $config->get('layout') ) {
			$show_dividers = $config->get('show_titles') || $config->get('show_details') || $config->get('show_excerpts') || $config->get('show_terms') || $config->get('show_links');
			if ( !$show_dividers ) $classes[] = 'description-off';
		}

		if ( is_single() ) {
			$post_type = get_post_type();
			if ( 'dt_portfolio' == $post_type && ( post_password_required() || ( !comments_open() && '0' == get_comments_number() ) ) ) {
				$classes[] = 'no-comments';
			}
		}

		if ( in_array('single-dt_portfolio', $classes) ) {
			$key = array_search('single-dt_portfolio', $classes);
			$classes[ $key ] = 'single-portfolio';
		}

		if ( 'fancy' == $config->get( 'header_title' ) ) {
			$classes[] = 'fancy-header-on';
		} elseif ( 'slideshow' == $config->get( 'header_title' ) ) {
			$classes[] = 'slideshow-on';

			if ( '3d' == $config->get( 'slideshow_mode' ) && 'fullscreen-content' == $config->get( 'slideshow_3d_layout' ) ) {
				$classes[] = 'threed-fullscreen';
			}

		} elseif ( is_single() && 'disabled' == $config->get( 'header_title' ) ) {
			$classes[] = 'title-off';
		}

		// hoover style
		switch( of_get_option('hoover-style', 'none') ) {
			case 'grayscale': $classes[] = 'filter-grayscale-static'; break;
			case 'gray+color': $classes[] = 'filter-grayscale'; break;
		}

		// add boxed-class to body
		if ( 'boxed' == of_get_option('general-layout', 'wide') ) {
			$classes[] = 'boxed-layout';
		}

		return array_values( array_unique( $classes ) );
	}

endif; // presscore_body_class

add_filter( 'body_class', 'presscore_body_class' );


if ( ! function_exists( 'presscore_post_types_author_archives' ) ) :

	/**
	 * Add Custom Post Types to Author Archives
	 */
	function presscore_post_types_author_archives( $query ) {
		
		// Add 'videos' post type to author archives
		if ( $query->is_author ) {
			$post_type = $query->get( 'post_type' );
			$query->set( 'post_type', array_merge( (array) $post_type, array('dt_portfolio', 'post') ) );
		}
		
		// Remove the action after it's run
		remove_action( 'pre_get_posts', 'presscore_post_types_author_archives' );
	}

endif; // presscore_post_types_author_archives

add_action( 'pre_get_posts', 'presscore_post_types_author_archives' );