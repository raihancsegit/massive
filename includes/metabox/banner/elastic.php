<?php
function massive_banner_elastic( $metabox ) {
    $metabox[] = array(
        'id'        => '_massive_banner_elastic',
        'title'     => esc_html__( 'Elastic Banner Settings', 'massive' ),
        'post_type' => 'banner',
        'context'   => 'normal',
        'priority'  => 'default',
        'sections'  => array(
            array(
                'name'   => 'elastic-settings',
                'title'  => esc_html__( 'Banner Settings', 'massive' ),
                'icon'   => 'fa fa-cogs',
                'fields' => array(
                    array(
                        'id'      => 'banner_layout',
                        'title'   => esc_html__( 'Banner Layout', 'massive' ),
                        'type'    => 'radio',
                        'default' => 'massive-default',
                        'options' => array(
                            'massive-default' => esc_html__( 'Massive Default (Height: 500px)', 'massive' ),
                            'custom' => esc_html__( 'Custom', 'massive' ),
                            ),
                        ),
                    array(
                        'id'         => 'custom_height',
                        'title'      => esc_html__( 'Custom Height', 'massive' ),
                        'type'       => 'number',
                        'dependency' => array( 'banner_layout_custom', '==', 'true' ),
                        'desc'       => massive_esc_desc( __( 'Add a custom height in pixel. Default unit is %s', 'massive' ), array('<code>px</code>') ),
                        'default'    => 500,
                        'attributes' => array(
                            'min'  => 1,
                            'step' => 1,
                            'max'  => 1400
                            ),
                        ),
                    ),
                ),
            array(
                'name'   => 'elastic-content',
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
                                'desc' => esc_html__( 'This title will not be shown on front end.', 'massive' )
                                ),
                            array(
                                'id'    => 'image',
                                'title' => esc_html__( 'Banner Image', 'massive' ),
                                'type'  => 'image',
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
                ),
            ),
        );

    return $metabox;
}
add_filter( 'cs_metabox_options', 'massive_banner_elastic' );
