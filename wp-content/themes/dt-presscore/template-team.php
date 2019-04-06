<?php
/**
 * Team.
 *
 * @package presscore
 * @since presscore 0.1
 */

/* Template Name: Team */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

global $post;
$config = Presscore_Config::get_instance();
$config->set('template', 'team');
$config->base_init();

// add content area
add_action('presscore_before_main_container', 'presscore_page_content_controller', 15);

get_header(); ?>

		<?php if ( presscore_is_content_visible() ): ?>

			<!-- Content -->
			<div id="content" class="content" role="main">

				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); // main loop ?>

					<?php
					do_action( 'presscore_before_loop' );

					$layout = $config->get('layout');
					$page_query = Presscore_Inc_Team_Post_Type::get_template_query();
					?>

					<div class="wf-container <?php echo ('masonry' == $layout) ? 'iso-container' : 'grid-masonry'; ?>">

					<?php if ( $page_query->have_posts() ): while( $page_query->have_posts() ): $page_query->the_post();	?>


						<?php
							/* Include the Post-Format-specific template for the content.
							 * If you want to overload this in a child theme then include a file
							 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
							 */
							get_template_part( 'content', 'team' );
						?>


					<?php endwhile; wp_reset_postdata(); endif; ?>

					</div>

					<?php dt_paginator($page_query); ?>

					<?php do_action( 'presscore_after_loop' ); ?>

					<?php endwhile; // main loop ?>

				<?php endif; ?>

			</div><!-- #content -->

			<?php do_action('presscore_after_content'); ?>

		<?php endif; // if content visible ?>

<?php get_footer(); ?>