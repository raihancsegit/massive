<?php
/**
 * Login form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/form-login.php.
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
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if ( is_user_logged_in() ) {
    return;
}

?>
<div class="row">
    <form class="col-md-6 col-sm-12 login" method="post" <?php if ( $hidden ) echo 'style="display:none;"'; ?>>

        <?php do_action( 'woocommerce_login_form_start' ); ?>
        <?php if ( $message ) echo wpautop( wptexturize( $message ) ); ?>

        <div class="form-group">
            <label for="username" class="screen-reader-text"><?php esc_html_e( 'Username or email', 'massive' ); ?></label>
            <input type="text" class="form-control" name="username" id="username" placeholder="<?php esc_attr_e( 'Username or email', 'massive' ); ?>" />
        </div>

        <div class="form-group">
            <label for="password" class="screen-reader-text"><?php esc_html_e( 'Password', 'massive' ); ?></label>
            <input class="form-control" type="password" name="password" id="password" placeholder="<?php esc_attr_e( 'Password', 'massive' ); ?>"/>
        </div>

        <?php do_action( 'woocommerce_login_form' ); ?>

        <div class="form-group">
            <?php wp_nonce_field( 'woocommerce-login' ); ?>
            <input class="button btn btn-small btn-dark-solid full-width" value="<?php esc_attr_e( 'Login', 'massive' ); ?>" type="submit" name="login">
        </div>

        <div class="form-group">
            <input type="hidden" name="redirect" value="<?php echo esc_url( $redirect ) ?>" />
            <div class="checkbox">
                <label>
                  <input type="checkbox" name="rememberme" value="forever" id="rememberme"><?php esc_html_e('Remember  me', 'massive'); ?>
                </label>
                <a class="pull-right" href="<?php echo esc_url( wp_lostpassword_url() ); ?>"> <?php esc_html_e( 'Lost your password?', 'massive' ); ?></a>
            </div>
        </div>

        <?php do_action( 'woocommerce_login_form_end' ); ?>

    </form>
</div>
