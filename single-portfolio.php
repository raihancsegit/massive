<?php
/**
 * The template for displaying portfolio details.
 *
 * 
 * @package Massive
 */

get_header();

$metabox             = get_post_meta( get_the_id(), '_massive_mb_portfolio', 1 );
$client              = massive_get_meta( $metabox, 'mb_portfolio_meta_client' );
$author              = massive_get_meta( $metabox, 'mb_portfolio_meta_author' );
$skils               = massive_get_meta( $metabox, 'mb_portfolio_meta_skills' );
$completion_date     = massive_get_meta( $metabox, 'mb_portfolio_meta_date' );
$project_link        = massive_get_meta( $metabox, 'mb_portfolio_meta_link' );
$project_btn_label   = massive_get_meta( $metabox, 'mb_portfolio_meta_btn_label' );
$gallery             = massive_get_meta( $metabox, 'mb_portfolio_gallery' );
$related_portfolio   = cs_get_option( 'show_related_porfolio' );
$number_of_portfolio = cs_get_option( 'no_of_related_portfolio' );

while ( have_posts() ) { the_post(); ?>

    <!--body content start-->
    <section class="body-content">
        <div class="container">
            <div class="row ">
                <div class="col-md-12">
                    <div class="portfolio-nav-row">
                        <div class="portfolio-nav left">
                            <?php next_post_link( '%link', '<i class="fa fa-angle-left"></i> <span>'. esc_html__( 'Prev ', 'massive' ) .'</span>' ); ?>
                            <a title="<?php esc_attr_e( 'Home page', 'massive'); ?>" href="<?php echo esc_url( home_url( '/' ) ); ?>"><i class="fa fa-th-large"></i></a>
                            <?php previous_post_link( '%link', '<span>'. esc_html__( 'Next', 'massive' ) .'</span> <i class="fa fa-angle-right"></i>' ); ?>
                        </div>
                    </div>

                    <?php
                        if ( ! empty( $gallery ) ) {
                            $images  = explode( ',', $gallery );
                            ?>
                            <div class="full-width">
                                <div class="post-slider post-img text-center">
                                    <ul class="slides">
                                    <?php
                                        if ( ! empty( $images ) ) {
                                            foreach ( $images as $image ) {
                                                $attachment = wp_get_attachment_image_src( $image , 'large' );
                                                ?>
                                                <li>
                                                    <a href="javascript:void 0;">
                                                        <?php $alt = get_post_meta( $image, '_wp_attachment_image_alt', true ); ?>
                                                        <img src="<?php echo esc_url( $attachment[0] ); ?>" alt="<?php echo esc_attr( $alt ); ?>">
                                                    </a>
                                                </li>
                                    <?php } } ?>
                                    </ul>
                                </div>
                            </div>

                            <?php
                        } else {
                            the_post_thumbnail( 'full', array( 'class' => 'portfolio-single-image' ) );
                        } ?>
                </div>

                <div class="page-content">
                    <div class="col-md-8">
                        <div class="heading-title-side-border text-left">
                            <h4 class="text-uppercase"><?php the_title(); ?></h4>
                            <div class="title-border-container">
                                <div class="title-border"></div>
                            </div>
                        </div>
                        <div>
                            <?php the_content(); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <ul class="portfolio-meta m-bot-30">

                            <?php if ( ! empty ( $client ) ) { ?>
                                <li>
                                    <span><?php esc_html_e( 'Client ', 'massive' ); ?></span>
                                    <?php echo esc_html( $client ); ?>
                                </li>
                            <?php } ?>
                            <?php if ( ! empty ( $author ) ) { ?>
                                <li>
                                    <span><?php esc_html_e( 'Created by ', 'massive' ); ?></span>
                                    <?php echo esc_html( $author ); ?>
                                </li>
                            <?php } ?>
                            <?php if ( ! empty ( $completion_date ) ) { ?>
                                <li>
                                    <span><?php esc_html_e( 'Completed on ', 'massive' ); ?></span>
                                    <?php echo esc_html( $completion_date ); ?>
                                </li>
                            <?php } ?>
                            <?php if ( ! empty ( $skils ) ) { ?>
                                <li>
                                    <span><?php esc_html_e( 'Skills ', 'massive' ); ?></span>
                                    <?php echo esc_html( $skils ); ?>
                                </li>
                            <?php } ?>

                        </ul>

                        <?php if ( ! empty ( $project_link ) ) { ?>
                            <div>
                                <a href="<?php echo esc_url( $project_link ); ?>" class="btn btn-small btn-rounded btn-dark-solid"><?php echo ( $project_btn_label ? esc_html( $project_btn_label ) : esc_html__( 'Visit Website', 'massive' ) ) ; ?></a>
                            </div>
                        <?php } ?>

                    </div>
                </div>

            </div>
        </div> <!-- .container -->

        <hr/>

        <div class="page-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <?php massive_get_related_portfolio( $related_portfolio, $number_of_portfolio ); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--body content end-->

<?php
/**
 * End loop
 */
}

get_footer();
