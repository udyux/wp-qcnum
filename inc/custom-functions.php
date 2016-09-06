<?php # custom functions #

## get layout
function _udyux_get_layout($type, $name) {
  $path = get_template_directory();
  require "{$path}/layouts/{$type}-{$name}.php";
}


## get partial
function _udyux_get_partial($name, $data = false) {
  $path = get_template_directory();
  require "{$path}/layouts/partials/{$name}.php";
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


## get google maps link with query
function _udyux_get_map_link($string) {
	$string = preg_replace('/\s+/', ' ', $string);
	$string = strtolower(preg_replace('/\s/', '+', $string));
	return "https://www.google.ca/maps/place/{$string}";
}


## format content with p tags
function _udyux_format_content($content) {
  return apply_filters( 'the_content', wpautop($content) );
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
