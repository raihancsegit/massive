<?php $class = ( 'circle' == $atts['type'] ) ? 'count-down-alt text-center' : 'count-down'; ?>
<div class="<?php echo esc_attr( $atts['uid'] ); ?>">
    <div class="<?php echo $class; ?>">
        <div class="clock" data-endtime="<?php echo esc_attr( $atts['end_time'] ); ?>"></div>
    </div>
</div>
