<?php
function wp_styles_scripts() {
    wp_enqueue_style('bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css', array(), null, 'all');
	wp_enqueue_style('googlefonts', 'https://fonts.googleapis.com/css2?family=Barlow+Condensed:ital,wght@0,400;0,500;1,400&display=swap', array(), null, 'all');
	wp_enqueue_style('fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/solid.min.css', array(), null, 'all');
    wp_enqueue_style('fontawesome2', 'https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,400;0,700;1,400;1,700&display=swap', array(), null,'all');
	wp_enqueue_style('main', get_template_directory_uri().'/css/main.css', array(), null, 'all');
    wp_enqueue_script('instagram', get_template_directory_uri().'/js/instagram.min.js', array(), null, null);
    wp_enqueue_script('masonry', 'https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js', array(), null, null);
    wp_enqueue_script('bootstrap','https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js', array('jquery'), null, null);
    wp_enqueue_script('custom', get_template_directory_uri().'/js/custom.js', array('jquery'), null, null);
}
add_action('wp_enqueue_scripts', 'wp_styles_scripts');
remove_action('wp_head', 'wp_resource_hints', 2);
add_filter('use_default_gallery_style', '__return_false');
add_theme_support('title-tag');
function wpdocs_after_setup_theme() {
    add_theme_support( 'html5', array( 'search-form' ) );
}
add_action( 'after_setup_theme', 'wpdocs_after_setup_theme' );

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
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '<h2>',
        'after_title'   => '</h2>',
    ));
    register_sidebar( array(
        'name'          => __('Home Block Mid', 'improv'),
        'id'            => 'block-m',
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '<h2>',
        'after_title'   => '</h2>',
    ));
    register_sidebar( array(
        'name'          => __('Home Block Right', 'improv'),
        'id'            => 'block-r',
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '<h2>',
        'after_title'   => '</h2>',
    ));
    register_sidebar( array(
        'name'          => __('Board Members', 'improv'),
        'id'            => 'board-members',
        'before_widget' => '<article class="boardmember">',
        'after_widget'  => '</article>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ));
    register_sidebar( array(
        'name'          => __('Board Details', 'improv'),
        'id'            => 'board-details',
        'before_widget' => '<section class="board-details">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2>',
        'after_title'   => '</h2>',
    ));
    register_sidebar( array(
        'name'          => __('Documents', 'improv'),
        'id'            => 'documents',
        'before_widget' => '<article class="document">',
        'after_widget'  => '</article>',
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

// Add Custom Post Type 'Games' & Services
function add_games_soort() {
    $labels = array(
        'name'              => _x( 'Soorten', 'taxonomy general name', 'improv' ),
        'singular_name'     => _x( 'Soort', 'taxonomy singular name', 'improv' ),
        'search_items'      => __( 'Zoeken in Soorten', 'improv' ),
        'all_items'         => __( 'Alle Soorten', 'improv' ),
        'parent_item'       => null,
        'parent_item_colon' => null,
        'edit_item'         => __( 'Soort bewerken', 'improv' ),
        'update_item'       => __( 'Soort bijwerken', 'improv' ),
        'add_new_item'      => __( 'Soort toevoegen', 'improv' ),
        'new_item_name'     => __( 'Nieuwe Soortnaam', 'improv' ),
        'menu_name'         => __( 'Soort', 'improv' ),
    );
    $args = array(
        'hierarchical'      => false,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var'         => true,
        'rewrite'           => array('slug' => 'soort'),
    );
    register_taxonomy('soort', array('games'), $args);
}
add_action( 'init', 'add_games_soort', 0 );
function add_cpt_games() {
    register_post_type('games',
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
            'menu_icon' => 'dashicons-groups',
            'supports' => array('title','excerpt','editor','revisions','custom-fields'),
            'taxonomies' => array('soort'),
            'has_archive' => 'games',
            'rewrite' => array('slug' => 'game'),
            'delete_with_user' => false,
        )
    );
}
add_action( 'init', 'add_cpt_games' );
function add_cpt_services() {
    register_post_type( 'services',
        array(
            'labels' => array(
                'name'                => __( 'Services', 'Post Type General Name', 'improv' ),
                'singular_name'       => __( 'Service', 'Post Type Singular Name', 'improv' ),
                'menu_name'           => __( 'Services', 'improv' ),
                'parent_item_colon'   => __( 'Referral Service', 'improv' ),
                'all_items'           => __( 'All Services', 'improv' ),
                'view_item'           => __( 'View Service', 'improv' ),
                'add_new_item'        => __( 'Add New Service', 'improv' ),
                'add_new'             => __( 'Add New', 'improv' ),
                'edit_item'           => __( 'Edit Service', 'improv' ),
                'update_item'         => __( 'Update Service', 'improv' ),
                'search_items'        => __( 'Search Service', 'improv' ),
                'not_found'           => __( 'Not Found', 'improv' ),
                'not_found_in_trash'  => __( 'Not found in Trash', 'improv' ),
            ),
            'description' => 'Services',
            'public' => true,
            'menu_icon' => 'dashicons-welcome-learn-more',
            'supports' => array('title','excerpt','editor','revisions','custom-fields'),
            'taxonomies' => array('tag'),
            'has_archive' => 'services',
            'rewrite' => array('slug' => 'service'),
            'delete_with_user' => false,
        )
    );
}
add_action( 'init', 'add_cpt_services' );

include_once('func_comments.php');
include_once('func_emojis.php');
include_once('func_yoast.php');
