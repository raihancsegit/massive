<?php
/**
 * Social Media
 */
$massive_social_links = array(
    'behance'        => esc_html__( 'Behance', 'massive' ),
    'bitbucket'      => esc_html__( 'Bitbucket', 'massive' ),
    'custom'         => esc_html__( 'Custom', 'massive' ),
    'deviantart'     => esc_html__( 'Deviant Art', 'massive' ),
    'dribbble'       => esc_html__( 'Dribbble', 'massive' ),
    'email'          => esc_html__( 'Email', 'massive' ),
    'facebook'       => esc_html__( 'Facebook', 'massive' ),
    'flickr'         => esc_html__( 'Flickr', 'massive' ),
    'github'         => esc_html__( 'Github', 'massive' ),
    'google-plus'    => esc_html__( 'Google Plus', 'massive' ),
    'instagram'      => esc_html__( 'Instagram', 'massive' ),
    'jsfiddle'       => esc_html__( 'JsFiddle', 'massive' ),
    'linkedin'       => esc_html__( 'LinkedIn', 'massive' ),
    'medium'         => esc_html__( 'Medium', 'massive' ),
    'pinterest'      => esc_html__( 'Pinterest', 'massive' ),
    'slideshare'     => esc_html__( 'Slide Share', 'massive' ),
    'soundcloud'     => esc_html__( 'Sound Cloud', 'massive' ),
    'stack-exchange' => esc_html__( 'Stack Exchange', 'massive' ),
    'stack-overflow' => esc_html__( 'Stack Overflow', 'massive' ),
    'tumblr'         => esc_html__( 'Tumblr', 'massive' ),
    'twitter'        => esc_html__( 'Twitter', 'massive' ),
    'vimeo'          => esc_html__( 'Vimeo', 'massive' ),
    'whatsapp'       => esc_html__( 'WhatsApp', 'massive' ),
    'youtube'        => esc_html__( 'Youtube', 'massive' ),
);

$massive_options[] = array(
    'name'   => 'massive-social-media',
    'title'  => esc_html__( 'Social Media', 'massive' ),
    'icon'   => 'fa fa-bullhorn',
    'fields' => array(
        array(
            'id'              => 'social_media',
            'type'            => 'group',
            'title'           => esc_html__( 'Social Media', 'massive' ),
            'button_title'    => esc_html__( 'Add New Media', 'massive' ),
            'accordion_title' => esc_html__( 'Media Name', 'massive' ),
            'fields'          => array(
                array(
                    'id'      => 'name',
                    'type'    => 'select',
                    'title'   => esc_html__( 'Media', 'massive' ),
                    'options' => $massive_social_links
                    ),
                array(
                    'id'         => 'icon-name',
                    'type'       => 'text',
                    'title'      => esc_html__( 'Custom Icon', 'massive' ),
                    'desc'       => esc_html__( 'Add a Font Awesome icon class. Note: class name from different icon library may not work properly.', 'massive' ),
                    'dependency' => array('name', '==', 'custom'),
                    ),
                array(
                    'id'    => 'link',
                    'type'  => 'text',
                    'title' => esc_html__( 'Link', 'massive' ),
                    )
                )
            )
        )
    );
