<?php
/**
 * This class handle all the functionality of
 * Massive Dashboard
 *
 * @package Massive
 */

class Massive_Dashboard {

    public function __construct() {
        add_action( 'admin_init', array($this, 'admin_board_init') );
        add_action( 'admin_menu', array($this, 'add_pages') );
        add_action( 'after_switch_theme', array($this, 'redirect_to_massive') );
        add_action( 'admin_menu', array($this, 'change_menu_label') );
        add_action( 'admin_bar_menu', array($this, 'admin_bar_menu'), 999 );
    }

    public function admin_bar_menu( $admin_bar ) {
        $admin_bar->add_menu(array(
            'id'    => 'massive-menu',
            'title' => '<img src="'. esc_url( get_template_directory_uri() . '/assets/admin/img/massive-icon.png' ) .'">' . esc_html__( 'Massive', 'massive' ),
            'href'  => admin_url( add_query_arg( array('page' => 'massive'), 'admin.php' ) ),
            'meta'  => array( 'class' => 'massive-main' ),
            ));

        $admin_bar->add_node(array(
            'parent' => 'massive-menu',
            'id'    => 'massive-home',
            'title' => esc_html__( 'Home', 'massive' ),
            'href'  => admin_url( add_query_arg( array('page' => 'massive'), 'admin.php' ) ),
            'meta'  => array( 'class' => 'massive-home' ),
        ));

        $admin_bar->add_node(array(
            'parent' => 'massive-menu',
            'id'    => 'massive-plugin',
            'title' => esc_html__( 'Plugin Installer', 'massive' ),
            'href'  => admin_url( add_query_arg( array('page' => 'massive-plugins'), 'admin.php' ) ),
            'meta'  => array( 'class' => 'massive-plugin-installer' ),
        ));

        if ( massive_has_ocdi() ) {
            $admin_bar->add_node(array(
                'parent' => 'massive-menu',
                'id' => 'massive-demo',
                'title' => esc_html__('Demo Installer', 'massive'),
                'href' => admin_url( add_query_arg( array('page' => 'massive-demo-importer'), 'themes.php' ) ),
                'meta' => array('class' => 'massive-demo-installer'),
            ));
        }

        $admin_bar->add_node(array(
            'parent' => 'massive-menu',
            'id'    => 'massive-options',
            'title' => esc_html__( 'Theme Options', 'massive' ),
            'href'  => admin_url( add_query_arg( array('page' => 'theme-options'), 'themes.php' ) ),
            'meta'  => array( 'class' => 'massive-theme-options' ),
        ));
    }

    public function add_pages() {
        $slug = 'massive';
        $bypass_add_menu_page = str_replace('bypass_', '', 'bypass_add_menu_page');
        $bypass_add_submenu_page = str_replace('bypass_', '', 'bypass_add_submenu_page');

        // Add dashboard home page
        $bypass_add_menu_page( esc_html__( 'Massive Dashboard', 'massive' ), esc_html__( 'Massive', 'massive' ), 'manage_options', $slug, array($this, 'render_main_page'), esc_url( get_template_directory_uri() . '/assets/admin/img/massive-icon.png' ), 3 );

        // Add plugin installer page
        $bypass_add_submenu_page( $slug, esc_html__( 'Massive Plugins Installer', 'massive' ), esc_html__( 'Plugin Installer', 'massive' ), 'manage_options', 'massive-plugins', array($this, 'render_plugins_page') );

        // Add demo import page link if only plugin is activated
        if ( massive_has_ocdi() ) {
            $bypass_add_submenu_page($slug, esc_html__('Massive Demo Installer', 'massive'), esc_html__( 'Demo Installer', 'massive' ), 'manage_options', 'themes.php?page=massive-demo-importer' );
        }

        // Add theme options page link for easy access
        $bypass_add_submenu_page( $slug, esc_html__( 'Massive Theme Options', 'massive' ), esc_html__( 'Theme Options', 'massive' ), 'manage_options', 'themes.php?page=theme-options' );
    }

    public function render_main_page() {
        $this->get_page( 'main' );
    }

    public function render_plugins_page() {
        $this->get_page( 'plugins' );
    }

    function redirect_to_massive() {
        if ( current_user_can( 'manage_options' ) ) {
            wp_redirect( admin_url() . 'admin.php?page=massive', 302 );
        }
    }

    function change_menu_label() {
        global $submenu;

        if ( current_user_can( 'edit_theme_options' ) ) {
            $submenu['massive'][0][0] = esc_html__( 'Home', 'massive' );
        }
    }

    private function get_page($pagename='') {
        ?>
        <div class="MassiveDashboard">
            <div class="MassiveDashboard__header">
                <a href="http://massive.themebucket.net/" target="_blank" class="MassiveDashboard__logoWrapper" title="<?php esc_attr_e( 'Massive multi-purpose WordPress theme', 'massive' ); ?>">
                    <img class="MassiveDashboard__logo" src="<?php echo esc_url( MASSIVE_ASSETS_URI . 'admin/img/logo.png' ); ?>" alt="<?php esc_attr_e( 'Massive Official Logo', 'massive' ); ?>">
                </a>
                <div class="MassiveDashboard__meta">
                    <h1 class="MassiveDashboard__title"><?php printf( esc_html__( 'Welcome to Massive %s', 'massive' ), MASSIVE_VERSION ); ?></h1>
                    <p class="MassiveDashboard__desc"><?php esc_html_e( 'Massive is a multi-purpose WordPress Theme that comes with huge collection of ready made templates. You can pick any one of those templates to get started your AWESOME project.', 'massive' ); ?></p>
                </div>
            </div>

            <?php $this->get_partial( $pagename ); ?>

            <div class="MassiveDashboard__footer">
                <p class="description">
                    <?php esc_html_e( '"A journey of a thousand miles begins with a single step". Thank you for purchasing Massive.', 'massive' ); ?>
                </p>
            </div>
        </div>
        <?php
    }

    private function get_partial($pagename='') {
        $pagedir = get_template_directory() . '/admin/pages/';
        if ( file_exists( $page = $pagedir . $pagename.'.php' ) )
            include( $page );
    }

    private function let_to_num( $size ) {
        $l   = substr( $size, -1 );
        $ret = substr( $size, 0, -1 );
        switch ( strtoupper( $l ) ) {
            case 'P':
                $ret *= 1024;
            case 'T':
                $ret *= 1024;
            case 'G':
                $ret *= 1024;
            case 'M':
                $ret *= 1024;
            case 'K':
                $ret *= 1024;
        }
        return $ret;
    }

    function admin_board_init() {

        if ( current_user_can( 'manage_options' ) ) {
            $tgmpa = TGM_Plugin_Activation::get_instance();
            $plugins = $tgmpa->plugins;

            if ( isset( $_GET['massive-deactivate'] ) && $_GET['massive-deactivate'] == 'deactivate-plugin' ) {
                check_admin_referer( 'massive-deactivate', 'massive-deactivate-nonce' );

                foreach( $plugins as $plugin ) {
                    if ( $plugin['slug'] == $_GET['plugin'] ) {
                        deactivate_plugins( $plugin['file_path'] );
                    }
                }
            } if ( isset( $_GET['massive-activate'] ) && $_GET['massive-activate'] == 'activate-plugin' ) {
                check_admin_referer( 'massive-activate', 'massive-activate-nonce' );

                foreach( $plugins as $plugin ) {
                    if ( $plugin['slug'] == $_GET['plugin'] ) {
                        activate_plugin( $plugin['file_path'] );

                        wp_redirect( admin_url( 'admin.php?page=massive-plugins' ) );
                        exit;
                    }
                }
            }
        }

    }

    private function get_plugin_url( $item ) {
        $tgmpa = TGM_Plugin_Activation::get_instance();
        $installed_plugins = get_plugins();

        $item['sanitized_plugin'] = $item['name'];

        // We have a repo plugin
        if ( ! $item['version'] ) {
            $item['version'] = $tgmpa->does_plugin_have_update( $item['slug'] );
        }

        /** We need to display the 'Install' hover link */
        if ( ! isset( $installed_plugins[$item['file_path']] ) ) {
            $actions = array(
                'install' => sprintf(
                    '<a href="%1$s" class="button button-primary" title="%2$s">%3$s</a>',
                    esc_url( wp_nonce_url(
                        add_query_arg(
                            array(
                                'page'          => urlencode( $tgmpa->menu ),
                                'plugin'        => urlencode( $item['slug'] ),
                                'plugin_name'   => urlencode( $item['sanitized_plugin'] ),
                                'plugin_source' => urlencode( $item['source'] ),
                                'tgmpa-install' => 'install-plugin',
                                'return_url'    => 'massive-plugins'
                            ),
                            $tgmpa->get_tgmpa_url()
                        ),
                        'tgmpa-install',
                        'tgmpa-nonce'
                    ) ),
                    sprintf( esc_attr__( 'Install %s', 'massive' ), $item['sanitized_plugin'] ),
                    esc_html__( 'Install', 'massive' )
                ),
            );
        }
        /** We need to display the 'Activate' hover link */
        elseif ( is_plugin_inactive( $item['file_path'] ) ) {
            $actions = array(
                'activate' => sprintf(
                    '<a href="%1$s" class="button button-primary" title="%2$s">%3$s</a>',
                    esc_url( add_query_arg(
                        array(
                            'plugin'                 => urlencode( $item['slug'] ),
                            'plugin_name'            => urlencode( $item['sanitized_plugin'] ),
                            'plugin_source'          => urlencode( $item['source'] ),
                            'massive-activate'       => 'activate-plugin',
                            'massive-activate-nonce' => wp_create_nonce( 'massive-activate' ),
                        ),
                        admin_url( 'admin.php?page=massive-plugins' )
                    ) ),
                    sprintf( esc_attr__( 'Activate %s', 'massive' ), $item['sanitized_plugin'] ),
                    esc_html__( 'Activate', 'massive' )
                ),
            );
        }
        /** We need to display the 'Update' hover link */
        elseif ( version_compare( $installed_plugins[$item['file_path']]['Version'], $item['version'], '<' ) ) {
            $actions = array(
                'update' => sprintf(
                    '<a href="%1$s" class="button button-primary" title="%2$s">%3$s</a>',
                    wp_nonce_url(
                        add_query_arg(
                            array(
                                'page'          => urlencode( $tgmpa->menu ),
                                'plugin'        => urlencode( $item['slug'] ),
                                'tgmpa-update'  => 'update-plugin',
                                'plugin_source' => urlencode( $item['source'] ),
                                'version'       => urlencode( $item['version'] ),
                                'return_url'    => 'massive-plugins'
                            ),
                            $tgmpa->get_tgmpa_url()
                        ),
                        'tgmpa-update',
                        'tgmpa-nonce'
                    ),
                    sprintf( esc_attr__( 'Install %s', 'massive' ), $item['sanitized_plugin'] ),
                    esc_html__( 'Update', 'massive' )
                ),
            );
        } elseif ( is_plugin_active( $item['file_path'] ) ) {
            $actions = array(
                'deactivate' => sprintf(
                    '<a href="%1$s" class="button button-primary" title="%2$s">%3$s</a>',
                    esc_url( add_query_arg(
                        array(
                            'plugin'                   => urlencode( $item['slug'] ),
                            'plugin_name'              => urlencode( $item['sanitized_plugin'] ),
                            'plugin_source'            => urlencode( $item['source'] ),
                            'massive-deactivate'       => 'deactivate-plugin',
                            'massive-deactivate-nonce' => wp_create_nonce( 'massive-deactivate' ),
                        ),
                        admin_url( 'admin.php?page=massive-plugins' )
                    ) ),
                    sprintf( esc_attr__( 'Deactivate %s', 'massive' ), $item['sanitized_plugin'] ),
                    esc_html__( 'Deactivate', 'massive' )
                ),
            );
        }

        return $actions;
    }

}

new Massive_Dashboard;
