<?php
/**
 * Blog
 */
$massive_options[] = array(
    'name'     => 'massive-portfolio',
    'title'    => esc_html__( 'Portfolio', 'massive' ),
    'icon'     => 'fa fa-image',
    'sections' => array(
        array(
            'name'   => 'massive-portfolio-home',
            'title'  => esc_html__( 'Settings', 'massive' ),
            'icon'   => 'fa fa-wrench',
            'fields' => array(
                array(
                    'id'         => 'portfolio_layout',
                    'type'       => 'radio',
                    'title'      => esc_html__( 'Layout', 'massive' ),
                    'desc'       => esc_html__( 'Select portfolio layout', 'massive' ),
                    'default'    => 'boxed',
                    'options'    => array(
                        'boxed'     => esc_html__( 'Boxed', 'massive'),
                        'fullwidth' => esc_html__( 'Fullwidth', 'massive'),
                        ),
                    ),
                array(
                    'id'         => 'portfolio_grid_quantity',
                    'type'       => 'radio',
                    'title'      => esc_html__('Grid Settings', 'massive'),
                    'default'    => 'two',
                    'desc'       => esc_html__( 'Select portfolio grid', 'massive' ),
                    'options'    => array(
                            'two'   => esc_html__( 'Grid 2', 'massive'),
                            'three' => esc_html__( 'Grid 3', 'massive'),
                            'four'  => esc_html__( 'Grid 4', 'massive'),
                            'five'  => esc_html__( 'Grid 5', 'massive'),
                            'six'   => esc_html__( 'Grid 6', 'massive'),
                        )
                    ),
                array(
                    'id'         => 'has_portfolio_gutter',
                    'type'       => 'radio',
                    'title'      => esc_html__( 'Gutter Settings', 'massive' ),
                    'default'    => false,
                    'options'    => array(
                            true    => esc_html__( 'Grid With Gutter', 'massive'),
                            false   => esc_html__( 'Grid Without Gutter', 'massive')
                        )
                    ),
                array(
                    'id'         => 'content_position',
                    'type'       => 'radio',
                    'title'      => esc_html__( 'Content Position', 'massive' ),
                    'default'    => 'on_hover',
                    'options'    => array(
                            'on-hover' => esc_html__( 'On Hover', 'massive'),
                            'bottom'   => esc_html__( 'Bottom', 'massive')
                        )
                    ),
                array(
                    'id'         => 'portfolio_category',
                    'type'       => 'checkbox',
                    'title'      => esc_html__( 'Portfolio Category', 'massive' ),
                    'options'    => massive_get_portfolio_categories(),
                    'desc'       => massive_get_desc_for_portfolio_cats(),
                    ),
                array(
                    'id'         => 'has_portfolio_masonry',
                    'type'       => 'switcher',
                    'title'      => esc_html__( 'Enable Masonry View', 'massive' ),
                    'default'    => false,
                    'desc'       => esc_html__( 'Switch on to display masonry view', 'massive'),
                    ),
                array(
                    'id'         => 'portfolio_filter',
                    'type'       => 'switcher',
                    'title'      => esc_html__( 'Disable Portfolio Filter', 'massive' ),
                    'default'    => false,
                    'desc'       => esc_html__( 'Switch on to disable portfolio filter navigation', 'massive'),
                    ),
                )
            ),
        array(
            'name'   => 'massive-portfolio-details',
            'title'  => esc_html__( 'Single', 'massive' ),
            'icon'   => 'fa fa-file-image-o',
            'fields' => array(
                array(
                    'id'         => 'portfolio_details_media',
                    'type'       => 'switcher',
                    'title'      => esc_html__( 'Fullwidth Featured Media', 'massive' ),
                    'desc'       => esc_html__( 'Switch on to display fullwidth featured media (image/gallery)', 'massive' ),
                    'default'    => false
                    ),
                array(
                    'type'    => 'subheading',
                    'content' => esc_html__( 'Related Portfolio', 'massive' )
                    ),
                array(
                    'id'      => 'show_related_porfolio',
                    'type'    => 'switcher',
                    'title'   => esc_html__( 'Display Related Portfolio', 'massive' ),
                    'default' => true,
                    'desc'    => esc_html__( 'Switch on to display related posts.', 'massive'),
                    ),
                array(
                    'id'         => 'no_of_related_portfolio',
                    'type'       => 'text',
                    'title'      => esc_html__( 'Number of Related Portfolio', 'massive' ),
                    'default'    => esc_html__( '5', 'massive'),
                    'dependency' => array('show_related_porfolio', '==', 'true'),
                    'desc'       => esc_html__( 'Input number of related portfolio want to dispaly ', 'massive'),
                    )
                )
            )
        )
    );
