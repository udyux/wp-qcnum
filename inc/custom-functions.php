<?php # custom functions #

## get layout
function _udyux_get_layout($type, $name) {
  require get_template_directory() . "{$path}/layouts/{$type}-{$name}.php";
}


## get partial
function _udyux_get_partial($type, $name) {
  require get_template_directory() . "{$path}/layouts/partials/{$type}-{$name}.php";
}


## get page type
function _udyux_page_is($type = null) {
  $pages = array(
    'home'    => is_front_page(),
    'article' => get_post_type() === 'article' && is_single(),
    'event'   => get_post_type() === 'event' && is_single(),
    'archive' => is_post_type_archive('article') || is_post_type_archive('event'),
    'search'  => is_search(),
    'author'  => is_author(),
    'post'    => is_single()
  );

  if ($type) return $pages[$type];
  else foreach ($pages as $page => $is) if ($is) return $page;
}


## get trimmed excerpt from content
function _udyux_get_excerpt($charlength) {
  $excerpt = preg_replace(" (\[.*?\])",'', get_the_content());
  $excerpt = strip_tags($excerpt);
  $excerpt = substr($excerpt, 0, $charlength);
  $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
  $excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));
  $excerpt = "{$excerpt} &mldr;";
  return $excerpt;
}


## get post list navigation links
function _udyux_get_next_paged_link() {
	global $paged, $wp_query;
  $paged = $paged ?: 1;
  $max_pages = $wp_query->max_num_pages;
  return array(
    'link'  => $paged + 1 <= $max_pages ? get_pagenum_link($paged + 1) : null,
    'label' => get_field('paged_nav_next_label', 'options')
  );
}


## get post list navigation links
function _udyux_get_prev_paged_link() {
	global $paged;
  $paged = $paged ?: 1;
  return array(
    'link' => is_paged() ? get_pagenum_link($paged - 1) : null,
    'label' => get_field('paged_nav_prev_label', 'options')
  );
}


## get google maps link with query
function _udyux_get_map_link($string) {
	$string = preg_replace('/\s+/', ' ', $string);
	$string = strtolower(preg_replace('/\s/', '+', $string));
	return "https://www.google.ca/maps/place/{$string}";
}


## format content with p tags
function _udyux_format_content($content) {
  return apply_filters('the_content', wpautop($content));
}


## format date to french string
function _udyux_format_date($dmy) {
  if ( !empty($dmy) ) {
    setlocale(LC_TIME, "fr_FR");
    list($d,$m,$y) = explode('/', $dmy);

    return array(
      'day' => strftime('%A', mktime(0,0,0,$m,$d,$y)),
      'date' => (int)$d,
      'month' => strftime('%B', mktime(0,0,0,$m,$d,$y)),
      'year' => $y
    );
  }

  else return false;
}
