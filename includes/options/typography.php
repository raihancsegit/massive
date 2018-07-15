<?php
$massive_options[] = array(
    'name' => 'massive-typography',
    'title' => esc_html__( 'Typography', 'massive' ),
    'icon' => 'fa fa-font',
    'sections' => array(
        array(
            'name'   => 'typography_general',
            'title'  => esc_html__( 'General', 'massive' ),
            'fields' => array(
                array(
                    'id' => 'enable_typography',
                    'type' => 'switcher',
                    'title' => esc_html__( 'Override Default', 'massive' ),
                    'desc' => esc_html__( 'Switch on to override default typography.', 'massive' ),
                    'default' => false
                    ),
                array(
                    'type' => 'subheading',
                    'content' => esc_html__( 'Body', 'massive' ),
                    'dependency' => array('enable_typography', '==', true),
                    ),
                array(
                    'id' => 'typography_body',
                    'type' => 'tb_typography',
                    'title' => esc_html__( 'Body Typography', 'massive' ),
                    'dependency' => array('enable_typography', '==', true),
                    'desc' => massive_esc_desc( __( 'Set font family, font variant, font size & line height for body text. Default unit for font size & line height is %s.', 'massive' ), array('<code>px</code>') ),
                    'default' => array(
                        'family' => 'Source Sans Pro',
                        'height' => '22.5px',
                        'size' => '15px',
                        'font' => 'google',
                        ),
                    ),
                ),
            ),
        array(
            'name' => 'typography_heading',
            'title' => esc_html__( 'Heading (h1..h6)', 'massive' ),
            'fields' => array(
                array(
                    'type' => 'subheading',
                    'content' => esc_html__( 'Heading (h1..h6)', 'massive' ),
                    'dependency' => array('enable_typography', '==', true),
                     ),
                array(
                    'id' => 'typography_h1',
                    'type' => 'tb_typography',
                    'title' => esc_html__( 'H1 Typography', 'massive' ),
                    'dependency' => array('enable_typography', '==', true),
                    'desc' => massive_esc_desc( __( 'Set font family, font variant, font size & line height for body text. Default unit for font size & line height is %s.', 'massive' ), array('<code>px</code>') ),
                    'default' => array(
                        'family' => 'Source Sans Pro',
                        'height' => '54px',
                        'size' => '36px',
                        'variant' => 'normal',
                        'font' => 'google',
                        ),
                    ),
                array(
                    'id' => 'typography_h2',
                    'type' => 'tb_typography',
                    'title' => esc_html__( 'H2 Typography', 'massive' ),
                    'dependency' => array('enable_typography', '==', true),
                    'desc' => massive_esc_desc( __( 'Set font family, font variant, font size & line height for body text. Default unit for font size & line height is %s.', 'massive' ), array('<code>px</code>') ),
                    'default' => array(
                        'family' => 'Source Sans Pro',
                        'height' => '45px',
                        'size' => '30px',
                        'font' => 'google',
                        ),
                    ),
                array(
                    'id' => 'typography_h3',
                    'type' => 'tb_typography',
                    'title' => esc_html__( 'H3 Typography', 'massive' ),
                    'dependency' => array('enable_typography', '==', true),
                    'desc' => massive_esc_desc( __( 'Set font family, font variant, font size & line height for body text. Default unit for font size & line height is %s.', 'massive' ), array('<code>px</code>') ),
                    'default' => array(
                        'family' => 'Source Sans Pro',
                        'height' => '36px',
                        'size' => '24px',
                        'font' => 'google',
                        ),
                    ),
                array(
                    'id' => 'typography_h4',
                    'type' => 'tb_typography',
                    'title' => esc_html__( 'H4 Typography', 'massive' ),
                    'dependency' => array('enable_typography', '==', true),
                    'desc' => massive_esc_desc( __( 'Set font family, font variant, font size & line height for body text. Default unit for font size & line height is %s.', 'massive' ), array('<code>px</code>') ),
                    'default' => array(
                        'family' => 'Source Sans Pro',
                        'height' => '27px',
                        'size' => '18px',
                        'font' => 'google',
                        ),
                    ),
                array(
                    'id' => 'typography_h5',
                    'type' => 'tb_typography',
                    'title' => esc_html__( 'H5 Typography', 'massive' ),
                    'dependency' => array('enable_typography', '==', true),
                    'desc' => massive_esc_desc( __( 'Set font family, font variant, font size & line height for body text. Default unit for font size & line height is %s.', 'massive' ), array('<code>px</code>') ),
                    'default' => array(
                        'family' => 'Source Sans Pro',
                        'height' => '21px',
                        'size' => '14px',
                        'font' => 'google',
                        ),
                    ),
                array(
                    'id' => 'typography_h6',
                    'type' => 'tb_typography',
                    'title' => esc_html__( 'H6 Typography', 'massive' ),
                    'dependency' => array('enable_typography', '==', true),
                    'desc' => massive_esc_desc( __( 'Set font family, font variant, font size & line height for body text. Default unit for font size & line height is %s.', 'massive' ), array('<code>px</code>') ),
                    'default' => array(
                        'family' => 'Source Sans Pro',
                        'height' => '18px',
                        'size' => '12px',
                        'font' => 'google',
                        ),
                    ),
                ),
            ),
        ),
    );
