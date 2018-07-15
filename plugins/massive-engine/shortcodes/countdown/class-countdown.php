<?php
/**
 * Massive countdown shortcode
 *
 * @package Massive Engine
 * @author ThemeBucket <themebucket@gmail.com>
 */

class Massive_Countdown extends Massive_Shortcode {

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
        $tree             = array();
        $type             = massive_get_default_param( $params, 'type', 'circle' );
        $has_weeks        = massive_get_default_param( $params, 'has_weeks' );
        $cr_text_color    = massive_get_default_param( $params, 'cr_text_color', '#323232' );
        $cr_border_size   = massive_get_default_param( $params, 'cr_border_size', '5px' );
        $cr_border_radius = massive_get_default_param( $params, 'cr_border_radius', '50%' );
        $cr_border_color  = massive_get_default_param( $params, 'cr_border_color' , 'rgba(0,0,0,.2)' );
        $cr_bg_color      = massive_get_default_param( $params, 'cr_bg_color' , '#fff');

        $sq_text_color    = massive_get_default_param( $params, 'sq_text_color', 'rgba(0,0,0,.2)' );
        $sq_border_size   = massive_get_default_param( $params, 'sq_border_size', '1px' );
        $sq_border_color  = massive_get_default_param( $params, 'sq_border_color' , 'rgba(0,0,0,.2)' );
        $sq_bg_color      = massive_get_default_param( $params, 'sq_bg_color' , 'transparent');

        $uid              = $this->get_uid( $params );
        $week_id          = $uid . ' .c-weeks';
        $count_id         = $uid . ' .c-grid';

        if ( 'square' == $type ) {
            $tree[$count_id] = array(
                'color'            => $sq_text_color . ' !important',
                'border-width'     => massive_check_css_unit($sq_border_size) . ' !important',
                'border-color'     => $sq_border_color . ' !important',
                'background-color' => $sq_bg_color . ' !important',
            );
        } else {
            $tree[$count_id] = array(
                'color'            => $cr_text_color . ' !important',
                'border-width'     => massive_check_css_unit($cr_border_size) . ' !important',
                'border-color'     => $cr_border_color . ' !important',
                'border-radius'    => massive_check_css_unit($cr_border_radius) . ' !important',
                'background-color' => $cr_bg_color . ' !important',
            );
        }

        if ( false == $has_weeks ) {
            $tree[$week_id] = array(
                'display' => 'none !important',
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
            'name'     => esc_html__( 'Countdown', 'massive-engine' ),
            'base'     => $this->get_tag(),
            'category' => esc_html__( 'Massive', 'massive-engine' ),
            'icon'     => $this->get_icon('countdown'),
            'params'   => array(
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Countdown Style', 'massive-engine' ),
                    'param_name'  => 'type',
                    'admin_label' => true,
                    'value'       => array(
                            esc_html__( 'Circle', 'massive-engine' ) => 'circle',
                            esc_html__( 'Square', 'massive-engine' ) => 'square'
                        ),
                    ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Countdown End Time', 'massive-engine' ),
                    'param_name'  => 'end_time',
                    'description' => mengine_esc_desc( __( 'Set countdown timer end date and time. Format:  YYYY/MM/DD. E.g: <code>2020/10/10</code>', 'massive-engine') ),
                    ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Show Weeks', 'massive-engine' ),
                    'param_name'  => 'has_weeks',
                    'value'       => array(
                            esc_html__( 'Yes' , 'massive-engine' ) => true,
                            esc_html__( 'No', 'massive-engine' )   => false
                        ),
                    ),
                //for circle style
                array(
                    'type'       => 'colorpicker',
                    'heading'    => esc_html__( 'Text Color', 'massive-engine' ),
                    'param_name' => 'cr_text_color',
                    'value'      => '#323232',
                    'group'      => esc_html__( 'Custom Settings: Circle Style', 'massive-engine' ),
                    'dependency' => array(
                            'element' => 'type',
                            'value'   => 'circle'
                        )
                    ),
                array(
                    'type'       => 'textfield',
                    'heading'    => esc_html__( 'Border Size', 'massive-engine' ),
                    'param_name' => 'cr_border_size',
                    'group'      => esc_html__( 'Custom Settings: Circle Style', 'massive-engine' ),
                    'dependency' => array(
                            'element' => 'type',
                            'value'   => 'circle'
                        )
                    ),
                array(
                    'type'       => 'textfield',
                    'heading'    => esc_html__( 'Border Radius', 'massive-engine' ),
                    'param_name' => 'cr_border_radius',
                    'group'      => esc_html__( 'Custom Settings: Circle Style', 'massive-engine' ),
                    'dependency' => array(
                            'element' => 'type',
                            'value'   => 'circle'
                        )
                    ),
                array(
                    'type'       => 'colorpicker',
                    'heading'    => esc_html__( 'Border Color', 'massive-engine' ),
                    'param_name' => 'cr_border_color',
                    'value'      => 'rgba(0,0,0,.2)',
                    'group'      => esc_html__( 'Custom Settings: Circle Style', 'massive-engine' ),
                    'dependency' => array(
                            'element' => 'type',
                            'value'   => 'circle'
                        )
                    ),
                array(
                    'type'       => 'colorpicker',
                    'heading'    => esc_html__( 'Background Color', 'massive-engine' ),
                    'param_name' => 'cr_bg_color',
                    'value'      => '#fff',
                    'group'      => esc_html__( 'Custom Settings: Circle Style', 'massive-engine' ),
                    'dependency' => array(
                            'element' => 'type',
                            'value'   => 'circle'
                        )
                    ),
                //for square style
                array(
                    'type'       => 'colorpicker',
                    'heading'    => esc_html__( 'Text Color', 'massive-engine' ),
                    'param_name' => 'sq_text_color',
                    'value'      => 'rgba(0,0,0,.2)',
                    'group'      => esc_html__( 'Custom Settings: Square Style', 'massive-engine' ),
                    'dependency' => array(
                            'element' => 'type',
                            'value'   => 'square'
                        )
                    ),
                array(
                    'type'       => 'textfield',
                    'heading'    => esc_html__( 'Border Size', 'massive-engine' ),
                    'param_name' => 'sq_border_size',
                    'value'      => '1px',
                    'group'      => esc_html__( 'Custom Settings: Square Style', 'massive-engine' ),
                    'dependency' => array(
                            'element' => 'type',
                            'value'   => 'square'
                        )
                    ),
                array(
                    'type'       => 'colorpicker',
                    'heading'    => esc_html__( 'Border Color', 'massive-engine' ),
                    'param_name' => 'sq_border_color',
                    'value'      => 'rgba(0,0,0,.2)',
                    'group'      => esc_html__( 'Custom Settings: Square Style', 'massive-engine' ),
                    'dependency' => array(
                            'element' => 'type',
                            'value'   => 'square'
                        )
                    ),
                array(
                    'type'       => 'colorpicker',
                    'heading'    => esc_html__( 'Background Color', 'massive-engine' ),
                    'param_name' => 'sq_bg_color',
                    'value'      => 'transparent',
                    'group'      => esc_html__( 'Custom Settings: Square Style', 'massive-engine' ),
                    'dependency' => array(
                            'element' => 'type',
                            'value'   => 'square'
                        )
                    ),
                )
            );
    }

    /**
     * Render this shortcode
     * @param  array $atts
     * @param  string $content
     * @return string
     */
    public function render( $atts, $content = null ) {
        $defaults = array(
            'type'             => 'circle',
            'end_time'         => '',
            'has_weeks'        => true,
            'cr_text_color'    => '#323232',
            'cr_border_size'   => '5px',
            'cr_border_color'  => 'rgba(0,0,0,.2)',
            'cr_border_radius' => '50%',
            'cr_bg_color'      => '#fff',
            'sq_text_color'    => 'rgba(0,0,0,.2)',
            'sq_border_size'   => '1px',
            'sq_border_color'  => 'rgba(0,0,0,.2)',
            'sq_bg_color'      => 'transparent',
            'uid'              => '',
            );

        $uid         = $this->get_uid( $atts );
        $atts        = shortcode_atts( $defaults, $atts );
        $atts['uid'] = $uid;

        $view = $this->get_view( 'countdown' );

        ob_start();
        if ( file_exists( $view ) ) {
            include( $view );
        }
        return ob_get_clean();
    }
    
}

new Massive_Countdown;
