<? # list page layout #
  $type   = is_search() ? 'search' : get_post_type();
  $title  = get_field("{$type}_title", 'options');
  $header = get_field("{$type}_header", 'options');
?>

<header class="header" style="background-image:url(<?= $header; ?>)">
  <h1 class="header__title"><?= $title; ?></h1>
</header>

<section class="postList">
    <nav class="postList__nav"><? the_posts_navigation(); ?></nav>

  <?
    if ( have_posts() ): while ( have_posts() ) : the_post();
      _udyux_get_partial('post', 'preview');
    endwhile; ?>

    <nav class="postList__nav"><? the_posts_navigation(); ?></nav>

  <?
    else:
      get_template_part('template-parts/content', 'none');
    endif;
  ?>

</section>
