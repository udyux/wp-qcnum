<? # article page layout #
  $id      = get_the_ID();
  $title   = get_the_title();
  $author  = get_the_author();
  $date    = get_the_date();
  $content = _udyux_format_content( get_the_content() );
  $img     = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
  $header  = $img ?: get_field('article_header', 'options');

  $show_signup = get_field('show_signup');
?>

<header class="header" style="background-image:url(<?= $header; ?>)">
  <h1 class="header__title "><?= $title; ?></h1>
</header>

<article id="post-<?= $id; ?>" class="post">
  <section class="post__content post__content--article">
    <div class="rte js-cleanPost"><?= $content; ?></div>
  </section>

  <aside class="post__sidebar sidebar">
    <div class="post__meta">
      <p class="sidebar__label">Auteur</p>
      <h2 class="sidebar__meta"><?= $author; ?></h2>
      <p class="sidebar__label">Publié</p>
      <h3 class="sidebar__meta"><?= $date; ?></h3>
    </div>

    <? if ($show_signup) _udyux_get_partial('form', 'signup'); ?>
  </aside>
</article>

<? _udyux_get_partial('post', 'feed'); ?>
