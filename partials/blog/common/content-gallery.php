<?php
/**
 * Template part for displaying video formated post.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Massive
 */

$metabox = get_post_meta( get_the_id(), '_massive_mb_gallery_post', 1 );
$gallery = massive_get_default_param( $metabox, 'mb_post_gallery' );
$images  = ( ! empty( $gallery ) ) ? explode( ',', $gallery ) : array();
?>

<div class="post-slider blog-post-slider post-img text-center relative">
    <ul class="slides">

    <?php
        if ( ! empty( $images ) ) {
            foreach ( $images as $image ) {
                $attachment = wp_get_attachment_image_src( $image , 'massive-sm-hard' );
                ?>
                <li>
                    <a href="javascript:;">
                        <?php $alt = get_post_meta( $image, '_wp_attachment_image_alt', true ); ?>
                        <img src="<?php echo esc_url( $attachment[0] ); ?>" alt="<?php echo esc_attr( $alt ); ?>">
                    </a>
                </li>
                <?php
            }
        }
    ?>

    </ul>
</div>
