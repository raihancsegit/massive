<?php
/**
 * Edit account form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-account.php.
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
    exit;
}

do_action( 'woocommerce_before_edit_account_form' ); ?>

<form class="woocommerce-EditAccountForm edit-account" action="" method="post">

    <?php do_action( 'woocommerce_edit_account_form_start' ); ?>

    <h3 class="text-uppercase h4"><?php esc_html_e( 'Edit Account', 'massive' ); ?></h3>

    <div class="form-group">
        <label for="account_first_name" class="screen-reader-text"><?php esc_html_e( 'First name', 'massive' ); ?></label>
        <input type="text" class="form-control" name="account_first_name" id="account_first_name" placeholder="<?php esc_attr_e( 'First name *', 'massive' ); ?>" value="<?php echo esc_attr( $user->first_name ); ?>" />
    </div>
    <div class="form-group">
        <label for="account_last_name" class="screen-reader-text"><?php esc_html_e( 'Last name', 'massive' ); ?></label>
        <input type="text" class="form-control" name="account_last_name" id="account_last_name" placeholder="<?php esc_attr_e( 'Last name *', 'massive' ); ?>" value="<?php echo esc_attr( $user->last_name ); ?>" />
    </div>
    <div class="form-group">
        <label for="account_email" class="screen-reader-text"><?php esc_html_e( 'Email address', 'massive' ); ?></label>
        <input type="email" class="form-control m-bot-30" name="account_email" id="account_email" placeholder="<?php esc_attr_e( 'Email address', 'massive' ); ?>" value="<?php echo esc_attr( $user->user_email ); ?>" />
    </div>

    <h3 class="text-uppercase h4"><?php esc_html_e( 'Password Change', 'massive' ); ?></h3>

    <div class="form-group">
        <label for="password_current" class="screen-reader-text"><?php esc_html_e( 'Current Password (leave blank to leave unchanged)', 'massive' ); ?></label>
        <input type="password" class="form-control" name="password_current" id="password_current"placeholder="<?php esc_attr_e( 'Current Password (leave blank to leave unchanged)', 'massive' ); ?>" />
    </div>
    <div class="form-group">
        <label for="password_1" class="screen-reader-text"><?php esc_html_e( 'New Password (leave blank to leave unchanged)', 'massive' ); ?></label>
        <input type="password" class="form-control" name="password_1" id="password_1" placeholder="<?php esc_attr_e( 'New Password (leave blank to leave unchanged)', 'massive' ); ?>" />
    </div>
    <div class="form-group">
        <label for="password_2" class="screen-reader-text"><?php esc_html_e( 'Confirm New Password', 'massive' ); ?></label>
        <input type="password" class="form-control" name="password_2" id="password_2" placeholder="<?php esc_attr_e( 'Confirm New Password', 'massive' ); ?>" />
    </div>

    <?php do_action( 'woocommerce_edit_account_form' ); ?>

    <div>
        <?php wp_nonce_field( 'save_account_details' ); ?>
        <input type="submit" class="woocommerce-Button button btn btn-small btn-dark-solid" name="save_account_details" value="<?php esc_attr_e( 'Save changes', 'massive' ); ?>" />
        <input type="hidden" name="action" value="save_account_details" />
    </div>

    <?php do_action( 'woocommerce_edit_account_form_end' ); ?>
</form>

<?php do_action( 'woocommerce_after_edit_account_form' ); ?>
