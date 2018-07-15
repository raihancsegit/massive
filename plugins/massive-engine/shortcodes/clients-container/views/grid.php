<div class="clients <?php echo ( 'angle-box' == $atts['box_style'] ? 'angle-box' : 'plus-box' );  ?> <?php echo esc_attr( $atts['grid_size'] ); ?>">
    <?php echo do_shortcode( $content ); ?>
</div>
