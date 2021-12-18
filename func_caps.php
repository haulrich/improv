<?php
if ((int) get_option( 'wp_page_for_privacy_policy' ) === $post->ID) {
    $caps = array_merge( $caps, map_meta_cap( 'manage_privacy_options', $user_id ) );
}
function custom_manage_privacy_options($caps, $cap, $user_id, $args) {
    if (!is_user_logged_in()) return $caps;

    if ('manage_privacy_options' === $cap) {
        $manage_name = is_multisite() ? 'manage_network' : 'manage_options';
        $caps = array_diff($caps, [ $manage_name ]);
    }
    return $caps;
}
add_action('map_meta_cap', 'custom_manage_privacy_options', 1, 4);