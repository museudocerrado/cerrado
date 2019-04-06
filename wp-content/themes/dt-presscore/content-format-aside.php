<?php
/**
 * Blog post format quote content. 
 *
 * @package presscore
 * @since presscore 0.1
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }
?>

<?php do_action('presscore_before_post'); ?>

<article <?php post_class(); ?>>

	<div class="format-aside-content text-big">									
		<?php the_content(); ?>
	</div>

	<?php presscore_posted_on(); ?>

	<?php echo presscore_post_edit_link(); ?>

</article><!-- #post-<?php the_ID(); ?> -->

<?php do_action('presscore_after_post'); ?>