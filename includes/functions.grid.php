<?php
/**
 * Generate container class based on layout setting
 * @param  string $layout
 * @return string
 */
function massive_get_container_class( $layout = 'boxed' ) {
    $class = '';
    if ( 'fullwidth' === $layout ) {
        $class = 'container-fluid';
    } else {
        $class = 'container';
    }
    return $class;
}

/**
 * Generate grid column based on grid setting
 * @param  string $grid
 * @return string
 */
function massive_get_grid_column_class( $grid = 'two'){
    $class = '';
    if ( 'two' === $grid ) {
        $class = 'col-md-6';
    } elseif ( 'three' === $grid ) {
        $class = 'col-md-4';
    } elseif ( 'four' === $grid ) {
        $class = 'col-md-3';
    }
    return $class;
}

/**
 * Generate masonry column based on masonry setting
 * @param  string $masonry
 * @return string
 */
function massive_get_masonry_column_class( $masonry = 'two' ){
    if ( 'two' == $masonry ) {
        $masonry_class = 'col-2';
    } elseif ( 'three' == $masonry ) {
        $masonry_class = 'col-3';
    }elseif ( 'four' == $masonry ) {
        $masonry_class = 'col-4';
    }
    return $masonry_class;
}

/**
 * Generate column based on sidebar setting
 * @param  string $sidebar
 * @return array
 */
function massive_get_column_class( $sidebar = 'right' ) {
    if ( 'right' == $sidebar ) {
        $column = array( 'main' => 'col-md-8', 'sidebar' => 'col-md-4' );
    } elseif ( 'left' == $sidebar ) {
        $column = array( 'main' => 'col-md-8 col-md-push-4', 'sidebar' => 'col-md-4 col-md-pull-8' );
    } elseif ( 'no-sidebar' == $sidebar ) {
        $column = array( 'main' => 'col-md-12', 'sidebar' => '' );
    } else{
        $column = array( 'main' => 'col-md-12', 'sidebar' => '' );
    }
    return $column;
}
