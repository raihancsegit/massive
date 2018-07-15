<?php
/**
 * Massive animated text shortcode
 *
 * @package Massive Engine
 * @author ThemeBucket <themebucket@gmail.com>
 */

class Massive_Animated_Text extends Massive_Shortcode {

    /**
     * Set shortcode directory
     * @return string Directory path
     */
    protected function set_dir() {
        return __DIR__;
    }

    /**
     * Map this shortcode with visual composer
     * @return array
     */
    protected function map() {
        return array(
            'name'                    => esc_html__( 'Animated Text', 'massive-engine' ),
            'base'                    => $this->get_tag(),
            'category'                => esc_html__( 'Massive', 'massive-engine' ),
            'icon'                    => $this->get_icon('animated-text'),
            'show_settings_on_create' => true,
            'params'                  => array(
                array(
                    'type'       => 'textfield',
                    'heading'    => esc_html__( 'Before Animated Text', 'massive-engine' ),
                    'description' => esc_html__( 'Add text before animated text.', 'massive-engine' ),
                    'param_name' => 'before_text',
                    'value'      => '',
                    ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Animated Text', 'massive-engine' ),
                    'admin_label' => true,
                    'description' => esc_html__( 'Comma separated animated text.', 'massive-engine' ),
                    'param_name'  => 'animated_text',
                    'value'       => esc_html__( 'Animated,Text', 'massive-engine' )
                    ),
                array(
                    'type'       => 'textfield',
                    'heading'    => esc_html__( 'Default Text', 'massive-engine' ),
                    'param_name' => 'default_text',
                    'value'      => esc_html__( 'Massive', 'massive-engine' ),
                    ),
                array(
                    'type'       => 'textfield',
                    'heading'    => esc_html__( 'After Animated Text', 'massive-engine' ),
                    'description' => esc_html__( 'Add text after animated text.', 'massive-engine' ),
                    'param_name' => 'after_text',
                    'value'      => '',
                    ),
                array(
                    'type'       => 'dropdown',
                    'heading'    => esc_html__( 'Effect', 'massive-engine' ),
                    'param_name' => 'effect',
                    'value'      => array(
                        esc_html__( 'Blink', 'massive-engine' ) => 'blink',
                        esc_html__( 'Mark', 'massive-engine' )  => 'mark',
                        ),
                    ),
                array(
                    'type'       => 'textfield',
                    'heading'    => esc_html__( 'Font Size', 'massive-engine' ),
                    'param_name' => 'font_size',
                    'value'      => '15px'
                    ),
                array(
                    'type'       => 'dropdown',
                    'heading'    => esc_html__( 'Font Family', 'massive-engine' ),
                    'param_name' => 'font_family',
                    'value'      => array(
                        esc_html__( 'Source Sans Pro', 'massive-engine' ),
                        esc_html__( 'Arizonia', 'massive-engine' )
                        )
                    ),
                )
            );
    }

    /**
     * Render this shortcode
     * @param  array $atts
     * @param  string $content
     * @return string
     */
    public function render( $atts, $content = null ) {
        $defaults = array(
            'before_text' => '',
            'after_text' => '',
            'animated_text' => esc_html__( 'Animated,Text', 'massive-engine' ),
            'default_text'  => esc_html__( 'Massive', 'massive-engine' ),
            'effect'        => 'blink',
            'font_size'     => '15px',
            'font_family'   => 'Source Sans Pro',
            );

        $atts        = shortcode_atts( $defaults, $atts );
        $uid         = $this->get_uid( $atts ); //this line must be here after $defaults, before calling shortcode_atts
        $effect      = massive_sanitize_param( $atts['effect'] );
        $classes     = array( 'typist-element' );

        if ( 'mark' == $effect ) {
            $classes[] = 'typist-mark';
        } else {
            $classes[] = 'typist-blink';
        }

        $data_attr = array(
            'typist' => $atts['animated_text'],
            );

        $view = $this->get_view('main');

        ob_start();
        if ( file_exists( $view ) ) {
            include( $view );
        }
        return ob_get_clean();
    }

}

new Massive_Animated_Text;
