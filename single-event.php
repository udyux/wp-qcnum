<?php
/**
 * The template for displaying an event page.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package _UdyUX
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main event-page" role="main">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'event' );

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
