<?php
/**
 * Massive gallery shortcode
 *
 * @package Massive Engine
 * @author ThemeBucket <themebucket@gmail.com>
 */

class Massive_Gallery extends Massive_Shortcode {

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
            'name'             => esc_html__( 'Gallery', 'massive-engine' ),
            'base'             => $this->get_tag(),
            'category'         => esc_html__( 'Massive', 'massive-engine' ),
            'icon'             => $this->get_icon('gallery'),
            'params'           => array(
                array(
                    'type'        => 'attach_images',
                    'heading'     => esc_html__( 'Gallery Images', 'massive-engine' ),
                    'description' => esc_html__( 'Add as many images as you want for gallery.', 'massive-engine' ),
                    'param_name'  => 'images',
                    ),
                ),
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
            'images' => '',
            );

        $uid         = $this->get_uid( $atts ); //this line must be here after $defaults, before calling shortcode_atts
        $atts        = shortcode_atts( $defaults, $atts );
        $atts['uid'] = $uid;

        $images = explode( ',', $atts['images'] );

        $view = $this->get_view( 'main' );

        ob_start();
        if ( file_exists( $view ) ) {
            include( $view );
        }
        return ob_get_clean();
    }
    
}

new Massive_Gallery;
