<?php
/**
 * Media gallery content. 
 *
 * @package presscore
 * @since presscore 0.1
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

global $post;
$config = Presscore_Config::get_instance();
$desc_on_hoover = ( 'on_hoover' == $config->get('description') );
$show_excerpts = $config->get('show_excerpts') && get_the_content();
$show_titles = $config->get('show_titles');

$show_content = $show_excerpts || $show_titles;

$previw_type = get_post_meta( $post->ID, '_dt_project_options_preview_style', true );
$before_content = '';
$after_content = '';
$before_description = '';
$after_description = '';

$link_classes = 'alignnone';
if ( $show_content && $desc_on_hoover ) {
	$before_content = '<div class="rollover-project">';
	$after_content = '</div>';

	$before_description = '<div class="rollover-content">';
	$after_description = '<span class="close-link"></span>' . "\n" . '</div>';

	$link_classes = 'link show-content';
} elseif ( $desc_on_hoover ) {
	$link_classes = 'rollover rollover-zoom';
}
$blank_img = presscore_get_blank_image();
?>

<?php do_action('presscore_before_post'); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
		
		<?php echo $before_content; ?>

		<?php
		$is_pass_protected = post_password_required();
		if ( !$is_pass_protected || $desc_on_hoover ) {
			$title = get_the_title();
			$content = get_the_content();

			$share_buttons = presscore_get_share_buttons_for_prettyphoto( 'photo', array( 'id' => $post->ID ) );

			$thumb_args = array(
				'img_meta' 	=> wp_get_attachment_image_src( $post->ID, 'full' ),
				'img_id'	=> $post->ID,
				'img_class' => 'preload-me',
				'custom'	=> 'data-pp="prettyPhoto" ' . $share_buttons,
				'class'		=> $link_classes,
				'echo'		=> false,
				'wrap'		=> '<a %HREF% %CLASS% %TITLE% %CUSTOM%><img %IMG_CLASS% %SRC% %ALT% %IMG_TITLE% %SIZE% /></a>',
			);

			// proportion
			$prop = $config->get('thumb_proportions');
			if ( 'resize' == $config->get('image_layout') && $prop ) {
				$thumb_args['prop'] = presscore_meta_boxes_get_images_proportions( $prop );
			}

			$video_url = esc_url( get_post_meta( $post->ID, 'dt-video-url', true ) );

			if ( $video_url ) {
				$thumb_args['href'] = presscore_prepare_video_url( $video_url );

				if ( !$desc_on_hoover ) {
					$thumb_args['class'] .= ' rollover-video';
					$thumb_args['wrap'] = '<div %CLASS% %CUSTOM%><img %IMG_CLASS% %SRC% %ALT% %IMG_TITLE% %SIZE% /><a %HREF% %TITLE% class="video-icon" data-pp="prettyPhoto" ' . $share_buttons . '><img src="' . $blank_img . '" %ALT% style="display: none;" /></a></div>';
				}
			} else {
				if ( !$desc_on_hoover ) {
					$thumb_args['class'] .= ' rollover rollover-zoom';
					$thumb_args['wrap'] = '<p>' . $thumb_args['wrap'] . '</p>';
				}
			}

			$media = dt_get_thumb_img( $thumb_args );
			echo $media;
		}
		?>

		<?php echo $before_description; ?>

		<?php if ( $show_titles ) : ?>
			<h2 class="entry-title"><?php the_title(); ?></h2>
		<?php endif; ?>

		<?php if ( $show_excerpts ) : ?>
			<?php echo wpautop(get_the_content()); ?>
		<?php endif; ?>

		<?php echo $after_description; ?>

	<?php echo $after_content; ?>

</article><!-- #post-<?php the_ID(); ?> -->

<?php do_action('presscore_after_post'); ?>