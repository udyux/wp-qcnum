<?php
/**
 	* _UdyUX core functions
 	*
 	* @link https://developer.wordpress.org/themes/basics/theme-functions/
 	*
 	* @package _UdyUX
*/


## Sets up theme defaults and registers support for various WordPress features.
if ( ! function_exists( '_udyux_setup' ) ) :

function _udyux_setup() {
	// Enable support for Post Thumbnails on posts and pages.
 	// https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	add_theme_support( 'post-thumbnails' );

	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Make theme available for translation.
	load_theme_textdomain( '_udyux', get_template_directory() . '/languages' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', '_udyux' ),
	) );

	// Switch default markup for search form, comment form, and comments to HTML5.
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( '_udyux_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}

endif;
add_action( 'after_setup_theme', '_udyux_setup' );
#/


## Set the content width in pixels, based on the theme's design and stylesheet.
function _udyux_content_width() {
	$GLOBALS['content_width'] = apply_filters( '_udyux_content_width', 640 );
}
add_action( 'after_setup_theme', '_udyux_content_width', 0 );
#/


## Register widget area.
// https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
function _udyux_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', '_udyux' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', '_udyux' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', '_udyux_widgets_init' );
#/


## Enqueue scripts and styles.
function _udyux_core_scripts() {
	wp_enqueue_script( '_udyux-navigation', get_template_directory_uri() . '/js/lib/navigation.js', array(), '20151215', true );
	wp_enqueue_script( '_udyux-skip-link-focus-fix', get_template_directory_uri() . '/js/lib/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', '_udyux_core_scripts' );
#/


## requires
// Implement the Custom Header feature.
require get_template_directory() . '/inc/custom-header.php';
// Custom template tags for this theme.
require get_template_directory() . '/inc/template-tags.php';
// Custom functions that act independently of the theme templates.
require get_template_directory() . '/inc/extras.php';
// Customizer additions.
require get_template_directory() . '/inc/customizer.php';
// Load Jetpack compatibility file.
require get_template_directory() . '/inc/jetpack.php';
#/
