<?php
$design          = array(); // contains styles
$banner_layout   = massive_get_default_param( $data, 'banner_layout', 'Massive' );
$custom_height   = massive_get_default_param( $data, 'custom_height', 500 );
$banner_contents = massive_get_default_param( $data, 'banner_contents', array() );
$banners         = array( 'banner' => array(), 'thumbnail' => array() );

$banner_layout_class = 'massive-elastic-banner ei-slider ' . $uid;

if ( 'custom' == $banner_layout ) {
    $banner_height = massive_check_css_unit( $custom_height );
} else {
    $banner_height = '500px';
}

$design[$uid] = array(
    'height' => $banner_height,
    );

if ( count( $banner_contents ) ) {
    foreach ( $banner_contents as $banner_content ) {
        $title     = massive_get_default_param( $banner_content, 'title' );
        $content   = massive_get_default_param( $banner_content, 'content' );
        $image_id  = massive_get_default_param( $banner_content, 'image' );
        $image     = massive_get_attachment_image_url( $image_id, 'massive-xl-soft' );
        $thumbnail = massive_get_attachment_image_url( $image_id, 'thumbnail' );

        $banners['banner'][] = sprintf('<li><img src="%1$s" alt="%2$s"><div class="ei-title">%3$s</div></li>',
            esc_url( $image ),
            esc_html( $title ),
            massive_parse_content_field( $content ) );

        $banners['thumbnail'][] = sprintf( '<li><a href="#">%1$s</a><img src="%2$s" alt="%3$s"></li>',
            esc_html( $title ),
            esc_url( $thumbnail ),
            esc_attr( $title ) );
    }
}

printf( "<style class='hidden for-%s' type='text/css'>\n%s\n</style>", esc_attr( $uid ), massive_generate_css_rules( $design ) );
?>

<section class="<?php echo esc_attr( $banner_layout_class ); ?>">
    <ul class="ei-slider-large">
        <?php echo implode( "\n", $banners['banner'] ); ?>
    </ul>
    <ul class="ei-slider-thumbs">
        <li class="ei-slider-element"><?php esc_html_e( 'Current Slide', 'massive-engine' ); ?></li>
        <?php echo implode( "\n", $banners['thumbnail'] ); ?>
    </ul>
</section>
