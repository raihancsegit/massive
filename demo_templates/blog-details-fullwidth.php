<?php
/**
 *Template Name: Blog-Details-FullWidth
 */

$layout    = 'boxed';
$sidebar   = 'no-sidebar';
$container = massive_get_container_class( $layout );
$column    = massive_get_column_class( $sidebar );

get_header();

get_template_part( 'demo_templates/partials/blog/common/title' );
?>

<!--body content start-->
<section class="body-content" aria-label="<?php esc_attr_e( 'Post Content', 'massive' ); ?>">
    <div class="page-content post-content-<?php the_ID(); ?>">
        <div class="<?php echo esc_attr( $container ); ?>">
            <div class="row">

                <div class="<?php echo esc_attr( $column['main'] ); ?>">

                    <!--classic image post-->
                    <div class="blog-classic">
                        <div class="blog-post">
                            <?php 
                                query_posts( array( 'post_type' => 'post', 'posts_per_page' => 1, ) );
                                if ( have_posts() ) { 
                                while ( have_posts() ) {
                                    the_post(); ?>
                                <?php get_template_part( 'demo_templates/partials/content', 'single' ); ?>
                            <?php }
                            } // End of the loop. ?>

                            <?php
                                // If comments are open or we have at least one comment, load up the comment template.
                                if ( comments_open() || get_comments_number() ) :
                                    comments_template();
                                endif;
                            ?>

                        </div>
                    </div>
                    <!--classic image post-->

                </div>

                <?php if ( $sidebar != 'no-sidebar') { ?>
                    <div class="<?php echo esc_attr( $column['sidebar'] ); ?>">
                        <?php get_sidebar(); ?>
                    </div>
                <?php } ?>

            </div> <!-- .row -->
        </div> <!-- .container -->
    </div> <!-- .page-content -->
</section> <!-- .body-content -->
<?php get_footer(); ?>
