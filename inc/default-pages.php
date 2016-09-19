<?php # default pages #

$default_pages = array(
  'about' => array(
    'post_type' => 'page',
    'post_title' => 'Organisation',
    'post_name' => 'organisation',
    'post_content' => 'null',
    'page_template' => 'layouts/about.php',
    'comment_status' => 'closed'
  )
);

foreach (array_values($default_pages) as $page) {
  if (!get_page_by_path($page['post_name'])) wp_insert_post($page);
}
