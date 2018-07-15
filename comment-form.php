<?php
/**
 * Comment form template.
 *
 *
 * @package Massive
 */

$commenter = wp_get_current_commenter();
$req       = get_option( 'require_name_email' );
$aria_req  = ( $req ? " aria-required='true'" : '' );
$fields =  array(

    'author' =>
    '<div class="row"><div class="col-md-6 "><div class="form-group">' .
    '<input id="author" required name="author" type="text" class="form-control" value="' . esc_attr( $commenter['comment_author'] ) .
    '" placeholder="' . esc_attr__( 'Name*', 'massive' ) .
    '" size="30"' . $aria_req . ' /></div></div>',


    'email' =>
    '<div class="col-md-6 "><div class="form-group">' .
    '<input id="email" required name="email" type="text" class="form-control" value="' . esc_attr( $commenter['comment_author_email'] ) .
    '" placeholder="' . esc_attr__( 'Email*', 'massive' ) .
    '" size="30"' . $aria_req . ' /></div></div>',

    'website' =>
    '<div class="col-md-12 "><div class="form-group">' .
    '<input id="website" name="website" type="text" class="form-control" value="' . esc_attr( $commenter['comment_author_url'] ) .
    '" placeholder="' . esc_attr__( 'Website', 'massive' ) .
    '" size="30" /></div></div></div>',
);

$args = array(
    'class_submit'  => 'btn btn-small btn-dark-solid ',
    'label_submit'  => esc_html__( 'Post Your Comment','massive' ),

    'comment_notes_before' => '<p class="comment-notes ">' .
    esc_html__( 'Your email address will not be published.','massive' ) . ( $req ? ' ' . esc_html__( 'Email and Name is required.','massive' ) : '' ) .
    '</p>',

    'comment_field' =>  '<div class="row"><div class="col-md-12 form-group"><div class="form-group"><textarea id="comment" name="comment" class="form-control" '.
    'placeholder="' . esc_attr__( 'Comment', 'massive' ) . '" ' .
    'cols="45" rows="8">' .
    '</textarea></div></div></div>',

    'fields' => apply_filters( 'comment_form_default_fields', $fields ),
);

comment_form( $args );
