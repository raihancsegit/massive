<?php
/**
 * This class handles all the sidebars registration
 *
 * @package Massive
 * @author ThemeBucket <themebucket@gmail.com>
 */

class Massive_Sidebars {

    public function __construct() {
        add_action( 'widgets_init', array($this, 'register') );
        add_action( 'widgets_init', array($this, 'register_dynamic') );
    }

    public function register() {
        register_sidebar( array(
            'name'          => esc_html__( 'Primary Sidebar', 'massive' ),
            'id'            => 'primary-sidebar',
            'description'   => '',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<div class="heading-title-alt text-left heading-border-bottom text-uppercase"><h3 class="h6 widget-title">',
            'after_title'   => '</h3></div>',
        ) );

        register_sidebar( array(
            'name'          => esc_html__( 'Secondary Sidebar', 'massive' ),
            'id'            => 'secondary-sidebar',
            'description'   => '',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<div class="heading-title-alt text-left heading-border-bottom text-uppercase"><h3 class="h6 widget-title">',
            'after_title'   => '</h3></div>',
        ) );

        register_sidebar( array(
            'name'          => esc_html__( 'Shop Sidebar', 'massive' ),
            'id'            => 'shop-sidebar',
            'description'   => '',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<div class="heading-title-alt text-left heading-border-bottom text-uppercase"><h3 class="h6 widget-title">',
            'after_title'   => '</h3></div>',
        ) );

        register_sidebar( array(
            'name'          => esc_html__( 'Footer First Column', 'massive' ),
            'id'            => 'footer-1',
            'description'   => '',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h5 class="footer-widget-title text-uppercase">',
            'after_title'   => '</h5>',
        ) );

        register_sidebar( array(
            'name'          => esc_html__( 'Footer Second Column', 'massive' ),
            'id'            => 'footer-2',
            'description'   => '',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h5 class="footer-widget-title text-uppercase">',
            'after_title'   => '</h5>',
        ) );

        register_sidebar( array(
            'name'          => esc_html__( 'Footer Third Column', 'massive' ),
            'id'            => 'footer-3',
            'description'   => '',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h5 class="footer-widget-title text-uppercase">',
            'after_title'   => '</h5>',
        ) );

        register_sidebar( array(
            'name'          => esc_html__( 'Footer Fourth Column', 'massive' ),
            'id'            => 'footer-4',
            'description'   => '',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h5 class="footer-widget-title text-uppercase">',
            'after_title'   => '</h5>',
        ) );
    }

    public function register_dynamic() {
        $widgets = cs_get_option( 'massive_sidebars', array() );

        if ( ! empty( $widgets ) ) {
            foreach ( $widgets as $key => $widget ) {
                $widget_name = ( '' !== $widget['name'] ? $widget['name'] : sprintf( __( 'Dynamic Sidebar %s', 'massive' ), $key ) );
                register_sidebar( array(
                    'name'          => esc_html( ucwords( $widget_name ) ),
                    'id'            => 'massive-dw-' . esc_attr( $widget_name ),
                    'description'   => '',
                    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                    'after_widget'  => '</aside>',
                    'before_title'  => '<div class="heading-title-alt text-left heading-border-bottom text-uppercase"><h3 class="h6 widget-title">',
                    'after_title'   => '</h3></div>',
                ) );
            }
        }
    }

}

new Massive_Sidebars;