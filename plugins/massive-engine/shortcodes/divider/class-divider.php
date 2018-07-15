<?php
/**
 * Massive divider shortcode
 *
 * @package Massive Engine
 * @author ThemeBucket <themebucket@gmail.com>
 */

class Massive_Divider extends Massive_Shortcode {

    /**
     * Set shortcode directory
     * @return string Directory path
     */
    protected function set_dir() {
        return __DIR__;
    }

    /**
     * Render shortcode dynamic styles
     * @param  array $params
     * @return string
     */
    public function map_dynamic_styles( $params ) {
        $tree       = array();

        $type       = massive_get_default_param( $params, 'type', 'solid' );
        $border     = massive_get_default_param( $params, 'icon_border', 'false' );
        $width      = massive_get_default_param( $params, 'width', '100%' );
        $line_color = massive_get_default_param( $params, 'line_color', '#e2e2e2' );
        $icon_color = massive_get_default_param( $params, 'icon_color', '#b4b4b4' );
        $icon_bcg   = massive_get_default_param( $params, 'icon_bcg', '#F5F5F5' );

        $uid        = $this->get_uid($params);
        $spcl_uid   = $uid . ' span.dot';
        $icon_uid   = $uid . ' i' ;

        $tree[$uid] = array(
            'width'        => massive_check_css_unit($width) . ' !important',
            'border-color' => $line_color . ' !important',
        );

        if ( 'dot' == $type ) {
            $tree[$spcl_uid] = array(
                'border-color'    => $line_color . ' !important',
            );
        }

        if ( 'true' == $border ) {
            $tree[$icon_uid] = array(
                'color'            => $icon_color . ' !important',
                'background-color' => $icon_bcg . ' !important',
                'border'           =>  '1px solid' . $line_color . ' !important',
            );
        }else{
            $tree[$icon_uid] = array(
                'color'            => $icon_color . ' !important',
                'background-color' => $icon_bcg . ' !important',
            );
        }
        return $tree;
    }

    /**
     * Map divider shortcode with visual composer
     * @return void
     */
    protected function map() {
        return array(
            'name'     => esc_html__( 'Divider', 'massive-engine' ),
            'base'     => $this->get_tag(),
            'category' => esc_html__( 'Massive', 'massive-engine' ),
            'icon'     => $this->get_icon('divider'),
            'params'   => array(
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Line Style', 'massive-engine' ),
                    'param_name'  => 'type',
                    'admin_label' => true,
                    'value'       => array(
                            esc_html__( 'Solid' , 'massive-engine' )          => 'solid',
                            esc_html__( 'Double' , 'massive-engine' )         => 'double',
                            esc_html__( 'Dashed' , 'massive-engine' )         => 'dashed',
                            esc_html__( 'Massive Special', 'massive-engine' ) => 'dot'
                        ),
                    ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__( 'Line Color', 'massive-engine' ),
                    'description' => esc_html__( 'Pick divider line color', 'massive-engine' ),
                    'param_name'  => 'line_color',
                    'value'       => '#e2e2e2',
                    ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Divider Width', 'massive-engine' ),
                    'description' => esc_html__( 'Set divider width', 'massive-engine' ),
                    'param_name'  => 'width',
                    'value'       => '100%',
                    ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Alignment', 'massive-engine' ),
                    'description' => esc_html__( 'Set divider alignment', 'massive-engine' ),
                    'param_name'  => 'alignment',
                    'admin_label' => true,
                    'value'       => array(
                            esc_html__( 'Center', 'massive-engine' ) => 'text-center',
                            esc_html__( 'Left'  , 'massive-engine' ) => 'text-left',
                            esc_html__( 'Right' , 'massive-engine' ) => 'text-right',
                        ),
                    ),
                array(
                    'type'        => 'checkbox',
                    'heading'     => esc_html__( 'Display Icon', 'massive-engine' ),
                    'description' => esc_html__( 'Check this box for displaying custom icon', 'massive-engine' ),
                    'param_name'  => 'has_icon',
                    'value'       => 'false',
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => array('solid', 'dashed', 'double'),
                        ),
                    ),
                array(
                    'type'        => 'iconpicker',
                    'heading'     => esc_html__( 'Divider Icon', 'massive-engine' ),
                    'param_name'  => 'icon',
                    'description' => esc_html__( 'Pick divider icon', 'massive-engine' ),
                    'dependency'  => array(
                        'element' => 'has_icon',
                        'value'   => 'true'
                        ),
                    'settings' => array(
                        'emptyIcon' => false,
                        'type'      => 'tb_icons'
                        ),
                    ),
                array(
                    'type'        => 'checkbox',
                    'heading'     => esc_html__( 'Customize Icon', 'massive-engine' ),
                    'description' => esc_html__( 'Check this box for customizing icon', 'massive-engine' ),
                    'param_name'  => 'customize',
                    'value'       => 'false',
                    'dependency'  => array(
                        'element' => 'has_icon',
                        'value'   => 'true'
                        ),
                    ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__( 'Icon Color', 'massive-engine' ),
                    'param_name'  => 'icon_color',
                    'description' => esc_html__( 'Pick icon color', 'massive-engine' ),
                    'dependency'  => array(
                        'element' => 'customize',
                        'value'   => 'true'
                        ),
                    ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__( 'Icon Background Color', 'massive-engine' ),
                    'param_name'  => 'icon_bcg',
                    'description' => esc_html__( 'Pick icon background color', 'massive-engine' ),
                    'dependency'  => array(
                        'element' => 'customize',
                        'value'   => 'true'
                        ),
                    ),
                array(
                    'type'        => 'checkbox',
                    'heading'     => esc_html__( 'Icon Border', 'massive-engine' ),
                    'description' => esc_html__( 'Check this box for displaying icon border', 'massive-engine' ),
                    'param_name'  => 'icon_border',
                    'value'       => 'false',
                    'dependency'  => array(
                        'element' => 'customize',
                        'value'   => 'true'
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
            'type'        => 'solid',
            'dot_color'   => '#e2e2e2',
            'line_color'  => '#e2e2e2',
            'width'       => '100%',
            'alignment'   => 'text-center',
            'has_icon'    => 'false',
            'icon'        => '',
            'customize'   => 'false',
            'icon_color'  => '#b4b4b4',
            'icon_bcg'    => '#F5F5F5',
            'icon_border' => 'false',
            'uid'         => '',
            );

        $uid =  $this->get_uid($atts); //this line must be here after $defaults, before calling shortcode_atts
        $atts = shortcode_atts( $defaults, $atts );
        $atts['uid'] = $uid;
        $type = trim( strtolower( $atts['type'] ) );
        $types = array('solid', 'double', 'dashed', 'dot');

        $view = $this->get_view( $type );

        ob_start();
        if ( in_array( $type, $types ) && file_exists( $view ) ) {
            include( $view );
        }
        return ob_get_clean();
    }
    
}

new Massive_Divider;
