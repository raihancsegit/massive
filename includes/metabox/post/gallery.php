<?php
function massive_gallery_post_metabox( $metabox ) {

    $metabox[]    = array(
        'id'        => '_massive_mb_gallery_post',
        'title'     => esc_html__( 'Gallery Options', 'massive' ),
        'post_type' => 'post',
        'context'   => 'normal',
        'priority'  => 'default',
        'sections'  => array(
            array(
                'name'   => 'mb_gallery',
                'fields' => array(
                    array(
                        'id'    => 'mb_post_gallery',
                        'type'  => 'gallery',
                        'title' => esc_html__( 'Featured Gallery', 'massive' ),
                        'desc'  => esc_html__( 'Add multiple images in this gallery', 'massive' ),
                        )
                    ),
                ),

            ),
        );

    return $metabox;
}
add_filter( 'cs_metabox_options', 'massive_gallery_post_metabox' );
