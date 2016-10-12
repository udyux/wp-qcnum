<? # home page layout #
  $activity_title = get_field('activity_title', 'options');
  $clients_title  = get_field('clients_title', 'options');
  $show_signup    = get_field('show_signup', 'options');
?>

<section class="row">
  <?php // TODO: scrollable feeds ?>
  <!-- articles -->
  <aside class="row__item feed feed--news">
    <div class="feed__header">
      <h3 class="feed__type">chroniques</h3>
    </div>

    <?
      $articles = new WP_Query(array(
        'posts_per_page'	=> 3,
        'post_type'				=> 'article',
        'post_status' 		=> 'publish'
      ));

      $c = 0;

      if ( $articles->have_posts() ): while ( $articles->have_posts() ) : $articles->the_post();

      $max = $c == 0 ? 750 : 350;
      $c++;

      $title   = get_the_title();
      $link    = get_permalink();
      $excerpt = _udyux_get_excerpt($max);
      $img        = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
      $featured   = _udyux_get_featured_image($post->ID, 'article'); ?>

      <article class="feed__item">
        <div class="feed__image" style="background-image:url(<?= $featured; ?>)"></div>

        <div class="feed__content">
          <h3 class="feed__title"><?= $title; ?></h3>
          <p class="feed__excerpt"><span class="feed__overlay"></span><?= $excerpt; ?></p>
          <a class="feed__link" href="<?= $link; ?>"></a>
        </div>
      </article>

    <? endwhile; endif; wp_reset_query(); ?>

  </aside>

  <!-- events -->
  <aside class="row__item feed feed--events">
    <div class="feed__header">
      <h3 class="feed__type">évènements</h3>
    </div>

    <?
      $events = new WP_Query( array(
        'posts_per_page'	=> 3,
        'post_type'				=> 'event',
        'post_status' 		=> 'publish'
      ));

      if ( $events->have_posts() ): while ( $events->have_posts() ) : $events->the_post();

      $title      = get_the_title();
      $link       = get_permalink();
      $start_date = _udyux_format_date( get_field('start_date') );
      $end_date   = _udyux_format_date( get_field('end_date') );
      $excerpt    = _udyux_get_excerpt(250);
      $featured   = _udyux_get_featured_image($post->ID, 'event'); ?>

      <article class="feed__item">
        <div class="feed__image" style="background-image:url(<?= $featured; ?>)"></div>

        <div class="feed__content">
          <h3 class="feed__title">

            <? if ($start_date && $end_date): ?>
              <sup><?= "{$start_date['date']} {$start_date['month']} &mdash; {$end_date['date']} {$end_date['month']} {$end_date['year']}"; ?></sup><br>
            <? elseif ($start_date): ?>
              <sup><?= "{$start_date['date']} {$start_date['month']} {$start_date['year']}"; ?></sup><br>
            <? endif; ?>

            <?= $title; ?>

          </h3>
          <p class="feed__excerpt"><span class="feed__overlay"></span><?= $excerpt; ?></p>
          <a class="feed__link" href="<?= $link; ?>"></a>
        </div>
      </article>

    <? endwhile; endif; wp_reset_query(); ?>

  </aside>
</section>

<? if ($show_signup) _udyux_get_partial('form', 'signup'); ?>
