<?php
/**
 * Template Name: Massive Portfolio
 */

$layout           = cs_get_option( 'portfolio_layout' );
$gutter           = cs_get_option( 'has_portfolio_gutter' );
$masonry          = cs_get_option( 'has_portfolio_masonry' );
$grid             = cs_get_option( 'portfolio_grid_quantity' );
$filter_nav       = cs_get_option( 'portfolio_filter' );
$content_position = cs_get_option( 'content_position' );
$container        = massive_get_container_class( $layout );

$categorie  = '';
$categories = cs_get_option( 'portfolio_category' ) ;

if ( ! empty ( $categories ) ) {
    $categorie = implode( ',', cs_get_option( 'portfolio_category' ) );
}

get_header();

while ( have_posts() ) { the_post();
?>

<section class="body-content page-content">
    <div class="<?php echo esc_attr( $container ); ?>">
        <div class="row">
            <div class="col-md-12">
                <?php echo do_shortcode( '[massive_portfolio portfolio_grid_quantity="'. esc_attr( $grid ) .'" has_portfolio_gutter="'. esc_attr( $gutter ) .'" content_position="'. esc_attr( $content_position ) .'" portfolio_items="-1" has_portfolio_masonry="'. esc_attr( $masonry ) .'" portfolio_filter="'. esc_attr( $filter_nav ) .'" categories="'. esc_attr( $categorie ) .'"]' ) ?>
            </div>
        </div>
    </div>
</section> <!-- .page-content -->

<?php
/**
 * End loop
 */
}

get_footer();
