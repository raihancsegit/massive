<?php
/**
 * Proceed to checkout button
 *
 * Contains the markup for the proceed to checkout button on the cart
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
} ?>

<div class="cart-btn-row inline-block">
    <a href="<?php echo esc_url( wc_get_checkout_url() ) ;?>" class="checkout-button button alt wc-forward btn btn-medium btn-dark-solid pull-right"><?php esc_html_e( 'Proceed to Checkout', 'massive' ); ?></a><a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="btn btn-medium btn-dark-solid btn-transparent pull-right"><i class="fa fa-shopping-cart"></i> <?php esc_html_e( ' Continue Shopping', 'massive' ); ?></a>
</div>
