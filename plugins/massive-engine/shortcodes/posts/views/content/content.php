<?php

$date_format   = cs_get_option( 'date_format' );
$metabox       = get_post_meta( get_the_id(), '_massive_mb_gallery_post', 1 );
$audio_metabox = get_post_meta( get_the_id(), '_massive_mb_audio_post', 1 );
$video_metabox = get_post_meta( get_the_id(), '_massive_mb_video_post', 1 );
$gallery       = massive_get_default_param( $metabox, 'mb_post_gallery' );
$images        = ( $gallery !== '' ) ? explode( ',', $gallery ): array();
$post_format   = get_post_format();
?>
<?php if ( $post_format == 'gallery' ) {  ?>

<div class="post-slider blog-post-slider post-img text-center relative">
    <ul class="slides">
    <?php
        if ( count( $images ) ) {
            foreach ( $images as $image ) {
                $attachment = massive_get_attachment_image_url( $image , $atts['image_size'] );
                ?>
                <li>
                    <a href="javascript:;">
                        <?php $alt = get_post_meta( $image, '_wp_attachment_image_alt', true ); ?>
                        <img src="<?php echo esc_url( $attachment ); ?>" alt="<?php echo esc_attr( $alt ); ?>">
                    </a>
                </li>
                <?php
            }
        }
    ?>
    </ul>
</div>

<?php } elseif ( $post_format == 'audio' ) {
    if ( isset( $audio_metabox['audio_url'] ) ) {
        echo wp_oembed_get( $audio_metabox['audio_url'] );
    }
} elseif ( $post_format == 'video' ) {
    if ( isset( $video_metabox['video_url'] ) ) {
        echo wp_oembed_get( $video_metabox['video_url'] );
    }
} elseif ( ( $post_format != 'audio' ) || ( $post_format != 'video' ) || ( $post_format != 'gallery' ) ) {
    the_post_thumbnail( $atts['image_size'] );
}
?>
