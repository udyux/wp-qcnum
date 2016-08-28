<? # site-wide nav ?>

<nav class="nav" role="navigation">
	<a href="<? bloginfo('url'); ?>">
		<img class="logo" src="<? the_field('logo', 'options'); ?>" alt="québec numérique"/>
	</a>

  <menu class="nav__menu">

    <? if ( have_rows('nav_links', 'options') ) : while ( have_rows('nav_links', 'options') ) : the_row(); ?>

    <li class="nav__link">
      <a href="<? the_sub_field('link'); ?>"><? the_sub_field('label'); ?></a>
    </li>

    <? endwhile; endif; ?>

  </menu>
</nav>
