<?php
/**
 * Massive heading shortcode
 *
 * @package Massive Engine
 * @author ThemeBucket <themebucket@gmail.com>
 */

class Massive_Heading extends Massive_Shortcode {

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
        $tree            = array();
        $type            = massive_get_default_param( $params, 'type', 'one' );
        $tcolor          = massive_get_default_param( $params, 'tcolor', '#222' );
        $tsize           = massive_get_default_param( $params, 'tsize', '36px' );
        $st_letter_space = massive_get_default_param( $params, 'st_letter_space', '0px' );
        $tcsize          = massive_get_default_param( $params, 'custom_tsize', '24px' );
        $stcolor         = massive_get_default_param( $params, 'stcolor', '#7e7e7e' );
        $spcolor         = massive_get_default_param( $params, 'spcolor', '#7e7e7e' );
        $bcolor          = massive_get_default_param( $params, 'bcolor', 'transparent' );
        $style_four_bg   = massive_get_default_param( $params, 'style_four_bg', '' );
        $custom_tcolor   = massive_get_default_param( $params, 'custom_tcolor', '#7e7e7e' );
        $custom_stcolor  = massive_get_default_param( $params, 'custom_stcolor', '#7e7e7e' );

        $uid             = $this->get_uid( $params );
        $title_id        = $uid . ' h2';
        $ttle_cst_clr    = $uid . ' .ct-color';
        $subtitle_id     = $uid . ' span';
        $sbtitle_cst_clr = $uid . ' .cst-color';
        $style_two       = $uid . ' div.heading-border-bottom';
        $style_three     = $uid . ' div.title-border';
        $style_four      = $uid . ' .ctitle-border';
        $style_five      = $uid . ' .heading-five:after';


        $tree[$subtitle_id] = array(
                'letter-spacing' => massive_check_css_unit( $st_letter_space ) . ' !important',
            );
        $tree[$ttle_cst_clr] = array(
                'color' => $custom_tcolor . ' !important',
            );
        $tree[$sbtitle_cst_clr] = array(
                'color' => $custom_stcolor . ' !important',
            );

        if ( 'ts_c' == $tsize ) {
            $tree[$title_id] = array(
                'font-size' => massive_check_css_unit( $tcsize ) . ' !important',
            );
        }

        $tree[$style_two] = array(
                'border-bottom' =>'1px solid ' . $spcolor .  ' !important',
            );

        $tree[$style_three] = array(
                'border-bottom' => '1px solid ' . $spcolor . ' !important',
            );

        $tree[$style_four] = array(
                'border'           => '1px solid ' . $bcolor . ' !important',
                'background-color' => $style_four_bg,
            );

        $tree[$style_five] = array(
                'background' => $spcolor . ' !important',
            );

        return $tree;
    }

    /**
     * Map this shortcode with visual composer
     * @return array
     */
    protected function map() {
        return array(
            'name'     => esc_html__( 'Heading', 'massive-engine' ),
            'base'     => $this->get_tag(),
            'category' => esc_html__( 'Massive', 'massive-engine' ),
            'icon'     => $this->get_icon('heading'),
            'params'   => array(
                array(
                    'type'        => 'gdropdown',
                    'heading'     => esc_html__( 'Heading Style', 'massive-engine' ),
                    'param_name'  => 'type',
                    'description' => esc_html__( 'Select a heading style from dropdown.', 'massive-engine' ),
                    'options'     => array(
                        esc_html__( 'General Style', 'massive-engine' ) => array(
                            esc_html__( 'Default'  , 'massive-engine' ) => 'one',
                            ),
                        esc_html__( 'Border Style', 'massive-engine' ) => array(
                            esc_html__( 'Border Bottom', 'massive-engine' )        => 'two',
                            esc_html__( 'Border Bottom (Tiny)', 'massive-engine' ) => 'five',
                            esc_html__( 'Border Right', 'massive-engine' )         => 'three',
                            esc_html__( 'Border Around', 'massive-engine' )        => 'four',
                            ),
                        ),
                    ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Title', 'massive-engine' ),
                    'param_name'  => 'ttext',
                    'admin_label' => true,
                    'description' => esc_html__( 'Write heading title text', 'massive-engine' ),
                    'value'       => esc_html__( 'SOME HEADING TEXT', 'massive-engine'),
                    ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Title Color', 'massive-engine' ),
                    'param_name'  => 'tcolor',
                    'description' => esc_html__( 'Pick heading title color', 'massive-engine' ),
                    'value'       => array(
                            esc_html__( 'Black' , 'massive-engine' ) => 'black',
                            esc_html__( 'White' , 'massive-engine' ) => 'white',
                            esc_html__( 'Theme' , 'massive-engine' ) => 'theme_color',
                            esc_html__( 'Custom', 'massive-engine' ) => 'ctcolor'
                        ),
                    ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__( 'Custom Title Color', 'massive-engine' ),
                    'description' => esc_html__( 'Pick custom heading title color', 'massive-engine' ),
                    'param_name'  => 'custom_tcolor',
                    'value'       => '#222',
                    'dependency'  => array(
                        'element' => 'tcolor',
                        'value'   => 'ctcolor',
                        ),
                    ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Title Size', 'massive-engine' ),
                    'description' => esc_html__( 'Set heading title font size', 'massive-engine' ),
                    'param_name'  => 'tsize',
                    'value'       => array(
                            esc_html__( 'Extra Large', 'massive-engine' ) => '36px',
                            esc_html__( 'Large'      , 'massive-engine' ) => '30px',
                            esc_html__( 'Medium'     , 'massive-engine' ) => '24px',
                            esc_html__( 'Small'      , 'massive-engine' ) => '18px',
                            esc_html__( 'Extra Small', 'massive-engine' ) => '14px',
                            esc_html__( 'Mini'       , 'massive-engine' ) => '12px',
                            esc_html__( 'Custom'     , 'massive-engine' ) => 'ts_c'
                        )
                    ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Custom Title Size', 'massive-engine' ),
                    'description' => esc_html__( 'Set heading title custom size', 'massive-engine' ),
                    'param_name'  => 'custom_tsize',
                    'value'       => '24px',
                    'dependency'  => array(
                        'element' => 'tsize',
                        'value'   => 'ts_c',
                        ),
                    ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Subtitle', 'massive-engine' ),
                    'param_name'  => 'sttext',
                    'description' => esc_html__( 'Insert heading subtitle text', 'massive-engine' ),
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => array(
                                'one',
                                'four',
                                'five'
                            )
                        ),
                    ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Subtitle Color', 'massive-engine' ),
                    'param_name'  => 'stcolor',
                    'description' => esc_html__( 'Pick heading subtitle color', 'massive-engine' ),
                    'value'       => array(
                            esc_html__( 'Black' , 'massive-engine' ) => 'black',
                            esc_html__( 'White' , 'massive-engine' ) => 'white',
                            esc_html__( 'Theme' , 'massive-engine' ) => 'theme_color',
                            esc_html__( 'Custom', 'massive-engine' ) => 'cstcolor'
                        ),
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => array(
                                'one',
                                'four',
                                'five'
                            )
                        ),
                    ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__( 'Custom Subtitle Color', 'massive-engine' ),
                    'description' => esc_html__( 'Pick custom heading subtitle color', 'massive-engine' ),
                    'param_name'  => 'custom_stcolor',
                    'value'       => '#7e7e7e',
                    'dependency'  => array(
                        'element' => 'stcolor',
                        'value'   => 'cstcolor',
                        ),
                    ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Subtitle Position', 'massive-engine' ),
                    'description' => esc_html__( 'Set subtitle position', 'massive-engine' ),
                    'param_name'  => 'stposition',
                    'value'       => array(
                            esc_html__( 'Before Title', 'massive-engine' ) => 'before',
                            esc_html__( 'After Title' , 'massive-engine' ) => 'after'
                        ),
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => 'one',
                        ),
                    ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Heading Alignment', 'massive-engine' ),
                    'description' => esc_html__( 'Set heading alignment', 'massive-engine' ),
                    'param_name'  => 'alignment',
                    'value'       => array(
                            esc_html__( 'Center', 'massive-engine' ) => 'text-center',
                            esc_html__( 'Left'  , 'massive-engine' ) => 'text-left',
                            esc_html__( 'Right' , 'massive-engine' ) => 'text-right',
                        ),
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => array( 'one', 'two', 'four', 'five' )
                        ),
                    ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Subtitle Letter Spacing', 'massive-engine' ),
                    'description' => esc_html__( 'Chose subtitle letter spacing', 'massive-engine' ),
                    'param_name'  => 'st_letter_space',
                    'std'         => '0',
                    'value'       => array(
                            esc_html__( '0px' , 'massive-engine' )  => '0',
                            esc_html__( '1px' , 'massive-engine' )  => '1',
                            esc_html__( '2px' , 'massive-engine' )  => '2',
                            esc_html__( '3px' , 'massive-engine' )  => '3',
                            esc_html__( '4px' , 'massive-engine' )  => '4',
                            esc_html__( '5px' , 'massive-engine' )  => '5',
                        ),
                    'save_always' => true,
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => array(
                                'one',
                                'four',
                                'five'
                            )
                        ),
                    ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__( 'Separator Color', 'massive-engine' ),
                    'description' => esc_html__( 'Set separator color', 'massive-engine' ),
                    'param_name'  => 'spcolor',
                    'value'       => '#7e7e7e',
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => array(
                                'two',
                                'three',
                                'five'
                            )
                        ),
                    ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__( 'Title Background Color', 'massive-engine' ),
                    'description' => esc_html__( 'Set title background color', 'massive-engine' ),
                    'param_name'  => 'style_four_bg',
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => 'four'
                        ),
                    ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__( 'Title Border Color', 'massive-engine' ),
                    'description' => esc_html__( 'Set title border color', 'massive-engine' ),
                    'param_name'  => 'bcolor',
                    'value'       => '#222',
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => 'four'
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
            'type'            => 'one',
            'ttext'           => esc_html__( 'HEADING STYLE', 'massive-engine'),
            'tcolor'          => 'black',
            'custom_tcolor'   => '#222',
            'tsize'           => '36px',
            'custom_tsize'    => '24px',
            'sttext'          => '',
            'stcolor'         => 'black',
            'custom_stcolor'  => '#7e7e7e',
            'stposition'      => 'before',
            'alignment'       => 'text-center',
            'st_letter_space' => '0',
            'spcolor'         => '#7e7e7e',
            'bcolor'          => '',
            'style_four_bg'   => '',
            'uid'             => '',
            );

        $uid         = $this->get_uid( $atts ); //this line must be here after $defaults, before calling shortcode_atts
        $atts        = shortcode_atts( $defaults, $atts );
        $atts['uid'] = $uid;
        $type        = trim( strtolower( $atts['type'] ) );
        $types       = array('one', 'two', 'three', 'four', 'five');

        $heading_map = array(
            '36px' => 'h1',
            '30px' => 'h2',
            '24px' => 'h3',
            '18px' => 'h4',
            '14px' => 'h5',
            '12px' => 'h6',
            'ts_c' => 'h2',
            );

        $heading = $heading_map[$atts['tsize']];

        $classes = array();
        $stclasses = array();

        $view = $this->get_view( $type );

        ob_start();
        if ( in_array( $type, $types ) && file_exists( $view ) ) {
            include( $view );
        }
        return ob_get_clean();
    }
    
}

new Massive_Heading;
