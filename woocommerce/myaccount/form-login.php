<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

?>

<?php wc_print_notices(); ?>

<?php do_action( 'woocommerce_before_customer_login_form' ); ?>

<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>

<div id="customer_login">

    <div class="col-md-6">

<?php endif; ?>

        <div class="heading-title-alt text-left m-bot-10">
            <h3 class="text-uppercase"><?php esc_html_e( 'Login', 'massive' ); ?></h3>
        </div>

        <form method="post" class="login">

            <?php do_action( 'woocommerce_login_form_start' ); ?>

            <div class="form-group">
                <label for="username" class="screen-reader-text"><?php esc_html_e( 'Username or email address', 'massive' ); ?></label>
                <input type="text" class="form-control" name="username" id="username" placeholder="<?php esc_attr_e( 'Username or email address *', 'massive' ); ?>" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>" />
            </div>
            <div class="form-group">
                <label for="password" class="screen-reader-text"><?php esc_html_e( 'Password', 'massive' ); ?> <span class="required">*</span></label>
                <input class="form-control" type="password" name="password" id="password" placeholder="<?php esc_attr_e( 'Password *', 'massive' ); ?>" />
            </div>

            <?php do_action( 'woocommerce_login_form' ); ?>

            <div class="form-group">
                <?php wp_nonce_field( 'woocommerce-login' ); ?>
                <input type="submit" class="btn btn-small btn-dark-solid full-width" name="login" value="<?php esc_attr_e( 'Login', 'massive' ); ?>" />
            </div>

            <div class="checkbox">
                <label><input name="rememberme" type="checkbox" id="rememberme" value="forever"> <?php esc_html_e( 'Remember me', 'massive' ); ?></label>
                <a class="pull-right" href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'massive' ); ?></a>
            </div>

            <?php do_action( 'woocommerce_login_form_end' ); ?>

        </form>

<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>

    </div>

    <div class="col-md-6">

        <div class="heading-title-alt text-left m-bot-10">
            <h3 class="text-uppercase"><?php esc_html_e( 'Register', 'massive' ); ?></h3>
        </div>

        <form method="post" class="register">

            <?php do_action( 'woocommerce_register_form_start' ); ?>

            <?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

                <div class="form-group">
                    <label for="reg_username" class="screen-reader-text"><?php esc_html_e( 'Username', 'massive' ); ?></label>
                    <input type="text" class="form-control" name="username" id="reg_username" placeholder="<?php esc_attr_e( 'Username *', 'massive' ); ?>" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>" />
                </div>

            <?php endif; ?>

            <div class="form-group">
                <label for="reg_email" class="screen-reader-text"><?php esc_html_e( 'Email address', 'massive' ); ?> <span class="required">*</span></label>
                <input type="email" class="form-control" name="email" id="reg_email" placeholder="<?php esc_attr_e( 'Email address *', 'massive' ); ?>" value="<?php if ( ! empty( $_POST['email'] ) ) echo esc_attr( $_POST['email'] ); ?>" />
            </div>

            <?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

                <div class="form-group">
                    <label for="reg_password" class="screen-reader-text"><?php _e( 'Password', 'massive' ); ?></label>
                    <input type="password" class="form-control" name="password" id="reg_password" placeholder="<?php esc_attr_e( 'Password *', 'massive' ); ?>" />
                </div>

            <?php endif; ?>

            <!-- Spam Trap -->
            <div style="<?php echo ( ( is_rtl() ) ? 'right' : 'left' ); ?>: -999em; position: absolute;"><label for="trap"><?php esc_html_e( 'Anti-spam', 'massive' ); ?></label><input type="text" name="email_2" id="trap" tabindex="-1" /></div>

            <?php do_action( 'woocommerce_register_form' ); ?>
            <?php do_action( 'register_form' ); ?>

            <p class="form-row">
                <?php wp_nonce_field( 'woocommerce-register' ); ?>
                <input type="submit" class="woocommerce-Button button btn btn-small btn-dark-solid full-width" name="register" value="<?php esc_attr_e( 'Register', 'massive' ); ?>" />
            </p>

            <?php do_action( 'woocommerce_register_form_end' ); ?>

        </form>

    </div>

</div>
<?php endif; ?>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
