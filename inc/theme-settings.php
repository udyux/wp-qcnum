<?php # theme settings #

## add theme support features
function _udyux_setup() {
	// enable support for post thumbnails
	add_theme_support('post-thumbnails');
	// let WordPress manage the document title
	add_theme_support('title-tag');
	// switch default markup for comments to HTML5
	add_theme_support('html5', array(
		'comment-form',
		'comment-list'
	));
}
add_action('after_setup_theme', '_udyux_setup');


## set posts per page
// http://wordpress.stackexchange.com/a/30763
function _udyux_posts_per_page($query) {
  if ( !is_admin() && $query->is_main_query() ) $query->set('posts_per_page', get_field('posts_per_page', 'options'));
}
add_action('pre_get_posts', '_udyux_posts_per_page');


## add custom post types to author queries
// http://wordpress.stackexchange.com/a/161954
function _udyux_author_post_types($query) {
  if ( !is_admin() && $query->is_main_query() && $query->is_author() ) $query->set('post_type', array('post', 'article'));
}
add_action('pre_get_posts', '_udyux_author_post_types');


## Set media width
function _udyux_content_width() {
	$GLOBALS['content_width'] = apply_filters('_udyux_content_width', 640 );
}
add_action('after_setup_theme', '_udyux_content_width', 0);


## google maps api key for admin
function _udyux_google_api_key() {
  return get_field('google_api_key', 'options');
}
add_filter('acf/settings/google_api_key', '_udyux_google_api_key');


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


## Set default posts sort order in admin
function _udyux_admin_post_order($wp_query) {
  global $pagenow;
  if ( is_admin() && 'edit.php' == $pagenow && !isset($_GET['orderby'])) {
    $wp_query->set( 'orderby', 'date' );
    $wp_query->set( 'order', 'DSC' );
  }
}
add_filter('pre_get_posts', '_udyux_admin_post_order');
