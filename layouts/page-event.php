<? # event page layout #
  $id      = get_the_ID();
  $title   = get_the_title();
  $content = _udyux_format_content( get_the_content() );
  $img     = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
  $header  = $img ?: get_field('event_header', 'options');

  $map      = get_field('map');
  $map_link = _udyux_get_map_link($map['address']);
  $address  = !empty($map) ? explode(',', $map['address']) : false;
  $zoom     = get_field('zoom');
  $venue    = get_field('venue');
  $price    = get_field('price');

  $link       = get_field('link');
  $link_label = get_field('link_label');

  $start_date = _udyux_format_date( get_field('start_date') );
  $end_date   = _udyux_format_date( get_field('end_date') );

  $start_time = get_field('start_time');
  $end_time   = get_field('end_time');

  $show_signup = get_field('show_signup');
?>

  <header class="header header--map">
    <div id="map" class="map"
      data-lat="<?= $location['lat']; ?>"
      data-lng="<?= $location['lng']; ?>"
      data-zoom="<?= $zoom; ?>"
      data-venue="<?= $venue; ?>"
      data-link="<?= $map_link; ?>"
      <? if ($address): ?>
      data-address="<?= "{$address[0]}, {$address[1]}"; ?>"
      <? endif; ?>>
    </div>
  </header>

<? else: ?>

    <header class="header" style="background-image:url(<?= $header; ?>)"></header>

<? endif; ?>

<article id="post-<?= $id; ?>" class="post">
  <section class="post__content">
    <h1 class="post__title post__title--event"><?= $title; ?></h1>
    <div class="rte js-cleanPost"><?= $content; ?></div>
  </section>

  <aside class="post__sidebar sidebar">
    <div class="post__meta">
      <p class="sidebar__label">où</p>
      <h2 class="sidebar__meta"><?= $venue; ?></h2>

      <p class="sidebar__label">quand</p>

      <? if ($start_date && $end_date): ?>

        <p class="sidebar__submeta">Commence</p>
        <h3 class="sidebar__meta">

          <?
            echo "{$start_date['day']} le {$start_date['date']} {$start_date['month']}, {$start_date['year']}";
            if ( !empty($start_time) ) echo "<br>@ {$start_time}";
          ?>

        </h3>

        <p class="sidebar__submeta">Termine </p>
        <h3 class="sidebar__meta">

          <?
            echo "{$end_date['day']} le {$end_date['date']} {$end_date['month']}, {$end_date['year']}";
            if ( !empty($end_time) ) echo "<br>@ {$end_time}";
          ?>

        </h3>

      <? elseif ($start_date): ?>

        <h3 class="sidebar__meta">

          <?
            echo "{$start_date['day']} le {$start_date['date']} {$start_date['month']}, {$start_date['year']}";
            if ( !empty($start_time) ) echo "<br>@ {$start_time}";
          ?>

        </h3>

      <? endif; if ( !empty($price) ): ?>

        <p class="sidebar__label">prix</p>
        <h2 class="sidebar__meta"><?= preg_match("/gratuit/i", $price) ? $price : "{$price}$"; ?></h2>

      <? endif; if ( !empty($link) ): ?>

        <h4 class="sidebar__link"><a href="<?= $link; ?>"><?= $link_label; ?></a></h4>

      <? endif; ?>
    </div>

  	<? if ($show_signup) _udyux_get_partial('form', 'signup'); ?>
  </aside>
</article>

<? _udyux_get_partial('post', 'feed'); ?>
