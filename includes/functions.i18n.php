<?php

if ( !function_exists( 'massive_esc_desc' ) ) {
    /**
     * Format translatable string with allowed html tags.
     * Use this function to esc meta box, option and other field's description.
     *
     * @param  string $translated_string Translatable format string using __() function
     * @param  array $placeholders       Placeholders for format string
     * @return string                    Formatted string
     */
    function massive_esc_desc( $translated_string = '', array $placeholders = array() ) {
        $allowed_tags = array(
            'a' => array(
                'href' => array(),
                'title' => array(),
                'target' => array(),
            ),
            'br' => array(),
            'i' => array(),
            'em' => array(),
            'strong' => array(),
            'code' => array(),
            'span' => array(),
        );

        return wp_kses( vsprintf( $translated_string, $placeholders ), $allowed_tags );
    }
}
