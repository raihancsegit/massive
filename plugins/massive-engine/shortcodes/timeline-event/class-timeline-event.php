<?php
/**
 * Massive timeline event shortcode
 *
 * @package Massive Engine
 * @author ThemeBucket <themebucket@gmail.com>
 */

class Massive_Timeline_Event extends Massive_Shortcode {

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
            'name'     => esc_html__( 'Timeline Event', 'massive-engine' ),
            'as_child' => array('only' => 'massive_timeline' ),
            'base'     => $this->get_tag(),
            'category' => esc_html__( 'Massive', 'massive-engine' ),
            'icon'     => $this->get_icon('timeline'),
            'params'   => array(
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Event Title', 'massive-engine' ),
                    'param_name'  => 'title',
                    'admin_label' => true,
                    'value'       => esc_html__( 'Event Title', 'massive-engine' ),
                    ),
                array(
                    'type'       => 'textarea_html',
                    'heading'    => esc_html__( 'Event Details', 'massive-engine' ),
                    'param_name' => 'content',
                    'value'      => esc_html__( 'Event details goes here', 'massive-engine' ),
                    ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Alignment', 'massive-engine' ),
                    'param_name'  => 'alignment',
                    'admin_label' => true,
                    'std'         => 'right',
                    'value'       => array(
                        esc_html__( 'Right', 'massive-engine' ) => 'right',
                        esc_html__( 'Left', 'massive-engine' )  => 'left',
                        )
                    ),
                array(
                    'type'       => 'iconpicker',
                    'heading'    => esc_html__( 'Icon', 'massive-engine' ),
                    'param_name' => 'icon',
                    'description' => esc_html__( 'Select an icon for this event.', 'massive-engine' ),
                    'settings' => array(
                        'emptyIcon' => false,
                        'type' => 'tb_icons',
                        ),
                    ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Title Link', 'massive-engine' ),
                    'param_name'  => 'link',
                    'value'       => '',
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
            'title'     => esc_html__( 'Event Title', 'massive-engine' ),
            'icon'      => 'icon-telescope',
            'link'      => '',
            'alignment' => 'right',
            );

        $uid         = $this->get_uid( $atts ); //this line must be here after $defaults, before calling shortcode_atts
        $atts        = shortcode_atts( $defaults, $atts );
        $atts['uid'] = $uid;

        $alignment   = massive_sanitize_param( $atts['alignment'] );
        $classes     = array('timeline-item');

        if ( 'right' !== $alignment ) {
            $classes[] = 'timeline-item-left';
            $classes[] = 'alt';
        } else {
            $classes[] = 'timeline-item-right';
        }

        $view = $this->get_view( 'main' );

        ob_start();
        if ( file_exists( $view ) ) {
            include( $view );
        }
        return ob_get_clean();
    }
    
}

new Massive_Timeline_Event;

if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_Massive_Timeline_Event extends WPBakeryShortCode {
    }
}
