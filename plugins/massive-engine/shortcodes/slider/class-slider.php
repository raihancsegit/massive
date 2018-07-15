<?php
/**
 * Massive slider shortcode
 *
 * @package Massive Engine
 * @author ThemeBucket <themebucket@gmail.com>
 */

class Massive_Slider extends Massive_Shortcode {

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
            'name'                    => esc_html__( 'Slider', 'massive-engine' ),
            'base'                    => $this->get_tag(),
            'category'                => esc_html__( 'Massive', 'massive-engine' ),
            'icon'                    => $this->get_icon('slider'),
            'show_settings_on_create' => true,
            'params'                  => array(
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Slider Title', 'massive-engine' ),
                    'admin_label' => true,
                    'description' => esc_html__( 'This title is being used for backend only.', 'massive-engine' ),
                    'param_name'  => 'title',
                    ),
                array(
                    'type'        => 'attach_images',
                    'heading'     => esc_html__( 'Slider Images', 'massive-engine' ),
                    'description' => esc_html__( 'Add as many images as you want for slider.', 'massive-engine' ),
                    'param_name'  => 'images',
                    ),
                array(
                    'type'       => 'checkbox',
                    'heading'    => esc_html__( 'Display Caption', 'massive-engine' ),
                    'param_name' => 'has_caption',
                    ),
                array(
                    'type'       => 'checkbox',
                    'heading'    => esc_html__( 'Display Pagination', 'massive-engine' ),
                    'param_name' => 'has_pagination',
                    'value'      => 'true',
                    'std'        => true,
                    ),
                array(
                    'type'       => 'dropdown',
                    'heading'    => esc_html__( 'Pagination Type', 'massive-engine' ),
                    'param_name' => 'pagination_type',
                    'dependency' => array(
                        'element' => 'has_pagination',
                        'value'   => 'true',
                        ),
                    'value'      => array(
                        esc_html__( 'Bullet', 'massive-engine' )    => 'bullet',
                        esc_html__( 'Thumbnail', 'massive-engine' ) => 'thumbnail',
                        ),
                    ),
                array(
                    'type'       => 'dropdown',
                    'heading'    => esc_html__( 'Pagination Alignment', 'massive-engine' ),
                    'param_name' => 'pagination_alignment',
                    'dependency' => array(
                        'element' => 'has_pagination',
                        'value'   => 'true',
                        ),
                    'value'      => array(
                        esc_html__( 'Left Align', 'massive-engine' )   => 'left',
                        esc_html__( 'Center Align', 'massive-engine' ) => 'center',
                        esc_html__( 'Right Align', 'massive-engine' )  => 'right',
                        ),
                    ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Slider Image Size', 'massive-engine' ),
                    'param_name'  => 'image_size',
                    'description' => esc_html__( 'Full size image will be used as default.', 'massive-engine' ),
                    'value'       => massive_get_image_sizes(true)
                    ),
                array(
                    'type'       => 'dropdown',
                    'heading'    => esc_html__( 'Animation Type', 'massive-engine' ),
                    'group'      => esc_html__( 'Animation Settings', 'massive-engine' ),
                    'param_name' => 'animation',
                    'value'      => array(
                        esc_html__( 'Slide', 'massive-engine' ) => 'slide',
                        esc_html__( 'Fade', 'massive-engine' )  => 'fade',
                        ),
                    ),
                array(
                    'type'       => 'dropdown',
                    'heading'    => esc_html__( 'Slide Direction', 'massive-engine' ),
                    'group'      => esc_html__( 'Animation Settings', 'massive-engine' ),
                    'param_name' => 'direction',
                    'dependency' => array(
                        'element' => 'animation',
                        'value'   => 'slide',
                        ),
                    'value'      => array(
                        esc_html__( 'Horizontal', 'massive-engine' ) => 'horizontal',
                        esc_html__( 'Vertical', 'massive-engine' )   => 'vertical',
                        ),
                    ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Animation Speed', 'massive-engine' ),
                    'group'       => esc_html__( 'Animation Settings', 'massive-engine' ),
                    'param_name'  => 'speed',
                    'value'       => '600',
                    'std'         => '600',
                    'description' => esc_html__( 'Set the speed of animations, in milliseconds. Default is 600 milliseconds.', 'massive-engine' ),
                    ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Slide Speed', 'massive-engine' ),
                    'group'       => esc_html__( 'Animation Settings', 'massive-engine' ),
                    'param_name'  => 'slide_speed',
                    'value'       => '7000',
                    'std'         => '7000',
                    'description' => esc_html__( 'Set the speed of the slide show cycling, in milliseconds. Default is 7000 milliseconds.', 'massive-engine' ),
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
            'images'               => '',
            'has_caption'          => '',
            'has_pagination'       => '',
            'pagination_type'      => 'bullet',
            'pagination_alignment' => 'left',
            'animation'            => 'slide',
            'direction'            => 'horizontal',
            'speed'                => 600,
            'slide_speed'          => 7000,
            'image_size'           => 'full',
            );

        $uid             = $this->get_uid( $atts ); //this line must be here after $defaults, before calling shortcode_atts
        $atts            = shortcode_atts( $defaults, $atts );
        $atts['uid']     = $uid;
        $slides          = array_filter( explode( ',', $atts['images'] ) );
        $has_caption     = massive_sanitize_param( $atts['has_caption'] );
        $has_pagination  = massive_sanitize_param( $atts['has_pagination'] );
        $pagination_type = massive_sanitize_param( $atts['pagination_type'] );
        $alignment       = massive_sanitize_param( $atts['pagination_alignment'] );
        $animation       = massive_sanitize_param( $atts['animation'] );
        $direction       = massive_sanitize_param( $atts['direction'] );
        $speed           = absint( $atts['speed'] );
        $slide_speed     = absint( $atts['slide_speed'] );
        $classes         = array( 'massive-slider', 'post-slider-thumb', 'post-img' );

        if ( $has_pagination && 'bullet' == $pagination_type ) {
            $pagination = 'true';
        } elseif ( $has_pagination && 'thumbnail' == $pagination_type ) {
            $pagination = 'thumbnails';
        } else {
            $pagination = 'false';
        }

        $data_attr = array(
            'animation'   => $animation,
            'direction'   => $direction,
            'pagination'  => $pagination,
            'slide-speed' => $slide_speed,
            'speed'       => $speed,
            );

        if ( $has_pagination ) {
            $classes[] = 'has-pagination';
            $classes[] = "pagination-{$alignment}";
            $classes[] = "pagination-type-{$pagination_type}";
        }

        if ( $has_caption ) {
            $classes[] = 'has-caption';
        }

        $view = $this->get_view( 'main' );

        ob_start();
        if ( file_exists( $view ) ) {
            include( $view );
        }
        return ob_get_clean();
    }

}

new Massive_Slider;
