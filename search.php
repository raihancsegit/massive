<?php
/**
 * Template for displaying search results.
 *
 *
 * @package Massive
 */

get_header();

$layout         = cs_get_option( 'blog_layout', 'boxed' );
$sidebar        = cs_get_option( 'blog_sidebar', 'right' );
$list_style     = cs_get_option( 'blog_style', 'classic' );
$classic_layout = cs_get_option( 'blog_classic_style', 'one' );
$masonry_layout = cs_get_option( 'blog_masonry_style', 'two' );
$blog_title     = cs_get_option( 'blog_home_title', esc_html__( 'Blog', 'massive' ) );
$container      = massive_get_container_class( $layout );
$column         = massive_get_column_class( $sidebar );
$masonry_column = massive_get_masonry_column_class( $masonry_layout );
$grid_class     = 'clearfix ';
?>

<section class="page-title">
    <div class="container">
        <h4 class="text-uppercase"><?php printf( esc_html__( 'Search results for: %s', 'massive' ), get_search_query(true) ); ?></h4>
        <?php if ( function_exists( 'massive_breadcrumbs' ) ) { massive_breadcrumbs(); } ?>
    </div>
</section>

<section class="body-content">
    <div class="page-content">
        <div class="<?php echo esc_attr( $container ); ?>">
            <div class="row">

                <div class="<?php echo esc_attr( $column['main'] ); ?>">
                    <?php if ( have_posts() ) { ?>

                        <div class="<?php echo esc_attr( $grid_class ); ?>">

                            <?php while ( have_posts() ) { the_post(); ?>

                                <?php get_template_part( 'partials/content', 'search');?>

                            <?php } // End of the loop. ?>

                        </div>

                        <div class="text-center">
                            <?php massive_posts_navigation(); ?>
                        </div>
                    <?php
                    } else {
                        get_template_part( 'partials/content', 'none' );
                    } ?>
                </div>

                <?php if ( $sidebar !== 'no-sidebar') { ?>
                    <div class="<?php echo esc_attr( $column['sidebar'] ); ?>">
                        <?php get_sidebar(); ?>
                    </div>
                <?php } ?>

            </div><!-- .row -->
        </div><!-- .container -->
    </div><!-- .page-content -->
</section> <!-- .body-content -->

<?php get_footer(); ?>
