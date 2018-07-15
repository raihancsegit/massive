<?php
/**
 * Display shop sidebar.
 *
 *
 * @package Massive
 */

if ( ! is_active_sidebar( 'shop-sidebar' ) ) {
    return;
}
?>

<div class="widget-area" role="complementary">
    <?php dynamic_sidebar( 'shop-sidebar' ); ?>
</div>
