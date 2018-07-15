<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
    <?php
    if ( has_shortcode( $content, 'massive_timeline_event' ) ) {
        echo do_shortcode( $content );
    }
    ?>
</div>
