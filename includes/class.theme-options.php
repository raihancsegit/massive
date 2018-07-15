<?php
/**
 * Initialize CodeStar and register theme options.
 *
 * @package Massive
 * @author ThemeBucket <themebucket@gmail.com>
 */

class Massive_Theme_Options {

    public function __construct() {
        add_action( 'init', array($this, 'setup_options_panel') );
        add_filter( 'cs_framework_options', array($this, 'register_options') );
    }

    public function setup_options_panel() {
        $settings = array(
            'menu_title' => esc_html__( 'Theme Options', 'massive' ),
            'menu_type' => 'add_theme_page',
            'menu_slug' => 'theme-options',
            'ajax_save' => true,
            );

        $options  = array();
        CSFramework::instance( $settings, $options );

        $metaboxes = array();
        CSFramework_Metabox::instance( $metaboxes );

        $shortcodes = array();
        CSFramework_Shortcode_Manager::instance( $shortcodes );
    }

    public function register_options( $massive_options ) {
        $dir = trailingslashit( MASSIVE_INCLUDES_DIR . 'options' );
        $imgs = trailingslashit( MASSIVE_ASSETS_URI . 'admin/img' );

        $sections = array(
            'general',
            'header',
            'blog',
            'portfolio',
            'woocommerce',
            'footer',
            'social',
            '404',
            'css',
            'js',
            'typography',
            'advanced',
            'backup',
            );

        foreach ( $sections as $section ) {
            $section_file = "{$dir}{$section}.php";
            if ( file_exists( $section_file ) )
                include_once $section_file;
        }

        return $massive_options;
    }

}

new Massive_Theme_Options;

