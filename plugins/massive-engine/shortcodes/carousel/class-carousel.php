<?php
/**
 * Massive carousel shortcode
 *
 * @package Massive Engine
 * @author ThemeBucket <themebucket@gmail.com>
 */

class Massive_Carousel extends Massive_Shortcode {

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
            'name'                    => esc_html__( 'Carousel', 'massive-engine' ),
            'base'                    => $this->get_tag(),
            'category'                => esc_html__( 'Massive', 'massive-engine' ),
            'icon'                    => $this->get_icon('carousel'),
            'show_settings_on_create' => true,
            'params'                  => array(
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Carousel Type', 'massive-engine' ),
                    'admin_label' => true,
                    'param_name'  => 'type',
                    'value' => array(
                        esc_html__( 'Only Image', 'massive-engine' )         => 'image',
                        esc_html__( 'Content With Image', 'massive-engine' ) => 'content-image',
                        )
                    ),
                array(
                    'type'        => 'attach_images',
                    'heading'     => esc_html__( 'Carousel Images', 'massive-engine' ),
                    'description' => esc_html__( 'Add as many images as you want for slider.', 'massive-engine' ),
                    'param_name'  => 'images',
                    ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Title', 'massive-engine' ),
                    'admin_label' => true,
                    'param_name'  => 'title',
                    'dependency' => array(
                        'element' => 'type',
                        'value'   => 'content-image',
                        ),
                    ),
                array(
                    'type'        => 'textarea_html',
                    'heading'     => esc_html__( 'Description', 'massive-engine' ),
                    'param_name'  => 'content',
                    'dependency' => array(
                        'element' => 'type',
                        'value'   => 'content-image',
                        ),
                    ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Content Position', 'massive-engine' ),
                    'param_name'  => 'position',
                    'value' => array(
                        esc_html__( 'Above Carousel', 'massive-engine' )  => 'above',
                        esc_html__( 'Beside Carousel', 'massive-engine' ) => 'beside',
                        ),
                    'dependency' => array(
                        'element' => 'type',
                        'value'   => 'content-image',
                        ),
                    ),
                array(
                    'type'       => 'checkbox',
                    'heading'    => esc_html__( 'Display Pagination', 'massive-engine' ),
                    'param_name' => 'has_pagination',
                    'value'      => 'false',
                    ),
                array(
                    'type'       => 'checkbox',
                    'heading'    => esc_html__( 'Display Navigation', 'massive-engine' ),
                    'param_name' => 'has_navigation',
                    'value'      => 'true',
                    'std'        => true,
                    ),
                array(
                    'type'       => 'textfield',
                    'heading'    => esc_html__( 'Number Of Image (Large)', 'massive-engine' ),
                    'param_name' => 'lg_items',
                    'value'      => 3,
                    'description' => esc_html__( 'Set the number of images to show on large devices. Default is 3', 'massive-engine' ),
                    ),
                array(
                    'type'       => 'textfield',
                    'heading'    => esc_html__( 'Number Of Image (Desktop)', 'massive-engine' ),
                    'param_name' => 'md_items',
                    'value'      => 3,
                    'description' => esc_html__( 'Set the number of images to show on medium devices. Default is 3', 'massive-engine' ),
                    ),
                array(
                    'type'       => 'textfield',
                    'heading'    => esc_html__( 'Number Of Image (Tab)', 'massive-engine' ),
                    'param_name' => 'sm_items',
                    'value'      => 2,
                    'description' => esc_html__( 'Set the number of images to show on small devices. Default is 2', 'massive-engine' ),
                    ),
                array(
                    'type'       => 'textfield',
                    'heading'    => esc_html__( 'Number Of Image (Mobile)', 'massive-engine' ),
                    'param_name' => 'xs_items',
                    'value'      => 1,
                    'description' => esc_html__( 'Set the number of images to show on extra small devices. Default is 1', 'massive-engine' ),
                    ),
                array(
                    'type'       => 'checkbox',
                    'heading'    => esc_html__( 'Autoplay', 'massive-engine' ),
                    'group'      => esc_html__( 'Animation Settings', 'massive-engine' ),
                    'param_name' => 'autoplay',
                    'value'      => 'true',
                    'std'        => true,
                    ),
                array(
                    'type'       => 'textfield',
                    'heading'    => esc_html__( 'Autoplay Speed', 'massive-engine' ),
                    'group'      => esc_html__( 'Animation Settings', 'massive-engine' ),
                    'param_name' => 'speed',
                    'value'      => '3000',
                    'std'        => '3000',
                    'dependency' => array(
                        'element' => 'autoplay',
                        'value'   => 'true',
                        ),
                    'description' => esc_html__( 'Set autoplay speed, in milliseconds. Default is 3000 milliseconds.', 'massive-engine' ),
                    ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Slide Speed', 'massive-engine' ),
                    'group'       => esc_html__( 'Animation Settings', 'massive-engine' ),
                    'param_name'  => 'slide_speed',
                    'value'       => '200',
                    'std'         => '200',
                    'description' => esc_html__( 'Set the speed of slide, in milliseconds. Default is 200 milliseconds.', 'massive-engine' ),
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
            'type'           => 'image',
            'images'         => '',
            'title'          => '',
            'position'       => 'above',
            'lg_items'       => 3,
            'md_items'       => 3,
            'sm_items'       => 2,
            'xs_items'       => 1,
            'autoplay'       => 'true',
            'speed'          => 3000,
            'slide_speed'    => 200,
            'has_pagination' => 'false',
            'has_navigation' => 'true',
            );

        $uid            = $this->get_uid( $atts ); //this line must be here after $defaults, before calling shortcode_atts
        $atts           = shortcode_atts( $defaults, $atts );
        $atts['uid']    = $uid;
        $type           = massive_sanitize_param( $atts['type'] );
        $slides         = array_filter( explode( ',', $atts['images'] ) );
        $position       = massive_sanitize_param( $atts['position'] );
        $autoplay       = massive_sanitize_param( $atts['autoplay'] );
        $speed          = absint( $atts['speed'] );
        $slide_speed    = absint( $atts['slide_speed'] );
        $lg_items       = absint( $atts['lg_items'] );
        $md_items       = absint( $atts['md_items'] );
        $sm_items       = absint( $atts['sm_items'] );
        $xs_items       = absint( $atts['xs_items'] );
        $has_pagination = massive_sanitize_param( $atts['has_pagination'] );
        $has_navigation = massive_sanitize_param( $atts['has_navigation'] );
        $classes        = array( 'massive-carousel' );

        $data_attr = array(
            'autoplay'    => ( 'true' == $autoplay ? $speed : 'false' ),
            'slide-speed' => $slide_speed,
            'pagination'  => $has_pagination,
            'navigation'  => $has_navigation,
            'lg-items'    => $lg_items,
            'md-items'    => $md_items,
            'sm-items'    => $sm_items,
            'xs-items'    => $xs_items,
            );

        if ( 'content-image' == $type ) {
            $classes[] = 'is-content-type';
            if ( 'above' == $position ) {
                $classes[] = 'content-above';
                $view = $this->get_view( 'content-above' );
            } else {
                $classes[] = 'content-beside';
                $view = $this->get_view( 'content-beside' );
            }
        } else {
            $classes[] = 'is-image-type';
            $view = $this->get_view( 'image' );
        }

        ob_start();
        if ( file_exists( $view ) ) {
            include( $view );
        }
        return ob_get_clean();
    }

}

new Massive_Carousel;
