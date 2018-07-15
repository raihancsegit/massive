<?php
/**
 * Blog
 */
$massive_options[] = array(
    'name'     => 'massive-blog',
    'title'    => esc_html__( 'Blog', 'massive' ),
    'icon'     => 'fa fa-quote-left',
    'sections' => array(
        array(
            'name'   => 'blog_global',
            'title'  => esc_html__( 'Settings', 'massive' ),
            'icon'   => 'fa fa-wrench',
            'fields' => array(
                array(
                    'type'    => 'subheading',
                    'content' => esc_html__( 'Blog Title Layout', 'massive' ),
                ),
                array(
                    'id'         => 'blog_title_alignment',
                    'type'       => 'select',
                    'title'      => esc_html__( 'Title Alignment', 'massive' ),
                    'default'    => 'align-left',
                    'desc'       => esc_html__( 'Select title alignment from dropdown.', 'massive' ),
                    'options'    => array(
                        'align-left'   => esc_html__( 'Align Left', 'massive' ),
                        'align-center' => esc_html__( 'Align Center', 'massive' ),
                        'align-right'  => esc_html__( 'Align Right', 'massive' ),
                        )
                    ),
                array(
                    'id'    => 'blog_title_top_padding',
                    'type'  => 'text',
                    'title' => esc_html__( 'Title Top Padding', 'massive' ),
                    'default' => '50px',
                    'desc'  => massive_esc_desc( __( 'Set blog title top padding in pixels, for example %s. Default value is %s', 'massive' ), array('<code>100px</code>', '<code>50px</code>') ),
                    ),
                array(
                    'id'    => 'blog_title_bottom_padding',
                    'type'  => 'text',
                    'title' => esc_html__( 'Title Bottom Padding', 'massive' ),
                    'default' => '50px',
                    'desc'  => massive_esc_desc( __( 'Set blog title bottom padding in pixels, for example %s. Default value is %s', 'massive' ), array('<code>100px</code>', '<code>50px</code>') ),
                    ),
                array(
                    'id'    => 'blog_title_background',
                    'type'  => 'background',
                    'title' => esc_html__( 'Title Background', 'massive' ),
                    'desc'  => massive_esc_desc( __( 'Set blog title background image/color and adjust other relevant settings. Background default color is %s', 'massive' ), array('<code>#f5f5f5</code>') ),
                    'default' => array(
                        'repeat'     => 'no-repeat',
                        'attachment' => 'fixed',
                        'position'   => 'center top',
                        'color'      => '#f5f5f5',
                        ),
                    ),
                array(
                    'type'    => 'subheading',
                    'content' => esc_html__( 'Blog Title', 'massive' ),
                    ),
                array(
                    'id'      => 'blog_title_color',
                    'type'    => 'color_picker',
                    'title'   => esc_html__( 'Title Color', 'massive' ),
                    'desc'    => massive_esc_desc( __( 'Pick a color for title. Default color is %s', 'massive' ), array('<code>#222</code>') ),
                    'default' => '#222',
                    ),
                array(
                    'id'    => 'blog_title_font_size',
                    'type'  => 'text',
                    'title' => esc_html__( 'Title Font Size', 'massive' ),
                    'default' => '18px',
                    'desc'  => massive_esc_desc( __( 'Set blog title font size in pixels, for example %s. Default value is %s', 'massive' ), array('<code>36px</code>', '<code>18px</code>') ),
                    ),
                array(
                    'type'    => 'subheading',
                    'content' => esc_html__( 'Blog Breadcrumbs', 'massive' ),
                    ),
                array(
                    'id'      => 'display_blog_title_breadcrumb',
                    'type'    => 'switcher',
                    'title'   => esc_html__( 'Display Breadcrumbs', 'massive' ),
                    'desc'    => esc_html__( 'Switch on to display breadcrumb.', 'massive' ),
                    'default' => true,
                    ),
                array(
                    'id'         => 'blog_title_breadcrumb_color',
                    'type'       => 'color_picker',
                    'title'      => esc_html__( 'Breadcrumbs Color', 'massive' ),
                    'desc'       => massive_esc_desc( __( 'Breadcrumbs link color. Default color is %s', 'massive' ), array('<code>#7e7e7e</code>') ),
                    'default'    => '#7e7e7e',
                    'dependency' => array( 'display_blog_title_breadcrumb', '==', true ),
                    ),
                array(
                    'id'         => 'blog_title_breadcrumb_active_color',
                    'type'       => 'color_picker',
                    'title'      => esc_html__( 'Breadcrumbs Active Color', 'massive' ),
                    'desc'       => massive_esc_desc( __( 'Breadcrumbs active link color. Default color is %s', 'massive' ), array('<code>#222</code>') ),
                    'default'    => '#222',
                    'dependency' => array( 'display_blog_title_breadcrumb', '==', true ),
                    ),
                array(
                    'type'    => 'subheading',
                    'content' => esc_html__( 'Post Meta Data', 'massive' ),
                    ),
                array(
                    'id'      => 'show_post_meta',
                    'type'    => 'switcher',
                    'title'   => esc_html__( 'Display Post Meta', 'massive' ),
                    'default' => true,
                    'desc'    => esc_html__( 'Switch on to display post meta data.', 'massive'),
                    ),
                array(
                    'id'         => 'show_meta_post_author',
                    'type'       => 'switcher',
                    'title'      => esc_html__( 'Display Author Name', 'massive' ),
                    'default'    => true,
                    'dependency' => array('show_post_meta', '==', 'true'),
                    'desc'       => esc_html__( 'Switch on to display post author name.', 'massive'),
                    ),
                array(
                    'id'         => 'show_meta_post_category',
                    'type'       => 'switcher',
                    'title'      => esc_html__( 'Display Post Category', 'massive' ),
                    'default'    => true,
                    'dependency' => array('show_post_meta', '==', 'true'),
                    'desc'       => esc_html__( 'Switch on to display post category.', 'massive'),
                    ),
                array(
                    'id'         => 'show_meta_post_comments_no',
                    'type'       => 'switcher',
                    'title'      => esc_html__( 'Display Post Comment Link', 'massive' ),
                    'default'    => true,
                    'dependency' => array('show_post_meta', '==', 'true'),
                    'desc'       => esc_html__( 'Switch on to display post comment link.', 'massive'),
                    ),
                array(
                    'id'         => 'show_meta_post_time',
                    'type'       => 'switcher',
                    'title'      => esc_html__( 'Display Post Date', 'massive' ),
                    'default'    => true,
                    'dependency' => array('show_post_meta', '==', 'true'),
                    'desc'       => esc_html__( 'Switch on to display post date.', 'massive'),
                    ),
                array(
                    'type'    => 'subheading',
                    'content' => esc_html__( 'Post Read More', 'massive' ),
                    ),
                array(
                    'id'      => 'edit_details_btn_text',
                    'type'    => 'switcher',
                    'title'   => esc_html__( 'Modify Read More Button', 'massive' ),
                    'default' => false,
                    'desc'    => esc_html__( 'Switch on to modify post read more button.', 'massive'),
                    ),
                array(
                    'id'         => 'details_btn_text',
                    'type'       => 'text',
                    'title'      => esc_html__( 'Read More Button Text', 'massive' ),
                    'default'    => esc_html__( 'Continue Reading', 'massive' ),
                    'dependency' => array('edit_details_btn_text', '==', 'true'),
                    'desc'       => esc_html__( 'Add your read more button text.', 'massive')
                    ),
                array(
                    'type'    => 'subheading',
                    'content' => esc_html__( 'Post Date Format', 'massive' ),
                    ),
                array(
                    'id'      => 'date_format',
                    'type'    => 'text',
                    'title'   => esc_html__( 'Post Date Format', 'massive' ),
                    'default' => 'l, F jS, Y',
                    'desc'    => massive_esc_desc( __( 'Customize your post date format. Get more information from %s', 'massive'), array('<a href="http://codex.wordpress.org/Formatting_Date_and_Time">Formatting Date and Time</a>') ),
                    ),
                array(
                    'type'    => 'subheading',
                    'content' => esc_html__( 'Post Exceprt', 'massive' ),
                    ),
                array(
                    'id'    => 'custom_post_excerpt_length',
                    'type'  => 'switcher',
                    'title' => esc_html__( 'Customize Excerpt Length', 'massive' ),
                    'desc'  => esc_html__( 'Switch on to customize post excerpt length. Default is 50', 'massive')
                    ),
                array(
                    'id'         => 'post_excerpt_length',
                    'type'       => 'text',
                    'title'      => esc_html__( 'Post Excerpt Length', 'massive' ),
                    'default'    => 50,
                    'desc'       => esc_html__( 'Enter the post excerpt length for blog page', 'massive'),
                    'dependency' => array('custom_post_excerpt_length', '==', true)
                    ),
                )
            ),
        array(
            'name'   => 'massive-blog-home',
            'title'  => esc_html__( 'Home', 'massive' ),
            'icon'   => 'fa fa-comments',
            'fields' => array(
                array(
                    'id'      => 'blog_home_title',
                    'type'    => 'text',
                    'title'   => esc_html__( 'Blog Page Title', 'massive' ),
                    'default' => esc_html__( 'Blog', 'massive'),
                    'desc'    => esc_html__( 'Enter blog page title', 'massive'),
                    ),
                array(
                    'id'      => 'blog_layout',
                    'type'    => 'radio',
                    'title'   => esc_html__( 'Layout', 'massive' ),
                    'desc'    => esc_html__( 'Select blog page layout', 'massive' ),
                    'default' => 'boxed',
                    'options' => array(
                        'boxed'     => esc_html__( 'Boxed', 'massive'),
                        'fullwidth' => esc_html__( 'Fullwidth', 'massive'),
                        ),
                    ),
                array(
                    'id'         => 'blog_sidebar',
                    'type'       => 'radio',
                    'title'      => esc_html__( 'Sidebar', 'massive' ),
                    'desc'       => esc_html__( 'Select blog sidebar', 'massive' ),
                    'default'    => 'right',
                    'options'    => array(
                        'left'       => esc_html__( 'Sidebar Left', 'massive'),
                        'right'      => esc_html__( 'Sidebar Right', 'massive'),
                        'no-sidebar' => esc_html__( 'No Sidebar', 'massive'),
                        ),
                    ),
                array(
                    'id'         => 'blog_style',
                    'type'       => 'radio',
                    'title'      => esc_html__( 'List Style', 'massive' ),
                    'desc'       => esc_html__( 'Select blog list style', 'massive' ),
                    'default'    => 'classic',
                    'options'    => array(
                        'classic' => esc_html__( 'Classic', 'massive'),
                        'grid'    => esc_html__( 'Grid', 'massive'),
                        'masonry' => esc_html__( 'Masonry', 'massive'),
                        ),
                    ),
                array(
                    'id'         => 'blog_classic_style',
                    'type'       => 'image_select',
                    'title'      => esc_html__('Classic Style', 'massive'),
                    'default'    => 'one',
                    'desc'       => esc_html__( 'Select from classic style', 'massive' ),
                    'dependency' => array('blog_style_classic', '==', 'true'),
                    'options'    => array(
                            'one' => esc_url( $imgs . 'classic1.jpg' ),
                            'two' => esc_url( $imgs . 'classic2.jpg' ),
                        )
                    ),
                array(
                    'id'         => 'blog_grid_style',
                    'type'       => 'image_select',
                    'title'      => esc_html__('Grid Style', 'massive'),
                    'default'    => 'two',
                    'desc'       => esc_html__( 'Select from grid style', 'massive' ),
                    'dependency' => array('blog_style_grid', '==', 'true'),
                    'options'    => array(
                            'two'   => esc_url( $imgs . 'grid2.jpg' ),
                            'three' => esc_url( $imgs . 'grid3.jpg' ),
                            'four'  => esc_url( $imgs . 'grid4.jpg' ),
                        )
                    ),
                array(
                    'id'         => 'blog_masonry_style',
                    'type'       => 'image_select',
                    'title'      => esc_html__('Masonry Style', 'massive'),
                    'default'    => 'two',
                    'desc'       => esc_html__( 'Select from masonry style', 'massive' ),
                    'dependency' => array('blog_style_masonry', '==', 'true'),
                    'options'    => array(
                            'two'   => esc_url( $imgs . 'masonry2.jpg' ),
                            'three' => esc_url( $imgs . 'masonry3.jpg' ),
                            'four'  => esc_url( $imgs . 'masonry4.jpg' ),
                        )
                    ),
                array(
                    'id'      => 'blog_home_content',
                    'type'    => 'radio',
                    'title'   => esc_html__('Post Content', 'massive'),
                    'default' => 'excerpt',
                    'desc'    => esc_html__( 'Chose post content type for blog home page', 'massive' ),
                    'options' => array(
                            'excerpt'      => esc_html__( 'Excerpt', 'massive'),
                            'full-content' => esc_html__( 'Full Content', 'massive'),
                        )
                    ),
                )
            ),
        array(
            'name'   => 'massive-blog-archive',
            'title'  => esc_html__( 'Archive', 'massive' ),
            'icon'   => 'fa fa fa-archive',
            'fields' => array(
                array(
                    'id'      => 'show_featured_media_on_blog_archive',
                    'type'    => 'switcher',
                    'title'   => esc_html__( 'Featured Media', 'massive' ),
                    'default' => true,
                    'label'   => esc_html__( 'Switch to show/hide featured image/video/audio from archive blog listing page.', 'massive'),
                    ),
                array(
                    'id'         => 'blog_archive_content',
                    'type'       => 'radio',
                    'title'      => esc_html__('Post Content', 'massive'),
                    'default'    => 'excerpt',
                    'desc'       => esc_html__( 'Chose post content type for blog archive page', 'massive' ),
                    'options'    => array(
                            'title'        => esc_html__( 'Title Only', 'massive'),
                            'excerpt'      => esc_html__( 'Title With Excerpt', 'massive'),
                            'full-content' => esc_html__( 'Full Content', 'massive'),
                        )
                    ),
                )
            ),
        array(
            'name'   => 'massive-blog-details',
            'title'  => esc_html__( 'Single', 'massive' ),
            'icon'   => 'fa fa fa-pencil',
            'fields' => array(
                array(
                    'id'         => 'blog_details_layout',
                    'type'       => 'radio',
                    'title'      => esc_html__( 'Layout', 'massive' ),
                    'desc'       => esc_html__( 'Select blog\'s details page layout', 'massive' ),
                    'default'    => 'boxed',
                    'options'    => array(
                        'boxed'     => esc_html__( 'Boxed', 'massive'),
                        'fullwidth' => esc_html__( 'Fullwidth', 'massive'),
                        ),
                    ),
                array(
                    'id'      => 'blog_details_sidebar',
                    'type'    => 'radio',
                    'title'   => esc_html__('Sidebar', 'massive'),
                    'default' => 'right',
                    'desc'    => esc_html__( 'Select blog details page sidebar.', 'massive' ),
                    'options' => array(
                            'left'       => esc_html__( 'Sidebar Left', 'massive'),
                            'right'      => esc_html__( 'Sidebar Right', 'massive'),
                            'no-sidebar' => esc_html__( 'No Sidebar ', 'massive'),
                        )
                    ),
                array(
                    'id'      => 'show_tag_on_details',
                    'type'    => 'switcher',
                    'title'   => esc_html__( 'Tags', 'massive' ),
                    'default' => true,
                    'desc'    => esc_html__( 'Switch on to display post tags.', 'massive'),
                    ),
                array(
                    'type'    => 'subheading',
                    'content' => esc_html__( 'Related Posts', 'massive' )
                    ),
                array(
                    'id'      => 'show_related_posts',
                    'type'    => 'switcher',
                    'title'   => esc_html__( 'Display Related Posts', 'massive' ),
                    'default' => false,
                    'desc'    => esc_html__( 'Switch on to display related posts.', 'massive'),
                    ),
                array(
                    'id'         => 'no_of_related_posts',
                    'type'       => 'text',
                    'title'      => esc_html__( 'Number of Related Posts', 'massive' ),
                    'default'    => esc_html__( '4', 'massive'),
                    'dependency' => array('show_related_posts', '==', 'true'),
                    'desc'       => esc_html__( 'Input number of related post want to dispaly.', 'massive'),
                    ),
                array(
                    'id'         => 'related_posts_view',
                    'type'       => 'radio',
                    'title'      => esc_html__('Related Posts View', 'massive'),
                    'default'    => 'list',
                    'dependency' => array('show_related_posts', '==', 'true'),
                    'desc'       => esc_html__( 'Select related posts view.', 'massive' ),
                    'options'    => array(
                        'list'     => esc_html__( 'List View', 'massive' ),
                        'carousel' => esc_html__( 'Carousel View', 'massive' ),
                        )
                    ),
                array(
                    'type'    => 'subheading',
                    'content' => esc_html__( 'Social Share', 'massive' )
                    ),
                array(
                    'id'      => 'share_single_post',
                    'type'    => 'switcher',
                    'title'   => esc_html__( 'Display Social Share', 'massive' ),
                    'default' => true,
                    'desc'   => esc_html__( 'Switch on to display social share.', 'massive' ),
                    ),
                array(
                    'id'         => 'post_social_shares',
                    'type'       => 'sorter',
                    'title'      => esc_html__( 'Social Share', 'massive' ),
                    'dependency' => array('share_single_post', '==', 'true'),
                    'default'    => array(
                    'enabled'        => array(
                        'email'      => esc_html__( 'Email', 'massive' ),
                        'twitter'    => esc_html__( 'Twitter', 'massive' ),
                        'facebook'   => esc_html__( 'Facebook', 'massive' ),
                        'googleplus' => esc_html__( 'Google Plus', 'massive' ),
                        'linkedin'   => esc_html__( 'Linkedin', 'massive' ),
                        'pinterest'  => esc_html__( 'Pinterest', 'massive' ),
                        ),
                    'disabled'     => array(
                        'wordpress'   => esc_html__( 'WordPress', 'massive' ),
                        'stumbleupon' => esc_html__( 'Stumble Upon', 'massive' ),
                        'reddit'      => esc_html__( 'Rddit', 'massive' ),
                        'tumblr'      => esc_html__( 'Tumblr', 'massive' ),
                        'digg'        => esc_html__( 'Digg', 'massive' ),
                        ),
                    ),
                    'enabled_title'  => esc_html__( 'Active Social Share', 'massive' ),
                    'disabled_title' => esc_html__( 'Inactive Social Share', 'massive' )
                    ),
                )
            )
        )
    );
