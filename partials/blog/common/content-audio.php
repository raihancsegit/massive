<?php
/**
 * Template part for displaying audio formated post.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Massive
 */

$metabox  = get_post_meta( get_the_id(), '_massive_mb_audio_post', 1 );

if ( isset( $metabox['audio_url'] ) ) {
    echo wp_oembed_get( $metabox['audio_url'] );
}
