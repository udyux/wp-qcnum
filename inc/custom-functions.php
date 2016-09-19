<?php # custom functions #

## router
function _udyux_get_layout() {
  $root = get_template_directory();

  $pages = array(
    'home'    => is_front_page(),
    'article' => get_post_type() === 'article' && is_single(),
    'event'   => get_post_type() === 'event' && is_single(),
    'about'   => is_page_template('layouts/about.php'),
    'archive' => is_archive() || is_search()
  );

  $page = '404';
  foreach ($pages as $this_page => $is) {
    if ($is) {
      $page = $this_page;
      break;
    }
  }

  // render
  require "{$root}/layouts/header.php";
  require "{$root}/layouts/{$page}.php";
  require "{$root}/layouts/footer.php";
}


## get partial
function _udyux_get_partial($type, $name) {
  require get_template_directory() . "/layouts/partials/{$type}-{$name}.php";
}


## check or get page type
function _udyux_page_is($type = null) {
  $pages = array(
    'home'    => is_front_page(),
    'article' => is_singular('article'),
    'event'   => is_singular('event'),
    'about'   => is_page_template('layouts/about.php'),
    'archive' => is_post_type_archive(array('article', 'event')),
    'search'  => is_search(),
    'author'  => is_author(),
    'post'    => is_single()
  );

  if ($type) return $pages[$type];
  else foreach ($pages as $page => $is) if ($is) return $page;
}


## format content with p tags
function _udyux_format_content($content) {
  return apply_filters('the_content', wpautop($content));
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


## get featured image or default
function _udyux_get_featured_image($post_id, $type = 'article') {
  $featured = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
  $default = get_field("{$type}_header", 'options');
  return $featured ?: $default;
}


## get author meta
function _udyux_get_author_meta($author_id) {
  return array(
    'name' => get_the_author(),
    'link' => get_author_posts_url($author_id),
    'grav' => get_avatar_url($author_id, array('size' => 256)),
    'desc' => get_the_author_meta('description')
  );
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


## get google maps link
function _udyux_get_map_link($string) {
	$string = preg_replace('/\s+/', ' ', $string);
	$string = strtolower(preg_replace('/\s/', '+', $string));
	return "https://www.google.ca/maps/place/{$string}";
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
