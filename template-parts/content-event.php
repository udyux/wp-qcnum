<?php
/**
 *
 * The template for displaying event content
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package QcNum
 */
?>

<section id="post-<? the_ID(); ?>" <? post_class(); ?>>
	<header class="entry-header">


			<div class="acf-map">
				<div class="marker" data-lat="<? echo $location['lat']; ?>" data-lng="<? echo $location['lng']; ?>">
					<h4 class="map-venue"><? the_field( 'event_venue' ); ?></h4>
					<p class="map-address"><? echo $address[0] . ', ' . $address[1] ?></p>
					<p><? the_field( 'event_start_date' ); ?> @ <? the_field( 'event_start_time' ); ?></p>
				</div>
			</div>

		<? endif; ?>
	</header>

	<div class="entry-content">
		<article>
			<hgroup><? the_title( '<h2 class="entry-title">', '</h2>' ); ?></hgroup>
				<?php
				the_content();

				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'qcnum' ),
					'after'  => '</div>',
				) );
				?>

			<footer class="entry-footer">
				<?php
				edit_post_link(
					sprintf(
						/* translators: %s: Name of current post */
						esc_html__( 'Edit %s', 'qcnum' ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					),
					'<span class="edit-link">',
					'</span>'
				);
				?>
			</footer>
		</article>

		<aside>
			<div class="event-data">
				<h3>Lieu:</h3>
				<h4><? the_field( 'event_venue' ) ?></h4>
				<h3>Début:</h3>
				<h4><? the_field( 'event_start_date' ) ?> @ <? the_field( 'event_start_time' ) ?></h4>
				<h3>Fin:</h3>
				<h4><? the_field( 'event_end_date' ) ?> @ <? the_field( 'event_end_time' ) ?></h4>
				<h3>Prix:</h3>
				<h4><? the_field( 'event_price' ) ?></h4>
				<h3>Site web:</h3>
				<h4><? the_field( 'event_url' ) ?></h4>
			</div>

			<!-- event newsletter -->
			<form>
				<h3>Restez à l'affût</h3>
				<p>Recevez les évènements pour<br>la semaine à chaque lundi!</p>
				<fieldset>
					<input type="email" name="new_event_sub" id="new_event_sub" placeholder="Votre courriel" autocomplete="email" autocorrect="off" autocapitalize="none" spellcheck="false"/>
					<button id="add_event_sub">S'inscrire</button>
				</fieldset>
			</form>
		</aside>
	</div>
</section>

<section class="latest">
	<?php
	$the_events = new WP_Query( array(
		'post__not_in' 				=> array( get_the_ID() ),
		'posts_per_page'	=> 3,
		'post_type'				=> 'event',
		'post_status' 		=> 'publish'
	) );

	if ( $the_events->have_posts() ): while ( $the_events->have_posts() ) : $the_events->the_post(); ?>

		<article>
			<div class="latest-bg" class="" style="background-image:url( <? echo wp_get_attachment_url( get_post_thumbnail_id($post->ID)); ?> )"></div>
			<h3><a href="<? the_permalink(); ?>"><? the_title(); ?></a></h3>
			<p><? echo _udyux_trim_excerpt( get_the_excerpt(), 200 ); ?></p>
		</article>
	<? endwhile; endif; wp_reset_query(); ?>
</section>
