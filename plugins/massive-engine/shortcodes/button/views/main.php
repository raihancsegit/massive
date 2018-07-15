<?php
$icon = sprintf( '<i class="%1$s"></i>', esc_attr( $atts['icon'] ) );
$text = '';

if ( 'true' === $has_icon && 'before' === $icon_position ) {
    $text = $icon . ' ' . esc_html( $atts['text'] );
} elseif ( 'true' === $has_icon && 'after' === $icon_position ) {
    $text = esc_html( $atts['text'] ) . ' ' . $icon;
} else {
    $text = esc_html( $atts['text'] );
}

printf( '<a %1$s class="%2$s" href="%3$s" %4$s>%5$s</a>', $id_attr, esc_attr( implode( ' ', $classes ) ), esc_url( $atts['link'] ), $target, $text );
