<?php

/**
 * Single product thumbnail
 */
function woocommerce_show_product_images() {
    global $post, $woocommerce, $product;
    $attachment_ids = $product->get_gallery_attachment_ids(); ?>

    <div class="post-list-aside">
        <div class="post-single">
            <div class="post-slider-thumb post-img text-center">
                <?php if ( $attachment_ids ) {
                    $loop       = 0;
                    $columns    = apply_filters( 'woocommerce_product_thumbnails_columns', 3 );
                ?>

                <?php if ( $product->is_on_sale() ) { ?>
                <?php echo apply_filters( 'woocommerce_sale_flash', '<div class="sale-label onsale">' . esc_html__( 'Sale!', 'massive' ) . '</div>', $post, $product ); ?>
                <?php } ?>

                <ul class="slides">
                    <?php
                        foreach ( $attachment_ids as $attachment_id ) {

                        $classes = array( 'zoom' );

                        if ( $loop == 0 || $loop % $columns == 0 )
                            $classes[] = 'first';

                        if ( ( $loop + 1 ) % $columns == 0 )
                            $classes[] = 'last';

                        $image_link = wp_get_attachment_url( $attachment_id );

                        if ( ! $image_link )
                            continue;

                        $image_title    = esc_attr( get_the_title( $attachment_id ) );
                        $image_caption  = esc_attr( get_post_field( 'post_excerpt', $attachment_id ) );

                        $image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'massive-sm-soft' ), 0, $attr = array(
                            'title' => $image_title,
                            'alt'   => $image_title
                            ) );

                        $image_class = esc_attr( implode( ' ', $classes ) );

                        echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<li data-thumb="%s"><a href="%s" class="%s" title="%s" data-rel="prettyPhoto[product-gallery]">%s</a></li>', esc_attr($image_link), esc_url($image_link), $image_class, esc_attr($image_caption), $image ), $attachment_id, $post->ID, $image_class );

                        $loop++;
                        } ?>
                    </ul>
                <?php } else{
                    echo woocommerce_get_product_thumbnail();
                } ?>
            </div>  <!-- .post-slider -->
        </div>  <!-- .post-single -->
    </div> <!-- .post-list -->
<?php }


/**
 * Single prodcut title
 */
function woocommerce_template_single_title() { ?>
    <div class="product-title">
        <h2 itemprop="name" class="text-uppercase" title="<?php printf( esc_attr__( 'Permalink to: %s', 'massive' ), get_the_title() ); ?>"><?php the_title(); ?></h2>
    </div>
<?php }

// Removed wc default single product sale flash & added with 'woocommerce_show_product_images'
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash');

/**
 * Single product price
 */
function woocommerce_template_single_price() {
    global $product;?>
    <div class="product-price txt-xl">
        <div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
            <span class="border-tb p-tb-10 m-bot-10"><?php echo $product->get_price_html(); ?></span>
            <meta itemprop="price" content="<?php echo esc_attr( $product->get_price() ); ?>" />
            <meta itemprop="priceCurrency" content="<?php echo esc_attr( get_woocommerce_currency() ); ?>" />
            <span class="status">
                <?php echo $product->is_in_stock() ? esc_html__( 'InStock', 'massive' ) : esc_html__( 'OutOfStock', 'massive') ; ?>
            </span>
        </div>
    </div>
<?php }

/**
 * Excerpt on single product page
 */
function woocommerce_template_single_excerpt() {
    global $post;
    if ( ! $post->post_excerpt ) { return; } ?>

    <div itemprop="description">
        <?php echo apply_filters( 'woocommerce_short_description', $post->post_excerpt ) ?>
    </div>
<?php }


/**
 * Return false the product ratting on single product page
 */
function woocommerce_template_single_rating() {
    return;
}


/**
 * Simple add to cart button on product single page
 */
function woocommerce_simple_add_to_cart() {
    global $product;
    if ( ! $product->is_purchasable() ) {
        return;
    }

    // Availability
    $availability      = $product->get_availability();
    $availability_html = empty( $availability['availability'] ) ? '' : '<p class="stock ' . esc_attr( $availability['class'] ) . '">' . esc_html( $availability['availability'] ) . '</p>';

        echo apply_filters( 'woocommerce_stock_html', $availability_html, $availability['availability'], $product );
    ?>
    <?php if ( $product->is_in_stock() ) : ?>

        <?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>

        <div class="clearfix">
            <form class="cart" method="post" enctype='multipart/form-data'>

                <?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

                <div class="p-values">
                    <ul class="p-quantity m-bot-10 ">
                        <li class="label--quantity">
                            <span><?php esc_html_e( 'Quantity', 'massive' ); ?></span>
                        </li>
                        <li>
                        <?php
                            if ( ! $product->is_sold_individually() ) {
                                woocommerce_quantity_input( array(
                                    'min_value'   => apply_filters( 'woocommerce_quantity_input_min', 1, $product ),
                                    'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->backorders_allowed() ? '' : $product->get_stock_quantity(), $product ),
                                    'input_value' => ( isset( $_POST['quantity'] ) ? wc_stock_amount( $_POST['quantity'] ) : 1 )
                                ) );
                            }
                        ?>
                        </li>
                        <li>
                            <input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->id ); ?>" />
                            <button type="submit" class="single_add_to_cart_button btn btn-small btn-dark-solid alt m-left-10">
                                <i class="fa fa-shopping-cart"></i>
                                <?php echo esc_html( $product->single_add_to_cart_text() ); ?>
                            </button>
                        </li>
                    </ul>
                </div>

                <?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>

            </form>
        </div> <!-- .clearfix -->

        <?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

    <?php endif;

}

/**
 * Singple product data tab
 */
function woocommerce_output_product_data_tabs() {
    $tabs = apply_filters( 'woocommerce_product_tabs', array() );

    if ( ! empty( $tabs ) ) { ?>
        <div class="row page-content">
            <div class="col-md-12">
                <section class="normal-tabs">
                    <ul class="nav nav-tabs">
                        <?php foreach ( $tabs as $key => $tab ) : ?>
                        <li class="<?php echo esc_attr( $key ); ?>_tab">
                            <a data-toggle="tab" href="#tab-<?php echo esc_attr( $key ); ?>"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ); ?></a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="panel-body">
                        <div class="tab-content">
                            <?php foreach ( $tabs as $key => $tab ) : ?>
                            <div id="tab-<?php echo esc_attr( $key ); ?>" class="tab-pane">
                                <?php call_user_func( $tab['callback'], $key, $tab ); ?>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div> <!-- .col-md-12 -->
        </div> <!-- .row & .page-contetn -->
    <?php } ?>

<?php }


/**
 * Description tab
 */
function woocommerce_product_description_tab() {
    global $post;
    $heading = esc_html( apply_filters( 'woocommerce_product_description_heading', esc_html__( 'Product Description', 'massive' ) ) );?>

    <?php if ( $heading ): ?>
      <h4 class="text-uppercase"><?php echo $heading; ?></h4>
    <?php endif; ?>
    <?php the_content(); ?>
<?php }

/**
 * Additional information tab
 */
function woocommerce_product_additional_information_tab() {
    global $product;

    $heading = apply_filters( 'woocommerce_product_additional_information_heading', esc_html__( 'Additional Information', 'massive' ) );
    ?>
    <?php if ( $heading ): ?>
        <h4 class="text-uppercase"><?php echo $heading; ?></h2>
    <?php endif; ?>
    <?php $product->list_attributes(); ?>
<?php }

/**
 * Disabled wc up sell
 */
function woocommerce_upsell_display() {
    return ;
}




/**
 * Output placeholders for the single variation.
 */
function woocommerce_single_variation() {
    echo '<div class="single_variation"></div>';
}


/**
 * Output the add to cart button for variations.
 */
function woocommerce_single_variation_add_to_cart_button() {
    global $product;
    ?>
    <div class="variations_button">
        <div class="p-values">
            <ul class="p-quantity m-bot-10 ">
                <li><label><?php esc_html_e( 'Quantity', 'massive' ); ?></label></li>
                <?php woocommerce_quantity_input( array( 'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( $_POST['quantity'] ) : 1 ) ); ?>
                <li>
                    <button type="submit" class="single_add_to_cart_button btn btn-small btn-dark-solid alt m-left-10">
                        <i class="fa fa-shopping-cart"></i>
                        <?php echo esc_html( $product->single_add_to_cart_text() ); ?>
                    </button>
                    <input type="hidden" name="add-to-cart" value="<?php echo absint( $product->id ); ?>" />
                    <input type="hidden" name="product_id" value="<?php echo absint( $product->id ); ?>" />
                    <input type="hidden" name="variation_id" class="variation_id" value="" />
                </li>
            </ul>
        </div>
    </div>
    <?php
}



/**
 * Output the variable product add to cart area.
 */
if ( ! function_exists( 'woocommerce_variable_add_to_cart' ) ) {

    function woocommerce_variable_add_to_cart() {
        global $product;

        // Enqueue variation scripts
        wp_enqueue_script( 'wc-add-to-cart-variation' );

        // Get Available variations?
        $get_variations = sizeof( $product->get_children() ) <= apply_filters( 'woocommerce_ajax_variation_threshold', 30, $product );

        // Load the template

        $available_variations = $get_variations ? $product->get_available_variations() : false;
        $attributes           = $product->get_variation_attributes();
        $selected_attributes  = $product->get_variation_default_attributes();
        $attribute_keys       = array_keys( $attributes );

        do_action( 'woocommerce_before_add_to_cart_form' ); ?>

        <form class="variations_form cart" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->id ); ?>" data-product_variations="<?php echo esc_attr( json_encode( $available_variations ) ) ?>">
            <?php do_action( 'woocommerce_before_variations_form' ); ?>

            <?php if ( empty( $available_variations ) && false !== $available_variations ) : ?>
                <p class="stock out-of-stock"><?php esc_html_e( 'This product is currently out of stock and unavailable.', 'massive' ); ?></p>
            <?php else : ?>
                <div class="variations" cellspacing="0">
                    <ul class="portfolio-meta m-bot-10">
                        <?php foreach ( $attributes as $attribute_name => $options ) : ?>
                            <li>
                                <span><?php echo wc_attribute_label( $attribute_name ); ?></span>
                                <span class="options">
                                    <?php
                                        $selected = isset( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) ? wc_clean( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) : $product->get_variation_default_attribute( $attribute_name );
                                        wc_dropdown_variation_attribute_options( array( 'options' => $options, 'attribute' => $attribute_name, 'product' => $product, 'selected' => $selected ) );
                                    ?>
                                </span>
                            </li>
                            <li>
                                <?php echo end( $attribute_keys ) === $attribute_name ? '<a class="reset_variations" href="#">' . esc_html__( 'Clear selection', 'massive' ) . '</a>' : ''; ?>
                            </li>
                        <?php endforeach;?>
                    </ul>
                </div>

                <?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

                <div class="single_variation_wrap" style="display:none;">
                    <?php
                        /**
                         * woocommerce_before_single_variation Hook
                         */
                        do_action( 'woocommerce_before_single_variation' );

                        /**
                         * woocommerce_single_variation hook. Used to output the cart button and placeholder for variation data.
                         * @since 2.4.0
                         * @hooked woocommerce_single_variation - 10 Empty div for variation data.
                         * @hooked woocommerce_single_variation_add_to_cart_button - 20 Qty and cart button.
                         */
                        do_action( 'woocommerce_single_variation' );

                        /**
                         * woocommerce_after_single_variation Hook
                         */
                        do_action( 'woocommerce_after_single_variation' );
                    ?>
                </div>

                <?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
            <?php endif; ?>

            <?php do_action( 'woocommerce_after_variations_form' ); ?>
        </form>

        <?php do_action( 'woocommerce_after_add_to_cart_form' );
    }
}


function woocommerce_comments( $comment, $args, $depth ) {

    $GLOBALS['comment'] = $comment;
    $rating = intval( get_comment_meta( $comment->comment_ID, 'rating', true ) );
    ?>
    <li itemprop="review" itemscope itemtype="http://schema.org/Review" <?php comment_class('media'); ?> id="li-comment-<?php comment_ID() ?>">

        <div class="pull-left">
            <?php echo get_avatar( $comment, apply_filters( 'woocommerce_review_gravatar_size', '60' ), '' ); ?>
        </div>
        <div class="media-body">

            <div class="comment-info">

                <?php if ( $comment->comment_approved == '0' ) : ?>

                    <p class="meta"><em><?php esc_html_e( 'Your comment is awaiting approval', 'massive' ); ?></em></p>

                <?php else : ?>

                    <div class="reviewer text-uppercase">
                        <strong itemprop="author"><?php comment_author(); ?></strong>
                    </div>
                    <?php echo get_comment_date( wc_date_format() ); ?>

                    <span class="review-rating">
                        <?php if ( $rating && get_option( 'woocommerce_enable_review_rating' ) == 'yes' ) : ?>

                            <div itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating" class="star-rating" title="<?php echo sprintf( esc_html__( 'Rated %d out of 5', 'massive' ), $rating ) ?>">
                                <span style="width:<?php echo ( $rating / 5 ) * 100; ?>%"></span>
                            </div>

                        <?php endif; ?>
                    </span>

                        <?php
                            if ( get_option( 'woocommerce_review_rating_verification_label' ) === 'yes' )
                                if ( wc_customer_bought_product( $comment->comment_author_email, $comment->user_id, $comment->comment_post_ID ) )
                                    echo '<em class="verified">(' . esc_html__( 'verified owner', 'massive' ) . ')</em> ';

                        ?>
                <?php endif; ?>
                <?php comment_text(); ?>
            </div>
        </div>
<?php }
