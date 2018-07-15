<?php
/**
 * This file contains all the required and recommended plugin list.
 *
 * @package Massive
 * @author ThemeBucket <themebucket@gmail.com>
 */

/** TGM Activation added */
require_once MASSIVE_VENDORS_DIR . 'tgm-plugin-activation/class-tgm-plugin-activation.php';

class Massive_Plugins {

    public function __construct() {
        add_action( 'tgmpa_register', array($this, 'register') );
    }

    public function register() {
        tgmpa( $this->get_plugins(), $this->get_config() );
    }

    private function get_config() {
        return array(
            'id'           => 'massive',
            'default_path' => '',
            'menu'         => 'massive-install-plugins',
            'parent_slug'  => 'themes.php',
            'capability'   => 'edit_theme_options',
            'has_notices'  => true,
            'dismissable'  => true,
            'dismiss_msg'  => '',
            'is_automatic' => false,
            'message'      => '',
        );
    }

    private function get_plugins() {
        $imgs = MASSIVE_ASSETS_URI . 'admin/img/';

        return array(
            array(
                'name'             => 'Massive Engine',
                'slug'             => 'massive-engine',
                'source'           => MASSIVE_ROOT . 'plugins/massive-engine.zip',
                'required'         => true,
                'force_activation' => true,
                'version'          => '1.3.0',
                'image_url'        => esc_url( $imgs . 'massive_engine.jpg' ),
            ),

            array(
                'name'      => 'Contact Form 7',
                'slug'      => 'contact-form-7',
                'required'  => false,
                'image_url' => esc_url( $imgs . 'contact_form_7.jpg' ),
            ),

            array(
                'name'      => 'One Click Demo Import',
                'slug'      => 'one-click-demo-import',
                'required'  => false,
                'image_url' => esc_url( $imgs . '1click.jpg' ),
            ),

            array(
                'name'      => 'Visual Composer',
                'slug'      => 'js_composer',
                'required'  => false,
                'version'   => '5.1',
                'source'    => MASSIVE_ROOT . 'plugins/js_composer.zip',
                'image_url' => esc_url( $imgs . 'visual_composer.jpg' ),
            ),

            array(
                'name'      => 'Slider Revolution',
                'slug'      => 'revslider',
                'required'  => false,
                'version'   => '5.4.1',
                'source'    => MASSIVE_ROOT . 'plugins/revslider.zip',
                'image_url' => esc_url( $imgs . 'rev_slider.jpg' ),
            ),

            array(
                'name'      => 'WooCommerce',
                'slug'      => 'woocommerce',
                'required'  => false,
                'image_url' => esc_url( $imgs . 'woocommerce.jpg' ),
                'version'   => '2.6.14',
            ),
        );
    }

}

new Massive_Plugins;
