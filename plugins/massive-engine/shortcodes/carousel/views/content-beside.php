<div class="c-info-row content-carousel-wrapper content-position-beside">
    <div class="c-info">
        <h4 class="text-uppercase"><?php echo esc_html( $atts['title'] ); ?></h4>
        <div><?php echo wpautop( do_shortcode( wp_kses_post( $content ) ) ); ?></div>
    </div>

    <div class="c-slide">
        <div class="portfolio-gallery portfolio-with-title <?php echo esc_attr( implode( ' ', $classes ) ); ?>" <?php echo massive_html_data_attr( $data_attr ); ?>>
            <?php foreach ( $slides as $slide ) {
                $aid  = absint( $slide );
                $data = masssive_get_attachment( $aid, 'massive-sm-hard' );
                ?>
                <div class="portfolio-item">
                    <div class="thumb">
                        <img src="<?php echo esc_url( $data['src'] ); ?>" alt="<?php echo esc_attr( $data['alt'] ); ?>">
                        <div class="portfolio-hover">
                            <div class="action-btn">
                                <a href="<?php echo esc_url( $data['src'] ); ?>" class="popup-gallery" title="<?php echo esc_attr( $data['title'] ); ?>"><i class="icon-basic_magnifier"></i>  </a>
                            </div>
                        </div>
                    </div>

                    <?php if ( $data['title'] || $data['tags'] ) { ?>
                        <div class="portfolio-title">
                            <h4><a href="<?php echo esc_url( $data['link'] ); ?>"><?php echo esc_html( $data['title'] ); ?></a></h4>
                            <p><?php echo esc_html( $data['tags'] ); ?></p>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
