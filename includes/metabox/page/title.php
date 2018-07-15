<?php
$massive_sections[] = array(
    'name'   => 'massive-page-title',
    'title'  => esc_html__( 'Page Title', 'massive' ),
    'icon'   => 'icon-software_layout_header',
    'fields' => array(
        array(
            'id' => 'title_status',
            'type' => 'switcher',
            'title' => esc_html__( 'Status', 'massive' ),
            'desc' => esc_html__( 'Switch on to enable page title.', 'massive' ),
            'default' => true,
            ),
        array(
            'type'    => 'subheading',
            'content' => esc_html__( 'Layout', 'massive' ),
            ),
        array(
            'id'         => 'title_alignment',
            'type'       => 'select',
            'title'      => esc_html__( 'Title Alignment', 'massive' ),
            'default'    => 'align-left',
            'desc'       => esc_html__( 'Select title alignment from dropdown.', 'massive' ),
            'options'    => array(
                'align-left'   => esc_html__( 'Align Left', 'massive' ),
                'align-center' => esc_html__( 'Align Center', 'massive' ),
                'align-right'  => esc_html__( 'Align Right', 'massive' ),
                )
            ),
        array(
            'id'    => 'title_top_padding',
            'type'  => 'text',
            'title' => esc_html__( 'Top Padding', 'massive' ),
            'default' => '50px',
            'desc'  => massive_esc_desc( __( 'Set title top padding in pixels, for example %s. Default value is %s', 'massive' ), array('<code>100px</code>', '<code>50px</code>') ),
            ),
        array(
            'id'    => 'title_bottom_padding',
            'type'  => 'text',
            'title' => esc_html__( 'Bottom Padding', 'massive' ),
            'default' => '50px',
            'desc'  => massive_esc_desc( __( 'Set title bottom padding in pixels, for example %s. Default value is %s', 'massive' ), array('<code>100px</code>', '<code>50px</code>') ),
            ),
        array(
            'id'    => 'title_top_border',
            'type'  => 'text',
            'title' => esc_html__( 'Top Border', 'massive' ),
            'default' => '0px',
            'desc'  => massive_esc_desc( __( 'Set title top border in pixels, for example %s. Default value is %s', 'massive' ), array('<code>5px</code>', '<code>0px</code>') ),
            ),
        array(
            'id'    => 'title_bottom_border',
            'type'  => 'text',
            'title' => esc_html__( 'Bottom Border', 'massive' ),
            'default' => '0px',
            'desc'  => massive_esc_desc( __( 'Set title bottom border in pixels, for example %s. Default value is %s', 'massive' ), array('<code>5px</code>', '<code>0px</code>') ),
            ),
        array(
            'id'    => 'title_border_color',
            'type'  => 'color_picker',
            'title' => esc_html__( 'Border Color', 'massive' ),
            'desc'  => esc_html__( 'Top and bottom border color.', 'massive' )
            ),
        array(
            'id'    => 'title_background',
            'type'  => 'background',
            'title' => esc_html__( 'Background', 'massive' ),
            'desc'  => massive_esc_desc( __( 'Set title background image/color and adjust other relevant settings. Background default color is %s', 'massive' ), array('<code>#f5f5f5</code>') ),
            'default' => array(
                'repeat'     => 'no-repeat',
                'attachment' => 'fixed',
                'position'   => 'center top',
                'color'      => '#f5f5f5',
                ),
            ),
        array(
            'type'    => 'subheading',
            'content' => esc_html__( 'Title', 'massive' ),
            ),
        array(
            'id'      => 'title_color',
            'type'    => 'color_picker',
            'title'   => esc_html__( 'Color', 'massive' ),
            'desc'    => massive_esc_desc( __( 'Pick a color for title. Default color is %s', 'massive' ), array('<code>#222</code>') ),
            'default' => '#222',
            ),
        array(
            'id'    => 'title_font_size',
            'type'  => 'text',
            'title' => esc_html__( 'Font Size', 'massive' ),
            'default' => '18px',
            'desc'  => massive_esc_desc( __( 'Set title font size in pixels, for example %s. Default value is %s', 'massive' ), array('<code>36px</code>', '<code>18px</code>') ),
            ),
        array(
            'type'    => 'subheading',
            'content' => esc_html__( 'Sub Title', 'massive' ),
            ),
        array(
            'id'    => 'title_sub_title',
            'type'  => 'text',
            'title' => esc_html__( 'Content', 'massive' ),
            'desc'  => esc_html__( 'Set page subtitle content or left blank.', 'massive' ),
            ),
        array(
            'id'      => 'title_sub_color',
            'type'    => 'color_picker',
            'title'   => esc_html__( 'Color', 'massive' ),
            'desc'    => massive_esc_desc( __( 'Pick a color for subtitle. Default color is %s', 'massive' ), array('<code>#929294</code>') ),
            'default' => '#929294',
            ),
        array(
            'id'    => 'title_sub_font_size',
            'type'  => 'text',
            'title' => esc_html__( 'Font Size', 'massive' ),
            'default' => '15px',
            'desc'  => massive_esc_desc( __( 'Set subtitle font size in pixels, for example %s. Default value is %s', 'massive' ), array('<code>18px</code>', '<code>15px</code>') ),
            ),
        array(
            'type'    => 'subheading',
            'content' => esc_html__( 'Breadcrumbs', 'massive' ),
            ),
        array(
            'id'      => 'display_title_breadcrumb',
            'type'    => 'switcher',
            'title'   => esc_html__( 'Status', 'massive' ),
            'desc'    => esc_html__( 'Switch on to display breadcrumb.', 'massive' ),
            'default' => true,
            ),
        array(
            'id'         => 'title_breadcrumb_color',
            'type'       => 'color_picker',
            'title'      => esc_html__( 'Color', 'massive' ),
            'desc'       => massive_esc_desc( __( 'Breadcrumbs link color. Default color is %s', 'massive' ), array('<code>#7e7e7e</code>') ),
            'default'    => '#7e7e7e',
            'dependency' => array( 'display_title_breadcrumb', '==', true ),
            ),
        array(
            'id'         => 'title_breadcrumb_active_color',
            'type'       => 'color_picker',
            'title'      => esc_html__( 'Active Color', 'massive' ),
            'desc'       => massive_esc_desc( __( 'Breadcrumbs active link color. Default color is %s', 'massive' ), array('<code>#222</code>') ),
            'default'    => '#222',
            'dependency' => array( 'display_title_breadcrumb', '==', true ),
            ),
        ),
    );
