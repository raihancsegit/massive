<?php
/**
 * Static image widget.
 *
 * @package Massive
 * 
 * @author ThemeBucket <themebucket@gmail.com>
 */

class Massive_Image_Uploader extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'massive_image_uploader',
            esc_html__( 'Massive Image', 'massive' ),
            array(
                'description' => esc_html__( 'Add a single image to sidebar.', 'massive' )
                )
        );
        add_action( 'admin_enqueue_scripts', array($this,'enqueue_scripts') );
    }

    public function widget($args, $instance) {
        extract( $args );
        $title = apply_filters( 'widget_title', $instance['title'] );
        $display_image = false;
        if ( $instance['image'] ) {
            $display_image = true;
            $image_src = wp_get_attachment_image_src( $instance['image'], 'full' );
        }

        echo $before_widget;

        ?>
        <?php if ( $title ) echo $before_title . $title . $after_title; ?>
        <figure class="widget-img-wrapper">
            <?php if($display_image){?>
                <?php if ( $instance['url'] ) { ?>
                    <a <?php echo $instance['new_window'] ? 'target="_blank"' : ''; ?> href='<?php echo esc_url( $instance['url'] );?>'>
                        <img alt="<?php echo esc_attr( $title ); ?>" title="<?php echo esc_attr( $title ); ?>" src="<?php echo esc_url( $image_src[0] ); ?>" />
                    </a>
                <?php } else { ?>
                    <img alt="<?php echo esc_attr( $title ); ?>" title="<?php echo esc_attr( $title ); ?>" src="<?php echo esc_url( $image_src[0] ); ?>" />
                <?php } ?>
            <?php } ?>
        </figure>

        <?php
        echo $after_widget;
    }

    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['image'] = strip_tags( $new_instance['image'] );
        $instance['url'] = strip_tags( $new_instance['url'] );
        $instance['new_window'] = absint( $new_instance['new_window'] );

        return $instance;
    }

    public function form($instance) {
        if (isset($instance['title'])) {
            $title = $instance['title'];
        } else {
            $title = esc_html__( 'Massive Image Widget', 'massive' );
        }

        if(!isset($instance['url'])) $instance['url'] = "";
        if(!isset($instance['image'])) $instance['image'] = "";
        if(!isset($instance['new_window'])) $instance['new_window'] = 0;

        $button_text = esc_html__( 'Add Image', 'massive' );
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e('Title:', 'massive' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
                   name="<?php echo $this->get_field_name('title'); ?>" type="text"
                   value="<?php echo esc_attr($title); ?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('image'); ?>"><?php esc_html_e('Image:', 'massive' ); ?></label>
            <p class="imgpreview">
                <?php
                if ( $instance['image'] ) {
                    $image = wp_get_attachment_image_src( $instance['image'], 'thumbnail' );
                    printf( '<img src="%s">', esc_url( $image[0] ) );
                    $button_text = esc_html__( 'Change Image', 'massive' );
                }
                ?>
            </p>
            <input type="hidden" id="<?php echo $this->get_field_id('image'); ?>" name="<?php echo $this->get_field_name('image'); ?>"  value="<?php echo esc_attr( $instance['image'] ); ?>" class="imgph" />
            <input type="button" class="button button-secondary widgetuploader" value="<?php echo esc_attr( $button_text ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('url'); ?>"><?php esc_html_e( 'Target URL:', 'massive' ); ?></label>
            <input class="widefat" type="text" id="<?php echo $this->get_field_id('url'); ?>" name="<?php echo $this->get_field_name('url'); ?>" value="<?php echo  esc_url( $instance['url'] ); ?>" />
        </p>
        <p>
            <input class="widefat" type="checkbox" id="<?php echo $this->get_field_id('new_window'); ?>" name="<?php echo $this->get_field_name('new_window'); ?>" value="1" <?php checked( $instance['new_window'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id('new_window'); ?>"><?php esc_html_e( 'Open In New Window', 'massive' ); ?></label>
        </p>
    <?php
    }

    public function enqueue_scripts( $hook ) {
        if ( $hook === 'widgets.php' ) {
            wp_enqueue_media();
            wp_enqueue_script(
                'Massive-image-uploader',
                get_template_directory_uri() . '/assets/admin/js/image-uploader.js',
                array('jquery'),
                '1.0.0',
                true
                );
        }
    }

}

add_action( 'widgets_init', create_function( '', 'register_widget("Massive_Image_Uploader");' ) );
