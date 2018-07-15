<?php
/**
 * Massive button shortcode
 *
 * @package Massive Engine
 * @author ThemeBucket <themebucket@gmail.com>
 */

class Massive_Button extends Massive_Shortcode {

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
        $tree = array();
        $type = massive_get_default_param( $params, 'type', 'fill' );
        $uid  = $this->get_uid( $params );

        $button       = "btn.{$uid}";
        $button_state = "{$button}:hover,.{$button}:focus,.{$button}:active";

        if ( 'custom' == $type ) {
            $color              = massive_get_default_param( $params, 'color' );
            $bg_color           = massive_get_default_param( $params, 'bg_color' );
            $border_color       = massive_get_default_param( $params, 'border_color' );
            $border_size        = massive_get_default_param( $params, 'border_size', '1px' );
            $border_radius      = massive_get_default_param( $params, 'border_radius' );
            $hover_color        = massive_get_default_param( $params, 'hover_color' );
            $hover_bg_color     = massive_get_default_param( $params, 'hover_bg_color' );
            $hover_border_color = massive_get_default_param( $params, 'hover_border_color' );

            $tree[$button] = array(
                'color'            => $color,
                'background-color' => $bg_color,
                'border-color'     => $border_color,
                'border-width'     => massive_check_css_unit( $border_size ),
                'border-radius'    => massive_check_css_unit( $border_radius ),
            );

            $tree[$button_state] = array(
                'color'            => $hover_color,
                'background-color' => $hover_bg_color,
                'border-color'     => $hover_border_color,
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
            'name'     => esc_html__( 'Button', 'massive-engine' ),
            'base'     => $this->get_tag(),
            'category' => 'Massive',
            'icon'     => $this->get_icon('button'),
            'params'   => array(
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Button Type', 'massive-engine' ),
                    'param_name'  => 'type',
                    'admin_label' => true,
                    'std'         => 'fill',
                    'value'       => array(
                        esc_html__( 'Fill', 'massive-engine' )      => 'fill',
                        esc_html__( 'Line', 'massive-engine' )      => 'line',
                        esc_html__( 'Bootstrap', 'massive-engine' ) => 'bootstrap',
                        esc_html__( 'Custom', 'massive-engine' )    => 'custom',
                        ),
                    ),
                array(
                    'type'       => 'dropdown',
                    'heading'    => esc_html__( 'Button Shape', 'massive-engine' ),
                    'param_name' => 'shape',
                    'std'        => 'rect',
                    'dependency' => array(
                        'element' => 'type',
                        'value'   => array('fill','line','bootstrap'),
                        ),
                    'value'       => array(
                        esc_html__( 'Rectangular', 'massive-engine' ) => 'rect',
                        esc_html__( 'Rounded', 'massive-engine' )     => 'rounded',
                        esc_html__( 'Capsule', 'massive-engine' )     => 'capsule',
                        ),
                    ),
                array(
                    'type'       => 'dropdown',
                    'heading'    => esc_html__( 'Button Color', 'massive-engine' ),
                    'param_name' => 'btn_color',
                    'std'        => 'theme',
                    'dependency' => array(
                        'element' => 'type',
                        'value'   => array('fill','line'),
                        ),
                    'value'       => array(
                        esc_html__( 'Theme Color', 'massive-engine' ) => 'theme',
                        esc_html__( 'Black', 'massive-engine' )       => 'black',
                        esc_html__( 'White', 'massive-engine' )       => 'white',
                        ),
                    ),
                array(
                    'type'       => 'dropdown',
                    'heading'    => esc_html__( 'Button Color', 'massive-engine' ),
                    'param_name' => 'bs_btn_color',
                    'std'        => 'default',
                    'dependency' => array(
                        'element' => 'type',
                        'value'   => 'bootstrap',
                        ),
                    'value'       => array(
                        esc_html__( 'Default', 'massive-engine' ) => 'default',
                        esc_html__( 'Primary', 'massive-engine' ) => 'primary',
                        esc_html__( 'Info', 'massive-engine' )    => 'info',
                        esc_html__( 'Success', 'massive-engine' ) => 'success',
                        esc_html__( 'Warning', 'massive-engine' ) => 'warning',
                        esc_html__( 'Danger', 'massive-engine' )  => 'danger',
                        ),
                    ),
                array(
                    'type'       => 'dropdown',
                    'heading'    => esc_html__( 'Button Size', 'massive-engine' ),
                    'param_name' => 'size',
                    'std'        => 'medium',
                    'value'      => array(
                        esc_html__( 'Large', 'massive-engine' )  => 'large',
                        esc_html__( 'Medium', 'massive-engine' ) => 'medium',
                        esc_html__( 'Small', 'massive-engine' )  => 'small',
                        esc_html__( 'Tiny', 'massive-engine' )   => 'tiny',
                        ),
                    ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Button Text', 'massive-engine' ),
                    'param_name'  => 'text',
                    'admin_label' => true,
                    'value'       => esc_html__( 'Button Text', 'massive-engine' ),
                    ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Button Link', 'massive-engine' ),
                    'param_name'  => 'link',
                    'value'       => esc_html__( 'http://', 'massive-engine' ),
                    ),
                array(
                    'type'       => 'checkbox',
                    'heading'    => esc_html__( 'Open Link In A New Tab.', 'massive-engine' ),
                    'param_name' => 'newtab',
                    ),
                array(
                    'type'       => 'checkbox',
                    'heading'    => esc_html__( 'Display Icon', 'massive-engine' ),
                    'param_name' => 'has_icon',
                    ),
                array(
                    'type'       => 'iconpicker',
                    'heading'    => esc_html__( 'Icon', 'massive-engine' ),
                    'param_name' => 'icon',
                    'dependency' => array(
                        'element' => 'has_icon',
                        'value'   => 'true'
                        ),
                    'settings'   => array(
                        'emptyIcon' => false,
                        'type'      => 'tb_icons',
                        ),
                    ),
                array(
                    'type'       => 'dropdown',
                    'heading'    => esc_html__( 'Icon Postion', 'massive-engine' ),
                    'param_name' => 'icon_position',
                    'std'        => 'before',
                    'value'      => array(
                        esc_html__( 'Before Button Text', 'massive-engine' ) => 'before',
                        esc_html__( 'After Button Text', 'massive-engine' )  => 'after',
                        ),
                    'dependency' => array(
                        'element' => 'has_icon',
                        'value'   => 'true'
                        ),
                    'description' => esc_html__( 'Select where icon should be displayed.', 'massive-engine' ),
                    ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'CSS Class', 'massive-engine' ),
                    'param_name'  => 'css_class',
                    ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'CSS ID', 'massive-engine' ),
                    'param_name'  => 'css_id',
                    ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__( 'Text Color', 'massive-engine' ),
                    'group'       => esc_html__( 'Custom Settings', 'massive-engine' ),
                    'param_name'  => 'color',
                    'description' => esc_html__( 'Pick a color for button text.', 'massive-engine' ),
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => 'custom'
                        ),
                    ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__( 'Text Color (hover)', 'massive-engine' ),
                    'group'       => esc_html__( 'Custom Settings', 'massive-engine' ),
                    'param_name'  => 'hover_color',
                    'description' => esc_html__( 'Pick a color for button text (hover).', 'massive-engine' ),
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => 'custom'
                        ),
                    ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__( 'Background Color', 'massive-engine' ),
                    'group'       => esc_html__( 'Custom Settings', 'massive-engine' ),
                    'param_name'  => 'bg_color',
                    'description' => esc_html__( 'Pick a color for button background.', 'massive-engine' ),
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => 'custom'
                        ),
                    ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__( 'Background Color (hover)', 'massive-engine' ),
                    'group'       => esc_html__( 'Custom Settings', 'massive-engine' ),
                    'param_name'  => 'hover_bg_color',
                    'description' => esc_html__( 'Pick a color for button background (hover).', 'massive-engine' ),
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => 'custom'
                        ),
                    ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Border Radius', 'massive-engine' ),
                    'group'       => esc_html__( 'Custom Settings', 'massive-engine' ),
                    'param_name'  => 'border_radius',
                    'value'       => '0',
                    'description' =>  mengine_esc_desc( __( 'Set a border radius for button. For example %s. Recommended units are %s, %s & %s.', 'massive-engine' ) ,
                        array( 
                            '<code>5px</code>', 
                            '<code>px</code>', 
                            '<code>em</code>', 
                            '<code>%</code>',
                        )
                    ),
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => 'custom'
                        ),
                    ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Border Size', 'massive-engine' ),
                    'group'       => esc_html__( 'Custom Settings', 'massive-engine' ),
                    'param_name'  => 'border_size',
                    'value'       => '1px',
                    'std'         => '1px',
                    'save_always' => true,
                    'description' => mengine_esc_desc(  __( 'Set a border size for button. For example %s. Recommended units are %s, %s & %s. If you set "0" then border color will not be visible.', 'massive-engine' ),
                        array(
                            '<code>1px</code>', '<code>px</code>', '<code>em</code>', '<code>%</code>'
                        )
                    ),
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => 'custom'
                        ),
                    ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__( 'Border Color', 'massive-engine' ),
                    'group'       => esc_html__( 'Custom Settings', 'massive-engine' ),
                    'param_name'  => 'border_color',
                    'description' => esc_html__( 'Pick a color for button border.', 'massive-engine' ),
                    'dependency'  => array(
                        'element'   => 'border_size',
                        'not_empty' => true,
                        ),
                    ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__( 'Border Color (Hover)', 'massive-engine' ),
                    'group'       => esc_html__( 'Custom Settings', 'massive-engine' ),
                    'param_name'  => 'hover_border_color',
                    'description' => esc_html__( 'Pick a color for button border (hover).', 'massive-engine' ),
                    'dependency'  => array(
                        'element'   => 'border_size',
                        'not_empty' => true,
                        ),
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
            'type'               => 'fill',
            'shape'              => 'rect',
            'btn_color'          => 'theme',
            'bs_btn_color'       => 'default',
            'size'               => 'medium',
            'text'               => esc_html__( 'Button Text', 'massive-engine' ),
            'link'               => '',
            'newtab'             => 'false',
            'has_icon'           => 'false',
            'icon'               => '',
            'icon_position'      => 'before',
            'color'              => '#555',
            'hover_color'        => '#333',
            'bg_color'           => '#f1f1f1',
            'hover_bg_color'     => '#f6f6f6',
            'border_radius'      => '',
            'border_size'        => '1px',
            'border_color'       => '',
            'hover_border_color' => '',
            'css_class'          => '',
            'css_id'             => '',
            'uid'                => '',
            );

        $uid           = $this->get_uid( $atts ); //this line must be here after $defaults, before calling shortcode_atts
        $atts          = shortcode_atts( $defaults, $atts );
        $atts['uid']   = $uid;
        $type          = massive_sanitize_param( $atts['type'] );
        $shape         = massive_sanitize_param( $atts['shape'] );
        $btn_color     = massive_sanitize_param( $atts['btn_color'] );
        $bs_btn_color  = massive_sanitize_param( $atts['bs_btn_color'] );
        $size          = massive_sanitize_param( $atts['size'] );
        $newtab        = massive_sanitize_param( $atts['newtab'] );
        $has_icon      = massive_sanitize_param( $atts['has_icon'] );
        $icon_position = massive_sanitize_param( $atts['icon_position'] );
        $css_class     = massive_sanitize_param( $atts['css_class'] );
        $css_id        = massive_sanitize_param( $atts['css_id'] );
        $types         = array('fill', 'line', 'bootstrap', 'custom');
        $classes       = array('btn'); // assing default btn class

        // set user defined id
        $id_attr = ( ! empty( $css_id ) ? ( 'id="' . esc_attr( $css_id ) . '"' ) : '' );

        // handle button shape
        if ( 'rounded' == $shape ) {
            $classes[] = 'btn-rounded';
        } elseif ( 'capsule' == $shape ) {
            $classes[] = 'btn-circle';
        }

        // handle button color
        if ( 'fill' == $type ) {
            switch( $btn_color ) {
                case 'theme':
                    $classes[] = 'btn-theme-color';
                    break;
                case 'black':
                    $classes[] = 'btn-dark-solid';
                    break;
                case 'white':
                    $classes[] = 'btn-light-solid';
                    break;
            }
        } elseif ( 'line' == $type ) {
            switch( $btn_color ) {
                case 'theme':
                    $classes[] = 'btn-theme-border-color';
                    break;
                case 'black':
                    $classes[] = 'btn-dark-border';
                    break;
                case 'white':
                    $classes[] = 'btn-light-border';
                    break;
            }
        } elseif ( 'bootstrap' == $type ) {
            $classes[] = "btn-{$bs_btn_color}";
        }

        // handle button size based on type
        if ( 'bootstrap' == $type ) {
            switch ( $size ) {
                case 'large':
                    $classes[] = 'btn-lg';
                    break;
                case 'medium':
                    $classes[] = 'btn-md';
                    break;
                case 'small':
                    $classes[] = 'btn-sm';
                    break;
                case 'tiny':
                    $classes[] = 'btn-xs';
                    break;
            }
        } else {
            switch ( $size ) {
                case 'large':
                    $classes[] = 'btn-large';
                    break;
                case 'medium':
                    $classes[] = 'btn-medium';
                    break;
                case 'small':
                    $classes[] = 'btn-small';
                    break;
                case 'tiny':
                    $classes[] = 'btn-extra-small';
                    break;
            }
        }

        // assign uid if custom type
        if ( 'custom' == $type ) {
            $classes[] = $atts['uid'];
        }

        // set user defined classes
        $classes[] = $css_class;

        // set target attribute
        $target = ( 'true' === $newtab || '1' === $newtab ) ? 'target="_blank"' : '';

        $view = $this->get_view( 'main' );

        ob_start();
        if ( file_exists( $view ) ) {
            include( $view );
        }
        return ob_get_clean();
    }

}

new Massive_Button;