<?php
$massive_sections[] = array(
    'name'   => 'massive-page-sidebar',
    'title'  => esc_html__( 'Sidebars', 'massive' ),
    'icon'   => 'icon-software_layout_header_3columns',
    'fields' => array(
        array(
            'type'    => 'subheading',
            'content' => massive_esc_desc( __( 'Sidebars (%s Only work with default page template %s)', 'massive' ), array('<em>','</em>') ),
            ),
        array(
            'id'      => 'sidebar_active-sidebar',
            'type'    => 'select',
            'title'   => esc_html__( 'Active Sidebar', 'massive' ),
            'desc'    => esc_html__( 'Select a sidebar from dropdown to set as active sidebar. Note: Select "Both Sidebars" for left and right sidebars. Select "No Sidebar" if you do not want any sidebar.', 'massive' ),
            'default' => 'no-sidebar',
            'options' => array(
                'no-sidebar'    => esc_html__( 'No Sidebar', 'massive' ),
                'left-sidebar'  => esc_html__( 'Left Sidebar', 'massive' ),
                'right-sidebar' => esc_html__( 'Right Sidebar', 'massive' ),
                'both-sidebar'  => esc_html__( 'Both Sidebars', 'massive' ),
                )
            ),
        array(
            'id'         => 'sidebar_left-sidebar',
            'type'       => 'select',
            'title'      => esc_html__( 'Left Sidebar', 'massive' ),
            'desc'       => massive_esc_desc( __( 'See all the sidebars by going to this link %s.', 'massive' ), array('<a href="'.esc_url( admin_url( 'widgets.php' ) ).'" target="_blank">Sidebars</a>') ),
            'default'    => 'primary-sidebar',
            'options'    => massive_get_sidebar_list(),
            ),
        array(
            'id'         => 'sidebar_right-sidebar',
            'type'       => 'select',
            'title'      => esc_html__( 'Right Sidebar', 'massive' ),
            'desc'       => massive_esc_desc( __( 'See all the sidebars by going to this link %s.', 'massive' ), array('<a href="'.esc_url( admin_url( 'widgets.php' ) ).'" target="_blank">Sidebars</a>') ),
            'default'    => 'secondary-sidebar',
            'options'    => massive_get_sidebar_list(),
            ),
        ),
    );
