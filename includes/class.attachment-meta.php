<?php
/**
 * Add attachment custom fields and save custom fields data.
 *
 * @package Massive
 * @author ThemeBucket <themebucket@gmail.com>
 */

class Massive_Attachment_Meta {

    public function __construct() {
        add_filter( 'attachment_fields_to_edit', array($this, 'add_fields'), 10, 2 );
        add_filter( 'attachment_fields_to_save', array($this, 'save_fields_data'), 10, 2 );
    }

    function add_fields( $form_fields, $post ) {
        $form_fields['massive_attachement_tags'] = array(
            'label' => esc_html__( 'Tags', 'massive' ),
            'input' => 'text',
            'value' => get_post_meta( $post->ID, '_massive_attachement_tags', true ),
            'helps' => esc_html__( 'Separate tags with commas', 'massive' ),
        );
        $form_fields['massive_attachement_link'] = array(
            'label' => esc_html__( 'Link', 'massive' ),
            'input' => 'text',
            'value' => esc_url( get_post_meta( $post->ID, '_massive_attachement_link', true ) ),
        );
        return $form_fields;
    }

    function save_fields_data( $post, $attachment ) {
        if ( isset( $attachment['massive_attachement_tags'] ) ) {
            update_post_meta( $post['ID'], '_massive_attachement_tags', sanitize_text_field( $attachment['massive_attachement_tags'] ) );
        }

        if ( isset( $attachment['massive_attachement_link'] ) ) {
            update_post_meta( $post['ID'], '_massive_attachement_link', sanitize_text_field( $attachment['massive_attachement_link'] ) );
        }

        return $post;
    }

}

new Massive_Attachment_Meta;