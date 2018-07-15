<div class="col-md-<?php echo $columns; ?>">
    <div class="price-col <?php echo esc_attr( $featured ); ?>">
        <h1><?php echo esc_html( $atts['title'] ); ?></h1>
        <div class="p-value">
            <div class="dollar">
                <?php printf( '%s %s</span>',
                    esc_attr( $atts['currency'] ),
                    str_replace( '.', '<span>.', number_format( $price, 2 ) )
                    );
                ?>
            </div>
            <div class="duration"><?php echo esc_html( $atts['duration'] ); ?></div>
        </div>

        <?php
            $features = wp_kses( $content, array(
                'ul'     => array(),
                'ol'     => array(),
                'li'     => array(),
                'strong' => array(),
                'em'     => array(),
                'span'   => array(
                    'style' => array()
                ),
                'a'      => array(
                    'href'  => array(),
                    'title' => array(),
                ),
            ) );

            echo $features;
        ?>

        <a href="<?php echo esc_url( $atts['button_link'] ); ?>" class="p-btn"><?php echo esc_html( $atts['button_text'] ); ?></a>
    </div>
</div>
