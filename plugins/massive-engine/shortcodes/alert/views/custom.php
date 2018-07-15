<div class="alert <?php echo esc_attr( $atts['uid'] ); ?>" role="alert">
    <?php if ( 'true' === $atts['dismissible'] ) { ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="<?php esc_attr_e( 'Close', 'massive-engine' ); ?>"><span aria-hidden="true">&times;</span></button>
    <?php } ?>

    <?php if ( 'true' === $atts['custom_has_icon'] ) { ?>
        <i class="<?php echo esc_attr( $atts['icon'] ); ?>"></i>
    <?php } ?>

    <?php echo wp_kses_post( $content ); ?>
</div>
