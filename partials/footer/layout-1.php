<?php
$footer_data = get_query_var('massive_footer_data');
extract( $footer_data );

$secondary_footer_columns = '';

if ( $has_site_social_icons && $has_site_copyright ) {
    $secondary_footer_columns = 'col-md-6';
} elseif ( $has_site_social_icons || $has_site_copyright ) {
    $secondary_footer_columns = 'col-md-12 text-center';
}
?>

<footer id="footer" class="Site-footer Site-footer--layout-1 Site-footer--<?php echo esc_attr( $site_footer_theme ); ?>" role="contentinfo">
    <?php if ( 'no' !== $site_widget_area_columns  ) { ?>
        <div class="Site-footer__primary">
            <div class="Footer-widget-area container">
                <div class="row">
                <?php
                    for ( $i=1; $i<=$site_widget_area_columns; $i++ ) {
                        ?>
                        <div class="col-md-<?php echo esc_attr( 12/$site_widget_area_columns ); ?>">
                            <?php dynamic_sidebar( "footer-{$i}" ); ?>
                        </div>
                        <?php
                    }
                ?>
                </div>
            </div>
        </div>
    <?php } ?>

    <?php if ( $secondary_footer_columns ) { ?>
        <div class="Site-footer__secondary">
            <div class="container">
                <div class="row">
                    <?php if ( $has_site_copyright ) { ?>
                        <div class="<?php echo esc_attr( $secondary_footer_columns ); ?>">
                            <?php echo wp_kses_post( do_shortcode( cs_get_option( 'footer_copyright_content' ) ) ); ?>
                        </div>
                    <?php } ?>
                    <?php if ( $has_site_social_icons ) { ?>
                        <div class="<?php echo esc_attr( $secondary_footer_columns ); ?>">
                            <?php massive_social_media( $site_social_icons_theme ); ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    <?php } ?>
</footer>
