<?php
/**
 * MegaMenu front walker.
 *
 * @package Massive
 * @author ThemeBucket <themebucket@gmail.com>
 */

class Massive_Megamenu_Walker extends Walker_Nav_Menu {

    /**
     * Current menu item status for megamenu
     * @var string
     */
    private $is_megamenu;

    /**
     * Current menu level
     * @var bool
     */
    private $megamenu_lvl = false;

    /**
     * Megamenu width
     * @var string
     */
    private $width;

    /**
     * Parent of current element
     * @var int
     */
    private $current_parent;

    /**
     * Starts the list before the elements are added.
     *
     * @see Walker::start_lvl()
     *
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param int    $depth  Depth of menu item. Used for padding.
     * @param array  $args   An array of arguments. @see wp_nav_menu()
     */
    public function start_lvl( &$output, $depth = 0, $args = array() ) {
        /**
         * Supported megamenu width
         * @var array
         */
        $avail_width = array('full', 'half', 'quarter');

        $is_megamenu_col = get_post_meta( $this->current_parent, '_menu_item_massive_megamenu_enabled', true );

        if ( 0 == $depth && 'yes' === $this->is_megamenu ) {
            $this->megamenu_lvl = true;
        } elseif ( 0 == $depth && 'yes' !== $this->is_megamenu ) {
            $this->megamenu_lvl = false;
        }

        if ( 0 == $depth && 'yes' == $this->is_megamenu ) {
            if ( in_array( $this->width, $avail_width ) ) {
                $classes = "megamenu-{$this->width}-width";
            }
            $output .= "\n<div class=\"megamenu ".esc_attr($classes)."\" aria-hidden=\"true\">";
                $output .= "\n<div class=\"megamenu-row\">\n";
        } elseif ( 1 == $depth && 'yes' == $is_megamenu_col ) {
            $output .= "\n<ul class=\"list-unstyled\" role=\"menu\">\n";
        } else {
            $output .= "\n<ul class=\"dropdown\" role=\"menu\" aria-hidden=\"true\">\n";
        }
    }

    /**
     * Ends the list of after the elements are added.
     *
     * @see Walker::end_lvl()
     *
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param int    $depth  Depth of menu item. Used for padding.
     * @param array  $args   An array of arguments. @see wp_nav_menu()
     */
    public function end_lvl( &$output, $depth = 0, $args = array() ) {
        if ( 0 == $depth && $this->megamenu_lvl ) {
                $output .= "\t</div>\n";
            $output .= "\n</div>\n";
        } else {
            $output .= "</ul>\n";
        }
    }

    /**
     * Start the element output.
     *
     * @see Walker::start_el()
     *
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param object $item   Menu item data object.
     * @param int    $depth  Depth of menu item. Used for padding.
     * @param array  $args   An array of arguments. @see wp_nav_menu()
     * @param int    $id     Current item ID.
     */
    public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

        $this->is_megamenu = isset( $item->massive_megamenu_enabled ) ? $item->massive_megamenu_enabled : '';
        $this->width = isset( $item->massive_megamenu_width ) ? $item->massive_megamenu_width : '';
        $this->current_parent = $item->menu_item_parent;

        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        /**
         * Parent item megamenu status
         * @var string
         */
        $is_megamenu_col = get_post_meta( $item->menu_item_parent, '_menu_item_massive_megamenu_enabled', true );

        /**
         * Megamenu coloumn width
         * @var string
         */
        $colwidth = isset( $item->massive_megamenu_colwidth ) ? absint( $item->massive_megamenu_colwidth ) : 4;

        /**
         * Megamenu widget area
         * @var string
         */
        $widgetarea = isset( $item->massive_megamenu_widgetarea ) ? $item->massive_megamenu_widgetarea : 'blank';

        /**
         * Megamenu column title visibility
         * @var string
         */
        $is_title_hidden = isset( $item->massive_megamenu_title ) ? $item->massive_megamenu_title : '';


        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        /**
         * Filter the CSS class(es) applied to a menu item's list item element.
         *
         * @since 3.0.0
         * @since 4.1.0 The `$depth` parameter was added.
         *
         * @param array  $classes The CSS classes that are applied to the menu item's `<li>` element.
         * @param object $item    The current menu item.
         * @param array  $args    An array of {@see wp_nav_menu()} arguments.
         * @param int    $depth   Depth of menu item. Used for padding.
         */
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );

        $class_names .= ( in_array( 'current-menu-item', $classes ) ) ? ' active' : '';

        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

        /**
         * Filter the ID applied to a menu item's list item element.
         *
         * @since 3.0.1
         * @since 4.1.0 The `$depth` parameter was added.
         *
         * @param string $menu_id The ID that is applied to the menu item's `<li>` element.
         * @param object $item    The current menu item.
         * @param array  $args    An array of {@see wp_nav_menu()} arguments.
         * @param int    $depth   Depth of menu item. Used for padding.
         */
        $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth );
        $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

        if ( 1 == $depth && 'yes' == $is_megamenu_col ) {
            $output .= $indent . "<div class=\"col".esc_attr($colwidth)."\">\n";
        } else {
            $output .= $indent . '<li' . $id . $class_names .' role="menuitem">';
        }

        $atts = array();
        $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
        $atts['target'] = ! empty( $item->target )     ? $item->target     : '';
        $atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
        $atts['href']   = ! empty( $item->url )        ? $item->url        : '';

        /*
         * Filter the HTML attributes applied to a menu item's anchor element.
         *
         * @since 3.6.0
         * @since 4.1.0 The `$depth` parameter was added.
         *
         * @param array $atts {
         *     The HTML attributes applied to the menu item's `<a>` element, empty strings are ignored.
         *
         *     @type string $title  Title attribute.
         *     @type string $target Target attribute.
         *     @type string $rel    The rel attribute.
         *     @type string $href   The href attribute.
         * }
         * @param object $item  The current menu item.
         * @param array  $args  An array of {@see wp_nav_menu()} arguments.
         * @param int    $depth Depth of menu item. Used for padding.
         */

        $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

        $attributes = '';
        foreach ( $atts as $attr => $value ) {
            if ( ! empty( $value ) ) {
                $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $item_output = isset( $args->before ) ? $args->before : '';
        $item_output .= '<a'. $attributes .'>';
        $item_output .= ( ! empty( $item->massive_megamenu_icon ) ) ? '<i class="massive-menu-icon ' . esc_attr( $item->massive_megamenu_icon ) . '"></i>' : '';
        /** This filter is documented in wp-includes/post-template.php */
        $item_output .= isset( $args->link_before ) ? $args->link_before : '';
        $item_output .= apply_filters( 'the_title', $item->title, $item->ID );
        $item_output .= isset( $args->link_after ) ? $args->link_after : '';
        $item_output .= '</a>';
        $item_output .= isset( $args->after ) ? $args->after : '';

        if ( 1 == $depth && 'yes' == $is_megamenu_col && 'yes' != $is_title_hidden ) {
            $anchor_tag = "\n<h3 class=\"h4 megamenu-col-title\">{$item_output}</h3>\n{WIDGET_AREA}";
        } elseif ( 1 == $depth && 'yes' == $is_megamenu_col && 'yes' == $is_title_hidden ) {
            $anchor_tag = '{WIDGET_AREA}';
        } else {
            $anchor_tag = $item_output;
        }

        /**
         * Widget area
         */
        if ( 1 == $depth && 'yes' == $is_megamenu_col ) {
            $widgets = '';
            if ( 'blank' != $widgetarea ) {
                $widgets .= "\n<div class=\"megamenu-widget-area\">\n";
                ob_start();
                dynamic_sidebar( $widgetarea );
                $widgets .= ob_get_clean() . "\n</div>\n";
            }
            $anchor_tag = str_replace( '{WIDGET_AREA}', $widgets, $anchor_tag );
        }

        /**
         * Filter a menu item's starting output.
         *
         * The menu item's starting output only includes `$args->before`, the opening `<a>`,
         * the menu item's title, the closing `</a>`, and `$args->after`. Currently, there is
         * no filter for modifying the opening and closing `<li>` for a menu item.
         *
         * @since 3.0.0
         *
         * @param string $anchor_tag The menu item's starting HTML output.
         * @param object $item        Menu item data object.
         * @param int    $depth       Depth of menu item. Used for padding.
         * @param array  $args        An array of {@see wp_nav_menu()} arguments.
         */
        $output .= apply_filters( 'walker_nav_menu_start_el', $anchor_tag, $item, $depth, $args );
    }

    /**
     * Ends the element output, if needed.
     *
     * @see Walker::end_el()
     *
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param object $item   Page data object. Not used.
     * @param int    $depth  Depth of page. Not Used.
     * @param array  $args   An array of arguments. @see wp_nav_menu()
     */
    public function end_el( &$output, $item, $depth = 0, $args = array() ) {
        $this->is_megamenu = isset( $item->massive_megamenu_enabled ) ? $item->massive_megamenu_enabled : '';

        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        /**
         * Parent item megamenu status
         * @var string
         */
        $is_megamenu_col = get_post_meta( $item->menu_item_parent, '_menu_item_massive_megamenu_enabled', true );

        if ( 1 == $depth && 'yes' == $is_megamenu_col ) {
            $output .= $indent . "\n</div>\n";
        } else {
            $output .= $indent . "</li>\n";
        }
    }

    /**
     * Menu Fallback
     * =============
     * If this function is assigned to the wp_nav_menu's fallback_cb variable
     * and a manu has not been assigned to the theme location in the WordPress
     * menu manager the function with display nothing to a non-logged in user,
     * and will add a link to the WordPress menu manager if logged in as an admin.
     *
     * @param array $args passed from the wp_nav_menu function.
     *
     */
    public static function fallback( $args ) {
        if ( current_user_can( 'manage_options' ) ) {
            extract( $args );
            $fb_output = null;
            if ( $container ) {
                $fb_output = '<' . $container;
                if ( $container_id )
                    $fb_output .= ' id="' . esc_attr( $container_id ) . '"';
                if ( $container_class )
                    $fb_output .= ' class="' . esc_attr( $container_class ) . '"';
                $fb_output .= '>';
            }
            $fb_output .= '<ul';
            if ( $menu_id )
                $fb_output .= ' id="' . esc_attr( $menu_id ) . '"';
            if ( $menu_class )
                $fb_output .= ' class="' . esc_attr( $menu_class ) . '"';
            $fb_output .= '>';
            $fb_output .= '<li><a href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '">' . esc_html__( 'Add a menu', 'massive' ) . '</a></li>';
            $fb_output .= '</ul>';
            if ( $container )
                $fb_output .= '</' . $container . '>';
            echo $fb_output;
        }
    }

}
