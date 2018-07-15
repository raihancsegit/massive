<?php
$massive_sections[] = array(
    'name'   => 'massive-page-banner',
    'title'  => esc_html__( 'Banner', 'massive' ),
    'icon'   => 'icon-desktop',
    'fields' => array(
        array(
            'id' => 'banner_status',
            'type' => 'switcher',
            'title' => esc_html__( 'Status', 'massive' ),
            'desc' => esc_html__( 'Switch on to enable banner or slider.', 'massive' ),
            'default' => false
            ),
        array(
            'id' => 'banner_type',
            'type' => 'select',
            'title' => esc_html__( 'Type', 'massive' ),
            'desc' => esc_html__( 'Select banner type from dropdown.', 'massive' ),
            'options' => array(
                'massive' => esc_html__( 'Massive Banner', 'massive' ),
                'rev' => esc_html__( 'Slider Revolution', 'massive' ),
                )
            ),
        array(
            'id' => 'banner_massive',
            'type' => 'select',
            'title' => esc_html__( 'Massive Banner', 'massive' ),
            'desc' => massive_esc_desc( __( 'Select a banner from dropdown or create a new banner from %s page.', 'massive' ), array('<a href="'. esc_url( admin_url('post-new.php?post_type=banner') ) . '" target="_blank">Banners</a>' ) ),
            'dependency' => array( 'banner_type', '==', 'massive' ),
            'options' => ( function_exists( 'massive_get_banners' ) ) ? massive_get_banners('not-reverse') : array(esc_html__( '--Activate Helper Plugin--', 'massive' )),
            ),
        array(
            'id' => 'banner_rev',
            'type' => 'select',
            'title' => esc_html__( 'Slider Revolution', 'massive' ),
            'desc' => massive_esc_desc( __( 'Select a slider from dropdown or create a new one from %s page.', 'massive' ), array( '<a href="'. esc_url( admin_url('admin.php?page=revslider') ) . '" target="_blank">Slider Revolution</a>' ) ),
            'dependency' => array( 'banner_type', '==', 'rev' ),
            'options' => ( massive_get_revsliders() ) ? massive_get_revsliders() : array(esc_html__( '--Activate Slider Revolution--', 'massive' )),
            ),
        ),
    );
