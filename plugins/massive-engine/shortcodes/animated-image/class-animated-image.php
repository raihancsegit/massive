<?php
/**
 * Massive image shortcode
 *
 * @package Massive Engine
 * @author ThemeBucket <themebucket@gmail.com>
 */

class Massive_Image extends Massive_Shortcode {

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
        $design = array();
        $uid = $this->get_uid( $params );

        $align = massive_get_default_param( $params, 'align', 'right' );
        $valign = massive_get_default_param( $params, 'valign', 'middle' );
        $color = massive_get_default_param( $params, 'color' );

        $design[$uid . ' .animated-img-cell'] = array(
            'color' => $color,
            'vertical-align' => $valign,
            'text-align' => $align,
        );
        return $design;
    }

    /**
     * Map this shortcode with visual composer
     * @return array
     */
    protected function map() {
        return array(
            'name'     => esc_html__( 'Animated Image', 'massive-engine' ),
            'base'     => $this->get_tag(),
            'category' => 'Massive',
            'icon'     => $this->get_icon('animated-image'),
            'params'   => array(
                array(
                    'type'        => 'attach_image',
                    'heading'     => esc_html__( 'Image', 'massive-engine' ),
                    'param_name'  => 'image',
                    'description' => esc_html__( 'Add an image for animation.', 'massive-engine' ),
                    ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Animation Type', 'massive-engine' ),
                    'param_name'  => 'animation',
                    'description' => esc_html__( 'Select an image animation type from dropdown.', 'massive-engine' ),
                    'admin_label' => true,
                    'dependency'  => array(
                        'element' => 'image',
                        'not_empty' => true,
                        ),
                    'value' => array(
                        esc_html__( 'None', 'massive-engine' ) => '',
                        esc_html__( 'ZoomIn', 'massive-engine' ) => 'zoomin',
                        ),
                    ),
                array(
                    'type'       => 'textarea',
                    'heading'    => esc_html__( 'Content', 'massive-engine' ),
                    'param_name' => 'content',
                    'dependency' => array(
                        'element' => 'image',
                        'not_empty' => true,
                        ),
                    ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Alignment', 'massive-engine' ),
                    'param_name'  => 'align',
                    'description' => esc_html__( 'Alignment for image content.', 'massive-engine' ),
                    'dependency'  => array(
                        'element' => 'image',
                        'not_empty' => true,
                        ),
                    'std' => 'right',
                    'value' => array(
                        esc_html__( 'Left', 'massive-engine' ) => 'left',
                        esc_html__( 'Center', 'massive-engine' ) => 'center',
                        esc_html__( 'Right', 'massive-engine' ) => 'right',
                        ),
                    ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Vertical Alignment', 'massive-engine' ),
                    'param_name'  => 'valign',
                    'description' => esc_html__( 'Vertical alignment for image content.', 'massive-engine' ),
                    'dependency'  => array(
                        'element' => 'image',
                        'not_empty' => true,
                        ),
                    'std' => 'middle',
                    'value' => array(
                        esc_html__( 'Top', 'massive-engine' ) => 'top',
                        esc_html__( 'Middle', 'massive-engine' ) => 'middle',
                        esc_html__( 'Bottom', 'massive-engine' ) => 'bottom',
                        ),
                    ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__( 'Color', 'massive-engine' ),
                    'param_name'  => 'color',
                    'description' => esc_html__( 'Select a color for image content.', 'massive-engine' ),
                    'dependency'  => array(
                        'element' => 'image',
                        'not_empty' => true,
                        ),
                    ),
                array(
                    'type'       => 'vc_link',
                    'heading'    => esc_html__( 'Image Link', 'massive-engine' ),
                    'param_name' => 'href',
                    'dependency' => array(
                        'element' => 'image',
                        'not_empty' => true,
                        ),
                    ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Image Size', 'massive-engine' ),
                    'param_name'  => 'image_size',
                    'description' => esc_html__( 'Select a suitable image size from dropdown. Default size is "Full".', 'massive-engine' ),
                    'dependency'  => array(
                        'element' => 'image',
                        'not_empty' => true,
                        ),
                    'value' => massive_get_image_sizes(true)
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
            'image'      => '',
            'animation'  => '',
            'align'      => 'right',
            'valign'     => 'middle',
            'color'      => '',
            'image_size' => 'full',
            'href'       => '',
            );

        $uid  = $this->get_uid( $atts ); //this line must be here after $defaults, before calling shortcode_atts
        $atts = shortcode_atts( $defaults, $atts );
        $href = vc_build_link( $atts['href'] );

        $view = $this->get_view('main');

        ob_start();
        if ( file_exists( $view ) ) {
            include( $view );
        }
        return ob_get_clean();
    }

}

new Massive_Image;
