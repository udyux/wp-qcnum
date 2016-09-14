<? # article page layout #
  $id      = get_the_ID();
  $date    = get_the_date();
  $content = _udyux_format_content( get_the_content() );

  $show_signup = get_field('show_signup');

  $author = array(
    'name' => get_the_author(),
    'link' => get_author_posts_url( get_the_author_meta('ID') )
  );
?>

<article id="post-<?= $id; ?>" class="post">
  <section class="post__content post__content--article">
    <div class="rte js-cleanPost"><?= $content; ?></div>
  </section>

  <aside class="post__sidebar sidebar">
    <div class="post__meta">
      <p class="sidebar__label">Auteur</p>
      <h2 class="sidebar__meta"><a href="<?= $author['link']; ?>"><?= $author['name']; ?></a></h2>
      <p class="sidebar__label">Publié</p>
      <h3 class="sidebar__meta"><?= $date; ?></h3>
    </div>

    <? if ($show_signup) _udyux_get_partial('form', 'signup'); ?>
  </aside>
</article>

<? _udyux_get_partial('feed', 'preview'); ?>
