 <?php if ( $atts['layout'] === 'boxed' ) { ?>
   <div class="container-fluid">
       <div class="row">
           <div class="promo-box round-5 border-box <?php echo $alignment; ?>">
<?php } else { ?>
    <div class="row">
      <div class="full-width promo-box border-box <?php echo $alignment; ?>">
        <div class="container">
          <div class="col-md-12">
<?php } ?>
                <div class="promo-info">
                    <h3 class="theme-color"> <?php echo wp_kses_post( do_shortcode( $content ) ); ?></h3>
                    <span><?php echo esc_html( $atts['subtitle'] ); ?></span>
                <?php if ( 'text-center' === $alignment ) { ?>
                    <a href="<?php echo esc_url( $atts['btn_link'] ); ?>" class="btn btn-medium <?php echo esc_attr( $btn_shape_class ); ?> btn-dark-solid text-uppercase">
                         <?php echo esc_html( $atts['btn_text'] ); ?>
                    </a>
                <?php } ?>
                </div>
                <?php if ( 'text-left' === $alignment ) { ?>
                    <div class="promo-btn">
                        <a href="<?php echo esc_url( $atts['btn_link'] ); ?>" class="btn btn-medium <?php echo esc_attr( $btn_shape_class ); ?> btn-dark-solid text-uppercase">
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
