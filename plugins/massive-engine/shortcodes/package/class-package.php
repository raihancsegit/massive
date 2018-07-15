<?php
/**
 * Massive package shortcode
 *
 * @package Massive Engine
 * @author ThemeBucket <themebucket@gmail.com>
 */

class Massive_Package extends Massive_Shortcode {

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
            'name'             => esc_html__( 'Package', 'massive-engine' ),
            'as_child'         => array('only' => 'massive_pricing_table' ),
            'base'             => $this->get_tag(),
            'category'         => esc_html__( 'Massive', 'massive-engine' ),
            'icon'             => $this->get_icon('price-table'),
            'params'           => array(
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Package Name', 'massive-engine' ),
                    'param_name'  => 'title',
                    'admin_label' => true,
                    'value'       => esc_html__( 'Package Name', 'massive-engine' )
                    ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Package Price', 'massive-engine' ),
                    'description' => esc_html__( 'Add package price without currency.', 'massive-engine' ),
                    'param_name'  => 'price',
                    'value'       => '',
                    ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Package Duration', 'massive-engine' ),
                    'param_name'  => 'duration',
                    'value'       => esc_html__( 'Per Month', 'massive-engine' )
                    ),
                array(
                    'type'        => 'textarea_html',
                    'heading'     => esc_html__( 'Package Features', 'massive-engine' ),
                    'description' => esc_html__( 'Use bulleted (unordered) list or numbered (ordered) list to list package features.', 'massive-engine' ),
                    'param_name'  => 'content',
                    'value'       => esc_html__( 'Feature goes here', 'massive-engine' )
                    ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Button Text', 'massive-engine' ),
                    'param_name'  => 'button_text',
                    'value'       => esc_html__( 'Purchase', 'massive-engine' )
                    ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Button Link', 'massive-engine' ),
                    'param_name'  => 'button_link',
                    ),
                array(
                    'type'        => 'checkbox',
                    'heading'     => esc_html__( 'Featured Package', 'massive-engine' ),
                    'param_name'  => 'is_featured',
                    'value'       => 'false',
                    ),
                array(
                    'type'       => 'hidden',
                    'heading'    => esc_html__( 'Currency', 'massive-engine' ),
                    'param_name' => 'currency',
                    'value'      => '$',
                    ),
                array(
                    'type'       => 'hidden',
                    'heading'    => esc_html__( 'Columns', 'massive-engine' ),
                    'param_name' => 'columns',
                    'value'      => '3',
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
            'title'       => esc_html__( 'Package Name', 'massive-engine' ),
            'currency'    => '$',
            'columns'     => 3,
            'price'       => '10',
            'duration'    => '',
            'button_text' => esc_html__( 'Purchase', 'massive-engine' ),
            'button_link' => '',
            'is_featured' => 'false',
            );

        $uid         = $this->get_uid( $atts ); //this line must be here after $defaults, before calling shortcode_atts
        $atts        = shortcode_atts( $defaults, $atts );
        $atts['uid'] = $uid;

        $price       = (float) massive_sanitize_param( $atts['price'] );
        $columns     = (int) massive_sanitize_param( $atts['columns'] );
        $columns     = ( 12 / $columns );
        $featured    = ( 'false' !== $atts['is_featured'] ? 'featured' : '' );

        $view = $this->get_view( 'main' );

        ob_start();
        if ( file_exists( $view ) ) {
            include( $view );
        }
        return ob_get_clean();
    }
    
}

new Massive_Package;

if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_Massive_Package extends WPBakeryShortCode {
    }
}
