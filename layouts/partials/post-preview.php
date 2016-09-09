<?
  $id      = get_the_ID();
  $title   = get_the_title();
  $link    = get_permalink();
  $excerpt = _udyux_get_excerpt(1000);
  $img     = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );

  $post_type = get_post_type();
  $featured  = $img ?: get_field("{$post_type}_header", 'options');
?>

<article id="post-<?= $currentNode['id']; ?>" class="preview">
	<div class="preview__image" style="background-image:url(<?= $featured; ?>)"><h3 class="preview__title"><?= $title; ?></h3></div>
	<p class="preview__excerpt"><?= $excerpt; ?></p>
</article>
