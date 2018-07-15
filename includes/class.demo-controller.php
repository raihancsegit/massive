<?php
/**
 * Handles all the demo related tasks.
 *
 * @package Massive
 * @author ThemeBucket <themebucket@gmail.com>
 */

class Massive_Demo_Controller {

    public function __construct() {
        add_filter( 'pt-ocdi/import_files', array($this, 'register') );
        add_filter( 'pt-ocdi/plugin_intro_text', array($this, 'help_note') );
        add_filter( 'pt-ocdi/plugin_page_setup', array($this, 'setup_importer_page') );

        add_action( 'pt-ocdi/after_import', array($this, 'update_options') );
        add_action( 'pt-ocdi/after_import', array($this, 'setup_theme') );
    }

    public function register() {
        return array(
            array(
                'import_file_name' => 'Massive Ultimate',
                'import_file_url' => MASSIVE_URI . 'demos/ultimate/content.xml',
                'import_widget_file_url' =>  MASSIVE_URI . 'demos/ultimate/widgets.json',
            )
        );
    }

    function setup_importer_page( $default_settings ) {
        $default_settings['page_title']  = esc_html__( 'Massive One Click Demo Importer' , 'massive' );
        $default_settings['menu_slug']   = 'massive-demo-importer';

        return $default_settings;
    }

    public function setup_theme() {
        $main_menu = get_term_by( 'name', 'Primary Menu', 'nav_menu' );
        set_theme_mod( 'nav_menu_locations',
            array(
                'primary' => $main_menu->term_id,
            )
        );

        $front_page_id = get_page_by_title( 'General 1' );
        $blog_page_id  = get_page_by_title( 'Blog' );

        update_option( 'show_on_front', 'page' );
        update_option( 'page_on_front', $front_page_id->ID );
        update_option( 'page_for_posts', $blog_page_id->ID );
    }

    public function update_options() {
        $file = MASSIVE_ROOT . 'demos/ultimate/theme_options.txt';

        if ( file_exists( $file ) ) {
            $data = file_get_contents( $file );
            update_option( CS_OPTION, cs_decode_string( $data ) );
        }
    }

    public function help_note( $text ) {
        ob_start();
        ?>
        <div class="ocdi__intro-text">
            <p><?php echo wp_kses_data( __( 'As you already know it is <strong>Massive</strong>! And to carry its signature, it contains around 250MB attachments (image mainly). So, depending on your internet connection speed it may take approximately 5-8 minutes.', 'massive' ) ); ?></p>
        </div>
        <div class="ocdi__intro-text">
            <p><?php echo wp_kses_data( __( '<strong>Note:</strong> If you face any unexpected situation then click on the <strong>Import Demo Data</strong> button again. Happy Journey.', 'massive' ) ); ?></p>
        </div>
        <hr>
        <?php
        return $text . ob_get_clean();
    }

}

new Massive_Demo_Controller();
