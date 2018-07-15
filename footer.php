<?php
/**
 * The template for displaying site footer.
 *
 *
 * @package Massive
 */

$page_default_logo = $page_retina_logo = $global_default_logo = $global_retina_logo = $site_widget_area_columns = 0;
$override = false;

if ( is_page() ) {
    $pagemeta = get_post_meta(get_queried_object_id(), '_massive_page_options', true);
    $override = ( isset( $pagemeta['footer_override'] ) && $pagemeta['footer_override'] ) ?: false;
}

if ( is_page() && $override ) {
    $site_footer_layout = massive_get_meta( $pagemeta, 'footer_layout', 'layout-1' );
    $site_footer_theme = massive_get_meta( $pagemeta, 'footer_theme', 'dark' );
    $page_default_logo = massive_get_meta( $pagemeta, 'footer_logo_default' );
    $page_retina_logo = massive_get_meta( $pagemeta, 'footer_logo_retina' );
    $site_social_icons_theme = massive_get_meta( $pagemeta, 'footer_social_icons_theme', 'gray' );
    $site_widget_area_columns = massive_get_meta( $pagemeta, 'footer_widget_area_columns', 4 );
} else {
    $site_footer_layout = cs_get_option( 'footer_layout', 'layout-1' );
    $site_footer_theme = cs_get_option( 'footer_theme', 'dark' );
    $global_default_logo = cs_get_option( 'footer_logo_default' );
    $global_retina_logo = cs_get_option( 'footer_logo_retina' );
    $site_social_icons_theme = cs_get_option( 'footer_social_icons_theme', 'gray' );
    $site_widget_area_columns = cs_get_option( 'footer_widget_area_columns', 4 );
}

$default_logo_url = wp_get_attachment_image_src( ( $page_default_logo ? $page_default_logo : $global_default_logo ) , 'full' );
$retina_logo_url = wp_get_attachment_image_src( ( $page_retina_logo ? $page_retina_logo : $global_retina_logo ) , 'full' );

$default_logo_url = isset( $default_logo_url[0] ) ? $default_logo_url[0] : 0;
$retina_logo_url = isset( $retina_logo_url[0] ) ? $retina_logo_url[0] : 0;

$has_site_copyright = cs_get_option( 'display_footer_copyright' );
$has_site_social_icons = cs_get_option( 'display_footer_social_icons' );

set_query_var('massive_footer_data', compact(
    'site_widget_area_columns',
    'site_footer_theme',
    'default_logo_url',
    'retina_logo_url',
    'site_social_icons_theme',
    'site_widget_area_columns',
    'has_site_copyright',
    'has_site_social_icons'
) );
?>

    </div><!-- #content -->

    <?php
    if ( ! is_page() || ( is_page() && massive_get_meta( $pagemeta, 'footer_status' ) ) ) {
        get_template_part( "partials/footer/{$site_footer_layout}" );
    }
    ?>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
