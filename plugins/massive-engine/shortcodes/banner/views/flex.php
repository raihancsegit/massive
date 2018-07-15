<?php
$design               = array(); // contains styles
$banner_layout        = massive_get_default_param( $data, 'banner_layout', 'massive-default' );
$custom_height        = massive_get_default_param( $data, 'custom_height', 580 );
$has_banner_thumbnail = massive_get_default_param( $data, 'has_banner_thumbnail' );
$banner_contents      = massive_get_default_param( $data, 'banner_contents', array() );

$banner_layout_class = 'massive-flex-banner-wrapper slider-full-width ' . $uid;

if ( $has_banner_thumbnail ) {
    $banner_thumb = 'thumbnails';
} else {
    $banner_thumb = 'true';
}

if ( 'custom' == $banner_layout ) {
    $banner_wrapper_height = massive_check_css_unit( absint( $custom_height ) + 50 );
    $banner_height         = massive_check_css_unit( $custom_height );
} else {
    $banner_wrapper_height = '600px';
    $banner_height         = '580px';
}

$design[$uid] = array(
    'height'   => $banner_wrapper_height,
    'overflow' => 'hidden'
    );

$design[$uid . ' .slides'] = array(
    'height'   => $banner_height,
    'overflow' => 'hidden'
    );

printf( "<style class='hidden for-%s' type='text/css'>\n%s\n</style>",
    esc_attr( $uid ),
    massive_generate_css_rules( $design )
    );
?>

<section class="<?php echo esc_attr( $banner_layout_class ); ?>">
    <div class="massive-flex-banner post-slider text-center vertical-align post-slider-thumb post-img" data-pagination="<?php echo esc_attr( $banner_thumb ); ?>">
        <ul class="slides">
            <?php
                if ( count( $banner_contents ) ) {
                    foreach ( $banner_contents as $banner_content ) {
                        $title     = massive_get_default_param( $banner_content, 'title' );
                        $image_id  = massive_get_default_param( $banner_content, 'image' );
                        $image     = massive_get_attachment_image_url( $image_id, 'massive-xl-soft' );
                        $thumbnail = massive_get_attachment_image_url( $image_id, 'thumbnail' );
                        ?>
                        <li data-thumb="<?php echo esc_url( $thumbnail ); ?>">
                            <img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $title ); ?>">
                            <div class="caption"><?php echo esc_html( $title ); ?></div>
                        </li>
                        <?php
                    }
                }
            ?>
        </ul>
    </div>
</section>
