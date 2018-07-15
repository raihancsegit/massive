<div class="featured-item career-box text-center">
    <?php if ( 'false' !== $has_icon ) { ?>
        <div class="icon"><i class="<?php echo esc_attr( $atts['icon'] ); ?>"></i></div>
    <?php } ?>

    <div class="title text-uppercase"><h4><?php echo esc_html( $atts['title'] ); ?></h4></div>

    <div class="desc"><?php echo wp_kses_post( do_shortcode( $atts['desc'] ) ); ?></div>

    <a href="#" class="show-detail" title="<?php esc_attr_e( 'Click here to view details.', 'massive-engine' ); ?>" <?php if ( 'false' !== $expanded ) { echo 'style="visibility:hidden"'; } ?>>
        <?php echo esc_html( $atts['details_button_text'] ); ?>
    </a>

    <div class="career-details-info" <?php if ( 'false' == $expanded ) { echo 'style="display:none"'; } ?>>

        <?php
        if ( has_shortcode( $content, 'massive_career_info' ) ) {
            echo do_shortcode( $content );
        }
        ?>

        <div class="m-top-30">
            <a href="<?php echo esc_url( $atts['button_link'] ); ?>" data-scroll class="btn btn-medium btn-theme-color apply-btn"><?php echo esc_html( $atts['button_text'] ); ?></a>
            <a href="#" class="btn apply-btn cancel-btn"><?php echo esc_html( $atts['close_button_text'] ); ?></a>
        </div>
    </div>
</div>
