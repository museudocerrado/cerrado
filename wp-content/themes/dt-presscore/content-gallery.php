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
$desc_on_hoover = ( 'on_hoover' == $config->get('description') );
$show_title = $config->get('show_titles') && get_the_title();
$show_details = $config->get('show_details');
$show_excerpts = $config->get('show_excerpts') && get_the_excerpt();
$show_terms = !$desc_on_hoover && $config->get('show_terms');
$show_content = $show_title || $show_details || $show_excerpts || $show_terms;
$preview_mode = get_post_meta( $post->ID, '_dt_album_options_preview', true );
$media_items = get_post_meta( $post->ID, '_dt_album_media_items', true );
$exclude_cover = get_post_meta( $post->ID, '_dt_album_options_exclude_featured_image', true );

if ( !$media_items ) {
	$media_items = array();
}

// if we have post thumbnail and it's not hidden
if ( has_post_thumbnail() ) {
	array_unshift( $media_items, get_post_thumbnail_id() );
}

$attachments_data = presscore_get_attachment_post_data( $media_items );

$class = array('rollover');
if ( !$desc_on_hoover ) {
	$class[] = 'alignnone';
}
$style = ' style="width: 100%;"';

// if there are one image in gallery
if ( count($attachments_data) == 1 ) {
	$class[] = 'rollover-zoom';
}

$rell = 'data-pp="prettyPhoto[album-' . $post->ID . ']"';
$before_content = '';
$after_content = '';
$before_description = '';
$after_description = '';
$media = '';

if ( $show_content && $desc_on_hoover ) {
	$before_content = '<div class="rollover-project">';
	$after_content = '</div>';

	$before_description = '<div class="rollover-content">';
	$after_description = '<span class="close-link"></span>' . "\n" . '</div>';

	if ( $attachments_data ) {
		$title_image = array_shift($attachments_data);
		$share_buttons = presscore_get_share_buttons_for_prettyphoto( 'photo', array( 'id' => $title_image['ID'] ) );
		$title_args = array(
			'img_meta' 	=> array( $title_image['full'], $title_image['width'], $title_image['height'] ),
			'img_id'	=> $title_image['ID'],
			'class'		=> 'link show-content',
			'custom'	=> $rell . ' ' . $share_buttons . ' ' . $style,
			'echo'		=> false,
			'wrap'		=> '<a %HREF% %CLASS% %CUSTOM% %TITLE%><img %IMG_CLASS% %SRC% %IMG_TITLE% %ALT% %SIZE% /></a>',
		);

		// proportion
		$prop = $config->get('thumb_proportions');
		if ( 'resize' == $config->get('image_layout') && $prop ) {
			$title_args['prop'] = presscore_meta_boxes_get_images_proportions( $prop );
		}

		$media = dt_get_thumb_img( $title_args );

		if ( has_post_thumbnail() && $exclude_cover ) {
			unset( $attachments_data[0] );
		}

		$hidden_gallery = '';
		foreach ( $attachments_data as $att ) {

			$share_buttons = presscore_get_share_buttons_for_prettyphoto( 'photo', array( 'id' => $att['ID'] ) );
			$att_args = array(
				'img_meta'	=> $att['thumbnail'],
				'img_id'	=> $att['ID'],
				'href'		=> $att['full'],
				'custom'	=> $rell . ' ' . $share_buttons,
			);

			$hidden_gallery .= dt_get_thumb_img( array_merge( $title_args, $att_args ) );
		}

		if ( $hidden_gallery ) $hidden_gallery = '<div class="dt-prettyphoto-gallery-container" style="display: none;">' . $hidden_gallery . '</div>';
		$media .= $hidden_gallery;
	}

} else {
	$media =  presscore_get_images_gallery_hoovered(
		$attachments_data,
		array(
			'class' => $class,
			'links_rel' => $rell,
			'style' => $style,
			'share_buttons' => true,
			'exclude_cover' => $exclude_cover
		)
	);
}
?>

<?php do_action('presscore_before_post'); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
		
		<?php echo $before_content; ?>

		<?php
		// $is_pass_protected = post_password_required();
		echo $media;
		?>

		<?php echo $before_description; ?>

		<?php if ( $show_title ) : ?>

			<h2 class="entry-title"><?php the_title(); ?></h2>

		<?php endif; ?>

		<?php if ( $show_terms ) :
			echo presscore_get_post_meta_wrap( presscore_get_post_categories() );
		endif; ?>

		<?php if ( $show_excerpts ) : ?>

			<?php the_excerpt(); ?>

		<?php endif; ?>

		<?php echo presscore_post_edit_link(); ?>

		<?php echo $after_description; ?>

	<?php echo $after_content; ?>

</article><!-- #post-<?php the_ID(); ?> -->

<?php do_action('presscore_after_post'); ?>