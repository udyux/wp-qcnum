<? # archive post preview #
  $id      = get_the_ID();
  $type    = get_post_type();

  $title   = get_the_title();
  $link    = get_permalink();
  $excerpt = _udyux_get_excerpt(130);
  $featured = _udyux_get_featured_image($post->ID, $type);

  $classlist = array('preview');

  if ($type === 'event') {
    $classlist[] = 'preview--event';
    $start_date  = _udyux_format_date( get_field('start_date') );
    $end_date    = _udyux_format_date( get_field('end_date') );
    $venue       = get_field('venue');
    $venue_link  = get_field('link');
  }

  else {
    $date    = get_the_date();
    $author = array(
      'name' => get_the_author(),
      'link' => get_author_posts_url( get_the_author_meta('ID') )
    );
  }
?>

<article id="post-<?= $currentNode['id']; ?>" class="<?= implode(' ', $classlist); ?>">
	<div class="preview__image" style="background-image:url(<?= $featured; ?>)"></div>
  <div class="preview__overlay"></div>

  <div class="preview__content">
    <h3 class="preview__title">
      <a href="<?= $link; ?>"><?= $title; ?></a>
    </h3>

    <div>
      <p><?= $excerpt; ?></p>
      <ul class="preview__meta">

        <? if ($type === 'event'): ?>

          <a href="<?= $venue_link; ?>" target="_blank"><?= $venue; ?></a>

          <? if ($start_date && $end_date): ?>
            <li><b><?= "{$start_date['date']} {$start_date['month']} &mdash; {$end_date['date']} {$end_date['month']} {$end_date['year']}"; ?></b></li>
          <? elseif ($start_date): ?>
            <li><b><?= "{$start_date['date']} {$start_date['month']} {$start_date['year']}"; ?></b></li>
          <? endif; ?>

        <? else: ?>

          <li>Par <a href="<?= $author['link']; ?>"><?= $author['name']; ?></a></li>
          <li>Le <b><?= $date; ?></b></li>

        <? endif; ?>

      </ul>
    </div>
  </div>
</article>
