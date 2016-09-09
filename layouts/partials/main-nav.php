<? # site-wide nav #
  $home_url = home_url();
  $logo     = get_field('logo', 'options');
?>

<nav class="nav" role="navigation">
	<a href="<?= $home_url; ?>">
		<img class="logo" src="<?= $logo; ?>" alt="québec numérique"/>
	</a>

  <menu class="nav__menu">

    <?
      if ( have_rows('nav_links', 'options') ) : while ( have_rows('nav_links', 'options') ) : the_row();

      $link  = get_sub_field('link');
      $label = get_sub_field('label'); ?>

      <li class="nav__link">
        <a href="<?= $link; ?>"><?= $label; ?></a>
      </li>

    <? endwhile; endif; ?>

    <? _udyux_get_partial('form', 'search'); ?>

  </menu>
</nav>
