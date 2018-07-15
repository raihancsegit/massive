<?php
/**
 * The template for displaying 404 error.
 *
 * 
 * @package Massive
 */

get_header();

$message = cs_get_option('massive_404_message');
$image = wp_get_attachment_image_src( cs_get_option( 'massive_404_image' ), 'full' );
$image = ( isset( $image[0] ) ? $image[0] : false );
?>

<section class="body-content">
    <div class="page-content">
        <div class="container">
            <div class="row page-content page-content-<?php the_ID(); ?>">
                <div class="col-md-5 text-center">
                    <div class="error-avatar">
                        <?php if ( $image ) { ?>
                        <img src="<?php echo esc_url( $image ); ?>" alt="<?php esc_attr_e( 'Not Found!', 'massive' ); ?>">
                        <?php } ?>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="error-info">
                        <div class="error404"><?php esc_html_e( '404', 'massive' ); ?></div>
                        <div class="error-txt"><?php echo esc_html( $message ); ?></div>
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-medium btn-theme-color "><?php esc_html_e( 'Take Me Home', 'massive' ); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
