<?php
$massive_sections[] = array(
    'name'   => 'massive-page-footer',
    'title'  => esc_html__( 'Footer', 'massive' ),
    'icon'   => 'icon-basic_display',
    'fields' => array(
        array(
            'id' => 'footer_status',
            'type' => 'switcher',
            'title' => esc_html__( 'Status', 'massive' ),
            'desc' => esc_html__( 'Switch on to enable page footer. Or disable it if you want to hide or disable page footer.', 'massive' ),
            'default' => true,
            ),
        array(
            'id' => 'footer_override',
            'type' => 'switcher',
            'title' => esc_html__( 'Override Global', 'massive' ),
            'desc' => esc_html__( 'Switch on to override global footer settings.', 'massive' ),
            'default' => false,
        ),
        array(
            'type'    => 'subheading',
            'content' => esc_html__( 'General', 'massive' ),
            'dependency' => array( 'footer_override', '==', 'true' ),
        ),
        array(
            'id'      => 'footer_layout',
            'type'    => 'select',
            'title'   => esc_html__( 'Layout', 'massive' ),
            'desc'    => esc_html__( 'Select footer layout form dropdown.', 'massive' ),
            'default' => cs_get_option('footer_layout'),
            'dependency' => array( 'footer_override', '==', 'true' ),
            'options' => array(
                'layout-1' => esc_html__( 'Widgetized Footer', 'massive' ),
                'layout-2' => esc_html__( 'With Footer Logo', 'massive' ),
                'layout-3' => esc_html__( 'With Footer Logo (Pulled Up)', 'massive' ),
                )
            ),
        array(
            'id'      => 'footer_theme',
            'type'    => 'select',
            'title'   => esc_html__( 'Theme', 'massive' ),
            'desc'    => esc_html__( 'Select footer theme from downdown.', 'massive' ),
            'default' => cs_get_option('footer_theme'),
            'dependency' => array( 'footer_override', '==', 'true' ),
            'options' => array(
                'dark'  => esc_html__( 'Dark Theme', 'massive' ),
                'gray'  => esc_html__( 'Gray Theme', 'massive' ),
                )
            ),
        array(
            'type'    => 'subheading',
            'content' => esc_html__( 'Brand Logo', 'massive' ),
            'dependency' => array( 'footer_override|footer_layout', '==|!=', 'true|layout-1' ),
            ),
        array(
            'id'         => 'footer_logo_default',
            'type'       => 'image',
            'title'      => esc_html__( 'Default Logo', 'massive' ),
            'desc'       => esc_html__( 'Select an image for your logo.', 'massive' ),
            'default'    => cs_get_option('footer_logo_default'),
            'dependency' => array( 'footer_override|footer_layout', '==|!=', 'true|layout-1' ),
            ),
        array(
            'id'         => 'footer_logo_retina',
            'type'       => 'image',
            'title'      => esc_html__( 'Retina Logo', 'massive' ),
            'desc'       => esc_html__( 'Select an image for the retina version of the logo. It should be exactly 2x the size of main logo.', 'massive' ),
            'default'    => cs_get_option('footer_logo_retina'),
            'dependency' => array( 'footer_override|footer_layout', '==|!=', 'true|layout-1' ),
            ),
        array(
            'type'    => 'subheading',
            'content' => esc_html__( 'Widget Area', 'massive' ),
            'dependency' => array( 'footer_override|footer_layout', '==|==', 'true|layout-1' ),
            ),
        array(
            'id'         => 'footer_widget_area_columns',
            'type'       => 'select',
            'title'      => esc_html__( 'Widget Area Columns', 'massive' ),
            'default'    => cs_get_option('footer_widget_area_columns'),
            'desc'       => massive_esc_desc( __( 'Select number of columns for footer widget area. Setup widgets from %s settings page.', 'massive' ), array('<a href="'.esc_url( admin_url('widgets.php') ).'" target="_blank">widget</a>') ),
            'dependency' => array( 'footer_override|footer_layout', '==|==', 'true|layout-1' ),
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
            'content' => esc_html__( 'Social Icons', 'massive' ),
            'dependency' => array( 'footer_override', '==', 'true' ),
            ),
        array(
            'id'      => 'footer_social_icons_theme',
            'type'    => 'select',
            'title'   => esc_html__( 'Social Icons Theme', 'massive' ),
            'desc'    => massive_esc_desc( __( 'Select social icon theme from dropdown. Setup social media icons from %s page.', 'massive' ), array('<a href="'.esc_url( admin_url('admin.php?page=massive-theme-settings') ).'" target="_blank">Theme Options</a>') ),
            'default' => cs_get_option('footer_social_icons_theme'),
            'dependency' => array( 'footer_override', '==', 'true' ),
            'options' => array(
                'dark'  => esc_html__( 'Dark Theme', 'massive' ),
                'gray'  => esc_html__( 'Gray Theme', 'massive' ),
                'light' => esc_html__( 'Light Theme', 'massive' ),
                )
            ),
        ),
    );
