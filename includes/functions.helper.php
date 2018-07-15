<?php

if ( ! function_exists( 'massive_sanitize_param' ) ) {
    /**
     * Trim and lowercase param value
     * @param  string $param
     * @return string
     */
    function massive_sanitize_param( $param ) {
        return strtolower( trim( $param ) );
    }
}

if ( ! function_exists( 'massive_shortcode_tags' ) ) {
    /**
     * Find out all massive shortcodes
     * @return array
     */
    function massive_shortcode_tags() {
        global $shortcode_tags;
        $shortcodes = array_filter(
            array_keys( $shortcode_tags ),
            'massive_filter_massive_shortcodes'
            );
        return $shortcodes;
    }
}

if ( ! function_exists( 'massive_filter_massive_shortcodes' ) ) {
    /**
     * Filter only massive shortcodes
     * @param  string $shortcode
     * @return string
     */
    function massive_filter_massive_shortcodes( $shortcode ) {
        return strstr( $shortcode, 'massive_' );
    }
}

if ( ! function_exists( 'massive_html_data_attr' ) ) {
    /**
     * Generate html data attribute string
     * @param  array    $atts   list of data attributes
     * @return string           generated attributes
     */
    function massive_html_data_attr( $atts ) {
        $atts_str = '';
        foreach ( $atts as $prop => $val ) {
            $atts_str .= sprintf( 'data-%s="%s" ', $prop, esc_attr( $val ) );
        }
        return $atts_str;
    }
}

if ( ! function_exists( 'massive_get_sidebar_list' ) ) {
    /**
     * Create a list of all registered sidebars
     * @return array list of registed sidebar key => name
     */
    function massive_get_sidebar_list() {
        global $wp_registered_sidebars;
        $sidebars = array();
        if ( ! empty( $wp_registered_sidebars ) ) {
            foreach ( $wp_registered_sidebars as $key => $data ) {
                $sidebars[$key] = $data['name'];
            }
        }
        return $sidebars;
    }
}

if ( ! function_exists( 'massive_parse_content_field' ) ) {
    function massive_parse_content_field( $content ) {
        return wpautop( do_shortcode( wp_kses_post( $content ) ) );
    }
}

if ( ! function_exists( 'massive_get_default_param' ) ) {
    function massive_get_default_param( $param_array, $param_name, $default = '' ) {
        return isset( $param_array[$param_name] ) && ! empty( $param_array[$param_name] ) ? $param_array[$param_name] : $default;
    }
}

if ( ! function_exists( 'massive_get_meta' ) ) {
    function massive_get_meta( $collection, $key, $default = '' ) {
        return ( ! empty( $collection[$key] ) ) ? $collection[$key] : $default;
    }
}

if ( ! function_exists( 'massive_get_all_menues' ) ) {
    /**
     * List all created menus
     * @return array    menu list
     */
    function massive_get_all_menues() {
        return get_terms('nav_menu', array(
            'orderby' => 'name',
            'order'   => 'ASC',
            'fields'  => 'id=>name',
            ) );
    }
}

if ( ! function_exists( 'massive_get_image_sizes' ) ) {
    function massive_get_image_sizes( $flip = false ) {
        global $_wp_additional_image_sizes;
        $output = array(
            'full' => esc_html__( 'Full Size', 'massive' ),
            'large' => esc_html__( 'Large Size [1000x999999]', 'massive' ),
            'medium' => esc_html__( 'Medium Size [650x999999]', 'massive' ),
            );
        foreach( $_wp_additional_image_sizes as $name => $data ) {
            $output[$name] = ucwords( str_replace(array('-','_'), array(' ', ' '), $name) ) . ' [' . $data['width'] . 'x' . $data['height'] . ']';
        }
        if ( $flip ) {
            return array_flip( $output );
        }
        return $output;
    }
}

if ( ! function_exists( 'massive_get_revsliders' ) ) {
    function massive_get_revsliders() {
        if ( !class_exists('RevSliderSlider') ) {
            return array();
        }

        $sl = new RevSliderSlider();
        $sliders = $sl->getAllSliderForAdminMenu();
        $map = array();
        foreach ( $sliders as $slider ) {
            $map[$slider['alias']] = $slider['title'];
        }
        return $map;
    }
}

if ( ! function_exists( 'massive_has_woocommerce' ) ) {
    function massive_has_woocommerce() {
        return class_exists( 'WooCommerce' );
    }
}

if ( ! function_exists( 'masssive_get_attachment' ) ) {
    function masssive_get_attachment( $attachment_id, $size = 'full' ) {
        $attachment = get_post( $attachment_id );
        $image_data = wp_get_attachment_image_src( $attachment_id, $size );
        return array(
            'alt'         => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
            'caption'     => $attachment->post_excerpt,
            'description' => $attachment->post_content,
            'href'        => get_permalink( $attachment->ID ),
            'link'        => get_post_meta( $attachment->ID, '_massive_attachement_link', true ),
            'src'         => $image_data[0],
            'tags'        => get_post_meta( $attachment->ID, '_massive_attachement_tags', true ),
            'title'       => $attachment->post_title,
        );
    }
}

if ( ! function_exists( 'massive_get_for_empty' ) ) {
    // used only for empty css props
    function massive_get_for_empty( $collection, $key, $default = '' ) {
        return isset( $collection[$key] ) && '' !== $collection[$key] ? $collection[$key] : $default;
    }
}

if ( ! function_exists( 'massive_get_banners' ) ) {
    function massive_get_banners( $format = 'reverse' ) {
        $args = array(
            'order'          => 'ASC',
            'orderby'        => 'title',
            'post_type'      => 'banner',
            'posts_per_page' => -1,
            'status'         => 'publish',
            );

        $banners = get_posts( $args );
        $output  = array();

        foreach ( $banners as $banner ) {
            $id   = $banner->ID;

            $meta = get_post_meta( $id, '_massive_banner_type', true );
            $type = isset( $meta['type'] ) ? sprintf( esc_html__( 'Type: %s', 'massive' ), ucwords( $meta['type'] ) ) : '';

            $title = $banner->post_title;
            $title = ( $title ? esc_html( $title ) : esc_html__( 'Banner Default Title', 'massive' ) );

            if ( 'reverse' === $format ) {
                $output["{$title} { {$type} }"] = $id;
            } else {
                $output[$id] = "{$title} { {$type} }";
            }
        }
        return $output;
    }
}

if ( ! function_exists( 'massive_get_portfolio_categories' ) ) {
    /**
     * Get portfolio categorires to usages on vc & option's map
     * @return string
     */
    function massive_get_portfolio_categories($flip = false) {

        $args = array(
            'orderby' => 'name',
            'order'   => 'ASC',
            'fields'  => 'id=>name',
        );
        $out = array();

        $terms = get_terms('portfolio-category', $args);
        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
            $out = (array) $terms;
        }

        if ($flip) {
            return array_flip($out);
        }
        return $terms;

    }
}

/**
 * List of all the Massive shortcode tags
 *
 * @return array
 */
function massive_get_shortcode_tags() {
    $tags = array(
        'massive_accordion',
        'massive_accordions_container',
        'massive_alert',
        'massive_image',
        'massive_animated_text',
        'massive_banner',
        'massive_button',
        'massive_career_info',
        'massive_career',
        'massive_carousel',
        'massive_client',
        'massive_clients_container',
        'massive_countdown',
        'massive_divider',
        'massive_featuredbox',
        'massive_funfactor',
        'massive_gallery',
        'massive_heading',
        'massive_list',
        'massive_package',
        'massive_page_title',
        'massive_portfolio',
        'massive_posts',
        'massive_pricing_table',
        'massive_progressbar',
        'massive_progressbars',
        'massive_promo_box',
        'massive_slider',
        'massive_subscribe',
        'massive_tab',
        'massive_tabs_container',
        'massive_team',
        'massive_testimonial',
        'massive_testimonials_container',
        'massive_timeline_event',
        'massive_timeline',
    );

    return $tags;
}


/**
 * Check One Click Demo Import
 *
 * @return bool
 */
function massive_has_ocdi() {
    return class_exists( 'OCDI_Plugin' );
}
