<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
/**
 *
 * Field: Typography Advanced
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
class CSFramework_Option_tb_typography extends CSFramework_Options {

    public function __construct( $field, $value = '', $unique = '' ) {
        parent::__construct( $field, $value, $unique );
    }

    public function output() {

        echo $this->element_before();

        $defaults_value = array(
            'family'  => 'Arial',
            'variant' => 'regular',
            'font'    => 'websafe',
            'size'    => '14',
            'height'  => '1.4em',
        );

        $default_variants = apply_filters( 'cs_websafe_fonts_variants', array(
            'regular',
            'italic',
            '700',
            '700italic',
            'inherit'
        ));

        $websafe_fonts = apply_filters( 'cs_websafe_fonts', array(
            'Arial',
            'Arial Black',
            'Comic Sans MS',
            'Impact',
            'Lucida Sans Unicode',
            'Tahoma',
            'Trebuchet MS',
            'Verdana',
            'Courier New',
            'Lucida Console',
            'Georgia, serif',
            'Palatino Linotype',
            'Times New Roman',
        ));

        $value         = wp_parse_args( $this->element_value(), $defaults_value );
        $family_value  = isset( $value['family'] ) ? $value['family'] : '';
        $variant_value = isset( $value['variant'] ) ? $value['variant'] : '';
        $font_size = isset( $value['size'] ) ? $value['size'] : '';
        $line_height = isset( $value['height'] ) ? $value['height'] : '';

        $is_variant    = ( isset( $this->field['variant'] ) && $this->field['variant'] === false ) ? false : true;
        $is_chosen     = ( isset( $this->field['chosen'] ) && $this->field['chosen'] === false ) ? '' : 'chosen ';
        $google_json   = cs_get_google_fonts();
        $chosen_rtl    = ( is_rtl() && ! empty( $is_chosen ) ) ? 'chosen-rtl ' : '';

        //Container
        echo '<div class="cs_font_fields" data-id="'.$this->field['id'].'">';

        if ( is_object( $google_json ) ) {

            $googlefonts = array();

            foreach ( $google_json->items as $key => $font ) {
                $googlefonts[$font->family] = $font->variants;
            }

            $is_google = ( array_key_exists( $family_value, $googlefonts ) ) ? true : false;

            echo '<div class="cs_font_field cs-typography-family">';
                echo '<label>' . esc_html__( 'Font Family', 'massive' ) . '</label>';
                echo '<select name="'. $this->element_name( '[family]' ) .'" class="'. $is_chosen . $chosen_rtl .'cs-typo-family" data-atts="family"'. $this->element_attributes() .'>';

                    do_action( 'cs_typography_family', $family_value, $this );

                    echo '<optgroup label="'. esc_html__( 'Web Safe Fonts', 'massive' ) .'">';
                    foreach ( $websafe_fonts as $websafe_value ) {
                        echo '<option value="'. $websafe_value .'" data-variants="'. implode( '|', $default_variants ) .'" data-type="websafe"'. selected( $websafe_value, $family_value, true ) .'>'. $websafe_value .'</option>';
                    }
                    echo '</optgroup>';

                    echo '<optgroup label="'. esc_html__( 'Google Fonts', 'massive' ) .'">';
                    foreach ( $googlefonts as $google_key => $google_value ) {
                        echo '<option value="'. $google_key .'" data-variants="'. implode( '|', $google_value ) .'" data-type="google"'. selected( $google_key, $family_value, true ) .'>'. $google_key .'</option>';
                    }
                    echo '</optgroup>';

                echo '</select>';
            echo '</div>';

            if ( ! empty( $is_variant ) ) {
                $variants = ( $is_google ) ? $googlefonts[$family_value] : $default_variants;
                $variants = ( $value['font'] === 'google' || $value['font'] === 'websafe' ) ? $variants : array( 'regular' );

                echo '<div class="cs_font_field cs-typography-variant">';
                    echo '<label>' . esc_html__( 'Font Variant', 'massive' ) . '</label>';
                    echo '<select name="'. $this->element_name( '[variant]' ) .'" class="'. $is_chosen . $chosen_rtl .'cs-typo-variant" data-atts="variant">';
                        foreach ( $variants as $variant ) {
                            echo '<option value="'. $variant .'"'. $this->checked( $variant_value, $variant, 'selected' ) .'>'. ucwords( $variant ) .'</option>';
                        }
                    echo '</select>';
                echo '</div>';
            }

            echo cs_add_element( array(
                'type'       => 'text',
                'name'       => $this->element_name( '[size]' ),
                'value'      => $font_size,
                'default'    => ( isset( $this->field['default']['size'] ) ) ? $this->field['default']['size'] : '',
                'before'     => '<label>' . esc_html__( 'Font Size', 'massive' ) . '</label>',
                'wrap_class' => 'cs_font_field cs-typography-size',
                'attributes' => array(
                    'title' => esc_html__( 'Font Size in Pixel', 'massive' )
                    ),
                ) );

            echo cs_add_element( array(
                'type'       => 'text',
                'name'       => $this->element_name( '[height]' ),
                'value'      => $line_height,
                'default'    => ( isset( $this->field['default']['height'] ) ) ? $this->field['default']['height'] : '',
                'before'     => '<label>' . esc_html__( 'Line Height', 'massive' ) . '</label>',
                'wrap_class' => 'cs_font_field cs-typography-height',
                'attributes' => array(
                    'title' => esc_html__( 'Line Height in Pixel', 'massive' )
                    ),
                ) );

            /**
            * Font Preview
            */
            if ( isset( $this->field['preview'] ) && $this->field['preview'] ) {
                if ( isset( $this->field['preview_text'] ) ) {
                    $preview_text = $this->field['preview_text'];
                } else {
                    $preview_text = 'Lorem ipsum dolor sit amet, pro ad sanctus admodum, vim at insolens appellantur. Eum veri adipiscing an, probo nonumy an vis.';
                }
                echo '<div id="preview-'.$this->field['id'].'" style="font-family:;" class="cs-font-preview">'. $preview_text .'</div>';
            }

            echo '<input type="text" name="'. $this->element_name( '[font]' ) .'" class="cs-typo-font hidden" data-atts="font" value="'. $value['font'] .'" />';

        } else {
          echo esc_html__( 'Error! Can not load json file.', 'massive' );
        }

        //end container
        echo '</div>';

        echo $this->element_after();
    }
}
