<?php
/**
 * Massive tabs container shortcode
 *
 * @package Massive Engine
 * @author ThemeBucket <themebucket@gmail.com>
 */

class Massive_Tabs_Container extends Massive_Shortcode {

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
        $tree                = array();

        $type                = massive_get_default_param( $params, 'type', 'one' );
        $customize           = massive_get_default_param( $params, 'customize', 'false' );
        $title_color         = massive_get_default_param( $params, 'title_color' );
        $title_actv_color    = massive_get_default_param( $params, 'title_actv_color' );
        $title_bg_color      = massive_get_default_param( $params, 'title_bg_color' );
        $title_bg_actv_color = massive_get_default_param( $params, 'title_bg_actv_color' );
        $border_color        = massive_get_default_param( $params, 'border_color' );
        $border_actv_color   = massive_get_default_param( $params, 'border_actv_color' );

        $uid                 = $this->get_uid( $params );
        $panel_id            = $uid . ' div.panel-body';
        $item_id             = $uid . ' ul.nav li';
        $anchr_id            = $uid . ' ul.nav li a';
        $anchr_active_id     = $uid . ' ul.nav li.active a';
        $anchr_hover_id      = $uid . ' ul.nav li a:hover';
        $anchr_focus_id      = $uid . ' ul.nav li a:focus';

        if ( 'true' == $customize ) {
            $tree[$anchr_id] = array(
                'color'        => $title_color . ' !important',
                'border-color' => $border_color . ' !important',
                'background'   => $title_bg_color . ' !important',
            );
            $tree[$anchr_active_id] = array(
                'color'        => $title_actv_color . ' !important',
                'border-color' => $border_actv_color . ' !important',
                'background'   => $title_bg_actv_color . ' !important',
            );
            $tree[$anchr_focus_id] = array(
                'color'        => $title_actv_color . ' !important',
                'border-color' => $border_actv_color . ' !important',
                'background'   => $title_bg_actv_color . ' !important',
            );
            $tree[$anchr_hover_id] = array(
                'color'        => $title_actv_color . ' !important',
                'border-color' => $border_actv_color . ' !important',
                'background'   => $title_bg_actv_color . ' !important',
            );
        }
        if ( ( 'three' == $type ) || ( 'four' == $type ) ) {
            $tree[$panel_id] = array(
                'border-color' => $border_color . ' !important'
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
            'name'                    => esc_html__( 'Tabs', 'massive-engine'),
            'base'                    => $this->get_tag(),
            'category'                => esc_html__( 'Massive', 'massive-engine' ),
            'as_parent'               => array('only' => 'massive_tab'),
            'content_element'         => true,
            'show_settings_on_create' => true,
            'icon'                    => $this->get_icon('tab'),
            'is_container'            => true,
            "js_view"                 => 'VcColumnView',
            "params"                  =>array(
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Tabs Style', 'massive-engine' ),
                    'param_name'  => 'type',
                    'description' => esc_html__( 'Chose massive tab style', 'massive-engine' ),
                    'admin_label' => true,
                    'value'       => array(
                            esc_html__( 'Underlined Tab'  , 'massive-engine' )            => 'one',
                            esc_html__( 'Button Tab '  , 'massive-engine' )               => 'two',
                            esc_html__( 'Button Tab (Content Border)', 'massive-engine' ) => 'three',
                            esc_html__( 'Capsule Tab' , 'massive-engine' )                => 'four',
                            esc_html__( 'Rectangular Tab' , 'massive-engine' )            => 'five',
                            esc_html__( 'Icon Tab'  , 'massive-engine' )                  => 'six',
                            esc_html__( 'Icon Tab With Title', 'massive-engine' )         => 'seven'
                        )
                    ),
                array(
                    'type'        => 'checkbox',
                    'heading'     => esc_html__( 'Customize', 'massive-engine' ),
                    'param_name'  => 'customize',
                    'description' => esc_html__( 'Check this box to activate custom settings', 'massive-engine' ),
                    'value'       => 'false'
                    ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__( 'Title Color', 'massive-engine' ),
                    'param_name'  => 'title_color',
                    'group'       => esc_html__( 'Custom Settings', 'massive-engine' ),
                    'value'       => '#333',
                    'dependency'  => array(
                        'element' => 'customize',
                        'value'   => 'true'
                        )
                    ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__( 'Title Hover & Active Color', 'massive-engine' ),
                    'param_name'  => 'title_actv_color',
                    'group'       => esc_html__( 'Custom Settings', 'massive-engine' ),
                    'value'       => '#333',
                    'dependency'  => array(
                        'element' => 'customize',
                        'value'   => 'true'
                        )
                    ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__( 'Title Background Color', 'massive-engine' ),
                    'param_name'  => 'title_bg_color',
                    'group'       => esc_html__( 'Custom Settings', 'massive-engine' ),
                    'value'       => '#fff',
                    'dependency'  => array(
                        'element' => 'customize',
                        'value'   => 'true'
                        )
                    ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__( 'Title Background Hover & Active Color', 'massive-engine' ),
                    'param_name'  => 'title_bg_actv_color',
                    'group'       => esc_html__( 'Custom Settings', 'massive-engine' ),
                    'value'       => '#fff',
                    'dependency'  => array(
                        'element' => 'customize',
                        'value'   => 'true'
                        )
                    ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__( 'Content Color', 'massive-engine' ),
                    'param_name'  => 'content_color',
                    'group'       => esc_html__( 'Custom Settings', 'massive-engine' ),
                    'value'       => '#333',
                    'dependency'  => array(
                        'element' => 'customize',
                        'value'   => 'true'
                        )
                    ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__( 'Border Color', 'massive-engine' ),
                    'param_name'  => 'border_color',
                    'group'       => esc_html__( 'Custom Settings', 'massive-engine' ),
                    'value'       => '#eee',
                    'dependency'  => array(
                        'element' => 'customize',
                        'value'   => 'true'
                        )
                    ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__( 'Border Hover & Active Color', 'massive-engine' ),
                    'param_name'  => 'border_actv_color',
                    'group'       => esc_html__( 'Custom Settings', 'massive-engine' ),
                    'value'       => '#333',
                    'dependency'  => array(
                        'element' => 'customize',
                        'value'   => 'true'
                        )
                    ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Alignment', 'massive-engine' ),
                    'param_name'  => 'alignment',
                    'group'       => esc_html__( 'Custom Settings', 'massive-engine' ),
                    'value'       => array(
                            esc_html__( 'Normal', 'massive-engine' )    => 'nav-normal',
                            esc_html__( 'Justified', 'massive-engine' ) => 'nav-justified'
                        ),
                    'dependency'  => array(
                        'element' => 'customize',
                        'value'   => 'true'
                        )
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
            'type'                => 'one',
            'title_color'         => '#434343',
            'title_actv_color'    => '#434343',
            'title_bg_color'      => 'transparen',
            'title_bg_actv_color' => '#eee',
            'content_color'       => '#434343',
            'border_color'        => '#eee',
            'border_actv_color'   => '#434343',
            'alignment'           => 'nav-normal',
            'uid'                 => '',
            );

        $uid         = $this->get_uid( $atts );
        $atts        = shortcode_atts( $defaults, $atts );
        $atts['uid'] = $uid;
        $type        = trim( strtolower( $atts['type'] ) );
        $types       = array('one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight');
        $classes = array();
        $contents = do_shortcode( $content );

        preg_match_all("'<li>(.*?)</li>'si", $contents, $nav);
        preg_match_all("'<article(.*?)</article>'si", $contents, $tab_contents);

        $view = $this->get_view( $type );

        ob_start();
        if ( in_array( $type, $types ) && file_exists( $view ) ) {
            include( $view );
        }
        return ob_get_clean();
    }

}

new Massive_Tabs_Container;

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_Massive_Tabs_Container extends WPBakeryShortCodesContainer {
    }
}
