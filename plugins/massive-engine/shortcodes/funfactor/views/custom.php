<div class="gray-border-factor">
    <div class="fun-factor alt <?php echo esc_attr( $atts['uid'] ); ?>">
        <div class="icon"><i class="<?php echo esc_attr( $atts['icon'] ); ?>"></i></div>
        <div class="fun-info">
            <h1 class="timer" data-from="0" data-to="<?php echo esc_attr( $atts['value'] ); ?>" data-speed="1000"></h1>
            <span><?php echo wp_kses_post( $atts['text'] ); ?></span>
        </div>
    </div>
</div>
