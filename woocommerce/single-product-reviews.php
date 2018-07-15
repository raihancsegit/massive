<?php
/**
 * Display single product reviews (comments)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product-reviews.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     2.3.2
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

global $product;

if ( ! comments_open() ) {
    return;
}

?>
<div id="reviews" class="woocommerce-Reviews">
    <div id="comments">
        <h2 class="woocommerce-Reviews-title"><?php
            if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' && ( $count = $product->get_review_count() ) )
                printf( _n( '%s review for %s%s%s', '%s reviews for %s%s%s', $count, 'massive' ), $count, '<span>', get_the_title(), '</span>' );
            else
                esc_html_e( 'Reviews', 'massive' );
        ?></h2>

        <?php if ( have_comments() ) : ?>

            <ol class="commentlist media-list comments-list clearlist">
                <?php wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'woocommerce_comments' ) ) ); ?>
            </ol>

            <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
                echo '<nav class="woocommerce-pagination">';
                paginate_comments_links( apply_filters( 'woocommerce_comment_pagination_args', array(
                    'prev_text' => '&larr;',
                    'next_text' => '&rarr;',
                    'type'      => 'list',
                ) ) );
                echo '</nav>';
            endif; ?>

        <?php else : ?>

            <p class="woocommerce-noreviews"><?php esc_html_e( 'There are no reviews yet.', 'massive' ); ?></p>

        <?php endif; ?>
    </div>

    <?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->id ) ) : ?>

        <div id="review_form_wrapper">
            <div id="review_form">
                <div class="heading-title-alt text-left m-bot-10">
                    <h4 class="text-uppercase"><?php echo have_comments() ? esc_html__( 'Add a review', 'massive' ) : sprintf( esc_html__( 'Be the first to review &ldquo;%s&rdquo;', 'massive' ), get_the_title() ); ?></h4>
                </div>
                <?php
                    $commenter = wp_get_current_commenter();

                    $comment_form = array(
                        'title_reply_to'       => __( 'Leave a Reply to %s', 'massive' ),
                        'comment_notes_after'  => '',
                        'fields'               => array(
                            'author' => '<div class="col-md-6 form-group m-left--15"><input class="form-control" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" placeholder="' . esc_attr__( 'Name *', 'massive') . '" /></p></div>',
                            'email'  => '<div class="col-md-6 form-group"><input id="email" name="email" class="form-control" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-required="true" placeholder="' . esc_attr__( 'Email *', 'massive') . '" /></p></div>',
                        ),
                        'label_submit'  => esc_html__( 'Submit', 'massive' ),
                        'logged_in_as'  => '',
                        'comment_field' => ''
                    );

                    if ( $account_page_url = wc_get_page_permalink( 'myaccount' ) ) {
                        $comment_form['must_log_in'] = '<p class="must-log-in">' .
                          massive_esc_desc( __( 'You must be %s to post a review.', 'massive' ),
                            array(
                                '<a href="'. esc_url( $account_page_url ) . '">' . esc_html('logged in', 'massive') . '</a>',
                                )
                            )
                           . '</p>';
                    }

                    if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) {
                        $comment_form['comment_field'] = '<div class="form-group col-md-12 m-left--15"><select name="rating" id="" class="form-control">
                            <option value="">' . esc_html__( 'Rate&hellip;', 'massive' ) . '</option>
                            <option value="5">' . esc_html__( 'Perfect', 'massive' ) . '</option>
                            <option value="4">' . esc_html__( 'Good', 'massive' ) . '</option>
                            <option value="3">' . esc_html__( 'Average', 'massive' ) . '</option>
                            <option value="2">' . esc_html__( 'Not that bad', 'massive' ) . '</option>
                            <option value="1">' . esc_html__( 'Very Poor', 'massive' ) . '</option>
                        </select></div>';
                    }

                    $comment_form['comment_field'] .= '<div class="form-group col-md-12 m-left--15"><textarea id="comment" class="form-control" name="comment" rows="6" aria-required="true" placeholder="' . esc_attr__( 'Comment *', 'massive') . '"></textarea></div>';

                    comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
                ?>
            </div>
        </div>

    <?php else : ?>

        <p class="woocommerce-verification-required"><?php esc_html_e( 'Only logged in customers who have purchased this product may leave a review.', 'massive' ); ?></p>

    <?php endif; ?>

    <div class="clear"></div>
</div>
