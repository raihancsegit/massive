<?php
/**
 * This class handles all the frontend assets.
 *
 * @package Massive
 * @author ThemeBucket <themebucket@gmail.com>
 */

class Massive_Assets {

    public function __construct() {
        add_action( 'wp_enqueue_scripts', array($this, 'enqueue_styles') );
        add_action( 'wp_enqueue_scripts', array($this, 'enqueue_scripts') );
        add_action( 'wp_enqueue_scripts', array($this, 'localize_scripts') );
        add_action( 'wp_head', array($this, 'enqueue_ie_only') );
    }

    public function enqueue_styles() {
        /** Deregister Old Vendors */
        wp_deregister_style( 'font-awesome' );
        wp_deregister_style( 'fontawesome' );

        /** Vendor styles */
        wp_enqueue_style( 'bootstrap', MASSIVE_CSS_URI . 'bootstrap.min.css', array(), MASSIVE_VERSION );
        wp_enqueue_style( 'font-awesome', MASSIVE_CSS_URI . 'font-awesome.min.css', array(), MASSIVE_VERSION );
        wp_enqueue_style( 'linea-icon', MASSIVE_CSS_URI . 'linea-icon.css', array(), MASSIVE_VERSION );
        wp_enqueue_style( 'animate', MASSIVE_CSS_URI . 'animate.min.css', array(), MASSIVE_VERSION );
        wp_enqueue_style( 'elastic', MASSIVE_CSS_URI . 'elastic.css', array(), MASSIVE_VERSION );
        wp_enqueue_style( 'magnific-popup', MASSIVE_CSS_URI . 'magnific-popup.css', array(), MASSIVE_VERSION );
        wp_enqueue_style( 'owl.carousel', MASSIVE_CSS_URI . 'owl.carousel.css', array(), MASSIVE_VERSION );
        wp_enqueue_style( 'owl.theme', MASSIVE_CSS_URI . 'owl.theme.css', array(), MASSIVE_VERSION );

        /** Massive styles */
        wp_enqueue_style( 'massive-shortcodes', MASSIVE_CSS_URI . 'shortcodes.min.css', array(), MASSIVE_VERSION );
        wp_enqueue_style( 'massive-style', MASSIVE_CSS_URI . 'style.css', array(), MASSIVE_VERSION );
        wp_enqueue_style( 'massive-woocommerce', MASSIVE_CSS_URI . 'woocommerce.css', array(), MASSIVE_VERSION );
        wp_enqueue_style( 'massive-style-responsive', MASSIVE_CSS_URI . 'style-responsive.css', array(), MASSIVE_VERSION );

        if ( ! cs_get_option('custom_theme_color') || cs_get_option('theme_color') === '#d6b161' ) {
            wp_enqueue_style( 'massive-default-theme', MASSIVE_CSS_URI . 'default-theme.css', array(), MASSIVE_VERSION );
        }
    }

    public function enqueue_scripts() {
        /** Vendor scripts */
        wp_enqueue_script( 'modernizr', MASSIVE_JS_URI . 'modernizr.js', array(), MASSIVE_VERSION );
        wp_enqueue_script( 'bootstrap', MASSIVE_JS_URI . 'bootstrap.min.js', array('jquery'), MASSIVE_VERSION, true );
        wp_enqueue_script( 'sticky', MASSIVE_JS_URI . 'jquery.sticky.min.js', array('jquery'), MASSIVE_VERSION, true );
        wp_enqueue_script( 'fitvids', MASSIVE_JS_URI . 'jquery.fitvids.js', array('jquery'), MASSIVE_VERSION, true );
        wp_enqueue_script( 'matchHeight', MASSIVE_JS_URI . 'jquery.matchHeight-min.js', array('jquery'), MASSIVE_VERSION, true );
        wp_enqueue_script( 'imagesloaded', MASSIVE_JS_URI . 'imagesloaded.js', array(), MASSIVE_VERSION, true );
        wp_enqueue_script( 'countTo', MASSIVE_JS_URI . 'jquery.countTo.js', array('jquery'), MASSIVE_VERSION, true );
        wp_enqueue_script( 'countdown', MASSIVE_JS_URI . 'jquery.countdown.js', array('jquery'), MASSIVE_VERSION, true );
        wp_enqueue_script( 'easing', MASSIVE_JS_URI . 'jquery.easing.1.3.js', array('jquery'), MASSIVE_VERSION, true );
        wp_enqueue_script( 'easypiechart', MASSIVE_JS_URI . 'jquery.easypiechart.min.js', array('jquery'), MASSIVE_VERSION, true );
        wp_enqueue_script( 'eislideshow', MASSIVE_JS_URI . 'jquery.eislideshow.js', array('jquery'), MASSIVE_VERSION, true );
        wp_enqueue_script( 'flexslider', MASSIVE_JS_URI . 'jquery.flexslider-min.js', array('jquery'), MASSIVE_VERSION, true );
        wp_enqueue_script( 'isotope', MASSIVE_JS_URI . 'jquery.isotope.js', array('jquery'), MASSIVE_VERSION, true );
        wp_enqueue_script( 'magnific-popup', MASSIVE_JS_URI . 'jquery.magnific-popup.min.js', array('jquery'), MASSIVE_VERSION, true );
        wp_enqueue_script( 'nav', MASSIVE_JS_URI . 'jquery.nav.js', array('jquery'), MASSIVE_VERSION, true );
        wp_enqueue_script( 'menuzord', MASSIVE_JS_URI . 'menuzord.js', array('jquery'), MASSIVE_VERSION, true );
        wp_enqueue_script( 'owl.carousel', MASSIVE_JS_URI . 'owl.carousel.min.js', array('jquery'), MASSIVE_VERSION, true );
        wp_enqueue_script( 'touchspin', MASSIVE_JS_URI . 'touchspin.js', array(), MASSIVE_VERSION, true );
        wp_enqueue_script( 'typist', MASSIVE_JS_URI . 'typist.js', array(), MASSIVE_VERSION, true );
        wp_enqueue_script( 'visible', MASSIVE_JS_URI . 'visible.js', array(), MASSIVE_VERSION, true );
        wp_enqueue_script( 'wow', MASSIVE_JS_URI . 'wow.min.js', array(), MASSIVE_VERSION, true );
        wp_enqueue_script( 'jssocials', MASSIVE_JS_URI . 'jssocials.min.js', array(), MASSIVE_VERSION, true );
        wp_enqueue_script( 'ajaxchimp', MASSIVE_JS_URI . 'mailchimp/jquery.ajaxchimp.min.js', array('jquery'), MASSIVE_VERSION, true );

        /** Massive scripts */
        wp_enqueue_script( 'massive-skip-link-focus-fix', MASSIVE_JS_URI . 'skip-link-focus-fix.js', array(), MASSIVE_VERSION, true );
        wp_enqueue_script( 'massive-scripts', MASSIVE_JS_URI . 'scripts.js', array('jquery'), MASSIVE_VERSION, true );

        /** Default scripts */
        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
            wp_enqueue_script( 'comment-reply' );
        }
    }

    public function localize_scripts() {
        $social_media_shares = cs_get_option( 'post_social_shares' );
        $medias = massive_get_default_param( $social_media_shares, 'enabled', array() );

        wp_localize_script( 'massive-scripts', 'MassiveJS',
            array(
                'activeSocialShares' => array_keys( $medias ),
                'hasBackToTop' => (bool) cs_get_option( 'display_backtotop' ),
                'hasPreloader' => (bool) cs_get_option( 'display_preloader' ),
                )
            );
    }

    public function enqueue_ie_only() {
        ?>
        <!--[if lt IE 9]>
        <script src="<?php echo esc_url( MASSIVE_JS_URI . 'html5shiv.js' ); ?>"></script>
        <script src="<?php echo esc_url( MASSIVE_JS_URI . 'respond.min.js' ); ?>"></script>
        <![endif]-->
        <?php
    }

}

new Massive_Assets;
