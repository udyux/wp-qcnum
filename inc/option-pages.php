<?php # admin option pages #

## Add ACF General options page
// http://www.advancedcustomfields.com/resources/acf_add_options_page/
if ( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title' 	=> 'Général',
		'menu_title' 	=> 'Général',
		'menu_slug' 	=> 'qcnum-global-settings',
		'capability' 	=> 'edit_posts',
		'redirect' 	=> false,
		'icon_url' => get_bloginfo('stylesheet_directory') . '/icons/globe.png'
	));

  acf_add_options_page(array(
    'page_title' 	=> 'Accueil',
		'menu_title' 	=> 'Accueil',
		'menu_slug' 	=> 'qcnum-home-settings',
		'capability' 	=> 'edit_posts',
		'redirect' 	=> false,
		'icon_url' => get_bloginfo('stylesheet_directory') . '/icons/home.png'
	));
}
#/
