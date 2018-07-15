<?php
$tgmpa = TGM_Plugin_Activation::get_instance();
$registered_plugins = $tgmpa->plugins;
$installed_plugins = get_plugins();
?>

<div class="MassiveDashboard__body theme-browser required-plugins">
    <div class="themes">
        <?php
        foreach( $registered_plugins as $plugin ) {
            $class = '';
            $plugin_status = '';
            $file_path = $plugin['file_path'];
            $plugin_action = $this->get_plugin_url( $plugin );

            if( is_plugin_active( $file_path ) ) {
                $plugin_status = 'active';
                $class = 'active';
            }
            ?>
            <div class="theme <?php echo esc_attr( $class ); ?>">
                <div class="theme-screenshot">
                    <img src="<?php echo esc_url( $plugin['image_url'] ); ?>" alt="" />
                </div>
                <h3 class="theme-name">
                    <?php
                    if ( $plugin_status == 'active' ) {
                        printf( '<span>%s</span> ', esc_html__( 'Active:', 'massive' ) );
                    }
                    echo esc_html( $plugin['name'] );
                    ?>
                </h3>
                <div class="theme-actions">
                    <?php foreach( $plugin_action as $action ) { echo $action; } ?>
                </div>
                <?php if ( isset( $plugin_action['update'] ) && $plugin_action['update'] ) { ?>
                    <div class="theme-update"><?php printf( esc_html__( 'Update Available: Version %s', 'massive' ), $plugin['version'] ); ?></div>
                <?php } ?>
                <?php if ( $plugin['required'] ) { ?>
                    <div class="is-required">
                        <?php esc_html_e( 'Required', 'massive' ); ?>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
        <br class="clear">
    </div>
</div>


