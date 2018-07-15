<?php
/**
 * Massive_Walker_Commentt class
 * HTML comment list class.
 *
 */
class Massive_Walker_Comment extends Walker_Comment {

    /**
     * Output a comment in the HTML5 format.
     * @param object $comment Comment to display.
     * @param int    $depth   Depth of comment.
     * @param array  $args    An array of arguments.
     */
    protected function html5_comment( $comment, $depth, $args ) {
        $tag = ( 'div' === $args['style'] ) ? 'div' : 'li';
        ?>
        <<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" class="media">
        <div class="pull-left">
            <?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
        </div><!-- .comment-author -->
        <article id="div-comment-<?php comment_ID(); ?>" class="media-body">
            <footer class="comment-info">
                <?php echo massive_esc_desc( __( '%s <span class="says">says:</span>', 'massive' ), array( sprintf( '<b class="fn">%s</b>', get_comment_author_link( $comment ) ) ) ); ?>

                <div class="comment-metadata">
                    <a href="<?php echo esc_url( get_comment_link( $comment, $args ) ); ?>">
                        <time datetime="<?php comment_time( 'c' ); ?>">
                            <?php
                            /* translators: 1: comment date, 2: comment time */
                            printf( esc_html__( '%1$s at %2$s', 'massive' ), get_comment_date( '', $comment ), get_comment_time() );
                            ?>
                        </time>
                    </a>
                    <?php edit_comment_link( esc_html__( 'Edit', 'massive' ), '<span class="edit-link">', '</span>' ); ?>
                    <?php
                    comment_reply_link( array_merge( $args, array(
                        'add_below' => 'div-comment',
                        'depth'     => $depth,
                        'max_depth' => $args['max_depth'],
                        'before'    => '<a href="#"><i class="fa fa-comment-o"></i>',
                        'after'     => '</a>'
                        ) ) );
                        ?>
                    </div><!-- .comment-metadata -->

                    <?php if ( '0' == $comment->comment_approved ) : ?>
                        <p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'massive' ); ?></p>
                    <?php endif; ?>
                </footer><!-- .comment-meta -->

                <div class="comment-content">
                    <?php comment_text(); ?>
                </div><!-- .comment-content -->

            </article><!-- .comment-body -->
            <?php
        }
    }
