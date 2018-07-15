<?php
/**
 * Massive page title shortcode
 *
 * @package Massive Engine
 * @author ThemeBucket <themebucket@gmail.com>
 */

class Massive_Page_Title extends Massive_Shortcode {

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
        $tree                  = array();
        $type                  = massive_get_default_param( $params, 'type', 'default' );
        $title_color           = massive_get_default_param( $params, 'title_color' );
        $subtitle_color        = massive_get_default_param( $params, 'subtitle_color' );
        $breadcrumb_color      = massive_get_default_param( $params, 'breadcrumb_color' );
        $breadcrumb_actv_color = massive_get_default_param( $params, 'breadcrumb_actv_color' );
        $padding               = massive_get_default_param( $params, 'padding', '200px 0' );
        $bg                    = massive_get_default_param( $params, 'bg', 'image' );
        $bg_image              = massive_get_default_param( $params, 'bg_image' );
        $bg_prop               = massive_get_default_param( $params, 'bg_prop', 'cover' );
        $bg_attachment         = massive_get_default_param( $params, 'bg_attachment', 'scroll' );
        $bg_color              = massive_get_default_param( $params, 'bg_color', '#F5F5F5' );

        $image_attributes      = wp_get_attachment_image_src( $bg_image, 'large' );

        $uid                   = $this->get_uid( $params );
        $title_id              = $uid . ' h4';
        $subtitle_id           = $uid . ' span';
        $breadcrumb_id         = $uid . ' .breadcrumb li  a';
        $breadcrumb_actv_id    = $uid . ' .breadcrumb .active';

        if ( 'custom' == $type ) {
            $tree[$title_id] = array(
                'color'            => $title_color,
            );
            $tree[$subtitle_id] = array(
                'color'            => $subtitle_color,
            );
            $tree[$breadcrumb_id] = array(
                'color'            => $breadcrumb_color,
            );
            $tree[$breadcrumb_actv_id] = array(
                'color'            => $breadcrumb_actv_color,
            );

            if ( 'image' == $bg ) {
                if ( 'cover' == $bg_prop ) {
                    $tree[$uid] = array(
                        'background-image'      => 'url(' .esc_url($image_attributes[0]). ') !important' ,
                        'background-attachment' => $bg_attachment . ' !important',
                        'padding'               => massive_check_css_unit( $padding ) . ' 0 !important',
                        'background-position'   => 'center !important',
                        'background-repeat'     => 'no-repeat !important',
                        'background-size'       => 'cover !important',
                    );
                }elseif( 'contain' == $bg_prop ){
                    $tree[$uid] = array(
                        'background-image'      => 'url(' .esc_url($image_attributes[0]). ') !important' ,
                        'background-attachment' => $bg_attachment . ' !important',
                        'padding'               => massive_check_css_unit( $padding ) . ' 0 !important',
                        'background-position'   => 'center !important',
                        'background-repeat'     => 'no-repeat !important',
                        'background-size'       => 'contain !important',
                    );
                }elseif( 'repeat' == $bg_prop ){
                    $tree[$uid] = array(
                        'background-image'      => 'url(' .esc_url($image_attributes[0]). ') !important' ,
                        'background-attachment' => $bg_attachment . ' !important',
                        'padding'               => massive_check_css_unit( $padding ) . ' 0 !important',
                        'background-position'   => '0 0 !important',
                        'background-repeat'     => 'repeat !important',
                        'background-size'       => 'inherit !important',
                    );
                }elseif( 'no-repeat' == $bg_prop ){
                    $tree[$uid] = array(
                        'background-image'      => 'url(' .esc_url($image_attributes[0]). ') !important' ,
                        'background-attachment' => $bg_attachment . ' !important',
                        'padding'               => massive_check_css_unit( $padding ) . ' 0 !important',
                        'background-position'   => '0 0 !important',
                        'background-repeat'     => 'no-repeat !important',
                        'background-size'       => 'inherit !important',
                    );
                }
            }elseif  ( 'color' == $bg ) {
                $tree[$uid] = array(
                    'background-color'      => $bg_color,
                    'padding'               => massive_check_css_unit( $padding ) . ' 0 !important',
                );
            }
        }

        return $tree;
    }

    /**
     * Map this shortcode with visual composer
     * @return array
     */
    protected function map() {
        return array(
            'name'     => esc_html__( 'Page Title', 'massive-engine' ),
            'base'     => $this->get_tag(),
            'category' => esc_html__( 'Massive', 'massive-engine' ),
            'icon'     => $this->get_icon('page-title'),
            'params'   => array(
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Page Title Style', 'massive-engine' ),
                    'param_name'  => 'type',
                    'description' => esc_html__( 'Chose page title style', 'massive-engine' ),
                    'value'       => array(
                            esc_html__( 'Default', 'massive-engine' ) => 'default',
                            esc_html__( 'Custom', 'massive-engine' )  => 'custom'
                        ),
                    ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Title', 'massive-engine' ),
                    'admin_label' => true,
                    'param_name'  => 'title',
                    ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Subtitle', 'massive-engine' ),
                    'admin_label' => true,
                    'param_name'  => 'subtitle',
                    ),
                array(
                    'type'        => 'checkbox',
                    'heading'     => esc_html__( 'Breadcrumb', 'massive-engine' ),
                    'param_name'  => 'breadcrumb',
                    'std'         => 'true'
                    ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Alignment', 'massive-engine' ),
                    'param_name'  => 'alignment',
                    'value'       => array(
                            esc_html__( 'Left', 'massive-engine' )   => 'page-title-left',
                            esc_html__( 'Right', 'massive-engine' )  => 'page-title-right',
                            esc_html__( 'Center', 'massive-engine' ) => 'page-title-center',
                        )
                    ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Page Title Size', 'massive-engine' ),
                    'param_name'  => 'title_size',
                    'value' => array(
                            esc_html__( 'Default', 'massive-engine' ) => 'normal-title',
                            esc_html__( 'Mini', 'massive-engine' )    => 'mini-title',
                        ),
                    'dependency'  => array(
                            'element' => 'type',
                            'value'   => 'default'
                        )
                    ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__( 'Title Color', 'massive-engine' ),
                    'param_name'  => 'title_color',
                    'group'       => esc_html__( 'Custom Settings', 'massive-engine'),
                    'dependency'  => array(
                            'element' => 'type',
                            'value'   => 'custom'
                        )
                    ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__( 'Subtitle Color', 'massive-engine' ),
                    'param_name'  => 'subtitle_color',
                    'group'       => esc_html__( 'Custom Settings', 'massive-engine'),
                    'dependency'  => array(
                            'element' => 'type',
                            'value'   => 'custom'
                        )
                    ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__( 'Breadcrumb Color', 'massive-engine' ),
                    'param_name'  => 'breadcrumb_color',
                    'group'       => esc_html__( 'Custom Settings', 'massive-engine'),
                    'dependency'  => array(
                            'element' => 'type',
                            'value'   => 'custom'
                        )
                    ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__( 'Breadcrumb Active Color', 'massive-engine' ),
                    'param_name'  => 'breadcrumb_actv_color',
                    'group'       => esc_html__( 'Custom Settings', 'massive-engine'),
                    'dependency'  => array(
                            'element' => 'type',
                            'value'   => 'custom'
                        )
                    ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Title Padding', 'massive-engine' ),
                    'param_name'  => 'padding',
                    'group'       => esc_html__( 'Custom Settings', 'massive-engine'),
                    'value'       => '200px',
                    'dependency'  => array(
                            'element' => 'type',
                            'value'   => 'custom'
                        )
                    ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Background Type', 'massive-engine' ),
                    'param_name'  => 'bg',
                    'group'       => esc_html__( 'Custom Settings', 'massive-engine'),
                    'value'       => array(
                            esc_html__( 'Image', 'massive-engine' ) => 'image',
                            esc_html__( 'Color', 'massive-engine' ) => 'color'
                        ),
                    'dependency'  => array(
                            'element' => 'type',
                            'value'   => 'custom'
                        ),
                    ),
                array(
                    'type'        => 'attach_image',
                    'heading'     => esc_html__( 'Background Image', 'massive-engine' ),
                    'param_name'  => 'bg_image',
                    'group'       => esc_html__( 'Custom Settings', 'massive-engine'),
                    'dependency'  => array(
                            'element' => 'bg',
                            'value'   => 'image'
                        )
                    ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Background Property', 'massive-engine' ),
                    'param_name'  => 'bg_prop',
                    'group'       => esc_html__( 'Custom Settings', 'massive-engine' ),
                    'value'       => array(
                            esc_html__( 'Cover'   , 'massive-engine' )  => 'cover',
                            esc_html__( 'Contain' , 'massive-engine' )  => 'contain',
                            esc_html__( 'Repeat' , 'massive-engine' )   => 'repeat',
                            esc_html__( 'No Repeat', 'massive-engine' ) => 'no-repeat'
                        ),
                    'dependency'  => array(
                        'element' => 'bg',
                        'value'   => 'image'
                        )
                    ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Background Attachment', 'massive-engine' ),
                    'param_name'  => 'bg_attachment',
                    'group'       => esc_html__( 'Custom Settings', 'massive-engine' ),
                    'value'       => array(
                            esc_html__( 'Scroll', 'massive-engine' ) => 'scroll',
                            esc_html__( 'Fixed' , 'massive-engine' ) => 'fixed'
                        ),
                    'dependency'  => array(
                        'element' => 'bg',
                        'value'   => 'image'
                        )
                    ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__( 'Background Color', 'massive-engine' ),
                    'param_name'  => 'bg_color',
                    'group'       => esc_html__( 'Custom Settings', 'massive-engine' ),
                    'dependency'  => array(
                        'element' => 'bg',
                        'value'   => 'color'
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
            'type'           => 'default',
            'title'          => '',
            'subtitle'       => '',
            'breadcrumb'     => 'true',
            'alignment'      => '',
            'title_size'     => '',
            'title_color'    => '',
            'subtitle_color' => '',
            'padding'        => '200px',
            'bg'             => '',
            'bg_image'       => '',
            'bg_prop'        => '',
            'bg_size'        => '',
            'bg_attachment'  => '',
            'bg_color'       => '',
            'uid'            => '',
        );

        $uid         = $this->get_uid( $atts );
        $atts        = shortcode_atts( $defaults, $atts );
        $atts['uid'] = $uid;
        $type        = massive_sanitize_param( $atts['type'] );
        $types       = array('default', 'custom');

        $view = $this->get_view( $type );

        ob_start();
        if ( in_array( $type, $types ) && file_exists( $view ) ) {
            include( $view );
        }
        return ob_get_clean();
    }

}

new Massive_Page_Title;
