<dt>
    <a href=""><?php echo esc_html( $atts['title'] ); ?></a>
</dt>
<dd>
     <?php echo wp_kses_post( do_shortcode( $content ) ); ?>
</dd>
