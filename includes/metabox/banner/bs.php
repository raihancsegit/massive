<?php
function massive_banner_bs( $metabox ) {
    $metabox[] = array(
        'id'        => '_massive_banner_bs',
        'title'     => esc_html__( 'BS Banner Settings', 'massive' ),
        'post_type' => 'banner',
        'context'   => 'normal',
        'priority'  => 'default',
        'sections'  => array(
            array(
                'name'   => 'bs-settings',
                'title'  => esc_html__( 'Banner Settings', 'massive' ),
                'icon'   => 'fa fa-cogs',
                'fields' => array(
                    array(
                        'id'      => 'banner_layout',
                        'title'   => esc_html__( 'Banner Layout', 'massive' ),
                        'type'    => 'radio',
                        'default' => 'massive-default',
                        'options' => array(
                            'massive-default' => esc_html__( 'Massive Default (Full Screen)', 'massive' ),
                            ),
                        ),
                    ),
                ),
            array(
                'name'   => 'bs-content',
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
                                'desc'  => massive_esc_desc( __( 'Minimum size: %s Best size: %s', 'massive' ), array('<code>1600X800</code><br>', '<code>1920X1080</code>' ) ),
                                ),
                            array(
                                'id'    => 'content',
                                'title' => esc_html__( 'Banner Content', 'massive' ),
                                'type'  => 'wysiwyg',
                                'desc'  => esc_html__( 'You can add any contents here including HTML tags & shortcodes. All contents will follow default styles. But you can style them however you want.', 'massive' ),
                                ),
                            array(
                                'id'      => 'animation',
                                'title'   => esc_html__( 'Animation', 'massive' ),
                                'type'    => 'select',
                                'options' => massive_animation_names()
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        );

    return $metabox;
}
add_filter( 'cs_metabox_options', 'massive_banner_bs' );
