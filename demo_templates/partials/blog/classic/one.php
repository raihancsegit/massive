<?php
$sidebar          = cs_get_option( 'blog_sidebar' );
$post_meta        = cs_get_option( 'show_post_meta' );
$meta_author      = cs_get_option( 'show_meta_post_author' );
$meta_category    = cs_get_option( 'show_meta_post_category' );
$meta_comments_no = cs_get_option( 'show_meta_post_comments_no' );
$meta_date        = cs_get_option( 'show_meta_post_time' );
$media_on_archive = cs_get_option( 'show_featured_media_on_blog_archive' );
$categories       = get_the_category();
$time_position    = ( $sidebar == 'left' ) ? 'right' : 'left';

if ( is_archive() ) {
    $content_length = cs_get_option( 'blog_archive_content' );
} else {
    $content_length = cs_get_option( 'blog_home_content' );
}
?>

<div class="blog-classic">

    <?php if ( $post_meta && $meta_date ) {
        massive_classic_style_post_date( $time_position );
    } ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class( 'blog-post' ); ?>>

        <?php if ( ! is_archive() || ( is_archive() && $media_on_archive ) ) { ?>
            <div class="full-width">
                   <?php echo get_template_part( 'partials/blog/common/content', get_post_format() ); ?>
            </div>
        <?php } ?>

        <h4 class="text-uppercase">
            <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to: %s', 'massive' ), get_the_title() ); ?>">
                <?php the_title(); ?>
            </a>
        </h4>

        <?php if ( $post_meta ) { ?>
            <ul class="post-meta">

                <?php if ( $meta_author ) { ?>
                    <li><i class="fa fa-user"></i><?php massive_author_link(); ?></li>
                <?php } ?>

                <?php if ( $meta_category && ! empty( $categories ) ) { ?>
                    <li><i class="fa fa-folder-open"></i><?php massive_get_post_categories( $categories, ', ' ); ?></li>
                <?php } ?>

                <?php if ( $meta_comments_no ) { ?>
                    <li><i class="fa fa-comments"></i><?php massive_comments_link(); ?></li>
                <?php } ?>

            </ul>
        <?php } ?>

        <div class="massive-post-content">
            <?php
            if ( 'excerpt' ===  $content_length ) {
                the_excerpt();
            } elseif ( 'full-content' ===  $content_length ) {
                the_content();
            } ?>
        </div>

    </article><!-- #post-<?php the_ID(); ?> -->
</div>
