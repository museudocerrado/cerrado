<?php
/**
 * Media Gallery template. Uses dt_gallery post type and dt_gallery_category taxonomy.
 *
 * @package presscore
 * @since presscore 0.1
 */

/* Template Name: Media Gallery (Photo & Video) */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

global $post;
$config = Presscore_Config::get_instance();
$config->set('template', 'media');
$config->base_init();

add_action('presscore_before_main_container', 'presscore_page_content_controller', 15);

get_header(); ?>
			
		<?php if ( presscore_is_content_visible() ): ?>

			<!-- Content -->
			<div id="content" class="content" role="main">

				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); // main loop ?>

					<?php do_action( 'presscore_before_loop' ); ?>

					<?php
					$layout = $config->get('layout');

					$media_query = Presscore_Inc_Albums_Post_Type::get_media_template_query();
					?>

					<?php
					// masonry layout classes
					$masonry_container_classes = array( 'wf-container' );
					
					switch ( $layout ) {
						case 'grid': $masonry_container_classes[] = 'portfolio-grid'; break;
						case 'masonry':
							$masonry_container_classes[] = 'iso-container';
							if ( 'on_hoover' == $config->get('description') ) $masonry_container_classes[] = 'portfolio-grid';
					}				

					$masonry_container_classes = implode(' ', $masonry_container_classes);
					?>

					<div class="<?php echo esc_attr($masonry_container_classes); ?>">

					<?php if ( $media_query->have_posts() ): while( $media_query->have_posts() ): $media_query->the_post(); ?>

						<?php get_template_part('content', 'media'); ?>

					<?php endwhile; wp_reset_postdata(); endif; ?>

					</div>

					<?php dt_paginator($media_query); ?>

					<?php do_action( 'presscore_after_loop' ); ?>

					<?php endwhile; ?>

				<?php endif; ?>

			</div><!-- #content -->

			<?php do_action('presscore_after_content'); ?>

		<?php endif; // if content visible ?>

<?php get_footer(); ?>