<article class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
    <div class="timeline-desk">
        <div class="panel">
            <div class="panel-body">
                <span class="timeline-icon">
                    <i class="<?php echo esc_attr( $atts['icon'] ); ?>"></i>
                </span>
                <h1 class="text-uppercase">
                    <?php if ( $atts['link'] ) { ?>
                        <a href="<?php echo esc_url( $atts['link'] ); ?>">
                            <?php echo esc_html( $atts['title'] ); ?>
                        </a>
                    <?php } else { echo esc_html( $atts['title'] ); } ?>
                </h1>
                <div class="timeline-event-details">
                    <?php echo wpautop( wp_kses_post( do_shortcode( $content ) ) ); ?>
                </div>
            </div>
        </div>
    </div>
</article>
