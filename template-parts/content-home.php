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

<header class="header header--frontpage" role="banner" style="background-image:url(<? the_field('header_background'); ?>)">
	<h1 class="header__title"><span class="text--desktop"><? the_field('header_banner'); ?></span><span class="text--mobile"><? the_field('mobile_header_banner'); ?></span></h1>
	<span class="header__lead"><svg class="util__icon"><use xlink:href="#caret"></use></svg></span>
</header>

<!-- activity -->
<section class="section activity">
	<h2 class="section__title"><? the_field('activity_title'); ?></h2>

	<div class="row--md activity__row">

		<? if ( have_rows('activity_blocks') ) : while ( have_rows('activity_blocks') ) : the_row(); ?>

    <div class="activity__block row__item">
			<img class="activity__icon" src="<? the_sub_field('block_icon'); ?>" alt="<? the_sub_field('activity_title'); ?>"/>
			<h3 class="activity__title"><? the_sub_field('block_title'); ?></h3>
			<p class="activity__desc"><? the_sub_field('block_description'); ?></p>
		</div>

		<? endwhile; endif; ?>

	</div>
</section>

<!-- latest articles and events -->
<section class="row">
	<!-- articles -->
	<aside class="feed feed--news">
		<?php
		$the_articles = new WP_Query( array(
			'posts_per_page'	=> 3,
			'post_type'				=> 'article',
			'post_status' 		=> 'publish'
		) );

		$c = 0;
		if ( $the_articles->have_posts() ): while ( $the_articles->have_posts() ) : $the_articles->the_post();
      // first article's excerpt is 500 characters
			$max = ( $c == 0 ) ? 500 : 190;
			$c++;
		?>

			<article class="feed__item" style="background-image:url( <? echo wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?> )">
				<h3 class="feed__title"><a href="<? the_permalink(); ?>"><? the_title(); ?></a></h3>
				<p><? echo _udyux_trim_excerpt( get_the_excerpt(), $max ); ?></p>
			</article>

		<? endwhile; endif; wp_reset_query(); ?>
	</aside>

	<!-- events -->
	<aside class="feed feed--events">
		<?php
		$the_events = new WP_Query( array(
			'posts_per_page'	=> 3,
			'post_type'				=> 'event',
			'post_status' 		=> 'publish'
		) );

		if ( $the_events->have_posts() ): while ( $the_events->have_posts() ) : $the_events->the_post(); ?>

			<article class="feed__item" style="background-image:url( <? echo wp_get_attachment_url( get_post_thumbnail_id($post->ID)); ?> )">
				<h3 class="feed__title"><a href="<? the_permalink(); ?>"><? the_title(); ?></a></h3>
				<p><? echo _udyux_trim_excerpt( get_the_excerpt(), 350 ); ?></p>
			</article>

		<? endwhile; endif; wp_reset_query(); ?>
	</aside>
</section>
