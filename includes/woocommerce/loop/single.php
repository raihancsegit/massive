<div class="row">
    <div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class() ; ?>>
        <div>

            <div class="col-md-5">
            <?php
                /**
                 * @hooked woocommerce_show_product_sale_flash
                 * @hooked woocommerce_show_product_images */
                do_action( 'woocommerce_before_single_product_summary' );
                ?>
            </div>

            <div class="col-md-7">
                <?php
                /**
                 * @hooked woocommerce_template_single_title - 5
                 * @hooked woocommerce_template_single_price - 10
                 * @hooked woocommerce_template_single_excerpt - 20
                 * @hooked woocommerce_template_single_add_to_cart - 30
                 * @hooked woocommerce_template_single_meta - 40
                 * @hooked woocommerce_template_single_sharing - 50
                 */
                do_action( 'woocommerce_single_product_summary' );
                ?>
            </div>

        </div> <!-- .row -->

        <?php
        /**
         * @hooked woocommerce_output_product_data_tabs - 10
         * @hooked woocommerce_upsell_display - 15
         * @hooked woocommerce_output_related_products - 20
         */
        do_action( 'woocommerce_after_single_product_summary' );
        ?>

        <meta itemprop="url" content="<?php the_permalink(); ?>" />
    </div><!-- #product-<?php the_ID(); ?> -->

    <?php do_action( 'woocommerce_after_single_product' ); ?>

