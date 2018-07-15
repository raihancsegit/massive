<?php
/**
* Search form template.
*
*
* @package Massive
*/
?>

<form role="search" method="get" class="form-inline form" action="<?php echo esc_url( home_url( '/' ) ); ?>" autocomplete="off">
    <div class="search-row">
        <label class="sr-only" for="search-form"><?php esc_html_e( 'Search for:', 'massive' ) ?></label>
        <button class="search-btn" type="submit" title="Search">
            <span class="sr-only"><?php esc_html_e( 'Search', 'massive' ) ?></span>
            <i class="fa fa-search"></i>
        </button>
        <input type="search" class="form-control" id="search-form" placeholder="<?php esc_attr_e( 'Search', 'massive' ) ?>" value="<?php echo get_search_query(true) ?>" name="s" title="<?php esc_attr_e( 'Search for:', 'massive' ) ?>" />
    </div>
</form>
