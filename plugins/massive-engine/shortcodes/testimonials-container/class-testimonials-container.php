<?php
/**
 * Massive testimonials shortcode
 *
 * @package Massive Engine
 * @author ThemeBucket <themebucket@gmail.com>
 */

class Massive_Testimonials_Container extends Massive_Shortcode {

    /**
     * Set shortcode directory
     * @return string Directory path
     */
    protected function set_dir() {
        return __DIR__;
    }

    /**
     * Map shortcode dynamic styles
     * @param  array $params
     * @return string
     */
    public function map_dynamic_styles( $params ) {
        $tree            = array();

        $customize       = massive_get_default_param( $params, 'has_customize' );
        $message_color   = massive_get_default_param( $params, 'message_color' );
        $name_color      = massive_get_default_param( $params, 'name_color' );
        $dsgnation_color = massive_get_default_param( $params, 'dsgnation_color' );
        $icon_color      = massive_get_default_param( $params, 'icon_color' );
        $uid             = $this->get_uid( $params );

        $content_id      = $uid . ' div.content p';
        $name_id         = $uid . ' div.testimonial-meta';
        $dsgnation_id    = $uid . ' div.testimonial-meta span';
        $icon_id         = $uid . ' i';

        if ( 'true' == $customize ) {
            $tree[$content_id] = array(
                'color'        => $message_color . ' !important',
            );
            $tree[$name_id] = array(
                'color'        => $name_color . ' !important',
            );
            $tree[$dsgnation_id] = array(
                'color'        => $dsgnation_color . ' !important',
            );
            $tree[$icon_id] = array(
                'color'        => $icon_color . ' !important',
            );
        }


        return $tree;
    }

    /**
     * Map this shortcode with visual composer
     * @return array
     */
    protected function map() {
        return array(
            'name'                    => esc_html__( 'Testimonials', 'massive-engine'),
            'base'                    => $this->get_tag(),
            'category'                => esc_html__( 'Massive', 'massive-engine' ),
            'as_parent'               => array('only' => 'massive_testimonial'),
            'content_element'         => true,
            'show_settings_on_create' => true,
            'icon'                    => $this->get_icon('testimonial'),
            'is_container'            => true,
            "js_view"                 => 'VcColumnView',
            "params"                  =>array(
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Testimonials Style', 'massive-engine' ),
                    'param_name'  => 'type',
                    'description' => esc_html__( 'Chose massive testimonials design', 'massive-engine' ),
                    'admin_label' => true,
                    'value'       => array(
                            esc_html__( 'Grid'   , 'massive-engine' )                         => 'plus-box',
                            esc_html__( 'Carousel: Center Aligned' , 'massive-engine' )       => 'carousel-two',
                            esc_html__( 'Carousel: Center Aligned Boxed' , 'massive-engine' ) => 'carousel-one',
                            esc_html__( 'Carousel: Left Aligned Bubble' , 'massive-engine' )  => 'carousel-three',
                            esc_html__( 'Carousel: Left Aligned Regular' , 'massive-engine' ) => 'carousel-four'
                        )

                    ),
                array(
                    'type'        => 'checkbox',
                    'heading'     => esc_html__( 'Customize', 'massive-engine' ),
                    'param_name'  => 'has_customize',
                    'description' => esc_html__( 'Check this box if want to customize the colors', 'massive-engine' )
                    ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__( 'Name Color', 'massive-engine' ),
                    'param_name'  => 'name_color',
                    'group'       => 'Custom Settings',
                    'dependency'  => array(
                        'element' => 'has_customize',
                        'value'   => 'true',
                        ),
                    ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__( 'Job Title Color', 'massive-engine' ),
                    'param_name'  => 'dsgnation_color',
                    'group'       => 'Custom Settings',
                    'dependency'  => array(
                        'element' => 'has_customize',
                        'value'   => 'true',
                        ),
                    ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__( 'Testimonial Content Color', 'massive-engine' ),
                    'param_name'  => 'message_color',
                    'group'       => 'Custom Settings',
                    'dependency'  => array(
                        'element' => 'has_customize',
                        'value'   => 'true',
                        ),
                    ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__( 'Icon Color', 'massive-engine' ),
                    'param_name'  => 'icon_color',
                    'group'       => 'Custom Settings',
                    'dependency'  => array(
                        'element' => 'has_customize',
                        'value'   => 'true',
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
            'type'       => 'plus-box',
            'uid'        => '',
            );

        $uid         = $this->get_uid( $atts );
        $atts        = shortcode_atts( $defaults, $atts );
        $atts['uid'] = $uid;
        $type        = trim( strtolower( $atts['type'] ) );
        $types       = array(
            'plus-box',
            'carousel-one',
            'carousel-two',
            'carousel-three',
            'carousel-four'
            );

        $content     = str_replace( '[massive_testimonial', '[massive_testimonial type="' . $atts['type'] . '"', $content );
        $classes = array();

        $view = $this->get_view( $type );

        ob_start();
        if ( in_array( $type, $types ) && file_exists( $view ) ) {
            include( $view );
        }
        return ob_get_clean();
    }

}

new Massive_Testimonials_Container;

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_Massive_Testimonials_Container extends WPBakeryShortCodesContainer {
    }
}
