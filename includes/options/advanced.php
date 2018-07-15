<?php

$massive_options[] = array(
    'name'     => 'massive-advanced',
    'title'    => esc_html__( 'Factory', 'massive' ),
    'icon'     => 'fa fa-cog',
    'sections' => array(
        array(
            'name'   => 'massive-custom-sidebars',
            'title'  => esc_html__( 'Sidebar', 'massive' ),
            'icon'   => 'fa fa-ellipsis-v',
            'fields' => array(
                 array(
                    'id'              => 'massive_sidebars',
                    'type'            => 'group',
                    'title'           => esc_html__( 'Sidebar', 'massive' ),
                    'desc'            => massive_esc_desc( __( 'Create unlimited sidebars and assign widgets to these sidebars from %s', 'massive' ), array('<a href="'.esc_url( admin_url('widgets.php') ).'">Widgets</a>') ),
                    'button_title'    => esc_html__( 'Add Sidebar', 'massive' ),
                    'accordion_title' => esc_html__( 'Sidebar', 'massive' ),
                    'fields'          => array(
                        array(
                            'id'    => 'name',
                            'type'  => 'text',
                            'title' => esc_html__( 'Sidebar Name', 'massive' ),
                            'desc'  => esc_html__( 'Add a convenient name for this sidebar (required).', 'massive' )
                            ),
                        )
                    )
                )
            ),
        array(
            'name'   => 'massive-custom-image-sizes',
            'title'  => esc_html__( 'Image Size', 'massive' ),
            'icon'   => 'fa fa-crop',
            'fields' => array(
                 array(
                    'id'              => 'massive_image_sizes',
                    'type'            => 'group',
                    'title'           => esc_html__( 'Image Sizes', 'massive' ),
                    'desc'            => massive_esc_desc( __( 'Add as many image sizes as you want. Just make sure to regenerate images using any image regenerator plugin after adding a new image size. We recommend to use %s', 'massive' ), array('<a href="https://wordpress.org/plugins/regenerate-thumbnails/" target="_blank">Regenerate Thumbnails</a>') ),
                    'button_title'    => esc_html__( 'Add New Size', 'massive' ),
                    'accordion_title' => esc_html__( 'Image Size', 'massive' ),
                    'fields'          => array(
                        array(
                            'id'    => 'name',
                            'type'  => 'text',
                            'title' => esc_html__( 'Name', 'massive' ),
                            'desc'  => esc_html__( 'Add a convenient name for this image size (required).', 'massive' )
                            ),
                        array(
                            'id'    => 'width',
                            'type'  => 'text',
                            'title' => esc_html__( 'Width', 'massive' ),
                            'desc'  => esc_html__( 'Add custom image width.', 'massive' )
                            ),
                        array(
                            'id'    => 'height',
                            'type'  => 'text',
                            'title' => esc_html__( 'Height', 'massive' ),
                            'desc'  => esc_html__( 'Add custom image height.', 'massive' )
                            ),
                        array(
                            'id'      => 'cropping',
                            'type'    => 'select',
                            'title'   => esc_html__( 'Cropping', 'massive' ),
                            'desc'    => esc_html__( 'Select image cropping type between hard & soft.', 'massive' ),
                            'default' => 'soft',
                            'options' => array(
                                'soft' => esc_html__( 'Soft Cropping', 'massive' ),
                                'hard' => esc_html__( 'Hard Cropping', 'massive' ),
                                )
                            ),
                        )
                    )
                )
            ),
        )
    );
