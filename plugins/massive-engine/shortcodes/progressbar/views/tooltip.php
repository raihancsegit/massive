<?php
$bar_color = massive_sanitize_param( $atts['bar_color'] );
if ( 'black' == $bar_color ) {
    $classes[] = 'bg-black-color';
} elseif ( 'white' == $bar_color ) {
    $classes[] = 'bg-white-color';
} elseif ( 'theme_color' == $bar_color  ) {
    $classes[] = 'bg-theme-color';
} ?>

<div class="progress massive-progress <?php echo esc_attr( $atts['uid'] ); ?>">
    <div class="progress-bar <?php echo esc_attr( implode( ' ', $classes ) ); ?>" role="progressbar" aria-valuenow="<?php echo esc_attr( $atts['percentage'] ); ?>" aria-valuemin="0" aria-valuemax="100">
        <div class="prg-txt"><?php echo esc_html( $atts['text'] ); ?></div>
        <span><?php echo esc_html( $atts['percentage'] ); ?>%</span>
    </div>
</div>
