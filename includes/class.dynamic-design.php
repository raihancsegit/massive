<?php
/**
 * Generate css from user settings and enqueue to head.
 *
 * @package Massive
 * @author ThemeBucket <themebucket@gmail.com>
 */

class Massive_Dynamic_Design {

    public function __construct() {
        add_action( 'wp_head', array($this, 'enqueue_dynamic_css'), 999999 );

        add_filter( 'massive_dynamic_design', array($this, 'page_dynamic_css') );
        add_filter( 'massive_dynamic_design', array($this, 'typography_css') );
        add_filter( 'massive_dynamic_design_css', array($this, 'enqueue_dynamic_theme_color') );
    }

    public function enqueue_dynamic_css() {
        $design = apply_filters( 'massive_dynamic_design', $design = array() );
        printf( "<style id='Massive-dynamic-design' type='text/css'>\n%s\n</style>",
            apply_filters( 'massive_dynamic_design_css', massive_generate_css_rules( $design ) )
            );
    }

    public function enqueue_dynamic_theme_color( $css ) {
        $color = cs_get_option('theme_color');

        if ( cs_get_option('custom_theme_color') && $color !== '#d6b161' ) {
            ob_start();
            include MASSIVE_INCLUDES_DIR . 'theme-color.php';
            $contents = ob_get_clean();
            $css .= str_replace( '{{MASSIVE_COLOR}}', esc_attr($color), $contents );
        }

        return $css;
    }

    public function typography_css( $design ) {
        if ( ! cs_get_option( 'enable_typography' ) ) {
            return $design;
        }

        $tags = array('body','h1','h2','h3','h4','h5','h6');
        $map = array();
        foreach ( $tags as $tag ) {
            $selector = "{$tag}, {$tag}";
            $props = cs_get_option("typography_{$tag}");
            $variant = massive_get_font_variant( massive_get_default_param( $props, 'variant' ) );
            $map = array_merge($map, array(
                $selector => array(
                    'font-family' => massive_get_default_param( $props, 'family' ),
                    'font-size' => massive_check_css_unit( massive_get_default_param( $props, 'size' ) ),
                    'line-height' => massive_check_css_unit( massive_get_default_param( $props, 'height' ) ),
                    'font-weight' => $variant['weight'],
                    'font-style' => $variant['style'],
                    ),
                )
            );
        }
        return array_merge( $design, $map );
    }

    public function page_dynamic_css( $design ) {
        if ( is_page() ) {
            $pageid = get_queried_object_id();
            $pagemeta = get_post_meta( $pageid, '_massive_page_options', true );

            $boxed_config = massive_get_meta( $pagemeta, 'page_background' );
            $boxed_img_id = massive_get_meta( $boxed_config, 'id' );
            $boxed_bg_color = massive_get_meta( $boxed_config, 'color' );

            $title_bg = massive_get_meta( $pagemeta, 'title_background' );
            $title_img_id = massive_get_meta( $title_bg, 'id' );
            $title_bg_color = massive_get_meta( $title_bg, 'color' );

            // boxed view
            if ( massive_get_meta( $pagemeta, 'page_boxed_view' ) && ( $boxed_img_id || $boxed_bg_color ) ) {
                $boxed_bg_img = wp_get_attachment_image_src( $boxed_img_id, 'massive-xl-soft' );
                $design["page-id-{$pageid}"] = array(
                    'background-attachment' => massive_get_meta( $boxed_config, 'attachment' ),
                    'background-color' => $boxed_bg_color,
                    'background-image' => 'url('. esc_url( $boxed_bg_img[0] ) . ')',
                    'background-position' => massive_get_meta( $boxed_config, 'position' ),
                    'background-repeat' => massive_get_meta( $boxed_config, 'repeat' ),
                    );

                if ( $boxed_bg_img[1] >= 1000 ) {
                    $design["page-id-{$pageid}"]['background-size'] = 'cover';
                }
            }

            // title
            if ( massive_get_meta( $pagemeta, 'title_status' ) && ( $title_img_id || ( '#f5f5f5' != $title_bg_color ) ) ) {
                $title_bg_img = wp_get_attachment_image_src( $title_img_id, 'massive-xl-soft' );
                $design["page-title-{$pageid}"] = array(
                    'background-attachment' => massive_get_meta( $title_bg, 'attachment' ),
                    'background-color' => $title_bg_color,
                    'background-image' => 'url('. esc_url( $title_bg_img[0] ) . ')',
                    'background-position' => massive_get_meta( $title_bg, 'position' ),
                    'background-repeat' => massive_get_meta( $title_bg, 'repeat' ),
                    );

                if ( $title_bg_img[1] >= 1000 ) {
                    $design["page-title-{$pageid}"]['background-size'] = 'cover';
                }
            }

            if ( massive_get_meta( $pagemeta, 'title_status' ) ) {
                $title_top_padding = massive_get_for_empty( $pagemeta, 'title_top_padding', '50px' );
                $title_bottom_padding = massive_get_for_empty( $pagemeta, 'title_bottom_padding', '50px' );
                $title_top_border = massive_get_for_empty( $pagemeta, 'title_top_border', '0px' );
                $title_bottom_border = massive_get_for_empty( $pagemeta, 'title_bottom_border', '0px' );
                $title_font_size = massive_get_for_empty( $pagemeta, 'title_font_size', '18px' );
                $title_sub_font_size = massive_get_for_empty( $pagemeta, 'title_sub_font_size', '15px' );

                $design["page-title-{$pageid}"]['padding-top'] = massive_check_css_unit( $title_top_padding );
                $design["page-title-{$pageid}"]['padding-bottom'] = massive_check_css_unit( $title_bottom_padding );
                $design["page-title-{$pageid}"]['border-color'] = massive_get_meta( $pagemeta, 'title_border_color' );
                $design["page-title-{$pageid}"]['border-style'] = 'solid';
                $design["page-title-{$pageid}"]['border-width'] = '0px';
                $design["page-title-{$pageid}"]['border-top-width'] = massive_check_css_unit( $title_top_border );
                $design["page-title-{$pageid}"]['border-bottom-width'] = massive_check_css_unit( $title_bottom_border );

                $design["page-heading-{$pageid}"] = array(
                    'color' => massive_get_meta( $pagemeta, 'title_color' ) . ' !important',
                    'font-size' => massive_check_css_unit( $title_font_size ) . ' !important',
                    );

                $design["page-subheading-{$pageid}"] = array(
                    'color' => massive_get_meta( $pagemeta, 'title_sub_color' ) . ' !important',
                    'font-size' => massive_check_css_unit( $title_sub_font_size ) . ' !important',
                    );

                $design['breadcrumb li:before, .breadcrumb a'] = array(
                    'color' => massive_get_meta( $pagemeta, 'title_breadcrumb_color' ) . ' !important',
                    );

                $design['breadcrumb .active, .breadcrumb li a:hover, .breadcrumb li a:focus'] = array(
                    'color' => massive_get_meta( $pagemeta, 'title_breadcrumb_active_color' ) . ' !important',
                    );
            }

            // page content
            $page_top_padding = massive_get_for_empty( $pagemeta, 'page_top_padding', '100px' );
            $page_bottom_padding = massive_get_for_empty( $pagemeta, 'page_bottom_padding', '100px' );
            $design["page-content-{$pageid}"] = array(
                'padding-top' => massive_check_css_unit( $page_top_padding ),
                'padding-bottom' => massive_check_css_unit( $page_bottom_padding ),
                );
        }

        if ( ! is_page() ) {
            $title_bg = cs_get_option( 'blog_title_background' );
            $title_img_id = massive_get_meta( $title_bg, 'id' );
            $title_bg_color = massive_get_meta( $title_bg, 'color' );

            // heading
            if ( $title_img_id || ( '#f5f5f5' != $title_bg_color ) ) {
                $title_bg_img = wp_get_attachment_image_src( $title_img_id, 'massive-xl-soft' );
                $design['page-title-custom'] = array(
                    'background-attachment' => massive_get_meta( $title_bg, 'attachment' ),
                    'background-color' => $title_bg_color,
                    'background-image' => 'url('. esc_url( $title_bg_img[0] ) . ')',
                    'background-position' => massive_get_meta( $title_bg, 'position' ),
                    'background-repeat' => massive_get_meta( $title_bg, 'repeat' ),
                    'background-size' => 'cover',
                    );
            }

            $design['page-title-custom']['padding-top'] = massive_check_css_unit( cs_get_option( 'blog_title_top_padding' ) );
            $design['page-title-custom']['padding-bottom'] = massive_check_css_unit( cs_get_option( 'blog_title_bottom_padding' ) );

            $design['page-main-title'] = array(
                'color' => cs_get_option( 'blog_title_color' ) . ' !important',
                'font-size' => massive_check_css_unit( cs_get_option( 'blog_title_font_size' ) ) . ' !important',
                );

            if ( cs_get_option('display_blog_title_breadcrumb') ) {
                $design['breadcrumb li:before, .breadcrumb a'] = array(
                    'color' => cs_get_option( 'blog_title_breadcrumb_color' ) . ' !important',
                    );

                $design['breadcrumb .active, .breadcrumb li a:hover, .breadcrumb li a:focus'] = array(
                    'color' => cs_get_option( 'blog_title_breadcrumb_active_color' ) . ' !important',
                    );
            }
        }

        return $design;
    }
}

new Massive_Dynamic_Design;