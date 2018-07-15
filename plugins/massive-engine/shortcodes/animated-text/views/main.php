<?php
printf('<span style="font-size: %1$s; font-family: %2$s">%3$s <span id="%4$s" class="%5$s" %6$s>%7$s</span> %8$s</span>',
    esc_attr( massive_check_css_unit( $atts['font_size'] ) ),
    esc_attr( $atts['font_family'] ),
    esc_html( $atts['before_text'] ),
    esc_attr( $uid ),
    esc_attr( implode( ' ', $classes ) ),
    massive_html_data_attr( $data_attr ),
    esc_html( $atts['default_text'] ),
    esc_html( $atts['after_text'] )
    );
