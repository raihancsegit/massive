<?php
$banner_position = $nav_menu = '';

if ( is_page() ) {
    $metadata = get_post_meta( get_queried_object_id(), '_massive_page_options', true );
    $banner_position = massive_get_meta( $metadata, 'banner_position' );
}

if ( is_page() && massive_get_meta( $metadata, 'navbar_override' ) ) {
    $logo_default = massive_get_meta( $metadata, 'logo_default' );
    $logo_retina = massive_get_meta( $metadata, 'logo_retina' );

    $header_layout = massive_get_meta( $metadata, 'navbar_layout' );
    $navbar_layout_width = massive_get_meta( $metadata, 'navbar_layout_width' );
    $navbar_theme = massive_get_meta( $metadata, 'navbar_theme' );
    $navbar_theme_compact = massive_get_meta( $metadata, 'navbar_theme_compact' );
    $navbar_link_color = massive_get_meta( $metadata, 'navbar_link_color' );
    $nav_link_style = massive_get_meta( $metadata, 'nav_link_style' );
    $nav_menu = massive_get_meta( $metadata, 'nav_menu' );
    $enable_onepage = massive_get_meta( $metadata, 'enable_onepage' );

    $compact_mode = massive_get_meta( $metadata, 'navbar_is_compact', false );
} else {
    $logo_default = cs_get_option( 'logo_default' );
    $logo_retina = cs_get_option( 'logo_retina' );

    $header_layout = cs_get_option( 'navbar_layout' );
    $navbar_layout_width = cs_get_option( 'navbar_layout_width' );
    $navbar_theme = cs_get_option( 'navbar_theme' );
    $navbar_theme_compact = cs_get_option( 'navbar_theme_compact' );
    $navbar_link_color = cs_get_option( 'navbar_link_color' );
    $nav_link_style = cs_get_option( 'nav_link_style' );
    $enable_onepage = false;

    $compact_mode = cs_get_option( 'navbar_is_compact', false);
}

$header_classes = array('bucket-header');
$container = 'container';
$navbar_classes = array('bucket-navbar');
$center_logo_wrapper_class = array('brand-logo-center-wrapper');
$nav_classes = array();


// Overflown header
if ( 'floating' === $header_layout ) {
    $header_classes[] = 'bucket-header-overflow';
}

if ( ( 'center' === $header_layout || 'default' === $header_layout ) && ( 'semi' === $navbar_theme || 'trans' === $navbar_theme ) ) {
    $header_classes[] = 'bucket-header-overflow';
}

// Header layout
switch ( $header_layout ) {
    case 'center':
        $navbar_classes[] = 'bucket-navbar-center';
        break;
    case 'floating':
        $navbar_classes[] = 'bucket-navbar-float';
        $nav_classes[] = 'menuzord-right';
        break;
    case 'sidebar':
        $navbar_classes[] = 'bucket-navbar-left';
        break;
    case 'default':
    default:
        $navbar_classes[] = 'bucket-navbar-top';
        $nav_classes[] = 'menuzord-right';
        break;
}

if ( 'sidebar' !== $header_layout ) {
    $navbar_classes[] = 'bucket-navbar-sticky';

    if ( $compact_mode ) {
        $header_classes[] = 'has-bucket-navbar-compact';
        $navbar_classes[] = 'bucket-navbar-compact';
    } else {
        $header_classes[] = 'has-bucket-navbar-expand';
        $navbar_classes[] = 'bucket-navbar-expand';
    }

    switch ( $navbar_theme ) {
        case 'dark':
            $navbar_classes[] = 'bucket-navbar-inverse';
            $center_logo_wrapper_class[] = 'bucket-navbar-inverse';
            break;
        case 'semi':
            $navbar_classes[] = 'bucket-navbar-semi-transparent';
            $center_logo_wrapper_class[] = 'bucket-navbar-semi-transparent';
            break;
        case 'trans':
            $navbar_classes[] = 'bucket-navbar-transparent';
            $center_logo_wrapper_class[] = 'bucket-navbar-transparent';
            break;
        case 'light':
        default:
            $navbar_classes[] = 'bucket-navbar-default';
            $center_logo_wrapper_class[] = 'bucket-navbar-default';
            break;
    }

    if ( 'trans' === $navbar_theme ) {
        switch( $navbar_link_color ) {
            case 'dark':
                $navbar_classes[] = 'bucket-navbar-transparent-light';
                break;
            case 'light':
            default:
                $navbar_classes[] = 'bucket-navbar-transparent-dark';
                break;
        }
    }

    switch ( $nav_link_style ) {
        case 'fill':
            $nav_classes[] = 'bucket-nav-background';
            break;
        case 'border-around':
            $nav_classes[] = 'bucket-nav-outline';
            break;
        case 'border-bottom':
            $nav_classes[] = 'bucket-nav-underline';
            break;
        default:
            $nav_classes[] = 'bucket-nav-standard';
            break;
    }
}

if ( 'sidebar' === $header_layout ) {
    switch ( $navbar_theme_compact ) {
        case 'dark':
            $navbar_classes[] = 'bucket-navbar-inverse';
            break;
        case 'light':
        default:
            $navbar_classes[] = 'bucket-navbar-default';
            break;
    }
}

// Container class
if ( 'sidebar' !== $header_layout && 'full' === $navbar_layout_width ) {
    $container = 'container-fluid';
}

//Enable one page navigation
if ( $enable_onepage ) {
    $nav_classes[] = 'tb-onepage';
}
?>

<header id="header" role="banner" class="<?php echo esc_attr( implode( ' ', $header_classes ) ); ?>">

    <?php if ( 'center' === $header_layout ) { ?>
        <div class="<?php echo esc_attr( implode( ' ', $center_logo_wrapper_class ) ); ?>">
            <?php echo Massive_Template::get_logo( $logo_default, $logo_retina, 'brand-logo-center' ); ?>
        </div>
    <?php } ?>

    <nav class="<?php echo esc_attr( implode( ' ', $navbar_classes ) ); ?>">
        <div class="<?php echo esc_attr( $container ); ?>">
            <div id="massive-menu" class="menuzord">
                <?php
                echo Massive_Template::get_logo( $logo_default, $logo_retina );
                Massive_Template::menu( $nav_menu, $nav_classes );
                ?>
            </div>
        </div>
    </nav>
</header>
