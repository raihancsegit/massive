<?php
$gutter            = $atts['has_portfolio_gutter'];
$masonry           = $atts['has_portfolio_masonry'];
$grid              = $atts['portfolio_grid_quantity'];
$portfolio_items   = $atts['portfolio_items'];
$portfolio_cat     = $atts['categories'];
$content_alignment = $atts['content_alignment'];
$grid_class        = '';
$gutter_class      = '';
$masonry_class     = '';
$thumb_size        = 'massive-sm-hard';

if ( true == $gutter ) {
    $gutter_class .= 'gutter';
}

if ( true == $masonry ) {
    $masonry_class .= 'portfolio-masonry';
    $thumb_size = 'massive-sm-soft';
}

if ( 'two' == $grid ) {
    $grid_class .= 'col-2';
} elseif( 'three' == $grid ) {
    $grid_class .= 'col-3';
} elseif ( 'four' == $grid ) {
    $grid_class .= 'col-4';
} elseif ( 'five' == $grid ) {
    $grid_class .= 'col-5';
} elseif ( 'six' == $grid ) {
    $grid_class .= 'col-6';
}
?>

<div class="text-center">
    <?php if ( true != $atts['portfolio_filter'] ) {
        massive_portfolio_filter_nav();
    } ?>
</div>
<div class="Massive-portfolio portfolio portfolio-with-title <?php echo esc_attr( $masonry_class ); ?> <?php echo esc_attr( $grid_class ); ?> <?php echo esc_attr( $gutter_class ); ?>">

    <?php
       $args = array( 
            'post_type'      => 'portfolio', 
            'posts_per_page' => $portfolio_items,
        );
        $cats = array_filter(explode(',' , $portfolio_cat ) );

        if ( count( $cats ) ) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'portfolio-category',
                    'field'    => 'id',
                    'terms'    => $cats,
                ),
            );
        }
        $loop = new WP_Query( $args );
        while ( $loop->have_posts() ) { $loop->the_post();

        $thumbnail_url   = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
        $metabox         = get_post_meta( get_the_id(), '_massive_mb_portfolio', 1 );
        $gallery         = massive_get_default_param( $metabox, 'mb_portfolio_gallery' );
        $hover_view      = massive_get_default_param( $metabox, 'mb_portfolio_hover_view' );
        $custom_subtitle = massive_get_default_param( $metabox, 'mb_portfolio_subtitle_text' );

        if ( isset( $metabox['mb_portfolio_lightbox_video'] ) ) {
            $lightbox_video = $metabox['mb_portfolio_lightbox_video'];
        } else {
            $lightbox_video = '';
        }

    ?>

        <div class="portfolio-item <?php massive_get_portfolio_class(); ?>">
            <div class="thumb">
                <?php
                    if (  $gallery !== '' ) {
                    $images = explode( ',', $gallery );
                    ?>

                    <div class="portfolio-slider">
                        <ul class="slides">
                        <?php
                            if ( count( $images ) ) {
                                foreach ( $images as $image ) {
                                    $thumb_url = massive_get_attachment_image_url( $image , 'massive-sm-hard' );
                                    $full_url = massive_get_attachment_image_url( $image , 'full' );
                                    ?>
                                    <li>
                                        <a href="<?php echo esc_url( $full_url ); ?>">
                                            <?php $alt = get_post_meta( $image, '_wp_attachment_image_alt', true ); ?>
                                            <img src="<?php echo esc_url( $thumb_url ); ?>" alt="<?php echo esc_attr( $alt ); ?>">
                                        </a>
                                    </li>
                                    <?php
                                }
                            }
                        ?>
                        </ul>
                    </div>

                    <?php } else {
                        the_post_thumbnail( $thumb_size );
                    } ?>

                <?php if ( 'lightbox' == $hover_view ) { ?>
                    <div class="portfolio-hover">
                        <?php if ( $gallery !== '' ) { ?>
                            <div class="action-btn">
                                <a href="#"><i class="icon-basic_magnifier"></i></a>
                            </div>
                        <?php } else { ?>
                            <div class="action-btn">
                                <a href="<?php echo esc_url( $thumbnail_url[0] ); ?>" class="popup-link" title="<?php printf( esc_attr__( 'Lightbox View: %1$s', 'massive-engine' ), get_the_title() ) ; ?>"><i class="icon-basic_magnifier"></i></a>
                            </div>
                        <?php } ?>
                    </div>
                <?php } elseif ( 'single' == $hover_view ) { ?>
                    <div class="portfolio-hover">
                        <div class="action-btn">
                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><i class="icon-basic_link"></i></a>
                        </div>
                    </div>
                <?php } elseif ( 'video' == $hover_view ) { ?>
                    <div class="portfolio-hover">
                        <div class="action-btn">
                            <a href="<?php echo esc_url( $lightbox_video ); ?>" class="popup-vimeo" title="<?php printf( esc_attr__( 'Video Lightbox: %1$s', 'massive-engine' ), get_the_title() ) ; ?>"><i class="icon-arrows_keyboard_right"></i></a>
                        </div>
                    </div>
                <?php } ?>
            </div> <!-- .thumb -->
            <div class="portfolio-title <?php echo $content_alignment; ?>">
                <h4><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
                <p>
                    <?php
                    if ( $custom_subtitle !== '' ) {
                        echo esc_html( $custom_subtitle );
                    } else {
                        massive_get_portfolio_cats();
                    }
                    ?>
                </p>
	        </div>
        </div> <!-- .portfolio-item -->

    <?php // end loop
        }
        wp_reset_postdata();
    ?>

</div> <!-- .portfolio -->
