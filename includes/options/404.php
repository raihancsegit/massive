<?php
$massive_options[] = array(
    'name'   => 'massive-404',
    'title'  => esc_html__( '404 Page', 'massive' ),
    'icon'   => 'fa fa-warning',
    'fields' => array(
        array(
            'id'    => 'massive_404_message',
            'type'  => 'textarea',
            'title' => esc_html__( '404 Message', 'massive' ),
            'desc'  => esc_html__( 'Add 404 (not found) message.', 'massive' )
            ),
        array(
            'id'    => 'massive_404_image',
            'type'  => 'image',
            'title' => '404 Image',
            'desc'  => esc_html__( 'Add 404 image here.', 'massive' )
            )
        ),
    );
