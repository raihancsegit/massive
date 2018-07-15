<div class="fun-factor light-txt">
    <div class="icon"><i class="<?php echo esc_attr($atts['icon']);?> light-txt"></i></div>
    <div class="fun-info">
        <h1 class="timer light-txt" data-from="0" data-to="<?php echo esc_attr($atts['value']);?>" data-speed="1000"> </h1>
        <span><?php echo wp_kses_post($atts['text']);?></span>
    </div>
</div>
