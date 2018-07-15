<?php
/**
 * Massive featuredbox shortcode
 *
 * @package Massive Engine
 * @author ThemeBucket <themebucket@gmail.com>
 */

class Massive_FeaturedBox extends Massive_Shortcode {

    /**
     * Set shortcode directory
     * @return string Directory path
     */
    protected function set_dir() {
        return __DIR__;
    }

    /**
     * Map shortcode dynamic styles
     *
     * @param  array $params
     * @return string
     */
    public function map_dynamic_styles( $params ) {
        $tree              = array();
        $type              = massive_get_default_param( $params, 'type' );
        $has_custom        = massive_get_default_param( $params, 'custom_color' );
        $custom_bg_color   = massive_get_default_param( $params, 'custom_bg_color', '' );
        $custom_icon_color = massive_get_default_param( $params, 'custom_icon_color', '' );
        $custom_text_color = massive_get_default_param( $params, 'custom_text_color', '' );
        $custom_padding    = massive_get_default_param( $params, 'custom_padding', '' );
        $uid               = $this->get_uid( $params );

        if ( 'true' == $has_custom ) {
            $tree[ $uid ] = array(
                'background-color' => $custom_bg_color,
                'padding'          => $custom_padding,
            );

            $tree[ $uid . " .icon i" ] = array(
                'color' => $custom_icon_color,
            );

            $tree[ $uid . " .fun-info span" ] = array(
                'color' => $custom_icon_color,
            );

            $tree[ $uid . " .fun-info h1" ] = array(
                'color' => $custom_text_color,
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
            'name'     => esc_html__( 'Featured Box', 'massive-engine' ),
            'base'     => $this->get_tag(),
            'category' => 'Massive',
            'icon'     => $this->get_icon('feature-box'),
            'params'   => array(
                array(
                    'type'        => 'gdropdown',
                    'heading'     => esc_html__( 'Display Type', 'massive-engine' ),
                    'param_name'  => 'type',
                    'admin_label' => true,
                    'options'     => array(
                        "Bordered Style" => array(
                            esc_html__( 'Boxed with icon in the center', 'massive-engine' ) => 'bordericoncenter',
                            esc_html__( 'Boxed with icon on the edge', 'massive-engine' )   => 'bordericonleft',
                        ),
                        "No Border"      => array(
                            esc_html__( 'Vertical Dark', 'massive-engine' )             => 'verticaldark',
                            esc_html__( 'Vertical Light', 'massive-engine' )            => 'verticallight',
                            esc_html__( 'Icon on the left Dark', 'massive-engine' )     => 'iconleftdark',
                            esc_html__( 'Icon on the left Light', 'massive-engine' )    => 'iconleftlight',
                            esc_html__( 'Circle Icon on the Center', 'massive-engine' ) => 'circleiconcenterdark',
                            esc_html__( 'Boxed', 'massive-engine' )                     => 'boxed',
                        )
                    ),
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Alignment', 'massive-engine' ),
                    'param_name'  => 'alignment',
                    'admin_label' => true,
                    'value'     => array(
                        esc_html__( 'Left', 'massive-engine' )   => 'text-left',
                        esc_html__( 'Right', 'massive-engine' )  => 'text-right',
                        esc_html__( 'Center', 'massive-engine' ) => 'text-center',
                    ),
                    'dependency'=>array(
                        'element'=>'type',
                        'value'=>array('verticaldark','verticallight')
                    )
                ),
                array(
                    'type'       => 'checkbox',
                    'heading'    => esc_html__( 'Icon Bottom Border', 'massive-engine' ),
                    'param_name' => 'icon_bottom_border',
                    'dependency' => array(
                        'element' => 'type',
                        'value'   => array('verticaldark','verticallight')
                    )
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Title', 'massive-engine' ),
                    'param_name'  => 'title',
                    'admin_label' => true,
                ),
                array(
                    'type'       => 'textarea_html',
                    'heading'    => esc_html__( 'Content', 'massive-engine' ),
                    'param_name' => 'content',
                ),
                array(
                    'type'       => 'dropdown',
                    'heading'    => esc_html__( 'Artwork Type', 'massive-engine' ),
                    'param_name' => 'artwork',
                    'value'     => array(
                        esc_html__( 'Icon', 'massive-engine' )   => 'icon',
                        esc_html__( 'Image', 'massive-engine' )  => 'image',
                    ),
                ),
                array(
                    'type'        => 'iconpicker',
                    'heading'     => esc_html__( 'Icon', 'massive-engine' ),
                    'param_name'  => 'icon',
                    'settings'    => array(
                        'emptyIcon' => false,
                        'type'      => 'tb_icons',
                    ),
                    'dependency'  => array(
                        'element' => 'artwork',
                        'value'   => array('icon')
                    ),
                    'description' => esc_html__( 'Select an icon from the Font Awesome library.', 'massive-engine' ),
                ),
                array(
                    'type'       => 'attach_image',
                    'heading'    => esc_html__( 'Image', 'massive-engine' ),
                    'param_name' => 'image',
                    'dependency'  => array(
                        'element' => 'artwork',
                        'value'   => array('image')
                    ),
                ),
                array(
                    'type'       => 'checkbox',
                    'heading'    => esc_html__( 'Customize', 'massive-engine' ),
                    'param_name' => 'custom_color',
                ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__( 'Background Custom Color', 'massive-engine' ),
                    'param_name'  => 'custom_bg_color',
                    'description' => esc_html__( 'Pick a color for background', 'massive-engine' ),
                    'dependency'  => array(
                        'element' => 'custom_color',
                        'value'   => 'true'
                    ),
                ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__( 'Text Color', 'massive-engine' ),
                    'param_name'  => 'custom_text_color',
                    'description' => esc_html__( 'Pick a color for text', 'massive-engine' ),
                    'dependency'  => array(
                        'element' => 'custom_color',
                        'value'   => 'true'
                    ),
                ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__( 'Icon Color', 'massive-engine' ),
                    'param_name'  => 'custom_icon_color',
                    'description' => esc_html__( 'Pick a color for icon & title text', 'massive-engine' ),
                    'dependency'  => array(
                        'element' => 'custom_color',
                        'value'   => 'true'
                    ),
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Padding', 'massive-engine' ),
                    'param_name'  => 'custom_padding',
                    'description' => esc_html__( 'Set featured box padding', 'massive-engine' ),
                    'dependency'  => array(
                        'element' => 'custom_color',
                        'value'   => 'true'
                    ),
                ),
            )
        );
    }

    /**
     * Render this shortcode
     *
     * @param  array $atts
     * @param  string $content
     *
     * @return string
     */
    public function render( $atts, $content = null ) {
        $defaults = array(
            'icon'                => '',
            'icon_bottom_border'  => false,
            'title'               => '',
            'type'                => 'false',
            'alignment'           => 'text-left',
            'custom_bg_color'     => 'false',
            'custom_border_color' => '',
            'custom_color'        => false,
            'custom_text_color'   => '',
            'custom_icon_color'   => '',
            'custom_padding'      => '',
            'uid'                 => '',
            'artwork' => 'icon',
            'image' => 0,
        );

        $uid         = $this->get_uid( $atts ); //this line must be here after $defaults, before calling shortcode_atts
        $atts        = shortcode_atts( $defaults, $atts );
        $atts['uid'] = $uid;
        $type        = trim( strtolower( $atts['type'] ) );
        $types       = array(
            'bordericoncenter',
            'bordericonleft',
            'boxed',
            'circleiconcenterdark',
            'fixedheight',
            'iconleftdark',
            'iconleftlight',
            'verticaldark',
            'verticallight',
        );

        if ( $type == 'false' ) {
            $type = "bordericoncenter";
        }

        $image = wp_get_attachment_image_src( $atts['image'],'thumbnail' );
        $image = isset( $image[0] ) ? $image[0] : '';

        $view = $this->get_view( $type );

        ob_start();
        if ( in_array( $type, $types )  && file_exists( $view ) ) {
            include( $view );
        }
        return ob_get_clean();
    }

}

new Massive_FeaturedBox;
