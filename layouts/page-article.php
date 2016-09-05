<? # article page template #
  $postNode = array(
    'id'      => get_the_ID(),
    'img'     => wp_get_attachment_url( get_post_thumbnail_id($post->ID) ),
    'title'   => get_the_title(),
    'author'  => get_the_author(),
    'date'    => get_the_date(),
    'content' => _udyux_format_content( get_the_content() )
  );

  $titleImage = $postNode['img'] ?: get_template_directory_uri() . '/images/article_placeholder.jpg';
  $showSignup = get_field('show_signup');
?>

<header class="header" style="background-image:url(<? echo $titleImage; ?>)">
  <h1 class="header__title "><? echo $postNode['title']; ?></h1>
</header>

<article id="post-<? echo $postNode['id']; ?>" class="post">
  <section class="post__content post__content--article">
    <div class="rte js-cleanPost"><? echo $postNode['content']; ?></div>
  </section>

  <aside class="post__sidebar sidebar">
    <div class="post__meta">
      <p class="sidebar__label">Auteur</p>
      <h2 class="sidebar__meta"><? echo $postNode['author']; ?></h2>
      <p class="sidebar__label">Publié</p>
      <h3 class="sidebar__meta"><? echo $postNode['date']; ?></h3>
    </div>

    <? if ($showSignup) _udyux_get_partial('signup'); ?>
  </aside>
</article>

<? _udyux_get_partial('postfeed', 'article'); ?>
