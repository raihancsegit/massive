<?php
/**
 * Massive portfolio shortcode
 *
 * @package Massive Engine
 * @author ThemeBucket <themebucket@gmail.com>
 */

class Massive_Portfolio extends Massive_Shortcode {

    /**
     * Set shortcode directory
     * @return string Directory path
     */
    protected function set_dir() {
        return __DIR__;
    }

    /**
     * Map this shortcode with visual composer
     * @return map
     */
    protected function map() {
        return array(
            'name'     => esc_html__( 'Portfolio', 'massive-engine' ),
            'base'     => $this->get_tag(),
            'category' => esc_html__( 'Massive', 'massive-engine' ),
            'icon'     => $this->get_icon('portfolio'),
            'params'   => array(
                array(
                    'type'        => 'checkbox',
                    'heading'     => esc_html__( 'Portfolio Categories', 'massive-engine' ),
                    'param_name'  => 'categories',
                    'value'       => massive_get_portfolio_categories(true),
                    'description' => massive_get_desc_for_portfolio_cats(),
                    ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__('Grid Settings', 'massive-engine' ),
                    'param_name'  => 'portfolio_grid_quantity',
                    'admin_label' => true,
                    'std'         => 'two',
                    'description' => esc_html__( 'Select portfolio grid', 'massive-engine' ),
                    'value'       => array(
                            esc_html__( 'Grid 2', 'massive-engine' ) => 'two',
                            esc_html__( 'Grid 3', 'massive-engine' ) => 'three',
                            esc_html__( 'Grid 4', 'massive-engine' ) => 'four',
                            esc_html__( 'Grid 5', 'massive-engine' ) => 'five',
                            esc_html__( 'Grid 6', 'massive-engine' ) => 'six',
                        )
                    ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Gutter Settings', 'massive-engine' ),
                    'param_name'  => 'has_portfolio_gutter',
                    'admin_label' => true,
                    'value'       => array(
                            esc_html__( 'Grid Without Gutter', 'massive-engine' ) => false,
                            esc_html__( 'Grid With Gutter', 'massive-engine' )    => true,
                        )
                    ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Content Position', 'massive-engine' ),
                    'param_name'  => 'content_position',
                    'value'       => array(
                            esc_html__( 'On Hover', 'massive-engine' ) => 'on-hover',
                            esc_html__( 'Bottom', 'massive-engine' )   => 'bottom',
                        )
                    ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Content Alignment', 'massive-engine' ),
                    'param_name'  => 'content_alignment',
                    'value'       => array(
                            esc_html__( 'Left Align', 'massive-engine' )   => 'text-left',
                            esc_html__( 'Center Align', 'massive-engine' ) => 'text-center',
                            esc_html__( 'Right Align', 'massive-engine' )  => 'text-right',
                        ),
                    'std'         => 'text-left',
                    'dependency'  => array(
                            'element' => 'content_position',
                            'value'   => 'bottom'
                        )
                    ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Portfolio Items', 'massive-engine' ),
                    'param_name'  => 'portfolio_items',
                    'value'       => 8,
                    'description' => esc_html__( 'No. of portfolios want to display ', 'massive-engine' ),
                    ),
                array(
                    'type'        => 'checkbox',
                    'heading'     => esc_html__( 'Masonry View', 'massive-engine' ),
                    'param_name'  => 'has_portfolio_masonry',
                    'admin_label' => true,
                    'std'         => false,
                    'description' => esc_html__( 'Check the box to display masonry view', 'massive-engine' ),
                    ),
                array(
                    'type'        => 'checkbox',
                    'heading'     => esc_html__( 'Disable Portfolio Filter', 'massive-engine' ),
                    'param_name'  => 'portfolio_filter',
                    'std'         => false,
                    'description' => esc_html__( 'Disable portfolio filter navigation ', 'massive-engine' ),
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
            'has_portfolio_gutter'    => false,
            'has_portfolio_masonry'   => false,
            'portfolio_grid_quantity' => 'two',
            'categories'              => '',
            'content_position'        => 'on-hover',
            'content_alignment'       => 'text-left',
            'portfolio_items'         => 8,
            'portfolio_filter'        => false,
            'uid'                     => ''
            );

        $uid         = $this->get_uid( $atts );
        $atts        = shortcode_atts( $defaults, $atts );
        $atts['uid'] = $uid;
        $type        = massive_sanitize_param( $atts['content_position'] );
        $types       = array('on-hover', 'bottom');

        $view = $this->get_view( $type );

        ob_start();
        if ( in_array( $type, $types ) && file_exists( $view ) ) {
            include( $view );
        }
        return ob_get_clean();
    }

}

new Massive_Portfolio;
