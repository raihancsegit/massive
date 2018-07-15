<?php
/**
 * Massive client shortcode
 *
 * @package Massive Engine
 * @author ThemeBucket <themebucket@gmail.com>
 */

class Massive_Client extends Massive_Shortcode {

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
            'name'            => esc_html__( 'Client Item', 'massive-engine' ),
            'base'            => $this->get_tag(),
            "content_element" => true,
            "as_child"        => array('only' => 'clients_container' ),
            'icon'            => $this->get_icon('clients'),
            'params'          => array(
                array(
                    'type'        => 'attach_image',
                    'heading'     => esc_html__( 'Client Logo', 'massive-engine' ),
                    'param_name'  => 'id',
                    'description' => esc_html__( 'Upload your client logo', 'massive-engine' )
                    ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Client URL', 'massive-engine' ),
                    'param_name'  => 'url',
                    'admin_label' => true,
                    'value'       => esc_url( 'http://' ),
                    'description' => esc_html__( 'Client url comes here.', 'massive-engine' ),
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
            'id'  => '',
            'url' => '',
            );

        $atts = shortcode_atts( $defaults, $atts );
        $image = massive_get_attachment_image_url( $atts['id'], 'thumbnail' );

        $view = $this->get_view( 'main' );

        ob_start();
        if ( file_exists( $view ) ) {
            include( $view );
        }
        return ob_get_clean();
    }

}

new Massive_Client;

if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_Massive_Client extends WPBakeryShortCode {
    }
}
