<div class="c-list-row">
    <label><?php echo esc_html( $atts['title'] ); ?></label>
    <div class="info"><?php echo wp_kses_post( do_shortcode( $content ) ); ?></div>
</div>
