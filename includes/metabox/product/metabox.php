<?php
function massive_wc_product_metabox( $metabox ) {

    $metabox[]    = array(
        'id'        => '_massive_mb_wc',
        'title'     => esc_html__( 'Product Flip Image', 'massive' ),
        'post_type' => 'product',
        'context'   => 'side',
        'priority'  => 'low',
        'sections'  => array(
            array(
                'name'   => 'mb_wc_product',
                'fields' => array(
                    array(
                        'id'      => 'mb_wc_show_flip_image',
                        'type'    => 'switcher',
                        'title'   => esc_html__( 'Enable Product Flip Image', 'massive' ),
                        'default' => false,
                        'label'   => massive_esc_desc( __( 'Switch to enable/disable product flip image <br> (This image will be shown when hover on a product) ', 'massive' ) ),
                        ),
                    array(
                        'id'         => 'mb_wc_upload_flip_image',
                        'type'       => 'image',
                        'dependency' => array('mb_wc_show_flip_image', '==', 'true'),
                        'add_title'  => esc_html__( 'Upload Product Flip Image', 'massive' ),
                        )
                    ),
                ),

            ),
        );

    return $metabox;
}
add_filter( 'cs_metabox_options', 'massive_wc_product_metabox' );
