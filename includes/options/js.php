<?php
$massive_options[] = array(
    'name'   => 'massive-custom-js',
    'title'  => esc_html__( 'JavaScript Code', 'massive' ),
    'icon'   => 'fa fa-code',
    'fields' => array(
        array(
            'type' => 'heading',
            'content' => esc_html__( 'JavaScript', 'massive' ),
            ),
        array(
            'type'    => 'subheading',
            'content' => massive_esc_desc( __( 'You do not need to add %s tag in this field. Your JavaScript code will be wrapped using %s tag automatically and then will be added to your site\'s footer', 'massive' ), array('<code>&lt;script type="text/javascript"&gt;...&lt/script&gt;</code>', '<code>&lt;script type="text/javascript"&gt;...&lt/script&gt;</code>') ),
            ),
        array(
            'id'         => 'massive_js',
            'type'       => 'textarea',
            'sanitize'   => false,
            'attributes' => array(
                'style' => 'height:400px',
                ),
            )
        ),
    );
