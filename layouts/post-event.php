<? # event page template #
  $postNode = array(
    'id'          => get_the_ID(),
    'img'         => wp_get_attachment_url( get_post_thumbnail_id($post->ID) ),
    'title'       => get_the_title(),
    'content'     => _udyux_format_content( get_the_content() ),
    'map'         => get_field('map'),
    'zoom'        => get_field('zoom'),
    'venue'       => get_field('venue'),
    'price'       => get_field('price'),
    'link'        => get_field('link'),
    'link_label'  => get_field('link_label'),
    'start_date'  => _udyux_format_date( get_field('start_date') ),
    'start_time'  => get_field('start_time'),
    'end_date'    => _udyux_format_date( get_field('end_date') ),
    'end_time'    => get_field('end_time'),
    'show_signup' => get_field('show_signup')
  );

  list($start_date, $end_date) = array($postNode['start_date'], $postNode['end_date']);

  $location = $postNode['map'];
  $map_link = _udyux_get_map_link($location['address']);

  $title_image = $postNode['img'] ?: get_template_directory_uri() . '/images/event_placeholder.jpg';
?>

<? if ( !empty($location) ): $address = explode(',', $location['address']); ?>

  <header class="header header--map">
    <div id="map" class="map"
      data-lat="<?= $location['lat']; ?>"
      data-lng="<?= $location['lng']; ?>"
      data-zoom="<?= $postNode['zoom']; ?>"
      data-venue="<?= $postNode['venue']; ?>"
      data-address="<?= "{$address[0]}, {$address[1]}"; ?>">
    </div>
  </header>

<? else: ?>

    <header class="header" style="background-image:url(<?= $title_image; ?>)"></header>

<? endif; ?>

<article id="post-<?= $postNode['id']; ?>" class="post">
  <section class="post__content">
    <h1 class="post__title post__title--event"><?= $postNode['title']; ?></h1>
    <div class="rte js-cleanPost"><?= $postNode['content']; ?></div>
  </section>

  <aside class="post__sidebar sidebar">
    <div class="post__meta">
      <p class="sidebar__label">où</p>
      <h2 class="sidebar__meta"><?= $postNode['venue']; ?></h2>

      <p class="sidebar__label">quand</p>

      <? if ($start_date && $end_date): ?>

        <p class="sidebar__submeta">Commence</p>
        <h3 class="sidebar__meta">

          <?
            echo "{$start_date['day']} le {$start_date['date']} {$start_date['month']}, {$start_date['year']}";
            if ( !empty($postNode['start_time']) ) echo "<br>@ {$postNode['start_time']}";
          ?>

        </h3>

        <p class="sidebar__submeta">Termine </p>
        <h3 class="sidebar__meta">

          <?
            echo "{$end_date['day']} le {$end_date['date']} {$end_date['month']}, {$end_date['year']}";
            if ( !empty($postNode['end_time']) ) echo "<br>@ {$postNode['end_time']}";
          ?>

        </h3>

      <? elseif ($start_date): ?>

        <h3 class="sidebar__meta">

          <?
            echo "{$start_date['day']} le {$start_date['date']} {$start_date['month']}, {$start_date['year']}";
            if ( !empty($postNode['start_time']) ) echo "<br>@ {$postNode['start_time']}";
          ?>

        </h3>

      <? endif; if ( !empty($postNode['price']) ): ?>

        <p class="sidebar__label">prix</p>
        <h2 class="sidebar__meta"><?= preg_match("/gratuit/i", $postNode['price']) ? $postNode['price'] : "{$postNode['price']}$"; ?></h2>

      <? endif; if ( !empty($postNode['link']) ): ?>

        <h4 class="sidebar__link"><a href="<?= $postNode['link']; ?>"><?= $postNode['link_label']; ?></a></h4>

      <? endif; ?>
    </div>

  	<? if ($postNode['show_signup']) _udyux_get_partial('signup'); ?>
  </aside>
</article>

<? _udyux_get_partial('postfeed', 'event'); ?>
