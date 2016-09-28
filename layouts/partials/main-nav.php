<? # main nav #
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

    <!-- <? _udyux_get_partial('form', 'search'); ?> -->
    <form id="search-form" role="search" method="GET" class="search" action="<?= home_url( '/' ); ?>">
      <input id="search-input" class="search__input" type="text" placeholder="Rechercher ..." value="<?= get_search_query(); ?>" name="s" autocomplete="off" required>
      <label class="search__label" for="search-input">
        <svg class="search__icon"><use xlink:href="#search"></use></svg>
      </label>
      <input id="search-submit" class="search__submit" type="submit" value="">
    </form>


  </menu>
</nav>
