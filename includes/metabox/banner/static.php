<?php
function massive_banner_static( $metabox ) {
    $metabox[] = array(
        'id'        => '_massive_banner_static',
        'title'     => esc_html__( 'Image Banner Settings', 'massive' ),
        'post_type' => 'banner',
        'context'   => 'normal',
        'priority'  => 'default',
        'sections'  => array(
            array(
                'name'   => 'static-settings',
                'title'  => esc_html__( 'Banner Settings', 'massive' ),
                'icon'   => 'fa fa-cogs',
                'fields' => array(
                    array(
                        'id'      => 'banner_layout',
                        'title'   => esc_html__( 'Banner Layout', 'massive' ),
                        'type'    => 'radio',
                        'default' => 'fullscreen',
                        'options' => array(
                            'fullscreen'      => esc_html__( 'Full Screen', 'massive' ),
                            'massive-default' => esc_html__( 'Massive Default(Height: 600px)', 'massive' ),
                            'custom'          => esc_html__( 'Custom', 'massive' ),
                            ),
                        ),
                    array(
                        'id'         => 'custom_height',
                        'title'      => esc_html__( 'Custom Height', 'massive' ),
                        'type'       => 'number',
                        'dependency' => array( 'banner_layout_custom', '==', 'true' ),
                        'desc'       => massive_esc_desc( __( 'Add a custom height in pixel. Default unit is %s', 'massive' ), array('<code>px</code>') ),
                        'default'    => 600,
                        'attributes' => array(
                            'min'  => 1,
                            'step' => 1,
                            'max'  => 1400
                            ),
                        ),
                    array(
                        'id'      => 'content_layout',
                        'title'   => esc_html__( 'Content Layout', 'massive' ),
                        'type'    => 'radio',
                        'default' => 'boxed',
                        'options' => array(
                            'boxed' => esc_html__( 'Boxed', 'massive' ),
                            'wide'  => esc_html__( 'Wide', 'massive' ),
                            ),
                        ),
                    array(
                        'id'         => 'boxed_theme',
                        'title'      => esc_html__( 'Theme', 'massive' ),
                        'type'       => 'radio',
                        'dependency' => array( 'content_layout_boxed', '==', 'true' ),
                        'default'    => 'light',
                        'options'    => array(
                            'light'  => esc_html__( 'Light Theme', 'massive' ),
                            'dark'   => esc_html__( 'Dark Theme', 'massive' ),
                            'custom' => esc_html__( 'Custom Theme', 'massive' ),
                            ),
                        ),
                    array(
                        'id'         => 'boxed_custom_theme',
                        'title'      => esc_html__( 'Custom Theme Color', 'massive' ),
                        'type'       => 'color_picker',
                        'dependency' => array( 'boxed_theme_custom', '==', 'true' ),
                        'default'    => '#fff',
                        ),
                    array(
                        'id'         => 'boxed_width',
                        'title'      => esc_html__( 'Width', 'massive' ),
                        'type'       => 'number',
                        'dependency' => array( 'content_layout_boxed', '==', 'true' ),
                        'desc'       => massive_esc_desc( __( 'Add a custom height in pixel. Default unit is %s', 'massive' ), array('<code>px</code>') ),
                        'default'    => 650,
                        'attributes' => array(
                            'min'  => 1,
                            'step' => 1,
                            'max'  => 1140,
                            ),
                        ),
                    ),
                ),
            array(
                'name'   => 'static-content',
                'title'  => esc_html__( 'Banner Contents', 'massive' ),
                'icon'   => 'fa fa-pencil',
                'fields' => array(
                    array(
                        'id'    => 'background',
                        'title' => esc_html__( 'Background Image', 'massive' ),
                        'type'  => 'background',
                        ),
                    array(
                        'id'    => 'content',
                        'title' => esc_html__( 'Banner Content', 'massive' ),
                        'type'  => 'wysiwyg',
                        'desc'  => esc_html__( 'You can add any contents here including HTML tags & shortcodes. All contents will follow default styles. But you can style them however you want.', 'massive' ),
                        ),
                    ),
                ),
            ),
        );

    return $metabox;
}
add_filter( 'cs_metabox_options', 'massive_banner_static' );
