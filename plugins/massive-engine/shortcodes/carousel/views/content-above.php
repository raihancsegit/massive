<div class="content-carousel-wrapper content-position-above">
    <div class="heading-title-alt text-left ">
        <h3 class="text-uppercase"><?php echo esc_html( $atts['title'] ); ?></h3>
        <span class="text-uppercase"><?php echo do_shortcode( wp_kses_post( $content ) ); ?></span>
    </div>

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
