<?php

add_filter( 'cs_shortcode_options', 'massive_sc_button_map' );

function massive_sc_button_map( $shortcodes ) {
    $shortcodes[]     = array(
        'shortcodes' => array(
            array(
                'name' => 'massive_button',
                'title' => esc_html__( 'Button', 'massive' ),
                'fields' => array(
                    array(
                        'id' => 'type',
                        'type' => 'select',
                        'title' => esc_html__( 'Button Type', 'massive' ),
                        'default' => 'fill',
                        'options' => array(
                            'fill' => esc_html__( 'Fill', 'massive' ),
                            'line' => esc_html__( 'Line', 'massive' ),
                            'bootstrap' => esc_html__( 'Bootstrap', 'massive' ),
                            ),
                        ),
                    array(
                        'id' => 'shape',
                        'type' => 'select',
                        'title' => esc_html__( 'Button Shape', 'massive' ),
                        'default' => 'rect',
                        'options' => array(
                            'rect' => esc_html__( 'Rectangular', 'massive' ),
                            'rounded' => esc_html__( 'Rounded', 'massive' ),
                            'capsule' => esc_html__( 'Capsule', 'massive' ),
                            ),
                        ),
                    array(
                        'id' => 'btn_color',
                        'type' => 'select',
                        'title' => esc_html__( 'Button Color', 'massive' ),
                        'default' => 'theme',
                        'dependency' => array('type', '!=', 'bootstrap' ),
                        'options' => array(
                            'theme' => esc_html__( 'Theme Color', 'massive' ),
                            'black' => esc_html__( 'Black', 'massive' ),
                            'white' => esc_html__( 'White', 'massive' ),
                            ),
                        ),
                    array(
                        'id' => 'bs_btn_color',
                        'type' => 'select',
                        'title' => esc_html__( 'Button Color', 'massive' ),
                        'default' => 'default',
                        'dependency' => array('type', '==', 'bootstrap' ),
                        'options' => array(
                            'default' => esc_html__( 'Default', 'massive' ),
                            'primary' => esc_html__( 'Primary', 'massive' ),
                            'info' => esc_html__( 'Info', 'massive' ),
                            'success' => esc_html__( 'Success', 'massive' ),
                            'warning' => esc_html__( 'Warning', 'massive' ),
                            'danger' => esc_html__( 'Danger', 'massive' ),
                            ),
                        ),
                    array(
                        'id' => 'size',
                        'type' => 'select',
                        'title' => esc_html__( 'Button Size', 'massive' ),
                        'default' => 'medium',
                        'options' => array(
                            'large' => esc_html__( 'Large', 'massive' ),
                            'medium' => esc_html__( 'Medium', 'massive' ),
                            'small' => esc_html__( 'Small', 'massive' ),
                            'tiny' => esc_html__( 'Tiny', 'massive' ),
                            ),
                        ),
                    array(
                        'id'  => 'text',
                        'type' => 'text',
                        'title' => esc_html__( 'Button Text', 'massive' ),
                        'default' => esc_html__( 'Button Text', 'massive' ),
                        ),
                    array(
                        'id' => 'link',
                        'type' => 'text',
                        'title' => esc_html__( 'Button Link', 'massive' ),
                        'default' => esc_html__( 'http://', 'massive' ),
                        ),
                    array(
                        'id' => 'newtab',
                        'type' => 'switcher',
                        'title' => esc_html__( 'Open Link In A New Tab.', 'massive' ),
                        'value' => true,
                        'default' => false,
                        ),
                    ),
                ),
            ),
        );

    return $shortcodes;
}
