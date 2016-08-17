<?php
/**
 	* _UdyUX theme functions and definitions.
 	*
 	* @link https://developer.wordpress.org/themes/basics/theme-functions/
 	*
 	* @package _UdyUX
	* If you're building a theme based on _UdyUX, use a find and replace
	* to change '_udyux' to the name of your theme in all the template files.
*/


// Include core functions.
require get_template_directory() . '/inc/core-functions.php';
// Include post types.
require get_template_directory() . '/inc/post-types.php';


## Enqueue main scripts and styles.
function _udyux_main_assets() {
	wp_enqueue_style( '_udyux-style', get_stylesheet_uri() );
	wp_enqueue_script( '_udyux-parallaxr', get_template_directory_uri() . '/js/parallaxr.min.js', array(), '20160101', true );
	wp_enqueue_script( '_udyux-scripts', get_template_directory_uri() . '/js/scripts.js', array(), '20160101', true );
}
add_action( 'wp_enqueue_scripts', '_udyux_main_assets' );
#/


## Enqueue admin custom stylesheet through ACF
// https://www.advancedcustomfields.com/resources/acfinputadmin_enqueue_scripts/
function _udyux_admin_assets() {
	wp_register_style( '_udyux-admin-style', get_stylesheet_directory_uri() . '/admin-style.css', false, '1.0.0' );
	wp_enqueue_style( 'udyux-admin-style' );
}
add_action( 'acf/input/admin_enqueue_scripts', '_udyux_admin_assets', 15 );
#/


# Add ACF General options page
// http://www.advancedcustomfields.com/resources/acf_add_options_page/
if ( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title' 	=> 'Général',
		'menu_title' 	=> 'Général',
		'menu_slug' 	=> 'qcnum-global',
		'capability' 	=> 'edit_posts',
		'redirect' 	=> false,
		'icon_url' => get_bloginfo('stylesheet_directory').'/images/qn.png'
	) );
}
#/


## Trim string to passed number of characters.
// If > 2 sentences remove incomplete last sentence else trim last incomplete word.
function trim_excerpt( $excerpt, $max_chars ) {
	$trimmed = substr( $excerpt, 0, $max_chars );
	$sentences = explode( '.', $trimmed );
	$count = count( $sentences );

	if ( $count > 1 ) {
		unset( $sentences[ $count-1 ] );
		return implode( '.', $sentences ) . '.';
	}

	else {
		$single_sentence = implode( '.', $sentences ) . '.';
		$words = explode( ' ', $single_sentence );
		$wordcount = count( $words );
		unset( $words[ $wordcount-1 ]);
		return implode ( ' ', $words ) . '...';
	}
}
#/


## TinyMCE first line toolbar customizations and block element select options
// http://wordpress.stackexchange.com/a/45824
function visual_editor_allowed_tags($arr){
	$arr['block_formats'] = 'Paragraph=p;Heading 3=h3;Heading 4=h4;Heading 5=h5;Heading 6=h6';
	return $arr;
}
add_filter('tiny_mce_before_init', 'visual_editor_allowed_tags');
#/
