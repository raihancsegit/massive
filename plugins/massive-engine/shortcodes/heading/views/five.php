<?php
    $color = massive_sanitize_param( $atts['tcolor'] );
    $stcolor = massive_sanitize_param( $atts['stcolor'] );
    if ( 'black' == $color ) {
        $classes[] = 'black-color';
    } elseif ( 'white' == $color ) {
        $classes[] = 'white-color';
    } elseif ( 'theme_color' == $color  ) {
        $classes[] = 'theme-color';
    } elseif ( 'ctcolor' == $color){
        $classes[] = 'ct-color';
    }


    if ( 'black' == $stcolor ) {
        $stclasses[] = 'black-color';
    } elseif ( 'white' == $stcolor ) {
        $stclasses[] = 'white-color';
    } elseif ( 'theme_color' == $stcolor  ) {
        $stclasses[] = 'theme-color';
    } elseif ( 'cstcolor' == $stcolor){
        $stclasses[] = 'cst-color';
    }
?>

<div class="heading-title-alt border-short-bottom <?php echo esc_attr( $atts['alignment'] ); ?> <?php echo esc_attr( $atts['uid'] ); ?>">
    <?php printf( '<%s class="heading-five %s">%s</%s>',
        $heading,
        esc_attr( implode( ' ', $classes ) ),
        esc_html( $atts['ttext'] ),
        $heading
        );
    ?>
    <?php if ( $atts['sttext'] ) { ?>
    <span class="half-txt <?php echo esc_attr( implode( ' ', $stclasses ) ); ?>"><?php echo esc_html( $atts['sttext'] ) ; ?></span>
    <?php } ?>
</div>
