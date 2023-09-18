<?php

define('MY_ACF_PATH', get_stylesheet_directory() . '/inc/acf/');
define('MY_ACF_URL', get_stylesheet_directory_uri() . '/inc/acf/');

// Include the ACF plugin.
include_once(MY_ACF_PATH . 'acf.php');

// Customize the url setting to fix incorrect asset URLs.
add_filter('acf/settings/url', 'my_acf_settings_url');
function my_acf_settings_url($url)
{
    return MY_ACF_URL;
}

// If the user is not an admin
if (!current_user_can('manage_options')) {
    // (Optional) Hide the ACF admin menu item.
    add_filter('acf/settings/show_admin', '__return_false');

    // When including the PRO plugin, hide the ACF Updates menu
    add_filter('acf/settings/show_updates', '__return_false', 100);
}


function my_acf_json_save_point($path)
{
    return get_stylesheet_directory() . '/inc/acf-json';
}
add_filter('acf/settings/save_json', 'my_acf_json_save_point');
