<?php

class Massive_Theme_Setup {

    public function __construct() {
        add_action( 'after_setup_theme', array($this, 'init') );
    }

    /**
     * Execute all methods
     * @return void
     */
    public function init(){
        $this->load_text_domain();

        $this->add_theme_supports();

        $this->add_image_sizes();

        $this->update_image_sizes();

        $this->register_nav_menus();

        $this->set_content_width();

        $this->add_dynamic_image_sizes();
    }

    /**
     * Load theme text domain
     * @return void
     */
    protected function load_text_domain() {
        load_theme_textdomain( 'massive', get_template_directory() . '/languages' );
    }

    /**
     * Set global content width for 3rd party and media uses
     * @return void
     */
    protected function set_content_width() {
        $GLOBALS['content_width'] = apply_filters( 'massive_content_width', 750 );
    }

    /**
     * Set which functionalites massive supports
     * @return void
     */
    protected function add_theme_supports() {
        add_theme_support( 'automatic-feed-links' );

        add_theme_support( 'title-tag' );

        add_theme_support( 'post-thumbnails' );

        add_theme_support( 'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ) );

        add_theme_support( 'post-formats', array(
            'gallery',
            'audio',
            'video',
        ) );

        add_theme_support( 'woocommerce' );
    }

    /**
     * Add massive image sizes
     * @return void
     */
    protected function add_image_sizes() {
        add_image_size( 'massive-xl-soft', 1750, 999999 );

        add_image_size( 'massive-md-soft', 700, 999999 );
        add_image_size( 'massive-md-hard', 700, 525, true );

        add_image_size( 'massive-sm-soft', 535, 999999 );
        add_image_size( 'massive-sm-hard', 535, 400, true );

        add_image_size( 'massive-xs-soft', 280, 999999 );
        add_image_size( 'massive-xs-hard', 280, 205, true );
    }

    /**
     * Update default image sizes
     * @return void
     */
    protected function update_image_sizes() {
        update_option( 'large_size_w', 1000 );
        update_option( 'large_size_h', 999999 );

        update_option( 'medium_size_w', 650 );
        update_option( 'medium_size_h', 999999 );
    }

    /**
     * Register default nav menus
     * @return void
     */
    protected function register_nav_menus() {
        register_nav_menus( array(
            'primary' => esc_html__( 'Primary Menu', 'massive' ),
        ) );
    }

    /**
     * Add user defined dynamic image sizes
     */
    protected function add_dynamic_image_sizes() {
        $sizes = cs_get_option( 'massive_image_sizes' );
        if ( ! empty( $sizes ) ) {
            foreach ( $sizes as $key => $size ) {
                $name = isset( $size['name'] ) ? $size['name'] : '';
                $width = isset( $size['width'] ) ? $size['width'] : '';
                $height = isset( $size['height'] ) ? $size['height'] : '';
                $cropping = isset( $size['cropping'] ) ? $size['cropping'] : 'soft';

                if ( empty( $name ) ) {
                    continue;
                }

                if ( 'hard' === $cropping ) {
                    add_image_size( $name, $width, $height, true );
                } else {
                    add_image_size( $name, $width, $height );
                }
            }
        }
    }

}

new Massive_Theme_Setup;