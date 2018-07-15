<?php
/*
 * Footer
 */
$massive_options[] = array(
    'name'   => 'massive-footer',
    'title'  => esc_html__( 'Footer', 'massive' ),
    'icon'   => 'fa fa-credit-card',
    'fields' => array(
        array(
            'type' => 'subheading',
            'content' => esc_html__( 'Footer Settings', 'massive' ),
            ),
        array(
            'id'      => 'footer_layout',
            'type'    => 'select',
            'title'   => esc_html__( 'Footer Layout', 'massive' ),
            'desc'    => esc_html__( 'Select a footer layout form dropdown.', 'massive' ),
            'options' => array(
                'layout-1' => esc_html__( 'Widgetized Footer', 'massive' ),
                'layout-2' => esc_html__( 'With Footer Logo', 'massive' ),
                'layout-3' => esc_html__( 'With Footer Logo (Pulled Up)', 'massive' ),
                )
            ),
        array(
            'id'      => 'footer_theme',
            'type'    => 'select',
            'title'   => esc_html__( 'Footer Theme', 'massive' ),
            'desc'    => esc_html__( 'Select a color scheme for footer from dropdown.', 'massive' ),
            'options' => array(
                'dark'  => esc_html__( 'Dark Theme', 'massive' ),
                'gray'  => esc_html__( 'Gray Theme', 'massive' ),
                )
            ),
        array(
            'type'    => 'subheading',
            'content' => esc_html__( 'Footer Logo', 'massive' ),
            'dependency' => array( 'footer_layout', '!=', 'layout-1' ),
            ),
        array(
            'id'    => 'footer_logo_default',
            'type'  => 'image',
            'title' => esc_html__( 'Default Logo', 'massive' ),
            'desc'  => esc_html__( 'Select an image for your logo.', 'massive' ),
            'dependency' => array( 'footer_layout', '!=', 'layout-1' ),
            ),
        array(
            'id'    => 'footer_logo_retina',
            'type'  => 'image',
            'title' => esc_html__( 'Retina Logo', 'massive' ),
            'desc'  => esc_html__( 'Select an image for the retina version of the logo. It should be exactly 2x the size of main logo.', 'massive' ),
            'dependency' => array( 'footer_layout', '!=', 'layout-1' ),
            ),
        array(
            'type'    => 'subheading',
            'content' => esc_html__( 'Footer Widget Area', 'massive' ),
            'dependency' => array( 'footer_layout', '==', 'layout-1' ),
            ),
        array(
            'id'         => 'footer_widget_area_columns',
            'type'       => 'select',
            'title'      => esc_html__( 'Widget Area Columns', 'massive' ),
            'default'    => 4,
            'desc'       => massive_esc_desc( __( 'Select number of columns for footer widget area. Setup widgets from %s settings page.', 'massive' ), array('<a href="'.esc_url( admin_url('widgets.php') ).'" target="_blank">widget</a>') ),
            'dependency' => array( 'footer_layout', '==', 'layout-1' ),
            'options'    => array(
                'no' => esc_html__( 'No Widget Area', 'massive' ),
                '1' => esc_html__( 'Column 1', 'massive' ),
                '2' => esc_html__( 'Column 2', 'massive' ),
                '3' => esc_html__( 'Column 3', 'massive' ),
                '4' => esc_html__( 'Column 4', 'massive' ),
                )
            ),
        array(
            'type'    => 'subheading',
            'content' => esc_html__( 'Copyright', 'massive' ),
            ),
        array(
            'id'    => 'display_footer_copyright',
            'type'  => 'switcher',
            'title' => esc_html__( 'Display Copyright', 'massive' ),
            'desc'  => esc_html__( 'Switch on to display copyright information.', 'massive' ),
            ),
        array(
            'id'         => 'footer_copyright_content',
            'type'       => 'textarea',
            'title'      => esc_html__( 'Copyright Content', 'massive' ),
            'desc'       => esc_html__( 'Add copyright content here.', 'massive' ),
            'dependency' => array( 'display_footer_copyright', '==', true ),
            ),
        array(
            'type'    => 'subheading',
            'content' => esc_html__( 'Social Icons', 'massive' ),
            ),
        array(
            'id'    => 'display_footer_social_icons',
            'type'  => 'switcher',
            'title' => esc_html__( 'Display Social Icons', 'massive' ),
            'desc'  => esc_html__( 'Switch on to display social media icons.', 'massive' ),
            ),
        array(
            'id'         => 'footer_social_icons_theme',
            'type'       => 'select',
            'title'      => esc_html__( 'Social Icons Theme', 'massive' ),
            'desc'       => esc_html__( 'Select a icon color scheme from dropdown.', 'massive' ),
            'dependency' => array( 'display_footer_social_icons', '==', true ),
            'default'    => 'gray',
            'options'    => array(
                'dark'  => esc_html__( 'Dark Theme', 'massive' ),
                'gray'  => esc_html__( 'Gray Theme', 'massive' ),
                'light' => esc_html__( 'Light Theme', 'massive' ),
                )
            ),
        ),
    );
