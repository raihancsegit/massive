<?php
/**
 * Massive tab shortcode
 *
 * @package Massive Engine
 * @author ThemeBucket <themebucket@gmail.com>
 */

class Massive_Tab extends Massive_Shortcode {

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
            'name'            => esc_html__( 'Tab Item', 'massive-engine' ),
            'base'            => $this->get_tag(),
            "content_element" => true,
            "as_child"        => array('only' => $this->get_tag() . 's_container' ),
            'icon'            => $this->get_icon('tab'),
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
                array(
                    'type'        => 'checkbox',
                    'heading'     => esc_html__( 'Display Icon', 'massive-engine' ),
                    'param_name'  => 'has_icon',
                    'value'       => 'true',
                    ),
                array(
                    'type'        => 'iconpicker',
                    'heading'     => esc_html__( 'Icon', 'massive-engine' ),
                    'param_name'  => 'icon',
                    'dependency'  => array(
                            'element' => 'has_icon',
                            'value'   => 'true'
                        ),
                    'settings' => array(
                        'emptyIcon' => false,
                        'type'        => 'tb_icons',
                        ),
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
            'has_icon' => 'true',
            'icon'     => '',
            'uid'      => ''
            );

        $uid         = $this->get_uid( $atts );
        $atts        = shortcode_atts( $defaults, $atts );
        $atts['uid'] = $uid;
        $hasicon     = esc_attr( $atts['has_icon'] );
        $icon        = esc_attr( $atts['icon'] );

        $view = $this->get_view( 'tab' );

        ob_start();
        if ( file_exists( $view ) ) {
            include( $view );
        }
        return ob_get_clean();

    }

}

new Massive_Tab;
    
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_Massive_Tab extends WPBakeryShortCode {
    }
}
