<?php
/**
 * Massive career info shortcode
 *
 * @package Massive Engine
 * @author ThemeBucket <themebucket@gmail.com>
 */

class Massive_Career_Info extends Massive_Shortcode {

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
            'name'     => esc_html__( 'Career Info Row', 'massive-engine' ),
            'as_child' => array('only' => 'massive_career' ),
            'base'     => $this->get_tag(),
            'category' => esc_html__( 'Massive', 'massive-engine' ),
            'icon'     => $this->get_icon('career'),
            'params'   => array(
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Title', 'massive-engine' ),
                    'param_name'  => 'title',
                    'admin_label' => true,
                    'value'       => esc_html__( 'Heading', 'massive-engine' )
                    ),
                array(
                    'type'       => 'textarea_html',
                    'heading'    => esc_html__( 'Description', 'massive-engine' ),
                    'param_name' => 'content',
                    'value'      => esc_html__( 'Details goes here.', 'massive-engine' ),
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
            'title'  => esc_html__( 'Heading', 'massive-engine' )
            );

        $uid         = $this->get_uid( $atts ); //this line must be here after $defaults, before calling shortcode_atts
        $atts        = shortcode_atts( $defaults, $atts );
        $atts['uid'] = $uid;

        $view = $this->get_view( 'main' );

        ob_start();
        if ( file_exists( $view ) ) {
            include( $view );
        }
        return ob_get_clean();
    }
    
}

new Massive_Career_Info;

if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_Massive_Career_Info extends WPBakeryShortCode {
    }
}
