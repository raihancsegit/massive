<div class="container-fluid">
    <div class="row <?php echo esc_attr( $atts['uid'] ); ?>">
        <div class="subscribe-box <?php echo esc_attr( $subscribe_class ); ?>">
            <div class="container">
                <div class="row">
                    <?php echo ( 'text-center' === $atts['alignment'] ) ? '<div class="col-md-8 col-md-offset-2">' : '<div class="col-md-12">'; ?>
                        <div class="subscribe-info">
                            <h4><?php echo esc_html( $atts['title'] ); ?></h4>
                            <span><?php echo esc_html( $atts['subtitle'] ); ?></span>
                        </div>
                        <div class="subscribe-form">
                            <form class="form-inline mc-subscriber-form" novalidate="true" action="<?php echo esc_url( $atts['mailchimp'] ); ?>">
                                <input id="<?php echo esc_attr( $atts['uid'] ); ?>-id" type="email" class="form-control" placeholder="<?php echo esc_attr( $atts['placeholder'] ); ?>" name="EMAIL">
                                <button type="submit" class="btn btn-medium <?php echo esc_attr( $btn_shape_class ); ?> btn-dark-solid text-uppercase"><?php echo esc_html( $atts['btn_text'] ); ?></button>
                                <label for="<?php echo esc_attr( $atts['uid'] ); ?>-id"></label>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
