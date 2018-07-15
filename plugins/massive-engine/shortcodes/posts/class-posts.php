<?php
/**
 * Massive posts shortcode
 *
 * @package Massive Engine
 * @author ThemeBucket <themebucket@gmail.com>
 */

class Massive_Posts extends Massive_Shortcode {

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
            'name'     => esc_html__( 'Blog Posts', 'massive-engine' ),
            'base'     => $this->get_tag(),
            'category' => esc_html__( 'Massive', 'massive-engine' ),
            'icon'     => $this->get_icon('blog-post'),
            'params'   => array(
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Post Style', 'massive-engine' ),
                    'param_name'  => 'type',
                    'description' => esc_html__( 'Chose massive blgo post style', 'massive-engine' ),
                    'admin_label' => true,
                    'value'       => array(
                        esc_html__( 'Style 1', 'massive-engine' ) => 'one',
                        esc_html__( 'Style 2', 'massive-engine' ) => 'two',
                        esc_html__( 'Style 3', 'massive-engine' ) => 'three',
                        esc_html__( 'Style 4', 'massive-engine' ) => 'four',
                        esc_html__( 'Style 5', 'massive-engine' ) => 'five'
                        ),
                    ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Number of posts', 'massive-engine' ),
                    'description' => esc_html__( 'Enter number of posts to display.', 'massive-engine' ),
                    'param_name'  => 'number',
                    'value'       => 3,
                    'admin_label' => true
                    ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Image Size', 'massive-engine' ),
                    'param_name'  => 'image_size',
                    'std'         => 'medium',
                    'value'       => massive_get_image_sizes(true),
                    'description' => esc_html__( 'Select a suitable image size from dropdown. Default is "Medium".', 'massive-engine' )
                    ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Excerpt Length', 'massive-engine' ),
                    'param_name'  => 'excerpt_length',
                    'value'       => 25,
                    'description' => esc_html__( 'Enter the post excerpt length', 'massive-engine' )
                    ),
                array(
                    'type'       => 'dropdown',
                    'heading'    => esc_html__( 'Status', 'massive-engine' ),
                    'param_name' => 'status',
                    'value'      => array(
                        esc_html__( 'Publish', 'massive-engine' )    => 'publish',
                        esc_html__( 'Future', 'massive-engine' )     => 'future',
                        esc_html__( 'Draft', 'massive-engine' )      => 'draft',
                        esc_html__( 'Pending', 'massive-engine' )    => 'pending',
                        esc_html__( 'Private', 'massive-engine' )    => 'private',
                        esc_html__( 'Trash', 'massive-engine' )      => 'trash',
                        esc_html__( 'Auto Draft', 'massive-engine' ) => 'auto-draft',
                    ),
                    'description' => mengine_esc_desc( __( 'Select posts status. More at %s.', 'massive-engine' ),
                        array('<a href="http://codex.wordpress.org/Post_Status" target="_blank">WordPress codex page</a>') )
                    ),
                array(
                    'type'        => 'exploded_textarea',
                    'heading'     => esc_html__( 'Categories', 'massive-engine' ),
                    'param_name'  => 'categories',
                    'description' => esc_html__( 'Enter categories by names to narrow output (Note: only listed categories will be displayed, divide categories with linebreak (Enter)).', 'massive-engine' )
                    ),
                array(
                    'type'       => 'dropdown',
                    'heading'    => esc_html__( 'Order by', 'massive-engine' ),
                    'param_name' => 'orderby',
                    'value'      => array(
                        esc_html__( 'Date', 'massive-engine' )          => 'date',
                        esc_html__( 'ID', 'massive-engine' )            => 'ID',
                        esc_html__( 'Author', 'massive-engine' )        => 'author',
                        esc_html__( 'Title', 'massive-engine' )         => 'title',
                        esc_html__( 'Modified', 'massive-engine' )      => 'modified',
                        esc_html__( 'Random', 'massive-engine' )        => 'rand',
                        esc_html__( 'Comment count', 'massive-engine' ) => 'comment_count',
                        esc_html__( 'Menu order', 'massive-engine' )    => 'menu_order'
                    ),
                    'description' => mengine_esc_desc( __( 'Select how to sort retrieved posts. More at %s.', 'massive-engine' ),
                        array( '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ) )
                    ),
                array(
                    'type'       => 'dropdown',
                    'heading'    => esc_html__( 'Sort order', 'massive-engine' ),
                    'param_name' => 'order',
                    'value'      => array(
                        esc_html__( 'Descending', 'massive-engine' ) => 'DESC',
                        esc_html__( 'Ascending', 'massive-engine' )  => 'ASC'
                    ),
                    'description' => mengine_esc_desc( __( 'Select ascending or descending order. More at %s.', 'massive-engine' ), array( '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ) )
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
            'type'           => 'one',
            'number'         => 3,
            'status'         => 'publish',
            'image_size'     => 'medium',
            'excerpt_length' => 25,
            'categories'     => '',
            'orderby'        => 'date',
            'order'          => 'DESC',
            'uid'            => '',
        );

        $uid         = $this->get_uid( $atts );
        $atts        = shortcode_atts( $defaults, $atts );
        $atts['uid'] = $uid;
        $type        = massive_sanitize_param( $atts['type'] );
        $types       = array('one', 'two', 'three', 'four', 'five', 'six');

        $view = $this->get_view( $type );

        ob_start();
        if ( in_array( $type, $types ) && file_exists( $view ) ) {
            include( $view );
        }
        return ob_get_clean();
    }

}

new Massive_Posts;
