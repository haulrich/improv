<?php
function wp_styles_scripts() {
    wp_enqueue_style('bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css', array(), null, 'all');
	wp_enqueue_style('googlefonts', 'https://fonts.googleapis.com/css2?family=Barlow+Condensed:ital,wght@0,400;0,500;1,400&display=swap', array(), null, 'all');
    wp_enqueue_style('fontawesome', 'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', array(), null, 'all');
    wp_enqueue_style('main', get_template_directory_uri().'/main.css', array(), null, 'all');
    wp_enqueue_script('bootstrap','https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js', array('jquery'), null, null);
    wp_enqueue_script('custom', get_template_directory_uri().'/js/custom.js', array('jquery'), null, null);
}
add_action('wp_enqueue_scripts', 'wp_styles_scripts');
remove_action('wp_head', 'wp_resource_hints', 2);
add_filter('use_default_gallery_style', '__return_false');
add_theme_support('title-tag');

function extend_body_class($classes)
{
    $include = array
    (
        'is-archive'           => is_archive(),
        'is-post_type_archive' => is_post_type_archive(),
        'is-attachment'        => is_attachment(),
        'is-author'            => is_author(),
        'is-category'          => is_category(),
        'is-tag'               => is_tag(),
        'is-tax'               => is_tax(),
        'is-date'              => is_date(),
        'is-day'               => is_day(),
        'is-feed'              => is_feed(),
        'is-comment-feed'      => is_comment_feed(),
        'is-front-page'        => is_front_page(),
        'is-home'              => is_home(),
        'is-privacy-policy'    => is_privacy_policy(),
        'is-month'             => is_month(),
        'is-page'              => is_page(),
        'is-paged'             => is_paged(),
        'is-preview'           => is_preview(),
        'is-robots'            => is_robots(),
        'is-search'            => is_search(),
        'is-single'            => is_single(),
        'is-singular'          => is_singular(),
        'is-time'              => is_time(),
        'is-trackback'         => is_trackback(),
        'is-year'              => is_year(),
        'is-404'               => is_404(),
        'is-embed'             => is_embed(),
        //'contact'              => is_page('contact'),
    );
    foreach ( $include as $class => $do_include )
    {
        if ( $do_include ) $classes[ $class ] = $class;
    }
    return $classes;
}
add_filter('body_class', 'extend_body_class');

function register_improv_sidebars() {
    register_sidebar( array(
        'name'          => __('Logo', 'improv'),
        'id'            => 'logo',
        'before_widget' => null,
        'after_widget'  => null,
        'before_title'  => null,
        'after_title'   => null,
    ));
    register_sidebar( array(
        'name'          => __('Home Fixed Photo', 'improv'),
        'id'            => 'fixed-photo',
        'before_widget' => '<section class="fixed-photo">',
        'after_widget'  => '</section>',
        'before_title'  => null,
        'after_title'   => null,
    ));
    register_sidebar( array(
        'name'          => __('Home Block Left', 'improv'),
        'id'            => 'block-l',
        'before_widget' => '<section class="block block-l">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2>',
        'after_title'   => '</h2>',
    ));
    register_sidebar( array(
        'name'          => __('Home Block Mid', 'improv'),
        'id'            => 'block-m',
        'before_widget' => '<section class="block block-m">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2>',
        'after_title'   => '</h2>',
    ));
    register_sidebar( array(
        'name'          => __('Home Block Right', 'improv'),
        'id'            => 'block-r',
        'before_widget' => '<section class="block block-r">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2>',
        'after_title'   => '</h2>',
    ));
}
add_action('widgets_init', 'register_improv_sidebars');

/* Register Header Menu */
function wp_menus() {
    register_nav_menus(
        array(
            'header-menu' => __( 'Header Menu' )
        )
    );
}
add_action( 'init', 'wp_menus' );

/* Disable Emoji's */
function disable_emojis() {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
    add_filter( 'wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2 );
}
add_action( 'init', 'disable_emojis' );
function disable_emojis_tinymce( $plugins ) {
    if ( is_array( $plugins ) ) {
        return array_diff( $plugins, array( 'wpemoji' ) );
    } else {
        return array();
    }
}
function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
    if ( 'dns-prefetch' == $relation_type ) {
        /** This filter is documented in wp-includes/formatting.php */
        $emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );

        $urls = array_diff( $urls, array( $emoji_svg_url ) );
    }

    return $urls;
}
function filter_media_comment_status( $open, $post_id ) {
    $post = get_post( $post_id );
    if( $post->post_type == 'attachment' ) {
        return false;
    }
    return $open;
}
add_filter('comments_open', 'filter_media_comment_status', 10 , 2);

/* Disable all Comment functions */
add_action('admin_init', function () {
    // Redirect any user trying to access comments page
    global $pagenow;

    if ($pagenow === 'edit-comments.php') {
        wp_redirect(admin_url());
        exit;
    }

    // Remove comments metabox from dashboard
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');

    // Disable support for comments and trackbacks in post types
    foreach (get_post_types() as $post_type) {
        if (post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
});
add_filter('comments_open', '__return_false', 20, 2);
add_filter('pings_open', '__return_false', 20, 2);
add_filter('comments_array', '__return_empty_array', 10, 2);
add_action('admin_menu', function () {
    remove_menu_page('edit-comments.php');
});
add_action('init', function () {
    if (is_admin_bar_showing()) {
        remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
    }
});

/* add slugs to admin columns */
function set_slug_column($columns) {
    $columns['slug'] = 'Slug';
    return $columns;
}
function slug_in_column($column, $post_id) {
    if ('slug' === $column ) {
        echo get_post_field('post_name', get_post());
    }
}
/* Posts */
add_filter('manage_post_posts_columns', 'set_slug_column');
add_action( 'manage_post_posts_custom_column', 'slug_in_column', 5, 2);
/* Pages */
add_filter('manage_pages_columns', 'set_slug_column');
add_action( 'manage_pages_custom_column', 'slug_in_column', 10, 2);
/* Games */
add_filter('manage_games_posts_columns', 'set_slug_column');
add_action( 'manage_games_posts_custom_column', 'slug_in_column', 5, 2);

// Add Custom Post Type 'Games'
function add_cpt_games() {
    register_post_type( 'games',
        array(
            'labels' => array(
                'name'                => __( 'Games', 'Post Type General Name', 'improv' ),
                'singular_name'       => __( 'Game', 'Post Type Singular Name', 'improv' ),
                'menu_name'           => __( 'Games', 'improv' ),
                'parent_item_colon'   => __( 'Referral Game', 'improv' ),
                'all_items'           => __( 'All Games', 'improv' ),
                'view_item'           => __( 'View Game', 'improv' ),
                'add_new_item'        => __( 'Add New Game', 'improv' ),
                'add_new'             => __( 'Add New', 'improv' ),
                'edit_item'           => __( 'Edit Game', 'improv' ),
                'update_item'         => __( 'Update Game', 'improv' ),
                'search_items'        => __( 'Search Game', 'improv' ),
                'not_found'           => __( 'Not Found', 'improv' ),
                'not_found_in_trash'  => __( 'Not found in Trash', 'improv' ),
            ),
            'description' => 'Game database',
            'public' => true,
            'menu_icon' => 'dashicons-format-status',
            'supports' => array('title','excerpt','editor','revisions','custom-fields'),
            'taxonomies' => array('tag'),
            'has_archive' => 'games',
            'rewrite' => array(
                'slug' => 'game',
                'with_front' => true,
                ),
            'delete_with_user' => false,
        )
    );
}
add_action( 'init', 'add_cpt_games' );