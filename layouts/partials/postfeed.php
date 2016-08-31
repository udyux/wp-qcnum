<? # post feed # ?>

<section class="postfeed">

  <?
    $articles = new WP_Query(array(
		  'post__not_in' 		=> array( $post->ID ),
		  'posts_per_page'	=> 3,
		  'post_type'				=> $data ?: 'article',
		  'post_status' 		=> 'publish'
	  ));

	  if ( $articles->have_posts() ): while ( $articles->have_posts() ) : $articles->the_post();

    $currentNode = array(
      'title'   => get_the_title(),
      'link'    => get_permalink(),
      'img'     => wp_get_attachment_url( get_post_thumbnail_id($post->ID) ),
      'excerpt' => trim_excerpt(get_the_excerpt(), 200)
    ); ?>

		<article class="postfeed__item" style="background-image:url( <? echo $currentNode['bgImg']; ?>);">
			<h5 class="postfeed__title"><a href="<? echo $currentNode['link']; ?>"><? echo $currentNode['title']; ?></a></h3>
			<p><? echo $currentNode['excerpt']; ?></p>
		</article>

	<? endwhile; endif; wp_reset_query(); ?>

</section>
