<?php
/**
 * Description here.
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

global $post;

$media_layout = get_post_meta( $post->ID, '_dt_project_media_options_layout', true );

$before_content = '<div class="wf-container">';
$after_content = '</div>';

$is_pass_protected = post_password_required();

if ( !$is_pass_protected && 'disabled' != $media_layout ) {

	// get media
	$media_items = get_post_meta( $post->ID, '_dt_project_media_items', true );
	$media_type = get_post_meta( $post->ID, '_dt_project_media_options_type', true );

	if ( !$media_items ) $media_items = array();

	// if we have post thumbnail and it's not hidden
	if ( has_post_thumbnail() && !get_post_meta( $post->ID, '_dt_project_options_hide_thumbnail', true ) ) {
		array_unshift( $media_items, get_post_thumbnail_id() );
	}

	$attachments_data = presscore_get_attachment_post_data( $media_items );

	if ( count( $attachments_data ) > 1 ) {
		// media html
		switch ( $media_type ) {
			case 'gallery' :
				$media_html = presscore_get_images_gallery_1( $attachments_data, array( 'links_rel' => 'data-pp="prettyPhoto[portfolio-' . $post->ID . ']"' ) );
				break;
			case 'list' :
				$media_html = presscore_get_images_list( $attachments_data );
				break;
			default:
				// slideshow dimensions
				$slider_proportions = get_post_meta( $post->ID, '_dt_project_media_options_slider_proportions',  true );
				$slider_proportions = wp_parse_args( $slider_proportions, array( 'width' => '', 'height' => '' ) );

				$width = $slider_proportions['width'];
				$height = $slider_proportions['height'];

				$media_html = presscore_get_royal_slider( $attachments_data, array(
					'class' 	=> array('slider-post'),
					'width' 	=> $width,
					'height'	=> $height,
					'style'		=> ' style="width: 100%;"',
				) );
		}
	} else {
		$media_html = presscore_get_post_attachment_html(
			current($attachments_data),
			array( 'wrap' => '<img %IMG_CLASS% %SRC% %IMG_TITLE% %ALT% %SIZE% />' )
		);
		if ( $media_html ) $media_html = sprintf( '<div class="images-container">%s</div>', $media_html );
	}

	$content_container_class = 'wf-1';
	$media_html_with_wrap = '';

	if ( $media_html && in_array( $media_type, array( 'list', 'gallery' ) ) ) {
		$media_html = sprintf( '<div class="images-container">%s</div>', $media_html );
	}

	// wrap media html
	if ( $media_html ) { $media_html_with_wrap = '<div class="wf-cell wf-2-3 project-slider">' . $media_html . '</div>'; $content_container_class = 'wf-1-3'; }

	// layout
	switch ( $media_layout ) {
		case 'left':
			$before_content .= sprintf( '%s<div class="wf-cell %s project-content">', $media_html_with_wrap, $content_container_class );
			$after_content = '</div>' . $after_content;
			break;
		case 'right':
			$before_content .= '<div class="wf-cell ' . $content_container_class . ' project-content">';
			$after_content .= sprintf( '%s', $media_html_with_wrap );
			break;
	}

// if media disabled
} else {
	$before_content .= '<div class="wf-cell wf-1 project-content">';
	$after_content = '</div>' . $after_content;
}

echo $before_content;
the_content();

echo presscore_get_project_link('dt-btn dt-btn-m btn-project-link');

presscore_posted_on( true );
presscore_display_share_buttons( 'portfolio_post' );
wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', LANGUAGE_ZONE ), 'after' => '</div>' ) );

echo $after_content;