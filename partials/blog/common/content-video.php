<?php
/**
 * Template part for displaying video formated post.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Massive
 */

$metabox    = get_post_meta( get_the_id(), '_massive_mb_video_post', 1 );

if ( isset( $metabox['video_url'] ) ) {
    echo wp_oembed_get( $metabox['video_url'] );
}
