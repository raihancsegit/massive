<?php
/**
 * Massive accordion container shortcode
 *
 * @package Massive Engine
 * @author ThemeBucket <themebucket@gmail.com>
 */

class Massive_Accordions_Container extends Massive_Shortcode {

    /**
     * Set shortcode directory
     * @return string Directory path
     */
    protected function set_dir() {
        return __DIR__;
    }

    private function toggle_value( $val1, $val2 ) {
        return ( ! empty( $val1 ) ? $val1 : $val2);
    }

    /**
     * Map shortcode dynamic styles
     * @param  array $params
     * @return string
     */
    public function map_dynamic_styles( $params ) {
        $tree                 = array();

        $type                     = massive_get_default_param( $params, 'type', 'one' );
        $customize_one            = massive_get_default_param( $params, 'customize_one', 'false' );
        $customize_two            = massive_get_default_param( $params, 'customize_two', 'false' );

        $title_color              = massive_get_default_param( $params, 'title_color' );
        $title_actv_color         = massive_get_default_param( $params, 'title_actv_color' );
        $icon_color               = massive_get_default_param( $params, 'icon_color' );
        $icon_actv_color          = massive_get_default_param( $params, 'icon_actv_color' );
        $accordion_color          = massive_get_default_param( $params, 'accordion_color' );
        $accordion_actv_color     = massive_get_default_param( $params, 'accordion_actv_color' );
        $timeline_style           = massive_get_default_param( $params, 'timeline_style', 'solid' );
        $timeline_color           = massive_get_default_param( $params, 'timeline_color' );
        $content_color            = massive_get_default_param( $params, 'content_color' );

        $title_color_two          = massive_get_default_param( $params, 'title_color_two' );
        $title_actv_color_two     = massive_get_default_param( $params, 'title_actv_color_two' );
        $accordion_color_two      = massive_get_default_param( $params, 'accordion_color_two' );
        $accordion_actv_color_two = massive_get_default_param( $params, 'accordion_actv_color_two' );
        $content_color_two        = massive_get_default_param( $params, 'content_color_two' );
        $icon_color_two           = massive_get_default_param( $params, 'icon_color_two' );
        $icon_actv_color_two      = massive_get_default_param( $params, 'icon_actv_color_two' );


        $uid                  = $this->get_uid( $params );
        $timeline_id          = $uid . ':before';
        $title_id             = $uid . ' dt a';
        $title_actv_id        = $uid . ' dt a.active';
        $title_hover_id       = $uid . ' dt a:hover';
        $title_after_id       = $uid . ' dt a:after';
        $title_actv_after_id  = $uid . ' dt a.active:after';
        $title_hover_after_id = $uid . ' dt a:hover:after';
        $content_id           = $uid . ' dd';

        if ( 'true' == $customize_one ) {

            $tree[$timeline_id] = array(
                'border'            => '1px ' . $timeline_style . ' ' . $timeline_color . ' !important',
            );
            $tree[$title_id] = array(
                'color'            => $title_color . ' !important',
            );
            $tree[$title_actv_id] = array(
                'color'            => $title_actv_color . ' !important',
            );
            $tree[$title_hover_id] = array(
                'color'            => $title_actv_color . ' !important',
            );
            $tree[$title_after_id] = array(
                'color'            => $icon_color . ' !important',
                'background-color' => $accordion_color . ' !important',
            );
            $tree[$title_actv_after_id] = array(
                'color'            => $icon_actv_color . ' !important',
                'background-color' => $accordion_actv_color . ' !important',
            );
            $tree[$title_hover_after_id] = array(
                'color'            => $icon_actv_color . ' !important',
                'background-color' => $accordion_actv_color . ' !important',
            );

        } elseif ( 'true' == $customize_two ) {

            $tree[$title_id] = array(
                'color'            => $title_color_two . ' !important',
                'background-color' => $accordion_color_two . ' !important',
                'border'           => 'none'
            );
            $tree[$title_actv_id] = array(
                'color'            => $title_actv_color_two . ' !important',
                'background-color' => $accordion_actv_color_two . ' !important',
                'border'           => 'none'
            );
            $tree[$title_hover_id] = array(
                'color'            => $title_actv_color_two . ' !important',
                'background-color' => $accordion_actv_color_two . ' !important',
                'border'           => 'none'
            );
            $tree[$title_after_id] = array(
                'color'            => $icon_color_two . ' !important',
            );
            $tree[$title_actv_after_id] = array(
                'color'            => $icon_actv_color_two . ' !important',
            );
            $tree[$title_hover_after_id] = array(
                'color'            => $icon_actv_color_two . ' !important',
            );
        }

        $tree[$content_id] = array(
            'color'            => ( ! empty( $content_color ) ? $content_color : $content_color_two ) . ' !important',
        );

        return $tree;
    }

    /**
     * Map this shortcode with visual composer
     * @return array
     */
    protected function map() {
        return array(
            'name'                    => esc_html__( 'Accordions', 'massive-engine'),
            'base'                    => $this->get_tag(),
            'category'                => esc_html__( 'Massive', 'massive-engine' ),
            'as_parent'               => array('only' => 'massive_accordion'),
            'content_element'         => true,
            'show_settings_on_create' => true,
            'icon'                    => $this->get_icon('accordion'),
            'is_container'            => true,
            "js_view"                 => 'VcColumnView',
            "params"                  =>array(
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Accordions Style', 'massive-engine' ),
                    'param_name'  => 'type',
                    'description' => esc_html__( 'Chose massive accordions style', 'massive-engine' ),
                    'admin_label' => true,
                    'value'       => array(
                            esc_html__( 'Timeline'  , 'massive-engine' ) => 'one',
                            esc_html__( 'Bar'  , 'massive-engine' )      => 'two'
                        )
                    ),
                array(
                    'type'        => 'checkbox',
                    'heading'     => esc_html__( 'Toggle Mode', 'massive-engine' ),
                    'param_name'  => 'toggle'
                    ),
                array(
                    'type'        => 'checkbox',
                    'heading'     => esc_html__( 'Customize', 'massive-engine' ),
                    'param_name'  => 'customize_one',
                    'description' => esc_html__( 'Check this box to activate custom settings', 'massive-engine' ),
                    'value'       => 'false',
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => 'one'
                        )
                    ),
                array(
                    'type'        => 'checkbox',
                    'heading'     => esc_html__( 'Customize', 'massive-engine' ),
                    'param_name'  => 'customize_two',
                    'description' => esc_html__( 'Check this box to activate custom settings', 'massive-engine' ),
                    'value'       => 'false',
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => 'two'
                        )
                    ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__( 'Title Color', 'massive-engine' ),
                    'param_name'  => 'title_color',
                    'group'       => esc_html__( 'Custom Settings', 'massive-engine' ),
                    'dependency'  => array(
                        'element' => 'customize_one',
                        'value'   => 'true'
                        )
                    ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__( 'Title Hover & Active Color', 'massive-engine' ),
                    'param_name'  => 'title_actv_color',
                    'group'       => esc_html__( 'Custom Settings', 'massive-engine' ),
                    'dependency'  => array(
                        'element' => 'customize_one',
                        'value'   => 'true'
                        )
                    ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__( 'Icon Color', 'massive-engine' ),
                    'param_name'  => 'icon_color',
                    'group'       => esc_html__( 'Custom Settings', 'massive-engine' ),
                    'dependency'  => array(
                        'element' => 'customize_one',
                        'value'   => 'true'
                        )
                    ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__( 'Icon Hover & Active Color', 'massive-engine' ),
                    'param_name'  => 'icon_actv_color',
                    'group'       => esc_html__( 'Custom Settings', 'massive-engine' ),
                    'dependency'  => array(
                        'element' => 'customize_one',
                        'value'   => 'true'
                        )
                    ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__( 'Icon Background Color', 'massive-engine' ),
                    'param_name'  => 'accordion_color',
                    'group'       => esc_html__( 'Custom Settings', 'massive-engine' ),
                    'dependency'  => array(
                        'element' => 'customize_one',
                        'value'   => 'true'
                        )
                    ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__( 'Icon Background Hover & Active Color', 'massive-engine' ),
                    'param_name'  => 'accordion_actv_color',
                    'group'       => esc_html__( 'Custom Settings', 'massive-engine' ),
                    'dependency'  => array(
                        'element' => 'customize_one',
                        'value'   => 'true'
                        )
                    ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Timeline Style', 'massive-engine' ),
                    'param_name'  => 'timeline_style',
                    'group'       => esc_html__( 'Custom Settings', 'massive-engine' ),
                    'value'       => array(
                            esc_html__( 'Solid', 'massive-engine' )  => 'solid',
                            esc_html__( 'Dashed', 'massive-engine' ) => 'dashed',
                            esc_html__( 'Dotted', 'massive-engine' ) => 'dotted'
                        ),
                    'dependency'  => array(
                        'element' => 'customize_one',
                        'value'   => 'true'
                        )
                    ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__( 'Timeline Color', 'massive-engine' ),
                    'param_name'  => 'timeline_color',
                    'group'       => esc_html__( 'Custom Settings', 'massive-engine' ),
                    'dependency'  => array(
                        'element' => 'customize_one',
                        'value'   => 'true'
                        )
                    ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__( 'Content Color', 'massive-engine' ),
                    'param_name'  => 'content_color',
                    'group'       => esc_html__( 'Custom Settings', 'massive-engine' ),
                    'dependency'  => array(
                        'element' => 'customize_one',
                        'value'   => 'true'
                        )
                    ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__( 'Title Color', 'massive-engine' ),
                    'param_name'  => 'title_color_two',
                    'group'       => esc_html__( 'Custom Settings', 'massive-engine' ),
                    'dependency'  => array(
                        'element' => 'customize_two',
                        'value'   => 'true'
                        )
                    ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__( 'Title Hover & Active Color', 'massive-engine' ),
                    'param_name'  => 'title_actv_color_two',
                    'group'       => esc_html__( 'Custom Settings', 'massive-engine' ),
                    'dependency'  => array(
                        'element' => 'customize_two',
                        'value'   => 'true'
                        )
                    ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__( 'Bar Color', 'massive-engine' ),
                    'param_name'  => 'accordion_color_two',
                    'group'       => esc_html__( 'Custom Settings', 'massive-engine' ),
                    'dependency'  => array(
                        'element' => 'customize_two',
                        'value'   => 'true'
                        )
                    ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__( 'Bar Hover & Active Color', 'massive-engine' ),
                    'param_name'  => 'accordion_actv_color_two',
                    'group'       => esc_html__( 'Custom Settings', 'massive-engine' ),
                    'dependency'  => array(
                        'element' => 'customize_two',
                        'value'   => 'true'
                        )
                    ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__( 'Icon Color', 'massive-engine' ),
                    'param_name'  => 'icon_color_two',
                    'group'       => esc_html__( 'Custom Settings', 'massive-engine' ),
                    'dependency'  => array(
                        'element' => 'customize_two',
                        'value'   => 'true'
                        )
                    ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__( 'Icon Hover & Active Color', 'massive-engine' ),
                    'param_name'  => 'icon_actv_color_two',
                    'group'       => esc_html__( 'Custom Settings', 'massive-engine' ),
                    'dependency'  => array(
                        'element' => 'customize_two',
                        'value'   => 'true'
                        )
                    ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__( 'Content Color', 'massive-engine' ),
                    'param_name'  => 'content_color_two',
                    'group'       => esc_html__( 'Custom Settings', 'massive-engine' ),
                    'dependency'  => array(
                        'element' => 'customize_two',
                        'value'   => 'true'
                        )
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
            'type'                     => 'one',
            'toggle'                   => '',
            'customize_one'            => 'false',
            'customize_two'            => 'false',
            'title_color'              => '',
            'title_actv_color'         => '',
            'accordion_color'          => '',
            'accordion_actv_color'     => '',
            'timeline_style'           => '',
            'timeline_color'           => '',
            'content_color'            => '',
            'title_color_two'          => '',
            'title_actv_color_two'     => '',
            'accordion_color_two'      => '',
            'accordion_actv_color_two' => '',
            'content_color_two'        => '',
            'uid'                      => '',
            );

        $uid         = $this->get_uid( $atts );
        $atts        = shortcode_atts( $defaults, $atts );
        $atts['uid'] = $uid;
        $type        = trim( strtolower( $atts['type'] ) );
        $types       = array('one', 'two');

        $view = $this->get_view( $type );

        ob_start();
        if ( in_array( $type, $types ) && file_exists( $view ) ) {
            include( $view );
        }
        return ob_get_clean();
    }

}

new Massive_Accordions_Container;

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_Massive_Accordions_Container extends WPBakeryShortCodesContainer {
    }
}
