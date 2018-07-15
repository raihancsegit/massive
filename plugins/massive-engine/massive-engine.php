<?php
/*
Plugin Name: Massive Engine
Description: Massive Engine is the core plugin for Massive WordPress Theme. You must install this plugin to get a full fledge Massive WordPress Theme, otherwise you'll miss some cool features.
Plugin URI: http://massive.themebucket.net/
Author: Theme Bucket
Author URI: http://themebucket.net
Version: 1.3.0
License: GPL2
Text Domain: massive-engine
Domain Path: /languages
*/

// Prevent direct access
defined( 'ABSPATH' ) || die( 'No Direct Access' );

/*******************************************************************
 * Constants
 *******************************************************************/

/** Massive Engine version  */
define( 'MASSIVE_ENGINE_VERSION', '1.3.0' );

/** Massive Engine directory path  */
define( 'MASSIVE_ENGINE_DIR', trailingslashit( plugin_dir_path( __FILE__ ) ) );

/** Massive Engine includes directory path  */
define( 'MASSIVE_ENGINE_INCLUDES_DIR', trailingslashit( MASSIVE_ENGINE_DIR . 'includes' ) );

/** Massive Engine shortcodes directory path  */
define( 'MASSIVE_ENGINE_SHORTCODES_DIR', trailingslashit( MASSIVE_ENGINE_DIR . 'shortcodes' ) );

/** Massive Engine url  */
define( 'MASSIVE_ENGINE_URL', trailingslashit(  plugin_dir_url( __FILE__ ) ) );


class Massive_Engine {

    public function __construct() {
        register_activation_hook( __FILE__, array($this, 'activate') );

        $this->load_helpers();

        $this->load_shortcodes();

        add_action( 'plugins_loaded', array($this, 'load_textdomain') );
    }

    public function activate() {
        if ( ! get_option( 'massive_engine_version' ) ) {
            update_option( 'massive_engine_old', true  );
        }
        update_option( 'massive_engine_version', MASSIVE_ENGINE_VERSION );

        // flash rewrite rules because of custom post type
        flush_rewrite_rules();
    }

    public function load_textdomain() {
        load_plugin_textdomain( 'massive-engine', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
    }

    private function load_helpers() {
        // helper functions
        require_once  MASSIVE_ENGINE_INCLUDES_DIR . 'functions.php';

        // massive icons
        require_once  MASSIVE_ENGINE_INCLUDES_DIR . 'icons.php';

        // custom field type
        require_once  MASSIVE_ENGINE_INCLUDES_DIR . 'class.tb-vc-preview-field.php';
        require_once  MASSIVE_ENGINE_INCLUDES_DIR . 'class.tb-vc-gdropdown-field.php';

        // shortcode base
        require_once  MASSIVE_ENGINE_INCLUDES_DIR . 'class.shortcode.php';

        // custom post type
        require_once  MASSIVE_ENGINE_INCLUDES_DIR . 'class.custom-types.php';
    }

    /**
     * Include all shortcode files
     * @return null
     */
    private function load_shortcodes() {
        foreach ( glob( MASSIVE_ENGINE_SHORTCODES_DIR . '*/*.php' ) as $shortcode ) {
            if ( ! file_exists( $shortcode ) ) {
                continue;
            }
            require_once $shortcode;
        }
    }

}

new Massive_Engine;