<? # main header #
  $page = _udyux_page_is();
  $about = $page === 'about';
  $map  = $page === 'event' ? get_field('map') : null;

  // event or article
  if (_udyux_page_is('post')) {
    $title  = get_the_title();
    $header = _udyux_get_featured_image($post->ID, $page);
  }

  // event or article archive
  else if ($page === 'archive') {
    $type   = get_post_type();
    $title  = get_field("{$type}_title", 'options');
    $header = get_field("{$type}_header", 'options');
  }

  // author, search or home
  else if ($page === 'author') {
    $author   = _udyux_get_author_meta( get_the_author_meta('ID') );
    $title    = $author['name'];
    $header   = get_field("{$page}_header", 'options');
    $grav_url = $author['grav'];
  }

  else {
    $title  = get_field("{$page}_title", 'options');
    $header = get_field("{$page}_header", 'options');
  }

  $grav = !empty($grav_url) ? '<img class="header__grav" src="'.$grav_url.'"><br>' : '';

  $classlist = array('header');

  if ($page == 'home') $classlist[] = 'header--home';
  else if (!empty($map)) $classlist[] = 'header--map';
  else if ($type === 'event' || $page === 'event') $classlist[] = 'header--reverse';
  else if ($page === 'about') $classlist[] = 'header--about';
?>

<header class="<?= implode(' ', $classlist); ?>" role="banner">

  <? if (!empty($map)):
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

  <? elseif (!$about): ?>

    <div class="header__image" style="background-image:url(<?= $header; ?>)"></div>
    <h1 class="header__title "><?= $grav . $title; ?></h1>

  <? endif; ?>

</header>
