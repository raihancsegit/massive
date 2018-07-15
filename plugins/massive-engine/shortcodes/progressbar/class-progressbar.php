<?php
/**
 * Massive progressbar shortcode
 *
 * @package Massive Engine
 * @author ThemeBucket <themebucket@gmail.com>
 */

class Massive_Progressbar extends Massive_Shortcode {

    /**
     * Set shortcode directory
     * @return string Directory path
     */
    protected function set_dir() {
        return __DIR__;
    }

    /**
     * Map shortcode dynamic styles
     * @param  array $params
     * @return string
     */
    public function map_dynamic_styles( $params ) {
        $tree      = array();

        $type      = massive_get_default_param( $params, 'type', 'tooltip' );
        $width     = massive_get_default_param( $params, 'percentage', '80' );
        $height    = massive_check_css_unit( massive_get_default_param( $params, 'height', '30px' ) );
        $color     = massive_get_default_param( $params, 'color', '#FFF' );
        $bar_color = massive_get_default_param( $params, 'bar_color', 'black' );
        $c_color   = massive_get_default_param( $params, 'custom_color', '#77897c');
        $bg_color  = massive_get_default_param( $params, 'bg_color' , '#EAE8E8' );

        $uid            = $this->get_uid( $params );
        $pb_item        = $uid . ' .progress-bar';
        $pb_text        = $uid . ' .progress-bar div';
        $pb_status_text = $uid . ' .progress-bar span';

        $tree[$uid] = array(
            'background-color' => $bg_color . ' !important',
            'height'           => $height . ' !important',
        );

        $tree[$pb_text] = array(
            'color'            => $color . ' !important',
        );

        $tree[$pb_item] = array(
            'color'            => $color . ' !important',
            'line-height'      => $height . ' !important',
            'height'           => $height . ' !important',
        );

        if ( 'c_color' == $bar_color ) {
            $tree[$pb_item] = array(
                'color'            => $color . ' !important',
                'line-height'      => $height . ' !important',
                'height'           => $height . ' !important',
                'background-color' => $c_color . ' !important',
            );
        }

        return $tree;
    }

    /**
     * Map this shortcode with visual composer
     * @return array
     */
    protected function map() {
        return array(
            'name'            => esc_html__( 'Progressbar', 'massive-engine' ),
            'base'            => $this->get_tag(),
            "content_element" => true,
            "as_child"        => array('only' => 'massive_progressbars' ),
            'icon'            => $this->get_icon('progress'),
            'params'          => array(
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Progressbar Style', 'massive-engine' ),
                    'param_name'  => 'type',
                    'value'       => esc_html__('Tooltip' , 'massive-engine' ),
                    'description' => esc_html__( 'Chose progressbar style', 'massive-engine' ),
                    'admin_label' => true,
                    'value'       => array(
                            __( 'Tooltip', 'massive-engine' ) => 'tooltip',
                            __( 'Inline' , 'massive-engine' ) => 'inline',
                        ),
                    ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Progressbar Text', 'massive-engine' ),
                    'param_name'  => 'text',
                    'admin_label' => true,
                    'value'       => esc_html__( ' HTML / CSS / JQUERY ', 'massive-engine'),
                    'description' => esc_html__( 'Write progressbar text here', 'massive-engine' ),
                    ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Progress Percentage', 'massive-engine' ),
                    'param_name'  => 'percentage',
                    'value'       => 80,
                    'description' => esc_html__( 'Write progress percentage here', 'massive-engine' ),
                    ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__( 'Progressbar Text Color', 'massive-engine' ),
                    'param_name'  => 'color',
                    'description' => esc_html__( 'Pick progressbar TEXT color', 'massive-engine' ),
                    'value'       => '#333',
                    ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Progressbar Color', 'massive-engine' ),
                    'param_name'  => 'bar_color',
                    'description' => esc_html__( 'Pick progressbar color', 'massive-engine' ),
                    'value'       => array(
                            esc_html__( 'Black' , 'massive-engine' ) => 'black',
                            esc_html__( 'White' , 'massive-engine' ) => 'white',
                            esc_html__( 'Theme' , 'massive-engine' ) => 'theme_color',
                            esc_html__( 'Custom', 'massive-engine' ) => 'c_color'
                        ),
                    ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__( 'Custom Bar Color', 'massive-engine' ),
                    'description' => esc_html__( 'Pick custom progressbar color', 'massive-engine' ),
                    'param_name'  => 'custom_color',
                    'value'       => '#222',
                    'dependency'  => array(
                        'element' => 'bar_color',
                        'value'   => 'c_color',
                        ),
                    ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__( 'Progressbar Background Color', 'massive-engine' ),
                    'param_name'  => 'bg_color',
                    'description' => esc_html__( 'Pick progressbar BACKGROUND color', 'massive-engine' ),
                    'value'       => '#EAE8E8',
                    ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Progressbar Height', 'massive-engine' ),
                    'param_name'  => 'height',
                    'description' => esc_html__( 'Set progress bar height', 'massive-engine' ),
                    ),
                )
            );
    }

    /**
     * render this shortcode
     * @param  array $atts
     * @param  string $content
     * @return string
     */
    public function render( $atts, $content = null ) {
        $defaults = array(
            'type'         => 'tooltip',
            'text'         => esc_html__( 'HTML / CSS / JQUERY', 'massive-engine' ),
            'percentage'   => '80',
            'color'        => '#333',
            'bar_color'    => 'black',
            'custom_color' => '#222',
            'bg_color'     => '#EAE8E8',
            'height'       => '30px',
            'uid'          => '',
            );

        $uid         = $this->get_uid( $atts );
        $atts        = shortcode_atts( $defaults, $atts );
        $atts['uid'] = $uid;
        $type        = trim( strtolower( $atts['type'] ) );
        $types       = array('tooltip','inline');
        $classes     = array();

        $view = $this->get_view( $type );

        ob_start();
        if ( in_array( $type, $types ) && file_exists( $view ) ) {
            include( $view );
        }
        return ob_get_clean();
    }

}

new Massive_Progressbar;

if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_Massive_Progressbar extends WPBakeryShortCode {
    }
}
