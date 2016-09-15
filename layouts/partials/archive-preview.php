<? # archive post preview #
  $id      = get_the_ID();
  $type    = get_post_type();

  $title   = get_the_title();
  $date    = get_the_date();
  $link    = get_permalink();
  $excerpt = _udyux_get_excerpt(170);
  $featured = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ) ?: get_field("{$type}_header", 'options');

  $author = array(
    'name' => get_the_author(),
    'link' => get_author_posts_url( get_the_author_meta('ID') )
  );

  $classlist = $type === 'event' ? 'preview preview--event' : 'preview';
?>

<article id="post-<?= $currentNode['id']; ?>" class="<?= $classlist; ?>">
	<div class="preview__image" style="background-image:url(<?= $featured; ?>)"></div>

  <div class="preview__content">
    <h3 class="preview__title">
      <a href="<?= $link; ?>"><?= $title; ?></a>
    </h3>

    <div>
      <p><?= $excerpt; ?></p>
      <div class="preview__meta">

        <? if ($type == 'article'): ?>
          <p>Par <a href="<?= $author['link']; ?>"><?= $author['name']; ?></a></p>
          <p>Le <b><?= $date; ?></b></p>
        <? endif; ?>

      </div>
    </div>
  </div>
</article>
