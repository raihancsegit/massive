<?php
/**
 * Sidebar template.
 *
 *
 * @package Massive
 */

if ( ! is_active_sidebar( 'primary-sidebar' ) ) {
    return;
}
?>

<div class="widget-area" role="complementary">
    <?php dynamic_sidebar( 'primary-sidebar' ); ?>
</div>
