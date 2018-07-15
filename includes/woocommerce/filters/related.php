<?php

/**
 * Related product
 */
function woocommerce_output_related_products() {
    global $product;
    if ( empty( $product ) || ! $product->exists() ) {
        return;
    }

    $related = $product->get_related();
    $total_related = count( $related );
    if ( sizeof( $related ) == 0 ) return;

    $args = apply_filters( 'woocommerce_related_products_args', array(
        'post_type'            => 'product',
        'ignore_sticky_posts'  => 1,
        'no_found_rows'        => 1,
        'posts_per_page'       => $total_related,
        'orderby'              => 'rand',
        'post__in'             => $related,
        'post__not_in'         => array( $product->id )
    ) );
    $products = new WP_Query( $args );

    if ( $products->have_posts() ) { ?>

        <div class="row">
            <div class="col-md-12">

                <div class="heading-title-alt text-left m-bot-50">
                    <h3 class="text-uppercase"><?php esc_html_e( 'Related Products', 'massive' ); ?></h3>
                    <span class="text-uppercase">
                    <?php printf( esc_html__('We have %s similar product currently in stock', 'massive'), $total_related); ?>
                    </span>
                </div>

                <div class="product-list">
                    <div id="portfolio-carousel" class="portfolio-with-title col-3">
                        <?php while ( $products->have_posts() ) {
                            $products->the_post(); ?>
                            <div class="portfolio-item">
                                <div class="thumb">
                                    <?php echo '<a href="'.esc_url(get_permalink()).'">' . woocommerce_get_product_thumbnail() . '</a>'; ?>
                                    <div class="portfolio-hover">
                                        <div class="action-btn">
                                            <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to: %s', 'massive' ), get_the_title() ); ?>">
                                                <i class="icon-basic_magnifier"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="portfolio-title">
                                    <h4><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to: %s', 'massive' ), get_the_title() ); ?>"><?php the_title(); ?></a></h4>
                                    <?php woocommerce_template_loop_price(); ?>
                                </div>
                            </div>
                        <?php } ; // end of the loop. ?>
                    </div>
                </div> <!-- .product-list -->

            </div>
        </div> <!-- .row -->

    <?php } ;

    wp_reset_postdata();

}
