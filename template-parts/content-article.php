<?php
/**
 *
 * The template for displaying article content
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package QcNum
 */
?>

<section id="post-<? the_ID(); ?>" <? post_class(); ?>>
	<header class="entry-header">
		<div class="featured-image" style="background-image:url( <? echo wp_get_attachment_url( get_post_thumbnail_id($post->ID)); ?> )"></div>
		<? the_title( '<h2 class="entry-title">', '</h2>' ); ?>
	</header>

	<div class="entry-content">
		<article>
			<h5 class="publish-date"><? the_date(); ?></h5>
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
			<div class="article-data">

			</div>

			<!-- event newsletter -->
			<form>
				<h3>Restez à l'affût</h3>
				<p>Recevez les nouvelles chroniques<br>une fois par semaine!</p>
				<fieldset>
					<input type="email" name="new_news_sub" id="new_news_sub" placeholder="Votre courriel" autocomplete="email" autocorrect="off" autocapitalize="none" spellcheck="false"/>
					<button id="add_news_sub">S'inscrire</button>
				</fieldset>
			</form>
		</aside>
	</div>
</section>

<section class="latest">
	<?php
	$the_article = new WP_Query( array(
		'post__not_in' 				=> array( get_the_ID() ),
		'posts_per_page'	=> 3,
		'post_type'				=> 'article',
		'post_status' 		=> 'publish'
	) );

	if ( $the_article->have_posts() ): while ( $the_article->have_posts() ) : $the_article->the_post(); ?>

		<article>
			<div class="latest-bg" class="" style="background-image:url( <? echo wp_get_attachment_url( get_post_thumbnail_id($post->ID)); ?> )"></div>
			<h3><a href="<? the_permalink(); ?>"><? the_title(); ?></a></h3>
			<p><? echo trim_excerpt( get_the_excerpt(), 200 ); ?></p>
		</article>
	<? endwhile; endif; wp_reset_query(); ?>
</section>
