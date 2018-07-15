<?php
function massive_connect_filesystem( $url, $method, $context, $fields = null ) {
    global $wp_filesystem;
    if ( false === ( $credentials = request_filesystem_credentials( $url, $method, false, $context, $fields ) ) ) {
        return false;
    }

    //check if credentials are correct or not.
    if ( ! WP_Filesystem( $credentials ) ) {
        request_filesystem_credentials( $url, $method, true, $context );
        return false;
    }
    return true;
}

function massive_get_file_contents( $file = '' ) {
    global $wp_filesystem;
    if ( massive_connect_filesystem( '', 'direct', MASSIVE_VENDORS_DIR . 'redium/demo-files' ) ) {
        $dir = $wp_filesystem->find_folder(MASSIVE_VENDORS_DIR . 'redium/demo-files');
        $file = trailingslashit($dir) . $file;
        $contents = '';

        if ( $wp_filesystem->exists( $file ) ) {
            $contents = $wp_filesystem->get_contents($file);
            return $contents;
        } else {
            return new WP_Error('filesystem_error', esc_html__( 'File doesn\'t exist', 'massive' ) );
        }
    } else {
        return new WP_Error('filesystem_error', esc_html__( 'Cannot initialize filesystem', 'massive' ) );
    }
}
