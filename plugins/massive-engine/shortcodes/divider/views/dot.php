<div class="<?php echo esc_attr( $atts['alignment'] ); ?>">
    <div class="divider d-solid d-single <?php echo esc_attr( $atts['uid'] ); ?>" role="divider">
        <span class="dot"></span>
        <?php if ( 'true' == $atts['has_icon'] ) { ?>
            <i class="<?php echo esc_attr( $atts['icon'] ) ?>"></i>
        <?php } ?>
    </div>
</div>

