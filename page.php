<?php
/**
 * Template for displaying page.
 *
 *
 * @package Massive
 */

$pageid    = get_queried_object_id();
$pagemeta  = get_post_meta( $pageid, '_massive_page_options', true );
$sidebar   = massive_get_meta( $pagemeta, 'sidebar_active-sidebar', 'no-sidebar' );
$subtitle  = massive_get_meta( $pagemeta, 'title_sub_title' );
$alignment = massive_get_meta( $pagemeta, 'title_alignment', 'align-left' );

if ( 'right-sidebar' == $sidebar ) {
    $column = array( 'main' => 'col-md-8', 'right-sidebar' => 'col-md-4' );
} elseif ( 'left-sidebar' == $sidebar ) {
    $column = array( 'main' => 'col-md-8 col-md-push-4', 'left-sidebar' => 'col-md-4 col-md-pull-8' );
} elseif ( 'both-sidebar' == $sidebar ) {
    $column = array( 'main' => 'col-md-6 col-md-push-3', 'left-sidebar' => 'col-md-3 col-md-pull-6 col-sm-6', 'right-sidebar' => 'col-md-3 col-sm-6' );
} else {
    $column = array( 'main' => 'col-md-12' );
}

$pagetitle = array( 'page-title' );

if ( 'align-right' == $alignment ) {
    $pagetitle[] = 'page-title-right';
} elseif( 'align-center' == $alignment ) {
    $pagetitle[] = 'page-title-center';
} else {
    $pagetitle[] = 'page-title-left';
}

$pagetitle[] = "page-title-{$pageid}";

get_header(); ?>

    <?php if ( empty( $pagemeta ) || ( isset( $pagemeta['title_status'] ) && $pagemeta['title_status'] ) ) { ?>
        <section class="<?php echo esc_attr( implode( ' ', $pagetitle ) ); ?>" aria-label="<?php esc_attr_e( 'Page Heading', 'massive' ); ?>">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="text-uppercase h4 page-heading-<?php echo esc_attr( $pageid ); ?>"><?php single_post_title(); ?></h1>
                        <?php if ( $subtitle ) { ?>
                            <span class="page-subtitle page-subheading-<?php echo esc_attr( $pageid ); ?>"><?php echo wp_kses_post( $subtitle ); ?></span>
                        <?php } ?>
                        <?php if ( empty( $pagemeta ) || ( isset( $pagemeta['display_title_breadcrumb'] ) && $pagemeta['display_title_breadcrumb'] ) ) {
                            massive_breadcrumbs();
                        } ?>
                    </div>
                </div>
            </div>
        </section>
    <?php } ?>

    <section class="body-content" aria-label="<?php esc_attr_e( 'Page Content', 'massive' ); ?>">
        <div class="container">
            <div class="row">
                <div class="page-content page-content-<?php echo esc_attr( get_the_ID() ); ?>">
                    <main class="<?php echo esc_attr( $column['main'] ); ?>" id="main" role="main">
                        <?php while ( have_posts() ) { the_post(); ?>
                            <?php get_template_part( 'partials/content', 'page' ); ?>
                            <?php
                                // If comments are open or we have at least one comment, load up the comment template.
                                if ( comments_open() || get_comments_number() ) {
                                    comments_template();
                                }
                            ?>
                        <?php } // End of the loop. ?>
                    </main> <!-- #main -->

                    <?php if ( 'left-sidebar' === $sidebar || 'both-sidebar' === $sidebar ) { ?>
                        <div class="<?php echo esc_attr( $column['left-sidebar'] ); ?>" id="sidebar-primary">
                            <div class="widget-area" role="complementary">
                                <?php dynamic_sidebar( massive_get_meta( $pagemeta, 'sidebar_left-sidebar' ) ); ?>
                            </div>
                        </div>
                    <?php } ?>

                    <?php if ( 'right-sidebar' === $sidebar || 'both-sidebar' === $sidebar ) { ?>
                        <div class="<?php echo esc_attr( $column['right-sidebar'] ); ?>" id="sidebar-secondary">
                            <div class="widget-area" role="complementary">
                                <?php dynamic_sidebar( massive_get_meta( $pagemeta, 'sidebar_right-sidebar' ) ); ?>
                            </div>
                        </div>
                    <?php } ?>

                </div>
            </div> <!-- .row -->
        </div> <!-- .container -->
    </section> <!-- .body-content -->

<?php get_footer(); ?>
