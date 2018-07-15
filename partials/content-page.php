<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Massive
 */

?>

<article id="post-<?php echo esc_attr( get_the_ID() ); ?>" <?php post_class(); ?>>
    <?php if ( has_post_thumbnail() ) { ?>
        <div class="entry-feauted-image">
            <?php the_post_thumbnail( 'massive-md-soft' ); ?>
        </div>
    <?php } ?>

    <div class="entry-content clearfix">
        <?php the_content(); ?>
        <?php
            wp_link_pages( array(
                'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'massive' ),
                'after'  => '</div>',
            ) );
        ?>
    </div><!-- .entry-content -->

    <footer class="entry-footer">
        <?php
            edit_post_link(
                sprintf(
                    /* translators: %s: Name of current post */
                    esc_html__( 'Edit %s', 'massive' ),
                    the_title( '<span class="screen-reader-text">"', '"</span>', false )
                ),
                '<span class="edit-link">',
                '</span>'
            );
        ?>
    </footer><!-- .entry-footer -->
</article><!-- #post-## -->

