<?php
/**
 * Massive funfactor shortcode
 *
 * @package Massive Engine
 * @author ThemeBucket <themebucket@gmail.com>
 */

class Massive_Funfactor extends Massive_Shortcode {

    /**
     * Set shortcode directory
     * @return string Directory path
     */
    protected function set_dir() {
        return __DIR__;
    }

    /**
     * Map shortcode dynamic styles
     *
     * @param  array $params
     * @return string
     */
    public function map_dynamic_styles( $params ) {
        $tree           = array();
        $uid            = $this->get_uid( $params );
        $type           = massive_get_default_param( $params, 'type' );
        $disable_border = massive_get_default_param( $params, 'disable_border', false );           
        
        if ( 'custom' == $type ) {
            $tree[ $uid  ] = array(
                'background-color' => $params['custom_bg_color'],
            );

            $tree[ $uid ." .icon i" ] = array(
                'color' => $params['custom_icon_color'],
            );

            $tree[ $uid ." .fun-info span" ] = array(
                'color' => $params['custom_icon_color'],
            );

            $tree[ $uid ." .fun-info h1" ] = array(
                'color' => $params['custom_text_color'],
            );

            if ( true == $disable_border ) {

                $tree[ $uid ] = array(
                    'background-color' => $params['custom_bg_color'],
                    'border-top'       => 'none !important',
                    'border-bottom'    => 'none !important'
                );

            }
        }

        return $tree;
    }

    /**
     * Map this shortcode with visual composer
     * 
     * @return array
     */
    protected function map() {
        return array(
            'name'     => esc_html__( 'Fun Factors', 'massive-engine' ),
            'base'     => $this->get_tag(),
            'category' => 'Massive',
            'icon'     => $this->get_icon('fun-factor'),
            'params'   => array(
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Display Type', 'massive-engine' ),
                    'param_name'  => 'type',
                    'admin_label' => true,
                    'value'       => array(
                        esc_html__('Horizontal With Separator (Dark)','massive-engine')     => 'separator',
                        esc_html__('Horizontal With Separator (Light)','massive-engine')    => 'separatoralt',
                        esc_html__('Vertical','massive-engine')                             => 'vertical',
                        esc_html__('Horizontal With No Separator (Dark)','massive-engine')  => 'noseparator',
                        esc_html__('Horizontal With No Separator (Light)','massive-engine') => 'noseparatorlight',
                        esc_html__('Custom','massive-engine')                               => 'custom',
                    ),
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Fun Factor Text', 'massive-engine' ),
                    'param_name'  => 'text',
                    'admin_label' => true,
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => esc_html__( 'Fun Factor Value', 'massive-engine' ),
                    'param_name' => 'value',
                ),
                array(
                    'type'        => 'iconpicker',
                    'heading'     => esc_html__( 'Icon', 'massive-engine' ),
                    'param_name'  => 'icon',
                    'settings'    => array(
                        'emptyIcon' => false,
                        'type'        => 'tb_icons',
                    ),
                    'description' => esc_html__( 'Select an icon from the Font Awesome library.', 'massive-engine' ),
                ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__( 'Background Custom Color', 'massive-engine' ),
                    'param_name'  => 'custom_bg_color',
                    'value'       => '#fff',
                    'description' => esc_html__( 'Pick a color for background', 'massive-engine' ),
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => 'custom'
                    ),
                ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__( 'Value Color', 'massive-engine' ),
                    'param_name'  => 'custom_text_color',
                    'value'       => '#333',
                    'description' => esc_html__( 'Pick a color for value text', 'massive-engine' ),
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => 'custom'
                    ),
                ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__( 'Icon & Text Color', 'massive-engine' ),
                    'param_name'  => 'custom_icon_color',
                    'value'       => '#333',
                    'description' => esc_html__( 'Pick a color for icon & title text', 'massive-engine' ),
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => 'custom'
                    ),
                ),
                array(
                    'type'        => 'checkbox',
                    'heading'     => esc_html__( 'Disable Border', 'massive-engine' ),
                    'param_name'  => 'disable_border',
                    'value'       => false,
                    'description' => esc_html__( "Disable top & bottom's border", 'massive-engine' ),
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => 'custom'
                    ),
                ),
            )
        );
    }

    /**
     * Render this shortcode
     *
     * @param  array $atts
     * @param  string $content
     * 
     * @return string
     */
    public function render( $atts, $content = null ) {
        $defaults = array(
            'icon'                 => '',
            'value'                => '',
            'text'                 => 'false',
            'type'                 => 'false',
            'custom_bg_color'      => '',
            'custom_text_color'    => '',
            'custom_icon_color'    => '',
            'disable_border'       => false,
            'uid'                  => '',
        );

        $uid         = $this->get_uid( $atts ); //this line must be here after $defaults, before calling shortcode_atts
        $atts        = shortcode_atts( $defaults, $atts );
        $atts['uid'] = $uid;
        $type        = trim( strtolower( $atts['type'] ) );
        $types       = array(
            'separator',
            'separatoralt',
            'vertical',
            'noseparator',
            'noseparatorlight',
            'custom',
        );

        if($type=='false') $type = "separator";

        $view = $this->get_view( $type );

        ob_start();
        if ( in_array( $type, $types ) && file_exists( $view ) ) {
            include( $view );
        }
        return ob_get_clean();
    }

}

new Massive_Funfactor;
