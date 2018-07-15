<?php
/*
 * Logo
 */
$massive_options[] = array(
    'name'   => 'woocommerce',
    'title'  => esc_html__( 'WooCommerce', 'massive' ),
    'icon'   => 'fa fa-shopping-cart',
    'fields' => array(
        array(
            'id'         => 'woo_layout',
            'type'       => 'radio',
            'title'      => esc_html__( 'Layout', 'massive' ),
            'desc'       => esc_html__( 'Select WooCommerce page layout', 'massive' ),
            'default'    => 'boxed',
            'options'    => array(
                'boxed'     => esc_html__( 'Boxed', 'massive'),
                'fullwidth' => esc_html__( 'Fullwidth', 'massive'),
                ),
            ),
        array(
            'id'         => 'woo_sidebar',
            'type'       => 'radio',
            'title'      => esc_html__( 'Sidebar', 'massive' ),
            'desc'       => esc_html__( 'Select WooCommerce sidebar', 'massive' ),
            'default'    => 'sidebar',
            'options'    => array(
                'left'       => esc_html__( 'Sidebar Left', 'massive'),
                'right'      => esc_html__( 'Sidebar Right', 'massive'),
                'no-sidebar' => esc_html__( 'No Sidebar', 'massive'),
                ),
            ),
        array(
            'id'         => 'woo_grid',
            'type'       => 'radio',
            'title'      => esc_html__('Grid Style', 'massive'),
            'default'    => 'three',
            'desc'       => esc_html__( 'Select product grid style', 'massive' ),
            'options'    => array(
                    'two'   => esc_html__( 'Grid 2', 'massive'),
                    'three' => esc_html__( 'Grid 3', 'massive'),
                    'four'  => esc_html__( 'Grid 4', 'massive'),
                )
            ),
        ),
    );
