<?php
/**
 * Massive alert shortcode
 *
 * @package Massive Engine
 * @author ThemeBucket <themebucket@gmail.com>
 */

class Massive_Alert extends Massive_Shortcode {

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
        $tree = array();
        $type = massive_get_default_param( $params, 'type', 'info' );
        $uid  = $this->get_uid( $params );
        if ( 'custom' == $type ) {
            $color        = massive_get_default_param( $params, 'color' );
            $bg_color     = massive_get_default_param( $params, 'bg_color' );
            $border_color = massive_get_default_param( $params, 'border_color' );
            $tree[$uid] = array(
                'color'            => $color,
                'background-color' => $bg_color,
                'border-color'     => $border_color,
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
            'name'     => esc_html__( 'Alert', 'massive-engine' ),
            'base'     => $this->get_tag(),
            'category' => 'Massive',
            'icon'     => $this->get_icon('alert'),
            'params'   => array(
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Alert Type', 'massive-engine' ),
                    'param_name'  => 'type',
                    'admin_label' => true,
                    'std'         => 'info',
                    'value'       => array(
                        esc_html__( 'Information', 'massive-engine' ) => 'info',
                        esc_html__( 'Success', 'massive-engine' )     => 'success',
                        esc_html__( 'Warning', 'massive-engine' )     => 'warning',
                        esc_html__( 'Danger', 'massive-engine' )      => 'danger',
                        esc_html__( 'Custom', 'massive-engine' )      => 'custom',
                        ),
                    ),
                array(
                    'type'        => 'textarea_html',
                    'heading'     => esc_html__( 'Alert Message', 'massive-engine' ),
                    'param_name'  => 'content',
                    'admin_label' => true,
                    'value'       => esc_html__( 'Alert message goes here.', 'massive-engine' ),
                    ),
                array(
                    'type'       => 'dropdown',
                    'heading'    => esc_html__( 'Background Style', 'massive-engine' ),
                    'param_name' => 'bg_style',
                    'std'        => 'none',
                    'dependency' => array(
                        'element' => 'type',
                        'value'   => array('info','success','warning','danger')
                        ),
                    'value'      => array(
                        'None' => 'none',
                        'Fill' => 'fill'
                        )
                    ),
                array(
                    'type'       => 'checkbox',
                    'heading'    => esc_html__( 'Display Icon', 'massive-engine' ),
                    'param_name' => 'has_icon',
                    'dependency' => array(
                        'element' => 'type',
                        'value'   => array('info','success','warning','danger')
                        ),
                    ),
                array(
                    'type'       => 'checkbox',
                    'heading'    => esc_html__( 'Display Icon', 'massive-engine' ),
                    'param_name' => 'custom_has_icon',
                    'dependency' => array(
                        'element' => 'type',
                        'value'   => 'custom'
                        ),
                    ),
                array(
                    'type'       => 'iconpicker',
                    'heading'    => esc_html__( 'Icon', 'massive-engine' ),
                    'param_name' => 'icon',
                    'dependency' => array(
                        'element' => 'custom_has_icon',
                        'value'   => 'true'
                        ),
                    'settings'   => array(
                        'emptyIcon' => false,
                        ),
                    'description' => esc_html__( 'Select icon from Font Awesome library.', 'massive-engine' ),
                    ),
                array(
                    'type'       => 'checkbox',
                    'heading'    => esc_html__( 'Display Close Button', 'massive-engine' ),
                    'param_name' => 'dismissible',
                    ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__( 'Text Color', 'massive-engine' ),
                    'param_name'  => 'color',
                    'description' => esc_html__( 'Pick a color for alert message text.', 'massive-engine' ),
                    'group'       => esc_html__( 'Custom Settings', 'massive-engine' ),
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => 'custom'
                        ),
                    ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__( 'Background Color', 'massive-engine' ),
                    'param_name'  => 'bg_color',
                    'description' => esc_html__( 'Pick a color for alert box background.', 'massive-engine' ),
                    'group'       => esc_html__( 'Custom Settings', 'massive-engine' ),
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => 'custom'
                        ),
                    ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__( 'Border Color', 'massive-engine' ),
                    'param_name'  => 'border_color',
                    'description' => esc_html__( 'Pick a color for alert box border.', 'massive-engine' ),
                    'group'       => esc_html__( 'Custom Settings', 'massive-engine' ),
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => 'custom'
                        ),
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
            'type'            => 'info',
            'bg_style'        => 'none',
            'dismissible'     => 'false',
            'has_icon'        => 'false',
            'custom_has_icon' => 'false',
            'icon'            => '',
            'color'           => '',
            'bg_color'        => '',
            'border_color'    => '',
            'uid'             => '',
            );

        $uid         = $this->get_uid( $atts ); //this line must be here after $defaults, before calling shortcode_atts
        $atts        = shortcode_atts( $defaults, $atts );
        $atts['uid'] = $uid;
        $type        = massive_sanitize_param( $atts['type'] );
        $types       = array('info', 'success', 'warning', 'danger', 'custom');

        $view = $this->get_view( $type );

        ob_start();
        if ( in_array( $type, $types ) && file_exists( $view ) ) {
            include( $view );
        }
        return ob_get_clean();
    }

}

new Massive_Alert;
