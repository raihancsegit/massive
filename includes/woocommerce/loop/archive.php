<?php
$grid       = cs_get_option( 'woo_grid', 'three' );
$grid_class = massive_get_grid_column_class( $grid );
$classes[]  = $grid_class;
global $product;
if ( ! $product || ! $product->is_visible() ) {
    return;
}
?>

<div <?php post_class( $classes ); ?>>
    <div class="product-list">
        <?php
        /** @hooked massive_woo_shop_thumbnail */
        do_action( 'woocommerce_before_shop_loop_item_title' );

        /** @hooked woocommerce_template_loop_product_title */
        do_action( 'woocommerce_shop_loop_item_title' );

        /**@hooked woocommerce_template_loop_price
         * @hooked woocommerce_template_loop_rating  */
        do_action( 'woocommerce_after_shop_loop_item_title' );

        /** @hooked woocommerce_template_loop_add_to_cart */
        do_action( 'woocommerce_after_shop_loop_item' );
        ?>
    </div>
</div>
