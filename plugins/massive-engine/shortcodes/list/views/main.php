<ul class="<?php echo esc_attr( $classes ); ?>">
    <?php foreach ( $items as $item ) { ?>
    <li><i class="<?php echo esc_attr( $item['icon'] ); ?>"></i> <?php echo wp_kses_post( $item['text'] ); ?></li>
    <?php } ?>
</ul>
