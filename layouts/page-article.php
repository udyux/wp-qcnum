<? # article page template #
  $postNode = array(
    'id'      => $post->ID,
    'img'     => wp_get_attachment_url( get_post_thumbnail_id($post->ID) ),
    'title'   => get_the_title(),
    'author'  => get_the_author(),
    'date'    => get_the_date(),
    'content' => get_the_content()
  );

  $showSignup = get_field('show_signup');
?>

<article id="post-<? echo $postNode['id']; ?>" class="post">
  <header class="post__header">
  	<div class="post__image" style="background-image:url(<? echo $postNode['img']; ?>)"></div>
  	<h1 class="post__title"><? echo $postNode['title']; ?></h1>
  </header>

  <section class="post__content">
    <? echo $postNode['content']; ?>
  </section>

  <aside class="post__sidebar sidebar">
    <p class="sidebar__meta">par</p>
    <h2 class="sidebar__title"><? echo $postNode['author']; ?></h2>
    <p class="sidebar__meta">le</p>
    <h3 class="sidebar__subtitle"><? echo $postNode['date']; ?></h3>

    <? if ($showSignup) _udyux_get_partial('signup'); ?>
  </aside>
</article>

<? _udyux_get_partial('postfeed', 'article'); ?>
