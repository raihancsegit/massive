<?php
/**
 * Massive team shortcode
 *
 * @package Massive Engine
 * @author ThemeBucket <themebucket@gmail.com>
 */

class Massive_Team extends Massive_Shortcode {

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
        $uid = $this->get_uid( $params );
        $css = array();

        $photo_style = massive_get_default_param( $params, 'photo_style' );
        $border_size = massive_get_default_param( $params, 'border_size' );
        $border_color = massive_get_default_param( $params, 'border_color' );

        if ( ! empty( $photo_style ) || 'simple' === $photo_style ) {
            $css[$uid . ' .team-img']['border-radius'] = '50%';
        }

        if ( ! empty( $border_size ) ) {
            $css[$uid . ' .team-img']['border-width'] = massive_check_css_unit( $border_size );
            $css[$uid . ' .team-img']['border-color'] = $border_color;
            $css[$uid . ' .team-img']['border-style'] = 'solid';
            $css[$uid . ' .team-img']['overflow'] = 'hidden';
        }

        return $css;
    }

    /**
     * Map this shortcode with visual composer
     * @return array
     */
    protected function map() {
        return array(
            'name'                    => esc_html__( 'Team Member', 'massive-engine' ),
            'base'                    => $this->get_tag(),
            'category'                => esc_html__( 'Massive', 'massive-engine' ),
            'icon'                    => $this->get_icon('team'),
            'show_settings_on_create' => true,
            'params'                  => array(
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Style', 'massive-engine' ),
                    'param_name'  => 'style',
                    'admin_label' => true,
                    'value'       => array(
                        esc_html__( 'Style One', 'massive-engine' )   => 'one',
                        esc_html__( 'Style Two', 'massive-engine' )   => 'two',
                        esc_html__( 'Style Three', 'massive-engine' ) => 'three',
                        esc_html__( 'Style Four', 'massive-engine' )  => 'four',
                        esc_html__( 'Style Five', 'massive-engine' )  => 'five',
                        ),
                    ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Name', 'massive-engine' ),
                    'param_name'  => 'name',
                    'admin_label' => true,
                    'value'       => esc_html__( 'Member Name', 'massive-engine' )
                    ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Job Title', 'massive-engine' ),
                    'param_name'  => 'job_title',
                    'value'       => '',
                    ),
                array(
                    'type'        => 'attach_image',
                    'heading'     => esc_html__( 'Photo', 'massive-engine' ),
                    'param_name'  => 'photo',
                    ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Photo Style', 'massive-engine' ),
                    'param_name'  => 'photo_style',
                    'value'       => array(
                        esc_html__( 'Simple', 'massive-engine' )  => 'simple',
                        esc_html__( 'Circle', 'massive-engine' )  => 'circle',
                        esc_html__( 'Circle Border', 'massive-engine' )  => 'circle_border',
                        ),
                    ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Border Size', 'massive-engine' ),
                    'param_name'  => 'border_size',
                    'save_always' => true,
                    'dependency'  => array(
                        'element' => 'photo_style',
                        'value'   => 'circle_border',
                        ),
                    'value'       => array(
                        esc_html__( 'None', 'massive-engine' ) => '',
                        '3'  => '3px',
                        '5'  => '5px',
                        '10' => '10px',
                        '15' => '15px',
                        '20' => '20px',
                        ),
                    ),
                array(
                    'type'       => 'colorpicker',
                    'heading'    => esc_html__( 'Border Color', 'massive-engine' ),
                    'param_name' => 'border_color',
                    'dependency' => array(
                        'element' => 'border_size',
                        'not_empty' => true,
                        ),
                    ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Title', 'massive-engine' ),
                    'param_name'  => 'title',
                    'value'       => '',
                    'dependency'  => array(
                        'element' => 'style',
                        'value'   => array('one','three'),
                        )
                    ),
                array(
                    'type'        => 'textarea_html',
                    'heading'     => esc_html__( 'Description', 'massive-engine' ),
                    'param_name'  => 'content',
                    'dependency'  => array(
                        'element' => 'style',
                        'value'   => array('one','three', 'four'),
                        )
                    ),

                // social links
                array(
                    'type'       => 'textfield',
                    'heading'    => esc_html__( 'Facebook', 'massive-engine' ),
                    'param_name' => 'facebook',
                    'group'      => esc_html__( 'Social Links', 'massive-engine' ),
                    ),
                array(
                    'type'       => 'textfield',
                    'heading'    => esc_html__( 'Twitter', 'massive-engine' ),
                    'param_name' => 'twitter',
                    'group'      => esc_html__( 'Social Links', 'massive-engine' ),
                    ),
                array(
                    'type'       => 'textfield',
                    'heading'    => esc_html__( 'Google+', 'massive-engine' ),
                    'param_name' => 'googleplus',
                    'group'      => esc_html__( 'Social Links', 'massive-engine' ),
                    ),
                array(
                    'type'       => 'textfield',
                    'heading'    => esc_html__( 'LinkedIn', 'massive-engine' ),
                    'param_name' => 'linkedin',
                    'group'      => esc_html__( 'Social Links', 'massive-engine' ),
                    ),
                array(
                    'type'       => 'textfield',
                    'heading'    => esc_html__( 'Dribbble', 'massive-engine' ),
                    'param_name' => 'dribbble',
                    'group'      => esc_html__( 'Social Links', 'massive-engine' ),
                    ),
                array(
                    'type'       => 'textfield',
                    'heading'    => esc_html__( 'Github', 'massive-engine' ),
                    'param_name' => 'github',
                    'group'      => esc_html__( 'Social Links', 'massive-engine' ),
                    ),
                array(
                    'type'       => 'textfield',
                    'heading'    => esc_html__( 'Flickr', 'massive-engine' ),
                    'param_name' => 'flickr',
                    'group'      => esc_html__( 'Social Links', 'massive-engine' ),
                    ),
                array(
                    'type'       => 'textfield',
                    'heading'    => esc_html__( 'Sound Cloud', 'massive-engine' ),
                    'param_name' => 'soundcloud',
                    'group'      => esc_html__( 'Social Links', 'massive-engine' ),
                    ),
                array(
                    'type'       => 'textfield',
                    'heading'    => esc_html__( 'Behance', 'massive-engine' ),
                    'param_name' => 'behance',
                    'group'      => esc_html__( 'Social Links', 'massive-engine' ),
                    ),
                array(
                    'type'       => 'textfield',
                    'heading'    => esc_html__( 'Deviant Art', 'massive-engine' ),
                    'param_name' => 'deviantart',
                    'group'      => esc_html__( 'Social Links', 'massive-engine' ),
                    ),
                array(
                    'type'       => 'textfield',
                    'heading'    => esc_html__( 'Youtube', 'massive-engine' ),
                    'param_name' => 'youtube',
                    'group'      => esc_html__( 'Social Links', 'massive-engine' ),
                    ),
                array(
                    'type'       => 'textfield',
                    'heading'    => esc_html__( 'Skype', 'massive-engine' ),
                    'param_name' => 'skype',
                    'group'      => esc_html__( 'Social Links', 'massive-engine' ),
                    ),
                array(
                    'type'       => 'textfield',
                    'heading'    => esc_html__( 'Pinterest', 'massive-engine' ),
                    'param_name' => 'pinterest',
                    'group'      => esc_html__( 'Social Links', 'massive-engine' ),
                    ),
                array(
                    'type'       => 'textfield',
                    'heading'    => esc_html__( 'Instagram', 'massive-engine' ),
                    'param_name' => 'instagram',
                    'group'      => esc_html__( 'Social Links', 'massive-engine' ),
                    ),
                array(
                    'type'       => 'textfield',
                    'heading'    => esc_html__( 'Stack Overflow', 'massive-engine' ),
                    'param_name' => 'stackoverflow',
                    'group'      => esc_html__( 'Social Links', 'massive-engine' ),
                    ),
                array(
                    'type'       => 'textfield',
                    'heading'    => esc_html__( 'Web Site', 'massive-engine' ),
                    'param_name' => 'web',
                    'group'      => esc_html__( 'Social Links', 'massive-engine' ),
                    ),
                array(
                    'type'       => 'textfield',
                    'heading'    => esc_html__( 'Email', 'massive-engine' ),
                    'param_name' => 'email',
                    'group'      => esc_html__( 'Social Links', 'massive-engine' ),
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
            'style'         => 'one',
            'name'          => esc_html__( 'Member Name', 'massive-engine' ),
            'job_title'     => '',
            'photo'         => '',
            'photo_style'   => '',
            'border_size'   => '',
            'border_color'  => '',
            'size'          => 'massive-sm-hard',
            'title'         => '',
            // social links
            'facebook'      => '',
            'twitter'       => '',
            'googleplus'    => '',
            'linkedin'      => '',
            'dribbble'      => '',
            'github'        => '',
            'flickr'        => '',
            'soundcloud'    => '',
            'behance'       => '',
            'deviantart'    => '',
            'youtube'       => '',
            'vimeo'         => '',
            'skype'         => '',
            'pinterest'     => '',
            'instagram'     => '',
            'stackoverflow' => '',
            'web'           => '',
            'email'         => '',
            );

        $uid         = $this->get_uid( $atts ); //this line must be here after $defaults, before calling shortcode_atts
        $atts        = shortcode_atts( $defaults, $atts );
        $atts['uid'] = $uid;
        $style       = massive_sanitize_param( $atts['style'] );
        $photo       = wp_get_attachment_image_src( absint( $atts['photo'] ),  $atts['size'] );

        $social_links = array(
            'facebook'      => 'facebook',
            'twitter'       => 'twitter',
            'googleplus'    => 'google-plus',
            'linkedin'      => 'linkedin',
            'dribbble'      => 'dribbble',
            'github'        => 'github',
            'flickr'        => 'flickr',
            'soundcloud'    => 'soundcloud',
            'behance'       => 'behance',
            'deviantart'    => 'deviantart',
            'youtube'       => 'youtube',
            'skype'         => 'skype',
            'pinterest'     => 'pinterest',
            'instagram'     => 'instagram',
            'stackoverflow' => 'stack-overflow',
            'web'           => 'globe',
            'email'         => 'envelope-o',
            );

        $view = $this->get_view( $style );

        ob_start();
        if ( in_array( $style, array('one','two','three','four','five') ) && file_exists( $view ) ) {
            include( $view );
        }
        return ob_get_clean();
    }

}

new Massive_Team;
