<div class="MassiveDashboard__body direction-list">

    <div class="direction-item">
        <h3><?php esc_html_e( 'Online Documentation', 'massive' ); ?></h3>
        <p><?php echo wp_kses_data( __( 'Checkout Massive online documentation and stay up to date. It is very detailed and easy to use and navigate.', 'massive' ) ); ?></p>
        <a class="button button-primary" target="_blank" href="http://massivedemo.lab.themebucket.net/documentation.html"><?php esc_html_e( 'Read Online', 'massive' ); ?></a>
    </div>
    <div class="direction-item">
        <h3><?php esc_html_e( 'Required Plugin Installer', 'massive' ); ?></h3>
        <p><?php echo wp_kses_data( __( 'Massive depends on <strong>Massive Engine (must use)</strong> as well as some 3rd party plugins. Install those plugins according to your need.', 'massive' ) ); ?></p>
        <a class="button button-primary" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'massive-plugins' ), 'admin.php' ) ) ); ?>"><?php esc_html_e( 'Install Plugins', 'massive' ); ?></a>
    </div>
    <div class="direction-item">
        <h3><?php esc_html_e( 'One Click Demo Installer', 'massive' ); ?></h3>
        <p><?php echo wp_kses_data( __( 'Massive integrated <strong>One Click</strong> demo installation feature. You can easily import all the demo data within a few minutes.', 'massive' ) ); ?></p>

        <?php if ( massive_has_ocdi() ) { ?>
            <a class="button button-primary" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'massive-demo-importer' ), 'themes.php' ) ) ); ?>"><?php esc_html_e( 'Install Demo', 'massive' ); ?></a>
        <?php } else { ?>
            <a class="button button-primary button-larger" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'massive-plugins' ), 'admin.php' ) ) ); ?>"><?php esc_html_e( 'Install: One Click Demo Import', 'massive' ); ?></a>
        <?php } ?>
    </div>
    <div class="direction-item">
        <h3><?php esc_html_e( 'Theme Options Panel', 'massive' ); ?></h3>
        <p><?php echo wp_kses_data( __( 'Massive has very intuitive and rich theme options panel. You can control almost everything from the panel.', 'massive' ) ); ?></p>
        <a class="button button-primary" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'theme-options' ), 'themes.php' ) ) ); ?>"><?php esc_html_e( 'Setup Options', 'massive' ); ?></a>
    </div>
    <br class="clear">
</div>
