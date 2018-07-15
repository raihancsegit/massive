<?php
$date_format = cs_get_option( 'date_format' );
$args = array (
    'post_type'      => 'post',
    'post_status'    => $atts['status'],
    'posts_per_page' => $atts['number'],
    'order'          => $atts['order'],
    'orderby'        => $atts['orderby'],
    'category_name'  => $atts['categories'],
);

?>
<div class="post-grid post">

<?php
    $query = new WP_Query( $args );
    $i = 0;
    if ( $query->have_posts() ) :
        while ( $query->have_posts() ) : $query->the_post();
            $categories = get_the_category();
            $i++;
        ?>
        <div class="col-md-4">
            <div class="post-single">
                <?php if ( $i % 2 == 0 ) : ?>
                    <div class="post-desk">
                        <div class="mid-align">
                            <div class="date dark-text"><?php the_time( $date_format ); ?></div>
                            <h4 class="text-uppercase"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                            <ul class="post-cat">
                                <li><?php massive_get_post_categories( $categories, ' &nbsp;' ); ?></li>
                            </ul>
                        </div>
                    </div>
                    <div class="post-img top">
                        <?php include ( dirname( __FILE__ ) . '/content/content.php' ); ?>
                    </div>
                <?php else: ?>
                    <div class="post-img bottom">
                        <?php include ( dirname( __FILE__ ) . '/content/content.php' ); ?>
                    </div>
                    <div class="post-desk">
                        <div class="mid-align">
                            <div class="date dark-text">
                                <?php the_time( $date_format ); ?>
                            </div>
                            <h4 class="text-uppercase"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                            <ul class="post-cat">
                                <li><?php massive_get_post_categories( $categories, ' &nbsp;' ); ?></li>
                            </ul>
                        </div>
                    </div>
                <?php endif; ?>
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
