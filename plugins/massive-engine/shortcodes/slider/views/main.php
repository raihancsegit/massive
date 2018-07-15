<div class="post-list-aside">
    <div class="post-single">
        <div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>" <?php echo massive_html_data_attr( $data_attr ); ?>>
            <ul class="slides clearfix">
            <?php foreach ( $slides as $slide ) {
                    $aid  = absint( $slide );
                    $data = masssive_get_attachment( $aid, $atts['image_size'] );
                    if ( 'thumbnail' === $pagination_type ) {
                        $thumb = massive_get_attachment_image_url( $aid, 'thumbnail' );
                    }
                    ?>
                    <li <?php if ( 'thumbnail' == $pagination_type ) { printf( 'data-thumb="%s"', esc_url( $thumb ) ); } ?>>
                        <a href="javascript:;" title="<?php echo esc_attr( $data['title'] ); ?>">
                            <img src="<?php echo esc_url( $data['src'] ); ?>" alt="<?php echo esc_attr( $data['alt'] ); ?>">
                        </a>
                        <?php if ( $has_caption && $data['caption'] ) { ?>
                            <div class="caption"><?php echo esc_html( $data['caption'] ); ?></div>
                        <?php } ?>
                    </li>
            <?php } ?>
            </ul>
        </div>
    </div>
</div>
