<div class="team-member <?php echo esc_attr( $uid ); ?>" itemscope itemtype="http://schema.org/Person">
    <div class="team-img">
        <?php if ( isset( $photo[0] ) ) { ?>
        <img itemprop="image" src="<?php echo esc_url( $photo[0] ); ?>" alt="<?php echo esc_attr( $atts['name'] ); ?>">
        <?php } ?>
    </div>
    <div class="team-hover">
        <div class="desk">
            <h4 itemprop="name"><?php echo esc_html( $atts['name'] ); ?></h4>
            <p itemprop="jobTitle"><?php echo esc_html( $atts['job_title'] ); ?></p>
        </div>
        <div class="s-link">
            <?php
            foreach( $social_links as $key => $icon ) {
                if ( $atts[$key] !== '' ) {
                    if ( 'email' == $key ) {
                        printf( '<a href="mailto:%1$s" itemprop="email"><i class="fa fa-%2$s"></i></a>' . "\n",
                            antispambot( esc_attr( $atts['email'] ), 1 ),
                            esc_attr( $icon )
                            );
                    } else {
                        printf( '<a href="%1$s" itemprop="url/%2$s"><i class="fa fa-%3$s"></i></a>' . "\n",
                            esc_url( $atts[$key] ),
                            esc_attr( $key ),
                            esc_attr( $icon )
                            );
                    }
                }
            } ?>
        </div>
    </div>
</div>
