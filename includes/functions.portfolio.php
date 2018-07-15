<?php
/**
 * Massive related portfolio
 * @param  boolean $related_portfolio
 * @param  string  $number_portfolio
 * @param  integer $portfolio_view
 * @return string
 */
function massive_get_related_portfolio( $related_portfolio = true, $number_portfolio = 5 ) {
    $query = new WP_Query();
    $args  = '';
    $cats  = wp_get_object_terms( get_the_id(), 'portfolio-category', array('fields' => 'slugs') );

    if ( ( false == $related_portfolio) || ( 0 == $number_portfolio ) ) {
        return $query;
    }

    printf( '<div class="heading-title-alt text-left m-bot-50"><h4 class="text-uppercase">%s</h4></div>', esc_html__( 'Related Portfolio', 'massive' ) );

    $args = wp_parse_args( $args, array(
        'post_type'           => 'portfolio',
        'portfolio-category'  => implode( ',' , $cats ),
        'ignore_sticky_posts' => 0,
        'posts_per_page'      => $number_portfolio,
        'post__not_in'        => array( get_the_ID() ),
        'meta_key'            => '_thumbnail_id',
    ) );

    $query = new WP_Query( $args );
        if ( $query->have_posts() ) { ?>

            <div id="portfolio-carousel" class="portfolio-with-title portfolio-gallery">
                <?php while ( $query->have_posts() ) { $query->the_post(); ?>
                    <div class="portfolio-item">
                        <div class="thumb">
                            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'massive-xs-hard' ); ?></a>
                        </div>
                        <div class="portfolio-title">
                            <h4><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to: %s', 'massive' ), get_the_title() ); ?>"><?php the_title(); ?></a></h4>
                        </div>
                    </div>
                <?php } ?>
            </div>

        <?php
        }
    wp_reset_postdata();
}

/**
 * Display portfolio filter navigation
 * @return string
 */
function massive_portfolio_filter_nav() {
    $tags = get_terms( 'portfolio-tag' );
    $html = "";
    $html .= '<ul class="portfolio-filter">' . "\n";
    $html .= "\t<li><a href='#' data-filter='*'>" . esc_html__( 'All', 'massive' ) . "</a></li>\n";
        if ( ! empty( $tags ) && ! is_wp_error( $tags ) ) {
            foreach ( $tags as $tag ) {
                $html .= "\t<li><a href='#' data-filter='.portfolio-tag-" . esc_attr( $tag->slug ) . "'>" . esc_html( $tag->name ) . "</a></li>\n";
            }
        }
    $html .= '</ul>';
    echo $html;
}

/**
 * Get portfolio class
 * @return string
 */
function massive_get_portfolio_class() {
    $tags = get_the_terms( get_the_ID(), 'portfolio-tag' );
    if ( ! empty( $tags ) && ! is_wp_error( $tags ) ) {
        foreach ( $tags as $tag ) {
           echo 'portfolio-tag-' . esc_attr( $tag->slug ) . ' ' ;
        }
    }
}
/**
 * Get portfolio tags
 * @return string
 */
function massive_get_portfolio_tags() {
    $tags = get_the_terms( get_the_ID(), 'portfolio-tag' );
    if ( ! empty( $tags ) && ! is_wp_error( $tags ) ) {
        foreach ( $tags as $tag ) {
           echo esc_attr( $tag->slug ) . ' ' ;
        }
    }
}

/**
 * Get portfolio categorires to usages on template
 * @return string
 */
function massive_get_portfolio_cats() {
    $cats = get_the_terms( get_the_ID(), 'portfolio-category' );
    if ( ! empty( $cats ) && ! is_wp_error( $cats ) ) {
        foreach ( $cats as $cat ) {
           echo esc_attr( $cat->name ) . ' ' ;
        }
    }
}
