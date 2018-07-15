<?php
function massive_portfolio_gallery_metabox( $metabox ) {

    $metabox[]    = array(
        'id'        => '_massive_mb_portfolio',
        'title'     => esc_html__( 'Portfolio Settings', 'massive' ),
        'post_type' => 'portfolio',
        'context'   => 'normal',
        'priority'  => 'default',
        'sections'  => array(
            array(
                'name'   => 'mb_portfolio',
                'title'  => esc_html__( 'Portfolio Gallery', 'massive' ),
                'icon'   => 'icon-basic_picture_multiple',
                'fields' => array(
                    array(
                        'id'    => 'mb_portfolio_gallery',
                        'type'  => 'gallery',
                        'title' => esc_html__( 'Gallery', 'massive' ),
                        'desc'  => esc_html__( 'Add multiple images in this gallery', 'massive' ),
                        )
                    ),
                ),
            array(
                'name'   => 'mb_portfolio_hover',
                'title'  => esc_html__( 'Portfolio Lightbox', 'massive' ),
                'icon'   => 'icon-video',
                'fields' => array(
                    array(
                        'id'      => 'mb_portfolio_hover_view',
                        'type'    => 'radio',
                        'title'   => esc_html__( 'Hover View', 'massive' ),
                        'default' => 'single',
                        'desc'    => esc_html__( 'Select portfolio hover view', 'massive'),
                        'options' => array(
                                'single'   => esc_html__( 'Single View', 'massive'),
                                'lightbox' => esc_html__( 'Lightbox View', 'massive'),
                                'video'    => esc_html__( 'Video Lightbox', 'massive'),
                            )
                        ),
                    array(
                        'id'         => 'mb_portfolio_lightbox_video',
                        'type'       => 'text',
                        'title'      => esc_html__( 'Video Link', 'massive' ),
                        'desc'       => massive_esc_desc( __( 'Add  portfolio lightbox video link, for example %s', 'massive' ), array('<code>https://vimeo.com/45830194</code>') ),
                        'dependency' => array( 'mb_portfolio_hover_view_video', '==', 'true' ),
                        ),
                    ),
                ),
            array(
                'name'   => 'mb_portfolio_meta',
                'title'  => esc_html__( 'Portfolio Meta', 'massive' ),
                'icon'   => 'icon-documents',
                'fields' => array(
                    array(
                        'id'    => 'mb_portfolio_meta_client',
                        'type'  => 'text',
                        'title' => esc_html__( 'Client', 'massive' ),
                        'desc'  => esc_html__( 'Add client name of the portfolio', 'massive' )
                        ),
                    array(
                        'id'    => 'mb_portfolio_meta_author',
                        'type'  => 'text',
                        'title' => esc_html__( 'Author', 'massive' ),
                        'desc'  => esc_html__( 'Add author name of the portfolio', 'massive' )
                        ),
                    array(
                        'id'    => 'mb_portfolio_meta_date',
                        'type'  => 'text',
                        'title' => esc_html__( 'Completion Date ', 'massive' ),
                        'desc'  => esc_html__( 'Add completion date of the portfolio project', 'massive' )
                        ),
                    array(
                        'id'    => 'mb_portfolio_meta_skills',
                        'type'  => 'text',
                        'title' => esc_html__( 'Skills', 'massive' ),
                        'desc'  => esc_html__( 'Add used skills this was used for portfolio project', 'massive' )
                        ),
                    array(
                        'id'    => 'mb_portfolio_meta_link',
                        'type'  => 'text',
                        'title' => esc_html__( 'Project Link', 'massive' ),
                        'desc'  => esc_html__( 'Add portfolio project website link', 'massive' )
                        ),
                    array(
                        'id'    => 'mb_portfolio_meta_btn_label',
                        'type'  => 'text',
                        'title' => esc_html__( 'Project Button Label', 'massive' ),
                        'desc'  => esc_html__( 'Change label for project link button', 'massive' )
                        ),
                    ),
                ),
            array(
                'name'   => 'mb_portfolio_subtitle',
                'title'  => esc_html__( 'Portfolio Subtitle', 'massive' ),
                'icon'   => 'icon-picture',
                'fields' => array(
                    array(
                        'id'    => 'mb_portfolio_subtitle_text',
                        'type'  => 'text',
                        'title' => esc_html__( 'Custom Subtitle', 'massive' ),
                        'desc'  => esc_html__( 'Add a custom subtitle for portfolio.', 'massive' )
                        ),
                    ),
                ),

            ),
        );

    return $metabox;
}
add_filter( 'cs_metabox_options', 'massive_portfolio_gallery_metabox' );
