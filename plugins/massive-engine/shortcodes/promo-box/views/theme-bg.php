 <?php if ( $atts['layout'] === 'boxed' ) { ?>
    <div class="container-fluid">
        <div class="row">
            <div class="promo-box theme-bg round-5 <?php echo $alignment; ?>">
<?php } else { ?>
    <div class="row">
        <div class="full-width promo-box theme-bg <?php echo $alignment; ?>">
            <div class="container">
                <div class="col-md-12">
<?php } ?>
                <div class="promo-info">
                    <h3 class="light-txt"> <?php echo wp_kses_post( do_shortcode( $content ) ); ?></h3>
                    <span class="light-txt"><?php echo esc_html( $atts['subtitle'] ); ?></span>
                <?php if ( 'text-center' === $alignment ) { ?>
                    <a href="<?php echo esc_url( $atts['btn_link'] ); ?>" class="btn btn-medium btn-dark-solid <?php echo esc_attr( $btn_shape_class ); ?>  btn-transparent light-txt  text-uppercase">
                         <?php echo esc_html( $atts['btn_text'] ); ?>
                    </a>
                <?php } ?>
                </div>
                <?php if ( 'text-left' === $alignment ) { ?>
                    <div class="promo-btn">
                        <a href="<?php echo esc_url( $atts['btn_link'] ); ?>" class="btn btn-medium btn-dark-solid <?php echo esc_attr( $btn_shape_class ); ?>  btn-transparent light-txt  text-uppercase">
                             <?php echo esc_html( $atts['btn_text'] ); ?>
                        </a>
                    </div>
                <?php } ?>
 <?php if ( $atts['layout'] === 'boxed' ) { ?>
            </div>
        </div>
    </div>
<?php } else { ?>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
