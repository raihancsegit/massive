<?php
function massive_banner_type( $metabox ) {
    $metabox[] = array(
        'id'        => '_massive_banner_type',
        'title'     => esc_html__( 'Massive Banner Types', 'massive' ),
        'post_type' => 'banner',
        'context'   => 'side',
        'priority'  => 'high',
        'sections'  => array(
            array(
                'name'   => 'banner_types',
                'fields' => array(
                    array(
                        'id'         => 'type',
                        'type'       => 'radio',
                        'options'    => array(
                            'bs'      => esc_html__( 'Bootstrap', 'massive' ),
                            'elastic' => esc_html__( 'Elastic', 'massive' ),
                            'flex'    => esc_html__( 'Flex', 'massive' ),
                            'owl'     => esc_html__( 'Owl', 'massive' ),
                            'static'  => esc_html__( 'Static Image', 'massive' ),
                            ),
                        'default' => 'static',
                        ),
                    ),
                ),
            ),
        );

    return $metabox;
}
add_filter( 'cs_metabox_options', 'massive_banner_type' );
