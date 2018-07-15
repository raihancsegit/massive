<?php
/**
 * The template for displaying site header.
 *
 *
 * @package Massive
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="page" class="wrapper">
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'massive' ); ?></a>

    <?php
    do_action( 'massive_page_start' );

    do_action( 'massive_before_header' );

    get_template_part( 'partials/header/navbar' );

    do_action( 'massive_after_header' );
    ?>

    <!-- header part will be here -->
    <div id="content">
