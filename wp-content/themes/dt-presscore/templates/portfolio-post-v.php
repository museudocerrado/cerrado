<?php
/**
 * Description here.
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

global $post;

$media_layout = get_post_meta( $post->ID, '_dt_project_media_options_layout', true );

$before_content = '<div class="wf-container"><div class="wf-cell wf-1">';
$after_content = '</div></div>';

// share buttons
$share_buttons = presscore_display_share_buttons( 'portfolio_post', array('echo' => false) );
$share_buttons = str_replace('class="entry-share', 'class="entry-share wf-td', $share_buttons);

// meta
$post_meta = presscore_posted_on( false );
$post_meta = str_replace('class="portfolio-categories', 'class="portfolio-categories wf-td', $post_meta);

// link pages
$link_pages = wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', LANGUAGE_ZONE ), 'after' => '</div>', 'echo' => false ) );

// get meta
$media_items = get_post_meta( $post->ID, '_dt_project_media_items', true );
$media_type = get_post_meta( $post->ID, '_dt_project_media_options_type', true );

if ( !$media_items ) {
	$media_items = array();
}

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
		case 'list' : $media_html = presscore_get_images_list( $attachments_data ); break;
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

$media_html_with_wrap = '';

if ( $media_html && in_array( $media_type, array( 'list', 'gallery' ) ) ) {
	$media_html = sprintf( '<div class="images-container">%s</div>', $media_html );
}

// wrap media html
if ( !post_password_required() && $media_html ) {
	$media_html_with_wrap = '<div class="wf-container">';

	if ( 'after' == $media_layout ) $media_html_with_wrap .= '<div class="gap-10"></div>';

	$media_html_with_wrap .= '<div class="wf-cell wf-1">' . $media_html . '</div>';

	$media_html_with_wrap .= '</div>';
	
	$content_container_class = 'wf-1-3';

	// layout
	switch ( $media_layout ) {
		case 'before':
			$before_content = $media_html_with_wrap . $before_content;
			break;
		case 'after':
			$after_content .= $media_html_with_wrap;
			break;
	}
}

// project link
$project_link = presscore_get_project_link('dt-btn dt-btn-m btn-project-link');

echo $before_content;
the_content();
echo $link_pages . $project_link;
echo $after_content;

if ( $post_meta || $share_buttons ) {
	printf( '<div class="wf-table wf-mobile-collapsed">%s</div>', $post_meta . $share_buttons );
}
