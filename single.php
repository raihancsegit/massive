<?php
/**
 * Template for displaying single post.
 *
 *
 * @package Massive
 */

$layout    = cs_get_option( 'blog_details_layout' );
$sidebar   = cs_get_option( 'blog_details_sidebar' );
$container = massive_get_container_class( $layout );
$column    = massive_get_column_class( $sidebar );

get_header();

get_template_part( 'partials/blog/common/title' );
?>

<!--body content start-->
<section class="body-content" aria-label="<?php esc_attr_e( 'Post Content', 'massive' ); ?>">
    <div class="page-content post-content-<?php echo esc_attr( get_the_ID() ); ?>">
        <div class="<?php echo esc_attr( $container ); ?>">
            <div class="row">

                <div class="<?php echo esc_attr( $column['main'] ); ?>">

                    <!--classic image post-->
                    <div class="blog-classic">
                        <div class="blog-post">
                            <?php
                                while ( have_posts() ) { the_post();
                                    get_template_part( 'partials/content', 'single' );
                                } // End of the loop.

                                // If comments are open or we have at least one comment, load up the comment template.
                                if ( comments_open() || get_comments_number() ) {
                                    comments_template();
                                }
                            ?>
                        </div>
                    </div>
                    <!--classic image post-->

                </div>

                <?php if ( $sidebar !== 'no-sidebar') { ?>
                    <div class="<?php echo esc_attr( $column['sidebar'] ); ?>">
                        <?php get_sidebar(); ?>
                    </div>
                <?php } ?>

            </div> <!-- .row -->
        </div> <!-- .container -->
    </div> <!-- .page-content -->
</section> <!-- .body-content -->

<?php get_footer(); ?>
