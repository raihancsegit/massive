<div class="item">
    <div class="content">
        <p><?php echo do_shortcode( $content ); ?></p>
    </div>
    <div class="testi-auth">
        <div class="avatar">
            <?php if ( 'image' === $which_avatar ) { ?>
                <img src="<?php echo esc_url( $image ); ?>" >
            <?php } elseif( 'icon' === $which_avatar ) { ?>
                <i class="<?php echo esc_attr( $atts['has_icon'] ); ?> fa-3x"></i>
            <?php } ?>
        </div>
        <div class="testimonial-meta">
            <?php echo esc_html( $atts['name'] ); ?>
            <span><?php echo esc_html( $atts['designation'] ); ?></span>
        </div>
    </div>
</div>
