<?php

if ( ! function_exists( 'massive_get_font_variant' ) ) {
    function massive_get_font_variant( $variant ) {
        $v = array(
            'weight' => absint( $variant ),
            'style' => preg_replace('/[\d]+/', '', $variant)
        );

        if ( empty( $v['style'] ) ) {
            $v['style'] = 'normal';
        } else if ( $v['style'] === 'italic' && empty( $v['weight'] ) ) {
            $v['weight'] = 400;
            $v['style'] = 'italic';
        } else if ( $v['style'] === 'regular' && empty( $v['weight'] ) ) {
            $v['weight'] = 400;
            $v['style'] = 'normal';
        } elseif ( $v['style'] === 'inherit' ) {
            $v['weight'] = $v['style'];
        }

        return $v;
    }
}

if ( ! function_exists( 'massive_get_google_font_stack' ) ) {
    function massive_get_google_font_stack() {
        $tags = array('body', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6');
        $font_stack = array();

        foreach( $tags as $tag ) {
            $props = cs_get_option("typography_{$tag}");
            $font = isset( $props['font'] ) ? $props['font'] : 'websafe';
            $family = massive_get_default_param( $props, 'family' );
            $variant = massive_get_default_param( $props, 'variant' );

            if ( $font === 'websafe' ) {
                continue;
            }
            $font_stack[] = "{$family}:" . implode( '', massive_get_font_variant( $variant ) );
        }
        return implode( '|', $font_stack );
    }
}