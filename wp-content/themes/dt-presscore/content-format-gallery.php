<?php
/**
 * Post content for gallery format. 
 *
 * @package presscore
 * @since presscore 0.1
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

global $post;

$config = Presscore_Config::get_instance();
?>

<?php do_action('presscore_before_post'); ?>

<article <?php post_class(); ?>>

	<h2 class="entry-title">
		<a href="<?php the_permalink(); ?>" title="<?php echo the_title_attribute( 'echo=0' ); ?>" rel="bookmark"><?php the_title(); ?></a>
	</h2>

	<?php presscore_posted_on(); ?>

	<?php
	$gallery = get_post_gallery( $post->ID, false );
	if ( !empty($gallery['ids']) ) {

		$media_items = array_map( 'trim', explode( ',', $gallery['ids'] ) );

		// if we have post thumbnail and it's not hidden
		if ( has_post_thumbnail() && !get_post_meta( $post->ID, '_dt_post_options_hide_thumbnail', true ) ) {
			array_unshift( $media_items, get_post_thumbnail_id() );
		}

		$attachments_data = presscore_get_attachment_post_data( $media_items );

		$preview_mode = 'normal';
		if ( !( is_search() || is_archive() ) ) {
			$saved_mode = get_post_meta( $post->ID, '_dt_post_options_preview', true );
			if ( $saved_mode ) {
				$preview_mode = $saved_mode;
			}
		}

		$preview_style = get_post_meta( $post->ID, '_dt_post_options_preview_style_gallery', true );

		$style = ' style="width: 100%;"';

		$class = array( 'alignnone' );
		if ( !in_array( $config->get('layout'), array('masonry', 'grid') ) && 'normal' == $preview_mode ) {
			$class = array( 'alignleft' );
			$style = ' style="width: 270px;"';
		}

		switch ( $preview_style ) {
			case 'slideshow':

				$class[] = 'slider-simple';
				if ( 'masonry' == $config->get('layout') ) {
					$class[] = 'slider-masonry';
				}

				echo presscore_get_post_media_slider( $attachments_data, array( 'class' => $class, 'style' => $style ) );

				break;
			case 'hovered_gallery' :

				$class[] = 'rollover';

				echo presscore_get_images_gallery_hoovered( $attachments_data, array('class' => $class, 'links_rel' => 'data-pp="prettyPhoto[post-format-gallery-' . $post->ID . ']"', 'style' => $style ) );

				break;
			default:

				if ( 'normal' == $preview_mode ) {
					$class[] = 'format-gallery-normal';
				}

				echo presscore_get_images_gallery_1( $attachments_data, array('class' => $class, 'links_rel' => 'data-pp="prettyPhoto[post-format-gallery-' . $post->ID . ']"', 'style' => $style ) );
		}
	}
	?>

	<?php presccore_the_excerpt(); ?>

	<?php presscore_post_buttons_depending_on_excerpt(); ?>

</article><!-- #post-<?php the_ID(); ?> -->

<?php do_action('presscore_after_post'); ?>