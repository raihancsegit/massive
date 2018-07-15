<?php
function massive_audio_post_metabox( $metabox ) {

    $metabox[]    = array(
        'id'        => '_massive_mb_audio_post',
        'title'     => esc_html__( 'Audio Options', 'massive' ),
        'post_type' => 'post',
        'context'   => 'normal',
        'priority'  => 'default',
        'sections'  => array(
            array(
                'name'   => 'mb_audio',
                'fields' => array(
                    array(
                        'id'    => 'audio_url',
                        'type'  => 'text',
                        'title' => esc_html__( 'External Audio Source URL', 'massive' ),
                        'desc'  => esc_html__( 'External audio source, like soundcloud url', 'massive' ),
                        )
                    ),
                ),

            ),
        );

    return $metabox;
}
add_filter( 'cs_metabox_options', 'massive_audio_post_metabox' );
