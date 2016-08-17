<?php
/**
 *
 * The template for displaying the front-page content
 *
 * Template Name: front-page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package _UdyUX
 */
?>

<header id="masthead" class="site-header parallax-parent" role="banner">
	<div class="hero-img parallax" data-ratio=".35">
		<img src="<? the_field('frontpage_background') ?>"/>
	</div>

	<div class="overlay"></div>

	<h1><? the_field('banner'); ?></h1>

	<span class="icon lead"><svg class="icon"><use xlink:href="#caret"></use></svg></span>
</header>

<!-- activities section -->
<section id="activities">
	<h2 class="title">implications</h2>

	<div class="flexbox">

		<? if ( have_rows('activities') ): while ( have_rows('activities') ) : the_row(); ?>
		<div class="activity">
			<img src="<? the_sub_field('activity_icon'); ?>" alt="<? the_sub_field('activity_title'); ?>"/>

			<h3><? the_sub_field('activity_title'); ?></h3>

			<p><? the_sub_field('activity_desc'); ?></p>
		</div>
		<? endwhile; endif; ?>

	</div>
</section>

<!-- glider section -->
<section id="glider">
	<div class="glider-box">

		<? if ( have_rows('areas') ): while ( have_rows('areas') ) : the_row(); ?>
		<div class="glider">
			<h3><? the_sub_field('area_title'); ?></h3>

			<p><? the_sub_field('area_text'); ?></p>
		</div>
		<? endwhile; endif; ?>
	</div>

	<div class="glider-nav"></div>

	<h2 class="title">chantiers</h2>
</section>

<!-- latest articles and events -->
<section id="latest">
	<!-- article previews -->
	<aside id="articles">
		<?php
		$the_articles = new WP_Query( array(
			'posts_per_page'	=> 3,
			'post_type'				=> 'article',
			'post_status' 		=> 'publish'
		) );

		$c = 0;
		if ( $the_articles->have_posts() ): while ( $the_articles->have_posts() ) : $the_articles->the_post();
			$max = ( $c == 0 ) ? 500 : 190;
			$c++;
		?>

			<article>
				<div class="latest-bg" class="" style="background-image:url( <? echo wp_get_attachment_url( get_post_thumbnail_id($post->ID)); ?> )"></div>
				<h3><a href="<? the_permalink(); ?>"><? the_title(); ?></a></h3>
				<p><? echo trim_excerpt( get_the_excerpt(), $max ); ?></p>
			</article>

		<? endwhile; endif; wp_reset_query(); ?>
	</aside>
	<!-- event previews -->
	<aside id="events">
		<?php
		$the_events = new WP_Query( array(
			'posts_per_page'	=> 3,
			'post_type'				=> 'event',
			'post_status' 		=> 'publish'
		) );

		if ( $the_events->have_posts() ): while ( $the_events->have_posts() ) : $the_events->the_post(); ?>

			<article>
				<div class="latest-bg" class="" style="background-image:url( <? echo wp_get_attachment_url( get_post_thumbnail_id($post->ID)); ?> )"></div>
				<h3><a href="<? the_permalink(); ?>"><? the_title(); ?></a></h3>
				<p><? echo trim_excerpt( get_the_excerpt(), 350 ); ?></p>
			</article>

		<? endwhile; endif; wp_reset_query(); ?>
	</aside>
</section>
