<?php
    $color = massive_sanitize_param( $atts['tcolor'] );
    if ( 'black' == $color ) {
        $classes[] = 'black-color';
    } elseif ( 'white' == $color ) {
        $classes[] = 'white-color';
    }elseif ( 'theme_color' == $color  ) {
        $classes[] = 'theme-color';
    }elseif( 'ctcolor' == $color){
        $classes[] = 'ct-color';
    }
?>
<div class="<?php echo esc_attr( $atts['uid'] ); ?>">
    <div class="heading-title-alt heading-border-bottom <?php echo esc_attr( $atts['alignment'] ); ?>">
        <?php printf( '<%s class="%s">%s</%s>',
            $heading,
            esc_attr( implode( ' ', $classes ) ),
            esc_html( $atts['ttext'] ),
            $heading
            );
        ?>
    </div>
</div>
