<?php
/**
 * The template for displaying the front-page.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package _UdyUX
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main front-page" role="main">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'front-page' );

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
