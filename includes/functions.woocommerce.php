<?php
require MASSIVE_INCLUDES_DIR . 'woocommerce/filters/archive.php';
require MASSIVE_INCLUDES_DIR . 'woocommerce/filters/single.php';
require MASSIVE_INCLUDES_DIR . 'woocommerce/filters/related.php';

/**
 * Output WooCommerce content.
 */
if ( ! function_exists( 'woocommerce_content' ) ) {

    function woocommerce_content() {

        if ( is_singular( 'product' ) ) {

            while ( have_posts() ) { the_post(); ?>

                <?php
                    /** @hooked wc_print_notices */
                     do_action( 'woocommerce_before_single_product' );

                     if ( post_password_required() ) {
                        echo get_the_password_form();
                        return;
                     }

                    get_template_part( 'includes/woocommerce/loop/single' );


            } // end of the loop.

        } else { ?>

            <?php if ( have_posts() ) { ?>

                <div class="clearfix m-bot-30 inline-block">
                    <?php do_action('woocommerce_before_shop_loop'); ?>
                </div>

                <?php woocommerce_product_loop_start();

                    woocommerce_product_subcategories();

                    while ( have_posts() ) { the_post();

                        get_template_part( 'includes/woocommerce/loop/archive' );

                    } // end of the loop.

                    woocommerce_product_loop_end();

                    do_action('woocommerce_after_shop_loop');

                } elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) {

                    wc_get_template( 'loop/no-products-found.php' );

            }

        };

    }
}


