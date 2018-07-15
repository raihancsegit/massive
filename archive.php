<?php
/**
 * The template for displaying archive posts.
 *
 *
 * @package Massive
 */
$layout           = cs_get_option( 'blog_layout', 'boxed' );
$sidebar          = cs_get_option( 'blog_sidebar', 'right' );
$list_style       = cs_get_option( 'blog_style', 'classic' );
$classic_layout   = cs_get_option( 'blog_classic_style', 'one' );
$masonry_layout   = cs_get_option( 'blog_masonry_style', 'two' );
$container        = massive_get_container_class( $layout );
$column           = massive_get_column_class( $sidebar );
$masonry_column   = massive_get_masonry_column_class( $masonry_layout );
$media_on_archive = cs_get_option( 'show_featured_media_on_blog_archive' );
$grid_class       = 'clearfix ';

if ( $list_style == 'grid' ) {
    $grid_class .= 'post-list';
} elseif ( $list_style == 'masonry' ) {
    $grid_class .= 'portfolio portfolio-with-title portfolio-masonry blog-m gutter ' . $masonry_column;
}

get_header();

get_template_part( 'partials/blog/common/title' );
?>

<section class="body-content">
    <div class="page-content">

        <div class="<?php echo esc_attr( $container ); ?>">
            <div class="row">

                <div class="<?php echo esc_attr( $column['main'] ); ?>">
                    <?php
                        $classic_style_two_divider = 0;
                        if ( have_posts() ){ ?>
                        <div class="<?php echo esc_attr( $grid_class ); ?>">
                            <?php while ( have_posts() ) { the_post(); $classic_style_two_divider++; ?>

                            <?php
                                if ( $list_style && 'classic' === $list_style ) {
                                    set_query_var( 'classicStyleTwoDivider', $classic_style_two_divider );
                                    get_template_part( "partials/blog/{$list_style}/" . $classic_layout );
                                } else {
                                    get_template_part( "partials/blog/{$list_style}/main" );
                                }
                            ?>
                            <?php } // End of the loop. ?>

                        </div>
                    <div class="text-center">
                        <?php massive_posts_navigation(); ?>
                    </div>
                    <?php } else { get_template_part( 'partials/content', 'none' ); } ?>
                </div>

                <?php if ( $sidebar !== 'no-sidebar') { ?>
                    <div class="<?php echo esc_attr( $column['sidebar'] ); ?>">
                        <?php get_sidebar(); ?>
                    </div>
                <?php } ?>

            </div><!-- .row -->
        </div><!-- .container -->

    </div><!-- .page-content -->
</section>

<?php get_footer(); ?>
