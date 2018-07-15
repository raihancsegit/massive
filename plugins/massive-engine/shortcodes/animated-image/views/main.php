<figure class="animated-img-box <?php echo esc_attr( $uid ); ?>" data-animation="<?php echo esc_attr( $atts['animation'] ); ?>">
    <?php if ( $href !== '' ) { printf( '<a href="%1$s" title="%2$s" target="%3$s">', esc_url($href['url']), esc_attr($href['title']), esc_attr($href['target']) ); } ?>
    <?php $image = massive_get_attachment_image_url( $atts['image'], $atts['image_size'] ); ?>
    <img class="animated-img" src="<?php echo esc_url( $image ); ?>">
    <div class="animated-img-content">
        <div class="animated-img-table">
            <div class="animated-img-cell"><?php echo do_shortcode( $content ); ?></div>
        </div>
    </div>
    <?php if ( $href !== '' ) { echo '</a>'; } ?>
</figure>
