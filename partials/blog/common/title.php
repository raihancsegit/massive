<?php
$alignment          = cs_get_option( 'blog_title_alignment' );
$display_breadcrumb = cs_get_option( 'display_blog_title_breadcrumb' );
$pagetitle          = array( 'page-title' );

if ( 'align-right' == $alignment ) {
    $pagetitle[] = 'page-title-right';
} elseif( 'align-center' == $alignment ) {
    $pagetitle[] = 'page-title-center';
} else {
    $pagetitle[] = 'page-title-left';
}

$pagetitle[] = 'page-title-custom';

if ( is_archive() ) {
    $title = get_the_archive_title();
} elseif ( is_home() || is_front_page() ) {
    $title = esc_html( cs_get_option( 'blog_home_title' ) );
} else {
    $title = single_post_title( '', false );
}
?>

<section class="<?php echo esc_attr( implode( ' ', $pagetitle ) ); ?>" aria-label="<?php esc_attr_e( 'Post Heading', 'massive' ); ?>">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-uppercase h4 page-main-title"><?php echo $title; ?></h1>
                <?php if ( $display_breadcrumb ) { massive_breadcrumbs(); } ?>
            </div>
        </div>
    </div>
</section>
