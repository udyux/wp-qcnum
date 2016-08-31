<? # event page template #
  $eventNode = array(
    'id'        => $post->ID,
    'img'       => wp_get_attachment_url( get_post_thumbnail_id($post->ID) ),
    'title'     => get_the_title(),
    'content'   => get_the_content(),
    'map'       => get_field('map'),
    'venue'     => get_field('venue'),
    'price'     => get_field('price'),
    'link'      => get_field('link'),
    'linkLabel' => get_field('link_label'),
    'startDate' => get_field('start_date'),
    'startTime' => get_field('start_time'),
    'endDate'   => get_field('end_date'),
    'endTime'   => get_field('end_time')
  );

  $titleImg   = !empty($eventNode['img']) ? $eventNode['img'] : get_template_directory_uri() . '/images/event_placeholder.jpg';
  $showSignup = get_field('show_signup');
?>

<article id="post-<? echo $eventNode['id']; ?>" class="post">
  <header class="post__header">

    <?
      if ( !empty($eventNode['map']) ):

      $location = $eventNode['map'];
      $address = explode(',', $location['address']); ?>

      <div class="post__map map js-map">
        <div class="map__marker" data-lat="<? echo $location['lat']; ?>" data-lng="<? echo $location['lng']; ?>">
          <h4 class="map__venue"><? echo $eventNode['venue']; ?></h4>
          <p class="map__address"><? echo $address[0] . ', ' . $address[1]; ?></p>
        </div>
      </div>

    <? else: ?>

      <div class="post__image" style="background-image:url(<? echo $titleImage; ?>)"></div>

    <? endif; ?>

  </header>

  <section class="post__content">
    <h1 class="post__title"><? echo $eventNode['title']; ?></h1>

    <div class="rte">
      <? echo $eventNode['content']; ?>
    </div>
  </section>

  <aside class="post__sidebar sidebar">
    <p class="sidebar__meta">où</p>
    <h2 class="sidebar__title"><? echo $eventNode['venue']; ?></h2>
    <p class="sidebar__meta">quand</p>
    <h3 class="sidebar__subtitle">
      <? echo $eventNode['startDate']; if ( !empty($eventNode['startTime']) ) echo ' @ ' . $eventNode['startTime']; ?>
    </h3>

    <? if ( !empty($eventNode['endDate']) ): ?>

      <p class="sidebar__meta">&nbsp;&nbsp;&nbsp;au</p>
      <h3 class="sidebar__subtitle">
        <? echo $eventNode['endtDate']; if ( !empty($eventNode['endTime']) ) echo ' @ ' . $eventNode['endTime']; ?>
      </h3>

    <? endif; ?>

    <? if ( !empty($eventNode['price']) ): ?>

      <p class="sidebar__meta"></p>
      <h2 class="sidebar__title"><? echo $eventNode['price']; ?></h2>

    <? endif; ?>

    <h4 class="sidebar__link"><a href="<? echo $eventNode['link']; ?>"><? echo $eventNode['linkLabel']; ?></a></h4>

  	<? _udyux_get_partial('signup'); ?>
  </aside>
</article>

<? _udyux_get_partial('postfeed', 'event'); ?>
