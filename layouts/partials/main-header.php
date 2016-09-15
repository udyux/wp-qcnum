<? # main header #
  $page = _udyux_page_is();
  $classlist = array('header');
  $map = get_field('map');

  if (_udyux_page_is('post')) {
    $title  = get_the_title();
    $header = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ) ?: get_field("{$page}_header", 'options');
  }

  elseif ($page === 'archive') {
    $type   = get_post_type();
    $title  = get_field("{$type}_title", 'options');
    $header = get_field("{$type}_header", 'options');
  }

  else {
    $title = $page === 'author' ? get_the_author() : get_field("{$page}_title", 'options');
    $header = get_field("{$page}_header", 'options');
  }

  if ($page == 'home') $classlist[] = 'header--home';
  else if (!empty($map)) $classlist[] = 'header--map';
  else if ($type === 'event' || $page === 'event') $classlist[] = 'header--reverse';
?>

<header class="<?= implode(' ', $classlist); ?>" role="banner">

  <? if (!empty($map)): ?>
    <?
      $map_link = _udyux_get_map_link($map['address']);
      $address  = explode(',', $map['address']);
      $zoom     = get_field('zoom');
      $venue    = get_field('venue');
    ?>

    <div id="map" class="map"
      data-lat="<?= $map['lat']; ?>"
      data-lng="<?= $map['lng']; ?>"
      data-zoom="<?= $zoom; ?>"
      data-venue="<?= $venue; ?>"
      data-link="<?= $map_link; ?>"
      data-address="<?= "{$address[0]}, {$address[1]}"; ?>">
    </div>

  <? else: ?>

    <div class="header__image" style="background-image:url(<?= $header; ?>)"></div>
    <h1 class="header__title "><?= $title; ?></h1>

  <? endif; ?>

</header>
