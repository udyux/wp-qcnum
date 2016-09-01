<?php # theme settings #

## google maps api key for admin
add_filter('acf/settings/google_api_key', function () {
  return 'AIzaSyD2IjP7p0YRO_X2zrtPdnIbCnay3RFXs8M';
});

## add theme supported features
if ( !function_exists('_udyux_setup') ) {
  function _udyux_setup() {
  	// Enable support for Post Thumbnails on posts and pages.
   	// https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
  	add_theme_support( 'post-thumbnails' );

  	// Let WordPress manage the document title.
  	add_theme_support( 'title-tag' );

  	// Switch default markup for search form, comment form, and comments to HTML5.
  	add_theme_support('html5', array(
  		'search-form',
  		'comment-form',
  		'comment-list',
  		'gallery',
  		'caption',
  	));
  }
}
add_action('after_setup_theme', '_udyux_setup');


## TinyMCE first line toolbar customizations and block element select options
// http://wordpress.stackexchange.com/a/45824
function _udyux_rte_config($arr){
	$arr['block_formats'] = 'Paragraph=p;Heading 3=h3;Heading 4=h4;Heading 5=h5;Heading 6=h6';
	return $arr;
}
add_filter('tiny_mce_before_init', '_udyux_rte_config');


## unwrap img tags in post content
function _udyux_unwrap_images($content){
  return preg_replace('/<p>(\s*)(<img .* \/>)(\s*)<\/p>/iU', '\2', $content);
}
add_filter('the_content', '_udyux_unwrap_images');


## Set media width
function _udyux_content_width() {
	$GLOBALS['content_width'] = apply_filters('_udyux_content_width', 640 );
}
add_action( 'after_setup_theme', '_udyux_content_width', 0 );


## Set default posts sort order in admin
function _udyux_admin_post_order($wp_query) {
  global $pagenow;
  if ( is_admin() && 'edit.php' == $pagenow && !isset($_GET['orderby'])) {
    $wp_query->set( 'orderby', 'date' );
    $wp_query->set( 'order', 'DSC' );
  }
}
add_filter('pre_get_posts', '_udyux_admin_post_order');
