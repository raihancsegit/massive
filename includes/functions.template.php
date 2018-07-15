<?php

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function massive_categorized_blog() {
    if ( false === ( $all_the_cool_cats = get_transient( 'massive_categories' ) ) ) {
        // Create an array of all the categories that are attached to posts.
        $all_the_cool_cats = get_categories( array(
            'fields'     => 'ids',
            'hide_empty' => 1,

            // We only need to know if there is more than one category.
            'number'     => 2,
        ) );

        // Count the number of categories that are attached to the posts.
        $all_the_cool_cats = count( $all_the_cool_cats );

        set_transient( 'massive_categories', $all_the_cool_cats );
    }

    if ( $all_the_cool_cats > 1 ) {
        // This blog has more than 1 category so massive_categorized_blog should return true.
        return true;
    } else {
        // This blog has only 1 category so massive_categorized_blog should return false.
        return false;
    }
}

/**
 * Flush out the transients used in massive_categorized_blog.
 */
function massive_category_transient_flusher() {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    // Like, beat it. Dig?
    delete_transient( 'massive_categories' );
}
add_action( 'edit_category', 'massive_category_transient_flusher' );
add_action( 'save_post',     'massive_category_transient_flusher' );

/**
 * Display post date
 * @param  string $position
 * @return string
 */
function massive_classic_style_post_date( $position ) {
    $position = $position == 'right' ? 'date right' : 'date left';
    printf( '<time class="%1$s" datetime="%2$s">%3$s<span>%4$s</span></time>',
        esc_attr( $position ),
        get_the_date( 'c' ),
        get_the_time( 'd' ),
        get_the_date( 'M Y' )
    );
}

/**
 * Display author link
 * @return string
 */
function massive_author_link() {
    echo massive_esc_desc(
        __( 'Posted by %s', 'massive' ),
        array('<a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a>')
    );
}

/**
 * Display post categories
 * @param  array  $categories
 * @param  string $separator
 * @param  string $output
 * @return string
 */
function massive_get_post_categories( $categories, $separator='', $output='' ){

    foreach( $categories as $category ) {
        $output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" title="' . esc_attr( sprintf( __( 'View all posts in %s', 'massive' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a>' . $separator;
    }
    echo trim( $output, $separator );
}

/**
 * Display customized comment link
 * @return string
 */
function massive_comments_link() {
    $num_comments = get_comments_number();
    $write_comments = '';
    if ( comments_open() ) {
        if ( $num_comments == 0 ) {
            $comments = esc_html__( 'No Comments', 'massive' );
        } elseif ( $num_comments > 1 ) {
            $comments = $num_comments . ' ' . esc_html__( 'Comments', 'massive' );
        } else {
            $comments = esc_html__( '1 Comment', 'massive' );
        }
        $write_comments = '<a href="' . esc_url( get_comments_link() ) .'">'. $comments.'</a>';
    } else {
        $write_comments =  esc_html__( 'Comments are off for this post.', 'massive' );
    }

    echo $write_comments;
}


if ( ! function_exists( 'massive_posts_navigation' ) ) :

function massive_posts_navigation() {
    global $wp_query;
    $big = 999999999; // need an unlikely integer

    $links = paginate_links(array(
        'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages,
        'type' => 'array',
        'prev_next' => true,
        'prev_text' => esc_html__('Prev', 'massive'),
        "next_text" => esc_html__('Next', 'massive'),
        'mid_size' => 3
    ));
    ?>
    <ul class="pagination custom-pagination">
        <?php
        if ($links) {
            foreach ($links as $link) {
                if (strpos($link, "current") !== false)
                    echo '<li class="active page-numbers"><a>' . $link . "</a></li>\n";
                else
                    echo '<li class="page-numbers">' . $link . "</li>\n";
            }
        }
        ?>
    </ul>
    <?php
}
endif;


/**
 * Get previous post link
 * @return string
 */
function massive_get_previous_post_link() {
    $previous_post = get_previous_post();
    $link          = '';
    if ( ! empty( $previous_post ) ) {
        $link = get_the_permalink( $previous_post->ID );
    }
    return $link;
}

/**
 * Get next post link
 * @return srting
 */
function massive_get_next_post_link() {
    $next_post = get_next_post();
    $link      = '';
    if ( ! empty( $next_post ) ) {
        $link = get_the_permalink( $next_post->ID );
    }
    return $link;
}

/**
 * Get previous post title
 * @return string
 */
function massive_get_previous_post_title() {
    $previous_post = get_previous_post();
    $title         = '';
    if ( ! empty( $previous_post ) ) {
        $title = get_the_title( $previous_post->ID );
    }
    return $title;
}

/**
 * Get next post title
 * @return string
 */
function massive_get_next_post_title() {
    $next_post = get_next_post();
    $title     = '';
    if ( ! empty( $next_post ) ) {
        $title = get_the_title( $next_post->ID );
    }
    return $title;
}

/**
 * Print massive breadcrumb
 * @return string
 */
function massive_breadcrumbs() {
    if ( function_exists( 'breadcrumb_trail') ) {
        $args = array(
            'show_browse' => false,
            );
        echo breadcrumb_trail( $args );
    }
}


function massive_social_media( $theme = '', $size = '' ) {
    $icons = cs_get_option( 'social_media', array() );

    if ( empty( $icons ) ) {
        return;
    }

    $variation[] = 'Social-link';
    $variation[] = 'Social-link--circle';
    $variation[] = ( ! empty( $theme ) ) ? "Social-link--{$theme}" : 'Social-link--dark';
    $variation[] = ( ! empty( $size ) ) ? "Social-link--{$size}" : 'Social-link--medium';

    echo '<div class="' . esc_attr( implode( ' ', $variation ) ) . '">';
        foreach( $icons as $icon ) {
            $name      = isset( $icon['name'] ) ? $icon['name'] : '';
            $link      = isset( $icon['link'] ) ? $icon['link'] : '';
            $link      = ( 'email' == $name ) ? 'mailto:' . esc_attr( $link ) : esc_url( $link );
            $icon_name = '';

            if ( 'email' == $name ) {
                $icon_name = 'fa fa-envelope-o';
            } elseif ( 'custom' == $name ) {
                $icon_name = isset( $icon['icon-name'] ) ? $icon['icon-name'] : '';
            } else {
                $icon_name = "fa fa-{$name}";
            }

            printf( '<a href="%s" class="Social-link__item" target="_blank"><i class="%s"></i></a>',
                $link,
                esc_attr( $icon_name )
                );
        }
    echo '</div>';
}

/**
 * Massive related posts
 * @param  boolean $related_posts
 * @param  string  $number_posts
 * @param  integer $posts_view
 * @return string
 */
function massive_get_related_posts( $related_posts = false, $number_posts = 4, $posts_view = 'list' ) {
    $query = new WP_Query();
    $args = '';
    if( ( false == $related_posts) || ( 0 == $number_posts ) ) {
        return $query;
    }

    printf( '<h4 class="text-uppercase">%s</h4>', esc_html__( "Related Post", 'massive' ) );

    $args = wp_parse_args( $args, array(
        'post_type'           => 'post',
        'category__in'        => wp_get_post_categories( get_the_ID() ),
        'ignore_sticky_posts' => 0,
        'posts_per_page'      => $number_posts,
        'post__not_in'        => array( get_the_ID() ),
        'meta_key'            => '_thumbnail_id',
    ));
    $query = new WP_Query( $args );

    if ( 'list' == $posts_view ) { ?>
        <?php if ( $query->have_posts() ) {
            echo '<div class="row">';
            while( $query->have_posts() ) {
            $query->the_post(); ?>
                <div class="col-md-3">
                    <div class="post-single">
                        <div class="post-img">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail( 'massive-xs-hard' ); ?>
                            </a>
                        </div>
                        <div class="post-desk">
                            <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to: %s', 'massive' ), get_the_title() ); ?>"><?php the_title(); ?></a>
                        </div>
                    </div>
                </div>
        <?php }
            echo '</div>';
        }
    } else { ?>
        <div id="portfolio-carousel" class="portfolio-with-title portfolio-gallery">
            <?php
                if ( $query->have_posts() ) {
                    while( $query->have_posts() ) { $query->the_post(); ?>
                        <div class="portfolio-item">
                            <div class="thumb">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail(); ?>
                                </a>
                            </div>
                            <div class="portfolio-title">
                                <h4>
                                    <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to: %s', 'massive' ), get_the_title() ); ?>"><?php the_title(); ?></a>
                                </h4>
                            </div>
                        </div>
            <?php } } ?>
        </div>
    <?php
    }

    wp_reset_postdata();
}

function massive_add_favicon() {
    if ( function_exists( 'wp_site_icon' ) ) {
        wp_site_icon();
    } else {
        $favicon = wp_get_attachment_image_src( cs_get_option('favicon'), 'full' );
        printf( '<link rel="shortcut icon" href="%s" />',
            esc_url( $favicon[0] )
            );
    }
}
add_action( 'wp_head', 'massive_add_favicon', 0, 1 );

if ( ! function_exists( 'massive_get_desc_for_portfolio_cats' ) ) {
    /**
     * Get vc map's description for portfolio categories checkbox
     * @return string
     */
    function massive_get_desc_for_portfolio_cats() {
        $args = array(
            'orderby'           => 'name',
            'order'             => 'ASC',
            'fields'            => 'id=>name',
        );

        $output = '';
        $terms = get_terms('portfolio-category', $args);

        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
            $output = esc_html__( 'Select portfolio categories (Leave empty to display from all categories)', 'massive' );
        } else{
            $output = massive_esc_desc( __( 'You may did not added any portfolio category yet. You can add categories over here %s', 'massive' ), array('<a href="'.esc_url(admin_url("edit-tags.php?taxonomy=portfolio-category&post_type=portfolio") ).'" target="_blank">Portfolio categories</a>') );
        }

        return $output;
    }
}


class Massive_Template {

    public static function add_preloader() {
        if ( cs_get_option( 'display_preloader' ) ) {
            echo '<div id="tb-preloader"><div class="tb-preloader-wave"></div></div>';
        }
    }

    public static function search_form() {
        ob_start();
        ?>
        <li class="nav-icon">
            <a href="javascript:void(0)"><i class="fa fa-search"></i> <?php esc_html_e( 'Search', 'massive' ); ?></a>
            <div class="megamenu megamenu-quarter-width search-box">
                <form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" autocomplete="off">
                    <label class="sr-only" for="nav-search-form"><?php esc_html_e( 'Search for:', 'massive' ) ?></label>
                    <input type="text" id="nav-search-form" name="s" class="form-control" placeholder="<?php esc_attr_e( 'Search Here...', 'massive' ); ?>">
                </form>
            </div>
        </li>
        <?php
        return ob_get_clean();
    }

    public static function cart() {
        ob_start();
        ?>
        <li class="nav-icon cart-info">
            <a href="javascript:void(0)" title="<?php esc_attr_e( 'View Shopping Cart', 'massive' ); ?>"><i class="fa fa-shopping-cart"></i> <?php printf( esc_html__( 'Cart (%s)', 'massive' ), WC()->cart->get_cart_contents_count() ); ?></a>
            <div class="megamenu megamenu-quarter-width">
                <div class="megamenu-row">
                    <div class="col12">
                        <?php woocommerce_mini_cart(); ?>
                    </div>
                </div>
            </div>
        </li>
        <?php
        return ob_get_clean();
    }

    public static function menu( $menu, array $classes ) {
        $html = '';

        if ( massive_has_woocommerce() || cs_get_option( 'display_search' ) ) {
            $html .= '<li class="nav-icon nav-divider"><a href="javascript:void(0)">|</a></li>';
        }

        if ( massive_has_woocommerce() ) {
            $html .= Massive_Template::cart();
        }

        if ( cs_get_option( 'display_search' ) ) {
            $html .= Massive_Template::search_form();
        }

        /**
         * Displays a navigation menu
         * @param array $args Arguments
         */
        $args = array(
            'menu' => $menu,
            'theme_location' => 'primary',
            'container' => false,
            'menu_class' => 'menuzord-menu ' . esc_attr( implode( ' ', $classes ) ),
            'walker' => new Massive_Megamenu_Walker,
            'items_wrap' => '<ul id="%1$s" role="menubar" class="%2$s">%3$s' . $html . '</ul>',
            'fallback_cb' => 'Massive_Megamenu_Walker::fallback',
        );

        wp_nav_menu( $args );
    }

    /**
     * Get massive logo html
     * @param  int $default Default logo id
     * @param  int $retina  Retina logo id
     * @param  string $class Logo class
     * @return string       Complete brand logo html
     */
    public static function get_logo( $default = 0, $retina = 0, $class = 'logo-brand' ) {
        $default = wp_get_attachment_image_src( $default, 'full' );
        $retina = wp_get_attachment_image_src( $retina, 'full' );
        $brand_name = esc_html( get_bloginfo( 'name' ) );
        $retina_url = '';

        if ( isset( $retina[0] ) ) {
            $retina_url = apply_filters( 'massive_header_logo_url:retina', esc_url( $retina[0] ) );
        }

        if ( isset( $default[0] ) ) {
            $brand_name = sprintf( '<img src="%1$s" data-retina="%2$s" alt="%3$s">',
                apply_filters( 'massive_header_logo_url:default', esc_url( $default[0] ) ),
                $retina_url,
                esc_attr( get_bloginfo( 'name' ) )
                );
        }

        return sprintf( '<a class="%4$s" href="%1$s" title="%2$s">%3$s</a>',
            esc_url( home_url( '/' ) ),
            esc_attr( get_bloginfo( 'name' ) ),
            $brand_name,
            esc_attr( $class )
            );
    }

}

add_action( 'massive_page_start', array('Massive_Template', 'add_preloader') );

/**
 * Useful for adding blog partial templates
 *
 * @param $name string Template name
 */
function massive_get_blog_partial( $name ) {
    get_template_part('partials/blog/' . $name);
}

/**
 * Useful for adding header partial templates
 * @param $name string Template name
 */
function massive_get_header_partial( $name ) {
    get_template_part('partials/header/' . $name );
}

/**
 * Useful for adding footer partial templates
 *
 * @param $name string Template name
 */
function massive_get_footer_partial( $name ) {
    get_template_part('partials/footer/' . $name);
}
