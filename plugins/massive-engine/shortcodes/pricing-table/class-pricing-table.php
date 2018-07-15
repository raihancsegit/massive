<?php
/**
 * Massive pricing table shortcode
 *
 * @package Massive Engine
 * @author ThemeBucket <themebucket@gmail.com>
 */

class Massive_Pricing_Table extends Massive_Shortcode {

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
            'name'                    => esc_html__( 'Pricing Table', 'massive-engine' ),
            'base'                    => $this->get_tag(),
            'category'                => esc_html__( 'Massive', 'massive-engine' ),
            'icon'                    => $this->get_icon('price-table'),
            'as_parent'               => array('only' => 'massive_package'),
            'is_container'            => true,
            'js_view'                 => 'VcColumnView',
            'content_element'         => true,
            'show_settings_on_create' => true,
            'params'    => array(
                array(
                    'type'       => 'textfield',
                    'heading'    => esc_html__( 'Currency', 'massive-engine' ),
                    'param_name' => 'currency',
                    'std'        => '$',
                    ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Column(s)', 'massive-engine' ),
                    'description' => esc_html__( 'Select how many packages you want in a row.', 'massive-engine' ),
                    'param_name'  => 'columns',
                    'std'         => 3,
                    'value'       => array(
                        esc_html__( '1 Column', 'massive-engine' )  => 1,
                        esc_html__( '2 Columns', 'massive-engine' ) => 2,
                        esc_html__( '3 Columns', 'massive-engine' ) => 3,
                        esc_html__( '4 Columns', 'massive-engine' ) => 4,
                        esc_html__( '6 Columns', 'massive-engine' ) => 6,
                        )
                    ),
                array(
                    'type'        => 'checkbox',
                    'heading'     => esc_html__( 'Remove Gutter', 'massive-engine' ),
                    'description' => esc_html__( 'Remove gutter/black space between package columns.', 'massive-engine' ),
                    'param_name'  => 'is_gutter_less',
                    'value'       => 'false',
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
            'currency'       => '$',
            'columns'        => 3,
            'is_gutter_less' => 'false',
            );

        $uid         = $this->get_uid( $atts ); //this line must be here after $defaults, before calling shortcode_atts
        $atts        = shortcode_atts( $defaults, $atts );
        $atts['uid'] = $uid;

        $currency    = massive_sanitize_param( $atts['currency'] );
        $columns     = absint( massive_sanitize_param( $atts['columns'] ) );
        $content     = str_replace( '[massive_package', '[massive_package columns="' . $atts['columns'] . '" currency="' . $atts['currency'] . '"', $content );
        $classes     = array('clearfix');

        if ( 'false' !== $atts['is_gutter_less'] ) {
            $classes[] = 'p-table-gutter-less';
        } else {
            $classes[] = 'price-table-row';
        }

        $view = $this->get_view( 'main' );

        ob_start();
        if ( file_exists( $view ) ) {
            include( $view );
        }
        return ob_get_clean();
    }
    
}

new Massive_Pricing_Table;

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_Massive_Pricing_Table extends WPBakeryShortCodesContainer {
    }
}
