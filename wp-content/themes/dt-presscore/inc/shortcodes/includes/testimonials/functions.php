<?php
/**
 * Testimonials shortcode.
 *
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Shortcode testimonials class.
 *
 */
class DT_Shortcode_Testimonials extends DT_Shortcode {

    static protected $instance;

    protected $shortcode_name = 'dt_testimonials';
    protected $post_type = 'dt_testimonials';
    protected $taxonomy = 'dt_testimonials_category';
    protected $plugin_name = 'dt_mce_plugin_shortcode_testimonials';

    public static function get_instance() {
        if ( !self::$instance ) {
            self::$instance = new DT_Shortcode_Testimonials();
        }
        return self::$instance;
    }

    protected function __construct() {

        add_shortcode( $this->shortcode_name, array($this, 'shortcode') );

        // add shortcode button
        $tinymce_button = new DT_ADD_MCE_BUTTON( $this->plugin_name, basename(dirname(__FILE__)), false, 4 );
    }

    public function shortcode( $atts, $content = null ) {
       $instance = shortcode_atts( array(
            'type'          => 'masonry',
            'category'      => '',
            'order'         => '',
            'orderby'       => '',
            'number'        => '6',
            'columns'       => '2',
            'autoslide'     => '0'
        ), $atts );
        
        // sanitize attributes
        $instance['type'] = in_array($instance['type'], array('masonry', 'list', 'slider') ) ? $instance['type'] : 'masonry';
        $instance['order'] = apply_filters('dt_sanitize_order', $instance['order']);
        $instance['orderby'] = apply_filters('dt_sanitize_orderby', $instance['orderby']);
        $instance['number'] = apply_filters('dt_sanitize_posts_per_page', $instance['number']);
        $instance['columns'] = in_array($instance['columns'], array('2', '3', '4')) ? absint($instance['columns']) : 2;
        $instance['autoslide'] = absint($instance['autoslide']);

        if ( $instance['category']) {
            $instance['category'] = explode(',', $instance['category']);
            $instance['category'] = array_map('trim', $instance['category']);
            $instance['select'] = 'only';
        } else {
            $instance['select'] = 'all';
        }

        $output = '';
        switch ( $instance['type'] ) {
            case 'slider' : $output .= $this->testimonials_slider($instance); break;
            case 'list' : $output .= $this->testimonials_list($instance); break;
            default : $output .= $this->testimonials_masonry($instance);
        }

        return $output; 
    }

    /**
     * Testimonials list.
     *
     */
    public function testimonials_list( $instance = array() ) {
        $dt_query = $this->get_posts_by_terms( $instance );        

        $output = '';
        if ( $dt_query->have_posts() ) {

            foreach ( $dt_query->posts as $dt_post ) {

                $output .= '<div class="wf-cell wf-1"><div class="testimonial-item">' . Presscore_Inc_Testimonials_Post_Type::render_testimonial( $dt_post->ID ) . '</div></div>';

            }

            $output = '<div class="wf-container">' . $output . '</div>';
        } // if have posts

        return $output;
    }

    /**
     * Testimonials masonry.
     *
     */
    public function testimonials_masonry( $instance = array() ) {
        
        switch ( $instance['columns'] ) {
            case 3: $column_class = 'wf-1-3'; break;
            case 4: $column_class = 'wf-1-4'; break;
            default: $column_class = 'wf-1-2';
        }

        $dt_query = $this->get_posts_by_terms( $instance );

        $output = '';
        if ( $dt_query->have_posts() ) {

            foreach ( $dt_query->posts as $dt_post ) {

                $output .= sprintf(
                    '<div class="iso-item wf-cell %s"><div class="testimonial-item">%s</div></div>',
                    $column_class,
                    Presscore_Inc_Testimonials_Post_Type::render_testimonial( $dt_post->ID )
                );

            }

            $output = '<div class="iso-container wf-container">' . $output . '</div>';
        } // if have posts

        return $output;
    }

    /**
     * Testimonials slider.
     *
     */
    public function testimonials_slider( $instance = array() ) {
        $dt_query = $this->get_posts_by_terms( $instance );        

        $autoslide = absint($instance['autoslide']);

        $output = '';
        if ( $dt_query->have_posts() ) {

            $output .= '<ul class="testimonials slider-content rsCont"' . ($autoslide ? ' data-autoslide="' . $autoslide . '"' : '') . '>' . "\n";

            foreach ( $dt_query->posts as $dt_post ) {

                $output .= '<li>' . Presscore_Inc_Testimonials_Post_Type::render_testimonial( $dt_post->ID ) . '</li>';

            }

            $output .= '</ul>' . "\n";

            $output = '<section class="testimonial-item testimonial-item-slider">' . $output . '</section>';
        } // if have posts

        return $output;
    }

}

// create shortcode
DT_Shortcode_Testimonials::get_instance();
