<li>
    <a data-toggle="tab" href="#<?php echo esc_attr( $atts['uid'] ); ?>">
        <i class="<?php if ( 'true' === $hasicon ){ echo $icon; } ?>"></i>
        <?php echo esc_html( $atts['title'] ); ?>
    </a>
</li>
<article id="<?php echo esc_attr( $atts['uid'] ); ?>" class="tab-pane">
    <?php echo wp_kses_post( do_shortcode( $content ) ); ?>
</article>
