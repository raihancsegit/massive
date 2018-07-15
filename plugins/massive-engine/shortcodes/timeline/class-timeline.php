<?php
/**
 * Massive timeline shortcode
 *
 * @package Massive Engine
 * @author ThemeBucket <themebucket@gmail.com>
 */

class Massive_Timeline extends Massive_Shortcode {

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
        $tree              = array();
        $uid               = $this->get_uid( $params );

        $style             = massive_get_default_param( $params, 'style', 'dark' );
        $line_color        = massive_get_default_param( $params, 'line_color' );
        $line_width        = massive_get_default_param( $params, 'line_width', '1px' );
        $icon_color        = massive_get_default_param( $params, 'icon_color' );
        $icon_bg_color     = massive_get_default_param( $params, 'icon_bg_color' );
        $icon_border_color = massive_get_default_param( $params, 'icon_border_color' );
        $icon_border_size  = massive_get_default_param( $params, 'icon_border_size', '4px' );
        $title_color       = massive_get_default_param( $params, 'title_color' );
        $desc_color        = massive_get_default_param( $params, 'desc_color' );

        $line_selector     = "{$uid}.timeline:before";
        $icon_selector     = "{$uid}.timeline .timeline-icon";
        $title_selector    = "{$uid} .timeline-desk h1";
        $desc_selector     = "{$uid} .timeline-desk p";

        if ( 'custom' == $style ) {
            $tree[$line_selector] = array(
                'background-color' => $line_color,
                'width'            => massive_check_css_unit( $line_width ),
                'margin-left'      => massive_check_css_unit( '-' . ( intval( $line_width ) / 2 ) ),
                );

            $tree[$icon_selector] = array(
                'color'            => $icon_color,
                'background-color' => $icon_bg_color,
                'border-color'     => $icon_border_color,
                'border-width'     => massive_check_css_unit( $icon_border_size ),
                );

            $tree[$title_selector] = array(
                'color' => $title_color,
                );

            $tree[$desc_selector] = array(
                'color' => $desc_color,
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
            'name'                    => esc_html__( 'Timeline', 'massive-engine' ),
            'base'                    => $this->get_tag(),
            'category'                => esc_html__( 'Massive', 'massive-engine' ),
            'icon'                    => $this->get_icon('timeline'),
            'as_parent'               => array('only' => 'massive_timeline_event'),
            'is_container'            => true,
            'js_view'                 => 'VcColumnView',
            'content_element'         => true,
            'show_settings_on_create' => true,
            'params'                  => array(
                array(
                    'type'       => 'dropdown',
                    'heading'    => esc_html__( 'Style', 'massive-engine' ),
                    'param_name' => 'style',
                    'std'        => 'dark',
                    'value'      => array(
                        esc_html__( 'Dark Style', 'massive-engine' )   => 'dark',
                        esc_html__( 'Light Style', 'massive-engine' )  => 'light',
                        esc_html__( 'Custom Style', 'massive-engine' ) => 'custom',
                        ),
                    ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__( 'Line Color', 'massive-engine' ),
                    'param_name'  => 'line_color',
                    'description' => esc_html__( 'Choose a suitable line color.', 'massive-engine' ),
                    'group'       => esc_html__( 'Custom Settings', 'massive-engine' ),
                    'dependency'  => array(
                        'element' => 'style',
                        'value'   => 'custom',
                        ),
                    ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Line Width', 'massive-engine' ),
                    'param_name'  => 'line_width',
                    'description' =>  mengine_esc_desc( __( 'Set a line width. For example %s. Recommended units are %s, %s & %s. If you set "0" then border color will not be visible.', 'massive-engine' ), array( '<code>1px</code>', '<code>px</code>', '<code>em</code>', '<code>%</code>' ) ),
                    'group'       => esc_html__( 'Custom Settings', 'massive-engine' ),
                    'value'       => '1px',
                    'dependency'  => array(
                        'element' => 'style',
                        'value'   => 'custom',
                        ),
                    ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__( 'Icon Color', 'massive-engine' ),
                    'param_name'  => 'icon_color',
                    'description' => esc_html__( 'Choose a suitable icon color.', 'massive-engine' ),
                    'group'       => esc_html__( 'Custom Settings', 'massive-engine' ),
                    'dependency'  => array(
                        'element' => 'style',
                        'value'   => 'custom',
                        ),
                    ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__( 'Icon Background Color', 'massive-engine' ),
                    'param_name'  => 'icon_bg_color',
                    'description' => esc_html__( 'Choose a suitable color for icon background.', 'massive-engine' ),
                    'group'       => esc_html__( 'Custom Settings', 'massive-engine' ),
                    'dependency'  => array(
                        'element' => 'style',
                        'value'   => 'custom',
                        ),
                    ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__( 'Icon Border Color', 'massive-engine' ),
                    'param_name'  => 'icon_border_color',
                    'description' => esc_html__( 'Choose a suitable color for icon border.', 'massive-engine' ),
                    'group'       => esc_html__( 'Custom Settings', 'massive-engine' ),
                    'dependency'  => array(
                        'element' => 'style',
                        'value'   => 'custom',
                        ),
                    ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Icon Border Size', 'massive-engine' ),
                    'param_name'  => 'icon_border_size',
                    'value'       => '3px',
                    'description' => mengine_esc_desc( __( 'Set a border size for icon. For example %s. Recommended units are %s, %s & %s. If you set "0" then border color will not be visible.', 'massive-engine' ), array( '<code>3px</code>', '<code>px</code>', '<code>em</code>', '<code>%</code>' ) ),
                    'group'       => esc_html__( 'Custom Settings', 'massive-engine' ),
                    'dependency'  => array(
                        'element' => 'style',
                        'value'   => 'custom',
                        ),
                    ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__( 'Event Title Color', 'massive-engine' ),
                    'param_name'  => 'title_color',
                    'description' => esc_html__( 'Choose a suitable color for event title.', 'massive-engine' ),
                    'group'       => esc_html__( 'Custom Settings', 'massive-engine' ),
                    'dependency'  => array(
                        'element' => 'style',
                        'value'   => 'custom',
                        ),
                    ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__( 'Event Description Color', 'massive-engine' ),
                    'param_name'  => 'desc_color',
                    'description' => esc_html__( 'Choose a suitable color for event description.', 'massive-engine' ),
                    'group'       => esc_html__( 'Custom Settings', 'massive-engine' ),
                    'dependency'  => array(
                        'element' => 'style',
                        'value'   => 'custom',
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
            'style'  => 'dark',
            );

        $uid         = $this->get_uid( $atts ); //this line must be here after $defaults, before calling shortcode_atts
        $atts        = shortcode_atts( $defaults, $atts );
        $atts['uid'] = $uid;

        $style       = massive_sanitize_param( $atts['style'] );
        $classes     = array('timeline');

        if ( 'light' == $style ) {
            $classes[] = 'dark';
            $classes[] = 'light-theme';
        } elseif( 'dark' == $style ) {
            $classes[] = 'light';
            $classes[] = 'dark-theme';
        } elseif( 'custom' == $style ) {
            $classes[] = 'custom-theme';
            $classes[] = $uid;
        }

        $view = $this->get_view( 'main' );

        ob_start();
        if ( file_exists( $view ) ) {
            include( $view );
        }
        return ob_get_clean();
    }
    
}

new Massive_Timeline;

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_Massive_Timeline extends WPBakeryShortCodesContainer {
    }
}
