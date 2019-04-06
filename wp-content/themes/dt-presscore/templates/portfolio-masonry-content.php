<?php
/**
 * Portfolio masonry content. 
 *
 * @package presscore
 * @since presscore 0.1
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

global $post;
$config = Presscore_Config::get_instance();
$desc_on_hover = ( 'on_hoover' == $config->get('description') );

$project_link = presscore_get_project_link();
$details_button = presscore_post_details_link();

$show_links = $config->get('show_links') && $project_link;
$show_title = $config->get('show_titles') && get_the_title();
$show_details = $config->get('show_details');
$show_excerpts = $config->get('show_excerpts') && get_the_excerpt();
$show_terms = !$desc_on_hover && $config->get('show_terms');

$show_content = $show_links || $show_title || $show_details || $show_excerpts || $show_terms;
$show_video_hoover = !$desc_on_hover || ( !$show_content && $desc_on_hover );
$show_post_buttons = ( $project_link && $show_links ) || $details_button;

$previw_type = get_post_meta( $post->ID, '_dt_project_options_preview_style', true );

$before_content = '';
$after_content = '';
$before_description = '';
$after_description = '';

$link_classes = 'alignnone rollover';
if ( $show_content && $desc_on_hover ) {
	$before_content = '<div class="rollover-project">';
	$after_content = '</div>';

	$before_description = '<div class="rollover-content">';
	$after_description = '<span class="close-link"></span>' . "\n" . '</div>';

	$link_classes = 'link show-content';
}

?>

<?php do_action('presscore_before_post'); ?>

<article <?php post_class('post'); ?>>
		
		<?php echo $before_content; ?>

		<?php
		$is_pass_protected = post_password_required();
		if ( !$is_pass_protected || $desc_on_hover ) {
			if ( 'slideshow' != $previw_type || $desc_on_hover ) {

				if ( has_post_thumbnail() ) {
					$thumb_id = get_post_thumbnail_id();
					$thumb_meta = wp_get_attachment_image_src( $thumb_id, 'full' );
				} else {
					$thumb_id = 0;
					$thumb_meta = presscore_get_default_image();
				}

				$video_url = esc_url( get_post_meta( $thumb_id, 'dt-video-url', true ) );

				$thumb_args = array(
					'img_meta' 	=> $thumb_meta,
					'img_id'	=> $thumb_id,
					'img_class' => 'preload-me',
					'class'		=> $link_classes,
					'href'		=> get_permalink( $post->ID ),
					'echo'		=> false,
				);
				$thumb_args['wrap'] = '<a %HREF% %CLASS% %TITLE% %CUSTOM%><img %IMG_CLASS% %SRC% %ALT% %SIZE% /></a>';

				if ( $video_url && $show_video_hoover ) {
					$thumb_args['class'] = 'alignnone rollover-video';
					$thumb_args['wrap'] = '<div %CLASS% %CUSTOM%><img %IMG_CLASS% %SRC% %ALT% %IMG_TITLE% %SIZE% /><a %HREF% class="video-icon"></a></div>';
				}

				$thumb_args = apply_filters( 'dt_portfolio_thumbnail_args', $thumb_args );

				$media = dt_get_thumb_img( $thumb_args );
				if ( !$desc_on_hover && !$video_url ) { $media = '<p>' . $media . '</p>'; }
				
				echo $media;

			} else {

				$slider_classes = array('alignnone');
				if ( 'grid' == $config->get('layout') ) {
					$slider_classes[] = 'slider-simple';
				} else {
					$slider_classes[] = 'slider-masonry';
				}

				echo presscore_get_project_media_slider( $slider_classes );

			}
		}
		?>

		<?php echo $before_description; ?>

		<?php if ( $show_title ) : ?>

			<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo the_title_attribute( 'echo=0' ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

		<?php endif; ?>

		<?php if ( $show_terms ) { echo presscore_get_post_meta_wrap( presscore_get_post_categories() ); } ?>

		<?php if ( $show_excerpts ) : ?>

			<?php the_excerpt(); ?>

		<?php endif; ?>

		<?php
		if ( $show_post_buttons ) {
			if ( $desc_on_hover ) {

				echo presscore_post_details_link($post->ID, 'project-details');

				if ( $show_links ) {
					echo presscore_get_project_link('project-link');
				}

			} else {

				printf( '<p>%s</p>',
					$details_button . ( $show_links ? $project_link : '' )
				);

			}
		}
		echo presscore_post_edit_link();
		?>

		<?php echo $after_description; ?>

	<?php echo $after_content; ?>

</article><!-- #post-<?php the_ID(); ?> -->

<?php do_action('presscore_after_post'); ?>