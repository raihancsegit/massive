<?php
/**
 * Massive progressbars shortcode
 *
 * @package Massive Engine
 * @author ThemeBucket <themebucket@gmail.com>
 */

class Massive_Progressbars extends Massive_Shortcode {

    /**
     * Set shortcode directory
     * @return string Directory path
     */
    protected function set_dir() {
        return __DIR__;
    }

    /**
     * Map this shortcode with visual composer
     * @return array
     */
    protected function map() {
        return array(
            'name'                    => esc_html__( 'Progressbars', 'massive-engine'),
            'base'                    => $this->get_tag(),
            'category'                => esc_html__( 'Massive', 'massive-engine' ),
            'as_parent'               => array('only' => 'massive_progressbar'),
            'content_element'         => true,
            'show_settings_on_create' => false,
            'icon'                    => $this->get_icon('progress'),
            'is_container'            => true,
            "js_view"                 => 'VcColumnView'
        );
    }

    /**
     * render this shortcode
     * @param  array $atts
     * @param  string $content
     * @return string
     */
    public function render( $atts, $content = null ) {
        return do_shortcode( $content );
    }

}

new Massive_Progressbars;

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_Massive_Progressbars extends WPBakeryShortCodesContainer {
    }
}
