<?php
/**
 * Massive accordion shortcode
 *
 * @package Massive Engine
 * @author ThemeBucket <themebucket@gmail.com>
 */

class Massive_Accordion extends Massive_Shortcode {

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
            'name'            => esc_html__( 'Accordion Item', 'massive-engine' ),
            'base'            => $this->get_tag(),
            "content_element" => true,
            "as_child"        => array('only' => $this->get_tag() . 's_container' ),
            'icon'            => $this->get_icon('accordion'),
            'params' => array(
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Title', 'massive-engine' ),
                    'param_name'  => 'title',
                    'value'       => '',
                    'admin_label' => true
                    ),
                array(
                    'type'        => 'textarea_html',
                    'heading'     => esc_html__( 'Content', 'massive-engine' ),
                    'param_name'  => 'content'
                    ),
                )
            );
    }

    /**
     * render this shortcode
     * @param  array $atts
     * @param  string $content
     * @return string
     */
    public function render( $atts, $content = null ) {
        $defaults = array(
            'title'    => '',
            'content'  => '',
            'uid'      => '',
            );

        $uid = $this->get_uid( $atts );
        $atts = shortcode_atts( $defaults, $atts );
        $atts['uid'] = $uid;

        ob_start();
        $view = $this->get_view('accordion');
        if ( file_exists( $view ) ) {
            include( $view );
        }
        return ob_get_clean();
    }

}

new Massive_Accordion;

if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_Massive_Accordion extends WPBakeryShortCode {
    }
}
