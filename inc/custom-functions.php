<?php # custom functions #

## Trim string to passed number of characters
// If > 2 sentences remove incomplete last sentence else trim last incomplete word
function _udyux_trim_excerpt($excerpt, $max_chars) {
	$trimmed = substr($excerpt, 0, $max_chars);
	$sentences = explode( '.', $trimmed);
	$count = count($sentences);

	if ($count > 1) {
		unset($sentences[$count-1]);
		return implode('.', $sentences) . '.';
	}

	else {
		$single_sentence = implode('.', $sentences) . '.';
		$words = explode(' ', $single_sentence);
		$wordcount = count($words);
		unset($words[$wordcount-1]);
		return implode (' ', $words) . '...';
	}
}


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


## format content
function _udyux_format_content($content) {
  return apply_filters( 'the_content', wpautop($content) );
}
