<?php
/**
 * Fancy image shortcode.
 *
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Shortcode fancy image class.
 *
 */
class DT_Shortcode_FancyImage extends DT_Shortcode {

    static protected $instance;

    protected $shortcode_name = 'dt_fancy_image';
    protected $plugin_name = 'dt_mce_plugin_shortcode_fancy_image';

    public static function get_instance() {
        if ( !self::$instance ) {
            self::$instance = new DT_Shortcode_FancyImage();
        }
        return self::$instance;
    }

    protected function __construct() {

        add_shortcode( $this->shortcode_name, array($this, 'shortcode') );

        // add shortcode button
        $tinymce_button = new DT_ADD_MCE_BUTTON( $this->plugin_name, basename(dirname(__FILE__)), false );
    }

    public function shortcode( $atts, $content = null ) {
        $default_atts = array(
            'style'             => '1',
            'image'             => '',
            'hd_image'          => '',
            'media'             => '',
            'border'            => '0',
            'lightbox'          => '0',
            'align'             => '',
            'animation'         => 'none',
            'width'             => ''
        );
        $attributes = shortcode_atts( $default_atts, $atts );
        
        $attributes['animation'] = in_array( $attributes['animation'], array('none', 'scale', 'fade', 'left', 'right', 'bottom', 'top') ) ?  $attributes['animation'] : $default_atts['animation'];
        $attributes['style'] = in_array( $attributes['style'], array('1', '2', '3') ) ? $attributes['style'] : $default_atts['style'];
        $attributes['align'] = in_array( $attributes['align'], array('center', 'centre', 'left', 'right') ) ? $attributes['align'] : $default_atts['align'];
        $attributes['border'] = absint($attributes['border']);
        $attributes['width'] = absint($attributes['width']);
        $attributes['image'] = esc_url($attributes['image']);
        $attributes['hd_image'] = esc_url($attributes['hd_image']);
        $attributes['media'] = esc_url($attributes['media']);
        $attributes['lightbox'] = apply_filters('dt_sanitize_flag', $attributes['lightbox']);

        $container_classes = array( 'shortcode-single-image-wrap' );
        $media_classes = array( 'shortcode-single-image' );
        $container_style = array();
        $media = '';
        $content_block = '';

        $content = strip_shortcodes( $content );

        switch ( $attributes['style'] ) {
            case '3': $container_classes[] = 'br-standard';
            case '2': $container_classes[] = 'borderframe';
        }

        switch ( $attributes['align'] ) {
            case 'left': $container_classes[] = 'alignleft'; break;
            case 'right': $container_classes[] = 'alignright'; break;
            case 'centre':
            case 'center': $container_classes[] = 'alignnone'; break;
        }

        if ( 'none' != $attributes['animation'] ) {
            
            switch ( $attributes['animation'] ) {
                case 'scale' : $container_classes[] = 'scale-up'; break;
                case 'fade' : $container_classes[] = 'fade-in'; break;
                case 'left' : $container_classes[] = 'right-to-left'; break;
                case 'right' : $container_classes[] = 'left-to-right'; break;
                case 'bottom' : $container_classes[] = 'top-to-bottom'; break;
                case 'top' : $container_classes[] = 'bottom-to-top'; break;
            }

            $container_classes[] = 'animate-element';
        }

        if ( $content ) {
            $container_classes[] = 'caption-on';
            $content_block = '<div class="shortcode-single-caption">' . $content . '</div>';
        }

        // if media url is set - do some stuff
        if ( $attributes['media'] ) {
            $container_classes[] = 'shortcode-single-video';

            $media = dt_get_embed($attributes['media']);

        // if image or hd_image is set
        } elseif ( $attributes['image'] || $attributes['hd_image'] ) {

            $default_image_src = $attributes['image'] ? $attributes['image'] : $attributes['hd_image'];

            if ( dt_retina_on() ) {
                $image_src = dt_is_hd_device() ? $attributes['hd_image'] : $attributes['image'];
            } else {
                $image_src = $attributes['image'];
            }

            if ( empty($image_src) ) {
                $image_src = $default_image_src;
            }

            $media = sprintf( '<img src="%s" alt="" />', $image_src );

            if ( $attributes['lightbox'] ) {
                 $media = sprintf( '<a class="rollover rollover-zoom" href="%s" title="" data-pp="prettyPhoto">%s</a>', $image_src, $media );
            }
        }

        if ( $media ) {
            $style = ' style="border-width: ' . esc_attr($attributes['border']) . 'px"';
            $media = sprintf( '<div class="%s"%s>%s</div>', esc_attr( implode( ' ', $media_classes ) ), $style, $media );
        }

        if ( $attributes['width'] ) {
            $container_style[] = 'width: ' . $attributes['width'] . 'px';
        }

        $output = sprintf('<div class="%s"%s>%s</div>',
            esc_attr(implode(' ', $container_classes)),
            $container_style ? ' style="' . esc_attr( implode(';', $container_style) ) . '"' : '',
            $media . $content_block
        );

        return $output; 
    }

}

// create shortcode
DT_Shortcode_FancyImage::get_instance();
