<?php
/**
 * Portfolio shortcode.
 *
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Shortcode testimonials class.
 *
 */
class DT_Shortcode_Portfolio extends DT_Shortcode {

    static protected $instance;

    protected $shortcode_name = 'dt_portfolio';
    protected $post_type = 'dt_portfolio';
    protected $taxonomy = 'dt_portfolio_category';
    protected $plugin_name = 'dt_mce_plugin_shortcode_portfolio';
    protected $atts;

    public static function get_instance() {
        if ( !self::$instance ) {
            self::$instance = new DT_Shortcode_Portfolio();
        }
        return self::$instance;
    }

    protected function __construct() {

        add_shortcode( $this->shortcode_name, array($this, 'shortcode') );

        // add shortcode button
        $tinymce_button = new DT_ADD_MCE_BUTTON( $this->plugin_name, basename(dirname(__FILE__)), false, 4 );
    }

    public function shortcode( $atts, $content = null ) {
       $attributes = shortcode_atts( array(
            'type'                  => 'masonry',
            
            'category'              => '',
            'order'                 => '',
            'orderby'               => '',
            'number'                => '6',
            'show_title'            => '1',
            'show_excerpt'          => '1',
            'show_details'          => '1',
            'show_link'             => '1',

            // slideshow
            'width'                 => '',
            'height'                => '',
            'show_text_hovers'      => '1',
            'show_text_hoovers'     => '',
            'arrows'                => '1',
            'margin_top'            => '',
            'margin_bottom'         => '',

            // masonry/grid
            'columns'               => '2',
            'descriptions'          => 'under_image',
            'proportion'            => '',
            'show_categories'       => '1',
            'same_width'            => '1'

        ), $atts );
        
        // sanitize attributes
        $attributes['type'] = in_array($attributes['type'], array('masonry', 'grid', 'slider') ) ? $attributes['type'] : 'masonry';
        $attributes['order'] = apply_filters('dt_sanitize_order', $attributes['order']);
        $attributes['orderby'] = apply_filters('dt_sanitize_orderby', $attributes['orderby']);
        $attributes['number'] = apply_filters('dt_sanitize_posts_per_page', $attributes['number']);

        if ( $attributes['category']) {
            $attributes['category'] = explode(',', $attributes['category']);
            $attributes['category'] = array_map('trim', $attributes['category']);
            $attributes['select'] = 'only';
        } else {
            $attributes['select'] = 'all';
        }

        $attributes['show_title'] = apply_filters('dt_sanitize_flag', $attributes['show_title']);
        $attributes['show_excerpt'] = apply_filters('dt_sanitize_flag', $attributes['show_excerpt']);
        $attributes['show_details'] = apply_filters('dt_sanitize_flag', $attributes['show_details']);
        $attributes['show_link'] = apply_filters('dt_sanitize_flag', $attributes['show_link']);

        // slideshow attributes
        // for backword compatibility
        if ( '' != $attributes['show_text_hoovers'] ) { $attributes['show_text_hovers'] = $attributes['show_text_hoovers']; }
        $attributes['show_text_hovers'] = apply_filters('dt_sanitize_flag', $attributes['show_text_hovers']);
        $attributes['arrows'] = apply_filters('dt_sanitize_flag', $attributes['arrows']);
        $attributes['slider_title'] = wp_kses($content, array());
        $attributes['width'] = absint($attributes['width']);
        $attributes['height'] = absint($attributes['height']);
        $attributes['margin_top'] = $attributes['margin_top'] ? intval($attributes['margin_top']) . 'px' : '';
        $attributes['margin_bottom'] = $attributes['margin_bottom'] ? intval($attributes['margin_bottom']) . 'px' : '';

        // masonry/grid
        $attributes['columns'] = in_array($attributes['columns'], array('2', '3', '4')) ? absint($attributes['columns']) : 2;
        $attributes['descriptions'] = in_array($attributes['descriptions'], array('off', 'under_image', 'on_hover')) ? $attributes['descriptions'] : 'under_image';
        $attributes['show_categories'] = apply_filters('dt_sanitize_flag', $attributes['show_categories']);
        $attributes['same_width'] = apply_filters('dt_sanitize_flag', $attributes['same_width']);

        if ( $attributes['proportion'] ) {
            $wh = array_map( 'absint', explode(':', $attributes['proportion']) );
            if ( 2 == count($wh) && !empty($wh[0]) && !empty($wh[1]) ) {
                $attributes['proportion'] = $wh[0]/$wh[1];
            } else {
                $attributes['proportion'] = '';
            }
        }

        // save atts for folter
        $this->atts = $attributes;

        $output = '';
        switch ( $attributes['type'] ) {
            case 'slider' : $output .= $this->portfolio_slider($attributes); break;
            default : $output .= $this->portfolio_masonry($attributes);
        }

        return $output; 
    }

    /**
     * Portfolio masonry.
     *
     */
    public function portfolio_masonry( $attributes = array() ) {
        global $post;

        $post_backup = $post;

        $dt_query = $this->get_posts_by_terms( $attributes );

        $output = '';

        if ( $dt_query->have_posts() ) {

            $config = Presscore_Config::get_instance();

            // backup and reset config
            $config_backup = array(
                'columns'               => $config->get('columns'),
                'template'              => $config->get('template'),
                'layout'                => $config->get('layout'),
                'description'           => $config->get('description'),
                'show_links'            => $config->get('show_links'),
                'show_titles'           => $config->get('show_titles'),
                'show_details'          => $config->get('show_details'),
                'show_excerpts'         => $config->get('show_excerpts'),
                'all_the_same_width'    => $config->get('all_the_same_width'),
                'show_terms'            => $config->get('show_terms')
            );

            $config->set('layout', $attributes['type']);
            $config->set('template', 'portfolio');
            $config->set('columns', $attributes['columns']);
            $config->set('show_terms', $attributes['show_categories']);
            $config->set('all_the_same_width', $attributes['same_width']);

            if ( 'off' != $attributes['descriptions'] ) {
                $config->set('description', 'on_hover' == $attributes['descriptions'] ? 'on_hoover' : 'under_image');
                $config->set('show_links', $attributes['show_link']);
                $config->set('show_titles', $attributes['show_title']);
                $config->set('show_details', $attributes['show_details']);
                $config->set('show_excerpts', $attributes['show_excerpt']);
            } else {
                $config->set('description', 'under_image');
                $config->set('show_links', false);
                $config->set('show_titles', false);
                $config->set('show_details', false);
                $config->set('show_excerpts', false);
            }

            if ( !$config->get('show_details') ) {
                add_filter('presscore_post_details_link', 'presscore_return_empty_string');
            }

            if ( '0' === $config->get('show_terms') ) {
                remove_filter('presscore_posted_on', 'presscore_get_post_categories', 14);
            }

            // add masonry wrap
            add_action('presscore_before_post', 'presscore_before_post_masonry', 15);
            add_action('presscore_after_post', 'presscore_after_post_masonry', 15);
            
            // remove proportions filter
            remove_filter( 'dt_portfolio_thumbnail_args', 'presscore_add_thumbnail_class_for_masonry', 15 );
            
            // add image height filter
            add_filter( 'dt_portfolio_thumbnail_args', array($this, 'portfolio_image_filter'), 15 );

            while ( $dt_query->have_posts() ) { $dt_query->the_post();
                ob_start();
                dt_get_template_part('portfolio-masonry-content');
                $output .= ob_get_contents();
                ob_end_clean();
            }

            // remove image height filter
            remove_filter( 'dt_portfolio_thumbnail_args', array($this, 'portfolio_image_filter'), 15 );

            // add proportions filter
            add_filter( 'dt_portfolio_thumbnail_args', 'presscore_add_thumbnail_class_for_masonry', 15 );

            // remove masonry wrap
            remove_action('presscore_before_post', 'presscore_before_post_masonry', 15);
            remove_action('presscore_after_post', 'presscore_after_post_masonry', 15);

            // remove details filter
            remove_filter('presscore_post_details_link', 'presscore_return_empty_string');

            // restore original $post
            $post = $post_backup;
            setup_postdata( $post );

            // restore config
            foreach ( $config_backup as $key=>$value ) {
                $config->set($key, $value);
            }

            if ( $config->get('show_terms') ) {
                add_filter('presscore_posted_on', 'presscore_get_post_categories', 14);
            }

            // masonry layout classes
            $masonry_container_classes = array( 'wf-container' );
            switch ( $attributes['type'] ) {
                case 'grid':
                    $masonry_container_classes[] = 'portfolio-grid';
                    if ( 'on_hover' == $attributes['descriptions'] ) {
                        $masonry_container_classes[] = 'grid-text-hovers';
                    }
                    break;
                case 'masonry':
                    $masonry_container_classes[] = 'iso-container';
                    $masonry_container_classes[] = 'layout-masonry';
                    if ( 'on_hover' == $attributes['descriptions'] ) {
                        $masonry_container_classes[] = 'layout-masonry-grid';
                    }
            }               
            $masonry_container_classes = implode(' ', $masonry_container_classes);

            // wrap output
            $output = sprintf( '<div class="%s">%s</div>',
                esc_attr($masonry_container_classes),
                $output
            );
        } // if have posts

        return $output;
    }

    /**
     * Portfolio slider.
     *
     */
    public function portfolio_slider( $attributes = array() ) {
        $config = Presscore_Config::get_instance();

        $related_posts_args = array(
            'exclude_current'   => false,
            'post_type'         => 'dt_portfolio',
            'taxonomy'          => 'dt_portfolio_category',
            'field'             => 'slug',
            'args'              => array(
                'posts_per_page'    => $attributes['number'],
                'orderby'           => $attributes['orderby'],
                'order'             => $attributes['order'],
            )
        );

        if ( !empty($attributes['category']) ) {
            $related_posts_args['cats'] = $attributes['category'];
            $related_posts_args['select'] = 'only';
        } else {
            $related_posts_args['select'] = 'all';
        }

        $attachments_data = presscore_get_related_posts( $related_posts_args );

        $slider_class = array();
        if ( 'disabled' == $config->get('sidebar_position') ) {
            $slider_class[] = 'full';
        }

        $slider_fields = array();

        if ( $attributes['show_text_hovers'] ) {
            if ( $attributes['arrows'] ) {
                $slider_fields[] = 'arrows';
            }

            if ( $attributes['show_title'] ) {
                $slider_fields[] = 'title';
            }

            if ( $attributes['show_excerpt'] ) {
                $slider_fields[] = 'description';
            }

            if ( $attributes['show_link'] ) {
                $slider_fields[] = 'link';
            }

            if ( $attributes['show_details'] ) {
                $slider_fields[] = 'details';
            }
        }

        $slider_style = array();
        if ( $attributes['margin_bottom'] ) {
            $slider_style[] = 'margin-bottom: ' . $attributes['margin_bottom'];
        }

        if ( $attributes['margin_top'] ) {
            $slider_style[] = 'margin-top: ' . $attributes['margin_top'];
        }

        $slider_args = array(
            'fields'        => $slider_fields,
            'class'         => $slider_class,
            'style'         => implode(';', $slider_style)
        );

        if ( $attributes['slider_title'] ) {
            $slider_args['title'] = $attributes['slider_title'];
        }
        
        if ( $attributes['height'] ) {
            $slider_args['height'] = $attributes['height'];
        }

        if ( $attributes['width'] ) {
            $slider_args['img_width'] = $attributes['width'];
        }

        $output = presscore_get_fullwidth_slider_two( $attachments_data, $slider_args );

        return $output;
    }

    public function portfolio_image_filter( $args = array() ) {
        $atts = $this->atts;

        if ( $atts['proportion'] ) {
            $args['prop'] = $atts['proportion'];
        }
        return $args;
    }

}

// create shortcode
DT_Shortcode_Portfolio::get_instance();
