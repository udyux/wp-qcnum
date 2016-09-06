<? # home page template #
  $homeNode = array(
    'home_banner'     => get_field('home_banner', 'options'),
    'home_background' => get_field('home_background', 'options'),
    'activity_title'  => get_field('activity_title', 'options'),
    'clients_title'   => get_field('clients_title', 'options'),
    'show_signup'     => get_field('show_signup', 'options')
  );
?>

<header class="header header--home" role="banner" style="background-image:url(<?= $homeNode['home_background']; ?>)">
  <h1 class="header__title "><?= $homeNode['home_banner']; ?></h1>
</header>

<section class="section activity">
  <h2 class="section__title"><?= $homeNode['activity_title']; ?></h2>
  <div class="row--md activity__row">

    <?
      if ( have_rows('activity_blocks', 'options') ) : while ( have_rows('activity_blocks', 'options') ) : the_row();

      $currentNode = array(
        'title' => get_sub_field('block_title'),
        'img'   => get_sub_field('block_icon'),
        'desc'  => get_sub_field('block_description')
      ); ?>

      <div class="activity__block row__item">
        <img class="activity__icon" src="<?= $currentNode['img']; ?>" alt="<?= $currentNode['title']; ?>"/>
        <h3 class="activity__title"><?= $currentNode['title']; ?></h3>
        <p class="activity__desc"><?= $currentNode['desc']; ?></p>
      </div>

    <? endwhile; endif; ?>

  </div>
</section>

<? if ($homeNode['show_signup']) _udyux_get_partial('signup', true); ?>

<section class="row">
  <!-- articles -->
  <aside class="row__item feed feed--news">

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

      $currentNode = array(
        'title'   => get_the_title(),
        'link'    => get_permalink(),
        'img'     => wp_get_attachment_url( get_post_thumbnail_id($post->ID) ),
        'excerpt' => _udyux_get_excerpt($max)
      ); ?>

      <article class="feed__item">
        <div class="feed__image" style="background-image:url(<?= $currentNode['img']; ?>)"></div>
        <div class="feed__content js-bgColor">
          <h3 class="feed__title"><?= $currentNode['title']; ?></h3>
          <p class="feed__excerpt"><span class="feed__overlay js-bgColorTarget"></span><?= $currentNode['excerpt']; ?></p>
          <a class="feed__link" href="<?= $currentNode['link']; ?>"></a>
        </div>
      </article>

    <? endwhile; endif; wp_reset_query();?>

  </aside>

  <!-- events -->
  <aside class="row__item feed feed--events">

    <?
      $events = new WP_Query( array(
        'posts_per_page'	=> 3,
        'post_type'				=> 'event',
        'post_status' 		=> 'publish'
      ));

      if ( $events->have_posts() ): while ( $events->have_posts() ) : $events->the_post();

      $currentNode = array(
        'title'     => get_the_title(),
        'link'      => get_permalink(),
        'start_date' => _udyux_format_date( get_field('start_date') ),
        'end_date'   => _udyux_format_date( get_field('end_date') ),
        'img'       => wp_get_attachment_url( get_post_thumbnail_id($post->ID) ),
        'excerpt'   => _udyux_get_excerpt(250)
      );

      list($start_date, $end_date) = array($currentNode['start_date'], $currentNode['end_date']); ?>

      <article class="feed__item">
        <div class="feed__image" style="background-image:url(<?= $currentNode['img']; ?>)"></div>
        <div class="feed__content js-bgColor">
          <h3 class="feed__title">

            <? if ($start_date && $end_date): ?>
              <sup><?= "{$start_date['date']} {$start_date['month']} &mdash; {$end_date['date']} {$end_date['month']} {$end_date['year']}"; ?></sup><br>
            <? elseif ($start_date): ?>
              <sup><?= "{$start_date['date']} {$start_date['month']} {$start_date['year']}"; ?></sup><br>
            <? endif; ?>

            <?= $currentNode['title']; ?>

          </h3>
          <p class="feed__excerpt"><span class="feed__overlay js-bgColorTarget"></span><?= $currentNode['excerpt']; ?></p>
          <a class="feed__link" href="<?= $currentNode['link']; ?>"></a>
        </div>
      </article>

    <? endwhile; endif; wp_reset_query(); ?>

  </aside>
</section>