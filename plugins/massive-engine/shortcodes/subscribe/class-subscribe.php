<?php
/**
 * Massive subscribe shortcode
 *
 * @package Massive Engine
 * @author ThemeBucket <themebucket@gmail.com>
 */

class Massive_subscribe extends Massive_Shortcode {

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
        $styles          = massive_get_default_param( $params, 'styles' , 'gray-bg' );
        $bg              = massive_get_default_param( $params, 'bg', '#f8f8f8' );
        $title_color     = massive_get_default_param( $params, 'title_color', '#333' );
        $subtitle_color  = massive_get_default_param( $params, 'subtitle_color', '#7e7e7e' );
        $btn_text_color  = massive_get_default_param( $params, 'btn_text_color', '#fff' );
        $btn_text_hcolor = massive_get_default_param( $params, 'btn_text_hcolor', '#fff' );
        $btn_bg          = massive_get_default_param( $params, 'btn_bg', '#222' );
        $btn_hbg         = massive_get_default_param( $params, 'btn_hbg', '#d6b161' );
        $input_bg        = massive_get_default_param( $params, 'input_bg', '#fff' );
        $border          = massive_get_default_param( $params, 'border', '1px' );
        $border_color    = massive_get_default_param( $params, 'border_color' , '#ececec' );
        $border_radius   = massive_get_default_param( $params, 'border_radius' , '5px' );

        $uid           = $this->get_uid( $params );
        $white_id      = $uid . ' .bg-white-color';
        $custom_id     = $uid . ' .custom';
        $title_id      = $uid . ' .subscribe-info h4';
        $subtitle_id   = $uid . ' .subscribe-info span';
        $btn_id        = $uid . ' .mailchimp button';
        $btn_hover_id  = $uid . ' .mailchimp button:hover';
        $input_id      = $uid . ' .subscribe-form input';
        $input_focusid = $uid . ' .mailchimp input:focus';

        if ( 'gray-bg' == $styles ) {
            $tree[$input_id] = array(
                'background-color' => '#fff !important',
            );
            $tree[$input_focusid] = array(
                'border-color' => 'transparent',
            );
        } elseif ( 'bg-black-color' == $styles ) {
            $tree[$title_id] = array(
                'color' => '#fff',
            );
            $tree[$subtitle_id] = array(
                'color' => '#fff',
            );
            $tree[$btn_id] = array(
                'background-color' => '#d6b161',
            );
            $tree[$btn_hover_id] = array(
                'color' => '#333 !important',
                'background-color' => '#fff',
            );
            $tree[$input_focusid] = array(
                'border-color' => 'transparent',
            );
        } elseif ( 'bg-white-color' == $styles ) {
            $tree[$white_id] = array(
                'border' => '1px solid #ececec',
            );
            $tree[$input_id] = array(
                'background-color' => '#f8f8f8',
            );
            $tree[$input_focusid] = array(
                'border-color' => 'transparent',
            );
        } elseif ( 'bg-theme-color' == $styles ) {
            $tree[$title_id] = array(
                'color' => '#fff',
            );
            $tree[$subtitle_id] = array(
                'color' => '#fff',
            );
            $tree[$btn_hover_id] = array(
                'background-color' => '#fff',
                'color'            => '#000'
            );
            $tree[$input_focusid] = array(
                'border-color' => 'transparent',
            );
        } elseif ( 'custom' == $styles ) {
            $tree[$custom_id] = array(
                'background-color' => $bg ,
                'border-width'     => massive_check_css_unit( $border ),
                'border-style'     => 'solid',
                'border-color'     => $border_color ,
                'border-radius'    => massive_check_css_unit( $border_radius )
            );
            $tree[$title_id] = array(
                'color' => $title_color ,
            );
            $tree[$subtitle_id] = array(
                'color' => $subtitle_color ,
            );
            $tree[$btn_id] = array(
                'color'            => $btn_text_color,
                'background-color' => $btn_bg ,
            );
            $tree[$btn_hover_id] = array(
                'color'            => $btn_text_hcolor,
                'background-color' => $btn_hbg
            );
            $tree[$input_id] = array(
                'background-color' => $input_bg . '!important',
            );
            $tree[$input_focusid] = array(
                'border-color' => 'transparent',
            );
        } else{
            $tree[$input_id] = array(
                'background-color' => '#fff !important',
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
            'name'     => __( 'Subscribe', 'massive-engine' ),
            'base'     => $this->get_tag(),
            'category' => __( 'Massive', 'massive-engine' ),
            'icon'     => $this->get_icon('subscribe'),
            'params'   => array(
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Subscribe Style', 'massive-engine' ),
                    'param_name'  => 'styles',
                    'admin_label' => true,
                    'value'       => array(
                            esc_html__( 'Gray'       , 'massive-engine' ) => 'gray-bg',
                            esc_html__( 'White'      , 'massive-engine' ) => 'bg-white-color',
                            esc_html__( 'Black'      , 'massive-engine' ) => 'bg-black-color',
                            esc_html__( 'Theme Color', 'massive-engine' ) => 'bg-theme-color',
                            esc_html__( 'Custom'     , 'massive-engine' ) => 'custom'
                        ),
                    ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Layout', 'massive-engine' ),
                    'param_name'  => 'type',
                    'admin_label' => true,
                    'value'       => array(
                        esc_html__( 'Box'      , 'massive-engine' ) => 'box',
                        esc_html__( 'Fullwidth', 'massive-engine' ) => 'fullwidth'
                        ),
                    ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Alignment', 'massive-engine' ),
                    'param_name'  => 'alignment',
                    'admin_label' => true,
                    'value'       => array(
                            esc_html__( 'Left'  , 'massive-engine' ) => 'text-left',
                            esc_html__( 'Center', 'massive-engine' ) => 'text-center'
                        )
                    ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Title', 'massive-engine' ),
                    'param_name'  => 'title',
                    'value'       => esc_html__( 'SUBSCRIBE TO GET IN TOUCH', 'massive-engine' )
                    ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Subtitle', 'massive-engine' ),
                    'param_name'  => 'subtitle',
                    'value'       => esc_html__( 'Connecting ideas and people, how talk can change our lives', 'massive-engine' )
                    ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Mailchimp URL', 'massive-engine' ),
                    'param_name'  => 'mailchimp',
                    'description' => esc_html__( 'Enter mailchimp url.', 'massive-engine'),
                    'value'       => ''
                    ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Placeholder Text', 'massive-engine' ),
                    'param_name'  => 'placeholder',
                    'value'       => esc_html__( 'Enter your email address', 'massive-engine' )
                    ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Button Text', 'massive-engine' ),
                    'param_name'  => 'btn_text',
                    'value'       => esc_html__( 'Subscribe', 'massive-engine' )
                    ),
                array(
                    'type'       => 'dropdown',
                    'heading'    => esc_html__( 'Button Shape', 'massive-engine' ),
                    'param_name' => 'shape',
                    'std'        => 'rect',
                    'value'      => array(
                        esc_html__( 'Rectangular', 'massive-engine' ) => 'rect',
                        esc_html__( 'Rounded', 'massive-engine' )     => 'rounded',
                        esc_html__( 'Capsule', 'massive-engine' )     => 'capsule',
                        ),
                    ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__( 'Background Color', 'massive-engine' ),
                    'param_name'  => 'bg',
                    'group'       => 'Custom Settings',
                    'dependency'  => array(
                        'element' => 'styles',
                        'value'   => 'custom'
                        )
                    ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__( 'Title Color', 'massive-engine' ),
                    'param_name'  => 'title_color',
                    'group'       => 'Custom Settings',
                    'std'         => '#333',
                    'value'       => '#333',
                    'dependency'  => array(
                        'element' => 'styles',
                        'value'   => 'custom'
                        )
                    ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__( 'Subtitle Color', 'massive-engine' ),
                    'param_name'  => 'subtitle_color',
                    'group'       => 'Custom Settings',
                    'std'         => '#7e7e7e',
                    'value'       => '#7e7e7e',
                    'dependency'  => array(
                        'element' => 'styles',
                        'value'   => 'custom'
                        )
                    ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__( 'Input Field Background Color', 'massive-engine' ),
                    'param_name'  => 'input_bg',
                    'group'       => 'Custom Settings',
                    'std'         => '#fff',
                    'value'       => '#fff',
                    'dependency'  => array(
                        'element' => 'styles',
                        'value'   => 'custom'
                        )
                    ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__( 'Button Text Color', 'massive-engine' ),
                    'param_name'  => 'btn_text_color',
                    'group'       => 'Custom Settings',
                    'std'         => '#fff',
                    'value'       => '#fff',
                    'dependency'  => array(
                        'element' => 'styles',
                        'value'   => 'custom'
                        )
                    ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__( 'Button Text Hover Color', 'massive-engine' ),
                    'param_name'  => 'btn_text_hcolor',
                    'group'       => 'Custom Settings',
                    'std'         => '#fff',
                    'value'       => '#fff',
                    'dependency'  => array(
                        'element' => 'styles',
                        'value'   => 'custom'
                        )
                    ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__( 'Button Background Color', 'massive-engine' ),
                    'param_name'  => 'btn_bg',
                    'group'       => 'Custom Settings',
                    'std'         => '#000',
                    'value'       => '#000',
                    'dependency'  => array(
                        'element' => 'styles',
                        'value'   => 'custom'
                        )
                    ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__( 'Button Background Hover Color', 'massive-engine' ),
                    'param_name'  => 'btn_hbg',
                    'group'       => 'Custom Settings',
                    'std'         => '#d6b161',
                    'value'       => '#d6b161',
                    'dependency'  => array(
                        'element' => 'styles',
                        'value'   => 'custom'
                        )
                    ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Border Size', 'massive-engine' ),
                    'param_name'  => 'border',
                    'group'       => 'Custom Settings',
                    'std'         => '1px',
                    'value'       => '1px',
                    'dependency'  => array(
                        'element' => 'styles',
                        'value'   => 'custom'
                        )
                    ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__( 'Border Color', 'massive-engine' ),
                    'param_name'  => 'border_color',
                    'group'       => 'Custom Settings',
                    'std'         => '#ececec',
                    'value'       => '#ececec',
                    'dependency'  => array(
                        'element' => 'styles',
                        'value'   => 'custom'
                        )
                    ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Subscribe Box Radius', 'massive-engine' ),
                    'param_name'  => 'border_radius',
                    'group'       => 'Custom Settings',
                    'value'       => '5 px',
                    'dependency'  => array(
                        'element' => 'styles',
                        'value'   => 'custom'
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
            'styles'          => 'gray-bg',
            'type'            => 'box',
            'alignment'       => 'left',
            'title'           => esc_html__( 'SUBSCRIBE TO GET IN TOUCH', 'massive-engine' ),
            'subtitle'        => esc_html__( 'Connecting ideas and people, how talk can change our lives' , 'massive-engine' ),
            'placeholder'     => esc_html__( 'Enter your email address', 'massive-engine' ),
            'mailchimp'       => '',
            'btn_text'        => esc_html__( 'Subscribe', 'massive-engine' ),
            'bg'              => '#f8f8f8',
            'title_color'     => '#333',
            'subtitle_color'  => '#7e7e7e',
            'input_bg'        => '#fff',
            'btn_text_color'  => '#fff',
            'btn_text_hcolor' => '#fff',
            'btn_bg'          => '#222',
            'btn_hbg'         => '#d6b161',
            'shape'           => 'rect',
            'border'          => '1px',
            'border_color'    => '#ececec',
            'border_radius'   => '5 px',
            'uid'             => '',
            );

        $uid         = $this->get_uid( $atts ); //this line must be here after $defaults, before calling shortcode_atts
        $atts        = shortcode_atts( $defaults, $atts );
        $atts['uid'] = $uid;
        $shape       = massive_sanitize_param( $atts['shape'] );
        $type        = massive_sanitize_param( $atts['type'] );
        $types       = array(
            'box',
            'fullwidth',
            );
        
        $subscribe_class = $atts['styles'] . ' ' . $atts['alignment'];
        $subscribe_class .= ( 'bg-white-color' === $atts['styles'] ) ? ' border-box' : '';
        $btn_shape_class = '';

        if ( 'rounded' == $shape ) {
            $btn_shape_class .= 'btn-rounded';
        } elseif ( 'capsule' == $shape ) {
            $btn_shape_class .= 'btn-circle';
        }

        $view = $this->get_view( $type );

        ob_start();
        if ( in_array( $type, $types ) && file_exists( $view ) ) {
            include( $view );
        }
        return ob_get_clean();
    }

}

new Massive_subscribe;
