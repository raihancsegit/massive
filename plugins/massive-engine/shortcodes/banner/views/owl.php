<?php
$design          = array(); // contains styles
$banner_layout   = massive_get_default_param( $data, 'banner_layout', 'massive-default' );
$custom_height   = massive_get_default_param( $data, 'custom_height', 580 );
$banner_contents = massive_get_default_param( $data, 'banner_contents', array() );

$banner_layout_class = 'massive-owl-banner owl-carousel ' . $uid;

if ( 'custom' == $banner_layout ) {
    $banner_height = massive_check_css_unit( $custom_height );
} else {
    $banner_height = '580px';
}

$design[$uid] = array(
    'height'   => $banner_height,
    'overflow' => 'hidden'
    );

printf( "<style class='hidden for-%s' type='text/css'>\n%s\n</style>",
    esc_attr( $uid ),
    massive_generate_css_rules( $design )
    );
?>

<section class="<?php echo esc_attr( $banner_layout_class ); ?>">
    <?php
        if ( count( $banner_contents ) ) {
            foreach ( $banner_contents as $banner_content ) {
                $title     = massive_get_default_param( $banner_content, 'title' );
                $image_id  = massive_get_default_param( $banner_content, 'image' );
                $image     = massive_get_attachment_image_url( $image_id, 'massive-xl-soft' );
                ?>
                <div><img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $title ); ?>"></div>
                <?php
            }
        }
    ?>
</section>

