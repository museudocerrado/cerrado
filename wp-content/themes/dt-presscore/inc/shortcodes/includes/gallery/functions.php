<?php

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Shortcode testimonials class.
 *
 */
class DT_Shortcode_Gallery extends DT_Shortcode {

    static protected $instance;

    public static function get_instance() {
        if ( !self::$instance ) {
            self::$instance = new DT_Shortcode_Gallery();
        }
        return self::$instance;
    }

    protected function __construct() {
        add_filter( 'post_gallery', array($this, 'shortcode'), 15, 2 );
    }

    public function shortcode( $content = '', $attr = array() ) {
        static $shortcode_instance = 0;

        // return if this is standard mode or gallery alredy modified
        if ( !empty($content) || empty( $attr['mode'] ) || 'standard' == $attr['mode'] ) {
            return $content;
        }

        $shortcode_instance++;

        $post = get_post();

        if ( isset( $attr['orderby'] ) ) {
            $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
            if ( !$attr['orderby'] )
                unset( $attr['orderby'] );
        }

        extract(shortcode_atts(array(
            'mode'          => 'metro',
            'width'         => 1200,
            'height'        => 500,
            'order'         => 'ASC',
            'orderby'       => 'menu_order ID',
            'id'            => $post ? $post->ID : 0,
            'size'          => 'thumbnail',
            'include'       => '',
            'exclude'       => ''
        ), $attr, 'gallery'));

        $id = intval($id);
        if ( 'RAND' == $order ) {
            $orderby = 'none';
        }

        if ( !empty($include) ) {
            $_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

            $attachments = array();
            foreach ( $_attachments as $key => $val ) {
                    $attachments[$val->ID] = $_attachments[$key];
                }
        } elseif ( !empty($exclude) ) {
            $attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
        } else {
            $attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
        }

        if ( empty($attachments) )
            return '';

        if ( is_feed() ) {
            $output = "\n";
            foreach ( $attachments as $att_id => $attachment )
                    $output .= wp_get_attachment_link($att_id, $size, true) . "\n";
            return $output;
        }

        $mode = in_array( $mode, array( 'slideshow', 'metro' ) ) ? $mode : 'metro';
        $width = absint( $width );
        $height = absint( $height );

        $attachments_data = array();

        foreach ( $attachments as $id => $attachment ) {
            $data = array();

            // attachment meta
            $data['full'] = $data['width'] = $data['height'] = '';
            $meta = wp_get_attachment_image_src( $id, 'full' );
            if ( !empty($meta) ) {
                $data['full'] = esc_url($meta[0]);
                $data['width'] = absint($meta[1]);
                $data['height'] = absint($meta[2]);
            }

            $data['thumbnail'] = wp_get_attachment_image_src( $id, 'thumbnail' );

            $data['alt'] = esc_attr( get_post_meta( $id, '_wp_attachment_image_alt', true ) );
            $data['caption'] = $attachment->post_excerpt;
            $data['description'] = $attachment->post_content;
            $data['title'] = get_the_title( $id );
            $data['video_url'] = esc_url( get_post_meta( $id, 'dt-video-url', true ) );
            $data['link'] = esc_url( get_post_meta( $id, 'dt-img-link', true ) );
            $data['mime_type_full'] = get_post_mime_type( $id );
            $data['mime_type'] = dt_get_short_post_myme_type( $id );
            $data['ID'] = $id;

            if ( ! empty( $attr['link'] ) && 'file' === $attr['link'] ) {
                $data['permalink'] = $data['full'];
            } elseif ( ! empty( $attr['link'] ) && 'none' === $attr['link'] ) {
                $data['permalink'] = '';
            } else {
                $data['permalink'] = get_permalink( $id );
            }

            $attachments_data[] = apply_filters( 'presscore_get_attachment_post_data-attachment_data', $data, array_keys($attachments) );
        }

        $style = ' style="width: 100%;"';

        if ( 'slideshow' == $mode ) {

            $output = presscore_get_royal_slider( $attachments_data, array(
                'width'     => $width,
                'height'    => $height,
                'class'     => array( 'slider-simple' ),
                'style'     => $style
            ) );

        } elseif ( 'metro' == $mode ) {

            $output = presscore_get_images_gallery_1( $attachments_data, array(
                'class'     => array( 'shortcode-gallery' ),
                'links_rel' => 'data-pp="prettyPhoto[post-format-gallery-' . $post->ID . '-' . $shortcode_instance . ']"',
                'style'     => $style
            ) );

        }

        return $output;
    }

}

// create shortcode
DT_Shortcode_Gallery::get_instance();