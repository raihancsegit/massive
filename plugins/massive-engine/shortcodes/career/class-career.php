<?php
/**
 * Massive career shortcode
 *
 * @package Massive Engine
 * @author ThemeBucket <themebucket@gmail.com>
 */

class Massive_Career extends Massive_Shortcode {

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
            'name'                    => esc_html__( 'Career', 'massive-engine' ),
            'base'                    => $this->get_tag(),
            'category'                => esc_html__( 'Massive', 'massive-engine' ),
            'icon'                    => $this->get_icon('career'),
            'as_parent'               => array('only' => 'massive_career_info'),
            'is_container'            => true,
            'js_view'                 => 'VcColumnView',
            'content_element'         => true,
            'show_settings_on_create' => true,
            'params'    => array(
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Title', 'massive-engine' ),
                    'param_name'  => 'title',
                    'admin_label' => true,
                    ),
                array(
                    'type'       => 'textarea',
                    'heading'    => esc_html__( 'Description', 'massive-engine' ),
                    'param_name' => 'desc',
                    ),
                array(
                    'type'       => 'checkbox',
                    'heading'    => esc_html__( 'Display Icon', 'massive-engine' ),
                    'param_name' => 'has_icon',
                    'value'      => 'false'
                    ),
                array(
                    'type'       => 'iconpicker',
                    'heading'    => esc_html__( 'Icon', 'massive-engine' ),
                    'param_name' => 'icon',
                    'dependency' => array(
                        'element' => 'has_icon',
                        'value'   => 'true'
                        ),
                    'settings'   => array(
                        'emptyIcon' => false,
                        'type' => 'tb_icons',
                        ),
                    ),
                array(
                    'type'       => 'textfield',
                    'heading'    => esc_html__( 'Details Button Text', 'massive-engine' ),
                    'param_name' => 'details_button_text',
                    'value'      => esc_html__( 'View Details', 'massive-engine' ),
                    ),
                array(
                    'type'       => 'textfield',
                    'heading'    => esc_html__( 'Apply Button Link', 'massive-engine' ),
                    'param_name' => 'button_link',
                    ),
                array(
                    'type'       => 'textfield',
                    'heading'    => esc_html__( 'Apply Button Text', 'massive-engine' ),
                    'param_name' => 'button_text',
                    'value'      => esc_html__( 'Apply For This Position', 'massive-engine' ),
                    ),
                array(
                    'type'       => 'textfield',
                    'heading'    => esc_html__( 'Close Button Text', 'massive-engine' ),
                    'param_name' => 'close_button_text',
                    'value'      => esc_html__( 'Close Details', 'massive-engine' ),
                    ),
                array(
                    'type'        => 'checkbox',
                    'heading'     => esc_html__( 'Expanded Details', 'massive-engine' ),
                    'description' => esc_html__( 'Keep details panel open when page loaded.', 'massive-engine' ),
                    'param_name'  => 'expanded',
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
            'title'               => '',
            'desc'                => '',
            'has_icon'            => 'false',
            'icon'                => $this->get_icon('career'),
            'details_button_text' => esc_html__( 'View Details', 'massive-engine' ),
            'button_link'         => '',
            'button_text'         => esc_html__( 'Apply For This Position', 'massive-engine' ),
            'close_button_text'   => esc_html__( 'Close Details', 'massive-engine' ),
            'expanded'            => 'false',
            );

        $uid         = $this->get_uid( $atts ); //this line must be here after $defaults, before calling shortcode_atts
        $atts        = shortcode_atts( $defaults, $atts );
        $atts['uid'] = $uid;

        $has_icon    = massive_sanitize_param( $atts['has_icon'] );
        $expanded    = massive_sanitize_param( $atts['expanded'] );

        $view = $this->get_view( 'main' );

        ob_start();
        if ( file_exists( $view ) ) {
            include( $view );
        }
        return ob_get_clean();
    }
    
}

new Massive_Career;

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_Massive_Career extends WPBakeryShortCodesContainer {
    }
}
