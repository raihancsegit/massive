<?php
/**
 * Massive promo box shortcode
 *
 * @package Massive Engine
 * @author ThemeBucket <themebucket@gmail.com>
 */

class Massive_promo_box extends Massive_Shortcode {

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

        $type             = massive_get_default_param( $params, 'type', 'gray-bg' );
        $bg_color         = massive_get_default_param( $params, 'bg_cstm_clr' );
        $title_color      = massive_get_default_param( $params, 'title_color' );
        $sub_title_color  = massive_get_default_param( $params, 'sub_title_color' );
        $btn_text_color   = massive_get_default_param( $params, 'btn_text_color' );
        $btn_color        = massive_get_default_param( $params, 'btn_bg_color' );
        $btn_text_hvr     = massive_get_default_param( $params, 'btn_text_hclr' );
        $btn_hvr          = massive_get_default_param( $params, 'btn_bg_hclr' );
        $border           = massive_get_default_param( $params, 'border' );
        $border_color     = massive_get_default_param( $params, 'border_color', 'transparetn' );
        $bg               = massive_get_default_param( $params, 'bg', 'promo-parallax' );
        $bg_image         = massive_get_default_param( $params, 'bg_image' );
        $bg_repeat        = massive_get_default_param( $params, 'bg_repeat', 'repeat' );
        $bg_attachment    = massive_get_default_param( $params, 'bg_attachment', 'scroll' );
        $bg_size          = massive_get_default_param( $params, 'bg_size', 'inherit' );

        $attachment_id    = $bg_image;
        $image_attributes = wp_get_attachment_image_src( $attachment_id, 'large' );

        $uid              = $this->get_uid( $params );
        $bgid             = $uid . ' div.promo-box ';
        $title_id         = $uid . ' h3';
        $sub_title_id     = $uid . ' span.promobox-subtitle';
        $btn_text_id      = $uid . ' a';
        $btn_hvr_id       = $uid . ' a:hover';

        if ( 'custom-bg' == $type ) {

            $tree[$title_id] = array(
                'color' => $title_color . ' !important',
            );
            $tree[$sub_title_id] = array(
                'color' => $sub_title_color . ' !important',
            );
            $tree[$btn_hvr_id] = array(
                'color'            => $btn_text_hvr . ' !important',
                'background-color' => $btn_hvr . ' !important',
            );
            $tree[$btn_text_id] = array(
                'color'            => $btn_text_color . ' !important',
                'background-color' => $btn_color . ' !important',
            );

            if ( 'promo-parallax' == $bg )  {
                $tree[$bgid] = array(
                    'border-color'          => $border_color . ' !important',
                    'background-image'      => 'url(' .esc_url($image_attributes[0]). ')' ,
                    'background-repeat'     => $bg_repeat . ' !important',
                    'background-attachment' => $bg_attachment . ' !important',
                    'background-size'       => $bg_size . ' !important',
                    'height'                => 'auto' ,
                );
            }
            if ( 'bg_color' == $bg ) {
                $tree[$bgid] = array(
                    'border'           => '1px solid ' . $border_color ,
                    'background-color' => $bg_color . ' !important',
                );
            }
        }

        return $tree;
    }

    /**
     * Map this shortcode with visual composer
     * @return void
     */
    protected function map() {
        return array(
            'name'     => esc_html__( 'Promo Box', 'massive-engine' ),
            'base'     => $this->get_tag(),
            'category' => esc_html__( 'Massive', 'massive-engine' ),
            'icon'     => $this->get_icon('promo-box'),
            'params'   => array(
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Promo Style', 'massive-engine' ),
                    'param_name'  => 'type',
                    'admin_label' => true,
                    'value'       => array(
                            esc_html__( 'Gray'      , 'massive-engine' )  => 'gray-bg',
                            esc_html__( 'Thame Color', 'massive-engine' ) => 'theme-bg',
                            esc_html__( 'Black', 'massive-engine' )       => 'dark-bg',
                            esc_html__( 'White', 'massive-engine' )       => 'white-bg',
                            esc_html__( 'Custom', 'massive-engine' )      => 'custom-bg',
                        )
                    ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Layout', 'massive-engine' ),
                    'param_name'  => 'layout',
                    'admin_label' => true,
                    'value'       => array(
                            esc_html__( 'Box'      , 'massive-engine' ) => 'boxed',
                            esc_html__( 'Fullwidth', 'massive-engine' ) => 'full-width',
                        ),
                    ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Alignment', 'massive-engine' ),
                    'param_name'  => 'alignment',
                    'description' => esc_html__( 'Chose promo box content alignment', 'massive-engine' ),
                    'value'       => array(
                            esc_html__( 'Center', 'massive-engine' ) => 'text-center',
                            esc_html__( 'Left'  , 'massive-engine' ) => 'text-left',
                        )
                    ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Title', 'massive-engine' ),
                    'param_name'  => 'content',
                    'description' => esc_html__( 'Promo box title comes here', 'massive-engine' ),
                    'admin_label' => true,
                    'value'       => esc_html__( 'START BUILDING YOUR PROJECT WITH MASSIVE', 'massive-engine')
                    ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Subtitle', 'massive-engine' ),
                    'param_name'  => 'subtitle',
                    'description' => esc_html__( 'Promo box subtitle comes here', 'massive-engine' ),
                    'value'       => esc_html__( 'ARE YOU IMPRESSED WITH OUR CREATIVE WORK?', 'massive-engine')
                    ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Button Text', 'massive-engine' ),
                    'param_name'  => 'btn_text',
                    'value'       => esc_html__( 'Purchase Now', 'massive-engine')
                    ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Button Link', 'massive-engine' ),
                    'param_name'  => 'btn_link',
                    'description' => esc_html__( 'Button link comes here.', 'massive-engine' ),
                    ),
                array(
                    'type'       => 'dropdown',
                    'heading'    => esc_html__( 'Button Shape', 'massive-engine' ),
                    'param_name' => 'shape',
                    'std'        => 'rect',
                    'value'      => array(
                        'Rectangular' => 'rect',
                        'Rounded'     => 'rounded',
                        'Capsule'     => 'capsule',
                        ),
                    ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__( 'Title Color', 'massive-engine' ),
                    'param_name'  => 'title_color',
                    'group'       => esc_html__( 'Custom Settings', 'massive-engine' ),
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => 'custom-bg',
                        )
                    ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__( 'Subtitle Color', 'massive-engine' ),
                    'param_name'  => 'sub_title_color',
                    'group'       => esc_html__( 'Custom Settings', 'massive-engine' ),
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => 'custom-bg',
                        )
                    ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__( 'Button Text Color', 'massive-engine' ),
                    'param_name'  => 'btn_text_color',
                    'group'       => esc_html__( 'Custom Settings', 'massive-engine' ),
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => 'custom-bg',
                        )
                    ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__( 'Button Text Hover Color', 'massive-engine' ),
                    'param_name'  => 'btn_text_hclr',
                    'group'       => esc_html__( 'Custom Settings', 'massive-engine' ),
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => 'custom-bg',
                        )
                    ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__( 'Button Background Color', 'massive-engine' ),
                    'param_name'  => 'btn_bg_color',
                    'group'       => esc_html__( 'Custom Settings', 'massive-engine' ),
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => 'custom-bg',
                        )
                    ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__( 'Button Hover Background Color', 'massive-engine' ),
                    'param_name'  => 'btn_bg_hclr',
                    'group'       => esc_html__( 'Custom Settings', 'massive-engine' ),
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => 'custom-bg',
                        )
                    ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Promo Background Type', 'massive-engine' ),
                    'param_name'  => 'bg',
                    'description' => esc_html__( 'Chose promo box background type', 'massive-engine' ),
                    'group'       => esc_html__( 'Custom Settings', 'massive-engine' ),
                    'value'       => array(
                            esc_html__( 'Image', 'massive-engine' ) => 'promo-parallax',
                            esc_html__( 'Color', 'massive-engine' ) => 'bg_color'
                        ),
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => 'custom-bg',
                        )
                    ),
                array(
                    'type'        => 'attach_image',
                    'heading'     => esc_html__( 'Upload Background Image', 'massive-engine' ),
                    'param_name'  => 'bg_image',
                    'description' => esc_html__( 'Upload your promo background image', 'massive-engine' ),
                    'group'       => esc_html__( 'Custom Settings', 'massive-engine' ),
                    'dependency'  => array(
                        'element' => 'bg',
                        'value'   => 'promo-parallax'
                        )
                    ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Background Repeat', 'massive-engine' ),
                    'param_name'  => 'bg_repeat',
                    'description' => esc_html__( 'Select background repeat property', 'massive-engine' ),
                    'group'       => esc_html__( 'Custom Settings', 'massive-engine' ),
                    'value'       => array(
                            esc_html__( 'Repeat'   , 'massive-engine' ) => 'repeat',
                            esc_html__( 'Repeat X' , 'massive-engine' ) => 'repeat-x',
                            esc_html__( 'Repeat Y' , 'massive-engine' ) => 'repeat-y',
                            esc_html__( 'No-repeat', 'massive-engine' ) => 'no-repeat'
                        ),
                    'dependency'  => array(
                        'element' => 'bg',
                        'value'   => 'promo-parallax'
                        )
                    ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Background Size', 'massive-engine' ),
                    'param_name'  => 'bg_size',
                    'description' => esc_html__( 'Select background size property', 'massive-engine' ),
                    'group'       => esc_html__( 'Custom Settings', 'massive-engine' ),
                    'value'       => array(
                            esc_html__( 'Inherit'  , 'massive-engine' ) => 'inherit',
                            esc_html__( 'Cover'  , 'massive-engine' )   => 'cover',
                            esc_html__( 'Contain', 'massive-engine' )   => 'contain'
                        ),
                    'dependency'  => array(
                        'element' => 'bg',
                        'value'   => 'promo-parallax'
                        )
                    ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Background Attachment', 'massive-engine' ),
                    'param_name'  => 'bg_attachment',
                    'description' => esc_html__( 'Select background attachment property', 'massive-engine' ),
                    'group'       => esc_html__( 'Custom Settings', 'massive-engine' ),
                    'value'       => array(
                            esc_html__( 'Scroll', 'massive-engine' ) => 'scroll',
                            esc_html__( 'Fixed' , 'massive-engine' ) => 'fixed'
                        ),
                    'dependency'  => array(
                        'element' => 'bg',
                        'value'   => 'promo-parallax'
                        )
                    ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__( 'Background Color', 'massive-engine' ),
                    'param_name'  => 'bg_cstm_clr',
                    'group'       => esc_html__( 'Custom Settings', 'massive-engine' ),
                    'dependency'  => array(
                        'element' => 'bg',
                        'value'   => 'bg_color',
                        )
                    ),
                array(
                    'type'        => 'checkbox',
                    'heading'     => esc_html__( 'Border Box', 'massive-engine' ),
                    'param_name'  => 'border',
                    'description' => esc_html__( 'Set border on promo box', 'massive-engine' ),
                    'group'       => esc_html__( 'Custom Settings', 'massive-engine' ),
                    'std'         => 'true',
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => 'custom-bg',
                        )
                    ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__( 'Border Color', 'massive-engine' ),
                    'param_name'  => 'border_color',
                    'group'       => esc_html__( 'Custom Settings', 'massive-engine' ),
                    'dependency'  => array(
                        'element' => 'border',
                        'value'   => 'true',
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
            'type'              => 'gray-bg',
            'layout'            => 'boxed',
            'content'           => esc_html__( 'START BUILDING YOUR PROJECT WITH MASSIVE', 'massive-engine' ),
            'subtitle'          => esc_html__( 'ARE YOU IMPRESSED WITH OUR CREATIVE WORK?', 'massive-engine' ),
            'title_color'       => '',
            'sub_title_color'   => '',
            'btn_text'          => esc_html__( 'Purchase Now', 'massive-engine' ),
            'btn_link'          => '',
            'shape'             => 'rect',
            'btn_text_color'    => '',
            'btn_color'         => '',
            'border'            => 'true',
            'border_color'      => '#000',
            'alignment'         => 'text-center',
            'bg'                => 'promo-parallax',
            'bg_color'          => '',
            'bg_image'          => '',
            'bg_repeat'         => 'repeat',
            'bg_attachment'     => 'scroll',
            'bg_size'           => 'inherit',
            'bg_cstm_clr'       => '',
            'uid'               => '',
            );

        $uid         = $this->get_uid( $atts ); //this line must be here after $defaults, before calling shortcode_atts
        $atts        = shortcode_atts( $defaults, $atts );
        $atts['uid'] = $uid;
        $type        = massive_sanitize_param( $atts['type'] );
        $alignment   = esc_attr( $atts['alignment'] );
        $shape       = massive_sanitize_param( $atts['shape'] );
        $types       = array(
            'gray-bg',
            'theme-bg',
            'dark-bg',
            'white-bg',
            'custom-bg'
            );

        $title_classes    = array();
        $subtitle_classes = array();
        $bg_classes       = array();
        $btn_text_classes = array();
        $btn_classes      = array();
        $btn_shape_class  = '';

        if ( 'rounded' == $shape ) {
            $btn_shape_class .= 'btn-rounded';
        } elseif ( 'capsule' == $shape ) {
            $btn_shape_class .= 'btn-circle';
        }

        $view = $this->get_view( $type );

        ob_start();
        if ( in_array( $type, $types ) && file_exists( $view )  ) {
            include( $view );
        }
        return ob_get_clean();
    }

}

new Massive_promo_box;
