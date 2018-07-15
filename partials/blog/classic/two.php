<?php
$sidebar          = cs_get_option( 'blog_sidebar' );
$post_meta        = cs_get_option( 'show_post_meta' );
$meta_author      = cs_get_option( 'show_meta_post_author' );
$meta_category    = cs_get_option( 'show_meta_post_category' );
$meta_comments_no = cs_get_option( 'show_meta_post_comments_no' );
$meta_date        = cs_get_option( 'show_meta_post_time' );
$date_format      = cs_get_option( 'date_format' );
$media_on_archive = cs_get_option( 'show_featured_media_on_blog_archive' );
$categories       = get_the_category();

if ( is_archive() ) {
    $content_length = cs_get_option( 'blog_archive_content' );
}else{
    $content_length = cs_get_option( 'blog_home_content' );
}
?>

<div class="page-content">
    <div class="row">

        <!--blog list-->
        <div class="post-list-aside">
            <article id="post-<?php echo esc_attr( get_the_ID() ); ?>" <?php post_class( 'post-single' ); ?>>

                <?php if ( ( $classicStyleTwoDivider % 2 ) == 0 ) { ?>
                    <div class="col-md-5">
                        <?php if ( ! is_archive() || ( is_archive() && $media_on_archive ) ) { ?>
                            <div class="post-img">
                                <?php get_template_part( 'partials/blog/common/content', get_post_format() ); ?>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>

                <div class="col-md-7">
                    <div class="post-desk text-center">

                        <ul class="post-cat">
                            <?php if ( $post_meta && $meta_category && ! empty( $categories ) ) { ?>
                                <li><?php massive_get_post_categories( $categories, ' &nbsp;' ); ?></li>
                            <?php } ?>
                        </ul>

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
                </div>

                <?php if ( ( $classicStyleTwoDivider % 2 ) != 0 ) { ?>
                    <div class="col-md-5">
                        <?php if ( ! is_archive() || ( is_archive() && $media_on_archive ) ) { ?>
                            <div class="post-img">
                                <?php get_template_part( 'partials/blog/common/content', get_post_format() ); ?>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>

            </article> <!-- #post-<?php the_ID(); ?> -->
        </div>
        <!--blog list-->

    </div> <!-- .row -->
</div> <!-- .page-content -->

<hr/>
