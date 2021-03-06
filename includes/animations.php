<?php
/**
 * List of animation class
 *
 * @return array
 */
if ( ! function_exists( 'massive_animation_names' ) ) :
function massive_animation_names() {
    $animations = array(
        'bounce'             => esc_html__( 'bounce', 'massive' ),
        'flash'              => esc_html__( 'flash', 'massive' ),
        'pulse'              => esc_html__( 'pulse', 'massive' ),
        'rubberBand'         => esc_html__( 'rubberBand', 'massive' ),
        'shake'              => esc_html__( 'shake', 'massive' ),
        'swing'              => esc_html__( 'swing', 'massive' ),
        'tada'               => esc_html__( 'tada', 'massive' ),
        'wobble'             => esc_html__( 'wobble', 'massive' ),
        'bounceIn'           => esc_html__( 'bounceIn', 'massive' ),
        'bounceInDown'       => esc_html__( 'bounceInDown', 'massive' ),
        'bounceInLeft'       => esc_html__( 'bounceInLeft', 'massive' ),
        'bounceInRight'      => esc_html__( 'bounceInRight', 'massive' ),
        'bounceInUp'         => esc_html__( 'bounceInUp', 'massive' ),
        'bounceOut'          => esc_html__( 'bounceOut', 'massive' ),
        'bounceOutDown'      => esc_html__( 'bounceOutDown', 'massive' ),
        'bounceOutLeft'      => esc_html__( 'bounceOutLeft', 'massive' ),
        'bounceOutRight'     => esc_html__( 'bounceOutRight', 'massive' ),
        'bounceOutUp'        => esc_html__( 'bounceOutUp', 'massive' ),
        'fadeIn'             => esc_html__( 'fadeIn', 'massive' ),
        'fadeInDown'         => esc_html__( 'fadeInDown', 'massive' ),
        'fadeInDownBig'      => esc_html__( 'fadeInDownBig', 'massive' ),
        'fadeInLeft'         => esc_html__( 'fadeInLeft', 'massive' ),
        'fadeInLeftBig'      => esc_html__( 'fadeInLeftBig', 'massive' ),
        'fadeInRight'        => esc_html__( 'fadeInRight', 'massive' ),
        'fadeInRightBig'     => esc_html__( 'fadeInRightBig', 'massive' ),
        'fadeInUp'           => esc_html__( 'fadeInUp', 'massive' ),
        'fadeInUpBig'        => esc_html__( 'fadeInUpBig', 'massive' ),
        'fadeOut'            => esc_html__( 'fadeOut', 'massive' ),
        'fadeOutDown'        => esc_html__( 'fadeOutDown', 'massive' ),
        'fadeOutDownBig'     => esc_html__( 'fadeOutDownBig', 'massive' ),
        'fadeOutLeft'        => esc_html__( 'fadeOutLeft', 'massive' ),
        'fadeOutLeftBig'     => esc_html__( 'fadeOutLeftBig', 'massive' ),
        'fadeOutRight'       => esc_html__( 'fadeOutRight', 'massive' ),
        'fadeOutRightBig'    => esc_html__( 'fadeOutRightBig', 'massive' ),
        'fadeOutUp'          => esc_html__( 'fadeOutUp', 'massive' ),
        'fadeOutUpBig'       => esc_html__( 'fadeOutUpBig', 'massive' ),
        'flip'               => esc_html__( 'flip', 'massive' ),
        'flipRoleIn'         => esc_html__( 'flipRole', 'massive' ),
        'flipInX'            => esc_html__( 'flipInX', 'massive' ),
        'flipInY'            => esc_html__( 'flipInY', 'massive' ),
        'flipOutY'           => esc_html__( 'flipOutY', 'massive' ),
        'lightSpeedIn'       => esc_html__( 'lightSpeedIn', 'massive' ),
        'lightSpeedOut'      => esc_html__( 'lightSpeedOut', 'massive' ),
        'rotateIn'           => esc_html__( 'rotateIn', 'massive' ),
        'rotateInDownRight'  => esc_html__( 'rotateInDownRight', 'massive' ),
        'rotateInUpLeft'     => esc_html__( 'rotateInUpLeft', 'massive' ),
        'rotateInUpRight'    => esc_html__( 'rotateInUpRight', 'massive' ),
        'rotateOut'          => esc_html__( 'rotateOut', 'massive' ),
        'rotateOutDownLeft'  => esc_html__( 'rotateOutDownLeft', 'massive' ),
        'rotateOutDownRight' => esc_html__( 'rotateOutDownRight', 'massive' ),
        'rotateOutUpLeft'    => esc_html__( 'rotateOutUpLeft', 'massive' ),
        'rotateOutUpRight'   => esc_html__( 'rotateOutUpRight', 'massive' ),
        'slideInUp'          => esc_html__( 'slideInUp', 'massive' ),
        'slideInDown'        => esc_html__( 'slideInDown', 'massive' ),
        'slideInLeft'        => esc_html__( 'slideInLeft', 'massive' ),
        'slideInRight'       => esc_html__( 'slideInRight', 'massive' ),
        'slideOutUp'         => esc_html__( 'slideOutUp', 'massive' ),
        'slideOutDown'       => esc_html__( 'slideOutDown', 'massive' ),
        'slideOutLeft'       => esc_html__( 'slideOutLeft', 'massive' ),
        'slideOutRight'      => esc_html__( 'slideOutRight', 'massive' ),
        'zoomIn'             => esc_html__( 'zoomIn', 'massive' ),
        'zoomInDown'         => esc_html__( 'zoomInDown', 'massive' ),
        'zoomInLeft'         => esc_html__( 'zoomInLeft', 'massive' ),
        'zoomInRight'        => esc_html__( 'zoomInRight', 'massive' ),
        'zoomInUp'           => esc_html__( 'zoomInUp', 'massive' ),
        'zoomOut'            => esc_html__( 'zoomOut', 'massive' ),
        'zoomOutDown'        => esc_html__( 'zoomOutDown', 'massive' ),
        'zoomOutLeft'        => esc_html__( 'zoomOutLeft', 'massive' ),
        'zoomOutRight'       => esc_html__( 'zoomOutRight', 'massive' ),
        'zoomOutUp'          => esc_html__( 'zoomOutUp', 'massive' ),
        'hinge'              => esc_html__( 'hinge', 'massive' ),
        'rollIn'             => esc_html__( 'rollIn', 'massive' ),
        'rollOut'            => esc_html__( 'rollOut', 'massive' ),
    );
    return $animations;
}
endif;
