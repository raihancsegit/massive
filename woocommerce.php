<?php
/**
 * WooCommerce default template.
 *
 * @package Massive
 */

get_header();

$layout    = cs_get_option( 'woo_layout', 'boxed' );
$sidebar   = cs_get_option( 'woo_sidebar', 'sidebar' );
$container = massive_get_container_class( $layout );
$column    = massive_get_column_class( $sidebar );
?>

<section class="page-title">
    <div class="<?php echo esc_attr( $container ); ?>">
        <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) { ?>
            <?php  if ( is_singular( 'product' ) ) { ?>
                <h4 class="text-uppercase"><?php the_title(); ?></h4>
            <?php } else { ?>
                <h4 class="text-uppercase"><?php woocommerce_page_title(); ?></h4>
            <?php } ?>
        <?php } ?>
        <?php if ( function_exists('massive_breadcrumbs') ) massive_breadcrumbs(); ?>
    </div>
</section>

<section class="body-content">
    <div class="page-content product-grid">
        <div class="<?php echo esc_attr( $container ); ?>">
            <div class="row">
                <div class="<?php echo esc_attr( $column['main'] ); ?>">
                    <?php
                        if ( is_page() ) {
                            the_content();
                        } else {
                            woocommerce_content();
                        }
                    ?>
                </div>

                <?php if ( $sidebar !== 'no-sidebar' ) { ?>
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
