<?php
function massive_page_options( $metabox ) {
    $dir = MASSIVE_INCLUDES_DIR . 'metabox/page/';
    $massive_sections = array();
    $imgs = get_template_directory_uri() . '/assets/admin/img/';

    include_once $dir . 'page.php';
    include_once $dir . 'header.php';
    include_once $dir . 'banner.php';
    include_once $dir . 'title.php';
    include_once $dir . 'sidebar.php';
    include_once $dir . 'footer.php';

    $metabox[] = array(
        'id'        => '_massive_page_options',
        'title'     => esc_html__( 'Massive Page Options', 'massive' ),
        'post_type' => 'page',
        'context'   => 'normal',
        'priority'  => 'default',
        'sections'  => $massive_sections,
        );

    return $metabox;
}
add_filter( 'cs_metabox_options', 'massive_page_options' );
