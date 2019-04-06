<?php
/**
 * Media Albums template. Uses dt_gallery post type and dt_gallery_category taxonomy.
 *
 * @package presscore
 * @since presscore 0.1
 */

/* Template Name: Media Albums */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

global $post;
$config = Presscore_Config::get_instance();
$config->set('template', 'albums');
$config->base_init();

add_action('presscore_before_main_container', 'presscore_page_content_controller', 15);

get_header(); ?>
			
		<?php if ( presscore_is_content_visible() ): ?>

			<!-- Content -->
			<div id="content" class="content" role="main">

				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); // main loop ?>

					<?php do_action( 'presscore_before_loop' ); ?>

					<?php
					$display = $config->get('display');
					$layout = $config->get('layout');

					$page_query = Presscore_Inc_Albums_Post_Type::get_albums_template_query();
					?>

					<?php
					// categorizer
					$filter_args = array();

					if ( !$config->get('show_ordering') ) {
						remove_filter( 'presscore_get_category_list', 'presscore_add_sorting_for_category_list', 15 );
					}
					
					if ( $config->get('show_filter') ) {
						
						$posts_ids = $terms_ids = array();
						$select = $display['select'];

						if ( 'masonry' == $layout ) {

							if ( $page_query->have_posts() ) {
								
								foreach ( $page_query->posts as $p ) {
									$p_ids[] = $p->ID;
								}

								// get posts terms
								$terms_ids = wp_get_object_terms( $p_ids, 'dt_gallery_category', array('fields' => 'ids') );
								$terms_ids = array_unique( $terms_ids );
								
							}
							
							$select = 'only';

						} elseif ( 'category' == $display['type'] ) {

							$terms_ids = empty($display['terms_ids']) ? array() : $display['terms_ids'];

						} elseif ( 'albums' == $display['type'] ) {

							$posts_ids = $display['posts_ids'];

						} 

						// categorizer args
						$filter_args = array(
							'taxonomy'	=> 'dt_gallery_category',
							'post_type'	=> 'dt_gallery',
							'select'	=> $select,
							'terms'		=> $terms_ids,
							'post_ids'	=> $posts_ids,
						);
					}

					// display categorizer
					presscore_get_category_list( array(
						// function located in /in/extensions/core-functions.php
						'data'	=> dt_prepare_categorizer_data( $filter_args ),
						'class'	=> 'filter' . ('grid' == $layout ? ' without-isotope' : ''),
					) );
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

					<?php
					if ( $page_query->have_posts() ):

						add_filter( 'presscore_get_images_gallery_hoovered-title_img_args', 'presscore_gallery_post_exclude_featured_image_from_gallery', 15, 3 );

						while( $page_query->have_posts() ): $page_query->the_post(); ?>

						<?php get_template_part('content', 'gallery'); ?>

					<?php
						endwhile;
						wp_reset_postdata();

						remove_filter( 'presscore_get_images_gallery_hoovered-title_img_args', 'presscore_gallery_post_exclude_featured_image_from_gallery', 15, 3 );

					endif; ?>

					</div>

					<?php dt_paginator($page_query); ?>

					<?php do_action( 'presscore_after_loop' ); ?>

					<?php endwhile; ?>

				<?php endif; ?>

			</div><!-- #content -->

			<?php do_action('presscore_after_content'); ?>

		<?php endif; // if content visible ?>

<?php get_footer(); ?>