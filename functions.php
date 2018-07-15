<?php
/**
 * Massive functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Massive
 */

/*******************************************************************
 * Constants
 *******************************************************************/

/** Massive theme settings field name */
defined( 'CS_OPTION' ) || define( 'CS_OPTION', '_massive_options' );

/** Massive version */
define( 'MASSIVE_VERSION', '2.3.1' );


/**
 * Directory paths
 *******************************************************************/

/** Massive root directory path */
define( 'MASSIVE_ROOT', trailingslashit( get_template_directory() ) );

/** Massive includes directory path */
define( 'MASSIVE_INCLUDES_DIR', trailingslashit( MASSIVE_ROOT . 'includes' ) );

/** Massive vendors directory path */
define( 'MASSIVE_VENDORS_DIR', trailingslashit( MASSIVE_ROOT . 'vendors' ) );

/** Massive admin directory path */
define( 'MASSIVE_ADMIN_DIR', trailingslashit( MASSIVE_ROOT . 'admin' ) );

/**
 * Directory uri
 *******************************************************************/

/** Massive root uri */
define( 'MASSIVE_URI', trailingslashit( get_template_directory_uri() ) );

/** Massive assets uri */
define( 'MASSIVE_ASSETS_URI', trailingslashit( MASSIVE_URI . 'assets' ) );

/** Massive js uri */
define( 'MASSIVE_JS_URI', trailingslashit( MASSIVE_ASSETS_URI . 'js' ) );

/** Massive css uri */
define( 'MASSIVE_CSS_URI', trailingslashit( MASSIVE_ASSETS_URI . 'css' ) );



/*******************************************************************
 * Core Helpers
 *******************************************************************/

/** Filesystem Functions */
require MASSIVE_INCLUDES_DIR . 'functions.filesystem.php';



/*******************************************************************
 * Vendors
 *******************************************************************/

/** Codestar Framework */
require_once MASSIVE_VENDORS_DIR . 'cs-framework/cs-framework.php';

/** Breadcrumb Trail */
require_once MASSIVE_VENDORS_DIR . 'breadcrumb-trail.php';



/*******************************************************************
 * Helpers
 *******************************************************************/

/** i18n Functions */
require MASSIVE_INCLUDES_DIR . 'functions.i18n.php';

/** Helper Functions */
require MASSIVE_INCLUDES_DIR . 'functions.helper.php';

/** Dynamic CSS Generator Functions */
require MASSIVE_INCLUDES_DIR . 'functions.css-generator.php';

/** Font Stack Generator Functions */
require MASSIVE_INCLUDES_DIR . 'functions.font.php';

/** Template Functions */
require MASSIVE_INCLUDES_DIR . 'functions.grid.php';
require MASSIVE_INCLUDES_DIR . 'functions.template.php';
require MASSIVE_INCLUDES_DIR . 'functions.portfolio.php';

/** WooCommerce Functions */
require MASSIVE_INCLUDES_DIR . 'functions.woocommerce.php';

/** WooCommerce Filter Functions */
require MASSIVE_INCLUDES_DIR . 'functions.woocommerce-filter.php';

/** Filter Functions */
require MASSIVE_INCLUDES_DIR . 'functions.filter.php';

/** Animate CSS Animation */
require MASSIVE_INCLUDES_DIR . 'animations.php';

/** Font Awesome Icons */
require MASSIVE_INCLUDES_DIR . 'icons.php';



/*******************************************************************
 * Theme Setup
 *******************************************************************/

/** Initial Setup */
require MASSIVE_INCLUDES_DIR . 'class.theme-setup.php';

/** Fonts Enqueue */
require MASSIVE_INCLUDES_DIR . 'class.fonts.php';

/** Load Frontend Assets */
require MASSIVE_INCLUDES_DIR . 'class.assets.php';

/** Sidebars Register */
require MASSIVE_INCLUDES_DIR . 'class.sidebars.php';

/** Setup Theme Options */
require MASSIVE_INCLUDES_DIR . 'class.theme-options.php';

/** Setup Required Plugins */
require MASSIVE_INCLUDES_DIR . 'class.plugins.php';



/*******************************************************************
 * Metabox Register
 *******************************************************************/

/** Page Metabox */
require MASSIVE_INCLUDES_DIR . 'metabox/page/main.php';

/** Post Metabox */
require MASSIVE_INCLUDES_DIR . 'metabox/post/audio.php';
require MASSIVE_INCLUDES_DIR . 'metabox/post/gallery.php';
require MASSIVE_INCLUDES_DIR . 'metabox/post/video.php';

/** Banner Metabox */
require MASSIVE_INCLUDES_DIR . 'metabox/banner/type.php';
require MASSIVE_INCLUDES_DIR . 'metabox/banner/static.php';
require MASSIVE_INCLUDES_DIR . 'metabox/banner/elastic.php';
require MASSIVE_INCLUDES_DIR . 'metabox/banner/bs.php';
require MASSIVE_INCLUDES_DIR . 'metabox/banner/owl.php';
require MASSIVE_INCLUDES_DIR . 'metabox/banner/flex.php';

/** Product Metabox */
require MASSIVE_INCLUDES_DIR . 'metabox/product/metabox.php';

/** Portfolio Metabox */
require MASSIVE_INCLUDES_DIR . 'metabox/portfolio/metabox.php';



/*******************************************************************
 * Shortcode Map
 *******************************************************************/

require MASSIVE_INCLUDES_DIR . 'shortcode-map.php';



/*******************************************************************
 * Walkers
 *******************************************************************/

/** Comment Walker */
require MASSIVE_INCLUDES_DIR . 'class.walker-comment.php';

/** Megamenu */
require MASSIVE_INCLUDES_DIR . 'class.megamenu.php';



/*******************************************************************
 * Customs
 *******************************************************************/

require MASSIVE_INCLUDES_DIR . 'class.attachment-meta.php';

/** Customizer */
require MASSIVE_INCLUDES_DIR . 'customizer.php';

/** Jetpack Compatibility */
require MASSIVE_INCLUDES_DIR . 'jetpack.php';



/*******************************************************************
 * Dynamic CSS
 ******************************************************************/

require MASSIVE_INCLUDES_DIR . 'class.dynamic-design.php';



/*******************************************************************
 * Widgets
 *******************************************************************/

/** Image Uploader */
require MASSIVE_INCLUDES_DIR . 'class.image-uploader.php';

/** Gallery Uploader */
require MASSIVE_INCLUDES_DIR . 'class.gallery-uploader.php';



/*******************************************************************
 * Massive Admin
 *******************************************************************/

/** Admin Assets Enqueue */
require MASSIVE_INCLUDES_DIR . 'class.admin-assets.php';

/** Admin Board */
require MASSIVE_ADMIN_DIR . 'class.dashboard.php';



/*******************************************************************
 * Massive Demo
 *******************************************************************/

require MASSIVE_INCLUDES_DIR . 'class.demo-controller.php';
