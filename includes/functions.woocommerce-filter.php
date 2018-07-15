<?php
// Prevent woocommerce from loading stylesheet
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

// Modify form field arguments
add_filter( 'woocommerce_form_field_args', 'massive_modify_form_field_args' );

function massive_modify_form_field_args( $args ) {
    $args['class']       = array('form-group');
    $args['input_class'] = array('form-control');
    return $args;
}

function massive_product_review_list_args( $args ) {
    return array_merge( $args, array(
        'reverse_top_level' => true
        ) );
}
add_filter( 'woocommerce_product_review_list_args', 'massive_product_review_list_args' );


function massive_cart_item_thumbnail( $html ) {
    return str_replace( array('"180"','"180"'), array('"80"','"80"'), $html );
}
add_filter( 'woocommerce_cart_item_thumbnail', 'massive_cart_item_thumbnail' );
