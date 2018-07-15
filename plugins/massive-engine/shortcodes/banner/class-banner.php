<?php
/**
 * Massive banner shortcode
 *
 * @package Massive Engine
 * @author ThemeBucket <themebucket@gmail.com>
 */

class Massive_Banner extends Massive_Shortcode {

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
            'name'                    => esc_html__( 'Banner', 'massive-engine' ),
            'base'                    => $this->get_tag(),
            'category'                => esc_html__( 'Massive', 'massive-engine' ),
            'icon'                    => $this->get_icon('banner'),
            'show_settings_on_create' => true,
            'params'                  => array(
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Banner Name', 'massive-engine' ),
                    'description' => mengine_esc_desc( __( 'Select a banner from the dropdown list or create a banner by going to this link %s', 'massive-engine' ),
                        array(
                            '<a href="'. esc_url( admin_url( 'post-new.php?post_type=banner' ) ). '" target="_blank">Create Banner</a>',
                        )
                    ),
                    'param_name'  => 'banner',
                    'admin_label' => true,
                    'value'       => massive_get_banners()
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
            'banner' => 0,
            );

        $uid       = $this->get_uid( $atts ); //this line must be here after $defaults, before calling shortcode_atts
        $atts      = shortcode_atts( $defaults, $atts );
        $banner_id = absint( $atts['banner'] );
        $type_meta = get_post_meta( $banner_id, '_massive_banner_type', true );
        $type      = massive_get_default_param( $type_meta, 'type', 'static' );
        $data      = get_post_meta( $banner_id, "_massive_banner_{$type}", true );

        $view = $this->get_view( $type );

        ob_start();
        if ( file_exists( $view ) ) {
            include( $view );
        }
        return ob_get_clean();
    }
    
}

new Massive_Banner;
