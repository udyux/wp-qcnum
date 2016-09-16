<? # main header #
  $page = _udyux_page_is();
  $classlist = array('header');
  $map = $page === 'event' ? get_field('map') : null;

  // event or article
  if (_udyux_page_is('post')) {
    $title  = get_the_title();
    $header = _udyux_get_featured_image($post->ID, $page);
  }

  // event or article archive
  elseif ($page === 'archive') {
    $type   = get_post_type();
    $title  = get_field("{$type}_title", 'options');
    $header = get_field("{$type}_header", 'options');
  }

  // author, search or home
  else {
    $title = $page === 'author' ? get_the_author() : get_field("{$page}_title", 'options');
    $header = get_field("{$page}_header", 'options');

  }

  if ($page === 'author') $grav = get_avatar_url( get_the_author_meta('ID'), array('size' => 256) );

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
    <h1 class="header__title ">

      <? if (!empty($grav)): ?>

        <img class="header__grav" src="<?= $grav; ?>"><br>

      <? endif; ?>

      <?= $title; ?>

    </h1>

  <? endif; ?>

</header>
