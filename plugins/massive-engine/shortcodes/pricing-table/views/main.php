<div class="row">
    <div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
        <?php
        if ( has_shortcode( $content, 'massive_package' ) ) {
            echo do_shortcode( $content );
        }
        ?>
    </div>
</div>
