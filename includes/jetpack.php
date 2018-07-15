<?php
/**
 * Jetpack Compatibility File.
 *
 * @link https://jetpack.me/
 *
 * @package Massive
 */

/**
 * Add theme support for Infinite Scroll.
 * See: https://jetpack.me/support/infinite-scroll/
 */
function massive_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'massive_infinite_scroll_render',
		'footer'    => 'page',
	) );
} // end function massive_jetpack_setup
add_action( 'after_setup_theme', 'massive_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function massive_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'partials/content', get_post_format() );
	}
} // end function massive_infinite_scroll_render
