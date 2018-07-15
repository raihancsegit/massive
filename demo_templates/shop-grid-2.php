<?php
/**
 * Template Name: Shop-2-Grid
 *
 * @package Massive
 */

get_header();

$layout         = 'boxed';
$sidebar        = 'right';
$container      = massive_get_container_class( $layout );
$column         = massive_get_column_class( $sidebar );

$grid       = 'two';
$grid_class = massive_get_grid_column_class( $grid );
$classes[]  = $grid_class;
global $product;
?>

<section class="page-title">
    <div class="<?php echo esc_attr( $container ); ?>">
        <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
            <?php  if ( is_singular( 'product' ) ) { ?>
                <h4 class="text-uppercase"><?php the_title(); ?></h4>
            <?php }else{ ?>
                <h4 class="text-uppercase"><?php woocommerce_page_title(); ?></h4>
            <?php } ?>
        <?php endif; ?>
        <?php if (function_exists('massive_breadcrumbs')) massive_breadcrumbs(); ?>
    </div>
</section>

<section class="body-content">
    <div class="page-content product-grid">
        <div class="<?php echo esc_attr( $container ); ?>">
            <div class="row">
                <div class="<?php echo esc_attr( $column['main'] ); ?>">
                    <div class="woocommerce">

                        <?php 
                            query_posts( array( 'post_type' => 'product', 'posts_per_page' => 10, ) );
                            if ( have_posts() ) { ?>

                            <div class="clearfix m-bot-30 inline-block">
                                <?php do_action('woocommerce_before_shop_loop'); ?>
                            </div>

                            <?php woocommerce_product_loop_start();

                                woocommerce_product_subcategories();

                                while ( have_posts() ) { the_post(); ?>

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
                                <?php } // end of the loop.

                                woocommerce_product_loop_end();

                                //do_action('woocommerce_after_shop_loop');

                            } elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) {

                                wc_get_template( 'loop/no-products-found.php' );

                        }   ?>

                    </div>
                </div>

                <?php if ( $sidebar != 'no-sidebar') { ?>
                <div class="<?php echo esc_attr( $column['sidebar'] ); ?>">
                    <?php
                        /**
                         * woocommerce_sidebar hook
                         * @hooked woocommerce_get_sidebar - 10
                         */
                        do_action( 'woocommerce_sidebar' );
                    ?>
                </div>
                <?php } ?>
            </div> <!-- .row -->
        </div> <!-- .container -->
    </div> <!-- page content -->
</section> <!-- body content -->

<?php get_footer(); ?>
