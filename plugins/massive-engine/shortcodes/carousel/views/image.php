<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>" <?php echo massive_html_data_attr( $data_attr ); ?>>
    <?php foreach ( $slides as $slide ) {
        $aid  = absint( $slide );
        $data = masssive_get_attachment( $aid, 'massive-sm-hard' );
        ?>
        <div class="item">
            <a href="<?php echo esc_url( $data['link'] ); ?>" title="<?php echo esc_attr( $data['title'] ); ?>">
                <img src="<?php echo esc_url( $data['src'] ); ?>" alt="<?php echo esc_attr( $data['alt'] ); ?>">
            </a>
        </div>
    <?php } ?>
</div>
