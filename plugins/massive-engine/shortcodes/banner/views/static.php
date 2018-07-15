<?php
$design              = array(); // contains styles
$banner_layout       = massive_get_default_param( $data, 'banner_layout', 'fullscreen' );
$custom_height       = massive_get_default_param( $data, 'custom_height', 650 );
$content_layout      = massive_get_default_param( $data, 'content_layout', 'boxed' );
$boxed_theme         = massive_get_default_param( $data, 'boxed_theme', 'light' );
$boxed_width         = massive_get_default_param( $data, 'boxed_width', 650 );
$boxed_custom_theme  = massive_get_default_param( $data, 'boxed_custom_theme' );
$content             = massive_get_default_param( $data, 'content' );
$background          = massive_get_default_param( $data, 'background' );
$bg_image_id         = massive_get_default_param( $background, 'id' );
$image               = massive_get_attachment_image_url( $bg_image_id, 'massive-xl-soft' );
$banner_layout_class = 'tb-parallax-banner vertical-align text-center ' . $uid;

if ( 'custom' == $banner_layout ) {
    $banner_height = massive_check_css_unit( $custom_height );
} elseif ( 'massive-default' == $banner_layout ) {
    $banner_height = '600px';
} else {
    $banner_height = '100vh';
}

$design[$uid] = array(
    'background-attachment' => massive_get_default_param( $background, 'attachment' ),
    'background-color'      => massive_get_default_param( $background, 'color' ),
    'background-image'      => sprintf( 'url(%s)', esc_url( $image ) ),
    'background-position'   => massive_get_default_param( $background, 'position' ),
    'background-repeat'     => massive_get_default_param( $background, 'repeat' ),
    'height'                => $banner_height,
    );

if ( 'wide' == $content_layout ) {
    $content_layout_class = 'hero-text';
} else {
    $content_layout_class          = 'banner-box';
    $design[$uid . ' .banner-box'] = array(
        'max-width' => massive_check_css_unit( $boxed_width ),
        );
}

if ( 'boxed' == $content_layout && 'light' == $boxed_theme ) {
    $content_layout_class .= ' light-box';
} elseif ( 'boxed' == $content_layout && 'dark' == $boxed_theme ) {
    $content_layout_class .= ' dark-box';
} elseif ( 'boxed' == $content_layout && 'custom' == $boxed_theme ) {
    $content_layout_class .= ' light-box';
    $design[$uid . ' .light-box'] = array(
        'background-color' => $boxed_custom_theme,
        'outline-color'    => $boxed_custom_theme,
        );
}

printf( "<style class='hidden for-%s' type='text/css'>\n%s\n</style>", esc_attr( $uid ), massive_generate_css_rules( $design ) );
?>

<section class="<?php echo esc_attr( $banner_layout_class ); ?>">
    <div class="container-mid">
        <div class="container">
            <div class="<?php echo $content_layout_class; ?>">
                <?php echo massive_parse_content_field( $content ); ?>
            </div>
        </div>
    </div>
</section>
