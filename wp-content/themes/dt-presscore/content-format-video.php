<?php
/**
 * Video post format content. 
 *
 * @package presscore
 * @since presscore 0.1
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

$config = Presscore_Config::get_instance();
?>

<?php do_action('presscore_before_post'); ?>

<article <?php post_class(); ?>>

	<h2 class="entry-title">
		<a href="<?php the_permalink(); ?>" title="<?php echo the_title_attribute( 'echo=0' ); ?>" rel="bookmark"><?php the_title(); ?></a>
	</h2>

	<?php presscore_posted_on(); ?>

	<?php
	if ( !post_password_required() && has_post_thumbnail() ) {

		// thumbnail meta
		$thumb_id = get_post_thumbnail_id();
		$thumb_meta = wp_get_attachment_image_src( $thumb_id, 'full' );

		$preview_mode = 'normal';
		if ( !( is_search() || is_archive() ) ) {
			$saved_mode = get_post_meta( $post->ID, '_dt_post_options_preview', true );
			if ( $saved_mode ) {
				$preview_mode = $saved_mode;
			}
		}
		$post_preview_style = get_post_meta( $post->ID, '_dt_post_options_preview_style_video', true );
		$layout = $config->get('layout');

		$align = 'alignnone';
		$custom = '';
		$thumb_options = array();
		if ( 'list' == $layout && 'normal' == $preview_mode ) {
			$align = 'alignleft';
			$custom = 'style="width: 270px;"';
			$thumb_options = array( 'w' => 270, 'z' => 1 );
		}

		$thumb_args = array(
			'img_meta' 		=> $thumb_meta,
			'img_id'		=> $thumb_id,
			'class'			=> $align . ' rollover',
			'custom'		=> $custom,
			'options'		=> $thumb_options,
			'echo'			=> false,
			'wrap'			=> '<a %HREF% %CLASS% %CUSTOM%><img %IMG_CLASS% %SRC% %ALT% %IMG_TITLE% %SIZE% /></a>',
		);
		$thumb_args = apply_filters( 'dt_post_thumbnail_args', $thumb_args );

		$video_url = esc_url( get_post_meta( $thumb_id, 'dt-video-url', true ) );
		$media = '';

		if ( $video_url && 'image_play' == $post_preview_style ) {
			// $id_mark = 'post-' . $post->ID . '-video-container';
			// $thumb_args['href'] = '#' . $id_mark;
			$blank_image = presscore_get_blank_image();
			$thumb_args['href'] = presscore_prepare_video_url( $video_url );
			$thumb_args['class'] = $align . ' rollover-video';
			$thumb_args['wrap'] = '<div %CLASS% %CUSTOM%><img %IMG_CLASS% %SRC% %ALT% %IMG_TITLE% %SIZE% /><a %HREF% %TITLE% class="video-icon" data-pp="prettyPhoto"><img src="' . $blank_image . '" %ALT% style="display: none;" /></a></div>';
			$media = dt_get_thumb_img( $thumb_args );
		} else {
			$thumb_args['href'] = get_permalink();
			$media = dt_get_thumb_img( $thumb_args );
			
			if ( 'list' != $layout ) $media = '<p>' . $media . '</p>';
		}
		
		echo $media;
	}
	?>

	<?php presccore_the_excerpt(); ?>

	<?php presscore_post_buttons_depending_on_excerpt(); ?>

</article><!-- #post-<?php the_ID(); ?> -->

<?php do_action('presscore_after_post'); ?>