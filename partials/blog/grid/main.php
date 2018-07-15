<?php
$sidebar          = cs_get_option( 'blog_sidebar' );
$post_meta        = cs_get_option( 'show_post_meta' );
$meta_author      = cs_get_option( 'show_meta_post_author' );
$meta_category    = cs_get_option( 'show_meta_post_category' );
$meta_comments_no = cs_get_option( 'show_meta_post_comments_no' );
$meta_date        = cs_get_option( 'show_meta_post_time' );
$date_format      = cs_get_option( 'date_format' );
$grid             = cs_get_option( 'blog_grid_style' );
$media_on_archive = cs_get_option( 'show_featured_media_on_blog_archive' );
$categories       = get_the_category();
$grid_class       = massive_get_grid_column_class( $grid );

if ( is_archive() ) {
    $content_length = cs_get_option( 'blog_archive_content' );
}else{
    $content_length = cs_get_option( 'blog_home_content' );
}
?>

<div class="<?php echo esc_attr( $grid_class ); ?>">
    <article id="post-<?php echo esc_attr( get_the_ID() ); ?>" <?php post_class( array( 'post-single', 'blog-grid-view' ) ); ?>>

        <ul class="post-cat">
            <?php if ( $post_meta && $meta_category && ! empty( $categories ) ) { ?>
                <li><?php massive_get_post_categories( $categories, ' &nbsp;' ); ?></li>
            <?php } ?>
        </ul>

        <?php if ( ! is_archive() || ( is_archive() && $media_on_archive ) ) { ?>
            <div class="post-img">
                <?php get_template_part( 'partials/blog/common/content', get_post_format() ); ?>
            </div>
        <?php } ?>

        <div class="post-desk">

            <h4 class="text-uppercase">
                <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to: %s', 'massive' ), get_the_title() ); ?>">
                    <?php the_title(); ?>
                </a>
            </h4>

            <div class="date">
            <?php
                if ( $post_meta && $meta_author ) {
                    massive_author_link();
                }

                if ( $post_meta && $meta_date ) {
                     echo '<a href="'. esc_url( get_the_permalink() ) .'"><span class="meta-date">' . get_the_time( $date_format ) . '</span></a>';
                }
            ?>
            </div>

            <div class="massive-post-content">
            <?php
                if (  'excerpt' ===  $content_length ) {
                    the_excerpt();
                } elseif ( 'full-content' ===  $content_length ) {
                    the_content();
                }
            ?>
            </div>

        </div>
    </article> <!-- #post-<?php the_ID(); ?> -->
</div>
