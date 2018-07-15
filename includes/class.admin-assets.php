<?php
/**
 * This class handles all the admin related assets.
 *
 * @package Massive
 * @author ThemeBucket <themebucket@gmail.com>
 */

class Massive_Admin_Assets {

    public function __construct() {
        $this->admin_assets = get_template_directory_uri() . '/assets/admin/';
        $this->assets = get_template_directory_uri() . '/assets/css/';
        add_action( 'admin_enqueue_scripts', array($this, 'enqueue_scripts'), 20 );
        add_action( 'admin_init', array($this, 'enqueue_editor_style') );
    }

    function enqueue_scripts( $hook ) {
        $pages = array(
            'toplevel_page_massive',
            'massive_page_massive-plugins',
            'massive_page_massive-status',
            'massive_page_massive-demo-importer',
            );

        if ( in_array( $hook, $pages ) ) {
            wp_enqueue_style( 'massive-admin-board', MASSIVE_ASSETS_URI . 'admin/css/dashboard.css' );
        }

        if ( 'post.php' === $hook || 'post-new.php' === $hook ) {
            wp_enqueue_script( 'massive-metabox', MASSIVE_ASSETS_URI . 'admin/js/metabox.js', array('jquery'), MASSIVE_VERSION, true );
        }

        wp_enqueue_script( 'massive-admin', MASSIVE_ASSETS_URI . 'admin/js/massive.js', array('jquery'), MASSIVE_VERSION, true );

        wp_enqueue_style( 'massive-linea-icon', MASSIVE_CSS_URI . 'linea-icon.css', array(), MASSIVE_VERSION );

        wp_deregister_style( 'font-awesome' );
        wp_deregister_style( 'fontawesome' );
        wp_enqueue_style( 'font-awesome', MASSIVE_CSS_URI . 'font-awesome.min.css', array(), MASSIVE_VERSION );

        wp_enqueue_style( 'massive-admin', MASSIVE_ASSETS_URI . 'admin/css/massive.css', array(), MASSIVE_VERSION );
    }

    public function enqueue_editor_style() {
        add_editor_style( MASSIVE_ASSETS_URI . 'admin/css/editor-style.css' );
    }

}

new Massive_Admin_Assets;