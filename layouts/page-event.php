<? # event page template #
  $postNode = array(
    'id'        => get_the_ID(),
    'img'       => wp_get_attachment_url( get_post_thumbnail_id(get_the_id()) ),
    'title'     => get_the_title(),
    'content'   => _udyux_format_content( get_the_content() ),
    'map'       => get_field('map'),
    'zoom'      => get_field('zoom'),
    'venue'     => get_field('venue'),
    'price'     => get_field('price'),
    'link'      => get_field('link'),
    'linkLabel' => get_field('link_label'),
    'startDate' => get_field('start_date'),
    'startTime' => get_field('start_time'),
    'endDate'   => get_field('end_date'),
    'endTime'   => get_field('end_time')
  );

  $titleImg   = !empty($postNode['img']) ? $postNode['img'] : get_template_directory_uri() . '/images/event_placeholder.jpg';
  $showSignup = get_field('show_signup');

  if ( !empty($postNode['map']) ):

  $location = $postNode['map'];
  $address = explode(',', $location['address']); ?>

  <header class="header header--map">
    <div id="map" class="map"
      data-lat="<? echo $location['lat']; ?>"
      data-lng="<? echo $location['lng']; ?>"
      data-zoom="<? echo $postNode['zoom']; ?>"
      data-venue="<? echo $postNode['venue']; ?>"
      data-address="<? echo "{$address[0]}, {$address[1]}"; ?>">
    </div>
  </header>

  <? else: ?>

    <header class="header" style="background-image:url(<? echo $titleImage; ?>)"></header>

  <? endif; ?>

</header>

<article id="post-<? echo $postNode['id']; ?>" class="post">
  <section class="post__content">
    <h1 class="post__title post__title--event"><? echo $postNode['title']; ?></h1>
    <div class="rte js-post"><? echo $postNode['content']; ?></div>
  </section>

  <aside class="post__sidebar sidebar">
    <div class="post__meta">
      <p class="sidebar__label">où</p>
      <h2 class="sidebar__meta"><? echo $postNode['venue']; ?></h2>

      <p class="sidebar__label">quand</p>

      <? if ( !empty($postNode['endDate']) ): ?>

        <h3 class="sidebar__meta">Commence le<br>&nbsp;&nbsp;<? echo $postNode['startDate']; if ( !empty($postNode['startTime']) ) echo ' @ ' . $postNode['startTime']; ?></h3>
        <h3 class="sidebar__meta">Termine le<br>&nbsp;&nbsp;<? echo $postNode['endDate']; if ( !empty($postNode['endTime']) ) echo ' @ ' . $postNode['endTime']; ?></h3>

      <? endif; if ( !empty($postNode['price']) ): ?>

        <p class="sidebar__label">prix</p>
        <h2 class="sidebar__meta"><? echo $postNode['price']; ?></h2>

      <? endif; if ( !empty($postNode['link']) ): ?>

        <h4 class="sidebar__link"><a href="<? echo $postNode['link']; ?>"><? echo $postNode['linkLabel']; ?></a></h4>

      <? endif; ?>
    </div>

  	<? if ($showSignup) _udyux_get_partial('signup'); ?>
  </aside>
</article>

<? _udyux_get_partial('postfeed', 'event'); ?>
