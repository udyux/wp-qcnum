<?php
/**
 * The template for displaying the front-page.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package _UdyUX
 */

get_header();

while ( have_posts() ) : the_post();

	get_template_part( 'template-parts/content', 'front-page' );

endwhile;

get_footer();
