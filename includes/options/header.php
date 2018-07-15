<?php
$massive_options[] = array(
    'name'   => 'massive-header',
    'title'  => esc_html__( 'Header', 'massive' ),
    'icon'   => 'fa fa-minus',
    'sections' => array(
        array(
            'name'   => 'header_logo',
            'title'  => esc_html__( 'Logo', 'massive' ),
            'icon'   => 'fa fa-envira',
            'fields' => array(
                array(
                    'id'         => 'logo_default',
                    'type'       => 'image',
                    'title'      => esc_html__( 'Default Logo', 'massive' ),
                    'desc'       => esc_html__( 'Select an image for logo.', 'massive' ),
                ),
                array(
                    'id'         => 'logo_retina',
                    'type'       => 'image',
                    'title'      => esc_html__( 'Retina Logo', 'massive' ),
                    'desc'       => esc_html__( 'Select an image for the retina version of the logo. It should be exactly 2x the size of main logo.', 'massive' ),
                ),
            ),
        ),
        array(
            'name'   => 'header_navbar',
            'title'  => esc_html__( 'Navbar', 'massive' ),
            'icon'   => 'fa fa-bars',
            'fields' => array(
                array(
                    'id'      => 'navbar_layout',
                    'type'    => 'image_select',
                    'title'   => esc_html__( 'Layout', 'massive' ),
                    'default' => 'default',
                    'radio'   => true,
                    'attributes'   => array(
                        'data-depend-id' => 'navbar_layout',
                    ),
                    'options' => array(
                        'default' => esc_url( $imgs . 'menu-default.jpg' ),
                        'center' => esc_url( $imgs . 'menu-center.jpg' ),
                        'floating' => esc_url( $imgs . 'menu-floating.jpg' ),
                        'sidebar' => esc_url( $imgs . 'menu-sidebar.jpg' ),
                    ),
                ),
                array(
                    'id'      => 'navbar_layout_width',
                    'type'    => 'select',
                    'title'   => esc_html__( 'Container Width', 'massive' ),
                    'desc'    => esc_html__( 'Select navbar container width from dropdown.', 'massive' ),
                    'default' => 'boxed',
                    'dependency' => array( 'navbar_layout', 'any', 'default,center' ),
                    'options' => array(
                        'boxed' => esc_html__( 'Boxed (1170px)', 'massive' ),
                        'full'  => esc_html__( 'Full Width (100%)', 'massive' ),
                    ),
                ),
                array(
                    'id'      => 'navbar_theme',
                    'type'    => 'select',
                    'title'   => esc_html__( 'Theme', 'massive' ),
                    'desc'    => esc_html__( 'Select a navbar theme from dropdown.', 'massive' ),
                    'dependency' => array( 'navbar_layout', 'any', 'default,center,floating' ),
                    'default' => 'light',
                    'options' => array(
                        'light' => esc_html__( 'Light Theme', 'massive' ),
                        'dark'  => esc_html__( 'Dark Theme', 'massive' ),
                        'trans' => esc_html__( 'Transparent Theme', 'massive' ),
                        'semi'  => esc_html__( 'Semi Transparent Theme', 'massive' ),
                    ),
                ),
                array(
                    'id'      => 'navbar_theme_compact',
                    'type'    => 'select',
                    'title'   => esc_html__( 'Theme', 'massive' ),
                    'desc'    => esc_html__( 'Select a navbar theme from dropdown.', 'massive' ),
                    'dependency' => array( 'navbar_layout', '==', 'sidebar' ),
                    'default' => 'light',
                    'options' => array(
                        'light' => esc_html__( 'Light Theme', 'massive' ),
                        'dark'  => esc_html__( 'Dark Theme', 'massive' ),
                    ),
                ),
                array(
                    'id'      => 'navbar_link_color',
                    'type'    => 'select',
                    'title'   => esc_html__( 'Link Color', 'massive' ),
                    'desc'    => esc_html__( 'Select link text color from dropdown.', 'massive' ),
                    'default' => 'light',
                    'dependency' => array( 'navbar_layout|navbar_theme', 'any|==', 'default,center,floating|trans' ),
                    'options' => array(
                        'light' => esc_html__( 'Light Color', 'massive' ),
                        'dark'  => esc_html__( 'Dark Color', 'massive' ),
                    ),
                ),
                array(
                    'id'      => 'nav_link_style',
                    'type'    => 'select',
                    'title'   => esc_html__( 'Link Style', 'massive' ),
                    'desc'    => esc_html__( 'Select link style from dorpdown.', 'massive' ),
                    'default' => 'default',
                    'dependency' => array( 'navbar_layout', '!=', 'sidebar' ),
                    'options' => array(
                        'default'       => esc_html__( 'Default', 'massive' ),
                        'border-around' => esc_html__( 'Outline', 'massive' ),
                        'border-bottom' => esc_html__( 'Underline', 'massive' ),
                        'fill'          => esc_html__( 'Background', 'massive' ),
                    ),
                ),
                array(
                    'id' => 'navbar_is_compact',
                    'type' => 'switcher',
                    'title' => esc_html__( 'Compact Mode', 'massive' ),
                    'desc' => esc_html__( 'Switch on to enable compact mode. In compact mode you will experience narrow navbar.', 'massive' ),
                    'dependency' => array( 'navbar_layout', 'any', 'default,center,floating' ),
                    'default' => false,
                ),
                array(
                    'type'    => 'subheading',
                    'content' => esc_html__( 'Additional Settings', 'massive' )
                ),
                array(
                    'id' => 'display_search',
                    'type' => 'switcher',
                    'title' => esc_html__( 'Display Search', 'massive' ),
                    'desc' => esc_html__( 'Switch on to display search box in navigation bar.', 'massive' ),
                    'default' => true,
                ),
            ),
        ),
    ),
);
