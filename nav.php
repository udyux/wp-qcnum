<?php
/**
 * The template for displaying the nav bar.
 *
 * Contains the theme's nav and is included in the footer.
 *
 * @package _UdyUX
 */
?>

<nav id="site-navigation" class="nav" role="navigation">
	<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
		<?php esc_html_e( 'Primary Menu', '_udyux' ); ?>
	</button>

	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
		<img class="logo" src="<?php the_field('logo', 'options'); ?>" alt="québec numérique"/>
	</a>

  <menu class="nav__menu">
	 <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
 </menu>
</nav>
