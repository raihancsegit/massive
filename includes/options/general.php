<?php
/*
 * General
 */
$fields = array(
    array(
        'id'      => 'display_preloader',
        'type'    => 'switcher',
        'title'   => esc_html__( 'Display Preloader', 'massive' ),
        'desc'    => esc_html__( 'Switch on to display preloader.', 'massive' ),
        'default' => true
        ),
    array(
        'id'      => 'display_backtotop',
        'type'    => 'switcher',
        'title'   => esc_html__( 'Display BackToTop', 'massive' ),
        'desc'    => esc_html__( 'Switch on to display back to top.', 'massive' ),
        'default' => true
        ),
    array(
        'type'    => 'subheading',
        'content' => esc_html__( 'Color Scheme', 'massive' ),
        ),
    array(
        'id'    => 'custom_theme_color',
        'type'  => 'switcher',
        'title' => esc_html__( 'Custom Theme Color', 'massive' ),
        'desc'  => esc_html__( 'Switch on to customize theme color.', 'massive' ),
        ),
    array(
        'id'    => 'theme_color',
        'type'  => 'color_picker',
        'title' => esc_html__( 'Theme Color', 'massive' ),
        'desc'  => esc_html__( 'Select an amazing theme color from unlimited posibilites.', 'massive' ),
        'default' => '#d6b161',
        'dependency' => array('custom_theme_color', '==', true)
        ),
    array(
        'type'    => 'subheading',
        'content' => esc_html__( 'Site Favicon', 'massive' ),
        ),
    array(
        'id'    => 'favicon',
        'type'  => 'image',
        'title' => esc_html__( 'Favicon', 'massive' ),
        'desc'  => esc_html__( 'Make sure to keep the favicon size 16px/16px or 32px/32px.', 'massive' ),
        ),
    );

if ( function_exists( 'wp_site_icon' ) ) {
    array_pop( $fields );
    array_pop( $fields );
}

$massive_options[] = array(
    'name'   => 'massive-general',
    'title'  => esc_html__( 'General', 'massive' ),
    'icon'   => 'fa fa-globe',
    'fields' => $fields
    );
