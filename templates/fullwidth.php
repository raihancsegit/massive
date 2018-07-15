<?php
/**
 * Template Name: Full Width
 *
 * @package Massive
 */

$pageid = get_queried_object_id();
$pagemeta = get_post_meta( $pageid, '_massive_page_options', true );
$subtitle = massive_get_meta( $pagemeta, 'title_sub_title' );
$alignment = massive_get_meta( $pagemeta, 'title_alignment', 'align-left' );

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
                        <?php if ( empty( $pagemeta ) || ( isset( $pagemeta['display_title_breadcrumb'] ) && $pagemeta['display_title_breadcrumb'] ) ) { massive_breadcrumbs();
                        } ?>
                    </div>
                </div>
            </div>
        </section>
    <?php } ?>

    <div class="page-content page-content-<?php echo esc_attr( get_the_ID() ); ?>">
        <div class="container-fluid">
            <main class="site-main" role="main">
                <?php
                    while ( have_posts() ) { the_post();
                        the_content();
                    }
                ?>
            </main>
        </div>
    </div>

<?php get_footer(); ?>
