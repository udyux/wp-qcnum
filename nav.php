<?php
/**
 * The template for displaying the nav bar.
 *
 * Contains the theme's nav and is included in the header.
 *
 * @package _UdyUX
 */
?>

<nav id="site-navigation" class="nav" role="navigation">
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
		<img class="logo" src="<?php the_field('logo', 'options'); ?>" alt="québec numérique"/>
	</a>

  <menu class="nav__menu">
	 <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
 </menu>
</nav>
