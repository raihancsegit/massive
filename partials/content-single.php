<?php
$post_meta            = cs_get_option( 'show_post_meta' );
$meta_author          = cs_get_option( 'show_meta_post_author' );
$meta_category        = cs_get_option( 'show_meta_post_category' );
$meta_comments_no     = cs_get_option( 'show_meta_post_comments_no' );
$meta_date            = cs_get_option( 'show_meta_post_time' );
$meta_tags            = cs_get_option( 'show_tag_on_details' );
$related_posts        = cs_get_option( 'show_related_posts' );
$related_posts_number = cs_get_option( 'no_of_related_posts' );
$related_posts_view   = cs_get_option( 'related_posts_view' );
$social_share         = cs_get_option( 'share_single_post' );
$prev_link            = massive_get_previous_post_link();
$next_link            = massive_get_next_post_link();
$prev_title           = massive_get_previous_post_title();
$next_title           = massive_get_next_post_title();
$categories           = get_the_category();
?>

<div class="full-width">
    <?php echo get_template_part( 'partials/blog/common/content', get_post_format() ); ?>
</div>

<h4 class="text-uppercase">
    <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to: %s', 'massive' ), get_the_title() ); ?>"><?php the_title(); ?></a>
</h4>

<?php if ( true === $post_meta ) { ?>
    <ul class="post-meta">

        <?php if ( true === $meta_author ) { ?>
            <li><i class="fa fa-user"></i><?php massive_author_link(); ?></li>
        <?php } ?>

        <?php if( ( true === $meta_category ) && ! empty( $categories ) ){ ?>
            <li><i class="fa fa-folder-open"></i><?php massive_get_post_categories( $categories, ', ' ); ?></li>
        <?php } ?>

        <?php if( true === $meta_comments_no ){ ?>
            <li><i class="fa fa-comments"></i><?php massive_comments_link(); ?></li>
        <?php } ?>

    </ul>
<?php } ?>

<div class="massive-post-content">
    <?php the_content(); ?>
</div>

<?php if ( ( true === $meta_tags ) && ( ! empty( $the_tags ) ) ) { ?>
    <div class="inline-block">
        <div class="widget-tags">
            <h6 class="text-uppercase"><?php esc_html_e( 'Tags', 'massive' ); ?></h6>
            <ul class="post-tags"><?php the_tags( '<li>', '', '</li>' ); ?></ul>
        </div>
    </div>
<?php } ?>

<?php if ( ( true === $social_share ) ) { ?>
    <div class="clearfix inline-block m-top-50 m-bot-50">
        <h6 class="text-uppercase"><?php esc_html_e( 'Share This Post', 'massive' ); ?></h6>
        <div id="share" class="widget-social-link circle"></div>
    </div>
<?php } ?>

<div class="pagination-row">
    <div class="pagination-post">
        <div class="prev-post">
            <a href="<?php echo esc_url( $prev_link ); ?>" title="<?php printf( esc_attr__( 'Previous post: %s', 'massive' ), $prev_title ); ?>">
                <div class="arrow"><i class="fa fa-angle-double-left"></i></div>
                <div class="pagination-txt"><span><?php echo esc_html( $prev_title ); ?></span></div>
            </a>
        </div>
        <div class="post-list-link">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php esc_attr_e( 'Go back to home', 'massive' ); ?>">
                <span class="sr-only"><?php esc_html_e( 'Go back to home', 'massive' ); ?></span>
                <i class="fa fa-home"></i>
            </a>
        </div>
        <div class="next-post">
            <a href="<?php echo esc_url( $next_link ); ?>" title="<?php printf( esc_attr__( 'Next post: %s', 'massive' ), $next_title ); ?>">
                <div class="arrow"><i class="fa fa-angle-double-right"></i></div>
                <div class="pagination-txt"><span><?php echo esc_html( $next_title ); ?></span></div>
            </a>
        </div>
    </div>
</div>

<?php massive_get_related_posts( $related_posts, $related_posts_number, $related_posts_view  ); ?>

