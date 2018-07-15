<?php
    $title = esc_html( $atts['title'] );
    $breadcrumb = $atts['breadcrumb'] ;
?>
<section class="page-title background-title <?php echo esc_attr( $atts['alignment'] ); ?> <?php echo esc_attr( $atts['uid'] ); ?>" >
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="text-uppercase"><?php echo ( $title !== '' ? $title : the_title() ) ?></h4>
                <span class="page-subtitle"><?php echo esc_html( $atts['subtitle'] ); ?></span>
                <?php if ( 'true' == $breadcrumb ){
                    if (function_exists('massive_breadcrumbs')) massive_breadcrumbs();
                } ?>
            </div>
        </div>
    </div>
</section>


