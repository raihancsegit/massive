<?php
$classes   = array();
$classes[] = 'alert ';
$classes[] = ( 'none' === $atts['bg_style'] ) ? 'info-border' : 'alert-info';
?>

<div class="<?php echo esc_attr( implode(' ', $classes ) ); ?>" role="alert">
    <?php if ( 'true' === $atts['dismissible'] ) { ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="<?php esc_attr_e( 'Close', 'massive-engine' ); ?>"><span aria-hidden="true">&times;</span></button>
    <?php } ?>

    <?php if ( 'true' === $atts['has_icon'] ) { ?>
        <i class="fa fa-lg fa-check-circle-o"></i>
    <?php } ?>

    <?php echo wp_kses_post( $content ); ?>
</div>
