<?php
$massive_sections[] = array(
    'name'   => 'massive-page-config',
    'title'  => esc_html__( 'Page', 'massive' ),
    'icon'   => 'icon-browser2',
    'fields' => array(
        array(
            'type'    => 'subheading',
            'content' => esc_html__( 'Spacing', 'massive' ),
            ),
        array(
            'id'    => 'page_top_padding',
            'type'  => 'text',
            'title' => esc_html__( 'Top Padding', 'massive' ),
            'default' => '100px',
            'desc'  => massive_esc_desc( __( 'Set page top padding in pixels, for example %s. Default value is %s', 'massive' ), array('<code>50px</code>', '<code>100px</code>') ),
            ),
        array(
            'id'    => 'page_bottom_padding',
            'type'  => 'text',
            'title' => esc_html__( 'Bottom Padding', 'massive' ),
            'default' => '100px',
            'desc'  => massive_esc_desc( __( 'Set page bottom padding in pixels, for example %s. Default value is %s', 'massive' ), array('<code>50px</code>', '<code>100px</code>') ),
            ),
        array(
            'type'    => 'subheading',
            'content' => esc_html__( 'Layout', 'massive' ),
            ),
        array(
            'id' => 'page_boxed_view',
            'type' => 'switcher',
            'title' => esc_html__( 'Boxed View', 'massive' ),
            'desc' => esc_html__( 'Switch on to enable page boxed view.', 'massive' ),
            'default' => false
            ),
        array(
            'id' => 'page_background',
            'type' => 'background',
            'title' => esc_html__( 'Background', 'massive' ),
            'desc' => esc_html__( 'Set page background, color and other additional settings.', 'massive' ),
            'dependency' => array('page_boxed_view','==',true),
            'default' => array(
                'repeat' => 'no-repeat',
                'attachment' => 'fixed',
                'position' => 'center center',
                )
            )
        ),
    );
