<?php
/**
 * SocialIcons shortcode.
 *
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Shortcode accordion class.
 *
 */
class DT_Shortcode_SocialIcons extends DT_Shortcode {

    static protected $instance;
    static protected $atts;

    protected $plugin_name = 'dt_mce_plugin_shortcode_social_icons';

    public static function get_instance() {
        if ( !self::$instance ) {
            self::$instance = new DT_Shortcode_SocialIcons();
        }
        return self::$instance;
    }

    protected function __construct() {

        add_shortcode( 'dt_social_icons', array($this, 'shortcode_icons_content') );
        add_shortcode( 'dt_social_icon', array($this, 'shortcode_icon') );

        // add shortcode button
        $tinymce_button = new DT_ADD_MCE_BUTTON( $this->plugin_name, basename(dirname(__FILE__)), false, 4 );
    }

    public function shortcode_icons_content( $atts, $content = null ) {
        $attributes = shortcode_atts( array(
            'animation'         => 'none'
        ), $atts );

        $attributes['animation'] = in_array( $attributes['animation'], array('none', 'scale', 'fade', 'left', 'right', 'bottom', 'top') ) ?  $attributes['animation'] : 'none';

        $classes = array( 'soc-ico' );

        if ( 'none' != $attributes['animation'] ) {
            $classes[] = 'animation-builder';
        }

        $backup_atts = self::$atts;
        self::$atts = $attributes;

        $output = '<div class="' . esc_attr( implode( ' ', $classes ) ) . '">' . do_shortcode( str_replace( array( "\n" ), '', $content ) ) . '</div>';

        self::$atts = $backup_atts;

        return $output;
    }

    public function shortcode_icon( $atts, $content = null ) {
        extract( shortcode_atts( array(
            'icon'          => '',
            'target_blank'  => '1',
            'link'          => '#'
        ), $atts ) );
        
        static $social_icons = null;
        if ( !$social_icons ) {
            $social_icons = array(
                'facebook'      => _x('Facebook', 'widget', LANGUAGE_ZONE),
                'twitter'       => _x('Twitter', 'widget', LANGUAGE_ZONE),
                'google'        => _x('Google+', 'widget', LANGUAGE_ZONE),
                'dribbble'      => _x('Dribbble', 'widget', LANGUAGE_ZONE),
                'you-tube'      => _x('YouTube', 'widget', LANGUAGE_ZONE),
                'rss'           => _x('Rss', 'widget', LANGUAGE_ZONE),
                'delicious'     => _x('Delicious', 'widget', LANGUAGE_ZONE),
                'flickr'        => _x('Flickr', 'widget', LANGUAGE_ZONE),
                'forrst'        => _x('Forrst', 'widget', LANGUAGE_ZONE),
                'lastfm'        => _x('Lastfm', 'widget', LANGUAGE_ZONE),
                'linkedin'      => _x('Linkedin', 'widget', LANGUAGE_ZONE),
                'vimeo'         => _x('Vimeo', 'widget', LANGUAGE_ZONE),
                'tumbler'       => _x('Tumblr', 'widget', LANGUAGE_ZONE),
                'pinterest'     => _x('Pinterest', 'widget', LANGUAGE_ZONE),
                'devian'        => _x('Deviantart', 'widget', LANGUAGE_ZONE),
                'skype'         => _x('Skype', 'widget', LANGUAGE_ZONE),
                'github'        => _x('Github', 'widget', LANGUAGE_ZONE),
                'instagram'     => _x('Instagram', 'widget', LANGUAGE_ZONE),
                'stumbleupon'   => _x('Stumbleupon', 'widget', LANGUAGE_ZONE),
                'behance'       => _x('Behance', 'widget', LANGUAGE_ZONE),
                'mail'          => _x('Mail', 'widget', LANGUAGE_ZONE),
                'website'       => _x('Website', 'widget', LANGUAGE_ZONE),
                'px-500'          => _x('500px', 'widget', LANGUAGE_ZONE),
                'tripedvisor'       => _x('tripedvisor', 'widget', LANGUAGE_ZONE),
            );
        }
        
        if ( 'deviant' == $icon ) {
            $icon = 'devian';
        } elseif ( 'tumblr' == $icon ) {
            $icon = 'tumbler';
        } elseif ( '500px' == $icon ) {
            $icon = 'px-500';
        } elseif ( 'YouTube' == $icon ) {
            $icon = 'you-tube';
        }

        $icon = in_array( $icon, array_keys($social_icons) ) ? $icon : '';

        if ( empty($icon) ) {
            return '';
        }

        $classes = array( sanitize_html_class( $icon ),  );

        if ( isset( self::$atts['animation'] ) && 'none' != self::$atts['animation'] ) {

            switch ( self::$atts['animation'] ) {
                case 'scale' : $classes[] = 'scale-up'; break;
                case 'fade' : $classes[] = 'fade-in'; break;
                case 'left' : $classes[] = 'right-to-left'; break;
                case 'right' : $classes[] = 'left-to-right'; break;
                case 'bottom' : $classes[] = 'top-to-bottom'; break;
                case 'top' : $classes[] = 'bottom-to-top'; break;
            }

            $classes[] = 'animate-element';
        }

        $link = $link ? esc_url( $link ) : '#';
        $target_blank = apply_filters( 'dt_sanitize_flag', $target_blank );

        $output = sprintf( '<a class="%1$s" href="%2$s"%4$s title="%3$s"><span class="assistive-text">%3$s</span></a>',
            esc_attr( implode( ' ', $classes ) ),
            $link,
            $social_icons[ $icon ],
            $target_blank ? ' target="_blank"' : ''
        );

        return $output; 
    }

}

// create shortcode
DT_Shortcode_SocialIcons::get_instance();
