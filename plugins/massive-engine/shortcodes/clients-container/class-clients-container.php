<?php
/**
 * Massive client container shortcode
 *
 * @package Massive Engine
 * @author ThemeBucket <themebucket@gmail.com>
 */

class Massive_Clients_container extends Massive_Shortcode {

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
            'name'                    => esc_html__( 'Clients', 'massive-engine'),
            'base'                    => $this->get_tag(),
            'category'                => esc_html__( 'Massive', 'massive-engine' ),
            'as_parent'               => array('only' => 'massive_client'),
            'content_element'         => true,
            'show_settings_on_create' => true,
            'icon'                    => $this->get_icon('clients'),
            'is_container'            => true,
            "js_view"                 => 'VcColumnView',
            "params"                  =>array(
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Clients Style', 'massive-engine' ),
                    'param_name'  => 'type',
                    'description' => esc_html__( 'Chose massive clients style', 'massive-engine' ),
                    'admin_label' => true,
                    'value'       => array(
                            esc_html__( 'Carousel', 'massive-engine' ) => 'carousel',
                            esc_html__( 'Grid'    , 'massive-engine' ) => 'grid',
                        )
                    ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Box Style', 'massive-engine' ),
                    'param_name'  => 'box_style',
                    'value'       => array(
                            esc_html__( 'Angle Box', 'massive-engine' ) => 'angle-box',
                            esc_html__( 'Plus Box', 'massive-engine' )  => 'plus-box'
                        ),
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => 'grid',
                        )
                    ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Autoplay', 'massive-engine' ),
                    'param_name'  => 'autoplay',
                    'description' => esc_html__( 'Chose clients carousel will autoplay or not', 'massive-engine' ),
                    'value'       => array(
                            'Yes' => 'true',
                            'No'  => 'false',
                        ),
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => 'carousel',
                        ),
                    ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Items', 'massive-engine' ),
                    'param_name'  => 'items',
                    'description' => esc_html__( 'The number of item you want to see on the screen at a time', 'massive-engine' ),
                    'value'       => 3,
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => 'carousel',
                        ),
                    ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Pagination', 'massive-engine' ),
                    'param_name'  => 'pagination',
                    'description' => esc_html__( 'Set clients carousel pagination', 'massive-engine' ),
                    'value'       => array(
                            'Yes' => 'true',
                            'No'  => 'false'
                        ),
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => 'carousel',
                        ),
                    ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Grid Size', 'massive-engine' ),
                    'param_name'  => 'grid_size',
                    'description' => esc_html__( 'Chose grid type', 'massive-engine' ),
                    'value'       => array(
                            esc_html__( 'Grid 2', 'massive-engine' ) => 'grid-2',
                            esc_html__( 'Grid 3', 'massive-engine' ) => 'grid-3',
                            esc_html__( 'Grid 4', 'massive-engine' ) => 'grid-4',
                            esc_html__( 'Grid 5', 'massive-engine' ) => 'grid-5',
                            esc_html__( 'Grid 6', 'massive-engine' ) => 'grid-6',
                        ),
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => 'grid',
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
            'type'       => 'carousel',
            'box_style'  => 'angle-box',
            'autoplay'   => 'true',
            'items'      => 3,
            'pagination' => 'true',
            'grid_size'  => 'grid-2',
            'id'         => '',
            'url'        => '',
            'uid'        => '',
            );

        $uid         = $this->get_uid( $atts );
        $atts        = shortcode_atts( $defaults, $atts );
        $atts['uid'] = $uid;
        $type        = trim( strtolower( $atts['type'] ) );
        $types       = array('carousel', 'grid');

        $view = $this->get_view( $type );

        ob_start();
        if ( in_array( $type, $types ) && file_exists( $view ) ) {
            include( $view );
        }
        return ob_get_clean();
    }

}

new Massive_Clients_container;

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_Massive_Clients_container extends WPBakeryShortCodesContainer {
    }
}
