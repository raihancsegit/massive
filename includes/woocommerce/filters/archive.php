<?php
/**
 *  Output the result count text (Showing x - x of x results).
*/
function woocommerce_result_count() {
    global $wp_query;
    if ( ! woocommerce_products_will_display() )
        return;
    ?>
    <div class="woocommerce-result-count m-top-5">
        <?php
        $paged    = max( 1, $wp_query->get( 'paged' ) );
        $per_page = $wp_query->get( 'posts_per_page' );
        $total    = $wp_query->found_posts;
        $first    = ( $per_page * $paged ) - $per_page + 1;
        $last     = min( $total, $wp_query->get( 'posts_per_page' ) * $paged );

        if ( 1 == $total ) {
            esc_html_e( 'Showing the single result', 'massive' );
        } elseif ( $total <= $per_page || -1 == $per_page ) {
            printf( esc_html__( 'Showing all %d results', 'massive' ), $total );
        } else {
            printf( esc_html_x( 'Showing %1$d&ndash;%2$d of %3$d results', '%1$d = first, %2$d = last, %3$d = total', 'massive' ), $first, $last, $total );
        } ?>
    </div>
<?php }

//removed wc default sale flash' & added it on 'massive_wc_shop_thumbnail'
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash' );

//removed wc default 'woocommerce_template_loop_product_thumbnail' & created massive_wc_shop_thumbnail
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail' );

/**
 * Show tumbnail
 */
function massive_wc_shop_thumbnail() {
    global $post, $product;
    $metabox    = get_post_meta( $product->id, '_massive_mb_wc', 1 );
    ?>

    <div class="product-img">
        <?php
            echo '<a href="'.esc_url(get_permalink()).'" class="product-original">' . woocommerce_get_product_thumbnail() . '</a>';
            if ( isset( $metabox['mb_wc_upload_flip_image'] ) ) {
                $image_id   = $metabox['mb_wc_upload_flip_image'];
                $attachment = wp_get_attachment_image_src( $image_id, 'full' );
                echo '<a href="'.esc_url(get_permalink()).'" class="product-flip"><img src="'. esc_url($attachment[0]) .'"/> </a>';
            }
        ?>
        <?php if ( $product->is_on_sale() ) : ?>
            <?php echo apply_filters( 'woocommerce_sale_flash', '<div class="sale-label onsale">' . esc_html__( 'Sale!', 'massive' ) . '</div>', $post, $product ); ?>
        <?php endif; ?>
    </div>

<?php } ;

add_action( 'woocommerce_before_shop_loop_item_title', 'massive_wc_shop_thumbnail' );

/**
 * Product title
 */
function woocommerce_template_loop_product_title(){ ?>
    <div class="product-title">
        <h5><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to: %s', 'massive' ), get_the_title() ); ?>"><?php the_title(); ?></a></h5>
    </div>
<?php }

//Removed wc default loop price
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price' );

/**
 * Product loop modified price
 */
function woocommerce_template_loop_price(){ ?>
    <?php global $product;
    if ( $price_html = $product->get_price_html() ) : ?>
        <div class="price product-price"><?php echo $price_html; ?></div>
    <?php endif; ?>
<?php }

/**
 * Product loop price added again with custom priority (before ratting)
 */
add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 2);

/**
 * Product loop ratting
 */
function woocommerce_template_loop_rating(){
    global $product;
    if ( get_option( 'woocommerce_enable_review_rating' ) === 'no' ) return; ?>
    <?php if ( $rating_html = $product->get_rating_html() ) : ?>
        <div class="product-rating">
           <?php echo $rating_html; ?>
        </div>
    <?php endif;
}

/**
 * Add to cart
 */
function woocommerce_template_loop_add_to_cart() {
    global $product;
    echo apply_filters( 'woocommerce_loop_add_to_cart_link',
        sprintf( '<div class="product-btn"><a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" data-quantity="%s" class="%s product_type_%s btn btn-extra-small btn-dark-border"><i class="fa fa-shopping-cart"></i> %s</a></div>',
            esc_url( $product->add_to_cart_url() ),
            esc_attr( $product->id ),
            esc_attr( $product->get_sku() ),
            esc_attr( isset( $quantity ) ? $quantity : 1 ),
            $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
            esc_attr( $product->product_type ),
            esc_html( $product->add_to_cart_text() )
        ),
    $product );
}

/**
 * Modified shop pagination
 */
function woocommerce_pagination() {

    global $wp_query;
    if ( $wp_query->max_num_pages <= 1 ) {
        return;
    }
    $big = 999999999; // need an unlikely integer

    $links = paginate_links(array(
        'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages,
        'type' => 'array',
        'prev_next' => true,
        'prev_text' => esc_html__('Prev', 'massive'),
        "next_text" => esc_html__('Next', 'massive'),
        'mid_size' => 3
    ));
    ?>
    <div class="text-center col-md-12">
        <ul class="pagination custom-pagination">
            <?php
            if ($links) {
                foreach ($links as $link) {
                    if (strpos($link, "current") !== false)
                        echo '<li class="active page-numbers"><a>' . $link . "</a></li>\n";
                    else
                        echo '<li class="page-numbers">' . $link . "</li>\n";
                }
            }
            ?>
        </ul>
    </div>
    <?php

    };
add_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination' );

