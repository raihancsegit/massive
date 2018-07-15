<?php
/*
 * Append read more button to post excerpt
 * @param  string $excerpt
 * @return string
 */
function massive_append_readmore_link( $excerpt ) {
    $readmore_text      = cs_get_option( 'details_btn_text' );
    $blog_style         = cs_get_option( 'blog_style' );
    $blog_classic_style = cs_get_option( 'blog_classic_style' );

    if ( 'masonry' === $blog_style ) {
        $button_class = 'btn btn-extra-small btn-dark-border btn-transparent';
        $arrow_right  = '';
    } elseif ( ( 'grid' === $blog_style ) || ( 'two' == $blog_classic_style)  ) {
        $button_class = 'p-read-more';
        $arrow_right  = '<i class="icon-arrows_slim_right"></i>';
    } else {
        $button_class = 'btn btn-small btn-dark-solid';
        $arrow_right  = '';
    }

    if ( cs_get_option( 'edit_details_btn_text' ) ) {
        $readmore_text = esc_html( $readmore_text );
    } else {
        $readmore_text = esc_html__( 'Continue Reading', 'massive' );
    }

    $readmore = sprintf( '<a href="%s" title="%s" class="%s">%s %s</a>',
        esc_url( get_permalink() ),
        sprintf( esc_attr__( 'Permalink to: %s', 'massive' ), get_the_title() ),
        esc_attr( $button_class ),
        $readmore_text,
        $arrow_right
        );

    return $excerpt . $readmore;
}
add_filter( 'the_excerpt', 'massive_append_readmore_link' );

/**
 * Post custom excerpt more sign
 * @param  string $excerpt
 * @return string
 */
function massive_post_excerpt_more( $excerpt ){
    return ' ...';
}
add_action( 'excerpt_more', 'massive_post_excerpt_more' );

/**
 * Display post excerpt length
 * @param  string $excerpt
 * @return integer
 */
function massive_post_excerpt_length( $length ){
    $length = absint( cs_get_option( 'post_excerpt_length' ) );
    return $length;
}
add_action( 'excerpt_length', 'massive_post_excerpt_length' );

/**
 * Render page slider/banne
 * @param  string $position Hook position
 * @return void
 */
function massive_render_slider() {
    if ( is_page() ) {
        $metadata = get_post_meta( get_queried_object_id(), '_massive_page_options', true );

        if ( ! massive_get_meta( $metadata, 'banner_status' ) ) {
            return;
        }

        $banner_type = massive_get_meta( $metadata, 'banner_type' );
        $revolution = massive_get_meta( $metadata, 'banner_rev' );
        $massive = massive_get_meta( $metadata, 'banner_massive' );

        if ( $revolution && 'rev' === $banner_type ) {
            echo do_shortcode( "[rev_slider alias='{$revolution}']");
        } elseif ( $massive && ( 'massive' === $banner_type || 'Massive' === $banner_type || 'massive-banner' === $banner_type ) ) {
            echo do_shortcode( "[massive_banner banner='{$massive}']");
        }
    }
}
add_action( 'massive_after_header', 'massive_render_slider' );

function massive_filter_body_classes( $classes ) {

    // change default 404 class to ignore design conflict with css
    if ( false !== ( $key = array_search( 'error404', $classes ) ) ) {
        unset( $classes[$key] );
        $classes[] = 'page404';
    }

    if ( is_page() ) {
        $metadata = get_post_meta( get_queried_object_id(), '_massive_page_options', true );

        // inject leftside navbar class
        if ( massive_get_meta( $metadata, 'navbar_override' ) && 'sidebar' === massive_get_meta( $metadata, 'navbar_layout' ) ) {
            $classes[] = 'has-bucket-navbar-left';
        } elseif ( ! massive_get_meta( $metadata, 'navbar_override' ) && 'sidebar' === cs_get_option( 'navbar_layout' ) ) {
            $classes[] = 'has-bucket-navbar-left';
        }

        // inject boxed view class
        if ( massive_get_meta( $metadata, 'page_boxed_view' ) ) {
            $classes[] = 'boxed';
        }
    }

    // inject leftside navbar class if not page
    if ( ! is_page() && 'sidebar' === cs_get_option( 'navbar_layout' ) ) {
        $classes[] = 'has-bucket-navbar-left';
    }

    if ( is_multi_author() ) {
        $classes[] = 'group-blog';
    }

    return $classes;
}
add_filter( 'body_class', 'massive_filter_body_classes' );

function massive_add_additional_mce_buttons( $buttons ) {
    $buttons[] = 'fontselect';
    $buttons[] = 'fontsizeselect';
    $buttons[] = 'backcolor';
    return $buttons;
}
add_filter( 'mce_buttons_3', 'massive_add_additional_mce_buttons' );

function massive_add_fontsize_formats( $config ){
    $config['fontsize_formats'] = "9px 10px 12px 13px 14px 16px 18px 21px 24px 28px 32px 36px 40px 44px 48px 54px 60px 66px 72px 80px 88px 96px";
    return $config;
}
add_filter( 'tiny_mce_before_init', 'massive_add_fontsize_formats' );

// add user defined styles
function massive_enqueue_user_css() {
    $data = cs_get_option( 'massive_css' );
    $data = trim( preg_replace( array('/<style[^>]*>/i','/<\/style>/i'), '', $data ) );
    if ( $data )
        echo sprintf('<style id="Massive-user-styles">%s</style>', $data );
}
add_action( 'wp_head', 'massive_enqueue_user_css', 999999999 );

// add user defined scripts
function massive_enqueue_user_js() {
    $data = cs_get_option( 'massive_js' );
    $data = trim( preg_replace( array('/<script[^>]*>/i','/<\/script>/i'), '', $data ) );
    if ( $data )
        echo sprintf('<script id="Massive-user-scripts">%s</script>', $data );
}
add_action( 'wp_footer', 'massive_enqueue_user_js', 999999999 );

add_filter( 'cs_customize_options', '__return_empty_array' );
