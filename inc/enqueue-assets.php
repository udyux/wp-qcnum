<?php # enqueue assets #

## replace wp jquery version
function _udyux_replace_jquery() {
  wp_deregister_script('jquery');

  wp_register_script('jquery', 'https://code.jquery.com/jquery-3.1.0.slim.min.js', array(), '3.1.0', true);
  wp_enqueue_script('jquery');
}
add_action('wp_enqueue_scripts', '_udyux_replace_jquery');
#/


## main scripts and styles.
function _udyux_main_assets() {
  wp_enqueue_style('_udyux-style', get_stylesheet_uri());

  wp_register_script('_udyux-scripts', get_template_directory_uri() . '/js/scripts.min.js', array(), '1', true);
  wp_enqueue_script('_udyux-scripts');
}
add_action('wp_enqueue_scripts', '_udyux_main_assets');
#/


## add scripts for event post types
function _udyux_event_assets() {
  if ( get_post_type() === 'event' && is_single() ) {
    $api_key = get_field('google_api_key', 'options');

    wp_register_script('_udyux-event-scripts', get_template_directory_uri() . '/js/event-scripts.min.js', array(), '1', true);
    wp_enqueue_script('_udyux-event-scripts');

    wp_register_script('_udyux-google-maps', "https://maps.googleapis.com/maps/api/js?key={$api_key}&callback=initMap", array(), '3.x.x', true);
    wp_enqueue_script('_udyux-google-maps');
  }
}
add_action('wp_enqueue_scripts', '_udyux_event_assets');
#/


## Enqueue admin custom stylesheet through ACF
// https://www.advancedcustomfields.com/resources/acfinputadmin_enqueue_scripts/
function _udyux_admin_assets() {
	wp_register_style('_udyux-admin-style', get_stylesheet_directory_uri() . '/admin-style.css');
	wp_enqueue_style('_udyux-admin-style');
}
add_action('acf/input/admin_enqueue_scripts', '_udyux_admin_assets', 15);
#/
