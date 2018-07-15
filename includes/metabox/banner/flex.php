<?php
function massive_banner_flex( $metabox ) {
    $metabox[] = array(
        'id'        => '_massive_banner_flex',
        'title'     => esc_html__( 'Flex Banner Settings', 'massive' ),
        'post_type' => 'banner',
        'context'   => 'normal',
        'priority'  => 'default',
        'sections'  => array(
            array(
                'name'   => 'flex-settings',
                'title'  => esc_html__( 'Banner Settings', 'massive' ),
                'icon'   => 'fa fa-cogs',
                'fields' => array(
                    array(
                        'id'      => 'banner_layout',
                        'title'   => esc_html__( 'Banner Layout', 'massive' ),
                        'type'    => 'radio',
                        'default' => 'massive-default',
                        'options' => array(
                            'massive-default' => esc_html__( 'Massive Default (Height: 580px)', 'massive' ),
                            'custom' => esc_html__( 'Custom', 'massive' ),
                            ),
                        ),
                    array(
                        'id'         => 'custom_height',
                        'title'      => esc_html__( 'Custom Height', 'massive' ),
                        'type'       => 'number',
                        'dependency' => array( 'banner_layout_custom', '==', 'true' ),
                        'desc'       => massive_esc_desc( __( 'Add a custom height in pixel. Default unit is %s', 'massive' ), array('<code>px</code>') ),
                        'default'    => 580,
                        'attributes' => array(
                            'min'  => 1,
                            'step' => 1,
                            'max'  => 1400
                            ),
                        ),
                    array(
                        'id'      => 'has_banner_thumbnail',
                        'title'   => esc_html__( 'Display Thumbnail', 'massive' ),
                        'type'    => 'switcher',
                        'default' => true,
                        )
                    ),
                ),
            array(
                'name'   => 'flex-content',
                'title'  => esc_html__( 'Banner Contents', 'massive' ),
                'icon'   => 'fa fa-pencil',
                'fields' => array(
                    array(
                        'id'              => 'banner_contents',
                        'type'            => 'group',
                        'button_title'    => esc_html__( 'Add New Slide', 'massive' ),
                        'accordion_title' => esc_html__( 'Banner Slide', 'massive' ),
                        'fields'          => array(
                            array(
                                'id'    => 'title',
                                'title' => esc_html__( 'Banner Title', 'massive' ),
                                'type'  => 'text',
                                ),
                            array(
                                'id'    => 'image',
                                'title' => esc_html__( 'Banner Image', 'massive' ),
                                'type'  => 'image',
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        );

    return $metabox;
}
add_filter( 'cs_metabox_options', 'massive_banner_flex' );


