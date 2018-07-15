<?php
$banner_contents = massive_get_default_param( $data, 'banner_contents', array() );

$banner_layout_class = 'massive-bs-banner-wrapper bs-hero full-screen ' . $uid;
?>

<section class="<?php echo esc_attr( $banner_layout_class ); ?>">
    <div id="massive-bs-banner" class="carousel slide carousel-fade full-width" data-ride="carousel">

        <div id="fullscreen-banner" class="carousel-inner fullscreen-banner" role="listbox">
            <?php
                $indicator = array();
                if ( count( $banner_contents ) ) {
                    $counter = 0;
                    foreach ( $banner_contents as $banner_content ) {
                        $title       = massive_get_default_param( $banner_content, 'title' );
                        $content     = massive_get_default_param( $banner_content, 'content' );
                        $animation   = massive_get_default_param( $banner_content, 'animation' );
                        $image_id    = massive_get_default_param( $banner_content, 'image' );
                        $image       = massive_get_attachment_image_url( $image_id, 'massive-xl-soft' );
                        $active      = ( 0 == $counter ) ? 'active' : '';
                        $indicator[] = sprintf( '<li data-target="#massive-bs-banner" data-slide-to="%1$s" class="%2$s"></li>', $counter, $active );

                        ++ $counter; // increment counter value
                        ?>
                        <div class="item <?php echo esc_attr( $active ); ?>">
                            <img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $title ); ?>">
                            <div class="bs-banner-content">
                                <div class="bs-banner-table">
                                    <div class="bs-banner-cell animated <?php echo esc_attr( $animation ); ?>">
                                        <?php echo massive_parse_content_field( $content ); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
            ?>
        </div>

        <ol class="carousel-indicators">
            <?php echo implode( "\n", $indicator ); ?>
        </ol>

        <a class="left carousel-control" href="#massive-bs-banner" role="button" data-slide="prev"></a>
        <a class="right carousel-control" href="#massive-bs-banner" role="button" data-slide="next"></a>
    </div>
</section>
