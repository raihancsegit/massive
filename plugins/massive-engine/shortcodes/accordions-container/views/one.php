<?php $toggle = $atts['toggle'] ; ?>
<dl class="time-line <?php echo ( ( 'true' === $toggle ) ? 'toggle' : 'accordion' ); ?> <?php echo esc_attr( $atts['uid'] ); ?>">
    <?php echo do_shortcode( $content ); ?>
</dl>
