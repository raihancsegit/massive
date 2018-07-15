<?php
function massive_video_post_metabox( $metabox ) {

    $metabox[]    = array(
        'id'        => '_massive_mb_video_post',
        'title'     => esc_html__( 'Video Options', 'massive' ),
        'post_type' => 'post',
        'context'   => 'normal',
        'priority'  => 'default',
        'sections'  => array(
            array(
                'name'   => 'mb_video',
                'fields' => array(
                    array(
                        'id'    => 'video_url',
                        'type'  => 'text',
                        'title' => esc_html__( 'External Video Source URL', 'massive' ),
                        'desc'  => esc_html__( 'External video source, like youtube url', 'massive' ),
                        )
                    ),
                ),

            ),
        );

    return $metabox;
}
add_filter( 'cs_metabox_options', 'massive_video_post_metabox' );
