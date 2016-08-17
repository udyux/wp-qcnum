<?php
/**
 * The template for displaying the nav bar.
 *
 * Contains the theme's nav and is included in the footer.
 *
 * @package _UdyUX
 */
?>

<nav id="site-navigation" class="main-navigation" role="navigation">
	<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
		<?php esc_html_e( 'Primary Menu', '_udyux' ); ?>
	</button>

	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
		<h1 id="site-name">québec numérique</h1>
		<img src="<?php the_field('logo', 'options'); ?>" class="logo" alt="québec numérique"/>
	</a>

	<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
</nav>
