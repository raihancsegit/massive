<?php

if ( ! function_exists( 'massive_prepare_css_properties' ) ) {
    /**
     * Prepare array of css property value to inline css
     * @param  array $props
     * @return string
     */
    function massive_prepare_css_properties( $props ) {
        $prop_map = array();
        foreach ( $props as $prop => $value ) {
            $value = trim( $value );
            if ( $value === '' || $value === '!important' )
                continue;

            $prop_map[] = "\t{$prop}:{$value};";
        }
        return esc_attr( implode( "\n", $prop_map ) );
    }
}

if ( ! function_exists( 'massive_get_shortcode_dynamic_styles' ) ) {
    /**
     * Enqueue shortcode dynamics styles
     * @return void
     */
    function massive_get_shortcode_dynamic_styles() {
        global $post;
        if ( ! empty( $post ) ) {
            $msl = massive_get_shortcode_tags();
            $regex = get_shortcode_regex( $msl );
            preg_match_all( '/' . $regex . '/', $post->post_content, $matches );

            if ( $matches ) {
                $i =-1;
                $output = '';
                foreach( $matches[2] as $msc ) {
                    $i++;

                    if ( ! class_exists( $msc ) ) {
                        continue;
                    }

                    $class  = new $msc();
                    $params = shortcode_parse_atts( $matches[3][$i] );
                    if ( method_exists( $class, 'map_dynamic_styles' ) ) {
                        $map = $class->map_dynamic_styles( $params );
                        $output .= massive_generate_css_rules( $map );
                    }

                    if ( isset( $matches[5][$i] ) && false !== stripos( $matches[5][$i], '[massive' ) ) {
                        $j =-1;
                        preg_match_all( '/' . $regex . '/', $matches[5][$i], $nested );
                        foreach( $nested[2] as $nestedMsc ) {
                            $j++;
                            $class  = new $nestedMsc();
                            $params = shortcode_parse_atts( $nested[3][$j] );
                            if ( method_exists( $class, 'map_dynamic_styles' ) ) {
                                $map = $class->map_dynamic_styles( $params );
                                $output .= massive_generate_css_rules( $map );
                            }
                        }
                    }
                }
                printf( "<style id='massive-dynamic-styles' type='text/css'>\n%s\n</style>", $output );
            }
        }
    }
    add_action( 'wp_head', 'massive_get_shortcode_dynamic_styles' );
}

if ( ! function_exists( 'massive_generate_css_rules' ) ) {
    /**
     * Create css rules from css mapping
     * @param  array $map css property map
     * @return string
     */
    function massive_generate_css_rules( $map ) {
        $rules = '';
        if ( ! empty( $map ) ) {
            foreach( $map as $selector => $props ) {
                if ( empty( $props ) )
                    continue;

                $rules .= sprintf( ".%s\n{\n%s\n}\n", esc_attr( $selector ), massive_prepare_css_properties( $props ) );
            }
        }
        return $rules;
    }
}

if ( ! function_exists( 'massive_check_css_unit' ) ) {
    /**
     * Check css units and set default if no unit
     * @param  string $value
     * @param  string $default
     * @return string
     */
    function massive_check_css_unit( $value, $default = 'px' ) {
        $value  = massive_sanitize_param( $value );

        if ( $value === 0 || $value === '0' || $value === '' )
            $value = '0px';

        $values = array_filter( explode( ' ', $value ) );
        $out = array();
        foreach ( $values as $val ) {
            $out[] = massive_sanitize_css_unit( $val, $default );
        }
        return implode( ' ', $out );
    }
}

if ( ! function_exists( 'massive_sanitize_css_unit' ) ) {
    function massive_sanitize_css_unit( $value, $default ) {
        $units = '/-?\d+[px|em|%|pt|cm|ex|mm|in|rem]/';
        if ( preg_match( $units, $value ) ) {
            return $value;
        } else {
            return $value . $default;
        }
    }
}
