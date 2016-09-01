<? # site-wide nav #
  $navNode = array(
    'homeUrl' => home_url(),
    'logo'    => get_field('logo', 'options')
  );
?>

<nav class="nav" role="navigation">
	<a href="<? echo $navNode['homeUrl']; ?>">
		<img class="logo" src="<? echo $navNode['logo']; ?>" alt="québec numérique"/>
	</a>

  <menu class="nav__menu">

    <?
      if ( have_rows('nav_links', 'options') ) : while ( have_rows('nav_links', 'options') ) : the_row();

      $currentNode = array(
        'link'  => get_sub_field('link'),
        'label' => get_sub_field('label')
      ); ?>

      <li class="nav__link">
        <a href="<? echo $currentNode['link']; ?>"><? echo $currentNode['label']; ?></a>
      </li>

    <? endwhile; endif; ?>

  </menu>
</nav>
