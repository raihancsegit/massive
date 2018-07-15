<?php
/**
 * Template Name: Blog-Classic-Sidebar-Left
 */
$layout         = 'boxed';
$sidebar        = 'left';
$list_style     = 'classic';
$classic_layout = 'one';
$masonry_layout = 'two';
$blog_title     = 'BLOG';
$container      = massive_get_container_class( $layout );
$column         = massive_get_column_class( $sidebar );
$masonry_column = massive_get_masonry_column_class( $masonry_layout );
$grid_class     = '';

if ( 'grid' === $list_style ) {
    $grid_class .= 'row post-list';
} elseif ( 'masonry' === $list_style ) {
    $grid_class .= 'portfolio portfolio-with-title portfolio-masonry blog-m gutter ' . $masonry_column;
}

get_header();

get_template_part( 'partials/blog/common/title' );
?>

<section class="body-content" aria-label="<?php esc_attr_e( 'Page Content', 'massive' ); ?>">
    <div class="page-content">
        <div class="<?php echo esc_attr( $container ); ?>">
            <div class="row">
                <div class="<?php echo esc_attr( $column['main'] ); ?>">
                    <?php 
                    query_posts( array( 'post_type' => 'post', 'posts_per_page' => 10, ) );
                    if ( have_posts() ) { ?>
                        <div class="<?php echo esc_attr( $grid_class ); ?>">
                            <?php while ( have_posts() ) : the_post(); ?>

                                <?php
                                    if ( $list_style && 'classic' == $list_style ) {
                                        get_template_part( "demo_templates/partials/blog/{$list_style}/" . $classic_layout );
                                    } else {
                                        get_template_part( "demo_templates/partials/blog/{$list_style}/main" );
                                    }
                                ?>

                            <?php endwhile; // End of the loop. ?>
                        </div>

                    <div class="text-center">
                        <?php //massive_posts_navigation(); ?>
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
