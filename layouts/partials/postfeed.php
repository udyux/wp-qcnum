<? # post feed # ?>

<section class="feed feed--post row">

  <?
    $posts = new WP_Query(array(
		  'post__not_in' 		=> array( get_the_ID() ),
		  'posts_per_page'	=> 3,
		  'post_type'				=> $data ?: 'article',
		  'post_status' 		=> 'publish'
	  ));

    $isEvent = $data == 'event';

	  if ( $posts->have_posts() ): while ( $posts->have_posts() ) : $posts->the_post();

    $currentNode = array(
      'title'     => get_the_title(),
      'link'      => get_permalink(),
      'img'       => wp_get_attachment_url( get_post_thumbnail_id($post->ID) ),
      'excerpt'   => _udyux_get_excerpt(200),
      'startDate' => _udyux_format_date( get_field('start_date') ),
      'endDate'   => _udyux_format_date( get_field('end_date') )
    );

    list($startDate, $endDate) = array($currentNode['startDate'], $currentNode['endDate']); ?>

    <article class="feed__item row__item">
      <div class="feed__image" style="background-image:url(<? echo $currentNode['img']; ?>)"></div>
      <div class="feed__content js-bgColor">
        <h3 class="feed__title">

          <? if ($startDate && $endDate): ?>
            <sup><? echo "{$startDate['date']} {$startDate['month']} &mdash; {$endDate['date']} {$endDate['month']} {$endDate['year']}"; ?></sup><br>
          <? elseif ($startDate): ?>
            <sup><? echo "{$startDate['date']} {$startDate['month']} {$startDate['year']}"; ?></sup><br>
          <? endif; ?>

          <? echo $currentNode['title']; ?>

        </h3>
        <p class="feed__excerpt"><span class="feed__overlay js-bgColorTarget"></span><? echo $currentNode['excerpt']; ?></p>
        <a class="feed__link" href="<? echo $currentNode['link']; ?>"></a>
      </div>
    </article>

	<? endwhile; endif; wp_reset_query(); ?>

</section>
