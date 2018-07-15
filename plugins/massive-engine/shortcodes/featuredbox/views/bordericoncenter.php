<div class="featured-item border-box text-center <?php echo esc_attr( $atts['uid'] ); ?>">
    <div class="icon">
        <?php if ( 'icon' === $atts['artwork'] ) { ?>
            <i class="<?php echo esc_attr( $atts['icon'] ); ?>"></i>
        <?php } else { ?>
            <img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $atts['title'] ); ?>">
        <?php } ?>
    </div>
    <div class="title text-uppercase">
        <h4><?php echo wp_kses_post( $atts['title'] ); ?></h4>
    </div>
    <div class="desc">
        <?php echo wp_kses_post( do_shortcode( $content ) ); ?>
    </div>
</div>
