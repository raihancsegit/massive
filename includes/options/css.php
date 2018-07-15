<?php
$massive_options[] = array(
    'name'   => 'massive-css',
    'title'  => esc_html__( 'CSS Code', 'massive' ),
    'icon'   => 'fa fa-css3',
    'fields' => array(
        array(
            'type' => 'heading',
            'content' => esc_html__( 'Cascading Style Sheets (CSS)', 'massive' ),
            ),
        array(
            'type'    => 'subheading',
            'content' => massive_esc_desc( __( 'You do not need to add %s tag in this field. Your CSS code will be wrapped using %s tag automatically and then will be added to your site\'s header', 'massive' ), array('<code>&lt;style type="text/css"&gt;...&lt/style&gt;</code>','<code>&lt;style type="text/css"&gt;...&lt/style&gt;</code>') ),
            ),
        array(
            'id'         => 'massive_css',
            'type'       => 'textarea',
            'sanitize'   => false,
            'attributes' => array(
                'style' => 'height:400px',
                ),
            )
        ),
    );
