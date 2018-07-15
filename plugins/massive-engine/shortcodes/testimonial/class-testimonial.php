<?php
/**
 * Massive testimonial shortcode
 *
 * @package Massive Engine
 * @author ThemeBucket <themebucket@gmail.com>
 */

class Massive_Testimonial extends Massive_Shortcode {

    /**
     * Set shortcode directory
     * @return string Directory path
     */
    protected function set_dir() {
        return __DIR__;
    }

    /**
     * Map this shortcode with visual composer
     * @return array
     */
    protected function map() {
        return array(
            'name'            => esc_html__( 'Testimonial Item', 'massive-engine' ),
            'base'            => $this->get_tag(),
            "content_element" => true,
            "as_child"        => array('only' => $this->get_tag() . 's_container' ),
            'icon'            => $this->get_icon('testimonial'),
            'params'          => array(
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Name', 'massive-engine' ),
                    'param_name'  => 'name',
                    'admin_label' => true,
                    'description' => esc_html__( 'Testimonial provider name', 'massive-engine' )
                    ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Job Title', 'massive-engine' ),
                    'param_name'  => 'designation',
                    'description' => esc_html__( 'Add job title with company name', 'massive-engine' ),
                    'admin_label' => true,
                    ),
                array(
                    'type'        => 'textarea_html',
                    'heading'     => esc_html__( 'Testimonial Content', 'massive-engine' ),
                    'param_name'  => 'content',
                    'description' => esc_html__( 'Testimonial content comes here', 'massive-engine' )
                    ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Avatar', 'massive-engine' ),
                    'param_name'  => 'which_avatar',
                    'description' => esc_html__( 'Choose which kind of Avatar to be displayed.', 'massive-engine' ),
                    'value'       => array(
                            esc_html__( 'Image', 'massive-engine' ) => 'image',
                            esc_html__( 'Icon', 'massive-engine' )  => 'icon',
                            esc_html__( 'None', 'massive-engine' )  => 'none'
                        )
                    ),
                array(
                    'type'        => 'attach_image',
                    'heading'     => esc_html__( 'Upload Image', 'massive-engine' ),
                    'param_name'  => 'id',
                    'description' => esc_html__( 'Upload a custom avatar image.', 'massive-engine' ),
                    'dependency'  => array(
                        'element' => 'which_avatar',
                        'value'   => 'image',
                        ),
                    ),
                array(
                    'type'        => 'iconpicker',
                    'heading'     => esc_html__( 'Pick Icon', 'massive-engine' ),
                    'param_name'  => 'has_icon',
                    'settings' => array(
                        'emptyIcon' => false,
                        'type' => 'tb_icons',
                        ),
                    'dependency'  => array(
                        'element' => 'which_avatar',
                        'value'   => 'icon',
                        ),
                    )
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
            'type'         => 'plus-box',
            'name'         => '',
            'designation'  => '',
            'content'      => '',
            'which_avatar' => 'image',
            'id'           => '',
            'has_icon'     => '',
            );

        $atts  = shortcode_atts( $defaults, $atts );
        $type  = $atts['type'];
        $types = array(
            'plus-box',
            'carousel-one',
            'carousel-two',
            'carousel-three',
            'carousel-four'
        );
        $which_avatar     = $atts['which_avatar'] ;
        $attachment_id    = $atts['id'];
        $image = massive_get_attachment_image_url( $attachment_id, 'thumbnail' );

        $view = $this->get_view( $type );

        ob_start();
        if ( in_array( $type, $types ) && file_exists( $view ) ) {
            include( $view );
        }
        return ob_get_clean();
    }

}

new Massive_Testimonial;

if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_Massive_Testimonial extends WPBakeryShortCode {
    }
}
