<?php
/**
 * PressCore helpers.
 *
 * @package presscore
 * @since presscore 0.1
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Check if comments will be displayed for this post.
 *
 * Return true if post not passwod protected or comments opened or even though one comment exisis.
 *
 * @return boolean;
 */
function presscore_comments_will_be_displayed() {
	return !( post_password_required() || ( !comments_open() && '0' == get_comments_number() ) );
}

if ( ! function_exists( 'presscore_post_navigation' ) ) :

	/**
	 * Next/previous post buttons helper.
	 *
	 * Works only in the loop. Sample options array:
	 * array(
	 *		'wrap'				=> '<div class="paginator-r inner-navig">%LINKS%</div>',
	 *		'title_wrap'		=> '<span class="pagin-info">%TITLE%</span>',
	 *		'no_link_next'		=> '<a href="#" class="prev no-act" onclick="return false;"></a>',
	 *		'no_link_prev'		=> '<a href="#" class="next no-act" onclick="return false;"></a>',
	 *		'title'				=> 'Post %CURRENT% of %MAX%',
	 *		'next_post_class'	=> 'prev',
	 *		'prev_post_class'	=> 'next',
	 *		 next_post_text'	=> '',
	 *		'prev_post_text'	=> '',
	 *		'echo'				=> true
	 * )
	 *
	 * @param array $args Options array.
	 * @since presscore 1.0
	 */
	function presscore_post_navigation( $args = array() ) {
		global $wpdb, $post;
		
		if ( !in_the_loop() ) {
			return false;
		}
			
		$defaults = array(
			'wrap'				=> '<div class="navigation-inner">%LINKS%</div>',
			'title_wrap'		=> '',
			'no_link_next'		=> '<a class="prev-post disabled" href="javascript: void(0);"></a>',
			'no_link_prev'		=> '<a class="next-post disabled" href="javascript: void(0);"></a>',
			'title'				=> '',
			'next_post_class'	=> 'prev-post',
			'prev_post_class'	=> 'next-post',
			'next_post_text'	=> '',
			'prev_post_text'	=> '',
			'echo'				=> true
		);
		$args = apply_filters( 'presscore_post_navigation-args', wp_parse_args( $args, $defaults ) );
		$args = wp_parse_args( $args, $defaults );
		
		// TODO: separate logick from view

		$title = $args['title'];
		
		if ( false !== strpos( $title, '%CURRENT%' ) || false !== strpos( $title, '%MAX%' ) ) {

			$posts = new WP_Query( array(
				'no_found_rows'		=> true,
				'fields'			=> 'ids',
				'posts_per_page'	=> -1,
				'post_type'			=> get_post_type(),
				'post_status'		=> 'publish',
				'orderby'			=> 'date',
				'order'				=> 'DESC'
			) );
			
			$current = 1;
			foreach( $posts->posts as $index=>$post_id ) {
				if ( $post_id == get_the_ID() ) {
					$current = $index + 1;
					break;
				}
			}
			
			$title = str_replace( array( '%CURRENT%', '%MAX%' ), array( $current, count( $posts->posts ) ), $title );
		}

		$output = '';
		
		$output .= str_replace( array( '%TITLE%' ), array( $title ), $args['title_wrap'] );

		// next link
		ob_start();
		next_post_link( '%link', $args['next_post_text'] );
		$link = ob_get_clean();
		if ( $link ) {
			$output .= str_replace( 'href=', 'class="'. $args['next_post_class']. '" href=', $link );
		} else {
			$output .= $args['no_link_next'];
		}

		// previos link
		ob_start();
		previous_post_link( '%link', $args['prev_post_text'] );
		$link = ob_get_clean();
		if ( $link ) {
			$output .= str_replace( 'href=', 'class="'. $args['prev_post_class']. '" href=', $link );
		} else {
			$output .= $args['no_link_prev'];
		}
		
		$output = str_replace( '%LINKS%', $output, $args['wrap'] );
		
		if ( $args['echo'] ) {
			echo $output;
		}

		return $output;
	}

endif; // presscore_post_navigation


if ( ! function_exists( 'presscore_get_media_content' ) ) :

	/**
	 * Get video embed.
	 *
	 */
	function presscore_get_media_content( $media_url, $id = '' ) {
		if ( !$media_url ) {
			return '';
		}

		if ( $id ) {
			$id = ' id="' . esc_attr( sanitize_html_class( $id ) ) . '"';
		}

		$html = '<div' . $id . ' class="pp-media-content" style="display: none;">' . dt_get_embed( $media_url ) . '</div>';

		return $html;
	}

endif; // presscore_get_media_content


if ( ! function_exists( 'presscore_get_royal_slider' ) ) :

	/**
	 * Royal media slider.
	 *
	 * @param array $media_items Attachments id's array.
	 * @return string HTML.
	 */
	function presscore_get_royal_slider( $attachments_data, $options = array() ) {

		if ( empty( $attachments_data ) ) {
			return '';
		}

		$default_options = array(
			'echo'		=> false,
			'width'		=> null,
			'heught'	=> null,
			'class'		=> array(),
			'style'		=> '',
		);
		$options = wp_parse_args( $options, $default_options );

		// common classes
		$options['class'][] = 'royalSlider';
		$options['class'][] = 'rsShor';

		$container_class = implode(' ', $options['class']);

		$data_attributes = '';
		if ( !empty($options['width']) ) {
			$data_attributes .= ' data-width="' . absint($options['width']) . '"';
		}

		if ( !empty($options['height']) ) {
			$data_attributes .= ' data-height="' . absint($options['height']) . '"';
		}

		$html = "\n" . '<ul class="' . esc_attr($container_class) . '"' . $data_attributes . $options['style'] . '>';

		foreach ( $attachments_data as $data ) {

			if ( empty($data['full']) ) continue;

			$is_video = !empty( $data['video_url'] );

			$html .= "\n\t" . '<li' . ( ($is_video) ? ' class="rollover-video"' : '' ) . '>';

			$image_args = array(
				'img_meta' 	=> array( $data['full'], $data['width'], $data['height'] ),
				'img_id'	=> $data['ID'],
				'alt'		=> $data['alt'],
				'title'		=> $data['title'],
				'caption'	=> $data['caption'],
				'img_class' => 'rsImg',
				'custom'	=> '',
				'class'		=> '',
				'echo'		=> false,
				'wrap'		=> '<img %IMG_CLASS% %SRC% %SIZE% %ALT% %CUSTOM% />',
			);

			if ( $is_video ) {
				$video_url = remove_query_arg( array('iframe', 'width', 'height'), $data['video_url'] );
				$image_args['custom'] = 'data-rsVideo="' . esc_url($video_url) . '"';
			}

			$image = dt_get_thumb_img( $image_args );

			$html .= "\n\t\t" . $image;

			if ( !empty( $data['description'] ) ) {
				$html .= "\n\t\t" . '<div class="slider-post-caption">' . "\n\t\t\t" . '<div class="slider-post-inner">';

				$html .= "\n\t\t\t\t" . wpautop($data['description']);

				$html .= "\n\t\t\t" . '</div>' . "\n\t\t" . '</div>';
			}

			$html .= '</li>';

		}

		$html .= '</ul>';

		if ( $options['echo'] ) {
			echo $html;
		}

		return $html;
	}

endif; // presscore_get_royal_slider


if ( ! function_exists( 'presscore_get_fullwidth_slider_two' ) ) :

	/**
	 * Full Width slider two.
	 *
	 * Description here.
	 */
	function presscore_get_fullwidth_slider_two( $attachments_data, $options = array() ) {
		
		if ( empty( $attachments_data ) ) {
			return '';
		}

		$default_options = array(
			'title'				=> '',
			'link'				=> 'page',
			'height'			=> 270,
			'img_width'			=> null,
			'echo'				=> false,
			'style'				=> '',
			'class'				=> array(),
			'fields'			=> array( 'arrows', 'title', 'description', 'link', 'details' ),
		);
		$options = wp_parse_args( $options, $default_options );

		$link = in_array( $options['link'], array( 'file', 'page', 'none' ) ) ? $options['link'] : $default_options['link'];
		$show_arrows = in_array('arrows', $options['fields']);
		$show_content = array_intersect($options['fields'], array('title', 'description', 'link', 'details')) && 'page' == $link;
		$slider_title = esc_html( $options['title'] );

		if ( !is_array($options['class']) ) {
			$options['class'] = explode(' ', (string) $options['class']);
		}

		// default class
		$options['class'][] = 'slider-wrapper';

		$container_class = implode(' ', $options['class']);

		$style = $options['style'] ? ' style="' . esc_attr($options['style']) . '"' : '';

		$html = "\n" . '<div class="' . esc_attr($container_class) . '"' . $style . '>
							<div class="frame fullwidth-slider" style="height:' . absint( $options['height'] ) . 'px;">
								<ul class="clearfix" style="height:' . absint( $options['height'] ) . 'px;">';

		$img_base_args = array(
			'options'	=> array( 'h' => absint($options['height']), 'z' => 1 ),
			'wrap'		=> '<img %SRC% %IMG_CLASS% %SIZE% %ALT% />',
			'img_class' => '',
			'echo'		=> false
		);

		if ( $options['img_width'] ) {
			$img_base_args['options']['w'] = absint($options['img_width']);
		}

		foreach ( $attachments_data as $data ) {

			if ( empty($data['full']) ) continue;

			if ( $show_content || 'file' == $link || 'none' == $link ) {
				$html .= "\n\t" . '<li class="fs-entry">';
			} else {
				$html .= "\n\t" . '<li class="fs-entry" data-dt-link="' . esc_url($data['permalink']) . '">';
			}

			$image = dt_get_thumb_img( array_merge( $img_base_args, array(
				'img_meta' 	=> array( $data['full'], $data['width'], $data['height'] ),
				'title'		=> $data['description'],
				'alt'		=> $data['title']
			) ) );

			$html .= "\n\t\t" . $image;

			if ( 'none' != $link ) {

				$html .= "\n\t\t" . '<span class="link ' . ( $show_content ? 'show-content' : '' ) . '">';

				if ( 'file' == $link ) {
					$html .= sprintf( '<a href="%s" data-pp="prettyPhoto" title="%s"><img src="%s" alt="%s" /></a>', $data['full'], $data['description'], presscore_get_blank_image(), $data['title'] );
				}

				$html .= '</span>';

				if ( $show_content ) {

					$html .= "\n\t\t" . '<div class="fs-entry-content">';

					if ( in_array('title', $options['fields']) && !empty($data['title']) ) {
						$html .= "\n\t\t\t" . '<h4><a href="' . esc_url($data['permalink']) . '">' . $data['title'] . '</a></h4>';
					}

					if ( in_array('description', $options['fields']) && !empty( $data['description'] ) ) {
						$html .= "\n\t\t\t" . wpautop($data['description']);
					}

					if ( in_array('details', $options['fields']) ) {
						$html .= '<a class="project-details" href="' . esc_url($data['permalink']) . '">' . _x('Details', 'fullscreen slider two', LANGUAGE_ZONE) . '</a>';
					}
					
					if ( in_array('link', $options['fields']) && !empty($data['link']) ) {
						$html .= $data['link'];
					}
					

					$html .= '<span class="close-link"></span>';
					$html .= "\n\t\t" . '</div>';

				}
			}

			$html .= "\n\t" . '</li>';

		}

		$html .= "\n" . '</ul>
			</div>';

		if ( $show_arrows || $slider_title ) {
			$html .= '<div class="fs-navigation controls center">';

			if ( $show_arrows ) {
				$html .= '<div class="prev"></div><div class="next"></div>';
			}
					
			if ( $slider_title ) {
				$html .= '<div class="fs-title">' . $slider_title . '</div>';
			}
			
			$html .= '</div>';
		}
		$html .= '</div>';

		if ( $options['echo'] ) {
			echo $html;
		}

		return $html;
	}

endif; // presscore_get_fullwidth_slider_two


if ( ! function_exists( 'presscore_get_images_list' ) ) :

	/**
	 * Images list.
	 *
	 * Description here.
	 *
	 * @return string HTML.
	 */
	function presscore_get_images_list( $attachments_data ) {
		if ( empty( $attachments_data ) ) {
			return '';
		}

		static $gallery_counter = 0;
		$gallery_counter++;

		$id_mark_prefix = 'pp-imageslist-media-content-' . $gallery_counter . '-';

		$html = '';

		foreach ( $attachments_data as $data ) {

			if ( empty($data['full']) ) continue;

			$is_video = !empty( $data['video_url'] );

			$html .= "\n\t" . '<div class="images-list">';

			$image_args = array(
				'img_meta' 	=> array( $data['full'], $data['width'], $data['height'] ),
				'img_id'	=> empty($data['ID']) ? 0 : $data['ID'],
				'title'		=> $data['description'],
				'alt'		=> $data['title'],
				'img_class' => 'images-list',
				'wrap'		=> '<img %SRC% %IMG_CLASS% %ALT% style="width: 100%;" />',
				'echo'		=> false,
			);

			// $media_content = '';
			if ( $is_video ) {
				$blank_image = presscore_get_blank_image();
				$image_args['href'] = $data['video_url'];
				$image_args['custom'] = 'data-pp="prettyPhoto"';
				$image_args['class'] = 'rollover-video';
				$image_args['wrap'] = '<div %CLASS%>' . $image_args['wrap'] . '<a %HREF% %TITLE% class="video-icon" %CUSTOM%><img src="' . $blank_image . '" %ALT% style="display: none;" /></a></div>';
			}

			$image = dt_get_thumb_img( $image_args );

			$html .= "\n\t\t" . $image;// . $media_content;

			if ( !empty( $data['description'] ) ) {
				$html .= "\n\t\t" . '<div class="images-list-caption">' . "\n\t\t\t" . '<div class="images-list-inner">';

				$html .= "\n\t\t\t\t" . wpautop($data['description']);

				$html .= "\n\t\t\t" . '</div>' . "\n\t\t" . '</div>';
			}

			$html .= '</div>';

		}

		return $html;
	}

endif; // presscore_get_images_list


if ( ! function_exists( 'presscore_get_images_gallery_1' ) ) :

	/**
	 * Gallery helper.
	 *
	 * @param array $attachments_data Attachments data array.
	 * @return string HTML.
	 */
	function presscore_get_images_gallery_1( $attachments_data, $options = array() ) {
		if ( empty( $attachments_data ) ) {
			return '';
		}

		static $gallery_counter = 0;
		$gallery_counter++;

		$id_mark_prefix = 'pp-gallery-1-media-content-' . $gallery_counter . '-';

		$default_options = array(
			'echo'			=> false,
			'class'			=> array(),
			'links_rel'		=> '',
			'style'			=> '',
		);
		$options = wp_parse_args( $options, $default_options );
		$blank_image = presscore_get_blank_image();
		
		$options['class'] = (array) $options['class']; 
		$options['class'][] = 'dt-format-gallery';

		$container_class = implode( ' ', $options['class'] );

		$html = '<div class="' . esc_attr( $container_class ) . '"' . $options['style'] . '>';

		// clear attachments_data
		foreach ( $attachments_data as $index=>$data ) {
			if ( empty($data['full']) ) unset($attachments_data[ $index ]);
		}
		unset($data);

		if ( empty($attachments_data) ) {
			return '';
		}

		$big_image = array_slice($attachments_data, 0, 1);
		$big_image = current($big_image);
		$medium_images = array_slice($attachments_data, 1, 4);
		$small_images = array_slice($attachments_data, 5);

		$image_custom = $options['links_rel'];

		$image_args = array(
			'img_class' => '',
			'class'		=> 'rollover rollover-zoom',
			'custom'	=> $image_custom,
			'echo'		=> false,
		);

		$media_args = array_merge( $image_args, array(
			'class'		=> 'rollover-video',
		) );

		// big image
		$big_image_args = array(
			'img_meta' 	=> array( $big_image['full'], $big_image['width'], $big_image['height'] ),
			'img_id'	=> empty( $big_image['ID'] ) ? $big_image['ID'] : 0, 
			'options'	=> array( 'w' => 600, 'h' => 600, 'z' => true ),
			'alt'		=> $big_image['title'],
			'title'		=> $big_image['description'],
		);

		if ( empty($big_image['video_url']) ) {
			$image = dt_get_thumb_img( array_merge( $image_args, $big_image_args ) );
		} else {
			$big_image_args['href'] = $big_image['video_url'];
			$big_image_args['wrap'] = '<div %CLASS%><img %SRC% %IMG_CLASS% %ALT% %IMG_TITLE% %SIZE% /><a %HREF% %TITLE% class="video-icon" %CUSTOM%><img src="' . $blank_image . '" %ALT% style="display: none;" /></a></div>';
			$image = dt_get_thumb_img( array_merge( $media_args, $big_image_args ) );
		}

		$html .= '<div class="dt-format-gallery-coll">';
		$html .= "\n\t\t" . $image;
		$html .= '</div>';

		// medium images
		if ( !empty($medium_images) ) {
			$html .= '<div class="dt-format-gallery-coll">';
			foreach ( $medium_images as $data ) {

				$medium_image_args = array(
					'img_meta' 	=> array( $data['full'], $data['width'], $data['height'] ),
					'img_id'	=> empty( $data['ID'] ) ? $data['ID'] : 0, 
					'options'	=> array( 'w' => 300, 'h' => 300, 'z' => true ),
					'alt'		=> $data['title'],
					'title'		=> $data['description'],
				);

				if ( empty($data['video_url']) ) {
					$image = dt_get_thumb_img( array_merge( $image_args, $medium_image_args ) );
				} else {
					$medium_image_args['href'] = $data['video_url'];
					$medium_image_args['wrap'] = '<div %CLASS%><img %SRC% %IMG_CLASS% %ALT% %IMG_TITLE% %SIZE% /><a %HREF% %TITLE% class="video-icon" %CUSTOM%><img src="' . $blank_image . '" %ALT% style="display: none;" /></a></div>';
					$image = dt_get_thumb_img( array_merge( $media_args, $medium_image_args ) );
				}

				$html .= "\n\t\t" . '<div class="gallery-coll-half">' . $image . '</div>';

			}
			$html .= '</div>';
		}

		// small images
		if ( !empty($small_images) ) {
			$html .= '<div class="dt-format-gallery-coll full">';
			foreach ( $small_images as $data ) {

				$small_image_args = array(
					'img_meta' 	=> array( $data['full'], $data['width'], $data['height'] ),
					'img_id'	=> empty( $data['ID'] ) ? $data['ID'] : 0, 
					'options'	=> array( 'w' => 300, 'h' => 300, 'z' => true ),
					'alt'		=> $data['title'],
					'title'		=> $data['description'],
				);

				if ( empty($data['video_url']) ) {
					$image = dt_get_thumb_img( array_merge( $image_args, $small_image_args ) );
				} else {
					$small_image_args['href'] = $data['video_url'];
					$small_image_args['wrap'] = '<div %CLASS%><img %SRC% %IMG_CLASS% %ALT% %IMG_TITLE% %SIZE% /><a %HREF% %TITLE% class="video-icon" %CUSTOM%><img src="' . $blank_image . '" %ALT% style="display: none;" /></a></div>';
					$image = dt_get_thumb_img( array_merge( $media_args, $small_image_args ) );
				}

				$html .= "\n\t\t" . '<div class="gallery-coll-fourth">' . $image . '</div>';

			}
			$html .= '</div>';
		}

		$html .= '</div>';

		return $html;
	}

endif; // presscore_get_images_gallery_1


if ( ! function_exists( 'presscore_get_images_gallery_hoovered' ) ) :

	/**
	 * Hoovered gallery.
	 *
	 * @param array $attachments_data Attachments data array.
	 * @param array $options Gallery options.
	 *
	 * @return string HTML.
	 */
	function presscore_get_images_gallery_hoovered( $attachments_data, $options = array() ) {
		if ( empty( $attachments_data ) ) {
			return '';
		}

		// clear attachments_data
		foreach ( $attachments_data as $index=>$data ) {
			if ( empty( $data['full'] ) ) {
				unset( $attachments_data[ $index ] );
			}
		}
		unset( $data );

		if ( empty( $attachments_data ) ) {
			return '';
		}

		static $gallery_counter = 0;
		$gallery_counter++;

		$id_mark_prefix = 'pp-gallery-hoovered-media-content-' . $gallery_counter . '-';

		$default_options = array(
			'echo'			=> false,
			'class'			=> array(),
			'links_rel'		=> '',
			'style'			=> '',
			'share_buttons'	=> false,
			'exclude_cover'	=> false,
		);
		$options = wp_parse_args( $options, $default_options );

		$class = implode( ' ', (array) $options['class'] );	

		$big_image = array_slice( $attachments_data, 0, 1 );
		$big_image = current( $big_image );
		$small_images = array_slice( $attachments_data, 1 );

		if ( $options['exclude_cover'] ) {
			$attachments_count = count( $small_images );
		} else {
			$attachments_count = count( $attachments_data );
		}

		$image_args = array(
			'img_class' => 'preload-me',
			'class'		=> $class,
			'custom'	=> implode( ' ', array( $options['links_rel'], $options['style'] ) ),
			'echo'		=> false,
		);

		$image_hoover = '';
		$mini_count = 3;
		$html = '';
		$share_buttons = '';

		// medium images
		if ( !empty( $small_images ) ) {
			$html .= '<div class="dt-prettyphoto-gallery-container" style="display: none;">';
			foreach ( $small_images as $data ) {

				if ( $options['share_buttons'] ) {
					$share_buttons = presscore_get_share_buttons_for_prettyphoto( 'photo', array( 'id' =>  $data['ID'] ) );
					$share_buttons = ' ' . $share_buttons;
				}

				$small_image_args = array(
					'img_meta' 	=> $data['thumbnail'],
					'img_id'	=> empty( $data['ID'] ) ? $data['ID'] : 0,
					'alt'		=> $data['title'],
					'title'		=> $data['description'],
					'href'		=> esc_url( $data['full'] ),
					'custom'	=> $image_args['custom'] . $share_buttons,
					'class'		=> '',
				);

				$mini_image_args = array(
					'img_meta' 	=> $data['thumbnail'],
					'img_id'	=> empty( $data['ID'] ) ? $data['ID'] : 0,
					'alt'		=> $data['title'],
					'title'		=> $data['description'],
					'wrap'		=> '<img %IMG_CLASS% %SRC% %ALT% %IMG_TITLE% width="90" />',
				);			

				if ( $mini_count ) {
					$image_hoover = '<span class="r-thumbn-' . $mini_count . '">' . dt_get_thumb_img( array_merge( $image_args, $mini_image_args ) ) . '<i>' . $attachments_count . '</i></span>' . $image_hoover;
					$mini_count--;
				}

				if ( !empty($data['video_url']) ) {
					$small_image_args['href'] = $data['video_url'];
				}

				$image = dt_get_thumb_img( array_merge( $image_args, $small_image_args ) );

				$html .= $image;

			}
			$html .= '</div>';
		}
		unset( $image );

		if ( $image_hoover ) {
			$image_hoover = '<span class="rollover-thumbnails">' . $image_hoover . '</span>';
		}

		if ( $options['share_buttons'] ) {
			$share_buttons = presscore_get_share_buttons_for_prettyphoto( 'photo', array( 'id' =>  $big_image['ID'] ) );
			$share_buttons = ' ' . $share_buttons;
		}

		// big image
		$big_image_args = array(
			'img_meta' 	=> array( $big_image['full'], $big_image['width'], $big_image['height'] ),
			'img_id'	=> empty( $big_image['ID'] ) ? $big_image['ID'] : 0,
			'wrap'		=> '<a %HREF% %CLASS% %CUSTOM%><img %SRC% %IMG_CLASS% %ALT% %IMG_TITLE% %SIZE% />' . $image_hoover . '</a>',
			'alt'		=> $big_image['title'],
			'title'		=> $big_image['description'],
			'custom'	=> $options['exclude_cover'] ? $options['style'] : $image_args['custom'] . $share_buttons,
		);
		$big_image_args = apply_filters('presscore_get_images_gallery_hoovered-title_img_args', $big_image_args, $image_args, $options, $big_image);

		if ( !empty( $big_image['video_url'] ) && !$options['exclude_cover'] ) {
			$big_image_args['href'] = $big_image['video_url'];

			$blank_image = presscore_get_blank_image();

			$big_image_args['class'] = isset($big_image_args['class']) ? $big_image_args['class'] : '';
			$big_image_args['class'] = str_replace('rollover', 'rollover-video', $image_args['class']);
			$big_image_args['custom'] = $options['style'];

			$big_image_args['wrap'] = '<div %CLASS% %CUSTOM%><img %IMG_CLASS% %SRC% %ALT% %IMG_TITLE% %SIZE% /><a %HREF% %TITLE% class="video-icon" ' . $options['links_rel'] . $share_buttons . '><img src="' . $blank_image . '" %ALT% style="display: none;" /></a></div>';
		}
		$image = dt_get_thumb_img( array_merge( $image_args, $big_image_args ) );

		$html = $image . $html;

		return $html;
	}

endif; // presscore_get_images_gallery_hoovered


if ( ! function_exists( 'presscore_get_posts_small_list' ) ) :

	/**
	 * Description here.
	 *
	 * Some sort of images list with some description and post title and date ... eah
	 *
	 * @return array Array of items or empty array.
	 */
	function presscore_get_posts_small_list( $attachments_data, $options = array() ) {
		if ( empty( $attachments_data ) ) {
			return array();
		}

		global $post;

		$default_options = array(
			'links_rel'		=> '',
		);
		$options = wp_parse_args( $options, $default_options );

		$image_args = array(
			'img_class' => '',
			'class'		=> 'alignleft post-rollover',
			'custom'	=> $options['links_rel'],
			'options'	=> array( 'w' => 60, 'h' => 60, 'z' => true ),
			'echo'		=> false,
		);

		$articles = array();
		$class = '';
		$post_was_changed = false;
		$post_backup = $post;

		foreach ( $attachments_data as $data ) {

			$new_post = null;

			if ( isset( $data['parent_id'] ) ) {

				$post_was_changed = true;
				$new_post = get_post( $data['parent_id'] );

				if ( $new_post ) {
					$post = $new_post;
					setup_postdata( $post );
				}
			}

			$permalink = esc_url($data['permalink']);

			$attachment_args = array(
				'href'		=> $permalink,
				'img_meta' 	=> array( $data['full'], $data['width'], $data['height'] ),
				'img_id'	=> empty($data['ID']) ? 0 : $data['ID'],
				'echo'		=> false,
				'wrap'		=> '<a %CLASS% %HREF% %CUSTOM%><img %IMG_CLASS% %SRC% %SIZE% %ALT% /></a>',
			);

			// show something if there is no title
			if ( empty($data['title']) ) {
				$data['title'] = _x('No title', 'blog small list', LANGUAGE_ZONE);
			}

			if ( !empty( $data['parent_id'] ) ) {
				$class = 'post-' . presscore_get_post_format_class( get_post_format( $data['parent_id'] ) );

				if ( empty($data['ID']) ) {
					$attachment_args['wrap'] = '<a %HREF% %CLASS% %TITLE%></a>';
					$attachment_args['class'] = $image_args['class'] . ' no-avatar';
					$attachment_args['img_meta'] = array('', 0, 0);
					$attachment_args['options'] = false;
				}
			}

			$article = sprintf(
				'<article class="%s">%s<div class="post-content">%s%s</div></article>',
				$class,
				$data['full'] ? dt_get_thumb_img( array_merge($image_args, $attachment_args) ) : '',
				'<a href="' . $permalink . '">' . apply_filters('the_title', $data['title']) . '</a><br />',
				$new_post ? '<time class="text-secondary" datetime="' . get_the_date('c') . '">' . get_the_date(get_option('date_format')) . '</time>' : ''
			);

			$articles[] = $article;
		}

		if ( $post_was_changed ) {
			$post = $post_backup;
			setup_postdata( $post );
		}

		return $articles;
	}

endif; // presscore_get_posts_small_list


if ( ! function_exists( 'presscore_display_related_posts' ) ) :

	/**
	 * Display related posts.
	 *
	 */
	function presscore_display_related_posts() {
		if ( !of_get_option( 'general-show_rel_posts', false ) ) {
			return '';
		}

		global $post;

		$html = '';
		$terms = array();

		switch ( get_post_meta( $post->ID, '_dt_post_options_related_mode', true ) ) {
			case 'custom': $terms = get_post_meta( $post->ID, '_dt_post_options_related_categories', true ); break;
			default: $terms = wp_get_object_terms( $post->ID, 'category', array('fields' => 'ids') );
		}

		if ( $terms && !is_wp_error($terms) ) {

			$attachments_data = presscore_get_related_posts( array(
				'cats'		=> $terms,
				'post_type' => 'post',
				'taxonomy'	=> 'category',
				'args'		=> array( 'posts_per_page' => intval(of_get_option('general-rel_posts_max', 12)) )
			) );

			$head_title = esc_html(of_get_option( 'general-rel_posts_head_title', 'Related posts' ));

			$posts_list = presscore_get_posts_small_list( $attachments_data );
			if ( $posts_list ) {

				foreach ( $posts_list as $p ) {
					$html .= sprintf( '<div class="wf-cell wf-1-3"><div class="borders">%s</div></div>', $p );
				}

				$html = '<section class="items-grid wf-container">' . $html . '</section>';
			
				// add title
				if ( $head_title ) {
					$html = '<h2 class="entry-title">' . $head_title . '</h2><div class="gap-10"></div>' . $html;
				}

				$html = '<div class="hr-thick"></div><div class="gap-30"></div>' . $html . '<div class="gap-10"></div>';
			}
		}

		echo (string) apply_filters( 'presscore_display_related_posts', $html );
	}

endif; // presscore_display_related_posts


if ( ! function_exists( 'presscore_display_related_projects' ) ) :

	/**
	 * Display related projects.
	 *
	 */
	function presscore_display_related_projects() {

		global $post;
		$html = '';
		
		// if related projects turn on in theme options
		if ( of_get_option( 'general-show_rel_projects', false ) ) {

			$terms = array();
			switch ( get_post_meta( $post->ID, '_dt_project_options_related_mode', true ) ) {
				case 'custom': $terms = get_post_meta( $post->ID, '_dt_project_options_related_categories', true ); break;
				default: $terms = wp_get_object_terms( $post->ID, 'dt_portfolio_category', array('fields' => 'ids') );
			}

			if ( $terms && !is_wp_error($terms) ) {

				$attachments_data = presscore_get_related_posts( array(
					'cats'		=> $terms,
					'post_type' => 'dt_portfolio',
					'taxonomy'	=> 'dt_portfolio_category',
					'args'		=> array( 'posts_per_page' => intval(of_get_option('general-rel_projects_max', 12)) )
				) );

				$slider_title = of_get_option( 'general-rel_projects_head_title', 'Related projects' );
				$slider_class = 'related-projects';

				if ( 'disabled' != get_post_meta( $post->ID, '_dt_sidebar_position', true ) ) {
					$height = of_get_option( 'general-rel_projects_height', 190 );
				} else {
					$height = of_get_option( 'general-rel_projects_fullwidth_height', 270 );
					$slider_class .= ' full';
				}

				$slider_fields = array();

				if ( of_get_option('general-rel_projects_arrows', true) ) {
					$slider_fields[] = 'arrows';
				}

				if ( of_get_option('general-rel_projects_title', true) ) {
					$slider_fields[] = 'title';
				}

				if ( of_get_option('general-rel_projects_excerpt', true) ) {
					$slider_fields[] = 'description';
				}

				if ( of_get_option('general-rel_projects_link', true) ) {
					$slider_fields[] = 'link';
				}

				if ( of_get_option('general-rel_projects_details', true) ) {
					$slider_fields[] = 'details';
				}

				$html = presscore_get_fullwidth_slider_two( $attachments_data, array(
					'class'		=> $slider_class,
					'title'		=> $slider_title,
					'fields'	=> $slider_fields,
					'height'	=> $height,
				) );
			}
		}

		echo (string) apply_filters('presscore_display_related_projects', $html);
	}

endif; // presscore_display_related_projects


if ( ! function_exists( 'presscore_get_project_media_slider' ) ) :

	/**
	 * Portfolio media slider.
	 *
	 * Based on royal slider. Properly works only in the loop.
	 *
	 * @return string HTML.
	 */
	function presscore_get_project_media_slider( $class = array() ) {
		global $post;

		// slideshow dimensions
		$slider_proportions = get_post_meta( $post->ID, '_dt_project_options_slider_proportions',  true );
		$slider_proportions = wp_parse_args( $slider_proportions, array( 'width' => '', 'height' => '' ) );

		$width = $slider_proportions['width'];
		$height = $slider_proportions['height'];

		// get slideshow
		$media_items = get_post_meta( $post->ID, '_dt_project_media_items', true );
		$slideshow = '';

		if ( !$media_items ) $media_items = array();
		
		// if we have post thumbnail and it's not hidden
		if ( has_post_thumbnail() ) {
			if ( is_single() ) {
				if ( !get_post_meta( $post->ID, '_dt_project_options_hide_thumbnail', true ) ) {
					array_unshift( $media_items, get_post_thumbnail_id() );
				}
			} else {
				array_unshift( $media_items, get_post_thumbnail_id() );
			}
		}

		$attachments_data = presscore_get_attachment_post_data( $media_items );
		
		// TODO: make it clean and simple
		if ( count( $attachments_data ) > 1 ) {
			$slideshow = presscore_get_royal_slider( $attachments_data, array(
				'width'		=> $width,
				'height'	=> $height,
				'class' 	=> $class,
				'style'		=> ' style="width: 100%"',
			) );
		} elseif ( !empty($attachments_data) ) {
			$image = current($attachments_data);

			$thumb_id = $image['ID'];
			$thumb_meta = array( $image['full'], $image['width'], $image['height'] );
			$video_url = esc_url( get_post_meta( $thumb_id, 'dt-video-url', true ) );

			$thumb_args = array(
				'img_meta' 	=> $thumb_meta,
				'img_id'	=> $thumb_id,
				'img_class' => 'preload-me',
				'class'		=> 'alignnone rollover',
				'href'		=> get_permalink( $post->ID ),
				'wrap'		=> '<a %CLASS% %HREF% %TITLE% %CUSTOM%><img %IMG_CLASS% %SRC% %ALT% %SIZE% /></a>',
				'echo'		=> false,
			);

			if ( $video_url ) {
				$blank_image = presscore_get_blank_image();
				$thumb_args['class'] = 'alignnone rollover-video';
				$thumb_args['wrap'] = '<div %CLASS% %CUSTOM%><img %IMG_CLASS% %SRC% %ALT% %IMG_TITLE% %SIZE% /><a %HREF% %TITLE% class="video-icon"><img src="' . $blank_image . '" %ALT% style="display: none;" /></a></div>';
			}

			$thumb_args = apply_filters( 'dt_portfolio_thumbnail_args', $thumb_args );

			$slideshow = dt_get_thumb_img( $thumb_args );
		}

		return $slideshow;
	}

endif; // presscore_get_project_media_slider


if ( ! function_exists( 'presscore_get_post_media_slider' ) ) :

	/**
	 * Post media slider.
	 *
	 * Based on royal slider. Properly works only in the loop.
	 *
	 * @return string HTML.
	 */
	function presscore_get_post_media_slider( $attachments_data, $options = array() ) {
		global $post;

		if ( !$attachments_data ) {
			return '';
		}

		$default_options = array(
			'class'	=> array(),
			'style'	=> ' style="width: 100%"',
		);
		$options = wp_parse_args( $options, $default_options );

		// slideshow dimensions
		$slider_proportions = get_post_meta( $post->ID, '_dt_post_options_slider_proportions',  true );
		$slider_proportions = wp_parse_args( $slider_proportions, array( 'width' => '', 'height' => '' ) );
		
		$width = $slider_proportions['width'];
		$height = $slider_proportions['height'];
		
		$slideshow = presscore_get_royal_slider( $attachments_data, array(
			'width'		=> $width,
			'height'	=> $height,
			'class' 	=> $options['class'],
			'style'		=> $options['style'],
		) );

		return $slideshow;
	}

endif; // presscore_get_post_media_slider


if ( ! function_exists( 'presscore_get_post_attachment_html' ) ) :

	/**
	 * Get post attachment html.
	 *
	 * Check if there is video_url and react respectively.
	 *
	 * @param array $attachment_data
	 * @param array $options
	 *
	 * @return string
	 */
	function presscore_get_post_attachment_html( $attachment_data, $options = array() ) {
		if ( empty( $attachment_data['ID'] ) ) {
			return '';
		}
		
		$default_options = array(
			'link_rel'	=> 'data-pp="prettyPhoto"',
			'class'		=> array(),
			'wrap'		=> '',
		);
		$options = wp_parse_args( $options, $default_options );

		$class = $options['class'];
		$image_media_content = '';

		if ( !$options['wrap'] ) $options['wrap'] = '<a %HREF% %CLASS% %CUSTOM%><img %SRC% %IMG_CLASS% %ALT% %IMG_TITLE% %SIZE% /></a>';

		$image_args = array(
			'img_meta' 	=> array( $attachment_data['full'], $attachment_data['width'], $attachment_data['height'] ),
			'img_id'	=> empty( $attachment_data['ID'] ) ? $attachment_data['ID'] : 0,
			'alt'		=> $attachment_data['alt'],
			'title'		=> $attachment_data['title'],
			'img_class' => 'preload-me',
			'custom'	=> $options['link_rel'],
			'echo'		=> false,
			'wrap'		=> $options['wrap']
		);
		
		// check if image has video
		if ( empty($attachment_data['video_url']) ) {
			$class[] = 'rollover';
			$class[] = 'rollover-zoom';
			
			$image_args['class'] = implode( ' ', $class );

		} else {
			$class[] = 'rollover-video';

			$blank_image = presscore_get_blank_image();

			$image_args['href'] = $attachment_data['video_url'];
			$image_args['class'] = implode( ' ', $class );		
			$image_args['wrap'] = '<div %CLASS%><img %SRC% %IMG_CLASS% %ALT% %IMG_TITLE% %SIZE% /><a %HREF% %TITLE% class="video-icon" %CUSTOM%><img src="' . $blank_image . '" %ALT% style="display: none;" /></a></div>';
		}

		$image = dt_get_thumb_img( $image_args );

		return $image;
	}

endif; // presscore_get_post_attachment_html


if ( ! function_exists( 'presscore_get_attachment_post_data' ) ) :

	/**
	 * Get attachments post data.
	 *
	 * @param array $media_items Attachments id's array.
	 * @return array Attachments data.
	 */
	function presscore_get_attachment_post_data( $media_items, $orderby = 'post__in', $order = 'DESC', $posts_per_page = -1 ) {
		if ( empty( $media_items ) ) {
			return array();
		}

		global $post;

		// sanitize $media_items
		$media_items = array_diff( array_unique( array_map( "absint", $media_items ) ), array(0) );

		if ( empty( $media_items ) ) {
			return array();
		}
		
		// get attachments
		$query = new WP_Query( array(
			'no_found_rows'     => true,
			'posts_per_page'    => $posts_per_page,
			'post_type'         => 'attachment',
			'post_mime_type'    => 'image',
			'post_status'       => 'inherit',
			'post__in'			=> $media_items,
			'orderby'			=> $orderby,
			'order'				=> $order,
		) );

		$attachments_data = array();

		if ( $query->have_posts() ) {

			// backup post
			$post_backup = $post;

			while ( $query->have_posts() ) { $query->the_post();
				$post_id = get_the_ID();
				$data = array();

				// attachment meta
				$data['full'] = $data['width'] = $data['height'] = '';
				$meta = wp_get_attachment_image_src( $post_id, 'full' );
				if ( !empty($meta) ) {
					$data['full'] = esc_url($meta[0]);
					$data['width'] = absint($meta[1]);
					$data['height'] = absint($meta[2]);
				}

				$data['thumbnail'] = wp_get_attachment_image_src( $post_id, 'thumbnail' );

				$data['alt'] = esc_attr( get_post_meta( $post_id, '_wp_attachment_image_alt', true ) );
				$data['caption'] = get_the_excerpt();
				$data['description'] = get_the_content();
				$data['title'] = get_the_title( $post_id );
				$data['permalink'] = get_permalink( $post );
				$data['video_url'] = esc_url( get_post_meta( $post_id, 'dt-video-url', true ) );
				$data['link'] = esc_url( get_post_meta( $post_id, 'dt-img-link', true ) );
				$data['mime_type_full'] = get_post_mime_type( $post_id );
				$data['mime_type'] = dt_get_short_post_myme_type( $post_id );
				$data['ID'] = $post_id;

				$attachments_data[] = apply_filters( 'presscore_get_attachment_post_data-attachment_data', $data, $media_items );
			}
			
			// restore post
			$post = $post_backup;
			setup_postdata( $post );
		}

		return $attachments_data;
	}

endif; // presscore_get_attachment_post_data


if ( ! function_exists( 'presscore_get_posts_in_categories' ) ) :

	/**
	 * Get posts by categories.
	 *
	 * @return object WP_Query Object. 
	 */
	function presscore_get_posts_in_categories( $options = array() ) {

		$default_options = array(
			'post_type'	=> 'post',
			'taxonomy'	=> 'category',
			'field'		=> 'id',
			'cats'		=> array( 0 ),
			'select'	=> 'all',
			'args'		=> array(),
		);

		$options = wp_parse_args( $options, $default_options );

		$args = array(
			'posts_per_page'	=> -1,
			'post_type'			=> $options['post_type'],
			'no_found_rows'     => 1,
			'post_status'       => 'publish',
			'tax_query'         => array( array(
				'taxonomy'      => $options['taxonomy'],
				'field'         => $options['field'],
				'terms'         => $options['cats'],
			) ),
		);

		$args = array_merge( $args, $options['args'] );

		switch( $options['select'] ) {
			case 'only': $args['tax_query'][0]['operator'] = 'IN'; break;
			case 'except': $args['tax_query'][0]['operator'] = 'NOT IN'; break;
			default: unset( $args['tax_query'] );
		}

		$query = new WP_Query( $args );

		return $query;
	}

endif; // presscore_get_posts_in_categories


if ( ! function_exists( 'presscore_get_related_posts' ) ) :

	/**
	 * Get related posts attachments data slightly modified.
	 *
	 * @return array Attachments data.
	 */
	function presscore_get_related_posts( $options = array() ) {
		$default_options = array(
			'select'			=> 'only',
			'exclude_current'	=> true,
			'args'				=> array(),
		);

		$options = wp_parse_args( $options, $default_options );

		// exclude current post if in the loop
		if ( in_the_loop() && $options['exclude_current'] ) {
			$options['args'] = array_merge( $options['args'], array( 'post__not_in' => array( get_the_ID() ) ) );
		}

		$posts = presscore_get_posts_in_categories( $options );

		$attachments_ids = array();
		$attachments_data_override = array();
		$posts_data = array();

		// get posts attachments id
		if ( $posts->have_posts() ) {

			while ( $posts->have_posts() ) { $posts->the_post();

				// thumbnail or first attachment id
				if ( has_post_thumbnail() ) {
					$attachments_ids[] = get_post_thumbnail_id();
				} else if ( $attachment = presscore_get_first_image() ) {
					$attachments_ids[] = $attachment->ID;
				// if no attachments - continue
				} else {
					// continue;
					$attachments_ids[] = 0;
				}

				$attachments_data_override[] = array(
					'permalink'		=> get_permalink(),
					'link'			=> presscore_get_project_link('project-link'),
					'title'			=> get_the_title(),
					'description'	=> get_the_excerpt(),
					'alt'			=> get_the_title(),
					'parent_id'		=> get_the_ID(),
				);
			}
			wp_reset_postdata();

		}

		if ( $attachments_ids ) {

			// what we want
			$attachments_data = presscore_get_attachment_post_data( $attachments_ids );

			// what we get
			$attachments_data_ids = array();
			if ( $attachments_data ) {
				$attachments_data_ids = wp_list_pluck($attachments_data, 'ID');
			}

			$default_image = presscore_get_default_image();

			foreach ( $attachments_ids as $key=>$id ) {

				$attachments_data_key = array_search( $id, $attachments_data_ids );

				// if there are image - add it to array
				if ( false !== $attachments_data_key ) {

					$posts_data[ $key ] = $attachments_data[ $attachments_data_key ];

				// or add noimage
				} else {
					$posts_data[ $key ] = array(
						'full' 		=> $default_image[0],
						'width' 	=> $default_image[1],
						'height' 	=> $default_image[2],
					);
				}

				if ( isset($attachments_data_override[ $key ]) ) {
					$posts_data[ $key ] = array_merge( $posts_data[ $key ], $attachments_data_override[ $key ] );
				}
			}
		}

		return $posts_data;
	}

endif; // presscore_get_related_posts


if ( ! function_exists( 'presscore_get_first_image' ) ) :

	/**
	 * Get first image associated with the post.
	 *
	 * @param integer $post_id Post ID.
	 * @return mixed Return (object) attachment on success ar false on failure.
	 */
	function presscore_get_first_image( $post_id = null ) {
		if ( in_the_loop() && !$post_id ) $post_id = get_the_ID();

		if ( !$post_id ) return false;

		$args = array(
			'posts_per_page' 	=> 1,
			'order'				=> 'ASC',
			'post_mime_type' 	=> 'image',
			'post_parent' 		=> $post_id,
			'post_status'		=> 'inherit',
			'post_type'			=> 'attachment',
		);

		$attachments = get_children( $args );

		if ( $attachments ) {
			return current($attachments);
		}

		return false;
	}

endif; // presscore_get_first_image


if ( ! function_exists( 'presscore_get_button_html' ) ) :

	/**
	 * Button helper.
	 *
	 * Description here.
	 * @return string HTML.
	 */
	function presscore_get_button_html( $options = array() ) {
		$default_options = array(
			'title'		=> '',
			'target'	=> '',
			'href'		=> '',
			'class'		=> 'dt-btn',
		);

		$options = wp_parse_args( $options, $default_options );

		if ( empty($options['href']) ) return '';

		$html = sprintf(
			'<a href="%1$s" class="%2$s"%3$s>%4$s</a>',
			esc_url($options['href']),
			esc_attr($options['class']),
			$options['target'] ? ' target="_blank"' : '',
			esc_html($options['title'])
		);

		return apply_filters('presscore_get_button_html', $html, $options);
	}

endif; // presscore_get_button_html


if ( ! function_exists( 'presscore_get_project_link' ) ) :

	/**
	 * Get project link.
	 *
	 * return string HTML.
	 */
	function presscore_get_project_link( $class = 'link dt-btn' ) {
		if ( post_password_required() || !in_the_loop() ) return '';

		global $post;

		// project link
		$project_link = '';
		if ( get_post_meta( $post->ID, '_dt_project_options_show_link', true ) ) {
			$project_link = presscore_get_button_html( array(
				'title'		=> get_post_meta( $post->ID, '_dt_project_options_link_name', true ),
				'href'		=> get_post_meta( $post->ID, '_dt_project_options_link', true ),
				'target'	=> get_post_meta( $post->ID, '_dt_project_options_link_target', true ),
				'class'		=> $class,
			) );
		}

		return $project_link;
	}

endif; // presscore_get_project_link


if ( ! function_exists( 'presscore_post_details_link' ) ) :

	/**
	 * PressCore Details button.
	 *
	 * @param int $post_id Post ID.Default is null.
	 * @param mixed $class Custom classes. May be array or string with classes separated by ' '.
	 */
	function presscore_post_details_link( $post_id = null, $class = array('dt-btn', 'more-link') ) {
		global $post;
		
		if ( !$post_id && !$post ) return;
		if ( !$post_id ) { $post_id = $post->ID; }
		if ( post_password_required( $post_id ) ) return;
		
		if ( ! is_array( $class ) ) { $class = explode( ' ', $class ); }

		$output = '';
		$url = get_permalink( $post_id );

		if ( $url ) {
			$output = sprintf(
				'<a href="%1$s" class="%2$s" rel="nofollow">%3$s</a>',
				$url,
				esc_attr( implode( ' ', $class ) ),
				_x( 'Details', 'details button', LANGUAGE_ZONE )
			);
		}

		return apply_filters( 'presscore_post_details_link', $output, $post_id, $class );
	}

endif; // presscore_post_details_link


if ( ! function_exists( 'presscore_post_edit_link' ) ) :

	/**
	 * PressCore edit link.
	 *
	 * @param int $post_id Post ID.Default is null.
	 * @param mixed $class Custom classes. May be array or string with classes separated by ' '.
	 */
	function presscore_post_edit_link( $post_id = null, $class = array() ) {
		$output = '';
		if ( current_user_can( 'edit_posts' ) ) {
			global $post;

			if ( !$post_id && !$post ) { return; }
			
			if ( !$post_id ) { $post_id = $post->ID; }
			
			if ( !is_array( $class ) ) { $class = explode( ' ', $class ); }
			
			$url = get_edit_post_link( $post_id );
			$default_classes = array( 'dt-btn', 'more-link', 'edit-link' );
			$final_classes = array_merge( $default_classes, $class );
			
			if ( $url ) {
				$output = sprintf(
					'<a href="%1$s" class="%2$s" >%3$s</a>',
					$url,
					esc_attr( implode( ' ', $final_classes ) ),
					_x( 'Edit', 'edit button', LANGUAGE_ZONE )
				);
			}
		}
		return apply_filters( 'presscore_post_edit_link', $output, $post_id, $class );
	}

endif; // presscore_post_edit_link


if ( ! function_exists( 'presscore_post_buttons' ) ) :

	/**
	 * PressCore post Details and Edit buttons in <p> tag.
	 */
	function presscore_post_buttons() {
		echo '<p>' . presscore_post_details_link() . '</p>' . presscore_post_edit_link();
	}

endif; // presscore_post_buttons


if ( ! function_exists( 'presscore_post_buttons_depending_on_excerpt' ) ) :

	/**
	 * PressCore post Details only if excerpt not empty and Edit buttons in <p> tag.
	 */
	function presscore_post_buttons_depending_on_excerpt() {
		global $post, $pages;
		if ( $post->post_excerpt || count($pages) > 1 ) {
			echo '<p>' . presscore_post_details_link() . '</p>';
		}
		echo presscore_post_edit_link();
	}

endif; // presscore_post_buttons_depending_on_excerpt


if ( !function_exists( 'presscore_posted_on' ) ) :

	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 *
	 * @since presscore 0.1
	 */
	function presscore_posted_on( $echo = true, $class = array() ) {

		$posted_on = apply_filters('presscore_posted_on', '', $class);

		if ( $echo ) {
			echo $posted_on;
		}
		return $posted_on;
	}

endif;


if ( ! function_exists( 'presscore_get_post_data' ) ) :

	/**
	 * Get post data.
	 */
	function presscore_get_post_data( $html = '' ) {
		$html .= sprintf(
			'<span class="assistive-text">%s</span>
			<a href="%s" title="%s" rel="bookmark"><time class="entry-date" datetime="%s">%s</time></a>',
				_x('Posted on', 'frontend post meta', LANGUAGE_ZONE), // assistive text
				get_permalink(),	// href
				esc_attr( get_the_time() ),	// title
				esc_attr( get_the_date( 'c' ) ),	// datetime
				esc_html( get_the_date() )	// date
		);
		
		return $html;
	}

endif; // presscore_get_post_data


if ( ! function_exists( 'presscore_get_post_author' ) ) :

	/**
	 * Get post author.
	 */
	function presscore_get_post_author( $html = '' ) {
		$html .= sprintf(
			'<span class="assistive-text"><br></span>
			<a class="author vcard" href="%s" title="%s" rel="author">%s</a>',
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ), // href
				esc_attr( sprintf( _x( 'View all posts by %s', 'frontend post meta', LANGUAGE_ZONE ), get_the_author() ) ), // title
				_x('By ', 'frontend post meta', LANGUAGE_ZONE) . get_the_author() // author
		);
		
		return $html;
	}

endif; // presscore_get_post_author


if ( ! function_exists( 'presscore_get_post_categories' ) ) :

	/**
	 * Get post categories.
	 */
	function presscore_get_post_categories( $html = '' ) {
		$post_type = get_post_type();
		
		if ( 'post' == $post_type ) {
			$categories_list = get_the_category_list( ' ' );
		} else {
			$categories_list = get_the_term_list( get_the_ID(), $post_type . '_category', ' ' );
		}
		
		if ( $categories_list && !is_wp_error($categories_list) ) {
			$categories_list = str_replace( array( 'rel="tag"', 'rel="category tag"' ), '', $categories_list);
			$html .= $categories_list;
		}

		return $html;
	}

endif; // presscore_get_post_categories


if ( ! function_exists( 'presscore_get_post_comments' ) ) :

	/**
	 * Get post comments.
	 */
	function presscore_get_post_comments( $html = '' ) {
		if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) :
			ob_start();
			comments_popup_link( __( 'Leave a comment', LANGUAGE_ZONE ), __( '1 Comment', LANGUAGE_ZONE ), __( '% Comments', LANGUAGE_ZONE ) );
			$html .= ob_get_clean();
		endif;

		return $html;
	}

endif; // presscore_get_post_comments


if ( ! function_exists( 'presscore_get_post_tags' ) ) :

	/**
	 * Get post tags.
	 */
	function presscore_get_post_tags( $html = '' ) {
		$tags_list = get_the_tag_list( '', '' );
		if ( $tags_list ) {
			$html .= sprintf(
				'<div class="entry-tags"><span class="assistive-text">%s</span>%s</div>',
					__( 'Tags:', LANGUAGE_ZONE ),
					$tags_list
			);
		}

		return $html;
	}

endif; // presscore_get_post_tags


if ( ! function_exists( 'presscore_get_post_meta_wrap' ) ) :

	/**
	 * Get post meta wrap.
	 */
	function presscore_get_post_meta_wrap( $html = '', $class = array() ) {
		if ( empty( $html ) ) return $html;

		$current_post_type = get_post_type();

		if ( !is_array($class) ) {
			$class = explode(' ', $class);
		}

		if ( in_array( $current_post_type, array('dt_portfolio', 'dt_gallery') ) ) {
			$class[] = 'portfolio-categories';
		} else {
			$class[] = 'entry-meta';
		}

		$html = '<div class="' . esc_attr( implode(' ', $class) ) . '">' . $html . '</div>';

		return $html;
	}

endif; // presscore_get_post_meta_wrap


if ( ! function_exists( 'presscore_get_breadcrumbs' ) ) :

	/**
	 * Breadckumbs helper.
	 *
	 * @return string HTML.
	 */
	function presscore_get_breadcrumbs() {
		global $post;
		
		// TODO: provide exception for archive/404/search

		$steps = '<li><a href="' . get_home_url() . '">' . _x('Home', 'breadcrumbs', LANGUAGE_ZONE) . '</a></li>';
		
		// for all pages except homepage
		if ( is_page() || is_single() ) {
			
			if ( is_single() ) {
				// set taxonomy based on post_type
				$post_type = get_post_type($post->ID);
				switch ( $post_type ) {
					case 'post': $tax = 'category'; break;
					case 'dt_portfolio': $tax = 'dt_portfolio_category'; break;
				}

				if ( isset($tax) ) {
					// terms loop
					$terms = wp_get_object_terms( $post->ID, $tax );
					if ( $terms && !is_wp_error($terms) ) {
						$terms_links = array();

						foreach ( $terms as $term ) {
							$terms_links[] = sprintf( '<a href="%s">%s</a>', get_term_link($term->slug, $tax), $term->name );
						}
						$steps .= '<li>' . implode(', ', $terms_links) . '</li>';
					}
				}
			} else if ( is_page() ) {
				$ancestors = get_ancestors( $post->ID, 'page' );
				if ( $ancestors ) {
					$ancestors = array_reverse($ancestors);
					foreach ( $ancestors as $ancestor ) {
						$steps .= sprintf( '<li><a href="%s">%s</a></li>', get_permalink($ancestor), get_the_title($ancestor) );
					}
				}
			}

			$steps .= '<li><a href="' . get_permalink($post->ID) . '">' . get_the_title($post->ID) . '</a></li>';

		}

		$breadcrumbs = sprintf(
			'<div class="assistive-text">%s</div>
			<ol class="breadcrumbs wf-td text-small">
			%s
			</ol>',
			_x('You are here:', 'breeadcrumbs', LANGUAGE_ZONE),
			$steps
		);

		return apply_filters('presscore_get_breadcrumbs', $breadcrumbs);
	}

endif; // presscore_get_breadcrumbs


if ( ! function_exists( 'presscore_display_share_buttons' ) ) :

	/**
	 * Display share buttons.
	 */
	function presscore_display_share_buttons( $place = '', $options = array() ) {
		global $post;
		$buttons = of_get_option('social_buttons-' . $place, array());

		if ( empty($buttons) ) return '';

		$default_options = array(
			'echo'	=> true,
			'class'	=> array(),
			'id'	=> null,
		);
		$options = wp_parse_args($options, $default_options);

		$options['id'] = $options['id'] ? absint($options['id']) : $post->ID;

		$class = $options['class'];
		if ( !is_array($class) ) { $class = explode(' ', $class); }

		$class[] = 'entry-share';

		$u = get_permalink( $options['id'] );
		$t = get_the_title( $options['id'] );
		
		$protocol = "http";
		if ( isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] == 'on' ) $protocol = "https";

		$buttons_list = presscore_themeoptions_get_social_buttons_list();

		$html = '';

		$html .= '<div class="' . esc_attr(implode(' ', $class)) . '">
					<div class="soc-ico">';

		foreach ( $buttons as $button ) {
			$classes = array( 'share-button' );
			$url = '';
			$desc = $buttons_list[ $button ];
			$share_title = _x('share', 'share buttons', LANGUAGE_ZONE);
			$custom = '';

			switch( $button ) {
				case 'twitter':
					$classes[] = 'twitter';
					$share_title = _x('tweet', 'share buttons', LANGUAGE_ZONE);
					$url = add_query_arg( array('status' => $t . ' ' . $u), $protocol . '://twitter.com/home' );
					break;
				case 'facebook':
					$classes[] = 'facebook';
					$url = add_query_arg( array('u' => $u, 't' => $t), $protocol . '://www.facebook.com/sharer.php');
					break;
				case 'google+':
					$t = str_replace(' ', '+', $t);
					$classes[] = 'google';
					$url = add_query_arg( array('url' => $u, 'title' => $t), $protocol . '://plus.google.com/share' );
					break;
				case 'pinterest':
					// wp_enqueue_script('pinit-script', get_stylesheet_directory_uri() . '/js/pin-it.js');

					$url = '//pinterest.com/pin/create/button/';
					
					// if image
					if ( wp_attachment_is_image($options['id']) ) {
						$image = wp_get_attachment_image_src($options['id'], 'full');
					
						if ( !empty($image) ) {
							$url = add_query_arg( array(
								'url'			=> $u,
								'media'			=> $image[0],
								'description'	=> $t
								), $url
							);
						}
					}

					$classes[] = 'pinterest';
					$share_title = _x('pin it', 'share buttons', LANGUAGE_ZONE);
					$custom = ' data-pin-config="above" data-pin-do="buttonBookmark"';
					break;
			}

			$desc = esc_attr($desc);
			$share_title = esc_attr($share_title);
			$classes_str = esc_attr( implode(' ', $classes) );
			$url = esc_url( $url );

			$share_button = sprintf(
				'<a href="%2$s" class="%1$s" target="_blank" title="%3$s"%5$s><span class="assistive-text">%3$s</span><span class="share-content">%4$s</span></a>',
				$classes_str,
				$url,
				$desc,
				$share_title,
				$custom
			);

			$html .= apply_filters( 'presscore_share_button', $share_button, $button, $classes, $url, $desc, $share_title, $t, $u );
		}

		$html .= '</div>
			</div>';

		$html = apply_filters( 'presscore_display_share_buttons', $html );

		if ( $options['echo'] ) echo $html;
		return $html;
	}

endif; // presscore_display_share_buttons


if ( ! function_exists( 'presscore_get_share_buttons_for_prettyphoto' ) ) :

	/**
	 * Share buttons lite.
	 *
	 */
	function presscore_get_share_buttons_for_prettyphoto( $place = '', $options = array() ) {
		global $post;
		$buttons = of_get_option('social_buttons-' . $place, array());

		if ( empty($buttons) ) return '';

		$default_options = array(
			'id'	=> null,
		);
		$options = wp_parse_args($options, $default_options);

		$options['id'] = $options['id'] ? absint($options['id']) : $post->ID;

		$u = get_permalink( $options['id'] );
		// $t = get_the_title( $options['id'] );
		
		$html = '';

		$html .= sprintf(
			' data-pretty-share="%s" data-pretty-share-url="%s"',
			esc_attr( str_replace( '+', '', implode( ',', $buttons ) ) ),
			esc_url($u)
		);

		return $html;
	}

endif; // presscore_get_share_buttons_for_prettyphoto


if ( ! function_exists( 'presscore_top_bar_contacts_list' ) ) :

	/**
	 * Get contact information for top bar.
	 *
	 * @since presscore 0.1
	 */
	function presscore_top_bar_contacts_list(){
		$contact_fields = array(
			'address',
			'phone',
			'email',
			'skype',
			'clock',
			'info'
		);

		foreach ( $contact_fields as $contact_id ) {
			$contact_content = of_get_option( 'top_bar-contact_' . $contact_id );
			if ( $contact_content ) :
				?>
				<li class="<?php echo esc_attr( $contact_id ); ?>"><?php echo $contact_content; ?></li>
				<?php 
			endif;
		}
	}

endif; // presscore_top_bar_contacts_list


if ( ! function_exists( 'presscore_main_container_classes' ) ) :

	/**
	 * Main container classes.
	 */
	function presscore_main_container_classes( $classes = array() ) {
		$classes = apply_filters('presscore_main_container_classes', $classes);
		if ( !empty($classes) ) {
			printf( 'class="%s"', esc_attr( implode(' ', (array)$classes) ) );
		}
	}

endif; // presscore_main_container_classes


if ( ! function_exists( 'presscore_nav_menu_list' ) ) :

	/**
	 * Make top/bottom menu.
	 *
	 * @param $menu_name string Valid menu name.
	 * @param $style string Align of menu. May be left or right. right by default.
	 *
	 * @since presscore 0.1
	 */
	function presscore_nav_menu_list( $menu_name = '', $style = 'right' ) {
		$menu_list = '';

		if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
			
			$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
			
			if ( !$menu ) return '';
			
			$menu_items = wp_get_nav_menu_items($menu->term_id);

			if ( 'left' == $style ) {
				$class = 'wf-float-left';
			} else {
				$class = 'wf-float-right';
			}

			$menu_list .= '<div class="mini-nav ' . $class . '"><ul>';

			foreach ( (array) $menu_items as $key => $menu_item ) {
				$title = $menu_item->title;
				$url = $menu_item->url;
				$attr = '';

				// target
				if ( $menu_item->target ) $attr .= ' target="' . esc_attr($menu_item->target) . '"';
				
				// title
				if ( $menu_item->attr_title ) $attr .= ' title="' . esc_attr($menu_item->attr_title) . '"';
				
				// classes
				if ( is_array($menu_item->classes) && $classes = implode(' ', $menu_item->classes) )
					$attr .= ' class="' . esc_attr($classes) . '"';
				
				// rel
				if ( $menu_item->xfn ) $attr .= ' rel="' . esc_attr($menu_item->xfn) . '"';

				$menu_list .= '<li><a href="' . $url . '"' . $attr . '>' . $title . '</a></li>';
			}
			$menu_list .= '</ul></div>';
		}

		echo $menu_list;
	}

endif; // presscore_nav_menu_list


if ( ! function_exists( 'presscore_the_title_trim' ) ) :

	/**
	 * Replace protected and private title part.
	 *
	 * From http://wordpress.org/support/topic/how-to-remove-private-from-private-pages
	 *
	 * @return string Clear title.
	 */
	function presscore_the_title_trim( $title ) {
		$pattern[0] = '/Protected:/';
		$pattern[1] = '/Private:/';
		$replacement[0] = ''; // Enter some text to put in place of Protected:
		$replacement[1] = ''; // Enter some text to put in place of Private	
		return preg_replace($pattern, $replacement, $title);
	}

endif; // presscore_the_title_trim


if ( ! function_exists( 'presscore_get_team_links_array' ) ) :

	/**
	 * Return links list for team post meta box.
	 *
	 * @return array.
	 */
	function presscore_get_team_links_array() {
		return array(
			'facebook'		=> array( 'desc' => _x(	'Facebook', 'team link', LANGUAGE_ZONE ) ),
			'linkedin'		=> array( 'desc' => _x(	'LinkedIn', 'team link', LANGUAGE_ZONE ) ),
			'twitter'		=> array( 'desc' => _x(	'Twitter', 'team link', LANGUAGE_ZONE ) ),
			'behance'		=> array( 'desc' => _x(	'Behance', 'team link', LANGUAGE_ZONE ) ),
			'dribbble'		=> array( 'desc' => _x(	'Dribbble', 'team link', LANGUAGE_ZONE ) ),
			'pinterest'		=> array( 'desc' => _x(	'Pinterest', 'team link', LANGUAGE_ZONE) ),
			'website'		=> array( 'desc' => _x( 'Personal blog / website', 'team link', LANGUAGE_ZONE ) ),
			'mail'			=> array( 'desc' => _x( 'E-mail', 'team link', LANGUAGE_ZONE ) ),
		);
	}

endif; // presscore_get_team_links_array


if ( ! function_exists( 'presscore_themeoptions_get_headers_defaults' ) ) :

	/**
	 * Returns headers defaults array.
	 *
	 * @return array.
	 * @since presscore 0.1
	 */
	function presscore_themeoptions_get_headers_defaults() {

		$headers = array(
			'h1'	=> array(
				'desc'	=> _x('H1', 'theme-options', LANGUAGE_ZONE),
				'fs'	=> 44,	// font size
				'ff'	=> '',	// font face
				'lh'	=> 50,	// line height
				'uc'	=> 0,	// upper case
			), 
			'h2'	=> array(
				'desc'	=> _x('H2', 'theme-options', LANGUAGE_ZONE),
				'fs'	=> 26,
				'ff'	=> '',
				'lh'	=> 30,
				'uc'	=> 0
			), 
			'h3'	=> array(
				'desc'	=> _x('H3', 'theme-options', LANGUAGE_ZONE),
				'fs'	=> 22,
				'ff'	=> '',
				'lh'	=> 30,
				'uc'	=> 0
			),
			'h4'	=> array(
				'desc'	=> _x('H4', 'theme-options', LANGUAGE_ZONE),
				'fs'	=> 18,
				'ff'	=> '',
				'lh'	=> 20,
				'uc'	=> 0
			),
			'h5'	=> array(
				'desc'	=> _x('H5', 'theme-options', LANGUAGE_ZONE),
				'fs'	=> 15,
				'ff'	=> '',
				'lh'	=> 20,
				'uc'	=> 0
			),
			'h6'	=> array(
				'desc'	=> _x('H6', 'theme-options', LANGUAGE_ZONE),
				'fs'	=> 12,
				'ff'	=> '',
				'lh'	=> 20,
				'uc'	=> 0
			)
		);

		return $headers;
	}

endif; // presscore_themeoptions_get_headers_defaults


if ( ! function_exists( 'presscore_themeoptions_get_buttons_defaults' ) ) :

	/**
	 * Buttons defaults array.
	 */
	function presscore_themeoptions_get_buttons_defaults() {
		return array(
			's'		=> array(
				'desc'	=> _x('Small buttons', 'theme-options', LANGUAGE_ZONE),
				'ff'	=> '',
				'fs'	=> 12,
				'uc'	=> 0,
				'lh'	=> 21
				),
			'm'	=> array(
				'desc'	=> _x('Medium buttons', 'theme-options', LANGUAGE_ZONE),
				'ff'	=> '',
				'fs'	=> 12,
				'uc'	=> 0,
				'lh'	=> 23
				),
			'l'	=> array(
				'desc'	=> _x('Big buttons', 'theme-options', LANGUAGE_ZONE),
				'ff'	=> '',
				'fs'	=> 14,
				'uc'	=> 0,
				'lh'	=> 32
				)
		);
	}

endif; // presscore_themeoptions_get_buttons_defaults


if ( ! function_exists( 'presscore_themeoptions_get_hoover_options' ) ) :

	/**
	 * Hoover options.
	 */
	function presscore_themeoptions_get_hoover_options() {
		return array(
			'none'			=> _x('None', 'theme-options', LANGUAGE_ZONE),
			'grayscale'		=> _x('Grayscale', 'theme-options', LANGUAGE_ZONE),
			'gray+color'	=> _x('Grayscale with color hovers', 'theme-options', LANGUAGE_ZONE),
		);
	}

endif; // presscore_themeoptions_get_hoover_options


if ( ! function_exists( 'presscore_themeoptions_get_general_layout_options' ) ) :

	/**
	 * General layout.
	 */
	function presscore_themeoptions_get_general_layout_options() {
		return array(
			'wide'	=> _x('Wide', 'theme-options', LANGUAGE_ZONE),
			'boxed'	=> _x('Boxed', 'theme-options', LANGUAGE_ZONE)
		);
	}

endif; // presscore_themeoptions_get_general_layout_options


if ( ! function_exists( 'presscore_themeoptions_get_social_buttons_list' ) ) :

	/**
	 * Social buttons.
	 */
	function presscore_themeoptions_get_social_buttons_list() {
		return array(
			'facebook' 	=> __('Facebook', LANGUAGE_ZONE),
			'twitter' 	=> __('Twitter', LANGUAGE_ZONE),
			'google+' 	=> __('Google+', LANGUAGE_ZONE),
			'pinterest' => __('Pinterest', LANGUAGE_ZONE),			
		);
	}

endif; // presscore_themeoptions_get_social_buttons_list


if ( ! function_exists( 'presscore_themeoptions_get_template_list' ) ) :

	/**
	 * Templates list.
	 */
	function presscore_themeoptions_get_template_list(){
		return array(
			'post' 				=> _x('Social buttons in blog posts', 'theme-options', LANGUAGE_ZONE),
			'portfolio_post' 	=> _x('Social buttons in portfolio projects', 'theme-options', LANGUAGE_ZONE),
			'photo' 			=> _x('Social buttons in media (photos and videos)', 'theme-options', LANGUAGE_ZONE),
		);
	}

endif; // presscore_themeoptions_get_template_list


if ( ! function_exists( 'presscore_themeoptions_get_stripes_list' ) ) :

	/**
	 * Stripes list.
	 */
	function presscore_themeoptions_get_stripes_list() {
		return array(
			1 => array(
				'title'				=> _x('Stripe 1', 'theme-options', LANGUAGE_ZONE),
				
				'bg_color'			=> '#222526',
				'bg_opacity'		=> 100,
				'bg_color_ie'		=> '#222526',
				'bg_img'			=> array(
					'image'			=> '',
					'repeat'		=> 'repeat',
					'position_x'	=> 'center',
					'position_y'	=> 'center'
				),
				'bg_fullscreen'		=> false,

				'text_color'		=> '#828282',
				'text_header_color'	=> '#ffffff',
				
				'div_color'		=> '#828282',
				'div_opacity'		=> 100,
				'div_color_ie'		=> '#828282',
				
				'addit_color'		=> '#dcdcdb',
				'addit_opacity'		=> 100,
				'addit_color_ie'	=> '#dcdcdb',
			),
			2 => array(
				'title'				=> _x('Stripe 2', 'theme-options', LANGUAGE_ZONE),
				
				'bg_color'			=> '#aeaeae',
				'bg_opacity'		=> 100,
				'bg_color_ie'		=> '#aeaeae',
				'bg_img'			=> array(
					'image'			=> '',
					'repeat'		=> 'repeat',
					'position_x'	=> 'center',
					'position_y'	=> 'center'
				),
				'bg_fullscreen'		=> false,

				'text_color'		=> '#828282',
				'text_header_color'	=> '#ffffff',
				
				'div_color'		=> '#dcdcdb',
				'div_opacity'		=> 100,
				'div_color_ie'		=> '#dcdcdb',
				
				'addit_color'		=> '#dcdcdb',
				'addit_opacity'		=> 100,
				'addit_color_ie'	=> '#dcdcdb',
			),
			3 => array(
				'title'				=> _x('Stripe 3', 'theme-options', LANGUAGE_ZONE),
				
				'bg_color'			=> '#cacaca',
				'bg_opacity'		=> 100,
				'bg_color_ie'		=> '#cacaca',
				'bg_img'			=> array(
					'image'			=> '',
					'repeat'		=> 'repeat',
					'position_x'	=> 'center',
					'position_y'	=> 'center'
				),
				'bg_fullscreen'		=> false,
				
				'text_color'		=> '#828282',
				'text_header_color'	=> '#ffffff',
				
				'div_color'		=> '#dcdcdb',
				'div_opacity'		=> 100,
				'div_color_ie'		=> '#dcdcdb',
				
				'addit_color'		=> '#dcdcdb',
				'addit_opacity'		=> 100,
				'addit_color_ie'	=> '#dcdcdb',
			),
		);
	}

endif; // presscore_themeoptions_get_stripes_list


if ( ! function_exists( 'presscore_get_post_format_class' ) ) :

	/**
	 * Post format class adapter.
	 */
	function presscore_get_post_format_class( $post_format = null ) {

		if ( 'post' == get_post_type() && null === $post_format ) {
			$post_format = get_post_format();
		}

		$format_class_adapter = array(
			''			=> 'format-standard',
			'image'		=> 'format-photo',
			'gallery'	=> 'format-gallery',
			'quote'		=> 'format-quote',
			'video'		=> 'format-video',
			'link'		=> 'format-link',
			'audio'		=> 'format-audio',
			'chat'		=> 'format-chat',
			'status'	=> 'format-status',
			'aside'		=> 'format-aside'
		);
		$format_class = isset( $format_class_adapter[ $post_format ] ) ? $format_class_adapter[ $post_format ] : $format_class_adapter[''];

		return $format_class;
	} 

endif; // presscore_get_post_format_class


if ( ! function_exists( 'presscore_display_post_author' ) ) :

	/**
	 * Post author snippet.
	 *
	 * Use only in the loop.
	 *
	 * @since presscore 0.1
	 */
	function presscore_display_post_author() {

	$user_url = get_the_author_meta('user_url');
	$avatar = get_avatar( get_the_author_meta('ID'), 80, presscore_get_default_avatar() );
	?>

	<div class="entry-author">
		<?php
		if ( $user_url ) {
			printf( '<a href="%s" class="alignright">%s</a>', esc_url($user_url), $avatar );
		} else {
			echo str_replace( "class='", "class='alignright ", $avatar );
		}
		?>
		<p class="text-primary"><?php _e('About the author', LANGUAGE_ZONE); ?></p>
		<p><?php the_author_meta('description'); ?></p>
	</div>

	<?php
	}

endif; // presscore_display_post_author


if ( ! function_exists( 'presscore_get_default_avatar' ) ) :

	/**
	 * Get default avatar.
	 *
	 * @return string.
	 */
	function presscore_get_default_avatar() {
		return PRESSCORE_THEME_URI . '/images/no-avatar.gif';
	}

endif; // presscore_get_default_avatar

if ( !function_exists('presscore_get_default_image') ) :
	
	/**
	 * Get default image.
	 *
	 * Return array( 'url', 'width', 'height' );
	 *
	 * @return array.
	 */
	function presscore_get_default_image() {
		return array( PRESSCORE_THEME_URI . '/images/noimage.jpg', 1000, 1000 );
	}

endif;


if ( ! function_exists( 'presscore_responsive' ) ) :

	/**
	 * Set some responsivness flag.
	 */
	function presscore_responsive() {
		return absint( of_get_option( 'general-responsive', 1 ) );
	}

endif; // presscore_responsive


if ( ! function_exists( 'presscore_get_logo_image' ) ) :

	/**
	 * Get logo image.
	 * 
	 * @return mixed.
	 */
	function presscore_get_logo_image( $logos = array() ) {
		$default_logo = null;
		
		if ( !is_array( $logos ) ) return false;

		// get default logo
		foreach ( $logos as $logo ) {
			if ( $logo ) { $default_logo = $logo; break; }
		}

		if ( empty($default_logo) ) return false;

		$alt = esc_attr( get_bloginfo( 'name' ) );
		
		$logo = dt_get_retina_sensible_image(
			$logos['logo'],
			$logos['logo_retina'],
			$default_logo,
			' alt="' . $alt . '"'
		);

		return $logo;
	}

endif; // presscore_get_logo_image


if ( ! function_exists( 'presscore_get_header_logos_meta' ) ) :

	/**
	 * Get header logos meta.
	 *
	 * @return array.
	 */
	function presscore_get_header_logos_meta() {
		return array(
			'logo' 			=> dt_get_uploaded_logo( of_get_option( 'header-logo_regular', array('', 0) ) ),
			'logo_retina'	=> dt_get_uploaded_logo( of_get_option( 'header-logo_hd', array('', 0) ), 'retina' ),
		);	
	}

endif; // presscore_get_header_logos_meta


if ( ! function_exists( 'presscore_get_footer_logos_meta' ) ) :

	/**
	 * Get footer logos meta.
	 *
	 * @return array.
	 */
	function presscore_get_footer_logos_meta() {
		return array(
			'logo' 			=> dt_get_uploaded_logo( of_get_option( 'bottom_bar-logo_regular', array('', 0) ) ),
			'logo_retina'	=> dt_get_uploaded_logo( of_get_option( 'bottom_bar-logo_hd', array('', 0) ), 'retina' ),
		);	
	}

endif; // presscore_get_footer_logos_meta

// TODO: refactor this!
/**
 * Categorizer.
 */
function presscore_get_category_list( $args = array() ) {
	global $post;

	$defaults = array(
		// 'wrap'              => '<div class="%CLASS%"><div class="filter-categories">%LIST%</div></div>',
		'item_wrap'         => '<a href="%HREF%" %CLASS% data-filter="%CATEGORY_ID%">%TERM_NICENAME%</a>',
		'hash'              => '#!term=%TERM_ID%&amp;page=%PAGE%&amp;orderby=date&amp;order=DESC',
		'item_class'        => '',    
		'all_class'        	=> 'show-all',
		'other_class'		=> '',
		'class'             => 'filter',
		'current'           => 'all',
		'page'              => '1',
		'ajax'              => false,
		'all_btn'           => true,
		'other_btn'         => true,
		'echo'				=> true,
		'data'				=> array(),
		'before'			=> '<div class="filter-categories">',
		'after'				=> '</div>',
		'act_class'			=> 'act',
	);
	$args = wp_parse_args( $args, $defaults );
	$args = apply_filters( 'presscore_get_category_list-args', $args );

	$data = $args['data'];

/*	if ( ! $data || 
		( count( $data['terms'] ) == 1 && empty( $data['other_count'] ) ) ||
		 ( count( $data['terms'] ) < 1 && !empty( $data['other_count'] ) )
	) {
		return '';
	}
*/
	$args['hash'] = str_replace( array( '%PAGE%' ), array( $args['page'] ), $args['hash'] );
	$output = $all = '';

	if ( isset($data['terms']) &&
		( ( count( $data['terms'] ) == 1 && !empty( $data['other_count'] ) ) ||
		count( $data['terms'] ) > 1 )
	) {
		if ( !empty( $args['item_class'] ) ) {
			$args['item_class'] = 'class="' . esc_attr($args['item_class']) . '"';
		}

		$replace_list = array( '%HREF%', '%CLASS%', '%TERM_DESC%', '%TERM_NICENAME%', '%TERM_SLUG%', '%TERM_ID%', '%COUNT%', '%CATEGORY_ID%' );

		foreach( $data['terms'] as $term ) {

			$item_class = array();

			if ( !empty( $args['item_class'] ) ) {
				$item_class[] = $args['item_class'];
			}

			if ( in_array( $args['current'], array($term->term_id, $term->slug) ) ) {
				$item_class[] = $args['act_class'];
			}

			if ( $item_class ) {
				$item_class = sprintf( 'class="%s"', esc_attr( implode( ' ', $item_class ) ) );
			} else {
				$item_class = '';
			}

			$output .= str_replace(
				$replace_list,
				array(
					esc_url( str_replace( array( '%TERM_ID%' ), array( $term->term_id ), $args['hash'] ) ),
					$item_class,
					$term->category_description,
					$term->cat_name,
					esc_attr($term->slug),
					esc_attr($term->term_id),
					$term->count,
					esc_attr('.category-' . $term->term_id),
				), $args['item_wrap']
			);
		}

		// all button
		if ( $args['all_btn'] ) {
			$all_class = array();

			if ( !empty( $args['all_class'] ) ) {
				$all_class[] = $args['all_class'];
			}

			if ( 'all' == $args['current'] ) {
				$all_class[] = $args['act_class'];
			}

			if ( $all_class ) {
				$all_class = sprintf( 'class="%s"', esc_attr( implode( ' ', $all_class ) ) );
			} else {
				$all_class = '';
			}

			$all = str_replace(
				$replace_list,
				array(
					esc_url( str_replace( array( '%TERM_ID%' ), array( '' ), $args['hash'] ) ),
					$all_class,
					_x( 'All posts', 'category list', LANGUAGE_ZONE ),
					_x( 'View all', 'category list', LANGUAGE_ZONE ),
					'',
					'',
					$data['all_count'],
					'*',
				), $args['item_wrap']
			);
		}

		// other button
		if( $data['other_count'] && $args['other_btn'] ) {
			$other_class = array();
			
			if ( !empty( $args['other_class'] ) ) {
				$other_class[] = $args['other_class'];
			}

			if ( 'none' == $args['current'] ) {
				$other_class[] = $args['act_class'];
			}

			if ( $other_class ) {
				$other_class = sprintf( 'class="%s"', esc_attr( implode( ' ', $other_class ) ) );
			} else {
				$other_class = '';
			}

			$output .= str_replace(
				$replace_list,
				array(
					esc_url( str_replace( array( '%TERM_ID%' ), array( 'none' ), $args['hash'] ) ),
					$other_class,
					_x( 'Other posts', 'category list', LANGUAGE_ZONE ),
					_x( 'Other', 'category list', LANGUAGE_ZONE ),
					'',
					0,
					$data['other_count'],
					esc_attr('.category-0'),
				), $args['item_wrap']
			); 
		}

		$output = $args['before'] . $all . $output . $args['after'];
		// $output = str_replace( array( '%LIST%', '%CLASS%' ), array( $output, $args['class'] ), $args['wrap'] );
		$output = str_replace( array( '%CLASS%' ), array( $args['class'] ), $output );
	}

	$output = apply_filters( 'presscore_get_category_list', $output, $args );

	if ( $args['echo'] ) {
		echo $output;
	} else {
		return $output;
	}
	return false;
}


if ( ! function_exists( 'presscore_get_categorizer_sorting_fields' ) ) :

	/**
	 * Get Categorizer sorting fields.
	 */
	function presscore_get_categorizer_sorting_fields() {

		$config = Presscore_Config::get_instance();	
		
		$request_display = $config->get('request_display');
		
		$orderby = $config->get('orderby');
		$order = $config->get('order');

		if ( null !== $request_display ) {
			$display = $request_display;
		} else {
			$display = $config->get('display');	
		}

		$select = isset($display['select']) ? $display['select'] : 'all';
		$term_id = isset($display['terms_ids']) ? current( (array) $display['terms_ids'] ) : array();

		$paged = dt_get_paged_var();

		$term = '';
		if ( 'except' == $select && 0 === $term_id ) {
			$term = 'none';
		} else if ( 'only' == $select ) {
			$term = absint( $term_id );
		}

		if ( $paged > 1 ) {
			$base_link = get_pagenum_link($paged);
		} else {
			$base_link = get_permalink();
		}

		$link = add_query_arg( 'term', $term, $base_link );

		$act = ' class="act"';

		$html = '<div class="filter-extras">' . "\n" . '<div class="filter-by">' . "\n";

		$html .= '<a href="' . esc_url( add_query_arg( array( 'orderby' => 'date', 'order' => $order ), $link ) ) . '" data-by="date"' . ('date' == $orderby ? $act : '') . '>' . __( 'Date', LANGUAGE_ZONE ) . '</a>' . "\n";
		$html .= '<a href="' . esc_url( add_query_arg( array( 'orderby' => 'name', 'order' => $order ), $link ) ) . '" data-by="name"' . ('name' == $orderby ? $act : '') . '>' . __( 'Name', LANGUAGE_ZONE ) . '</a>' . "\n";

		$html .= '</div>' . "\n" . '<div class="filter-sorting">' . "\n";

		$html .= '<a href="' . esc_url( add_query_arg( array( 'orderby' => $orderby, 'order' => 'DESC' ), $link ) ) . '" data-sort="desc"' . ('DESC' == $order ? $act : '') . '>' . __( 'Desc', LANGUAGE_ZONE ) . '</a>';
		$html .= '<a href="' . esc_url( add_query_arg( array( 'orderby' => $orderby, 'order' => 'ASC' ), $link ) ) . '" data-sort="asc"' . ('ASC' == $order ? $act : '') . '>' . __( 'Asc', LANGUAGE_ZONE ) . '</a>';

		$html .= '</div>' . "\n" . '</div>' . "\n";

		return $html;
	}

endif; // presscore_get_categorizer_sorting_fields


if ( ! function_exists( 'presscore_meta_boxes_get_images_proportions' ) ) :

	/**
	 * Image proportions array.
	 *
	 * @return array.
	 */
	function presscore_meta_boxes_get_images_proportions( $prop = false ) {

		$ratios = array(
			'1'		=> array( 'ratio' => 0.33, 'desc' => '1:3' ),
			'2'		=> array( 'ratio' => 0.3636, 'desc' => '4:11' ),
			'3'		=> array( 'ratio' => 0.45, 'desc' => '9:20' ),
			'4'		=> array( 'ratio' => 0.5625, 'desc' => '9:16' ),
			'5'		=> array( 'ratio' => 0.6, 'desc' => '3:5' ),
			'6'		=> array( 'ratio' => 0.6666, 'desc' => '2:3' ),
			'7'		=> array( 'ratio' => 0.75, 'desc' => '3:4' ),
			'8'		=> array( 'ratio' => 1, 'desc' => '1:1' ),
			'9'		=> array( 'ratio' => 1.33, 'desc' => '4:3' ),
			'10'	=> array( 'ratio' => 1.5, 'desc' => '3:2' ),
			'11'	=> array( 'ratio' => 1.66, 'desc' => '5:3' ),
			'12'	=> array( 'ratio' => 1.77, 'desc' => '16:9' ),
			'13'	=> array( 'ratio' => 2.22, 'desc' => '20:9' ),
			'14'	=> array( 'ratio' => 2.75, 'desc' => '11:4' ),
			'15'	=> array( 'ratio' => 3, 'desc' => '3:1' ),
		);

		if ( false === $prop ) return $ratios;

		if ( isset($ratios[ $prop ]) ) return $ratios[ $prop ]['ratio'];

		return false;
	}

endif; // presscore_meta_boxes_get_images_proportions


if ( ! function_exists( 'presscore_prepare_video_url' ) ) :

	/**
	 * Prepare video url.
	 *
	 */
	function presscore_prepare_video_url( $video_url = '' ) {
		if ( $video_url ) $video_url = add_query_arg( array( 'iframe' => 'true', 'width' => 700, 'height' => 400 ), $video_url );

		return $video_url;
	}

endif; // presscore_prepare_video_url


if ( ! function_exists( 'presscore_blog_title' ) ) :

	/**
	 * Display blog title.
	 *
	 */
	function presscore_blog_title() {
		$wp_title = wp_title('', false);
		$title = get_bloginfo('name') . ' | ';
		$title .= (is_front_page()) ? get_bloginfo('description') : $wp_title;

		return apply_filters( 'presscore_blog_title', $title, $wp_title );
	}

endif; // presscore_blog_title


if ( ! function_exists( 'presscore_get_blank_image' ) ) :

	/**
	 * Get blank image.
	 *
	 */
	function presscore_get_blank_image() {
		return get_template_directory_uri() . '/images/1px.gif';
	}

endif; // presscore_get_blank_image


if ( ! function_exists( 'presscore_get_widgetareas_options' ) ) :

	/**
	 * Prepare array with widgetareas options.
	 *
	 */
	function presscore_get_widgetareas_options() {
		$widgetareas_list = array();
		$widgetareas_stored = of_get_option('widgetareas', false);
		if ( is_array($widgetareas_stored) ) {
			foreach ( $widgetareas_stored as $index=>$desc ) {
				$widgetareas_list[ 'sidebar_' . $index ] = $desc['sidebar_name'];
			}
		}

		return $widgetareas_list;
	}

endif; // presscore_get_widgetareas_options


if ( ! function_exists( 'presscore_language_selector_flags' ) ) :

	/**
	 * Language flags for wpml.
	 *
	 */
	function presscore_language_selector_flags() {
		$languages = icl_get_languages('skip_missing=0&orderby=code');

		if(!empty($languages)){

			echo '<div class="mini-lang wf-float-right"><ul>';

			foreach($languages as $l){

				echo '<li>';

				if(!$l['active']) echo '<a href="'.$l['url'].'">';

				echo '<img src="'.$l['country_flag_url'].'" alt="'.$l['language_code'].'" />';

				if(!$l['active']) echo '</a>';

				echo '</li>';

			}

			echo '</ul></div>';

		}

	}

endif; // presscore_language_selector_flags


if ( ! function_exists( 'presscore_is_content_visible' ) ) :

	/**
	 * Flag to check is content visible.
	 *
	 */
	function presscore_is_content_visible() {
		$config = Presscore_Config::get_instance();
		return !( 'slideshow' == $config->get('header_title') && '3d' == $config->get('slideshow_mode') && 'fullscreen-content' == $config->get('slideshow_3d_layout') );
	}

endif; // presscore_is_content_visible


if ( ! function_exists( 'presscore_enqueue_web_fonts' ) ) :

	/**
	 * PressCore web fonts enqueue.
	 *
	 * @since: presscore 0.1
	 */
	function presscore_enqueue_web_fonts() {
		// get web fonts from theme options
		$headers = presscore_themeoptions_get_headers_defaults();
		$buttons = presscore_themeoptions_get_buttons_defaults();

		$skin = of_get_option( 'preset' );

		$fonts = array();
		
		// main fonts
		$fonts['dt-font-basic'] = of_get_option('fonts-font_family');

		// h fonts
		foreach ( $headers as $id=>$opts ) {
			$fonts[ 'dt-font-' . $id ] = of_get_option('fonts-' . $id . '_font_family');
		}

		// buttons fonts
		foreach ( $buttons as $id=>$opts ) {
			$fonts[ 'dt-font-btn-' . $id ] = of_get_option('buttons-' . $id . '_font_family');
		}

		// menu font
		$fonts['dt-font-menu'] = of_get_option('header-font_family');

		// we do not want duplicates
		$fonts = array_unique($fonts);

		foreach ( $fonts as $id=>$font ) {
			if ( dt_stylesheet_maybe_web_font($font) && ($font_uri = dt_make_web_font_uri($font)) ) {
				wp_enqueue_style($id . '-' . $skin, $font_uri);
			}
		}
	}

endif; // presscore_enqueue_web_fonts


if ( ! function_exists( 'presccore_get_content' ) ) :

	/**
	 * Show content with funny details button.
	 *
	 */
	function presccore_get_the_excerpt() {
		global $post, $more;
		$more = 0;

		if ( !has_excerpt( $post->ID ) && preg_match( '/<!--more(.*?)?-->/', $post->post_content, $matches ) ) {

			$content = get_the_content('');
			$content = strip_shortcodes( $content );
			$content = apply_filters('the_content', $content);
			$content = str_replace(']]>', ']]&gt;', $content);

			$content .= apply_filters( 'presccore_get_content-more', '' );
		} else {
			$content = apply_filters( 'the_excerpt', get_the_excerpt() );
		}

		return $content;
	}

endif; // presccore_get_content

if ( ! function_exists( 'presccore_the_excerpt' ) ) :

	/**
	 * Echo custom content.
	 *
	 */
	function presccore_the_excerpt() {
		echo presccore_get_the_excerpt();
	}

endif; // presccore_the_excerpt