<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Massive
 */
?>

<div class="blog-classic">
    <article id="post-<?php echo esc_attr( get_the_ID() ); ?>" <?php post_class( 'blog-post' ); ?>>

        <h4 class="text-uppercase">
            <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to: %s', 'massive' ), get_the_title() ); ?>">
                <?php the_title(); ?>
            </a>
        </h4>

        <div class="massive-post-content">
            <?php the_excerpt(); ?>
        </div>

    </article><!-- #post-<?php the_ID(); ?> -->
</div> <!-- .body-classic -->


