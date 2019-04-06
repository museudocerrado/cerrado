<?php
/* Template Name: Blog - masonry */

/**
 * Blog masonry layout.
 *
 * @package presscore
 * @since presscore 0.1
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

global $post;
$config = Presscore_Config::get_instance();
$config->set('template', 'blog');
$config->base_init();

add_action('presscore_before_main_container', 'presscore_page_content_controller', 15);
add_filter('excerpt_more', 'presscore_excerpt_more_to_details', 11);

get_header(); ?>

		<?php if ( presscore_is_content_visible() ): ?>

			<!-- Content -->
			<div id="content" class="content" role="main">

				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); // main loop ?>

					<?php do_action( 'presscore_before_loop' ); ?>

					<?php
					// masonry layout
					$masonry_container_classes = array( 'wf-container' );

					$masonry_layout = get_post_meta(get_the_ID(), '_dt_blog_options_layout', true);
					if ( 'grid' == $masonry_layout ) {
						$masonry_container_classes[] = 'iso-grid';
					} else {
						$masonry_container_classes[] = 'iso-container';
					}
					$masonry_container_classes = implode(' ', $masonry_container_classes);
					?>

					<div class="<?php echo esc_attr($masonry_container_classes); ?>">

					<?php
					$ppp = $config->get('posts_per_page');
					$order = $config->get('order');
					$orderby = $config->get('orderby');
					$display = $config->get('display');

					$blog_args = array(
						'post_type'	=> 'post',
						'status'	=> 'publish' ,
						'paged'		=> dt_get_paged_var(),
						'order'		=> $order,
						'orderby'	=> 'name' == $orderby ? 'title' : $orderby,
					);

					if ( $ppp ) {
						$blog_args['posts_per_page'] = intval($ppp);
					}

					if ( !empty($display['terms_ids']) ) {
						$terms_ids = array_values($display['terms_ids']);

						switch( $display['select'] ) {
							case 'only':
								$blog_args['category__in'] = $terms_ids;
								break;

							case 'except':
								$blog_args['category__not_in'] = $terms_ids;
						}

					}

					$blog_query = new WP_Query($blog_args);

					if ( $blog_query->have_posts() ): while( $blog_query->have_posts() ): $blog_query->the_post();
					?>

						<?php
							/* Include the Post-Format-specific template for the content.
							 * If you want to overload this in a child theme then include a file
							 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
							 */
							$post_format = get_post_format();
							if ( $post_format ) $post_format = 'format-' . $post_format;

							if ( 'grid' == $masonry_layout ) {
								dt_get_template_part( 'content-grid', $post_format );
							} else {
								get_template_part( 'content', $post_format );
							}
						?>

					<?php endwhile; wp_reset_postdata(); endif; ?>

					</div>

					<?php dt_paginator($blog_query); ?>

					<?php do_action( 'presscore_after_loop' ); ?>

					<?php endwhile; ?>

				<?php endif; ?>

			</div><!-- #content -->

			<?php do_action('presscore_after_content'); ?>

		<?php endif; // if content visible ?>

<?php get_footer(); ?>