<?php
/**
 * Enqueue default google fonts as well as user selected fonts.
 *
 * @package Massive
 * @author ThemeBucket <themebucket@gmail.com>
 */

class Massive_Fonts {

    public function __construct() {
        add_action( 'wp_enqueue_scripts', array($this, 'enqueue') );
    }

    public function enqueue() {
        wp_enqueue_style( 'massive-default-font', $this->get_default_fonts(), array(), MASSIVE_VERSION );

        if ( $user_font = $this->get_user_fonts() ) {
            wp_enqueue_style( 'massive-user-font', $user_font, array(), MASSIVE_VERSION );
        }
    }

    protected function get_default_fonts() {
        $font_url = '';

        /* Translators: If there are characters in your language that are not
        * supported by Arizonia, translate this to 'off'. Do not translate
        * into your own language.
        */
        $arizonia = _x( 'on', 'Arizonia font: on or off', 'massive' );

        /* Translators: If there are characters in your language that are not
        * supported by Source Sans Pro, translate this to 'off'. Do not translate
        * into your own language.
        */
        $source_sans_pro = _x( 'on', 'Source Sans Pro font: on or off', 'massive' );

        if ( 'off' !== $arizonia || 'off' !== $source_sans_pro ) {
            $font_families = array();

            if ( 'off' !== $arizonia ) {
                $font_families[] = 'Arizonia';
            }

            if ( 'off' !== $source_sans_pro ) {
                $font_families[] = 'Source Sans Pro:400,300,400italic,600';
            }

            $query_args = array(
                'family' => urlencode( implode( '|', $font_families ) ),
                'subset' => urlencode( 'latin,latin-ext' ),
            );

            $font_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
        }

        return esc_url_raw( $font_url );
    }

    protected function get_user_fonts() {
        $font_url = '';
        $google_font_stack = massive_get_google_font_stack();

        if ( cs_get_option( 'enable_typography' ) && ! empty( $google_font_stack ) ) {
            $font_url = add_query_arg( 'family', urlencode( $google_font_stack ), '//fonts.googleapis.com/css' );
        }

        return $font_url;
    }

}

new Massive_Fonts();
