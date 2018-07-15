<?php
/**
 * MegaMenu controller.
 *
 * @package Massive
 * @author ThemeBucket <themebucket@gmail.com>
 */

class Massive_Megamenu {

    public function __construct() {
        add_action( 'massive_nav_menu_edit_custom_fields', array($this, 'add_megamenu_fields'), 10, 4 );
        add_action( 'massive_nav_menu_edit_custom_fields', array($this, 'add_common_fields'), 15, 4 );

        add_filter( 'wp_edit_nav_menu_walker', array($this, 'set_edit_walker') );

        add_action( 'admin_enqueue_scripts', array($this, 'enqueue_script') );

        add_action( 'wp_update_nav_menu_item', array($this, 'save_fields_data'), 10, 3 );
        add_filter( 'wp_setup_nav_menu_item', array($this, 'set_fields_data_to_menu') );

        $this->icons = apply_filters( 'massive_menu_icons', array() );

        add_action( 'admin_footer', array($this, 'render_icons') );

        $this->load_front_walker();
    }

    public function render_icons() {
        if ( count( $this->icons ) ) {
            echo '<ul id="js-menu-icon-list" class="menu-icon-list" style="display:none">';
                foreach ( $this->icons as $icon ) {
                    echo '<li class="menu-icon-list-item '. esc_attr( $icon ) . '"></i>' . "\n";
                }
            echo '</ul>';
        }
    }

    public function set_edit_walker( $walker ) {
        $this->load_edit_walker();
        return 'Massive_Megamenu_Walker_Edit';
    }

    public function enqueue_script( $hook ) {
        if ( 'nav-menus.php' == $hook ) {
            wp_enqueue_script( 'massive-megamenu', get_template_directory_uri() . '/assets/admin/js/megamenu.js', array('jquery'), '1.0.0', true );
        }
    }

    public function add_common_fields( $item_id, $item, $depth, $args ) {
        ?>
        <div class="menu-item-icon-wrapper field-icon description description-wide js-icon-field">
            <label for="edit-menu-item-icon-<?php echo $item_id; ?>">
                <span class="field-icon-label"><?php esc_html_e( 'Menu Icon (Click on the box to change icon)', 'massive' ); ?></span>
                <span class="menu-item-icon js-menu-item-icon"><?php if ( isset( $item->massive_megamenu_icon ) ) echo '<i class="' . $item->massive_megamenu_icon . '"></i>' ; ?></span>
                <input type="hidden" id="edit-menu-item-icon-<?php echo $item_id; ?>" name="massive-menu-item[<?php echo $item_id; ?>][icon]" value="<?php echo esc_attr( $item->massive_megamenu_icon ); ?>" />
            </label>
            <div class="menu-icon-list-wrapper js-menu-icon-list-wrapper" style="display:none"><!-- placeholder for icon list --></div>
        </div>
        <?php
    }

    public function add_megamenu_fields( $item_id, $item, $depth, $args ) {
        ?>
        <div class="massive-megamenu-fields-row">
            <p class="field-megamenu-enabled description description-wide">
                <label for="edit-menu-item-megamenu-enabled-<?php echo $item_id; ?>">
                    <input
                        type="checkbox"
                        class="edit-menu-item-is-megamenu"
                        id="edit-menu-item-megamenu-enabled-<?php echo $item_id; ?>"
                        name="massive-menu-item[<?php echo $item_id; ?>][enabled]"
                        <?php checked( $item->massive_megamenu_enabled, 'yes' ); ?>
                        value="yes" />
                    <strong><?php esc_html_e( 'Enable Massive Mega Menu', 'massive' ); ?></strong>
                </label>
            </p>
            <p class="field-megamenu-width description description-wide">
                <label for="edit-menu-item-megamenu-width-<?php echo $item_id; ?>"><?php esc_html_e( 'Mega Menu Width', 'massive' ); ?></label>
                <select
                    class="widefat code"
                    id="edit-menu-item-megamenu-width-<?php echo $item_id; ?>"
                    name="massive-menu-item[<?php echo $item_id; ?>][width]">
                    <option value="full" <?php selected( $item->massive_megamenu_width, 'full' ); ?>><?php esc_html_e( 'Full Width (100%)', 'massive' ); ?></option>
                    <option value="half" <?php selected( $item->massive_megamenu_width, 'half' ); ?>><?php esc_html_e( 'Half Width (50%)', 'massive' ); ?></option>
                    <option value="quarter" <?php selected( $item->massive_megamenu_width, 'quarter' ); ?>><?php esc_html_e( 'Quarter Width (25%)', 'massive' ); ?></option>
                </select>
            </p>
        </div>
        <div class="massive-megamenu-fields-column">
            <p class="field-megamenu-columntitle description description-wide">
                <label for="edit-menu-item-megamenu-columntitle-<?php echo $item_id; ?>">
                    <input
                        type="checkbox"
                        id="edit-menu-item-megamenu-columntitle-<?php echo $item_id; ?>"
                        name="massive-menu-item[<?php echo $item_id; ?>][title]"
                        <?php checked( $item->massive_megamenu_title, 'yes' ); ?>
                        value="yes" />
                    <?php esc_html_e( 'Hide Mega Menu Column Title', 'massive' ); ?>
                </label>
            </p>
            <p class="field-megamenu-colwidth description description-wide">
                <label for="edit-menu-item-megamenu-colwidth-<?php echo $item_id; ?>"><?php esc_html_e( 'Mega Menu Column Width', 'massive' ); ?></label>
                <select class="widefat code" id="edit-menu-item-megamenu-colwidth-<?php echo $item_id; ?>" name="massive-menu-item[<?php echo $item_id; ?>][colwidth]">
                    <?php
                    $colwidth = ( ! empty( $item->massive_megamenu_colwidth ) ) ? $item->massive_megamenu_colwidth : 4;
                    foreach ( range(1, 12) as $num ) { ?>
                        <option value="<?php echo $num; ?>" <?php selected( $colwidth, $num ); ?>>
                            <?php echo massive_esc_desc( _n( 'Column %s of 12 (%s)', 'Columns %s of 12 (%s)', $num, 'massive' ), array($num, round( ( 100 / 12 ) * $num, 2 ) ) ) . '%'; ?>
                        </option>
                    <?php } ?>
                </select>
            </p>
            <p class="field-megamenu-widgetarea description description-wide">
                <label for="edit-menu-item-megamenu-widgetarea-<?php echo $item_id; ?>"><?php esc_html_e( 'Mega Menu Widget Area', 'massive' ); ?></label>
                <select class="widefat code" id="edit-menu-item-megamenu-widgetarea-<?php echo $item_id; ?>" name="massive-menu-item[<?php echo $item_id; ?>][widgetarea]">
                    <option value=""><?php esc_html_e( 'Blank Widget Area', 'massive' ); ?></option>
                    <?php
                    $widgetAreas = massive_get_sidebar_list();
                    foreach ( $widgetAreas as $val => $name ) {
                        printf( '<option value="%s" %s>%s</option>', $val, selected( $item->massive_megamenu_widgetarea, $val ), $name );
                    }
                    ?>
                </select>
            </p>
        </div>

        <?php
    }

    public function save_fields_data( $menu_id, $menu_item_db_id, $args ) {
        if ( ! isset( $_POST['massive-menu-item'] ) ) {
            return;
        }

        // Column fields
        $fields = array( 'title', 'colwidth', 'widgetarea', 'icon' );

        // Row fields
        if ( ! $args['menu-item-parent-id'] ) {
            $fields = array( 'enabled', 'width', 'icon' );
        }

        $menu_item = $_POST['massive-menu-item'];

        foreach ( $fields as $field ) {
            if ( ! isset( $menu_item[$menu_item_db_id] ) || ! isset( $menu_item[$menu_item_db_id][$field] ) ) {
                $menu_item[$menu_item_db_id][$field] = '';
            }
            $value = sanitize_text_field( $menu_item[$menu_item_db_id][$field] );
            update_post_meta( $menu_item_db_id, "_menu_item_massive_megamenu_{$field}", $value );
        }
    }

    public function set_fields_data_to_menu( $menu_item ) {

        if ( ! $menu_item->menu_item_parent ) {
            $menu_item->massive_megamenu_enabled = get_post_meta( $menu_item->ID, '_menu_item_massive_megamenu_enabled', true );
            $menu_item->massive_megamenu_width = get_post_meta( $menu_item->ID, '_menu_item_massive_megamenu_width', true );
        } else {
            $menu_item->massive_megamenu_title = get_post_meta( $menu_item->ID, '_menu_item_massive_megamenu_title', true );
            $menu_item->massive_megamenu_colwidth = get_post_meta( $menu_item->ID, '_menu_item_massive_megamenu_colwidth', true );
            $menu_item->massive_megamenu_widgetarea = get_post_meta( $menu_item->ID, '_menu_item_massive_megamenu_widgetarea', true );
        }

        $menu_item->massive_megamenu_icon = get_post_meta( $menu_item->ID, '_menu_item_massive_megamenu_icon', true );

        return $menu_item;
    }

    private function load_edit_walker() {
        require_once MASSIVE_INCLUDES_DIR . 'class.megamenu-walker-edit.php';
    }

    private function load_front_walker() {
        require_once MASSIVE_INCLUDES_DIR . 'class.megamenu-walker.php';
    }

}

new Massive_Megamenu;
