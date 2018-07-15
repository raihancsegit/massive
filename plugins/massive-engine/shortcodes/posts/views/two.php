<?php
$excerpt_length = $atts['excerpt_length'];
$date_format = cs_get_option( 'date_format' );
$args = array(
    'post_type'      => 'post',
    'post_status'    => $atts['status'],
    'posts_per_page' => $atts['number'],
    'order'          => $atts['order'],
    'orderby'        => $atts['orderby'],
    'category_name'  => $atts['categories'],
);

?>
<div class="post-list post row">

<?php
    $query = new WP_Query( $args );
    if ( $query->have_posts() ) :
        while ( $query->have_posts() ) : $query->the_post();
            $categories = get_the_category();
        ?>

        <div class="col-md-4">
            <div class="post-single">
                <ul class="post-cat">
                    <li><?php massive_get_post_categories( $categories, ' &nbsp;' ); ?></li>
                </ul>
                <div class="post-img">
                    <?php include ( dirname( __FILE__ ) . '/content/content.php' ); ?>
                </div>
                <div class="post-desk">
                    <h4 class="text-uppercase"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                    <div class="date">
                        <a class="author" rel="author" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php the_author(); ?></a>
                        <?php the_time( $date_format ); ?>
                    </div>
                    <p>
                    <?php
                    global $post;
                    if ( $post->post_excerpt ) :
                        echo esc_html( $post->post_excerpt );
                    else:
                        echo wp_trim_words( get_the_content(), $excerpt_length, '...' );
                    endif;
                    ?>
                    </p>
                    <a href="<?php the_permalink(); ?>" class="p-read-more"><?php esc_html_e( 'Read More', 'massive-engine' ); ?><i class="icon-arrows_slim_right"></i></a>
                </div>
            </div>
        </div>

        <?php
        endwhile;
    else:
        echo '<p>'. esc_html__( 'No post found!', 'massive-engine') . '</p>';
    endif;

    wp_reset_postdata();
?>

</div><!-- .post-grid -->
