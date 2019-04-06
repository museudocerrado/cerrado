<?php
/**
 * Blog post content. 
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
	if ( !post_password_required() && has_post_thumbnail() ) {

		// thumbnail meta
		$thumb_id = get_post_thumbnail_id();
		$thumb_meta = wp_get_attachment_image_src( $thumb_id, 'full' );
		$layout = $config->get('layout');

		$preview_mode = 'normal';
		if ( !( is_search() || is_archive() ) ) {
			$saved_mode = get_post_meta( $post->ID, '_dt_post_options_preview', true );
			if ( $saved_mode ) {
				$preview_mode = $saved_mode;
			}
		}
		
		$align = 'alignnone';
		$custom = '';
		$thumb_options = array();
		if ( 'list' == $layout && 'normal' == $preview_mode ) {
			$align = 'alignleft';
			$custom = 'style="width: 270px;"';
			$thumb_options = array( 'w' => 270, 'z' => 1 );
		}

		$thumb_args = array(
			'img_meta' 	=> $thumb_meta,
			'img_id'	=> $thumb_id,
			'class'		=> $align . ' rollover',
			'custom'	=> $custom,
			'href'		=> get_permalink(),
			'options'	=> $thumb_options,
			'echo'		=> false,
			'wrap'		=> '<a %HREF% %CLASS% %CUSTOM%><img %IMG_CLASS% %SRC% %ALT% %IMG_TITLE% %SIZE% /></a>',
		);

		$thumb_args = apply_filters( 'dt_post_thumbnail_args', $thumb_args );

		$media = dt_get_thumb_img( $thumb_args );
		if ( 'list' != $layout ) {
			$media = '<p>' . $media . '</p>';
		}
		
		echo $media;
	}
	?>
	
	<?php presccore_the_excerpt(); ?>

	<?php presscore_post_buttons_depending_on_excerpt(); ?>

</article><!-- #post-<?php the_ID(); ?> -->

<?php do_action('presscore_after_post'); ?>