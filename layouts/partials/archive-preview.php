<? # archive post preview #
  $id      = get_the_ID();
  $title   = get_the_title();
  $date    = get_the_date();
  $link    = get_permalink();
  $excerpt = _udyux_get_excerpt(1000);

  $author = array(
    'name' => get_the_author(),
    'link' => get_author_posts_url( get_the_author_meta('ID') )
  );

  $post_type = get_post_type();
  $featured  = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ) ?: get_field("{$post_type}_header", 'options');
?>

<article id="post-<?= $currentNode['id']; ?>" class="preview">
	<div class="preview__image" style="background-image:url(<?= $featured; ?>)"></div>
  <a class="preview__link" href="<?= $link; ?>"><h3 class="preview__title"><?= $title; ?></h3></a>

  <div class="preview__excerpt">
    <p><?= $excerpt; ?></p>

    <div class="preview__meta">
      <p>Par <a href="<?= $author['link']; ?>"><?= $author['name']; ?></a></p>
      <p>Le <b><?= $date; ?></b></p>
    </div>
  </div>
</article>
