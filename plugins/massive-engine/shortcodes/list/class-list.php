<?php
/**
 * Massive list shortcode
 *
 * @package Massive Engine
 * @author ThemeBucket <themebucket@gmail.com>
 */

class Massive_List extends Massive_Shortcode {

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
            'name'                    => esc_html__( 'Icon List', 'massive-engine' ),
            'base'                    => $this->get_tag(),
            'category'                => esc_html__( 'Massive', 'massive-engine' ),
            'icon'                    => $this->get_icon('icon-list'),
            'show_settings_on_create' => true,
            'params' => array(
                    array(
                        'type' => 'dropdown',
                        'heading' => esc_html__( 'Icon Theme', 'massive-engine' ),
                        'param_name' => 'theme',
                        'admin_label' => true,
                        'description' => esc_html__( 'Select a icon theme from dropdown.', 'massive-engine' ),
                        'value' => array(
                            esc_html__( 'Border Less Transparent Background', 'massive-engine' ) => 'default',
                            esc_html__( 'Border With Transparent Background', 'massive-engine' ) => 'trans',
                            esc_html__( 'Border Less Gray Background', 'massive-engine' )        => 'gray',
                            esc_html__( 'Border Less Dark Background', 'massive-engine' )        => 'dark',
                            ),
                        ),
                    array(
                        'type' => 'dropdown',
                        'heading' => esc_html__( 'Icon Box Style', 'massive-engine' ),
                        'param_name' => 'style',
                        'admin_label' => true,
                        'description' => esc_html__( 'Select a icon box style from dropdown.', 'massive-engine' ),
                        'dependency'  => array(
                            'element' => 'theme',
                            'value'   => array('trans','gray','dark')
                            ),
                        'value' => array(
                            esc_html__( 'Rectangle', 'massive-engine' ) => 'rectangle',
                            esc_html__( 'Rounded', 'massive-engine' )   => 'rounded',
                            esc_html__( 'Circle', 'massive-engine' )    => 'circle',
                            ),
                        ),
                    array(
                        'type' => 'param_group',
                        'value' => '',
                        'param_name' => 'content',
                        'params' => array(
                            array(
                                'type' => 'textfield',
                                'value' => '',
                                'heading' => esc_html__( 'Text', 'massive-engine' ),
                                'param_name' => 'text',
                                'description' => esc_html__( 'Add list item text.', 'massive-engine' ),
                                ),
                            array(
                                'type'       => 'iconpicker',
                                'heading'    => esc_html__( 'Icon', 'massive-engine' ),
                                'param_name' => 'icon',
                                'settings'   => array(
                                    'emptyIcon' => false,
                                    ),
                                ),
                            )
                        )
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
            'theme' => 'default',
            'style' => 'rectangle',
            );

        $uid = $this->get_uid( $atts );
        $atts = shortcode_atts( $defaults, $atts );
        $theme = massive_sanitize_param( $atts['theme'] );
        $style = massive_sanitize_param( $atts['style'] );

        $theme_map = array(
            'default' => 'icon-defalut',
            'trans' => 'icon-border',
            'gray' => 'icon-bg-box',
            'dark' => 'icon-dark',
            );

        $style_map = array(
            'rectangle' => 'rectangle',
            'rounded' => 'radius',
            'circle' => 'circle',
            );

        if ( function_exists('vc_param_group_parse_atts') ) {
            $items = vc_param_group_parse_atts( $content );
        } else {
            $items = array();
        }

        $classes = array('list-unstyled icon-list');

        if ( isset( $theme_map[$theme] ) ) {
            $classes[] = $theme_map[$theme];
        }

        if ( isset( $style_map[$style] ) ) {
            $classes[] = $style_map[$style];
        }

        $classes = implode( ' ', $classes );

        $view = $this->get_view( 'main' );

        ob_start();
        if ( file_exists( $view ) ) {
            include( $view );
        }
        return ob_get_clean();
    }
    
}

new Massive_List;
