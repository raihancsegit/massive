<?php
$footer_data = get_query_var('massive_footer_data');
extract( $footer_data );
?>

<footer id="footer" class="Site-footer Site-footer--layout-2 Site-footer--<?php echo esc_attr( $site_footer_theme ); ?>" role="contentinfo">
    <div class="Site-footer__primary">
        <div class="Footer-logo Footer-logo--normal">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="Footer-logo__link" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
                <img class="Footer--logo__img" data-retina="<?php echo esc_url( $retina_logo_url ); ?>" src="<?php echo esc_url( $default_logo_url ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
            </a>
        </div>
    </div>

    <?php if ( $has_site_social_icons || $has_site_copyright ) { ?>
        <div class="Site-footer__secondary">
            <div class="container text-center">
                <div class="row">
                    <?php if ( $has_site_social_icons ) { ?>
                        <div class="col-md-12">
                            <?php massive_social_media($site_social_icons_theme); ?>
                        </div>
                    <?php } ?>

                    <?php if ( $has_site_copyright ) { ?>
                        <div class="col-md-12">
                            <div class="copyright">
                                <?php echo wp_kses_post( do_shortcode( cs_get_option( 'footer_copyright_content' ) ) ); ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    <?php } ?>
</footer>
