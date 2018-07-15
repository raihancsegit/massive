<?php
/**
 * Gallery widget.
 *
 * @package Massive
 * @author ThemeBucket <themebucket@gmail.com>
 */

class Massive_Gallery_Uploader extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'massive_gallery_uploader',
            esc_html__( 'Massive Gallery', 'massive' ),
            array(
                'description' => esc_html__( 'Add an image gallery to sidebar.', 'massive' )
                )
        );

        add_action( 'admin_enqueue_scripts', array($this, 'enqueue_scripts') );
        add_action( 'admin_head', array($this, 'add_styles') );
    }

    public function widget($args, $instance) {
        extract( $args );
        $title = apply_filters( 'widget_title', $instance['title'] );
        $images = $instance['images'];
        $ids = explode( ',', $images );

        echo $before_widget;

        if ( !empty($ids) ) {
            if ( $title ) echo $before_title . $title . $after_title;
            echo '<ul class="Massive-gallery-imgs clearfix">';
                foreach ( $ids as $id ) {
                    $thumbnail = wp_get_attachment_image_src( $id, 'thumbnail' );
                    $full = wp_get_attachment_image_src( $id, 'full' );
                    printf( '<li><img class="Massive-gallery-img" src="%s" data-mfp-src="%s"></li>',
                        esc_url( $thumbnail[0] ),
                        esc_url( $full[0] )
                        );
                }
            echo '</ul>';
        }

        echo $after_widget;
    }

    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['images'] = strip_tags( $new_instance['images'] );
        return $instance;
    }

    public function form($instance) {
        if (isset($instance['title'])) {
            $title = $instance['title'];
        } else {
            $title = esc_html__( 'Massive Gallery Widget', 'massive' );
        }

        if ( !isset( $instance['images'] ) ) $instance['images'] = "";
        $state = 'add';
        $btn_label = esc_html__( 'Add Gallery', 'massive' );
        if ( ! empty( $instance['images'] ) ) {
            $state = 'edit';
            $btn_label = esc_html__( 'Update Gallery', 'massive' );
        }
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e( 'Title:', 'massive' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
                   name="<?php echo $this->get_field_name('title'); ?>" type="text"
                   value="<?php echo esc_attr($title); ?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('images'); ?>"><?php esc_html_e( 'Gallery Images:', 'massive' ); ?></label>
            <ul class="preview-gallery">
                <?php
                    if ( 'edit' === $state ) {
                        $imgs = explode( ',', $instance['images'] );
                        foreach ( $imgs as $id ) {
                            $img = wp_get_attachment_image_src( $id, 'thumbnail' );
                            printf( '<li><img src="%s"></li>', esc_url( $img[0] ) );
                        }
                    }
                ?>
            </ul>
            <input type="hidden" class="field-gallery-imgs" id="<?php echo $this->get_field_id('images'); ?>" name="<?php echo $this->get_field_name('images'); ?>"  value="<?php echo esc_attr( $instance['images'] ); ?>" />
            <input type="button" data-state="<?php echo esc_attr( $state ); ?>" class="button button-secondary gallery-uploader" value="<?php echo $btn_label; ?>" />
        </p>
    <?php
    }

    public function enqueue_scripts($hook){
        if ( $hook === 'widgets.php' ) {
            wp_enqueue_media();
            wp_enqueue_script(
                'Massive-gallery-uploader',
                get_template_directory_uri() . '/assets/admin/js/gallery-uploader.js',
                array('jquery'),
                '1.0.0',
                true
                );
        }
    }

    public function add_styles() {
        ?>
        <style>
            .preview-gallery {
                overflow: hidden;
                margin: 0 -3px 10px;
            }
            .preview-gallery li {
                width: 33.3333%;
                overflow: hidden;
                padding: 3px;
                float: left;
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
                box-sizing: border-box;
                margin: 0;
            }
            .preview-gallery img {
                max-width: 100%;
                height: auto;
                display: block;
                border: 1px solid #dcdcdc;
                padding: 5px;
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
                box-sizing: border-box;
                border-radius: 2px;
            }
        </style>
        <?php
    }

}

add_action( 'widgets_init', create_function( '', 'register_widget("Massive_Gallery_Uploader");' ) );
