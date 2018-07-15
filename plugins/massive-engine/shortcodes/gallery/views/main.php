<?php
/**
 * Early return for no image
 */
if ( empty( $images ) ) { return; }

$groups = array_chunk( $images, 8 );
$grid = array(1,3,1,2,1,1,1,1);
?>

<div class="tb-grid">
    <?php
    foreach ( $groups as $group ) {
        $grid[1] = ( count( $group ) >= 3 ) ? 3 : 2;
        foreach ( $group as $key => $image ) {
            $image = massive_get_attachment_image_url( absint( $image ), 'massive-md-soft' );
            $full = massive_get_attachment_image_url( absint( $image ), 'full' );
            ?>
            <div class="item <?php echo ( $grid[$key] === 1 ) ? 'box' : 'box'.$grid[$key]; ?>">
                <figure class="item-inner box-img" data-src="<?php echo esc_url( $image ); ?>" data-mfp-src="<?php echo esc_url( $full ); ?>"></figure>
            </div>
            <?php
        }
    }
    ?>
</div>
